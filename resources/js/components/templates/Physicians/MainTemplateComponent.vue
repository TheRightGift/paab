<template>
    <div :id="template">
        <HeaderComponent/>
        <IntroComponent/>
        <p>Num: {{template}}</p>
    </div>
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
            template: String,
            id: ''
        },
        mounted() {
            // if(this.templateId)
            console.log(this.template)
        },
        methods: {
            
        },
        computed: {},
    };
</script>
