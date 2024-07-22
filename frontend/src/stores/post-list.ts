import { defineStore } from 'pinia';
import axiosInstance from '@/plugins/axios';
import axios from 'axios';

export const usePostStore = defineStore('post', {
  state: () => ({
    posts: [] as Array<{ id: number, title: string, description: string }>
  }),
  actions: {
    async fetchPosts() {
      try {
        const response = await axios.get('/post/list', {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('access_token')}`
          }
        });
        this.posts = response.data;
      } catch (error) {
        console.error('Error fetching posts:', error);
      }
    }
  }
});
