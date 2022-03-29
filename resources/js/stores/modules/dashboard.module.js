import api from "~/config/libs/axios";
const actions = {
    getDashboardContent: async (cx, { action }) => {
        let { data } = await api.post(`/admin/dashboard/get-data/${action}`);
        return data;
    },
};

export default {
    namespaced: true,
    actions,
};
