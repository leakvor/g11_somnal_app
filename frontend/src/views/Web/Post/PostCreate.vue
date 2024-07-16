<template>
  <div class="container ">
    <form @submit.prevent="createPost" class="form p-4" method="POST" enctype="multipart/form-data">
      <h3 class="text-center m-3" style="color: black">Post Here!!</h3>
      <div class="mb-3">
        <label for="title" class="form-label" style="color: black">Title</label>
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
        <div class="mb-3" v-if="selectedItemsNames.length>0"> 
        <p style="color:black">{{ selectedItemsNames }}</p>
      </div>
        <button
          class="form-control shared-style dropdown-toggle"
          type="button"
          id="item-dropdown"
          data-bs-toggle="dropdown"
          aria-expanded="false"
        >
          Select items
        </button>
        <ul class="dropdown-menu scrollable-menu" aria-labelledby="item-dropdown">
          <li v-for="item in item_all" :key="item.id">
            <div class="form-check dropdown-item">
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
        <label for="formFile" class="form-label" style="color: black">File image post</label>
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
      <div class="mb-3">
        <label for="company-selection" style="color: black" class="form-label">Company Selection</label>
        <select
          id="company-selection"
          name="company"
          class="form-select shared-style"
          v-model="company_id"
        >
          <option disabled selected value="">Select a company</option>
          <option v-for="company in companies" :key="company.id" :value="company.id">
            {{ company.name }}
          </option>
        </select>
      </div>
     <div class="submit d-grid gap-2">
        <button class="btn btn-success" type="submit">Submit</button>
      </div>
    </form>
  </div>
</template>

<script>
import vueFilePond from 'vue-filepond'
import 'filepond/dist/filepond.min.css'
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css'
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type'
import FilePondPluginImagePreview from 'filepond-plugin-image-preview'

import axios from 'axios'
import router from '@/router'

// Register the plugins
const FilePond = vueFilePond(FilePondPluginFileValidateType, FilePondPluginImagePreview)

export default {
  components: {
    FilePond,
    
  },
  data() {
    return {
      images: [],
      item_all: [],
      company_id: '',
      companies: [],
      title: '',
      // status: 'pending',
      selectedItems: []
    }
  },
  computed: {
    selectedItemsNames() {
      return this.selectedItems.map(id => {
        const item = this.item_all.find(item => item.id === id);
        return item.name;
      });
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
        console.log(response.data)
        this.resetForm()
        if(this.company_id != null){
          this.$router.push('/profile')
        }else{
          this.$router.push('/sell/now')
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
    }
  }
}
</script>

<style scoped>
.container {
  width: 100%;
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  

}

form {
  width: 100%;
  max-width: 800px;
  margin: auto;
  border-radius: 10px;
  border-top: 7px solid rgb(248, 98, 44);
  background: white;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  
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

.dropdown-menu.scrollable-menu {
  max-height: 200px;
  overflow-y: auto;
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

@media (min-width: 576px) {
  form {
    width: 90%;
  }
}

@media (min-width: 768px) {
  form {
    width: 90%;

  }
}

@media (min-width: 992px) {
  form {
     width: 90%;
  }
}

@media (min-width: 1200px) {
  form {
    width: 60%;
  }
}
</style>
