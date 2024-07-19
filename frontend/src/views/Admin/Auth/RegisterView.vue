<template>
  <div class="flex items-center justify-center min-h-screen bg-gray-100">
    <el-card class="w-full max-w-md shadow-lg">
      <h2 class="text-2xl font-bold mb-6 text-center">Register</h2>
      <el-form @submit.prevent="onSubmit">
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

        <span class="text-danger" v-if="messageError">{{ messageError }}</span>

        <div class="mt-6">
          <el-button type="primary" native-type="submit" :loading="isSubmitting" class="w-full">
            Register
          </el-button>
        </div>
        <div class="mt-4 text-center">
          <router-link to="/login">Do have an account?</router-link>
        </div>
      </el-form>
    </el-card>
  </div>
</template>

<script>
import axiosInstance from '@/plugins/axios'
import { useForm, useField } from 'vee-validate'
import * as yup from 'yup'
import { useRouter } from 'vue-router'

export default {
  setup() {
    const router = useRouter()
    const { handleSubmit, isSubmitting, errors } = useForm({
      validationSchema: yup.object({
        email: yup
          .string()
          .required('Email is required')
          .email('Must be a valid email')
          .test('checkUniqueEmail', 'Email already exists', async function (value) {
            try {
              const response = await axiosInstance.post('http://127.0.0.1:8000/api/check-email', {
                email: value
              })
              console.log(value);
              return response.data.unique
            } catch (error) {
              console.error('Error checking email uniqueness:', error)
              return false
            }
          })
          .label('Email address'),
        name: yup.string().required().label('Full Name'),
        phone: yup
          .string()
          .required()
          .matches(/^[0-9]+$/, 'Phone number must be digits only')
          .min(10, 'Phone number must be at least 10 digits')
          .label('Phone Number'),
        password: yup
          .string()
          .required()
          .min(8, 'Password must be at least 8 characters')
          .label('Password')
      })
    })

    const { value: email, errorMessage: emailError } = useField('email')
    const { value: name, errorMessage: nameError } = useField('name')
    const { value: phone, errorMessage: phoneError } = useField('phone')
    const { value: password, errorMessage: passwordError } = useField('password')

    const onSubmit = handleSubmit(async (values) => {
      try {
        const { data } = await axiosInstance.post('http://127.0.0.1:8000/api/register', values)
        localStorage.setItem('access_token', data.access_token)
        router.push('/login')
      } catch (error) {
        console.error('Registration Error:', error.response?.data || error.message)
        errors.messageError = error.response?.data?.message || error.message
      }
    })

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
      messageError: errors.messageError
    }
  }
}
</script>