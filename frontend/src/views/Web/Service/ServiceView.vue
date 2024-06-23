<template>
  <NavComponent />
  <div class="header">
    <img
      src="../../../assets/image/bin.png"
      style="width: 100%; height: 400px; object-fit: cover"
      alt=""
    />
  </div>
  <div class="container mt-5 d-flex justify-content-between gap-5">
    <div class="card" style="width: 600px; height: 550px">
      <img src="../../../assets/image/wastindutry.png" class="card-img-top" alt="..." />
      <div class="card-body">
        <h5 class="card-title">Adjay</h5>
        <p class="card-text">
          we buy the product that who stop to use to help to clean invironment
        </p>
        <a href="/adjay" class="btn btn-primary">show more</a>
      </div>
    </div>
    <div class="card" style="width: 600px; height: 550px">
        <img src="../../../assets/image/draip.png" class="card-img-top" alt="..." />
        <div class="card-body">
        <h5 class="card-title">Drain</h5>
        <p class="card-text">
          We have many service to help who are have problem in daily life
        </p>
        <a href="/drain" class="btn btn-primary">Show more</a>
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
</style>