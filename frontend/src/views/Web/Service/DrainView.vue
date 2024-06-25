<template>
  <NavBar />
  <head>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"
    />
  </head>
  <div class="header">
    <div class="image-header">
      <img
        src="../../../assets/image/drainpage.jpg"
        alt=""
        style="width: 100%; height: 400px; object-fit: cover"
      />
      <!-- <h2>We are helpful for who are have problem in daily to living in confortable</h2> -->
    </div>
    <h1 class="mt-20 color-dark text-center">OUR SERVICE</h1>
  </div>
  <div class="container mt-10 p-10 d-flex justify-content-evenly">
    <div class="card" style="width: 400px; height: 450px">
      <img src="../../../assets/image/kitchen.jpg" class="card-img-top" alt="..." />
      <div class="card-body">
        <div class="title text-center">
          <h1 class="card-title">ជួសជុលផ្ទះបាយ</h1>
          <h5 class="card-text">តម្លៃ:100$</h5>
        </div>
        <div class="icon d-flex justify-content-around m-5">
          <a href="#"><i class="bi bi-telephone"></i></a>
          <a href="#"><i class="bi bi-chat-dots"></i></a>
          <a href="#"><i class="bi bi-cart-plus"></i></a>
        </div>
      </div>
    </div>
    <div class="card" style="width: 400px; height: 450px">
      <img src="../../../assets/image/bathroom.jpg" class="card-img-top" alt="..." />
      <div class="card-body">
        <div class="title text-center">
          <h1 class="card-title">ជួសជុលបន្ទប់ទឹក</h1>
          <h5 class="card-text">តម្លៃ:200$</h5>
        </div>
        <div class="icon d-flex justify-content-around m-5">
          <a href="#"><i class="bi bi-telephone"></i></a>
          <a href="#"><i class="bi bi-chat-dots"></i></a>
          <a href="#"><i class="bi bi-cart-plus"></i></a>
        </div>
      </div>
    </div>
    <div class="card" style="width: 400px; height: 450px">
      <img src="../../../assets/image/drain.jpg" class="card-img-top" alt="..." />
      <div class="card-body">
        <div class="title text-center">
          <h1 class="card-title">បូមលូ</h1>
          <h5 class="card-text">តម្លៃ:៣00$</h5>
        </div>
        <div class="icon d-flex justify-content-around m-5">
          <a href="#"><i class="bi bi-telephone"></i></a>
          <a href="#"><i class="bi bi-chat-dots"></i></a>
          <a href="#"><i class="bi bi-cart-plus"></i></a>
        </div>
      </div>
    </div>
  </div>
  <a
    href="/service"
    class="bg-green-600 text-white font-bold py-2 px-4 rounded hover:bg-orange-600 no-underline ml-25"
    >Back</a
  >
  <Footer class="mt-5" />
</template>

<script>
import NavBar from '@/Components/NavBar.vue'
import Footer from '@/Components/Footer.vue'

export default {
  components: {
    NavBar,
    Footer
  }
}
</script>

<style>
i {
  border-radius: 50px;
  background-color: green;
  color: white;
  padding: 10px;
}
i:hover {
  background:orangered;
}
</style>
