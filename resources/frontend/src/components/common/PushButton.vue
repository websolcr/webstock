<template>
  <button
    class="relative ease-linear duration-150 rounded-full px-3 py-2 shadow-lg font-normal bg-white"
    :class="[isActive? 'bg-blue-400' : '']"
  >
    <div>
      <svg-icon
        v-tooltip="tooltip"
        :icon="icon"
      />
    </div>
  </button>
</template>

<script>
export default {
  name: "PushButton",

  props: {
    icon: {
      type: String,
      required: true
    },
    tooltip: {
      type: String,
      default: () => '',
    },
    isActive: {
      type: Boolean,
      default: false,
    }
  },
}
</script>
