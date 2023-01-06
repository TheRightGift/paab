<template>
    <div class="navbar-fixed">
        <nav class="editWebNavbar">
            <div class="nav-wrapper container">
                <a href="/" class="brand-logo editWebNavbarLogo">Paab</a>
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
                    <li><a href="#" class="editWebSidenavProImgDiv"></a></li>
                </ul>
            </div>
        </nav>
    </div>
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
            };
        },
        methods: {
            openNew() {
                window.open(`http://${this.host}`, "_blank");
            },
            openPromotionals() {
                this.$emit('openPromotionals');
            }
        },
    };
</script>