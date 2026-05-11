<template>
    <section class="about-us">
      <div class="about-us-content">
        <h2>About Us</h2>
        <p>We are Somnal App, a leading provider of scrap collection, processing, and recycling services.</p>
      </div>
    </section>
    <div class=" p-3 mt-5 text-black" >
        <h2 class="text-start" >ABOUT US</h2>
        <p class="text-start" >
        We are ScrapMall, a leading provider of scrap collection, processing, and recycling services. With over 25 years of experience in the industry, we have built a reputation for providing reliable, efficient, and environmentally-friendly services to our customers. Our team is dedicated to providing the highest level of customer service and support, and we are available 24/7 to assist with any questions or concerns.
        <br>
        <br>
        We offer a wide range of services, including scrap collection, processing, and recycling of materials such as metal, plastic, paper, and electronic waste, as well as dumpster rental, portable toilet rental, and office dismantling. We operate in over 20+ countries worldwide, and our goal is to make scrap recycling easy and accessible for everyone. With our 100% guarantee, you can trust that we will always go above and beyond to ensure your complete satisfaction.
        </p>
    </div>
  </template>
  
  <script>
  export default {
    name: 'AboutUsCom'
  };
  </script>
  
  <style scoped>
  
  .about-us {
    padding: clamp(80px, 12vw, 150px) 20px;
    margin-top: 30px;
    text-align: center;
    background-image: url('@/assets/background.jpg');
    background-size: cover;
    background-position: center;
    color: white;
    box-shadow: 0 12px 32px rgba(31, 41, 51, 0.12);
    position: relative;
    overflow: hidden;
    border-radius: 8px;
  }
  
  .about-us::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5); /* Black overlay with opacity */
    z-index: 0;
  }
  
  .about-us-content {
    position: relative;
    z-index: 1;
  }
  
  .about-us h2 {
    font-size: clamp(2rem, 5vw, 3.4rem);
    margin-bottom: 20px;
    font-weight: bold;
  }
  
  .about-us p {
    font-size: 18px;
    line-height: 1.6;
    max-width: 720px;
    margin: 0 auto;
  }

  .p-3 {
    background: #fff;
    border: 1px solid #dfe7dc;
    border-radius: 8px;
    box-shadow: 0 8px 22px rgba(31, 41, 51, 0.09);
  }

  .p-3 h2 {
    color: #177245;
    font-weight: 800;
  }

  .p-3 p {
    color: #4b5563;
    line-height: 1.75;
  }
  </style>
