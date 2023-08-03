<template>
    <div>
        <SidenavComponent @user="getUser" class="hide-on-small-only" />
        <HeaderComponent :user="user" class="hide-on-small-only"/>
        <main>
            <section class="hide-on-small-only">
                <div class="d-flex justify-between align-center">
                    <div class="w-335">
                        <p class="mb-0 welcomeName">
                            Welcome Back, Dr. {{ user.firstname }}
                            {{ user.lastname }}
                        </p>
                        <span class="supportWelcomeNote"
                            >Lets start and automate your process so you
                            can reclaim time and focus on your goals.</span
                        >
                    </div>
                    <div>
                        <div class="d-flex justify-between align-center gap-10">
                            <div class="timer">{{ currentHour }}</div>
                            <span
                                :style="{
                                    visibility: colonVisible
                                        ? 'visible'
                                        : 'hidden',
                                }"
                                >:</span
                            >
                            <div class="timer">{{ currentMinute }}</div>
                            <div class="timer meridian uppercase">
                                {{ currentMidNoon }}
                            </div>
                            <span class="dates"
                                >{{ currentDay }} / {{ currentMonth }} /
                                {{ currentYear }}</span
                            >
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="row">
                        <div class="col s12">
                            <ul class="tabs">
                                <li class="tab col s2">
                                    <a href="#myWebsites" class="active"
                                        >My Websites</a
                                    >
                                </li>
                            </ul>
                        </div>
                        <div id="myWebsites" class="col s12">
                            <div v-if="websiteLoading" class="center-align">
                                <i
                                    class="fa-solid fa-circle-notch fa-spin fa-2x grey-text"
                                ></i>
                            </div>
                            <div v-else>
                                <div v-if="websites.length > 0">
                                    <div
                                        class="website d-flex justify-between align-center px-2"
                                        v-for="website in websites"
                                        :key="website.id"
                                    >
                                        <div
                                            class="d-flex align-center justify-between gap-1"
                                        >
                                            <img
                                                :src="
                                                    '/media/img/templateThumbnail/' +
                                                    website.template.title +
                                                    '/' +
                                                    website.template.imageUrl
                                                "
                                                class="responsive-img w-32 h-32 circle"
                                            />
                                            <span class="specialty">
                                                {{ website.template.title }}
                                            </span>
                                        </div>
                                        <span class="tenantID">
                                            {{ website.name }}
                                        </span>
                                        <div>
                                            <a
                                                href="#"
                                                @click="gotoDomain(website)"
                                                >View</a
                                            >
                                        </div>
                                    </div>
                                </div>
                                <div class="center" v-else>
                                    <p>No Website Created Yet!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="fixed-action-btn">
                    <a
                        class="btn-floating btn-large waves-effect waves-light red right customBtn"
                        @click="navigateToWebsitePage"
                        ><i class="material-icons">add</i>
                        <span>Create</span></a
                    >
                </div>
            </section>
            <section class="hide-on-med-and-up">
                <div class="h-100 d-flex justify-center align-center">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-title">
                                <h5 class="m-0 center"><i class="fa-solid fa-triangle-exclamation alert-accent"></i> Oops Sorry!</h5>
                            </div>
                            <div class="card-body">
                                <p class="center">
                                    Your dashboard is not optimized for mobile screen view. Switch to a desktop view for better experience.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</template>
<style scoped>
    .timer {
        width: 40px;
        height: 40px !important;
        text-align: center;
        line-height: 40px;
        height: inherit;
        border-radius: 4px;
        border: 1px solid #e6e6e6;
        background: #fcfcfc;
    }
    .meridian {
        background: #109dad;
        font-size: 0.75rem;
    }
    .gap-10 {
        gap: 10px;
    }
    .dates,
    .meridian {
        color: #4c4c4c;
        font-family: "Montserrat", sans-serif;
        font-style: normal;
        font-weight: 600;
    }
    .dates {
        font-size: 1rem;
    }
    .tabs .tab a:hover,
    .tabs .tab a.active {
        color: #04103b;
        font-family: "Montserrat", sans-serif;
        font-size: 1rem;
        font-style: normal;
        font-weight: 700;
        text-transform: none;
    }
    .tabs .tab a {
        color: #979797;
        font-style: normal;
        font-weight: 700;
    }
    .tabs .tab a:focus,
    .tabs .tab a:focus.active {
        background: transparent;
    }
    .alert-accent {
        color: #686a8a;
    }
    @media only screen and (max-width: 767px) {
        header,
        main,
        footer {
            padding-left: 0;
        }
        body {
            display: none;
        }
    }
</style>
<script>
    import MobileNavComponent from "../partials/MobileNavComponent.vue";
    import SidenavComponent from "../partials/SideNavComponent.vue";
    import InnerFooterComponent from "../partials/InnerFooterComponent.vue";
    import HeaderComponent from "../partials/HeaderComponent.vue";
    let centralURL = process.env.MIX_APP_URL;
    export default {
        components: {
            SidenavComponent,
            MobileNavComponent,
            InnerFooterComponent,
            HeaderComponent,
        },
        data() {
            return {
                bg_img: "/media/img/istockphoto-1390124896-170667a.jpg",
                pro_img: "/media/img/yuna.jpg",
                centralURL: centralURL,
                colonVisible: true,
                currentMonth: "",
                currentDay: "",
                currentDate: "",
                currentYear: "",
                currentMinute: "",
                currentHour: "",
                currentMidNoon: "",
                user: {},
                websites: [],
                websiteLoading: false,
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
                this.currentMonth = String(d.getMonth() + 1).padStart(2, "0");
                this.currentDay = String(d.getDate()).padStart(2, "0");
                this.currentDate = d.getDate();
                this.currentYear = d.getFullYear();
                this.currentMidNoon = d.getHours() >= 12 ? "pm" : "am";
                this.getCurrentTimeInterval();
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
                this.currentHour = String(date.getHours()).padStart(2, "0");
                this.currentMinute = String(date.getMinutes()).padStart(2, "0");
                this.colonVisible = !this.colonVisible;
            },
            getUser(e) {
                this.user = e;
            },
            getWebsites() {
                this.websiteLoading = true;
                axios
                    .get("/api/tenancies")
                    .then((res) => {
                        if (res.data.status == 200) {
                            this.websites = res.data.tenants.data.slice(0, 2);
                        }
                        this.websiteLoading = false;
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            },
            setCookie(cname, cvalue, exdays) {
                const d = new Date();
                d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
                let expires = "expires=" + d.toUTCString();
                document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
            },
            setToken() {
                if (this._token != "") {
                    this.setCookie("_token", this._token, 2);
                }
            },
            navigateToWebsitePage() {
                window.location.replace("/client/websites?openForm");
            },
            gotoDomain(website) {
                let domain =
                    typeof website.domains === "object"
                        ? website.domains[0].domain
                        : website.domains;
                window.open(`https://${domain}.whitecoatdomain.com`, "_blank");
            },
        },
        props: ["_token"],
    };
</script>
