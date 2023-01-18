<template>
    <div>
        <mobile-nav-component />

        <!-- Sidebar for large and medium devices -->
        <div class="row" id="dashRowDiv">
            <side-nav-component @user="getUser" />

            <!-- Mail blue div -->
            <div v-if="loading" class="loading"></div>
            <div class="col s12 m10 l10" id="setRightDiv" v-else>
                <div class="setMainDiv">
                    <div class="settingBannerDiv">
                        <img
                            src="/media/img/settingillustration.png"
                            alt="settingillustration.png"
                            class="responsive-img settingsIllustImg right"
                        />
                    </div>

                    <div class="col s12 settingsFormDiv">
                        <form id="settingsForm">
                            <div class="row rm_mg" id="setProMainDiv">
                                <div class="flexed">
                                    <div class="setProDiv">
                                        <i class="material-icons" id="setProImg" v-if="uploaded === null && user.avatar === null"
                                            >person</i
                                        >
                                        <img width="100" height="100" class="circle" :src="uploaded ?? '/media/img/avatars/'+user.avatar" :alt="user.firstname +' avatar'" v-else>
                                    </div>
                                    <div class="setProEditIconDiv">
                                        <input
                                            @change="uploadAvatar"
                                            accept="image/*"
                                            class="custom-file-input edit icon"
                                            type="file"
                                            id="setProEditIcon"
                                        />

                                        <!-- <i
                                            class="material-icons"
                                            id="setProEditIcon"
                                            >edit</i
                                        > -->
                                    </div>
                                </div>

                                <div class="setProTitleDiv">
                                    <p class="mySetTitle">Settings</p>
                                    <span class="mySetName">{{
                                        user.email
                                    }}</span>
                                </div>
                            </div>

                            <div class="row settingsInptuRow">
                                <div>
                                    
                                </div>                                
                                <form @submit.prevent="updateUserDetails()">
                                    <div class="row">
                                        <div
                                            class="
                                                input-field
                                                col
                                                s2
                                                rm_mg
                                                sm_mg
                                            "
                                            v-if="user.role === 'Client'"
                                        >
                                            <select
                                                class="browser-default"
                                                id="settingTitle"
                                                required
                                                v-model="user.title_id"
                                            >
                                                <option
                                                    value=""
                                                    disabled
                                                    selected
                                                >
                                                    Title
                                                </option>
                                                <option
                                                    v-for="title in titles"
                                                    :key="title.id"
                                                    :value="title.id"
                                                >
                                                    {{ title.name }}
                                                </option>
                                            </select>
                                        </div>

                                        <div
                                            class="input-field col rm_mg sm_mg"
                                            :class="{
                                                s6: user.role === 'Admin',
                                                s5: user.role === 'Client',
                                            }"
                                        >
                                            <input
                                                placeholder="Last Name"
                                                id="settingLname"
                                                type="text"
                                                class="validate"
                                                v-model="user.lastname"
                                                required
                                            />
                                        </div>

                                        <div
                                            class="
                                                input-field
                                                col
                                                s4
                                                rm_mg
                                                sm_mg
                                            "
                                            :class="{
                                                s6: user.role === 'Admin',
                                                s5: user.role === 'Client',
                                            }"
                                        >
                                            <input
                                                placeholder="First Name"
                                                id="settingFName"
                                                type="text"
                                                class="validate"
                                                v-model="user.firstname"
                                                required
                                            />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div
                                            class="
                                                input-field
                                                col
                                                s6
                                                rm_mg
                                                sm_mg
                                            "
                                            :class="{
                                                s6: user.role === 'Admin',
                                                s4: user.role === 'Client',
                                            }"
                                        >
                                            <input
                                                placeholder="Other Name"
                                                id="settingOName"
                                                type="text"
                                                class="validate"
                                                v-model="user.othername"
                                                disabled
                                            />
                                        </div>
                                        <div
                                            class="
                                                input-field
                                                col
                                                s6
                                                rm_mg
                                                sm_mg
                                            "
                                        >
                                            <input
                                                placeholder="Email"
                                                id="settingEmail"
                                                type="email"
                                                class="validate"
                                                v-model="user.email"
                                                disabled
                                            />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div
                                            class="
                                                input-field
                                                col
                                                s6
                                                rm_mg
                                                sm_mg
                                            "
                                        >
                                            <input
                                                placeholder="Phone Number"
                                                id="settingPhone"
                                                type="text"
                                                class="validate"
                                                disabled
                                                v-model="user.phone"
                                                required
                                            />
                                        </div>
                                        <div
                                            class="
                                                input-field
                                                col
                                                s6
                                                rm_mg
                                                sm_mg
                                            "
                                        >
                                            <input
                                                placeholder="Zipcode"
                                                id="settingPhone"
                                                type="text"
                                                class="validate"
                                                v-model="user.zipcode"
                                                required
                                            />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div
                                            class="
                                                input-field
                                                col
                                                s6
                                                rm_mg
                                                sm_mg
                                            "
                                            v-if="user.role === 'Client'"
                                        >
                                            <select
                                                class="browser-default"
                                                id="settingCountry"
                                                v-model="user.country"
                                                @change="sortStates"
                                                required
                                            >
                                                <option
                                                    value=""
                                                    disabled
                                                    selected
                                                >
                                                    Country
                                                </option>
                                                <option
                                                    v-for="country in countries"
                                                    :key="country.id"
                                                    :value="country.id"
                                                >
                                                    {{ country.name }}
                                                </option>
                                            </select>
                                        </div>

                                        <div
                                            class="
                                                input-field
                                                col
                                                s6
                                                rm_mg
                                                sm_mg
                                            "
                                            v-if="user.role === 'Client'"
                                        >
                                            <select
                                                class="browser-default"
                                                id="settingGender"
                                                v-model="user.gender"
                                            >
                                                <option value="_" selected>
                                                    Gender
                                                </option>
                                                <option value="M">Male</option>
                                                <option value="F">
                                                    Female
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div
                                        class="row"
                                        v-if="user.role === 'Client'"
                                    >
                                        <div
                                            class="
                                                input-field
                                                col
                                                s6
                                                rm_mg
                                                sm_mg
                                            "
                                        >
                                            <select
                                                class="browser-default"
                                                id="settingState"
                                                v-model="user.state"
                                                @change="sortCities"
                                                required
                                            >
                                                <option
                                                    value=""
                                                    disabled
                                                    selected
                                                >
                                                    State
                                                </option>
                                                <option
                                                    v-for="state in states"
                                                    :key="state.id"
                                                    :value="state.id"
                                                >
                                                    {{ state.name }}
                                                </option>
                                            </select>
                                        </div>

                                        <div
                                            class="
                                                input-field
                                                col
                                                s6
                                                rm_mg
                                                sm_mg
                                            "
                                        >
                                            <select
                                                class="browser-default"
                                                id="settingCity"
                                                v-model="user.city_id"
                                                required
                                            >
                                                <option
                                                    value=""
                                                    disabled
                                                    selected
                                                >
                                                    City
                                                </option>
                                                <option
                                                    v-for="city in cities"
                                                    :key="city.id"
                                                    :value="city.id"
                                                >
                                                    {{ city.name }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col l12 center-align">
                                        <button
                                            class="btn sm_mg"
                                            type="submit"
                                            id="setFormBtn"
                                            v-if="!processing"
                                        >
                                            SAVE
                                            <i class="material-icons right"
                                                >send</i
                                            >
                                        </button>
                                        <button
                                            :disabled="processing"
                                            v-else
                                            class="btn sm_mg"
                                        >
                                            <div
                                                class="
                                                    preloader-wrapper
                                                    small
                                                    active
                                                "
                                            >
                                                <div
                                                    class="
                                                        spinner-layer
                                                        spinner-white-only
                                                    "
                                                >
                                                    <div
                                                        class="
                                                            circle-clipper
                                                            left
                                                        "
                                                    >
                                                        <div
                                                            class="circle"
                                                        ></div>
                                                    </div>
                                                    <div class="gap-patch">
                                                        <div
                                                            class="circle"
                                                        ></div>
                                                    </div>
                                                    <div
                                                        class="
                                                            circle-clipper
                                                            right
                                                        "
                                                    >
                                                        <div
                                                            class="circle"
                                                        ></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import MobileNavComponent from "./MobileNavComponent.vue";
    import SideNavComponent from "./SideNavComponent.vue";
    // import FooterComponent from "./partials/FooterComponent.vue";
    // import HeaderComponent from "./partials/HeaderComponent.vue";
    let country = "/api/countries";
    let title = "/api/title";
    let locs = "/api/userLocationDets";
    export default {
        components: {
            MobileNavComponent,
            SideNavComponent,
            // FooterComponent,
            // HeaderComponent
        },
        data() {
            return {
                bg_img: "/media/img/istockphoto-1390124896-170667a.jpg",
                cities: [],
                countries: [],
                loading: false,
                processing: false,
                pro_img: "/media/img/yuna.jpg",
                states: [],
                titles: [],
                uploaded: null,
                user: {},
            };
        },
        mounted() {},
        methods: {
            uploadAvatar(e) {
                if (!e.target.files.length) return;
                this.user.avatar = e.target.files[0];
                this.uploaded = URL.createObjectURL(e.target.files[0]);
            },
            getLocations() {
                this.loading = true;
                const requestTitles = axios.get(title);
                const requestCountries = axios.get(country);
                const requestLocs = axios.get(locs + `/${this.user.city_id}`);
                axios
                    .all([requestTitles, requestCountries, requestLocs])
                    .then(
                        axios.spread((...responses) => {
                            const titleRes = responses[0];
                            const countryRes = responses[1];
                            const locsRes = responses[2];
                            this.countries = countryRes.data.countries;
                            this.titles = titleRes.data.titles;
                            this.user.country = locsRes.data.country_id;
                            this.user.state = locsRes.data.state_id;
                            this.sortStates();
                            this.sortCities();
                            this.loading = false;
                        })
                    )
                    .catch((errors) => {
                        console.log(errors);
                        this.loading = false;
                    });
            },
            getUser(e) {
                this.user = e;
                this.getLocations();
            },
            sortCities() {
                axios
                    .get(`/api/cities/${this.user.state}`)
                    .then((res) => {
                        if (res.data.status == 200) {
                            this.cities = res.data.cities;
                        } else {
                            M.toast({
                                html: "Error getting cities",
                                classes: "errorNotifier",
                            });
                        }
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            },
            sortStates() {
                axios
                    .get(`/api/states/${this.user.country}`)
                    .then((res) => {
                        if (res.data.status == 200) {
                            this.states = res.data.states;
                        } else {
                            M.toast({
                                html: "Error getting states",
                                classes: "errorNotifier",
                            });
                        }
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            },
            updateUserDetails() {
                this.processing = true;
                let formData = new FormData();
                typeof(this.user.avatar) != 'string' && this.user.avatar != null ? formData.append("avatar", this.user.avatar) : null;
                typeof(this.user.avatar) != 'string' ? formData.append("oldAvatar", this.user.oldAvatar) : null;
                this.user.role == "Client"
                    ? formData.append("title_id", this.user.title_id)
                    : null;
                formData.append("lastname", this.user.lastname);
                formData.append("firstname", this.user.firstname);
                formData.append("phone", this.user.phone);
                this.user.role == "Client"
                    ? formData.append("city_id", this.user.city_id)
                    : null;
                formData.append("gender", this.user.gender);
                formData.append("zipcode", this.user.zipcode);
                formData.append("_method", "PUT");
                axios
                    .post(`/api/updateUser/${this.user.id}`, formData)
                    .then((res) => {
                        if (res.data.status == 200) {
                            M.toast({
                                html: res.data.message,
                                classes: "successNotifier",
                            });
                            this.processing = false;
                            location.reload();
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
                            this.processing = false;
                        }
                        console.log(err);
                    });
            },
        },
    };
</script>
<style>
    .mb-10 {
        margin-bottom: 10px;
    }
    .custom-file-input::-webkit-file-upload-button {
        visibility: hidden;
    }
    .custom-file-input::before {
        content: "✎";
        display: inline-block;
        /* background: linear-gradient(top, #f9f9f9, #e3e3e3); */
        border: none;
        border-radius: 3px;
        padding: 5px 8px;
        outline: none;
        white-space: nowrap;
        -webkit-user-select: none;
        cursor: pointer;
        text-shadow: 1px 1px #fff;
        font-weight: 700;
        font-size: 10pt;
    }
    .custom-file-input:hover::before {
        border-color: black;
    }
    .custom-file-input:active::before {
        background: -webkit-linear-gradient(top, #e3e3e3, #f9f9f9);
    }
</style>

<style scoped>
    input[type="file"] {
        /* visibility: hidden; */
        /* display: none; */
    }
</style>



