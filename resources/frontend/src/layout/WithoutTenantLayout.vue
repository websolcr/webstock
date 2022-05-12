<template>
  <div class="bg-blue-50">
    <div
      class="bg-indigo-500 shadow flex justify-between h-16 px-6 items-center"
    >
      <div>
        <div class="text-center text-white font-medium">
          Your Organizations
        </div>
      </div>
      <div>
        <div class="flex gap-6">
          <div class="text-sm text-white">
            {{ user.name }}
          </div>
          <div>
            <svg-icon
              v-tooltip="'logout'"
              icon="logout"
              class="text-white cursor-pointer"
              @click="logout"
            />
          </div>
        </div>
      </div>
    </div>
    <router-view :key="$route.fullPath" />
  </div>
</template>

<script>
export default {
  name: "WithoutTenantLayout",

  computed: {
    user() {
      return this.$store.state.user
    },
  },

  methods: {
    logout() {
      this.clearLocalStorage()

      const form = document.getElementById('logout-form')
      form.submit()
    },
    clearLocalStorage() {
      localStorage.removeItem('user')
      localStorage.removeItem('tenancy')
    },
  }
}
</script>
