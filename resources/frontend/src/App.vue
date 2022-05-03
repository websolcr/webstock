<template>
  <div>
    <div v-if="$wait.is('fetch-tenant')">
      loading ...
    </div>

    <div v-else>
      <p
        class="font-bold cursor-pointer"
        @click="logout"
      >
        logout..
      </p>
      <app-layout v-if="hasTenant" />
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
      hasTenant: false,
    }
  },

  async created() {
    await this.fetchAuthenticatedUser()
    await this.setLayout()
  },

  methods: {
    async fetchAuthenticatedUser() {
      await this.$store.dispatch('fetchAuthenticatedUser')
    },

    async setLayout() {
      if (!this.$store.state.user) {
        return
      }

      this.$wait.start('fetch-tenant')

      await this.fetchTenant()
      this.setLayoutBasedOnTenant()

      this.$wait.end('fetch-tenant')

    },

    async fetchTenant() {
      await this.$store.dispatch('fetchActiveTenant')
    },

    setLayoutBasedOnTenant() {
      if (!this.$store.state.tenant.id) {
        this.hasTenant = false
        return
      }

      this.hasTenant = true
    },

    logout() {
      const form = document.getElementById('logout-form')
      form.submit()
    },
  }
}
</script>

<!--<style>-->
<!--#app {-->
<!--  font-family: Avenir, Helvetica, Arial, sans-serif;-->
<!--  -webkit-font-smoothing: antialiased;-->
<!--  -moz-osx-font-smoothing: grayscale;-->
<!--  text-align: center;-->
<!--  color: #2c3e50;-->
<!--}-->
<!--</style>-->
