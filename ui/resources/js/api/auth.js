export default function ({ $axios }) {
  return {
    register(data) {
      return $axios.post('/api/auth/register', data)
    },

    login(data) {
      return $axios.post('/api/auth/login', data)
    },

    logout() {
      return $axios.put('/api/auth/logout')
    }
  }
}
