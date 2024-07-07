<template>
  <div>
    <NavBar />
    <div class="container">
      <div class="post-container" v-for="post in posts" :key="post.id">
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
          :class="post.status === 'buy' ? 'btn btn-danger mt-3' : 'btn btn-success mt-3'"
          @click="updatePostStatus(post.id, post.status === 'buy' ? 'not_buy' : 'buy')"
        >
          {{ post.status === 'buy' ? 'Already Buy' : 'Buy' }}
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import NavBar from '../../../Components/NavBar.vue'
import axios from 'axios'

export default {
  name: 'PostComponent',
  components: {
    NavBar
  },
  data() {
    return {
      accountImage: '',
      accountName: '',
      postTitle: '',
      images: [],
      posts: []
    }
  },
  methods: {
    async fetchPosts() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/post/list')
        this.posts = response.data
        console.log(this.posts)
      } catch (error) {
        console.error(error)
      }
    },
    async updatePostStatus(postId, newStatus) {
  try {
    console.log(newStatus);
    console.log(postId);
    const token = localStorage.getItem('access_token');
    if (!token) {
      throw new Error('No access token found');
    }
    const headers = {
      Authorization: `Bearer ${token}`,
      'Content-Type': 'application/json'
    };
    const data = { status: newStatus };
    const response = await axios.post(
      `http://127.0.0.1:8000/api/post/update/status/${postId}`,
      data,
      { headers }
    );
    console.log('Response:', response);
    alert("You already buy this item.");
  } catch (error) {
    alert('You are a user so you do not have permission to buy'),
    console.error(error);
  }
}
    
  },
  mounted() {
    this.fetchPosts()
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
