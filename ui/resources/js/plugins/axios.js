import axios from 'axios'

export default {
  install(Vue) {
    axios.defaults.baseURL = process.env.MIX_BASE_URL || 'https://phambinh.net'
    Vue.prototype.$axios = axios
  }
}
