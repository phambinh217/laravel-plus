<template>
  <div class="avatar" :style="avatarStyle" />
</template>

<script>
export default {
  props: {
    src: {
      type: String,
      required: true
    },

    width: {
      type: String,
      required: true
    }
  },

  computed: {
    avatarStyle () {
      return {
        width: this.width,
        height: this.width,
        flex: `0 0 ${this.width}`,
        backgroundImage: `url(${this.src})`,
      }
    }
  }
}
</script>

<style scoped>
.avatar {
    background-size: cover;
    border-radius: 50%;
}
</style>
