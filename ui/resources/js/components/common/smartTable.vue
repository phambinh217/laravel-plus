<template>
  <table :id="id" class="table text-nowrap" :class="!loading ? 'table-striped table-hover' : ''">
    <slot></slot>
  </table>
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

    loading: {
      type: Boolean,
      default: true,
    },

    numberOfLoadingRow: {
      type: Number,
      default: 5,
    }
  },

  data () {
    return {
      tableEl: undefined,
      numberOfRow: 0,
    }
  },

  computed: {
    // tableEl () {
    //   return $(`#${this.id}`)
    // },

    bodyEl () {
      return $('tbody', this.tableEl)
    },

    headEl () {
      return $('thead', this.tableEl)
    },

    numberOfCol () {
      return this.headEl.find('th').length
    },

    htmlLoading () {
      let tbody = ''
      for (let i = 1; i <= this.numberOfLoadingRow; i++) {
        tbody += `<tr class="loading-row">`
        for (let j = 1; j <= this.numberOfCol; j++) {
          tbody += `<td class=""><div class="bg-placeholder p-2 cursor-pointer"></div></td>`
        }
        tbody += '</tr>'
      }

      return tbody
    },

    htmlEmpty () {
      return `<tr class="empty"><td class="text-center" colspan="${this.numberOfCol}">Không có dữ liệu</td></tr>`
    },

    isEmpty () {
      return this.numberOfRow == 0
    },
  },

  watch: {
    loading () {
      if (this.loading == false) {
        this.destroyPlaceholderLoading()
      } else {
        this.createPlaceholderLoading()
      }
    },

    isEmpty() {
      this.handleEmpty()
    }
  },

  mounted () {
    this.tableEl = $(`#${this.id}`)
    this.calcNumberOfRow()

    if (this.loading == true) {
      this.createPlaceholderLoading()
    }
  },

  updated () {
    this.calcNumberOfRow()
  },

  methods: {
    calcNumberOfRow () {
      this.numberOfRow = this.bodyEl.find('tr').not('.empty, .loading-row').length
    },

    createPlaceholderLoading () {
      this.bodyEl.find('tr').hide()
      this.bodyEl.append(this.htmlLoading)
    },

    destroyPlaceholderLoading () {
      this.tableEl.find('tr.loading-row').remove()
      this.tableEl.find('tr').show()
      this.handleEmpty()
    },

    handleEmpty () {
      if (this.isEmpty) {
        this.bodyEl.html(this.htmlEmpty)
      } else {
        this.bodyEl.find('tr.empty').remove()
      }
    }
  }
}
</script>
