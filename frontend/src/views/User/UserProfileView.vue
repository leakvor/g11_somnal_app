<template>
  <div >
    <NavBar />
    <head>
      <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"
      />
    </head>
    <div class="items-center justify-center bg-white" style="height: 700px">
      <img
        class="w-full"
        src="https://images.unsplash.com/photo-1605379399642-870262d3d051?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=2000&q=80"
        alt=""
        style="height: 300px; object-fit: cover"
      />
      <div class="px-5 -mt-40 ml-10">
        <img
          class="bg-white p-2 rounded-full"
          src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=2000&q=80"
          alt=""
          style="width: 200px; height: 200px"
        />
      </div>
      <div class="color-dark pl-10">
        <div class="info">
          <h1>Kun Voleak</h1>
          <div class="address">
            <p>Phone: 098 456 789</p>
            <p>Email: voath"gimail.com</p>
            <span>Address: .....</span>
          </div>
        </div>
      </div>

      <!-- modal -->
      <button type="button" class="py-3 px-4 inline-flex items-center bg-green-600 hover:bg-orange-600 m-10 color-white gap-x-2 text-sm font-semibold rounded-lg border border-transparent" @click="showModal = true">
        Send Message
      </button>

      <div
        v-if="showModal" class="fixed inset-0 z-50 overflow-auto bg-smoke-light flex ">
        <div class="relative p-8 bg-white w-full max-w-md m-auto flex-col flex rounded-lg shadow-lg">
          <span
            class="absolute top-0 right-0 p-4"
            @click="showModal = false"
          >
            <svg
              class="w-6 h-6 text-gray-600"
              fill="none"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              stroke="currentColor"
              viewBox="0 0 24 24"
            >
              <path d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </span>
          <div class="mt-4">
            <h3 class="font-bold text-gray-800">Send Message</h3>
            <textarea
              name="message"
              id="message"
              cols="30"
              rows="10"
              placeholder="Please input your message"
              class="w-full p-2 mt-2 border rounded-md"
            ></textarea>
          </div>
          <div class="flex justify-end items-center gap-x-2 mt-4">
            <button
              type="button"
              class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
              @click="showModal = false"
            >
              Close
            </button>
            <button
              type="button"
              class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
              @click="saveMessage"
            >
              Save changes
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import NavBar from "@/Components/NavBar.vue";
export default {
  components: {
    NavBar,
  },
  data() {
    return {
      showModal: false,
    };
  },
  methods: {
    saveMessage() {
      // Handle saving the message logic here
      alert("Message saved!");
      this.showModal = false;
    },
  },
};
</script>

<style>
.bg-smoke-light {
  background-color: rgba(0, 0, 0, 0.5);
}

</style>
