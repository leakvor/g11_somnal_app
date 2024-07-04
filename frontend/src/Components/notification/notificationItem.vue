<template>
  <div class="relative">
    <div class="flex items-center p-4 bg-white rounded-lg shadow-md">
      <div class="w-12 h-12 rounded-full overflow-hidden mr-4">
        <img :src="notification.avatar" class="w-full h-full object-cover" alt="Avatar">
      </div>
      <div class="flex-grow">
        <div class="flex items-end space-x-2">
          <NotificationIcon :type="notification.icon" />
          <div>
            <p class="text-sm font-medium">{{ notification.message }}</p>
            <p class="text-xs text-gray-500">{{ notification.time }}</p>
          </div>
        </div>
      </div>
      <button @click="toggleDropdown"
        class="inline-flex items-center justify-center p-2 text-sm font-medium text-gray-500 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 bord-white">
        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
          viewBox="0 0 16 3">
          <path
            d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
        </svg>
      </button>
    </div>
    <!-- Dropdown Menu -->
    <!-- <div v-if="showDropdown" class="absolute right-0 mt-2 w-36 bg-yellow-200 rounded-lg shadow-lg">
      <ul class="py-1 text-sm text-gray-700">
        <li>
          <a href="#" @click="handleDelete" class="block px-4 py-2 hover:bg-yellow-300">Delete</a>
        </li>
        <li>
          <a href="#" @click="handleReport" class="block px-4 py-2 hover:bg-yellow-300">Report</a>
        </li>
      </ul>
    </div> -->
  </div>
</template>

<script setup>
import { defineProps, ref } from 'vue';
import NotificationIcon from './notificationIcon.vue';

const props = defineProps({
  notification: {
    type: Object,
    required: true
  }
});

const showDropdown = ref(false);

const toggleDropdown = () => {
  showDropdown.value = !showDropdown.value;
};

const handleDelete = () => {
  console.log('Delete action triggered');
  showDropdown.value = false;
};

const handleReport = () => {
  console.log('Report action triggered');
  showDropdown.value = false;
};
</script>

<style scoped></style>
