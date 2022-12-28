<template>
    <div>
        <div class="row authContainDiv" v-if="verifiedEmail == 1">
            <div class="col s12 m12 l6 welcomeContainer hide-on-med-and-down">
                <div class="wlcNoteDiv">
                    <a href="/" class="wlcNoteLogo">PaaB</a>
                    <p class="wlcNoteTitle">
                        Start your journey <br />with us...
                    </p>
                    <p class="wlcNoteTxt">
                        It is a long established fact that a reader will be
                        distracted by the readable content.
                    </p>
                    <p class="wlcNoteFooterTxt">
                        &copy; PaaB. {{ getYear() }}. We support your brand!
                    </p>
                </div>
            </div>

            <div class="col s12 m12 l6 welcomeContainer">
                <VerifyEmailComponent @resData="setOTP" :type="'register'"/>
            </div>
        </div>

        <div class="row authContainDiv" v-if="verifiedEmail == 2">
            <div class="col s12 m12 l6 otpContainer hide-on-med-and-down">
                <div class="wlcNoteDiv">
                    <a href="/" class="wlcNoteLogo">PaaB</a>
                    <p class="wlcNoteTitle">
                        Start your journey <br />with us...
                    </p>
                    <p class="wlcNoteTxt">
                        It is a long established fact that a reader will be
                        distracted by the readable content.
                    </p>
                    <p class="wlcNoteFooterTxt">
                        &copy; PaaB. {{ getYear() }}. We support your brand!
                    </p>
                </div>
            </div>

            <div class="col s12 m12 l6 otpContainer">
                <OtpComponent @res="otpVerifier" :otp="otp" :type="'register'"/>
            </div>
        </div>

        <div class="row authContainDiv" v-if="verifiedEmail == 3">
            <div class="col s12 m12 l6 regContainer hide-on-med-and-down">
                <div class="wlcNoteDiv">
                    <a href="/" class="wlcNoteLogo">PaaB</a>
                    <p class="wlcNoteTitle">
                        Start your journey <br />with us...
                    </p>
                    <p class="wlcNoteTxt">
                        It is a long established fact that a reader will be
                        distracted by the readable content.
                    </p>
                    <p class="wlcNoteFooterTxt">
                        &copy; PaaB. {{ getYear() }}. We support your brand!
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
                                <select
                                    class="browser-default"
                                    id="signupTitle"
                                    v-model="userReg.title"
                                >
                                    <option value="" disabled selected>
                                        Title
                                    </option>
                                    <option
                                        v-for="title in titles"
                                        :key="title.id"
                                        :value="title.id"
                                    >
                                        {{ title.name }}
                                    </option>
                                </select>
                            </div>

                            <div class="input-field col l5 s12">
                                <input
                                    placeholder="Last Name"
                                    id="signupLname"
                                    type="text"
                                    v-model="userReg.lastname"
                                />
                            </div>

                            <div class="input-field col l5 s12">
                                <input
                                    placeholder="First Name"
                                    id="signupFName"
                                    type="text"
                                    v-model="userReg.firstname"
                                />
                            </div>
                        </div>

                        <div class="row">
                            <div
                                class="
                                    input-field
                                    col
                                    l6
                                    m6
                                    s6
                                    noPaddingLeft
                                "
                            >
                                <input
                                    placeholder="Email"
                                    id="signupEmail"
                                    type="email"
                                    v-model="userReg.email"
                                    readonly
                                />
                            </div>
                            <div
                                class="
                                    input-field
                                    col
                                    l6
                                    m6
                                    s6
                                "
                            >
                                <input
                                    placeholder="Zipcode"
                                    id="signupZipcode"
                                    type="text"
                                    v-model="userReg.zipcode"
                                />
                            </div>
                        </div>

                        <div class="row">
                            <div
                                class="
                                    input-field
                                    col
                                    l6
                                    m6
                                    s12
                                    noPaddingLeft
                                "
                            >
                                <input
                                    placeholder="Phone Number"
                                    id="signupPhone"
                                    type="tel"
                                    class="validate"
                                    v-model="userReg.phone"
                                />
                            </div>
                            <div class="input-field col l6 s12 noPaddingRight">
                                <select
                                    class="browser-default"
                                    id="signupProfession"
                                    v-model="userReg.profession"
                                >
                                    <option value="" disabled selected>
                                        Profession
                                    </option>
                                    <option
                                        v-for="profession in professions"
                                        :key="profession.id"
                                        :value="profession.id"
                                    >
                                        {{ profession.name }}
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col l6 s12 noPaddingLeft">
                                <select
                                    class="browser-default"
                                    id="signupCountry"
                                    v-model="userReg.country"
                                    @change="sortStates"
                                >
                                    <option value="" disabled selected>
                                        Country
                                    </option>
                                    <option
                                        v-for="country in countries"
                                        :key="country.id"
                                        :value="country.id"
                                    >
                                        {{ country.name }}
                                    </option>
                                </select>
                            </div>

                            <div class="input-field col l6 s12 noPaddingRight">
                                <select
                                    class="browser-default"
                                    id="signupGender"
                                    v-model="userReg.gender"
                                >
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
                                <select
                                    class="browser-default"
                                    id="signupState"
                                    v-model="userReg.state"
                                    @change="sortCities"
                                >
                                    <option value="" disabled selected>
                                        State
                                    </option>
                                    <option
                                        v-for="state in states"
                                        :key="state.id"
                                        :value="state.id"
                                    >
                                        {{ state.name }}
                                    </option>
                                </select>
                            </div>

                            <div class="input-field col l6 s12 noPaddingRight">
                                <select
                                    class="browser-default"
                                    id="signupCity"
                                    v-model="userReg.city"
                                >
                                    <option value="" disabled selected>
                                        City
                                    </option>
                                    <option
                                        v-for="city in cities"
                                        :key="city.id"
                                        :value="city.id"
                                    >
                                        {{ city.name }}
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div
                                class="
                                    input-field
                                    col
                                    l12
                                    m12
                                    s12
                                    noPaddingLeft
                                "
                            >
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
                            <div
                                class="
                                    input-field
                                    col
                                    l12
                                    m12
                                    s12
                                    noPaddingLeft
                                "
                            >
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
                            <button
                                class="btn col l12 m12 s12"
                                v-if="!registrationLoading"
                                type="button"
                                id="signupBtn"
                                @click="submitRegistrationForm()"
                            >
                                Sign Up
                            </button>
                            <a class="btn getStartBtn" v-else>
                                <div class="preloader-wrapper small active">
                                    <div
                                        class="spinner-layer spinner-white-only"
                                    >
                                        <div class="circle-clipper left">
                                            <div class="circle"></div>
                                        </div>
                                        <div class="gap-patch">
                                            <div class="circle"></div>
                                        </div>
                                        <div class="circle-clipper right">
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
    import VerifyEmailComponent from "../partials/VerifyEmailComponent";
    import OtpComponent from "../partials/OtpComponent";
    // import cryptoJs from "crypto-js";
    // import { Base64 } from "js-base64";
    // const key = process.env.MIX_APP_KEY;
    let country = "/api/countries";
    let title = "/api/title";
    let profession = "/api/profession";

    export default {
        components: {
            VerifyEmailComponent,
            OtpComponent
        },
        data() {
            return {
                cities: [],
                countries: [],
                otp: "",
                professions: [],
                registrationLoading: false,
                states: [],
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
                    zipcode: ""
                },
                verifiedEmail: 1,
            };
        },
        mounted() {
            this.getLocations();
        },
        methods: {
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
                            this.titles = titleRes.data.titles;
                            this.professions = professionRes.data.professionals;
                        })
                    )
                    .catch((errors) => {
                        console.log(errors)
                    });
            },
            getYear() {
                return new Date().getFullYear();
            },
            otpVerifier(value){
                if(value === 200){
                    this.updateVerifiedEmail(3);
                }
            },
            setOTP(value){
                this.otp = value.otp;
                this.userReg.email = value.email;
                this.updateVerifiedEmail(2);
            },
            sortCities() {
                axios.get(`/api/cities/${this.userReg.state}`).then(res => {
                    if (res.data.status == 200) {
                        this.cities = res.data.cities;
                    }
                    else {
                        M.toast({
                            html: 'Error getting cities',
                            classes: "errorNotifier",
                        });
                    }
                }).catch(err => {
                    console.log(err);
                })
            },
            sortStates() {
                axios.get(`/api/states/${this.userReg.country}`).then(res => {
                    if (res.data.status == 200) {
                        this.states = res.data.states;
                    }
                    else {
                        M.toast({
                            html: 'Error getting states',
                            classes: "errorNotifier",
                        });
                    }
                }).catch(err => {
                    console.log(err);
                })
            },
            submitRegistrationForm() {
                if (
                    !this.userReg.email ||
                    !this.userReg.firstname ||
                    !this.userReg.lastname ||
                    !this.userReg.phone ||
                    !this.userReg.country ||
                    !this.userReg.gender ||
                    !this.userReg.state ||
                    !this.userReg.city ||
                    !this.userReg.zipcode ||
                    !this.userReg.password ||
                    this.userReg.password !== this.userReg.cPassword
                ) {
                    M.toast({
                        html: "Please fill every field in the registration form.",
                        classes: "errorNotifier",
                    });
                } else {
                    this.registrationLoading = true;
                    let data = {
                        email: this.userReg.email,
                        firstname: this.userReg.firstname,
                        lastname: this.userReg.lastname,
                        phone: this.userReg.phone,
                        gender: this.userReg.gender,
                        city_id: this.userReg.city,
                        title_id: this.userReg.title,
                        zipcode: this.userReg.zipcode,
                        password: this.userReg.password,
                    };
                    axios
                        .post("/auth/register", data)
                        .then((res) => {
                            if (res.status === 200) {
                                if (res.data.status == 200) {
                                    window.location.href = "/auth/login";
                                } else if (res.data.status == 501) {
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
            },
            updateVerifiedEmail(num) {
                this.verifiedEmail = num;
            },
        },
        computed: {},
    };
</script>
