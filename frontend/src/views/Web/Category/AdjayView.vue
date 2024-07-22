<template>
  <NavBar />
  <head>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"
    />
  </head>
  <!-- Alert Message -->
  <div class="alertModal flex justify-center" v-if="showSuccessMessage">
    <div class="alert alert-success mt-3 w-99 flex items-center gap-2 p-4 rounded-lg shadow-md">
      <i class="fa fa-check-circle text-green-500"></i>
      <span class="text-green-500">{{ successMessage }}</span>
    </div>
  </div>
   <!-- Error Message -->
   <div class="alertModal flex justify-center" v-if="showErrorMessage">
    <div class="alert alert-error mt-3 w-99 flex items-center gap-2 p-4 rounded-lg shadow-md">
      <i class="fa fa-times-circle text-red-500"></i>
      <span class="text-red-500">{{ errorMessage }}</span>
    </div>
  </div>
  <!-- ////////// -->

  <div class="container">
    <div v-if="category">
      <h1 class="mt-20 color-dark text-center mb-4">List items of Category {{ category.name }}</h1>
    </div>
    <!-- items dropdown -->
    <div class="input-group p-2">
      <button
        class="dropdown-toggle btn btn-success"
        data-bs-toggle="dropdown"
        aria-expanded="false"
        id="dropdown-category"
        style="border: none"
      >
        <span>All</span>
      </button>
      <ul class="dropdown-menu" aria-labelledby="dropdown-category">
        <li v-for="item in filteredItems" :key="item.id">
          <a class="dropdown-item" href="#">{{ item.name }}</a>
        </li>
      </ul>
      <input
        type="search"
        class="form-control"
        id="search-btn"
        name="search"
        placeholder="Search term..."
        v-model="textInput"
      />
      <button @click="searchItems" type="button" class="btn btn-success">
        <i class="fas fa-search"></i>
      </button>
    </div>

    <!-- list items-->
    <div class="adjay mt-10 mb-3 d-flex justify-content-start flex-wrap gap-5">
      <div
        class="card bg-gray-200 hover:bg-green-200 shadow-lg"
        v-for="item in filteredItems"
        :key="item.id"
      >
        <div class="card-body">
          <router-link
            class="no-underline color-dark"
            :to="{ name: 'show-card', params: { id: item.id } }"
          >
            <img :src="`http://127.0.0.1:8000/scrap/${item.image}`" class="card-img" alt="..." />
          </router-link>
            <div class="title text-start mt-3">
              <h5 class="card-title">{{ item.name }}</h5>
              <p class="des">{{ item.description }}</p>
              <h5 class="card-text -mt-3">{{ item.price }}៛</h5>
            </div>
          <div class="icon d-flex justify-content-between mt-4">
            <button class="w-20 btn btn-outline-success rounded hover:bg-orange-600">
              <i class="bi bi-chat-dots"></i>
            </button>
            <button
              class="w-20 btn btn-outline-success rounded hover:bg-orange-600"
              @click.stop="addFavorite(item.id)"
            >
              <i class="bi bi-heart"></i>
            </button>
          </div>
        </div>
      </div>
        <!-- <a href="#" class="next round">&#8250;</a> -->
    </div>

    <router-link
      to="/service"
      class="link bg-green-600 text-white font-bold py-2 px-4 rounded hover:bg-orange-600 no-underline"
    >
      Back
    </router-link>
  </div>
  <Footer class="mt-5" />
</template>

<script>

import axios from 'axios'
import NavBar from '@/Components/NavBar.vue'
import Footer from '@/Components/Footer.vue'

export default {
  components: {
    NavBar,
    Footer
  },
  props: ['id'],
  name: 'AdjayView',
  data() {
    return {
      category: null,
      selectedItemId: null,
      items: [],
      backendUrl: 'http://127.0.0.1:8000',
      textInput: '',
      showSuccessMessage: false,
      successMessage: '',
      showErrorMessage: false,
      errorMessage: ''
    }
  },
  computed: {
    filteredItems() {
      if (!this.textInput) {
        return this.items
      }
      return this.items.filter((item) =>
        item.name.toLowerCase().includes(this.textInput.toLowerCase())
      )
    }
  },
  mounted() {
    this.fetchCategoryDetails()
  },
  methods: {
    async fetchCategoryDetails() {
      try {
        const response = await axios.get(`http://127.0.0.1:8000/api/category/show/${this.id}`)
        if (response.data.data && response.data.data.length > 0) {
          this.category = response.data.data[0]
          this.items = this.category.items
          console.log(this.items)
        
        }
      } catch (error) {
        console.error('Error fetching category details:', error)
      }
    },
    async addFavorite(itemId) {
      try {
        const token = localStorage.getItem('access_token')
        if (!token) {
          throw new Error('No token found')
        }

        const response = await axios.post(
          'http://127.0.0.1:8000/api/fav/create',
          { item_id: itemId },
          {
            headers: {
              Authorization: `Bearer ${token}`
            }
          }
        )

        console.log(response.data)

        if (response.data.success) {
          this.successMessage = 'Item added to favorites successfully.';
          this.showSuccessMessage = true;
          setTimeout(() => {
            this.showSuccessMessage = false;
          }, 2000);

        } else if (response.data.error) {
          this.errorMessage = response.data.error;
          this.showErrorMessage = true;
          setTimeout(() => {
            this.showErrorMessage = false;
          }, 2000);
        }
      } catch (error) {
        if (error.response) {
          console.error('Server Error:', error.response.data);
          this.errorMessage = error.response.data.error || 'I do not have account yet';
          this.showErrorMessage = true;
          setTimeout(() => {
            this.showErrorMessage = false;
          }, 2000);
        } else if (error.request) {
          console.error('Network Error:', error.request);
          this.errorMessage = 'Network error occurred. Please try again.';
          this.showErrorMessage = true;
          setTimeout(() => {
            this.showErrorMessage = false;
          }, 2000);
        } else {
          console.error('Error:', error.message);
          this.errorMessage = error.message;
          this.showErrorMessage = true;
          setTimeout(() => {
            this.showErrorMessage = false;
          }, 2000);
        }
      }

    }
  }
}
</script>
<style scoped>
.alertModal {
  position: fixed;
  top: 20px;
  left: 50%;
  transform: translateX(-50%);
  z-index: 999;
}

.alert {
  background-color: white;
  border-color: white;
  color: green;
}

.adjay .card {
  width: 22%;
  height: 80%;
  padding: 2%;
}
.adjay .card .card-body img {
  height: 150px;
  object-fit: cover;
}
@media (min-width: 320px) and (max-width: 568px) {
  .card img {
    width: 40%;
    height: 10%;
  }
  .adjay .card {
    width: 200px;
    margin: auto;
  }
}
</style>