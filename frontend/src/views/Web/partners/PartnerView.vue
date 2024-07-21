<template>
  <div >
    <NavBar />
    <PartnerComponent />
    <OptionPaid />
    <PricingOption/>
    <FooterVue />
  </div>
</template>
  
  <script>
import NavBar from '../../../Components/NavBar.vue'
import FooterVue from '../../../Components/Footer.vue'
import PartnerComponent from '../../../Components/dialogs/PartnerComponent.vue'

import PricingOption from '../../Web/userInfo/PricingOption.vue'
import OptionPaid from '../partners/OptionPaid.vue'
export default {
  name: 'PartnerPage',

  components: {
    PartnerComponent,
    OptionPaid,
    NavBar,
    PricingOption, 
    FooterVue
  }

}
</script>
  