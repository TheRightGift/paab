<template>
    <div>
        <!-- Sidenav for small devices -->
        <mobile-nav-component />

        <div class="row" id="dashRowDiv">
            <!-- Sidebar for large and medium devices -->
            <sidenav-component @user="getUser" />
            <div class="col s12 m10 l10" id="webRightDiv">
                <!-- Admin Clients Section -->
                <div class="webRightDiv">
                    <div class="row">
                        <div class="col s9 black websiteBanner">
                            <p class="webBlackTitle">Projects - Overview</p>
                            <p class="webBlackTxt">
                                Now is the time to create something exceptional
                                with no limits.
                            </p>
                        </div>
                        <div
                            class="col s3 primaryBorder hoverable"
                            id="webAddContainer"
                            @click="openForm"
                        >
                            <i class="material-icons webAddIcon2">add</i>
                            <p>Submit</p>
                        </div>
                    </div>
                </div>

                <div v-if="!formOpen">
                    <div class="adminClientSearchInputMainDiv">
                        <div>
                            <form>
                                <div class="input-field">
                                    <input
                                        placeholder="&#128269; Search by name"
                                        id="adminClientSearchInput"
                                        type="text"
                                        class="validate"
                                        v-model="search"
                                    />
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row center-align" v-if="loading">
                        <ButtonLoaderComponent />
                    </div>
                    <table class="responsive-table adminAddClientTable" v-else>
                        <tbody>
                            <tr
                                class="adminAddClientTr"
                                v-for="dev in filteredProjects()"
                                :key="dev.id"
                            >
                                <td class="addminAddClientTxts">
                                    {{ dev.name }}
                                </td>
                                <td class="addminAddClientTxts">
                                    {{ dev.zip_url }}
                                </td>
                                <td class="addminAddClientTxts">
                                    {{ dev.approved == 0 ? 'Not Approved' : 'Approved' }}
                                </td>
                                <td class="addminAddClientTxts">
                                    <a href="#!" @click="update(dev)">Update</a>
                                </td>
                                
                            </tr>
                            <div
                                class="centered"
                                v-if="search && !filteredProjects().length"
                            >
                                <p class="error">No results found!</p>
                            </div>
                            <tr v-if="projects.length == 0" class="centered">
                                You have not created any website for a client
                                sir!
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="row z-depth-4" v-else id="reduced">
                    <form
                        class="col s12"
                        @submit.prevent="storeProjectAndRetrive"
                    >
                        <h5>Submit Project</h5>
                        <div class="row">
                            <div class="input-field col s12">
                                <input
                                    type="text"
                                    class="validate"
                                    v-model="project.name"
                                />
                                <label for="Project Name">Project Name</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="file-field input-field">
                                <div class="btn">
                                    <span>File</span>
                                    <input
                                        type="file"
                                        accept=".zip,.rar,.7zip"
                                        @change="handleFileChange"
                                    />
                                </div>
                                <div class="file-path-wrapper">
                                    <input
                                        class="file-path validate"
                                        type="text"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <button
                                :disabled="loading"
                                class="col s12 purple darken-4 btn waves waves-effect"
                                type="submit"
                            >
                                <span v-if="!loading">Submit</span>
                                <span
                                    v-else
                                    class="fas fa-spinner fa-spin fa-1x"
                                ></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import SidenavComponent from "../partials/SideNavComponent.vue";
    import WebCreateComponent from "../partials/WebCreateComponent.vue";
    import ButtonLoaderComponent from "../partials/ButtonLoaderComponent.vue";
    import MobileNavComponent from "../partials/MobileNavComponent.vue";
    export default {
        components: {
            SidenavComponent,
            WebCreateComponent,
            ButtonLoaderComponent,
            MobileNavComponent,
        },
        data() {
            return {
                user: {},
                projects: [],
                masterDataSource: [],
                fetching: false,
                page: 1,
                total: 0,
                loading: false,
                data: {
                    to: 0,
                    from: 0,
                    prev_page_url: null,
                },
                search: "",
                verifying: false,
                formOpen: false,
                project: {
                    name: "",
                    zip_url: "",
                    developer_id: "",
                },
            };
        },
        computed: {},
        methods: {
            openForm() {
                this.formOpen = true;
            },
            isDataChecked(dev) {
                // Use a computed property to determine the checked state based on the received data
                console.log(dev);
                return dev.registration_completed === "Active";
            },
            getUser(e) {
                this.user = e;
                this.getDevProjects(e.id);
            },
            getDevProjects(userID) {
                axios
                    .get(`/api/show/${userID}`)
                    .then((res) => {
                        if (res.data.data.developer !== null) {
                            this.projects = res.data.data.developer.projects;
                            this.masterDataSource =
                                res.data.data.developer.projects;
                            this.project.developer_id = res.data.data.developer.id;
                        }
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            },
            storeProjectAndRetrive() {
                this.loading = true;
                let formData = new FormData();
                formData.append("name", this.project.name);
                formData.append("zip_url", this.project.zip_url);
                formData.append("developer_id", this.project.developer_id);
                axios
                    .post(`/api/store_project/`, formData)
                    .then((res) => {
                        if (res.status == 201) {
                            M.toast({
                                html: 'Success',
                                classes: 'successNotifier',
                            });
                            this.formOpen = false;
                            location.reload();
                        } else {
                            M.toast({
                                html: res.data.error,
                                classes: 'errorNotifier',
                            })
                        }
                        this.loading = false;
                    })
                    .catch((err) => {
                        console.log(err);
                        this.loading = false;
                    });
            },
            filteredProjects() {
                return this.masterDataSource.filter((item) =>
                    item.name.toUpperCase().includes(this.search.toUpperCase())
                );
            },
            handleFileChange(e) {
                this.project.zip_url = e.target.files[0];
            },
            update(dev) {
                axios.put(`/api/update_project/`)
            }
        },
    };
</script>
<style>
    .clientCreatePortCancelDiv {
        margin: 10px;
    }
    .roundedName {
        width: 50px;
        height: 50px;
        border-radius: 100%;
        line-height: 50px;
        background-color: var(--sec);
        color: var(--white);
        font-weight: 700;
        font-family: Roboto, sans-serif;
        text-align: center;
    }
    .webRightDiv .row {
        display: flex;
        align-items: stretch; /* Stretch items vertically to have the same height */
    }

    .webRightDiv .col {
        flex-grow: 1 !important; /* Allow columns to grow and fill the available space */
    }
    @media screen and (max-width: 640px) {
        #webAddContainer {
            display: flex !important;
            text-align: center;
        }
    }
</style>
<style scoped>
    #webWhiteIcon {
        font-size: 1.25rem;
    }
    .disabled {
        color: rgba(0, 0, 0, 0.5);
    }
    #reduced {
        display: flex;
        justify-content: center;
        width: 50%;
        margin: auto;
        padding: 30px;
    }
</style>