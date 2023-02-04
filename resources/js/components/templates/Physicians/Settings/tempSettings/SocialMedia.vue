<template>
    <div>
        <div class="row">
            <div class="col s12">
                <div class="primaryColorDiv">
                    <div class="headerDiv">
                        <a href="/">
                            <img src="/media/img/setupWeb/wcdMobileLogo.png" alt="wcdMobileLogo.png">
                        </a>
                        <p class="headerTitle">
                            It is time for the world
                            to hear your pulse
                        </p>
                    </div>
                    <div>
                        <img src="/media/img/setupWeb/3dDoctors.png" alt="3dDoctors.png" class="primaryColorDocsImg">
                    </div>
                </div>
            </div>

            <div class="col s12">
                <div class="contentDiv">
                    <div v-show="view == 0">
                        <p class="contentTitle">
                            Do you want to setup your facebook 
                            posts to stream on your website
                        </p>
                        
                        <form class="formContain">
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
                        </form>
                    </div>

                    <div v-show="view == 1">
                        <p class="contentTitle">How to get my facebook id</p>
                        
                        <form class="formContain">
                            <div class="row">
                                <div class="input-field col s10 offset-s1">
                                    <input type="text" placeholder="Id" class="validate">
                                </div>
                            </div>
                            
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
                        </form>
                    </div>

                    <div v-show="view == 2">
                        <p class="contentTitle">
                            Do you want to setup your twitter 
                            posts to stream on your website
                        </p>
                        
                        <form class="formContain">
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
                        </form>
                    </div>

                    <div v-show="view == 3">
                        <p class="contentTitle">How to get my Twitter id</p>
                        
                        <form class="formContain">
                            <div class="row">
                                <div class="input-field col s10 offset-s1">
                                    <input type="text" placeholder="Id" class="validate">
                                </div>
                            </div>
                        
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
                        </form>
                    </div>

                    <div v-show="view == 4">
                        <p class="contentTitle">
                            Do you want to setup your instagram 
                            posts to stream on your website
                        </p>
                        
                        <form class="formContain">
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
                        </form>
                    </div>

                    <div v-show="view == 5">
                        <p class="contentTitle">How to get my Instagram id</p>
                        
                        <form class="formContain">
                            <div class="row">
                                <div class="input-field col s10 offset-s1">
                                    <input type="text" placeholder="Id" class="validate">
                                </div>
                            </div>
                        
                            <ul class="collapsible">
                                <li>
                                    <div class="collapsible-header">
                                        <i class="material-icons">smartphone</i>
                                        <span class="contentTitle1">How to get my Instagram id via mobile</span>
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
                                        <span class="contentTitle1">How to get my Instagram id via desktop</span>
                                    </div>
                                    <div class="collapsible-body">
                                        <video class="socialMediaHandVidTag" controls>
                                            <source src="/media/videos/get_twitter_handle.mp4" type="video/mp4">
                                        </video>
                                    </div>
                                </li>
                            </ul>
                        </form>
                    </div>

                    <div v-show="view == 6">
                        <p class="contentTitle">
                            Do you want to setup your tiktok 
                            posts to stream on your website
                        </p>
                        
                        <form class="formContain">
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
                        </form>
                    </div>

                    <div v-show="view == 7">
                        <p class="contentTitle">How to get my Tiktok id</p>
                        
                        <form class="formContain">
                            <div class="row">
                                <div class="input-field col s10 offset-s1">
                                    <input type="text" placeholder="Id" class="validate">
                                </div>
                            </div>
                        
                            <ul class="collapsible">
                                <li>
                                    <div class="collapsible-header">
                                        <i class="material-icons">smartphone</i>
                                        <span class="contentTitle1">How to get my Tiktok id via mobile</span>
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
                                        <span class="contentTitle1">How to get my Tiktok id via desktop</span>
                                    </div>
                                    <div class="collapsible-body">
                                        <video class="socialMediaHandVidTag" controls>
                                            <source src="/media/videos/get_twitter_handle.mp4" type="video/mp4">
                                        </video>
                                    </div>
                                </li>
                            </ul>
                        </form>
                    </div>

                    <div v-show="view == 8">
                        <p class="contentTitle">Are you satisfied with the changes?</p>

                        <form class="formContain">
                            <div class="row">
                                <div class="col s7 offset-s4">
                                    <label class="radioBtnLabel">
                                        <input class="with-gap" name="group1" type="radio" />
                                        <span class="radioBtnSpan" @click="yesSatisfy()">Yes</span>
                                    </label>
                                    <label @click="noSatisfy()">
                                        <input class="with-gap" name="group1" type="radio" />
                                        <span class="radioBtnSpan">No</span>
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div v-show="view == 9">
                        <p class="milestoneCongratMsg">Congratulations!!!</p>
                        <p class="contentTitle">
                            on completing your Social media process. 
                            please click the link to preview on your website
                        </p>

                        <div class="viewWebBtnDiv">
                            <a href="/preview/1" class="btn viewWebBtn">
                                View website
                            </a>
                        </div>
                    </div>

                    <!-- Prev/Next Button Section -->
                    <div v-if="view != 9" class="skipDiv">
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
                            :disabled="view == view.length"
                            :class="view != 9 ? 'btnOn' : 'btnOff'"
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
export default {
    components: {},
    data() {
        return {
            view: 0,
        };
    },
    mounted() { },
    methods: {
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