<template>
    <div class="authRightDiv">
        <!-- <p class="authTitle">ENTER OTP</p> -->
        <p class="otpEmailAuthTxt marginBottom-5">
            <span v-if="text !== undefined">{{ text }} </span>
            <span v-else>You are almost there, get ready to conquer the world.</span>
        </p>

        <div class="row">
            <div class="col l12 m12 s12 marginBottom-5" id="otpEmailDiv">
                <form
                    method="get"
                    class="digit-group marginBottom-5"
                    data-group-name="digits"
                    data-autosubmit="false"
                    autocomplete="off"
                >
                    <input
                        type="text"
                        v-on:keyup="
                            processOtpFields(
                                $event,
                                $event.target.value,
                                0
                            )
                        "
                        class="input-field col s1 otpDigits"
                        maxlength="1"
                        data-next="digit-2"
                        autofocus 
                        :disabled="disabled == 1"
                    />
                    <input
                        type="text"
                        v-on:keyup="
                            processOtpFields(
                                $event,
                                $event.target.value,
                                1
                            )
                        "
                        class="input-field col s1 otpDigits"
                        maxlength="1"
                        data-next="digit-3"
                        data-previous="digit-1" 
                        :disabled="disabled == 1"
                    />
                    <input
                        type="text"
                        v-on:keyup="
                            processOtpFields(
                                $event,
                                $event.target.value,
                                2
                            )
                        "
                        class="input-field col s1 otpDigits"
                        maxlength="1"
                        data-next="digit-4"
                        data-previous="digit-2" 
                        :disabled="disabled == 1"
                    />
                    <input
                        type="text"
                        v-on:keyup="
                            processOtpFields(
                                $event,
                                $event.target.value,
                                3
                            )
                        "
                        class="input-field col s1 otpDigits"
                        maxlength="1"
                        data-next="digit-5"
                        data-previous="digit-3" 
                        :disabled="disabled == 1"
                    />
                    <input
                        type="text"
                        v-on:keyup="
                            processOtpFields(
                                $event,
                                $event.target.value,
                                4
                            )
                        "
                        class="input-field col s1 otpDigits"
                        maxlength="1"
                        data-next="digit-6"
                        data-previous="digit-4" 
                        :disabled="disabled == 1"
                    />
                    <input
                        type="text"
                        v-on:keyup="
                            processOtpFields(
                                $event,
                                $event.target.value,
                                5
                            )
                        "
                        class="input-field col s1 otpDigits"
                        maxlength="1"
                        data-previous="digit-3" 
                        :disabled="disabled == 1"
                    />
                </form>
                <p v-if="shown && toggleOn"><b>Still can't find the mail? Check your spam/junk box. Messages could end up there.</b></p>
            </div>
            
            <div class="row center">
                <button href="#!" v-if="!verifyLoading && !verifying" class="btn" @click="confirmOTP()" :disabled="isDisabled">Verify</button>
                <a href="#!" v-else class="btn">
                    <i class="fa fa-spin fa-spinner"></i>
                </a>
            </div>
        </div>
    </div>
</template>
<script>
    import cryptoJs from "crypto-js";
    import { Base64 } from "js-base64";
    const key = process.env.MIX_APP_KEY;

    export default {
        data() {
            return {
                userInputedOTP: "",
                key: key.substring(7),
                disabled: 0,
                shown: false,
                verifyLoading: false
            };
        },
        props: {
            otp: String,
            type: String,
            email: String,
            text: String,
            toggleOn: Boolean,
            verifying: Boolean,
        },
        mounted() {
            setTimeout(() => {
                this.shown = true;
            }, 7000);
        },
        methods: {
            confirmOTP() {
                if (this.userInputedOTP.length !== 6) {
                    M.toast({
                        html: "OTP should be six characters.",
                        classes: "errorNotifier",
                    });
                } else {
                    this.verifyLoading = true;
                    this.disabled = 1;
                    if(this.type === 'register'){
                        if (this.decryptOTP(this.otp) === this.userInputedOTP) {
                            // Pass 200 to parent
                            this.$emit('res', 200);
                            this.verifyLoading = false;
                        } else {
                            M.toast({
                                html: "Invalid OTP.",
                                classes: "errorNotifier",
                            });
                            this.verifyLoading = false;
                            // reload page after 4secs
                            setTimeout(() => {
                                location.reload();
                            }, 4000);
                        }
                    } else if(this.type === 'reset'){
                            let data = {email: this.email, otp: this.userInputedOTP}
                            axios.post('/api/verifyOTP', data).then(res => {
                                // console.log(res);
                                if (res.data.status == 200) {
                                    this.$emit('res', 200);
                                    this.verifyLoading = false;
                                } else if (res.data.status == 404) {
                                    this.$emit('res', 404);
                                    this.verifyLoading = false;
                                }

                            }).catch(err => {
                                this.verifyLoading = false;
                                M.toast({
                                    html: "Server Error.",
                                    classes: "Please reload page and try again.",
                                });
                                console.log(err);
                            })
                    }
                    else if (this.type === 'otpField') {
                        this.$emit('response', this.userInputedOTP);
                    }
                    
                }
            },
            decryptOTP(otp) {
                let cipher = JSON.parse(Base64.decode(otp));
                let decrypted = cryptoJs.AES.decrypt(
                    cipher.value,
                    cryptoJs.enc.Base64.parse(this.key),
                    {
                        iv: cryptoJs.enc.Base64.parse(cipher.iv),
                    }
                );
                return decrypted.toString(cryptoJs.enc.Utf8);
            },
            processOtpFields(e, char = null, index) {
                if (char !== null && char !== "") {
                    this.userInputedOTP = [
                        this.userInputedOTP.slice(0, index),
                        char,
                        this.userInputedOTP.slice(index),
                    ].join("");

                    if (index !== 5) {
                        e.target.nextElementSibling.focus();
                    }
                } else if (char === "") {
                    this.userInputedOTP =
                        this.userInputedOTP.slice(0, index) +
                        this.userInputedOTP.slice(index + 1);
                }
                
            },
        },
        computed: {
            isDisabled: function () {
                return this.userInputedOTP.length !== 6;
            },
        },
    };
</script>
<style scoped>
    .btn {
        background-color: var(--pri);
        text-transform: unset;
        padding: 2vh 5vw;
        border-radius: 2vh;
        height: unset;
        line-height: unset;
        box-shadow: 0px 4px 19px 0px rgba(16, 157, 173, 0.30);
    }
    .btn:disabled {
        background-color: #b9bac1 !important;
        border: none !important;
    }

    /* Large */
    @media only screen and (min-width: 1024px) {
        
    }
    /* Medium */
    @media only screen and (min-width: 768px) and (max-width: 1023px) {
        .btn {
            padding: 2vh 12vw;
        }
    }
    /* small */
    @media only screen and (max-width: 767px) {
        .btn {
            padding: 2vh 15vw;
        }
    }
    
</style>