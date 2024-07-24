<template>
  <div class="container mt-5" >
    <h3 class="text-center mb-3" style="color: black">Company have paid.</h3>

    <table class="table table-striped">
      <thead class="table-dark">
        <tr>
          <th>Option Paid</th>
          <th>Amount</th>
          <th>Date Paid</th>
          <th>Date Pay</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="userPayment in paginatedUserPayments" :key="userPayment.id">
          <td>{{ userPayment.option_paid.option_paid }}</td>
          <td>{{ userPayment.option_paid.amount }} $</td>
          <td>{{ userPayment.created_at }}</td>
          <td>{{ userPayment.deadline }}</td>
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
</template>

<script>
import axios from 'axios'
export default {
  data() {
    return {
      userPayments: [],
      currentPage: 1,
      pageSize: 5
    }
  },
  computed: {
    paginatedUserPayments() {
      const start = (this.currentPage - 1) * this.pageSize;
      return this.userPayments.slice(start, start + this.pageSize);
    },
    totalPages() {
      return Math.ceil(this.userPayments.length / this.pageSize);
    }
  },
  methods: {
    async UserPayment() {
      try {
        const token = localStorage.getItem('access_token')
        const response = await axios.get('http://127.0.0.1:8000/api/payment/company', {
          headers: {
            Authorization: `Bearer ${token}`
          }
        })
        this.userPayments = response.data.data
      } catch (error) {
        console.error(error)
      }
    },
    nextPage() {
      if (this.currentPage < this.totalPages) {
        this.currentPage++;
      }
    },
    prevPage() {
      if (this.currentPage > 1) {
        this.currentPage--;
      }
    }
  },
  mounted() {
    this.UserPayment()
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
</style>
