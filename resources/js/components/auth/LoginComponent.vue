<template>
    <!--div class="row authContainDiv">
        <div v-if="!otpPrompt && !logginIn">
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

            <div class="col s12 m8 offset-m2 l6 loginContainer formContainer">
                <div class="authRightDiv">
                    <div class="authHeadingContainer center-align hide-on-large-only mb-0">
                        <div class="row ">
                            <div class="col m12 s6 offset-s3">
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
                    <p class="authTitle">Sign in</p>
                    <p class="authTxt">
                        Build a brand online and let your potential patients
                        find you.
                    </p>
                    
                    <div id="helpModal" class="modal">
                        <div class="modal-content">
                            <p>
                                <a
                                    href="#!"
                                    class="modal-close waves-effect waves-green btn-flat helpModalCloseBtn"
                                    >Go Back</a
                                >
                            </p>
                            <h5 class="helpModalTitle">How to login</h5>
                            <p class="helpModalTxts">
                                Saving you the stress of long logins, you can
                                access your profile by linking any of your
                                social media accounts like Facebook, Instagram
                                and Twitter.
                            </p>

                            <p class="helpModalTxts">
                                Presenting your best work is the final step in
                                your workflow. Join the world of leading
                                professionals . Share your professional brand
                                with the world.
                            </p>
                        </div>
                    </div>

                    <form id="loginForm">
                        <div class="row rm_mg">
                            <div class="input-field col s12">
                                <label>Email</label>
                                <input
                                    placeholder="Enter your email"
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
                                    placeholder="**********"
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

                            <div class="input-field col s12">
                                <a
                                    type="button"
                                    v-if="!loginLoading"
                                    class="btn loginBtn"
                                    @click.prevent="userLogin()"
                                >
                                    sign in
                                </a>
                                <a class="btn loginBtn" v-else>
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
                            
                            <div class="row">
                                <div class="col l12 m12 s12 loginSignUpDiv">
                                    <div class="loginSignUpInnerDiv">
                                        <p class="loginSignUpTxt">
                                            Don't have an account yet?
                                        </p>
                                        <p>
                                            <a
                                                href="/auth/getstarted"
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
            </div>
        </div>
        <div v-else-if="otpPrompt && !logginIn">
            <i class="fas fa-circle-notch fa-spin right fa-2x" v-if="logginIn"></i>
            <div class="col l6 otpContainer white-text intro hide-on-med-and-down">
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
                    <OtpComponent @res="otpVerifier" :otp="otp" :type="'register'" :text="'You are logging in from a new device, we sent you an OTP to your registered email. Please enter OTP to verify your account'"/>
                </div>
            </div>
        </div>
        <div v-else-if="logginIn" class="centeredLoader">
            <div class="authRightDiv">
                <div class="authHeadingContainer center-align hide-on-large-only">
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
                <i class="fas fa-circle-notch fa-spin fa-2x"></i>
                <p>Loggin You In</p>
            </div>
        </div>
    </div-->

    <div class="row">
        <div class="col l6 loginBackground hide-on-med-and-down">
            
            <img
                class="logo"
                src="/media/img/wcdlogoLG-noBG.png"
                alt="Whitecoatdomain Logo"
            />
        </div>
        <div class="col l6 m12 s12 loginDetail">
            <div class="loginDetailInner">
                <div v-if="!otpPrompt && !logginIn">
                    <div class="right-align hide-on-med-and-up">
                        <a href="/">
                            <img class="" src="/media/img/wcd-logo-noBckg.png" alt="Whitecoatdomain Logo"/>
                        </a>                    
                    </div>
                    
                    <p class="welcome">Welcome Back <span class="priTextColor">Doctor</span></p>
                    <h1>Sign in</h1>
                    <div class="row">
                        <div class="col l12 m12 s12">
                            <label for="email">Enter your email address</label>
                            <input placeholder="email address" type="email" class="browser-default">                    
                        </div>
                    </div>
                    <div class="row">
                        <div class="col l12 m12 s12">
                            <label for="password">Enter your password</label>
                            <input placeholder="password" type="password" class="browser-default">                    
                        </div>
                        <p class="forgotPass">
                            <a href="/auth/resetpassword">Forgot password</a>
                        </p>
                    </div>

                    <div class="row center">
                        <a href="#!" v-if="!loginLoading" class="btn" @click.prevent="userLogin()">Sign in</a>
                        <a href="#!" v-else class="btn">
                            <i class="fa fa-spin fa-spinner"></i>
                        </a>
                    </div>
                    <div class="center toSignUp">
                        <p>
                            <span class="grey-text">No Account?</span> <a href="/auth/getstarted">Sign up</a>
                        </p>
                    </div>
                </div>
                <div v-else-if="otpPrompt && !logginIn" class="otp">
                    <div class="right-align hide-on-med-and-up">
                        <a href="/">
                            <img class="" src="/media/img/wcd-logo-noBckg.png" alt="Whitecoatdomain Logo"/>
                        </a>                    
                    </div>
                    <h1>Enter OTP</h1>
                    <div class="row">
                        <div class="col l12 m12 s12">
                            <OtpComponent @res="otpVerifier" :otp="otp" :type="'register'" :text="'You are logging in from a new device, we sent you an OTP to your registered email. Please enter OTP to verify your account'"/>              
                        </div>
                        
                    </div>
                </div>
                <div v-else-if="logginIn">
                    <div class="row loginLoader noMarginBottom">
                        <i class="fas fa-circle-notch fa-spin fa-2x"></i>
                        <p>Loggin You In</p>
                    </div>
                </div>
                
            </div>

            <p class="white-text center footer">Copyright &copy; {{ getYear() }} whitecoatdomain </p>
        </div>
    </div>
</template>

<script>
    import OtpComponent from "../partials/OtpComponent.vue";
    import SocialLoginComponent from "../partials/SocialLoginComponent.vue";
    export default {
        components: { SocialLoginComponent, OtpComponent },
        data() {
            return {
                errors: {},
                logginIn: false,
                loginLoading: false,
                loginUser: {
                    email: "",
                    password: "",
                },
                otp: "",
                otpPrompt: false,
            };
        },
        mounted() {},
        methods: {
            getYear() {
                return new Date().getFullYear();
            },
            otpVerifier(val) {
                if (val === 200) {
                    this.anteLogin();
                }
            },
            async anteLogin() {
                this.logginIn = !this.logginIn;
                let data = {
                    email: this.loginUser.email,
                    password: this.loginUser.password,
                };
                await axios
                    .post("/auth/ante_login", data)
                    .then((res) => {
                        if (res.status === 200) {
                            if (res.data.status == 200) {
                                //redirect to dashboard route
                                this.setCookie("_token", res.data.access_token, 2);
                                window.location.href = "/dashboard";
                            }
                            this.loginLoading = false;
                        }
                    })
                    .catch((error) => {
                        console.error();
                    });
            },
            userLogin() {
                if (this.loginUser.email === "" || this.loginUser.password === "") {
                    M.toast({
                        html: "Invalid Email/Password.",
                        classes: "errorNotifier",
                    });
                } else {
                    this.loginLoading = true;
                    let data = {
                        email: this.loginUser.email,
                        password: this.loginUser.password,
                    };
                    axios
                        .post("/auth/login", data)
                        .then((res) => {
                            if (res.status === 200) {
                                if (res.data.status == 200) {
                                    //redirect to dashboard route
                                    this.setCookie(
                                        "_token",
                                        res.data.access_token,
                                        2
                                    );
                                    window.location.href = "/dashboard";
                                } else if (res.data.status == 404) {
                                    M.toast({
                                        html: res.data.error,
                                        classes: "errorNotifier",
                                    });
                                }
                                this.loginLoading = false;
                            }
                            if (res.data.status === 422) {
                                if (res.data.message == "Device changed") {
                                    this.otpPrompt = true;
                                    this.otp = res.data.otp;
                                }
                            }
                        })
                        .catch((err) => {
                            console.log(err);
                            this.loginLoading = false;
                            if (err.response.status === 422) {
                                this.errors = err.response.data.errors;
                            }
                        });
                }
            },
            setCookie(cname, cvalue, exdays) {
                const d = new Date();
                d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
                let expires = "expires=" + d.toUTCString();
                document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
            },
        },
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
    .footer {
        margin-top: 4vh;
    }

    .loginLoader {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 70vh;
    }

    @media only screen and (max-width: 767px) {
        .btn {
            padding: 1.5vh 20vw;
        }
    }
</style>