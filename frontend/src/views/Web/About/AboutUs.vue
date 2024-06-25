<template>
    <div class="container">
      <AboutUsCom />
      <OurServices />
      <OurTeam />
    </div>
</template>
  
  <script>
  import AboutUsCom from '../../../Components/AboutComponent/AboutUsCom.vue';
  import OurServices from '../../../Components/AboutComponent/OurServices.vue';
  import OurTeam from '../../../Components/AboutComponent/OurTeam.vue';  
  
  export default {
    name: 'AboutUs',
    components: {
      AboutUsCom,
      OurServices,
      OurTeam
    }
  };
  </script>
  
  <style>
  #app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
    margin-top: 60px;
  }
  </style>