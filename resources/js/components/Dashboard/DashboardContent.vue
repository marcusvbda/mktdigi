<template>
    <div>
        <div class="row mt-3 d-flex flex-wrap">
            <div class="col-md-3 col-sm-12">
                <div class="row">
                    <qty-pixels class="mb-3" />
                </div>
                <div class="row">
                    <qty-clicks />
                </div>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="card shadow h-100">
                    <div class="container py-3">
                        <div class="d-flex flex-column">
                            <b class="mb-1">Clique Recentes</b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-5 col-sm-12">
                <div class="row">
                    <recent-activities />
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    components: {
        "qty-pixels": require("./-qty-pixels.vue").default,
        "qty-clicks": require("./-qty-clicks.vue").default,
        "recent-activities": require("./-recent-activities.vue").default,
    },
};
</script>
