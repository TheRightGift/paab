<template>
    <div>
        <mobile-nav-component />
        <!-- Sidebar for large and medium devices -->
        <div class="row" id="dashRowDiv">
            <sidenav-component />

            <div class="col s12 m10 l10">
                <!-- Staff black rectangular div -->
                <div class="staffBlackDiv">
                    <div class="staffBlackInnerDiv">
                        <div class="row staffBlackInnerDiv">
                            <div class="col s12">
                                <p class="staffTitle">Add Staff</p>
                            </div>
                            <div class="col s11">
                                <p class="staffTxt">
                                    Now is the time to create something
                                    exceptional with no limits.
                                </p>
                            </div>
                            <div class="col s1">
                                <!-- Add Staff Modal Trigger -->
                                <a
                                    href="#addStaffModal"
                                    class="marginRight1 modal-trigger"
                                >
                                    <i class="material-icons staffIcon right"
                                        >add_circle</i
                                    >
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="staffSearchInputMainDiv">
                    <div>
                        <form>
                            <div class="input-field">
                                <input placeholder="&#128269; Search" id="staffSearchInput" type="text"
                                    class="validate" v-model="search" />
                            </div>
                        </form>
                    </div>
        
                    <div class="staffSearchInputControlDiv">
                        <div>
                            <span class="staffSearchInputTxts">Filter</span>
                            <i class="material-icons staffSearchInputIcons">filter_list</i>
                        </div>
        
                        <div class="staffSearchInputIconsDiv">
                            <span class="staffSearchInputTxts">Sort</span>
                            <i class="material-icons staffSearchInputIcons">sort</i>
                        </div>
                    </div>
                </div>

                <div v-if="admins.length > 0">
                    <!-- View all Staff Table -->
                    <table class="responsive-table">
                        <tbody>
                            <tr v-for="admin in filteredAdmins()" :key="admin.id">
                                <td>
                                    <div class="addStaffTableImgDiv"></div>
                                </td>
                                <!-- <td class="addStaffTableTxts">
                                    Dr
                                </td> -->
                                <td class="addStaffTableTxts">
                                    {{admin.firstname}}
                                </td>
                                <td class="addStaffTableTxts">
                                    {{admin.lastname}}
                                </td>
                                <td class="addStaffTableTxts">
                                    {{admin.othername}}
                                </td>
                                <td class="addStaffTableTxts">
                                    {{admin.email}}
                                </td>
                                <td class="right">
                                    <a @click="getId2Edit(admin)" href="#!" class="modal-trigger marginRight1 btn addStaffEditBtn">
                                        Edit
                                    </a>
                                    <!-- Delete Staff Modal Trigger -->
                                    <a @click="getId2Del(admin)" href="#deleteStaffModal" class="marginRight1 btn addStaffDeleteBtn modal-trigger">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
                <div class="row" v-else>
                    <p class="center-align noStaffTxt">
                        No staff found
                        <!-- Add Staff Modal Trigger -->
                        <a href="#addStaffModal" class="noStaffCreateTempLink modal-trigger">Add staff</a>
                    </p>
                </div>
                <div class="centered" v-if="
                    search && !filteredAdmins().length
                ">
                    <p class="error">No results found!</p>
                </div>
                <!-- <InnerFooterComponent /> -->
            </div>
        </div>
        <!-- Staff's Add and Delete Modals -->
        <!-- ------------------------------------------------------------------------------------- -->

        <!-- Add Staff Modal Structure -->
        <div id="addStaffModal" class="modal">
            <form @submit.prevent="createAdmin">
                <div class="row">
                    <div class="input-field col s12 m6 l6">
                        <input
                            type="text"
                            id="staffLname"
                            v-model="admin.lastname"
                            required
                            placeholder="Last Name"
                            class="validate"
                        />
                    </div>

                    <div class="input-field col s12 m6 l6">
                        <input
                            type="text"
                            id="staffFname"
                            placeholder="First Name"
                            class="validate"
                            v-model="admin.firstname"
                            required
                        />
                    </div>

                    <div class="input-field col s12 m6 l6">
                        <input
                            type="text"
                            id="staffOtherName"
                            placeholder="Other Name"
                            class="validate"
                            v-model="admin.othername"
                        />
                    </div>

                    <div class="input-field col s12 m6 l6">
                        <input
                            type="text"
                            id="staffEmail"
                            placeholder="Email"
                            class="validate"
                            v-model="admin.email"
                        />
                    </div>
                </div>

                <div class="row center-align">
                    <button class="staffCreateBtn btn-flat" :disabled="loading">
                        Create
                    </button>
                </div>
            </form>
        </div>

        <!-- Delete Staff Modal Structure -->
        <div id="deleteStaffModal" class="modal">
            <div class="row logoutModalImageRow">
                <img
                    src="/media/img/warning.png"
                    alt="Illustrating a warning that you will be logged out"
                    id="errAltImg"
                    class="logoutModalImage"
                />
            </div>
            <div class="row center-align">
                <p class="staffDeleteModalTitle">
                    You are about to delete this client
                </p>
            </div>

            <div class="row center-align">
                <button
                    class="confirmDeleteBtn btn-flat"
                    @click="deleteTemplate"
                >
                   <span v-if="!loading">Yes</span>
                   <i class="fas-spinner fa-spin" v-else-if="loading"></i>
                </button>
                <span class="gutter1"></span>
                <button class="modal-close cancelDeleteBtn btn-flat">No</button>
            </div>
        </div>
        <!-- ------------------------------------------------------------------------------------- -->
    </div>
</template>

<script>
    import MobileNavComponent from "../partials/MobileNavComponent.vue";
    import SidenavComponent from "../partials/SideNavComponent.vue";
    import InnerFooterComponent from "../partials/InnerFooterComponent.vue";
    export default {
        components: {
            SidenavComponent,
            MobileNavComponent,
            InnerFooterComponent,
        },
        data() {
            return {
                admin: {
                    firstname: "",
                    lastname: "",
                    othername: "",
                    password: "",
                    email: "",
                    role: "Admin",
                },
                admins: [],
                addStaff: 1,
                loading: false,
                search: "",
            };
        },
        mounted() {
            this.getAdmins();
        },
        methods: {
            createAdmin() {
                this.loading = !this.loading;
                axios
                    .post("/api/admin", this.admin)
                    .then((res) => {
                        if (res.status == 201) {
                            this.loading = !this.loading;
                            M.toast({
                                html: res.data.message,
                                classes: "successNotifier",
                            });
                            this.admin.firstname = "";
                            this.admin.lastname = "";
                            this.admin.email = "";
                            this.admin.othername = "";
                            this.admin.password = "";
                            let elem = document.getElementById("addStaffModal"); //.getElementsByClassName('modal-close').click()
                            var instance = M.Modal.getInstance(elem);
                            instance.close();
                        }
                    })
                    .catch((err) => {
                        if (err.response.status == 400) {
                            err.response.data.forEach((el) => {
                                M.toast({
                                    html: el,
                                    classes: "errorNotifier",
                                });
                            });
                            this.loading = false;
                        }
                        console.log(err);
                    });
            },
            deleteTemplate() {
                this.loading = !this.loading;
                axios.delete(`/api/deleteAdmin/${this.admin.id}`)
                    .then((res) => {
                        if (res.status == 204) {
                            M.toast({
                                html: 'Admin moved to archive',
                                classes: "successNotifier",
                            });
                            this.loading = !this.loading;
                        }
                        let elem = document.getElementById("deleteStaffModal"); //.getElementsByClassName('modal-close').click()
                        var instance = M.Modal.getInstance(elem);
                        instance.close();
                        this.admins.splice(
                            this.admins.findIndex(
                                (admin) => admin.id === this.admin.id
                            ),
                            1
                        );
                    })
                    .catch((err) => {
                        this.loading = !this.loading;
                        console.log(err);
                    });
            },
            filteredAdmins() {
                return this.admins.filter((item) =>
                    item.firstname
                        .toUpperCase()
                        .includes(this.search.toUpperCase())
                );
            },
            getAdmins() {
                this.loading = !this.loading;
                axios.get('/api/admins').then(res => {
                    this.loading = !this.loading;
                    this.admins = res.data.admins;
                }).catch(err => {
                    console.log(err);
                })
            },
            getId2Del(admin) {
                this.admin.id = admin.id;
            },
            getId2Edit(admin) {
                this.admin.id = admin.id;
                this.admin.firstname = admin.firstname;
                this.admin.lastname = admin.lastname;
                this.admin.othername = admin.othername;
                this.admin.email = admin.email;
            }
        },
    };
</script>
<style scoped>
    .flexed {
        display: flex;
        justify-content: center;
    }
    .btn {
        background-color: #7746ff;
    }
    .btn:hover {
        background-color: #aa8ff5;
    }
</style>