<template>
  <div>
    <Navbar/>
    <div class="container mx-auto">
    <div class="flex flex-col lg:flex-column items-center justify-between">
      <div class="text-orange mt-5">
        <h1 class=""><b>Increase Your Income with Us</b></h1>
        <p>We are willing to help strengthen your business and increase your income.</p>
      </div>
      <div class="partner-img mt-2">
        <img src="https://the-media-leader.com/wp-content/uploads/2022/09/partnership-business-shutterstock.jpg" alt="Partner Image">
      </div>
    </div>
    <div class="flex mt-5" style="margin-top: -10px;margin: 10px;">
      <div class="flex-grow">
        <h3 class="text-green-700 mb-4">To become our partner, you must meet the following conditions:</h3>
        <ul class="list-disc list-inside mb-4">
          <li>You are a business owner who buys scrabs.</li>
          <li>You have the right to make decisions about your business and services.</li>
          <li>You have the right to communicate directly with customers.</li>
          <li>If a customer contacts you to purchase goods or services, you must accept all of them.</li>
          <li>You must respect the market prices that we have set.</li>
          <li>Within a year, you must pay us $100.</li>
          <li>Please respect our terms and conditions.</li>
        </ul>
        <p>If you are interested in partnering with us, please provide us with the necessary information and pay the fee to us.</p>
      </div>
    </div>
    <PricingOPtion/>
  </div>
  <Footer/>
  </div>
  
</template>

<script>


export default{
  name: 'PartnerView',

}
</script>

<style scoped>
li{
  color: black;
  font-size: 20px;
}
h1{
  margin-top: 5px;
  text-align: center;
}
p{
  color: black;
  font-size: 18px;
}
.partner-img img {
  width: 100%;
  max-width: 100%;
}
.container{
  /* background: black; */
  margin-top: -40px;
}
</style>
