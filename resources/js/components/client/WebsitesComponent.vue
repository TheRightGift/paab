<template>
    <div>
        <SideNavComponent @user="getUser" />
        <HeaderComponent :user="user" />
        <main>
            <section>
                <div v-if="view === 0">
                    <div class="w-485">
                        <p class="welcomeName mb-0">Create Portfolio</p>
                        <span class="supportWelcomeNote">
                            Lets start and automate your process so you can reclaim
                            time and focus on your goals.
                        </span>
                    </div>
                    <div class="d-flex gap-31 px-50">
                        <p class="fs-1 fw-500">Profession</p>
                        <p class="fs-1 fw-500">ID</p>
                    </div>
                    <div
                        class="website d-flex justify-between align-center px-2"
                        v-for="website in websites"
                        :key="website.id"
                    >
                        <div class="d-flex align-center justify-between gap-1">
                            <img
                                :src=" '/media/img/templateThumbnail/' +
                                website.template.title +
                                '/' +
                                website.template.imageUrl"
                                class="responsive-img w-32 h-32 circle"
                            />
                            <span class="specialty">
                                {{ website.template.title }}
                            </span>
                        </div>
                        <span class="tenantID">
                            {{ website.name }}
                        </span>
                        <div class="d-flex gap-1 icons">
                            <a
                                href="#!"
                                @click="gotoDomain(website)"
                                class=""
                                title="Visit my website"
                            >
                                <i class="material-icons"
                                    >visibility</i
                                >
                            </a>
                            <a
                                href="#!"
                                @click="configureWebsite(website)"
                                class=""
                                title="Configure my webiste details"
                            >
                                <i class="material-icons"
                                    >settings</i
                                >
                            </a>
                            <a
                                href="#!"
                                @click="updateWebsite(website)"
                                title="Edit your website"
                            >
                                <i class="material-icons">edit</i>
                            </a>
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
            </section>
        </main>
    </div>
</template>
<style scoped>
    .w-485 {
        width: 485px;
    }
    .icons a:first-child {
        color: #699BF7;
    }
    .icons a:nth-child(2) {
        color: #474747;
    }
    .icons a:last-child {
        color: #109DAD;
    }
    .gap-31 {
        gap: 30vw;
    } 
    .px-50 {
        padding: 0 50px;
    }
</style>
<script>
    import MobileNavComponent from "../partials/MobileNavComponent.vue";
    import SideNavComponent from "../partials/SideNavComponent.vue";
    import TemplatePreviewComponent from "../partials/TemplatePreviewComponent.vue";
    import InnerFooterComponent from "../partials/InnerFooterComponent.vue";
    import WebCreateComponent from "../partials/WebCreateComponent.vue";
    import ConfigureWebComponent from "../partials/ConfigureWebComponent.vue";
    import ButtonLoader from "../partials/ButtonLoaderComponent.vue";
    import HeaderComponent from "../partials/HeaderComponent.vue";
    export default {
        components: {
            MobileNavComponent,
            SideNavComponent,
            WebCreateComponent,
            TemplatePreviewComponent,
            InnerFooterComponent,
            ConfigureWebComponent,
            ButtonLoader,
            HeaderComponent,
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
                window.open(
                    `https://${this.tenant.domain}.whitecoatdomain.com`,
                    "_blank"
                );
            },
            updateWebsite(website) {
                this.tenant.domain =
                    typeof website.domains === "object"
                        ? website.domains[0].domain
                        : website.domains;
                window.open(
                    `https://${this.tenant.domain}.whitecoatdomain.com/setting`,
                    "_blank"
                );
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