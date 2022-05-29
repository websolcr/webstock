<template>
  <div
    v-tooltip.right-end="tooltip"
    class="flex p-2 mx-3 my-1 text-white text-white hover:bg-gray-600 rounded h-10"
    :class="[isCurrent ? 'bg-gray-600' : '']"
  >
    <router-link
      :to="{name: namedRoute}"
      class="flex relative"
    >
      <svg-icon
        icon="document"
        class="pr-3"
      />
      <div v-if="isSideBarPinned">
        {{ label }}
      </div>
    </router-link>
  </div>
</template>

<script>
export default {
  name: "SidebarLink",

  props: {
    label: {
      type: String,
      required: true,
    },

    namedRoute: {
      type: String,
      required: true,
    },

    tooltip: {
      type: String,
      default: null,
    },

    isSideBarPinned: {
      type: Boolean,
      required: true,
    },
  },

  computed: {
    isCurrent() {
      return this.$route.name === this.namedRoute
    },
  }
}
</script>
