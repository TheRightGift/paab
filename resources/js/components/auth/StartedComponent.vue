<template>
    <div>
        <div class="row authContainDiv" v-if="state.verifiedEmail == 1">
            <div class="col s12 m12 l6 welcomeContainer">
                <div class="wlcNoteDiv">
                    <p class="wlcNoteLogo">PaaB</p>
                    <p class="wlcNoteTitle">
                        Start your journey <br />with us...
                    </p>
                    <p class="wlcNoteTxt">
                        It is a long established fact that a reader will be
                        distracted by the readable content.
                    </p>
                    <p class="wlcNoteFooterTxt">
                        &copy; PaaB. 2022. We support your brand!
                    </p>
                </div>
            </div>

            <div class="col s12 m12 l6 welcomeContainer">
                <div>
                    <p class="authTitle">GET STARTED</p>
                    <p class="authTxt">
                        It is a long established fact that a reader will be diIt
                        is a long
                    </p>

                    <form @submit.prevent="submitEmail">
                        <div class="row rm_mg">
                            <div class="input-field col s12">
                                <input
                                    placeholder="Email"
                                    id="user"
                                    type="email"
                                    v-model="state.email"
                                    required
                                />
                            </div>

                            <button
                                class="btn col s12"
                                type="submit"
                                id="getStartBtn"
                                :disabled="state.submitting"
                            >
                                <span v-if="!state.submitting">VERIFY</span>
                                <div
                                    v-else
                                    class="preloader-wrapper small active"
                                >
                                    <div class="spinner-layer">
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
                            </button>

                            <!-- Login Social Media Handle -->
                            <div class="row loginSocialMedDiv">
                                <div
                                    class="
                                        col
                                        s7
                                        m7
                                        l7
                                        offset-s5 offset-m5 offset-l5
                                        loginSocialMedInnerDiv
                                    "
                                >
                                    <p class="loginSocialMedTxt">
                                        or login with
                                    </p>

                                    <div class="socialMedIconsDiv">
                                        <a href="#">
                                            <i
                                                class="
                                                    fa-brands
                                                    fa-square-instagram
                                                    socialMedIcons
                                                "
                                            ></i>
                                        </a>
                                        <a href="#">
                                            <i
                                                class="
                                                    fa-brands fa-facebook
                                                    socialMedIcons
                                                "
                                            ></i>
                                        </a>
                                        <a href="#">
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
                                        Don't have an account yet?
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
            </div>
        </div>

        <div class="row authContainDiv" v-if="state.verifiedEmail == 2">
            <div class="col s12 m12 l6 otpContainer">
                <div class="wlcNoteDiv">
                    <p class="wlcNoteLogo">PaaB</p>
                    <p class="wlcNoteTitle">
                        Start your journey <br />with us...
                    </p>
                    <p class="wlcNoteTxt">
                        It is a long established fact that a reader will be
                        distracted by the readable content.
                    </p>
                    <p class="wlcNoteFooterTxt">
                        © Photo, Inc. {{ getYear() }}. We love our users!
                    </p>
                </div>
            </div>

            <div class="col s12 m12 l6 otpContainer">
                <div class="authRightDiv">
                    <p class="authTitle">INSERT OTP</p>
                    <p class="otpEmailAuthTxt">
                        It is a long established fact that a reader will be diIt
                        is a long
                    </p>

                    <div class="row rm_mg">
                        <div class="col s12" id="otpEmailDiv">
                            <form
                                method="get"
                                class="row digit-group"
                                data-group-name="digits"
                                data-autosubmit="false"
                                autocomplete="off"
                            >
                                <otp :digitCount="6" @update:otp="otpValue = $event"/>
                            </form>
                        </div>
                        <button
                            class="btn col s12"
                            type="button"
                            id="otpEmailBtn"
                            :disabled="(otpValue.length < 6)"
                            @click.prevent="verifyOTP"
                        >
                            VERIFY
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row authContainDiv" v-if="state.verifiedEmail == 3">
            <div class="col s12 m12 l6 regContainer">
                <div class="wlcNoteDiv">
                    <p class="wlcNoteLogo">PaaB</p>
                    <p class="wlcNoteTitle">
                        Start your journey <br />with us...
                    </p>
                    <p class="wlcNoteTxt">
                        It is a long established fact that a reader will be
                        distracted by the readable content.
                    </p>
                    <p class="wlcNoteFooterTxt">
                        © Photo, Inc. 2019. We love our users!
                    </p>
                </div>
            </div>

            <div class="col s12 m12 l6 regContainer">
                <div class="authRightDiv">
                    <p class="authTitle">SIGN UP</p>
                    <p class="authTxt">
                        It is a long established fact that a reader will be diIt
                        is a long
                    </p>

                    <form>
                        <div class="row rm_mg">
                            <div class="row rm_mg">
                                <div class="input-field col s2 rm_mg sm_mg">
                                    <input
                                        placeholder="Title"
                                        type="text"
                                        class="validate"
                                        id="signupTitle"
                                    />
                                </div>

                                <div
                                    class="
                                        input-field
                                        col
                                        s4
                                        offset-s1
                                        rm_mg
                                        sm_mg
                                    "
                                >
                                    <input
                                        placeholder="Last Name"
                                        id="signupLname"
                                        type="text"
                                        class="validate"
                                    />
                                </div>

                                <div
                                    class="
                                        input-field
                                        col
                                        s4
                                        offset-s1
                                        rm_mg
                                        sm_mg
                                    "
                                >
                                    <input
                                        placeholder="First Name"
                                        id="signupFName"
                                        type="text"
                                        class="validate"
                                    />
                                </div>
                            </div>

                            <div class="row rm_mg">
                                <div class="input-field col s12 rm_mg sm_mg">
                                    <input
                                        placeholder="Email"
                                        id="signupEmail"
                                        type="email"
                                        class="validate"
                                    />
                                </div>
                            </div>

                            <div class="row rm_mg">
                                <div class="input-field col s12 rm_mg sm_mg">
                                    <input
                                        placeholder="Phone Number"
                                        id="signupPhone"
                                        type="Number"
                                        class="validate"
                                    />
                                </div>
                            </div>

                            <div class="row rm_mg">
                                <div class="input-field col s6 rm_mg sm_mg">
                                    <input
                                        placeholder="Country"
                                        id="signupCountry"
                                        type="text"
                                        class="validate"
                                    />
                                </div>

                                <div class="input-field col s6 rm_mg sm_mg">
                                    <select
                                        class="browser-default"
                                        id="signupGender"
                                    >
                                        <option value="" disabled selected>
                                            Gender
                                        </option>
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row rm_mg">
                                <div class="input-field col s6 rm_mg sm_mg">
                                    <input
                                        placeholder="State"
                                        id="signupState"
                                        type="text"
                                        class="validate"
                                    />
                                </div>

                                <div class="input-field col s6 rm_mg sm_mg">
                                    <input
                                        placeholder="City"
                                        id="signupCity"
                                        type="text"
                                        class="validate"
                                    />
                                </div>
                            </div>

                            <div class="row rm_mg">
                                <div class="input-field col s12 rm_mg sm_mg">
                                    <input
                                        placeholder="Password"
                                        id="signupPass"
                                        type="password"
                                        class="validate"
                                    />
                                </div>
                            </div>

                            <div class="row rm_mg">
                                <div class="input-field col s12 rm_mg sm_mg">
                                    <input
                                        placeholder="Confirm Password"
                                        id="signCpass"
                                        type="password"
                                        class="validate"
                                    />
                                </div>
                            </div>

                            <button
                                class="btn col s12 rm_mg sm_mg"
                                type="button"
                                id="signupBtn"
                            >
                                Sign Up
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import { ref, reactive } from "vue";
    import otp from "../OtpComponent.vue";
    import cryptoJs from 'crypto-js'
    import {Base64} from 'js-base64'
    export default {
        setup() {
            const otpValue = ref("");
            let key = process.env.MIX_APP_KEY;
            key = key.substring(7); //Removes the base64:
            const state = reactive({
                email: "",
                submitting: false,
                verifiedEmail: 1,
                cryptedOTP: "",
            });
            const decryptOTP = (otp) => {
                let e = JSON.parse(Base64.decode(otp));
                let decrypted = cryptoJs.AES.decrypt(e.value, cryptoJs.enc.Base64.parse(key), {
                    iv : cryptoJs.enc.Base64.parse(e.iv)
                });
                return decrypted.toString(cryptoJs.enc.Utf8);
            };
            const updateVerifiedEmail = (num) => {
                state.verifiedEmail = num;
            };
            const updateSubmitting = (bool) => {
                state.submitting = bool;
            };
            const submitEmail = () => {
                updateSubmitting(true);
                let data = {
                    email: state.email,
                };
                axios
                    .post("/verifyEmailForRegistration", data)
                    .then((res) => {
                        if (res.status === 200) {
                            if (res.data.status == 200) {
                                state.cryptedOTP = res.data.otp;
                                updateSubmitting(false);
                                updateVerifiedEmail(2);
                            }
                        }
                    })
                    .catch((err) => {
                        console.log(err.response);
                    });
            };
            const getYear = () => {
                return new Date().getFullYear();
            };
            const verifyOTP = () => {
                // Gets the cryptedOTp and run the decrypt function on it and compare then proceed if ok
                if (otpValue.value != "" && otpValue.value.length == 6) {
                    if (otpValue.value === decryptOTP(state.cryptedOTP)) {
                        updateVerifiedEmail(3);
                    }
                    else {
                        M.toast({html: 'Inavlid OTP!', classes: 'error'})
                    }
                }
            };
            return {
                state,
                updateVerifiedEmail,
                getYear,
                submitEmail,
                updateSubmitting,
                otpValue,
                key,
                decryptOTP,
                verifyOTP,
            };
        },

        components: {
            otp,
        },
    };
</script>
<style scoped>
    .spinner-layer {
        border-color: rgb(56, 54, 54);
    }
</style>
