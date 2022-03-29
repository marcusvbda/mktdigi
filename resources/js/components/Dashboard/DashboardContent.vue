<template>
    <div class="row mt-3 d-flex flex-wrap">
        <div class="col-md-4 col-sm-12">
            <div class="row">
                <qty-pixels class="mb-3" />
            </div>
            <div class="row">
                <qty-clicks class="mb-3" />
            </div>
        </div>
    </div>
</template>
<script>
export default {
    components: {
        "qty-pixels": require("./-qty-pixels.vue").default,
        "qty-clicks": require("./-qty-clicks.vue").default,
    },
};
</script>
