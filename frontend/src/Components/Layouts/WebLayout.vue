<script setup lang="ts">
import NavBar from '@/Components/NavBar.vue'
</script>
<template>
  <NavBar />
  <div class="md:px-50 h-full">
    <div class="h-full">
      <slot/>
    </div>
  </div>
</template>

<script setup lang="ts"></script>
