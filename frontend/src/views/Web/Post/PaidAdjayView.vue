<!-- App.vue (or your main application file) -->
<template>
  <NavBar/>
    <div id="app">
      <ManagePaidAdjay />
    </div>
  </template>
  
  <script >
  import ManagePaidAdjay from '../../../Components/ManagePaidAdjay.vue';
  export default{
    name:"PaidAdjayView",
    components: {
      ManagePaidAdjay
    }
  }
  </script>
  
  <style>
  /* Your global styles */
  </style>