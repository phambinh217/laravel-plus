<template>
  <default-layout>
    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Dashboard</h1>
            </div>
          </div>
        </div>
      </div>
      <div class="content">
        <div class="container-fluid">
          Hello world
        </div>
      </div>
    </div>
  </default-layout>
</template>

<script>
import { mapActions } from 'vuex'
import defaultLayout from '../layouts/default'

export default {
  components: {
    defaultLayout,
  },

  created () {
    this.setActivedMenu(['dashboard'])
  },

  methods: {
    ...mapActions(['setActivedMenu'])
  }
}
</script>
