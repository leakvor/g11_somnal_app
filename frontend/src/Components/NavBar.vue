<script setup lang="ts">
import { Icon } from '@iconify/vue'
</script>

<template>
  <header class="sticky top-0 flex justify-between px-10 py-3 bg-green-600 text-white items-center shadow-lg z-50">
    <!-- Logo -->
    <div class="flex items-center space-x-2">
      <img src="../assets/image/logo.png" alt="logo" class="w-10 h-10">
      <span class="text-xl font-bold">SOMNAL</span>
    </div>
    <!-- Menu Items -->
    <nav class="flex justify-center space-x-4">
      <a
        href="/"
        class="font-bold px-3 py-2 text-white rounded-lg hover:bg-orange-400 hover:text-slate-900 no-underline"
        >Home</a
      >
      <a
        href="/service"
        class="font-bold px-3 py-2 text-white rounded-lg hover:bg-orange-400 hover:text-slate-900 no-underline"
        >Service</a
      >
      <a
        href="/about"
        class="font-bold px-3 py-2 text-white rounded-lg hover:bg-orange-400 hover:text-slate-900 no-underline"
        >About Us</a
      >
      <a
        href="/projects"
        class="font-bold px-3 py-2 text-white rounded-lg hover:bg-orange-400 hover:text-slate-900 no-underline"
        >Contact Us</a
      >
    </nav>

    <!-- Sign In -->
    <div>
      <div class="px-4 py-2 rounded font-semibold">Sign In</div>
    </div>
  </header>
</template>

<style scoped>
.header {
  position: sticky;
  top: 0;
  z-index: 50;
}
</style>
