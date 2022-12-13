<template>
    <div :id="template">
        <HeaderComponent />
        <ServicesComponent />
        <ExperienceComponent />
        <SocialMediaComponent />
        <TestimonialsComponent />
        <ContactComponent />
    </div>
</template>
<script>
    import ContactComponent from "./ContactComponent.vue";
    import ExperienceComponent from "./ExperienceComponent.vue";
    import HeaderComponent from "./HeaderComponent.vue";
    import ServicesComponent from "./ServicesComponent.vue";
    import SocialMediaComponent from "./SocialMediaComponent.vue";
    import TestimonialsComponent from "./TestimonialsComponent.vue";
    export default {
        components: {
            HeaderComponent,
            ServicesComponent,
            ExperienceComponent,
            SocialMediaComponent,
            TestimonialsComponent,
            ContactComponent,
        },
        data() {
            return {};
        },
        props: {
            template: String,
            id: "",
        },
        mounted() {
            // if(this.templateId)
            console.log(this.template);
        },
        methods: {},
        computed: {},
    };
</script>
