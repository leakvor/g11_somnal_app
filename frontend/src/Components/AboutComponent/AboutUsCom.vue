<template>
    <section class="about-us">
      <div class="about-us-content">
        <h2>About Us</h2>
        <p>We are Somnal App, a leading provider of scrap collection, processing, and recycling services.</p>
      </div>
    </section>
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