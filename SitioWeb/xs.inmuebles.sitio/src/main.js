import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
<<<<<<< Updated upstream
=======
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { fas } from '@fortawesome/free-solid-svg-icons'
import ProgressBar from 'vuejs-progress-bar'
Vue.use(ProgressBar)

library.add(fas)

Vue.component('font-awesome-icon', FontAwesomeIcon)

>>>>>>> Stashed changes

import './styles/styles.scss'
import vuetify from './plugins/vuetify'

Vue.config.productionTip = false

new Vue({
  router,
  store,
  vuetify,
  render: h => h(App)
}).$mount('#app')
