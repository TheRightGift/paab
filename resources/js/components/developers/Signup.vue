<template>
    <div class="row">
        <div
            class="col l6 loginContainer white-text intro hide-on-med-and-down"
        >
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
                            Start your journey <br />with us...
                        </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col l12">
                        <p class="wlcNoteTxt">
                            “Good things come to those who wait”.
                            <span class="getStartedOtpSpan right"
                                >Nathan Sykes</span
                            >
                        </p>
                    </div>
                </div>
            </div>
            <p class="wlcNoteFooterTxt center-align">
                <small>© {{ getYear() }} whitecoatdomain.com.</small>
            </p>
        </div>

        <div class="col s12 m10 offset-m1 l6 loginContainer formContainer">
            <div class="authRightDiv">
                <div for="signup" v-if="verifiedEmail == 1">
                    <VerifyEmailComponent
                        @resData="setOTP"
                        :type="'register'"
                    />
                </div>

                <div for="otpComponent" v-if="verifiedEmail === 2">
                    <OtpComponent
                        @res="otpVerifier"
                        :otp="otp"
                        :type="'register'"
                    />
                </div>

                <div v-if="verifiedEmail === 3" for="afterVerifyingEmail">
                    <div class="flex">
                        <img width="150" height="50" src="/media/img/wcdlogodeepblue.webp" class="responsive-img hide-on-med-and-up" />
                    </div>
                    <h5 class="center-align">Continue to complete registration</h5>
                    <form @submit.prevent="createDev" id="reistrationForm">
                        <div class="row">
                            <div class="input-field col l12 s12">
                                <input
                                    placeholder="Last Name"
                                    id="signupLname"
                                    type="text"
                                    v-model="userReg.lastname"
                                    required
                                />
                            </div>

                            <div class="input-field col l12 s12">
                                <input
                                    placeholder="First Name"
                                    id="signupFName"
                                    type="text"
                                    v-model="userReg.firstname"
                                    required
                                />
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col l12 m12 s12">
                                <input
                                    placeholder="Email"
                                    id="signupEmail"
                                    type="email"
                                    v-model="userReg.email"
                                    autocomplete="false"
                                    required
                                    readonly
                                />
                            </div>
                        </div>

                        <div class="row">
                            <div
                                class="input-field col l12 m12 s12"
                            >
                                <input
                                    placeholder="Phone Number"
                                    id="signupPhone"
                                    type="tel"
                                    class="validate"
                                    v-model="userReg.phone"
                                    required
                                />
                            </div>
                        </div>
                        <div class="input-field col l12 s12">
                                <select
                                    class="browser-default"
                                    id="signupGender"
                                    v-model="userReg.gender"
                                    required
                                >
                                    <option value="" disabled selected>
                                        Gender
                                    </option>
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                </select>
                            </div>
                        <div class="row">
                            <div
                                class="
                                    input-field
                                    col
                                    l12
                                    m12
                                    s12
                                "
                            >
                                <input
                                    placeholder="Password"
                                    id="signupPass"
                                    type="password"
                                    class="validate"
                                    v-model="userReg.password"
                                    autocomplete="false"
                                    required
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
                                "
                            >
                                <input
                                    placeholder="Confirm Password"
                                    id="signCpass"
                                    type="password"
                                    class="validate"
                                    v-model="userReg.cPassword"
                                    required
                                    autocomplete="false"
                                />
                            </div>
                        </div>

                        <div class="row">
                            <button
                                class="btn col l12 m12 s12"
                                v-if="!registrationLoading"
                                type="submit"
                                id="signupBtn"
                            >
                                Sign Up
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
            OtpComponent,
        },
        data() {
            return {
                otp: "",
                registrationLoading: false,
                password: "",
                userReg: {
                    email: "",
                    lastname: "",
                    firstname: "",
                    phone: "",
                    gender: "",
                    password: "",
                    cPassword: "",
                    profession: "",
                },
                verifying: false,
                verifiedEmail: 1,
            };
        },
        mounted() {},
        methods: {
            getYear() {
                return new Date().getFullYear();
            },
            otpVerifier(value) {
                if (value === 200) {
                    this.updateVerifiedEmail(3);
                    this.saveMailAndCreateUser();
                }
            },
            setOTP(value) {
                this.otp = value.otp;
                this.userReg.email = value.email;
                this.updateVerifiedEmail(2);
            },
            updateVerifiedEmail(num) {
                this.verifiedEmail = num;
            },
            createDev() {
                if (
                    !this.userReg.email ||
                    !this.userReg.firstname ||
                    !this.userReg.lastname ||
                    !this.userReg.phone ||
                    !this.userReg.gender ||
                    !this.userReg.password ||
                    this.userReg.password !== this.userReg.cPassword
                ) {
                    M.toast({
                        html: "Please fill every field in the registration form.",
                        classes: "errorNotifier",
                    });
                } else {
                    this.registrationLoading = true;
                    let data = {
                        email: this.userReg.email,
                        firstname: this.userReg.firstname,
                        lastname: this.userReg.lastname,
                        phone: this.userReg.phone,
                        gender: this.userReg.gender,
                        password: this.userReg.password,
                        role: 'Developer'
                    };
                    axios
                        .post("/auth/register", data)
                        .then((res) => {
                            if (res.status === 200) {
                                if (res.data.status == 200) {
                                    M.toast({html: 'Registration Completed, Pending Admin Verification', classes: 'successNotifier', outDuration: 10000});
                                    setTimeout(() => {
                                        window.location.href = '/';
                                    }, 6000);
                                    // Backend send email of registration complete and pending verification by admin, send a message to
                                    // gozie@whitecoatdomain.com that a developer is pending verification.
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
    };
</script>
<style scoped>
    input::placeholder {
        font-weight: 600;
        font-family: Roboto, sans-serif;
    }
    .flex {
        display: flex;
        justify-content: center;
    }
    #cover-spin {
        position: fixed;
        width: 100%;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        background-color: rgba(255, 255, 255, 0.7);
        z-index: 9999;
    }

    @-webkit-keyframes spin {
        from {
            -webkit-transform: rotate(0deg);
        }
        to {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
        }
    }

    #cover-spin::after {
        content: "";
        display: block;
        position: absolute;
        left: 48%;
        top: 40%;
        width: 40px;
        height: 40px;
        border-style: solid;
        border-color: black;
        border-top-color: transparent;
        border-width: 4px;
        border-radius: 50%;
        -webkit-animation: spin 0.8s linear infinite;
        animation: spin 0.8s linear infinite;
    }
</style>
