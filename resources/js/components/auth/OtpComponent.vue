<template>
    <div>
        <div class="row authContainDiv">
            <div class="col s12 m12 l6">
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
        
            <div class="col s12 m12 l6">
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