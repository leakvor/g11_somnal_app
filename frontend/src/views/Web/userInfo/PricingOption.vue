<template>
  <div>
    <NavBar/>
    <div class="container d-flex justify-content-center">
      <div class="pricing-options m-5 ">
        <!-- w-90 md-75 lg-50 -->
        <h1 class="mt-3">Pricing Options</h1>
        <div class="pricing-cards mt-4">
          <div class="card starter">
            <div class="starter">
              <h3 class="mt-2">STARTER</h3>
              <h4 class="price">$10/month</h4>
            </div>
             <p class="mb-19 mt-3 p-2 word-break: break-word">In this case you need to pay <b>$10 a month</b> if you don't pay on time  or <b>3 days after deadline</b> we will cut a money from you and disable your account.</p>
             <button type="button"><b>Get Started</b></button>
          </div>
          <div class="card standard">
            <div class="standard">
              <h3 class="mt-2">STANDARD</h3>
              <h4 class="price ">$55/months</h4>
            </div>
            <p class="mb-13 mt-3 word-break: break-word p-2 ">For in case you need to pay <b>$55/half of year</b>  you will got <b>$5 profit</b>  for you. But if you don't pay on time we will cut a money from you and disable you account Auto matice.</p>
            <button type="button"><b>Get Started</b></button>
          </div>
          <div class="card premium">
            <div class="premium">
              <h3 class="mt-2">PREMIUM</h3>
              <h4 class="price">$100/year</h4>
            </div>
            <p class=" mt-3 mb-4 word-break: break-word  p-2">About this one if you want to pay <b>$100/year</b> you will got <b>$10 profit</b> for you, In this case it's every good for you. But if you don't pay on time we will penalty you as a money $15 from you and disable your account automatic also.</p>
            <button type="button"><b>Get Started</b></button>
          </div>
        </div>
      </div>
    </div>
    <Footer/>
  </div>
</template>

<script>
import NavBar from "../../../Components/NavBar.vue";
import Footer from "../../../Components/Footer.vue";
export default {
  name: "PricingOptions",
  components: {
    NavBar,
    Footer
  }
};
</script>

<style scoped>
.container {
  width: 100%;
  display: flex;
  align-items: center;
}

.pricing-options {
  text-align: center;
  background-color: rgba(8, 73, 123, 0.727);
  color: white;
  width: 80%;
  height: 80vh;
  border-radius: 8px;
}

.pricing-cards {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 20px;
}

.card {
  background-color: white;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  width: 100%;
  max-width: 300px;
  padding-bottom: 5%;
  text-align: center;
  transition: all 0.3s ease; /* Smooth transition for hover effects */
}

.card ul {
  list-style: none;
  padding: 0;
}

.card ul li {
  margin: 5px 0;
}

.card ul li.disabled {
  color: #ccc;
}

.card button {
  color: white;
  border: none;
  padding: 10px 20px;
  cursor: pointer;
}

.card:hover {
  transform: scale(1.05); /* Slightly enlarge the card */
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Darker shadow */
}

.starter {
  background-color: #1d731fd9;
  color: white;
  border: 1px solid #1d731fd9;
  border-radius: 10px 0px 50px 0px;
}

.card.starter {
  background-color: white;
  color: black;
  border-radius: 15px 0px 10px 10px;
}

.card.starter:hover {
  background-color: #f1f1f1; /* Light grey background on hover */
}

.card.starter button {
  background-color: #1d731fd9;
  border-radius: 40px 0px 40px 0px;
  border-right: 7px solid orange;
}

.card.starter button:hover {
  background-color: #2b992dd9;
  border-radius: 40px 0px 40px 0px;
}

.standard {
  background-color: orange;
  color: white;
  border: 1px solid orange;
  border-radius: 10px 0px 50px 0px;
}

.card.standard {
  background-color: white;
  color: black;
  border: none;
  border-radius: 10px 0px 10px 10px;
}

.card.standard:hover {
  background-color: #f1f1f1; 
}

.card.standard button {
  background-color: orange;
  border-radius: 40px 0px 40px 0px;
  border-right: 7px solid rgb(255, 0, 0);
}

.card.standard button:hover {
  background-color: rgb(255, 186, 58);
  border-radius: 40px 0px 40px 0px;
}

.premium {
  background-color: rgb(255, 0, 0);
  color: white;
  border: 1px solid rgb(255, 0, 0);
  border-radius: 10px 0px 50px 0px;
}

.card.premium {
  background-color: white;
  color: black;
  border: none;
  border-radius: 10px 0px 10px 10px;
}

.card.premium:hover {
  background-color: #f1f1f1; /* Light grey background on hover */
}

.card.premium button {
  background-color: rgb(255, 0, 0);
  border-radius: 40px 0px 40px 0px;
  border-right: 7px solid #2b992dd9;
}

.card.premium button:hover {
  background-color: rgb(249, 73, 73);
  border-radius: 40px 0px 40px 0px;
}

/* Responsive styles */
@media (max-width: 576px) {
  .pricing-options {
    width: 100%;
    height: 180vh;
    padding: 20px;
    margin-top: 215%;
    margin-bottom: 5px;
  }

  .card {
    margin-bottom: 5px;
  }
}

@media (min-width: 577px) and (max-width: 768px) {
  .container {
    margin-bottom: 160%;
  }

  .pricing-options {
    width: 85%;
    height: 180vh;
    padding: 20px;
    margin-top: 120%;
    margin-bottom: 10px;
  }

  .card {
    margin-bottom: 20px;
  }
}

@media (min-width: 769px) and (max-width: 992px) {
  .pricing-options {
    width: 100%;
    height: 80vh;
  }
}

@media (min-width: 993px) and (max-width: 1224px) {
  .pricing-options {
    width: 30%;
    padding: none;
  }
}
</style>
