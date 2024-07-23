<template>
  <div class="pricing-options m-5">
    <h1 class="mt-2 d-flex justify-content-center text-success"><b>Pricing Options</b></h1>
    <div class="pricing-cards d-flex column mt-5">
      <div class="card starterfree" v-for="(option, index) in options" :key="index">
        <div class="free">
          <h3 class="mt-2">{{ option.type }}</h3>
          <h4 class="price">{{ option.amount === 0 ? 'Free' : option.amount + ' $' }}</h4>
        </div>
        <div class="card-title">
          <p class="mb-19 mt-3 p-2 word-break: break-word">{{ option.description }}</p>
        </div>
        <router-link
          v-if="authStore.isAuthenticated"
          :to="{ name: 'payment', params: { id: option.id } }"
          class="btn btn-success"
        >
          <b>{{ option.amount === 0 ? 'Get Now' : 'Buy Now' }}</b>
        </router-link>
        <button v-else @click="redirectToLogin" class="btn btn-success">
          <b>{{ option.amount === 0 ? 'Get Now' : 'Buy Now' }}</b>
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import { useAuthStore } from '../../../stores/auth-store.ts'
export default {
  name: 'PricingOptions',
  setup() {
    const authStore = useAuthStore()
    console.log(authStore)
    return {
      authStore
    }
  },
  data() {
    return {
      options: [],
      user_info: null
    }
  },
  mounted() {
    this.option_payment()
  },
  methods: {
    
    async option_payment() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/option/list')
        this.options = response.data.data
        console.log('Payment options', this.options)
      } catch (e) {
        console.log('Error on payment', e)
      }
    },
    async fetchUser() {
      try {
        const token = localStorage.getItem('access_token')
        const response = await axios.get('http://127.0.0.1:8000/api/me', {
          headers: {
            Authorization: `Bearer ${token}`
          }
        })
        this.user_info = response.data.data
        console.log('User info:', this.user_info)
      } catch (error) {
        console.error('Error fetching user:', error)
      }
    },
    redirectToLogin() {
      this.$router.push({ name: 'login' });
    }
  }
}
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
    margin-top: 35px;
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
