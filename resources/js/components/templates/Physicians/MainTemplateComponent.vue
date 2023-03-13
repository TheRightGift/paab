<template>
    <div :id="template">
        <div v-show="loading">
            <div class="loader"></div>
        </div>
        <div v-show="!loading && !otpPrompt">
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
            <div
                id="experienceContainer"
                v-if="
                    (achievement !== null && preview === '0') || preview === '1'
                "
            >
                <ExperienceComponent
                    :tenant="tenant"
                    :experience="achievement"
                    :location="location"
                    :preview="preview"
                    :isLoggedIn="loggedIn"
                />
            </div>
            <SocialMediaComponent
                :social="social"
                v-if="
                    (social !== null && social !== '' && preview === '0') ||
                    preview === '1'
                "
                :isLoggedIn="loggedIn"
            />
            <!--            <TestimonialsComponent :reviews="reviews" :preview="preview" :tenant="tenant"/>-->
            <div id="contactContainer">
                <ContactComponent
                    :preview="preview"
                    :isLoggedIn="loggedIn"
                    :contactMail="contact"
                />
            </div>
            <FooterComponent />
            <!-- :href="
                        'https://whitecoatdomain.com/auth/claim?claimable=' +
                        tenant +
                        '&mail=' +
                        email
                    " -->
            <div class="fixedBtmBtn" v-if="can === '1'">
                <button class="btn waves waves-effect" @click="sendOtp" :disabled="disabledBtn">Edit your website Now <i class="fas fa-circle-notch fa-spin" v-if="disabledBtn"></i></button>
            </div>
            
        </div>
        <div class="row authContainDiv" v-if="otpPrompt">
                <div class="col s12 m12 l6 otpContainer hide-on-med-and-down">
                    <div class="wlcNoteDiv">
                        <a href="/" class="wlcNoteLogo">
                            <img
                                src="/media/img/whiteCoatDomain1.png"
                                alt="whiteCoatDomain.png"
                                class="authLogo"
                            />
                        </a>
                        <p class="wlcNoteTitle">
                            Start your journey <br />with us...
                        </p>
                        <p class="wlcNoteTxt">
                            “Good things come to those who wait”.
                            <span class="getStartedOtpSpan right">Nathan Sykes</span>
                        </p>
                        <p class="wlcNoteFooterTxt">
                            &copy; White Coat Domain. {{ getYear() }}. We support
                            your brand!
                        </p>
                    </div>
                </div>
    
                <div class="col s12 m12 l6 otpContainer">
                    <div class="authHeadingContainer center-align hide-on-large-only">
                        <a href="/" class="authHeading">WhiteCoatDomain</a>
                    </div>
                    <OtpComponent @res="otpVerifier" :otp="otp" :type="'register'"/>
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
import FooterComponent from './FooterComponent.vue';
import OtpComponent from '../../partials/OtpComponent.vue';
let bio = '/api/bio';
let service = '/api/service';
let achievement = '/api/achievement';
let review = '/api/review';
let contact = '/api/contact';
// CVs
let cvXpo = '/api/cvexperience';
let summy = '/api/cv';
let training = '/api/cvtraining';
let referal = '/api/cvreferral';
let cvMed = '/api/cvmed_school';
let cvOther = '/api/cv_otherschool';
let underGrad = '/api/cv_gradschool';
let license = '/api/license';
let env = process.env.MIX_APP_ENV;
let domain = env === 'production' ? 'https://whitecoatdomain.com' : 'http://localhost:8000'

export default {
    components: {
        HeaderComponent,
        ServicesComponent,
        ExperienceComponent,
        SocialMediaComponent,
        TestimonialsComponent,
        ContactComponent,
        AboutMeComponent,
        FooterComponent,
        OtpComponent,
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
            otpPrompt: false,
            disabledBtn: false,
            otp: null,
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
    },
    methods: {
        getYear() {
            return new Date().getFullYear();
        },
        otpVerifier(value) {
            if (value === 200) {
                window.location.replace(`${domain}/auth/claim?claimable=${this.tenant}&mail=${this.email}`);
            }
        },
        sendOtp() {
            let data = {
                email: this.email,
            }
            this.disabledBtn = !this.disabledBtn;
            axios
                .post("/auth/verifyEmailForRegistration", data)
                .then((res) => {
                    if (res.status === 200) {
                        if (res.data.status == 200) {
                                this.otp = res.data.otp,
                                this.otpPrompt = true;
                                this.disabledBtn = !this.disabledBtn;
                    
                        } else if (res.data.status == 404) {
                            M.toast({
                                html: res.data.error,
                                classes: "errorNotifier",
                            });
                            this.disabledBtn = !this.disabledBtn;
                        }
                    }
                })
                .catch((err) => {
                    console.log(err.response);
                    this.disabledBtn = !this.disabledBtn;
                });
        },  
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
                .all([requestBio, requestService, requestAchievement, requestReviews, requestContact, requestSummary, requestCvXpo, requesTraining, requestReferral, requestMedSchool, requestOtherSchool, requestUnderGrad, requestLicense,
                ])
                .then(
                    axios.spread((...responses) => {
                        const bioRes = responses[0];
                        const servicesRes = responses[1];
                        const achievementRes = responses[2];
                        const reviewRes = responses[3];
                        const contactRes = responses[4];
                        // CV
                        const summaryRes = responses[5];
                        const cvExpRes = responses[6];
                        const trainingRes = responses[7];
                        const referralRes = responses[8];
                        const medSchoolRes = responses[9];
                        const otherSchoolRes = responses[10];
                        const underGradRes = responses[11];
                        const licenseRes = responses[12];

                        this.services = servicesRes.data.services;
                        this.bio = bioRes.data.bio;
                        this.achievement = achievementRes.data.achievement;
                        this.reviews = reviewRes.data.reviews;
                        this.contact = contactRes.data.contact;
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
