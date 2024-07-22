<template>
  <NavBar />
  <div class="container mt-5">
    <h3 class="text-center mb-3">Company have paid</h3>
    <div class="header d-flex gap-5">
      <button type="button" class="btn btn-success w-40 h-10 mt-3">
        <a href="/history" style="text-decoration: none; color: white">History</a>
      </button>
      <div class="input-group mt-3 mb-5">
        <input
          type="search"
          class="form-control"
          id="search-btn"
          name="search"
          placeholder="Search category"
          v-model="searchInput"
        />
        <button type="button" class="btn btn-success">
          <i class="fas fa-search"></i>
        </button>
      </div>
    </div>

    <table class="table table-striped">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Option Paid</th>
          <th>Amount</th>
          <th>Date Paid</th>
          <th>Date Pay</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="userPayment in userPayments" :key="userPayment.id">
          <td>{{ userPayment.id }}</td>
          <td>{{ userPayment.user.name }}</td>
          <td>{{ userPayment.option_paid.option_paid }}</td>
          <td>{{ userPayment.option_paid.amount }}</td>
          <td>{{ userPayment.created_at }}</td>
        </tr>
      </tbody>
    </table>
  </div>
  <Footer class="mt-5" />
</template>
  <script>
import NavBar from '@/Components/NavBar.vue'
import Footer from '@/Components/Footer.vue'
import axios from 'axios'
export default {
  components: {
    NavBar,
    Footer
  },
  data() {
    return {
      userPayments: []
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
        console.log(this.userPayments)
      } catch (error) {
        console.error(error)
      }
    }
  },
  mounted() {
    this.UserPayment()
  }
}
</script>
    
    <style>
</style>