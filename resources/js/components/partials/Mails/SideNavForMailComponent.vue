<template>
    <div>
        <ul
            id="sidenav-1"
            class="sidenav sidenav-fixed white d-flex align-center flex-col"
        >
            <nav
                class="customNavBar d-flex align-center flex-col justify-center mb-6"
            >
                <img
                    src="/media/img/wcd-logo-noBckg.webp"
                    class="responsive-img logo"
                />
            </nav>
            <template v-for="link in links" :key="link.id">
                <li
                    class="w-100 d-flex justify-center align-center mb-4"
                    :class="{ active: link.id === currentId }"
                    v-if="link.role === user.role || link.role == null"
                >
                    <a
                        href="!#"
                        @click="navigateToClicked(link)"
                        class="d-flex justify-start align-center w-100"
                    >
                        <div
                            class="d-flex justify-start align-center w-100 gap-1 flexColumn"
                        >
                            <span v-html="link.icon" ref="svgIcon" :class="{'white-text': link.id === currentId}"></span>
                            <span
                                class="shrink-none"
                                :class="{ 'white-text': link.id === currentId }"
                                >{{ link.title }}</span
                            >
                        </div>
                    </a>
                </li>
            </template>
            <div class="p-24 w-100 d-flex flex-col">
                <a
                    href="#!"
                    @click="toggleShrink"
                    id="toggleIcon"
                    class="align-self-end"
                >
                    <svg
                        width="26"
                        height="20"
                        viewBox="0 0 26 20"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M18.5004 17.2253C18.3421 17.2253 18.1837 17.1669 18.0587 17.0419L12.6254 11.6086C11.7421 10.7253 11.7421 9.27526 12.6254 8.39193L18.0587 2.95859C18.3004 2.71693 18.7004 2.71693 18.9421 2.95859C19.1837 3.20026 19.1837 3.60026 18.9421 3.84193L13.5087 9.27526C13.1087 9.67526 13.1087 10.3253 13.5087 10.7253L18.9421 16.1586C19.1837 16.4003 19.1837 16.8003 18.9421 17.0419C18.8171 17.1586 18.6587 17.2253 18.5004 17.2253Z"
                            fill="#787486"
                        />
                        <path
                            d="M12.5004 17.2253C12.3421 17.2253 12.1837 17.1669 12.0587 17.0419L6.62539 11.6086C5.74206 10.7253 5.74206 9.27526 6.62539 8.39193L12.0587 2.95859C12.3004 2.71693 12.7004 2.71693 12.9421 2.95859C13.1837 3.20026 13.1837 3.60026 12.9421 3.84193L7.50872 9.27526C7.10872 9.67526 7.10872 10.3253 7.50872 10.7253L12.9421 16.1586C13.1837 16.4003 13.1837 16.8003 12.9421 17.0419C12.8171 17.1586 12.6587 17.2253 12.5004 17.2253Z"
                            fill="#787486"
                        />
                    </svg>
                </a>
            </div>
        </ul>
    </div>
</template>
<style scoped>
    ul {
        border-right: 1px solid rgba(158, 157, 157, 0.664);
        box-shadow: none;
    }
    .logo {
        width: 120px;
        height: 65px;
    }
    li > a {
        color: #787486;
        font-family: "Montserrat", sans-serif;
        font-size: 1rem;
        font-style: normal;
        font-weight: 500;
        line-height: 100%;
    }
    .active {
        height: 49px;
        background: #109dad !important;
    }
    .active a {
        font-weight: 600 !important;
    }
    .p-24 {
        padding: 24px;
    }
    .shrink .shrink-none {
        display: none;
    }
    .shrink .flexColumn {
        flex-direction: column;
    }
    .shrink .logo {
        width: 4vw;
        height: 5vh;
    }
</style>

<script>
    export default {
        name: "Sidenav",
        data() {
            return {
                currentId: 1,
                links: [
                    {
                        id: 1,
                        title: "Inbox",
                        icon: '<i class="material-icons">inbox</i>',
                    },
                    {
                        id: 2,
                        title: "Sent",
                        icon: `<i class="material-icons">send</i>`,
                    },
                    {
                        id: 3,
                        title: "Draft",
                        icon: `<i class="material-icons">drafts</i>`,
                    },
                    {
                        id: 4,
                        title: "Trashed",
                        icon: `<i class="material-icons">delete</i>`,
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
                setTimeout(() => {
                    this.updateSVGColor();
                }, 300);
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
                        this.$emit("user", res.data);
                        if (res.data.role == "Admin") {
                            this.prefix = "/admin";
                        } else if (res.data.role == "Client") {
                            this.prefix = "/client";
                        } else if (res.data.role == "SuperAdmin") {
                            this.prefix = "/supre";
                        } else if (res.data.role == "Developer") {
                            this.prefix = "/developers";
                        }
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            },
            navigateToClicked(link) {
                console.log(link)
            },
            toggleShrink() {
                const sidenav = document.querySelector(".sidenav");
                sidenav.classList.toggle("shrink");
                const headerElement = document.querySelector("header");
                const mainElement = document.querySelector("main");
                const toggler = document.getElementById("toggleIcon");
                // const footerElement = document.querySelector('footer');
                document.querySelector('body').classList.toggle('shrinkedSideNav');
                if (sidenav.classList.contains("shrink")) {
                    toggler.style.transform = "rotate(180deg)";
                } else {
                    toggler.style.transform = "rotate(360deg)";
                }
            },
            updateSVGColor() {
                const item = document.querySelector("li.active a svg");
                if (item) {
                    const paths = item.getElementsByTagName("path");
                    for (const path of paths) {
                        path.setAttribute("fill", "white");
                    }
                }
            },
        },
        mounted() {
            this.getUser();
        },
    };
</script>