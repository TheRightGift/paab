<template>
    <div :id="template">
        <HeaderComponent :user="user" />
        <ServicesComponent :user="user" :services="services" :bio="bio"/>
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
    let bio = '/api/bio';
    let service = '/api/service';

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
            return {
                services: [],
                bio: {},
            };
        },
        props: {
            template: String,
            id: "",
            user: String,
        },
        mounted() {
            // if(this.templateId)
            this.getLocations();
        },
        methods: {
            getLocations() {
                const requestBio = axios.get(bio);
                const requestService = axios.get(service);
                axios
                    .all([requestBio, requestService])
                    .then(
                        axios.spread((...responses) => {
                            const bioRes = responses[0];
                            const servicesRes = responses[1];
                            this.services = servicesRes.data.services;
                            this.bio = bioRes.data.bio;
                        })
                    )
                    .catch((errors) => {
                        console.log(errors)
                    });
            },
        },
        computed: {},
    };
</script>
