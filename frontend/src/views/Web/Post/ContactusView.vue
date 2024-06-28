<template>
  <div>
    <NavBar />
    <ContactUs />
    <Footer />
  </div>
</template>

<script>
import ContactUs from '../../../Components/ContactUs.vue'; 
import NavBar from '../../Components/NavBar.vue';
import Footer from '../../../Components/Footer';
export default {
  name: 'ContactView',
  components: {
    NavBar,
    ContactUs,
    Footer

  }
}
</script>

