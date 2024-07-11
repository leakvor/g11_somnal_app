<template>
  <div>
    <NavBar />
    <div class="container">
      <div class="list-company mt-3 p-3 bg-white">
        <h3 class="text-success font-bold d-flex justify-content-center">All Companies</h3>
        <div class="d-flex justify-content-end pt-2 pb-4">
          <div class="d-flex justify-content-end pt-2 pb-4">
            <input
              type="text"
              class="form-control bg-orange"
              placeholder="Search..."
              v-model="searchText"
              @input="filterCompanies" 

            />
          </div>
        </div>
        <div class="list-container pb-5">
          <a ref="#" v-for="company in filteredCompanies" :key="company.id" class="card company-card text-decoration-none text-dark pe-3 ps-3 pb-3">
            <div class="card-body"> 
              <div class="company-logo text-center">
                <img   :src="`http://127.0.0.1:8000/uploads/${company.profile}`" alt="Company Logo"  />
              </div>
              <div class="company-info">
                <h5 class="text-title"><b>Name:</b> {{ company.name }}</h5>
                <p class="text-card text-danger"><b>Services:</b> {{ company.id }}</p>
                <a :href="'tel:' + company.tel" class="text-card text-decoration-none"><b>Phone:</b> {{ company.phone }}</a>
                <p class="text-card"><b>Email:</b> {{ company.email }}</p>
                <p class="text-card"><b>Address:</b> {{ company.address }}</p>
              </div>
              <div class="company-action d-flex justify-content-end">
                <button class="btn btn-success">Sales Now</button>
              </div>
            </div>
          </a>
        </div>
      </div>
      <div class="text-center m-5 d-flex justify-content-end">
        <a href="/">
          <button @click="fetchCompanies" class="btn btn-success" id="back-btn">Back</button>
        </a>
      </div>
    </div>
    <Footer />
  </div>
</template>

<script>
import NavBar from '../../../Components/NavBar.vue';
import Footer from '../../../Components/Footer.vue';
import axios from 'axios';

export default {
  name: 'CompanyList',
  components: {
    NavBar,
    Footer,
  },
  data() {
    return {
      companies: [],
      filteredCompanies: [],
      searchText: '',
    };
  },
  mounted() {
    this.fetchCompanies();
  },
  methods: {
    fetchCompanies() {
      axios.get('http://127.0.0.1:8000/api/company')
        .then(response => {
          this.companies = response.data.data;
          this.filteredCompanies = response.data.data;
        })
        .catch(error => {
          console.error('Error fetching companies:', error);
        });
    },
    filterCompanies() {
      this.filteredCompanies = this.companies.filter(company =>
        company.name.toLowerCase().includes(this.searchText.toLowerCase())
      );
    },
  },
};
</script>

<style scoped>
 .list-container {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 1rem;
  }

 .company-card {
    border-radius: 0.5rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition:
      transform 0.4s ease-in-out,
      box-shadow 0.4s ease-in-out,
      border-color 0.4s ease-in-out;
    position: relative;
    overflow: hidden;
    border: 3px solid thick;
  }
.company-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    border-color: #007bff;

  }

.company-logo img {
  max-width: 80px;
  height: auto;
}

.text-title {
  font-size: 1.2rem;
  font-weight: bold;
}

.text-card {
  font-size: 0.9rem;
  color: #666;
}

#see-all-btn {
  display: block;
  margin: 20px auto 0;
  padding: 10px 20px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}
.company-action button{
  background:rgb(25, 107, 58);
}
.company-action button:hover{
  background:orange;
  color: black;
  border: none;
}
.company-action button, #back-btn{
  background:rgb(25, 107, 58);
}
.company-action button:hover, #back-btn:hover{
  background:orange;
  color: black;
  border: none;
}

/* Mobile Styles */
@media (max-width: 767px) {
  .list-container {
      grid-template-columns: repeat(2, 1fr);
}
  .company-logo img {
    max-width: 60px;
  }
  .text-title {
    font-size: 1rem;
  }
  .text-card {
    font-size: 0.8rem;
  }
}

/* Tablet Styles */
@media (min-width: 768px) and (max-width: 991px) {
  .list-container {
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  }
  .company-logo img {
    max-width: 70px;
  }
  .text-title {
    font-size: 1.1rem;
  }
  .text-card {
    font-size: 0.9rem;
  }
}

/* Computer Styles */
@media (min-width: 992px) {
  .list-container {
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  }
  .company-logo img {
    max-width: 80px;
  }
  .text-title {
    font-size: 1.2rem;
  }
  .text-card {
    font-size: 0.9rem;
  }
}
</style>