import {createStore} from "vuex"
import axios from "axios"

const store = createStore({
  state: {
    user: {
      data: {},
    },
    tenant: {},
  },
  getters: {},
  actions: {
    async fetchAuthenticatedUser() {
      const { data } = await axios.get('api/myself')

      store.commit('setUser', data)
    },

    async fetchActiveTenant() {
      const { data } = await axios.get('api/tenant')

      store.commit('setTenant', data)
    }
  },

  mutations: {
    setUser(state, payload) {
      state.user.data = { ...payload }
    },

    setTenant(state, payload) {
      state.tenant = { ...payload }
    }
  },
  modules: {},
})

export default store
