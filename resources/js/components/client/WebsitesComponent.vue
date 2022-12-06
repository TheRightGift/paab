<template>
    <div>
        <!-- Sidenav for small devices -->
        <div v-if="!viewingTemplate">
            <nav class="hide-on-med-and-up white">
                <!-- Sidenav Contents -->
                <ul id="slide-out" class="sidenav">
                    <li>
                        <div class="user-view">
                            <div class="background">
                                <img :src="bg_img" />
                            </div>
                            <a href="#user"
                                ><img class="circle" :src="pro_img"
                            /></a>
                            <a href="#name"
                                ><span class="white-text name"
                                    >Dr. {{ user.firstname }}
                                    {{ user.lastname }}</span
                                ></a
                            >
                            <a href="#email"
                                ><span class="white-text email">{{
                                    user.email
                                }}</span></a
                            >
                        </div>
                    </li>
    
                    <li>
                        <a href="/client/dashboard" class="dashLeftBarListDiv">
                            <i class="material-icons dashLeftBarIcons">dashboard</i>
                            <p class="dashLeftBarTitle">Dashboard</p>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="dashLeftBarListDiv">
                            <i
                                class="
                                    material-icons
                                    dashLeftBarIcons
                                    purple-text
                                    text-darken-4
                                "
                                >web</i
                            >
                            <p class="dashLeftBarTitle">Websites</p>
                        </a>
                    </li>
                    <!-- <li><div class="divider"></div></li> -->
                    <!-- <li><a class="subheader">Subheader</a></li> -->
                    <li>
                        <a href="/client/template" class="dashLeftBarListDiv">
                            <i class="material-icons">chrome_reader_mode</i>
                            <p class="dashLeftBarTitle">Templates</p>
                        </a>
                    </li>
                    <li>
                        <a href="/client/mail" class="dashLeftBarListDiv">
                            <i class="material-icons dashLeftBarIcons"
                                >mail_outline</i
                            >
                            <p class="dashLeftBarTitle">Mails</p>
                        </a>
                    </li>
                    <li>
                        <a href="/client/settings" class="dashLeftBarListDiv">
                            <i class="material-icons dashLeftBarIcons">settings</i>
                            <p class="dashLeftBarTitle">Settings</p>
                        </a>
                    </li>
                    <li>
                        <a href="/client/support" class="dashLeftBarListDiv">
                            <i class="material-icons dashLeftBarIcons"
                                >question_answer</i
                            >
                            <p class="dashLeftBarTitle">Help/Support</p>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="dashLeftBarListDiv">
                            <i class="material-icons dashLeftBarIcons">autorenew</i>
                            <p class="dashLeftBarTitle">Logout</p>
                        </a>
                    </li>
                </ul>
    
                <!-- Sidenav Trigger -->
                <a href="#" data-target="slide-out" class="sidenav-trigger">
                    <i class="material-icons" id="dashSidenavIconBtn">menu</i>
                </a>
            </nav>
    
            <!-- Sidebar for large and medium devices -->
            <div class="row" id="dashRowDiv">
                <div class="col s12 m2 l2" id="dashLeftColBar">
                    <div class="dashLeftBar hide-on-small-only">
                        <div class="proImgDiv">
                            <i class="material-icons" id="proImg">person</i>
                        </div>
    
                        <div class="dashLeftBarInnerDiv">
                            <a href="/dashboard" class="dashLeftBarListDiv">
                                <i class="material-icons dashLeftBarIcons"
                                    >dashboard</i
                                >
                                <p class="dashLeftBarTitle">Dashboard</p>
                            </a>
    
                            <a href="#" class="dashLeftBarListDiv">
                                <i
                                    class="material-icons dashLeftBarIcons"
                                    id="dashActive"
                                    >web</i
                                >
                                <p class="dashLeftBarTitle">Websites</p>
                            </a>
    
                            <a href="/client/template" class="dashLeftBarListDiv">
                                <i class="material-icons dashLeftBarIcons"
                                    >chrome_reader_mode</i
                                >
                                <p class="dashLeftBarTitle">Templates</p>
                            </a>
    
                            <a href="/client/mail" class="dashLeftBarListDiv">
                                <i class="material-icons dashLeftBarIcons"
                                    >mail_outline</i
                                >
                                <p class="dashLeftBarTitle">Mails</p>
                            </a>
    
                            <a href="/client/settings" class="dashLeftBarListDiv">
                                <i class="material-icons dashLeftBarIcons"
                                    >settings</i
                                >
                                <p class="dashLeftBarTitle">Settings</p>
                            </a>
    
                            <a href="/client/support" class="dashLeftBarListDiv">
                                <i class="material-icons dashLeftBarIcons"
                                    >question_answer</i
                                >
                                <p class="dashLeftBarTitle">Help/Support</p>
                            </a>
    
                            <a href="#" class="dashLeftBarListDiv">
                                <i class="material-icons dashLeftBarIcons"
                                    >autorenew</i
                                >
                                <p class="dashLeftBarTitle">Logout</p>
                            </a>
                        </div>
                    </div>
                </div>
    
                <!-- Web black div -->
                <div class="col s12 m10 l10" id="webRightDiv" v-if="view == 0">
                    <div class="webBlackDiv">
                        <div class="webBlackDiv1">
                            <div class="row webBlackDiv1">
                                <div class="col s12">
                                    <p class="webBlackTitle">Create Portfolio</p>
                                </div>
                                <div class="col s11">
                                    <p class="webBlackTxt">
                                        Lets start and automate your process so you
                                        can reclaim time and focus on your goals.
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
                        <div class="webWhiteDiv1">
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
    
                                    <div class="col s1 m2 l3 offset-s1 offset-m1">
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
                                    No website created yet!. All websites appears
                                    here when you create one
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
                                        domain.domain
                                    }}</a>
                                    <span class="setWebPlan">Premium</span>
                                </p>
                            </div>
    
                            <div class="setWebDateDiv">
                                <p class="setWebDateTitle">Start Date:</p>
                                <p class="setWebDateData">
                                    {{ new Date(tenant.created_at) || new Date() }}
                                </p>
                            </div>
    
                            <div class="setWebDescriptionDiv">
                                <p class="setWebDescriptionTitle">Description:</p>
                                <p class="setWebDescriptionData">
                                    {{ tenant.description }}
                                </p>
                            </div>
    
                            <div class="row" id="setWebBtnDiv">
                                <button
                                    class="col s12 btn"
                                    type="button"
                                    id="setWebBtn"
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
                </div>
            </div>
        </div>

        <template-starter v-else @viewTemplate="viewTemplate" :user="user"/>

        <!-- Modal Creation of websites -->
        <div class="clientCreatePortModalDiv" v-if="!isHidden">
            <p class="clientCreatePortCancelDiv">
                <i
                    class="material-icons"
                    id="clientCreatePortCancelIconBtn"
                    @click="modalCancelBtn()"
                    >cancel</i
                >
            </p>

            <p class="clientCreatePortTitle">
                Giving your website a good title make it easier for customer to
                find your page.
            </p>

            <div class="row" id="clientCreatePortInputRowDiv">
                <div class="col s12">
                    <input
                        type="text"
                        placeholder="Website title"
                        id="clientCreatePortInput"
                        v-model="web.name"
                    />
                </div>

                <div class="col s12">
                    <input
                        type="text"
                        placeholder="Description"
                        id="clientCreatePortInput1"
                        v-model="web.description"
                    />
                </div>
            </div>

            <div class="clientCreateInnerPortModalDiv">
                <div class="webProfessionDiv">
                    <div class="row">
                        <div
                            class="col s6 m4 l2"
                            v-for="profession in professions"
                            :key="profession.id"
                        >
                            <div id="userTempDiv" class="hoverable">
                                <div class="tempImgDiv" id="tempImgDiv">
                                    <i class="material-icons" id="tempProIcon"
                                        >person</i
                                    >
                                </div>
                                <p class="userTempTitle">
                                    {{ profession.name }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button
                type="button"
                class="btn"
                id="clientCreatePortBtn"
                @click.prevent="createWebsite()"
            >
                <span v-if="!loading">GET STARTED</span>
                <div class="preloader-wrapper small active" v-else>
                    <div class="spinner-layer spinner-white-only">
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
            </button>
        </div>
    </div>
</template>

<script>
    // import FooterComponent from "./partials/FooterComponent.vue";
    // import HeaderComponent from "./partials/HeaderComponent.vue";
    import TemplateStarter from '../templates/TemplateStarter.vue'
    export default {
        components: {
            TemplateStarter
            // FooterComponent,
            // HeaderComponent
        },
        data() {
            return {
                bg_img: "/media/img/istockphoto-1390124896-170667a.jpg",
                domain: {},
                isHidden: false,
                loading: false,
                professions: [],
                pro_img: "/media/img/yuna.jpg",
                tenant: {},
                user: {},
                view: 0,
                viewingTemplate: 0,
                websites: [],
                web: {
                    name: "",
                    description: "",
                },
            };
        },
        mounted() {
            this.getUser();
            this.getWebsites();
            this.getProfessions();
            this.isHidden = !this.isHidden;
        },
        methods: {
            createWebsite() {
                this.loading = true;
                this.web.user_id = this.user.id;
                axios
                    .post("/api/tenant", this.web)
                    .then((res) => {
                        if (res.data.status == 200) {
                            this.tenant = res.data.tenant;
                            this.domain = res.data.domain;
                            this.loading = false;
                            this.isHidden = !this.isHidden;
                            this.setDefaults(1);
                        }
                    })
                    .catch((err) => {
                        console.log(err);
                    });
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
            modalCancelBtn() {
                this.isHidden = true;
            },
            setDefaults(num) {
                this.view = num;
            },
            setView(website) {
                this.domain = website.domains[0];
                this.tenant.name = website.name;
                this.tenant.description = website.description;
                this.tenant.created_at = website.created_at;
                this.setDefaults(1);
            },
            viewTemplate () {
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