<template>
    <div>
        <div class="row authContainDiv" v-if="verifiedEmail == 1">
            <div class="col s12 m12 l6 welcomeContainer white-text intro hide-on-med-and-down">
                
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
                            <h1 class="wlcNoteTitle">Continue your<br/>journey</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col l12">
                            <p class="wlcNoteTxt">
                                Life does not give you a reset button but with White
                        Coat Domain, we do *winks*
                            </p>
                        </div>                    
                    </div>
                </div>
                <p class="wlcNoteFooterTxt center-align">
                        <small>© {{ getYear() }} whitecoatdomain.com.</small>
                </p>
            </div>

            <div class="col s12 m10 offset-m1 l6 welcomeContainer formContainer">
                <VerifyEmailComponent @res="setOTP" :type="'reset'" />
            </div>
        </div>

        <div class="row authContainDiv" v-if="verifiedEmail == 2">
            <div class="col s12 m12 l6 otpContainer white-text intro hide-on-med-and-down">
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
                            <h1 class="wlcNoteTitle">We Appreciate <br/>Your Journey</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col l12">
                            <p class="wlcNoteTxt">
                                “Good things come to those who wait”.
                                <span class="getStartedOtpSpan right">Nathan Sykes</span>
                            </p>
                        </div>                    
                    </div>
                </div>
                <p class="wlcNoteFooterTxt center-align">
                        <small>© {{ getYear() }} whitecoatdomain.com.</small>
                </p>
            </div>

            <div class="col s12 m10 offset-m1 l6 otpContainer formContainer">
                <div class="authRightDiv">
                    <div class="authHeadingContainer center-align hide-on-large-only">
                        <!--a href="/" class="authHeading">WhiteCoatDomain</a-->
                        <div class="col m12 s6 offset-s3 marginBottom-5">
                            <a href="/">
                                <img
                                    src="/media/img/wcd-logo-noBckg.png"
                                    alt="WhiteCoatDomain Logo"
                                    class="responsive-img"
                                />
                            </a>
                        </div>
                    </div>
                    <OtpComponent
                        @res="otpVerifier"
                        :otp="otp"
                        :type="reset"
                        :email="user.email"
                    />
                </div>
            </div>
        </div>

        <div class="row authContainDiv" v-if="verifiedEmail == 3">
            <div class="col s12 m12 l6 welcomeContainer white-text intro hide-on-med-and-down">
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
                            <h1 class="wlcNoteTitle">Continue your<br/>journey</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col l12">
                            <p class="wlcNoteTxt">
                                The first step to stand out is by creating something
                        unique and extraordinary
                            </p>
                        </div>                    
                    </div>
                </div>
                <p class="wlcNoteFooterTxt center-align">
                        <small>© {{ getYear() }} whitecoatdomain.com.</small>
                </p>
            </div>

            <div class="col s12 m8 offset-m2 l6 welcomeContainer formContainer">
                <div class="authRightDiv">
                    <div class="authHeadingContainer center-align hide-on-large-only">
                        <!--a href="/" class="authHeading">WhiteCoatDomain</a-->
                        <div class="col m12 s6 offset-s3 marginBottom-5">
                            <a href="/">
                                <img
                                    src="/media/img/wcd-logo-noBckg.png"
                                    alt="WhiteCoatDomain Logo"
                                    class="responsive-img"
                                />
                            </a>
                        </div>
                    </div>
                    <p class="authTitle">RESET PASSWORD</p>
                    <p class="authTxt">
                        It is a long established fact that a reader will be diIt
                        is a long
                    </p>

                    <form id="reistrationForm">
                        <div class="row rm_mg">
                            <div
                                class="
                                    input-field
                                    col
                                    l12
                                    m12
                                    s12
                                "
                            >
                                <label>New Password</label>
                                <input
                                    placeholder="Password"
                                    type="password"
                                    class="validate loginInput browser-default"
                                    v-model="user.password"
                                />
                            </div>

                            <div
                                class="
                                    input-field
                                    col
                                    l12
                                    m12
                                    s12
                                "
                            >
                                <label>Confirm New Password</label>
                                <input
                                    placeholder="Confirm Password"
                                    type="password"
                                    class="validate loginInput browser-default"
                                    v-model="user.cPassword"
                                />
                            </div>

                            <div class="input-field col s12">
                                <!--button
                                    class="btn col l12 m12 s12"
                                    v-if="!resetLoading"
                                    type="button"
                                    id="signupBtn"
                                    @click="submitResetPasswordForm()"
                                >
                                    Reset
                                </button-->
                                <a
                                        type="button"
                                        v-if="!resetLoading"
                                        class="btn loginBtn"
                                        @click.prevent="submitResetPasswordForm()"
                                    >
                                        Reset
                                    </a>
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
            OtpComponent,
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
            setOTP(value) {
                if (value.status === 200) {
                    this.user.email = value.email;
                    this.updateVerifiedEmail(2);
                }
            },
            otpVerifier(value) {
                if (value === 200) {
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
