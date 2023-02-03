<template>
    <div class="custom-navbar-fixed">
        <nav  v-bind:class="scrollPosition >= 5 ? 'altNav' : 'navbar'" class='hide-on-med-and-down'>
            <div class="nav-wrapper navbarWrap">
                <a href="/" class="brand-logo" id="physiPortPageLogo"
                >{{user == '' ? 'Dr John Doe' : user}}</a
                >
                <ul
                    id="nav-mobile"
                    class="section table-of-contents right hide-on-med-and-down"
                >
                    <li>
                        <a href="#about" class="physiTempNavLinks">About Me</a>
                    </li>
                    <li>
                        <a href="#services" class="physiTempNavLinks">Services</a>
                    </li>
                    <li>
                        <a href="#experience" class="physiTempNavLinks"
                        >Experience</a
                        >
                    </li>
                    <li><a href="#feeds" class="physiTempNavLinks">Feeds</a></li>
                    <li>
                        <a href="#testimonials" class="physiTempNavLinks"
                        >Testimonials</a
                        >
                    </li>
                    <li>
                        <a href="#contact" class="physiTempContactBtn"
                        >Contact Me</a
                        >
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="navbar-fixw">
        <nav class="hide-on-large-only white navMain" id="sideNav">
            <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons black-text sideNavIcon"
                                                                           id="sideNavIcon">menu</i></a>

            <a href="#" class="" id="physiPortPageLogo">{{user == '' ? 'Dr John Doe' : user}}</a>

            <ul id="slide-out" class="sidenav">
                <!-- <li>
                    <div class="user-view">
                        <div class="background" id="sideNavImgDiv">
                            <img
                                src="/media/img/istockphoto-1390124896-170667a.jpg"
                                id="sidNavImg"
                            />
                        </div>
                    </div>
                    </li> -->
                <li>
                    <a href="#" class="physiSidenavTempName">LIVELY PURPLE</a>
                </li>
                <li>
                    <div class="divider"></div>
                </li>
                <li class="sideNavLinkMgTp">
                    <a href="#about" class="physiTempNavLinks">About Me</a>
                </li>
                <li class="sideNavLinkMgTp">
                    <a href="#services" class="physiTempNavLinks">Services</a>
                </li>
                <li>
                    <a href="#experience" class="physiTempNavLinks">Experience</a>
                </li>
                <li><a href="#feeds" class="physiTempNavLinks">Feeds</a></li>
                <li>
                    <a href="#testimonials" class="physiTempNavLinks">Testimonials</a>
                </li>
                <li>
                    <a href="#contact" class="physiTempContactBtn">Contact Me</a>
                </li>
            </ul>
        </nav>

        <div class="navbar-fixed">
            <nav class="headerNoSideNav center-align">
                <!-- Sidenav Trigger -->
                <a href="#" data-target="slide" class="sidenav-trigger sidenavTriggerLink">
                    <i class="material-icons sidenavTriggerIcon">settings</i>
                </a>
                <a href="/" class="sideNavBrandLogo">
                    {{user == '' ? 'Dr Chidinma Felix' : user}}
                </a>
                <ul class="extHeaderNoSideNav">
                    <li>
                        <a href="#about" class="mobileNavLink">About Me</a>
                    </li>
                    <li>
                        <a href="#services" class="mobileNavLink">Services</a>
                    </li>
                    <!-- <li>
                            <a href="#experience">Experience</a>
                        </li> -->
                    <!-- <li>
                            <a href="#testimonials">Testimonials</a>
                        </li> -->
                    <!-- <li>
                        <a href="#feeds">Feeds</a>
                    </li> -->
                    <li>
                        <a href="#contact" class="mobileNavLink">Contact Me</a>
                    </li>
                </ul>
            </nav>
        </div>
        <!-- Sidenav Content -->
        <ul id="slide" class="sidenav">
            <li>
                <a href="#!" class="sidenav-close sidenavCloseBtn">
                    <i class="material-icons sidenavCloseIcon white-text">cancel</i>
                </a>
            </li>

            <li><a href="#!" class="sidenavLink">General</a></li>
            <li><div class="divider"></div></li>
            <li><a href="#!" class="sidenavLink">About</a></li>
            <li><div class="divider"></div></li>
            <li><a href="/milestones" class="sidenavLink">Milestones</a></li>
            <li><div class="divider"></div></li>
            <li><a href="#!" class="sidenavLink">Public Features</a></li>
            <li><div class="divider"></div></li>
            <li><a href="#!" class="sidenavLink">Services</a></li>
            <li><div class="divider"></div></li>
            <li><a href="#!" class="sidenavLink">Social Media</a></li>
            <li><div class="divider"></div></li>
            <li><a href="#!" class="sidenavLink">CV Generator</a></li>
            <li><div class="divider"></div></li>
        </ul>

    </div>
</template>
<script>
export default {
    components: {},
    data() {
        return {
            scrollPosition: null,
        };
    },
    props: {
        user: String,
    },
    mounted() {
        window.addEventListener('scroll', this.updateScroll);
    },
    methods: {
        updateScroll() {
            this.scrollPosition = window.scrollY
        },
    },
    computed: {},
};
</script>
