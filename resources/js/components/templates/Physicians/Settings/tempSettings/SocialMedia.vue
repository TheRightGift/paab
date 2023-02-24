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
                <div class="contentDiv container">
                    <div v-show="view == 0">
                        <p class="contentTitle">
                            Do you want to setup your facebook
                            posts to stream on your website
                        </p>

                        <div class="formContain">
                            <div class="row">
                                <div class="col s7 offset-s4">
                                    <label class="radioBtnLabel">
                                        <input class="with-gap" name="group1" type="radio" />
                                        <span class="radioBtnSpan" @click="yesFb()">Yes</span>
                                    </label>
                                    <label @click="noFb()">
                                        <input class="with-gap" name="group1" type="radio" />
                                        <span class="radioBtnSpan">No</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-show="view == 1">

                        <div class="formContain">
                            <div class="row">
                                <div class="input-field col s10 offset-s1">
                                    <input type="text" placeholder="Input your Facebook Id" class="validate" v-model="social.facebook">
                                </div>
                            </div>
                            <p class="contentTitle">How to get your facebook id</p>
                            <div class="container">
                                <ul class="collapsible">
                                    <li>
                                        <div class="collapsible-header">
                                            <i class="material-icons">smartphone</i>
                                            <span class="contentTitle1">How to get my facebook id via mobile</span>
                                        </div>
                                        <div class="collapsible-body">
                                            <video class="socialMediaHandVidTag" controls>
                                                <source src="/media/videos/get_facebook_pro_page_name.mp4" type="video/mp4">
                                            </video>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="collapsible-header">
                                            <i class="material-icons">laptop_windows</i>
                                            <span class="contentTitle1">How to get my facebook id via desktop</span>
                                        </div>
                                        <div class="collapsible-body">
                                            <video class="socialMediaHandVidTag" controls>
                                                <source src="/media/videos/get_facebook_pro_page_name.mp4" type="video/mp4">
                                            </video>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div v-show="view == 2">
                        <p class="contentTitle">
                            Do you want to setup your twitter
                            posts to stream on your website
                        </p>

                        <div class="formContain">
                            <div class="row">
                                <div class="col s7 offset-s4">
                                    <label class="radioBtnLabel">
                                        <input class="with-gap" name="group1" type="radio" />
                                        <span class="radioBtnSpan" @click="yesTw()">Yes</span>
                                    </label>
                                    <label @click="noTw()">
                                        <input class="with-gap" name="group1" type="radio" />
                                        <span class="radioBtnSpan">No</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-show="view == 3">

                        <div class="formContain">
                            <div class="row">
                                <div class="input-field col s10 offset-s1">
                                    <input type="text" placeholder="Input your twitter Id" class="validate" v-model="social.twitter">
                                </div>
                            </div>
                            <p class="contentTitle">How to get my Twitter id</p>
                            <div class="container">
                                <ul class="collapsible">
                                    <li>
                                        <div class="collapsible-header">
                                            <i class="material-icons">smartphone</i>
                                            <span class="contentTitle1">How to get my Twitter id via mobile</span>
                                        </div>
                                        <div class="collapsible-body">
                                            <video class="socialMediaHandVidTag" controls>
                                                <source src="/media/videos/get_twitter_handle.mp4" type="video/mp4">
                                            </video>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="collapsible-header">
                                            <i class="material-icons">laptop_windows</i>
                                            <span class="contentTitle1">How to get my Twitter id via desktop</span>
                                        </div>
                                        <div class="collapsible-body">
                                            <video class="socialMediaHandVidTag" controls>
                                                <source src="/media/videos/get_twitter_handle.mp4" type="video/mp4">
                                            </video>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div v-show="view == 4">
                        <p class="contentTitle">
                            Do you want to setup your instagram
                            posts to stream on your website
                        </p>

                        <div class="formContain">
                            <div class="row">
                                <div class="col s7 offset-s4">
                                    <label class="radioBtnLabel">
                                        <input class="with-gap" name="group1" type="radio" />
                                        <span class="radioBtnSpan" @click="yesInta()">Yes</span>
                                    </label>
                                    <label @click="noInta()">
                                        <input class="with-gap" name="group1" type="radio" />
                                        <span class="radioBtnSpan">No</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-show="view == 5">

                        <div class="formContain">
                            <div class="row">
                                <div class="input-field col s10 offset-s1">
                                    <input type="text" placeholder="Input your instagram Id" class="validate" v-model="social.instagram">
                                </div>
                            </div>

                            <p class="contentTitle">How to get my Instagram id</p>
                            <div class="container">
                                <ul class="collapsible">
                                    <li>
                                        <div class="collapsible-header">
                                            <i class="material-icons">smartphone</i>
                                            <span class="contentTitle1">How to get my Instagram id via mobile</span>
                                        </div>
                                        <div class="collapsible-body">
                                            <video class="socialMediaHandVidTag" controls>
                                                <source src="/media/videos/get_instagram_handle.webm" type="video/webm">
                                            </video>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="collapsible-header">
                                            <i class="material-icons">laptop_windows</i>
                                            <span class="contentTitle1">How to get my Instagram id via desktop</span>
                                        </div>
                                        <div class="collapsible-body">
                                            <video class="socialMediaHandVidTag" controls>
                                                <source src="/media/videos/get_instagram_handle.webm" type="video/webm">
                                            </video>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div v-show="view == 6">
                        <p class="contentTitle">
                            Do you want to setup your tiktok
                            posts to stream on your website
                        </p>

                        <div class="formContain">
                            <div class="row">
                                <div class="col s7 offset-s4">
                                    <label class="radioBtnLabel">
                                        <input class="with-gap" name="group1" type="radio" />
                                        <span class="radioBtnSpan" @click="yesTik()">Yes</span>
                                    </label>
                                    <label @click="noTik()">
                                        <input class="with-gap" name="group1" type="radio" />
                                        <span class="radioBtnSpan">No</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-show="view == 7">

                        <div class="formContain">
                            <div class="row">
                                <div class="input-field col s10 offset-s1">
                                    <input type="text" placeholder="Input your tiktok Id" class="validate" v-model="social.tiktok">
                                </div>
                            </div>
                            <p class="contentTitle">How to get my Tiktok id</p>
                            <div class="container">
                                <ul class="collapsible">
                                    <li>
                                        <div class="collapsible-header">
                                            <i class="material-icons">smartphone</i>
                                            <span class="contentTitle1">How to get my Tiktok id via mobile</span>
                                        </div>
                                        <div class="collapsible-body">
                                            <video class="socialMediaHandVidTag" controls>
                                                <source src="/media/videos/get_tiktok_handle.webm" type="video/webm">
                                            </video>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="collapsible-header">
                                            <i class="material-icons">laptop_windows</i>
                                            <span class="contentTitle1">How to get my Tiktok id via desktop</span>
                                        </div>
                                        <div class="collapsible-body">
                                            <video class="socialMediaHandVidTag" controls>
                                                <source src="/media/videos/get_tiktok_handle.webm" type="video/webm">
                                            </video>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div v-show="view == 8">
                        <p class="contentTitle">Are you satisfied with the changes?</p>

                        <div class="formContain">
                            <div class="row">
                                <div class="col s7 offset-s4">
                                    <label class="radioBtnLabel">
                                        <input class="with-gap" name="group1" type="radio" />
                                        <span class="radioBtnSpan" @click="(yesSatisfy(), saveSocials())">Yes</span>
                                    </label>
                                    <label @click="noSatisfy()">
                                        <input class="with-gap" name="group1" type="radio" />
                                        <span class="radioBtnSpan">No</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-show="view == 9">
                        <p class="contentTitle">
                            <span class="milestoneCongratMsg">Congratulations!!!</span>
                            <br>
                            on completing your Social media process.
                            please click the link to preview on your website
                        </p>

                        <div class="viewWebBtnDiv">
                            <a :href="host" class="btn viewWebBtn">
                                View website
                            </a>
                        </div>
                    </div>

                    <!-- Prev/Next Button Section -->
                    <div v-if="view !== 9 && view !== 0 && view !== 2 && view !== 4 && view !== 6" class="skipDiv">
                        <button
                            class="skipBtn"
                            @click="prev()" :disabled="view < 1"
                            :class="view > 0 ? 'btnOn' : 'btnOff'"
                        >
                            <i class="material-icons">keyboard_arrow_left</i>
                        </button>
                        <span class="skipTxt">skip</span>
                        <button
                            class="skipBtn" @click="next()"
                            :disabled="view === view.length"
                            :class="view !== 9 ? 'btnOn' : 'btnOff'"
                        >
                            <i class="material-icons">keyboard_arrow_right</i>
                        </button>
                    </div>

                    <FooterComponent />
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import FooterComponent from "../../FooterComponent.vue";

export default {
    components: {FooterComponent},
    data() {
        return {
            loading: false,
            fetching: false,
            view: 0,
            social: {
                facebook: "",
                twitter: "",
                tiktok: "",
                instagram: "",
            },
            host: "",
        };
    },
    mounted() {
        this.getSavedSocials();
        this.host = `http://${location.host}`;
    },
    methods: {
        saveSocials() {
            if (
                this.social.facebook !== '' ||
                this.social.tiktok !== '' ||
                this.social.instagram !== '' ||
                this.social.twitter !== ''
            ) {
                this.loading = !this.loading;
                let request = `/api/social`;
                let data = {
                    _method: "PUT",
                };
                if (this.update == 1) {
                    request = `/api/social/${this.social.id}`;
                    this.social = { ...this.social, ...data };
                }
                axios
                    .post(request, this.social)
                    .then((res) => {
                        if (res.status == 201 || res.data.status == 200) {
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
        },
        getSavedSocials(){
            this.fetching = !this.fetching;
            axios.get('/api/social').then(res => {
                if (res.data.social !== null) {
                    this.social = res.data.social;
                    this.update = 1;
                    this.fetching = !this.fetching;
                }
            }).catch(reportError => {
                this.fetching = !this.fetching;
                console.log(reportError)
            })
        },
        prev() {
            this.view != 0 ? this.view-- : null;
        },
        next() {
            this.view != 9 ? this.view++ : null;
        },
        yesFb() {
            this.view = 1;
        },
        noFb() {
            this.view = 2;
        },
        yesTw() {
            this.view = 3;
        },
        noTw() {
            this.view = 4;
        },
        yesInta() {
            this.view = 5;
        },
        noInta() {
            this.view = 6;
        },
        yesTik() {
            this.view = 7;
        },
        noTik() {
            this.view = 8;
        },
        yesSatisfy() {
            this.view = 9;
        },
        noSatisfy() {
            this.view = 7;
        }
    },
};
</script>
