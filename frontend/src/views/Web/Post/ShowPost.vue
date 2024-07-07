<template>
  <div>
    <NavBar />
    <div class="container">
      <router-link style="margin-top: 10px" to="/post/request/sell" class="btn btn-primary"
        >Back</router-link
      >
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
        <button
          style="margin: 10px"
          class="btn btn-success"
          @click="updatePostStatus(post.id, 'buy')"> Buy</button>
        <button class="btn btn-danger"  @click="updatePostStatus(post.id, 'cancel')">Cancel</button>
      </div>
    </div>
  </div>
</template>

<script>
import NavBar from '../../../Components/NavBar.vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

export default {
  name: 'ShowPost',
  components: {
    NavBar
  },
  props: ['id'],
  data() {
    return {
      post: null
    }
  },
  mounted() {
    this.fetchPost()
  },
  setup() {
    const router = useRouter()
    return { router }
  },
  methods: {
    async fetchPost() {
      try {
        const response = await axios.get(`http://127.0.0.1:8000/api/post/each/user/${this.id}`)
        this.post = response.data.data
        console.log(this.post)
      } catch (error) {
        console.error(error)
      }
    },

    //update status of post
    //update post status
    async updatePostStatus(postId, newStatus) {
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

        const message =
          newStatus === 'cancel'
            ? 'You have been cancelled this item.'
            : 'You have been bought this item.'
        alert(message)
        this.router.push('/post/request/sell')
      } catch (error) {
        const message =
          newStatus === 'cancel' ? 'Failed to cancel the item.' : 'Failed to buy the item.'
        alert(message)
        console.error('Error:', error)
      }
    }
  }
}
</script>

<style scoped>
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
</style>
