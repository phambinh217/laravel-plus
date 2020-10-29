export default function ({ $axios }) {
  return {
    user() {
      return $axios.get('/api/account/user')
    },

    changePassword(data) {
      return $axios.put('/api/account/password', data)
    },

    update(data) {
      return $axios.put('/api/account', data)
    },
  }
}
