<template>
    <div>
        <div class="row authContainDiv">
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
            };
        },
        mounted() {             
        },
        methods: {
        }
    }
</script>