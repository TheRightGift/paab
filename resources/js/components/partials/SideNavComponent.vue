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
                        href="#"
                        class="dashLeftBarListDiv"
                        @click="switchModal"
                    >
                        <i
                            class="material-icons dashLeftBarIcons"
                            >autorenew</i
                        >
                        <p class="dashLeftBarTitle">Logout</p>
                    </a>
                </div>
            </div>
        </div>
        <logout-modal-component v-if="shown" @switchMe="switchModal"/>
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
            }
        },
        mounted() {
            this.getLocation();
        },
    };
</script>