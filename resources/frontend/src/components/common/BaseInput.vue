<template>
  <div>
    <label
      :for="id"
      class="ml-px  block text-sm font-medium text-gray-700"
    >{{ label }}</label>
    <div class="mt-1">
      <input
        :id="id"
        :type="type"
        :name="id"
        :value="modelValue"
        class="shadow-sm focus:ring-blue-200 block w-full sm:text-sm px-4 input-height mb-2 shadow-lg"
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
    modelValue: {
      type: [String, Number],
      default: null,
    },
  },
}
</script>

<style scoped>
.input-height{
  display:inline-block;
  padding:10px 10px;
}
</style>
