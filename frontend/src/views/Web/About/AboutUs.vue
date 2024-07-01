<template>
     <NavBar/>
    <div class="container">
      <AboutUsCom />
      <OurServices />
      <OurTeam />
    </div>
    <FooterView/>
</template>
  
  <script>
  import NavBar from '@/Components/NavBar.vue';
  import FooterView from '@/Components/Footer.vue';
  import AboutUsCom from '../../../Components/AboutComponent/AboutUsCom.vue';
  import OurServices from '../../../Components/AboutComponent/OurServices.vue';
  import OurTeam from '../../../Components/AboutComponent/OurTeam.vue';  
  
  export default {
    name: 'AboutUs',
    components: {
      NavBar,
      AboutUsCom,
      OurServices,
      OurTeam,
      FooterView
    }
  };
  </script>
  
  <style scoped>
  #app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
    background: white;
  }
  </style>