import {createApp} from 'vue'
import {createVueWait} from "vue-wait"
import App from './App.vue'
import axios from "axios"
import store from "@/store"

import './index.css'

const axiosInstance = axios.create({
  withCredentials: true,
  baseURL: '/api',
})

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

const app = createApp(App)

app.config.globalProperties.$http = { ...axiosInstance }
app.config.globalProperties.$store = store

app.use(store)
app.use(createVueWait())
app.mount('#app')
