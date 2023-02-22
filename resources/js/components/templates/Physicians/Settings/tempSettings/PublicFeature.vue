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
                        <p class="contentTitle">
                            Have you made any media rounds/features ?
                        </p>

                        <div class="formContain">
                            <div class="row">
                                <div class="col s7 offset-s4 offset-l5">
                                    <label class="radioBtnLabel">
                                        <input class="with-gap" name="group1" type="radio" />
                                        <span class="radioBtnSpan" @click="yesPubEvent()">Yes</span>
                                    </label>
                                    <label @click="noPubEvent()">
                                        <input class="with-gap" name="group1" type="radio" />
                                        <span class="radioBtnSpan">No</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-show="view === 1">
                        <p class="contentTitle">Name of the media house?</p>

                        <div class="formContain">
                            <div class="row">
                                <div class="input-field col s10 offset-s1">
                                    <input type="text" placeholder="CNN OR BBC etc." class="validate" v-model="program.broadcaster">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-show="view === 2">
                        <p class="contentTitle">What is the title of the program?</p>

                        <div class="formContain">
                            <div class="row">
                                <div class="input-field col s10 offset-s1">
                                    <input type="text" placeholder="CNN Health" class="validate" v-model="program.title">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-show="view === 3">
                        <p class="contentTitle">Kindly provide the link, <b>if available</b>?</p>

                        <div class="formContain">
                            <div class="row">
                                <div class="input-field col s10 offset-s1">
                                    <input type="url" placeholder="https://news.com/whatevertheurlis" class="validate" v-model="program.url">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-show="view === 4">
                        <p class="contentTitle">
                            Do you want to add more
                        </p>

                        <div class="formContain">
                            <div class="row">
                                <div class="col s7 offset-s4">
                                    <label class="radioBtnLabel">
                                        <input class="with-gap" name="group1" type="radio" />
                                        <span class="radioBtnSpan" @click="addMore()">Yes</span>
                                    </label>
                                    <label @click="dontAddMore()">
                                        <input class="with-gap" name="group1" type="radio" />
                                        <span class="radioBtnSpan">No</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-show="view === 5">
                        <p class="milestoneCongratMsg">Congratulations!!!</p>
                        <p class="contentTitle">
                            You have setup the public feature section of your website.
                            please click the link to preview on your website
                        </p>

                        <div class="viewWebBtnDiv">
                            <a :href="host" class="btn viewWebBtn">
                                View website
                            </a>
                        </div>
                    </div>

                    <!-- Prev/Next Button Section -->
                    <div class="skipDiv" v-if="loading">
                        <i class="fas fa-spinner fa-spin"></i>
                    </div>
                    <div v-else>
                        <div v-if="view !== 0 && view !== 4" class="skipDiv">
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
                                :class="view !== 5 ? 'btnOn' : 'btnOff'"
                            >
                                <i class="material-icons">keyboard_arrow_right</i>
                            </button>
                        </div>
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
    created() {
        this.isLoggedIn = this.getCookie('_token');
        if (!this.isLoggedIn) location.replace(`http://${location.host}`)
    },
    data() {
        return {
            host: "",
            isLoggedIn: false,
            loading: false,
            program: {
              broadcaster: "",
              title: "",
              url: "",
            },
            programs: [],
            view: 0,
        };
    },
    mounted() {
        this.host = `http://${location.host}`;
    },
    methods: {
        addMore() {
            this.view = 1;
            this.program = {
                    broadcaster: "",
                    title: "",
                    url: "",
            };
        },
        addEventFeatured() {
            if (
                this.program.title !== '' ||
                this.program.broadcaster !== '' ||
                this.program.url !== ''
            ) {
                this.loading = !this.loading;
                axios
                    .post("/api/public_feature", this.program)
                    .then((res) => {
                        if (res.data.message === 'Success') {
                            M.toast({
                                html: res.data.message,
                                classes: "successNotifier",
                            });
                            this.program.id = res.data.id;
                            this.loading = !this.loading;
                        }
                    })
                    .catch((err) => {
                        this.loading = !this.loading;
                        console.log(err);
                    });
            }
        },
        dontAddMore() {
            this.view = 5;
        },
        getSavedPublicFeatures(){
            this.fetching = !this.fetching;
            axios.get('/api/public_feature').then(res => {
                if (res.data.message === 'Success') {
                    if (res.data.public_feature !== null) {
                        let feats = JSON.parse(res.data.achievement.feats);
                        this.programs = res.data.public_feature;
                        this.update = 1;
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
        next() {
            this.addEventFeatured();
            this.view != 5 ? this.view++ : null;
        },
        noPubEvent() {
            window.location.href = `http://${location.host}`;
        },
        prev() {
            this.view != 0 ? this.view-- : null;
        },
        yesPubEvent() {
            this.view = 1;
        },
    },
};
</script>
<style>
    .flex {
        display: flex;
    }

    .btnOn {
        border: 2px solid var(--primary);
        color: var(--primary);
    }

    .btnOff {
        border: 2px solid #D9D9D9;
        color: #D9D9D9;
    }
</style>
