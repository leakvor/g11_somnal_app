<template>
  <div class="container d-flex justify-content-center  ">
    <div class="bg-white text-black d-flex row justify-content-center shadow bg-body rounded ">
      <h2 class="d-flex justify-content-center mt-3">Pay here!</h2>
      <div class="payment-form mt-3">
        <div class="payment-options d-flex row justify-content-center">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS52vo3OYmQyqKFnbSxuSBkIbMW-MOuWNl88_70HoUNChhPaO7Aau3SmuVxg0LEgcQS4qU&usqp=CAU" class="w-27 " alt="PayPal" />
          <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/48/MasterCard-Logo.svg/2560px-MasterCard-Logo.svg.png" class="w-27 " alt="PayPal" />
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSpJDoLEj5bcbkQhxlFOl0vJQ6JH0TQUnd6auGYNM0XnL09iuHx82As_Gd7Ak4Xa6OCTIA&usqp=CAU" class="w-27" alt="PayPal" />
          <img src="https://media.product.which.co.uk/prod/images/pr_4to3_400x300/0c57de7ae7aa-american-express.jpg" class="w-27" alt="PayPal" />
        </div>
        <div class="form-group w-d-flex justify-content-center mt-3 m-3">
          <form>
            <div class="form-group">
              <label for="cardholder-name">Company Name :</label>
              <input type="text" class="form-control border" id="cardholder-name">
            </div>
            <div class="form-group d-flex justify-content-between">
              <div class="form-group">
                <label for="card-number">Email addre:</label>
                <input type="text" class="form-control w-100 " id="card-number">
              </div>
              <div class="form-group">
                <label for="cvv">Phone Number:</label>
                <input type="text" class="form-control w-100" id="cvv">
              </div>
            </div>
            <div class="form-group">
              <label for="cardholder-name">Cardholder Name :</label>
              <input type="text" class="form-control border" id="cardholder-name">
            </div>
            <div class="form-group d-flex justify-content-between">
              <div class="form-group">
                <label for="card-number">Card Number :</label>
                <input type="text" class="form-control w-100 " id="card-number">
              </div>
              <div class="form-group">
                <label for="cvv">CVV :</label>
                <input type="text" class="form-control w-100" id="cvv">
              </div>
            </div>
            <div class="form-group">
              <label for="expiry-date">MM/YY :</label>
              <input type="text" class="form-control" id="expiry-date">
            </div>
            <div class="d-flex justify-content-center" >
              <button type="submit" class="pay-button mt-3 rounded-pill w-60 h-12 bg-orange text-white " id="paynow"><b>Pay Now</b></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>



<style scoped>
  .container{
    width: 100%;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    
  } 
  .bg-white{
    width: 50%;
    padding: 10px;
    border-radius: 10px;
    background-color: white;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
  }
    #paynow{
        background-color: rgb(3, 104, 3);
        border-radius: 10px;
        border-bottom: 5px solid rgb(207, 95, 4);
        border-top: none;
        border-left: none;
        border-right: none;


      
    }
    #paynow:hover{
      background-color: rgb(3, 136, 9);

      
    }
  /* Responsive Styles */
  @media (max-width: 620px) {
    .container{
    width: 100%;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    
  }
    .bg-white{
    width: 100%;
    border-radius: 10px;
    background-color: white;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
  }

    .payment-options img {
      width: 20% !important;
    }

    .form-group {
      margin: 1rem 0 !important;
     
    }

    .pay-button {
      width: 80% !important;
      height: 3rem !important;

    }
  }

  @media (min-width: 768px) and (max-width: 1024px) {
    .container{
    width: 100%;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    
  }
    .bg-white{
    width: 100%;
    border-radius: 10px;
    background-color: white;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
  }
    .payment-options img {
      width: 22% !important;
    }

    form{
        padding: 2rem;

    }

    .form-group {
      margin: 0.5rem 0 !important;
    
    }
    .form-control{
      width: 100% !important;
      padding: 1rem;
    }

    .pay-button {
      width: 60% !important;
      height: 3.5rem !important;
    }
  }
</style>