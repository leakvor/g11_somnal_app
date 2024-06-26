<template>
  <div>
    <NavBar />
    <head>
      <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    </head>
    <div class="container p-10 mt-5">
      <button
        type="button"
        class="py-3 px-4 inline-flex items-center bg-orange-600 hover:bg-green-600 mb-3 color-white gap-x-2 text-sm font-semibold rounded-lg border border-transparent"
        @click="showModal = true"
      >
        Add Post
      </button>
      <div class="card" style="margin: auto">
        <div class="header-card d-flex justify-content-between p-3 bg-gray-50">
          <div class="profile d-flex gap-3">
            <img
              src="../../../assets/image/profile.png"
              alt="pf"
              class="rounded-circle profile-image ml-5 mr-5 w-13 h-13"
            />
            <div class="text-container d-flex flex-column align-items-center mt-2">
              <h5 class="m-0">name</h5>
              <p class="m-0">Date</p>
            </div>
          </div>
          <i
            @click="toggleDropdown"
            class="bx bx-dots-horizontal-rounded mr-5 mt-2"
            style="font-size: 30px"
          ></i>
          <div
            v-if="showDropdown"
            class="absolute mt-5 right-0 bg-white rounded-lg py-2 mt-2 shadow-lg w-40"
          >
            <a 
              href="/update_post"
              class="block px-4 py-2 hover:bg-orange-600 hover:text-white flex items-center space-x-2"
            >
              <i class="fas fa-user"></i>
              <span>Edit</span>
            </a>
            <a
              href="#"
              class="block px-4 py-2 hover:bg-orange-600 hover:text-white flex items-center space-x-2"
            >
              <i class="bx bx-trash"></i>
              <span>Delete</span>
            </a>
          </div>
        </div>
        <p class="card-text p-3 mr-5 ml-5">post description</p>
        <div class="body">
          <img
            src="../../../assets//image/kitchen.jpg"
            alt=""
            style="width: 100%; height: 500px; object-fit: cover"
          />
          <div
            class="total-comment-like d-flex align-items-center justify-content-between mr-5 ml-5 p-3"
          >
            <p class="like m-0">0 Likes</p>
            <p class="comment m-0">0 comment</p>
          </div>
        </div>
        <div
          class="footer-icon border-top bg-gray-50 border-bottom d-flex justify-content-between p-4 text-center"
        >
          <i class="bx bx-like d-flex gap-2 align-items-center" style="font-size: 20px">
            <span>Like</span>
          </i>
          <i class="bx bx-comment-dots d-flex gap-2 align-items-center" style="font-size: 20px">
            <span>Comment</span>
          </i>
          <i class="bx bx-phone-call d-flex gap-2 align-items-center" style="font-size: 20px">
            <span>Contact</span>
          </i>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, onMounted, onBeforeUnmount } from 'vue'
import NavBar from '../../../Components/NavBar.vue'

export default {
  components: {
    NavBar
  },
  setup() {
    const showDropdown = ref(false)

    const toggleDropdown = () => {
      showDropdown.value = !showDropdown.value
    }

    const handleClickOutside = (event) => {
      if (showDropdown.value && !event.target.closest('.header-card')) {
        showDropdown.value = false
      }
    }

    onMounted(() => {
      document.addEventListener('click', handleClickOutside)
    })

    onBeforeUnmount(() => {
      document.removeEventListener('click', handleClickOutside)
    })

    return {
      showDropdown,
      toggleDropdown
    }
  }
}
</script>

<style>
/* .absolute {
    position: absolute;
  } */
</style>
