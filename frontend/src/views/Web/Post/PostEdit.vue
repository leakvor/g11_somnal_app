<template>
  <div>
    <NavBar />
    <form
    @submit.prevent="editPost"
    method="post"
    class="flex flex-col p-4 rounded-lg bg-white shadow-md max-w-lg m-auto mt-5"
    enctype="multipart/form-data"
  >
    <h2 class="text-center mb-3 text-lg font-semibold" style="color: black">Edit Post</h2>

    <div class="mb-3">
      <label for="title" class="form-label" style="color: black">Title</label>
      <input
        type="text"
        class="form-control shared-style"
        id="title"
        name="title"
        v-model="postData.title"
      />
    </div>

    <div class="mb-3 dropdown">
      <label for="item-dropdown" class="form-label" style="color: black">Item selection</label>
      <div class="mb-3" v-if="selectedItemsNames.length">
        <p style="color: black">{{ selectedItemsNames }}</p>
      </div>
      <button
        class="form-control shared-style dropdown-toggle"
        type="button"
        id="item-dropdown"
        data-bs-toggle="dropdown"
        aria-expanded="false"
      >
        Select items
      </button>
      <ul class="dropdown-menu scrollable-menu" aria-labelledby="item-dropdown">
        <li v-for="item in item_all" :key="item.id">
          <div class="form-check dropdown-item">
            <input
              class="form-check-input"
              type="checkbox"
              :value="item.id"
              :id="`Checkme${item.id}`"
              v-model="selectedItems"
            />
            <label class="form-check-label" :for="`Checkme${item.id}`">{{ item.name }}</label>
          </div>
        </li>
      </ul>
    </div>

    <div class="mb-3">
      <label for="company-selection" style="color: black" class="form-label">Company Selection</label>
      <select
        id="company-selection"
        name="company"
        class="form-select shared-style"
        v-model="postData.company_id">
        <option disabled selected value="">Select a company</option>
        <option v-for="company in companies" :key="company.id" :value="company.id">
          {{ company.name }}
        </option>
      </select>
    </div>

    <div class="mb-3">
      <button type="button" style="background-color: orange; border-color: orange;" @click="triggerFileInput">Add New Image</button>
      <input
        type="file"
        ref="fileInput"
        class="d-none"
        @change="handleFileChange"
      />
    </div>

    <div class="row">
      <div v-for="(image, index) in postData.images" :key="image.id" class="col-12 col-sm-6 col-lg-3">
        <img
          class="img-fluid shadow rounded mb-4 gallery-img bg-none m-3 w-47 h-48"
          :src="`http://127.0.0.1:8000/uploads/${image.image}`"
          :alt="`Image ${index + 1}`"
          @click="selectImageForUpdate(image.image_id)"
        />
      </div>
    </div>

    <div class="flex justify-end mt-5">
      <button
        type="submit"
        class="px-4 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700"
      >
        Update Post
      </button>
    </div>
  </form>
  </div>
  
</template>

<script>
import axios from 'axios';
import NavBar from '../../../Components/NavBar.vue'

export default {
  components:{
    NavBar,
  },
  data() {
    return {
      // postData: {
      //   title: '',
      //   images: [], 
      //   company_id: null,
      // },
      postData:{},
      item_all: [],
      companies: [],
      selectedItems: [],
      currentImageId: null, 
    };
  },
  computed: {
    selectedItemsNames() {
      return this.selectedItems.map((id) => {
        const item = this.item_all.find((item) => item.id === id);
        return item ? item.name : '';
      });
    },
  },
  props: ['id'],
  methods: {
    async fetchPost() {
      try {
        const token = localStorage.getItem('access_token');
        const response = await axios.get(`http://127.0.0.1:8000/api/post/each/user/${this.id}`, {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });
        this.postData = response.data.data;
        
        this.selectedItems = this.postData.items.map((item) => item.item_id);
      } catch (error) {
        console.error('Error fetching post:', error);
      }
    },
    handleFileChange(event) {
      const file = event.target.files[0];
      if (this.currentImageId) {
        this.uploadImage(file, this.currentImageId);
      } else {
        this.addNewImage(file);
      }
      this.currentImageId = null; // Reset after handling the file change
    },
    selectImageForUpdate(imageId) {
      this.currentImageId = imageId;
      this.$refs.fileInput.click();
    },
    async uploadImage(file, imageId) {
      try {
        const formData = new FormData();
        formData.append('image', file);

        await axios.post(
          `http://127.0.0.1:8000/api/images/update/${imageId}`,
          formData,
          {
            headers: {
              'Content-Type': 'multipart/form-data',
            },
          }
        );
        this.fetchPost(); // Refresh the post data to show updated images
      } catch (error) {
        console.error('Error uploading image:', error);
      }
    },
    async addNewImage(file) {
      try {
        const formData = new FormData();
        formData.append('image', file);

        await axios.post(
          `http://127.0.0.1:8000/api/posts/${this.id}/add-image`,
          formData,
          {
            headers: {
              'Content-Type': 'multipart/form-data',
            },
          }
        );
        this.fetchPost(); // Refresh the post data to show new images
      } catch (error) {
        console.error('Error uploading image:', error);
      }
    },
    async editPost() {
      try {
        const formData = new FormData();
        formData.append('title', this.postData.title);
        formData.append('company_id', this.postData.company_id);
        formData.append('items', this.selectedItems.join(','));
     
        console.log(this.postData.company_id);
        const token = localStorage.getItem('access_token');
        await axios.post(
          `http://127.0.0.1:8000/api/post/update/user/${this.id}`,
          formData,
          {
            headers: {
              Authorization: `Bearer ${token}`,
              'Content-Type': 'multipart/form-data',
            },
          }
        );
        this.$router.push('/profile');
      } catch (error) {
        console.error('Error editing post:', error);
      }
    },
    async getAllItems() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/item/list');
        this.item_all = response.data.data;
      } catch (error) {
        console.error('Error getting items:', error);
      }
    },
    async getAllCompanies() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/company');
        this.companies = response.data.data;
      } catch (error) {
        console.error('Error getting companies:', error);
      }
    },

    triggerFileInput() {
      this.currentImageId = null;
      this.$refs.fileInput.click();
    },
  },
  mounted() {
    this.fetchPost();
    this.getAllItems();
    this.getAllCompanies();
  },
};
</script>







<style scoped>
@media (max-width: 768px) {
  .max-w-md {
    max-width: 100%;
  }
}
.container {
  width: 100%;
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
}

form {
  width: 100%;
  max-width: 800px;
  margin: auto;
  border-radius: 10px;
  border-top: 7px solid rgb(248, 98, 44);
  background: white;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.dropdown .form-control,
.dropdown-menu {
  width: 100%;
}
.dropdown .form-control {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.dropdown-menu.scrollable-menu {
  max-height: 200px;
  overflow-y: auto;
}

.form-check-input {
  margin-left: 20px;
}

.form-label {
  margin-top: 5px;
}

.submit {
  margin-top: 7%;
  margin-bottom: 5%;
}

@media (min-width: 576px) {
  form {
    width: 90%;
  }
}

@media (min-width: 768px) {
  form {
    width: 90%;
  }
}

@media (min-width: 992px) {
  form {
    width: 90%;
  }
}

@media (min-width: 1200px) {
  form {
    width: 60%;
  }
}
</style>
