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
          label="value"
          track-by="key"
          :dataset="areas"
        />

        <multiselect-dropdown
          :key="dropdownKey"
          v-model="selectedActions"
          button-text="actions"
          label="value"
          track-by="key"
          :dataset="actions"
        />

        <div
          v-if="hasSelectedFilters"
          class="text-xs flex justify-between ml-6 mt-1 cursor-pointer gap-1"
          @click="resetFilters"
        >
          <svg-icon icon="ticket" />
          Reset filters
        </div>

        <base-button
          v-if="hasSelectedFilters"
          label="apply filters"
          class="text-sm ml-6"
          @click="fetchAudits"
        />
      </div>

      <audit-table
        v-if="!$wait.is('fetch-audits')"
        :audits="audits.data"
      />

      <pagination-bar
        v-if="!$wait.is('fetch-audits')"
        :dataset="audits"
        @set-per-page="setPerPage"
        @go-to-page="goToPage"
      />
    </div>
  </div>
</template>

<script>
import TitleBar from "@/components/common/TitleBar"
import AuditTable from "@/components/audits/AuditTable"
import BaseButton from "@/components/common/BaseButton"
import PushButton from "@/components/common/PushButton"
import PaginationBar from "@/components/common/pagination/PaginationBar"
import MultiselectDropdown from "@/components/common/MultiselectDropdown"

const INITIAL_FILTERS = {
  member: [],
  area: [],
  action: [],
}

const INITIAL_PAGINATION = {
  perPage: 10,
  page: 1,
}

export default {
  name: "AuditsPage",

  components: {
    PaginationBar,
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
      paginator: {...INITIAL_PAGINATION},
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
        return this.filters.member
      },
      set(members) {
        this.filters = {
          ...this.filters,
          member: [...members].map(member => member.id)
        }
      },
    },

    selectedAreas: {
      get() {
        return this.filters.area
      },
      set(areas) {
        this.filters = {
          ...this.filters,
          area: [...areas].map(area => area.key)
        }
      },
    },

    selectedActions: {
      get() {
        return this.filters.action
      },
      set(actions) {
        this.filters = {
          ...this.filters,
          action: [...actions].map(action => action.key)
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
    this.fetchFilters()
  },

  methods: {
    async fetchFilters() {
      this.$wait.start('fetch-filters')

      const { data } = await this.$http.get('audit-filters')

      this.areas = data.areas
      this.actions = data.actions

      this.$wait.end('fetch-filters')
    },

    async fetchAudits() {
      this.$wait.start('fetch-audits')

      const { data } = await this.$http.get('audits', {
        params: {...this.filters, ...this.paginator}
      })

      this.audits = data

      this.$wait.end('fetch-audits')
    },

    resetFilters() {
      this.dropdownKey ++

      this.filters = {...INITIAL_FILTERS}

      this.fetchAudits()
    },

    async fetchMembers() {
      this.$wait.start('fetch-members')

      const { data } = await this.$http.get('members')

      this.members = data

      this.$wait.end('fetch-members')
    },

    setPerPage(perPage) {
      this.paginator = {
        ...this.paginator, perPage
      }

      this.fetchAudits()
    },

    goToPage(page) {
      this.paginator = {
        ...this.paginator, page
      }

      this.fetchAudits()
    }
  },
}
</script>
