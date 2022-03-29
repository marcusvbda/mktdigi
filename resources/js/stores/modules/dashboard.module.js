const state = {
    user: {},
};

const getters = {
    getUser: (state) => state.user,
};

const mutations = {
    setUser: (state, payload) => {
        state.user = payload;
    },
};

const actions = {
    getUser: ({ commit }, payload) => {
        commit("setUser", payload);
    },
};

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions,
};
