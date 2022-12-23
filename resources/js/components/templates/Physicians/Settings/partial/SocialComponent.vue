<template>
    <div>
        <div class="socialModalDiv" v-if="socialsModal">
            <div class="editInnerGenModal">
                <div>
                    <p class="genTitle1">Link your social media platform</p>

                    <p class="genTxt">
                        Lorem Ipsum is simply dummy text of the printing and
                        typesetting industry.
                    </p>

                    <form @submit.prevent="saveSocial">
                        <div class="input-field">
                            <input
                                type="text"
                                id="socialInput"
                                v-model="social.linkedin"
                                placeholder="Enter your linkedin company profile name eg. DrFaucci"
                            />
                            <i
                                class="
                                    fa-brands fa-linkedin
                                    editSocialMedIcons
                                "
                            ></i>
                        </div>

                        <div class="input-field">
                            <input
                                type="text"
                                id="socialInput1"
                                v-model="social.twitter"
                                placeholder="Enter your twitter username eg @Drpeters"
                            />
                            <i
                                class="fa-brands fa-twitter editSocialMedIcons"
                            ></i>
                        </div>

                        <div class="input-field">
                            <input
                                type="text"
                                id="socialInput2"
                                v-model="social.facebook"
                                placeholder="Enter your page name eg: XiaomiGlobal"
                            />
                            <i
                                class="fa-brands fa-facebook editSocialMedIcons"
                            ></i>
                        </div>

                        <div>
                            <button type="submit" class="btn" id="genModalBtn" v-if="saved == null">
                                save
                            </button>
                            <button type="submit" class="btn" id="genModalBtn" v-else @click="social.update = 1">
                                update
                            </button>
                        </div>
                    </form>

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