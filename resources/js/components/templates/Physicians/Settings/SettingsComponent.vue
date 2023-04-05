<template>
    <div v-show="loggedIn">
        <div class="loader" v-if="initialCheck || loading"></div>
        <div v-show="!initialCheck">
            <SideNavComponent @openPromotionals="openPromotionals" />
            <TabForm
                :user="userDets"
                :bio="bio"
                :services="services"
                :achievement="achievement"
                :contact="contact"
                :social="social"
                :general="general"
                :loading="loading"
                v-show="!promoView" class="fullPage"
                :tenant="tenant"
            />
            <PromotionalsComponent
                @close="promoView = false"
                v-show="promoView"
                :tenant="tenant"
            />
        </div>
    </div>
    <div v-if="!loggedIn">
        <div v-if="!initialCheck">
            <TenantLoginComponent :errors="errors" :logginIn="logginIn" :otp="otp" :otpPrompt="otpPrompt" @anteLogin="anteLogin($event)" @loginUser="login($event)" :loading="loading"/>
        </div>
        <div class="loader" v-else></div>
    </div>
</template>
<script>
    import SideNavComponent from "./partial/SideNavComponent.vue";
    import EditWebsiteModalComponent from "./partial/GeneralComponent.vue";
    import TabForm from "./partial/TabFormComponent.vue";
    import TenantLoginComponent from "./TenantLoginComponent.vue";
    import PromotionalsComponent from "./partial/PromotionalsComponent.vue";
    let centralURL = process.env.MIX_APP_URL;
    let bio = "/api/bio";
    let service = "/api/service";
    let achievement = "/api/achievement";
    let contact = "/api/contact";
    let social = "/api/social";
    let general = "/api/general";

    export default {
        components: {
            EditWebsiteModalComponent,
            TabForm,
            SideNavComponent,
            TenantLoginComponent,
            PromotionalsComponent,
        },
        props: {
            user: String,
            tenant: String,
        },
        data() {
            return {
                userDets: JSON.parse(this.user),
                services: [],
                bio: {},
                achievement: {},
                general: {},
                social: {},
                contact: {},
                loading: false,
                loggedIn: false,
                initialCheck: false,
                promoView: false,
                centralURL: centralURL,

                errors: {},
                logginIn: false,
                otp: "",
                otpPrompt: false,
            };
        },
        created() {
            this.checkAuth();
        },
        methods: {
            async anteLogin(e) {
                this.logginIn = !this.logginIn;
                let data = {
                    email: e.email,
                    password: e.password,
                };
                await axios.post(`${this.centralURL}/api/tenant/auth/ante_login`, data).then(res => {
                    if (res.status === 200) {
                        if (res.data.status == 200) {
                            this.setCookie(
                                "_token",
                                res.data.access_token,
                                2
                            );
                            
                            this.setCookie("_token", res.data.access_token, 1);
                            this.saveAccessToken(
                                res.data.access_token,
                                res.data.user.id,
                                e.email,
                                res.data.user.role,
                                res.data.user.visits
                            );
                        }
                    }
                }).catch(error => {
                    console.error();
                })
            },
            getLocations() {
                this.loading = true;
                const requestBio = axios.get(bio);
                const requestService = axios.get(service);
                const requestAchievement = axios.get(achievement);
                const requestContact = axios.get(contact);
                const requestSocial = axios.get(social);
                const requestGeneral = axios.get(general);
                axios
                    .all([
                        requestBio,
                        requestService,
                        requestAchievement,
                        requestContact,
                        requestSocial,
                        requestGeneral,
                    ])
                    .then(
                        axios.spread((...responses) => {
                            const bioRes = responses[0];
                            const servicesRes = responses[1];
                            const achievementRes = responses[2];
                            const contactRes = responses[3];
                            const socialRes = responses[4];
                            const generalRes = responses[5];
                            this.services = servicesRes.data.services;
                            this.bio = bioRes.data.bio;
                            this.achievement = achievementRes.data.achievement;
                            this.contact = contactRes.data.contact;
                            this.social = socialRes.data.social;
                            this.general = generalRes.data.general;
                            this.loading = false;
                        })
                    )
                    .catch((errors) => {
                        console.log(errors);
                    });
            },
            checkAuth() {
                this.initialCheck = true;
                const _token = ("; " + document.cookie)
                    .split(`; _token=`)
                    .pop()
                    .split(";")[0];
                if (_token == "") {
                    this.initialCheck = false;
                    this.loggedIn = false;
                } else {
                    axios
                        .post("/api/verifyToken", { accessToken: _token })
                        .then((res) => {
                            if (res.data.status == 401) {
                                this.loggedIn = false;
                                this.initialCheck = false;
                            } else if (res.data.status == 200) {
                                this.getLocations();
                                this.initialCheck = false;
                                this.loggedIn = true;
                            }
                        })
                        .catch((err) => {
                            console.log(err);
                            this.initialCheck = false;
                        });
                }
            },
            login(e) {
                this.loading = true;
                if (e.email == "" || e.password == "") {
                    M.toast({
                        html: "Invalid Credentials",
                        classes: "errorNotifier",
                    });
                } else {
                    axios
                    .post(`${this.centralURL}/api/tenant/auth/login`, e)
                    .then((res) => {
                        if (res.status === 200) {
                            if (res.data.status == 200) {
                                this.saveAccessToken(
                                    res.data.access_token,
                                    res.data.user.id,
                                    e.email,
                                    res.data.user.role,
                                    res.data.user.visits
                                );
                                this.setCookie("_token", res.data.access_token, 1);
                            } else if (res.data.status == 404) {
                                M.toast({
                                    html: res.data.error,
                                    classes: "errorNotifier",
                                });
                            }
                        }
                        if (res.data.status === 422) {
                            if (res.data.message == 'Device changed') {
                                this.otpPrompt = true;
                                this.otp = res.data.otp;
                            }
                        }
                        // if(res.data.status === 404){
                        //     M.toast({
                        //         html: "Invalid Credentials",
                        //         classes: "errorNotifier",
                        //     });
                        //     this.loading = !this.loading;
                        // } else {
                            
                        // }
                    })
                    .catch((err) => {
                        console.log(`Error: ${err}`);
                        this.loading = false;
                        if (err.response.status === 422) {
                            this.errors = err.response.data.errors;
                        }
                    });
                }
            },
            saveAccessToken(accessToken, user_id, email, role, visits) {
                let data = {
                    accessToken: accessToken,
                    user_id: user_id,
                    email: email,
                };
                axios
                    .post("/api/savelogin", data)
                    .then((res) => {
                        if (res.data.status == 201) {
                            localStorage.setItem('візіт', visits + 1);
                            this.loading = false;
                            role === 'Admin' ? location.reload() : window.location.href = `https://${location.host}`;
                        }
                    })
                    .catch((err) => {
                        console.log(err.response);
                        if (err.response.status === 401) {
                            M.toast({
                                html: err.response.data.message,
                                classes: 'errorNotifier'
                            })
                        } 
                        this.logginIn = !this.logginIn;
                        this.loading = false;
                    });
            },
            setCookie(cname, cvalue, exdays) {
                const d = new Date();
                d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
                let expires = "expires=" + d.toUTCString();
                document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
            },
            openPromotionals() {
                this.promoView = true;
            },
        },
        setup() {},
    };
</script>
