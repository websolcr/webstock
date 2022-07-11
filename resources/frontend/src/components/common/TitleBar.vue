<template>
  <div class="flex justify-between p-3">
    <div class="font-bold text-2xl">
      <slot
        name="title"
      />
    </div>

    <div class="space-x-2">
      <slot
        name="top-buttons"
      />
    </div>
  </div>
</template>

<script>
export default {
  name: "TitleBar"
}
</script>
