<template>
  <div class="flex flex-row gap-3">
    <div class="text-xs">
      Per page :
    </div>

    <div>
      <div
        v-if="isShowing"
        class="flex flex-col bg-white text-xs text-blue-600 w-fit px-4 py-2 rounded-lg border border-blue-400 shadow absolute z-10"
      >
        <div
          v-for="paginationValue in numberOfRows"
          :key="paginationValue"
          class="flex cursor-pointer hover:text-gray-900 gap-3 text-xs"
          @click="setPerPage(paginationValue)"
        >
          {{ paginationValue }}
        </div>
      </div>
      <div
        class="flex flex-col bg-white text-xs text-blue-600 w-fit px-4 py-1 rounded-lg border border-blue-400 shadow"
        @click="isShowing = !isShowing"
      >
        <div class="uppercase text-sm">
          <div class="flex justify-between">
            {{ perPage }}
            <svg-icon :icon="isShowing ? 'chevron-up' : 'chevron-down'" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "PaginationBarPerPageSelector",

  props: {
    perPage: {
      type: Number,
      default: () => 10,
    },
  },

  data() {
    return {
      numberOfRows: [10, 20, 30, 50],
      isShowing: false,
    }
  },

  methods: {
    setPerPage(paginationValue) {
      this.$emit('setPerPage', paginationValue)

      this.isShowing = !this.isShowing
    }
  }
}
</script>
