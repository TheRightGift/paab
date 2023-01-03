<template>
    <div>
        <!-- Sidenav for small devices -->
        <div v-if="!viewingTemplate">
            <mobile-nav-component />

            <!-- Sidebar for large and medium devices -->
            <div class="row" id="dashRowDiv">
                <SideNavComponent @user="getUser" />
                <!-- Web black div -->
                <div class="col s12 m10 l10" v-if="view == 0">
                    <div id="webRightDiv">
                        <div class="col s9 black websiteBanner">
                            <p class="webBlackTitle">Create Portfolio</p>
                            <p class="webBlackTxt">
                                Lets start and automate your process so you can
                                reclaim time and focus on your goals.
                            </p>
                        </div>
                        <div
                            class="col s3 primary"
                            id="webAddContainer"
                            @click="webAddCircleIcon()"
                            v-if="isHidden"
                        >
                            <i class="material-icons webAddIcon">add</i>
                            <p>Create Website</p>
                        </div>
                        <div
                            class="col s3 primaryBorder"
                            id="webAddContainer"
                            v-else
                        >
                            <i class="material-icons webAddIcon2"
                                >linear_scale</i
                            >
                            <p>Creating Website...</p>
                        </div>

                        <!-- web empty div -->
                        <div class="col s12 webWhiteDiv">
                            <web-create-component
                                @createWebsite="createWebsite($event)"
                                @close="close($event)"
                                v-if="!isHidden && loadingUserProfessionId"
                                :loading="loading"
                                :userProfessionId="userProfessionId"
                                :user="user"
                            />
                            <div v-else>
                                <div class="webWhiteDiv1" v-if="view == 0">
                                    <div
                                        class="row center-align"
                                        v-if="websiteLoading"
                                    >
                                        <ButtonLoader />
                                    </div>
                                    <div v-else>
                                        <div v-if="websites.length > 0">
                                            <div
                                                class="row websitesViewRow"
                                                v-for="website in websites"
                                                :key="website.id"
                                            >
                                                <div class="col l2">
                                                    <div class="websiteTitle">
                                                        <div
                                                            class="
                                                                webWhiteProDiv
                                                            "
                                                        >
                                                            <img
                                                                :src="
                                                                    '/media/img/templateThumbnail/' +
                                                                    website
                                                                        .template
                                                                        .profession
                                                                        .name +
                                                                    '/' +
                                                                    website
                                                                        .template
                                                                        .imageUrl
                                                                "
                                                                class="
                                                                    responsive-img
                                                                "
                                                            />
                                                        </div>
                                                    </div>
                                                    <p
                                                        class="
                                                            websiteTemplateName
                                                            center-align
                                                        "
                                                    >
                                                        {{ website.name }}
                                                    </p>
                                                </div>
                                                <div
                                                    class="
                                                        col
                                                        l10
                                                        websiteTemplateDesc
                                                    "
                                                >
                                                    <h5>Description</h5>
                                                    <div class="col l9">
                                                        <p class="webWhiteTxt">
                                                            {{
                                                                website.description
                                                            }}
                                                        </p>
                                                    </div>

                                                    <div
                                                        class="
                                                            col
                                                            l3
                                                            right-align
                                                        "
                                                    >
                                                        <a
                                                            href="#!"
                                                            @click="
                                                                gotoDomain(
                                                                    website
                                                                )
                                                            "
                                                            class="marginRight1"
                                                            title="Visit my website"
                                                        >
                                                            <i
                                                                class="
                                                                    material-icons
                                                                "
                                                                id="webWhiteIcon"
                                                                >visibility</i
                                                            >
                                                        </a>
                                                        <a
                                                            href="#!"
                                                            @click="
                                                                configureWebsite(
                                                                    website
                                                                )
                                                            "
                                                            class="marginRight1"
                                                            title="Configure my webiste details"
                                                        >
                                                            <i
                                                                class="
                                                                    material-icons
                                                                "
                                                                id="webWhiteIcon"
                                                                >settings</i
                                                            >
                                                        </a>
                                                        <a
                                                            href="#!"
                                                            @click="
                                                                updateWebsite(
                                                                    website
                                                                )
                                                            "
                                                            title="Edit your website"
                                                        >
                                                            <i
                                                                class="
                                                                    material-icons
                                                                "
                                                                id="webWhiteIcon"
                                                                >edit</i
                                                            >
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="centre">
                                                <button
                                                    :disabled="loading"
                                                    v-show="
                                                        websites.length != total
                                                    "
                                                    class="
                                                        waves-effect waves-light
                                                        btn
                                                        loadmore
                                                    "
                                                    @click.prevent="getWebsites"
                                                >
                                                    <i
                                                        v-show="loading"
                                                        class="
                                                            fas
                                                            fa-stroopwafel
                                                            fa-spin
                                                            right
                                                        "
                                                    ></i
                                                    >load more
                                                </button>
                                            </div>
                                        </div>
                                        <div v-else>
                                            <p class="centered">
                                                No website created yet!. All
                                                websites appears here when you
                                                create one
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <ConfigureWebComponent
                    v-else-if="view == 1"
                    :loading="loading"
                    @updateDomainTemplate="updateDomainTemplate"
                    :domain="domain"
                    @goBack="setDefaults(0)"
                    :userProfessionId="userProfessionId"
                    :selectedTemplate="selectedTemplate"
                    :user="user"
                />
            </div>
        </div>
    </div>
</template>
<script>
    import MobileNavComponent from "../partials/MobileNavComponent.vue";
    import SideNavComponent from "../partials/SideNavComponent.vue";
    import TemplatePreviewComponent from "../partials/TemplatePreviewComponent.vue";
    import InnerFooterComponent from "../partials/InnerFooterComponent.vue";
    import WebCreateComponent from "../partials/WebCreateComponent.vue";
    import ConfigureWebComponent from "../partials/ConfigureWebComponent.vue";
    import ButtonLoader from "../partials/ButtonLoaderComponent.vue";
    export default {
        components: {
            MobileNavComponent,
            SideNavComponent,
            WebCreateComponent,
            TemplatePreviewComponent,
            InnerFooterComponent,
            ConfigureWebComponent,
            ButtonLoader,
            MobileNavComponent,
        },
        data() {
            return {
                bg_img: "/media/img/istockphoto-1390124896-170667a.jpg",
                domain: "",
                deleteModal: false,
                isHidden: false,
                loading: false,
                onEditWebModal: false,
                page: 1,
                professions: [],
                pro_img: "/media/img/yuna.jpg",
                selectedTemplate: "",
                tenant: {},
                total: 0,
                user: {},
                loadingUserProfessionId: false,
                userProfessionId: null,
                view: 0,
                siteToDelete: "",
                viewingTemplate: 0,
                websites: [],
                websiteLoading: false,
            };
        },
        mounted() {
            this.getWebsites();
            this.getProfessions();
            this.isHidden = !this.isHidden;
        },
        methods: {
            createWebsite(evt) {
                this.loading = true;
                evt.user_id = this.user.id;
                evt.name = evt.name.replace(/ +/g, "");
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
                            console.log();
                            this.loading = false;
                            // this.isHidden = !this.isHidden;
                            location.reload();
                        }
                    })
                    .catch((err) => {
                        if (err.response.status == 500) {
                            M.toast({
                                html: err.response.data.message,
                                classes: "errorNotifier",
                            });
                            this.loading = false;
                        }
                    });
            },
            close(evt) {
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
            getUser(e) {
                this.user = e;
                this.getUserDets();
            },
            getWebsites() {
                this.page == 1
                    ? (this.websiteLoading = true)
                    : (this.loading = true);
                axios
                    .get(`/api/tenancies/?page=${this.page++}`)
                    .then((res) => {
                        if (res.data.status == 200) {
                            this.websites = [
                                ...this.websites,
                                ...res.data.tenants.data,
                            ];
                            this.websiteLoading = false;
                            this.loading = false;
                            this.total = res.data.tenants.total;
                        }
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            },
            getUserDets() {
                axios
                    .get(`/api/userTitle/${this.user.id}`)
                    .then((res) => {
                        this.user.title = res.data.data;
                        this.userProfessionId = this.user.title.profession.id;
                        this.loadingUserProfessionId = true;
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            },
            setDefaults(num) {
                this.view = num;
            },
            gotoDomain(website) {
                this.tenant.domain =
                    typeof website.domains === "object"
                        ? website.domains[0].domain
                        : website.domains;
                window.open(`http://${this.tenant.domain}:8000`, "_blank");
            },
            updateWebsite(website) {
                this.tenant.domain =
                    typeof website.domains === "object"
                        ? website.domains[0].domain
                        : website.domains;
                window.open(`http://${this.tenant.domain}:8000/setting`, "_blank");
            },
            processTemp(evt) {
                this.selectedTemplate = evt.id;
            },
            configureWebsite(website) {
                this.setDefaults(1);
                this.selectedTemplate = website.template_id;
                this.tenant.template_id = website.template_id;
                this.tenant.domain =
                    typeof website.domains === "object"
                        ? website.domains[0].domain
                        : website.domains;
                this.domain = this.tenant.domain.split(".")[0];
                this.tenant.domain_id = website.domains[0].id;
                this.tenant.id = website.id;
            },
            toggleDeleteModal() {
                this.deleteModal = !this.deleteModal;
            },
            viewTemplate() {
                this.viewingTemplate = !this.viewingTemplate;
            },
            webAddCircleIcon() {
                this.isHidden = false;
            },
            updateDomainTemplate(evt) {
                this.loading = true;
                let data = { domain_id: this.tenant.domain_id };
                axios
                    .put(`/api/template-update/${this.tenant.id}`, {
                        ...evt,
                        ...data,
                    })
                    .then((res) => {
                        if (res.data.status == 200) {
                            console.log(res);
                            M.toast({
                                html: res.data.message,
                                classes: "successNotifier",
                            });
                            this.loading = false;
                        }
                    })
                    .catch((err) => {
                        this.loading = false;
                        if (err.response.status == 500) {
                            M.toast({
                                html: err.response.data.message,
                                classes: "errorNotifier",
                                displayLength: 6000,
                            });
                        }
                        console.log(err);
                    });
            },
        },
    };
</script>
<style scoped>
    .centered {
        color: black;
    }
    .danger {
        color: white;
        background-color: rgb(238, 112, 112);
    }
    .f-danger {
        justify-content: space-between;
        border: 1px solid rgb(224, 124, 124);
        padding: 20px;
    }
    .loadmore {
        text-align: center;
        background-color: #7746ff;
    }
</style>
<style>
    button[disabled="disabled"],
    .btn:disabled,
    .btn.disabled {
        border: 1px solid #d492f3;
        background-color: #c7bbeb !important;
        color: #fff;
    }
</style>