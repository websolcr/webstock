<template>
  <div>
    <div class="items-center fixed content-center h-screen w-full grid grid-cols-5 px-24 pb-32 pt-8 bg-blue-50">
      <div class="col-span-3 h-full overflow-y-auto">
        <div class="shadow sm:rounded-md">
          <ul
            role="list"
            class="divide-y divide-gray-100"
          >
            <li
              v-for="organization in organizations"
              :key="organization.id"
              class="bg-white py-5 my-2 hover:bg-blue-100 rounded-lg text-center text-sm cursor-pointer"
              @click="initializeTenant(organization)"
            >
              {{ organization.name }} <br>
              <span class="text-xs">{{ organization.id }}</span>
            </li>
          </ul>
        </div>
      </div>
      <div class="text-center col-span-2">
        <router-link
          :to="{name: 'CreateOrganization'}"
        >
          <base-button label="Create New Organization" />
        </router-link>
      </div>
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

      const response  = await this.$http.post(`/tenant/${tenant.id}/initialize`)

      this.$store.commit('setTenant', response.data.tenant)

      await this.$router.push('/dashboard')

    },
  }
}
</script>
