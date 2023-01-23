<template>
    <div class="section scrollspy physiExpContainerDiv" id="experience" >
        <div class="row" v-show="experience == null">
            <div class="col s12">
                <h3 class="title">
                    MY EXPERIENCE
                    <span class="primaryColorBoxDesign2"></span>
                </h3>
                <p class="expMainTitle">Experience</p>
                <p class="expMainTxt">MY ACHIEVEMENT</p>
                <div class="experienceImgContainDiv">
                    <div class="surgeonBannerImgDiv">
                        <img  v-if="preview == '1'" src="/media/img/surgeonbanner.png"  alt="surgeonbanner.png" class="bannerImg">
                        <img  v-else :src="location+'media/img/surgeonbanner.png'"  alt="surgeonbanner.png" class="bannerImg">
                    </div>
                    <div class="col s12 m3 l2">
                        <div class="expLeftBarDiv experiences">
                            <div class="expLeftBarInnerDiv">
                                <div class="experience">
                                    <p class="experienceTitle">10 Yrs</p>
                                    <p class="experienceTxt">Experience</p>
                                </div>
                            </div>
                            <div class="expLeftBarInnerDiv">
                                <div class="experience">
                                    <p class="experienceTitle">2,000</p>
                                    <p class="experienceTxt">Ward Rounds</p>
                                </div>
                            </div>
                            <div class="expLeftBarInnerDiv">
                                <div class="experience">
                                    <p class="experienceTitle">10yrs</p>
                                    <p class="experienceTxt">Volunteer services</p>
                                </div>
                            </div>
                            <div class="expLeftBarInnerDiv">
                                <div class="experience">
                                    <p class="experienceTitle">15</p>
                                    <p class="experienceTxt">Certifications</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
                
            </div>       
        </div>
        <div class="row" v-show="experience != null">
            <div class="col s12">
                <h3 class="title">
                    MY EXPERIENCE
                    <span class="primaryColorBoxDesign2"></span>
                </h3>
                <p class="expMainTitle">Experience</p>
                <p class="expMainTxt">MY ACHIEVEMENT</p>
                <div class="experienceImgContainDiv">
                    <div class="surgeonBannerImgDiv" v-if="experience != null">
                        <img :src="location+'tenancy/assets/'+experience.banner" 
                            alt="physicianTemplate.png" class="bannerImg"
                            v-if="promo == ''"
                        >
                        <img :src="location+'tenancy/assets/'+promo.banner" 
                            alt="physicianTemplate.png" class="bannerImg" 
                            v-else-if="promo != ''"
                        >
                    </div>
                    <div class="col s12 m3 l2">
                        <div class="expLeftBarDiv experiences">
                            <div class="expLeftBarInnerDiv" v-for="(feat, index) in feats" :key="index">
                                <div class="experience">
                                    <p class="experienceTitle">{{feat}} {{index == 'experience' ? 'Yrs' : null}}</p>
                                    <p class="experienceTxt">{{index}} {{ index == 'volunteer' ? 'services' : null }} {{ index == 'ward' ? 'rounds' : null}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
                
            </div>       
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                feats: {},
                promo: "",
            };
        },
        props: {
            experience: Object,
            location: String,
            preview: String,
        },
        watch: {
            experience (newVal, oldVal) {
                if (newVal != null) this.feats = JSON.parse(newVal.feats);
            }
        },
        mounted() {
            this.getActivePromo();
        },
        methods: {
            getActivePromo() {
                axios.get('/api/activePromo').then(res => {
                    if (res.data != "") {
                        this.promo = res.data.promo;
                    }
                }).catch(err => {
                    console.log(err)
                })
            }
        },
        computed: {},
    };
</script>