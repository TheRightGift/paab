<template>
    <div class="navbar-fixed">
        <nav class="editWebNavbar">
            <div class="nav-wrapper container">
                <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons sidenavMenuIcon">menu</i></a>
                <a href="/" class="brand-logo editWebNavbarLogo">White Coat Domain</a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li>
                        <a href="#!" class="editWebSidenavDomainNameLink" @click="openPromotionals">
                            Add Promotionals
                            <i class="material-icons editWebSidenavTempIcon">add</i>
                        </a>
                    </li>
                    <li>
                        <a :href="host" class="editWebSidenavDomainNameLink" @click="openNew">
                            <span>Preview website</span>
                        
                            <i class="material-icons editWebSidenavTempIcon">open_in_new</i>
                        </a>
                    </li>
                    <li>
                        <a href="#!" class="editWebSidenavDomainNameLink" @click="logout">
                            <span>Logout</span>
                        
                            <i class="material-icons editWebSidenavTempIcon">power_settings_new</i>
                        </a>
                    </li>
                    <li><a href="#" class="editWebSidenavProImgDiv"></a></li>
                </ul>
            </div>
        </nav>
    </div>
    <!-- Mobile Nav Contents -->
    <ul id="slide-out" class="sidenav">
        <li><a href="#" class="editWebSidenavProImgDiv"></a></li>
        <li>
            <a href="#!" class="editWebSidenavDomainNameLink" @click="openPromotionals">
                Add Promotionals
                <i class="material-icons editWebSidenavTempIcon">add</i>
            </a>
        </li>
        <li>
            <a :href="host" class="editWebSidenavDomainNameLink" @click="openNew">
                <span>Preview website</span>
        
                <i class="material-icons editWebSidenavTempIcon">open_in_new</i>
            </a>
        </li>
        <li>
            <a href="#!" class="editWebSidenavDomainNameLink" @click="logout">
                <span>Logout</span>
            
                <i class="material-icons editWebSidenavTempIcon">power_settings_new</i>
            </a>
        </li>
    </ul>
</template>
<script>
    export default {
        data() {
            return {
                date: new Date().toLocaleDateString("en-us", {
                    weekday: "long",
                    year: "numeric",
                    month: "short",
                    day: "numeric",
                }),
                host: location.host,
                centralURL: process.env.MIX_APP_URL,
            };
        },
        emits: ["openPromotionals"],
        methods: {
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
            logout() {
                this.deleteCookie("_token", "/");
                location.replace("/");
            },
            openNew() {
                window.open(`https://${this.host}`, "_blank");
            },
            openPromotionals() {
                this.$emit('openPromotionals');
            }
        },
    };
</script>