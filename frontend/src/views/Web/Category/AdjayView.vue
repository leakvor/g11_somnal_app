<template>
  <NavBar />
  <head>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"
    />
  </head>
  <div class="container">
    <div v-if="category">
      <h1 class="mt-20 color-dark text-center mb-4">List items of Category {{ category.name }}</h1>
    </div>
    <!-- items dropdown -->
    <div class="input-group hover:bg-orange-600 p-2">
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
        <li>
          <a href="/service">Back</a>
        </li>
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
        class="card bg-white-200 hover:bg-green-200 shadow-lg"
        v-for="item in filteredItems"
        :key="item.id"
      >
        <div class="card-body">
          <router-link
            class="no-underline color-dark"
            :to="{ name: 'show-card', params: { id: item.id } }"
          >
            <img :src="`http://127.0.0.1:8000/scrap/${item.image}`" class="card-img" alt="..." />
            <div class="title text-start mt-3">
              <h5 class="card-title">{{ item.name }}</h5>
              <p class="des">{{ item.description }}</p>
              <h5 class="card-text -mt-3">{{ item.price }}៛</h5>
            </div>
          </router-link>
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
      textInput: ''
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
          alert('Item added to favorites successfully.')
        } else if (response.data.error) {
          alert(response.data.error)
        }
      } catch (error) {
        if (error.response) {
          console.error('Server Error:', error.response.data)
          alert(error.response.data.error || 'You have not account yet')
        } else if (error.request) {
          console.error('Network Error:', error.request)
          alert('Network error occurred. Please try again.')
        } else {
          console.error('Error:', error.message)
          alert(error.message)
        }
      }
    }
  }
}
</script>
<style scoped>
.adjay .card {
  width: 22%;
  height: 80%;
  padding: 2%;
}
.adjay .card .card-body img {
  height: 150px;
  object-fit: cover;
}
/*action*/

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
