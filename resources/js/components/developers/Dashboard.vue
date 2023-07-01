<template>
    <div>
        <!-- Sidenav for small devices -->
        <mobile-nav-component />
        
        <div class="row" id="dashRowDiv">
            <sidenav-component @user="getUser"/>

            <div class="col s12 m10 l10">
                <div class="dashRightDiv">
                    <div id="adminDashRightImgDiv">
                        <div class="dashRightImgInnerDiv">
                            <div class="dashRightImgTxtDiv">
                                <p class="dashRightImgTitle">
                                    Manage your client’s portfolio
                                </p>
                                <p class="dashRightImgTxt">
                                    Say hello to the next level platform that gives you infinite 
                                    freedom to create, design and manage your personal brand
                                    exactly the way you want.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="dashWlcNoteRowDiv">
                        <div class="col s12 m8 l8">
                            <div class="dashWlcNoteDiv">
                                <div class="dashWlcNoteInnerDiv">
                                    <p class="dashWlcNoteTitle">
                                        Welcome!
                                        <span class="dashWlcNoteTitle1"
                                            >{{ user.firstname }}
                                            {{ user.lastname }}</span
                                        >
                                    </p>
                                    <p class="dashWlcNoteTxt">
                                        Lets start and automate your process so
                                        you can reclaim time and focus on your
                                        goals.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col s12 m4 l4">
                            <div class="row">
                                <div class="dashTimeDiv">
                                    <div class="col s7 m6 l6">
                                        <div class="dashTimeInnerDiv">
                                            <p class="dashTimeDate">
                                                {{ currentMonth }}
                                                {{ currentDay }},
                                                {{ currentYear }}
                                            </p>
                                            <p class="dashTime">
                                                {{ currentTime
                                                }}<span
                                                    class="dashTimePeriod"
                                                    >{{ currentMidNoon }}</span
                                                >
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col s5 m6 l6">
                                        <div class="shapeDegDiv">
                                            <div class="shapeDeg"></div>
                                            <div class="shapeDeg1"></div>
                                            <div class="shapeDeg2"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="myWebDiv">
                        <div class="col s12 m6 l6">
                            <div class="cardDiv">
                                <div class="cardHeader">
                                    <p class="cardTitle">MY PROJECTS</p>
                                </div>
                            </div>
                            <div class="cardContent">
                                <div class="cardContentProfile">
                                    <div  v-if="(devProjects.length > 0)">
                                        <div class="row" id="myWebRmMgRow"  v-for="clientWeb in devProjects" :key="clientWeb.id">
                                            <div class="col s12 m10 l10">
                                                <div class="">
                                                    <div class="col s10 m10 l10 cardImgMainDiv">
                                                        <div class="cardImgDiv">
                                                            <i
                                                                class="material-icons"
                                                                id="cardImg"
                                                                >person</i
                                                            >
                                                        </div>
                                                        <p class="cardProName">
                                                            {{clientWeb.name}}
                                                        </p>
                                                    </div>
                                                    <div class="col s2 m2 l2">
                                                        <a href="#" id="cardViewLink" @click="gotoDomain(clientWeb)"
                                                            >View</a
                                                        >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col s12">
                                                <hr class="cardLine" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" v-else>
                                        <p class="white-text center-align noVertMargin">No Projects Found!</p>
                                    </div>
                                    <div class="row" id="myWebRmMgRow">
                                        <div class="col s12 center-align">
                                            <a @click="navigateToDevProjects" class="waves-effect primary waves-light btn-small"><i class="material-icons right">add</i>Submit Project</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col s12 m6 l6">
                            <div class="cardDiv">
                                <div class="cardHeader">
                                    <p class="cardTitle">MY MAIL</p>
                                </div>
                                <div class="cardContent">
                                    <div class="row">
                                        <p class="white-text center-align noVertMargin">No Mail.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Template Stuff -->
                    
                </div>
                <!-- <InnerFooterComponent /> -->
            </div>
        </div>
        <div id="profile" class="modal">
            <div class="modal-content">
                <h4>Complete Your Profile</h4>
                <p>This is important</p>
                <div class="row">
                <form class="col s12" @submit.prevent="createNuban">
                <div class="row">
                    <div class="input-field col s12">
                    <input maxlength="10" type="text" class="validate" required v-model="developer.NUBAN">
                    <label for="NUBAN">NUBAN</label>
                    </div>
                    <div class="input-field col s12">
                    <input type="text" class="validate" required v-model="developer.bank">
                    <label for="Bank Name">Bank Name</label>
                    </div>
                </div>
                <div class="row">
                    <button :disabled="loading" type="submit" class="btn waves waves-effect purple darken-4 col s12">
                        <span v-if="!loading">Submit</span>
                        <span v-else class="fas fa-spinner fa-spin fa-1x"></span>
                    </button>
                </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import InnerFooterComponent from "../partials/InnerFooterComponent.vue";
    import SidenavComponent from "../partials/SideNavComponent.vue";
    import MobileNavComponent from "../partials/MobileNavComponent.vue";
    export default {
        components: {
            InnerFooterComponent,
            MobileNavComponent,
            SidenavComponent,
        },
        data() {
            return {
                devProjects: [],
                currentMonth: "",
                currentDay: "",
                currentDate: "",
                currentYear: "",
                currentTime: "",
                currentMidNoon: "",
                loading: false,
                months: [
                    "January",
                    "February",
                    "March",
                    "April",
                    "May",
                    "June",
                    "July",
                    "August",
                    "September",
                    "October",
                    "November",
                    "December",
                ],
                professions: [],
                template: {
                    profession_id: "",
                    title: "",
                    imageUrl: "",
                },
                templates: [],
                user: {},
                view: 0,
                loading: false,
                developer: {
                    NUBAN: "",
                    bank: "",
                    user_id: "",
                },
            };
        },
        mounted() {
            this.getDate();
            setInterval(this.getCurrentTimeInterval, 1000);
        },
        methods: {
            checkDeveloperDetailsFilled (userID) {
                axios.get(`/api/show/${userID}`).then(res => {
                    if (res.data.data.developer == null) {
                        document.addEventListener('DOMContentLoaded', function() {
                            var elems = document.querySelector('#profile');
                            let options = {
                                dismissible: false,
                            }
                            var instance = M.Modal.init(elems, options);
                            instance.open();
                        });

                    } else {
                        this.devProjects = res.data.data.developer.projects.slice(0, 5);
                    }
                }).catch(err => {
                    console.log(err);
                })
            },
            createNuban() {
                this.loading = true;
                axios.post('/api/store', this.developer).then(res => {
                    if (res.status == 201) {
                        M.toast({
                            html: 'Success',
                            classes: 'successNotifier',
                        });
                        var elems = document.querySelector('#profile');
                        var instance = M.Modal.init(elems);
                        instance.close();
                    } else {
                        M.toast({
                            html: res.data.error,
                            classes: 'errorNotifier',
                        });
                    }
                    this.loading = false;
                }).catch(err => {
                    console.log(err);
                    this.loading = false;
                })
            },
            getDate() {
                const d = new Date();
                this.currentMonth = this.months[d.getMonth()].substring(0, 3);
                this.currentDay = d.getDate() + this.dayFormatter(d.getDate());
                this.currentDate = d.getDate();
                this.currentYear = d.getFullYear();
                this.currentMidNoon = d.getHours() >= 12 ? "pm" : "am";
                this.getCurrentTimeInterval();
            },
            dayFormatter(d) {
                {
                    if (d > 3 && d < 21) return "th";
                    switch (d % 10) {
                        case 1:
                            return "st";
                        case 2:
                            return "nd";
                        case 3:
                            return "rd";
                        default:
                            return "th";
                    }
                }
            },
            formatAMPM(d) {
                var hours = d.getHours();
                var minutes = d.getMinutes();
                var ampm = hours >= 12 ? "pm" : "am";
                hours = hours % 12;
                hours = hours ? hours : 12; // the hour '0' should be '12'
                minutes = minutes < 10 ? "0" + minutes : minutes;
                var strTime = hours + ":" + minutes + " " + ampm;
                return strTime;
            },
            getCurrentTimeInterval() {
                const date = new Date();
                this.currentTime = `${date.getHours()}:${String(
                    date.getMinutes()
                ).padStart(2, "0")}`;
            },
            getUser(e) {
                this.user = e;
                this.developer.user_id = e.id;
                this.checkDeveloperDetailsFilled(e.id);
            },
            navigateToDevProjects () {
                window.location.href = '/developers/projects';
            }
        },
        props: ["_token"],
    };
</script>
<style>
    .centered {
        color: #000;
        text-align: center;
        padding-top: 20px;
    }
    .btn_file {
        background-color: #7746ff;
    }
    .btn_file:hover {
        background-color: #aa8ff5;
    }
    .center {
        margin: auto;
        width: 60%;
        border: 1px solid #b59ff0;
        padding: 30px;
        border-radius: 5px;
        background-color: #c1b8d8;
    }
</style>