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
                        <i
                            class="material-icons dashLeftBarIcons"
                            :class="{ dashActive: link.id === currentId }"
                            >{{ link.icon }}</i
                        >
                        <p class="dashLeftBarTitle">{{ link.title }}</p>
                    </a>
                    <a
                        href="#logoutModal"
                        class="dashLeftBarListDiv modal-trigger"
                    >
                        <i
                            class="material-icons dashLeftBarIcons"
                            >exit_to_app</i
                        >
                        <p class="dashLeftBarTitle">Logout</p>
                    </a>
                </div>
            </div>
        </div>
        <!--logout-modal-component v-if="shown" @switchMe="switchModal"/-->
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
                    <button @click="logout" class="primary waves-effect waves-green btn-flat">Yes</button>
                    <span class="gutter1"></span>
                    <button class="modal-close primaryBorder waves-effect waves-green btn-flat">No</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import LogoutModalComponent from "../auth/LogoutModalComponent.vue";
    export default {
        components: { LogoutModalComponent },
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
                    },
                    {
                        id: 2,
                        title: "Websites",
                        icon: "web",
                        url: "/websites",
                    },
                    {
                        id: 3,
                        title: "Templates",
                        icon: "chrome_reader_mode",
                        url: "/template",
                    },
                    {
                        id: 4,
                        title: "Mails",
                        icon: "mail_outline",
                        url: "/mail",
                    },
                    {
                        id: 5,
                        title: "Settings",
                        icon: "settings",
                        url: "/settings",
                    },
                    {
                        id: 6,
                        title: "Help/Support",
                        icon: "question_answer",
                        url: "/support",
                    },
                ],
                prefix: "/client",
                shown: false
            };
        },
        methods: {
            getLocation() {
                let location = window.location.pathname.split("/")[2];
                let linkId = this.links.find((el) => el.url === `/${location}`);
                this.currentId = linkId != undefined ? linkId.id : 1;
            },
            switchModal() {
                this.shown = !this.shown;
            },
            delete_cookie(name, path, domain) {
                if (this.get_cookie(name)) {
                    document.cookie =
                        name +
                        "=" +
                        (path ? ";path=" + path : "") +
                        // (domain ? ";domain=" + domain : "") +
                        ";expires=Thu, 01 Jan 1970 00:00:01 GMT";
                }
            },
            get_cookie(name) {
                return document.cookie.split(";").some((c) => {
                    return c.trim().startsWith(name + "=");
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
            this.getLocation();
        },
    };
</script>