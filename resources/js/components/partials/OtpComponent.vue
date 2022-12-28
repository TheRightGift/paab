<template>
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
            </div>

            <button
                class="btn col s12"
                id="otpEmailBtn"
                @click="confirmOTP()"
                :disabled="isDisabled"
            >
                VERIFY
            </button>
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
                disabled: 0
            };
        },
        props: {
            otp: String,
            type: String,
            email: String,
        },
        mounted() {},
        methods: {
            confirmOTP() {
                if (this.userInputedOTP.length !== 6) {
                    M.toast({
                        html: "OTP should be six characters.",
                        classes: "errorNotifier",
                    });
                } else {
                    this.disabled = 1;
                    if(this.type === 'register'){
                        if (this.decryptOTP(this.otp) === this.userInputedOTP) {
                            // Pass 200 to parent
                            this.$emit('res', 200);
                        } else {
                            M.toast({
                                html: "Invalid OTP.",
                                classes: "errorNotifier",
                            });

                            // reload page after 4secs
                            setTimeout(() => {
                                location.reload();
                            }, 4000);
                        }
                    } else if(this.type === 'reset'){
                        // TODO: send otp to backend to verifie OTP and userID
                        // if ok:
                            //this.$emit('res', 200);
                        // else
                            // this.$emit('res', 404);
                            let data = {email: this.email, otp: this.userInputedOTP}
                            axios.post('/api/verifyOTP', data).then(res => {
                                // console.log(res);
                                if (res.data.status == 200) {
                                    this.$emit('res', 200);
                                }
                                else if (res.data.status == 404) {
                                    this.$emit('res', 404);
                                }
                            }).catch(err => {
                                console.log(err);
                            })
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
