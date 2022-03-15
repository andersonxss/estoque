import api from "../../../service/api";
const actions = {
  getProdutos({ commit }) {
    commit("SET_PRELOADER", true);
    return api
      .get("/produtos")
      .then((response) => {
        commit("GET_PRODUTOS", response.data);
      })
      .finally(() => {
        commit("SET_PRELOADER", false);
      });
  },
  getDescontos({ commit }) {
    commit("SET_PRELOADER", true);
    return api
      .get("/descontos")
      .then((response) => {
        commit("GET_DESCONTOS", response.data);
      })
      .finally(() => {
        commit("SET_PRELOADER", false);
      });
  },
  setNovoProduto({ commit }, param) {
    commit("SET_PRELOADER", true);
    return api.post("/produtos", param).finally(() => {
      commit("SET_PRELOADER", false);
    });
  },
};

export default actions;
