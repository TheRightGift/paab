<template>
    <div>
        <div class="mainBackground">
            <div class="customNav d-flex justify-between align-center">
                <div class="logoContainer">
                    <img class="logo" src="/media/img/wcdlogoWhite.png" alt="Whitecoatdomain Logo">
                </div>
                <div class="signUpBtnContainer">
                    <button class="button signin waves-effect waves-deep-orange" @click="route('auth/login')" >Sign in</button>
                </div>
            </div>
            <div class="d-flex flex-col">
                <section class="introductory">
                    <div class="container">
                        <div class="introductoryBody">
                            <p class="introductoryHeader">
                                Enhance your public image with white coat domain.
                            </p>
                            <p class="introductorySummary">
                                As a physicians, it is crucial to maintain and manage your public profile. We strongly recommend actively managing your online identity by securing a personal domain name and maintaining a website separate from social media.
                            </p>
                            <div class="getStartedLayout">
                                <button class="button getstartedbtn waves-effect waves-deep-orange" @click="route('auth/getstarted')" >Get Started</button>
                            </div>
                            <div class="introductoryImageContainer"> 
                                <img class="introductoryImg responsive-img" :src="'/media/img/'+bannerImg" alt="Introductory Image of our template">
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        
        <div class="d-flex flex-col">
            <section class="advert">
                <div class="advBody">
                    <p class="advHeader">
                        MAKE YOUR PORTFOLIO WORK FOR YOU
                    </p>
                    <img class="introductoryImg responsive-img" src="/media/img/wcdHomeAdvSection.png" alt="Introductory Image of our template">
                    <div class="custom-container">
                        <div class="row">
                            <div class="col l4 m4 s12 article">
                                <p>
                                    Choose from our wide range of groundbreaking templates, designer fonts, and eye-catching colors that reflect your style and professional taste.
                                </p>
                            </div>
                            <div class="col l4 m4 s12 article">
                                <p>
                                    Explore our add-ons, whether you want to link your social media platforms, schedule an appointment, or display client reviews.
                                </p>
                            </div>
                            <div class="col l4 m4 s12 article">
                                <p>
                                    Boost the reach of your words by linking all of your social media accounts to expand and retain your audience.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="getStartedLayout">
                        <button class="button getstartedbtnFor waves-effect waves-deep-orange" @click="route('auth/getstarted')" >Get Started</button>
                    </div>
                </div>
            </section>
            <section class="templateFeature">
                <div class="custom-container">
                    <div class="templateFeatureBody">
                        <p class="templateFeatureHeader">
                            MORE THAN JUST A LANDING PAGE.
                        </p>
                        <p class="templateFeatureSummary">
                            White Coat Domain is providing you with an opportunity to showcase who you are and what you can offer to your target audience. Discover thousands of customized, mobile-responsive templates that will help convert visitors into potential clients.
                        </p>
                        <div class="mb-6 mt-1">
                            <button class="button getStartedBtn waves-effect waves-deep-orange" @click="route('auth/getstarted')" >Get Started</button>
                        </div>
    
                        <div class="row templateFeatureDetMed">
                            <div class="col l4 m4 s12 left-align">
                                <div class="content mb-7 mt-9">
                                    <div class="icon-container">
                                        <img src="/media/img/message.svg" alt="message icon">
                                    </div>
                                    <p class="content-header">LIVE CHAT</p>
                                    <p class="contentSummary">Need help creating an amazing online portfolio? We've got you covered! Our help desk is standing by, ready to assist you as you take those critical steps. Let us guide you and provide the support you need to make your portfolio shine!.</p>
                                </div>
                                <div class="content marginTop-4">
                                    <div class="icon-container">
                                        <img src="/media/img/like.svg" alt="like icon">
                                    </div>
                                    <p class="content-header">SOCIAL MEDIA POST</p>
                                    <p class="contentSummary">Let your patients connect with you on social level and see you outside the white coat by linking all your social media platforms.</p>
                                </div>
                            </div>
                            <div class="col l4 m4 s12">
                                <img class="responsive-img" src="/media/img/templateFeatureSectionImg.png" alt="Template Feature Image Rep">
                            </div>
                            <div class="col l4 m4 s12">
                                <div class="content mb-7 mt-9">
                                    <div class="icon-container">
                                        <img src="/media/img/cv.png" width="50" height="50" alt="cv icon">
                                    </div>
                                    <p class="content-header">CURRICULUM VITAE</p>
                                    <p class="contentSummary">Enter your information and get instant access to your auto-generated curriculum vitae (CV).</p>
                                </div>
                                <div class="content marginTop-6">
                                    <div class="icon-container">
                                        <img src="/media/img/reviewflag.svg" alt="flag-review icon">
                                    </div>
                                    <p class="content-header">CLIENT REVIEW</p>
                                    <p class="contentSummary">Connect with your patients on a personal level and show them the person behind the white coat. Link all your social media platforms and let them get to know you outside of the office.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="howToGetStarted">
                <div class="container">
                    <div class="howToGetStartedBody">
                        <p class="howToGetStartedHeader">
                            HOW TO GET STARTED.
                        </p>
                        <p class="howToStep mb-6">Follow these 6 simple steps to create a website today</p>
                        <div class="row hide-on-small-only">
                            <div class="col l4 m4 marginBottom-3">
                                <div class="numberIcon">
                                    <div>1</div>
                                </div>
                                <p class="howToCounterHeader bold">​Sign up for a free website builder.</p>
                                <p class="howToInstruction">​Choose what kind of website you want to create.</p>
                            </div>
                            <div class="col l4 m4 marginBottom-3">
                                <div class="numberIcon">
                                    <div>2</div>
                                </div>
                                <p class="howToCounterHeader bold">Log into your dashboard.</p>
                                <p class="howToInstruction">​Choose what kind of website you want to create.</p>
                            </div>
                            <div class="col l4 m4 marginBottom-3">
                                <div class="numberIcon">
                                    <div>3</div>
                                </div>
                                <p class="howToCounterHeader bold">Provide your favorite domain name.</p>
                                <p class="howToInstruction">​Choose what kind of website you want to create.</p>
                            </div>
                            <div class="col l4 m4 marginBottom-3">
                                <div class="numberIcon">
                                    <div>4</div>
                                </div>
                                <p class="howToCounterHeader bold">Pick a template that suits your brand.</p>
                                <p class="howToInstruction">​Choose what kind of website you want to create.</p>
                            </div>
                            <div class="col l4 m4 marginBottom-3">
                                <div class="numberIcon">
                                    <div>5</div>
                                </div>
                                <p class="howToCounterHeader bold">Make payment &amp; publish your website.</p>
                                <p class="howToInstruction">​Choose what kind of website you want to create.</p>
                            </div>
                            <div class="col l4 m4 marginBottom-3">
                                <div class="numberIcon">
                                    <div>6</div>
                                </div>
                                <p class="howToCounterHeader bold">Your website is live in few minutes.</p>
                                <p class="howToInstruction">​Choose what kind of website you want to create.</p>
                            </div>
                        </div>

                        <div class="row hide-on-med-and-up noMarginBottom">
                            <div class="row">
                                <div class="col s1">
                                    1.
                                </div>
                                <div class="col s11">
                                    <p class="howToCounterHeader noMarginTop marginBottom-1 bold">​Sign up for a free website builder.</p>
                                    <p class="howToInstruction noMarginTop">​Choose what kind of website you want to create.</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s1">
                                    2.
                                </div>
                                <div class="col s11">
                                    <p class="howToCounterHeader noMarginTop marginBottom-1 bold">Log into your dashboard.</p>
                                    <p class="howToInstruction noMarginTop">​Choose what kind of website you want to create.</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s1">
                                    3.
                                </div>
                                <div class="col s11">
                                    <p class="howToCounterHeader noMarginTop marginBottom-1 bold">Provide your favorite domain name.</p>
                                    <p class="howToInstruction noMarginTop">​Choose what kind of website you want to create.</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s1">
                                    4.
                                </div>
                                <div class="col s11">
                                    <p class="howToCounterHeader noMarginTop marginBottom-1 bold">Pick a template that suits your brand.</p>
                                    <p class="howToInstruction noMarginTop">​Choose what kind of website you want to create.</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s1">
                                    5.
                                </div>
                                <div class="col s11">
                                    <p class="howToCounterHeader noMarginTop marginBottom-1 bold">Make payment &amp; publish your website.</p>
                                    <p class="howToInstruction noMarginTop">​Choose what kind of website you want to create.</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s1">
                                    6.
                                </div>
                                <div class="col s11">
                                    <p class="howToCounterHeader noMarginTop marginBottom-1 bold">Your website is live in few minutes.</p>
                                    <p class="howToInstruction noMarginTop">​Choose what kind of website you want to create.</p>
                                </div>
                            </div>
                        </div>
                        <div class="getStartedLayout mt-2 mb-6">
                            <button class="button getstartedbtnFor waves-effect waves-deep-orange" @click="route('auth/getstarted')" >Get Started</button>
                        </div>
                    </div>
                </div>
            </section>
            <section class="templates">
                <div class="container">
                    <div class="templateBody">
                        <p class="templateHeader">
                            TEMPLATES FIT JUST FOR YOU.
                        </p>
                        <p class="templateSummary mb-4">We are giving you the freedom to select from our multiple customized templates designed to meet your personal and professional taste. Our templates are seamless with drag and drop settings.</p>
                        <div class="row">
                            <div class="col l4 m6 s12" v-for="(template, index) in templates.slice(0, 3)" :key="index">
                                <img :src="'./media/img/'+template.imgUrl" alt="Template 1" class="responsive-img">
                                <div class="d-flex justify-between mb-2">
                                    <!-- <a href="#!" class="links">Select</a> -->
                                    <a href="#!" class="links">Preview</a>
                                </div>
                            </div>
                        </div>
                        <div class="navigation d-flex align-center">
                            <i class="fa fa-angle-double-left"></i>
                            <i class="material-icons">navigate_before</i>
                            <p class="nav-links">1</p>
                            <p class="nav-links">2</p>
                            <p class="nav-links">3</p>
                            <i class="material-icons">navigate_next</i>
                            <i class="fa fa-angle-double-right"></i>
                        </div>
                    </div>
                </div>
            </section>
            <SupportComponent />
            <FooterComponent />
        </div>
    </div>
</template>
<style>
    
</style>
<script>
import SupportComponent from './partials/SupportPageComponent.vue'
import FooterComponent from './partials/FooterComponent.vue'
export default {
    components: { SupportComponent, FooterComponent },
    data() {
        return {
            templates: [
                {
                    imgUrl: "templateOne.png",
                },
                {
                    imgUrl: "templateTwo.png",
                },
                {
                    imgUrl: "templateThree.png",
                },
                {
                    imgUrl: "templateTwo.png",
                },
                {
                    imgUrl: "templateOne.png",
                },

            ],
            bannerImg: 'wcdHomeBanner1.png',
            bannerImages: [
                    {img: 'wcdHomeBanner2.png'}, 
                    {img: 'wcdHomeBanner3.png'},
                    {img: 'wcdHomeBanner1.png'}
                ]
        }
    },
    mounted() {
        let index = 0
        setInterval(
            () => {
                this.swapBannerImgs(index);

                let imgArrayLen = this.bannerImages.length;
                index++;
                
                if(index >= imgArrayLen){  
                    index = 0;
                }                
            }, 
            6000
        );
    },
    methods: {
        route(url) {
            location.href = url;
        },
        swapBannerImgs(index){  
            this.bannerImg = this.bannerImages[index].img;
        }
    },
}
</script>