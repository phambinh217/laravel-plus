export default function ({ $axios }) {
  return {
    changePassword(data) {
      return $axios.put('/api/account/password', data)
    },

    update(data) {
      return $axios.put('/api/account', data)
    },
  }
}
