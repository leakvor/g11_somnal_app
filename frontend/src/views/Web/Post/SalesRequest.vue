<template>
  <div class="container mt-5">
    <div class="d-flex flex-column justify-content-center" id="firstchild">
      <div class="d-flex justify-content-center text-orange p-3 bg-success rounded-top">
        <h2>View Post</h2>
      </div>
      <div class="search-container m-2 ">
        <div class="input-group  d-flex justify-content-end ">
        <input class="input-text border-none rounded-start" type="search" v-model="searchTerm" placeholder="Search Item..." />
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
            <tr v-for="item in paginatedData" :key="item.id">
              <td>{{ item.id }}</td>
              <td>{{ item.userName }}</td>
              <td>
                <a href="#" @click.prevent="handlePostIdClick(item.postId)">{{ item.postId }}</a>
              </td>
              <td>{{ formatDate(item.date) }}</td>
              <td class="text-end">
                <button
                  v-for="action in item.actions"
                  :key="action"
                  :class="`btn btn-${getButtonClass(action)}`"
                  @click="handleActionClick(item, action)"
                >
                  {{ action }}
                </button>
              </td>
            </tr>
          </tbody>
        </table>
        <div class="pagination  d-flex justify-content-end ">
          <button class="btn btn-success me-2" @click="prevPage" :disabled="currentPage === 1"><i class="bi bi-chevron-left"></i></button>
          <span class="mx-2">{{ currentPage }} / {{ totalPages }}</span>
          <button class="btn btn-success ms-2" @click="nextPage" :disabled="currentPage === totalPages"><i class="bi bi-chevron-right"></i></button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      data: [
        {
          id: "01",
          userName: "Tiv",
          postId: "https://adjay.com",
          date: "2023-05-01",
          actions: ["Buy", "Padding", "Cancel"]
        },
        {
          id: "02",
          userName: "Vouk",
          postId: "https://adjay.com",
          date: "2023-06-15",
          actions: ["Buy", "Padding", "Cancel"]
        },
        {
          id: "03",
          userName: "Thary",
          postId: "https://adjay.com",
          date: "2023-07-20",
          actions: ["Buy", "Padding", "Cancel"]
        },
        {
          id: "04",
          userName: "leak",
          postId: "https://adjay.com",
          date: "2023-08-01",
          actions: ["Buy", "Padding", "Cancel"]
        },
        {
          id: "05",
          userName: "leak",
          postId: "https://adjay.com",
          date: "2023-09-10",
          actions: ["Buy", "Padding", "Cancel"]
        },
        {
          id: "06",
          userName: "leak",
          postId: "https://adjay.com",
          date: "2023-10-15",
          actions: ["Buy", "Padding", "Cancel"]
        }
      ],
      searchTerm: "",
      currentPage: 1,
      itemsPerPage: 5
    };
  },
  computed: {
    filteredData() {
      return this.data.filter(item =>
        item.userName.toLowerCase().includes(this.searchTerm.toLowerCase())
      );
    },
    totalPages() {
      return Math.ceil(this.filteredData.length / this.itemsPerPage);
    },
    paginatedData() {
      const startIndex = (this.currentPage - 1) * this.itemsPerPage;
      const endIndex = startIndex + this.itemsPerPage;
      return this.filteredData.slice(startIndex, endIndex);
    },
    getButtonClass() {
      return (action) => {
        if (action === "Buy") {
          return "success";
        } else if (action === "Padding") {
          return "warning";
        } else if (action === "Cancel") {
          return "danger";
        } else {
          return "secondary";
        }
      };
    }
  },
  methods: {
    deleteRow(index) {
      this.data.splice(index, 1);
      alert("Sure you want to cancel?");
    },
    handlePostIdClick(postId) {
      alert(`View Post ID: ${postId}`);
    },
    handleActionClick(item, action) {
      if (action === "Buy") {
        alert(`Sure you want buy ?: ${item.postId}`);
      } else if (action === "Cancel") {
        const index = this.data.findIndex(i => i.id === item.id);
        this.deleteRow(index);
      } else {
        alert(`Sure you want:  ${item.postId}`);
      }
    },
    formatDate(dateString) {
      const date = new Date(dateString);
      return date.toLocaleDateString();
    },
    prevPage() {
      if (this.currentPage > 1) {
        this.currentPage--;
      }
    },
    nextPage() {
      if (this.currentPage < this.totalPages) {
        this.currentPage++;
      }
    }
  }
};
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