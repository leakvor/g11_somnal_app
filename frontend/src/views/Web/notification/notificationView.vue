<template>
  <NavBar/>
  <div id="app">
    <notificationComponent />
  </div>
</template>

<script setup>
import notificationComponent from '../../../Components/Notification/notificationComponent.vue';
import NavBar from "@/Components/NavBar.vue";

const name = 'notificationView';
const component = {
  notificationComponent,
  NavBar

}

</script>

<style>
</style>
