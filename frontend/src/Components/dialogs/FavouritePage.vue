<!-- FavouritePage.vue -->
<template>
  <div class="container px-5 py-10 mx-auto">
    <h1 class="font-bold mb-15">Favourites Page</h1>
    <div class="flex flex-wrap -m-7 gap-7">
      <FavouriteCard v-for="(item, index) in favouritesData" :key="index" :item="item" />
    </div>
  </div>
</template>

<script>
import FavouriteCard from '../FavouritePageCard.vue';

export default {
  name: 'FavouritePage',
  props: {
    favouritesData: {
      type: Array,
      default: () => []
    }
  },
  components: {
    FavouriteCard
  }
};
</script>

<style scoped>

</style>
