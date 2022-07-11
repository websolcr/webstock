<template>
  <div class="flex divide-x divide-blue-200 hover:bg-blue-50 bg-white hover:cursor-pointer">
    <div
      class="supplier-table-row-item"
      style="width: 20%"
    >
      {{ supplier.name }}
    </div>
    <div
      class="supplier-table-row-item"
      style="width: 20%"
    >
      {{ supplier.email }}
    </div>
    <div
      class="supplier-table-row-item"
      style="width: 20%"
    >
      {{ supplier.address }}
    </div>
    <div
      class="supplier-table-row-item"
      style="width: 20%"
    >
      {{ supplier.primary_contact_no }}
    </div>
    <div
      class="supplier-table-row-item"
      style="width: 20%"
    >
      {{ supplier.secondary_contact_no }}
    </div>
  </div>
</template>

<script>
export default {
  name: "SuppliersTableRow",

  props: {
    supplier: {
      type: Object,
      required: true,
    }
  }
}
</script>

<style scoped>
.supplier-table-row-item {
  @apply border-b;
  @apply border-blue-200;
  @apply text-center;
  @apply text-gray-900;
  @apply align-middle;
}
</style>
