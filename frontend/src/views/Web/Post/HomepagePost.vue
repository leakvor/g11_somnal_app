<template>
  <div>
    <NavBar />
    <!-- ========message alert of post create -->
    <!-- Alert created successfully -->
    <div class="alertModal flex justify-center">
      <div class="alert alert-success mt-3 w-99 flex items-center gap-2 p-4 rounded-lg shadow-md" v-if="showSuccessMessage">
        <i class="fa fa-check-circle"></i> {{ successMessage }}
      </div>
    </div>

    <div class="d-flex">
      <div class="backgroundform ">
        <form @submit.prevent="createPost" class="form p-4" method="POST" enctype="multipart/form-data">
          <h3 class="text-center m-3" style="color: orange">Post Here!!</h3>
          <div class="mb-3">
            <label for="title" class="form-label" style="color: white">Title</label>
            <input type="text" class="form-control shared-style" id="title" name="title" v-model="title" />
          </div>
          <div class="mb-3 dropdown">
            <label for="item-dropdown" class="form-label" style="color: white">Choose Type of scrap </label>
            <div class="mb-3" v-if="selectedItemsNames.length > 0">
              <p style="color: white">{{ selectedItemsNames }}</p>
            </div>
            <button class="form-control shared-style dropdown-toggle" type="button" id="item-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
              Choose Type 
            </button>
            <ul class="dropdown-menu text-white" aria-labelledby="item-dropdown" style="max-height: 200px; overflow-y: auto;">
              <li v-for="item in item_all" :key="item.id">
                <div class="form-check dropdown-item ">
                  <input class="form-check-input " type="checkbox" :value="item.id" :id="`Checkme${item.id}`" name="item_ids[]" v-model="selectedItems" />
                  <label class="form-check-label" :for="`Checkme${item.id}`">{{ item.name }}</label>
                </div>
              </li>
            </ul>
          </div>
          <div class="mb-3">
            <label for="formFile" class="form-label" style="color: white">File image post</label>
            <div class="filepond-container">
              <FilePond name="images[]" v-model="images" ref="pond"
                label-idle="Drag & Drop your images or <span class='filepond--label-action'>Browse</span>"
                allow-multiple="true" accepted-file-types="image/jpeg, image/png" @updatefiles="handleFileChange" />
            </div>
          </div>
          <div class="mb-3">
            <label for="company-selection" style="color: white" class="form-label">Choose company</label>
            <select id="company-selection" name="company" class="form-select shared-style" v-model="company_id">
              <option disabled selected value="">Choose a company</option>
              <option v-for="company in companies" :key="company.id" :value="company.id">
                {{ company.name }}
              </option>
            </select>
          </div>
          <div class="submit d-grid gap-2">
            <div class="d-flex column justify-content-end gap-2">
              <button class="btn btn-danger" type="button" @click="closeForm">Cancel</button>
              <button class="btn btn-success" type="submit">Submit</button>
            </div>
          </div>
        </form>
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
  components: {
    FilePond,
    NavBar,
    Footer
  },
  data() {
    return {
      images: [],
      item_all: [],
      company_id: '',
      companies: [],
      title: '',
      selectedItems: [],
      showSuccessMessage: false,
      successMessage: ''
    }
  },
  computed: {
    selectedItemsNames() {
      return this.selectedItems.map((id) => {
        const item = this.item_all.find((item) => item.id === id)
        return item.name
      })
    }
  },
  mounted() {
    this.getAllItems()
    this.getAllCompanies()
  },
  methods: {
    async createPost() {
      console.log('title', this.title)
      console.log('image', this.images)
      console.log('item', this.selectedItems.join(','))
      console.log('company', this.company_id)
      try {
        const formData = new FormData()
        formData.append('title', this.title)
        formData.append('company_id', this.company_id)
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
        this.successMessage = 'Post created successfully!'
        this.showSuccessMessage = true
        this.resetForm()
          if(this.company_id != null){
            this.$router.push('/')
          }else{
            this.$router.push('/')
          }
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
    closeForm() {
      this.resetForm()
      // Optional: Navigate to another page, e.g., homepage or previous page
      this.$router.push('/profile')
    },
    async getAllItems() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/item/list')
        this.item_all = response.data.data
      } catch (error) {
        console.error('Error getting items:', error)
      }
    },
    async getAllCompanies() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/company')
        this.companies = response.data.data
        console.log(this.companies)
      } catch (error) {
        console.error('Error getting companies:', error)
      }
    },
  }
}
</script>

<style scoped>
.backgroundform {
  width: 100%;
  display: flex;
  justify-content: center;
   background-image: url("../../../assets/image/adjay.jpg");
   background-size: cover;
   background-position: center;
   background-repeat: no-repeat;  
   /* filter: blur(1px); */
   /* filter: blur(8px) */

   
}
form {
  width: 100%;
  max-width: 40%;
  border-radius: 10px;
  border-top: 7px solid rgb(248, 98, 44);
  background: rgba(37, 109, 82, 0.885);
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  margin-top: 10px;
  margin-bottom: 10px;
}

.dropdown .form-control,
.dropdown-menu {
  width: 100%;
}

.dropdown .form-control {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.form-check-input {
  margin-left: 20px;
}

.form-label {
  margin-top: 5px;
}

.submit {
  margin-top: 7%;
  margin-bottom: 5%;
}

.filepond-container {
  max-height: 200px;
  overflow-y: auto;
  padding: 5px;
  border: 1px solid #ccc;
  border-radius: 5px;
  background-color: #fff;
}

@media screen and (max-width: 1114px) {
  form {
    max-width: 50%;
  }
}

@media screen and (max-width: 768px) {
  form {
    max-width: 70%;
  }
}

@media screen and (max-width: 575px) {
  form {
    max-width: 90%;
  }
}


.alertModal {
  position: fixed;
  top: 10%;
  left: 0;
  right: 0;
  z-index: 9999;
}

.alert-success {
  display: flex;
  align-items: center;
  gap: 8px;
}

.filepond--item {
  margin-bottom: 8px;
}
</style>
