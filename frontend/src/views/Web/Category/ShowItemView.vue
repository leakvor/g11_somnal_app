<template>
  <div>
    <NavBar />
    <div class="container mb-5">
      <h2 class="text-center m-5">Checking good before buy or selling</h2>
      <div class="group-detail">
        <div class="row">
          <div class="col-12 col-md-2 category-list bg-green-200 rounded">
            <h4 class="text-center m-3">Categories</h4>
            <ul class="list-unstyled">
              <li v-for="category in categories" :key="category.id" class="mb-2">
                <router-link
                  class="link no-underline color-dark"
                  :to="{ name: 'adjay', params: { id: category.id } }" style="font-size:20px;"
                >
                  {{ category.name }}
                </router-link>
              </li>
            </ul>
          </div>
          <div class="col-12 col-md-10 show-detail">
            <div v-if="item" class="card p-2 d-flex flex-column flex-md-row" id="imageShow">
              <figure
                class="zoom flex-2 m-auto position-relative"
                @mousemove="zoomImage"
                @mouseleave="hideLens"
              >
                <img
                  :src="`http://127.0.0.1:8000/scrap/${item.image}`"
                  class="card-img-top"
                  id="zoomImage"
                  alt="Item image"
                />
                <span id="lens"></span>
              </figure>
              <div class="card-contain flex-1 ml-0 ml-md-5">
                <div class="card-body mt-5">
                  <h5 class="card-title fw-bold">{{ item.name }}</h5>
                  <p class="card-text">{{item.description}}</p>
                </div>
                <div class="mt-5 d-flex justify-content-between p-3">
                  <h5 class="mb-0">{{ item.price }}៛</h5>
                  <!-- <a href="#" class="btn btn-success mt-5">Buy Now</a> -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <hr />
      <!-- display all items in category -->
      <div class="involve-items mt-5 d-flex flex-column">
        <h3 class="mb-3">Related items</h3>
        <div class="d-flex justify-content-start flex-wrap gap-5">
          <div
            class="card bg-gray-200 hover:bg-green-200 shadow-lg"
            v-for="relatedItem in items"
            :key="relatedItem.id" 
          >
          <router-link class="no-underline color-dark" :to="{ name: 'show-card', params: { id: relatedItem.id } }" >
            <img
              :src="`${backendUrl}/scrap/${relatedItem.image}`"
              class="card-img-top"
              alt="Related item image"
            />
          </router-link>
            <div class="card-body text-start">
              <h5 class="card-title">{{ relatedItem.name }}</h5>
              <p
                class="card-text text-center text-white rounded bg-green-600 w-20 h-10 d-flex align-items-center justify-content-center"
              >
                {{ relatedItem.price }}៛
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <Footer />
  </div>
</template>

<script>
import axios from 'axios'
import NavBar from '@/Components/NavBar.vue'
import Footer from '@/Components/Footer.vue'

export default {
  components: {
    NavBar,
    Footer
  },
  props: ['id'],
  data() {
    return {
      categories: [],
      item: null,
      backendUrl: 'http://127.0.0.1:8000',
      category: null,
      items: [],
      refresh:false,
    }
  },
  methods: {
    
    async fetchItemDetails() {
     
      try {
        const response = await axios.get(`${this.backendUrl}/api/item/show/${this.id}`)
        console.log(response.data.data)
        if (response.data.data) {
          this.item = response.data.data[1]
          // console.log(this.item);
          this.category = this.item.category_id
        }
      } catch (error) {
        console.error('Error fetching item details:', error)
      }
    },

    async getCategory() {
      try {
        const response = await axios.get(`${this.backendUrl}/api/category/list`)
        this.categories = response.data.data
      } catch (error) {
        console.error('Error fetching categories:', error)
      }
    },
    async fetchRelateItem() {
      // console.log(this.id);
      try {
        const response = await axios.get(`${this.backendUrl}/api/item/relate/${this.id}`)
          this.items = response.data.related_items
          console.log('relate',this.items);
      } catch (error) {
        console.error('Error fetching related items:', error)
      }
    },
    // showRelateItem(relatedItem) {
    //   this.item = relatedItem
    // },
    zoomImage(e) {
      const lens = document.getElementById('lens')
      const zoomer = e.currentTarget
      let offsetX, offsetY, x, y

      e.offsetX ? (offsetX = e.offsetX) : (offsetX = e.touches[0].pageX)
      e.offsetY ? (offsetY = e.offsetY) : (offsetY = e.touches[0].pageY)

      x = (offsetX / zoomer.offsetWidth) * 100
      y = (offsetY / zoomer.offsetHeight) * 100

      zoomer.style.backgroundPosition = `${x}% ${y}%`

      lens.style.display = 'block'
      lens.style.left = `${e.clientX - zoomer.offsetLeft}px`
      lens.style.top = `${e.clientY - zoomer.offsetTop}px`

      zoomer.style.backgroundImage = `url(${this.backendUrl}/scrap/${this.item.image})`
      zoomer.style.backgroundSize = '600% 600%'
    },
    hideLens() {
      const lens = document.getElementById('lens')
      lens.style.display = 'none'
    },
  },
  async mounted() {
    await this.getCategory()
    await this.fetchItemDetails()
    await this.fetchRelateItem()
  },
  watch: {
    id() {
      this.fetchItemDetails()
    }
  }
}
</script>

<style scoped>
/* list related item */
.involve-items .card {
  width: 22%;
  padding: 2%;
}
.involve-items .card img {
  width: 230px;
  height: 150px;
  object-fit: cover;
  margin: auto;
}
.card .p {
  width: 200px;
  margin: auto;
}


/* zoom image */
.zoom img {
  width: 100%;
  height: 300px;
  object-fit: cover;
  margin: auto;
  background: rgba(0, 128, 0, 0.379);
}
figure.zoom {
  background-position: 50% 50%;
  position: relative;
  width: 100%;
  max-width: 500px;
  overflow: hidden;
  cursor: zoom-in;
}
figure.zoom img:hover {
  opacity: 0;
}
figure.zoom img {
  transition: opacity 0.5s;
  display: block;
  width: 100%;
  border: 1px solid green;
}

/*desktop*/
@media screen and (max-width: 1280px) {
  .involve-items {
    padding: 10px;
  }
  .involve-items .card {
    width: 45%;
    padding: 2%;
  }
  .involve-items .card img {
    width: 200px;
    height: 150px;
  }
  .involve-items .card-body {
    font-size: 14px;
  }
  .card-title,
  .card-text {
    padding: 10px;
    font-size: 24px;
  }
  .category-list {
    display: none;
  }
  .show-detail {
    width: 100%;
    display: flex;
    flex-direction: column;
  }
}
/* template responsive */
@media screen and (max-width: 768px) {
  .involve-items {
    padding: 10px;
  }
  .involve-items .card {
    width: 45%;
    height: 70%;
    padding: 2%;
  }
  .involve-items .card img {
    width: 200px;
    height: 150px;
    object-fit: cover;
  }
  .involve-items .card-body {
    font-size: 14px;
  }
  .card-title,
  .card-text {
    padding: 10px;
    font-size: 24px;
  }
 
  .show-detail {
    width: 100%;
    display: flex;
    flex-direction: column;
  }
}
/*phone*/
@media screen and (max-width: 360px) {
  .involve-items {
    padding: 10px;
  }
  .involve-items .card {
    width: 90%;
    padding: 2%;
    margin: auto;
  }
  .involve-items .card img {
    width: 200px;
    height: 150px;
  }
  .involve-items .card-body {
    font-size: 12px;
  }
  .card-title,
  .card-text {
    padding: 10px;
  }
  .category-list {
    display: none;
  }
  .show-detail .card img {
    width: 100%;
    height: 300px;
  }
}
</style>
