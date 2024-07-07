<template>
  <div>
    <NavBar />
    <div class="container mt-5">
      <div class="d-flex flex-column justify-content-center" id="firstchild">
        <!-- <div class="d-flex justify-content-center text-orange p-3 bg-success rounded-top">
          <h2>View Post</h2>
        </div> -->
        <h2 style="color: black">View Post that have sell!!</h2>
        <div class="search-container m-2">
          <div class="input-group d-flex justify-content-end">
            <input
              class="input-text border-none rounded-start"
              type="search"
              v-model="searchTerm"
              placeholder="Search Item..."
            />
            <button
              class="btn btn-outline-secondary bg-orange text-white border-none"
              type="button"
            >
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
        <div>
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>UserName</th>
                <th>Post-ID</th>
                <th>Date</th>
                <th class="text-center">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(post, index) in paginatedData" :key="post.id">
                <td>{{ (currentPage - 1) * itemsPerPage + index + 1 }}</td>
                <td>{{ post.user.name }}</td>
                <td>
                  <a href="#"
                    ><router-link :to="{ name: 'showPost', params: { id: post.id } }"
                      >Here is link</router-link
                    ></a
                  >
                </td>
                <td>{{ post.date_created }}</td>
                <td class="text-end">
                  <button
                    class="btn btn-success"
                    @click="updatePostStatus(post.id,  'buy')"
                  >
                    Buy
                  </button>
                  <button
                    class="btn btn-danger"
                    @click="updatePostStatus(post.id, 'cancel')"
                  >
                    Cancel
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
            <button
              class="btn btn-success ms-2"
              @click="nextPage"
              :disabled="currentPage === totalPages"
            >
              <i class="bi bi-chevron-right"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import NavBar from '../../../Components/NavBar.vue'
import axios from 'axios'
export default {
  components: {
    NavBar
  },
  data() {
    return {
      posts: [],
      searchTerm: '',
      currentPage: 1,
      itemsPerPage: 5
    }
  },
  computed: {
    filteredData() {
      return this.posts.filter((item) =>
        item.user.name.toLowerCase().includes(this.searchTerm.toLowerCase())
      )
    },
    totalPages() {
      return Math.ceil(this.filteredData.length / this.itemsPerPage)
    },
    paginatedData() {
      const startIndex = (this.currentPage - 1) * this.itemsPerPage
      const endIndex = startIndex + this.itemsPerPage
      return this.filteredData.slice(startIndex, endIndex)
    }
  },
  methods: {
    handleActionClick(item, action) {
      if (action === 'Buy') {
        alert(`Sure you want buy ?: ${item.id}`)
      } else if (action === 'Cancel') {
        const index = this.posts.findIndex((i) => i.id === item.id)
        this.posts.splice(index, 1)
        alert('Post cancelled successfully')
      }
    },
    prevPage() {
      if (this.currentPage > 1) {
        this.currentPage--
      }
    },
    nextPage() {
      if (this.currentPage < this.totalPages) {
        this.currentPage++
      }
    },
    async fecthPostSell() {
      try {
        const token = localStorage.getItem('access_token')
        const response = await axios.get('http://127.0.0.1:8000/api/post/to_company', {
          headers: {
            Authorization: `Bearer ${token}`
          }
        })
        this.posts = response.data.data
        console.log(this.posts)
      } catch (error) {
        console.error(error)
      }
    },
    //update post status
    async updatePostStatus(postId, newStatus) {
  try {
    console.log('New Status:', newStatus);
    console.log('Post ID:', postId);

    const token = localStorage.getItem('access_token');
    if (!token) {
      throw new Error('No access token found');
    }

    const headers = {
      Authorization: `Bearer ${token}`,
      'Content-Type': 'application/json'
    };

    const data = { status: newStatus };

    const response = await axios.post(
      `http://127.0.0.1:8000/api/post/update/status/${postId}`,
      data,
      { headers }
    );

    console.log('Response:', response);

    const message = newStatus === 'cancel' ? 'You have been cancelled this item.' : 'You have been bought this item.';
    alert(message);
  } catch (error) {
    const message = newStatus === 'cancel' ? 'Failed to cancel the item.' : 'Failed to buy the item.';
    alert(message);
    console.error('Error:', error);
  }
}

  },
  mounted() {
    this.fecthPostSell()
  }
}
</script>

<style scoped>
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
