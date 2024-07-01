<template>
  <form @submit.prevent="editPost" method="post" class="flex flex-col p-4 rounded-lg bg-white shadow-md max-w-lg m-auto mt-5" enctype="multipart/form-data">
    <h2 class="text-center mb-3 text-lg font-semibold" style="color: black">Edit Post</h2>

    <div class="form-group mt-3 mb-3">
      <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Title</label>
      <input type="text" id="title" name="title" v-model="postData.title" class="w-full p-2 border border-gray-300 rounded-md" required />
    </div>

    <div class="form-group mt-3 mb-3">
      <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
      <input type="text" id="description" name="description" v-model="postData.description" class="w-full p-2 border border-gray-300 rounded-md" required />
    </div>

    <div class="form-group mt-3">
      <label for="file_input" class="block mb-2 text-sm font-medium text-gray-900">Upload Image</label>
      <div class="relative">
        <img v-if="imageUrl" :src="imageUrl" alt="Uploaded Image" class="w-full h-48 border border-gray-300 p-2 cursor-pointer rounded-md" @click="uploadImage" />
        <img v-else src="https://via.placeholder.com/200x200" alt="Default Image" class="w-full h-40 border border-gray-300 p-2 cursor-pointer rounded-md" @click="uploadImage" />
        <input type="file" id="file_input" ref="file_input" name="image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" @change="handleFileUpload" />
      </div>
    </div>

    <div class="flex justify-end mt-5">
      <button type="submit" class="px-4 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700">Update Post</button>
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
      imageUrl: null,
      formData: new FormData() // Initialize formData properly
    };
  },
  props: ['id'],
  methods: {
    async fetchPost() {
      try {
        const token = localStorage.getItem('access_token');
        const response = await axios.get(`http://127.0.0.1:8000/api/post/each/user/${this.id}`, {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });
        this.postData = response.data.data;
        if (this.postData.image) {
          this.imageUrl = `http://127.0.0.1:8000/uploads/${this.postData.image}`;
        }
      } catch (error) {
        console.error('Error fetching post:', error);
        // Handle error (e.g., show error message)
      }
    },
    uploadImage() {
      this.$refs.file_input.click();
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
    async editPost() {
      try {
        this.formData.append('title', this.postData.title);
        this.formData.append('description', this.postData.description);
        if (this.postData.image) {
          this.formData.append('image', this.postData.image);
        }
        console.log(this.formData);
        const token = localStorage.getItem('access_token');
        const response = await axios.post(`http://127.0.0.1:8000/api/post/update/user/${this.id}`, this.formData, {
          headers: {
            Authorization: `Bearer ${token}`,
            'Content-Type': 'multipart/form-data'
          }
        });
        this.postData = response.data.data;
        this.$router.push('/profile');
      } catch (error) {
        console.error('Error editing post:', error);
        // Handle error (e.g., show error message)
      }
    }
  },
  mounted() {
    this.fetchPost();
  }
};
</script>

<style scoped>
@media (max-width: 768px) {
 .max-w-md {
    max-width: 100%;
  }
}
</style>
