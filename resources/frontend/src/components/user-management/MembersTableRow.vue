<template>
  <div class="flex divide-x divide-blue-200">
    <div class="member-table-row-item">
      {{ member.name }}
    </div>
    <div class="member-table-row-item">
      {{ member.email }}
    </div>
    <div class="member-table-row-item">
      {{ member.created_at }}
    </div>
    <div class="member-table-row-item">
      {{ member.role }}
    </div>
    <div class="member-table-row-item">
      {{ member.invited_by ? member.invited_by.name : '---' }}
    </div>
  </div>
</template>

<script>
export default {
  name: "MembersTableRow",

  props: {
    member: {
      type: Object,
      required: true,
    },
  }

}
</script>

<style scoped>
.member-table-row-item {
  @apply w-1/5;
  @apply border-b;
  @apply border-blue-200;
  @apply text-center;
  @apply text-gray-900;
  @apply bg-white;
  @apply align-middle;
}
</style>
