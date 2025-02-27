import { createRouter, createWebHistory } from 'vue-router'
import Dashboard from '../views/DashboardView.vue'
import AddClothingItems from '@/views/AddClothingItems.vue'

const routes = [
  { path: '/', component: Dashboard },
  { path: '/dashboard', component: Dashboard },
  { path: '/add', component: AddClothingItems },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
