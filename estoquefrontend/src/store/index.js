import Vue from "vue";
import Vuex from "vuex";
import { state, mutations } from "./default";
import pedidos from "./modules/pedidos";
import produtos from "./modules/produtos";
import usuarios from "./modules/usuarios";
import auth from "./modules/auth";
import config from "./modules/config";

Vue.use(Vuex);

const store = new Vuex.Store({
  modules: {
    pedidos,
    produtos,
    usuarios,
    auth,
    config,
  },
  state,
  mutations,
});
export default store;
