<template>
  <div class="icheck-danger">
    <input :id="id" type="radio" :checked="checked" :value="value" :name="name" @change="handleChange" @input="handleInput">
    <label class="form-check-label" :for="id"><slot />{{ label }}</label>
  </div>
</template>

<script>
import { strRandom } from '@/helpers/str'

export default {
  props: {
    id: {
      type: String,
      default () {
        return strRandom(5)
      }
    },
    label: {
      type: String,
      default: '',
    },
    name: {
      default: undefined,
      type: String,
    },
    value: {
      default: undefined,
      type: String,
    },
    checked: {
      type: Boolean,
      default: false,
    }
  },

  methods: {
    handleChange ($event) {
      this.$emit('change', $event)
    },

    handleInput ($event) {
      this.$emit('input', $event.target.value)
    }
  }
}
</script>
