<template>
    <div :id="template">
        <div v-show="loading">
            <div class="loader"></div>
        </div>
        <div v-show="!loading">
            <HeaderComponent
                :services="services"
                :user="user"
                :isLoggedIn="loggedIn"
                :achievement="achievement"
                :feeds="social"
                :preview="preview"
            />
            <AboutMeComponent
                :tenant="tenant"
                :title="title"
                :user="user"
                :bio="bio"
                :location="location"
                :preview="preview"
                :isLoggedIn="loggedIn"
                :CV="CV"
                :contact="contact"
            />

            <ServicesComponent
                :services="services"
                :isLoggedIn="loggedIn"
                :preview="preview"
            />
            <MiniBlogComponent
                :tenant="tenant"
                :preview="preview"
                :isLoggedIn="loggedIn"
                v-if="miniBlog.length > 0 || preview === '1'"
            />
            <SocialMediaComponent
                :social="social"
                v-if="
                    (social !== null && social !== '' && preview === '0') ||
                    preview === '1'
                "
                :isLoggedIn="loggedIn"
                :preview="preview"
            />
            <TestimonialsComponent v-if="reviewLen != 0 || preview == '1'" :reviews="reviews" :preview="preview" :tenant="tenant"/>
            <div id="contactContainer">
                <ContactComponent
                    :preview="preview"
                    :isLoggedIn="loggedIn"
                    :contactMail="contact"
                />
            </div>
             <FooterComponent :user="user"/>
     
            <div class="fixedBtmBtn" v-if="can === '1'">
                <a
                    target="_self"
                    :href="
                        'https://whitecoatdomain.com/auth/claim?claimable=' +
                        tenant +
                        '&mail=' +
                        email
                    "
                    class="btn waves waves-effect button"
                    >Edit your website</a
                >
            </div>
        </div>
    </div>
</template>
<script lang="js">
import ContactComponent from "./ContactComponent.vue";
import MiniBlogComponent from "./MiniBlogComponent.vue";
import HeaderComponent from "./HeaderComponent.vue";
import ServicesComponent from "./ServicesComponent.vue";
import SocialMediaComponent from "./SocialMediaComponent.vue";
import TestimonialsComponent from "./TestimonialsComponent.vue";
import AboutMeComponent from "./AboutMeComponent.vue";
import FooterComponent from './FooterComponent.vue';
let bio = '/api/bio';
let service = '/api/service';
let achievement = '/api/achievement';
let review = '/api/review';
let contact = '/api/contact';
let miniBlog = '/api/miniblog'
// CVs
let cvXpo = '/api/cvexperience';
let summy = '/api/cv';
let training = '/api/cvtraining';
let referal = '/api/cvreferral';
let cvMed = '/api/cvmed_school';
let cvOther = '/api/cv_otherschool';
let underGrad = '/api/cv_gradschool';
let license = '/api/license';

export default {
    components: {
        HeaderComponent,
        ServicesComponent,
        MiniBlogComponent,
        SocialMediaComponent,
        TestimonialsComponent,
        ContactComponent,
        AboutMeComponent,
        FooterComponent,
    },
    data() {
        return {
            contact: {},
            services: [],
            bio: {},
            achievement: {},
            reviews: [],
            loading: false,
            location: "",
            loggedIn: false,
            initialCheck: false,
            CV: {},
            reviewLen: 0,
            miniBlog: [],
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
        can: String,
        email: String,
    },
    created() {
        this.checkAuth();
    },
    mounted() {
        if (this.preview == '0') {
            this.getLocations();
        }
        else if (this.preview == '1') {
            this.services = null;
            this.bio = null;
            this.achievement = null;
            this.socials = null;
        }
        this.location = window.location.href // For absolute pathing
        var dropdowns = document.querySelectorAll('.dropdown-trigger')
        for (var i = 0; i < dropdowns.length; i++){
            M.Dropdown.init(dropdowns[i]);
        }
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
            const requestMiniBlog = axios.get(miniBlog);
            // CVs
            const requestSummary = axios.get(summy);
            const requestCvXpo = axios.get(cvXpo);
            const requesTraining = axios.get(training);
            const requestReferral = axios.get(referal);
            const requestMedSchool = axios.get(cvMed);
            const requestOtherSchool = axios.get(cvOther);
            const requestUnderGrad = axios.get(underGrad);
            const requestLicense = axios.get(license);

            axios
                .all([requestBio, requestService, requestAchievement, requestReviews, requestContact, requestMiniBlog, requestSummary, requestCvXpo, requesTraining, requestReferral, requestMedSchool, requestOtherSchool, requestUnderGrad, requestLicense,
                ])
                .then(
                    axios.spread((...responses) => {
                        const bioRes = responses[0];
                        const servicesRes = responses[1];
                        const achievementRes = responses[2];
                        const reviewRes = responses[3];
                        const contactRes = responses[4];
                        const miniBlogRes = responses[5]
                        // CV
                        const summaryRes = responses[6];
                        const cvExpRes = responses[7];
                        const trainingRes = responses[8];
                        const referralRes = responses[9];
                        const medSchoolRes = responses[10];
                        const otherSchoolRes = responses[11];
                        const underGradRes = responses[12];
                        const licenseRes = responses[13];

                        this.services = servicesRes.data.services;
                        this.bio = bioRes.data.bio;
                        this.achievement = achievementRes.data.achievement;
                        this.reviews = reviewRes.data.reviews;
                        this.reveiwLen = this.reviews.data.length;
                        this.contact = contactRes.data.contact;
                        this.miniBlog = miniBlogRes.data.miniBlog;
                        this.CV = {
                            summary: summaryRes.data.cvSummary,
                            experience: cvExpRes.data.experience,
                            trainings: trainingRes.data.trainings,
                            referee: referralRes.data.referral,
                            medschool: medSchoolRes.data.medSchool,
                            otherschool: otherSchoolRes.data.additionalSchool,
                            undergradschool: underGradRes.data.underGradSchool,
                            license: licenseRes.data.license
                        }

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
<style scoped>
    .button {
        background-color: var(--white);
        color: var(--sec);
        border-radius: 100px;
    }
    .button:hover {
        background-color: var(--pri);
        color: var(--white);
    }
</style>