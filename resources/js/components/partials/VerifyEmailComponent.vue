<template>
    <div class="authRightDiv">
        <h1 class="authTitle" v-if="type === 'register'">GET STARTED</h1>
        <h1 class="authTitle" v-if="type === 'reset'">Reset Password</h1>
        <p class="authTxt">            
            <span v-if="type === 'register'">Get a booster shot in your journey with a simple click. </span>
            <span v-if="type === 'reset'">No worries, reseting your password is easy. Just enter your email address.</span>
        </p>
        <form id="verifyEmail" class="marginTop-9">
            <div class="row">
                <div class="col s12">
                    <label>Enter your email address</label>
                    <input
                        placeholder="email address"
                        id="user"
                        type="email"
                        class=" browser-default"
                        v-model="email"
                        required
                    />                    
                </div>
            </div>
            <div class="row">
                <div class="row center marginTop-10">
                    <a href="#!" v-if="!verificationLoading" class="btn" @click.prevent="submitEmailForVerificationOTP()">Verify</a>
                    <a href="#!" v-else class="btn">
                        <i class="fa fa-spin fa-spinner"></i>
                    </a>
                </div>

                <!-- Login Signup Link -->
                <div class="center toSignUp marginTop-7">
                    <p>
                        <span class="grey-text">Have an account?</span> <a href="/auth/login">Sign in</a>
                    </p>
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
                        if (err.response.status === 422) {
                            M.toast({
                                html: err.response.data.errors.email,
                                classes: "errorNotifier",
                            });
                        }
                        this.verificationLoading = false;
                        console.log(err);
                    });
                }
            }
        },
        computed: {},
    };
</script>
<style scoped>
    .btn {
        background-color: var(--pri);
        text-transform: unset;
        padding: 2vh 5vw;
        border-radius: 2vh;
        height: unset;
        line-height: unset;
    }
    .row {
        margin-bottom: 5vh;
    }
    @media only screen and (min-width: 768px) and (max-width: 1023px) {
        .btn {
            padding: 1.5vh 15vw;
        }
    }
    @media only screen and (max-width: 767px) {
        .btn {
            padding: 1.5vh 20vw;
        }
    }
</style>