<template>
    <div class="dashboard-content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-12 d-flex flex-row justify-content-between align-items-center">
                                <h5 class="mb-0"><span class="el-icon-data-analysis mr-3" />{{ title }}</h5>
                                <dash-filters :user_id="user_id" :selected_polo_ids="selected_polo_ids" />
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row mt-3 d-flex flex-wrap">
                            <div class="col-md-6 col-sm-12">
                                <div class="row">
                                    <qty-pixels class="mb-3" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    components: {
        "qty-pixels": require("./-qty-pixels.vue").default,
    },
};
</script>
