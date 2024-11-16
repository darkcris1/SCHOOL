// store/auth.js
const state = {
  token: localStorage.getItem("token") || null,
  user: JSON.parse(localStorage.getItem("user")) || null,
};

const getters = {
  isAuthenticated: (state) => !!state.token,  // Getter is now a function
  getUser: (state) => state.user,  // Getter is now a function
};

const actions = {
  login({ commit }, { token, user }) {
    localStorage.setItem("token", token);
    localStorage.setItem("user", JSON.stringify(user));
    commit("SET_AUTH", { token, user });
  },
  logout({ commit }) {
    localStorage.removeItem("token");
    localStorage.removeItem("user");
    commit("CLEAR_AUTH");
  },
};

const mutations = {
  SET_AUTH(state, { token, user }) {
    state.token = token;
    state.user = user;
  },
  CLEAR_AUTH(state) {
    state.token = null;
    state.user = null;
  },
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations,
};
