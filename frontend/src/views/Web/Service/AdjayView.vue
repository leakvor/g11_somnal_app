<template>
  <NavComponent />
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
  <div class="container mt-20 d-flex justify-content-between gap-5 pb-30">
    <div class="card" style="width: 400px; height: 400px">
      <img src="../../../assets/image/bottle.jpg" class="card-img-top" alt="..." style="width:279px; height: 200px"/>
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
    <div class="card" style="width: 400px; height: 400px">
      <img src="../../../assets/image/can.jpg" class="card-img-top" alt="..." style="width:279px; height: 200px"/>
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
    <div class="card" style="width: 400px; height: 400px">
      <img src="../../../assets/image/dump.jpg" class="card-img-top" alt="..." style="width:279px; height: 200px"/>
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
    <div class="card" style="width: 400px; height: 400px">
      <img src="../../../assets/image/magazin.jpg" class="card-img-top" alt="..." style="width:279px; height: 200px"/>
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
</template>
  
  <script>
import NavComponent from '@/Components/NavComponent.vue'

export default {
  components: {
    NavComponent
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
  background:orange;
}
</style>
  