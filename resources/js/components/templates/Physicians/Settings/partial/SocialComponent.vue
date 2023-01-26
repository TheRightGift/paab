<template>
    <div>
        <div class="socialModalDiv" v-if="socialsModal">
            <div class="editInnerGenModal">
                <div class="row">
                    <p class="genTitle1">Link your social media platform</p>

                    <div class="col l6">
                        <p class="genTxt">
                            Please click on the information icon beside each social input field to get details on how to fill it. <span v-if="instructionViewSTate !== 'df'"><a href="#!" @click="changeSocialInstructionView('df')">View default instruction</a></span>
                        </p>

                        <form @submit.prevent="saveSocial" id="socailsSettingForm">
                            <div class="row">
                                <div class="input-field col l10 noVertMargin">
                                    <input
                                        type="text"
                                        class="socialInput"
                                        v-model="social.linkedin"
                                        placeholder="Enter a linkedin share id eg. 6997829974141382656"
                                    />
                                    <i
                                        class="
                                            fa-brands fa-linkedin
                                            editSocialMedIcons
                                        "
                                    ></i>
                                </div>
                                <div class="col l2">
                                    <a class="waves-effect waves-teal btn-flat addSocialsInstruction" @click="changeSocialInstructionView('in')">
                                        <i class="material-icons">info</i>
                                    </a>
                                </div>
                            </div>

                            <div class="input-field">
                                <div class="row">
                                    <div class="input-field col l10 noVertMargin">
                                        <input
                                            type="text"
                                            class="socialInput"
                                            v-model="social.twitter"
                                            placeholder="Enter your twitter username WITHOUT the @ sign. Eg Drpeters"
                                        />
                                        <i
                                            class="fa-brands fa-twitter editSocialMedIcons"
                                        ></i>
                                    </div>
                                    <div class="col l2">
                                        <a class="waves-effect waves-teal btn-flat addSocialsInstruction" @click="changeSocialInstructionView('tw')">
                                            <i class="material-icons">info</i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="input-field">
                                <div class="row">
                                    <div class="input-field col l10 noVertMargin">
                                        <input
                                            type="text"
                                            class="socialInput"
                                            v-model="social.facebook"
                                            placeholder="Enter your page name eg: XiaomiGlobal"
                                        />
                                        <i
                                            class="fa-brands fa-facebook editSocialMedIcons"
                                        ></i>
                                    </div>
                                    <div class="col l2">
                                        <a class="waves-effect waves-teal btn-flat addSocialsInstruction" @click="changeSocialInstructionView('fb')">
                                            <i class="material-icons">info</i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div>
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
                                    save
                                </button>
                                <button type="submit" class="btn" id="genModalBtn" v-else @click="social.update = 1">
                                    update
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col l6 socailInstruction">
                        <div class="col l12" v-if="instructionViewSTate == 'in'">
                            <h5 class="center-align">
                                <i class="fa-brands fa-linkedin"></i>
                                How to get linked share id for this field?                                 
                            </h5>
                            <p>
                                <i class="gray-text">
                                    Watch the video or follow the steps below to get embed value for your top linkedin post.
                                </i>
                            </p>
                            <section class="instructionSection">
                                <h6>Video Instruction</h6>
                                <div class="video-container">
                                    <video width="100%" controls>
                                        <source src="/media/videos/get_linkedin_share_id.mp4" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            </section>

                            <section class="instructionSection">
                                <h6>Step-by-step Instruction</h6>
                                <ol class="col l12">
                                    <li>
                                        Log into your linkedin account from your PC. <small>You are advised to do this with your PC.</small> 
                                    </li>
                                    <li>
                                        Click on the "Me" option with your profile picture on the top navigation.
                                    </li>
                                    <li>
                                        Click on "Posts &amp; Activity" from the resulting dropdown.
                                    </li>
                                    <li>
                                        Click on the "Post" pill to display your posts.
                                    </li>
                                    <li>    
                                        Scroll to the post you want to share on your website.
                                    </li>
                                    <li>
                                        CLick on "..." at the top-right corner of the post.
                                    </li>
                                    <li>
                                        CLick on "Embed this post".
                                    </li>
                                    <li>
                                        A code is displayed. You only need value of "urn:li:share". This will always be a number
                                    </li>
                                </ol>
                            </section>
                        </div>
                        <div class="col l12" v-if="instructionViewSTate == 'tw'">
                            <h5 class="center-align">
                                <i class="fa-brands fa-twitter"></i>
                                How to get twitter handle for this field?
                            </h5>
                            <p>
                                <i class="gray-text">
                                    Watch the video or follow the steps below to get your twitter handle. The video demonstrates how to get your twitter handle on your PC. For mobile please follow the instruction.
                                </i>
                            </p>
                            <section class="instructionSection">
                                <h6>Video Instruction</h6>
                                <div class="video-container">
                                    <video width="100%" controls>
                                        <source src="/media/videos/get_twitter_handle.mp4" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            </section>

                            <section class="instructionSection">
                                <h6>Step-by-step Instruction</h6>
                                <ol class="col l12">
                                    <li>
                                        Log into your twitter account from your PC or mobile.
                                    </li>
                                    <li>
                                        <b>PC: </b> On the bottom left-corner of your screen you will see your twittwr handle name.<br>
                                        <b>Mobile: </b> CLick on your profile picture on the top-left corner of your mobile screen to view your handle name
                                    </li>
                                    <li>
                                        Please do NOT include the @ sign.
                                    </li>
                                    
                                </ol>
                            </section>
                        </div>
                        <div class="col l12" v-if="instructionViewSTate == 'fb'">
                            <h5 class="center-align">
                                <i class="fa-brands fa-facebook"></i>
                                How to get facebook id for this field?
                            </h5>
                            
                            <p class="red-text">
                                Facebook does not allow embedding timeline from your facebook account that is not on professional mode.
                            </p>
                            <p>
                                <i class="gray-text">
                                    Follow the video below to turn on professional mode on your facebook account and get your page name for embedding on your website (PC &amp; Mobile).
                                </i>
                            </p>

                            <section class="instructionSection">
                                <h6>Video Instruction</h6>
                                <div class="video-container">
                                    <video width="100%" controls>
                                        <source src="/media/videos/get_facebook_pro_page_name.mp4" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            </section>

                            
                        </div>

                        <div class="col l12" v-if="instructionViewSTate == 'df'">
                            <h5>
                                Embedding my Social Media timeline in my website.
                            </h5>
                            <p>
                                Updating this section enables your clients or visitors to share of your socail media posts. Your website automatically updates this section with your latest posts.
                            </p>
                            <p>
                                <b>Please click on the info icon (<i class="material-icons inlineIcon">info</i>) beside each social input field to view steps on how to properly enable this feature.</b>
                            </p>
                            <div class="col l12">
                                <img src="/media/img/editWebsiteSettings/socials.png" alt="preview of socail media section of your webpage" class="responsive-img">
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="genBottomBtnDiv">
                        <a href="#" class="goBackBtn" @click="socialGoBackBtn()"
                            >GO BACK</a
                        >

                        <button
                            type="button"
                            class="btn right"
                            id="genNextBtn"
                            @click="contactLink()"
                        >
                            NEXT STEP
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            socialsModal: Boolean,
            saved: Object,
            loading: Boolean
        },
        data() {
            return {
                social: {
                    facebook: "",
                    twitter: "",
                    linkedin: "",
                    update: 0,
                },
                socialError: false,
                instructionViewSTate: 'df'
            }
        },
        methods: {
            contactLink(){
                if (this.social.facebook == "" || this.social.twitter == "") {
                    this.socialError = true;
                } else this.socialError = false;
                this.$emit('contactLink', this.socialError);
            },
            socialGoBackBtn(){
                this.$emit('socialGoBackBtn');
            },
            saveSocial(){
                this.$emit('saveSocial', this.social)
            },
            changeSocialInstructionView(viewName){
                this.instructionViewSTate = viewName;
            }
        },
        watch: {
            saved(newVal, oldVal){
                if (newVal != null) {
                    this.social.facebook = newVal.facebook;
                    this.social.linkedin = newVal.linkedin;
                    this.social.twitter = newVal.twitter;
                    this.social.id = newVal.id;
                }
            }
        },
    };
</script>