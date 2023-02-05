<template>
    <div :id="template">
        <div v-show="loading">
            <div class="loader"></div>
        </div>
        <div v-show="!loading">
            <HeaderComponent :user="user" :isLoggedIn="loggedIn" :achievement="achievement" :preview="preview"/>
            <AboutMeComponent :tenant="tenant" :title="title" :user="user" :bio="bio" :location="location" :preview="preview" :isLoggedIn="loggedIn" />

            <ServicesComponent :services="services" :isLoggedIn="loggedIn" />
            <div id="experienceContainer" v-if="(achievement !== null && preview === '0') || preview === '1'">
                <ExperienceComponent :tenant="tenant"  :experience="achievement" :location="location" :preview="preview" :isLoggedIn="loggedIn"/>
            </div>
<!--            <SocialMediaComponent :socials="socials"/>-->
<!--            <TestimonialsComponent :reviews="reviews" :preview="preview" :tenant="tenant"/>-->
            <div id="contactContainer">
                <ContactComponent :preview="preview" :isLoggedIn="loggedIn" :contactMail="contactMail"/>
            </div>
        </div>
    </div>
</template>
<script lang="js">
    import ContactComponent from "./ContactComponent.vue";
    import ExperienceComponent from "./ExperienceComponent.vue";
    import HeaderComponent from "./HeaderComponent.vue";
    import ServicesComponent from "./ServicesComponent.vue";
    import SocialMediaComponent from "./SocialMediaComponent.vue";
    import TestimonialsComponent from "./TestimonialsComponent.vue";
    import AboutMeComponent from "./AboutMeComponent.vue";
    let bio = '/api/bio';
    let service = '/api/service';
    let achievement = '/api/achievement';
    let social = '/api/social';
    let review = '/api/review';
    let contact = '/api/contact';

    export default {
        components: {
            HeaderComponent,
            ServicesComponent,
            ExperienceComponent,
            SocialMediaComponent,
            TestimonialsComponent,
            ContactComponent,
            AboutMeComponent
        },
        data() {
            return {
                contactMail: {},
                services: [],
                bio: {},
                achievement: {},
                socials: {},
                reviews: [],
                loading: false,
                location: "",
                loggedIn: false,
            };
        },
        props: {
            template: String,
            id: "",
            user: String,
            preview: String,
            title: String,
            tenant: String,
        },
        created() {
            this.loggedIn = this.getCookie('_token');
            if (this.loggedIn) {
                localStorage.getItem('візіт') <= 1 ? location.href = `http://${location.host}/password_change` : null;
            }
        },
        mounted() {
            if (this.preview == '0') {
                this.getLocations();
            }
            else if (this.preview == '1'){
                this.services = null;
                this.bio = null;
                this.achievement = null;
                this.socials = null;
            }
            this.location = window.location.href // For absolute pathing
        },
        methods: {
            getCookie(name) {
                return document.cookie.split(";").some((c) => {
                    return c.trim().startsWith(name + "=");
                });
            },
            getLocations() {
                this.loading = true;
                const requestBio = axios.get(bio);
                const requestService = axios.get(service);
                const requestAchievement = axios.get(achievement);
                const requestSocials = axios.get(social);
                const requestReviews = axios.get(review);
                const requestContact = axios.get(contact);

                axios
                    .all([requestBio, requestService, requestAchievement, requestSocials, requestReviews, requestContact])
                    .then(
                        axios.spread((...responses) => {
                            const bioRes = responses[0];
                            const servicesRes = responses[1];
                            const achievementRes = responses[2];
                            const socialRes = responses[3];
                            const reviewRes = responses[4];
                            const contactRes = responses[5];
                            this.services = servicesRes.data.services;
                            this.bio = bioRes.data.bio;
                            this.achievement = achievementRes.data.achievement;
                            this.socials = socialRes.data.social;
                            this.reviews = reviewRes.data.reviews;
                            this.contactMail = contactRes.data.contact;

                            this.loading = false;
                        })
                    )
                    .catch((errors) => {
                        // console.log(errors)
                    });
            },
        },
        computed: {},
    };
</script>
