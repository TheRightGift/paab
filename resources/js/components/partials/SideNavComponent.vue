<template>
    <div>
        <div class="col s12 m2 l2" id="dashLeftColBar">
            <div class="dashLeftBar hide-on-small-only">
                <div class="proImgDiv">
                    <i class="material-icons" id="proImg">person</i>
                </div>

                <div class="dashLeftBarInnerDiv">
                    <a
                        :href="prefix + link.url"
                        class="dashLeftBarListDiv"
                        v-for="link in links"
                        :key="link.id"
                    >
                        <span
                            v-show="
                                link.role === user.role || link.role == null
                            "
                        >
                            <i
                                class="material-icons dashLeftBarIcons"
                                :class="{ dashActive: link.id === currentId }"
                                >{{ link.icon }}</i
                            >
                            <p class="dashLeftBarTitle">{{ link.title }}</p>
                        </span>
                    </a>
                    <a
                        href="#logoutModal"
                        class="dashLeftBarListDiv modal-trigger"
                    >
                        <i class="material-icons dashLeftBarIcons"
                            >exit_to_app</i
                        >
                        <p class="dashLeftBarTitle">Logout</p>
                    </a>
                </div>
            </div>
        </div>
        <div id="logoutModal" class="modal">
            <div class="modal-content">
                <div class="row logoutModalImageRow">
                    <img
                        src="/media/img/warning.png"
                        alt="Illustrating a warning that you will be logged out"
                        id="errAltImg"
                        class="logoutModalImage"
                    />
                </div>
                <div class="row center-align">
                    <p>You sure you want to logout from your space?</p>
                </div>

                <div class="row center-align">
                    <button
                        @click="logout"
                        class="primary waves-effect waves-green btn-flat"
                    >
                        Yes
                    </button>
                    <span class="gutter1"></span>
                    <button
                        class="
                            modal-close
                            primaryBorder
                            waves-effect waves-green
                            btn-flat
                        "
                    >
                        No
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name: "Sidenav",
        data() {
            return {
                currentId: 1,
                links: [
                    {
                        id: 1,
                        title: "Dashboard",
                        icon: "dashboard",
                        url: "/dashboard",
                        role: null,
                    },
                    {
                        id: 2,
                        title: "Websites",
                        icon: "web",
                        url: "/websites",
                        role: "Client",
                    },
                    {
                        id: 2,
                        title: "Clients",
                        icon: "web",
                        url: "/client",
                        role: "Admin",
                    },
                    {
                        id: 3,
                        title: "Templates",
                        icon: "chrome_reader_mode",
                        url: "/template",
                        role: null,
                    },
                    {
                        id: 4,
                        title: "Mails",
                        icon: "mail_outline",
                        url: "/mail",
                        role: null,
                    },
                    {
                        id: 5,
                        title: "Settings",
                        icon: "settings",
                        url: "/settings",
                        role: null,
                    },
                    {
                        id: 6,
                        title: "Help/Support",
                        icon: "question_answer",
                        url: "/support",
                        role: "Client",
                    },
                    {
                        id: 7,
                        title: "Admins",
                        icon: "question_answer",
                        url: "/admins",
                        role: "SuperAdmin",
                    },
                ],
                prefix: "/client",
                shown: false,
                user: {},
            };
        },
        methods: {
            getLocation() {
                let location = window.location.pathname.split("/")[2];
                let linkId = this.links.find((el) => el.url === `/${location}`);
                this.currentId = linkId != undefined ? linkId.id : 1;
            },
            deleteCookie(name, path, domain) {
                if (this.getCookie(name)) {
                    document.cookie =
                        name +
                        "=" +
                        (path ? ";path=" + path : "") +
                        // (domain ? ";domain=" + domain : "") +
                        ";expires=Thu, 01 Jan 1970 00:00:01 GMT";
                }
            },
            getCookie(name) {
                return document.cookie.split(";").some((c) => {
                    return c.trim().startsWith(name + "=");
                });
            },
            getUser() {
                axios
                    .get("/api/user")
                    .then((res) => {
                        this.user = res.data;
                        this.$emit('user', res.data);
                        if ((res.data.role == "Admin")) {
                            this.prefix = "/admin";
                        } else if ((res.data.role == "Client")) {
                            this.prefix = "/client";
                        } else if (res.data.role == "SuperAdmin") {
                            this.prefix = "/supre";
                        }
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            },
            logout() {
                axios
                    .post("/auth/logout")
                    .then((res) => {
                        if (res.data.status == 401) {
                            this.deleteCookie("_token", "/");
                            location.replace("/");
                        }
                        console.log(res);
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            },
        },
        mounted() {
            this.getUser();
            this.getLocation();
        },
    };
</script>