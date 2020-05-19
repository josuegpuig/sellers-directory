import Vue from 'vue'
import './plugins/axios'
import App from './App.vue'
import router from './router'
import store from './store'

import MaterialKit from "./plugins/material-kit";

import * as Sentry from '@sentry/browser';
import * as Integrations from '@sentry/integrations';

Vue.config.productionTip = false

Vue.use(MaterialKit);

Sentry.init({
  dsn: 'https://953d86547eac447b8ca600900e70fe7c@o376461.ingest.sentry.io/5244203',
  integrations: [new Integrations.Vue({Vue, attachProps: true})],
});

const NavbarStore = {
  showNavbar: false
};

Vue.mixin({
  data() {
    return {
      NavbarStore
    };
  }
});

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
