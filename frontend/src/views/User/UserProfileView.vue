<template>
  <div>
    <NavBar />
    <div class="container bootstrap snippets bootdeys">
      <div class="d-flex justify-content-center row mt-5">
        <div class="col-12 col-md-4 col-lg-3">
          <div class="panel rounded shadow">
            <div class="panel-body">
              <div class="inner-all">
                <ul class="list-unstyled text-center">
                  <li>
                    <img
                      data-no-retina=""
                      class="img-circle img-responsive img-bordered-primary mt-3"
                      alt="John Doe"
                      :src="`http://127.0.0.1:8000/uploads/${userData.profile}`"
                      style="
                        width: 200px;
                        height: 200px;
                        object-fit: cover;
                        object-position: center;
                        border-radius: 50%;
                        border: 5px solid #c2c2c2;
                      "
                      onerror="this.src='https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png'"
                    />
                    <input
                      ref="fileInput"
                      type="file"
                      style="display: none"
                      @change="handleFileChange"
                    />
                  </li>
                  <div class="mt-3">
                    <h5 style="color: black">{{ userData.name }}</h5>
                    <hr />
                    <p style="color: black">{{ userData.email }}</p>
                    <hr />
                    <p style="color: black">{{ userData.phone }}</p>
                    <hr />
                  </div>
                </ul>
              </div>
            </div>
            <button
              @click="showPostModal()"
              class="update-pf bg-success text-white rounded-circle position-absolute"
            >
              <i class="bi bi-plus-lg d-flex justify-content-center"></i>
            </button>
          </div>
        </div>
        <div class="col-12 col-md-8 col-lg-9">
          <PostCard :posts="posts" @delete-post="deletePost" />
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div
      class="modal fade"
      id="postModal"
      tabindex="-1"
      aria-labelledby="postModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <span class="close-button" @click="closeModal">&times;</span>
            <h2 style="color: black">Edit Profile</h2>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="updateProfile" method="post" enctype="multipart/form-data" v-if="user_info">
              <div class="title mt-3 mb-3">
                <input
                  type="text"
                  class="w-full p-2 border border-gray-300"
                  id="title"
                  name="name"
                  v-model="user_info.name"
                  required
                />
              </div>

              <div class="title mt-3 mb-3">
                <input
                  type="email"
                  class="w-full p-2 border border-gray-300"
                  name="email"
                  v-model="user_info.email"
                  required
                />
              </div>
              <div class="title mt-3 mb-3">
                <input
                  type="tel"
                  class="w-full p-2 border border-gray-300"
                  name="phone"
                  v-model="user_info.phone"
                  required
                />
              </div>

              <div class="mt-3">
                <div class="relative">
                  <img
                    v-if="imageUrl"
                    :src="imageUrl"
                    alt="Uploaded Image"
                    class="w-full h-300px border border-gray-300 p-2 cursor-pointer object-fit-cover"
                    @click="triggerFileInput"
                  />
                  <img
                    v-else
                    :src="`http://127.0.0.1:8000/uploads/${user_info.profile}`"
                    alt="Default Image"
                    class="w-full h-300px border border-gray-300 p-2 cursor-pointer object-fit-cover"
                    @click="triggerFileInput"
                  />
                  <input
                    type="file"
                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                    id="file_input"
                    name="image"
                    @change="handleFileUpload"
                  />
                </div>
              </div>

              <div class="flex justify-end space-x-10 mt-5">
                <button
                  type="submit"
                  class="px-4 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700"
                >
                  Save Change
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import NavBar from '@/Components/NavBar.vue'
import PostCard from '../Web/Post/PostCard.vue'
import axios from 'axios'

export default {
  components: {
    NavBar,
    PostCard
  },
  data() {
    return {
      posts: [],
      user_info: null,
      showModal: false,
      name: '',
      email: '',
      phone: '',
      imageUrl: ''
    }
  },
  computed: {
    userData() {
      return this.user_info || {}
    }
  },
  methods: {
    showPostModal() {
      // this.showModal = true
      $('#postModal').modal('show')
      this.name = this.userData.name
      this.email = this.userData.email
      this.phone = this.userData.phone
    },
    closeModal() {
      this.showModal = false
    },
    async fetchPosts() {
      try {
        const token = localStorage.getItem('access_token')
        const response = await axios.get('http://127.0.0.1:8000/api/post/show/user', {
          headers: {
            Authorization: `Bearer ${token}`
          }
        })
        this.posts = response.data.data
      } catch (error) {
        console.error(error)
      }
    },
    async deletePost(postId) {
      try {
        const token = localStorage.getItem('access_token')
        const response = await axios.delete(
          `http://127.0.0.1:8000/api/post/delete/user/${postId}`,
          {
            headers: {
              Authorization: `Bearer ${token}`
            }
          }
        )

        if (response.status === 200) {
          this.posts = this.posts.filter((post) => post.id !== postId)
        } else {
          console.error('Failed to delete post:', response.statusText)
        }
      } catch (error) {
        console.error('Error deleting post:', error)
      }
    },
    async fetchUser() {
      try {
        const token = localStorage.getItem('access_token')
        const response = await axios.get('http://127.0.0.1:8000/api/me', {
          headers: {
            Authorization: `Bearer ${token}`
          }
        })
        this.user_info = response.data.data
        console.info('User info:', this.user_info)
      } catch (error) {
        console.error('Error fetching user:', error)
      }
    },
    triggerFileInput() {
      this.$refs.fileInput.click()
    },
    handleFileUpload(event) {
      const file = event.target.files[0]
      this.imageUrl = URL.createObjectURL(file)
      this.$refs.fileInput.files = event.target.files
    },
    async updateProfile() {
      this.name=this.user_info.name
      this.email=this.user_info.email
      this.phone=this.user_info.phone
      try {
        const formData = new FormData()
        formData.append('name', this.name)
        formData.append('email', this.email)
        formData.append('phone', this.phone)
        if (this.$refs.fileInput.files[0]) {
          formData.append('profile', this.$refs.fileInput.files[0])
        }

        const token = localStorage.getItem('access_token')
        const response = await axios.post('http://127.0.0.1:8000/api/updateProfile', formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
            Authorization: `Bearer ${token}`
          }
        })

        this.user_info = response.data.data
        $('#postModal').modal('hide')
        this.closeModal()
      } catch (error) {
        console.error('Error updating profile:', error)
      }
    }
  },
  mounted() {
    this.fetchPosts()
    this.fetchUser()
  }
}
</script>

<style>
.container {
  padding: 0 15px;
}
.row {
  margin: 0 -15px;
}
.panel {
  position: relative;
}

.update-pf {
  border: 3px solid #c2c2c2;
  width: 40px;
  height: 40px;
  right: 17%;
  bottom: 50%;
  cursor: pointer;
}

@media (max-width: 767px) {
  .col-12 {
    flex: 0 0 100%;
    max-width: 100%;
  }
  .update-pf {
    right: 25%;
    bottom: 47%;
    width: 35px;
    height: 35px;
    cursor: pointer;
  }
}

@media (min-width: 768px) and (max-width: 991px) {
  .col-md-4,
  .col-md-8 {
    flex: 0 0 50%;
    max-width: 100%;
  }
  .col-md-4 {
    flex: 0 0 33.33%;
    max-width: 33.33%;
  }
  .update-pf {
    right: 10%;
    bottom: 50%;
    width: 35px;
    height: 35px;
    cursor: pointer;
  }
}

@media (min-width: 992px) {
  .col-lg-3,
  .col-lg-9 {
    flex: 0 0 25%;
    max-width: 25%;
  }
  .col-lg-9 {
    flex: 0 0 75%;
    max-width: 75%;
  }
}
</style>
