import VueRouter from 'vue-router'
import Vue from 'vue'
import requiredAuth from './middlewares/requiredAuth'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    component: () => import('../pages/index'),
    name: 'home',
    meta: {
      middlewares: [
        requiredAuth
      ],
    }
  },
  {
    path: '/account',
    component: () => import('../pages/account'),
    name: 'account',
    meta: {
      middlewares: [
        requiredAuth
      ],
    }
  },
  {
    path: '/login',
    component: () => import('../pages/login'),
    name: 'login',
    meta: {
    }
  },
]

const router = new VueRouter({
  routes,
  mode: 'hash',
})

router.beforeEach((to, from, next) => {
  let middlewares = []
  for (let record of to.matched) {
    if (record.meta.middlewares) {
      middlewares = middlewares.concat(record.meta.middlewares)
    }
  }

  for (let middleware of middlewares) {
    return middleware(to, from, next)
  }

  next()
})

export default router
