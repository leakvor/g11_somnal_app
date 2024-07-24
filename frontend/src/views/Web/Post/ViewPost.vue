<template>
  <div>
    <NavBar />
    <div class="container mt-5">
      <div class="row">
        <aside class="col-lg-3 fixed-aside">
          <div class="profile-card">
            <div class="card-cont">
              <div
                class="card"
                v-for="company in paginatedCompanies"
                :key="company.id"
                style="display: flex; flex-direction: row"
              >
                <img :src="`http://127.0.0.1:8000/uploads/${company.profile}`" @click="showCompanyModal(company.id)" alt="Image" />
                <p class="title" style="size: 5px">{{ company.name }}</p>
                <div>

                </div>
              </div>

            </div>

            <div class="pagination d-flex justify-content-end">
              <button class="btn btn-success me-2" @click="prevPage" :disabled="currentPage === 1">
                <i class="bi bi-chevron-left"></i>
              </button>
              <span class="mx-2">{{ currentPage }} / {{ totalPages }}</span>
              <button
                class="btn btn-success ms-2"
                @click="nextPage"
                :disabled="currentPage === totalPages"
              >
                <i class="bi bi-chevron-right"></i>
              </button>
            </div>
          </div>
        </aside>
        <main class="col-lg-6">
          <div v-for="post in posts" :key="post.id" class="post-card">
            <div class="post-header">
              <img
                :src="`http://127.0.0.1:8000/uploads/${post.user.profile}`"
                alt="User Image"
                class="user-image"
              />
              <div class="user-info">
                <h5 style="color: black">{{ post.user.name }}</h5>
                <span style="color: black">{{ post.created_at }}</span>
              </div>
            </div>
            <div class="post-content">
              <p style="color: black">{{ post.title }}</p>
              <div class="type-scrap" v-if="post.items.length > 0">
                <span style="color: red">Type of Scrap:</span>
                <ul>
                  <span style="color: black" v-for="(item, index) in post.items" :key="index">
                    {{ item.item }}{{ index < post.items.length - 1 ? ', ' : '' }}
                  </span>
                </ul>
              </div>

              <div class="images-grid">
                <template v-if="post.images.length === 1">
                  <img
                    style="width: 100%; height: auto; cursor: pointer"
                    :src="`http://127.0.0.1:8000/uploads/${post.images[0].image}`"
                    alt="Post Image"
                    class="post-image"
                    @click="openImageModal(post.images, 0)"
                  />
                </template>
                <template v-else-if="post.images.length === 3">
                  <div class="image-container full-width">
                    <img
                      :src="`http://127.0.0.1:8000/uploads/${post.images[0].image}`"
                      alt="Post Image"
                      class="post-image-grid"
                    />
                  </div>
                  <div
                    class="image-container half-width"
                    v-for="(image, index) in post.images.slice(1)"
                    :key="index"
                  >
                    <img
                      :src="`http://127.0.0.1:8000/uploads/${image.image}`"
                      alt="Post Image"
                      class="post-image-grid"
                      @click="openImageModal(post.images, index + 1)"
                    />
                  </div>
                </template>
                <template v-else>
                  <div
                    v-for="(image, index) in displayedImages(post.images)"
                    :key="index"
                    class="image-container"
                    @click="openImageModal(post.images, index)"
                  >
                    <img
                      :src="`http://127.0.0.1:8000/uploads/${image.image}`"
                      alt="Post Image"
                      class="post-image-grid"
                    />
                    <div v-if="index === 3 && post.images.length > 4" class="overlay">
                      +{{ post.images.length - 4 }}
                    </div>
                  </div>
                </template>
              </div>

              <button
                v-if="authStore.isAuthenticatedCompany"
                :class="post.status === 'buy' ? 'btn btn-danger mt-3' : 'btn btn-success mt-3'"
                @click="confirmAction(post.id, post.status === 'buy' ? 'not_buy' : 'buy')"
              >
                {{ post.status === 'buy' ? 'Already Buy' : 'Buy' }}
              </button>
            </div>
          </div>
        </main>
        <aside class="col-lg-3 fixed-aside">
          <div class="card-image" style="width: 100%; height: 200px">
            <img
              src="../../../assets/image/right_aside_image.jpg"
              style="object-fit: cover; width: 100%; height: 100%"
              alt=""
            />
            <div class="card-content" style="align-items: center">
              <h5 style="color: black">See all post!!</h5>
              <ul style="color: black">
                <li>You are a business owner who buys scrabs.</li>
                <li>You are a user who sells scrabs.</li>
              </ul>
            </div>
          </div>
        </aside>
      </div>
    </div>

    <!-- Image Modal -->
    <div v-if="showModal" class="modal mt-5" @click="closeImageModal">
      <span class="close" @click="closeImageModal">&times;</span>
      <img class="modal-content" :src="`http://127.0.0.1:8000/uploads/${currentImage.image}`" />
      <div class="caption">{{ currentImageIndex + 1 }} / {{ modalImages.length }}</div>
      <a class="prev" @click.stop="prevImage">&#10094;</a>
      <a class="next" @click.stop="nextImage">&#10095;</a>
    </div>

    <!-- Confirm Modal -->
    <div
      v-if="showModalConfirm"
      class="modal fade show d-block modal-top"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle" style="color: black">Confirm</h5>
          </div>
          <div class="modal-body">
            <p style="color: black">{{ confirmationMessage }}</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" @click="closeConfirmModal">Cancel</button>
            <button type="button" class="btn btn-success" @click="executeAction">Confirm</button>
          </div>
        </div>
      </div>
    </div>


    <!-- Company Modal -->
    <div class="modal fade" v-if="showModelCompany"  id="companyModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="card-body">
              <div class="company-logo text-center mt-3">
                <img
                  :src="`http://127.0.0.1:8000/uploads/${company.profile}`"
                  alt="Company Logo"
                  width="100%"
                  height="200"
                  class="rounded"
                  onerror="this.src='https://icons.iconarchive.com/icons/praveen/minimal-outline/512/gallery-icon.png'"
                />
              </div>
              <div class="company-info mt-3">
                <h5 class="text-title" style="color: black">{{ company.name }}</h5>
                <p class="text-break text-danger"><b>Services:</b> {{ company.id }}</p>
                <a :href="'tel:' + company.tel" class="text-card text-decoration-none"
                  ><b>Phone:</b> {{ company.phone }}</a
                >
                <div class=" ">
                  <p class="text-break" style="color: black"><b>Email:</b>{{ company.email }}</p>
                </div>
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
    

  </div>
</template>

<script>
import { useAuthStore } from '../../../stores/auth-store'
import NavBar from '../../../Components/NavBar.vue'
import axios from 'axios'

export default {
  components: {
    NavBar
  },
  setup() {
    const authStore = useAuthStore()
    return { authStore }
  },
  data() {
    return {
      posts: [],
      showModal: false,
      showModalConfirm: false,
      modalImages: [],
      currentImage: null,
      currentImageIndex: 0,
      confirmationMessage: '',
      actionPostId: null,
      actionType: null,
      companies: [],
      currentPage: 1,
      itemsPerPage: 3,
      company:null,
      showModelCompany:false
    }
  },
  computed: {
    totalPages() {
      return Math.ceil(this.companies.length / this.itemsPerPage)
    },
    paginatedCompanies() {
      const start = (this.currentPage - 1) * this.itemsPerPage
      const end = start + this.itemsPerPage
      return this.companies.slice(start, end)
    }
  },
  methods: {
    async showCompanyModal(companyId){
      try {
        const token = localStorage.getItem('access_token')
        const response = await axios.get(`http://127.0.0.1:8000/api/company/show/${companyId}`, {
          headers: {
            Authorization: `Bearer ${token}`
          }
        })
        this.company = response.data
        console.log('company', this.company)
        $('#companyModal').modal('show')
        this.showModelCompany = true
      } catch (error) {
        console.error(error)
      }
    },
    confirmAction(postId, actionType) {
      this.actionPostId = postId
      this.actionType = actionType
      this.confirmationMessage = `Are you sure you want to ${actionType === 'buy' ? 'buy' : 'not buy'} this post?`
      this.showModalConfirm = true
    },
    async executeAction() {
      try {
        await this.updatePostStatus(this.actionPostId, this.actionType)
      } finally {
        this.showModalConfirm = false
      }
    },
    closeConfirmModal() {
      this.showModalConfirm = false
    },
    async fetchPosts() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/post/list')
        this.posts = response.data
        console.log('posts', this.posts)
      } catch (error) {
        console.error(error)
      }
    },
    async infoCompany(id) {
      try {
        const response = await axios.get(`http://127.0.0.1:8000/api/company/show/${id}`)
        this.company = response.data
        console.log('company', this.company)
      } catch (error) {
        console.error(error)
      }
    },
    async updatePostStatus(postId, newStatus) {
      try {
        const token = localStorage.getItem('access_token')
        if (!token) {
          throw new Error('No access token found')
        }
        const headers = {
          Authorization: `Bearer ${token}`,
          'Content-Type': 'application/json'
        }
        const data = { status: newStatus, company_id: this.authStore.user.id }
        const response = await axios.post(
          `http://127.0.0.1:8000/api/post/update/status/${postId}`,
          data,
          { headers }
        )
        console.log('Response:', response.data)
        await this.fetchPosts()
      } catch (error) {
        console.error('Error updating post status:', error)
      }
    },
    openImageModal(images, index) {
      this.modalImages = images
      this.currentImageIndex = index
      this.currentImage = images[index]
      this.showModal = true
    },

    nextImage() {
      this.currentImageIndex = (this.currentImageIndex + 1) % this.modalImages.length
      this.currentImage = this.modalImages[this.currentImageIndex]
    },
    prevImage() {
      this.currentImageIndex =
        (this.currentImageIndex - 1 + this.modalImages.length) % this.modalImages.length
      this.currentImage = this.modalImages[this.currentImageIndex]
    },
    closeImageModal() {
      this.showModal = false
      this.modalImages = []
      this.currentImage = null
      this.currentImageIndex = 0
    },
    displayedImages(images) {
      return images.length > 4 ? images.slice(0, 4) : images
    },
    changePage(page) {
      if (page > 0 && page <= this.totalPages) {
        this.currentPage = page
      }
    },
    nextPage() {
      if (this.currentPage < this.totalPages) {
        this.currentPage++
      }
    },
    prevPage() {
      if (this.currentPage > 1) {
        this.currentPage--
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
  },
  mounted() {
    this.fetchPosts()
    this.fetchCompanies()
  }
}
</script>



<style scoped>
.container {
  display: flex;
}

.fixed-aside {
  position: fixed;
  top: 0;
  height: 100vh;
  overflow-y: auto;
}

.profile-card {
  padding: 20px;
  background-color: #f8f9fa;
  border-radius: 5px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.profile-image {
  width: 100%;
  height: auto;
  border-radius: 50%;
}

.profile-stats {
  margin-top: 10px;
  display: flex;
  justify-content: space-between;
}

.recent,
.groups,
.saved-items {
  margin-top: 20px;
}

.post-card {
  margin-bottom: 20px;
  padding: 15px;
  background-color: #fff;
  border-radius: 5px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.post-header {
  display: flex;
  align-items: center;
}

.user-image {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  margin-right: 10px;
}

.user-info h5,
.user-info span {
  display: block;
  margin: 0;
}

.images-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 10px;
  margin-top: 10px;
}

.image-container {
  position: relative;
}

.post-image-grid {
  width: 100%;
  height: auto;
  border-radius: 5px;
  cursor: pointer;
}

.overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.5);
  color: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 24px;
  border-radius: 5px;
}

@media (min-width: 992px) {
  .fixed-aside {
    position: sticky;
    top: 0;
  }
}
.images-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  grid-gap: 10px;
}

.image-container {
  position: relative;
  width: 100%;
  padding-top: 100%; /* 1:1 Aspect Ratio */
  overflow: hidden;
  border-radius: 5px; /* Optional: for rounded corners */
}

.image-container img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.image-container img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.full-width {
  grid-column: span 2;
  width: 100%;
  padding-top: 50%; /* Aspect ratio for the full-width image */
}

.half-width {
  width: 100%;
  padding-top: 100%; /* 1:1 Aspect Ratio for half-width images */
}

.overlay {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  background: rgba(0, 0, 0, 0.5);
  color: #fff;
  font-size: 1.5em;
}


.close {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #fff;
  font-size: 40px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

.prev,
.next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  color: white;
  font-weight: bold;
  font-size: 20px;
  transition: 0.6s ease;
  user-select: none;
}

.prev {
  left: 0;
}

.next {
  right: 0;
}

.prev:hover,
.next:hover {
  background-color: rgba(0, 0, 0, 0.8);
}

.caption {
  text-align: center;
  color: #ccc;
  padding: 10px 0;
}

.card {
  border: 1px solid white;
  padding: 20px;
  margin-bottom: 20px;
  border-radius: 8px;
  background: none;
  /* box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); */
}

.card img {
  width: 50px;
  height: 50px;
  margin-right: 10px;
  border-radius: 50%;
}

.card .title {
  font-size: 15px;
  margin-top: 10px;
  /* font-weight: bold; */
}

.card .description {
  font-size: 0.9em;
  color: #666;
}

.card button:hover {
  background-color: #45a049;
}
</style>
