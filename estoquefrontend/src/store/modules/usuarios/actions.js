import api from "../../../service/api";
const actions = {
  getUsuarios({ commit }) {
    commit("SET_PRELOADER", true);
    return api
      .get("/usuarios")
      .then((response) => {
        commit("GET_USUARIOS", response.data);
      })
      .finally(() => {
        commit("SET_PRELOADER", false);
      });
  },
  getUsuario({ commit }, param) {
    commit("SET_PRELOADER", true);
    return api.get(`/usuarios/${param}`).finally(() => {
      commit("SET_PRELOADER", false);
    });
  },
  getPofiles({ commit }) {
    return api.get("/profiles").then((response) => {
      commit("GET_PROFILES", response.data);
    });
  },
  setNovoUsuario({ commit }, param) {
    commit("SET_PRELOADER", true);
    return api.post("/usuarios", param).finally(() => {
      commit("SET_PRELOADER", false);
    });
  },
  setEditarUsuario({ commit }, param) {
    commit("SET_PRELOADER", true);

    return api.put(`/usuarios/${param.id}`, param).finally(() => {
      commit("SET_PRELOADER", false);
    });
  },
};

export default actions;
