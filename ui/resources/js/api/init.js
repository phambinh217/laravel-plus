export default function ({ $axios }) {
  return {
    init () {
      return $axios.get('/api/init')
    }
  }
}
