<template>
    <div>
        <!-- Sidenav for small devices -->
        <nav class="hide-on-med-and-up white">
            <!-- Sidenav Contents -->
            <ul id="slide-out" class="sidenav">
                <li>
                    <div class="user-view">
                        <div class="background">
                            <img :src="bg_img" />
                        </div>
                        <a href="#user"
                            ><img class="circle" :src="pro_img"
                        /></a>
                        <a href="#name"
                            ><span class="white-text name"
                                >Dr. Adebayo Akelere</span
                            ></a
                        >
                        <a href="#email"
                            ><span class="white-text email"
                                >adebayoakelere@gmail.com</span
                            ></a
                        >
                    </div>
                </li>

                <li>
                    <a href="/client/dashboard" class="dashLeftBarListDiv">
                        <i
                            class="
                                material-icons
                                dashLeftBarIcons
                                purple-text
                                text-darken-4
                            "
                            >dashboard</i
                        >
                        <p class="dashLeftBarTitle">Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="/client/websites" class="dashLeftBarListDiv">
                        <i class="material-icons dashLeftBarIcons">web</i>
                        <p class="dashLeftBarTitle">Websites</p>
                    </a>
                </li>
                <!-- <li><div class="divider"></div></li> -->
                <!-- <li><a class="subheader">Subheader</a></li> -->
                <li>
                    <a href="/client/template" class="dashLeftBarListDiv">
                        <i class="material-icons">chrome_reader_mode</i>
                        <p class="dashLeftBarTitle">Templates</p>
                    </a>
                </li>
                <li>
                    <a href="/client/mail" class="dashLeftBarListDiv">
                        <i class="material-icons dashLeftBarIcons"
                            >mail_outline</i
                        >
                        <p class="dashLeftBarTitle">Mails</p>
                    </a>
                </li>
                <li>
                    <a href="/client/settings" class="dashLeftBarListDiv">
                        <i class="material-icons dashLeftBarIcons">settings</i>
                        <p class="dashLeftBarTitle">Settings</p>
                    </a>
                </li>
                <li>
                    <a href="/client/support" class="dashLeftBarListDiv">
                        <i class="material-icons dashLeftBarIcons"
                            >question_answer</i
                        >
                        <p class="dashLeftBarTitle">Help/Support</p>
                    </a>
                </li>
                <li>
                    <a href="/client/support" class="dashLeftBarListDiv">
                        <i class="material-icons dashLeftBarIcons">autorenew</i>
                        <p class="dashLeftBarTitle">Logout</p>
                    </a>
                </li>
            </ul>

            <!-- Sidenav Trigger -->
            <a href="#" data-target="slide-out" class="sidenav-trigger">
                <i class="material-icons" id="dashSidenavIconBtn">menu</i>
            </a>
        </nav>

        <!-- Sidebar for large and medium devices -->
        <div class="row" id="dashRowDiv">
            <div class="col s12 m2 l2" id="dashLeftColBar">
                <div class="dashLeftBar hide-on-small-only">
                    <div class="proImgDiv">
                        <i class="material-icons" id="proImg">person</i>
                    </div>

                    <div class="dashLeftBarInnerDiv">
                        <a href="/dashboard" class="dashLeftBarListDiv">
                            <i class="material-icons" id="dashActive"
                                >dashboard</i
                            >
                            <p class="dashLeftBarTitle">Dashboard</p>
                        </a>

                        <a href="/websites" class="dashLeftBarListDiv">
                            <i class="material-icons dashLeftBarIcons">web</i>
                            <p class="dashLeftBarTitle">Websites</p>
                        </a>

                        <a href="/client/template" class="dashLeftBarListDiv">
                            <i class="material-icons dashLeftBarIcons"
                                >chrome_reader_mode</i
                            >
                            <p class="dashLeftBarTitle">Templates</p>
                        </a>

                        <a href="/client/mail" class="dashLeftBarListDiv">
                            <i class="material-icons dashLeftBarIcons"
                                >mail_outline</i
                            >
                            <p class="dashLeftBarTitle">Mails</p>
                        </a>

                        <a href="/client/settings" class="dashLeftBarListDiv">
                            <i class="material-icons dashLeftBarIcons"
                                >settings</i
                            >
                            <p class="dashLeftBarTitle">Settings</p>
                        </a>

                        <a href="/client/support" class="dashLeftBarListDiv">
                            <i class="material-icons dashLeftBarIcons"
                                >question_answer</i
                            >
                            <p class="dashLeftBarTitle">Help/Support</p>
                        </a>

                        <a href="#" class="dashLeftBarListDiv">
                            <i class="material-icons dashLeftBarIcons"
                                >autorenew</i
                            >
                            <p class="dashLeftBarTitle">Logout</p>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col s12 m10 l10">
                <div class="dashRightDiv">
                    <div id="dashRightImgDiv">
                        <div id="dashRightImgInnerDiv">
                            <div class="dashRightImgTxtDiv">
                                <p class="dashRightImgTitle">
                                    Skyrocket your portfolio
                                </p>
                                <p class="dashRightImgTxt">
                                    Lorem Ipsum is simply dummy text of the
                                    printing and typesetting industry. Lorem
                                    Ipsum has been the industry's
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
                                            >Dr. {{user.firstname}} {{user.lastname}}</span
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
                                                }}<span class="dashTimePeriod"
                                                    >{{currentMidNoon}}</span
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
                                    <p class="cardTitle">MY WEBSITES</p>
                                </div>
                            </div>
                            <div class="cardContent">
                                <div class="cardContentProfile">
                                    <div  v-if="(websites.length > 0)">
                                        <div class="row" id="myWebRmMgRow"  v-for="website in websites" :key="website.id">
                                            <div class="col s10 m10 l10">
                                                <div class="cardImgMainDiv">
                                                    <div class="cardImgDiv">
                                                        <i
                                                            class="material-icons"
                                                            id="cardImg"
                                                            >person</i
                                                        >
                                                    </div>
                                                    <p class="cardProName">
                                                        {{website.name}}
                                                    </p>
                                                </div>
                                            </div>
    
                                            <div class="col s2 m2 l2">
                                                <a href="#" id="cardViewLink"
                                                    >View</a
                                                >
                                            </div>
    
                                            <div class="col s12">
                                                <hr class="cardLine" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" v-else>
                                        <p class="centered">No Website created yet</p>
                                    </div>
                                    <div class="row" id="myWebRmMgRow">
                                        <div class="col s2 offset-s10">
                                            <i
                                                class="material-icons hoverable"
                                                id="dashAddIconBtn"
                                                @click="navigateToWebsitePage"
                                                >add_circle</i
                                            >
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
                                    <div class="row" id="myMailDiv">
                                        <div class="col s10 m10 l10">
                                            <div class="cardImgMainDiv">
                                                <div class="cardImgDiv">
                                                    <i
                                                        class="material-icons"
                                                        id="cardImg"
                                                        >person</i
                                                    >
                                                </div>
                                                <a href="#" class="cardProName"
                                                    >info@paab.com</a
                                                >
                                            </div>
                                        </div>

                                        <div class="col s2 m2 l2">
                                            <p class="dashTimeAgo">2m</p>
                                        </div>

                                        <div class="col s10 offset-s2">
                                            <p class="mailCardTxt">
                                                Lorem Ipsum is simply dummy text
                                                of the printing and typesetting
                                                industry. Lorem Ipsum has been
                                                the industry's standard dummy
                                                text ever since the 1500s, when
                                                an unknown printer took a galley
                                                of type and scrambled it to make
                                                a type specimen book, Lorem
                                                Ipsum is simply dummy text of
                                                the printing and typesetting
                                                Lorem Ipsum has been the
                                                industry's standard dummy text
                                                ever since the 1500s,....
                                            </p>
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
    // import FooterComponent from "./partials/FooterComponent.vue";
    // import HeaderComponent from "./partials/HeaderComponent.vue";
    export default {
        components: {
            // FooterComponent,
            // HeaderComponent
        },
        data() {
            return {
                bg_img: "/media/img/istockphoto-1390124896-170667a.jpg",
                pro_img: "/media/img/yuna.jpg",
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
                currentMonth: "",
                currentDay: "",
                currentDate: "",
                currentYear: "",
                currentTime: "",
                currentMidNoon:"",
                user: {},
                websites: [],
            };
        },
        mounted() {
            this.getUser();
            this.getDate();
            this.getWebsites();
            setInterval(this.getCurrentTimeInterval, 1000);
        },
        methods: {
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
            getCurrentTimeInterval(){
                const date = new Date();
                this.currentTime = `${date.getHours()}:${String(
                    date.getMinutes()
                ).padStart(2, "0")}`;
            },
            getUser() {
                axios.get("/api/user").then(res => {
                    this.user = res.data;
                }).catch(err => {
                    console.log(err);
                });
            },
            getWebsites() {
                axios.get("/api/tenancies").then(res => {
                    if (res.data.status == 200) {
                        this.websites = res.data.tenants;
                    }
                }).catch(err => {
                    console.log(err);
                });
            },
            navigateToWebsitePage(){
                window.location.replace('/websites');
            }
        },
    };
</script>
<style>
    .centered {
        color: #fff;
        text-align: center;
        padding-top: 20px;
    }
</style>