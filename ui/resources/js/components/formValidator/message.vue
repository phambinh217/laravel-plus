<template>
  <div>
    <span v-for="(messageItem, index) in messages" :key="index" class="error invalid-feedback">{{ messageItem }}</span>
  </div>
</template>

<script>
export default {
  props: {
    message: {
      default: '',
      type: [String, Array],
    }
  },

  computed: {
    messages () {
      if (!Array.isArray(this.message)) {
        return [this.message]
      }

      return this.message
    }
  }
}
</script>
