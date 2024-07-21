<template>
  <div>
    <NavBar />
    <div class="container">
      <div class="post-container" v-for="post in posts" :key="post.id">
        <div class="d-flex flex-row align-items-center feed-text px-2">
          <img
            class="rounded-circle"
            :src="`http://127.0.0.1:8000/uploads/${post.user.profile}`"
            width="45"
            alt="Profile"
            style="border: 1px solid black"
          />
          <div class="d-flex flex-column flex-wrap ml-2">
            <h6 style="color: black">{{ post.user.name }}</h6>
            <span class="text-black-50 time">{{ post.created_at }}</span>
          </div>
        </div>
        <p class="post-title">{{ post.title }}</p>
        <p class="text-danger">Type of scrap:</p>
        <p class="post-title" >{{ post.title }}</p>
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

        <div class="row" v-if="post.images.length > 1">
          <div
            v-for="(image, index) in post.images"
            :key="index"
            class="col-sm-12 col-md-6 col-lg-4"
          >
            <img
              class="img-fluid shadow rounded mb-4 gallery-img"
              :src="`http://127.0.0.1:8000/uploads/${image.image}`"
              :alt="`Image ${index + 1}`"
              @click="openImageModal(post.images, index)"
            />
          </div>
        </div>

        <div v-else>
          <img
            class="img-fluid shadow rounded mb-4 single-img"
            :src="`http://127.0.0.1:8000/uploads/${post.images[0].image}`"
            alt="Single Image"
            @click="openImageModal(post.images, 0)"
          />
        </div>

        <button
          :class="post.status === 'buy' ? 'btn btn-danger mt-3' : 'btn btn-success mt-3'"
          @click="updatePostStatus(post.id, post.status === 'buy' ? 'not_buy' : 'buy')"
        >
          {{ post.status === 'buy' ? 'Already Buy' : 'Buy' }}
        </button>
      </div>
    </div>

    <div v-if="showModal" class="modal mt-5" @click="closeImageModal">
      <span class="close" @click="closeImageModal">&times;</span>
      <img class="modal-content" :src="`http://127.0.0.1:8000/uploads/${currentImage.image}`" />
      <div class="caption">{{ currentImageIndex + 1 }} / {{ modalImages.length }}</div>
      <a class="prev" @click.stop="prevImage">&#10094;</a>
      <a class="next" @click.stop="nextImage">&#10095;</a>
    </div>
  </div>
</template>


<script>
import NavBar from '../../../Components/NavBar.vue';
import axios from 'axios';

export default {
  name: 'PostComponent',
  
  components: {
    NavBar,
  },
  data() {
    return {
      accountImage: '',
      accountName: '',
      postTitle: '',
      images: [],
      posts: [],
      showModal: false,
      modalImages: [],
      currentImage: null,
      currentImageIndex: 0,
    }
  },
  methods: {
    async fetchPosts() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/post/list');
        this.posts = response.data;
        console.log(this.posts);
      } catch (error) {
        console.error(error);
      }
    },
    async fetchUser() {
      try {
        const token = localStorage.getItem('access_token');
        const response = await axios.get('http://127.0.0.1:8000/api/me', {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });
        this.user_info = response.data.data;
        console.log('Fetched user:', this.user_info);
      } catch (error) {
        console.error('Error fetching user:', error);
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
          'Content-Type': 'application/json',
        };
        const data = { status: newStatus };
        const response = await axios.post(
          `http://127.0.0.1:8000/api/post/update/status/${postId}`,
          data,
          { headers }
        );
        console.log('Response:', response);
        alert('You already buy this item.');
        this.fetchPosts();
      } catch (error) {
        alert('You are a user so you do not have permission to buy');
        console.error(error);
      }
    },
    openImageModal(images, index) {
      this.modalImages = images
      this.currentImageIndex = index
      this.currentImage = images[index]
      this.showModal = true
    },
    closeImageModal() {
      this.showModal = false
      this.modalImages = []
      this.currentImage = null
      this.currentImageIndex = 0
    },
    prevImage() {
      this.currentImageIndex = (this.currentImageIndex + this.modalImages.length - 1) % this.modalImages.length
      this.currentImage = this.modalImages[this.currentImageIndex]
    },
    nextImage() {
      this.currentImageIndex = (this.currentImageIndex + 1) % this.modalImages.length
      this.currentImage = this.modalImages[this.currentImageIndex]
    },
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

li{
  list-style: none;
}
li p {
  font-size: 15px;
  color: black;
 
}

.gallery-img {
  height: 200px; /* Adjust height as needed */
  width: 100%;
  object-fit: cover;
  border-radius: 8px;
  margin-top: 10px;
  cursor: pointer;
}

.single-img {
  height: 300px; /* Adjust height as needed */
  width: 100%;
  object-fit: cover;
  border-radius: 8px;
  margin-top: 10px;
  cursor: pointer;
}

.modal {
  display: block;
  position: fixed;
  z-index: 1;
  padding-top: 60px;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0, 0, 0, 0.6);
}

.modal-content {
  margin: auto;
  display: block;
  width: 100%;
  max-width: 800px;
}

.close {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #fff;
  font-size: 40px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

.prev,
.next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  color: white;
  font-weight: bold;
  font-size: 20px;
  transition: 0.6s ease;
  user-select: none;
}

.prev {
  left: 0;
}

.next {
  right: 0;
}

.prev:hover,
.next:hover {
  background-color: rgba(0, 0, 0, 0.8);
}

.caption {
  text-align: center;
  color: #ccc;
  padding: 10px 0;
}
</style>
