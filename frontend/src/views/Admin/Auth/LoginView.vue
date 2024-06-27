<template>
  <div class="flex items-center justify-center min-h-screen bg-gray-100">
    <el-card class="w-full max-w-md shadow-lg">
      <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
      <el-form @submit.prevent="onSubmit">
        <el-form-item :error="emailError">
          <el-input placeholder="Email Address" v-model="email" size="large" />
        </el-form-item>

        <el-form-item :error="passwordError" class="mt-8">
          <el-input placeholder="Password" v-model="password" size="large" type="password" />
        </el-form-item>
        
        <div>
          <el-button
            size="large"
            class="mt-3 w-full"
            :disabled="isSubmitting"
            type="primary"
            native-type="submit"
          >Submit</el-button>
        </div>
        
        <div v-if="apiError" class="mt-4 text-center text-red-500">
          {{ apiError }}
        </div>

        <div class="mt-4 text-center">
          <el-link href="/register">Don't have an account? Register</el-link>
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
import { useRouter } from 'vue-router';
import { useAuthStore } from '../../../stores/auth-store';
import type { AxiosError } from 'axios';

interface ErrorResponse {
  message: string;
}

const authStore = useAuthStore();
const router = useRouter();

const formSchema = yup.object({
  password: yup.string().required().label('Password'),
  email: yup.string().required().email().label('Email address'),
});

const { handleSubmit, isSubmitting } = useForm({
  initialValues: {
    password: '',
    email: '',
  },
  validationSchema: formSchema,
});

const apiError = ref('');

const onSubmit = handleSubmit(async (values) => {
  try {
    const response = await axios.post('http://127.0.0.1:8000/api/login', values);
    const data = response.data; 
    authStore.login(data); 
    router.push('/'); 
  } catch (error) {
    const axiosError = error as AxiosError<ErrorResponse>;
    if (axiosError.response && axiosError.response.data) {
      apiError.value = axiosError.response.data.message;
    } else {
      apiError.value = 'An unexpected error occurred.';
    }
  }
});

const { value: password, errorMessage: passwordError } = useField('password');
const { value: email, errorMessage: emailError } = useField('email');
</script>

<style scoped>
.min-h-screen {
  min-height: 100vh;
}
</style>
