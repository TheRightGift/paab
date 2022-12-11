<template>
    <div class="row" v-if="id === 1">
        <p>Itroduction for Template ID 1</p>
    </div>

    <div class="row" v-if="id === 2">
        <p>Itroduction for Template ID 2</p>
    </div>
</template>
<script>
    export default {
        data() {
            return {};
        },
        props: {
            id: String,
        },
        mounted() {},
        methods: {
            
        },
        computed: {},
    };
</script>