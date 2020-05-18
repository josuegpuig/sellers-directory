import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    logged_in: false,
  },
  getters: { 
    loggedIn: state => {
      return state.model_login.connected;
    }, 
  },
  mutations: {
    setLogin(state, login) {
      state.logged_in = login;
    },
  },
  actions: {
  },
  modules: {
  }
})
