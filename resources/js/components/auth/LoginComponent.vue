<template>
    <div>
        <div class="row authContainDiv">
            <div class="col s12 m12 l6 loginContainer hide-on-med-and-down">
                <div class="wlcNoteDiv">
                    <a href="/" class="wlcNoteLogo">PaaB</a>
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
                            <div class="row loginSocialMedDiv">
                                <div
                                    class="
                                        col
                                        l12
                                        m12
                                        s12
                                        loginSocialMedInnerDiv
                                    "
                                >
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
    </div>
</template>

<script>
    export default {
        data() {
            return {
                loginLoading: false,
                loginUser: {
                    email: "",
                    password: "",
                },
            };
        },
        mounted() {
        },
        methods: {
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
                                } else if (res.data.status == 501) {
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