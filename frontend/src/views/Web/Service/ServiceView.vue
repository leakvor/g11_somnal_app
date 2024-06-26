<script setup lang="ts">
// import { Icon } from '@iconify/vue';
import NavBar from '@/Components/NavBar.vue';
import Footer from '@/Components/Footer.vue';
import { ref, onMounted, onUnmounted } from 'vue';

const currentSlide = ref(0);
const totalSlides = 3;
let slideInterval;

const goToSlide = (index) => {
  currentSlide.value = index;
  const slider = document.querySelector('.slider');
  slider.style.transform = `translateX(-${index * 100}%)`;
};

const prevSlide = () => {
  if (currentSlide.value > 0) {
    goToSlide(currentSlide.value - 1);
  } else {
    goToSlide(totalSlides - 1);
  }
};

const nextSlide = () => {
  if (currentSlide.value < totalSlides - 1) {
    goToSlide(currentSlide.value + 1);
  } else {
    goToSlide(0);
  }
};

const startAutoSlide = () => {
  slideInterval = setInterval(nextSlide, 3000); 
};

onMounted(() => {
  startAutoSlide();
});

</script>

<template>
  <NavBar />
  <div class="slider-wrapper relative w-full overflow-hidden">
    <div class="slider flex transition-transform duration-700 ease-in-out">
      <img id="slide-1" src="https://i.pinimg.com/564x/28/9c/4a/289c4a3e478d09fca23eeb7b918f121f.jpg" alt="Slide 1" class="w-full">
      <img id="slide-2" src="https://i.pinimg.com/236x/84/bc/81/84bc81cc809e06d27862c2c09d783837.jpg" alt="Slide 2" class="w-full">
      <img id="slide-3" src="https://i.pinimg.com/564x/28/9c/4a/289c4a3e478d09fca23eeb7b918f121f.jpg" alt="Slide 3" class="w-full">
    </div>
    <div class="slider-nav absolute inset-x-0 bottom-0 flex justify-center space-x-2 mb-4">
      <button @click="goToSlide(0)" class="w-3 h-3 rounded-full bg-gray-300" :class="{'bg-gray-600': currentSlide == 0}"></button>
      <button @click="goToSlide(1)" class="w-3 h-3 rounded-full bg-gray-300" :class="{'bg-gray-600': currentSlide == 1}"></button>
      <button @click="goToSlide(2)" class="w-3 h-3 rounded-full bg-gray-300" :class="{'bg-gray-600': currentSlide == 2}"></button>
    </div>
    <button @click="prevSlide" class="absolute top-1/2 left-4 transform -translate-y-1/2 p-2 bg-gray-800 text-white rounded-full">&lt;</button>
    <button @click="nextSlide" class="absolute top-1/2 right-4 transform -translate-y-1/2 p-2 bg-gray-800 text-white rounded-full">&gt;</button>
  </div>

  <!-- Services Section -->
  <div class="container shadow-lg bg-white-100 p-10">
    <div class="p-10 text-center color-dark">
      <h1 class="text-center">Our Services</h1>
      <p>Use our services to make it easier for customers to sell products.</p>
    </div>
    <div class="card-service d-flex mt-5 justify-content-between gap-5">
      <div class="card" style="width:700px; height:700px;">
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
      <div class="card" style="width:700px;height:700px;">
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
  </div>
  <Footer class="mt-5"/>
</template>

<style>
.slider {
  width: 100%;
}

.slider img {
  width: 100%;
}
</style>
