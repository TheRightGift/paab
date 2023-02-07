<template>
    <div>
        <div class="row" v-if="!fetching">
            <div class="col s12">
                <div class="primaryColorDiv">
                    <div class="headerDiv">
                        <a href="/">
                            <img src="/media/img/wcdMobileLogo.png" alt="wcdMobileLogo.png">
                        </a>
                        <p class="headerTitle">
                            It is time for the world
                            to hear your pulse
                        </p>
                    </div>
                    <div>
                        <img src="/media/img/3dDoctors.png" alt="3dDoctors.png" class="primaryColorDocsImg">
                    </div>
                </div>
            </div>

            <div class="col s12">
                <div class="contentDiv">
                    <div v-show="view === 0">
                        <p class="contentTitle">How many years of experience do you have?</p>

                        <form class="formContain">
                            <div class="row">
                                <div class="input-field col s3 offset-s5">
                                    <input type="number" placeholder="0" class="validate" v-model="achievement.feats.experience">
                                    <input type="text" value="Year(s)" disabled class="validate">
                                </div>
                            </div>
                        </form>
                    </div>

                    <div v-show="view === 1">
                        <p class="contentTitle">Have you been involved in any charity/volunteer work?</p>

                        <form class="formContain">
                            <div class="row">
                                <div class="col s7 offset-s4">
                                    <label class="radioBtnLabel">
                                        <input class="with-gap" name="group1" type="radio" />
                                        <span class="radioBtnSpan" @click="yesVolun()">Yes</span>
                                    </label>
                                    <label @click="noVolun()">
                                        <input class="with-gap" name="group1" type="radio" />
                                        <span class="radioBtnSpan">No</span>
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div v-show="view === 2">
                        <p class="contentTitle">How many have you done?</p>

                        <form class="formContain">
                            <div class="row">
                                <div class="input-field col s3 offset-s5">
                                    <input type="number" placeholder="0" class="validate" v-model="achievement.feats.volunteer">
                                </div>
                            </div>
                        </form>
                    </div>

                    <div v-show="view === 3">
                        <p class="contentTitle">Have you been a recipient of any award/honors ?</p>

                        <form class="formContain">
                            <div class="row">
                                <div class="col s7 offset-s4">
                                    <label class="radioBtnLabel">
                                        <input class="with-gap" name="group1" type="radio" />
                                        <span class="radioBtnSpan" @click="yesAward()">Yes</span>
                                    </label>
                                    <label @click="noAward()">
                                        <input class="with-gap" name="group1" type="radio" />
                                        <span class="radioBtnSpan">No</span>
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div v-show="view === 4">
                        <p class="contentTitle">How many awards/honors have you received?</p>

                        <form class="formContain">
                            <div class="row">
                                <div class="input-field col s3 offset-s5">
                                    <input type="number" placeholder="0" class="validate" v-model="achievement.feats.award">
                                </div>
                            </div>
                        </form>
                    </div>

                    <div v-show="view === 5">
                        <p class="contentTitle">Have you taken any certification courses?</p>

                        <form class="formContain">
                            <div class="row">
                                <div class="col s7 offset-s4">
                                    <label class="radioBtnLabel">
                                        <input class="with-gap" name="group1" type="radio" />
                                        <span class="radioBtnSpan" @click="yesCert()">Yes</span>
                                    </label>
                                    <label @click="noCert()">
                                        <input class="with-gap" name="group1" type="radio" />
                                        <span class="radioBtnSpan">No</span>
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div v-show="view === 6">
                        <p class="contentTitle">How many certification have you acquired?</p>

                        <form class="formContain">
                            <div class="row">
                                <div class="input-field col s3 offset-s5">
                                    <input type="number" placeholder="0" class="validate" v-model="achievement.feats.certificate">
                                </div>
                            </div>
                        </form>
                    </div>

                    <div v-show="view === 7">
                        <p class="contentTitle">Upload a banner</p>

                        <div class="bannerImgDiv">
                            <img v-if="initialAchieve.banner !== null" :src="typeof achievement.banner == 'string'
                                        ? '/media/tenants/'+tenant+'/img/'+ initialAchieve.banner
                                        : uploaded"
                                 alt="milestoneBanner.png"
                                 class="bannerImg"
                            >
                            <img src="/media/img/milestoneBanner.png" v-else
                                 alt="milestoneBanner.png"
                                 class="bannerImg"
                            >
                        </div>

                        <form class="formContain">
                            <div class="row" v-if="!uploadingBanner">
                                <div class="col s9">
                                    <p class="bannerImgInstruct">The image should be 1024px width and 512px height</p>
                                </div>
                                <div class="file-field input-field col s3">
                                    <i class="material-icons bannerInputIcon right">
                                        file_upload
                                        <input type="file" @change="addBannerchiever" accept="image/*" >
                                    </i>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate bannerImgInput" type="text" placeholder="Upload">
                                    </div>
                                </div>
                            </div>
                            <div v-else>

                                <p class="centered">Uploading Banner <i class="fas fa-spinner fa-spin fa-2xl"></i></p>
                            </div>
                        </form>
                    </div>

                    <div v-show="view === 8">
                        <p class="contentTitle">Are you satisfied with the changes?</p>

                        <form class="formContain">
                            <div class="row">
                                <div class="col s7 offset-s4">
                                    <label class="radioBtnLabel">
                                        <input class="with-gap" name="group1" type="radio" />
                                        <span class="radioBtnSpan modal-trigger" href="#modal1" @click="(saveAchievement(), yesSatisfy())">Yes</span>
                                    </label>
                                    <label @click="noSatisfy()">
                                        <input class="with-gap" name="group1" type="radio" />
                                        <span class="radioBtnSpan">No</span>
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div v-show="view === 9">
                        <p class="milestoneCongratMsg">Congratulations!!!</p>
                        <p class="contentTitle">on completing your milestone process</p>

                        <div class="viewWebBtnDiv">
                            <a href="#" @click="replace" class="btn viewWebBtn">
                                View website
                            </a>
                        </div>
                    </div>

                    <!-- Prev/Next Button Section -->
                    <div v-if="view !== 9" class="skipDiv">
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
                            :disabled="view === view.length"
                            :class="view !== 9 ? 'btnOn' : 'btnOff'"
                        >
                            <i class="material-icons">keyboard_arrow_right</i>
                        </button>
                    </div>

                </div>
            </div>
            <div id="modal1" class="modal">
                <div class="modal-content">
                    <i class="fas fa-spinner fa-spin fa-2xl flex center-align"></i>
                    <p class="centered">Updating your changes</p>
                </div>
            </div>
        </div>
        <div class="loader" v-else></div>
    </div>
</template>
<script>
    export default {
        components: { },
        created() {
            this.loggedIn = this.getCookie('_token');
            if (!this.loggedIn) location.replace(`http://${location.host}`)
        },
        data() {
            return {
                achievement: {
                    feats: {
                        experience: 0,
                        award: 0,
                        certificate: 0,
                        volunteer: 0,
                    },
                    banner: null,
                    update: 0,
                },
                host: 'http://'+location.host,
                uploaded: null,
                view: 0,
                loggedIn: false,
                loading: false,
                fetching: false,
                update: 0,
                oldBanner: null,
                uploadingBanner: false,
                initialAchieve: {
                    feats: {
                        experience: 0,
                        award: 0,
                        certificate: 0,
                        volunteer: 0,
                    },
                    banner: null,
                },
            };
        },
        mounted() {
            this.getSavedMilestone();
            document.addEventListener('DOMContentLoaded', function() {
                var elems = document.querySelector('#modal1');
                let options = {
                    dismissible: false,
                }
                var instances = M.Modal.init(elems, options);
            });
        },
        methods: {
            deleteImg() {
                this.achievement.oldBanner = this.achievement.banner;
                this.achievement.banner = null;
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
                            this.achievement.id = res.data.achievement.id;
                            this.initialAchieve = res.data.achievement;
                            let elem = document.getElementById("modal1"); //.getElementsByClassName('modal-close').click()
                            var instance = M.Modal.getInstance(elem);
                            instance.close();
                        }
                    })
                    .catch((err) => {
                        if (err.response.status === 400) {
                            this.loading = !this.loading;
                            this.uploadingBanner = !this.uploadingBanner;
                            err.response.data.forEach((el) => {
                                M.toast({
                                    html: el,
                                    classes: "errorNotifier",
                                });
                            });
                            let elem = document.getElementById("modal1"); //.getElementsByClassName('modal-close').click()
                            var instance = M.Modal.getInstance(elem);
                            instance.close();
                        }
                    });
            },
            replace() {
                location.href = this.host;
            },
            addBannerchiever(e) {
                if (!e.target.files.length) return;
                this.deleteImg();
                this.uploadingBanner = true;
                this.achievement.banner = e.target.files[0];
                let formData = new FormData();
                let request = `/api/achievement`;
                if (this.update === 1) {
                    formData.append("_method", "PUT");
                    request = `/api/achievement/${this.achievement.id}`;
                }
                this.update !== 1 || this.achievement.oldBanner
                    ? formData.append("banner", this.achievement.banner)
                    : null;
                this.request(request, formData);
                this.uploaded = URL.createObjectURL(e.target.files[0]);
            },
            saveAchievement(e) {
                this.loading = !this.loading;
                let formData = new FormData();
                let request = `/api/achievement`;
                if (this.update === 1) {
                    formData.append("_method", "PUT");
                    request = `/api/achievement/${this.achievement.id}`;
                }
                formData.append("feats", JSON.stringify(this.achievement.feats));
                this.request(request, formData);

            },
            getSavedMilestone(){
                this.fetching = !this.fetching;
                axios.get('/api/achievement').then(res => {
                    if (res.data.message === 'Success') {
                        if (res.data.achievement !== null) {
                            if (res.data.achievement.feats !== null) {
                                let feats = JSON.parse(res.data.achievement.feats);
                                this.achievement.feats.certificate = feats.certificate;
                                this.achievement.feats.experience = feats.experience;
                                this.achievement.feats.volunteer = feats.volunteer;
                                this.achievement.feats.award = feats.award;
                                this.initialAchieve.feats.certificate = feats.certificate;
                                this.initialAchieve.feats.experience = feats.experience;
                                this.initialAchieve.feats.volunteer = feats.volunteer;
                                this.initialAchieve.feats.award = feats.award;
                            }
                            this.achievement.banner = res.data.achievement.banner;
                            this.achievement.id = res.data.achievement.id;
                            this.update = 1;
                            this.initialAchieve.banner = res.data.achievement.banner;
                        }
                        this.fetching = !this.fetching;
                    }
                }).catch(reportError => {
                    this.fetching = !this.fetching;
                    console.log(reportError)
                })
            },
            getCookie(name) {
                return document.cookie.split(";").some((c) => {
                    return c.trim().startsWith(name + "=");
                });
            },
            prev() {
                this.view !== 0 ? this.view-- : null;
            },
            next() {
                this.view !== 9 ? this.view++ : null;
            },
            yesVolun() {
                this.view = 2;
            },
            noVolun() {
                this.view = 3;
            },
            yesAward() {
                this.view = 4;
            },
            noAward() {
                this.view = 5;
            },
            yesCert() {
                this.view = 6;
            },
            noCert() {
                this.view = 7;
            },
            yesSatisfy() {
                this.view = 9;
            },
            noSatisfy() {
                this.view = 7;
            }
        },
        props: {tenant: String}
    };
</script>
<style scoped>
.loader {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url("//upload.wikimedia.org/wikipedia/commons/thumb/e/e5/Phi_fenomeni.gif/50px-Phi_fenomeni.gif")
    50% 50% no-repeat rgb(249, 249, 249);
}
input[type=text]:not(.browser-default) {
    height: 2vh;
    width: 4rem;
}
input[type=number]:not(.browser-default) {
    width: 6rem;
}
.input-field.col.s3.offset-s5 {
    display: flex;
    align-items: center;
}
.center-align {
    justify-content: center !important;
}
.flex {
    display: flex;
}
.modal-content {
    padding-bottom: 0px;
}
#modal1 {   transform: translateY(-50%) scaleX(1) !important; top: 50% !important;}

@media only screen and (max-width: 992px) {
    .modal {
        width: 20%;
        /* margin-top: 50%; */
    }

}
@media screen and (max-width: 640px) {
    .modal {
        width: 40%;
        /* margin-top: 50%; */
    }
}
</style>

