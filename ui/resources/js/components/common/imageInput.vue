<template>
  <div class="image-input square">
    <div v-if="hasImage == false" :id="id" class="placeholder position-relative cursor-pointer" @click="clickInputFile">
      <div class="placeholder-inner position-absolute absolute-center text-center">
        {{ placeholder }}
      </div>
    </div>
    <div v-else>
      <div class="image-container">
        <img :src="image" class="img-fluid image absolute-center position-absolute">
        <div class="blur position-absolute w-100 h-100 d-flex align-items-center justify-content-center" :class="{ 'loading': isUploading }">
          <div v-if="isUploading" class="spinner-grow" role="status">
            <span class="sr-only">Loading...</span>
          </div>
        </div>
        <div class="actions position-absolute w-100 h-100 align-items-center justify-content-center">
          <button type="button" class="btn btn-xs btn-secondary rounded-circle mr-1" @click="clickInputFile"><i class="fa fa-undo" /></button>
          <button type="button" class="btn btn-xs btn-danger rounded-circle" @click="removeImage"><i class="fa fa-times" /></button>
        </div>
      </div>
    </div>
    <input :id="inputFileId" type="file" style="display: none">
  </div>
</template>
<script>
import { strRandom } from '@/helpers/str'
import storageApi from '@/api/storage'

export default {
  components: {
  },
  props: {
    id: {
      type: String,
      default () {
        return strRandom(5)
      }
    },

    inputFileId: {
      type: String,
      default () {
        return strRandom(5)
      }
    },

    value: {
      type: String,
      default: undefined,
    },

    placeholder: {
      type: String,
      default: 'Tải lên ảnh đại diện',
    }
  },

  data () {
    return {
      image: undefined,
      isUploading: false,
    }
  },

  computed: {
    hasImage () {
      return !!this.image
    }
  },

  mounted () {
    let that = this
    this.image = this.value

    $(`#${this.inputFileId}`).change(function () {
      that.previewImage(this)
      that.uploadImage(this)
    })
  },

  methods: {
    removeImage () {
      this.image = undefined
      this.$emit('input', '')
    },

    clickInputFile () {
      $(`#${this.inputFileId}`).trigger('click')
    },

    previewImage (input) {
      if (input.files && input.files[0]) {
        let reader = new FileReader()
        reader.onload = e => {
          this.image = e.target.result
        }
        reader.readAsDataURL(input.files[0])
      }
    },

    async uploadImage (file) {
      if (file.files && file.files[0]) {
        this.isUploading = true
        let formData = new FormData()
        formData.append('upload', file.files[0])
        let { data: response } = await storageApi.upload(formData)
        this.isUploading = false

        this.$emit('input', response.url)
      }
    }
  }
}
</script>
