<template>
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
      <el-card class="w-full max-w-md shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-center">Forgot Password</h2>
        <el-form @submit.prevent="onSubmit">
          <el-form-item :error="emailError">
            <el-input placeholder="Email Address" v-model="email" size="large" />
          </el-form-item>
          
          <div>
            <el-button
              size="large"
              class="mt-3 w-full"
              :disabled="isSubmitting"
              type="primary"
              native-type="submit"
            >Send Reset Link</el-button>
          </div>
          
          <div v-if="apiError" class="mt-4 text-center text-danger">
            {{ apiError }}
          </div>
  
          <div v-if="successMessage" class="mt-4 text-center text-success">
            {{ successMessage }}
          </div>
        </el-form>
      </el-card>
    </div>
  </template>
  
  <script setup lang="ts">
  import { ref } from 'vue';
  import axios from 'axios';
  import { useField, useForm } from 'vee-validate';
  import * as yup from 'yup';
  import type { AxiosError } from 'axios';
  
  interface ErrorResponse {
    message: string;
  }
  
  const formSchema = yup.object({
    email: yup.string().required().email().label('Email address'),
  });
  
  const { handleSubmit, isSubmitting } = useForm({
    initialValues: {
      email: '',
    },
    validationSchema: formSchema,
  });
  
  const apiError = ref('');
  const successMessage = ref('');
  
  const onSubmit = handleSubmit(async (values) => {
    try {
      const response = await axios.post('http://127.0.0.1:8000/api/forgot-password', values);
      successMessage.value = response.data.message;
    } catch (error) {
      const axiosError = error as AxiosError<ErrorResponse>;
      if (axiosError.response && axiosError.response.data) {
        apiError.value = axiosError.response.data.message;
      } else {
        apiError.value = 'An unexpected error occurred.';
      }
    }
  });
  
  const { value: email, errorMessage: emailError } = useField('email');
  </script>
  
  <style scoped>
  .text-danger {
    color: #ff5b5b;
  }
  .text-success {
    color: #28a745;
  }
  </style>