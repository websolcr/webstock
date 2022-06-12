<template>
  <div>
    <div class="flex flex-col overflow-y-scroll shadow">
      <div class="table-header-style">
        <div
          class="table-header-item"
          style="width: 20%"
        >
          NAME
        </div>
        <div
          class="table-header-item"
          style="width: 20%"
        >
          EMAIL
        </div>
        <div
          class="table-header-item"
          style="width: 20%"
        >
          ADDRESS
        </div>
        <div
          class="table-header-item"
          style="width: 20%"
        >
          CONTACT NO:
        </div>
        <div
          class="table-header-item"
          style="width: 20%"
        >
          CONTACT NO (OPTIONAL)
        </div>
      </div>
      <div
        v-if="suppliers.length"
        class="table-body-style"
      >
        <suppliers-table-row
          v-for="supplier in suppliers"
          :key="supplier.id"
          :supplier="supplier"
          @click="$emit('select-supplier', supplier)"
        />
      </div>
      <div
        v-else
        class="table-body-style text-center p-4"
      >
        no suppliers
      </div>
    </div>
  </div>
</template>

<script>
import SuppliersTableRow from "@/components/suppliers/SuppliersTableRow"
export default {
  name: "SuppliersTable",

  components: {SuppliersTableRow},

  props: {
    suppliers: {
      type: Array,
      required: true,
    },
  },
}
</script>

<style scoped>
.table-header-style{
  @apply h-8;
  @apply flex;
  @apply text-sm;
  @apply items-center;
  @apply justify-center;
  @apply divide-x;
  @apply divide-blue-200;
  @apply bg-white;
  @apply border-b border-blue-200;
}

.table-header-item {
  @apply font-bold;
  @apply uppercase;
  @apply text-center;
  @apply text-blue-900;
}

.table-body-style {
  @apply flex;
  @apply flex-col;
  max-height: calc(100vh - 300px);
}
</style>

