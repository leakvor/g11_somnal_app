<template>
  <NavBar />

  <!-- Services Section -->
  <div class="container bg-white-100 mb-10">
    <div class="p-10 text-center mt-5 color-dark">
      <h1 class="text-center">Our Sraps</h1>
      <p>List all scraps that you can see and buy.</p>
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
    searchCategories() {
      return this.filteredCategories;
    },
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
  width: min(760px, 100%);
  margin: auto;
}

.container {
  padding-top: 24px;
  padding-bottom: 56px;
}

.p-10 {
  padding: 32px 16px;
}

.p-10 h1 {
  font-weight: 800;
  color: #1f2933;
}

.p-10 p {
  color: #667085;
  margin-bottom: 0;
}

.category {
  display: grid !important;
  grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
  gap: 20px !important;
}

.category .card {
  width: 100%;
  padding: 12px;
  overflow: hidden;
}
.category .card img {
  width: 100%;
  height: 150px;
  object-fit: cover;
  border-radius: 8px;
}
.card .link{
  width: 100%;
  margin: 0;
  border-radius: 8px;
}

.card-title {
  font-size: 1.1rem;
  color: #1f2933;
  font-weight: 700;
}

@media (max-width:360px){
  .category, .company {
    display: flex;
    flex-direction: column;
  }
   .category .card {
    width: 100%;
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
    width: 100%;
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
    display: grid !important;
  }
   .category .card {
    width: 100%;
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
    display: grid !important;
  }
   .category .card {
    width: 100%;
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
