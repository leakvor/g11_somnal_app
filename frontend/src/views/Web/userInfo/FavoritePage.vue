<!-- FavouritePageView.vue -->
<template>
  <div>
    <NavBar />
    <div>
      <FavouritePage :favorites="favorites" @delete-fav="deleteFav"/>
    </div>
  </div>
</template>

<script>
import NavBar from '@/Components/NavBar.vue';
import FavouritePage from '../../../Components/FavouritePageCard.vue';
import axios from 'axios';

export default {
  name: 'FavouritePageView',
  components: { NavBar, FavouritePage },
  data() {
    return {
      favorites: []
    };
  },
  methods: {
    async fetchFavorites() {
      try {
        const token = localStorage.getItem('access_token');
        const response = await axios.get('http://127.0.0.1:8000/api/fav/list', {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });
        this.favorites = response.data;
        console.log(this.favorites);
      } catch (error) {
        console.error(error);
      }
    },
    //delete the favorites
    async deleteFav(favId) {
      try {
        const token = localStorage.getItem('access_token');
        if (!token) {
          throw new Error('No token found');
        }

        const response = await axios.delete(`http://127.0.0.1:8000/api/fav/delete/${favId}`, {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });

        console.log(response.data);

        // Update the favorites list by removing the deleted item
        this.favorites = this.favorites.filter(fav => fav.id !== favId);
        
      } catch (error) {
        console.error('Error deleting fav:', error);
        this.showError('Failed to delete the favorite item.');
      }
    },
    showError(message) {
      // Implementation to show error messages (e.g., using a toast notification)
      alert(message); // Simple alert as an example
    }
  },
  mounted() {
    this.fetchFavorites();
  }
};
</script>

<style scoped></style>
