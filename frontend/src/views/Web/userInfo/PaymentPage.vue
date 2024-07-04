<template>
  <div class="container d-flex justify-content-center">
    <div class="bg-white text-black d-flex row justify-content-center shadow bg-body rounded">
      <h2 class="d-flex justify-content-center mt-3">Pay here!</h2>
      <div class="payment-form mt-3">
        <div class="payment-options d-flex row justify-content-center">
          <img
            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS52vo3OYmQyqKFnbSxuSBkIbMW-MOuWNl88_70HoUNChhPaO7Aau3SmuVxg0LEgcQS4qU&usqp=CAU"
            class="w-27"
            alt="PayPal"
          />
          <img
            src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/48/MasterCard-Logo.svg/2560px-MasterCard-Logo.svg.png"
            class="w-27"
            alt="MasterCard"
          />
          <img
            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSpJDoLEj5bcbkQhxlFOl0vJQ6JH0TQUnd6auGYNM0XnL09iuHx82As_Gd7Ak4Xa6OCTIA&usqp=CAU"
            class="w-27"
            alt="Visa"
          />
          <img
            src="https://media.product.which.co.uk/prod/images/pr_4to3_400x300/0c57de7ae7aa-american-express.jpg"
            class="w-27"
            alt="American Express"
          />
        </div>
        <div class="form-group w-d-flex justify-content-center mt-3 m-3">
          <form @submit.prevent="fetchPayment">
            <div class="form-group">
              <label for="cardholder-name">Cardholder Name :</label>
              <input
                type="text"
                class="form-control border"
                id="cardholder-name" placeholder="Your name on card"
                v-model="cardName"
              />
            </div>
            <div class="form-group d-flex justify-content-between">
              <div class="form-group">
                <label for="card-number">Card Number :</label>
                <input
                  type="text"  placeholder="Must be 16 digits"
                  class="form-control w-100"
                  id="card-number"
                  v-model="cardNumber"
                />
                <span class="text-danger">{{ cardNumberMessage }}</span>
              </div>
              <div class="form-group">
                <label for="cvv">CVV :</label>
                <input type="text" placeholder="Example: 789" class="form-control w-100" id="cvv" v-model="cvv" />
                <span class="text-danger">{{ cvvMessage }}</span>
              </div>
            </div>
            <div class="form-group">
              <label for="expiry-date">MM/YY :</label>
              <input type="text" placeholder="Example: 12/24" class="form-control" id="expiry-date" v-model="expiration_date" />
              <span class="text-danger">{{ expirationMessage }}</span>
            </div>
            <div class="d-flex justify-content-center">
              <button
                type="submit"
                class="pay-button mt-3 rounded-pill w-60 h-12 bg-orange text-white"
                id="paynow"
              >
                <b>Pay Now</b>
              </button>
            </div>
          </form>
          <p style="margin-top: 20px"><span class="text-danger">Noted:</span> After you pay to our website successfully! We will change you to be a company owner. We logout your account and you must login with your old email and password.</p>
          <p>Thank you! Good luck</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import { useAuthStore } from '../../../stores/auth-store';
import { useRouter } from 'vue-router';

export default {
  data() {
    return {
      cardName: '',
      cardNumber: '',
      cvv: '',
      expiration_date: '',
      cardNumberMessage: '',
      expirationMessage: '',
      cvvMessage: '',
      role_id: 3
    }
  },
  setup() {
    const authStore = useAuthStore();
    const router = useRouter();
    return { authStore, router };
  },
  watch: {
    cardNumber(value) {
      this.validateCardNumber(value);
    },
    expiration_date(value) {
      this.validateExpirationDate(value);
    },
    cvv(value) {
      this.validateCVV(value);
    }
  },
  methods: {
    luhnCheck(cardNumber) {
      let sum = 0;
      let shouldDouble = false;
      for (let i = cardNumber.length - 1; i >= 0; i--) {
        let digit = parseInt(cardNumber.charAt(i));
        if (shouldDouble) {
          if ((digit *= 2) > 9) digit -= 9;
        }
        sum += digit;
        shouldDouble = !shouldDouble;
      }
      return (sum % 10) === 0;
    },
    isFutureDate(expiration_date) {
      const [month, year] = expiration_date.split('/').map(num => parseInt(num));
      const now = new Date();
      const currentMonth = now.getMonth() + 1; // getMonth() is zero-indexed
      const currentYear = now.getFullYear() % 100; // Get last two digits of year
      return (year > currentYear) || (year === currentYear && month >= currentMonth);
    },
    validateCardNumber(cardNumber) {
      if (cardNumber.length !== 16 || !this.luhnCheck(cardNumber)) {
        this.cardNumberMessage = 'Invalid card number';
      } else {
        this.cardNumberMessage = '';
      }
    },
    validateExpirationDate(expiration_date) {
      if (!this.isFutureDate(expiration_date)) {
        this.expirationMessage = 'Card is expired';
      } else {
        this.expirationMessage = '';
      }
    },
    validateCVV(cvv) {
      if (cvv.length === 3) {
        this.cvvMessage = '';
      } else {
        this.cvvMessage = 'CVV must be 3 digits';
      }
    },
    async fetchPayment() {
      try {
        this.validateCVV(this.cvv);
        
        if (this.cardNumberMessage || this.expirationMessage || this.cvvMessage) {
          return;
        }

        const token = localStorage.getItem('access_token');
        if (!token) {
          throw new Error('No token found');
        }

        const response = await axios.post(
          'http://127.0.0.1:8000/api/payment/create',
          {
            cardName: this.cardName,
            cardNumber: this.cardNumber,
            cvv: this.cvv,
            expiration_date: this.expiration_date,
          },
          {
            headers: {
              Authorization: `Bearer ${token}`,
            },
          }
        );
        console.log(response.data);

        if (response.data.success) {
          this.cardNumberMessage = '';
          this.expirationMessage = '';
          this.cvvMessage = '';
          alert('Payment created successfully.');
          await this.updateProfile();
          this.authStore.logout();
          this.router.push('/');
        }
      } catch (error) {
        this.cardNumberMessage = 'Invalid card number';
      }
    },
    async updateProfile() {
      try {
        const token = localStorage.getItem('access_token');
        if (!token) {
          throw new Error('No token found');
        }

        const response = await axios.post(
          'http://127.0.0.1:8000/api/updateProfile',
          { role_id: this.role_id },
          {
            headers: {
              'Content-Type': 'application/json',
              Authorization: `Bearer ${token}`,
            },
          }
        );

        console.log('Profile updated successfully:', response.data);
      } catch (error) {
        console.error('Error updating profile:', error);
      }
    },
  },
}
</script>


<style scoped>
.container {
  width: 100%;
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
}
.bg-white {
  width: 50%;
  padding: 10px;
  border-radius: 10px;
  background-color: white;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}
#paynow {
  background-color: rgb(3, 104, 3);
  border-radius: 10px;
  border-bottom: 5px solid rgb(207, 95, 4);
  border-top: none;
  border-left: none;
  border-right: none;
}
#paynow:hover {
  background-color: rgb(3, 136, 9);
}
/* Responsive Styles */
@media (max-width: 620px) {
  .container {
    width: 100%;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .bg-white {
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
  .container {
    width: 100%;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .bg-white {
    width: 100%;
    border-radius: 10px;
    background-color: white;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
  }
  .payment-options img {
    width: 22% !important;
  }
  form {
    padding: 2rem;
  }
  .form-group {
    margin: 0.5rem 0 !important;
  }
  .form-control {
    width: 100% !important;
    padding: 1rem;
  }
  .pay-button {
    width: 60% !important;
    height: 3.5rem !important;
  }
}
</style>
