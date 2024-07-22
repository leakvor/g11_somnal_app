<template>
  <NavBar />
  <div class="container mt-5">
    <h3 class="text-center mb-3">History of company</h3>
    <div class="header d-flex gap-5">
      <button type="button" class="btn btn-success w-40 h-10 mt-3">
         <a href="/company/payment" style="text-decoration: none; color: white;">Company Paid</a>
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
          <th>Post ID</th>
          <th>User ID</th>
          <th>Date</th>                   
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="history in filteredPosts" :key="history.id">
          <td>{{ history.id }}</td>
            <td>{{ history.user.id }}</td>
            <td>{{ new Date(history.created_at).toLocaleDateString() }}</td>
            <td>{{ history.status }}</td>
          <td>
            <button class="w-20 bg-green-500 hover:bg-orange-600 text-white p-2 rounded border-0">
                <i class="fas fa-eye"></i>
              </button>  
          </td>
        </tr>
      </tbody>
    </table>
   
  </div>
  <Footer class="mt-5"/>
</template>
<script>
import NavBar from '@/Components/NavBar.vue'
import Footer from '@/Components/Footer.vue'
import axios from 'axios';
export default {
  components: {
    NavBar,
    Footer
  },
  data() {
    return {
      searchInput: '',
      posts: [],
      userPayments:[],
    }
  },
  computed: {
    filteredPosts() {
      return this.posts.filter(post =>
        post.id.toString().includes(this.searchInput)
      );
    }
  },
  methods: { 
    async getHistory(){
      try {
        const token = localStorage.getItem('access_token')
        const response = await axios.get('http://127.0.0.1:8000/api/post/company/history', {
          headers: {
            Authorization: `Bearer ${token}`
          }
        })
        this.posts = response.data.data
        console.log('coma',this.posts)
      } catch (error) {
        console.error(error)
      }
  },

  },
  mounted(){
    this.getHistory();
  }
}
</script>
  
  <style>
</style>