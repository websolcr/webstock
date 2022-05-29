<template>
  <div class="flex justify-between">
    <div class="flex flex-row">
      <pagination-bar-per-page-selector
        :per-page="dataset.per_page"
        @setPerPage="setPerPage"
      />
    </div>

    <div class="text-xs">
      {{ dataset.current_page }} of {{ dataset.last_page }} pages
    </div>
    <div class="flex flex-row">
      <div>
        <pagination-links
          :links="dataset.links"
          :current-page="dataset.current_page"
          :last-page="dataset.last_page"
          :prev-page-url="dataset.prev_page_url"
          :next-page-url="dataset.next_page_url"
          @go-to-page="goToPage"
        />
      </div>
    </div>
  </div>
</template>

<script>
import PaginationLinks from "@/components/common/pagination/PaginationLinks"
import PaginationBarPerPageSelector from "@/components/common/pagination/PaginationBarPerPageSelector"

export default {
  name: "PaginationBar",

  components: {
    PaginationLinks,
    PaginationBarPerPageSelector
  },

  props: {
    dataset: {
      type: Object,
      required: true
    },
  },

  methods: {
    setPerPage(paginationValue) {
      this.$emit('setPerPage', paginationValue)
    },

    goToPage(page) {
      this.$emit('goToPage', page)
    }
  }
}
</script>
