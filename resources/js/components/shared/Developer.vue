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
                        <div class="col s12 black websiteBanner">
                            <p class="webBlackTitle">
                                Developers - Overview
                            </p>
                            <p class="webBlackTxt">
                                Now is the time to create something exceptional with no limits.
                            </p>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="adminClientSearchInputMainDiv">
                        <div>
                            <form>
                                <div class="input-field">
                                    <input
                                        placeholder="&#128269; Search by Firstname"
                                        id="adminClientSearchInput"
                                        type="text"
                                        class="validate"
                                        v-model="search"
                                    />
                                </div>
                            </form>
                        </div>

                        <div class="adminClientSearchInputControlDiv">
                            <div>
                                <span class="adminClientSearchInputTxts"
                                    >Filter</span
                                >
                                <i
                                    class="
                                        material-icons
                                        adminClientSearchInputIcons
                                    "
                                    >filter_list</i
                                >
                            </div>

                            <div class="adminClientSearchInputIconsDiv">
                                <span class="adminClientSearchInputTxts"
                                    >Sort</span
                                >
                                <i
                                    class="
                                        material-icons
                                        adminClientSearchInputIcons
                                    "
                                    >sort</i
                                >
                            </div>
                        </div>
                    </div>
                    <div class="row center-align" v-if="loading">
                        <ButtonLoaderComponent />
                    </div>
                    <table class="responsive-table adminAddClientTable" v-else>
                        <tbody>
                            <tr
                                class="adminAddClientTr"
                                v-for="dev in filteredDevs()"
                                :key="dev.id"
                            >
                                <td class="addminAddClientTxts">
                                    <div class="roundedName">{{
                                        dev.firstname.slice(0, 1)
                                    }}  {{ dev.lastname.slice(0, 1) }}</div>
                                </td>
                                <td class="addminAddClientTxts">
                                    {{
                                        dev.firstname
                                    }}  {{ dev.lastname }}
                                </td>
                                <td class="addminAddClientTxts">
                                    {{ dev.gender }}
                                </td>
                                <td class="addminAddClientTxts">
                                    {{ dev.phone }}
                                </td>
                                <td class="addminAddClientTxts">
                                    <a :href="'mailto: '+ dev.email" >{{ dev.email }}</a>
                                </td>
                                <td class="">
                                    <a href="#!" class="marginRight1" v-if="!verifying">
                                        <form action="#">
                                            <p>
                                                <label>
                                                    <input @change="verifyDev(dev)" type="checkbox" :checked="isDataChecked(dev)"/><span></span>
                                                </label>
                                            </p>
                                        </form>
                                    </a>
                                    <a class="marginRight1"  v-else>
                                        <i class="fas fa-circle-notch fa-spin"></i>
                                    </a>
                                </td>
                            </tr>
                            <div
                                class="centered"
                                v-if="
                                    search && !filteredDevs().length
                                "
                            >
                                <p class="error">No results found!</p>
                            </div>
                            <tr
                                v-if="developers.length == 0"
                                class="centered"
                            >
                                You have not created any website for a client
                                sir!
                            </tr>
                        </tbody>
                    </table>

                    <div
                        class="adminClientPaginationControlDiv"
                        v-if="developers.length != 0"
                    >
                        <div class="adminClientPaginationInnerControlDiv right">
                            <span class="adminClientPaginationNum"
                                >{{ data.from }}-{{ data.to }} of
                                {{ total }}</span
                            >

                            <div class="adminClientPaginationIconDiv">
                                <i
                                    class="
                                        material-icons
                                        adminClientPaginationLeftIcon
                                    "
                                    v-if="data.prev_page_url != null"
                                    @click="getClientsWebsites(page--)"
                                    >navigate_before</i
                                >
                                <i
                                    v-else
                                    class="
                                        material-icons
                                        adminClientPaginationLeftIcon
                                        disabled
                                    "
                                    >navigate_before</i
                                >
                                <i
                                    class="
                                        material-icons
                                        adminClientPaginationRightIcon
                                    "
                                    v-if="total != data.to"
                                    @click="getClientsWebsites(page++)"
                                    >navigate_next</i
                                >
                                <i
                                    v-else
                                    class="
                                        material-icons
                                        adminClientPaginationRightIcon
                                        disabled
                                    "
                                    >navigate_next</i
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import SidenavComponent from "../partials/SideNavComponent.vue";
    import WebCreateComponent from "../partials/WebCreateComponent.vue";
    import ButtonLoaderComponent from "../partials/ButtonLoaderComponent.vue";
    import MobileNavComponent from '../partials/MobileNavComponent.vue';
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
                developers: [],
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
            };
        },
        computed: {
            
        },
        mounted() {
            this.getClientsWebsites();
        },
        methods: {
            isDataChecked(dev) {
            // Use a computed property to determine the checked state based on the received data
                console.log(dev);
                return dev.registration_completed === 'Active';
            },
            getUser(e) {
                this.user = e;
            },
            getClientsWebsites() {
                this.page == 1 ? (this.fetching = true) : (this.loading = true);
                axios
                    .get(`/api/developers/?page=${this.page}`)
                    .then((res) => {
                        this.developers = res.data.devs.data;
                        this.masterDataSource = res.data.devs.data;
                        this.data.to = res.data.devs.to;
                        this.data.from = res.data.devs.from;
                        this.data.prev_page_url =
                            res.data.devs.prev_page_url;
                        this.fetching = false;
                        this.loading = false;
                        this.total = res.data.devs.total;
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            },
            
            filteredDevs() {
                return this.masterDataSource.filter((item) =>
                    item.firstname
                        .toUpperCase()
                        .includes(this.search.toUpperCase())
                );
            },
            verifyDev(dev) {
                this.verifying = true;
                axios.put(`/api/verify_dev/${dev.id}`).then(res => {
                    if (res.status == 200) {
                        M.toast({html: res.data.msg, classes: 'successNotifier'});
                        dev.registration_completed = res.data.dev.registration_completed;
                    } else {
                        M.toast({html: res.data.msg, classes: 'errorNotifier'});
                    }
                    this.isDataChecked(dev);
                    this.verifying = false;
                }).catch(err => {
                    console.log(err);
                    this.verifying = false;
                    M.toast({html: err.response.message, classes: 'errorNotifier'});
                })
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
</style>
<style scoped>
    #webWhiteIcon {
        font-size: 1.25rem;
    }
    .disabled {
        color: rgba(0, 0, 0, 0.5);
    }
</style>