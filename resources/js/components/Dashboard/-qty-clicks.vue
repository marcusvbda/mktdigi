<template>
    <div class="col-md-6 col-sm-12 dash-card flex-fill">
        <div class="card shadow h-100">
            <div class="container py-3">
                <div class="d-flex flex-column">
                    <div v-if="loading" class="shimmer my-2" :style="{ height: 24, width: '70%' }" />
                    <b class="mb-1" v-else>Cliques</b>
                    <div class="d-flex flex-row align-items-end">
                        <div v-if="loading" class="shimmer" :style="{ height: 45, width: 50 }" />
                        <div class="number" v-else>{{ qty[0] }}</div>
                    </div>
                    <div v-if="loading" class="shimmer my-2" :style="{ height: 22.5, width: '40%' }" />
                    <div class="description" v-else>
                        <span class="text-bold text-success">+{{ qty[1] }}</span> Hoje
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapActions } from "vuex";
export default {
    data() {
        return {
            loading: true,
            timeout: null,
            qtys: [],
        };
    },
    created() {
        this.getData();
    },
    methods: {
        ...mapActions("dashboard", ["getDashboardContent"]),
        getData() {
            this.getDashboardContent({ action: "getClickQty" }).then((data) => {
                this.qty = data;
                this.loading = false;
            });
        },
    },
};
</script>
<style lang="scss" scoped>
.dash-card {
    .number {
        font-weight: 600;
        font-size: 30px;
    }
    .description {
        font-size: 15px;
        color: gray;
    }
}
</style>
