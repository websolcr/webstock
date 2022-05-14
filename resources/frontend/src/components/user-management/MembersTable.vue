<template>
  <div>
    <div class="flex flex-col overflow-y-scroll shadow bg-white">
      <div class="table-header-style">
        <div class="member-table-header-item">
          name
        </div>
        <div class="member-table-header-item">
          email
        </div>
        <div class="member-table-header-item">
          joined date
        </div>
        <div class="member-table-header-item">
          role
        </div>
        <div class="member-table-header-item">
          invited by
        </div>
      </div>
      <div class="table-body-style">
        <MembersTableRow
          v-for="member in members"
          :key="member.id"
          :member="member"
        />
      </div>
    </div>
  </div>
</template>

<script>
import MembersTableRow from "@/components/user-management/MembersTableRow"
export default {
  name: "MembersTable",

  components: {
    MembersTableRow
  },
  props: {
    members: {
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
  @apply divide-x;
  @apply divide-blue-200;
  @apply border-b border-blue-200;
}

.member-table-header-item {
  @apply w-1/5;
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
