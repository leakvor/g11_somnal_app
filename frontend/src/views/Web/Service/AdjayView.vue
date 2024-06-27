<template>
  <NavBar />
  <head>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"
    />
  </head>
  <temnent />
  <div class="header">
    <img
      src="../../../assets/image/homepage.jpeg"
      style="width: 100%; height: 400px; object-fit: cover"
      alt=""
    />
  </div>
  <h1 class="mt-20 color-dark text-center">OUR SERVICE</h1>
  <div class="container mt-10 p-10 d-flex justify-content-evenly" >
    <div class="card" style="width: 300px; height: 350px" v-for="item in items" :key="item.id">
      <img :src="`${backendUrl}/uploads/${item.image}`" class="card-img-top" alt="..." />
      <div class="card-body">
        <div class="title text-center">
          <h1 class="card-title">{{ item.name }}</h1>
          <h5 class="card-text">{{ price }} ៛</h5>
        </div>
        <div class="icon d-flex justify-content-around m-5">
          <a href="#"><i class="bi bi-telephone"></i></a>
          <a href="#"><i class="bi bi-chat-dots"></i></a>
          <a href="#"><i class="bi bi-cart-plus"></i></a>
        </div>
      </div>
    </div>
  
  </div>
  <router-link to="/about"  class="bg-green-600 text-white font-bold py-2 px-4 rounded hover:bg-orange-600 no-underline ml-25">Back</router-link>
  <Footer class="mt-5" />
</template>
  
<script>
import axios from 'axios';
import NavBar from '@/Components/NavBar.vue';
import Footer from '@/Components/Footer.vue';

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
      backendUrl : 'http://127.0.0.1:8000'
    };
  },
  mounted() {
    this.fetchCategoryDetails();
  },
  methods: {
    async fetchCategoryDetails() {
      try {
        const response = await axios.get(`http://127.0.0.1:8000/api/category/show/${this.id}`);
        if (response.data.data && response.data.data.length > 0) {
          this.category = response.data.data[0];
          this.items = this.category.items;
          console.log(this.items);
          this.items.forEach(item => {
        console.log('ID:', item.id);
        console.log('Name:', item.name);
        console.log('Image:', item.image);
      }); 
        }
      } catch (error) {
        console.error('Error fetching category details:', error);
      }
    },
  },
};
</script>

  <style>

i {
  border-radius:50px;
  background-color:green;
  color:white;
  padding: 10px;
}
i:hover{
  background:orangered;
}
.card img{
  height:45%;
}
.card:hover{
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
</style>
  