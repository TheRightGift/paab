<template>
    <div>
        <!-- Sidenav for small devices -->
        <mobile-nav-component />

        <div class="row" id="dashRowDiv">
            <!-- Sidebar for large and medium devices -->
            <sidenav-component @user="getUser" />

            <configure-web-component :loading="loading" @updateDomainTemplate="updateDomainTemplate"
                :domain="domainName" @goBack="setDefaults" :selectedTemplate="selectedTemplate" v-if="configureWeb"
                :user="user" :professionID="professionID" @giveAccess="giveAccess" :granting="granting"
                :claimantMail="claimantMail" />
            <!-- :userProfessionId="userProfessionId" -->
            <div class="col s12 m10 l10" id="webRightDiv" v-else>
                <!-- Admin Clients Section -->
                <div class="webRightDiv" v-if="heading">
                    <div class="row">
                        <div class="col s9 black websiteBanner">
                            <p class="webBlackTitle">
                                Your Clients - Websites
                            </p>
                            <p class="webBlackTxt">
                                Now is the time to create something exceptional with no limits.
                            </p>
                        </div>
                        <div class="col s3 primary" id="webAddContainer" @click="webAddCircleIcon()" v-if="isHidden">
                            <i class="material-icons webAddIcon">add</i>
                            <p>Create Website</p>
                        </div>
                        <div class="col s3 primaryBorder" id="webAddContainer" v-else>
                            <i class="material-icons webAddIcon2">linear_scale</i>
                            <p>Creating Website...</p>
                        </div>
                    </div>
                </div>

                <div v-if="clientsView">
                    <div class="adminClientSearchInputMainDiv">
                        <div>
                            <form>
                                <div class="input-field">
                                    <input placeholder="&#128269; Search by domain" id="adminClientSearchInput"
                                        type="text" class="validate" v-model="search" />
                                </div>
                            </form>
                        </div>
                        <div class="ml-2">
                            <a class="waves-effect waves-light red-text darken-4" @click="(faultyClients = true, clients = false)" v-if="!faultyClients"><i class="material-icons left">error</i> Failed Website Creations</a>
                            <a class="waves-effect waves-light black-text darken-4" @click="(faultyClients = false, clients = true)" v-else><i class="material-icons left">arrow_back</i> Return Back</a>
                        </div>

                        <div class="adminClientSearchInputControlDiv">
                            <div>
                                <span class="adminClientSearchInputTxts">Filter</span>
                                <i class="
                                        material-icons
                                        adminClientSearchInputIcons
                                    ">filter_list</i>
                            </div>

                            <div class="adminClientSearchInputIconsDiv">
                                <span class="adminClientSearchInputTxts">Sort</span>
                                <i class="
                                        material-icons
                                        adminClientSearchInputIcons
                                    ">sort</i>
                            </div>
                        </div>
                    </div>
                    <div class="row center-align" v-if="loading">
                        <ButtonLoaderComponent />
                    </div>
                    <table class="responsive-table adminAddClientTable" v-else-if="!loading && clients">
                        <tbody>
                            <tr class="adminAddClientTr" v-for="clientWebo in filteredClientWebsites()"
                                :key="clientWebo.id">
                                <td>
                                    <div class="adminAddClientImgDiv"></div>
                                </td>
                                <td class="addminAddClientTxts">
                                    {{ profession(clientWebo) }}
                                </td>
                                <td class="addminAddClientTxts">
                                    {{
                                        clientWebo.order == null
                                            ? "Not Assigned"
                                            : clientWebo.order.email
                                    }}
                                </td>
                                <td class="addminAddClientTxts">
                                    {{ domain(clientWebo) }}
                                </td>
                                <td class="right">
                                    <a
                                        href="#!"
                                        @click="sendMail(clientWebo)"
                                        class="marginRight1"
                                        title="Configure my webiste details"
                                        v-if="!sending && clientWebo.order.times_mailed === 0"
                                    >
                                        <img src="/media/img/mailer.svg" alt="svg" :title="'send mail to '+clientWebo.order.email "/>
                                    </a>
                                    <a href="#!" @click="sendMail(clientWebo)" class="marginRight1" :title="'Resend Message to user. You have mailed him '+clientWebo.order.times_mailed+' time'" v-else-if="!sending && clientWebo.order.times_mailed > 0"><i class="material-icons" id="webWhiteIcon">autorenew</i></a>
                                    <a class="marginRight1"  v-else>
                                        <i class="fas fa-circle-notch fa-spin"></i>
                                    </a>
                                    <a href="#!" @click="configureWebsite(clientWebo)" class="marginRight1"
                                        title="Configure my webiste details">
                                        <i class="material-icons" id="webWhiteIcon">settings</i>
                                    </a>
                                    <a href="#!" @click="updateWebsite(clientWebo)" title="Edit your website"
                                        class="marginRight1">
                                        <i class="material-icons" id="webWhiteIcon">edit</i>
                                    </a>
                                </td>
                            </tr>
                            <div class="centered" v-if="
                                search && !filteredClientWebsites().length
                            ">
                                <p class="error">No results found!</p>
                            </div>
                            <tr v-if="clientsWebsites.length == 0" class="centered">
                                You have not created any website for a client
                                sir!
                            </tr>
                        </tbody>
                    </table>
                    <div v-else-if="!loading && faultyClients">
                        <p class="right">
                            <a class="waves-effect waves-light btn-small  red darken-4" @click="removeAllFaultyUser" v-if="clientsFaultyWebsites.length > 0">Remove All</a>
                        </p>
                        <table class="responsive-table adminAddClientTable">
                            <tbody>
                                <tr class="adminAddClientTr" v-for="clientWebo in filteredClientsFaultyWebsites()"
                                    :key="clientWebo.id">
                                    <td>
                                        <div class="adminAddClientImgDiv"></div>
                                    </td>
                                    <td class="addminAddClientTxts">
                                        {{
                                            clientWebo.tenant_id
                                        }}
                                    </td>
                                    <td class="addminAddClientTxts">
                                        {{ clientWebo.email }}
                                    </td>
                                    <!-- <td class="right">
                                        <a href="#!" @click="removeNReinitiate(clientWebo)" title="Edit your website"
                                            class="marginRight1">
                                            <i class="material-icons" id="webWhiteIcon">edit</i>
                                        </a>
                                    </td> -->
                                    <td class="right">
                                        <a href="#!" @click="remove(clientWebo)" title="Remove user accounts" v-if="!sending"
                                            class="marginRight1 waves waves-effect nt-small">Remove
                                        </a>
                                        <a class="marginRight1"  v-else>
                                            <i class="fas fa-circle-notch fa-spin"></i>
                                        </a>
                                    </td>
                                </tr>
                                <div class="centered" v-if="
                                    search && !filteredClientsFaultyWebsites().length
                                ">
                                    <p class="error">No results found!</p>
                                </div>
                                <tr v-if="clientsFaultyWebsites.length == 0" class="centered">
                                    All Tenants Collected was created successful. No Issuses detected!
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="adminClientPaginationControlDiv" v-if="clientsWebsites.length != 0">
                        <div class="adminClientPaginationInnerControlDiv right">
                            <span class="adminClientPaginationNum">{{ data.from }}-{{ data.to }} of
                                {{ total }}</span>

                            <div class="adminClientPaginationIconDiv">
                                <i class="
                                        material-icons
                                        adminClientPaginationLeftIcon
                                    " v-if="data.prev_page_url != null"
                                    @click="getClientsWebsites(page--)">navigate_before</i>
                                <i v-else class="
                                        material-icons
                                        adminClientPaginationLeftIcon
                                        disabled
                                    ">navigate_before</i>
                                <i class="
                                        material-icons
                                        adminClientPaginationRightIcon
                                    " v-if="total != data.to" @click="getClientsWebsites(page++)">navigate_next</i>
                                <i v-else class="
                                        material-icons
                                        adminClientPaginationRightIcon
                                        disabled
                                    ">navigate_next</i>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-else-if="createClientView">
                    <web-create-component @close="closeWebCreation" :user="user" @createWebsite="createWebsite($event)"
                        :loading="creating" />
                </div>
            </div>
        </div>
    </div>
</template>
<!-- get from services all tracker -->
<!-- for payment get from paab count -->
<!-- for setting up account, check if title has been updated -->
<script>
import SidenavComponent from "../partials/SideNavComponent.vue";
import MobileNavComponent from '../partials/MobileNavComponent.vue';
import WebCreateComponent from "../partials/WebCreateComponent.vue";
import ButtonLoaderComponent from "../partials/ButtonLoaderComponent.vue";
import ConfigureWebComponent from "../partials/ConfigureWebComponent.vue";
export default {
    components: {
        SidenavComponent,
        MobileNavComponent,
        WebCreateComponent,
        ButtonLoaderComponent,
        ConfigureWebComponent,
    },
    data() {
        return {
            bg_img: "/media/img/istockphoto-1390124896-170667a.jpg",
            pro_img: "/media/img/yuna.jpg",
            creating: false,
            user: {},
            addClientDiv: false,
            clientsWebsites: [],
            masterDataSource: [],
            clients: false,
            faultyClients: false,
            masterDataForFaultySource: [],
            clientsFaultyWebsites: [],
            clientsView: false,
            configureWebDiv: false,
            configureWeb: false,
            createClientView: false,
            fetching: false,
            heading: false,
            isHidden: false,
            granting: false,
            page: 1,
            total: 0,
            data: {
                to: 0,
                from: 0,
                prev_page_url: null,
            },
            search: "",
            sending: false,
            selectedTemplate: 0,
            tenant: { template_id: 0, domain: "", domain_id: 0, id: 0 },
            domainName: "",
            claimantMail: "",
            professionID: 0,
            loading: false,
        };
    },
    computed: {},
    mounted() {
        this.isHidden = !this.isHidden;
        this.heading = !this.heading;
        this.clientsView = !this.clientsView;
        this.clients = !this.clients;
        this.getClientsWebsites();
        this.getFaultyClientWebsitesCr8n();
        this.getAccess();
    },
    methods: {
        configureWebsite(website) {
            this.heading = !this.heading;
            this.configureWeb = true;
            this.clientsView = false;
            this.selectedTemplate = website.template_id;
            this.tenant.template_id = website.template_id;
            this.tenant.domain =
                typeof website.domains === "object"
                    ? website.domains[0].domain
                    : website.domains;
            this.domainName = this.tenant.domain.split(".")[0];
            this.claimantMail = website.order == null ? '' : website.order.email;
            this.tenant.domain_id = website.domains[0].id;
            this.tenant.id = website.id;
            this.professionID = website.template.profession.id;
        },
        createWebsite(evt) {
            this.creating = true;
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
                        location.reload();
                    }
                })
                .catch((err) => {
                    console.log(err);
                    if (err.response.status == 500) {
                        M.toast({
                            html: err.response.data.message,
                            classes: "errorNotifier",
                        });
                    }
                    this.creating = false;
                    if (err.response.status == 501) {
                        M.toast({
                            html: err.response.data.errors,
                            classes: "errorNotifier",
                        });
                    }
                });
        },
        domain(evt) {
            return evt.domains == undefined ? null : evt.domains[0].domain;
        },
        profession(evt) {
            return evt.template == undefined
                ? null
                : evt.template.profession.name;
        },
        getUser(e) {
            this.user = e;
        },
        getClientsWebsites() {
            this.page == 1 ? (this.fetching = true) : (this.loading = true);
            axios
                .get(`/api/tenancies/?page=${this.page}`)
                .then((res) => {
                    if (res.data.status == 200) {
                        this.clientsWebsites = res.data.tenants.data;
                        this.masterDataSource = res.data.tenants.data;
                        this.data.to = res.data.tenants.to;
                        this.data.from = res.data.tenants.from;
                        this.data.prev_page_url =
                            res.data.tenants.prev_page_url;
                        this.fetching = false;
                        this.loading = false;
                        this.total = res.data.tenants.total;
                    }
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        getFaultyClientWebsitesCr8n() {
            axios
                .get(`/api/get_tenants_with_faultycr8`)
                .then((res) => {
                    this.clientsFaultyWebsites = res.data.data;
                    this.masterDataForFaultySource = res.data.data;
                }).catch(err => {
                    console.log(err);
                })
        },
        deleteWebsite(e) {
            console.log(e);
        },
        webAddCircleIcon() {
            this.isHidden = false;
            this.clientsView = false;
            this.createClientView = true;
        },
        closeWebCreation() {
            this.isHidden = true;
            this.clientsView = true;
            this.createClientView = false;
        },
        filteredClientWebsites() {
            return this.masterDataSource.filter((item) =>
                item.domains[0].domain
                    .toUpperCase()
                    .includes(this.search.toUpperCase())
            );
        },
        filteredClientsFaultyWebsites () {
            return this.masterDataForFaultySource.filter((item) => item.tenant_id.toUpperCase().includes(this.search.toUpperCase()));
        },
        removeAllFaultyUser () {
            this.sending = true;
            axios.get(`/api/remove_tenants_with_faultycr8`).then(res => {
                if (res.status === 204) {
                    M.toast({
                        html: `Tenants With issue on automation creation deleted`,
                        classes: 'successNotifier'
                    });
                    this.sending = false;
                    location.reload();
                }
            }).catch(err => {
                this.sending = false;
                console.log(err);
            })
        },
        remove(evt) {
            this.sending = true;
            axios.get(`/api/remove_tenant_with_faultycr8/${evt.tenant_id}`).then(res => {
                console.log(res);
                if (res.status === 204) {
                    M.toast({
                        html: `Tenant with id ${evt.tenant_id} deleted`,
                        classes: 'successNotifier'
                    });
                    this.sending = false;
                    // Do splice to remove from array
                    location.reload();
                }
            }).catch(err => {
                this.sending = false;
                console.log(err);
            })
        },
        setDefaults() {
            this.heading = !this.heading;
            this.configureWeb = !this.configureWeb;
            this.clientsView = !this.clientsView;
            this.claimantMail = "";
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
                        M.toast({
                            html: res.data.message,
                            classes: "successNotifier",
                        });
                        this.loading = false;
                        this.tenant.template_id =
                            res.data.domain.tenant.template_id;
                        location.reload();
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
        updateWebsite(website) {
            this.tenant.domain =
                typeof website.domains === "object"
                    ? website.domains[0].domain
                    : website.domains;
            window.open(`https://${this.tenant.domain}.whitecoatdomain.com/setting`, "_blank");
        },
        giveAccess(evt) {
            this.granting = true;
            let data = {
                email: evt,
                tenant_id: this.tenant.id,
                user_id: this.user.id,
            };
            axios
                .post("/api/access", data)
                .then((res) => {
                    if (res.status == 201) {
                        this.granting = false;
                        M.toast({
                            html: res.data.message,
                            classes: "successNotifier",
                        });
                    }
                })
                .catch((err) => {
                    console.log(err);
                    M.toast({
                        html: err.response.data.message,
                        classes: "errorNotifier",
                        displayLength: 6000,
                    });
                    this.granting = false;
                });
        },
        getAccess() {
            axios
                .get("/api/access")
                .then((res) => {
                    // console.log(res);
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        sendMail(mail) {
                this.sending = true;
                let data = {
                    "email": mail.order.email,
                    // Changed from https://whitecoatdomain.com/getstared to tenant subdomain
                    "url": `https://${mail.domains[0].domain}.whitecoatdomain.com`,
                    "profilePix": "string",
                    "title": mail.domains[0].domain,
                    'tenancy_db_name': mail.tenancy_db_name,
                    'tenant_id': mail.domains[0].tenant_id,
                };
                axios.post('/api/sendClaimMail', data).then(res => {
                    this.sending = false;
                    M.toast({
                        html: res.data.status,
                        classes: 'successNotifier'
                    })
                }).catch(err => {
                    this.sending = false;
                    M.toast({
                        html: err.response.data.message,
                        classes: 'errorNotifier'
                    })
                    console.log(err);
                })
            },
    },
};
</script>
<style>
.clientCreatePortCancelDiv {
    margin: 10px;
}
</style>
<style scoped>
#webWhiteIcon {
    font-size: 1.25rem;
}

.disabled {
    color: rgba(0, 0, 0, 0.5);
}
</style>