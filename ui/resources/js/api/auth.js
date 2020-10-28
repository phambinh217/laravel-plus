export default function ({ $axios }) {
  return {
    register(data) {
      return $axios.post('/api/auth/register', data)
    },

    login(data) {
      return $axios.post('/api/auth/login', data)
    },

    changePassword(data) {
      return $axios.put('/api/auth/password', data)
    },

    logout() {
      return $axios.put('/api/auth/logout')
    },

    user() {
      return $axios.get('/api/auth/user')
    }
  }
}
