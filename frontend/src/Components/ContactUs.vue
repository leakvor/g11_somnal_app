<template>
  <div class="container mx-auto px-4 py-8 fadeIn">
    <div class="text-center">
      <h1 class="text-blue-500 text-3xl font-bold">Contact Us</h1>
      <hr class="my-4">
    </div>
    <div class="flex flex-wrap md:flex-nowrap">
      <div class="w-full md:w-1/2 mb-4 md:mb-0">
        <iframe class="w-full h-100 border-0" frameborder="0" style="border:0"
          src="https://www.google.com/maps/@11.5565521,104.8805006,15z?"
          allowfullscreen>
        </iframe>
      </div>
      <div class="w-full md:w-1/2">
        <form action="form.php" method="post">
          <div class="mb-4">
            <input type="text"
              class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:border-blue-500"
              id="name" name="nm" placeholder="Name" required autofocus>
          </div>
          <div class="mb-4">
            <input type="email"
              class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:border-blue-500"
              id="email" name="em" placeholder="Email" required>
          </div>
          <div class="mb-4">
            <input type="text"
              class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:border-blue-500"
              id="phone" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="10"
              placeholder="Phone" required>
          </div>
          <div class="mb-4">
            <textarea
              class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:border-blue-500 resize-none"
              rows="5" id="comment" name="FB" placeholder="Type Your Message/Feedback here..." required>
            </textarea>
          </div>
          <button
            class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-white hover:text-blue-500 border border-blue-500 transition duration-500">
            <i class="fas fa-paper-plane"></i> Send
          </button>
        </form>
      </div>
    </div>
    <div class="mt-8">
      <div class="flex flex-wrap -mx-4">
        <div class="w-full md:w-1/2 lg:w-1/4 px-4 my-5" v-for="(info, index) in contactInfo" :key="index">
          <div class="text-center">
            <i :class="info.icon + ' fa-5x mb-3 text-blue-500'" aria-hidden="true"></i>
            <h4 class="text-uppercase mb-5 text-lg font-semibold">{{ info.title }}</h4>
            <p v-if="info.text">{{ info.text }}</p>
            <address v-else>{{ info.address }}</address>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ContactUs',
  data() {
    return {
      contactInfo: [
        {
          icon: 'fa fa-phone',
          title: 'Call Us',
          text: '097 777 999 80'
        },
        {
          icon: 'fa fa-map-marker',
          title: 'Office',
          address: '#371 Phum Tropeang Chhuksangkat Tek Thla, Khan Sen Sok, Phnom Penh.'
        },
        {
          icon: 'fa fa-map-marker',
          title: 'Partner Office',
          address: 'Suite 02, Level 12, Sahera Tropical Center'
        },
        {
          icon: 'fa fa-globe',
          title: 'Email',
          text: 'somnal@gmail.com'
        }
      ]
    };
  }
}
</script>

<style scoped>
.fadeIn {
  animation: fadeIn 3s;
}

@keyframes fadeIn {
  0% {
    opacity: 0;
  }

  100% {
    opacity: 1;
  }
}
textarea{
  color: black;
}
</style>
