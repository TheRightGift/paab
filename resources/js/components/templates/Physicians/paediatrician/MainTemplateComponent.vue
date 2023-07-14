<template>
    <div :id="template">
        <div v-show="loading">
            <div class="loader"></div>
        </div>
        <div v-show="!loading" class="flex flex-col">
            <HeaderComponent
                :services="services"
                :user="user"
                :isLoggedIn="loggedIn"
                :achievement="achievement"
                :feeds="social"
                :preview="preview"
                :tenant="tenant"
                :bio="bio"
                :user_id="user_id"
                :interests="interests"
                :reviews="reviews"
                :miniBlog="miniBlog"
                :userSubscribed="Boolean(usersubscribed)"
                :email="email"
                :physicianName="physicianName"
            />
            <main>
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
                    :template_id="template_id"
                    :social="social"
                />
                <ServicesComponent
                    :services="services"
                    :isLoggedIn="loggedIn"
                    :preview="preview"
                    :interests="interests"
                />
                <MiniBlogComponent
                    :tenant="tenant"
                    :preview="preview"
                    :isLoggedIn="loggedIn"
                    :miniBlog="miniBlog"
                    :bio="bio"
                    v-if="miniBlog.length > 0 || preview === '1'"
                />
                <ContactComponent
                    :preview="preview"
                    :isLoggedIn="loggedIn"
                    :contactMail="contact"
                />
                    <!-- :physicianHero="physicianHero"
                    :physicianName="physicianName" -->
            </main>
            
            <!-- <SocialMediaComponent
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
             <FooterComponent :user="user" :physicianName="physicianName"/> -->
     
            <div class="fixed-bottom" v-if="can === '1'">
                <!-- <a
                    target="_self"
                    :href="
                        'https://whitecoatdomain.com/auth/claim?claimable=' +
                        tenant +
                        '&mail=' +
                        email
                    "
                    class="btn waves waves-effect button"
                    >Edit your website</a
                > -->
                <a
                    target="_self"
                    :href="
                        'http://localhost:8000/auth/claim?claimable=' +
                        tenant +
                        '&code=' +
                        code
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
let centralURL = process.env.MIX_APP_URL;
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
            interests: [],
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
            centralURL: centralURL,
            physicianHero: 'physicianHeroWhiteMale.jpg',
            physicianName: 'John Summers',
            previewImages: [
                    {img: 'physicianHero.png', physicianName: 'Olivia Felix'}, 
                    {img: 'physicianHeroAsianFemale.jpg', physicianName: 'Jane Chang'},
                    {img: 'physicianHeroWhiteMale.jpg', physicianName: 'John Summers'},                    
                ]
        };
    },
    props: {
        template: String,
        template_id: String,
        id: "",
        user: String,
        preview: String,
        title: String,
        tenant: String,
        social: String,
        can: String,
        email: String,
        user_id: String,
        usersubscribed: String,
        code: String,
    },
    created() {
        this.preview == '0' ? this.checkAuth() : null;
    },
    mounted() {
        let index = 0
        setInterval(
            () => {
                this.swapPreviewProfile(index);

                let imgArrayLen = this.previewImages.length;
                index++;
                
                if(index >= imgArrayLen){  
                    index = 0;
                }                
            }, 
            6000
        );
        
        if (this.preview == '0') {
            this.getLocations();
        } else if (this.preview == '1') {
            this.services = null;
            this.bio = null;
            this.achievement = null;
            this.socials = null;
            this.miniBlog = [
                {
                    title: "Five Reasons You Need a Website: Credibility",
                    imageUrl: `/media/img/templates/1/blogImage.jpg`,
                    body: `<p>One of the main reasons you should have a website for your business is to increase your organization's credibility. Chances are there are several providers offering a similar service to yours. One way you can stand out is by having a website that looks good and clearly communicates quality information to your consumers.</p><p>Without a website, people may question your legitimacy as a business. Having a website is an opportunity to make a great first impression and give people comfort that you're a real business.</p>`
                },
                {
                    title: "Five Reasons You Need a Website: Brand",
                    imageUrl: `/media/img/templates/1/blogImage.jpg`,
                    body: `<p>Showcasing your brand to your prospective customers is one of the most important things that you can do. By clearly establishing who you are, what you represent and what you stand for, you increase the chances of your customers buying from you.</p><p>This is also something that can set you apart from your competitors. Without a website, it can be incredibly challenging to do this because people can't easily find quality and reliable information on your business.</p>`
                },
                {
                    title: "Five Reasons You Need a Website: Leads",
                    imageUrl: `/media/img/templates/1/blogImage.jpg`,
                    body: `<p>Perhaps one of the most intriguing reasons to have a website for your business is because it can increase your chances of getting leads.</p><p>Once people find you online, become interested in your product or service and want to know more, they'll know how to contact you thanks to the information on your website, which gives you the opportunity to increase your sales. Even though websites have a cost, when used correctly, they have a positive ROI.</p>`
                },
                {
                    title: "Five Reasons You Need a Website: Organic Traffic",
                    imageUrl: `/media/img/templates/1/blogImage.jpg`,
                    body: `<p>Once you're online and have an SEO-optimized website, you have a chance of showing up in Google search results. This means that when people are searching for a product or service, there is a chance your website will show up in the results. This gives you the opportunity to drastically increase your customer base.</p>`
                },
                {
                    title: "Five Reasons You Need a Website: Customer Service",
                    imageUrl: `/media/img/templates/1/blogImage.jpg`,
                    body: `<p>Many businesses get calls from prospects or existing customers asking simple questions about location and hours of operation. If you miss a call, the customer is left unhappy. Calls can also distract your staff from focusing on the most important parts of your business. A website can reduce these calls and increase internal productivity. At the same time, it helps customers find useful information without needing to call, which ultimately provides an all-around better user experience.</p>`
                }
            ];
        }
        this.getInterests(); 
        this.location = window.location.href // For absolute pathing
        var dropdowns = document.querySelectorAll('.dropdown-trigger')
        for (var i = 0; i < dropdowns.length; i++){
            M.Dropdown.init(dropdowns[i]);
        }
        
    },
    methods: {
        swapPreviewProfile(index){  
            this.physicianHero = this.previewImages[index].img;
            this.physicianName = this.previewImages[index].physicianName;
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
        getInterests() {
            axios.get(`${this.centralURL}/api/interests`).then(res => {
                this.interests = res.data.interests;
            }).catch(err => {
                console.log(err);
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