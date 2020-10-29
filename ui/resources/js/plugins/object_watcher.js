import { clone } from '../helpers/object'

export default class ObjectWatcher {
  constructor (object) {
    this.object = object
    this.backupObject = clone(this.object)

    return new Proxy(object, this.magicMethods(this))
  }

  static make (object) {
    return new ObjectWatcher(object)
  }

  values () {
    return this.object
  }

  isChanged () {
    return JSON.stringify(this.object) !== JSON.stringify(this.backupObject)
  }

  commitChange () {
    this.backupObject = clone(this.object)
  }

  magicMethods (instance) {
    return {
      get (target, property) {
        if (typeof instance[property] == 'function') {
          return instance[property].bind(instance)
        }

        return instance.object[property]
      },

      set (target, property, value) {
        instance.object[property] = value
        return true
      }
    }
  }
}
