<!-- FavouritePageView.vue -->
<template>
  <div>
    <FavouritePage :favouritesData="favourites" />
  </div>
</template>

<script>
import FavouritePage from '../../../Components/dialogs/FavouritePage.vue';

export default {
  name: 'FavouritePageView',
  components: {
    FavouritePage
  },
  data() {
    return {
      favourites: [
        {
          imageSrc: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSERUKiGvUkOouNqUnAp__DirTLxdZb3XR5SvGMpw6Nvj9EZ2HkaQNXc_ITS0hzC15GWB4&usqp=CAU',
          category: 'Company Name 1',
          description: 'Description of the company 1',
          location: 'Location of the company 1'
        },
        {
          imageSrc: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSERUKiGvUkOouNqUnAp__DirTLxdZb3XR5SvGMpw6Nvj9EZ2HkaQNXc_ITS0hzC15GWB4&usqp=CAU',
          category: 'Company Name 2',
          description: 'Description of the company 1',
          location: 'Location of the company 1'
        },
        {
          imageSrc: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSERUKiGvUkOouNqUnAp__DirTLxdZb3XR5SvGMpw6Nvj9EZ2HkaQNXc_ITS0hzC15GWB4&usqp=CAU',
          category: 'Company Name 3',
          description: 'Description of the company 1',
          location: 'Location of the company 1'
        },
        {
          imageSrc: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSERUKiGvUkOouNqUnAp__DirTLxdZb3XR5SvGMpw6Nvj9EZ2HkaQNXc_ITS0hzC15GWB4&usqp=CAU',
          category: 'Company Name 4',
          description: 'Description of the company 1',
          location: 'Location of the company 1'
        },
        {
          imageSrc: 'https://via.placeholder.com/300x200',
          category: 'Company Name 2',
          description: 'Description of the company 2',
          location: 'Location of the company 2'
        }
      ]
    };
  }
};
</script>

<style scoped></style>
