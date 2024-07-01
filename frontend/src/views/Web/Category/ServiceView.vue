
<template>
  <NavBar />
  <!-- <div class="slider-wrapper relative w-full overflow-hidden">
    <div class="slider flex transition-transform duration-700 ease-in-out">
      <img
        id="slide-1"
        src="https://i.pinimg.com/236x/42/cd/80/42cd8099b8d04029548bbb4186dbef66.jpg"
        alt="Slide 1"
        class="w-full"
      />
      <img
        id="slide-2"
        src="https://i.pinimg.com/236x/84/bc/81/84bc81cc809e06d27862c2c09d783837.jpg"
        alt="Slide 2"
        class="w-full"
      />
    </div>
    <div class="slider-nav absolute inset-x-0 bottom-0 flex justify-center space-x-2 mb-4">
      <button
        @click="goToSlide(0)"
        class="w-3 h-3 rounded-full bg-gray-300"
        :class="{ 'bg-gray-600': currentSlide == 0 }"
      ></button>
      <button
        @click="goToSlide(1)"
        class="w-3 h-3 rounded-full bg-gray-300"
        :class="{ 'bg-gray-600': currentSlide == 1 }"
      ></button>
    </div>
    <button
      @click="prevSlide"
      class="absolute top-1/2 left-4 transform -translate-y-1/2 p-2 bg-gray-800 text-white rounded-full"
    >
      &lt;
    </button>
    <button
      @click="nextSlide"
      class="absolute top-1/2 right-4 transform -translate-y-1/2 p-2 bg-gray-800 text-white rounded-full"
    >
      &gt;
    </button>
  </div>
   -->

  <!-- Services Section -->
  <div class="container bg-white-100">
    <div class="p-10 text-center mt-5 color-dark">
      <h1 class="text-center">Our Services</h1>
      <p>Use our services to make it easier for customers to sell products.</p>
    </div>
    <div class="category mt-5 d-flex justify-content-start flex-wrap gap-5" >
      <div class="card bg-gray-200 hover:bg-green-200 shadow-lg" v-for=" category in categories" :key="category.id">
        <div class="d-flex">
          <div class="card-body">
            <h2 class="card-title">{{category.name}}</h2>
            <p class="card-text">{{category.description}}</p>
          </div>
          <img
            :src="`${backendUrl}/${category.image}`"
            class="card-img-top" 
            alt="Waste Industry"
          />
        </div>
          <router-link class=" link bg-green-600 w-30 text-white font-bold py-2 px-4 rounded hover:bg-orange-600 no-underline text-center" :to="{ name: 'adjay', params: { id: category.id } }">See more</router-link>
      </div>
    </div>
    <!-- <div class="mt-10">
      <div class="mb-20">
        <h1 class="text-center">Our partner</h1>
      </div>
      <div class="company mt-5 d-flex justify-content-start flex-wrap gap-5">
        <div class="card">
          <img
            src="../../../assets/buy-scrap.jpg"
            class="card-img-top"
            alt="Waste Industry"
          />
          <div class="card-body">
            <h5 class="card-title">Company name</h5>
            <div class="card-text">
              <p>Description</p>
              <span>Address</span>
            </div>
            
          </div>
        </div>
      </div>
    </div> -->
  </div>
  <Footer class="mt-5" />
</template>
<script>
import NavBar from '@/Components/NavBar.vue'
import Footer from '@/Components/Footer.vue'

export default{
components:{
  NavBar,
  Footer
},
data() {
    return {
      categories: [],
      backendUrl: 'http://127.0.0.1:8000', 
    };
  },
  methods: {
    getCategory() {
      this.$axios
        .get("/category/list")
        .then(response => {
          this.categories = response.data.data;
          console.log(this.categories);
        })
        .catch(error => {
          console.log(error);
        });
    },
   
  },
  mounted() {
    this.getCategory();
  }
}


</script>

<style scoped>
.category .card{
  width: 48%; 
  padding:2%;
}
.company .card {
  width: 45%; 
  height: 10%;
}
.category .card img {
  width: 25%; 
  height: 100%;
  object-fit: cover;
}

.company .card img{
  width: 60%; 
  height: 40%;
  margin: auto;
  margin-top: -20%;
  border-radius: 10% 10% 0 0;
  object-fit: cover;
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
@media (max-width:393px){
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
@media (max-width:414px){
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
@media (max-width:428px){
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
@media (max-width:1280px){
  .category {
    display: flex;
    flex-direction: row;
  }
   .category .card {
    width: 45%;
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


</style>
