<template>
  <div>
    <div class="container mx-auto">
    <div class="flex flex-col lg:flex-row items-center justify-between">
      <div class="text-head lg:ml-10 mb-4 lg:mb-0">
        <h1><b>Increase Your Income with Us</b></h1>
        <p>We are willing to help strengthen your business and increase your income.</p>
        <router-link to="/payment" class="bg-red-500 text-white px-4 py-2 rounded-full mt-5" style="text-decoration: none; margin-top: 15px">Click Now!!</router-link>
      </div>
      <div class="partner-img lg:ml-20">
        <img src="@/assets/partner/partner.png" alt="Partner Image" class="w-full lg:max-w-lg xl:max-w-xl">
      </div>
    </div>
    <div class="flex" style="margin-top: -10px;margin: 10px;">
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
  </div>
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
  color: black;
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
