<template>
    <div class="authRightDiv">
        <div class="authHeadingContainer center-align hide-on-large-only">
            <div class="row">
                <div class="col l12 m8 offset-m2 s6 offset-s3 marginBottom-5">
                    <a href="/">
                        <img
                            src="/media/img/wcd-logo-noBckg.png"
                            alt="WhiteCoatDomain Logo"
                            class="responsive-img"
                        />
                    </a>
                </div>
            </div>
        </div>
        <p class="authTitle" v-if="type === 'register'">GET STARTED</p>
        <p class="authTitle" v-if="type === 'reset'">Reset Password</p>
        <p class="authTxt">            
            <span v-if="type === 'register'">Get a booster shot in your journey with a simple click. </span>
            <span v-if="type === 'reset'">No worries, reseting your password is easy. Just enter your email address.</span>
        </p>
        <form id="loginForm">
            <div class="row rm_mg">
                <div class="input-field col s12">
                    <label>Email</label>
                    <input
                        placeholder="Email"
                        id="user"
                        type="email"
                        class="center-align loginInput browser-default"
                        v-model="email"
                        required
                    />
                    
                </div>

                <div class="input-field col s12">
                    <a
                        type="button"
                        v-if="!verificationLoading"
                        class="btn loginBtn"
                        @click.prevent="submitEmailForVerificationOTP()"
                    >
                        sign up
                    </a>
                    <a class="btn loginBtn" v-else>
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

                <!-- Login Signup Link -->
                <div class="row">
                    <div class="col l12 m12 s12 loginSignUpDiv">
                        <div class="loginSignUpInnerDiv">
                            <p class="loginSignUpTxt">
                                Have an account?
                            </p>
                            <p>
                                <a
                                    href="/auth/login"
                                    class="loginSignUpLink"
                                >
                                    Sign in
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
import SocialLoginComponent from './SocialLoginComponent.vue';
    export default {
    components: { SocialLoginComponent },
        data() {
            return {
                verificationLoading: false,
                email: "",
            };
        },
        props: {
            type: String
        },
        mounted() {},
        methods: {
            submitEmailForVerificationOTP() {
                if (this.email === "") {
                    M.toast({
                        html: "Please input your emial.",
                        classes: "errorNotifier",
                    });
                } else {
                    this.verificationLoading = true;
                    let data = {
                        email: this.email,
                    };
                    let url = '';

                    if(this.type === 'reset'){
                        // sendOtpForUserResetPassword
                        url = "/auth/sendOtpForUserResetPassword";
                    } else if(this.type === 'register'){
                        url = "/auth/verifyEmailForRegistration";
                    }

                    axios
                    .post(url, data)
                    .then((res) => {
                        if (res.status === 200) {
                            if (res.data.status == 200) {
                                if(this.type === 'reset'){
                                    // Pass response to parent ;
                                    this.$emit('res', {email: this.email, status: 200});
                                } else if(this.type === 'register'){
                                    // Pass OTP to parent ;
                                    let resData = {
                                        otp: res.data.otp,
                                        email: this.email
                                    }
                                    this.$emit('resData', resData);
                                }
                            } else if (res.data.status == 404) {
                                M.toast({
                                    html: res.data.error,
                                    classes: "errorNotifier",
                                });
                            }
                            this.verificationLoading = false;
                        }
                    })
                    .catch((err) => {
                        console.log(err.response);
                    });
                }
            }
        },
        computed: {},
    };
</script>
<style scoped>
.input-field.col.s12{
    padding : 0;
}
</style>