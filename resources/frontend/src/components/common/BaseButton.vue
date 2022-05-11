<template>
  <button
    class="relative border-blue-300 hover:border-blue-500 hover:bg-blue-300 focus:border-blue-500 active:bg-blue-800 active:border-blue-800 border border-solid text-sm ease-linear duration-100 rounded px-3 py-1 font-sans font-semibold"
    :class="[
      buttonType === 'filled' ? filledStyles : defaultStyles,
    ]"
    @click.prevent
  >
    <span class="spinner" />
    <span>{{ label }}</span>
    <slot name="extra" />
  </button>
</template>

<script>
export default {
  name: 'BaseButton',

  props: {
    label: {
      type: String,
      required: true,
    },

    buttonType: {
      type: String,
      default: 'filled',
    },
  },

  data() {
    return {
      filledStyles: ['bg-blue-300', 'text-white', 'shadow'],
      defaultStyles: ['hover:text-white', 'text-blue-500', 'bg-white'],
    }
  },
}
</script>
