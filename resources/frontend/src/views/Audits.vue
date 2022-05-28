<template>
  <div>
    <title-bar>
      <template #title>
        Audit
      </template>
      <template #top-buttons>
        <push-button
          icon="filter"
          :tooltip="isShowingFilters ? 'Hide filters' : 'Show Filters'"
          :is-active="isShowingFilters"
          @click="isShowingFilters = !isShowingFilters"
        />
      </template>
    </title-bar>

    <div class="mt-1 w-full flex flex-col p-3 gap-y-4">
      <div
        v-if="isShowingFilters"
        class="flex gap-3"
      >
        <multiselect-dropdown
          :key="dropdownKey"
          v-model="selectedMembers"
          button-text="members"
          label="id"
          track-by="id"
          :dataset="members"
        />

        <multiselect-dropdown
          :key="dropdownKey"
          v-model="selectedAreas"
          button-text="areas"
          label="area"
          track-by="id"
          :dataset="areas"
        />

        <multiselect-dropdown
          :key="dropdownKey"
          v-model="selectedActions"
          button-text="actions"
          label="action"
          track-by="id"
          :dataset="actions"
        />

        <div
          class="text-xs flex justify-between ml-6 mt-1 cursor-pointer gap-1"
          :class="!hasSelectedFilters ? 'cursor-not-allowed text-gray-600' : ''"
          @click="resetFilters"
        >
          <svg-icon icon="ticket" />
          Reset filters
        </div>

        <base-button
          :disabled="!hasSelectedFilters"
          label="apply filters"
          class="text-sm ml-6"
          @click="fetchFilteredData"
        />
      </div>
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
import MultiselectDropdown from "@/components/common/MultiselectDropdown"
import BaseButton from "@/components/common/BaseButton"
import PushButton from "@/components/common/PushButton"

const INITIAL_FILTERS = {
  members: [],
  areas: [],
  actions: [],
}

export default {
  name: "AuditsPage",

  components: {
    PushButton,
    BaseButton,
    MultiselectDropdown,
    AuditTable,
    TitleBar
  },

  data() {
    return {
      audits: [],
      filters: {...INITIAL_FILTERS},
      members: [],
      actions: [],
      areas: [],
      dropdownKey: 0,
      isShowingFilters: true,
    }
  },

  computed: {
    selectedMembers: {
      get() {
        return this.filters.members
      },
      set(members) {
        this.filters = {
          ...this.filters,
          members: [...members].map(member => member.id)
        }
      },
    },

    selectedAreas: {
      get() {
        return this.filters.areas
      },
      set(areas) {
        this.filters = {
          ...this.filters,
          areas: [...areas].map(area => area.area)
        }
      },
    },

    selectedActions: {
      get() {
        return this.filters.actions
      },
      set(actions) {
        this.filters = {
          ...this.filters,
          actions: [...actions].map(action => action.action)
        }
      }
    },

    hasSelectedFilters() {
      return !!this.selectedAreas.length || !!this.selectedActions.length || !!this.selectedMembers.length
    },
  },

  created() {
    this.fetchAudits()
    this.fetchMembers()
    this.fetchActions()
    this.fetchAreas()
  },

  methods: {
    async fetchAudits() {
      this.$wait.start('fetch-audits')

      const {data} = await this.$http.get('audits')
      this.audits = data.data

      this.$wait.end('fetch-audits')
    },

    resetFilters() {
      this.dropdownKey ++

      this.fetchAudits()

      this.filters = {...INITIAL_FILTERS}
    },

    async fetchMembers() {
      this.$wait.start('fetch-members')

      const { data } = await this.$http.get('members')

      this.members = data

      this.$wait.end('fetch-members')
    },

    async fetchActions() {
      this.$wait.start('fetch-actions')

      const { data } = await this.$http.get('audit-data', {
        params: {
          filter: 'actions'
        }
      })

      this.actions = Object.keys(data).map(key => {
        return {
          id: key,
          action: data[key]
        }
      })

      this.$wait.end('fetch-actions')
    },

    async fetchAreas() {
      this.$wait.start('fetch-areas')

      const { data } = await this.$http.get('audit-data', {
        params: {
          filter: 'areas'
        }
      })

      this.areas = Object.keys(data).map(key => {
        return {
          id: key,
          area: data[key]
        }
      })

      this.$wait.end('fetch-areas')
    },

    async fetchFilteredData() {
      if (!this.hasSelectedFilters) {
        return
      }

      this.$wait.start('fetch-audits')

      const { data } = await this.$http.get('audits', {
        params: this.filters
      })

      this.audits = data.data

      this.$wait.end('fetch-audits')
    }
  },
}
</script>
