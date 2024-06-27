<template>
  <head>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
  />
</head>

  <header class="flex justify-between px-10 py-3 bg-green-600 items-center">
    <!-- Logo -->
    <div class="flex items-center space-x-2">
      <img src="../assets/image/logo.png" alt="logo" class="w-10 h-10" />
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
      <a
        href="/list_post"
        class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-orange-400 hover:text-slate-900 color-white no-underline"
        >post</a
      >
    </nav>

    <!-- Sign In -->
    <div class="relative">
      <a
        href="#" class="font-bold px-3 py-2 mr-4 text-slate-700 rounded-lg hover:bg-orange-400 hover:text-slate-900 color-white no-underline">
        Sign In
      </a>
      <div class="relative inline-block">
        <img
          src="../assets/image/logo.png"
          alt="logo"
          class="w-10 h-10 cursor-pointer"
          @click="toggleDropdown"
        />
        <div
          v-if="showDropdown"
          class="absolute right-0 bg-white rounded-lg py-2 mt-2 shadow-lg w-40"
        >
        <a href="/profile" class="block px-4 py-2 hover:bg-orange-600 hover:color-white flex items-center space-x-2">
          <i class="fas fa-user"></i>
          <span>View Profile</span>
        </a>
        <a href="#" class="block px-4 py-2 hover:bg-orange-600 hover:color-white flex items-center space-x-2">
          <i class="fas fa-edit"></i>
          <span>Edit Profile</span>
        </a>
          <a href="#" class="block px-4 py-2 hover:bg-orange-600 hover:color-white flex items-center space-x-2">
            <i class='bx bx-log-in-circle'></i>
            <span>Logout</span>
          </a>
        </div>
      </div>
    </div>
  </header>
</template>

<script setup lang="ts">
import { ref, onMounted, onBeforeUnmount } from 'vue';

const showDropdown = ref(false);

const toggleDropdown = () => {
  showDropdown.value = !showDropdown.value;
};

const handleClickOutside = (event: MouseEvent) => {
  if (showDropdown.value && !(event.target as HTMLElement).closest('.relative')) {
    showDropdown.value = false;
  }
};

onMounted(() => {
  document.addEventListener('click', handleClickOutside);
});

onBeforeUnmount(() => {
  document.removeEventListener('click', handleClickOutside);
});
</script>

<style scoped>
/* Add any additional styling here if needed */
</style>
