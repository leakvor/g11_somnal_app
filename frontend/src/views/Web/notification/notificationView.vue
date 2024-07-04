<template>
  <div id="app">
    <notificationComponent />
     <!-- <Notifi/> -->
  </div>
</template>

<script setup>
import notificationComponent from '../../../Components/notification/notificationComponent.vue';
// import Notifi from '../../../Components/notification/Notifi.vue'

const name = 'notificationView';
const component = {
  notificationComponent
  // Notifi
}

</script>

<style>
/* Add global styles if needed */
</style>
