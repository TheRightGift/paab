<template>
    <div>
        <div class="row">
            <div class="col s12">
                <div class="primaryColorDiv">
                    <div class="headerDiv">
                        <a href="/">
                            <img src="/media/img/wcdMobileLogo.png" alt="wcdMobileLogo.png" class="hide-on-large-only wcdMobileLogo">
                            <img src="/media/img/wcdMobileLogoLarge.png" alt="wcdMobileLogoLarge.png" class="hide-on-med-and-down">
                        </a>
                        <p class="headerTitle">
                            It is time for the world
                            to hear your pulse
                        </p>
                    </div>
                    <div class="hide-on-large-only">
                        <img src="/media/img/3dDoctors.png" alt="3dDoctors.png" class="primaryColorDocsImg">
                    </div>
                    <div class="hide-on-med-and-down">
                        <img src="/media/img/3dDoctorsLarge.png" alt="3dDoctorsLarge.png" class="primaryColorDocsImgLarge">
                    </div>
                </div>
            </div>

            <div class="col s12">
                <div class="contentDiv">
                    <div v-show="view === 0">
                        <p class="contentTitle">Do want your names to appear as follows?</p>

                        <form class="formContain">
                            <div class="row">
                                <div class="input-field col s5">
                                    <input type="text" v-model="bio.firstname" class="validate" placeholder="Firstname">
                                </div>

                                <div class="input-field col s5 offset-s1">
                                    <input type="text" v-model="bio.lastname" class="validate" placeholder="Lastname">
                                </div>
                            </div>
                        </form>
                    </div>

                    <div v-show="view === 1" class="flexedOnLarge">
                        <p class="contentTitle" v-show="!showCropper">Do you like this picture as your main image?</p>
                        <div v-show="showCropper" class="flexed">
                            <p class="contentTitle">Alright, Upload a clear picture OR</p>
                            <a class="btn-flat btn waves offsetS2" href="#" @click="showCropper = false">Cancel</a>
                        </div>
                        <div class="proImgDiv" v-if="!showCropper">
                            <img v-if="false"  src="/media/img/profilePics.png" alt="profilePics.png" class="proImg">
                            <img :src="typeof photo === 'string'
                                        ? '/media/tenants/' +
                                          tenantid +
                                          '/img/' +
                                          photo
                                        : uploaded" v-else :alt="bio.firstname" class="proImg">
                        </div>
                        <div class="proCenter" v-show="showCropper" v-if="!uploadPhotoProcessing">
                            <image-cropper  :height="512" :width="451" @uploadPhoto="updatePhoto($event)" />
                        </div>

                        <div class="proImgBtnMainDiv">
                            <div class="centered">
                                <div v-if="errors.length > 0" >
                                    <p class="error" v-for="(error, index) in errors" :key="index">{{error}}</p>
                                </div>
                            </div>
                            <form class="proImgBtnContainDiv" v-if="!uploadPhotoProcessing" v-show="!showCropper">
                                <a href="#" class="proImgYesBtn" @click="yesProImg()">Yes</a>
                                <!-- <input type="file" id="actual-btn" hidden @change="updatePhoto" accept=".jpg, .png"/> -->

                                <!--our custom file upload button-->
                                <div class="centered">
                                    <div>
                                        <label for="actual-btn" class="proImgSelectFile" @click="showCropper=true">Change Image<i class="material-icons proInputFileUpladIcon">file_upload</i></label>
                                    </div>

                                </div>
                            </form>
                            <p v-else class="centered">Uploading image <i class="fas fa-spinner fa-spin"></i></p>
                        </div>
                        <div class="proImgInstructDiv" v-show="!showCropper">
                            <p class="proImgInstruct">The image should be 451px width and 512px height</p>
                        </div>
                    </div>

                    <div v-show="view === 2">
                        <p class="contentTitle">Are you satisfied with the changes?</p>

                        <form class="formContain">
                            <div class="row">
                                <div class="col s7 offset-s4">
                                    <label class="radioBtnLabel">
                                        <input class="with-gap" name="group1" type="radio" />
                                        <span class="radioBtnSpan" @click="(updateBio(), yesSatisfy())">Yes</span>
                                    </label>
                                    <label @click="noSatisfy()">
                                        <input class="with-gap" name="group1" type="radio" />
                                        <span class="radioBtnSpan">No</span>
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div v-show="view === 3 && !loading">
                        <p class="contentTitle">
                            <span class="milestoneCongratMsg">Congratulations!!!</span>
                            <br>
                            on completing your Bio settings.
                            please click the link to preview on your website
                        </p>

                        <div class="viewWebBtnDiv">
                            <a :href="host" class="btn viewWebBtn">
                                View website
                            </a>
                        </div>
                    </div>
                    <div v-if="loading && view === 3"><p class="centered">Updating your changes <i class="fas fa-circle-notch fa-spin fa-3xl"></i></p></div>

                    <!-- Prev/Next Button Section -->
                    <div v-if="view !== 3" class="skipDiv" v-show="!showCropper">
                        <button class="skipBtn"
                                @click="prev()"
                                :disabled="view < 1"
                                :class="view > 0 ? 'btnOn' : 'btnOff'"
                        >
                            <i class="material-icons">keyboard_arrow_left</i>
                        </button>
                        <span class="skipTxt">skip</span>
                        <button class="skipBtn"
                                @click="next()"
                                :disabled="view > 1"
                                :class="view > 1 ? 'btnOff' : 'btnOn'"
                        >
                            <i class="material-icons">keyboard_arrow_right</i>
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>
<script>
import ImageCropper from '../../../../partials/ImageCropper.vue';
export default {
    components: { ImageCropper },
    data() {
        return {
            bio: {
                firstname: "",
                lastname: "",
                othername: "",
                title_id: "",
                photo: null
            },
            errors: [],
            host: "",
            loading: false,
            showCropper: false,
            uploadPhotoProcessing: false,
            view: 0,
            uploaded: null,
            update: 0,
            photo: null,
        };
    },
    mounted() {
        this.host = `http://${location.host}`;
        this.getBiography();
    },
    methods: {
        getBiography() {
            axios.get('api/bio').then(res => {
                if (res.data.bio !== null) {
                    this.update = 1;
                    this.bio = res.data.bio;
                    this.photo = res.data.bio.photo;
                }
            }).catch(err => {
              console.log(err);
            })
        },
        updatePhoto(e) {
                this.errors = [];
                this.uploadPhotoProcessing = true;
                let formData = new FormData();
                formData.append('photo', e);
                this.update === 1 ? formData.append('_method', 'PUT') : null;
                let request = this.update === 1 ? `/api/bio/${this.bio.id}` : '.api/bio';
                axios.post(request, formData).then(res => {
                    if (res.data.status === 200 || res.data.status === 201) {
                        M.toast({
                            html: res.data.message,
                            classes: "successNotifier",
                        });
                        this.photo = {};
                        this.uploaded = e;
                        this.uploadPhotoProcessing = false;
                        this.showCropper = false;
                    }
                }).catch(err => {
                    if (err.response.status === 400) {
                        this.errors = err.response.data;
                    }
                    this.uploadPhotoProcessing = false;
                    console.log(err);
                })

        },
        updateBio() {
            if (
                this.bio.lastname !== '' ||
                this.bio.firstname !== ''
            ) {
                this.loading = true;
                let formData = new FormData();
                formData.append('firstname', this.bio.firstname);
                formData.append('lastname', this.bio.lastname);

                let request = this.update === 1 ? `/api/bio/${this.bio.id}` : '.api/bio';
                this.update === 1 ? formData.append('_method', 'PUT') : null;
                axios
                    .post(request, formData)
                    .then((res) => {
                        if (res.data.status === 200 || res.data.status === 201) {
                            M.toast({
                                html: res.data.message,
                                classes: "successNotifier",
                            });
                            this.loading = !this.loading;
                        }
                    })
                    .catch((err) => {
                        this.loading = !this.loading;
                        console.log(err);
                    });
            }
            else console.log('Hey')
        },
        prev() {
            this.view !== 0 ? this.view-- : null;
        },
        next() {
            this.view !== 3 ? this.view++ : null;
        },
        yesSatisfy() {
            this.view = 3;
        },
        noSatisfy() {
            this.view = 1;
        },
        yesProImg() {
            this.view = 2;
        }
    },
    props: {
        tenantid: String,
    }
};
</script>
<style scoped>
.centered {
    padding-top: 0;
}
</style>
