<template>
    <form @submit.prevent="createPost" method="Post" class="flex flex-col p-4 rounded-lg bg-white shadow-md w-200 h-100 m-auto mt-5" enctype="multipart/form-data">
      <h2 class="text-center mb-3">Create new post</h2>
  
      <div class="title mt-3 mb-3">
        <label class="block mb-2 text-sm font-medium text-gray-900" for="title">Title</label>
        <input type="text" class="w-full p-2 border border-gray-300" id="title" v-model="postData.title" required />
      </div>
      
      <div class="title mt-3 mb-3">
        <label class="block mb-2 text-sm font-medium text-gray-900" for="description">Description</label>
        <input type="text" class="w-full p-2 border border-gray-300" id="description" v-model="postData.description" required />
      </div>
      
      <div class="mt-3">
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload file</label>
        <div class="relative">
          <img v-if="imageUrl" :src="imageUrl" alt="Uploaded Image" class="w-full h-300px border border-gray-300 p-2 cursor-pointer" @click="uploadImage">
          <img v-else src="https://via.placeholder.com/200x200" alt="Default Image" class="w-full h-300px border border-gray-300 p-2 cursor-pointer" @click="uploadImage">
          <input type="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" id="file_input" name="image" @change="handleFileUpload">
        </div>
      </div>
      
      <div class="flex justify-end space-x-10 mt-5">
        <button type="submit" class="px-4 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700">
          Create a new post
        </button>
      </div>
    </form>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        postData: {
          title: '',
          description: '',
          image: null
        },
        imageUrl: null
      }
    },
    methods: {
      uploadImage() {
        this.$refs.fileInput.click();
      },
      handleFileUpload(event) {
        const file = event.target.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = (e) => {
            this.imageUrl = e.target.result;
          };
          reader.readAsDataURL(file);
          this.postData.image = file; 
        }
      },
      async createPost() {
        try {
          const formData = new FormData();
          formData.append('title', this.postData.title);
          formData.append('description', this.postData.description);
          if (this.postData.image) {
            formData.append('image', this.postData.image);
          }
          
          const token = localStorage.getItem('access_token');
          const response = await axios.post('http://127.0.0.1:8000/api/post/create/user', formData, {
            headers: {
              Authorization: `Bearer ${token}`,
              'Content-Type': 'multipart/form-data' 
            }
          });
          
          console.log(response.data);
          this.$router.push('/profile'); 
          this.resetForm();
        } catch (error) {
          console.error('Error creating post:', error);
        }
      },
      resetForm() {
        this.postData.title = '';
        this.postData.description = '';
        this.image = null;
        this.$refs.fileInput.value = ''; // Reset file input
      }
    }
  }
  </script>
  
  <style scoped>
  /* Add scoped styles if needed */
  </style>
  