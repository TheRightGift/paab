<template>
    <div>
        <div class="row authContainDiv" v-if="verifiedEmail == 1">
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
                        &copy; PaaB. {{getYear()}}. We support your brand!
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

                    <form>
                        <div class="row rm_mg">
                            <div class="input-field col s12">
                                <input
                                    placeholder="Email"
                                    id="user"
                                    type="email"
                                    v-model="userReg.email"
                                    required
                                />
                            </div>

                            <div class="input-field col s12">
                                <a class="btn getStartBtn" v-if="!verificationLoading" @click.prevent="submitEmailForVerificationOTP()">
                                    VERIFY
                                </a>
                                <a class="btn getStartBtn" v-else>
                                    <div class="preloader-wrapper small active">
                                        <div class="spinner-layer spinner-white-only">
                                            <div class="circle-clipper left">
                                                <div class="circle"></div>
                                            </div><div class="gap-patch">
                                                <div class="circle"></div>
                                            </div><div class="circle-clipper right">
                                                <div class="circle"></div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
        
                            <!-- Login Social Media Handle -->
                            <div class="row loginSocialMedDiv">
                                <div class="col s12 loginSocialMedInnerDiv">
                                    <div>
                                        <p class="loginSocialMedTxt">or login with</p>
            
                                        <div class="socialMedIconsDiv">
                                            <a href="#">
                                                <i class="fa-brands fa-square-instagram socialMedIcons"></i>
                                            </a>
                                            <a href="#">
                                                <i class="fa-brands fa-facebook socialMedIcons"></i>
                                            </a>
                                            <a href="#">
                                                <i class="fa-brands fa-twitter socialMedIcons"></i>
                                            </a>
                                        </div>
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

        <div class="row authContainDiv" v-if="verifiedEmail == 2">
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
                        &copy; PaaB. {{getYear()}}. We support your brand!
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
                            <form method="get" class="row digit-group" data-group-name="digits" data-autosubmit="false"
                                autocomplete="off">
                                <input type="text" v-on:keyup="processOtpFields($event, $event.target.value, 0)" class="input-field col s1 otpDigits" maxlength="1" data-next="digit-2" autofocus />
                                <input type="text" v-on:keyup="processOtpFields($event, $event.target.value, 1)" class="input-field col s1 otpDigits" maxlength="1" data-next="digit-3" data-previous="digit-1" />
                                <input type="text" v-on:keyup="processOtpFields($event, $event.target.value, 2)" class="input-field col s1 otpDigits" maxlength="1" data-next="digit-4" data-previous="digit-2" />
                                <input type="text" v-on:keyup="processOtpFields($event, $event.target.value, 3)" class="input-field col s1 otpDigits" maxlength="1" data-next="digit-5" data-previous="digit-3" />
                                <input type="text" v-on:keyup="processOtpFields($event, $event.target.value, 4)" class="input-field col s1 otpDigits" maxlength="1" data-next="digit-6" data-previous="digit-4" />
                                <input type="text" v-on:keyup="processOtpFields($event, $event.target.value, 5)" class="input-field col s1 otpDigits" maxlength="1" data-previous="digit-3" />
                            </form>
                        </div>
        
                        <button class="btn col s12" id="otpEmailBtn" @click="confirmOTP()" :disabled='isDisabled'>
                            VERIFY
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row authContainDiv" v-if="verifiedEmail == 3">
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
                        &copy; PaaB. {{getYear()}}. We support your brand!
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

                    <form id="reistrationForm">
                        <div class="row">
                            <div class="input-field col l2 s12 noPaddingLeft">
                                <input placeholder="Title" type="text" v-model="userReg.title" id="signupTitle"/>
                            </div>

                            <div class="input-field col l5 s12">
                                <input placeholder="Last Name" id="signupLname" type="text" v-model="userReg.lastname"/>
                            </div>

                            <div class="input-field col l5 s12">
                                <input placeholder="First Name" id="signupFName" type="text" v-model="userReg.firstname"/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col l12 m12 s12 noPaddingLeft">
                                <input
                                    placeholder="Email"
                                    id="signupEmail"
                                    type="email"
                                    v-model="userReg.email"
                                    readonly
                                />
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col l12 m12 s12 noPaddingLeft">
                                <input
                                    placeholder="Phone Number"
                                    id="signupPhone"
                                    type="Number"
                                    class="validate"
                                    v-model="userReg.phone"
                                />
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col l6 s12 noPaddingLeft">
                                <input
                                    placeholder="Country"
                                    id="signupCountry"
                                    type="text"
                                    class="validate"
                                    v-model="userReg.country"
                                />
                            </div>

                            <div class="input-field col l6 s12 noPaddingRight">
                                <select class="browser-default" id="signupGender" v-model="userReg.gender">
                                    <option value="" disabled selected>
                                        Gender
                                    </option>
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col l6 s12 noPaddingLeft">
                                <input
                                    placeholder="State"
                                    id="signupState"
                                    type="text"
                                    class="validate"
                                    v-model="userReg.state"
                                />
                            </div>

                            <div class="input-field col l6 s12">
                                <input
                                    placeholder="City"
                                    id="signupCity"
                                    type="text"
                                    class="validate"
                                    v-model="userReg.city"
                                />
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col l12 m12 s12 noPaddingLeft">
                                <input
                                    placeholder="Password"
                                    id="signupPass"
                                    type="password"
                                    class="validate"
                                    v-model="userReg.password"
                                />
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col l12 m12 s12 noPaddingLeft">
                                <input
                                    placeholder="Confirm Password"
                                    id="signCpass"
                                    type="password"
                                    class="validate"
                                    v-model="userReg.cPassword"
                                />
                            </div>
                        </div>

                        <div class="row">
                            <button class="btn col l12 m12 s12" v-if="!registrationLoading" type="button" id="signupBtn" @click="submitRegistrationForm()">
                                Sign Up
                            </button>
                            <a class="btn getStartBtn" v-else>
                                <div class="preloader-wrapper small active">
                                    <div class="spinner-layer spinner-white-only">
                                        <div class="circle-clipper left">
                                            <div class="circle"></div>
                                        </div><div class="gap-patch">
                                            <div class="circle"></div>
                                        </div><div class="circle-clipper right">
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
    import cryptoJs from 'crypto-js'
    import {Base64} from 'js-base64'
    const key = process.env.MIX_APP_KEY;
    export default {
        data() {
            return {
                verifiedEmail: 3,
                verificationLoading: false,
                registrationLoading: false,
                otp: '',
                userInputedOTP: '',
                key: key.substring(7),
                userReg: {
                    email: "goziechukwu@gmail.com",
                    title: "",
                    lastname: "",
                    firstname: "",
                    phone: "",
                    country: "",
                    gender: "",
                    state: "",
                    city: "",
                    password: "",
                    cPassword: "",
                },
            };
        },
        mounted() {

        },
        methods: {
            decryptOTP(otp){
                let cipher = JSON.parse(Base64.decode(otp));
                let decrypted = cryptoJs.AES.decrypt(cipher.value, cryptoJs.enc.Base64.parse(this.key), {
                    iv : cryptoJs.enc.Base64.parse(cipher.iv)
                });
                return decrypted.toString(cryptoJs.enc.Utf8);
            },
            updateVerifiedEmail(num){
                this.verifiedEmail = num;
            },
            getYear() {
                return new Date().getFullYear();
            },
            processOtpFields(e, char = null, index){
                if(char !== null && char !== ''){
                    this.userInputedOTP = [this.userInputedOTP.slice(0, index), char, this.userInputedOTP.slice(index)].join('')
                    
                    if(index !== 5){
                        e.target.nextElementSibling.focus();
                    }            
                } else if(char === ''){
                    this.userInputedOTP = this.userInputedOTP.slice(0, index) + this.userInputedOTP.slice(index + 1);
                }              
            },
            submitEmailForVerificationOTP(){
                if(this.userReg.email === ''){
                    M.toast({
                        html: 'Please input your emial.',
                        classes: "errorNotifier",
                    });
                } else {
                    this.verificationLoading = true;
                    let data = {
                        email: this.userReg.email
                    }
                    axios
                    .post("/verifyEmailForRegistration", data)
                    .then((res) => {
                        if(res.status === 200){
                            if(res.data.status == 200){
                                this.otp = res.data.otp;
                                this.updateVerifiedEmail(2);
                            } else if(res.data.status == 404){
                                M.toast({
                                    html: res.data.error,
                                    classes: "errorNotifier",
                                });
                            }
                            this.verificationLoading = false;
                        }
                        
                    })
                    .catch((err) => {
                        console.log(err.response);
                    });
                }
            },
            confirmOTP(){
                if(this.userInputedOTP.length !== 6){
                    M.toast({
                        html: 'OTP should be six characters.',
                        classes: "errorNotifier",
                    });
                } else {
                    if(this.decryptOTP(this.otp) === this.userInputedOTP){
                        // move to next state view
                        this.updateVerifiedEmail(3);
                    } else {
                        M.toast({
                            html: 'Invalid OTP.',
                            classes: "errorNotifier",
                        });

                        // reload page after 4secs
                        setTimeout(() => {
                            location.reload()
                        }, 4000);
                    }
                }
            },
            submitRegistrationForm(){
                if(!this.userReg.email || !this.userReg.firstname || !this.userReg.lastname || !this.userReg.phone || !this.userReg.country || !this.userReg.gender || !this.userReg.state || !this.userReg.city || !this.userReg.password || this.userReg.password !== this.userReg.cPassword){
                    M.toast({
                        html: 'Please fill every field in the registration form.',
                        classes: "errorNotifier",
                    });
                } else {
                    this.registrationLoading = true;
                    let data = {
                        email: this.userReg.email,
                        firstname: this.userReg.firstname,
                        lastname: this.userReg.lastname,
                        phone: this.userReg.phone,
                        // country: this.userReg.country,
                        gender: this.userReg.gender,
                        // state: this.userReg.state,
                        // city: this.userReg.city,
                        password: this.userReg.password,
                    }
                    axios
                    .post("/register", data)
                    .then((res) => {
                        if(res.status === 200){
                            if(res.data.status == 200){                                
                                window.location.href = '/auth/login';
                            } else if(res.data.status == 501){
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
            }
        },
        computed: {
            isDisabled: function(){
                return this.userInputedOTP.length !== 6;
            }
        }
    }
</script>
