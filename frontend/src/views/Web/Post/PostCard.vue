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
          <div class="d-flex flex-row justify-content-between align-items-center p-2 bg-white border">
            <div class="feed-text px-2">
              <h6 class="text-black-50 mt-2">What's on your mind</h6>
            </div>
            <div class="feed-icon px-2">
              <i class="fa fa-long-arrow-up text-black-50"></i>
            </div>
          </div>
          <div class="bg-white border mt-2" v-for="post in posts" :key="post.id">
            <div class="d-flex flex-row justify-content-between align-items-center p-2 border-bottom">
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
              <h4 style="color: black">{{ post.title }}</h4>
              <p style="color: black">{{ post.description }}</p>
            </div>
            <div class="feed-image p-2 px-3" v-if="post.image">
              <img
                class="img-fluid img-responsive"
                :src="`http://127.0.0.1:8000/uploads/${post.image}`"
                alt="Post Image"
              />
            </div>
            <div class="d-flex justify-content-between align-items-center p-2">
              <div class="d-flex flex-row align-items-center">
                <button
                  type="submit"
                  @click="likePost(post.id)"
                  :class="['fa', 'fa-heart', { liked: post.liked }]"
                  :style="{ color: post.liked ? 'red' : 'gray' }"
                ></button>
                <i class="fa fa-smile-o ml-2" style="color: blue"></i>
              </div>
              <div class="muted-color" style="color: black">
                <span v-if="post.total_likes === 1">{{ post.total_likes }} like</span>
                <span v-else>{{ post.total_likes }} likes</span>
                <span class="ml-2" v-if="post.total_comments === 1">{{ post.total_comments }} comment</span>
                <span class="ml-2" v-else>{{ post.total_comments }} comments</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  props: ['posts'],
  data() {
    return {
      showOptions: null,
    };
  },
  methods: {
    toggleOptions(postId) {
      this.showOptions = this.showOptions === postId ? null : postId;
    },
    confirmDeletePost(postId) {
      if (window.confirm('Are you sure you want to delete this post?')) {
        this.$emit('delete-post', postId);
      }
    },
    async likePost(post) {
      console.log(post);
      try {
        const token = localStorage.getItem('access_token');
        const response = await axios.post('http://127.0.0.1:8000/api/comment/user/like', {
          post_id: this.post,
        }, {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });

        if (response.data === true) {
          post.liked = true;
          post.total_likes++;
        } else if (response.data === false) {
          post.liked = false;
          post.total_likes--;
        } else {
          console.error('Unexpected response from server');
        }
      } catch (error) {
        console.error('Error liking/unliking post:', error);
      }
    },
  },
};
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
