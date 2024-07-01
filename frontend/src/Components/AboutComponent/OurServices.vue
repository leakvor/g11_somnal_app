<template>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <section class="our-services">
      <h2 class="our-services-title">Our Services</h2>
      <div class="service-cards d-flex justify-content-start">
        <div class="service-card card p-3 m-2">
          <img src="@/assets/buy-scrap.jpg" alt="Buy Scrap" class="card-img-top">
          <div class="card-body">
            <h3 class="card-title">Buy Scrap</h3>
            <p class="card-text">We offer competitive prices for your scrap materials.</p>
          </div>
        </div>
        <div class="service-card card p-3 m-2">
          <img src="@/assets/drain-services.jpg" alt="Drain Services" class="card-img-top">
          <div class="card-body">
            <h3 class="card-title">Drain</h3>
            <p class="card-text">Our team provides efficient and reliable drain services.</p>
          </div>
        </div>
      </div>
  
      <div class="why-choose-us mt-5">
        <h2 class="mb-4">Why Choose Us</h2>
        <ul class="list-unstyled">
          <li class="mb-3">
            <i class="bi bi-check-square-fill me-2"></i>
            <span class="fw-bold nowrap">Nationwide Availability:</span> No matter where you are, our expert team is ready to assist. We offer our high-quality drain services and scrap buying options across the entire country, ensuring you get the help and value you need, when you need it.
          </li>
          <li class="mb-3">
            <i class="bi bi-check-square-fill me-2"></i>
            <span class="fw-bold nowrap">Expert Technicians:</span> Our team consists of experienced and certified drain specialists who use the latest tools and techniques to handle any drainage problem. From minor blockages to major repairs, we've got you covered.
          </li>
          <li class="mb-3">
            <i class="bi bi-check-square-fill me-2"></i>
            <span class="fw-bold nowrap">Quality Service Guaranteed:</span> We are committed to providing exceptional service and ensuring customer satisfaction. Our comprehensive approach means that we don't just fix the problem; we also offer advice on how to prevent future issues.
          </li>
        </ul>
      </div>
  </section>
</template>

<script>
import axios from 'axios';

export default {
  name: 'OurServices',

  data() {
    return {
      backendUrl: 'http://127.0.0.1:8000', // Replace with your Laravel backend URL
      categories: [],
    };
  },

  mounted() {
    // Fetch categories from Laravel backend
    this.fetchServiceCategories();
  },

  methods: {
    async fetchServiceCategories() {
      try {
        const response = await axios.get(`${this.backendUrl}/api/category/list`);
        this.categories = response.data.data;
        console.log(this.categories);
      } catch (error) {
        console.error('Error fetching categories:', error);
        // Handle error or show a message to the user
      }
    },
  },
};
</script>

<style scoped>
li,p,span{
  color:black;
}
  .our-services {
    padding: 100px 80px 0px 80px;
    text-align: start;
  }
  
  .our-services-title {
    background: #FCA401;
    color: white;
    width: fit-content;
    border-radius: 5px;
    border-bottom: 4px solid #057931;
    padding: 5px 10px;
    margin-bottom: 30px;
  }
  
  .service-cards {
    display: flex;
    gap: 30px;
    flex-wrap: wrap;
  }
  
  .service-card {
    flex: 1;
    max-width: 400px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: none;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }
  
  .service-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
  }
  
  .service-card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
  }
  
  .service-card .card-body {
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 0 0 10px 10px;
  }
  
  .why-choose-us {
    padding-top: 60px;
    text-align: left;
  }
  
  .why-choose-us h2 {
    background:  #057931;
    color: white;
    width: fit-content;
    border-radius: 5px;
    border-bottom: 4px solid #FCA401 ;
    padding: 5px 10px;
  }
  
  .why-choose-us ul {
    padding: 40px;
    text-align: left;
    max-width: 100%;
    border-radius: 10px;
    background: #f9f9f9;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s, box-shadow 0.3s;
    margin-top: 33px;

  }
  .why-choose-us ul:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
  }
  
  .why-choose-us ul li {
    list-style-type: none;
    font-size: 16px;
  }
  
  .why-choose-us ul li i {
    font-size: 1.2rem;
    margin-right: 10px;
    color: #057931;
  }
  
  .why-choose-us ul li .nowrap {
    white-space: nowrap;
  }
  
  .fw-bold {
    font-weight: bold;
  }
  /* media 996 */
  @media (max-width: 996px) {
    .our-services {
      padding: 100px 40px 0px 40px;
    }
    .service-card {
      flex: 1 0 100%;
    }
  }
  </style>
