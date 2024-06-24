<script setup lang="ts">
import { Icon } from '@iconify/vue'
</script>
<template>
  <header class="flex justify-between px-10 py-3 bg-green-600 color-white items-center">
    <!-- Logo -->
    <div class="flex items-center space-x-2">
      <!-- <Icon icon="skill-icons:devto-dark" style="font-size: 45px" /> -->

      <img src="../assets/image/logo.png" alt="logo"  class="w-10 h-10">
      <span class="text-xl font-bold">SOMNAL</span>
    </div>
    <!-- Menu Items -->
    <nav class="flex justify-center space-x-4">
      <a
        href="/"
        class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-orange-400 hover:text-slate-900 color-white no-underline"
        >Home</a
      >
      <a
        href="/service"
        class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-orange-400 hover:text-slate-900 color-white no-underline"
        >Service</a
      >
      <a
        href="/team"
        class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-orange-400 hover:text-slate-900 color-white no-underline"
        >About Us</a
      >
      <a
        href="/projects"
        class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-orange-400 hover:text-slate-900 color-white no-underline"
        >Contact Us</a
      >
      <!-- <a
        href="/post"
        class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-orange-400 hover:text-slate-900 color-white"
        >post</a
      > -->
   
    </nav>

    <!-- Sign In -->
    <div>
      <div class="px-4 py-2 rounded font-semibold">Sign In</div>
    </div>
  </header>
</template>
