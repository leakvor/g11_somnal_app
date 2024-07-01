<template>
  <div class="container mx-auto p-4">
    <div class="flex flex-col lg:flex-row items-center justify-between">
      <div class="text-head lg:ml-10 mb-4 lg:mb-0">
        <h1 class="text-2xl font-bold mb-4"><b>បង្កើនចំណូលរបស់អ្នកជាមួយយើងខ្ញុំ</b></h1>
        <p>យើងរូមគ្នាជួយពង្រឹងអាជីវកម្មរបស់លោកអ្នកមានការរីចម្រើន​និង​ជួយបង្កើតចំណូលរបស់អ្នក។</p>
        <button class="bg-red-500 text-white px-4 py-2 rounded-full mt-5">ចុចនៅទីនេះ!</button>
      </div>
      <div class="partner-img lg:ml-20">
        <img src="@/assets/partner/partner.png" alt="Partner Image" class="w-full lg:max-w-lg xl:max-w-xl">
      </div>
    </div>
    <div class="flex">
      <div class="flex-grow">
        <p class="text-green-700 mb-4">លក្ខខណ្ឌមួយចំនួនដើម្បីក្លាយជាដៃគូរបស់យើង:</p>
        <ul class="list-disc list-inside mb-4">
          <li>លោកអ្នកជាម្ចាស់អាជីវកម្មទិញអេតចាយទាំងដុំនិងរាយ​ ឬជាម្ចាស់អាជីវកម្មបូមលូ។</li>
          <li>លោកអ្នកមានសិទ្ធិក្នុងការផុសពីព័ត៍មានផ្សេងៗឬសេវាកម្មរបស់លោកអ្នក។</li>
          <li>លោកអ្នកមានសិទ្ធិក្នុងការទាក់ទងទៅអតិថិជនដោយខ្លួនឯង។</li>
          <li>ប្រសិនបើមានអតិថិជនទាក់ទងទៅកាន់លោកអ្នកដើម្បីទៅយកអេតចាយឬសេវាកម្មបូមលូ លោកអ្នកត្រូវតែទទួលទាំងអស់។</li>
          <li>គោរពទៅតាមតម្លៃទីផ្សារដែលពួកយើងបានដាក់។</li>
          <li>ក្នុងមួយឆ្នាំលោកអ្នកត្រូវបង់លុយឲ្យខាងយើងខ្ញុំ 500$។</li>
          <li>សុំគោរពទៅតាមល័ក្ខខណ្ឌរបស់ពួកយើង។</li>
        </ul>
        <p>ប្រសិនបើលោកអ្នកចាប់អារម្មណ៍ជាមួយខាងយើងខ្ញុំ សុំធ្វើការបំពេញព័ត័មានផ្សេងៗ និងបង់លុយមកខាងយើងខ្ញុំ។</p>
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
h1,p,li{
  color: black;
}
.partner-img img {
  width: 100%;
  max-width: 100%;
}
</style>
