<template>
    <div>
        <div class="achieveModalDiv" v-if="achieveModal">
            <div class="editInnerGenModal">
                <div class="row">
                    <div class="col l12">
                        <p class="genTitle1">Add your achievement</p>
                    </div>
                </div>
                <div class="row">   
                    
                
                    <form @submit.prevent="saveAchievement">
                        <div class="row">
                            <div class="col l12">
                                <p class="achieveTitle">Banner image</p>
                            </div>
                            <div class="col l6 file-field input-field" id="genUploadFavIconDiv" v-if="achievement.banner == null">
                                <p class="genTxt">
                                    Banner must not be greater than 500KB(1249x743).
                                </p>
                                <input type="file" accept="image/*" @change="addBannerchiever" />
                                <div class="file-path-wrapper">
                                    <input class="file-path validate genInput1" placeholder="Pick banner image"
                                        type="text" />
                                    <i class="material-icons" id="genUploadFavIcon">file_upload</i>
                                </div>
                            </div>
                    
                            <div v-else class="col l6">
                                <img class="col l9 responsive-img noPaddingLeft" :src="
                                    typeof achievement.banner == 'string'
                                        ? '/media/tenants/'+tenant+'/img/'+ achievement.banner
                                        : uploaded
                                " />
                                <div class="col l3 faviconUploadBtnCol">
                                    <button type="button" class="btn-flat redBorderBtn matchngBtn" @click="deleteImg"><i class="material-icons">swap_horiz</i></button>                                
                                </div>
                            </div>
                            <div class="col l6">
                                <img src="/media/img/editWebsiteSettings/achieveImg.png" alt="achieveImg.png" class="responsive-img right">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col l6">
                                <p class="achieveTitle">Experience (in Years)</p>
                    
                                <div class="flex no-space-between">
                                    <div class="sliderContainer range-field">
                                        <input type="range" min="0" max="100" v-model="achievement.feats.experience" />
                                    </div>
                                    <p class="years">
                                        {{ achievement.feats.experience }}
                                    </p>
                                </div>
                            </div>
                            <div class="col l6">
                                <img src="/media/img/editWebsiteSettings/achieveImg1.png" alt="achieveImg1.png" class="responsive-img right">
                            </div>  
                        </div>
                
                        <div class="row">
                            <div class="col l6">
                                <p class="achieveTitle">Ward Rounds  (in Numbers)</p>
                    
                                <div class="flex no-space-between">
                                    <div class="sliderContainer range-field">
                                        <input type="range" min="0" max="100" v-model="achievement.feats.ward" />
                                    </div>
                                    <p class="years">
                                        {{ achievement.feats.ward }}
                                    </p>
                                </div>
                            </div>
                            <div class="col l6">
                                <img src="/media/img/editWebsiteSettings/achieveImg2.png" alt="achieveImg2.png" class="responsive-img right">
                            </div>
                        </div>
                
                        <div class="row">
                            <div class="col l6">
                                <p class="achieveTitle">Volunteer/Outreach (in Years)</p>
                    
                                <div class="flex no-space-between">
                                    <div class="sliderContainer range-field">
                                        <input type="range" min="0" max="100" v-model="achievement.feats.volunteer" />
                                    </div>
                                    <p class="years">
                                        {{ achievement.feats.volunteer }}
                                    </p>
                                </div>
                            </div>
                            <div class="col l6">
                                <img src="/media/img/editWebsiteSettings/achieveImg3.png" alt="achieveImg3.png" class="responsive-img right">
                            </div>
                        </div>
                
                        <div class="row">
                            <div class="col l6">
                                <p class="achieveTitle">Certificates  (in Numbers)</p>
                                <div class="flex no-space-between">
                                    <div class="sliderContainer range-field">
                                        <input type="range" min="0" max="100" v-model="achievement.feats.certificate" />
                                    </div>
                                    <p class="years">
                                        {{ achievement.feats.certificate }}
                                    </p>
                                </div>
                            </div>
                    
                            
                            <div class="col l6">
                                <img src="/media/img/editWebsiteSettings/achieveImg4.png" alt="achieveImg4.png" class="responsive-img right">
                            </div>
                        </div>
                
                        <div class="row">
                            <button  v-if="loading" class="btn">
                                <div class="preloader-wrapper small active">
                                    <div
                                        class="spinner-layer spinner-white-only"
                                    >
                                        <div class="circle-clipper left">
                                            <div class="circle"></div>
                                        </div>
                                        <div class="gap-patch">
                                            <div class="circle"></div>
                                        </div>
                                        <div class="circle-clipper right">
                                            <div class="circle"></div>
                                        </div>
                                    </div>
                                </div>
                            </button>
                            <button type="submit" class="btn" id="genModalBtn" v-else-if="saved == null">
                                Save
                            </button>
                            <button type="submit" class="btn" id="genModalBtn" v-else @click="achievement.update = 1">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
                
                <div class="genBottomBtnDiv">
                    <a href="#" class="goBackBtn" @click="achieveGoBackBtn()">GO BACK</a>
                
                    <button type="button" class="btn right" id="genNextBtn" @click="socialLink()">
                        NEXT STEP
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            achieveModal: Boolean,
            saved: Object,
            loading: Boolean,
            tenant: String,
        },
        data() {
            return {
                achievement: {
                    feats: {
                        experience: 0,
                        ward: 0,
                        certificate: 0,
                        volunteer: 0,
                    },
                    banner: null,
                    update: 0,
                },
                uploaded: null,
                achievementError: false,
            };
        },
        methods: {
            deleteImg() {
                this.achievement.oldBanner = this.achievement.banner;
                this.achievement.banner = null;
            },
            achieveGoBackBtn() {
                this.$emit("achieveGoBackBtn");
            },
            socialLink() {
                if (
                    this.achievement.feats.experience == 0 ||
                    this.achievement.banner == null
                ) {
                    this.achievementError = true;
                } else this.achievementError = false;
                this.$emit("socialLink", this.achievementError);
            },
            addBannerchiever(e) {
                if (!e.target.files.length) return;
                this.achievement.banner = e.target.files[0];
                this.uploaded = URL.createObjectURL(e.target.files[0]);
            },
            saveAchievement() {
                this.$emit("saveAchievement", this.achievement);
            },
        },
        watch: {
            saved(newVal, oldVal) {
                if (newVal != null) {
                    let feats = JSON.parse(newVal.feats);
                    this.achievement.feats.certificate = feats.certificate;
                    this.achievement.feats.experience = feats.experience;
                    this.achievement.feats.volunteer = feats.volunteer;
                    this.achievement.feats.ward = feats.ward;
                    this.achievement.banner = newVal.banner;
                    this.achievement.id = newVal.id;
                }
            },
        },
    };
</script>