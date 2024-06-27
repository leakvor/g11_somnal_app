<script setup lang="ts">
import { Icon } from '@iconify/vue'
</script>
<template>
  <header class="flex justify-between px-50 py-3 bg-white items-center">
    <!-- Logo -->
    <div class="flex items-center space-x-2">
      <Icon icon="skill-icons:devto-dark" style="font-size: 45px" />
      <span class="text-xl font-bold">I-KNOW</span>
    </div>

    <!-- Menu Items -->
    <nav class="flex justify-center space-x-4">
      <a
        href="/home"
        class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900"
        >Home</a
      >
      <a
        href="/about"
        class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900"
        >About Us</a
      >
      <a
        href="/contactus"
        class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900"
        >Contact Us</a
      >
      <a
        href="/partners"
        class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900"
        >Partner</a
      >
      <router-link to="/chat" class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900">Chat</router-link>
      <router-link to="/company" class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900">Company</router-link>
    </nav>

    <!-- Sign In -->
    <div>
      <div class="px-4 py-2 rounded font-semibold">Sign In</div>
    </div>
  </header>
</template>
