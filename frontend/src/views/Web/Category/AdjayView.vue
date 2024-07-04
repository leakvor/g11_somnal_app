<template>
  <NavBar />
  <head>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"
    />
  </head>
  <temnent />
  <!-- <div class="header">
    <img
      src="../../../assets/image/homepage.jpeg"
      style="width: 100%; height: 400px; object-fit: cover"
      alt=""
    />
  </div> -->

  <div v-if="category">
    <h1 class="mt-20 color-dark text-center">{{ category.name }}</h1>
  </div>

  <div class="adjay mt-10 p-10 d-flex justify-content-start flex-wrap gap-5">
    <div class="card bg-white-200 hover:bg-gray-200 shadow-lg" v-for="item in items" :key="item.id">
      <img :src="`${backendUrl}/uploads/${item.image}`" class="card-img-top mt-5" alt="..." />
      <div class="card-body">
        <div class="title text-center">
          <h3 class="card-title">{{ item.name }}</h3>
          <h5 class="card-text">{{ item.price }}$</h5>
        </div>
        <div class="icon d-flex justify-content-evenly w-100 justify-content-around mt-4 mb-3">
          <a href="#"><i class="bi bi-chat-dots"></i></a>
          <button @click="addFavorite(item.id)" >
            <i class="bi bi-cart-plus"></i>
          </button>
        </div>
      </div>
    </div>
  </div>

  <router-link
    to="/service"
    class="link bg-green-600 text-white font-bold py-2 px-2 rounded hover:bg-orange-600 no-underline ml-20"
  >
    Back
  </router-link>
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
      items: [],
      backendUrl: 'http://127.0.0.1:8000'
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
          console.log(this.category.name)
          this.items.forEach((item) => {
            console.log('ID:', item.id)
            console.log('Name:', item.name)
            console.log('Image:', item.image)
          })
        }
      } catch (error) {
        console.error('Error fetching category details:', error)
      }
    },

    //add favorite
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
          alert(error.response.data.error || 'Server error occurred.')
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
i {
  border-radius: 50px;
  background-color: green;
  color: white;
  padding: 10px;
}
i:hover {
  background: orangered;
}
button{
  background-color:white;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
}
.card {
  width: 22.5%;
}
.card img {
  width: 50%;
  height: 70%;
  margin: auto;
  object-fit: cover;
}

.card:hover {
  box-shadow:
    0 4px 8px 0 rgba(0, 0, 0, 0.2),
    0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
.circle-icon {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 40px; /* Adjust size as needed */
  height: 40px; /* Adjust size as needed */
  border-radius: 50%;
  background-color: #f1f1f1; /* Background color for the circle */
  text-align: center;
}

.circle-icon i {
  color: #000; /* Icon color */
}

.delete-button {
  background-color: red;
  border: 1px solid white;
}

.delete-button i {
  color: white;
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
@media (max-width: 768px) {
  .adjay {
    display: flex;
    flex-direction: column;
    background-color: black;
  }
  .card {
    width: 98%;
    margin: auto;
  }
  .card-title {
    font-size: 10px;
  }
}
@media (max-width: 428px) {
  .adjay .card {
    width: 90%;
    margin: auto;
  }
  .card-title {
    font-size: 20px;
  }
}
@media (min-width: 768px) and (max-width: 1024px) {
  .adjay {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
  }
  .adjay .card {
    width: 45%;
  }
}
@media (min-width: 800px) and (max-width: 1214px) {
  .adjay {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;

  }
  .adjay .card {
    width: 27.5%;
  }
}
@media (min-width: 1100px) and (max-width: 1290px) {
  .adjay {
    display: flex;
    gap:3px;
  
  }
  .card{
    width: 21%;
  }  
}
</style>
