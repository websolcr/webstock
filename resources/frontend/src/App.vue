<template>
  <div>
    <div
      v-if="$wait.is('fetch-tenant')"
      class="bg-red-400 p-4"
    >
      loading ...
    </div>

    <div v-else>
      <p
        class="font-bold cursor-pointer p-4"
        @click="logout"
      >
        logout..
      </p>
      <app-layout v-if="!!tenant.id" />
      <without-tenant-layout v-else />
    </div>
  </div>
</template>
<script>
import AppLayout from "@/layout/AppLayout"
import WithoutTenantLayout from "@/layout/WithoutTenantLayout"

export default {
  name: 'App',

  components: {
    AppLayout,
    WithoutTenantLayout,
  },


  data() {
    return {
      tenant: {},
    }
  },

  async created() {
    await this.fetchAuthenticatedUser()
    await this.fetchTenant()

    if (!this.tenant.id) {
      await this.$router.push({name: 'OrganizationIndex'})
      return
    }

    await this.$router.push({name: 'Home'})
  },

  methods: {
    async fetchAuthenticatedUser() {
      this.$wait.start('fetch-user')

      await this.$store.dispatch('fetchAuthenticatedUser')

      this.$wait.end('fetch-user')
    },

    async fetchTenant() {
      this.$wait.start('fetch-tenant')

      await this.$store.dispatch('fetchActiveTenant')
      this.getTenant()

      this.$wait.end('fetch-tenant')
    },

    getTenant() {
      this.tenant = this.$store.state.tenant
    },

    logout() {
      const form = document.getElementById('logout-form')
      form.submit()
    },
  }
}
</script>
