import { createApp } from 'vue'
import './style.css'
import App from './App.vue'
import routes from './routes'
import axios from 'axios'

axios.defaults.baseURL = 'http://127.0.0.1:8000/api'

import { createMemoryHistory, createRouter, createWebHistory } from 'vue-router'
const router = createRouter({
  // history: createMemoryHistory(),
  history: createWebHistory(),
  routes,
})

const app = createApp(App)

app.use(router)
app.mount("#app")