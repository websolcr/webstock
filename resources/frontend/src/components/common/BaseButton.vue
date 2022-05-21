<template>
  <div
    class="relative text-sm ease-linear duration-100 rounded px-3 py-1 font-sans font-semibold h-fit"
    :class="[
      disabled ? disabledClasses : activeClasses
    ]"
  >
    <span class="spinner" />
    <span>{{ label }}</span>
    <slot name="extra" />
  </div>
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
        'hover:border-blue-800',
        'hover:bg-blue-800',
        'focus:border-blue-500',
        'border border-solid',
        'bg-blue-300',
        'text-white',
        'shadow',
        'cursor-pointer',
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
