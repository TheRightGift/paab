<template>
    <SideNavComponent />
    <TabForm
        :user="userDets"
        :bio="bio"
        :services="services"
        :achievement="achievement"
        :contact="contact"
        :social="social"
        :general="general"
    />
    <!-- <edit-website-modal-component :user="userDets"/> -->
</template>
<script>
    import SideNavComponent from "./partial/SideNavComponent.vue";
    import EditWebsiteModalComponent from "./partial/GeneralComponent.vue";
    import TabForm from "./partial/TabFormComponent.vue";

    let bio = "/api/bio";
    let service = "/api/service";
    let achievement = "/api/achievement";
    let contact = "/api/contact";
    let social = "/api/social";
    let general = "/api/general";

    export default {
        components: { EditWebsiteModalComponent, TabForm, SideNavComponent },
        props: {
            user: String,
        },
        data() {
            return {
                userDets: JSON.parse(this.user),
                services: [],
                bio: {},
                achievement: {},
                general: {},
                social: {},
                contact: {},
                loading: false,
            };
        },
        mounted() {
            this.getLocations();
        },
        methods: {
            getLocations() {
                this.loading = true;
                const requestBio = axios.get(bio);
                const requestService = axios.get(service);
                const requestAchievement = axios.get(achievement);
                const requestContact = axios.get(contact);
                const requestSocial = axios.get(social);
                const requestGeneral = axios.get(general);
                axios
                    .all([
                        requestBio,
                        requestService,
                        requestAchievement,
                        requestContact,
                        requestSocial,
                        requestGeneral,
                    ])
                    .then(
                        axios.spread((...responses) => {
                            const bioRes = responses[0];
                            const servicesRes = responses[1];
                            const achievementRes = responses[2];
                            const contactRes = responses[3];
                            const socialRes = responses[4];
                            const generalRes = responses[5];
                            this.services = servicesRes.data.services;
                            this.bio = bioRes.data.bio;
                            this.achievement = achievementRes.data.achievement;
                            this.contact = contactRes.data.contact;
                            this.social = socialRes.data.social;
                            this.general = generalRes.data.general;
                            this.loading = false;
                        })
                    )
                    .catch((errors) => {
                        console.log(errors);
                    });
            },
        },
        setup() {},
    };
</script>