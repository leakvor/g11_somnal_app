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
    <h1 class="mt-20 color-dark text-center">{{category.name}}</h1>
  </div>
  
  <div class="adjay mt-10 p-10 d-flex justify-content-start flex-wrap gap-5">
    <div class="card bg-white-200 hover:bg-gray-200 shadow-lg" v-for="item in items" :key="item.id">
      <img :src="`${backendUrl}/uploads/${item.image}`" class="card-img-top mt-5" alt="..." />
      <div class="card-body">
        <div class="title text-center">
          <h3 class="card-title">{{ item.name }}</h3>
          <h5 class="card-text">{{item.price}}$</h5>
        </div>
        <div class="icon d-flex justify-content-evenly w-100 justify-content-around mt-4 mb-3">
          <a href="#"><i class="bi bi-chat-dots"></i></a>
          <a href="#"><i class="bi bi-cart-plus"></i></a>
        </div>
      </div>
    </div>
  </div>
  
  <router-link to="/service" class="link bg-green-600 text-white font-bold py-2 px-2 rounded hover:bg-orange-600 no-underline ml-20">
    Back
  </router-link>
  <Footer class="mt-5" />
</template>  
  
<script >
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
          console.log(this.category.name);
          this.items.forEach(item => {
        console.log('ID:', item.id);
        console.log('Name:', item.name);
        console.log('Image:', item.image);
      }

    ); 
        }
      } catch (error) {
        console.error('Error fetching category details:', error);
      }
    },
  },
};
</script>

  <style scoped>
i {
  
  border-radius:50px;
  background-color:green;
  color:white;
  padding: 10px;
}
i:hover{
  background:orangered;
}
.card{
  width:22%;
}
.card img{
  width:50%;
  margin: auto;
  object-fit: cover;
}
.card:hover{
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
@media (min-width:320px) and (max-width: 568px) {
  .card img{
    width: 40%;
    height: 10%;
  }
  .adjay .card{
    width:200px;
    margin: auto;
  }
 
}
@media (max-width: 768px) {
  .adjay{
    display: flex;
    flex-direction: column;
  }
  .card{
    width:90%;
    margin: auto;
 
  }
  .card-title{
    font-size: 10px;
  }
}
@media (max-width: 428px) {
  .adjay .card{
    width:90%;
    margin: auto;
  }
  .card-title{
    font-size: 20px;
  }

}
@media (min-width: 768px) and (max-width: 1024px) {
  .adjay{
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
  }
  .adjay .card{
    width:45%;
  }
}
@media (min-width: 705px) and (max-width: 1114px) {
  .adjay{
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
  }
  .adjay .card{
    width:30%;
  }
}
@media (min-width: 834px) and (max-width: 1104px) {
  .adjay{
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
  }
  .adjay .card{
    width:28%;
    padding: 2%;
    margin: auto;
  }
 
}
</style>
  