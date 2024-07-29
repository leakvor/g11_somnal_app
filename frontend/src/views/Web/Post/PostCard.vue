<template>
  <div class="container">
    <div class="d-flex justify-content-center row">
      <div class="col-md-15">
        <ul class="mb-2">
          <li>
            <router-link to="/post/create" class="btn btn-success pull-right mt-3 ml-2 p-2.8">
              POST
            </router-link>
          </li>
        </ul>
        <div class="feed p-2">
          <div
            class="d-flex flex-row justify-content-between align-items-center p-2 bg-white border"
          >
            <div class="feed-text px-2">
              <h6 class="text-black-50 mt-2">What's on your mind</h6>
            </div>
            <div class="feed-icon px-2">
              <i class="fa fa-long-arrow-up text-black-50"></i>
            </div>
          </div>
          <div
            class="bg-white border shadow rounded mt-2 mb-4"
            v-for="post in posts"
            :key="post.id"
          >
            <div
              class="d-flex flex-row justify-content-between align-items-center p-2 border-bottom"
            >
              <div class="d-flex flex-row align-items-center feed-text px-2">
                <img
                  class="rounded-circle"
                  :src="`http://127.0.0.1:8000/uploads/${post.user.profile}`"
                  width="45"
                  alt="Profile"
                />
                <div class="d-flex flex-column flex-wrap ml-2">
                  <span style="color: black">{{ post.user.name }}</span>
                  <span class="text-black-50 time">{{ post.created_at }}</span>
                </div>
              </div>
              <div class="feed-icon px-2" @click="toggleOptions(post.id)">
                <i class="fa fa-ellipsis-v text-black-50"></i>
                <div v-if="showOptions === post.id" class="options">
                  <router-link :to="{ name: 'edit_post', params: { id: post.id } }">
                    <i class="fa fa-edit" style="color: blue"></i>
                  </router-link>
                  <button @click="confirmDeletePost(post.id)">
                    <i class="fa fa-trash" style="color: red"></i>
                  </button>
                </div>
              </div>
            </div>
            <div class="p-2 px-3">
              <p class="mb-3" style="color: black">{{ post.title }}</p>
              <!-- <p class="text-danger">Type of scrap:</p> -->
              <span style="color: black" v-for="(item, index) in post.items" :key="index">
                <span class="item bg-success text-white me-2"
                  >{{ item.item }}{{ index < post.items.length - 1 ? '' : '' }}</span
                >
              </span>
            </div>
            <div class="images-grid m-3">
              <div v-for="(image, index) in post.images.slice(0, 3)" :key="index" class="grid-item">
                <img
                  class="img-fluid shadow rounded"
                  :src="`http://127.0.0.1:8000/uploads/${image.image}`"
                  :alt="`Image ${index + 1}`"
                  @click="openImageModal(post.images, index)"
                />
                <div
                  v-if="index === 2 && post.images.length > 3"
                  class="more-overlay"
                  @click="openImageModal(post.images, 3)"
                >
                  +{{ post.images.length - 3 }} more
                </div>
              </div>
            </div>
            <button
              class="buy-sell mt-3"
              :class="
                post.status === 'buy'
                  ? 'btn btn-danger'
                  : post.status === 'pending'
                    ? 'btn btn-success'
                    : 'btn btn-warning'
              "
            >
              {{
                post.status === 'buy'
                  ? 'Already Buy'
                  : post.status === 'pending'
                    ? 'Sell Now'
                    : 'Cancel'
              }}
            </button>
          </div>
        </div>
      </div>
    </div>

    <div v-if="showModal" class="modal mt-5" @click="closeImageModal">
      <span class="close" @click="closeImageModal">&times;</span>
      <img class="modal-content" :src="`http://127.0.0.1:8000/uploads/${currentImage.image}`" />
      <div class="caption">{{ currentImageIndex + 1 }} / {{ modalImages.length }}</div>
      <a class="prev" @click.stop="prevImage">&#10094;</a>
      <a class="next" @click.stop="nextImage">&#10095;</a>
    </div>
  </div>
</template>

<script>


export default {
  props: ['posts'],
  data() {
    return {
      showOptions: null,
      showModal: false,
      modalImages: [],
      currentImage: null,
      currentImageIndex: 0
    }
  },
  methods: {
    toggleOptions(postId) {
      this.showOptions = this.showOptions === postId ? null : postId
    },
    confirmDeletePost(postId) {
      if (window.confirm('Are you sure you want to delete this post?')) {
        this.$emit('delete-post', postId)
      }
    },
    openImageModal(images, index) {
      this.modalImages = images
      this.currentImageIndex = index
      this.currentImage = images[index]
      this.showModal = true
    },
    closeImageModal() {
      this.showModal = false
      this.modalImages = []
      this.currentImage = null
      this.currentImageIndex = 0
    },
    prevImage() {
      this.currentImageIndex =
        (this.currentImageIndex + this.modalImages.length - 1) % this.modalImages.length
      this.currentImage = this.modalImages[this.currentImageIndex]
    },
    nextImage() {
      this.currentImageIndex = (this.currentImageIndex + 1) % this.modalImages.length
      this.currentImage = this.modalImages[this.currentImageIndex]
    }
  }
}
</script>

<style scoped>
body {
  background-color: #eee;
}
.time {
  font-size: 9px !important;
}
li {
  list-style-type: none;
}
.socials i {
  margin-right: 14px;
  font-size: 17px;
  color: #d2c8c8;
  cursor: pointer;
}
.feed-image img {
  width: 100%;
  height: auto;
}
.item {
  padding: 5px 10px 5px;
  font-size: 12px;
  border-radius: 20px;
}
.options {
  position: absolute;
  background-color: white;
  border: 1px solid #ccc;
  padding: 5px;
  z-index: 100;
}
.options button {
  display: block;
  text-decoration: none;
  color: black;
  padding: 5px 0;
  background: none;
  border: none;
  cursor: pointer;
}
.options button:hover {
  background-color: #f0f0f0;
}
.rounded-circle {
  border-radius: 50%;
  width: 45px;
  height: 45px;
  object-fit: cover;
}
.modal {
  display: block;
  position: fixed;
  z-index: 1;
  padding-top: 60px;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0, 0, 0, 0.6);
}
.modal-content {
  margin: auto;
  display: block;
  width: 100%;
  max-width: 800px;
}
.close {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #fff;
  font-size: 40px;
  font-weight: bold;
}
.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}
.prev,
.next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  color: white;
  font-weight: bold;
  font-size: 20px;
  transition: 0.6s ease;
  user-select: none;
}
.prev {
  left: 0;
}
.next {
  right: 0;
}
.prev:hover,
.next:hover {
  background-color: rgba(0, 0, 0, 0.8);
}
.caption {
  text-align: center;
  color: #ccc;
  padding: 10px 0;
}
.buy-sell {
  margin-bottom: 10px;
  margin-left: 10px;
}
.images-grid {
  display: flex;
  position: relative;
  gap: 10px;
}
.grid-item {
  flex: 1 1 calc(25% - 8px);
  box-sizing: border-box;
  position: relative;
}
.grid-item img {
  width: 100%;
  height: 85%;
}
.more-overlay {
  height: 85%;
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  background-color: rgba(0, 0, 0, 0.6);
  color: white;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 25px;
  cursor: pointer;
  border-radius: 5px;
}
@media (max-width: 767px) {
  .grid-item {
    flex: 1 1 calc(50% - 8px);
  }
}

@media (max-width: 479px) {
  .grid-item {
    flex: 1 1 100%;
  }
}

@media (min-width: 768px) and (max-width: 991px) {
  .grid-item {
    flex: 1 1 calc(25% - 8px);
  }
}
</style>
