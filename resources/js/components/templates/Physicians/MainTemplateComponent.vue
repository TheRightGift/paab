<template>
    <div :id="template">
        <div v-show="loading">
            <div class="loader"></div>
        </div>
        <div v-show="!loading">
            <HeaderComponent :user="user" :isLoggedIn="loggedIn" :achievement="achievement" :feeds="social" :preview="preview"/>
            <AboutMeComponent :tenant="tenant" :title="title" :user="user" :bio="bio" :location="location" :preview="preview" :isLoggedIn="loggedIn" />

            <ServicesComponent :services="services" :isLoggedIn="loggedIn" />
            <div id="experienceContainer" v-if="(achievement !== null && preview === '0') || preview === '1'">
                <ExperienceComponent :tenant="tenant"  :experience="achievement" :location="location" :preview="preview" :isLoggedIn="loggedIn"/>
            </div>
            <SocialMediaComponent :social="social" v-if="(social !== null && social !== '' && preview === '0') || preview === '1'" :isLoggedIn="loggedIn"/>
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
                reviews: [],
                loading: false,
                location: "",
                loggedIn: false,
                initialCheck: false,
            };
        },
        props: {
            template: String,
            id: "",
            user: String,
            preview: String,
            title: String,
            tenant: String,
            social: String,
        },
        created() {
            this.checkAuth();
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
            checkAuth() {
                this.initialCheck = true;
                const _token = ("; " + document.cookie)
                    .split(`; _token=`)
                    .pop()
                    .split(";")[0];
                if (_token == "") {
                    this.initialCheck = false;
                    this.loggedIn = false;
                } else {
                    axios
                        .post("/api/verifyToken", { accessToken: _token })
                        .then((res) => {
                            console.log(res)
                            if (res.data.status == 401) {
                                this.loggedIn = false;
                                this.initialCheck = false;
                            } else if (res.data.status == 200) {
                                this.initialCheck = false;
                                this.loggedIn = true;
                            }
                        })
                        .catch((err) => {
                            console.log(err);
                            this.initialCheck = false;
                        });
                }
            },
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
                const requestReviews = axios.get(review);
                const requestContact = axios.get(contact);

                axios
                    .all([requestBio, requestService, requestAchievement, requestReviews, requestContact])
                    .then(
                        axios.spread((...responses) => {
                            const bioRes = responses[0];
                            const servicesRes = responses[1];
                            const achievementRes = responses[2];
                            const reviewRes = responses[3];
                            const contactRes = responses[4];
                            this.services = servicesRes.data.services;
                            this.bio = bioRes.data.bio;
                            this.achievement = achievementRes.data.achievement;
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
