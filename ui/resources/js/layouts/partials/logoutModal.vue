<template>
  <modal title="Logout?" :open="open" @close="close">
    <div class="modal-body">Do your want to logout</div>
    <div class="modal-footer text-right">
      <button class="btn btn-secondary" @click.prevent="close">Cancel</button>
      <button class="btn btn-danger" @click.prevent="handleLogout">Logout now</button>
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
