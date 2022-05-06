<template>
  <div>
    <label
      :for="id"
      class="ml-px pl-4 block text-sm font-medium text-gray-700"
    >Name</label>
    <div class="mt-1">
      <input
        :id="id"
        :type="type"
        :name="id"
        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 px-4 rounded-full"
        :placeholder="placeholder"
        @input="$emit('update:modelValue', $event.target.value)"
      >
    </div>
  </div>
</template>

<script>
export default {
  name: "BaseInput",

  props: {
    label: {
      type: String,
      required: true
    },
    id: {
      type: String,
      required: true
    },
    placeholder: {
      type: String,
      default: '',
    },
    type: {
      type: String,
      default: 'text',
    },
  },
}
</script>
