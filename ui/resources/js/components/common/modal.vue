<template>
  <div :id="id" class="modal fade" role="dialog">
    <div class="modal-dialog" :class="size" role="document">
      <div class="modal-content border-0">
        <div class="modal-header border-bottom-0 pb-0">
          <h5 class="modal-title">
            {{ title }}
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="fal fa-times" />
          </button>
        </div>
        <slot />
      </div>
    </div>
  </div>
</template>
<script>
import { strRandom } from '../../helpers/str'

export default {
  props: {
    open: {
      type: Boolean,
      default: false,
    },

    title: {
      type: String,
      default: ''
    },

    id: {
      type: String,
      default () {
        return strRandom(5)
      }
    },

    size: {
      type: String,
      default: ''
    }
  },

  computed: {
    modal () {
      return $('#' + this.id)
    }
  },

  watch: {
    /*eslint no-unused-vars: ["error", { "args": "none" }]*/
    open (value) {
      if (this.open) {
        this.modal.modal({backdrop: 'static', keyboard: false})
      } else {
        this.modal.modal('hide')
      }
    }
  },

  mounted () {
    let vm = this
    if (vm.open == true) {
      vm.modal.modal({backdrop: 'static', keyboard: false})
    }
    vm.modal.on("hide.bs.modal", function () {
      vm.$emit('close')
    })
  },

  methods: {

  },
}
</script>
