<template>
  <div class="flex">
    <div class="audit-table-row-item">
      {{ audit.member }}
    </div>
    <div class="audit-table-row-item">
      {{ audit.area }}
    </div>
    <div class="audit-table-row-item">
      {{ audit.action }}
    </div>
    <div class="audit-table-row-item">
      {{ audit.before_value ?? '---' }}
    </div>
    <div class="audit-table-row-item">
      {{ audit.after_value ?? '---' }}
    </div>
    <div class="audit-table-row-item">
      {{ audit.created_at }}
    </div>
  </div>
</template>

<script>
export default {
  name: "AuditTableRow",

  props: {
    audit: {
      type: Object,
      required: true,
    },
  }
}
</script>

<style scoped>
.audit-table-row-item {
  @apply w-1/6;
  @apply border-2;
  @apply text-center;
  @apply text-gray-900;
  @apply border-blue-100;
}
</style>
