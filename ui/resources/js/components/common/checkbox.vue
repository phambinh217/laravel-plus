<template>
  <div class="icheck-danger">
    <input :id="id" type="checkbox" :value="value" :checked="checked" :name="name" @change="handleChange" @input="handleInput">
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
    value: {
      default: undefined,
      type: String,
    },
    name: {
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
      this.$emit('input', $event.target.checked)
    }
  }
}
</script>
