import Vue from 'vue'
import Vuetify from 'vuetify/lib'

Vue.use(Vuetify)

// Translation provided by Vuetify (javascript)
import fa from 'vuetify/es5/locale/fa'

export default new Vuetify({
  lang: {
    locales: { fa },
    current: 'fa',
  },
})
