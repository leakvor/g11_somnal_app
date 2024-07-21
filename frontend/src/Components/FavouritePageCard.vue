<template>
  <!-- Alert Message -->
  <div class="alertModal flex justify-center ">
    <div class="alert alert-success mt-3 w-99 flex items-center gap-2 p-4 rounded-lg shadow-md"
      v-if="showSuccessMessage">
      <i class="fa fa-check-circle text-green-500"></i>
      <span class="text-black-500">{{ successMessage }}</span>
    </div>
  </div>
  <div class="container">
    <h1 class="mt-20 color-dark text-center mb-4">List favorit of items</h1>
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
            <button class="w-20 btn btn-outline-success rounded hover:bg-orange-600">
              <i class="bi bi-chat-dots"></i>
            </button>
            <button
              class="w-20 btn btn-outline-success rounded hover:bg-red-600"
              @click="confirmDeletePost(fav.id)"
            >
              <i class="fa fa-trash"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <Footer />
</template>

<script>
import Footer from '@/Components/Footer.vue'

export default {
  name: 'FavouritePageCard',
  props: ['favorites'],
  data() {
    return {
      showSuccessMessage: false,
      successMessage: ''
    };
  },
  methods: {
    deleteFav(favId) {
      this.$emit('delete-fav', favId);
      this.successMessage = 'Favourite deleted successfully!';
      this.showSuccessMessage = true;
      setTimeout(() => {
        this.showSuccessMessage = false;
      }, 2000);
    },
  },
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

.card:hover {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}

.circle-icon {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background-color: #f1f1f1;
}

.circle-icon i {
  color: #000;
}

.delete-button {
  background-color: red;
  border: 1px solid white;
}

.delete-button i {
  color: white;
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
