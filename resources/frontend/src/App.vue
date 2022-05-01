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
import axios from 'axios'

axios.defaults.baseURL=process.env.APP_URL
axios.defaults.withCredentials = true

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
      const {data} = await axios.get('api/test')
      this.testData = data

      console.log(this.testData)
    },

    test() {
      axios.get('api/test').then(r => console.log(r))
    },

    logout(reason = '') {
      const form = document.getElementById('logout-form')

      const input = document.createElement('input')
      input.setAttribute('type', 'hidden')
      input.setAttribute('name', 'reason')
      input.setAttribute('value', reason)

      form.appendChild(input)

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
