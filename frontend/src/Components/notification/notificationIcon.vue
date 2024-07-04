<template>
  <div class="flex items-center space-x-4">
    <!-- First set of icons -->
    <!-- <div class="first-icon">
      <svg v-if="type === 'comment'" class="w-6 h-6 text-green-500" fill="currentColor" viewBox="0 0 20 20">
        <path
          d="M18 10c0 3.866-3.582 7-8 7-1.528 0-2.94-.347-4.168-.952L2 18l1.352-3.784C2.57 13.1 2 11.604 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7z" />
      </svg>
      <svg v-if="type === 'group'" class="w-6 h-6 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
        <path
          d="M10 10a3 3 0 110-6 3 3 0 010 6zm-7 8a7 7 0 0114 0H3zm4-9a2 2 0 104 0 2 2 0 00-4 0zm9 5a3 3 0 100-6 3 3 0 000 6zm2 2a6 6 0 00-9 5 6 6 0 009-5z" />
      </svg>
      <svg v-if="type === 'cake'" class="w-6 h-6 text-pink-500" fill="currentColor" viewBox="0 0 20 20">
        <path d="M4 5a2 2 0 114 0h6a2 2 0 114 0v1H4V5zM2 10h16v6a2 2 0 01-2 2H4a2 2 0 01-2-2v-6z" />
      </svg>
      <svg v-if="type === 'thumb_up'" class="w-6 h-6 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
        <path
          d="M2 10c0 1.1.9 2 2 2h1v6a2 2 0 002 2h7a2 2 0 001.995-1.85L16 18V8a2 2 0 00-2-2H9a1 1 0 01-.117-1.993L9 4a1 1 0 00-1-1H6c-1.1 0-2 .9-2 2v5zm10 8h-5v-6h5v6zm-6-8h1V5a1 1 0 011-1h1V3H6v7z" />
      </svg>
    </div> -->
    
    <!-- Last icon -->
    <!-- <div class="last-icon ">
      <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
        height="24" fill="none" viewBox="0 0 24 24">
        <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M6 12h.01m6 0h.01m5.99 0h.01" />
      </svg>
    </div> -->
  </div>
</template>

<script setup>
import { defineProps } from 'vue';

const props = defineProps({
  type: {
    type: String,
    required: true
  }
});
</script>

<style scoped>
/* Add scoped styles if needed */
</style>
