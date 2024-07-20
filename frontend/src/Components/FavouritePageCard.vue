<template>
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
  <Footer class="mt-5" />
</template>

<script>
export default {
  name: 'FavouriteCard',
  props: ['favorites'],
  data() {
    return {
      textInput: '',
    };
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
    confirmDeletePost(favId) {
      if (window.confirm('Are you sure you want to delete this fav?')) {
        this.$emit('delete-fav', favId);
      }
    },
  },
};
</script>

<style scoped>
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
