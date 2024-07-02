<!-- App.vue (or your main application file) -->
<template>
  <NavBar/>
    <div id="app">
      <ManagePaidAdjay />
    </div>
  </template>
  
  <script >
  import NavBar from '@/Components/NavBar.vue';
  import ManagePaidAdjay from '../../../Components/ManagePaidAdjay.vue';
  export default{
    name:"PaidAdjayView",
    components: {
      NavBar,
      ManagePaidAdjay
    }
  }
  </script>
  
  <style>
  /* Your global styles */
  </style>