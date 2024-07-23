<template>
    <div class="notification-container">
      <div v-if="notifications.length > 0">
        <div v-for="notification in notifications" :key="notification.id">
          <div class="notification">
            <span class="notification-message">{{ notification.message }}</span>
            <button class="mark-as-read" @click="markAsRead(notification.id)">Mark as read</button>
          </div>
        </div>
      </div>
      <div v-else>
        <p class="text-dark">No notifications</p>
      </div>
    </div>
  </template>
  
  <script>
  import { computed } from 'vue'
  import { useStore } from 'vuex'
  
  export default {
    setup() {
      const store = useStore()
      const notifications = computed(() => store.state.notifications)
  
      const markAsRead = (notificationId) => {
        store.commit('MARK_AS_READ', notificationId)
      }
  
      return {
        notifications,
        markAsRead
      }
    }
  }
  </script>
  
  <style scoped>
  .notification-container {
    max-width: 300px;
    margin: 20px auto;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }
  
  .notification {
    padding: 10px;
    border-bottom: 1px solid #ccc;
  }
  
  .notification-message {
    font-size: 16px;
    font-weight: bold;
    margin-bottom: 10px;
  }
  
  .mark-as-read {
    background-color: #4CAF50;
    color: #fff;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
  }
  
  .mark-as-read:hover {
    background-color: #3e8e41;
  }
  </style>