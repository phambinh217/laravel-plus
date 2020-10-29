<template>
  <body class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="#"><b>Laravel</b>Plus</a>
      </div>
      <div v-if="errorMessage" class="alert alert-danger">{{ errorMessage }}</div>
      <div class="card">
        <div class="card-body login-card-body">
          <p class="login-box-msg">Đăng nhập</p>
          <form action="" method="post" @submit.prevent="submitFormLogin">
            <div class="input-group mb-3">
              <input v-model="email" type="email" class="form-control" placeholder="Nhập email">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope" />
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input v-model="password" type="password" class="form-control" placeholder="Nhập mật khẩu">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock" />
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-danger btn-block" :class="{ 'btn-loading': submitting }">Đăng nhập</button>
          </form>
        </div>
      </div>
    </div>
  </body>
</template>
<script>
import { mapActions } from 'vuex'

export default {
  layout: 'blank',
  middleware: 'guest',

  data () {
    return {
      email: 'phambinh.net@gmail.com',
      password: '123456',
      submitting: false,
      errorMessage: '',
    }
  },

  metaInfo: {
    title: 'Đăng nhập'
  },

  methods: {
    submitFormLogin () {
      this.submitting = true
      this.errorMessage = ''

      this.$api.auth.login({
        email: this.email,
        password: this.password
      }).then(({ data: response }) => {
        const { token, user } = response
        this.setAuth({
          accessToken: token,
          user: {
            id: user.id,
            email: user.email,
            name: user.name,
          }
        })
        this.$router.push({ name: 'home' })
      }).catch(({ message }) => {
        this.errorMessage = message
      }).finally(() => {
        this.submitting = false
      })
    },
    ...mapActions(['setAuth']),
  }
}
</script>
