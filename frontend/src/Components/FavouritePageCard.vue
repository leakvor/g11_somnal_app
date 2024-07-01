<!-- FavouritePageCard.vue -->
<template>
  <div>
    <div class=" card rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transition-shadow duration-300 transform hover:scale-101">
      <div class="relative overflow-hidden pb-2/3"> <!-- Adjust pb-2/3 for 3:2 aspect ratio -->
        <img class="absolute h-full w-full object-cover object-center" :src="item.imageSrc" alt="Card Image" />
      </div>
      <div class="relative ">
        <div class="py-6 px-4 md:px-8">
          <h5 class="text-xl ">{{ item.category }}</h5>
          <div class="text-gray-600 text-sm font-medium flex items-center mb-2 mt-1">
            <p>Location : &nbsp;</p>
            <a :href="item.locationLink" class="hover:text-black transition duration-300 ease-in-out mb-3">{{ item.location }}</a>
          </div>
          <p class="leading-7 text-gray-700">{{ item.description }}</p>
          <div class="mt-6 flex justify-between items-center">
            <!-- Uncomment if needed -->
           <!-- <img :src="item.logoSrc" alt="Provider Logo" class="w-6 h-6" /> -->
            <!-- <button>Edit</button>
            <a :href="item.readMoreLink" class="flex items-center">
              <p class="mr-5">Read more</p>
              <svg xmlns="http://www.w3.org/2000/svg" width="14.125" height="13.358" viewBox="0 0 14.125 13.358">
                <path fill="#1d1d1d" fill-rule="evenodd" d="M14.189,10.739H3V9.2H14.189L9.361,4.378l1.085-1.085,6.679,6.679-6.679,6.679L9.361,15.566Z"></path>
              </svg>
            </a> -->
            <a :href="item.readMoreLink" class="flex items-center">
              <!-- <p class="mr-5">Read more</p> -->
              <button class="btn bg-red-700  color-white hover:bg-red-700 color-white">Delete</button>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'FavouriteCard',
  props: {
    item: {
      type: Object,
      required: true
    }
  }
};
</script>

<style scoped>
*{
  text-decoration: none;
}
  .card{
    transition: all 0.7s ease;
  }
  button:hover{
    color: white;
  }
</style>
