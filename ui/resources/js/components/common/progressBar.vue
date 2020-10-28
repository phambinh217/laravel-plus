<template>
  <div class="progress">
    <div
      class="progress-bar progress-bar-striped progress-bar-animated"
      role="progressbar"
      :style="{ width: `${percent}%` }"
      :aria-valuenow="percent"
      aria-valuemin="0"
      aria-valuemax="100"
    />
  </div>
</template>

<script>
export default {
  props: {
    percent: {
      type: Number,
      default: 0,
      validator (value) {
        return value <= 100
      }
    }
  },
}
</script>

<style lang="scss" scoped>
  .progress {
    height: 5px;
  }
</style>
