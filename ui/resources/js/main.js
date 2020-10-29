/* eslint-disable no-unused-vars */
import Vue from 'vue'
import App from './App.vue'
import VueAxios from './plugins/axios'
import VueToast  from './plugins/toast'
import VueMeta from 'vue-meta'
import VueLodash from 'vue-lodash'
import lodash from 'lodash'
import ResourceApi from './plugins/api'
import router from './router'
import store from './store'

import './assets/scss/style.scss'

const $ = require('jquery')
const jQuery = $
window.$ = window.jQuery = $
window.Popper = require('popper.js')
window.Vue = Vue
window.bus = new Vue

require('bootstrap')
require('admin-lte')

Vue.use(VueMeta)
Vue.use(VueAxios)
Vue.use(ResourceApi)
Vue.use(VueToast)
Vue.use(VueLodash, { name: 'custom' , lodash: lodash })

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

new Vue({
  render: h => h(App),
  router,
  store,
}).$mount('#app')
