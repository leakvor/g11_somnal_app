<template>
  <div>
    <NavBar />
    <div class="container bootstrap snippets bootdeys">
      <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-4" style="margin-top: 30px">
          <div class="panel rounded shadow">
            <div class="panel-body">
              <div class="inner-all">
                <ul class="list-unstyled">
                  <li class="text-center">
                    <img
                      data-no-retina=""
                      class="img-circle img-responsive img-bordered-primary"
                      :src="`http://127.0.0.1:8000/uploads/${userData.profile}`"
                      alt="John Doe"
                     
                      style="
                        width: 200px;
                        height: 200px;
                        object-fit: cover;
                        object-position: center;
                        border-radius: 50%;
                      "
                    />
                    <input ref="fileInput" type="file" style="display: none" @change="handleFileChange" />
                  </li>
                  <div class="div" style="margin-left: 30px; text-align: center; margin-top: 5px">
                    <h5 style="color: black">{{ userData.name }}</h5>
                    <p style="color: black">{{ userData.email }}</p>
                    <p style="color: black">{{ userData.phone }}</p>
                  </div>
                </ul>
              </div>
            </div>
            <button @click="openModal" type="submit"
              style="
                border: none;
                background-color: #4caf50;
                color: white;
                padding: 10px 20px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                border-radius: 4px;
                cursor: pointer;">
              <i class="material-icons" style="vertical-align: middle">&#xe923;</i>
              Update
            </button>
          </div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-8">
          <PostCard :posts="posts" @delete-post="deletePost" />
        </div>
      </div>
    </div>

    <div class="modal" v-if="showModal" @click.self="closeModal">
      <div class="modal-content">
        <span class="close-button" @click="closeModal">&times;</span>
        <h2 style="color:black">Edit Profile</h2>
        <form @submit.prevent="updateProfile" method="post" enctype="multipart/form-data">
          <div class="title mt-3 mb-3">
            <input type="text" class="w-full p-2 border border-gray-300" id="title" name="name" v-model="userData.name" required />
          </div>
          
          <div class="title mt-3 mb-3">
            <input type="email" class="w-full p-2 border border-gray-300" name="email" v-model="userData.email" required />
          </div>
          <div class="title mt-3 mb-3">
            <input type="tell" class="w-full p-2 border border-gray-300" name="phone" v-model="userData.phone" required />
          </div>
         
          <div class="mt-3">
            <div class="relative">
              <img v-if="imageUrl" :src="imageUrl" alt="Uploaded Image" class="w-full h-300px border border-gray-300 p-2 cursor-pointer" @click="triggerFileInput">
              <img v-else :src="`http://127.0.0.1:8000/uploads/${userData.profile}`" alt="Default Image" class="w-full h-300px border border-gray-300 p-2 cursor-pointer" @click="triggerFileInput">
              <input type="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" id="file_input" name="image" @change="handleFileUpload">
            </div>
          </div>
          
          <div class="flex justify-end space-x-10 mt-5">
            <button type="submit" class="px-4 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700">
              Save Change
            </button>
          </div>
        </form>
      </div>
    </div>
    <!-- <FooterVue/> -->
  </div>
  
</template>

<script>
import NavBar from '@/Components/NavBar.vue'
import FooterVue from '@/Components/Footer.vue'
import PostCard from '../Web/Post/PostCard.vue'
import axios from 'axios'
import Cookies from 'js-cookie'

export default {
  components: {
    NavBar,
    PostCard,
    FooterVue
  },
  data() {
    return {
      posts: [],
      user_info: null,
      showModal: false,
      imageUrl: '',
      name: '',
      email: '',
      phone: ''
    }
  },
  computed: {
    userData() {
      return this.user_info || {}
    }
  },
  methods: {
    openModal() {
      this.showModal = true
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
        const response = await axios.get(`http://127.0.0.1:8000/api/me`, {
          headers: {
            Authorization: `Bearer ${token}`
          }
        })
        this.user_info = response.data.data
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
      try {
        const formData = new FormData()
        formData.append('name', this.userData.name)
        formData.append('email', this.userData.email)
        formData.append('phone', this.userData.phone)
        if (this.$refs.fileInput.files[0]) {
          formData.append('profile', this.$refs.fileInput.files[0])
        }

        const token = localStorage.getItem('access_token')
        const response = await axios.post(
          'http://127.0.0.1:8000/api/updateProfile',
          formData,
          {
            headers: {
              'Content-Type': 'multipart/form-data',
              Authorization: `Bearer ${token}`
            }
          }
        )

        this.user_info = response.data.data
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
.modal {
  display: flex;
  justify-content: center;
  align-items: center;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
}

.modal-content {
  background-color: #fff;
  padding: 20px;
  border-radius: 5px;
  width: 80%;
  max-width: 500px;
  position: relative;
}

.close-button {
  position: absolute;
  top: 10px;
  right: 10px;
  font-size: 24px;
  cursor: pointer;
}

.bg-smoke-light {
  background-color: rgba(0, 0, 0, 0.5);
}
</style>
