<!-- FavouritePageCard.vue -->
<template>
  <div class="container px-5 py-10 mx-auto">
    <h1 class="font-bold mb-15 text-black">Favourites Page</h1>
    <div class="adjay mt-10 p-10 d-flex flex-wrap gap-5">
      <div
        class="card bg-white-200 hover:bg-gray-200 shadow-lg"
        v-for="fav in favorites"
        :key="fav.id"
      >
        <img
          :src="`http://127.0.0.1:8000/uploads/${fav.item.image}`"
          class="card-img-top mt-5"
          alt="..."
        />
        <div class="card-body">
          <div class="title text-center">
            <h3 class="card-title">{{ fav.item.name }}</h3>
            <h5>{{ fav.item.price }}$</h5>
          </div>

          <div class="icon d-flex justify-content-evenly w-100 justify-content-around mt-4 mb-3">
            <a href="#" class="circle-icon" style="background: green">
              <i class="bi bi-chat-dots" ></i>
            </a>
            <button @click="confirmDeletePost(fav.id)" class="circle-icon delete-button">
              <i class="fa fa-trash"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'FavouriteCard',
  props: ['favorites'],
  mounted() {
    this.favorites
  },
  methods: {
    confirmDeletePost(favId) {
      if (window.confirm('Are you sure you want to delete this fav?')) {
        this.$emit('delete-fav', favId)
      }
    }
  }
}
</script>

<style scoped>
/* i {
  border-radius: 50px;
  background-color: green;
  color: white;
  padding: 10px;
} */
i:hover {
  background: orangered;
}
.card {
  width: 22.5%;
}
.card img {
  width: 50%;
  height: 70%;
  margin: auto;
  object-fit: cover;
}

.card:hover {
  box-shadow:
    0 4px 8px 0 rgba(0, 0, 0, 0.2),
    0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
.circle-icon {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 40px; /* Adjust size as needed */
  height: 40px; /* Adjust size as needed */
  border-radius: 50%;
  background-color: #f1f1f1; /* Background color for the circle */
  text-align: center;
}

.circle-icon i {
  color: #000; /* Icon color */
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
    gap:3px;
  
  }
  .card{
    width: 21%;
  }  
}
</style>
