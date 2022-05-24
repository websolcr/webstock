<template>
  <div class="flex flex-row">
    <div
      v-for="link in links"
      :key="link"
      class="text-blue-600 bg-white p-2 border border-blue-400 rounded cursor-pointer hover:underline"
      :class="[link.active ? 'font-bold' : '']"
      @click="goToPage(link)"
    >
      <div
        :class="[isNotAllowedLink(link.label) ? 'cursor-not-allowed text-gray-400' : '']"
        v-html="link.label"
      />
    </div>
  </div>
</template>

<script>
export default {
  name: "PaginationLinks",

  props: {
    links: {
      type: Array,
      required: true,
    },

    currentPage: {
      type: Number,
      required: true,
    },

    lastPage: {
      type: Number,
      required: true,
    },

    prevPageUrl: {
      type: [String, null],
      default: () => null
    },

    nextPageUrl: {
      type: [String, null],
      default: () => null
    }
  },

  methods: {
    isNotAllowedLink(label) {
      return label === 'Next &raquo;' && this.currentPage === this.lastPage ||
      label === '&laquo; Previous' && this.currentPage === 1
    },

    goToPage(page) {
      if (this.isNotAllowedLink(page.label)) {
        return
      }

      if (page.label === 'Next &raquo;' && this.currentPage !== this.lastPage) {
        this.$emit('goToPage', this.currentPage + 1)
        return
      }

      if (page.label === '&laquo; Previous' && this.currentPage !== 1) {
        this.$emit('goToPage', this.currentPage - 1)
        return
      }

      this.$emit('goToPage', page.label)
    }
  }
}
</script>
