<template>
  <div class="wrapper">
    <nav-header />
    <main-sidebar />
    <slot />
    <logout-modal :open="openLogoutModal" />
  </div>
</template>

<script>
import { mapActions } from 'vuex'
import mainSidebar from './partials/mainSidebar'
import navHeader from './partials/navHeader'
import logoutModal from './partials/logoutModal'

export default {
  components: {
    mainSidebar,
    navHeader,
    logoutModal
  },

  computed: {
    openLogoutModal () {
      return this.$store.state.openLogoutModal
    }
  },

  created () {
    this.init()
  },

  methods: {
    init () {
      this.$api.init.init().then(({ data: response }) => {
        this.setAuthUser(response.user)
      })
    },
    ...mapActions(['setAuthUser'])
  }
}
</script>
