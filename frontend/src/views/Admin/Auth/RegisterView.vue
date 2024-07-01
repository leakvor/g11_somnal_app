<!-- src/components/Register.vue -->
<template>
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
      <el-card class="w-full max-w-md shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-center">Register</h2>
        <el-form @submit="onSubmit">
          <el-form-item :error="emailError">
            <el-input placeholder="Email Address" v-model="email" size="large" />
          </el-form-item>
  
          <el-form-item :error="nameError" class="mt-4">
            <el-input placeholder="Full Name" v-model="name" size="large" />
          </el-form-item>
  
          <el-form-item :error="phoneError" class="mt-4">
            <el-input placeholder="Phone Number" v-model="phone" size="large" />
          </el-form-item>
  
          <el-form-item :error="passwordError" class="mt-4">
            <el-input placeholder="Password" v-model="password" size="large" type="password" />
          </el-form-item>
  
          <div class="mt-6">
            <el-button type="primary" native-type="submit" :loading="isSubmitting" class="w-full">
              Register
            </el-button>
          </div>
        </el-form>
      </el-card>
    </div>
  </template>
  
  <script>
  import axiosInstance from '@/plugins/axios'
  import { useField, useForm } from 'vee-validate'
  import * as yup from 'yup'
  import { useRouter } from 'vue-router'
  
  export default {
    setup() {
      const router = useRouter()
  
      const formSchema = yup.object({
        email: yup.string().required().email().label('Email address'),
        name: yup.string().required().label('Full Name'),
        phone: yup.string().nullable().label('Phone Number'),
        password: yup.string().required().label('Password'),
      })
  
      const { handleSubmit, isSubmitting } = useForm({
        initialValues: {
          email: '',
          name: '',
          phone: '',
          password: '',
        },
        validationSchema: formSchema,
      })
  
      const onSubmit = handleSubmit(async (values) => {
        try {
          const { data } = await axiosInstance.post('http://127.0.0.1:8000/api/register', values)
          localStorage.setItem('access_token', data.access_token)
          router.push('/login')
        } catch (error) {
          console.error('Registration Error:', error)
        }
      })
  
      const { value: email, errorMessage: emailError } = useField('email')
      const { value: name, errorMessage: nameError } = useField('name')
      const { value: phone, errorMessage: phoneError } = useField('phone')
      const { value: password, errorMessage: passwordError } = useField('password')
  
      return {
        email,
        name,
        phone,
        password,
        emailError,
        nameError,
        phoneError,
        passwordError,
        onSubmit,
        isSubmitting,
      }
    },
  }
  </script>
  
  <style scoped>
  .min-h-screen {
    min-height: 100vh;
  }
  </style>
  