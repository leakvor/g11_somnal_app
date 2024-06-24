<template>
  <head>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  </head>
  <div class="container m-5">
    <div class="card">
      <div class="header-card d-flex justify-content-between p-4">
        <div class="profile d-flex gap-2">
          <img
            src="../../../assets/image/profile.png"
            alt="pf"
            class="rounded-circle profile-image"
            style="width: 40px; height: 40px"
          />
          <h6 class="mt-2">name</h6>
        </div>
        <div class="menu">
          <i class="bx bx-dots-horizontal-rounded" style="font-size: 30px"></i>
        </div>
      </div>
      <div class="card-body">
        <p class="card-text">post description</p>
      </div>
      <div class="img-post">
        <img src="../../../assets//image/kitchen.jpg" alt="" style="width: 100%" />
      </div>
        <div class="total-comment-like d-flex justify-content-between p-3">
          <p class="like">0</p>
          <p class="comment">0comment</p>
        </div>
        <div class="footer-icon border-top border-bottom d-flex justify-content-between p-4 ">
          <i class="bx bx-like" style="font-size: 25px; color:blue; text-align:center;">Like</i>
          <i class='bx bx-comment-dots' style="font-size: 25px; color:blue;">Comment</i>
          <i class="bx bx-phone-call" style="font-size: 25px; color:blue; text-align:center;">Contact</i>
        </div>
    </div>
  </div>
</template>

<script>
export default {}
</script>

<style>
</style>