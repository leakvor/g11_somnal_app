<!-- FavouritePage.vue -->
<template>
  <div class="container px-5 py-10 mx-auto">
    <h2 class=" mb-15 text-dark">Favourites Page</h2>
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
