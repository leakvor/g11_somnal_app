<template>
  <div class="relative w-200 h-155 m-auto mt-5 max-h-full m-auto bg-white shadow rounded">
    <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
      <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Update Post</h3>
      <button
        type="button"
        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white"
        @click="redirectToPosts"
      >
        <svg
          class="w-3 h-3"
          aria-hidden="true"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 14 14"
        >
          <path
            stroke="currentColor"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
          />
        </svg>
        <span class="sr-only">Close modal</span>
      </button>
    </div>
    <!-- Modal body -->
    <div class="p-4">
      <input
        type="text"
        class="w-full p-2 border border-grey mb-4"
        placeholder="Input your description"
      />
      <div>
        <img
          src="../../../assets/image/kitchen.jpg"
          alt=""
          style="width: 700px; height: 300px; object-fit: cover"
        />
      </div>
      <button
        type="submit"
        class="w-full text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-5 border-none"
      >
        Save
      </button>
    </div>
  </div>
</template>

<script>
export default {
  methods: {
    redirectToPosts() {
      this.$router.push('/list_post')
    }
  }
}
</script>

<style scoped>
@media (max-width: 768px) {
  .max-w-md {
    max-width: 100%;
  }
}

</style>
