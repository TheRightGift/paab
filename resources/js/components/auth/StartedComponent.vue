<template>
    <div>
        <div class="row authContainDiv" v-if="verifiedEmail == 1">
            <div class="col s12 m12 l6 welcomeContainer">
                <div class="wlcNoteDiv">
                    <p class="wlcNoteLogo">PaaB</p>
                    <p class="wlcNoteTitle">Start your journey <br />with us...</p>
                    <p class="wlcNoteTxt">
                        It is a long established fact that a reader will be distracted
                        by the readable content.
                    </p>
                    <p class="wlcNoteFooterTxt">&copy; PaaB. 2022. We support your brand!</p>
                </div>
            </div>
        
            <div class="col s12 m12 l6 welcomeContainer">
                <div>
                    <p class="authTitle">GET STARTED</p>
                    <p class="authTxt">
                        It is a long established fact that a reader will be diIt is a long
                    </p>
        
                    <form>
                        <div class="row rm_mg">
                            <div class="input-field col s12">
                                <input placeholder="Email" id="user" type="email" v-model="email">
                            </div>
        
                            <button class="btn col s12" type="button" id="getStartBtn" @click="submitEmail()">
                                VERIFY
                            </button>
        
                            <!-- Login Social Media Handle -->
                            <div class="row loginSocialMedDiv">
                                <div class="col s7 m7 l7 offset-s5 offset-m5 offset-l5 loginSocialMedInnerDiv">
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
        
                            <!-- Login Signup Link -->
                            <div class="row">
                                <div class="col s12 m12 l12 loginSignUpDiv center-align">
                                    <span class="loginSignUpTxt">
                                        Don't have an account yet?
                                    </span>
                                    <a href="/auth/login" class="loginSignUpLink">
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
                    <p class="wlcNoteTitle">Start your journey <br />with us...</p>
                    <p class="wlcNoteTxt">
                        It is a long established fact that a reader will be distracted
                        by the readable content.
                    </p>
                    <p class="wlcNoteFooterTxt">© Photo, Inc. 2019. We love our users!</p>
                </div>
            </div>
        
            <div class="col s12 m12 l6 otpContainer">
                <div class="authRightDiv">
                    <p class="authTitle">INSERT OTP</p>
                    <p class="otpEmailAuthTxt">
                        It is a long established fact that a reader will be diIt is a long
                    </p>
        
                    <div class="row rm_mg">
        
                        <div class="col s12" id="otpEmailDiv">
                            <form method="get" class="row digit-group" data-group-name="digits" data-autosubmit="false"
                                autocomplete="off">
                                <input type="text" class="input-field col s1 otpDigits" id="digit-1" data-next="digit-2" />
                                <input type="text" class="input-field col s1 otpDigits" id="digit-2" data-next="digit-3"
                                    data-previous="digit-1" />
                                <input type="text" class="input-field col s1 otpDigits" id="digit-3" data-next="digit-4"
                                    data-previous="digit-2" />
                                <input type="text" class="input-field col s1 otpDigits" id="digit-4" data-previous="digit-3" />
                            </form>
                        </div>
        
                        <button class="btn col s12" type="button" id="otpEmailBtn" disabled>
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
                    <p class="wlcNoteTitle">Start your journey <br />with us...</p>
                    <p class="wlcNoteTxt">
                        It is a long established fact that a reader will be distracted
                        by the readable content.
                    </p>
                    <p class="wlcNoteFooterTxt">© Photo, Inc. 2019. We love our users!</p>
                </div>
            </div>
        
            <div class="col s12 m12 l6 regContainer">
                <div class="authRightDiv">
                    <p class="authTitle">SIGN UP</p>
                    <p class="authTxt">
                        It is a long established fact that a reader will be diIt is a long
                    </p>
        
                    <form>
                        <div class="row rm_mg">
                            <div class="row rm_mg">
                                <div class="input-field col s2 rm_mg sm_mg">
                                    <input placeholder="Title" type="text" class="validate" id="signupTitle">
                                </div>
        
                                <div class="input-field col s4 offset-s1 rm_mg sm_mg">
                                    <input placeholder="Last Name" id="signupLname" type="text" class="validate">
                                </div>
        
                                <div class="input-field col s4 offset-s1 rm_mg sm_mg">
                                    <input placeholder="First Name" id="signupFName" type="text" class="validate">
                                </div>
                            </div>
        
                            <div class="row rm_mg">
                                <div class="input-field col s12 rm_mg sm_mg">
                                    <input placeholder="Email" id="signupEmail" type="email" class="validate">
                                </div>
                            </div>
        
                            <div class="row rm_mg">
                                <div class="input-field col s12 rm_mg sm_mg">
                                    <input placeholder="Phone Number" id="signupPhone" type="Number" class="validate">
                                </div>
                            </div>
        
                            <div class="row rm_mg">
                                <div class="input-field col s6 rm_mg sm_mg">
                                    <input placeholder="Country" id="signupCountry" type="text" class="validate">
                                </div>
        
                                <div class="input-field col s6 rm_mg sm_mg">
                                    <select class="browser-default" id="signupGender">
                                        <option value="" disabled selected>Gender</option>
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                    </select>
                                </div>
                            </div>
        
                            <div class="row rm_mg">
                                <div class="input-field col s6 rm_mg sm_mg">
                                    <input placeholder="State" id="signupState" type="text" class="validate">
                                </div>
        
                                <div class="input-field col s6 rm_mg sm_mg">
                                    <input placeholder="City" id="signupCity" type="text" class="validate">
                                </div>
                            </div>
        
                            <div class="row rm_mg">
                                <div class="input-field col s12 rm_mg sm_mg">
                                    <input placeholder="Password" id="signupPass" type="password" class="validate">
                                </div>
                            </div>
        
                            <div class="row rm_mg">
                                <div class="input-field col s12 rm_mg sm_mg">
                                    <input placeholder="Confirm Password" id="signCpass" type="password" class="validate">
                                </div>
                            </div>
        
                            <button class="btn col s12 rm_mg sm_mg" type="button" id="signupBtn">
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
    export default {
       data() {
            return {
                verifiedEmail: 1
            };
        },
        mounted() {             
        },
        methods: {
            updateVerifiedEmail(num){
                this.verifiedEmail = num;
            },
            submitEmail(){
                let data = {
                    email: this.email
                }
                axios
                .post("/verifyEmailForRegistration", data)
                .then((res) => {
                    if(res.status === 200){
                        if(res.data.status == 200){
                            this.updateVerifiedEmail(2);
                        }
                    }
                    
                })
                .catch((err) => {
                    console.log(err.response);
                });
            }
        }
    }
</script>
