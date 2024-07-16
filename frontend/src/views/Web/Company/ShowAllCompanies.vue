<template>
  <div>
    <NavBar />
    <div class="container">
      <div class="list-company mt-3 p-3 bg-white">
        <h3 class="text-success font-bold d-flex justify-content-center">All Companies</h3>

        <div class="d-flex justify-content-end pt-2 pb-4">
          <input
            type="text"
            class="form-control"
            id="search_company"
            placeholder="Search.."
            v-model="searchText"    
            @input="filterCompanies"
          />
        </div>

        <div class="list-container pb-5">
          <a
            ref="#"
            v-for="company in filteredCompanies"
            :key="company.id"
            class="card company-card text-decoration-none text-dark pe-3 ps-3 pb-3"
          >
            <div class="card-body">
              <div class="company-logo text-center">
                <img :src="`http://127.0.0.1:8000/uploads/${company.profile}`" alt="Company Logo" />
              </div>
              <div class="company-info">
                <h5 class="text-title">{{ company.name }}</h5>
                <!-- <p class="text-card text-danger"><b>Services:</b> {{ company.id }}</p> -->
                <a :href="'tel:' + company.tel" class="text-card text-decoration-none"
                  ><b>Phone:</b> {{ company.phone }}</a
                >
                <div class=" "> 
                  <p class="text-break"><b>Email:</b>{{ company.email }}</p>
                </div>
                <p class="text-card"><b>Address:</b> {{ company.address }}</p>
              </div>
              <div v-if="user_info.role_id==2" class="company-action d-flex justify-content-end">
                <button class="btn btn-success" type="submit" @click="openModal(company.id)">
                  Sales Now
                </button>
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
      <div
        class="modal fade show"
        tabindex="-1"
        aria-labelledby="postModalLabel"
        aria-hidden="true"
        :style="{ display: visible ? 'block' : 'none', backgroundColor: 'rgba(0, 0, 0, 0.5)' }"
        v-if="visible"
      >
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title text-orange" id="postModalLabel">Post Here!!</h5>
              <button
                type="button"
                class="btn-close"
                @click="closeModal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">
              <form
                @submit.prevent="createPost"
                class="form p-4"
                method="POST"
                enctype="multipart/form-data"
              >
                <div class="mb-3">
                  <label for="title" class="form-label" style="color:black">Title</label>
                  <input
                    type="text"
                    class="form-control shared-style"
                    id="title"
                    name="title"
                    v-model="title"
                  />
                </div>
                <div class="mb-3 dropdown">
                  <label for="item-dropdown" class="form-label" style="color:black">Item selection</label>
                  <div class="mb-3" v-if="selectedItemsNames.length > 0">
                    <p style="color:black">{{ selectedItemsNames }}</p>
                  </div>
                  <button class="form-control shared-style dropdown-toggle" type="button" id="item-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <p>Select items</p>
                  </button>
                  <ul class="dropdown-menu dropdown-scroll" aria-labelledby="item-dropdown">
                    <li v-for="item in item_all" :key="item.id">
                      <div class="form-check dropdown-item ml-2">
                        <input
                          class="form-check-input"
                          type="checkbox"
                          :value="item.id"
                          :id="`Checkme${item.id}`"
                          name="item_ids[]"
                          v-model="selectedItems"
                        />
                        <label class="form-check-label" :for="`Checkme${item.id}`">{{ item.name }}</label>
                      </div>
                    </li>
                  </ul>
                </div>
                <div class="mb-3">
                  <label for="formFile" class="form-label" style="color:black">File image post</label>
                  <FilePond
                    name="images[]"
                    v-model="images"
                    ref="pond"
                    label-idle="Drag & Drop your images or <span class='filepond--label-action'>Browse</span>"
                    allow-multiple="true"
                    accepted-file-types="image/jpeg, image/png"
                    @updatefiles="handleFileChange"
                  />
                </div>
                <div class="submit d-grid gap-2">
                  <button class="btn btn-success" type="submit">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <Footer />
  </div>
</template>


<script>
import vueFilePond from 'vue-filepond'
import 'filepond/dist/filepond.min.css'
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css'
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type'
import FilePondPluginImagePreview from 'filepond-plugin-image-preview'

import NavBar from '../../../Components/NavBar.vue'
import Footer from '../../../Components/Footer.vue'

import axios from 'axios'
import router from '@/router'

// Register the plugins
const FilePond = vueFilePond(FilePondPluginFileValidateType, FilePondPluginImagePreview)

export default {
  name: 'CompanyList',
  components: {
    NavBar,
    Footer,
    FilePond
  },
  data() {
    return {
      images: [],
      item_all: [],
      company_id: '',
      title: '',
      selectedItems: [],
      companies: [],
      filteredCompanies: [],
      visible: false,
      selectedCompany: null,
      searchText: '',
      user_info: null,
    }
  },
  mounted() {
    this.getAllItems()
    this.fetchCompanies()
    this.fetchUser()
  },
  computed: {
    selectedItemsNames() {
      return this.selectedItems.map(id => {
        const item = this.item_all.find(item => item.id === id);
        return item.name;
      });
    }
  },
  methods: {
    openModal(company) {
        $('#postModal').modal('show')
      this.selectedCompany = company
      console.log("id",this.selectedCompany)
      this.visible = true  
    },
    closeModal() {
      this.visible = false
    },
    async fetchUser() {
      try {
        const token = localStorage.getItem('access_token')
        const response = await axios.get(`http://127.0.0.1:8000/api/me`, {
          headers: {
            Authorization: `Bearer ${token}`
          }
        })
        this.user_info = response.data.data
        console.log('User Info:', this.user_info)
      } catch (error) {
        console.error('Error fetching user:', error)
      }
    },
    async createPost() {
      console.log('title', this.title)
      console.log('image', this.images)
      console.log('item', this.selectedItems.join(','))
      console.log('company', this.selectedCompany)
      try {
        const formData = new FormData()
        formData.append('title', this.title)
        formData.append('company_id', this.selectedCompany)
        formData.append('items', this.selectedItems.join(','))
        this.images.forEach((image) => {
          formData.append('images[]', image)
        })
        const token = localStorage.getItem('access_token')
        const response = await axios.post('http://127.0.0.1:8000/api/post/create/user', formData, {
          headers: {
            Authorization: `Bearer ${token}`,
            'Content-Type': 'multipart/form-data'
          }
        })
        console.log(response.data)
        this.resetForm()
        this.$router.push('/profile')
      } catch (error) {
        console.error('Error creating post:', error)
      }
    },
    handleFileChange(fileItems) {
      this.images = fileItems.map((fileItem) => fileItem.file)
    },
    resetForm() {
      this.title = ''
      this.company_id = null
      this.images = []
      this.selectedItems = []
      this.item_all.forEach((item) => {
        document.getElementById(`Checkme${item.id}`).checked = false
      })
    },
    async getAllItems() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/item/list')
        this.item_all = response.data.data
        console.log('Items:', this.item_all)
      } catch (error) {
        console.error('Error getting items:', error)
      }
    },
    fetchCompanies() {
      axios
        .get('http://127.0.0.1:8000/api/company')
        .then((response) => {
          this.companies = response.data.data
          this.filteredCompanies = response.data.data
          console.log(this.company)
        })
        .catch((error) => {
          console.error('Error fetching companies:', error)
        })
    },
    filterCompanies() {
      this.filteredCompanies = this.companies.filter((company) =>
        company.name.toLowerCase().includes(this.searchText.toLowerCase())
      )
    },
  }
}
</script>

<style scoped>
#search_company{
  background:white;
  width: 20%;
}
.list-container {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 1rem;
}
.company-card {
  border-radius: 0.5rem;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  transition: transform 0.4s ease-in-out, box-shadow 0.4s ease-in-out, border-color 0.4s ease-in-out;
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

#item-dropdown{
display: flex;
justify-content: space-between;

}
.text-card {
  font-size: 0.9rem;
  color: #666;
}
.company-action button {
  background: rgb(25, 107, 58);
}
.company-action button:hover {
  background: orange;
  color: black;
  border: none;
}
.company-action button,
#back-btn {
  background: rgb(25, 107, 58);
  color: white;
  border: none;
  margin-right: 20px;
}
.company-action button:hover,
#back-btn:hover {
  background: orange;
  color: black;
}

.bg-orange {
  background-color: orange;
}

.dropdown-scroll {
  max-height: 200px; 
  overflow-y: auto;
}

/* Responsive styles */
@media (max-width: 1200px) {
  .list-container {
    grid-template-columns: repeat(4, 1fr);
  }
}

@media (max-width: 992px) {
  .list-container {
    grid-template-columns: repeat(3, 1fr);
  }
}

@media (max-width: 768px) {
  .list-container {
    grid-template-columns: repeat(1, 1fr);
  }

  .company-action {
    justify-content: center !important;
  }
}


</style>
