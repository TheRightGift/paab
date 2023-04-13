<template>
    <!--Large device-->
    <!--div class="custom-navbar-fixed">
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
                    <li v-if="(services !== null && services.length !== 0 && preview === '0') || preview === '1'">
                        <a href="#services" class="physiTempNavLinks">Services</a>
                    </li>
                    <li v-if="(achievement !== null && preview === '0') || preview === '1'">
                        <a href="#experience" class="physiTempNavLinks"
                        >Experience</a>
                    </li>
                    <li v-if="(feeds !== null && feeds !== '' && preview === '0') || preview === '1'"><a href="#feeds" class="physiTempNavLinks">Feeds</a></li>
                    
                    <li>
                        <a href="#contact" class="physiTempContactBtn"
                        >Contact Me</a
                        >
                    </li>
                    <li v-if="isLoggedIn">
                        <a class='sidenav-trigger physiTempSettingsNavLink' href='#!' data-target="slide-out">
                            <i class="material-icons physiTempSettingsIcon">settings</i>
                        </a>
                    </li>
                </ul>
                <ul id="slide-out" class="sidenav">
                    <li>
                        <a href="/general" class="dropSetLink">General</a>
                    </li>
                    <li class="divider" tabindex="-1"></li>
                    <li>
                        <a href="/biography" class="dropSetLink">Bio</a>
                    </li>
                    <li class="divider" tabindex="-1"></li>
                    <li>
                        <a href="/milestones" class="dropSetLink">Milestones</a>
                    </li>
                    <li class="divider" tabindex="-1"></li>
                    <li>
                        <a href="/public_feature" class="dropSetLink">Public Features</a>
                    </li>
                    <li class="divider" tabindex="-1"></li>
                    <li>
                        <a href="/services_rendered" class="dropSetLink">Services</a>
                    </li>
                    <li class="divider" tabindex="-1"></li>
                    <li>
                        <a href="/socialmedia_presence" class="dropSetLink">Social Media</a>
                    </li>
                    <li class="divider" tabindex="-1"></li>
                    <li>
                        <a href="/cv_generator" class="dropSetLink">CV Generator</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div-->
    <div class="hide-on-med-and-down">
        <nav>
            <div class="nav-wrapper">
                <div class="container">
                    <a href="#!" class="brand-logo">Dr. Olivia Felix</a>
                    <ul class="centerNav">
                        <li><a href="#!">Interests</a></li>
                        <li><a href="#miniBlog">Mini Blog</a></li>
                        <li><a href="#!">Feeds</a></li>
                        <li><a href="#!">Testimonials</a></li>                        
                    </ul>

                    <ul class="right">
                        <li><a href="#!">Contact</a></li>
                        <li><a href="#!" class="waves-effect waves-light btn subscribeBtn">Subscribe</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <!--Small devices-->
    <div class="navbar-fixw hide-on-large-only">
        <nav class="white navMain" id="sideNav">
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
                <a href="#" data-target="slide" class="sidenav-trigger sidenavTriggerLink" v-if="isLoggedIn">
                    <i class="material-icons sidenavTriggerIcon">settings</i>
                </a>
                <a href="/" class="sideNavBrandLogo">
                    {{user == '' ? 'Dr Chidinma Felix' : user}}
                </a>
                <ul class="extHeaderNoSideNav">
                    <li>
                        <a href="#about" class="mobileNavLink">About</a>
                    </li>
                    <li>
                        <a href="#services" class="mobileNavLink">Services</a>
                    </li>
                    <li v-if="(achievement !== null && preview === '0') || preview === '1'">
                            <a href="#experience">Experience</a>
                    </li>
                    <li v-if="(feeds !== null && feeds !== '' && preview === '0') || preview === '1'">
                        <a href="#feeds">Feeds</a>
                    </li>
                    <!-- <li>
                            <a href="#testimonials">Testimonials</a>
                        </li> -->
                    <li>
                        <a href="#contact" class="mobileNavLink">Contact</a>
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

            <li><a href="/general" class="sidenavLink">General</a></li>
            <li><div class="divider"></div></li>
            <li><a href="/biography" class="sidenavLink">Bio</a></li>
            <li><div class="divider"></div></li>
            <li><a href="/milestones" class="sidenavLink">Milestones</a></li>
            <li><div class="divider"></div></li>
            <li><a href="/public_feature" class="sidenavLink">Public Features</a></li>
            <li><div class="divider"></div></li>
            <li><a href="#!" class="sidenavLink">Services</a></li>
            <li><div class="divider"></div></li>
            <li><a href="socialmedia_presence" class="sidenavLink">Social Media</a></li>
            <li><div class="divider"></div></li>
            <li><a href="/cv_generator" class="sidenavLink">CV Generator</a></li>
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
        isLoggedIn: Boolean,
        preview: String,
        achievement: Object,
        feeds: String,
        services: Array
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
