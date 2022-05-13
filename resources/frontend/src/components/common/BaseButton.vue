<template>
  <button
    class="relative text-sm ease-linear duration-100 rounded px-3 py-1 font-sans font-semibold"
    :class="[
      disabled ? disabledClasses : activeClasses
    ]"
    :disabled="disabled"
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

    disabled: {
      type: Boolean,
      default: false,
    }
  },

  data() {
    return {
      activeClasses: [
        'border-blue-300',
        'hover:border-blue-500',
        'hover:bg-blue-300',
        'focus:border-blue-500',
        'active:bg-blue-800',
        'active:border-blue-800 ',
        'border border-solid',
        'bg-blue-300',
        'text-white',
        'shadow',
      ],

      disabledClasses: [
        'bg-gray-100',
        'text-gray-800',
        'cursor-not-allowed'
      ]
    }
  },
}
</script>
