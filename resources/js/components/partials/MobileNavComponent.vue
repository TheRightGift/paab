<template>
    <div>
        <!-- Sidenav for small devices -->
        <nav class="hide-on-med-and-up white">
            <!-- Sidenav Contents -->
            <ul id="slide-out" class="sidenav">
                <li>
                    <div class="user-view">
                        <!-- <div class="background">
                            <img src="/media/img/istockphoto-1390124896-170667a.jpg" />
                        </div> -->
                        <a href="#user">
                            <img class="circle mobileNavProImg" src="/media/img/user.png" alt="user.png" />
                        </a>

                    </div>
                </li>

                <a :href="prefix + link.url" class="dashLeftBarListDiv" v-for="link in links" :key="link.id">
                    <span v-show="
                        link.role === user.role || link.role == null
                    ">
                        <i class="material-icons dashLeftBarIcons" :class="{ dashActive: link.id === currentId }">{{
                            link.icon
                        }}</i>
                        <p class="dashLeftBarTitle">{{ link.title }}</p>
                    </span>
                </a>

                <li>
                    <a href="#logoutModal" class="dashLeftBarListDiv modal-trigger">
                        <div>
                            <i class="material-icons dashLeftBarIcons white-text">exit_to_app</i>
                        </div>
                        <p class="dashLeftBarTitle">Logout</p>
                    </a>
                </li>
            </ul>

            

            <!-- Sidenav Trigger -->
            <a href="#" data-target="slide-out" class="sidenav-trigger">
                <i class="material-icons sideNavIcon">menu</i>
            </a>
        </nav>
    </div>
</template>
<script>
export default {
    name: 'MobileNav',
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
                        this.delete_cookie('_token', '/',)
                        location.replace('/');
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
}

</script>