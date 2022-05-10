import {createApp} from 'vue'
import {createVueWait} from "vue-wait"
import App from './App.vue'
import axios from "axios"
import store from "@/store"
import router from "@/routes"
import {
  VTooltip,
  VClosePopper,
  Dropdown,
  Tooltip,
  Menu
} from 'floating-vue'

import './index.css'
import 'floating-vue/dist/style.css'

const axiosInstance = axios.create({
  withCredentials: true,
  baseURL: '/api',
})

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

const app = createApp(App)

app.config.globalProperties.$http = { ...axiosInstance }
app.config.globalProperties.$store = store
app.config.globalProperties.$router = router

app.use(store)
app.use(router)
app.use(createVueWait())
app.mount('#app')
app.directive('tooltip', VTooltip)
app.directive('close-popper', VClosePopper)

app.component('VDropdown', Dropdown)
app.component('VTooltip', Tooltip)
app.component('VMenu', Menu)
