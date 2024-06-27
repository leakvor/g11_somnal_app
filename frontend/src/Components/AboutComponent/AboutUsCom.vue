<template>
    <section class="about-us">
      <div class="about-us-content">
        <h2>About Us</h2>
        <p>We are Somnal App, a leading provider of scrap collection, processing, and recycling services.</p>
      </div>
    </section>
    <div class="container mt-5" >
        <h2 class="text-start" style="margin-left: 65px;">ABOUT US</h2>
        <p class="text-start" style="margin-left: 65px; margin-right: 30px;">
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
    padding: 10% 20px; /* 10% top and bottom padding, 20px left and right padding */
    margin-top: 30px;
    border-radius: 15px;
    text-align: center;
    background-image: url('@/assets/background.jpg');
    background-size: cover;
    background-position: center;
    color: white;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    position: relative;
    overflow: hidden;
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
    font-size: 36px;
    margin-bottom: 20px;
    font-weight: bold;
  }
  
  .about-us p {
    font-size: 18px;
    line-height: 1.6;
    max-width: 600px;
    margin: 0 auto;
  }
  </style>