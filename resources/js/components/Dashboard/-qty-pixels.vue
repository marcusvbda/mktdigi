<template>
    <div class="col-md-6 col-sm-12 dash-card flex-fill">
        <div class="card shadow h-100">
            <div class="container py-3">
                <div class="d-flex flex-column">
                    <b class="mb-1">Pixels</b>
                    <div class="d-flex flex-row align-items-end">
                        <div v-if="loading" class="shimmer my-2" :style="{ height: 30, width: 45 }" />
                        <div class="number" v-else>{{ qty }}</div>
                    </div>
                    <small class="description">Pixels de Rastreamento cadastrados no sistema</small>
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
            qty: 0,
        };
    },
    created() {
        this.getData();
    },
    methods: {
        ...mapActions("dashboard", ["getDashboardContent"]),
        getData() {
            this.getDashboardContent({ action: "getPixelQty" }).then((data) => {
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
    .trend {
        margin-bottom: 15px;
        margin-left: 10px;
        font-size: 12px;
    }
    .description {
        font-size: 11px;
        color: gray;
    }
}
</style>
