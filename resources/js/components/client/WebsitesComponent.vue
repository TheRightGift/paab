<template>
    <div>
        <!-- Sidenav for small devices -->
        <div v-if="!viewingTemplate">
            <mobile-nav-component />

            <!-- Sidebar for large and medium devices -->
            <div class="row" id="dashRowDiv">
                <side-nav-component />

                <!-- Web black div -->
                <div class="col s12 m10 l10" id="webRightDiv" v-if="view == 0">
                    <div class="webBlackDiv">
                        <div class="webBlackDiv1">
                            <div class="row webBlackDiv1">
                                <div class="col s12">
                                    <p class="webBlackTitle">
                                        Create Portfolio
                                    </p>
                                </div>
                                <div class="col s11">
                                    <p class="webBlackTxt">
                                        Lets start and automate your process so
                                        you can reclaim time and focus on your
                                        goals.
                                    </p>
                                </div>
                                <div class="col s1">
                                    <i
                                        class="material-icons right"
                                        id="webAddCircleIcon"
                                        @click="webAddCircleIcon()"
                                        >add_circle</i
                                    >
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- web empty div -->
                    <div class="webWhiteDiv">
                        <web-create-component @createWebsite="createWebsite($event)" :professions="professions" @close="close($event)" v-if="!isHidden" :loading="loading"/>
                        <div class="webWhiteDiv1" v-else>
                            <div v-if="websites.length > 0">
                                <div
                                    class="row"
                                    id="webWhiteDiv2"
                                    v-for="website in websites"
                                    :key="website.id"
                                >
                                    <div
                                        class="col s3 m2 l2"
                                        id="webWhiteProMgLftDiv"
                                    >
                                        <div id="">
                                            <div class="webWhiteProDiv" id="">
                                                <i
                                                    class="material-icons"
                                                    id="tempProIcon"
                                                    >person</i
                                                >
                                            </div>
                                            <p class="webWhiteProName">
                                                {{ website.name }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col s5 s5 l6 offset-s1">
                                        <p class="webWhiteTitle">Description</p>
                                        <p class="webWhiteTxt">
                                            {{ website.description }}
                                        </p>
                                    </div>

                                    <div
                                        class="col s1 m2 l3 offset-s1 offset-m1"
                                    >
                                        <a href="#!" @click="setView(website)">
                                            <i
                                                class="material-icons right"
                                                id="webWhiteIcon"
                                                >open_in_new</i
                                            >
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div v-else>
                                <p class="centered">
                                    No website created yet!. All websites
                                    appears here when you create one
                                </p>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Right Side Div -->
                <div class="col s12 m10 l10" id="setupWebRightDiv" v-else>
                    <div class="setWebContainModalDiv">
                        <div class="setWebInnerModalDiv">
                            <div class="setWebTitleDiv">
                                <p class="setWebTitle">Title:</p>
                                <p class="setWebTitleData">{{ tenant.name }}</p>
                            </div>

                            <div class="setWebUrlDiv">
                                <p class="setWebUrlTitle">url:</p>
                                <p>
                                    <a href="#" class="setWebUrlData">{{
                                        tenant.domain
                                    }}</a>
                                    <span class="setWebPlan">Premium</span>
                                </p>
                            </div>

                            <div class="setWebDateDiv">
                                <p class="setWebDateTitle">Start Date:</p>
                                <p class="setWebDateData">
                                    {{
                                        new Date(tenant.created_at) ||
                                        new Date()
                                    }}
                                </p>
                            </div>

                            <div class="setWebDescriptionDiv">
                                <p class="setWebDescriptionTitle">
                                    Description:
                                </p>
                                <p class="setWebDescriptionData">
                                    {{ tenant.description }}
                                </p>
                            </div>

                            <div class="row" id="setWebBtnDiv">
                                <button
                                    class="col s12 btn"
                                    type="button"
                                    id="setWebBtn"
                                    @click="setEditWebModal"
                                >
                                    EDIT WEBSITE
                                </button>

                                <button
                                    class="col s12 btn"
                                    type="button"
                                    id="setWebBtn1"
                                    @click="viewTemplate"
                                >
                                    VIEW WEBSITE
                                </button>
                            </div>
                        </div>
                    </div>
                    <edit-website-modal-component @exitModal="setEditWebModal" v-if="onEditWebModal"/>
                </div>
            </div>
        </div>

        <template-starter v-else @viewTemplate="viewTemplate" :user="user" />

        <!-- Modal Creation of websites -->
        
    </div>
</template>

<script>
import MobileNavComponent from '../partials/MobileNavComponent.vue';
import SideNavComponent from '../partials/SideNavComponent.vue';
    // import FooterComponent from "./partials/FooterComponent.vue";
    // import HeaderComponent from "./partials/HeaderComponent.vue";
    import TemplateStarter from "../templates/TemplateStarter.vue";
    import EditWebsiteModalComponent from "./EditWebsiteModalComponent.vue";
import WebCreateComponent from './WebCreateComponent.vue';
    export default {
        components: {
            TemplateStarter,
            EditWebsiteModalComponent,
                MobileNavComponent,
                SideNavComponent,
                WebCreateComponent,
            // FooterComponent,
            // HeaderComponent
        },
        data() {
            return {
                bg_img: "/media/img/istockphoto-1390124896-170667a.jpg",
                domain: {},
                isHidden: false,
                loading: false,
                onEditWebModal: false,
                professions: [],
                pro_img: "/media/img/yuna.jpg",
                tenant: {},
                user: {},
                view: 0,
                viewingTemplate: 0,
                websites: [],
            };
        },
        mounted() {
            this.getUser();
            this.getWebsites();
            this.getProfessions();
            this.isHidden = !this.isHidden;
        },
        methods: {
            createWebsite(evt) {
                this.loading = true;
                evt.user_id = this.user.id;
                axios
                    .post("/api/tenant", evt)
                    .then((res) => {
                        if (res.data.status == 200) {
                            M.toast({
                                html: res.data.message,
                                classes: "successNotifier",
                            });
                            let created = res.data.tenant;
                            created.domains = res.data.domain.domain;
                            this.websites.unshift(res.data.tenant);
                            this.loading = false;
                            this.isHidden = !this.isHidden;
                            // this.setDefaults(1);
                        }
                    })
                    .catch((err) => {
                        if(err.response.status == 500) {
                            M.toast({
                                html: err.response.data.message,
                                classes: "errorNotifier",
                            });
                            this.loading = false;
                        }
                    });
            },
            close (evt) {
                this.isHidden = evt;
            },
            getProfessions() {
                axios
                    .get("/api/profession")
                    .then((res) => {
                        if (res.status == 200) {
                            this.professions = res.data.professionals;
                        }
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            },
            getUser() {
                axios
                    .get("/api/user")
                    .then((res) => {
                        this.user = res.data;
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            },
            getWebsites() {
                axios
                    .get("/api/tenancies")
                    .then((res) => {
                        if (res.data.status == 200) {
                            this.websites = res.data.tenants;
                        }
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            },
            
            setDefaults(num) {
                this.view = num;
            },
            setEditWebModal () {
                this.onEditWebModal = !this.onEditWebModal;
            },
            setView(website) {
                this.tenant.domain = typeof(website.domains) === "object"? website.domains[0].domain : website.domains;
                this.tenant.name = website.name;
                this.tenant.description = website.description;
                this.tenant.created_at = website.created_at;
                this.setDefaults(1);
            },
            viewTemplate() {
                this.viewingTemplate = !this.viewingTemplate;
            },
            webAddCircleIcon() {
                this.isHidden = false;
            },
        },
    };
</script>
<style scoped>
    .centered {
        color: black;
    }
</style>