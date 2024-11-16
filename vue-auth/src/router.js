import { createMemoryHistory, createRouter } from 'vue-router'

import HomeView from './pages/HomeView.vue'
import RegisterView from './pages/RegisterView.vue'
import LoginView from './pages/LoginView.vue'

const routes = [
  { path: '/', component: HomeView },
  { path: '/register', component: RegisterView },
  { path: '/login', component: LoginView },
]

export default createRouter({
  history: createMemoryHistory(),
  routes,
})