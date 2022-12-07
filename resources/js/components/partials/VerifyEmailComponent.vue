<template>
    <div>
        <p class="authTitle" v-if="type === 'register'">GET STARTED</p>
        <p class="authTitle" v-if="type === 'reset'">RESET PASSWORD</p>
        <p class="authTxt">
            It is a long established fact that a reader will be diIt
            is a long
        </p>

        <form id="regEmailVerifier">
            <div class="row rm_mg">
                <div class="input-field col s12">
                    <input
                        placeholder="Email"
                        id="user"
                        class="center-align"
                        type="email"
                        v-model="email"
                        required
                    />
                </div>

                <div class="input-field col s12">
                    <a
                        class="btn getStartBtn"
                        v-if="!verificationLoading"
                        @click.prevent="
                            submitEmailForVerificationOTP()
                        "
                    >
                        VERIFY
                    </a>
                    <a class="btn getStartBtn" v-else>
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

                <!-- Login Social Media Handle -->
                <div class="row loginSocialMedDiv" v-if="type === 'register'">
                    <div class="col s12 loginSocialMedInnerDiv">
                        <div>
                            <p class="loginSocialMedTxt">
                                or login with
                            </p>

                            <div class="socialMedIconsDiv">
                                <a href="/auth/login/linkedin">
                                    <i
                                        class="
                                            fa-brands
                                            fa-square-instagram
                                            socialMedIcons
                                        "
                                    ></i>
                                </a>
                                <a href="/auth/login/facebook">
                                    <i
                                        class="
                                            fa-brands fa-facebook
                                            socialMedIcons
                                        "
                                    ></i>
                                </a>
                                <a href="/auth/login/twitter">
                                    <i
                                        class="
                                            fa-brands fa-twitter
                                            socialMedIcons
                                        "
                                    ></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Login Signup Link -->
                <div class="row">
                    <div
                        class="
                            col
                            s12
                            m12
                            l12
                            loginSignUpDiv
                            center-align
                        "
                    >
                        <span class="loginSignUpTxt">
                            Have an account?
                        </span>
                        <a
                            href="/auth/login"
                            class="loginSignUpLink"
                        >
                            Sign in
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
    export default {
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
