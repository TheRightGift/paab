<template>
    <HeaderComponent :id="1"/>
    <IntroComponent :id="1"/>
</template>
<script>
    import HeaderComponent from './HeaderComponent.vue';
    import IntroComponent from './IntroComponent.vue';
    export default {
        components: {
            HeaderComponent,
            IntroComponent
        },
        data() {
            return {};
        },
        props: {
            id: Number,
        },
        mounted() {},
        methods: {
            
        },
        computed: {},
    };
</script>
