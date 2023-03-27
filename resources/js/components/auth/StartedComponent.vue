<template>
    <div>
        <!-- Signup Help Modal Structure -->
        <!-- <div id="helpModal1" class="modal">
            <div class="modal-content">
                <p>
                    <a
                        href="#!"
                        class="
                            modal-close
                            waves-effect waves-green
                            btn-flat
                            helpModalCloseBtn
                        "
                        >Go Back</a
                    >
                </p>
                <h5 class="helpModalTitle">How to sign up</h5>
                <div class="helpModalTxts">
                    <p>Create your portfolio with these easy steps:</p>
                    <p>
                        1. Enter your professional name and title e.g Dr Bayo
                        Akerele.
                    </p>
                    <p>2. Enter your email and mobile number.</p>
                    <p>3. Select your gender, country, state and city.</p>
                    <p>4. Create a Strong password e.g. Qwerty123@</p>
                    <p>5. Tap Sign Up</p>
                    <p>
                        6. To finish creating your account, you need to confirm
                        your email or phone number.
                    </p>
                </div>
            </div>
        </div> -->
        <!-- Had to differentiate for those that are coming from claiming website -->
        <div v-if="!claimant && claimaint === null">
            <div class="row authContainDiv" v-if="verifiedEmail == 1">
                <div class="col s12 m12 l6 welcomeContainer hide-on-med-and-down">
                    <div class="wlcNoteDiv">
                        <a href="/" class="wlcNoteLogo">
                            <img
                                src="/media/img/whiteCoatDomain1.png"
                                alt="whiteCoatDomain.png"
                                class="authLogo"
                            />
                        </a>
                        <p class="wlcNoteTitle">
                            Start your journey <br />with us...
                        </p>
                        <p class="wlcNoteTxt">
                            Let us ensure that your email address is active and accurate , that is the only way we can reach you effectively. <br/><br/>P.S Also check your spam, we might meet you there.
                        </p>
                        <p class="wlcNoteFooterTxt">
                            &copy; White Coat Domain. {{ getYear() }}. We support
                            your brand!
                        </p>
                    </div>
                </div>
    
                <div class="col s12 m12 l6 welcomeContainer">
                    <div class="authHeadingContainer center-align hide-on-large-only">
                        <a href="/" class="authHeading">WhiteCoatDomain</a>
                    </div>
                    <VerifyEmailComponent @resData="setOTP" :type="'register'" />
                </div>
            </div>
    
            <div class="row authContainDiv" v-if="verifiedEmail == 2">
                <div class="col s12 m12 l6 otpContainer hide-on-med-and-down">
                    <div class="wlcNoteDiv">
                        <a href="/" class="wlcNoteLogo">
                            <img
                                src="/media/img/whiteCoatDomain1.png"
                                alt="whiteCoatDomain.png"
                                class="authLogo"
                            />
                        </a>
                        <p class="wlcNoteTitle">
                            Start your journey <br />with us...
                        </p>
                        <p class="wlcNoteTxt">
                            “Good things come to those who wait”.
                            <span class="getStartedOtpSpan right">Nathan Sykes</span>
                        </p>
                        <p class="wlcNoteFooterTxt">
                            &copy; White Coat Domain. {{ getYear() }}. We support
                            your brand!
                        </p>
                    </div>
                </div>
    
                <div class="col s12 m12 l6 otpContainer">
                    <div class="authHeadingContainer center-align hide-on-large-only">
                        <a href="/" class="authHeading">WhiteCoatDomain</a>
                    </div>
                    <OtpComponent @res="otpVerifier" :otp="otp" :type="'register'"/>
                </div>
            </div>
            
            <div v-if="verifiedEmail === 3">
                <div id="cover-spin">
                    <div class="valign-wrapper">
                        <h6 class="">Saving data, please hang on. You will be redirected to complete your registration</h6>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="claimant || claimaint != null">
            <claimaint-component-prop :claimaint="claimaint" :claimant="claimant" :titles="titles" :countries="countries"/>
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
                verifying: false,
                verifiedEmail: 1,
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
                if (this.claimant != '') {
                    localStorage.setItem('claimproc', this.claimant);
                    localStorage.setItem('email', this.userEmail);
                }
                else {
                    if (claimaintProcess != null) {
                        this.claimaint = claimaintProcess;
                    }
                }
            },
            createTenant(datum) {
                let data = {
                    name: faker.datatype.uuid(),
                    description: faker.lorem.paragraph(),
                    user_id: datum.id,
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
                axios.post('/claim/saveuser', {confirmHash: 'hashkeill', firstname: faker.name.firstName(), lastname: faker.name.lastName(), email: this.userReg.email, password: this.passwordGenerator(),}).then(res => {
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
            
            
            // submitRegistrationForm() {
            //     if (
            //         !this.userReg.email ||
            //         !this.userReg.firstname ||
            //         !this.userReg.lastname ||
            //         !this.userReg.phone ||
            //         !this.userReg.country ||
            //         !this.userReg.gender ||
            //         !this.userReg.state ||
            //         !this.userReg.city ||
            //         !this.userReg.zipcode ||
            //         !this.userReg.password ||
            //         this.userReg.password !== this.userReg.cPassword
            //     ) {
            //         M.toast({
            //             html: "Please fill every field in the registration form.",
            //             classes: "errorNotifier",
            //         });
            //     } else {
            //         this.registrationLoading = true;
            //         let data = {
            //             email: this.userReg.email,
            //             firstname: this.userReg.firstname,
            //             lastname: this.userReg.lastname,
            //             phone: this.userReg.phone,
            //             gender: this.userReg.gender,
            //             city_id: this.userReg.city,
            //             title_id: this.userReg.title,
            //             zipcode: this.userReg.zipcode,
            //             password: this.userReg.password,
            //         };
            //         axios
            //             .post("/auth/register", data)
            //             .then((res) => {
            //                 if (res.status === 200) {
            //                     if (res.data.status == 200) {
            //                         window.location.href = "/auth/login";
            //                     } else if (res.data.status == 501) {
            //                         M.toast({
            //                             html: res.data.error,
            //                             classes: "errorNotifier",
            //                         });
            //                     }
            //                     this.registrationLoading = false;
            //                 }
            //             })
            //             .catch((err) => {
            //                 console.log(`Error: ${err.response}`);
            //             });
            //     }
            // },
            updateVerifiedEmail(num) {
                this.verifiedEmail = num;
            },
        },
        props: {
            claimant: String,
            userEmail: String,
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