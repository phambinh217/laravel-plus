import axios from 'axios'
import store from '../store'

export function extractErrors ({ response }) {
  const { status, data, statusText } = response
  const message = data.message || statusText
  const errors = data.errors || {}

  return { status, message, errors }
}

export default {
  install(Vue) {
    axios.defaults.baseURL = process.env.MIX_BASE_URL || 'http://localhost'

    if (store.state.auth.check) {
      axios.defaults.headers.common['Authorization'] = `Bearer ${store.state.auth.accessToken}`
    }

    axios.interceptors.response.use((response) => {
      return response
    }, (error) => {
      console.error(error)
      const extractedError = extractErrors(error)
      if (String(extractedError.status).startsWith('5')) {
        alert(extractedError.message)
      }

      return Promise.reject(extractedError)
    })

    Vue.prototype.$axios = axios
  }
}
