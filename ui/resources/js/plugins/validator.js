export default class Validator {
  constructor() {
    this.errors = []
  }

  static make() {
    return new Validator()
  }

  resetErrors() {
    this.errors = []
  }

  setErrors(errors) {
    this.errors = errors
  }

  getError(field) {
    return this.errors[field]
  }

  hasError(field) {
    return !!this.errors[field]
  }
}
