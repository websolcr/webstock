<template>
  <div>
    <div class="p-4">
      Organization index

      <div
        v-for="organization in organizations"
        :key="organization.id"
      >
        {{ organization.id }} => {{ organization.name }}
      </div>
    </div>

    <br>
    <router-link :to="{name: 'CreateOrganization'}">
      create organization
    </router-link>
  </div>
</template>

<script>
export default {
  name: "OrganizationIndex",

  data() {
    return {
      organizations: [],
    }
  },

  created() {
    this.fetchOrganizations()
  },

  methods: {
    async fetchOrganizations() {
      const { data } = await this.$http.get('/tenant/index')
      this.organizations = data
    }
  }
}
</script>
