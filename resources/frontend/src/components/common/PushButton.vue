<template>
  <button
    v-tooltip="tooltip"
    class="relative duration-100 rounded-full px-2.5 py-2 shadow-lg font-normal bg-white button-size items-center"
    :class="[isActive? 'bg-blue-300' : '']"
  >
    <div>
      <svg-icon
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

<style scoped>
.button-size{
  height: 40px;
  width: 40px;
}
</style>
