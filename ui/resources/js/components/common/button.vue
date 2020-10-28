<template>
  <button class="btn" :disabled="disabledBtn" :class="{'btn-loading': loading}" @click="handleClick">
    <slot />
  </button>
</template>
<script>
export default {
  props: {
    loading: {
      type: Boolean,
      default: false,
    },
    disabled: {
      type: Boolean,
      default: undefined,
    }
  },

  computed: {
    disabledBtn () {
      if (this.disabled === true) {
        return true
      }

      if (this.disabled === false) {
        return false
      }

      return this.loading
    }
  },

  methods: {
    handleClick(e) {
      this.$emit('click', e)
    }
  }
}
</script>
<style lang="scss">
@keyframes loader {
  from {
    transform: rotate(0deg);
  }

  to {
    transform: rotate(360deg);
  }
}

.btn-loading {
  color: transparent !important;
  pointer-events: none;
  position: relative;

  &:disabled {
    color: transparent !important;
  }

  &:after {
    content: '';
    animation: loader 500ms infinite linear;
    border: 2px solid #fff;
    border-radius: 50%;
    border-right-color: transparent !important;
    border-top-color: transparent !important;
    display: block;
    height: 1.4em;
    width: 1.4em;
    left: calc(50% - (1.4em / 2));
    top: calc(50% - (1.4em / 2));
    transform-origin: center;
    position: absolute !important;
  }

  &.btn-sm:after{
    height: 1em;
    width: 1em;
    left: calc(50% - (1em / 2));
    top: calc(50% - (1em / 2));
  }
}
</style>
