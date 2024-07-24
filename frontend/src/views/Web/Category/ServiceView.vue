<template>
  <NavBar />

  <!-- Services Section -->
  <div class="container bg-white-100 mb-10">
    <div class="p-10 text-center mt-5 color-dark">
      <h1 class="text-center">Our Services</h1>
      <p>Use our services to make it easier for customers to sell products.</p>
    </div>
    <!--  -->
    <div class="input-group">
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
        <li v-for="category in categories" :key="category.id">
          <router-link class=" link font-bold py-2 px-4 no-underline text-center" :to="{ name: 'adjay', params: { id: category.id } }">{{ category.name }}</router-link>
        </li>
      </ul>
      <input
      type="search"
      class="form-control"
      id="search-btn"
      name="search"
      placeholder="Search category"
      v-model="searchInput"
    />
    <button @click="searchCategories" type="button" class="btn btn-success">
      <i class="fas fa-search"></i>
    </button>
    </div>
    <div class="category mt-5 d-flex justify-content-start flex-wrap gap-5" >
      <div class="card bg-gray-200 hover:bg-green-200 shadow-lg" v-for="category in filteredCategories"
      :key="category.id">
          <img
            :src="`${backendUrl}/scrap/${category.image}`"
            class="card-img-top" 
            alt="Waste Industry"
          />
          <div class="card-body text-center">
            <h2 class="card-title">{{category.name}}</h2>
          </div>
          <router-link class=" link bg-green-600 text-white font-bold py-2 px-2 rounded hover:bg-orange-600 no-underline text-center" :to="{ name: 'adjay', params: { id: category.id } }">See more</router-link>
        </div>
    </div>
  </div>
  <Footer  />
</template>
<script>
import NavBar from '@/Components/NavBar.vue'
import Footer from '@/Components/Footer.vue'
import axios from 'axios';
export default{
components:{
  NavBar,
  Footer
},
data() {
    return {
      categories: [],
      backendUrl: 'http://127.0.0.1:8000', 
      searchInput: '',
    };
  },
  computed: {
    filteredCategories() {
      if (!this.searchInput.trim()) {
        return this.categories;
      }
      return this.categories.filter(category =>
        category.name.toLowerCase().includes(this.searchInput.trim().toLowerCase())
      );
    }
  },
  methods: {
    async getCategory(){
      try {
        const response = await axios.get("http://127.0.0.1:8000/api/category/list");
        this.categories = response.data.data;
      } catch (error) {
        console.error(error);
      }
    }
   
  },
  mounted() {
    this.getCategory();
  }
}


</script>

<style scoped>
.input-group {
  width: 80%;
  margin: auto;
}

.category .card {
  width: 22%;
  padding: 2%;
}
.category .card img {
  width: 230px; 
  height: 150px;
  object-fit: cover;
  margin: auto;
}
.card .link{
  width: 200px;
  margin: auto;
}

@media (max-width:360px){
  .category, .company {
    display: flex;
    flex-direction: column;
  }
   .category .card {
    width: 90%;
    margin: auto;
  }
  .card img{
    height: 50%;
    object-fit: cover;
  }
  .company .card img{
    height: 110px;
    width: 100%; 
    border-radius: 0;
    margin-top: 0;
    object-fit: cover;
  }
  .link{
    width: 120px;
    margin: 10px 0 10px 10px;
  }
  
}
@media (max-width:412px){
  .category, .company {
    display: flex;
    flex-direction: column;
  }
   .category .card {
    width: 90%;
    margin: auto;
  }
  .card img{
    height: 50%;
    object-fit: cover;
  }
  .company .card img{
    height: 110px;
    width: 100%; 
    border-radius: 0;
    margin-top: 0;
    object-fit: cover;
  }
  .link{
    width: 120px;
    margin: 10px 0 10px 10px;
  }
  
}
@media (max-width:1024px){
  .category {
    display: flex;
    flex-direction: row;
  }
   .category .card {
    width: 45%;
    margin: auto;
    margin-right: 5px;
    margin-left: 5px;
  }
  .card img{
    height: 50%;
    object-fit: cover;
  }
  .company .card img{
    height: 110px;
    width: 100%; 
    border-radius: 0;
    margin-top: 0;
    object-fit: cover;
  }
  .link{
    width: 120px;
    margin: 10px 0 10px 10px;
  }
  
}
@media (max-width:1114px){
  .category {
    display: flex;
    flex-direction: row;
  }
   .category .card {
    width: 45%;
    margin: auto;
    margin-right: 5px;
    margin-left: 5px;
  }
  .card img{
    height: 50%;
    object-fit: cover;
  }
  .company .card img{
    height: 110px;
    width: 100%; 
    border-radius: 0;
    margin-top: 0;
    object-fit: cover;
  }
  .link{
    width: 120px;
    margin: 10px 0 10px 10px;
  }
  
}

</style>