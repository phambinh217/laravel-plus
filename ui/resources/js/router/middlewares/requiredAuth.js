import store from '../../store'

export default function (to, from, next) {
  const isLogin = store.state.auth.check
  if (!isLogin) {
    return next({ name: 'login' })
  }
  next()
}
