<script setup lang="ts">
import { Icon } from '@iconify/vue';
import NavBar from '@/Components/NavBar.vue';
import Footer from '@/Components/Footer.vue';
</script>

<template>
  <NavBar />
  <!-- <div class="slider-wrapper">
    <div class="slider">
      <img id="slide-1" src="https://i.pinimg.com/564x/28/9c/4a/289c4a3e478d09fca23eeb7b918f121f.jpg" alt="">
      <img id="slide-2" src="https://i.pinimg.com/236x/84/bc/81/84bc81cc809e06d27862c2c09d783837.jpg" alt="">
      <img id="slide-3" src="https://i.pinimg.com/564x/28/9c/4a/289c4a3e478d09fca23eeb7b918f121f.jpg" alt="">
    </div>
    <div class="slider-nav">
      <a href=""></a>
      <a href=""></a>
      <a href=""></a>
    </div>

  </div> -->


  <!-- Services Section -->
  <div class="p-10 text-center shadow-lg bg-white-100">
    <h1 class="text-center">Our Services</h1>
    <p>Use our services to make it easier for customers to sell products.</p>
  </div>

  <div class="container d-flex mt-5 justify-content-between gap-5">
    <div class="card" style="width: 500px; height: 500px;">
      <img src="../../../assets/image/wastindutry.png" class="card-img-top" alt="Waste Industry" />
      <div class="card-body">
        <h5 class="card-title">Adjay</h5>
        <p class="card-text">
          We buy products that people stop using to help clean the environment.
        </p>
        <a
          href="/adjay"
          class="bg-green-600 text-white font-bold py-2 px-4 rounded hover:bg-orange-600 no-underline"
        >Show more</a>
      </div>
    </div>
    <div class="card" style="width: 500px; height: 500px;">
      <img src="../../../assets/image/draip.png" class="card-img-top" alt="Drain" />
      <div class="card-body">
        <h5 class="card-title">Drain</h5>
        <p class="card-text">
          We offer many services to help those who face daily problems.
        </p>
        <a
          href="/drain"
          class="bg-green-600 text-white font-bold py-2 px-4 rounded hover:bg-orange-600 no-underline"
        >Show more</a>
      </div>
    </div>
  </div>
  <Footer class="mt-5"/>
</template>

<style>
/* Add any necessary styles here */
</style>
