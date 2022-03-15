import Vue from "vue";

import router from "./router";
import store from "./store";
import BaseTemplate from "./BaseTemplate";
import { BootstrapVue } from "bootstrap-vue";
import VueSweetalert2 from "vue-sweetalert2";
import VueSuggestion from "vue-suggestion";
import VueToastify from "vue-toastify";
import VueLuxon from "vue-luxon";
import "bootstrap/dist/css/bootstrap.css";
import "bootstrap-vue/dist/bootstrap-vue.css";
import "sweetalert2/dist/sweetalert2.min.css";
Vue.config.productionTip = false;
Vue.use(BootstrapVue);
Vue.use(VueSweetalert2);
Vue.use(VueSuggestion);
Vue.use(VueToastify);
Vue.use(VueLuxon, {
  input: {
    zone: "utc",
    format: "sql",
  },
  output: "both",
});
Vue.component("preloader-component", () => import("./components/preloader"));

new Vue({
  render: (h) => h(BaseTemplate),
  router,
  store,
}).$mount("#app");
store.dispatch("getMe");
