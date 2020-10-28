<template>
  <select :id="id" class="form-control" :multiple="multiple" :data-placeholder="placeholder">
    <option />
    <option v-for="tag in tags" :key="tag.id" :value="tag.id" :selected="isSelected(tag)">{{ tag.title }}</option>
  </select>
</template>
<script>
import { strRandom, strSlug } from '@/helpers/str'
// eslint-disable-next-line no-unused-vars
import select2 from 'admin-lte/plugins/select2/js/select2.full'

export default {
  props: {
    id: {
      type: String,
      default () {
        return strRandom(5)
      }
    },

    placeholder: {
      type: String,
      default: 'Chọn tags'
    },

    multiple: {
      type: Boolean,
      default: true,
    },

    value: {
      type: [Array, String],
      default: undefined,
    },

    tags: {
      type: Array,
      default () {
        return []
      }
    }
  },

  mounted () {
    $(`#${this.id}`)
      .select2({
        // tags: true,
        placeholder: this.placeholder,
        // createTag: this.createTag,
      })
      .on('change', this.change)
  },

  methods: {
    isSelected (tag) {
      if (typeof this.value === undefined) {
        return false
      }
      if (Array.isArray(this.value)) {
        return this.value.map(n => parseInt(n)).indexOf(parseInt(tag.id)) > -1
      }

      return this.value == tag.id
    },

    async change () {
      let value = $(`#${this.id}`).val()
      this.$emit('input', value)
    },

    createTag (params) {
      let term = $.trim(params.term)
      if (term === '') {
        return null
      }

      return {
        id: strSlug(term),
        text: term,
        newTag: true,
      }
    }
  }
}
</script>
