export default {
  GET_USUARIOS(state, data) {
    state.items = data;
  },
  GET_USUARIO(state, data) {
    state.usuario = data;
  },

  GET_PROFILES(state, data) {
    state.profiles = data;
  },
};
