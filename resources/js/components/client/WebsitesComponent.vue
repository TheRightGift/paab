<template>
    <div>
        <!-- Sidenav for small devices -->
        <div v-if="!viewingTemplate">
            <mobile-nav-component />

            <!-- Sidebar for large and medium devices -->
            <div class="row" id="dashRowDiv">
                <side-nav-component />

                <!-- Web black div -->
                <div class="col s12 m10 l10" v-if="view == 0">
                    <div id="webRightDiv">
                        <div class="col s9 black websiteBanner">
                            <p class="webBlackTitle">
                                Create Portfolio
                            </p>
                            <p class="webBlackTxt">
                                Lets start and automate your process so
                                you can reclaim time and focus on your
                                goals.
                            </p>
                        </div>
                        <div class="col s3 primary" id="webAddContainer" @click="webAddCircleIcon()" v-if="isHidden">
                            <i class="material-icons webAddIcon">add</i>
                            <p>Create Website</p>
                        </div>
                        <div class="col s3 primaryBorder" id="webAddContainer" v-else>
                            <i class="material-icons webAddIcon">linear_scale</i>
                            <p>Creating Website...</p>
                        </div>
                    

                        <!-- web empty div -->
                        <div class="col s12 webWhiteDiv">
                            <web-create-component @createWebsite="createWebsite($event)" @close="close($event)" v-if="!isHidden && loadingUserProfessionId" :loading="loading" :userProfessionId="userProfessionId"/>
                            <div v-else>
                                <div class="webWhiteDiv1" v-if="view == 0">
                                    <div class="row">
                                        <div class="col l2 webWhiteTitle">
                                            Title
                                        </div>
                                        <div class="col l2 webWhiteTitle websiteTitle">
                                            Template
                                        </div>
                                        <div class="col l6 webWhiteTitle">
                                            Description
                                        </div>
                                        <div class="col l2 webWhiteTitle  right-align">
                                            Actions
                                        </div>
                                    </div>
                                    <div v-if="websites.length > 0">
                                        <div
                                            class="row websitesViewRow"
                                            v-for="website in websites"
                                            :key="website.id"
                                        >
                                            <div class="col l2">
                                                <p class="webWhiteProName">
                                                    {{ website.name }}
                                                </p>
                                            </div>
                                            <div class="col l2">
                                                <div class="websiteTitle">
                                                    <div class="webWhiteProDiv">
                                                        <img :src="'/media/img/templateThumbnail/'+website.template.profession.name+'/'+website.template.imageUrl" class="responsive-img" />
                                                    </div>
                                                </div>
                                            </div>
    
                                            <div class="col l6">                                            
                                                <p class="webWhiteTxt">
                                                    {{ website.description }}
                                                </p>
                                            </div>
    
                                            <div class="col l2 right-align">
                                                <a href="#!" @click="gotoDomain(website)" class="marginRight1" title="Visit my website">
                                                    <i class="material-icons" id="webWhiteIcon">open_in_new</i>
                                                </a>
                                                <a href="#!" @click="configureWebsite(website)" class="marginRight1" title="Configure my webiste details">
                                                    <i class="material-icons" id="webWhiteIcon">settings</i>
                                                </a>
                                                <a href="#!" @click="updateWebsite(website)" title="Edit your website">
                                                    <i class="material-icons" id="webWhiteIcon">edit</i>
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
                                <div class="webWhiteDiv1" v-else>
                                    <div class="row">
                                        <a @click="setDefaults(0)" id="clientCreatePortCancelIconBtn" class="waves-effect waves-light btn-flat"><i class="material-icons left">arrow_back</i>Go Back</a>
                                        <form id="bioForm">

                                            <div class="row">
                                                <div class="row">
                                                    <p class="bioTitle">Templates</p>
                                                    <small>You can change to your desired template from here</small>
                                                    <!--template-selector-component :selectedTemplate="selectedTemplate" @tempSel="processTemp($event)" :professionId="userProfessionId"/-->
                                                    <TemplatePreviewComponent :selectedTemplate="selectedTemplate" @tempSel="processTemp($event)" :professionId="userProfessionId" :type="'create'"/>

                                                    <p class="bioTitle">Website</p>
                                                    <div class="input-field col s12">
                                                        <input type="text" id="bioCvInput" placeholder="Change domain name" v-model="domain">
                                                        <button type="button" class="col s2 right btn" id="bioModalBtn" @click.prevent="updateDomainTemplate">
                                                            <span>save</span>
                                                        </button>
                                                    </div>
                                                    
                                                    <p class="bioTitle">Danger Zone</p>
                                                    <div class="flexed f-danger">
                                                        <div>
                                                            <h6>Delete Website</h6>
                                                            <small>You can delete your website</small>
                                                        </div>
                                                        <div>
                                                            <a class="waves-effect waves-light btn danger modal-trigger" href="#!" @click="toggleDeleteModal">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </form>
                                    </div>

                                    <div id="setupWebRightDiv" v-if="deleteModal">
                                        <div class="setWebContainModalDiv">
                                            <div class="setWebInnerModalDiv" id="bioForm">
                                                Please type the word in bold<p class="bioTitle setWebTitleData">{{tenant.id}}</p>
                                                    <div class="input-field col s12">
                                                        <input type="text" id="bioCvInput" placeholder="Enter the name above" v-model="siteToDelete">
                                                    </div>

                                                <div class="row" id="setWebBtnDiv">
                                                    <button
                                                        class="col s12 btn"
                                                        type="button"
                                                        id="setWebBtn"
                                                        @click="deleteWebsite"
                                                    >
                                                        DELETE
                                                    </button>

                                                    <button
                                                        class="col s12 btn"
                                                        type="button"
                                                        id="setWebBtn1"
                                                        @click="toggleDeleteModal"
                                                    >
                                                        CANCEL
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import MobileNavComponent from '../partials/MobileNavComponent.vue';
    import SideNavComponent from '../partials/SideNavComponent.vue';
    import TemplatePreviewComponent from '../partials/TemplatePreviewComponent.vue';
    import WebCreateComponent from './WebCreateComponent.vue';

    export default{
        components: {
            MobileNavComponent,
            SideNavComponent,
            WebCreateComponent,
            TemplatePreviewComponent
        },
        data() {
            return {
                bg_img: "/media/img/istockphoto-1390124896-170667a.jpg",
                domain: "",
                deleteModal: false,
                isHidden: false,
                loading: false,
                onEditWebModal: false,
                professions: [],
                pro_img: "/media/img/yuna.jpg",
                selectedTemplate: "",
                tenant: {},
                user: {},
                loadingUserProfessionId: false,
                userProfessionId: null,
                view: 0,
                siteToDelete: "",
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
                            console.log()
                            this.loading = false;
                            // this.isHidden = !this.isHidden;          
                            location.reload();                  
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
                        this.getUserDets()
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
                            console.log(res.data)
                            this.websites = res.data.tenants;
                        }
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            },
            getUserDets() {
                axios.get(`/api/userTitle/${this.user.id}`).then(res => {
                    this.user.title = res.data.data;
                    this.userProfessionId = this.user.title.profession.id;
                    this.loadingUserProfessionId = true;
                }).catch(err => {
                    console.log(err)
                });
            },
            
            setDefaults(num) {
                this.view = num;
            },
            gotoDomain(website) {
                this.tenant.domain = typeof(website.domains) === "object"? website.domains[0].domain : website.domains;
                window.open(`http://${this.tenant.domain}:8000`,'_blank');
                // this.tenant.name = website.name;
                // this.tenant.description = website.description;
                // this.tenant.created_at = website.created_at;
                // this.setDefaults(1);
            },
            updateWebsite(website){
                this.tenant.domain = typeof(website.domains) === "object"? website.domains[0].domain : website.domains;
                window.open(`http://${this.tenant.domain}:8000/setting`,'_blank');
            },
            processTemp(evt) {
                this.selectedTemplate = evt.id;
            },
            configureWebsite(website){
                this.view = 3;
                this.selectedTemplate = website.template_id;
                this.tenant.template_id = website.template_id;
                this.tenant.domain = typeof(website.domains) === "object"? website.domains[0].domain : website.domains;
                this.domain = this.tenant.domain.split('.')[0];
                this.tenant.domain_id = website.domains[0].id
                this.tenant.id = website.id;
            },
            toggleDeleteModal(){
                this.deleteModal = !this.deleteModal;
            },
            viewTemplate() {
                this.viewingTemplate = !this.viewingTemplate;
            },
            webAddCircleIcon() {
                this.isHidden = false;
            },
            updateDomainTemplate() {
                this.loading = true;
                let data = {tenant_id: this.tenant.id};
                if (this.domain !== this.tenant.domain.split('.')[0]) {
                    data.domain = this.domain;
                    data.domain_id = this.tenant.domain_id;
                }
                if (this.tenant.template_id != this.selectedTemplate)
                {
                    data.template_id = this.selectedTemplate;
                }
                axios.put(`/api/template-update/${this.tenant.id}`, data).then(res => {
                    if (res.data.status == 200) {
                        M.toast({
                            html: res.data.message,
                            classes: "successNotifier",
                        });
                    }
                }).catch(err => {
                    console.log(err);
                })
            }
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
</style>