<template>
    <div class="section scrollspy physiExpContainerDiv" id="miniBlog">
        <div v-show="experience == null">
            <div class="row">
                <div class="col l12">
                    <span class="sectionSubHeading">MINI BLOG</span>
                    <h2 class="sectionHeading">Shared <br/>updates &amp; thoughts.</h2>
                </div>
            </div>
            <div  class="row">
                <div class="experienceImgContainDiv">
                    <div class="surgeonBannerImgDiv">
                        <img  v-if="preview == '1'" src="/media/img/surgeonbanner.png"  alt="surgeonbanner.png" class="bannerImg">
                        <img  v-else :src="'media/img/surgeonbanner.png'"  alt="surgeonbanner.png" class="bannerImg">
                    </div>
                    <div class="col s12 m12 l2">
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
                <div class="col s12 serviceHeading">
                    <h3 class="title">
                        MY EXPERIENCE
                        <span class="primaryColorBoxDesign2"></span>
                    </h3>
                    <div>
                        <p class="expMainTitle">Experience</p>
                        <p class="expMainTxt">MY ACHIEVEMENT</p>
                    </div>
                    <div class="">
                        <!-- About Edit Img Modal Trigger -->
                        <a class="modal-trigger iconBox" href="#experienceUpdate" v-if="isLoggedIn">
                            <i class="material-icons editIcon">edit</i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="experienceImgContainDiv">
                    <div class="surgeonBannerImgDiv" v-if="experience != null">
                        <img :src="'/media/tenants/'+tenant+'/img/'+banner"
                            alt="physicianTemplate.png" class="bannerImg"
                            v-if="promo == ''"
                        >
                        <img :src="'/media/tenants/'+tenant+'/img/promo/'+promo.banner"
                            alt="physicianTemplate.png" class="bannerImg"
                            v-else-if="promo != ''"
                        >
                    </div>
                    <div class="col s12 m12 l2">
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
        <div id="experienceUpdate" class="modal">
            <div class="modal-content">
                <div class="aboutWriteUpsEditModalInnerDiv">
                    <a href="#!" class="modal-close editWriteUpsModalCloseBtn">
                        <i class="material-icons">keyboard_arrow_left</i>
                    </a>
                    <form enctype="multipart/form-data">
                        <div class="bannerImgDiv" v-if="isLoggedIn" v-show="!showCropper">
                            <img
                                alt="doc.png" class="responsive-img aboutImgModal"
                                :src="
                                    typeof banner == 'string'
                                    ? '/media/tenants/'+tenant+'/img/'+ banner
                                        : uploaded == null ? '/media/tenants/'+tenant+'/img/'+ banner : uploaded
                                "
                            />
                        </div>
                        <div v-show="showCropper" class="bannerCropper">
                            <ImageCropper :height="743" :width="1294" @uploadPhoto="addBannerchiever($event)" />
                        </div>
                        <div class="editImgChangeBtnDiv">

                            <!--our custom file upload button-->
                            <div class="centered">
                                <div v-if="errorse.length > 0" >
                                    <p class="error" v-for="(error, index) in errorse" :key="index">{{error}}</p>
                                </div>
                                <div>
                                    <label for="our-btn" class="editImgChangeBtn" v-if="!uploadingBanner" @click="showCropper=true" v-show="!showCropper">Change Image</label>
                                    <p v-else>Uploading image <i class="fas fa-spinner fa-spin"></i></p>
                                </div>
                            </div>
                        </div>
                        <p class="aboutImgSize" v-show="!showCropper">The Image should be 1024px width and 512px height and .jpg oR .png</p>
                    </form>
                    <div class="row rm_mg" v-show="!showCropper">
                        <div class="input-field col s12">
                            <input type="number" v-model="feats.experience" class="validate aboutWriteUpsInput" placeholder="Experience In year(s)">
                        </div>
                        <div class="input-field col s12 rm_mg">
                            <input type="number" v-model="feats.award" class="validate aboutWriteUpsInput" placeholder="Awards">
                        </div>
                        <div class="input-field col s12">
                            <input type="number" v-model="feats.certificate" class="validate aboutWriteUpsInput" placeholder="Certificate(s) you have">
                        </div>
                        <div class="input-field col s12 rm_mg">
                            <input type="number" v-model="feats.volunteer" class="validate aboutWriteUpsInput" placeholder="Volunteer Services">
                        </div>
                    </div>
                    <div class="editWriteUpsSaveBtnDiv" v-show="!showCropper">
                        <a href="#" class="editWriteUpsSaveBtn" @click.prevent="updateAchievements()" v-if="!loading">
                            Update
                        </a>
                        <a href="#" class="editWriteUpsSaveBtn" v-else>
                            <i class="fas fa-spinner fa-spin"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
// import ImageCropper from '../../partials/ImageCropper.vue';
    export default {
        // components: {ImageCropper},
        data() {
            return {
                uploadingBanner: false,
                feats: {},
                promo: "",
                loading: false,
                banner: null,
                errorse: [],
                uploaded: null,
                showCropper: false,
            };
        },
        props: {
            experience: Object,
            location: String,
            preview: String,
            tenant: String,
            isLoggedIn: Boolean,
        },
        watch: {
            experience (newVal, oldVal) {
                if (newVal !== null) {
                    this.feats = JSON.parse(newVal.feats);
                    this.banner = newVal.banner;
                }

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
            },
            request(request, formData) {
                axios
                    .post(request, formData)
                    .then((res) => {
                        if (res.status === 201 || res.data.status === 200) {
                            this.loading = !this.loading;
                            M.toast({
                                html: res.data.message,
                                classes: "successNotifier",
                            });
                            this.uploadingBanner = !this.uploadingBanner;
                            this.update = 1;
                            this.experience.id = res.data.achievement.id;
                            this.banner = res.data.achievement.banner;
                            location.reload();
                        }
                    })
                    .catch((err) => {
                        if (err.response.status === 400) {
                            this.errorse = err.response.data;
                            this.loading = !this.loading;
                            this.uploadingBanner = !this.uploadingBanner;
                        }
                        if (err.response.status === 413) {
                            this.loading = !this.loading;
                            this.uploadingBanner = !this.uploadingBanner;
                            M.toast({
                                html: err.response.statusText,
                                classes: 'errorNotifier'
                            })
                        }
                    });
            },
            addBannerchiever(e) {
                this.errorse = [];
                this.uploadingBanner = true;
                this.experience.banner = {};
                let formData = new FormData();
                formData.append("_method", "PUT");
                let request = `/api/achievement/${this.experience.id}`;
                formData.append("banner", e);
                this.request(request, formData);
                typeof(this.banner) !== 'string' ? this.uploaded = e : null;
            },
            updateAchievements() {
                this.loading = !this.loading;
                let formData = new FormData();
                formData.append("_method", "PUT");
                let request = `/api/achievement/${this.experience.id}`;
                formData.append("feats", JSON.stringify(this.feats));
                this.request(request, formData);
            },
        },
        computed: {},
    };
</script>
<style scoped>
.editImgChangeBtn {
    background-color: var(--primary);
    padding: 0.5rem;
    color: var(--white);
}
</style>
