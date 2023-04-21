<template>
    <div>
        <div v-if="!claimant && claimaint === null">
            <div class="row">
                <div class="col l6 loginContainer white-text intro hide-on-med-and-down">
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
                                <h1 class="wlcNoteTitle">Start your journey <br />with us...</h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col l12">
                                <p class="wlcNoteTxt">
                                    “Good things come to those who wait”.
                                    <span class="getStartedOtpSpan right">Nathan Sykes</span>
                                </p>
                            </div>                    
                        </div>
                    </div>
                    <p class="wlcNoteFooterTxt center-align">
                            <small>© {{ getYear() }} whitecoatdomain.com.</small>
                    </p>
                    <!--div class="wlcNoteDiv">
                        <a href="/" class="wlcNoteLogo">
                            <img
                                src="/media/img/whiteCoatDomain1.png"
                                alt="whiteCoatDomain.png"
                                class="authLogo"
                            />
                        </a>
                        <p class="wlcNoteTitle">WELCOME BACK CHIEF!</p>
                        <p class="wlcNoteTxt">
                            The World is listening, it is time to tell your brand story with our professional, powerful and easy to use portfolio builder.
        
        
                        </p>
                        <p class="wlcNoteFooterTxt">
                            © White Coat Domain, Inc. {{ getYear() }}. We love our
                            users!
                        </p>
                    </div-->
                </div>
        
                <div class="col s12 m12 l6 loginContainer formContainer">
                    <div class="authRightDiv">
                        <div for="signup" v-if="verifiedEmail == 1">
                            <VerifyEmailComponent @resData="setOTP" :type="'register'" />
                        </div>
                       
                        <div for="otpComponent" v-if="verifiedEmail === 2">
                            <OtpComponent @res="otpVerifier" :otp="otp" :type="'register'"/>
                        </div>

                        <div v-if="verifiedEmail === 3" for="afterVerifyingEmail">
                            <div id="cover-spin">
                                <div class="valign-wrapper">
                                    <h6 class="">Saving data, please hang on. You will be redirected to complete your registration</h6>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div v-if="claimant || claimaint != null">
            <claimaint-component-prop :tenantOnDemand="tenantOnDemand" :claimaint="claimaint" :claimant="claimant" :titles="titles" :countries="countries" :userMail="userMail"/>
        </div>
    </div>
</template>
<script>
    import VerifyEmailComponent from "../partials/VerifyEmailComponent";
    import OtpComponent from "../partials/OtpComponent";
    import ClaimaintComponentProp from './ClaimaintComponentProp.vue';
    import { faker } from '@faker-js/faker';
    // import cryptoJs from "crypto-js";
    // import { Base64 } from "js-base64";
    // const key = process.env.MIX_APP_KEY;
    let country = "/api/countries";
    let title = "/api/title";
    let profession = "/api/profession";

    export default {
        components: {
            VerifyEmailComponent,
            OtpComponent,
            ClaimaintComponentProp,
        },
        data() {
            return {
               
                countries: [],
                otp: "",
                professions: [],
                registrationLoading: false,
                titles: [],
                password: "",
                userReg: {
                    email: "",
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
                    profession: "",
                    zipcode: "",
                },
                tenantOnDemand: parseInt(this.usernotordered), 
                verifying: false,
                verifiedEmail: 1,
                userMail: null,
                claimaint: null// if user refreshes page check if the process of claiming has started previously
            };
        },
        mounted() {
            this.getLocations();
            this.checkIfComingFromClaim();
        },
        methods: {
            checkIfComingFromClaim() {
                let claimaintProcess = localStorage.getItem('claimproc');
                let emailProcess = localStorage.getItem('email');
                if (this.claimant != '') {
                    localStorage.setItem('claimproc', this.claimant);
                    localStorage.setItem('email', this.useremail);
                }
                else {
                    if (claimaintProcess != null) {
                        this.claimaint = claimaintProcess;
                        this.userMail = emailProcess;
                    }
                }
            },
            createTenant(datum) {
                let data = {
                    name: faker.datatype.uuid(),
                    description: faker.lorem.paragraph(),
                    user_id: datum.id,
                    confirmHash: 'hashkeill',
                    password: this.password,
                };
                axios.post('/api/tenant_without_auth', data).then(res => {
                    if (res.data.status === 200) {
                        document.location.href = `claim?claimable=${res.data.domain.tenant.id}&mail=${this.userReg.email}`;
                        this.verifying = false;
                        console.log(location.host);
                    }
                }).catch(err => { 
                    console.log(err);
                })
            },
            passwordGenerator() {
                var chars =
                    "0123456789abcdefghijklmnopqrstuvwxyz!@#$%^&*()ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                var passwordLength = 12;
                var password = "";
                for (var i = 0; i <= passwordLength; i++) {
                    var randomNumber = Math.floor(Math.random() * chars.length);
                    password += chars.substring(randomNumber, randomNumber + 1);
                }
                console.log(password)
                return password;
            },
            getLocations() {
                const requestTitles = axios.get(title);
                const requestCountries = axios.get(country);
                const requestProfessions = axios.get(profession);
                // const requestCities = axios.get(city);
                axios
                    .all([requestTitles, requestCountries, requestProfessions])
                    .then(
                        axios.spread((...responses) => {
                            const titleRes = responses[0];
                            const countryRes = responses[1];
                            const professionRes = responses[2];
                            this.countries = countryRes.data.countries;

                            this.countries.sort(function(x, y){ return x.name == 'United States' || x.name == 'Canada' ? -1 : y.name == 'United States' || y.name == 'Canada' ? 1 : 0; });
                            this.titles = titleRes.data.titles;
                            this.professions = professionRes.data.professionals;
                        })
                    )
                    .catch((errors) => {
                        console.log(errors);
                    });
            },
            getYear() {
                return new Date().getFullYear();
            },
            otpVerifier(value) {
                if (value === 200) {
                    this.updateVerifiedEmail(3);
                    this.saveMailAndCreateUser();
                }
            },
            saveMailAndCreateUser() {
                this.verifying = true;
                this.password = this.passwordGenerator();
                axios.post('/claim/saveuser', {confirmHash: 'hashkeill', firstname: faker.name.firstName(), lastname: faker.name.lastName(), email: this.userReg.email, password: this.password,}).then(res => {
                    if (res.data.status === 201) {
                        this.createTenant(res.data.user);
                    }
                }).catch(err => {
                    console.log(err);
                })
            },
            setOTP(value) {
                this.otp = value.otp;
                this.userReg.email = value.email;
                this.updateVerifiedEmail(2);
            },
            updateVerifiedEmail(num) {
                this.verifiedEmail = num;
            },
        },
        props: {
            claimant: String,
            useremail: String,
            usernotordered: String,
        },
        
        computed: {},
    };
</script>
<style>
    #cover-spin {
    position:fixed;
    width:100%;
    left:0;right:0;top:0;bottom:0;
    background-color: rgba(255,255,255,0.7);
    z-index:9999;
}

@-webkit-keyframes spin {
	from {-webkit-transform:rotate(0deg);}
	to {-webkit-transform:rotate(360deg);}
}

@keyframes spin {
	from {transform:rotate(0deg);}
	to {transform:rotate(360deg);}
}

#cover-spin::after {
    content:'';
    display:block;
    position:absolute;
    left:48%;top:40%;
    width:40px;height:40px;
    border-style:solid;
    border-color:black;
    border-top-color:transparent;
    border-width: 4px;
    border-radius:50%;
    -webkit-animation: spin .8s linear infinite;
    animation: spin .8s linear infinite;
}
</style>
