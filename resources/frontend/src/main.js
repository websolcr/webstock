import {createApp} from 'vue'
import App from './App.vue'
import axios from "axios"

const axiosInstance = axios.create({
    withCredentials: true,
    baseURL: '/api',
})

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

const app = createApp(App)
app.config.globalProperties.$http = { ...axiosInstance }
app.mount('#app')
