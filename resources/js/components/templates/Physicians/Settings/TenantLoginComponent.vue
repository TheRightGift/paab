<template>
    <div>
        <div class="row authContainDiv">
            <div class="col s12 m12 l6 loginContainer">
                <div class="wlcNoteDiv">
                    <p class="wlcNoteLogo">PaaB</p>
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
                            </div>

                            <!-- Login Social Media Handle -->
                            <!-- <div class="row loginSocialMedDiv">
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
                            </div> -->

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
        props: {
            loading: Boolean,
        },
        methods: {
            userLogin() {
                this.$emit("loginUser", this.loginUser);
            },
        },
    };
</script>