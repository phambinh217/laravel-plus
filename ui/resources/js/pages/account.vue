<template>
  <default-layout>
    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Tài khoản của bạn</h1>
            </div>
          </div>
        </div>
      </div>
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-8 col-md-12">
              <div class="card card-outline">
                <div class="card-header">
                  <h3 class="card-title">Thông tin cá nhân</h3>
                </div>
                <form action="" @submit.prevent="updateAccount">
                  <div class="card-body">
                    <div class="form-group">
                      <label>Email</label>
                      <input v-model="account.email" type="text" class="form-control" readonly>
                    </div>
                    <div class="form-group mb-0">
                      <label class="required">Tên</label>
                      <input v-model="account.name" type="text" class="form-control" :class="{ 'is-invalid': accountValidator.hasError('name') }" placeholder="Nhập tên của bạn">
                      <fv-message :message="accountValidator.getError('name')" />
                    </div>
                  </div>
                  <div class="card-footer text-right">
                    <button type="submit" :disabled="!account.isChanged()" :class="{ 'btn-loading': isUpdatingAccount }" class="btn min-width btn-danger">Lưu</button>
                  </div>
                </form>
              </div>
              <div class="card card-outline">
                <div class="card-header">
                  <h3 class="card-title">Đổi mật khẩu</h3>
                </div>
                <form action="" @submit.prevent="changePassword">
                  <div class="card-body">
                    <div class="form-group">
                      <label class="required">Nhập mật khẩu mới</label>
                      <input v-model="password.password" type="password" class="form-control" :class="{ 'is-invalid': passwordValiator.hasError('password') }" placeholder="Nhập mật khẩu mới">
                      <fv-message :message="passwordValiator.getError('password')" />
                    </div>
                    <div class="form-group mb-0">
                      <label class="required">Nhập lại mật khẩu</label>
                      <input v-model="password.password_confirmation" type="password" class="form-control" :class="{ 'is-invalid': passwordValiator.hasError('password_confirmation') }" placeholder="Nhập lại mật khẩu">
                      <fv-message :message="passwordValiator.getError('password_confirmation')" />
                    </div>
                  </div>
                  <div class="card-footer text-right">
                    <button :class="{ 'btn-loading': isUpdatingPassword }" :disabled="!password.isChanged()" class="btn min-width btn-danger">Lưu</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </default-layout>
</template>

<script>
import { mapActions } from 'vuex'
import fvMessage from '../components/formValidator/message'
import Validator from '../plugins/validator'
import ObjectWatcher from '../plugins/object_watcher'
import defaultLayout from '../layouts/default'

export default {
  components: {
    fvMessage,
    defaultLayout,
  },

  data () {
    return {
      account: ObjectWatcher.make({
        email: this.$store.state.auth.user.email,
        name: this.$store.state.auth.user.name,
      }),

      accountValidator: Validator.make(),
      passwordValiator: Validator.make(),

      isUpdatingAccount: false,
      isUpdatingPassword: false,

      password: ObjectWatcher.make({
        password: '',
        password_confirmation: '',
      })
    }
  },

  head: {
    title: 'Tài khoản',
  },

  created () {
    this.setActivedMenu(['account'])
  },

  methods: {
    async updateAccount () {
      this.accountValidator.resetErrors()
      this.isUpdatingAccount = true

      this.$api.account.update({
        name: this.account.name
      }).then(() => {
        this.$toast.success('Đã lưu')
        this.setAuthUser({ name: this.account.name })
        this.account.commitChange()
      }).catch(({ message, errors }) => {
        this.accountValidator.setErrors(errors)
        this.$toast.error(message)
      }).finally(() => {
        this.isUpdatingAccount = false
      })
    },

    async changePassword () {
      this.passwordValiator.resetErrors()
      this.isUpdatingPassword = true

      this.$api.account.changePassword(this.password).then(() => {
        this.$toast.success('Đã lưu')
        this.password.password = ''
        this.password.password_confirmation = ''
        this.password.commitChange()
      }).catch(({ message, errors }) => {
        this.passwordValiator.setErrors(errors)
        this.$toast.error(message)
      }).finally(() => {
        this.isUpdatingPassword = false
      })
    },

    ...mapActions(['setActivedMenu', 'setAuthUser']),
  }
}
</script>
