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
                            Have you featured in a public event?
                        </p>
                        
                        <form class="formContain">
                            <div class="row">
                                <div class="col s7 offset-s4">
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
                        </form>
                    </div>

                    <div v-show="view == 1">
                        <p class="contentTitle">Who is the organizer?</p>
                        
                        <form class="formContain">
                            <div class="row">
                                <div class="input-field col s10 offset-s1">
                                    <input type="text" placeholder="CNN,BBC etc." class="validate">
                                </div>
                            </div>
                        </form>
                    </div>

                    <div v-show="view == 2">
                        <p class="contentTitle">What is the title of the program?</p>
                        
                        <form class="formContain">
                            <div class="row">
                                <div class="input-field col s10 offset-s1">
                                    <input type="text" placeholder="Title of the program" class="validate">
                                </div>
                            </div>
                        </form>
                    </div>

                    <div v-show="view == 3">
                        <p class="contentTitle">Is there a URL to this program?</p>
                        
                        <form class="formContain">
                            <div class="row">
                                <div class="input-field col s10 offset-s1">
                                    <input type="text" placeholder="Input the URL" class="validate">
                                </div>
                            </div>
                        </form>
                    </div>

                    <div v-show="view == 4">
                        <p class="contentTitle">
                            Do you want to add more
                        </p>
                        
                        <form class="formContain">
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
                        </form>
                    </div>

                    <div v-show="view == 5">
                        <p class="milestoneCongratMsg">Congratulations!!!</p>
                        <p class="contentTitle">
                            you have setup the public feature section of your website. 
                            please click the link to preview on your website
                        </p>
                        
                        <div class="viewWebBtnDiv">
                            <a href="/preview/1" class="btn viewWebBtn">
                                View website
                            </a>
                        </div>
                    </div>

                    <!-- Prev/Next Button Section -->
                    <div v-if="view != 4 && view != 5" class="skipDiv">
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
                            :class="view != 5 ? 'btnOn' : 'btnOff'"
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
    components: { },
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
            this.view != 5 ? this.view++ : null;
        },
        yesPubEvent() {
            this.view = 1;
        },
        noPubEvent() {
            // this.view = 5;
            window.location.href = "/preview/1";
        },
        addMore() {
            this.view = 1;
        },
        dontAddMore() {
            this.view = 5;
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