import authApi from '../api/auth'

export default {
  install(Vue) {
    Vue.prototype.$api = {
      auth: authApi(Vue)
    }
  }
}

