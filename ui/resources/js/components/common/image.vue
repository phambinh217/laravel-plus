<template>
  <div class="image-container">
    <img :src="src" class="img-fluid image absolute-center position-absolute">
  </div>
</template>

<script>
export default {
  props: {
    src: {
      type: String,
      default: '',
    },
    loading: {
      type: Boolean,
      default: false,
    }
  }
}
</script>

<style scoped>
  .image-container.loading img.img-thumbnail {
    opacity: .6;
  }
</style>
