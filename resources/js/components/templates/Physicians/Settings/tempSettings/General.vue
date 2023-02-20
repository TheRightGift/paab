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
                    <div v-show="view == 0">
                        <p class="contentTitle">What do you want the title of your website to be?</p>

                        <form class="formContain">
                            <div class="row">
<!--                                <div class="input-field col s2">-->
<!--                                    <select>-->
<!--                                        <option value="1">MD</option>-->
<!--                                        <option value="2">Dr</option>-->
<!--                                    </select>-->
<!--                                </div>-->

<!--                                <div class="input-field col s4 offset-s1">-->
<!--                                    <input type="text" placeholder="Last Name" class="validate">-->
<!--                                </div>-->

                                <div class="input-field col s12">
                                    <input type="text" placeholder="Title of page" class="validate" v-model="general.title">
                                </div>
                            </div>
                        </form>
                    </div>

                    <div v-show="view == 1">
                        <p class="contentTitle">Do you want to setup a favicon (logo) for your site?</p>

                        <form class="formContain">
                            <div class="row">
                                <div class="col s7 offset-s4">
                                    <label class="radioBtnLabel">
                                        <input class="with-gap" name="group1" type="radio" />
                                        <span class="radioBtnSpan" @click="yesFavIcon()">Yes</span>
                                    </label>
                                    <label @click="noFavIcon()">
                                        <input class="with-gap" name="group1" type="radio" />
                                        <span class="radioBtnSpan">No</span>
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div v-show="view == 2">
                        <p class="contentTitle">Set up a favicon logo</p>
                        <p class="centered">The favicon logo is usually the icon beside the title of a webpage URL</p>
                        <p class="centered"><small >The image for favicon should be less than 100KiloBytes</small></p>
                        <form class="formContain">
                            <input type="file" id="viewWebBtn" hidden @change="favUpload" accept=".png"/>

                            <div class="viewWebBtnDiv">
                                <div class="centered">
                                    <div v-if="errors.length > 0" >
                                        <p class="error" v-for="(error, index) in errors" :key="index">{{error}}</p>
                                    </div>
                                    <div>
                                        <label for="viewWebBtn" class="viewWebBtn" v-if="!uploadFavLoading">Upload FavIcon</label>
                                        <p v-else>Uploading image <i class="fas fa-spinner fa-spin"></i></p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div v-show="view == 3">
                        <p class="contentTitle">Are you satisfied with the changes?</p>

                        <form class="formContain">
                            <div class="row">
                                <div class="col s7 offset-s4">
                                    <label class="radioBtnLabel">
                                        <input class="with-gap" name="group1" type="radio" />
                                        <span class="radioBtnSpan" @click="(generalSaveUpdate(), yesSatisfy())">Yes</span>
                                    </label>
                                    <label @click="noSatisfy()">
                                        <input class="with-gap" name="group1" type="radio" />
                                        <span class="radioBtnSpan">No</span>
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div v-show="view === 4 && !loading">
                        <p class="contentTitle">
                            <span class="milestoneCongratMsg">Congratulations!!!</span>
                            <br>
                            on completing your General settings.
                            please click the link to preview on your website
                        </p>

                        <div class="viewWebBtnDiv">
                            <a :href="host" class="btn viewWebBtn">
                                View website
                            </a>
                        </div>
                    </div>
                    <div v-if="view === 4 && loading" class="centered">
                        <p>Updating Changes <i class="fas fa-circle-notch fa-spin"></i></p>
                    </div>

                    <!-- Prev/Next Button Section -->
                    <div v-if="view != 4 && view !== 3 && view !== 1" class="skipDiv">
                        <button class="skipBtn" @click="prev()"
                                :disabled="view < 1"
                                :class="view > 0 ? 'btnOn' : 'btnOff'">
                            <i class="material-icons">keyboard_arrow_left</i>
                        </button>
                        <span class="skipTxt">skip</span>
                        <button class="skipBtn" @click="next()"
                                :disabled="view === 3"
                                :class="view !== 3 ? 'btnOn' : 'btnOff'">
                            <i class="material-icons">keyboard_arrow_right</i>
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    components: {},
    data() {
        return {
            errors: [],
            general: {
                favicon: null,
                title: "",
            },
            uploaded: null,
            loading: false,
            uploadFavLoading: false,
            view: 0,
            host: "",
        };
    },
    mounted() {
        this.getSaved();
        this.host = `http://${location.host}`
    },
    methods: {
        deleteImg() {
            this.general.oldFav = this.general.favicon;
            this.general.favicon = null;
        },
        favUpload(e) {
            this.errors = [];
            if (!e.target.files.length) return;
            this.uploadFavLoading = !this.uploadFavLoading;
            this.general.favicon = e.target.files[0];
            let formData = new FormData();
            formData.append("favicon", this.general.favicon);
            let request = this.update === 1 ? `/api/general/${this.general.id}` : '/api/general';
            this.update === 1 ? formData.append('_method', 'PUT') : null;
            axios
                .post(request, formData)
                .then((res) => {
                    if (res.data.status === 200) {
                        M.toast({
                            html: res.data.message,
                            classes: "successNotifier",
                        });
                        this.uploadFavLoading = !this.uploadFavLoading;
                        this.update = 1;
                    }
                })
                .catch((err) => {
                    this.uploadFavLoading = !this.uploadFavLoading;
                    if (err.response.status == 400) {
                        this.loading = !this.loading;
                        this.errors = err.response.data;
                    }
                });
        },
        generalSaveUpdate(){
            this.loading = !this.loading;
            let formData = new FormData();
            formData.append("title", this.general.title);
            let request = this.update === 1 ? `/api/general/${this.general.id}` : '/api/general';
            this.update === 1 ? formData.append('_method', 'PUT') : null;
            axios
                .post(request, formData)
                .then((res) => {
                    if (res.data.status === 200) {
                        M.toast({
                            html: res.data.message,
                            classes: "successNotifier",
                        });
                        this.loading = false;
                        this.update = 1;
                    }
                })
                .catch((err) => {
                    this.loading = !this.loading;
                    if (err.response.status == 400) {
                        this.loading = !this.loading;
                        this.errors = err.response.data;
                    }
                });
        },
        getSaved() {
            this.fetching = true;
            axios.get('/api/general').then(res => {
                if (res.data.general !== null) {
                    this.general = res.data.general;
                    this.update = 1;
                }
            }).catch(err => {
                console.log(err);
            })
        },

        prev() {
            if (this.view !== 0 && this.view !== 2) {
                this.view --;
            }
            if (this.view === 2) {
                this.view = 0;
            }
        },
        next() {
            this.view != 9 ? this.view++ : null;
        },
        yesFavIcon() {
            this.view = 2;
        },
        noFavIcon() {
            this.view = 3;
        },
        yesSatisfy() {
            this.view = 4;
        },
        noSatisfy() {
            this.view = 2;
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
.displayNone {
    display: none;
}
</style>
