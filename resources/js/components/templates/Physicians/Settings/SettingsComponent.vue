<template>
    <div v-show="loggedIn">
        <SideNavComponent />
        <TabForm
            :user="userDets"
            :bio="bio"
            :services="services"
            :achievement="achievement"
            :contact="contact"
            :social="social"
            :general="general"
        />
    </div>
    <div v-show="!loggedIn">
        <TenantLoginComponent @loginUser="login($event)"/>
    </div>
</template>
<script>
    import SideNavComponent from "./partial/SideNavComponent.vue";
    import EditWebsiteModalComponent from "./partial/GeneralComponent.vue";
    import TabForm from "./partial/TabFormComponent.vue";
    import TenantLoginComponent from "./TenantLoginComponent.vue";

    let bio = "/api/bio";
    let service = "/api/service";
    let achievement = "/api/achievement";
    let contact = "/api/contact";
    let social = "/api/social";
    let general = "/api/general";

    export default {
        components: { EditWebsiteModalComponent, TabForm, SideNavComponent, TenantLoginComponent },
        props: {
            user: String,
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
            };
        },
        mounted() {
            this.checkAuth();
            this.getLocations();
        },
        methods: {
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
                const _token = ('; '+document.cookie).split(`; _token=`).pop().split(';')[0];
                console.log(_token)
                if (_token == "") {
                    this.loggedIn = false;
                }
                else {
                    axios.post('/api/verifyToken', {accessToken: _token}).then(res => {
                        if (res.data.status == 401) {
                            this.loggedIn = false;
                        }
                        else if (res.data.status == 200) {
                            this.loggedIn = true;
                        }
                    }).catch(err => {
                        console.log(err);
                    })
                }
            },
            login(e) {
                if (e.email == "" || e.password == "") {
                    M.toast({
                        html: 'Invalid Credentials',
                        classes: "errorNotifier",
                    });
                }else {
                    axios.post('http://localhost:8000/api/tenant/auth/login', e).then(res => {
                        // console.log(res)
                        // Send accessToken to the tenant.user to update
                        this.setCookie(
                            "_token",
                            res.data.access_token,
                            1
                        );
                        this.saveAccessToken(res.data.access_token, res.data.user.id);
                        // Store as cookie variable for accesstoken
                        // Get accessToken from cookie and verify every operation
                        // Verify the
                    }).catch(err => {
                        console.log(err);
                    })
                }
            },
            saveAccessToken(accessToken, user_id) {
                let data = {'accessToken': accessToken, 'user_id': user_id};
                axios.post('/api/savelogin', data).then(res => {
                    if (res.data.status == 201) {
                        this.loggedIn = true;
                    }
                }).catch(err => {
                    consol.log(err);
                })
            },
            setCookie(cname, cvalue, exdays) {
                const d = new Date();
                d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
                let expires = "expires=" + d.toUTCString();
                document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
            },
        },
        setup() {},
    };
</script>