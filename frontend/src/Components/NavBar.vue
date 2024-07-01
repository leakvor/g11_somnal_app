<template>
  <header class="flex justify-between px-10 py-3 bg-green-600 items-center">
    <!-- Logo -->
    <div class="flex items-center space-x-2">
      <img src="../assets/image/logo.png" alt="logo" class="w-10 h-10" />
      <span class="text-xl font-bold">SOMNAL</span>
    </div>
    <!-- Menu Items -->
    <nav class="flex justify-center space-x-4">
      <router-link to="/homeview" class="font-bold px-3 py-2 text-white rounded-lg hover:bg-orange-400 hover:text-slate-900 no-underline">Home</router-link>
      <router-link to="/category" class="font-bold px-3 py-2 text-white rounded-lg hover:bg-orange-400 hover:text-slate-900 no-underline">Service</router-link>
      <router-link to="/about" class="font-bold px-3 py-2 text-white rounded-lg hover:bg-orange-400 hover:text-slate-900 no-underline">About Us</router-link>
      <router-link to="/contact" class="font-bold px-3 py-2 text-white rounded-lg hover:bg-orange-400 hover:text-slate-900 no-underline">Contact Us</router-link>
      <router-link v-if="authStore.isAuthenticated" to="/profile" class="flex items-center space-x-2 font-bold px-3 py-2 text-white rounded-lg hover:bg-orange-400 hover:text-slate-900 no-underline">
        <img v-if="authStore.user?.profile" :src="`${backendUrl}/uploads/${authStore.user?.profile}`" alt="Profile" class="w-8 h-8 rounded-full hover:bg-orange-400 hover:text-slate-900 no-underline">
        <span>{{ authStore.user?.name }}</span>
      </router-link>
      <router-link v-else to="/login" class="font-bold px-3 py-2 text-white rounded-lg hover:bg-orange-400 hover:text-slate-900 no-underline">Login</router-link>
      <button v-if="authStore.isAuthenticated" @click="authStore.logout()" class="font-bold px-3 py-2 text-white rounded-lg hover:bg-orange-400 hover:text-slate-900 no-underline">Logout</button>
    </nav>
  </header>
</template>

<script setup lang="ts">
import { onMounted } from 'vue';
import { useAuthStore } from '../stores/auth-store';

const authStore = useAuthStore();
const backendUrl = 'http://127.0.0.1:8000'; // Replace with your backend URL

onMounted(() => {
  authStore.loadUserFromCookie();
});
</script>

<style scoped>
button {
  background-color: transparent;
  border: none;
  color: #fff;
}
</style>
