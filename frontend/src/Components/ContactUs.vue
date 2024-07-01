<template>
  <NavBar/>
  <div class="container mx-auto px-8 fadeIn">
    <div class="text-center">
      <!-- <h1 class="text-blue-500 text-3xl font-bold">Contact Us</h1> -->
      <hr class="my-1" />
    </div>
    <div class="flex flex-wrap">
      <!-- Map Section -->
      <div class="w-full md:w-1/2 mb-4 md:mb-0">
        <iframe class="w-full h-64 md:h-full border-0" frameborder="0" style="border: 1px solid black"
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3909.742471777524!2d104.87831131475303!3d11.556248491833105!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x310951a0c15b5b4f%3A0x375d614c1a50b7e2!2sPhnom%20Penh!5e0!3m2!1sen!2skh!4v1648891360110!5m2!1sen!2skh"
          allowfullscreen>
        </iframe>
      </div>
      <!-- Contact Form Section -->
      <div id="form-container" class="form-container w-full md:w-1/2 md:pl-8 bg-white p-8 shadow  ">
        <div class="text-blue-800 text-4xl font-bold text-center mb-4">Contact Us</div>
        <form action="https://fabform.io/f/{form-id}" method="post">
          <div class="mb-4">
            <label for="name" class="block text-lg text-gray-900">Name</label>
            <input type="text" id="name" name="name" required
            class="form-control w-full bg-white rounded border border-slate-700 border-dark focus:border-slate-900 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-900 py-2 px-4 leading-8 transition-colors duration-200 ease-in-out">
          </div>
          <div class="mb-4">
            <label for="email" class="block text-lg text-gray-900">Email</label>
            <input type="email" id="email" name="email" required
              class="w-full bg-white rounded border border-slate-900 border-dark  focus:border-black-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-900 py-2 px-4 leading-8 transition-colors duration-200 ease-in-out">
          </div>
          <div class="mb-4">
            <label for="phone" class="block text-lg text-gray-900">Phone</label>
            <input type="phone" id="phone" name="phone" required
              class="w-full bg-white rounded border border-slate-900 border-dark focus:border-black-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-900 py-2 px-4 leading-8 transition-colors duration-200 ease-in-out">
          </div>
          <div class="mb-4">
            <label for="comment" class="block text-lg text-gray-900">Message/Feedback</label>
            <textarea
              class="w-full bg-white rounded border border-slate-900 border-dark focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 h-32 text-base outline-none text-gray-900 py-2 px-4 resize-none leading-6 transition-colors duration-200 ease-in-out"
              rows="5" id="comment" name="message" placeholder="Type Your Message/Feedback here..." required></textarea>
          </div>
          <button type="submit"
            class="w-full bg-green-700 text-white py-3 px-4 rounded hover:bg-green-600 hover:text-white border border-green-500 transition duration-500">
            <i class="fas fa-paper-plane"></i> Send
          </button>
        </form>
      </div>

    </div>
    <div class="mt-20 flex flex-col sm:flex-row space-y-6 sm:space-y-0 sm:space-x-20 justify-center">
      <div class="flex items-center">
        <div class="flex-shrink-0">
          <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
            <!-- Heroicon name: globe-alt -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418" />
            </svg>
          </div>
        </div>
        <div class="ml-4">
          <dt class="text-lg leading-6 font-medium text-gray-900">
            Address
          </dt>
          <dd class="mt-2 text-base text-gray-500">
            #371 Phum Tropeang Chhuksangkat Tek Thla,<br> Khan Sen Sok, Phnom Penh.
          </dd>
        </div>
      </div>
      <div class="flex items-center mt-6 sm:mt-0">
        <div class="flex-shrink-0">
          <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
            <!-- Heroicon name: phone -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
            </svg>
          </div>
        </div>
        <div class="ml-4">
          <dt class="text-lg leading-6 font-medium text-gray-900">
            Phone number
          </dt>
          <a href="tel:09777799980" class="mt-2 text-base text-gray-500 text-decoration-none">
            097 777 999 80
          </a>
        </div>
      </div>
      <div class="flex items-center mt-6 sm:mt-0">
        <div class="flex-shrink-0">
          <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
            <!-- Heroicon name: mail -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
            </svg>
          </div>
        </div>
        <div class="ml-4">
          <dt class="text-lg leading-6 font-medium text-gray-900">
            Email
          </dt>
          <a href="mailto:somnal@gmail.com" class="mt-2 text-base text-gray-500 text-decoration-none">
            somnal@gmail.com
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import NavBar from './NavBar.vue';
export default {
  name: 'ContactUs',
  components:{
    NavBar
  }
}
</script>

<style scoped>

input{
  border: 1px solid #000;
}
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
@media(max-width: 428px) {
  .container{
    padding: 10px;
  }
  #form-container{
    width: 100%;
  }
}
</style>