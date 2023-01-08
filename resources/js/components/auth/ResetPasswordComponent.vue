<template>
    <div>
        <div class="row authContainDiv" v-if="verifiedEmail == 1">
            <div class="col s12 m12 l6 welcomeContainer hide-on-med-and-down">
                <div class="wlcNoteDiv">
                    <a href="/" class="wlcNoteLogo">PaaB</a>
                    <p class="wlcNoteTitle">
                        Start your journey <br />with us...
                    </p>
                    <p class="wlcNoteTxt">
                        Life does not give you a reset button but with PAAB, we do *winks*
                    </p>
                    <p class="wlcNoteFooterTxt">
                        &copy; PaaB. {{ getYear() }}. We support your brand!
                    </p>
                </div>
            </div>

            <div class="col s12 m12 l6 welcomeContainer">
                <VerifyEmailComponent @res="setOTP" :type="'reset'"/>
            </div>
        </div>

        <div class="row authContainDiv" v-if="verifiedEmail == 2">
            <div class="col s12 m12 l6 otpContainer hide-on-med-and-down">
                <div class="wlcNoteDiv">
                    <a href="/" class="wlcNoteLogo">PaaB</a>
                    <p class="wlcNoteTitle">
                        Start your journey <br />with us...
                    </p>
                    <p class="wlcNoteTxt">
                        “ Good things come to those who wait”.
                        <span class="right">Nathan Sykes</span>
                    </p>
                    <p class="wlcNoteFooterTxt">
                        &copy; PaaB. {{ getYear() }}. We support your brand!
                    </p>
                </div>
            </div>

            <div class="col s12 m12 l6 otpContainer">
                <OtpComponent @res="otpVerifier" :otp="otp" :type="reset" :email="user.email"/>
            </div>
        </div>

        <div class="row authContainDiv" v-if="verifiedEmail == 3">
            <div class="col s12 m12 l6 regContainer hide-on-med-and-down">
                <div class="wlcNoteDiv">
                    <a href="/" class="wlcNoteLogo">PaaB</a>
                    <p class="wlcNoteTitle">
                        Start your journey <br />with us...
                    </p>
                    <p class="wlcNoteTxt">
                        The first step to stand out is by creating something unique and extraordinary
                    </p>
                    <p class="wlcNoteFooterTxt">
                        &copy; PaaB. {{ getYear() }}. We support your brand!
                    </p>
                </div>
            </div>

            <div class="col s12 m12 l6 regContainer">
                <div class="authRightDiv">
                    <p class="authTitle">RESET PASSWORD</p>
                    <p class="authTxt">
                        It is a long established fact that a reader will be diIt
                        is a long
                    </p>

                    <form id="reistrationForm">
                        <div class="row">
                            <div
                                class="
                                    input-field
                                    col
                                    l12
                                    m12
                                    s12
                                    noPaddingLeft
                                "
                            >
                                <input
                                    placeholder="Password"
                                    id="signupPass"
                                    type="password"
                                    class="validate"
                                    v-model="user.password"
                                />
                            </div>
                        </div>

                        <div class="row">
                            <div
                                class="
                                    input-field
                                    col
                                    l12
                                    m12
                                    s12
                                    noPaddingLeft
                                "
                            >
                                <input
                                    placeholder="Confirm Password"
                                    id="signCpass"
                                    type="password"
                                    class="validate"
                                    v-model="user.cPassword"
                                />
                            </div>
                        </div>

                        <div class="row">
                            <button
                                class="btn col l12 m12 s12"
                                v-if="!resetLoading"
                                type="button"
                                id="signupBtn"
                                @click="submitResetPasswordForm()"
                            >
                                Reset
                            </button>
                            <a class="btn getStartBtn" v-else>
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import VerifyEmailComponent from "../partials/VerifyEmailComponent";
    import OtpComponent from "../partials/OtpComponent";

    export default {
        components: {
            VerifyEmailComponent,
            OtpComponent
        },
        data() {
            return {
                reset: "reset",
                verifiedEmail: 1,
                resetLoading: false,
                otp: "",
                user: {
                    email: "",
                    password: "",
                    cPassword: "",
                },
            };
        },
        mounted() {},
        methods: {
            updateVerifiedEmail(num) {
                this.verifiedEmail = num;
            },
            getYear() {
                return new Date().getFullYear();
            },
            setOTP(value){
                if(value.status === 200){
                    this.user.email = value.email;
                    this.updateVerifiedEmail(2);
                }                
            },
            otpVerifier(value){
                if(value === 200){
                    this.updateVerifiedEmail(3);
                } else {
                    // use toast to notify
                    M.toast({
                        html: "Invalid OTP.",
                        classes: "errorNotifier",
                    });
                }
            },
            submitResetPasswordForm() {
                if (
                    !this.user.email ||
                    !this.user.password ||
                    this.user.password !== this.user.cPassword
                ) {
                    M.toast({
                        html: "Please enter matching passwords.",
                        classes: "errorNotifier",
                    });
                } else {
                    this.resetLoading = true;
                    let data = {
                        email: this.user.email,
                        password: this.user.password,
                    };
                    axios
                        .post("/auth/resetPassword", data)
                        .then((res) => {
                            if (res.status === 200) {
                                if (res.data.status == 200) {
                                    window.location.href = "/auth/login";
                                } else if (res.data.status == 501) {
                                    M.toast({
                                        html: res.data.error,
                                        classes: "errorNotifier",
                                    });
                                }
                                this.registrationLoading = false;
                            }
                        })
                        .catch((err) => {
                            console.log(`Error: ${err.response}`);
                        });
                }
            },
        },
        computed: {},
    };
</script>
