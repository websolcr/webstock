<template>
  <div>
    <img
      alt="Vue logo"
      src="./assets/logo.png"
    >
    <pre>{{ user }}</pre>
    <HelloWorld
      msg="Click here to logout..."
      @click="logout"
    />
  </div>
</template>

<script>
import HelloWorld from './components/HelloWorld.vue'

export default {
  name: 'App',
  components: {
    HelloWorld
  },

  created() {
    this.syncAuthenticatedUser()
  },

  methods: {
    async syncAuthenticatedUser() {
      await this.$store.dispatch('fetchAuthenticatedUser')
    },

    logout() {
      const form = document.getElementById('logout-form')
      form.submit()
    },
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
