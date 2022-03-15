import api from "../../../service/api";

//import { token } from "../../../service/token";

export default {
  state: {
    me: {
      name: "",
      email: "",
    },
    authenticated: false,
  },
  mutations: {
    SET_ME(state, me) {
      state.me = me;

      state.authenticated = true;
    },
    SET_AUTHENTICATED(state, status) {
      state.authenticated = status;
    },
    LOGOUT(state) {
      state.me = {
        name: "",
        email: "",
      };
      state.authenticated = false;
    },
  },
  actions: {
    register({ commit }, param) {
      commit("SET_PRELOADER", true);

      return api.post("/auth/register", param);
    },
    login({ commit }, param) {
      commit("SET_PRELOADER", true);

      return api.post("/auth/token", param);

      // .then((response) => {
      //   localStorage.setItem("TOKEN_NAME", response.data.token);
      //   if (response.data.success != false) {
      //     dispatch("getMe");
      //   }
      // });
    },
    getMe({ commit }) {
      const token = localStorage.getItem("TOKEN_NAME");
      if (!token) return;

      commit("SET_ME", {});
      return api
        .get("auth/getMe", {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        })
        .then((response) => {
          commit("SET_ME", response.data);
        })
        .catch(() => {
          localStorage.removeItem("TOKEN_NAME");
        });
    },
    logout({ commit }) {
      const token = localStorage.getItem("TOKEN_NAME");

      if (!token) return;

      return api
        .post(
          "auth/logout",
          {},
          {
            headers: {
              Authorization: `Bearer ${token}`,
            },
          }
        )
        .then(() => {
          commit("LOGOUT");

          localStorage.removeItem("TOKEN_NAME");
        });
    },
  },
};
