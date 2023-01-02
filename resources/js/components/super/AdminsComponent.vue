<template>
    <div>
        <mobile-nav-component />
        <!-- Sidebar for large and medium devices -->
        <div class="row" id="dashRowDiv">
            <sidenav-component @user="getUser" />

            <div class="col s12 m10 l10">
                <div class="dashRightDiv">
                    <div class="row" id="dashWlcNoteRowDiv">
                        <h1>Admins</h1>
                        <h6>Create admin from here</h6>
                        <form @submit.prevent="createAdmin">
                            <div class="col l6 createWebsiteDomainName">
                                <input
                                    type="text"
                                    placeholder="Firstname"
                                    id="clientCreatePortInput"
                                    v-model="admin.firstname"
                                    required
                                />
                            </div>
                            <div class="col l6 createWebsiteDomainName">
                                <input
                                    type="text"
                                    placeholder="Lastname"
                                    id="clientCreatePortInput"
                                    v-model="admin.lastname"
                                    required
                                />
                            </div>
                            <div class="col l6 createWebsiteDomainName">
                                <input
                                    type="text"
                                    placeholder="Othername"
                                    id="clientCreatePortInput"
                                    v-model="admin.othername"
                                />
                            </div>
                            <div class="col l6 createWebsiteDomainName">
                                <input
                                    type="email"
                                    placeholder="Email"
                                    id="clientCreatePortInput"
                                    v-model="admin.email"
                                />
                            </div>
                            <div class="col s8 flexed">
                                <button
                                    :disabled="loading"
                                    class="col s6 btn waves waves-effect"
                                    type="submit"
                                >
                                    Create
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- Template Stuff -->
                </div>
                <!-- <InnerFooterComponent /> -->
            </div>
        </div>
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
                loading: false,
            };
        },
        mounted() {},
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
                            console.log(res);
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