<template>
  <div class="container" style="margin-top: -10px">
    <h3 class="text-center mb-3" style="color: black">History of company buy Scraps</h3>
    <table class="table table-striped">
      <thead class="table-dark">
        <tr>
          <th>User</th>
          <th>Date</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="history in paginatedPosts" :key="history.id">
          <td>{{ history.user.name }}</td>
          <td>{{ history.date_created }}</td>
          <td>
            <button @click="showPostModal(history.id)"  class="w-20 bg-green-500 hover:bg-orange-600 text-white p-2 rounded border-0">
              <i class="fas fa-eye"></i>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
    <div class="pagination d-flex justify-content-end">
      <button class="btn btn-success me-2" @click="prevPage" :disabled="currentPage === 1">
        <i class="bi bi-chevron-left"></i>
      </button>
      <span class="mx-2">{{ currentPage }} / {{ totalPages }}</span>
      <button class="btn btn-success ms-2" @click="nextPage" :disabled="currentPage === totalPages">
        <i class="bi bi-chevron-right"></i>
      </button>
    </div>
    <div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="post-container" v-if="post">
              <div class="post-header d-flex align-items-center">
                <img
                   :src="post.user.profile ? `http://127.0.0.1:8000/uploads/${post.user.profile}` : 'http://127.0.0.1:8000/uploads/1721404514.png'"
                  alt="Account Image"
                  class="account-image rounded-circle"
                  style="border: 1px solid gray"
                />
                <h6 class="account-name ml-3 mb-0" style="color:black">{{ post.user.name }}</h6>
              </div>
              <p class="post-title" style="size: 5px;color:black">{{ post.title }}</p>
              <p class="text-danger" style="margin-top: -20px;color:black">Type of scrap:</p>
              <ul>
                <li>
                  <p class="comment-text">
                    <span style="color:black" v-for="(item, index) in post.items" :key="index">
                      {{ item.item }}{{ index < post.items.length - 1 ? ', ' : '' }}
                    </span>
                  </p>
                </li>
              </ul>
              <!-- <div class="row">
                  <div v-for="(image, index) in post.images" :key="index" class="grid-item">
                  <img
                    class="img-fluid shadow rounded m-2"
                    :src="`http://127.0.0.1:8000/uploads/${image.image}`"
                    :alt="`Image ${index + 1}`"
                  />
                </div>
              </div> -->
               <!-- ==========if post only one image========= -->
               <div class="row" v-if="post.images.length == 1">
                <div v-for="(image, index) in post.images" :key="index" class="grid-item">
                  <img
                    class="img-fluid shadow rounded"
                    :src="`http://127.0.0.1:8000/uploads/${image.image}`"
                    :alt="`Image ${index + 1}`"
                  />
                </div>
              </div>
              <!-- ==========if post have two images========= -->
              <div class="row" v-if="post.images.length === 2">
                <div v-for="(image, index) in post.images" :key="index" class="grid-item col-6">
                  <img
                    class="img-fluid shadow rounded"
                    :src="`http://127.0.0.1:8000/uploads/${image.image}`"
                    :alt="`Image ${index + 1}`"
                    style="width:100%; height:80%;"
                  />
                </div>
              </div>
              <!-- ===================if post have images>3========= -->
              <div class="row" v-if="post.images.length > 2">
                <div v-for="(image, index) in post.images" :key="index" class="grid-item col-4">
                  <img
                    class="img-fluid shadow rounded"
                    :src="`http://127.0.0.1:8000/uploads/${image.image}`"
                    :alt="`Image ${index + 1}`"
                    style="width:100%; height:80%;"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  components: {},
  data() {
    return {
      searchInput: '',
      posts: [],
      currentPage: 1,
      pageSize: 5,
      post: null,
    }
  },
  computed: {
    filteredPosts() {
      return this.posts.filter((post) => post.id.toString().includes(this.searchInput))
    },
    paginatedPosts() {
      const start = (this.currentPage - 1) * this.pageSize
      const end = start + this.pageSize
      return this.filteredPosts.slice(start, end)
    },
    totalPages() {
      return Math.ceil(this.filteredPosts.length / this.pageSize)
    }
  },
  methods: {
    async getHistory() {
      try {
        const token = localStorage.getItem('access_token')
        const response = await axios.get('http://127.0.0.1:8000/api/post/company/history', {
          headers: {
            Authorization: `Bearer ${token}`
          }
        })
        this.posts = response.data.data
      } catch (error) {
        console.error(error)
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
    async showPostModal(postId) {
      try {
        const token = localStorage.getItem('access_token')
        const response = await axios.get(`http://127.0.0.1:8000/api/post/each/user/${postId}`, {
          headers: {
            Authorization: `Bearer ${token}`
          }
        })
        this.post = response.data.data
        console.log('post',this.post)
        $('#postModal').modal('show')
      } catch (error) {
        console.error(error)
      }
    }
  },
  mounted() {
    this.getHistory(),
    this.showPostModal()
  }
}
</script>

<style scoped>
.pagination {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 20px;
}
.pagination button {
  margin: 0 10px;
}
th,
td {
  text-align: left;
}
th {
  font-weight: bold;
}
button {
  margin-right: 6px;
}
button.btn-success {
  background-color: #126f15;
  color: white;
}
button.btn-warning {
  background-color: rgb(255, 157, 0);
  color: black;
}
button.btn-danger {
  background-color: #f44336;
  color: white;
}
button.btn-secondary {
  background-color: #6c757d;
  color: white;
}
.post-container {
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 10px;
  max-width: 600px;
  margin: 20px auto;
  background-color: #fff;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
.post-header {
  display: flex;
  align-items: center;
}

.account-image {
  width: 50px;
  height: 50px;
  border-radius: 50%;
}

.account-name {
  margin-left: 10px;
  font-weight: bold;
  color: #333;
}

.post-title {
  margin-top: 10px;
  font-size: 15px;
  color: #333;
}
li p {
  font-size: 15px;
  color: black;
  margin-top: -20px;
}

.post-image {
  height: 300px; /* Set a fixed height */

  width: 100%; /* Ensure images fill their containers */
  object-fit: cover; /* Maintain aspect ratio */
  border-radius: 8px;
  margin-top: 10px;
  cursor: pointer;
}

.more-images-indicator {
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: rgba(0, 0, 0, 0.6);
  color: #fff;
  border-radius: 10px;
  font-size: 1.2em;
  padding: 5px 10px;
  margin-top: 10px;
}

.buy-button {
  background-color: #4caf50;
  border: none;
  color: white;
  padding: 12px 24px;
  font-size: 1em;
  border-radius: 5px;
  transition:
    background 0.3s,
    transform 0.3s;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
  text-align: center;
  display: block;
  margin-top: 20px;
}

.buy-button:hover {
  background-color: #388e3c;
  transform: scale(1.05);
}

.buy-button:active {
  transform: scale(1);
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
}
h6 {
  color: black;
}
/* Mobile */
@media (max-width: 767px) {
  .table thead {
    display: none;
  }

  .table,
  .table tbody,
  .table tr,
  .table td {
    display: block;
  }

  .table tr {
    margin-bottom: 1.5rem;
    border-bottom: 1px solid #dee2e6;
  }

  .table td {
    position: relative;
    /* text-align: right;
        padding-left: 50%; */
  }

  .table td::before {
    content: attr(data-label);
    position: absolute;
    left: 0;
    width: 50%;
    font-weight: bold;
    text-align: left;
  }
}

/* Tablet */
@media (min-width: 768px) and (max-width: 991px) {
  .table {
    font-size: 0.9rem;
  }

  .table td,
  .table th {
    padding: 0.5rem;
  }

  button {
    margin-right: 6px;
  }
}

/* Laptop */
@media (min-width: 992px) {
  .table {
    font-size: 1rem;
  }

  .table td,
  .table th {
    padding: 0.75rem;
  }

  .text-end {
    text-align: right;
  }
}
</style>
