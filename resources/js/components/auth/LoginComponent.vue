<template>
    <div>
        <div class="row authContainDiv">
            <div class="col s12 m12 l6 loginContainer">
                <div class="wlcNoteDiv">
                    <p class="wlcNoteLogo">PaaB</p>
                    <p class="wlcNoteTitle">WELCOME BACK CHIEF!</p>
                    <p class="wlcNoteTxt">
                        It is a long established fact that a reader will be distracted
                        by the readable content.
                    </p>
                    <p class="wlcNoteFooterTxt">© Photo, Inc. 2019. We love our users!</p>
                </div>
            </div>
        
            <div class="col s12 m12 l6 loginContainer">
                <div class="authRightDiv">
                    <p class="authTitle">LOGIN</p>
                    <p class="authTxt">
                        It is a long established fact that a reader will be diIt is a long
                    </p>
        
                    <form>
                        <div class="row rm_mg">
                            <div class="input-field col s12">
                                <input placeholder="User" id="user" type="text" class="validate">
                                <!-- <label for="email">Email</label> -->
                            </div>
        
                            <div class="input-field col s12">
                                <input placeholder="Password" id="password" type="password" class="validate">
                                <!-- <label for="email">Email</label> -->
                            </div>
        
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
        
                            <button type="button" class="btn" id="loginBtn">
                                sign in
                            </button>
        
                            <!-- Login Signup Link -->
                            <div class="row">
                                <div class="col s7 m7 l6 offset-s5 offset-m5 offset-l4 loginSignUpDiv">
                                    <div class="loginSignUpInnerDiv">
                                        <p class="loginSignUpTxt">
                                            Don’t have an account yet?
                                        </p>
                                        <p>
                                            <a href="/auth/getstarted" class="loginSignUpLink">
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
            };
        },
        mounted() {             
        },
        methods: {
        }
    }
</script>