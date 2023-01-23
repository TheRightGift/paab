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
    <nav class="hide-on-large-only white" id="sideNav">
        <a href="#" data-target="slide-out" class="sidenav-trigger"
            ><i
                class="material-icons black-text sideNavIcon"
                id="sideNavIcon"
                >menu</i
            ></a
        >

        <a href="#" class="" id="physiPortPageLogo">{{user}}</a>

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
            <li class="sideNavLinkMgTp">
                <a href="#about" class="physiTempNavLinks">About Me</a>
            </li>
            <li class="sideNavLinkMgTp">
                <a href="#services" class="physiTempNavLinks">Services</a>
            </li>
            <li>
                <a href="#experience" class="physiTempNavLinks">Experience</a>
            </li>
            <li><a href="#" class="physiTempNavLinks">Feeds</a></li>
            <li>
                <a href="#testimonials" class="physiTempNavLinks"
                    >Testimonials</a
                >
            </li>
            <li>
                <div class="divider"></div>
            </li>
            <li>
                <a href="#contact" class="physiTempContactBtn">Contact Me</a>
            </li>
        </ul>
    </nav>
</template>
<script>
    export default {
        data() {
            return {
                scrollPosition: null
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
            }
        },
        computed: {},
    };
</script>
