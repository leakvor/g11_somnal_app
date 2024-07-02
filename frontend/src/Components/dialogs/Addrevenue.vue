<template>
  <div class="dialog">
    <button @click="toggleForm" class="btn-add">+ ADD</button>
    <!-- Modal -->
    <div class="dialog-form" v-if="isShow" @click="toggleForm">
      <form @submit.prevent="submitForm" @click.stop class="rounded">
        <span class="close" @click="closeForm">&times;</span>
        <h3 class="text-center pt-3">Add New Revenue</h3>
        <div class="form-group">
          <label for="item">Item:</label>
          <input type="text" id="item" v-model="formData.item" placeholder="Enter item name" required>
        </div>
        <div class="form-group">
          <label for="customer">Customer Name:</label>
          <input type="text" id="customer" v-model="formData.customer" placeholder="Customer's full name" required>
        </div>
        <div class="form-group">
          <label for="date">Date:</label>
          <input type="date" id="date" v-model="formData.date" required>
        </div>
        <div class="form-group">
          <label for="earn">Earnings ($):</label>
          <input type="number" id="earn" v-model="formData.earn" placeholder="Enter earnings" required>
        </div>
        <div class="form-buttons">
          <button type="submit" class="btn btn-primary">Add more</button>
          <button type="button" class="btn btn-secondary" @click="closeForm">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref, defineEmits } from 'vue';

const isShow = ref(false);
const formData = ref({
  item: '',
  customer: '',
  date: '',
  earn: ''
});

const emit = defineEmits(['submit']);

function toggleForm() {
  isShow.value = true;
}

function closeForm() {
  isShow.value = false;
  clearForm();
}

function clearForm() {
  formData.value = {
    item: '',
    customer: '',
    date: '',
    earn: ''
  };
}

function submitForm() {
  if (formData.value.item && formData.value.customer && formData.value.date && formData.value.earn) {
    emit('submit', { ...formData.value });
    closeForm(); // Close the modal after submission
  } else {
    alert("Please fill all the fields before adding an entry.");
  }
}
</script>
  
  <style scoped>
  .dialog .btn-add {
    background-color: green;
    color: white;
    border: none;
    border-radius: 4px;
    height: 45px;
    width: 80px;
  }
  /* Modal style */
  .dialog-form {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100vh;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(5px);
  }
  
  form {
    width: 40rem;
    padding: 2rem;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    position: relative;
  }
  
  .close {
    position: absolute;
    top: 10px;
    right: 15px;
    font-size: 24px;
    cursor: pointer;
  }
  
  h3 {
    margin-bottom: 1.5rem;
    color: #333;
  }
  
  .form-group {
    margin-bottom: 1.5rem;
  }
  
  label {
    display: block;
    margin-bottom: 0.5rem;
    color: #666;
  }
  
  input {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 1rem;
    color: #333;
  }
  
  input:focus {
    border-color: #007bff;
    outline: none;
  }
  
  .form-buttons {
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
  }
  
  .btn {
    padding: 0.75rem 1.5rem;
    border-radius: 4px;
    border: none;
    cursor: pointer;
    font-size: 1rem;
  }
  
  .btn-primary {
    background-color: #007bff;
    color: #fff;
  }
  
  .btn-primary:hover {
    background-color: #0056b3;
  }
  
  .btn-secondary {
    background-color: red;
    color: #fff;
  }
  
  .btn-secondary:hover {
    background-color: #5a6268;
  }
  </style>
  