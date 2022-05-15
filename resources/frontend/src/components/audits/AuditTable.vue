<template>
  <div>
    <div class="flex flex-col">
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
  @apply text-sm;
  @apply items-center;
  @apply justify-center;
}

.audit-table-header-item {
  @apply border-2;
  @apply border-blue-200;
  @apply w-1/6;
  @apply font-bold;
  @apply uppercase;
  @apply text-center;
  @apply text-gray-900;
}

.table-body-style {
  @apply flex;
  @apply flex-col;
  @apply overflow-y-scroll;
  height: calc(100vh - 250px);
}
</style>
