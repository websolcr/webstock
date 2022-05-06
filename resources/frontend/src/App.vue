<template>
  <div>
    <div
      v-if="$wait.is('set-user')"
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
      <router-view />
    </div>
  </div>
</template>

<script>

export default {
  name: 'App',

  async created() {
    await this.setAuthenticatedUser()
  },

  methods: {
    async setAuthenticatedUser() {
      this.$wait.start('set-user')

      await this.$store.dispatch('fetchAuthenticatedUser')

      this.$wait.end('set-user')
    },

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
