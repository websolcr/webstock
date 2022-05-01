import {createStore} from "vuex"
import axios from "axios"

const store = createStore({
    state: {
        user: {
            data: {},
        }
    },
    getters: {},
    actions: {
        async fetchAuthenticatedUser() {
            const { data } = await axios.get('api/myself')

            store.commit('setUser', data)
        }
    },
    mutations: {
        setUser(state, payload) {
            state.user.data = { ...payload }
        }
    },
    modules: {},
})

export default store
