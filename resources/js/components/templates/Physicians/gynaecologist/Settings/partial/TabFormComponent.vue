<template>
    <div>
        <div class="container">
            <div class="editWebiIllustrateMainDiv">
                <div>
                    <p class="editWebWlcTxt">Setup your website</p>
                </div>
                <div class="editWebiIllustrateDiv hide-on-med-and-down">
                    <img
                        src="/media/img/settings.png"
                        alt="settings.png"
                        class="editWebSidenavImg"
                    />
                </div>
            </div>

            <div class="editWebNav">
                <!-- hide-on-med-and-down -->
                <div class="editInnerWebNav">
                    <ul id="editWebUl">
                        <li class="editWebLi">
                            <a href="#" class="editWebLink" @click="genLink()">
                                <span
                                    class="editBtnLinkNum"
                                    :class="[isActive ? 'black' : '']"
                                    id="genLink"
                                    >1</span
                                >
                                General
                                <span
                                    class="icon-button__badge"
                                    v-if="generalErrors"
                                ></span>
                            </a>
                        </li>
                        <li class="editWebLi">
                            <a href="#" class="editWebLink" @click="bioLink()">
                                <span class="editBtnLinkNum" id="bioLink"
                                    >2</span
                                >
                                Bio
                                <span
                                    class="icon-button__badge"
                                    v-if="bioeErrors"
                                ></span>
                            </a>
                        </li>
                        <li class="editWebLi">
                            <a
                                href="#"
                                class="editWebLink"
                                @click="servicesLink()"
                            >
                                <span class="editBtnLinkNum" id="servicesLink"
                                    >3</span
                                >
                                Services
                                <span
                                    class="icon-button__badge"
                                    v-if="serviceErrors"
                                ></span>
                            </a>
                        </li>
                        <li class="editWebLi">
                            <a
                                href="#"
                                class="editWebLink"
                                @click="achieveLink()"
                            >
                                <span class="editBtnLinkNum" id="achieveLink"
                                    >4</span
                                >
                                Achievement
                                <span
                                    class="icon-button__badge"
                                    v-if="achievementErrors"
                                ></span>
                            </a>
                        </li>
                        <li class="editWebLi">
                            <a
                                href="#"
                                class="editWebLink"
                                @click="socialLink()"
                            >
                                <span class="editBtnLinkNum" id="socialLink"
                                    >5</span
                                >
                                Socials
                                <span
                                    class="icon-button__badge"
                                    v-if="socialErrors"
                                ></span>
                            </a>
                        </li>
                        <li class="editWebLi">
                            <a
                                href="#"
                                class="editWebLink"
                                @click="contactLink()"
                            >
                                <span class="editBtnLinkNum" id="contactLink"
                                    >6</span
                                >
                                Contacts
                                <span
                                    class="icon-button__badge"
                                    v-if="contactErrors"
                                ></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <GeneralComponent
                :genModal="genModal"
                :genModal1="genModal1"
                :saved="general"
                :loading="loading"
                :tenant="tenant"
                @genNextBtn="genNextBtn"
                @generalSave="generalSave($event)"
                @generalUpdate="generalUpdate($event)"
                @genGoBackBtn="genGoBackBtn"
                @genNextBtn1="genNextBtn1"
            />
            <BioComponent
                :bioModal="bioModal"
                :bioModal1="bioModal1"
                :bioModal2="bioModal2"
                :bioModal3="bioModal3"
                :user="user"
                :saved="bio"
                :loading="loading"
                @bioGoBackBtn="bioGoBackBtn"
                @bioNextBtn="bioNextBtn"
                @bioGoBackBtn1="bioGoBackBtn1"
                @bioNextBtn1="bioNextBtn1"
                @bioGoBackBtn2="bioGoBackBtn2"
                @bioNextBtn2="bioNextBtn2"
                @bioGoBackBtn3="bioGoBackBtn3"
                @servicesLink="servicesLink"
                @bioSave="bioSave($event)"
                @bioUpdate="bioUpdate($event)"
                :tenant="tenant"
            />
            <ServicesComponent
                :servicesModal="servicesModal"
                :saved="services"
                :loading="loading"
                @serviceSave="serviceSave($event)"
                @achieveLink="achieveLink"
                @servicesGoBackBtn="servicesGoBackBtn"
                :interests="interests"
            />
            <Achievement
                :achieveModal="achieveModal"
                :saved="achievement"
                :loading="loading"
                @saveAchievement="saveAchievement($event)"
                @socialLink="socialLink"
                @achieveGoBackBtn="achieveGoBackBtn"
                :tenant="tenant"
            />
            <SocialComponent
                :socialsModal="socialsModal"
                :saved="social"
                :loading="loading"
                @saveSocial="saveSocial($event)"
                @contactLink="contactLink"
                @socialGoBackBtn="socialGoBackBtn"
            />
            <ContactComponent
                :user="user"
                :saved="contact"
                :loading="loading"
                :contactModal="contactModal"
                @saveContact="saveContact($event)"
                @contactGoBackBtn="contactGoBackBtn"
            />
        </div>
    </div>
</template>
<script>
    import GeneralComponent from "./GeneralComponent.vue";
    import BioComponent from "./BioComponent.vue";
    import ServicesComponent from "./ServicesComponent.vue";
    import Achievement from "./Achievement.vue";
    import SocialComponent from "./SocialComponent.vue";
    import ContactComponent from "./ContactComponent.vue";

    export default {
        components: {
            GeneralComponent,
            BioComponent,
            ServicesComponent,
            Achievement,
            SocialComponent,
            ContactComponent,
        },
        data() {
            return {
                bioModal: false,
                genModal: false,
                servicesModal: false,
                achieveModal: false,
                socialsModal: false,
                contactModal: false,

                isActive: true,

                genModal1: false,
                bioModal1: false,
                bioModal2: false,
                bioModal3: false,

                titles: [],

                // ErorrNotify
                generalErrors: false,
                bioeErrors: false,
                serviceErrors: false,
                contactErrors: false,
                socialErrors: false,
                achievementErrors: false,
                loading: false,
            };
        },
        props: {
            user: Object,
            social: Object,
            bio: Object,
            services: Array,
            contact: Object,
            general: Object,
            achievement: Object,
            tenant: String,
            interests: Array,
        },
        mounted() {
            this.genModal = true;
            if (performance.navigation.type == performance.navigation.TYPE_RELOAD) {
                if (localStorage.getItem("refreshed") == null) {
                    localStorage.setItem("refreshed", 1);
                } else {
                    let refreshed = parseInt(localStorage.getItem("refreshed")) + 1;
                    localStorage.setItem("refreshed", refreshed);
                }
            } else {
                let refreshed =
                    localStorage.getItem("refreshed") === null
                        ? 0
                        : parseInt(localStorage.getItem("refreshed")) + 1;
                localStorage.setItem("refreshed", refreshed);
            }
        },
        methods: {
            checkIfFieldIsEmpty() {
                if (
                    localStorage.getItem("візіт") > 1 ||
                    localStorage.getItem("refreshed") > 2
                ) {
                    if (this.social == null) {
                        this.socialErrors = true;
                    }
                    if (this.bio == null) {
                        this.bioeErrors = true;
                    }
                    if (this.services.length === 0) {
                        this.serviceErrors = true;
                    }
                    if (this.contact == null) {
                        this.contactErrors = true;
                    }
                    if (this.general == null) {
                        this.generalErrors = true;
                    }
                    if (this.achievement == null) {
                        this.achievementErrors = true;
                    }
                }
            },
            generalSave(e) {
                this.loading = !this.loading;
                let formData = new FormData();
                formData.append("favicon", e.favicon);
                formData.append("title", e.title);
                axios
                    .post(`/api/general`, formData)
                    .then((res) => {
                        if (res.data.status == 200) {
                            this.loading = !this.loading;
                            M.toast({
                                html: res.data.message,
                                classes: "successNotifier",
                            });
                            this.genNextBtn1();
                            this.generalErrors = false;
                        }
                    })
                    .catch((err) => {
                        this.loading = !this.loading;
                        if (err.response.status == 400) {
                            this.loading = !this.loading;
                            err.response.data.forEach((el) => {
                                M.toast({
                                    html: el,
                                    classes: "errorNotifier",
                                });
                            });
                        }
                    });
            },
            generalUpdate(e) {
                this.loading = !this.loading;
                let formData = new FormData();
                e.favicon ? formData.append("favicon", e.favicon) : null;
                e.favicon ? formData.append("oldFav", e.oldFav) : null;
                formData.append("title", e.title);
                formData.append("_method", e._method);
                axios
                    .post(`/api/general/${e.id}`, formData)
                    .then((res) => {
                        if (res.data.status == 200) {
                            this.loading = !this.loading;
                            M.toast({
                                html: res.data.message,
                                classes: "successNotifier",
                            });
                        }
                    })
                    .catch((err) => {
                        this.loading = !this.loading;
                        if (err.response.status == 400) {
                            err.response.data.forEach((el) => {
                                M.toast({
                                    html: el,
                                    classes: "errorNotifier",
                                });
                            });
                        }
                    });
            },
            bioSave(e) {
                this.loading = !this.loading;
                let formData = new FormData();
                axios.post(`${process.env.MIX_WCDSERVICE_URL}physicians/getPhysicianDescriptionFromChatGPT`, {
                    // lastname: e.lastname,
                    // firstname: e.firstname,
                    specialty: e.specialty,
                    name: e.firstname +' '+ e.lastname
                }).then(res => {
                    if (res.status === 201) {
                        formData.append("photo", e.photo);
                        formData.append("about", res.data);
                        formData.append("firstname", e.firstname);
                        formData.append("lastname", e.lastname);
                        formData.append("gender", e.gender);
                        axios
                            .post(`/api/bio`, formData)
                            .then((res) => {
                                if (res.status == 201) {
                                    this.loading = !this.loading;
                                    M.toast({
                                        html: res.data.message,
                                        classes: "successNotifier",
                                    });
                                    this.bioeErrors = false;
                                    this.servicesLink();
                                }
                            })
                            .catch((err) => {
                                this.loading = !this.loading;
                                if (err.response.status == 400) {
                                    err.response.data.forEach((el) => {
                                        M.toast({
                                            html: el,
                                            classes: "errorNotifier",
                                        });
                                    });
                                }
                                if (err.response.status == 413) {
                                    M.toast({
                                        html: "Picture " + err.response.statusText,
                                        classes: "errorNotifier",
                                    });
                                }
                            });
                        }
                }).catch(err => {
                    console.log(err);
                })
            },
            bioUpdate(e) {
                this.loading = !this.loading;
                let formData = new FormData();
                e.photo ? formData.append("photo", e.photo) : null;
                e.photo ? formData.append("oldPhoto", e.oldPhoto) : null;
                e.CV ? formData.append("CV", e.CV) : null;
                e.CV ? formData.append("oldCV", e.oldCV) : null;

                formData.append("firstname", e.firstname);
                formData.append("lastname", e.lastname);
                formData.append("about", e.about);
                formData.append("gender", e.gender);
                formData.append("_method", e._method);
                axios
                    .post(`/api/bio/${e.id}`, formData)
                    .then((res) => {
                        if (res.data.status == 200) {
                            M.toast({
                                html: res.data.message,
                                classes: "successNotifier",
                            });
                            this.loading = !this.loading;
                        }
                    })
                    .catch((err) => {
                        this.loading = !this.loading;
                        console.log(err.response.status);
                        if (err.response.status == 400) {
                            err.response.data.forEach((el) => {
                                M.toast({
                                    html: el,
                                    classes: "errorNotifier",
                                });
                            });
                        }
                        if (err.response.status == 413) {
                            M.toast({
                                html: err.response.statusText,
                                classes: "errorNotifier",
                            });
                        }
                    });
            },
            serviceSave(e) {
                console.log(e);
                this.loading = !this.loading;
                let request = `/api/service`;
                let formData = new FormData();
                if (e.update == 1) {
                    request = `/api/service/${e.id}`;
                    e.removed.length > 0
                        ? formData.append("removed", JSON.stringify(e.removed))
                        : null;
                }
                formData.append("data", JSON.stringify(e.services));
                e.update == 1 ? formData.append("_method", "PUT") : null;
                axios
                    .post(request, formData)
                    .then((res) => {
                        if (res.status == 201 || res.data.status == 200) {
                            M.toast({
                                html: res.data.message,
                                classes: "successNotifier",
                            });
                            this.serviceErrors = false;
                            this.loading = !this.loading;
                            this.$emit("updateServices", res.data.services);
                            e.update == 0 ? this.achieveLink() : null;
                        }
                    })
                    .catch((err) => {
                        this.loading = !this.loading;
                        if (err.response.status == 400) {
                            err.response.data.forEach((el) => {
                                M.toast({
                                    html: el,
                                    classes: "errorNotifier",
                                });
                            });
                        }
                    });
            },
            saveSocial(e) {
                this.loading = !this.loading;
                let request = `/api/social`;
                let data = {
                    _method: "PUT",
                };
                // console.log(e)
                if (e.update == 1) {
                    request = `/api/social/${e.id}`;
                    e = { ...e, ...data };
                }
                axios
                    .post(request, e)
                    .then((res) => {
                        if (res.status == 201 || res.data.status == 200) {
                            this.loading = !this.loading;
                            M.toast({
                                html: res.data.message,
                                classes: "successNotifier",
                            });
                            this.socialErrors = false;
                            this.contactLink();
                        }
                    })
                    .catch((err) => {
                        this.loading = !this.loading;
                        if (err.response.status == 400) {
                            err.response.data.forEach((el) => {
                                M.toast({
                                    html: el,
                                    classes: "errorNotifier",
                                });
                            });
                        }
                    });
            },
            saveContact(e) {
                this.loading = !this.loading;
                let request = `/api/contact`;
                let data = {
                    _method: "PUT",
                };
                if (e.update == 1) {
                    request = `/api/contact/${e.id}`;
                    e = { ...e, ...data };
                }
                axios
                    .post(request, e)
                    .then((res) => {
                        if (res.status == 201 || res.data.status == 200) {
                            this.loading = !this.loading;
                            M.toast({
                                html: res.data.message,
                                classes: "successNotifier",
                            });
                            location.reload();
                            // this.contactNextBtn()
                        }
                    })
                    .catch((err) => {
                        this.loading = !this.loading;
                        if (err.response.status == 400) {
                            err.response.data.forEach((el) => {
                                M.toast({
                                    html: el,
                                    classes: "errorNotifier",
                                });
                            });
                        }
                    });
            },
            saveAchievement(e) {
                this.loading = !this.loading;
                let formData = new FormData();
                let request = `/api/achievement`;
                if (e.update == 1) {
                    formData.append("_method", "PUT");
                    request = `/api/achievement/${e.id}`;
                }
                e.update != 1 || e.oldBanner
                    ? formData.append("banner", e.banner)
                    : null;
                formData.append("feats", JSON.stringify(e.feats));
                axios
                    .post(request, formData)
                    .then((res) => {
                        if (res.status == 201 || res.data.status == 200) {
                            this.loading = !this.loading;
                            M.toast({
                                html: res.data.message,
                                classes: "successNotifier",
                            });
                            this.achievementErrors = false;
                            e.update == 0 ? this.socialLink() : null;
                        }
                    })
                    .catch((err) => {
                        if (err.response.status == 400) {
                            this.loading = !this.loading;
                            err.response.data.forEach((el) => {
                                M.toast({
                                    html: el,
                                    classes: "errorNotifier",
                                });
                            });
                        }
                    });
            },
            servicesLink(e) {
                this.bioModal = false;
                this.bioModal1 = false;
                this.bioModal2 = false;
                this.bioModal3 = false;
                this.genModal = false;
                this.genModal1 = false;
                this.achieveModal = false;
                this.socialsModal = false;
                this.contactModal = false;
                this.servicesModal = true;

                this.isActive = false;
                e != undefined ? (this.bioeErrors = e) : null;

                $("#servicesLink").css("background-color", "black");
                $("#genLink").css("background-color", "white");
                $("#bioLink").css("background-color", "white");
                $("#socialLink").css("background-color", "white");
                $("#contactLink").css("background-color", "white");
            },
            genLink() {
                this.genModal = true;
                this.bioModal = false;
                this.servicesModal = false;
                this.achieveModal = false;
                this.socialsModal = false;
                this.contactModal = false;

                this.isActive = true;

                $("#genLink").css("background-color", "black");
                $("#servicesLink").css("background-color", "white");
                $("#bioLink").css("background-color", "white");
                $("#achieveLink").css("background-color", "white");
                $("#socialLink").css("background-color", "white");
                $("#contactLink").css("background-color", "white");
            },
            bioLink() {
                this.bioModal = true;
                this.genModal = false;
                this.genModal1 = false;
                this.servicesModal = false;
                this.achieveModal = false;
                this.socialsModal = false;
                this.contactModal = false;

                this.isActive = false;

                $("#bioLink").css("background-color", "black");
                $("#genLink").css("background-color", "white");
                $("#servicesLink").css("background-color", "white");
                $("#achieveLink").css("background-color", "white");
                $("#socialLink").css("background-color", "white");
                $("#contactLink").css("background-color", "white");
            },
            achieveLink(e) {
                this.bioModal = false;
                this.bioModal1 = false;
                this.bioModal2 = false;
                this.bioModal3 = false;
                this.genModal = false;
                this.genModal1 = false;
                this.servicesModal = false;
                this.socialsModal = false;
                this.contactModal = false;
                this.achieveModal = true;

                this.isActive = false;
                e != undefined ? (this.serviceErrors = e) : null;

                $("#bioLink").css("background-color", "white");
                $("#genLink").css("background-color", "white");
                $("#servicesLink").css("background-color", "white");
                $("#achieveLink").css("background-color", "black");
                $("#socialLink").css("background-color", "white");
                $("#contactLink").css("background-color", "white");
                setTimeout(() => {
                    var elems = document.querySelectorAll("input[type=range]");
                    M.Range.init(elems);
                }, 100);
            },
            socialLink(e) {
                this.achieveModal = false;
                this.bioModal = false;
                this.bioModal1 = false;
                this.bioModal2 = false;
                this.bioModal3 = false;
                this.genModal = false;
                this.genModal1 = false;
                this.servicesModal = false;
                this.contactModal = false;
                this.socialsModal = true;

                this.isActive = false;
                e != undefined ? (this.achievementErrors = e) : null;
                $("#bioLink").css("background-color", "white");
                $("#genLink").css("background-color", "white");
                $("#servicesLink").css("background-color", "white");
                $("#achieveLink").css("background-color", "white");
                $("#socialLink").css("background-color", "black");
                $("#contactLink").css("background-color", "white");
            },
            contactLink(e) {
                this.achieveModal = false;
                this.socialsModal = false;
                this.bioModal = false;
                this.bioModal1 = false;
                this.bioModal2 = false;
                this.bioModal3 = false;
                this.genModal = false;
                this.genModal1 = false;
                this.servicesModal = false;
                this.contactModal = true;

                this.isActive = false;
                e != undefined ? (this.socialErrors = e) : null;
                $("#bioLink").css("background-color", "white");
                $("#genLink").css("background-color", "white");
                $("#servicesLink").css("background-color", "white");
                $("#achieveLink").css("background-color", "white");
                $("#socialLink").css("background-color", "white");
                $("#contactLink").css("background-color", "black");
            },

            genNextBtn() {
                this.genModal = false;
                this.genModal1 = true;
                $("#bioLink").css("background-color", "white");
            },

            genGoBackBtn() {
                this.genModal = true;
                this.genModal1 = false;
                $("#bioLink").css("background-color", "white");
            },

            genNextBtn1(e) {
                this.generalErrors = e;
                this.bioModal = true;
                this.genModal1 = false;
                this.isActive = false;
                $("#bioLink").css("background-color", "black");
            },

            bioGoBackBtn() {
                this.bioModal = false;
                this.genModal1 = true;
                $("#genLink").css("background-color", "black");
                $("#bioLink").css("background-color", "white");
            },

            bioGoBackBtn() {
                this.bioModal = false;
                this.genModal1 = true;
                $("#genLink").css("background-color", "black");
                $("#bioLink").css("background-color", "white");
            },

            bioNextBtn() {
                this.bioModal = false;
                this.bioModal3 = false;
                this.bioModal1 = true;
                this.bioModal2 = false;
            },

            bioGoBackBtn1() {
                this.bioModal = true;
                this.bioModal3 = false;
                this.bioModal1 = false;
                this.bioModal2 = false;
            },

            bioGoBackBtn2() {
                this.bioModal1 = true;
                this.bioModal2 = false;
            },

            bioNextBtn1() {
                this.bioModal = false;
                this.bioModal3 = false;
                this.bioModal1 = false;
                this.bioModal2 = true;
            },

            bioGoBackBtn3() {
                this.bioModal2 = true;
                this.bioModal3 = false;
            },

            bioNextBtn2() {
                this.bioModal = false;
                this.bioModal3 = true;
                this.bioModal1 = false;
                this.bioModal2 = false;
            },

            bioNextBtn3() {
                this.bioModal3 = false;
                this.servicesModal = true;
            },

            servicesGoBackBtn() {
                this.servicesModal = false;
                this.bioModal3 = true;

                $("#bioLink").css("background-color", "black");
                $("#servicesLink").css("background-color", "white");
            },

            achieveGoBackBtn() {
                this.servicesModal = true;
                this.achieveModal = false;

                $("#achieveLink").css("background-color", "white");
                $("#servicesLink").css("background-color", "black");
            },

            servicesNextBtn() {
                this.servicesModal = false;
                this.achieveModal = true;
                setTimeout(() => {
                    var elems = document.querySelectorAll("input[type=range]");
                    M.Range.init(elems);
                }, 100);
            },

            achieveNextBtn() {
                this.achieveModal = false;
                this.socialsModal = true;
            },

            socialGoBackBtn() {
                this.achieveModal = true;
                this.socialsModal = false;
                $("#socialLink").css("background-color", "white");
                $("#achieveLink").css("background-color", "black");
            },

            socialNextBtn() {
                this.socialsModal = false;
                this.contactModal = true;
            },

            contactGoBackBtn() {
                this.contactModal = false;
                this.socialsModal = true;
                $("#socialLink").css("background-color", "black");
                $("#contactLink").css("background-color", "white");
            },
        },
        watch: {
            general(newVal, oldVal) {
                this.checkIfFieldIsEmpty();
            },
        },
    };
</script>
