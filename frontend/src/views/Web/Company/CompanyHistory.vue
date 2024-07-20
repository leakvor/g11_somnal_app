<template>
  <NavBar />
  <div class="container mt-5">
    <h3 class="text-center mb-3">Company Information</h3>
    <div class="input-group mt-3 mb-5">
      <button
        class="dropdown-toggle btn btn-success"
        data-bs-toggle="dropdown"
        aria-expanded="false"
        id="dropdown-category"
        style="border: none"
      >
        <span>All</span>
      </button>
      <ul class="dropdown-menu" aria-labelledby="dropdown-category">
        <li>
          <router-link class="link font-bold py-2 px-4 no-underline text-center"
            >company</router-link
          >
        </li>
      </ul>
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
    <table class="table table-striped">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>User ID</th>
          <th>Post ID</th>
          <th>Date</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="history in  histories" :key="history.id">
        <!-- <tr> -->
          <td>{{ history.id }}</td>
            <td>{{ history.user_id }}</td>
            <td>{{ history.post_id }}</td>
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
</template>
<script>
import NavBar from '@/Components/NavBar.vue'
import axios from 'axios';
export default {
  components: {
    NavBar
  },
  data() {
    return {
      searchInput: '',
      histories: []
    }
  },
  methods: { 
      async getHistory() {
      try {
        const response = await axios.get("http://127.0.0.1:8000/api/post/company/history", {
          headers: {
            'Authorization': `Bearer ${this.token}`
          }
        });
        this.histories = response.data.data;
        console.log('this.histories', this.histories);
      } catch (error) {
        console.error(error);
      }
    }
    // async getHistory(){
    //   try {
    //     const response = await axios.get("http://127.0.0.1:8000/api/post/company/history");
    //     this.histories = response.data.data;
    //     console.log('this.histories');   
    //   } catch (error) {
    //     console.error(error);
    //   }
     
    // },
  },
  mounted(){
    this.getHistory();
  }
}
</script>
  
  <style>
</style>