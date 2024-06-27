<template>
  <NavBar/>
  <div class=" ml-12 mb-4 mt-5">
    <p class="fs-4 fw-bold color-dark">List Post</p>
    <a href="/post_create" class="px-4 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 no-underline">
        Create Post
    </a>
    
  </div>
  <div class="container mt-4 p-4 bg-white shadow rounded">
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <!-- <tr>
            <th scope="row"></th>
            <td></td>
            <td></td>
          </tr> -->
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import NavBar from '../../../Components/NavBar.vue'

export default {
  components: {
    NavBar
  },
  
}
</script>
