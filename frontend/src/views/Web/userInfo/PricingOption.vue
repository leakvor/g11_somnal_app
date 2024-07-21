<template>
    <div class="container d-flex justify-content-center">
      <div class="pricing-options m-5 ">
        <h1 class="mt-2 d-flex justify-content-center text-success"><b>Pricing Options</b></h1>
        <div class="pricing-cards d-flex column mt-5">
          <div class="card starterfree">
            <div class="free">
              <h3 class="mt-2">STARTERS</h3>
              <h4 class="price">Free</h4>
            </div>
             <p class="mb-19 mt-3 p-2 word-break: break-word">Free <b>30 days </b> for all of you first join with us. give the trust and hight  quality if you choose our app for use.</p>
             <button type="button"><b>Get Started</b></button>
          </div>
          <div class="card starter">
            <div class="starter">
              <h3 class="mt-2">STARTER</h3>
              <h4 class="price">$10/month</h4>
            </div>
             <p class="mb-19 mt-3 p-2 word-break: break-word">In this case you need to pay <b>$10 a month</b> if you don't pay on time  or 3 days after deadline we will cut a money from you and disable your account.</p>
             <button type="button"><b>Get Started</b></button>
          </div>
          <div class="card standard">
            <div class="standard">
              <h3 class="mt-2">STANDARD</h3>
              <h4 class="price ">$55/months</h4>
            </div>
            <p class="mb-13 mt-3 word-break: break-word p-2 ">For in case you need to pay <b>$55/half of year</b>  you will got $5 profit  for you. But if you don't pay on time we will cut a money from you and disable you account Auto matice.</p>
            <button type="button"><b>Get Started</b></button>
          </div>
          <div class="card premium">
            <div class="premium">
              <h3 class="mt-2">PREMIUM</h3>
              <h4 class="price">$100/year</h4>
            </div>
            <p class=" mt-3 mb-4 word-break: break-word  p-2">About this one if you want to pay <b>$100/year</b> you will got $10 profit for you, In this case it's every good for you. But if you don't pay on time we will penalty you as a money $15 from you and disable your account automatic also.</p>
            <button type="button"><b>Get Started</b></button>
          </div>
        </div>
      </div>
    </div>
</template>

<script>

export default {
  name: "PricingOptions",
};
</script>

<style scoped>
.container {
  width: 100%;
  display: flex;
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
  transition: all 0.3s ease;
}

.card button {
  color: white;
  border: none;
  padding: 10px 20px;
  cursor: pointer;
}

.card:hover {
  transform: scale(1.05);
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.card .starterfree {
  background-color: white;
  color: black;
  border-radius: 15px 0px 10px 10px;
}

.card .starterfree:hover {
  background-color: white;
}

.free {
  background-color: #14a85efc;
  color: white;
  border-radius: 10px 0px 50px 0px;
}

.card.starterfree button {
  background-color: #14a85efc;
  border-radius: 40px 0px 40px 0px;
  margin-top: 2px;
  width: 90%;
  margin-left: 12px;
}

.starter {
  background-color: rgb(255, 185, 55);
  color: white;
  border-radius: 10px 0px 50px 0px;
}

.card.starter {
  background-color: white;
  color: black;
  border: none;
  border-radius: 15px 0px 10px 10px;
}

.card.starter:hover {
  background-color: #f1f1f1;
}

.card.starter button {
  background-color: orange;
  border-radius: 40px 0px 40px 0px;
  margin-top: 7px;
  width: 90%;
  margin-left: 12px;
}

.card.starter button:hover {
  background-color: orange;
  border-radius: 40px 0px 40px 0px;
}

.standard {
  background-color: rgba(83, 80, 252, 0.869);
  color: white;
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
  background-color: rgba(83, 80, 252, 0.869);
  border-radius: 40px 0px 40px 0px;
  margin-top: 10px;
  width: 90%;
  margin-left: 12px;
}

.card.standard button:hover {
  background-color: rgba(106, 103, 250, 0.869);
  border-radius: 40px 0px 40px 0px;
}

.premium {
  background-color: rgb(255, 65, 65);
  color: white;
  border-radius: 10px 0px 50px 0px;
}

.card.premium {
  background-color: white;
  color: black;
  border: none;
  border-radius: 10px 0px 10px 10px;
}

.card.premium:hover {
  background-color: #f1f1f1;
}

.card.premium button {
  background-color: rgb(250, 52, 52);
  border-radius: 40px 0px 40px 0px;
  width: 90%;
  margin-left: 12px;
}

.card.premium button:hover {
  background-color: rgb(237, 78, 78);
  border-radius: 40px 0px 40px 0px;
}

/* Responsive styles */
@media (min-width: 576px) {
  .card {
    width: 80%;
  }
}

@media (min-width: 768px) {
  .card {
    width: 40%;

  }
  .card.starterfree button {
  border-radius: 40px 0px 40px 0px;
  margin-top: 30px;
  width: 90%;
  margin-left: 12px;
}
.card.premium button {
  border-radius: 40px 0px 40px 0px;
  margin-top: 30px;
  width: 90%;
  margin-left: 12px;
}
.card.standard button {
  background-color: rgba(83, 80, 252, 0.869);
  border-radius: 40px 0px 40px 0px;
  margin-top: 30px;
  width: 90%;
  margin-left: 12px;
}
}

@media (min-width: 992px) {
  .card {
    width: 40%;

  }
}

@media (min-width: 1200px) {
  .card {
    width: 23%;
  }
  .card.starterfree button {
  border-radius: 40px 0px 40px 0px;
  margin-top:35px;
  width: 90%;
  margin-left: 12px;
}
.card.premium button {
  border-radius: 40px 0px 40px 0px;
  margin-top: 9px;
  width: 90%;
  margin-left: 12px;
}
.card.standard button {
  background-color: rgba(83, 80, 252, 0.869);
  border-radius: 40px 0px 40px 0px;
  margin-top: 10px;
  width: 90%;
  margin-left: 12px;
}
}
</style>
