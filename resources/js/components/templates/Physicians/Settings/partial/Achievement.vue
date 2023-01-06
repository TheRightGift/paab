<template>
    <div>
        <div class="achieveModalDiv" v-if="achieveModal">
            <div class="editInnerGenModal">
                <div class="row">
                    <div class="col s7">
                        <p class="genTitle1">Add your achievement</p>
                    
                        <p class="genTxt">
                            Lorem Ipsum is simply dummy text of the printing and
                            typesetting industry.
                        </p>
                    
                        <form @submit.prevent="saveAchievement">
                            <div class="file-field input-field" id="genUploadFavIconDiv" v-if="achievement.banner == null">
                                <input type="file" accept="image/*" @change="addBannerchiever" />
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" placeholder="Banner must not be greater than 500KB(1249x743)"
                                        type="text" id="genInput1" />
                                    <i class="material-icons" id="genUploadFavIcon">file_upload</i>
                                </div>
                            </div>
                    
                            <div v-else class="flex no-space-between">
                                <img width="100" height="100" class="responsive-img" :src="
                                    typeof achievement.banner == 'string'
                                        ? 'tenancy/assets/' + achievement.banner
                                        : uploaded
                                " />
                                <a class="
                                    waves-effect waves-light
                                    btn-small btn
                                    red
                                " @click="deleteImg">Change</a>
                            </div>
                    
                            <div>
                                <p class="achieveTitle">Experience</p>
                    
                                <div class="flex no-space-between">
                                    <div class="sliderContainer range-field">
                                        <input type="range" min="0" max="100" v-model="achievement.feats.experience" />
                                    </div>
                                    <p class="years">
                                        {{ achievement.feats.experience }} Years
                                    </p>
                                </div>
                            </div>
                    
                            <div>
                                <p class="achieveTitle">Ward Rounds</p>
                    
                                <div class="flex no-space-between">
                                    <div class="sliderContainer range-field">
                                        <input type="range" min="0" max="100" v-model="achievement.feats.ward" />
                                    </div>
                                    <p class="years">
                                        {{ achievement.feats.ward }}
                                    </p>
                                </div>
                            </div>
                    
                            <div>
                                <p class="achieveTitle">Volunteer/Outreach</p>
                    
                                <div class="flex no-space-between">
                                    <div class="sliderContainer range-field">
                                        <input type="range" min="0" max="100" v-model="achievement.feats.volunteer" />
                                    </div>
                                    <p class="years">
                                        {{ achievement.feats.volunteer }} Years
                                    </p>
                                </div>
                            </div>
                    
                            <div>
                                <p class="achieveTitle">Certificates</p>
                                <div class="flex no-space-between">
                                    <div class="sliderContainer range-field">
                                        <input type="range" min="0" max="100" v-model="achievement.feats.certificate" />
                                    </div>
                                    <p class="years">
                                        {{ achievement.feats.certificate }}
                                        Certificates
                                    </p>
                                </div>
                            </div>
                    
                            <div>
                                <button type="submit" class="btn" id="genModalBtn" v-if="saved == null">
                                    Save
                                </button>
                                <button type="submit" class="btn" id="genModalBtn" v-else @click="achievement.update = 1">
                                    Update
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="col s5">
                        <img src="/media/img/editWebsiteSettings/achieveImg.png" alt="achieveImg.png" class="editWebIllustrativeImg">
                        <img src="/media/img/editWebsiteSettings/achieveImg1.png" alt="achieveImg1.png" class="editWebIllustrativeImg1">
                        <img src="/media/img/editWebsiteSettings/achieveImg2.png" alt="achieveImg2.png" class="editWebIllustrativeImg1">
                        <img src="/media/img/editWebsiteSettings/achieveImg3.png" alt="achieveImg3.png" class="editWebIllustrativeImg1">
                        <img src="/media/img/editWebsiteSettings/achieveImg4.png" alt="achieveImg4.png" class="editWebIllustrativeImg1">
                    </div>
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