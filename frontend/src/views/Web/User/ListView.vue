<template>
  <head>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  </head>
  <div class="container p-10">
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
        <i class="bx bx-dots-horizontal-rounded mr-5 mt-2" style="font-size: 30px"></i>
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
</template>

<script>
export default {}
</script>

<style></style>
