<template>
    <NavBar/>
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel" data-bs-interval="1500">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="https://www.euractiv.com/wp-content/uploads/sites/2/2020/08/Plastic_bottles-800x450.jpg" class="d-block w-100 h-100" alt="Carousel Image 1"/>
        </div>
        <div class="carousel-item">
          <img src="https://wallpapers.com/images/hd/peaceful-background-ia029sdh1de3pwu9.jpg" class="d-block w-100 h-100" alt="Carousel Image 2"/>
        </div>  
        <div class="carousel-item">
          <img src="https://wallpapers.com/images/hd/peaceful-background-aymk14ikibr03mwt.jpg" class="d-block w-100 h-100" alt="Carousel Image 3"/>
        </div>
      </div>
      <div class="position-absolute top-0 start-0 h-100 d-md-block" id="bg-blur">
        <div class="position-absolute top-30 start-10 w-50 text-white bg-secondary p-5 text-dark bg-opacity-75"  id="misson" >
          <h2>SONAL SOLUTION</h2>
          <h2 id="blur-text">
            Somnal Solution is a comprehensive platform that provides innovative and
            sustainable solutions to address the challenges faced by individuals
            and communities. Our mission is to empower people and create a better
            future through the application of cutting-edge technology and
            collaborative initiatives.
          </h2>
        </div>
      </div>
    </div>
    <div class="container mb-5">
      <div class="d-flex justify-content-between mt-20">
        <div class="col-12 col-md-4 bg-success shadow rounded mb-4 mb-md-0" id="first_child">
          <h2 class="text-center mt-3 text-orange" >How to use!</h2>
          <div class="ml-3 mt-4 text-white">
            <h6>1. First you just register for get the Account.</h6>
            <h6>2. If you havealready an account,you can log in.</h6>
            <h6>3. When you log in, you can use our app.</h6>
            <h6>4. You can post your scraps here. by click on button pot in your account</h6>
            <h6>5. You can chat and commend with the companies that you want to shales.</h6>
            <h6>6. then you can select the company to whom you want to shale your scraps.</h6>
            <h6>7. You can also view the scraps that you have posted and the companies that you have shale them.</h6>
            <h6>7. Not only, can also view the scraps that you have posted and the companies that you have shale them.</h6>
  
          </div>
        </div>
        <div class="col-12 col-md-7">
          <img src="https://insidesmallbusiness.com.au/wp-content/uploads/2021/04/Small-businesses-using-apps-in-record-numbers.jpg" class="w-100 h-100 shadow rounded" id="imag-right" alt=""/>
        </div>
      </div>
      <div class="mt-5 ">
        <div class="d-flex justify-content-between mt-20">
          <div class="col-md-7">
            <img src="https://news.sophos.com/wp-content/uploads/2017/05/shutterstock_439303546-11.jpg" class="w-100 h-100 shadow rounded" id="img-r2" alt=""/>
          </div>
          <div class="col-md-4 bg-white shadow rounded mb-4 mb-md-0">
            <h3 class="text-center mt-5 text-success" id="question">Why use Somnal App? </h3>
            <h6 class="m4 text-black">
              <b>Somnal App</b> offers a wide range of features that cater to both small and large businesses. With its easy-to-use interface and intuitive design, Somnal App makes it easy for individuals and businesses to manage their business operations.
              <b>Somnal App also</b> allow the customers can post they scraps in Somnal app for shales them scraps and contact with companies to buy the scrap. And also in the somnal app you can contact to pumping your bathroom it can help you qickly for solve your problems Sewage blockage at your home.
  
            </h6>
          </div>
        </div>
      </div>
    </div>
    <ContactUs/>
    <FooterVue/>
    
  </template>
  <script>
  import NavBar from '../../Components/NavBar.vue'
  import FooterVue from '../../Components/Footer.vue'
  import ContactUs from '../../Components/ContactUs.vue'

  

export default{
  name:'HomePage',
  components:{
    NavBar,
    ContactUs,
    FooterVue
  }
}
</script>

<style scoped>

#bg-blur {
  background-size: cover;
  background-position: center;
  backdrop-filter: blur(5px);
  filter: brightness(70%);
  width: 100%;
  height: 100vh;
}
#misson {
  background-size: cover;
  background-position: center;
  backdrop-filter: blur(2px);
  width: 100%;


}
.col-12.col-md-4,.col-md-4  {
  border-bottom: 5px solid rgb(238, 152, 3);;
}

#imag-right, #img-r2{
  border-bottom: 5px solid hwb(152 1% 48%); 
}


.col-12.col-md-4,.col-12.col-md-7,.col-md-4,.col-md-7 {
  transition: all 1s ease;
}

.col-12.col-md-4:hover,
.col-12.col-md-7:hover,.col-md-4:hover,.col-md-7:hover {
  transform: translateY(-20px);
}


/* Responsive styles */
@media (max-width: 767px) {
  .col-12.col-md-4,.col-md-4, .col-md-7, .col-12.col-md-7 {
    transition: none;
    margin: 0; /* Use valid margin declaration */
  }

  .col-12.col-md-4:hover,.col-md-4:hover, .col-md-7:hover, .col-12.col-md-7:hover {
    transform: none;

  }
  #first_child{
    position: relative;
    top: 23px;
    }
  .d-flex{
    flex-direction: column;
    align-items: center;
    justify-content: center;
  }
  #bg-blur {
  background-size: cover;
  background-position: center;
  backdrop-filter: blur(5px);
  width: 100%;
  height: 100vh;

}
#misson{
  position: absolute;
  top: 20%;
  left: 30%;
  transform: translate(-50%, -40%);
  width: 100%;
  height: 100%;
  padding: 0px;
 
}
#blur-text{
  font-size: 8px;
  width: 100%;
  height: 100%;
}

#imag-right{
  border-bottom: 5px solid hwb(152 1% 48%);
  max-width: 100%;
  max-height: 100%
}
  .col-12.col-md-4 {
    /* margin-bottom: 1rem; */
    margin-left: 0%!important;
  }

  .col-12.col-md-7 {
    margin-left: 0% !important;
  }
}

@media (min-width: 768px) and (max-width: 1023px) {
  .position-absolute.top-50.start-10.text-white.w-50.d-none.d-md-block {
    top: 50% !important;
    left: 7% !important;
    width: 60% !important;
  }

  .col-12.col-md-4 {
    margin-bottom: 1rem;
  }

  .col-12.col-md-7 {
    margin-left: 0.5rem !important;
  }
  #bg-blur {
  background-size: cover;
  background-position: center;
  backdrop-filter: blur(9px);
  width: 100%;
  height: 100vh;
  }
  #misson {
  position: absolute;
  top: 40%;
  left: 30%;
  transform: translate(-50%, -45%);
  width: 100%;
  height: 100%;
  font-size:8px;
}
#blur-text{
  font-size: 25px;
  width: 100%;
}
  #imag-right {
    border-bottom: 5px solid hwb(152 1% 48%);
    max-width: 100%;
    max-height: 100%
  }
  #img-r2{
    border-bottom: 5px solid hwb(152 1% 48%);
    max-width: 100%;
    max-height: 100;
  }
  .col-md-4{
    line-height: 2.5px;
  }
  #question{
    font-size: 25px;
  }
}
</style>
