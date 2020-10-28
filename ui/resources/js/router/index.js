import VueRouter from 'vue-router'
import Vue from 'vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    component: () => import('../pages/index'),
    name: 'index',
  },
  {
    path: '/',
    component: () => import('../pages/account'),
    name: 'account',
  },
]

const router = new VueRouter({
  routes,
  mode: 'hash',
})

export default router
