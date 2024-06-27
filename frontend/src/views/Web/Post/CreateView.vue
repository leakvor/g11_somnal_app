<template>
  <div class="flex flex-col p-4 rounded-lg bg-white shadow-md w-200 h-100 m-auto mt-5">
    <h2 class="text-center mb-3">Create new post</h2>
    <div class="title mt-3 mb-3">
      <label class="block mb-2 text-sm font-medium text-gray-900 " for="file_input">Description</label>
      <input
        type="text"
        class="w-full p-2 border border-grey"
        placeholder="Input your description"
      />
      
    </div>
    <div class="mt-3">
      <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload file</label>
      <input type="file" class="block w-full border border-gray-300 p-2" id="file_input" >
    </div>
    <div class="flex justify-end space-x-10 mt-15">
      <a
        href="/list_post"
        class="px-4 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-600 no-underline"
      >
        Cancel
      </a>
      <a
        href="/update_post"
        class="px-4 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-600 no-underline"
      >
        Save
      </a>
    </div>
  </div>
</template>

<script>
export default {}
</script>

<style scoped>
</style>
