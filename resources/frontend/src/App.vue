<template>
  <div>
    <div
      v-if="$wait.is('set-user')"
      class="bg-red-400 p-4"
    >
      loading ...
    </div>
    <div v-else>
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

  }
}
</script>
