<template>
  <div>
    <NavBar />
    <div id="carousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button
          type="button"
          data-bs-target="#carouselExampleIndicators"
          data-bs-slide-to="0"
          class="active"
          aria-current="true"
          aria-label="Slide 1"
        ></button>
        <button
          type="button"
          data-bs-target="#carouselExampleIndicators"
          data-bs-slide-to="1"
          aria-label="Slide 2"
        ></button>
        <button
          type="button"
          data-bs-target="#carouselExampleIndicators"
          data-bs-slide-to="2"
          aria-label="Slide 3"
        ></button>
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
      <button
        class="carousel-control-prev"
        type="button"
        data-bs-target="#carousel"
        data-bs-slide="prev"
      >
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button
        class="carousel-control-next"
        type="button"
        data-bs-target="#carousel"
        data-bs-slide="next"
      >
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

    <div v-if="authStore.isAuthenticated" class="button-group d-flex justify-content-end pt-5 pe-3">
      <router-link
        v-if="authStore.isAuthenticatedUser"
        to="/create/post"
        type="button"
        class="sale btn btn-success d-flex align-items-center me-3 p-3"
      >
        <i class="material-icons icon-align">add_shopping_cart</i>
        <span>Sale Now</span>
      </router-link>
      <router-link
        v-if="authStore.isAuthenticatedCompany"
        to="/post/view"
        type="button"
        class="buy btn text-white d-flex align-items-center p-3"
      >
        <i class="material-icons icon-align">shopping_bag</i>
        <span>Buy Now</span>
      </router-link>
    </div>

    <div v-else class="button-group d-flex justify-content-end pt-5 pe-3">
      <button
        type="button"
        class="sale btn btn-success d-flex align-items-center me-3 p-3"
        data-bs-toggle="modal"
        data-bs-target="#loginModal" 
      >
        <i class="material-icons icon-align">add_shopping_cart</i>
        <span>Sale Now</span>
      </button>
      <button
        type="button"
        class="buy btn text-white d-flex align-items-center "
        data-bs-toggle="modal"
        data-bs-target="#loginModal"
      >
        <i class="material-icons icon-align">shopping_bag</i>
        <span>Buy Now</span>
      </button>
    </div>

    <div class="d-flex justify-content-between align-items-center mt-3 p-3">
      <h3 class="text-orange fw-bold">Top Companies</h3>
      <router-link
        to="/companies"
        class="btn btn-success text-decoration-none text-white"
        id="see-all"
        >See All...</router-link
      >
    </div>
    <div class="slider-container">
      <div class="slider mt-5">
        <div class="slider-item" v-for="company in filteredCompanies" :key="company.id">
          <div class="card company-card text-decoration-none text-dark">
            <div class="card p-3">
              <div class="company-logo text-center object-fit-cover">
                <img
                  :src="`http://127.0.0.1:8000/uploads/${company.profile}`"
                  alt="Company Logo"
                  onerror="this.src='https://icons.iconarchive.com/icons/praveen/minimal-outline/512/gallery-icon.png  '"
                  width="100%"
                  height="200"
                  class="rounded"
                />
              </div>
              <div class="company-info">
                <h5 class="text-title mt-3"><b></b> {{ company.name }}</h5>
                <p class="text-break text-danger"><b>Services:</b> Scrap</p>
                <a :href="'tel:' + company.tel" class="text-card text-decoration-none"
                  ><b>Phone:</b> {{ company.phone }}</a
                >
                <p class="text-break"><b>Email:</b>{{ company.email }}</p>
                <a
                  :href="`https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(company.latitude + ',' + company.longitude)}`"
                >
                  <b>Address:</b>
                  <i class="bi bi-geo-alt-fill"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="table-responsive bg-white mt-5 pe-3 ps-3">
      <h3 class="text-orange font-bold pb-3 pt-4">Scrap Price List</h3>
      <div class="d-flex justify-content-end">
        <select
          class="form-select w-25 me-2"
          aria-label="Default select example"
          @change="filterByMonth($event)"
        >
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
            <td>{{ item.item.name }}</td>
            <td class="date">{{ item.date }}</td>
            <td>
              <span class="text-danger font-bold">{{ item.item.price }}៛</span
              ><span class="text-black">/kg</span>
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
          <li
            class="page-item"
            v-for="page in totalPages"
            :key="page"
            :class="{ active: currentPage === page }"
          >
            <a class="page-link" @click="changePage(page)">{{ page }}</a>
          </li>
          <li class="page-item" :class="{ disabled: currentPage === totalPages }">
            <a class="page-link" @click="changePage(currentPage + 1)">Next</a>
          </li>
        </ul>
      </nav>
    </div>

    <FooterVue></FooterVue>
  </div>
</template>

<script>
import axios from 'axios'
import NavBar from '../../../Components/NavBar.vue'
import FooterVue from '../../../Components/Footer.vue'
import { useAuthStore } from '../../../stores/auth-store.ts'
// import { useRoute } from 'vue-router'
// import { computed } from 'vue'

export default {
  name: 'HomePage',
  components: {
    NavBar,
    FooterVue
  },
  data() {
    return {
      companies: [],
      filteredCompanies: [],
      items: [],
      currentPage: 1,
      itemsPerPage: 10
    }
  },
  setup() {
    const authStore = useAuthStore()
    console.log(authStore)
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
    this.fetchCompanies()
  },
  methods: {
    async fetchData() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/history/list')
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
    },
    async fetchCompanies() {
      await axios
        .get('http://127.0.0.1:8000/api/company')
        .then((response) => {
          this.companies = response.data.data
          console.log(response.data.data)
          this.filteredCompanies = response.data.data
        })
        .catch((error) => {
          alert('Error fetching companies:', error)
        })
    }
  }
}
document.addEventListener('DOMContentLoaded', () => {
  const slider = document.querySelector('.slider')
  const sliderItems = Array.from(slider.children)

  // Clone each slider item to create an infinite loop effect
  sliderItems.forEach((item) => {
    const clone = item.cloneNode(true)
    slider.appendChild(clone)
  })

  // Add hover event listeners to pause/resume animation
  sliderItems.forEach((item) => {
    item.addEventListener('mouseover', () => {
      slider.style.animationPlayState = 'paused'
    })
    item.addEventListener('mouseout', () => {
      slider.style.animationPlayState = 'running'
    })
  })
})
</script>

<style scoped>
.carousel-item img {
  /* height: 600px; */
  object-fit: contain;
  object-position: center;
  filter: brightness(70%);
}

.buy {
  background: #ff8c00;
}

.list-container {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 1rem;
}
#sider-card {
  background-color: black;
  border-radius: 5px;
}
#sider-card:hover {
  background-color: #176122;
  border-radius: 5px;
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
.text-break {
  font-size: 18px;
}

/* Aoutor slider of company card */
.slider-container {
  width: 100%;
  overflow: hidden;
}

.slider {
  display: flex;
  width: 100%;
  gap: 1rem;
  animation: scroll 5s linear infinite;
}

.slider-item {
  min-width: calc(100% / 4);
  min-width: calc(100% / 4);
  box-sizing: border-box;
  padding: 0 0.5rem;
}
.company-action button,
#see-all {
  background: rgb(25, 107, 58);
}
.company-action button:hover,
#see-all:hover {
  background: orange;
  color: black;
  border: none;
}

@keyframes scroll {
  100% {
    transform: translateX(-30%);
  }
  0% {
    transform: translateX(0);
  }
}

@media (max-width: 1200px) {
  .slider-item {
    min-width: calc(100% / 5);
  }
  
}

@media (max-width: 992px) {
  .button-group{
    position: absolute;
    top: 63%;
    left: 3.4%;
    margin: 5px;
  }
  .slider-item {
    min-width: calc(100% / 4);
  }
}

@media (max-width: 768px) {
  .slider-item {
    min-width: calc(100% / 4);
  }
}

@media (max-width: 576px) {
  .slider-item {
    min-width: calc(100% / 2);
  }
}


.slider:hover {
  animation-play-state: paused;
}

/* end */

@media (min-width: 1200px) {
  .button-group {
    position: absolute;
    top: 63%;
    left: 15%;
    margin: 5px;
  }
  .list-container {
    grid-template-columns: repeat(5, 1fr);
  }
}

@media (max-width: 1199px) {
  .button-group {
    position: absolute;
    top: 26%;
    left: 3.2%;
    margin: 5px;
  }
  .carousel-item img {
    height: 100%;
  }

  .list-container {
    grid-template-columns: repeat(3, 1fr);
  }
}

@media (max-width: 767px) {
  .button-group {
    position: absolute;
    top: 20%;
    margin: 5px;
    font-size: 5px;
  }
  .button-group button {
    font-size: 10px;
    height: 30px;
  }
  .button-group button i {
    font-size: 10px;
  }
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
@media (max-width: 391px) {
  .button-group {
    top: 22%;
  }
}
</style>
