<template>
  <div>
    <NavBar />
    <div class="container" style="margin-top: 20px;margin-bottom:300px">
      <div class="row">
        <div class="col-lg-15">
          <div
            v-for="(notification, index) in notifications"
            :key="index"
            class="box shadow-sm rounded bg-white mb-3"
          >
            <div class="box-title border-bottom p-3">
              <h6 class="m-0" v-if="index === 0">Recent</h6>
              <h6 class="m-0" v-else-if="index === notifications.length - 1">Earlier</h6>
            </div>
            <div class="box-body p-0">
              <div
                class="p-3 d-flex align-items-center bg-light border-bottom osahan-post-header"
                @click="showPostModal(notification.post.id)"
                style="cursor: pointer"
              >
                <div class="dropdown-list-image mr-3">
                  <img
                    v-if="notification.post.user"
                    class="rounded-circle"
                    :src="`http://127.0.0.1:8000/uploads/${notification.post.user.profile}`"
                  />
                </div>
                <div class="font-weight-bold mr-3">
                  <div class="text-truncate" style="color: black">{{ notification.message }}</div>
                </div>
                <span class="ml-auto mb-auto">
                  <div class="btn-group">
                    <button
                      type="button"
                      class="btn btn-light btn-sm rounded"
                      data-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                    >
                      <i class="mdi mdi-dots-vertical"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                      <button
                        class="dropdown-item"
                        type="button"
                        @click="deleteNotification(notification.id)"
                      >
                        <i class="mdi mdi-delete"></i> Delete
                      </button>
                      <button
                        class="dropdown-item"
                        type="button"
                        @click="turnOffNotification(notification.id)"
                      >
                        <i class="mdi mdi-close"></i> Turn Off
                      </button>
                    </div>
                  </div>
                  <br />
                  <div class="text-right text-muted pt-1">{{ notification.time_diff }}</div>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div
      class="modal fade"
      id="postModal"
      tabindex="-1"
      aria-labelledby="postModalLabel"
      aria-hidden="true">
      <div class="modal-dialog ">
        <div class="modal-content">
          <div class="modal-header">
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <div class="post-container" v-if="post">
              <div class="post-header d-flex align-items-center">
                <img
                  :src="`http://127.0.0.1:8000/uploads/${post.user.profile}`"
                  alt="Account Image"
                  class="account-image rounded-circle"
                  style="border: 1px solid gray"
                />
                <h6 class="account-name ml-3 mb-0">{{ post.user.name }}</h6>
              </div>
              <p class="post-title" style="size: 5px">{{ post.title }}</p>
              <p class="text-danger" style="margin-top: -20px">Type of scrap:</p>
              <ul>
                <li>
                  <p class="comment-text">
                    <span v-for="(item, index) in post.items" :key="index">
                      {{ item.item }}{{ index < post.items.length - 1 ? ', ' : '' }}
                    </span>
                  </p>
                </li>
              </ul>

              <div class="row">
                <div
                  v-for="(image, index) in post.images"
                  :key="index"
                  class="col-sm-12 col-md-6 col-lg-4"
                >
                  <img
                    class="img-fluid shadow rounded mb-4 gallery-img"
                    :src="`http://127.0.0.1:8000/uploads/${image.image}`"
                    :alt="`Image ${index + 1}`"
                  />
                </div>
              </div>

              <div v-if="user_info.role_id == 3 && post.status == 'pending'">
                <button
                  style="margin: 10px"
                  class="btn btn-success"
                  @click="updatePostStatus(post.id, 'buy')"
                >
                  Buy
                </button>
                <button class="btn btn-danger" @click="updatePostStatus(post.id, 'cancel')">
                  Cancel
                </button>
              </div>
              <div v-else-if="user_info.role_id == 2 || post.status == 'buy' || post.status == 'cancel'">
                <button style="margin: 10px" class="btn btn-danger disabled">{{post.status}}</button>
              </div>

            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <FooterVue />
  </div>
</template>

<script>
import { ref, onMounted } from 'vue'
import NavBar from '../../../Components/NavBar.vue'
import FooterVue from '../../../Components/Footer.vue'
import axios from 'axios'

import { useToast } from 'vue-toastification'

export default {
  components: {
    NavBar,
    FooterVue
  },
  setup() {
    const toast = useToast()
    const notifications = ref([])
    const user_info = ref(null)
    const lastNotificationMessage = ref('')
    const post = ref(null)

    //fetch user info====
    async function fetchUser() {
      try {
        const token = localStorage.getItem('access_token')
        const response = await axios.get(`http://127.0.0.1:8000/api/me`, {
          headers: {
            Authorization: `Bearer ${token}`
          }
        })
        user_info.value = response.data.data
        console.log('User Info:', user_info.value)
      } catch (error) {
        console.error('Error fetching user:', error)
      }
    }

    //show all notification====
    async function fetchNotifications() {
      try {
        if (!user_info.value || !user_info.value.role_id) {
          throw new Error('User info or role_id is not available')
        }

        let endpoint = ''
        if (user_info.value.role_id === 2) {
          endpoint = 'user'
        } else if (user_info.value.role_id === 3) {
          endpoint = 'company'
        }

        const token = localStorage.getItem('access_token')
        const response = await axios.get(
          `http://127.0.0.1:8000/api/notification/${endpoint}/list`,
          {
            headers: {
              Authorization: `Bearer ${token}`
            }
          }
        )

        notifications.value = response.data.data
        console.log('Notifications:', notifications.value)
      } catch (error) {
        console.error('Error fetching notifications:', error)
      }
    }

    //show model
    async function showPostModal(postId) {
      try {
        const response = await axios.get(`http://127.0.0.1:8000/api/post/each/user/${postId}`)
        post.value = response.data.data
        console.log('Post Details:', post.value)
        $('#postModal').modal('show')
      } catch (error) {
        console.error('Error fetching post details:', error)
        toast.error('Failed to fetch post details')
      }
    }

    //update status
    async function updatePostStatus(postId, newStatus) {
      try {
        console.log('New Status:', newStatus)
        console.log('Post ID:', postId)

        const token = localStorage.getItem('access_token')
        if (!token) {
          throw new Error('No access token found')
        }

        const headers = {
          Authorization: `Bearer ${token}`,
          'Content-Type': 'application/json'
        }

        const data = { status: newStatus }

        const response = await axios.post(
          `http://127.0.0.1:8000/api/post/update/status/${postId}`,
          data,
          { headers }
        )

        console.log('Response:', response)

        // Update the post status in the local posts array
        const postIndex = notifications.value.findIndex((post) => post.id === postId)
        if (postIndex !== -1) {
          notifications.value[postIndex].status = newStatus
        }

        const message =
          newStatus === 'cancel'
            ? 'You have been cancelled this item.'
            : 'You have been bought this item.'
        alert(message)
        window.location.reload()
      } catch (error) {
        const message =
          newStatus === 'cancel' ? 'Failed to cancel the item.' : 'Failed to buy the item.'
        alert(message)
        console.error('Error:', error)
      }
    }

    onMounted(async () => {
      await fetchUser()
      await fetchNotifications()
    })

    return {
      notifications,
      user_info,
      fetchUser,
      fetchNotifications,
      lastNotificationMessage,
      showPostModal,
      post,
      updatePostStatus
    }
  }
}
</script>

<style scoped>
body {
  margin-top: 20px;
  background-color: #f0f2f5;
}
.dropdown-list-image {
  position: relative;
  height: 2.5rem;
  width: 2.5rem;
}
.dropdown-list-image img {
  height: 2.5rem;
  width: 2.5rem;
}
.btn-light {
  color: #2cdd9b;
  background-color: #e5f7f0;
  border-color: #d8f7eb;
}
.post-container {
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 10px;
  max-width: 600px;
  margin: 20px auto;
  background-color: #fff;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
.post-header {
  display: flex;
  align-items: center;
}

.account-image {
  width: 50px;
  height: 50px;
  border-radius: 50%;
}

.account-name {
  margin-left: 10px;
  font-weight: bold;
  color: #333;
}

.post-title {
  margin-top: 10px;
  font-size: 15px;
  color: #333;
}
li p {
  font-size: 15px;
  color: black;
  margin-top: -20px;
}

.post-image {
  height: 300px; /* Set a fixed height */

  width: 100%; /* Ensure images fill their containers */
  object-fit: cover; /* Maintain aspect ratio */
  border-radius: 8px;
  margin-top: 10px;
  cursor: pointer;
}

.more-images-indicator {
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: rgba(0, 0, 0, 0.6);
  color: #fff;
  border-radius: 10px;
  font-size: 1.2em;
  padding: 5px 10px;
  margin-top: 10px;
}

.buy-button {
  background-color: #4caf50;
  border: none;
  color: white;
  padding: 12px 24px;
  font-size: 1em;
  border-radius: 5px;
  transition:
    background 0.3s,
    transform 0.3s;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
  text-align: center;
  display: block;
  margin-top: 20px;
}

.buy-button:hover {
  background-color: #388e3c;
  transform: scale(1.05);
}

.buy-button:active {
  transform: scale(1);
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
}
h6 {
  color: black;
}
</style>
