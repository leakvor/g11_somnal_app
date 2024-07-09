<template>
  <div class="container mx-auto p-4">
    <div class="flex flex-col lg:flex-row items-center justify-between">
      <div class="text-head lg:ml-10 mb-4 lg:mb-0">
        <h1 class="text-2xl font-bold mb-4"><b>Increase your revenue with us</b></h1>
        <p>We strengthen our business together, grow and generate our revenue. </p>
        <button class="bg-red-500 text-white px-4 py-2 rounded-full mt-5">Click on here!</button>
      </div>
      <div class="partner-img lg:ml-20">
        <img src="@/assets/partner/partner.png" alt="Partner Image" class="w-full lg:max-w-lg xl:max-w-xl">
      </div>
    </div>
    <div class="flex">
      <div class="flex-grow">
        <p class="text-green-700 mb-4">Some conditions to become our partner:</p>
        <ul class="list-disc list-inside mb-4">
          <li>You are a business owner who buys and sells materials in bulk or retail, or you own a sewer cleaning business.</li>
          <li>You have the right to post information or services about your business.</li>
          <li>You have the right to contact customers directly.</li>
          <li>If a customer contacts you to request materials or sewer cleaning services, you must accept all requests.</li>
          <li>Respect the market prices that we have set.</li>
          <li>You must pay us $500 per year.</li>
          <li>Please respect our terms and conditions.</li>
        </ul>
        <p>If you are interested in working with us, please fill out the necessary information and make the payment to us.</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'PartnerView',
}
</script>

<style scoped>
.partner-img img {
  width: 100%;
  max-width: 100%;
}
</style>
