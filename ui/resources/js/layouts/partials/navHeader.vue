<template>
  <nav class="main-header navbar navbar-expand navbar-dark navbar-dark navbar-fixed-top">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars" /></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a :href="'/' | homeUrl" class="nav-link">Trang chủ</a>
      </li>
    </ul>
    <form class="form-inline ml-auto">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search" />
          </button>
        </div>
      </div>
    </form>
    <ul class="navbar-nav ml-2">
      <li class="nav-item">
        <a class="nav-link text-danger cursor-pointer" href="/" role="button" @click.prevent="showLogoutModal">
          <i class="fas fa-power-off" />
        </a>
      </li>
    </ul>
  </nav>
</template>

<script>
import { mapActions } from 'vuex'
import { homeUrl } from '../..//helpers/url'

export default {
  filters: {
    homeUrl,
  },

  methods: {
    ...mapActions(['showLogoutModal']),
  }
}
</script>
