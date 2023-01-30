<template>
    <div class="section scrollspy physiExpContainerDiv" id="experience">
        <div v-show="experience == null">
            <div class="row noMarginBottom">
                <div class="col s12">
                    <h3 class="title">
                        MY EXPERIENCE
                        <span class="primaryColorBoxDesign2"></span>
                    </h3>
                    <p class="expMainTitle">Experience</p>
                    <p class="expMainTxt">MY ACHIEVEMENT</p>
                </div>
            </div>
            <div  class="row">
                <div class="experienceImgContainDiv">
                    <div class="surgeonBannerImgDiv">
                        <img  v-if="preview == '1'" src="/media/img/surgeonbanner.png"  alt="surgeonbanner.png" class="bannerImg">
                        <img  v-else :src="'media/img/surgeonbanner.png'"  alt="surgeonbanner.png" class="bannerImg">
                    </div>
                    <div class="col s12 m3 l2">
                        <div class="row expLeftBarDiv experiences">
                            <div class="col s3 m12 l12 expLeftBarInnerDiv">
                                <div class="experience">
                                    <p class="experienceTitle">10 Yrs</p>
                                    <p class="experienceTxt">Experience</p>
                                </div>
                            </div>
                            <div class="col s3 m12 l12 expLeftBarInnerDiv">
                                <div class="experience">
                                    <p class="experienceTitle">2,000</p>
                                    <p class="experienceTxt">Ward Rounds</p>
                                </div>
                            </div>
                            <div class="col s3 m12 l12 expLeftBarInnerDiv">
                                <div class="experience">
                                    <p class="experienceTitle">10yrs</p>
                                    <p class="experienceTxt">Volunteers</p>
                                </div>
                            </div>
                            <div class="col s3 m12 l12 expLeftBarInnerDiv">
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
        <div v-show="experience != null">
            <div class="row noMarginBottom">
                <div class="col s12">
                    <h3 class="title">
                        MY EXPERIENCE
                        <span class="primaryColorBoxDesign2"></span>
                    </h3>
                    <p class="expMainTitle">Experience</p>
                    <p class="expMainTxt">MY ACHIEVEMENT</p>
                </div>
            </div>
            <div class="row">
                <div class="experienceImgContainDiv">
                    <div class="surgeonBannerImgDiv" v-if="experience != null">
                        <img :src="'/media/tenants/'+tenant+'/img/'+experience.banner"
                            alt="physicianTemplate.png" class="bannerImg"
                            v-if="promo == ''"
                        >
                        <img :src="'/media/tenants/'+tenant+'/img/promo/'+promo.banner" 
                            alt="physicianTemplate.png" class="bannerImg" 
                            v-else-if="promo != ''"
                        >
                    </div>
                    <div class="col s12 m3 l2">
                        <div class="row expLeftBarDiv experiences">
                            <div class="col s3 m12 l12 expLeftBarInnerDiv" v-for="(feat, index) in feats" :key="index">
                                <div class="experience">
                                    <p class="experienceTitle">{{feat}} {{index == 'experience' ? 'Yrs' : null}}</p>
                                    <p class="experienceTxt">{{index}}{{ index == 'volunteer' ? 's' : null }} {{ index == 'ward' ? 'rounds' : null}}</p>
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
            tenant: String,
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