<template>
    <div>
        <div class="row authContainDiv">
            <div> 
                <!-- v-if="!otpPrompt && !logginIn" -->
                <div class="col l6 loginContainer white-text intro hide-on-med-and-down">
                    <div class="marginTop-15">
                        <div class="row">
                            <div class="col l4 noMarginLeft">
                                <a href="/">
                                    <img
                                        src="/media/img/wcdlogoWhite.png"
                                        alt="WhiteCoatDomain Logo"
                                        class="responsive-img"
                                    />
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col l12">
                                <h1 class="wlcNoteTitle">
                                    WELCOME BACK <br />Doc.
                                </h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col l12">
                                <p class="wlcNoteTxt">
                                    The World is listening, it is time to tell your
                                    brand story with our professional, powerful and
                                    easy to use portfolio builder.
                                </p>
                            </div>
                        </div>
                    </div>
                    <p class="wlcNoteFooterTxt center-align">
                        <small>© {{ getYear() }} whitecoatdomain.com.</small>
                    </p>
                </div>

                <div class="col s12 m12 l6 loginContainer formContainer">
                    <div class="authRightDiv">
                        <div
                            class="authHeadingContainer center-align hide-on-large-only"
                        >
                            <a href="/" class="authHeading">WhiteCoatDomain</a>
                        </div>
                        <div for="loginIn" v-if="!otpPrompt && !logginIn">
                            <p class="authTitle">Sign In to Your space</p>
                            <p class="authTxt">
                                Build a brand online and let your potential patients
                                find you.
                            </p>
                            <form id="loginForm">
                                <div class="row rm_mg">
                                    <div class="input-field col s12">
                                        <label>Email</label>
                                        <input
                                            placeholder="Email"
                                            v-model="loginUser.email"
                                            id="user"
                                            type="email"
                                            class="validate loginInput browser-default"
                                            required
                                        />
                                        <div v-if="errors.email">
                                            <p
                                                class="red-text"
                                                v-for="err in errors.email"
                                                :key="err"
                                            >
                                                {{ err }}
                                            </p>
                                        </div>
                                    </div>
    
                                    <div class="input-field col s12">
                                        <label>Password</label>
                                        <input
                                            placeholder="Password"
                                            v-model="loginUser.password"
                                            id="password"
                                            type="password"
                                            class="validate loginInput browser-default"
                                        />
    
                                        <small class="right resetPass">
                                            <a href="/auth/resetpassword" class=""
                                                >Reset Password?</a
                                            >
                                        </small>
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
                                        </a>
                                    </div>
    
                                    <!-- Login Signup Link -->
                                    <div class="row">
                                        <div class="col l12 m12 s12 loginSignUpDiv">
                                            <div class="loginSignUpInnerDiv">
                                                <p class="loginSignUpTxt">
                                                    Don't have an account yet?
                                                </p>
                                                <p>
                                                    <a
                                                        href="https://whitecoatdomain.com/auth/getstarted"
                                                        class="loginSignUpLink"
                                                    >
                                                        Sign Up
                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div for="otpprompt" v-else-if="otpPrompt && !logginIn">
                            <OtpComponent @res="otpVerifier" :otp="otp" :type="'register'" :text="'You are logging in from a new device, we sent you an OTP to your registered email. Please enter OTP to verify your account'"/>
                        </div>
                        <div for="loggingIn" v-else-if="logginIn" class="centeredLoader">
                            <i class="fas fa-circle-notch fa-spin fa-2x"></i>
                            <p>Loggin You In</p>
                        </div>
                    </div>
                </div>
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
