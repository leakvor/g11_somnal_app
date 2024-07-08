<template>
  <div class="pb-5">
    <NavBar />
    <div id="carousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
          aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
          aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
          aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="2000">
          <img src="../../../assets/Slider/slider-1.png" class="d-block w-100" alt="..." />
        </div>
        <div class="carousel-item" data-bs-interval="2000">
          <img src="../../../assets/Slider/slider-2.png" class="d-block w-100" alt="..." />
        </div>
        <div class="carousel-item">
          <img src="../../../assets/Slider/slider-3.png" class="d-block w-100" alt="..." />
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

    <div v-if="authStore.isAuthenticated" class="button-group d-flex justify-content-end pt-5 pe-3">
      <router-link  v-if="authStore.isAuthenticated" to="/create/post" type="button" class="sale btn btn-success d-flex align-items-center me-3 p-3">
        <i class="material-icons icon-align">add_shopping_cart</i>
        <span>Sale Now</span>
      </router-link>
      <router-link  v-if="authStore.isAuthenticatedCompany" to="/post" type="button" class="buy btn text-white d-flex align-items-center">
        <i class="material-icons icon-align">shopping_bag</i>
        <span>Buy Now</span>
      </router-link>
    </div>

    <div v-else class="button-group d-flex justify-content-end pt-5 pe-3">
      <button type="button" class="sale btn btn-success d-flex align-items-center me-3 p-3" data-bs-toggle="modal"
      data-bs-target="#loginModal">
        <i class="material-icons icon-align">add_shopping_cart</i>
        <span>Sale Now</span>
      </button>
      <button type="button" class="buy btn text-white d-flex align-items-center" data-bs-toggle="modal"
      data-bs-target="#loginModal">
        <i class="material-icons icon-align">shopping_bag</i>
        <span>Buy Now</span>
      </button>
    </div>

    <div class="table-responsive bg-white mt-5 pe-3 ps-3">
      <h3 class="text-secondary font-bold pb-3 pt-2">Scrap Price List</h3>
      <div class="d-flex justify-content-end">
        <select class="form-select w-25 me-2" aria-label="Default select example" @change="filterByMonth($event)">
          <option value="all" selected>All month</option>
          <option value="01">January</option>
          <option value="01">January</option>
          <option value="02">February</option>
          <option value="03">March</option>
          <option value="04">April</option>
          <option value="05">May</option>
          <option value="06">June</option>
          <option value="07">July</option>
          <option value="08">August</option>
          <option value="09">September</option>
          <option value="10">October</option>
          <option value="11">November</option>
          <option value="12">December</option>
        </select>
        <!-- <button type="button" class="btn btn-success">Story</button> -->
      </div>
      <table id="ScrapPrice" class="table text-nowrap table-striped table-hover mt-4">
        <thead class="table-dark text-white">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Scrap Name</th>
            <th scope="col">Date</th>
            <th scope="col">Price</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(item, index) in paginatedItems" :key="index">
            <th scope="row">{{ index + 1 + (currentPage - 1) * itemsPerPage }}</th>
            <td>{{ item.name }}</td>
            <td class="date">{{ item.formattedDate }}</td>
            <td>
              <span class="text-danger font-bold">{{ item.price }}៛</span><span class="text-black">/kg</span>
            </td>
          </tr>
        </tbody>
      </table>
      <div id="dataEmpty" class="hidden">
        <p class="text-center text-white p-5 bg-secondary">Data not found</p>
      </div>
      <nav aria-label="Page navigation" class="d-flex justify-content-center mt-3">
        <ul class="pagination">
          <li class="page-item" :class="{ disabled: currentPage === 1 }">
            <a class="page-link" @click="changePage(currentPage - 1)">Previous</a>
          </li>
          <li class="page-item" v-for="page in totalPages" :key="page" :class="{ active: currentPage === page }">
            <a class="page-link" @click="changePage(page)">{{ page }}</a>
          </li>
          <li class="page-item" :class="{ disabled: currentPage === totalPages }">
            <a class="page-link" @click="changePage(currentPage + 1)">Next</a>
          </li>
        </ul>
      </nav>
    </div>

    <div class="list-company mt-3 p-3 bg-white">
      <h3 class="text-secondary font-bold pb-3">Top 5 Company</h3>
      <div class="d-flex justify-content-end pt-2 pb-4">
        <a href="" class="btn btn-success text-decoration-none text-white text-right">See All...</a>
      </div>
      <div class="list-container pb-5">
        <a v-for="(company, index) in companies" :key="index" href=""
          class="card company-card text-decoration-none text-dark pe-3 ps-3 pb-3">
          <div class="card-body">
            <div class="company-logo text-center">
              <img src="../../../assets/company-logo/company-logo.png" alt="Company Logo" />
            </div>
            <div class="company-info">
              <h5 class="text-title">{{ company.name }}</h5>
              <p class="text-card text-danger">{{ company.service }}</p>
              <p class="text-card">{{ company.address }}</p>
              <a :href="'tel:' + company.tel" class="text-card text-decoration-none">{{ company.tel }}</a>
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>
  <Footer></Footer>
</template>

<script>
  import axios from 'axios'
  import NavBar from '../../../Components/NavBar.vue'
  import Footer from '../../../Components/Footer.vue'
  import { useAuthStore } from '../../../stores/auth-store.ts'
  import { useRoute } from 'vue-router'
  import { computed } from 'vue'

  export default {
    name: 'HomePage',
    components: {
      NavBar,
      Footer
    },
    data() {
      return {
        items: [],
        currentPage: 1,
        itemsPerPage: 10,
        companies: [
          {
            name: 'Company 1',
            service: 'service 1',
            address: 'Phnom Penh',
            tel: '012 345 6789',
            image: 'company-logo.png',
            description: 'Description for Company 1'
          },
          {
            name: 'Company 2',
            service: 'service 2',
            address: 'Phnom Penh',
            tel: '012 345 6789',
            image: 'company-logo.png',
            description: 'Description for Company 2'
          },
          {
            name: 'Company 3',
            service: 'service 3',
            address: 'Phnom Penh',
            tel: '012 345 6789',
            image: 'company-logo.png',
            description: 'Description for Company 3'
          },
          {
            name: 'Company 4',
            service: 'service 4',
            address: 'Phnom Penh',
            tel: '012 345 6789',
            image: 'company-logo.png',
            description: 'Description for Company 4'
          },
          {
            name: 'Company 5',
            service: 'service 5',
            address: 'Phnom Penh',
            tel: '012 345 6789',
            image: 'company-logo.png',
            description: 'Description for Company 5'
          }
        ]
      }
    },
    setup() {
    const authStore = useAuthStore()
    console.log(authStore);
    return {
      authStore
    }
  },
    computed: {
      formattedItems() {
        return this.items.map((item) => ({
          ...item,
          formattedDate: this.formatDate(item.created_at)
        }))
      },
      totalPages() {
        return Math.ceil(this.formattedItems.length / this.itemsPerPage)
      },
      paginatedItems() {
        const start = (this.currentPage - 1) * this.itemsPerPage
        const end = start + this.itemsPerPage
        return this.formattedItems.slice(start, end)
      }
    },
    mounted() {
      this.fetchData()
    },
    methods: {
      async fetchData() {
        try {
          const response = await axios.get('http://127.0.0.1:8000/api/item/list')
          this.items = response.data.data
          console.log(response.data.data)

          if (this.items.length === 0) {
            document.getElementById('dataEmpty').classList.remove('hidden')
          } else {
            document.getElementById('dataEmpty').classList.add('hidden')
          }
        } catch (error) {
          console.error('Error fetching data:', error)
        }
      },
      formatDate(dateString) {
        const date = new Date(dateString)
        const options = { year: 'numeric', month: 'long', day: '2-digit' }
        return date.toLocaleDateString('en-US', options)
      },
      filterByMonth(event) {
        const selectedMonth = event.target.value
        const tableRows = document.querySelectorAll('#ScrapPrice tbody tr')
        let dataFound = false

        tableRows.forEach((row) => {
          const rowDate = row.querySelector('.date').innerText.trim()
          const rowMonth = new Date(rowDate).getMonth() + 1
          const formattedRowMonth = rowMonth < 10 ? `0${rowMonth}` : `${rowMonth}`

          if (selectedMonth === 'all' || selectedMonth === formattedRowMonth) {
            row.style.display = 'table-row'
            dataFound = true
          } else {
            row.style.display = 'none'
          }
        })

        if (!dataFound) {
          document.getElementById('dataEmpty').classList.remove('hidden')
        } else {
          document.getElementById('dataEmpty').classList.add('hidden')
        }
      },
      changePage(page) {
        if (page > 0 && page <= this.totalPages) {
          this.currentPage = page
        }
      }
    }
  }
</script>

<style scoped>
  .carousel-item img {
    height: 600px;
    object-fit: cover;
    object-position: center;
    filter: brightness(70%);
  }

  .buy {
    background: #ff8c00;
  }

  .list-container {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 1rem;
  }

  .company-card {
    border-radius: 0.5rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition:
      transform 0.3s ease-in-out,
      box-shadow 0.3s ease-in-out,
      border-color 0.3s ease-in-out;
    position: relative;
    overflow: hidden;
    border: 2px solid thick;
  }

  .company-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    border-color: #007bff;
  }

  .company-card img {
    width: 110px;
    height: 110px;
    object-fit: fill;
  }

  .text-card {
    line-height: 1px;
    font-size: 12px;
  }

  @media (min-width: 1200px) {
    .list-container {
      grid-template-columns: repeat(5, 1fr);
    }
  }

  @media (min-width: 768px) and (max-width: 1199px) {
    .carousel-item img {
      height: 100%;
    }

    .list-container {
      grid-template-columns: repeat(3, 1fr);
    }
  }

  @media (max-width: 767px) {
    .carousel-item img {
      height: 200px;
    }

    .list-container {
      grid-template-columns: repeat(2, 1fr);
    }

    tbody tr td {
      font-size: 12px;
    }

    .company-card img {
      width: 70px;
      height: 70px;
    }

    .company-card .company-info h5 {
      margin-top: 5px;
      font-size: 12px;
      font-weight: bold;
    }
  }
</style>