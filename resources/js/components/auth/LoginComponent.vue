<template>
    <div class="row authContainDiv">
        <div v-if="!otpPrompt && !logginIn">
            <div class="col s12 m12 l6 loginContainer hide-on-med-and-down">
                <div class="wlcNoteDiv">
                    <a href="/" class="wlcNoteLogo">
                        <img
                            src="/media/img/whiteCoatDomain1.png"
                            alt="whiteCoatDomain.png"
                            class="authLogo"
                        />
                    </a>
                    <p class="wlcNoteTitle">WELCOME BACK CHIEF!</p>
                    <p class="wlcNoteTxt">
                        The World is listening, it is time to tell your brand story with our professional, powerful and easy to use portfolio builder.
    
    
                    </p>
                    <p class="wlcNoteFooterTxt">
                        © White Coat Domain, Inc. {{ getYear() }}. We love our
                        users!
                    </p>
                </div>
            </div>
    
            <div class="col s12 m12 l6 loginContainer">
                <div class="authRightDiv">
                    <div class="authHeadingContainer center-align hide-on-large-only">
                        <a href="/" class="authHeading">WhiteCoatDomain</a>
                    </div>
                    <p class="authTitle">
                        LOGIN
                        <!-- Login Help Modal Trigger -->
                        <!--a class="modal-trigger" href="#helpModal">
                            <i class="material-icons helpIcon right">help</i>
                        </a-->
                    </p>
                    <p class="authTxt">
                        Build a brand online and let your potential patients find you.
                    </p>
    
                    <!-- Login Help Modal Structure -->
                    <div id="helpModal" class="modal">
                        <div class="modal-content">
                            <p>
                                <a
                                    href="#!"
                                    class="
                                        modal-close
                                        waves-effect waves-green
                                        btn-flat
                                        helpModalCloseBtn
                                    "
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
    
                                <small class="right resetPass">
                                    <a
                                        href="/auth/resetpassword"
                                        class="grey-text"
                                        >Reset Password?</a
                                    >
                                </small>
                            </div>
    
                            <!-- Login Social Media Handle -->
                            <!-- <social-login-component /> -->
    
                            <div class="input-field col s12">
                                <a
                                    type="button"
                                    v-if="!loginLoading"
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
    
                            <!-- Login Signup Link -->
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
                <a href="#" class="authHeading">WhiteCoatDomain</a>
            </div>
            <i class="fas fa-circle-notch fa-spin fa-2x"></i>
            <p>Loggin You In</p>
        </div>
    </div>
</template>

<script>
    import OtpComponent from '../partials/OtpComponent.vue';
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
                await axios.post("/auth/ante_login", data).then(res => {
                    if (res.status === 200) {
                        if (res.data.status == 200) {
                            //redirect to dashboard route
                            this.setCookie(
                                "_token",
                                res.data.access_token,
                                2
                            );
                            window.location.href = "/dashboard";
                        }
                        this.loginLoading = false;
                    }
                }).catch(error => {
                    console.error();
                })
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
                                if (res.data.message == 'Device changed') {
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
    .red-text {
        color: rgb(245, 126, 126);
        font-style: italic;
    }
</style>