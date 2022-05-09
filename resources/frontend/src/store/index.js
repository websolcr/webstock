import {createStore} from "vuex"
import axios from "axios"

const store = createStore({
  state: {
    user: JSON.parse(localStorage.getItem('user')),

    tenancy: JSON.parse(localStorage.getItem('tenancy')),
  },

  getters: {},

  actions: {
    async fetchAuthenticatedUser() {
      const userData = localStorage.getItem('user')

      if (userData) {
        store.commit('setUser', JSON.parse(userData))

        return
      }

      const { data } = await axios.get('api/myself')
      localStorage.setItem('user', JSON.stringify({ ...data }))
      store.commit('setUser', data)
    },

    async fetchActiveTenant() {
      await axios.get('api/active-tenant')
        .then(response => {
          localStorage.setItem('tenancy', JSON.stringify({...response.data}))
          store.commit('setTenant', response.data)
        })
        .catch(error => {
          console.log(error.response)
        })
    },
  },

  mutations: {
    setUser(state, payload) {
      state.user = { ...payload }
    },

    setTenant(state, payload) {
      localStorage.setItem('tenancy', JSON.stringify({...payload}))
      state.tenant = { ...payload }
    }
  },
  modules: {},
})

export default store
