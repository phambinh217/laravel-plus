<template>
  <modal title="Đăng xuất tài khoản" :open="open" @close="close">
    <div class="modal-body">Bạn có muốn đăng xuất tài khoản</div>
    <div class="modal-footer text-right">
      <button class="btn btn-secondary" @click.prevent="close">Hủy</button>
      <button class="btn btn-danger" @click.prevent="handleLogout">Đăng xuất</button>
    </div>
  </modal>
</template>
<script>
import modal from '../../components/common/modal'
import { mapActions } from 'vuex'

export default {
  components: {
    modal,
  },

  props: {
    open: {
      type: Boolean,
      default: false,
    },
  },

  methods: {
    handleLogout () {
      this.logout()
      this.hideLogoutModal()
      this.$router.push('/login')
    },

    close () {
      this.hideLogoutModal()
    },

    ...mapActions([
      'hideLogoutModal',
      'logout',
    ])
  }
}
</script>
