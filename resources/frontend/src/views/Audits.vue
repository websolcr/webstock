<template>
  <div>
    <title-bar>
      <template #title>
        Audit
      </template>
      <template #top-buttons />
    </title-bar>

    <div class="mt-1 w-full flex flex-col p-3 gap-y-4">
      <audit-table :audits="audits" />
      <div class="bg-blue-400">
        pagination
      </div>
    </div>
  </div>
</template>

<script>
import TitleBar from "@/components/common/TitleBar"
import AuditTable from "@/components/audits/AuditTable"

export default {
  name: "Audits",

  components: {
    AuditTable,
    TitleBar
  },

  data() {
    return {
      audits: [],
    }
  },

  created() {
    this.fetchAudits()
  },

  methods: {
    async fetchAudits() {
      this.$wait.start('fetch-audits')

      const {data} = await this.$http.get('audits')
      this.audits = data

      this.$wait.end('fetch-audits')
    }
  },
}
</script>
