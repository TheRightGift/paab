<template>
    <div class="row authContainDiv">
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
                    The World is still listening , it is time to tell your
                    brand story with our professional , powerful and easy to
                    use portfolio builder for your career.
                </p>
                <p class="wlcNoteFooterTxt">
                    © White Coat Domain, Inc. {{ getYear() }}. We love our
                    users!
                </p>
            </div>
        </div>

        <div class="col s12 m12 l6 loginContainer">
            <div class="authRightDiv">
                <div class="authHeadingContainer center-align">
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
                    Please enter a valid combination of email and password
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
</template>

<script>
    import SocialLoginComponent from "../partials/SocialLoginComponent.vue";
    export default {
        components: { SocialLoginComponent },
        data() {
            return {
                loginLoading: false,
                loginUser: {
                    email: "",
                    password: "",
                },
            };
        },
        mounted() {},
        methods: {
            getYear() {
                return new Date().getFullYear();
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
                        })
                        .catch((err) => {
                            console.log(err.response);
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