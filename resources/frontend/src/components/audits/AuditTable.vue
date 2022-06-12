<template>
  <div>
    <div class="flex flex-col overflow-y-scroll shadow bg-white">
      <div class="table-header-style">
        <div class="audit-table-header-item">
          member
        </div>
        <div class="audit-table-header-item">
          area
        </div>
        <div class="audit-table-header-item">
          action
        </div>
        <div class="audit-table-header-item">
          before value
        </div>
        <div class="audit-table-header-item">
          after value
        </div>
        <div class="audit-table-header-item">
          perform at
        </div>
      </div>
      <div class="table-body-style">
        <audit-table-row
          v-for="audit in audits"
          :key="audit.id"
          :audit="audit"
        />
      </div>
    </div>
  </div>
</template>

<script>
import AuditTableRow from "@/components/audits/AuditTableRow"
export default {
  name: "AuditTable",

  components: {
    AuditTableRow
  },

  props: {
    audits: {
      type: Array,
      required: true,
    },
  }

}
</script>

<style scoped>
.table-header-style{
  @apply h-8;
  @apply flex;
  @apply text-xs;
  @apply items-center;
  @apply justify-center;
  @apply divide-x;
  @apply divide-blue-200;
  @apply border-b border-blue-200;
}

.audit-table-header-item {
  @apply w-1/6;
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
