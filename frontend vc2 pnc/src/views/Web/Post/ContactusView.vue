<template>
  <div class="contact-us">
    <main>
      <div class="contact-form-container">
        <img src="../../../assets/contact image/contactusImg.png" alt="Worker" class="contactusImg" />
        <div class="contact-form">
          <h2>Contact Us</h2>
          <form @submit.prevent="submitForm">
            <div class="form-group">
              <label for="fullName">Full Name:</label>
              <input type="text" id="fullName" v-model="form.fullName" required />
            </div>
            <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" id="email" v-model="form.email" required />
            </div>
            <div class="form-group">
              <label for="description">Description:</label>
              <textarea id="description" v-model="form.description" required></textarea>
            </div>
            <button type="submit">Submit</button>
          </form>
        </div>
      </div>
      <footer>
        <div class="contact-info">
          <div class="info-item1">
            <img src="../../../assets/contact image/call.png" alt="" width="70px" height="70px">
            <span>097 777 999 80</span>
          </div>
          <div class="info-item">
           <img src="../../../assets/contact image/map.png" alt="" width="50px" height="50px">
            <span>#371 Phum Tropeang Chhuksangkat Tek Thla, Khan Sen Sok, Phnom Penh.</span>
          </div>
          <div class="info-item1">
            <img src="../../../assets/contact image/mail.png" alt="" width="60px" height="50px">
            <span>somnal@gmail.com</span>
          </div>
        </div>
      </footer>
    </main>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        fullName: '',
        email: '',
        description: ''
      }
    };
  },
  methods: {
    submitForm() {
      // Handle form submission
      console.log('Form submitted', this.form);
    }
  }
};
</script>

<style scoped>
.contact-us {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  color: #333;
  line-height: 1.6;
}

.contact-form-container {
  position: relative;
  text-align: center;
}

.contactusImg {
  width: 100%;
  height: auto;
  display: block;
}

.contact-form {
  position: absolute;
  top: 50%;
  left: 70%;
  transform: translate(-50%, -50%);
  background-color: rgba(255, 255, 255, 0.95);
  padding: 20px 30px;
  border-radius: 10px;
  box-shadow: 0px -10px 1px orange; 
  max-width: 400px;
  width: 100%;
  text-align: left;
}

.contact-form h2 {
  margin-top: 0;
  color: #444;
  display:  flex;
  /* align-items: center; */
  justify-content: center;
}

.contact-form .form-group {
  margin-bottom: 15px;
}

.contact-form label {
  display: block;
  margin-bottom: 5px;
  font-weight: bold;
}

.contact-form input,
.contact-form textarea {
  width: calc(100% - 20px);
  padding: 10px;
  border: 1px solid #6e6b6b;
  border-radius: 10px;
  margin-bottom: 10px;
  font-size: 16px;
}

.contact-form input:focus,
.contact-form textarea:focus {
  border-color: #007bff;
  outline: none;
}

.contact-form button {
  background-color: #007bff;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
  /* width: 100px; */
}

.contact-form button:hover {
  background-color: #0056b3;
}

footer {
  background-color: #f0f0f0;
  padding: 20px;
  text-align: center;
}

.contact-info {
  display: flex;
  justify-content: space-around;
  flex-wrap: wrap;
}

.info-item,
.info-item1 {
  display: flex;
  flex-direction: column;
  align-items: center;
  background: white;
  border: 1px solid #a8a3a3;
  border-radius: 10px;
  padding: 20px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  transition: box-shadow 0.3s ease;
  margin: 10px;
  width: 250px;
  }
  
  .info-item {
    box-shadow: 0 10px 1px rgb(26, 104, 26);
  }
  .info-item1 {
    box-shadow: 0 10px 1px rgb(212, 158, 7);
  }
  .info-item i {
    font-size: 24px;
    color: #007bff;
    margin-bottom: 10px;
  }
  
  .info-item span {
    text-align: center;
  }
  </style>
