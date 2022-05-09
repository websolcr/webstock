<template>
  <div class="flex flex-col">
    <div class="pb-4 text-center">
      <div class="font-bold">
        Your Organizations.
      </div>
    </div>
    <div class="p-6">
      <div
        v-for="organization in organizations"
        :key="organization.id"
        class="py-5 hover:bg-blue-100 rounded-lg text-center cursor-pointer"
        @click="initializeTenant(organization)"
      >
        {{ organization.name }} <br>
        <span class="text-xs">{{ organization.id }}</span>
      </div>
    </div>
    <div class="flex justify-center pt-6">
      <router-link
        :to="{name: 'CreateOrganization'}"
      >
        <base-button label="Create New Organization" />
      </router-link>
    </div>
  </div>
</template>

<script>
import BaseButton from "@/components/common/BaseButton"

export default {
  name: "OrganizationIndex",
  components: {
    BaseButton,
  },


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
    },

    async initializeTenant(tenant) {
      this.$wait.start('initializing-tenant')

      await this.$http.post(`/tenant/${tenant.id}/initialize`)
        .then(async (response) => {
          await this.$store.commit('setTenant', { ...response.data })
          this.loadTenancyHome()

        }).catch(error => {
          console.log(error.response)
        })

      this.$wait.end('initializing-tenant')
    },

    loadTenancyHome() {
      const form = document.getElementById('load-home-form')
      form.submit()
    },
  }
}
</script>
