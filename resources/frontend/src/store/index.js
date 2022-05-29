import {createStore} from "vuex"
import axios from "axios"

const store = createStore({
  state: {
    user: {},

    organization: {},
  },

  getters: {},

  actions: {
    async fetchAuthenticatedUser() {

      const { data } = await axios.get('api/myself')
      store.commit('setUser', data)
    },

    async fetchActiveOrganization() {
      await axios.get('api/active-tenant')
        .then(response => {
          store.commit('setOrganization', response.data.tenant)
        })
        .catch(error => {
          console.log(error.response)
        })
    },

    resetOrganization() {
      store.commit('resetOrganization')
    }
  },

  mutations: {
    setUser(state, payload) {
      state.user = { ...payload }
    },

    setOrganization(state, payload) {
      state.organization = { ...payload }
    },

    resetOrganization(state) {
      state.organization = {}
    }
  },
  modules: {},
})

export default store
