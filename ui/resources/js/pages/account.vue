<template>
  <default-layout>
    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Your account</h1>
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
                  <h3 class="card-title">Personal information</h3>
                </div>
                <form action="" @submit.prevent="updateAccount">
                  <div class="card-body">
                    <div class="form-group">
                      <label>Email</label>
                      <input v-model="account.email" type="text" class="form-control" readonly>
                    </div>
                    <div class="form-group mb-0">
                      <label class="required">Name</label>
                      <input v-model="account.name" type="text" class="form-control" :class="{ 'is-invalid': accountValidator.hasError('name') }" placeholder="Enter your name">
                      <fv-message :message="accountValidator.getError('name')" />
                    </div>
                  </div>
                  <div class="card-footer text-right">
                    <button type="submit" :disabled="!account.isChanged()" :class="{ 'btn-loading': isUpdatingAccount }" class="btn min-width btn-danger">Save</button>
                  </div>
                </form>
              </div>
              <div class="card card-outline">
                <div class="card-header">
                  <h3 class="card-title">Change password</h3>
                </div>
                <form action="" @submit.prevent="changePassword">
                  <div class="card-body">
                    <div class="form-group">
                      <label class="required">New password</label>
                      <input v-model="password.password" type="password" class="form-control" :class="{ 'is-invalid': passwordValiator.hasError('password') }" placeholder="Enter your new password">
                      <fv-message :message="passwordValiator.getError('password')" />
                    </div>
                    <div class="form-group mb-0">
                      <label class="required">Passoword confirmation</label>
                      <input v-model="password.password_confirmation" type="password" class="form-control" :class="{ 'is-invalid': passwordValiator.hasError('password_confirmation') }" placeholder="Re-enter your password">
                      <fv-message :message="passwordValiator.getError('password_confirmation')" />
                    </div>
                  </div>
                  <div class="card-footer text-right">
                    <button :class="{ 'btn-loading': isUpdatingPassword }" :disabled="!password.isChanged()" class="btn min-width btn-danger">Save</button>
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

  metaInfo: {
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
        this.$toast.success('Saved successfully')
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
        this.$toast.success('Saved successfully')
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
