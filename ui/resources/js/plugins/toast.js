import Swal from 'admin-lte/plugins/sweetalert2/sweetalert2'

const toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
})

const $toast = {
  success (message) {
    return toast.fire({
      icon: 'success',
      title: message
    })
  },

  error (message) {
    return toast.fire({
      icon: 'error',
      title: message
    })
  }
}

export default {
  install (Vue) {
    Vue.prototype.$toast = $toast
    Vue.prototype.$alert = Swal
  }
}
