<template>
  <div class="space-y-4">
    <div class="flex items-center p-4 bg-white rounded-lg shadow-md">
      <!-- Notification content -->
      <div class="flex-grow">
        <div class="flex items-end space-x-2">
          <div class="flex items-center mt-3 hover:bg-gray-100 rounded-lg px-1 py-1 cursor-pointer">
            <div class="flex flex-shrink-0 items-end">
              <img class="h-16 w-16 rounded-full" src="" alt="Avatar">
              <img class="w-6 h-6 -ml-5" src="https://drive.google.com/uc?id=1jAh9mzCA6TIsDj06NMMxcVjqvwEshlvu" alt="">
            </div>
            <div class="ml-3">
              <span class="font-medium text-sm"></span>
              <p class="text-sm"></p>
              <span class="text-sm text-blue font-semibold"></span>
            </div>
          </div>
        </div>
      </div>
      <!-- Dropdown icon -->
      <svg class="w-4 h-4 ml-auto cursor-pointer" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
        fill="currentColor" viewBox="0 0 16 3" @click="toggleDropdown">
        <path
          d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
      </svg>
      <!-- Dropdown Menu -->
      <transition name="fade">
        <div v-if="showDropdown" @click="closeDropdown"
          class="absolute right-0 w-48 bg-green rounded-lg shadow-lg overflow-hidden">
          <ul class="py-1 text-sm text-gray-700 p-5">
            <p>
              <a href="#" @click.prevent="deleteNotification"
                class="flex items-center px-4 py-2 hover:bg-gray-100 transition-colors duration-200">
                <svg class="w-5 h-5 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                Delete
              </a>
            </p>
            <p>
              <a href="#" @click.prevent="handleReport"
                class="flex items-center px-4 py-2 hover:bg-gray-100 transition-colors duration-200">
                <svg class="w-5 h-5 mr-2 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13 16h-1v-4h-1m1-4h.01M12 18.5A5.5 5.5 0 116.5 13 5.5 5.5 0 0112 18.5zM12 3v2m7.78 3.78l-1.42 1.42M19 12h-2M5 12H3m2.22-6.22l-1.42 1.42M12 19v2m4.78-1.22l1.42-1.42M6.22 18.78l-1.42-1.42">
                  </path>
                </svg>
                Report
              </a>
            </p>
          </ul>
        </div>
      </transition>
    </div>
  </div>
</template>

<script>
import { defineComponent } from 'vue';
import axios from 'axios';
 
export default defineComponent({
  props: {
    notification: {
      type: Object,
      required: true
    }
  },

  data() {
    return {
      showDropdown: false
    };
  },

  methods: {
    toggleDropdown() {
      this.showDropdown = !this.showDropdown;
    },

    closeDropdown() {
      this.showDropdown = false;
    },

    async deleteNotification() {
      try {
        await axios.delete(`/api/notifications/${this.notification.id}`);
        this.$emit('notification-deleted', this.notification.id);
      } catch (error) {
        console.error('Failed to delete notification:', error);
      }
    },

    handleReport() {
      console.log('Reporting notification...');
    }
  }
});
</script>

<style scoped>

</style>
