<template>
    <div class="col-12 dash-card flex-fill">
        <div class="card shadow h-100">
            <div class="container py-3">
                <div class="d-flex flex-column">
                    <div v-if="loading" class="shimmer my-2" :style="{ height: 24, width: '70%' }" />
                    <b class="mb-1" v-else>Atidades Recentes</b>
                    <template v-for="(click, i) in clicks">
                        <div :key="i" class="d-flex flex-column mb-3">
                            <div class="d-flex flex-row">
                                <small>
                                    <a href="">{{ click.short_url.original_url }}</a>
                                </small>
                                <small class="mx-3">{{ click.short_url.short_url }}</small>
                            </div>
                            <div class="d-flex flex-row">
                                <small v-html="click.short_url.f_created_at_badge" />
                            </div>
                        </div>
                    </template>
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
            clicks: [],
        };
    },
    created() {
        this.getData();
    },
    methods: {
        ...mapActions("dashboard", ["getDashboardContent"]),
        getData() {
            this.getDashboardContent({ action: "getRecentClicks" }).then((data) => {
                this.clicks = data;
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
