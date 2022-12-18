<template>
    <div :id="template">
        <div v-show="loading">
            <div class="loader"></div>
        </div>
        <div v-show="!loading">
            <HeaderComponent :user="user"/>
            <ServicesComponent :user="user" :services="services" :bio="bio"/>
            <ExperienceComponent  :experience="achievement"/>
            <SocialMediaComponent :socials="socials"/>
            <TestimonialsComponent />
            <ContactComponent />
        </div>
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
    let achievement = '/api/achievement';
    let social = '/api/social';

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
                achievement: {},
                socials: {},
                loading: false,
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
                this.loading = true;
                const requestBio = axios.get(bio);
                const requestService = axios.get(service);
                const requestAchievement = axios.get(achievement);
                const requestSocials = axios.get(social);

                axios
                    .all([requestBio, requestService, requestAchievement, requestSocials])
                    .then(
                        axios.spread((...responses) => {
                            const bioRes = responses[0];
                            const servicesRes = responses[1];
                            const achievementRes = responses[2];
                            const socialRes = responses[3];
                            this.services = servicesRes.data.services;
                            this.bio = bioRes.data.bio;
                            this.achievement = achievementRes.data.achievement;
                            this.socials = socialRes.data.social;
                           
                            this.loading = false;
                            
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
