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
                                type="url"
                                id="socialInput"
                                v-model="social.instagram"
                            />
                            <i
                                class="
                                    fa-brands fa-square-instagram
                                    editSocialMedIcons
                                "
                            ></i>
                        </div>

                        <div class="input-field">
                            <input
                                type="url"
                                id="socialInput1"
                                v-model="social.twitter"
                            />
                            <i
                                class="fa-brands fa-twitter editSocialMedIcons"
                            ></i>
                        </div>

                        <div class="input-field">
                            <input
                                type="url"
                                id="socialInput2"
                                v-model="social.facebook"
                            />
                            <i
                                class="fa-brands fa-facebook editSocialMedIcons"
                            ></i>
                        </div>

                        <div>
                            <button type="submit" class="btn" id="genModalBtn" v-if="Object.entries(saved).length == 0">
                                save
                            </button>
                            <button type="submit" class="btn" id="genModalBtn" v-else>
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
                    facebook: "https://",
                    twitter: "https://",
                    instagram: "https://",
                },
            }
        },
        methods: {
            contactLink(){
                this.$emit('contactLink');
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
                this.social.facebook = newVal.facebook;
                this.social.instagram = newVal.instagram;
                this.social.twitter = newVal.twitter;
            }
        },
    };
</script>