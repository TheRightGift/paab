<template>
    <div>
        <mobile-nav-component />
        <!-- Sidebar for large and medium devices -->
        <div class="row" id="dashRowDiv">
            <sidenav-component @user="getUser"/>

            <div class="col s12 m10 l10">
                <div class="dashRightDiv">
                    <div id="dashRightImgDiv">
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
                                    <div v-if="websiteLoading" class="center-align">
                                        <div class="preloader-wrapper small active">
                                            <div
                                                class="
                                                    spinner-layer spinner-white-only
                                                "
                                            >
                                                <div class="circle-clipper left">
                                                    <div class="circle"></div>
                                                </div>
                                                <div class="gap-patch">
                                                    <div class="circle"></div>
                                                </div>
                                                <div class="circle-clipper right">
                                                    <div class="circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div v-else>
                                        <div  v-if="(websites.length > 0)">
                                            <div class="row noMarginBottom"  v-for="website in websites" :key="website.id">
                                                <div class="col s2">
                                                    <div class="webWhiteProDiv">
                                                        <img :src="'/media/img/templateThumbnail/'+website.template.profession.name+'/'+website.template.imageUrl" class="responsive-img" />
                                                    </div>
                                                </div>
                                                <div class="col s8">
                                                    <p class="domainname">
                                                        {{website.name}}
                                                    </p>
                                                </div>  
                                                <div class="col s2">
                                                    <p>
                                                        <a href="#" @click="gotoDomain(website)">View</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" v-else>
                                            <p class="white-text center-align noVertMargin">No Website created yet</p>
                                        </div>
                                        <div class="row noMarginBottom marginTop-5">
                                            <div class="col s12 center-align">
                                                <a @click="navigateToWebsitePage" class="waves-effect primary waves-light btn-small"><i class="material-icons right">add</i>Create website</a>
                                            </div>
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
                                    <div class="row" v-if="mail.length < 1">
                                        <p class="white-text center-align noVertMargin">No Mail.</p>
                                    </div>
                                    <div class="row" id="myMailDiv" v-else>
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
                                    <div class="row noMarginBottom marginTop-5 center-align">
                                        <a @click="navigateToMail" class="waves-effect primary waves-light btn-small"><i class="material-icons right">email</i>Mail Admin</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <InnerFooterComponent/>
            </div>
        </div>
    </div>
</template>

<script>
    import MobileNavComponent from '../partials/MobileNavComponent.vue';
    import SidenavComponent from '../partials/SideNavComponent.vue';
    import InnerFooterComponent from '../partials/InnerFooterComponent.vue';
    export default {
        components: {
            SidenavComponent,
            MobileNavComponent,
            InnerFooterComponent
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
                websiteLoading: false,
                mail: []
            };
        },
        mounted() {
            this.setToken();
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
            getUser(e) {
                this.user = e;
                this.checkMailExist();
            },
            getWebsites() {
                this.websiteLoading = true;
                axios.get("/api/tenancies").then(res => {
                    if (res.data.status == 200) {
                        this.websites = res.data.tenants.data.slice(0, 2);
                    }
                    this.websiteLoading = false;
                }).catch(err => {
                    console.log(err);
                });
            },
            setCookie(cname, cvalue, exdays) {
                const d = new Date();
                d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
                let expires = "expires=" + d.toUTCString();
                document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
            },
            setToken () {
                if (this._token != "") {
                        this.setCookie(
                            "_token",
                            this._token,
                            2
                        );
                }
            },
            navigateToWebsitePage(){
                window.location.replace('/client/websites');
            },
            gotoDomain(website) {
                let domain = typeof(website.domains) === "object"? website.domains[0].domain : website.domains;
                window.open(`http://${domain}:8000`,'_blank');
            },
            checkMailExist() {
                axios.post('/api/checkMailExist', {email: this.user.email}).then(res => {
                    console.log(res);
                }).catch(err => {
                    console.log(err)
                })
            }
        },
        props: ['_token'],

    };
</script>
<style>
    .centered {
        color: #fff;
        text-align: center;
        padding-top: 20px;
    }
</style>