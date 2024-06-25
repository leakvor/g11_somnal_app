<template>
  <NavBar />
  <head>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"
    />
  </head>
  <temnent />
  <div class="header">
    <img
      src="../../../assets/image/homepage.jpeg"
      style="width: 100%; height: 400px; object-fit: cover"
      alt=""
    />
  </div>
  <h1 class="mt-20 color-dark text-center">OUR SERVICE</h1>
  <div class="container mt-10 p-10 d-flex justify-content-evenly">
    <div class="card" style="width: 300px; height: 350px">
      <img src="../../../assets/image/bottle.jpg" class="card-img-top" alt="..."/>
      <div class="card-body">
        <div class="title text-center">
          <h1 class="card-title">ដបទឹក</h1>
          <h5 class="card-text">តម្លៃ: ៣០០៛</h5>
        </div>
        <div class="icon d-flex justify-content-around m-5">
          <a href="#"><i class="bi bi-telephone"></i></a>
          <a href="#"><i class="bi bi-chat-dots"></i></a>
          <a href="#"><i class="bi bi-cart-plus"></i></a>
        </div>
      </div>
    </div>
    <div class="card" style="width: 300px; height: 350px">
      <img src="../../../assets/image/can.jpg" class="card-img-top" alt="..." />
      <div class="card-body">
        
        <div class="title text-center">
          <h1 class="card-title">កំប៉ុង</h1>
          <h5 class="card-text">តម្លៃ: ៤០០០៛</h5>
        </div>
        <div class="icon d-flex justify-content-around m-5">
          <a href="#"><i class="bi bi-telephone"></i></a>
          <a href="#"><i class="bi bi-chat-dots"></i></a>
          <a href="#"><i class="bi bi-cart-plus"></i></a>
        </div>
      </div>
    </div>
    <div class="card" style="width: 300px; height: 350px">
      <img src="../../../assets/image/dump.jpg" class="card-img-top" alt="..." />
      <div class="card-body">
        <div class="title text-center">
          <h1 class="card-title">សំបកកេះ</h1>
          <h5 class="card-text">តម្លៃ: ៥០០៛</h5>
        </div>
        <div class="icon d-flex justify-content-around m-5">
          <a href="#"><i class="bi bi-telephone"></i></a>
          <a href="#"><i class="bi bi-chat-dots"></i></a>
          <a href="#"><i class="bi bi-cart-plus"></i></a>
        </div>
      </div>
    </div>
    <div class="card" style="width: 300px; height: 350px">
      <img src="../../../assets/image/magazin.jpg" class="card-img-top" alt="..." />
      <div class="card-body">
        <div class="title text-center">
          <h1 class="card-title">ទស្សនាវត្តី</h1>
          <h5 class="card-text">តម្លៃ: ៥០០៛</h5>
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
  border-radius:50px;
  background-color:green;
  color:white;
  padding: 10px;
}
i:hover{
  background:orangered;
}
.card img{
  height:45%;
}
.card:hover{
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
</style>
  