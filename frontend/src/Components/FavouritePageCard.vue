<template>
  <!-- ==============alert message ============ -->
  <div class="alertModal flex justify-center">
    <div class="alert alert-success mt-3 w-99 flex items-center gap-2 p-4 rounded-lg shadow-md"
      v-if="showSuccessMessage">
      <i class="fa fa-check-circle text-green-500"></i>
      <span class="text-black-500">{{ successMessage }}</span>
    </div>
  </div>
  <div class="container">
    <h1 class="mt-20 color-dark text-center mb-4">List of Favorite Items</h1>
    <div class="input-group p-2">
      <input
        type="search"
        class="form-control"
        id="search-btn"
        name="search"
        placeholder="Search term..."
        v-model="textInput"
      />
      <button type="button" class="btn btn-success">
        <i class="fas fa-search"></i>
      </button>
    </div>

    <!-- ===============list favorite=================== -->
    <div class="favorit mt-10 mb-3 d-flex justify-content-start flex-wrap gap-5">
      <div
        class="card bg-gray-200 hover:bg-green-200 shadow-lg"
        v-for="fav in filteredFavItems"
        :key="fav.id"
      >
        <div class="card-body">
          <img
            :src="`http://127.0.0.1:8000/scrap/${fav.item.image}`"
            class="card-img-top"
            alt="..."
          />
          <div class="title text-start mt-3">
            <h5 class="card-title">{{ fav.item.name }}</h5>
            <p class="des">{{ fav.item.description }}</p>
            <h5 class="card-text -mt-3">{{ fav.item.price }}៛</h5>
          </div>
          <div class="icon d-flex justify-content-between mt-4">
            <!-- <button class="w-20 btn btn-outline-success rounded hover:bg-orange-600">
              <i class="bi bi-chat-dots"></i>
            </button> -->
            <button
              class="w-20 btn btn-outline-success rounded hover:bg-red-600"
              @click="showConfirmationModal(fav.id)"
            >
              <i class="fa fa-trash"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal alert -->
  <div v-if="showModal" class="fixed inset-0 flex items-center justify-center z-50">
    <div class="modal-container bg-white rounded-lg shadow-lg p-5 w-99 transition duration-300 ease-in-out">
      <div class="flex justify-end p-2">
        <button type="button" @click="showModal = false"
          class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
              clip-rule="evenodd"></path>
          </svg>
        </button>
      </div>
      <div class="p-6 pt-0 text-center">
        <svg class="w-20 h-20 text-red-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"
          xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <h3 class="text-xl font-normal text-gray-500 mt-5 mb-6">{{ confirmationMessage }}</h3>
        <a href="#" @click="deleteFav(favIdToDelete)"
          class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-base inline-flex items-center px-3 py-2.5 text-center mr-2">
          Yes, I'm sure
        </a>
        <a href="#" @click="showModal = false"
          class="text-gray-900 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-cyan-200 border border-gray-200 font-medium inline-flex items-center rounded-lg text-base px-3 py-2.5 text-center">
          No, cancel
        </a>
      </div>
    </div>
  </div>

  <Footer />
</template>

<script>
import Footer from '@/Components/Footer.vue'

export default {
  name: 'FavouriteCard',
  props: ['favorites'],
  data() {
    return {
      textInput: '',
      showModal: false,
      confirmationMessage: '',
      favIdToDelete: null,
      showSuccessMessage: false,
      successMessage: ''
    };
  },
  components: {
    Footer
  },
  computed: {
    filteredFavItems() {
      if (!this.textInput) {
        return this.favorites;
      }
      return this.favorites.filter((fav) =>
        fav.item.name.toLowerCase().includes(this.textInput.toLowerCase())
      );
    },
  },
  methods: {
    showConfirmationModal(favId) {
      this.showModal = true;
      this.confirmationMessage = 'Are you sure you want to delete this favorite item?';
      this.favIdToDelete = favId;
    },
    deleteFav(favId) {
      this.$emit('delete-fav', favId);
      this.showModal = false;
      this.successMessage = 'Favorite deleted successfully!';
      this.showSuccessMessage = true;
      setTimeout(() => {
        this.showSuccessMessage = false;
      }, 2000);
    }
  }
};
</script>

<style scoped>
.alertModal {
  position: fixed;
  top: 20px;
  left: 50%;
  transform: translateX(-50%);
  z-index: 999;
}

.alert {
  background-color: white;
  border-color: white;
  color: green;
}

.favorit .card {
  width: 22%;
  height: 80%;
  padding: 2%;
}
.card img {
  height: 150px;
  object-fit: cover;
}

@media (min-width: 320px) and (max-width: 568px) {
  .card img {
    width: 40%;
    height: 10%;
  }
  .adjay .card {
    width: 200px;
    margin: auto;
  }
}
@media (max-width: 768px) {
  .adjay {
    display: flex;
    flex-direction: column;
    background-color: black;
  }
  .card {
    width: 98%;
    margin: auto;
  }
  .card-title {
    font-size: 10px;
  }
}
@media (max-width: 428px) {
  .adjay .card {
    width: 90%;
    margin: auto;
  }
  .card-title {
    font-size: 20px;
  }
}
@media (min-width: 768px) and (max-width: 1024px) {
  .adjay {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
  }
  .adjay .card {
    width: 45%;
  }
}
@media (min-width: 800px) and (max-width: 1214px) {
  .adjay {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
  }
  .adjay .card {
    width: 27.5%;
  }
}
@media (min-width: 1100px) and (max-width: 1290px) {
  .adjay {
    display: flex;
    gap: 3px;
  }
  .card {
    width: 21%;
  }
}
</style>
