<template>
  <div>
    <NavBar />
    <ContactUs />
    <FooterVue />
  </div>
</template>

<script>
import ContactUs from '../../../Components/ContactUs.vue'; 
import NavBar from '../../../Components/NavBar.vue';
import FooterVue from '../../../Components/Footer';
export default {
  name: 'ContactView',
  components: {
    NavBar,
    ContactUs,
    FooterVue

  }
}
</script>

