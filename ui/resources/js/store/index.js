import Vue from 'vue'
import Vuex from 'vuex'
import createMutationsSharer from 'vuex-shared-mutations'
import createPersistedState from 'vuex-persistedstate'

Vue.use(Vuex)

const STORAGE_KEY = process.env.MIX_STORAGE_KEY

const store = new Vuex.Store({
  state() {
    return {
      activedMenu: ['dashboard'],
      openLogoutModal: false,

      auth: {
        check: false,
        accessToken: '',
        expiresAt: null,
        user: {
          id: '',
          email: '',
          name: ''
        },
      },
    }
  },

  getters: {
    getAuthAccessToken (state) {
      return state.auth.accessToken
    }
  },

  mutations: {
    setActivedMenu (state, menuName) {
      state.activedMenu = menuName
    },

    setOpenLogoutModal (state, status) {
      state.openLogoutModal = !!status
    },

    setAuthAccessToken (state, token) {
      state.auth.accessToken = token
    },

    setAuthUser (state, user) {
      for (let key in state.auth.user) {
        state.auth.user[key] = user[key]
      }
    },

    setAuthCheck (state, status) {
      state.auth.check = status
    },
  },

  actions: {
    setActivedMenu ({ commit }, payload) {
      commit('setActivedMenu', payload)
    },

    showLogoutModal ({ commit }) {
      commit('setOpenLogoutModal', true)
    },

    hideLogoutModal ({ commit }) {
      commit('setOpenLogoutModal', false)
    },

    setAuth ({ commit }, data) {
      // eslint-disable-next-line no-unused-vars
      let { accessToken, refreshToken, user } = data
      commit('setAuthCheck', true)
      commit('setAuthAccessToken', accessToken)
    },

    setAuthUser ({ commit }, user) {
      commit('setAuthUser', user)
    },

    logout ({ commit }) {
      commit('setAuthAccessToken', '')
      commit('setAuthUser', { id: '', email: '', name: '' })
      commit('setAuthCheck', false)
    }
  },

  plugins: [
    createPersistedState({
      key: STORAGE_KEY,
      paths: [
        'activedMenu',
        'openLogoutModal',
        'auth',
        'auth.check',
        'auth.accessToken',
        'auth.expiresAt',
        'auth.user',
        'auth.user.id',
        'auth.user.email',
        'auth.user.name',
      ],
    }),
    createMutationsSharer({ predicate: [] })
  ]
})

export default store
