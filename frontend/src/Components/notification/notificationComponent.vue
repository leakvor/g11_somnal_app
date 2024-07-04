<template>
 <Navbar/>
  <div class="p-4">
    <h2 class="text-2xl font-bold mb-4">Notifications</h2>
    <div>
      <h3 class="text-xl font-semibold mb-2">New</h3>
      <div class="space-y-4">
        <NotificationItem 
          v-for="(notification, index) in newNotifications" 
          :key="index" 
          :notification="notification"
          @delete="deleteNewNotification(index)" 
        />
      </div>
    </div>
    <div class="mt-6">
      <h3 class="text-xl font-semibold mb-2">Earlier</h3>
      <div class="space-y-4">
        <NotificationItem 
          v-for="(notification, index) in earlierNotifications" 
          :key="index" 
          :notification="notification"
          @delete="deleteEarlierNotification(index)" 
        />
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import NotificationItem from './notificationItem.vue';

const newNotifications = ref([
  {
    avatar: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT1bDrIZIBO-_x5E1vEJCzdAQhShDRqhOG84A&s',
    message: 'Jonathan Hammond and Toby Hamilton also commented on Elinor Taussig\'s post.',
    icon: 'comment',
    time: '2h',
  },
  {
    avatar: 'https://example.com/avatar2.jpg',
    message: 'The SF Movie Club has new posts from Sam Wander and Hani Ahir.',
    icon: 'group',
    time: '8m',
  },
  {
    avatar: 'https://example.com/avatar4.jpg',
    message: 'Connor James, Kory Westerhold and 5 other people reacted to your post.',
    icon: 'thumb_up',
    time: '2h',
  },
]);

const earlierNotifications = ref([
  {
    avatar: 'https://example.com/avatar5.jpg',
    message: 'Katherine Maslyn and James Bennett commented on Graham Long\'s post in Brutalism Appreciation.',
    icon: 'comment',
    time: '3h',
  },
]);

const deleteNewNotification = (index) => {
  newNotifications.value.splice(index, 1);
};

const deleteEarlierNotification = (index) => {
  earlierNotifications.value.splice(index, 1);
};
</script>

<style scoped></style>