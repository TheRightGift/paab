<template>
    <div>
        <!-- <get-started-button-component />

        
        
        <review-popup-component />
        
        <services-offered-component />

        <templates-for-component /> -->
        <div class="body relative">
            <div class="container">
                <div class="customNav d-flex justify-between align-center">
                    <div class="logoContainer">
                        <img class="logo" src="/media/img/wcd-logo-noBckg.png" alt="Whitecoatdomain Logo">
                    </div>
                    <div class="signUpBtnContainer">
                        <sign-up-button-component />
                    </div>
                </div>
                <div class="d-flex pt-10">
                    <div class="">
                        <div class="d-flex align-center">
                            <img src="/media/img/verify.png" />
                            <p class="verifyTitle">Best Portfolio Platform - World Record</p>
                        </div>
                        <div >
                            
                            
                        </div>
                        <div class="heading d-flex flex-col relative">
                            <div>
                                <span class="headingText">
                                    Enhance your public image with 
                                </span>
                                <span class="headingText">
                                    White Coat Domain
                                </span>
                            </div>
                            <img src="/media/img/decor.png" class="decor"/>
                        </div>
                        <div class="description mt-4">
                            As a physician, it is crucial to maintain and manage your public profile. We strongly recommend actively managing your online identity by securing a personal domain name and maintaining a website separate from social media.
                        </div>
                        <get-started-button-component class="pt-5"/>
                    </div>
                    <div class="relative">
                        <div class="relative top-112" >
                            <div class="image1Container">
                                <img  src="/media/img/physicianBnW.png" class="responsive-img image1" />
                            </div>
                            <div class="joiner">
                                <img src="/media/img/physicianBnWD.png" class="responsive-img image2" />
                            </div>
                        </div>
                        <div class="spiralGrey">
                            <img src="/media/img/spiralGrey.png" />
                        </div>
                        <div class="spiralRed">
                            <img src="/media/img/spiralRed.png" />
                        </div>
                        <div class="maskPri">
                            <img src="/media/img/maskPri.png" />
                        </div>
                        <div class="maskSec">
                            <img src="/media/img/maskSec.png" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="pizzariedLeft"></div>
            <div class="pizzariedRight"></div>
        </div>
    </div>
</template>
<script>
import SupportComponent from './partials/SupportPageComponent.vue'
import FooterComponent from './partials/FooterComponent.vue'
import GetStartedButtonComponent from './partials/GetStartedButtonComponent.vue'
import SignUpButtonComponent from './partials/SignUpButtonComponent.vue'
import ReviewPopupComponent from './partials/ReviewPopupComponent.vue'
import ServicesOfferedComponent from './partials/ServicesOfferedComponent.vue'
import TemplatesForComponent from './partials/TemplatesForComponent.vue'
export default {
    components: { SupportComponent, FooterComponent, GetStartedButtonComponent, SignUpButtonComponent, ReviewPopupComponent, ServicesOfferedComponent, TemplatesForComponent },
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
        
        swapBannerImgs(index){  
            this.bannerImg = this.bannerImages[index].img;
        }
    },
}
</script>