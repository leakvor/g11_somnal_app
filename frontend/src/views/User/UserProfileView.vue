<template>
  <div>
    <NavBar />

    <div class="items-center justify-center bg-white" style="height: 700px">
      <img
        class="w-full"
        src="https://images.unsplash.com/photo-1605379399642-870262d3d051?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=2000&q=80"
        alt=""
        style="height: 300px; object-fit: cover"
      />
      <div class="px-5 -mt-40 ml-10">
        <img
          v-if="user.profile"
          :src="`${backendUrl}/uploads/${user.profile}`"
          alt="Profile Image"
          class="bg-white p-2 rounded-full"
          style="width: 200px; height: 200px"
        />
        <div v-else>
          <!-- Placeholder image or default image -->
          <img
            src="https://via.placeholder.com/200x200"
            alt="Default Profile Image"
            class="bg-white p-2 rounded-full"
            style="width: 200px; height: 200px"
          />
        </div>
      </div>

      <!-- Other user info -->
      <div class="color-dark pl-10">
        <div class="info">
          <h1>{{ user.name }}</h1>
          <div class="address">
            <p>Phone: {{ user.phone }}</p>
            <p>Email: {{ user.email }}</p>
          </div>
        </div>
      </div>

      <!-- Modal -->
      <button
        type="button"
        class="py-3 px-4 inline-flex items-center bg-green-600 hover:bg-orange-600 m-10 color-white gap-x-2 text-sm font-semibold rounded-lg border border-transparent"
        @click="navigateToChat()"
      >
        Send Message
      </button>

      <div v-if="showModal" class="fixed inset-0 z-50 overflow-auto bg-smoke-light flex">
        <div class="relative p-8 bg-white w-full max-w-md m-auto flex-col flex rounded-lg shadow-lg">
          <span class="absolute top-0 right-0 p-4" @click="showModal = false">
            <svg class="w-6 h-6 text-gray-600" fill="none" stroke-linecap="round" stroke-linejoin="round"
              stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
              <path d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </span>
          <div class="mt-4">
            <button class="font-bold text-gray-800" @click="navigateToChat()">
              Send Message
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import NavBar from "@/Components/NavBar.vue";
import { computed, ref } from 'vue';
import { useAuthStore } from '../../stores/auth-store';

export default {
  components: {
    NavBar,
  },
  setup() {
    const authStore = useAuthStore();
    const backendUrl = 'http://127.0.0.1:8000'; // Replace with your actual backend URL

    // Computed property for user data
    const user = computed(() => ({
      name: authStore.user?.name || '',
      email: authStore.user?.email || '',
      phone: authStore.user?.phone || '',
      profile: authStore.user?.profile || '',
    }));

    // Modal state
    const showModal = ref(false);

    // Navigate to chat function
    const navigateToChat = () => {
      // Navigate to the /chat route
      this.$router.push('/chat');
      
      // Optionally close the modal after navigation
      showModal.value = false;
    };

    return {
      user,
      showModal,
      navigateToChat,
      backendUrl,
    };
  },
};
</script>

<style scoped>
.bg-smoke-light {
  background-color: rgba(0, 0, 0, 0.5);
}
</style>
