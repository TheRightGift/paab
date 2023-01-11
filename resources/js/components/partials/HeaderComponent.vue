<template>
    <div>
        <span v-if="type === 'main'">
            <!-- Navbar -->
            <nav v-bind:class="scrollPosition >= 5 ? 'altNav' : 'navbar'" class="hide-on-med-and-down">
                <div class="nav-wrapper navbarWrap">
                    <a href="/" v-bind:class="scrollPosition >= 5 ? 'altBrandLogo' : 'brandLogo'"
                        class="hide-on-med-and-down">PaaB</a>
                    <ul id="nav-mobile" class="section table-of-contents right hide-on-med-and-down">
                        <li><a href="#product" class="navLinks">Product</a></li>
                        <li><a href="#features" class="navLinks">Features</a></li>
                        <li><a href="/templates" class="navLinks">Templates</a></li>
                        <li><a href="#support" class="navLinks">Support</a></li>
                        <li><a href="/auth/login" class="loginLink">Log in</a></li>
                    </ul>
                </div>
            </nav>

            <!-- SideNav Section -->
            <nav class="hide-on-large-only white" id="sideNav">
                <a href="#" data-target="slide-out" class="sidenav-trigger">
                    <i class="material-icons sideNavIcon" id="sideNavIcon">menu</i>
                </a>

                <a href="/" class="sideNavBrandLogo">PaaB</a>

                <ul id="slide-out" class="sidenav">
                    <!-- <li> -->
                    <!-- <div class="user-view">
                            <div class="background" id="sideNavImgDiv">
                                <img :src="'./media/img/istockphoto-1390124896-170667a.jpg'" id="sidNavImg">
                            </div>
                        </div> -->
                    <!-- </li> -->

                    <li class="sideNavLinkMgTp"><a href="#product" class="navLinks white-text">Product</a></li>
                    <li><a href="#features" class="navLinks white-text">Features</a></li>
                    <li><a href="/templates" class="navLinks white-text">Templates</a></li>
                    <li><a href="#support" class="navLinks white-text">Support</a></li>
                    <li>
                        <div class="divider"></div>
                    </li>
                    <li><a href="/auth/login" class="loginLink deep-purple-text accent-4">Log in</a></li>
                </ul>
            </nav>
        </span>
        <span v-if="type === 'template'">
            <!-- Navbar -->
            <nav v-bind:class="scrollPosition >= 5 ? 'altNav' : 'navbar'" class="hide-on-med-and-down">
                <div class="nav-wrapper navbarWrap">
                    <a href="/" class="brand-logo" id="tempLogo">PaaB</a>

                    <ul id="nav-mobile" class="section right table-of-contents hide-on-med-and-down">
                        <li>
                            <a href="#template" class="navLinks tempScrollLink">Templates</a>
                        </li>
                        <li>
                            <a href="#support" class="navLinks tempScrollLink">Support</a>
                        </li>
                        <li class="marginLeft-25"><a href="/auth/login" class="right tempLoginLink loginLink">Log
                                in</a></li>
                    </ul>
                </div>
            </nav>

            <!-- SideNav Section -->
            <nav class="hide-on-large-only white" id="sideNav">
                <a href="#" data-target="slide-out" class="sidenav-trigger">
                    <i class="material-icons sideNavIcon" id="sideNavIcon">menu</i>
                </a>

                <a href="/" class="sideNavBrandLogo">PaaB</a>

                <ul id="slide-out" class="sidenav">
                    <!-- <li> -->
                    <!-- <div class="user-view">
                        <div class="background" id="sideNavImgDiv">
                            <img src="/media/img/istockphoto-1390124896-170667a.jpg" id="sidNavImg">
                        </div>
                    </div> -->
                    <!-- </li> -->

                    <li><a href="#template" class="sideNavLinkMgTp navLinks white-text">Templates</a></li>
                    <li><a href="#support" class="navLinks white-text">Support</a></li>
                    <li><a href="/auth/login" class="loginLink deep-purple-text accent-4">Log in</a></li>
                </ul>
            </nav>
        </span>
        <span v-if="type === 'singleTemplate'">
            <!-- Navbar -->
            <nav v-bind:class="scrollPosition >= 5 ? 'altNav' : 'navbar'" class="navbar hide-on-med-and-down">
                <div class="nav-wrapper navbarWrap">
                    <a href="#" class="brand-logo" id="physiPortPageLogo">Dr. Akerele Adebayo</a>
                    <ul id="nav-mobile" class="section table-of-contents right hide-on-med-and-down">
                        <li>
                            <a href="#services" id="physiTempNavLinks">Services</a>
                        </li>
                        <li><a href="#experience" id="physiTempNavLinks">Experience</a></li>
                        <li><a href="#testimonials" id="physiTempNavLinks">Testimonials</a></li>
                        <li><a href="#feeds" id="physiTempNavLinks">Feeds</a></li>
                        <li><a href="#contact" id="physiTempContactBtn">Contact Me</a></li>
                    </ul>
                </div>
            </nav>

            <!-- SideNav Section -->
            <!-- <div class="navbar-fixed"> -->
            <nav class="hide-on-large-only white" id="sideNav">
                <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons sideNavIcon"
                        id="sideNavIcon">menu</i></a>

                <a href="#" class="" id="physiPortPageLogo">Dr. Akerele Adebayo</a>

                <ul id="slide-out" class="sidenav">
                    <!-- <li> -->
                    <!-- <div class="user-view">
                        <div class="background" id="sideNavImgDiv">
                            <img src="/media/img/istockphoto-1390124896-170667a.jpg" id="sidNavImg">
                        </div>
                    </div> -->
                    <!-- </li> -->

                    <li class="sideNavLinkMgTp"><a href="#services" id="physiTempNavLinks">Services</a></li>
                    <li><a href="#experience" id="physiTempNavLinks">Experience</a></li>
                    <li><a href="#testimonials" id="physiTempNavLinks">Testimonials</a></li>
                    <li><a href="#" id="physiTempNavLinks">Feeds</a></li>
                    <li>
                        <div class="divider"></div>
                    </li>
                    <li><a href="#contact" id="physiTempContactBtn">Contact Me</a></li>
                </ul>
            </nav>
            <!-- </div> -->
        </span>
    </div>
</template>
<script>
export default {
    data() {
        return {};
    },
    props: {
        type: String
    },
    data() {
        return {
            scrollPosition: null
        };
    },
    mounted() {
        window.addEventListener('scroll', this.updateScroll);
    },
    methods: {
        updateScroll() {
            this.scrollPosition = window.scrollY
        }
    }
};
</script>