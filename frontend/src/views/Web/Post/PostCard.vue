<template>
  <div class="container">
    <div class="d-flex justify-content-center row">
      <div class="col-md-8">
        <ul class="mb-2">
          <li>
            <router-link to="/post/create" class="btn btn-success pull-right mt-5 ml-5">
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
          <div class="bg-white border mt-2" v-for="post in posts" :key="post.id">
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
                  <span style="color: black">{{ post.user.name}}</span>
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
              <h4 style="color: black">{{ post.title }}</h4>
              <span v-for="(item, index) in post.items" :key="index">
                {{ item.item }}{{ index < post.items.length - 1 ? ', ' : '' }}
              </span>
            </div>
            <div class="row">
              <div
                v-for="(image, index) in post.images"
                :key="index"
                class="col-sm-12 col-md-6 col-lg-4"
              >
                <img
                  class="img-fluid shadow rounded mb-4 gallery-img"
                  :src="`http://127.0.0.1:8000/uploads/${image.image}`"
                  :alt="`Image ${index + 1}`"
                />
              </div>
            </div>
            <button
              :class="post.status === 'buy' ? 'btn btn-danger mt-3' : 'btn btn-success mt-3'">
              {{ post.status === 'buy' ? 'Already Buy' : 'Sell' }}
            </button>
          </div>
            
        </div>
      </div>
    </div>
  </div>
  <!-- </div> -->
</template>

<script>
import axios from 'axios'

export default {
  props: ['posts'],
  data() {
    return {
      showOptions: null
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
</style>
