import loginStore from "./login";
import panelStore from "./panel";
import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    login: loginStore,
    panel: panelStore
  }
})
