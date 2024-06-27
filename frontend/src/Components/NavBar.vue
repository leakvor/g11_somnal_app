<template>
  <header class="sticky top-0 flex justify-between px-10 py-3 bg-green-600 text-white items-center shadow-lg z-50">
    <!-- Logo -->
    <div class="flex items-center space-x-2">
      <img src="../assets/image/logo.png" alt="logo" class="w-10 h-10">
      <span class="text-xl font-bold">SOMNAL</span>
    </div>
    <!-- Menu Items -->
    <nav class="flex justify-center space-x-4">
      <router-link to="/" class="font-bold px-3 py-2 text-white rounded-lg hover:bg-orange-400 hover:text-slate-900 no-underline">Home</router-link>
      <router-link to="/service" class="font-bold px-3 py-2 text-white rounded-lg hover:bg-orange-400 hover:text-slate-900 no-underline">Service</router-link>
      <router-link to="/about" class="font-bold px-3 py-2 text-white rounded-lg hover:bg-orange-400 hover:text-slate-900 no-underline">About Us</router-link>
      <router-link  to="/profile" class="font-bold px-3 py-2 text-white rounded-lg hover:bg-orange-400 hover:text-slate-900 no-underline">Profile</router-link>
      <router-link to="/contact" class="font-bold px-3 py-2 text-white rounded-lg hover:bg-orange-400 hover:text-slate-900 no-underline">Contact Us</router-link>
    </nav>

    <!-- Sign In / Profile Link -->
    <div>
      <router-link to="/login" class="px-4 py-2 rounded font-semibold">Login</router-link>
      <button  class="px-4 py-2 rounded font-semibold">Logout</button>
    </div>

  </header>
</template>

<script setup lang="ts">
import { useAuthStore } from '../stores/auth-store';
import { useRouter } from 'vue-router';

const authStore = useAuthStore();
const router = useRouter();

const handleLogout = () => {
  console.log(1);
  authStore.logout(); 
  router.push('/'); 
};
</script>

<style scoped>
 button{
  background-color: transparent;
  border: none;
  color: #fff;
 }
</style>
