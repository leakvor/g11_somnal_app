<template>
  <div class="container mt-10 d-flex justify-content-center">
    <div class="bg-white d-flex row justify-content-center shadow bg-body rounded">
      <h2 class="d-flex justify-content-center mt-3">Pay here!</h2>
      <div class="payment-form mt-3">
        <div class="payment-options d-flex row justify-content-center">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS52vo3OYmQyqKFnbSxuSBkIbMW-MOuWNl88_70HoUNChhPaO7Aau3SmuVxg0LEgcQS4qU&usqp=CAU" class="w-27 " alt="PayPal" />
          <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/48/MasterCard-Logo.svg/2560px-MasterCard-Logo.svg.png" class="w-27 " alt="PayPal" />
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSpJDoLEj5bcbkQhxlFOl0vJQ6JH0TQUnd6auGYNM0XnL09iuHx82As_Gd7Ak4Xa6OCTIA&usqp=CAU" class="w-27" alt="PayPal" />
          <img src="https://media.product.which.co.uk/prod/images/pr_4to3_400x300/0c57de7ae7aa-american-express.jpg" class="w-27" alt="PayPal" />
        </div>
        <div class="form-group w-d-flex justify-content-center mt-5 m-5">
          <form>
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
              <button type="submit" class="pay-button mt-5 border rounded-pill w-55 h-10 bg-orange " id="paynow" >Pay Now</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<style>
    #paynow{
        border-bottom: 6px solid;
    }
  /* Responsive Styles */
  @media (max-width: 767px) {
    .container {
      margin-top: 5rem !important;
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

  @media (min-width: 768px) and (max-width: 1199px) {
    .container {
      margin-top: 7rem !important;

    }

    .payment-options img {
      width: 22% !important;
    }

    form{
        padding: 2rem ;
    }

    .form-group {
      margin: 1.5rem 0 !important;
    }

    .pay-button {
      width: 60% !important;
      height: 3.5rem !important;
    }
  }
</style>