import authApi from '../api/auth'
import accountApi from '../api/account'
import initApi from '../api/init'

export default {
  install(Vue) {
    Vue.prototype.$api = {
      auth: authApi(Vue.prototype),
      init: initApi(Vue.prototype),
      account: accountApi(Vue.prototype),
    }
  }
}

