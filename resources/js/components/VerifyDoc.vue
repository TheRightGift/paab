<template>
    <div>
        <div class="bg d-flex justify-center">
            <div class="d-flex justify-center flex-col align-center">
                <div class="show-on-medium">
                    <img
                        class="logo"
                        src="/media/img/wcd-logo-noBckg-removebg-previewWHITE.png"
                        alt="Whitecoatdomain Logo"
                    />
                </div>
                <div class="contents ">
                    <div class="flex-end d-flex hide-on-med-and-up">
                        <a href="/">
                            <img class="" src="/media/img/wcd-logo-noBckg.png" alt="Whitecoatdomain Logo"/>
                        </a>                    
                    </div>
                    <div v-show="verified">
                        <h5>Thanks for making this decision of creating your public domain</h5>
                        <p>To continue...</p>
                        <p>Is this your name?</p>
                        <p class="names">{{ names }}</p>
                        <div class="d-flex">
                            <p @click="openWebsite" class="box">Yes</p> <p class="box">No</p>
                        </div>
                        <small>Clicking on Yes navigates you to your generated site, where you can make further changes missed by our AI</small>
                    </div>
                    <div class="" v-show="!verified">
                        <h5>Enter OTP</h5>
                        <div class="">
                            <otp-component :verifying="verifying" :text="'Please type in the number you recieved.'" :toggle-on="false" @response="getOtpField($event)" :type="'otpField'"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import OtpComponent from './partials/OtpComponent.vue'
export default {
    data() {
        return {
            verifying: false,
            verified: false,
            names: '',
            token: '',
            url: '',
        }
    },
    components: {
        OtpComponent
    },
    methods: {
        getOtpField(code) {
            this.verifying = true;
            const pathname = window.location.pathname;
            const name = pathname.substring(pathname.lastIndexOf("/") + 1);
            const tenant = decodeURIComponent(name);
            let data = {code: code, name: tenant}
            axios.post(`/api/checkTenantOtp/`, data).then(res => {
                console.log(res);
                if (res.data.code == false) {
                    M.toast({
                        html: 'The code you entered is wrong',
                        classes: 'errorNotifier'
                    });
                    setTimeout(() => {
                        location.reload();
                    }, 700);
                } else if (res.data.code == true) {
                    M.toast({
                        html: 'Congrats, You are verified!',
                        classes: 'successNotifier',
                    });
                    this.verifying = false;
                    this.names = res.data.names;
                    this.verified = true;
                    this.token = res.data.token.token;
                    this.url = `https://${res.data.tenant}.whitecoatdomain.com?token=${this.token}`;
                }

            }).catch(err => {
                console.log(err);
            })
            console.log(code);
        },
        openWebsite() {
            // Make a call to backend and get the token
            // Get the token and tenantId and take user to his page
            location.href = this.url;
        }
    }
}
</script>