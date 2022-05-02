<template>
  <div>
    <img
      alt="Vue logo"
      src="./assets/logo.png"
    >
    <HelloWorld
      msg="Click here to logout..."
      @click="logout"
    />

    <p @click="test">
      adkabdd
    </p>
  </div>
</template>

<script>
import HelloWorld from './components/HelloWorld.vue'

export default {
  name: 'App',
  components: {
    HelloWorld
  },

  data() {
    return {
      testData: [],
    }
},

  created() {
    this.testFUnction()
  },

  methods: {
    async testFUnction() {
      const {data} = await this.$http.get('/test')
      this.testData = data
    },

    test() {
      this.$http.get('/test')
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
