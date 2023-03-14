<template>
    <div>
        <div class="row authContainDiv">
            <div v-if="!otpPrompt && !logginIn">
                <div class="col s12 m12 l6 loginContainer hide-on-med-and-down">
                    <div class="wlcNoteDiv">
                        <p class="wlcNoteLogo">WhiteCoatDomain</p>
                        <p class="wlcNoteTitle">WELCOME BACK CHIEF!</p>
                        <p class="wlcNoteTxt">
                            It is a long established fact that a reader will be
                            distracted by the readable content.
                        </p>
                        <p class="wlcNoteFooterTxt">
                            © Photo, Inc. 2019. We love our users!
                        </p>
                    </div>
                </div>
    
                <div class="col s12 m12 l6 loginContainer">
                    <div class="authRightDiv">
                        <p class="authTitle">LOGIN</p>
                        <p class="authTxt">
                            It is a long established fact that a reader will be diIt
                            is a long
                        </p>
    
                        <form id="loginForm">
                            <div class="row rm_mg">
                                <div class="input-field col s12">
                                    <input
                                        placeholder="Email"
                                        v-model="loginUser.email"
                                        id="user"
                                        type="email"
                                        class="validate"
                                        required
                                    />
                                    <div v-if="errors.email">
                                        <p class="red-text" v-for="err in errors.email" :key="err">{{ err }}</p>
                                    </div>
                                </div>
    
                                <div class="input-field col s12">
                                    <input
                                        placeholder="Password"
                                        v-model="loginUser.password"
                                        id="password"
                                        type="password"
                                        class="validate"
                                    />
                                </div>
    
                                <!-- Login Social Media Handle -->
                                <!-- <social-login-component /> -->
                                <div class="input-field col s12">
                                    <a
                                        type="button"
                                        v-if="!loading"
                                        class="btn"
                                        id="loginBtn"
                                        @click.prevent="userLogin()"
                                    >
                                        sign in
                                    </a>
                                    <a class="btn" id="loginBtn" v-else>
                                        <div class="preloader-wrapper small active">
                                            <div
                                                class="
                                                    spinner-layer spinner-white-only
                                                "
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
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div v-else-if="otpPrompt && !logginIn">
            
                <div class="col s12 m12 l6 otpContainer hide-on-med-and-down">
                    <div class="wlcNoteDiv">
                        <a href="/" class="wlcNoteLogo">
                            <img
                                src="/media/img/whiteCoatDomain1.png"
                                alt="whiteCoatDomain.png"
                                class="authLogo"
                            />
                        </a>
                        <p class="wlcNoteTitle">
                            We appreciate your journey <br />with us...
                        </p>
                        <p class="wlcNoteTxt">
                            “Good things come to those who wait”.
                            <span class="getStartedOtpSpan right">Nathan Sykes</span>
                        </p>
                        <p class="wlcNoteFooterTxt">
                            &copy; White Coat Domain. {{ getYear() }}. We support
                            your brand!
                        </p>
                    </div>
                </div>
    
                <div class="col s12 m12 l6 otpContainer">
                    <div class="authHeadingContainer center-align hide-on-large-only">
                        <a href="/" class="authHeading">WhiteCoatDomain</a>
                    </div>
                    <OtpComponent @res="otpVerifier" :otp="otp" :type="'register'" :text="'You are logging in from a new device, we sent you an OTP to your registered email. Please enter OTP to verify your account'"/>
                </div>
            </div>
            <div v-else-if="logginIn" class="centeredLoader">
                <div class="authHeadingContainer center-align hide-on-large-only">
                    <a href="/" class="authHeading">WhiteCoatDomain</a>
                </div>
                <i class="fas fa-circle-notch fa-spin fa-2x"></i>
                <p>Loggin You In</p>
            </div>
        </div>
    </div>
</template>
<script>
    import OtpComponent from "../../../partials/OtpComponent.vue";
    import SocialLoginComponent from "../../../partials/SocialLoginComponent.vue";
    export default {
        components: { SocialLoginComponent, OtpComponent },
        data() {
            return {
                
                loginLoading: false,
                loginUser: {
                    email: "",
                    password: "",
                },
            };
        },
        props: {
            loading: Boolean,
            errors: Object,
            logginIn: Boolean,
            otp: String,
            otpPrompt: Boolean,
        },
        methods: {
            getYear() {
                return new Date().getFullYear();
            },
            otpVerifier(val) {
                if (val === 200) {
                    console.log('here')
                    this.$emit("anteLogin", this.loginUser);
                }
            },
            userLogin() {
                this.$emit("loginUser", this.loginUser);
            },
        },
    };
</script>
<style>
@media screen and (max-width: 640px) {
    ul:not(.browser-default)>li {
        list-style-type: none;
    }
    .authContainDiv {
        width: 80%;
    }
}
.centeredLoader {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    transform: -webkit-translate(-50%, -50%);
    transform: -moz-translate(-50%, -50%);
    transform: -ms-translate(-50%, -50%);
    text-align: center;
}
</style>
