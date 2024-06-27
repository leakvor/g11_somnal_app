
import 'bootstrap/dist/css/bootstrap.min.css' // Import Bootstrap CSS
import './assets/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'
import ElementPlus from 'element-plus'
import 'element-plus/dist/index.css'
import customAxios from './plugins/axios'
import 'uno.css'
import { configure } from 'vee-validate'
import axios from './axios'


const app = createApp(App)

configure({
  validateOnInput: true
})

app.use(createPinia())
app.use(router.router)
app.use(router)
app.use(ElementPlus)
// app.use(router.simpleAcl)

app.config.globalProperties.$customAxios = customAxios
app.config.globalProperties.$axios = axios

app.mount('#app')