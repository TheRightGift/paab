<template>
    <div>
        <!-- Sidenav for small devices -->
        <nav class="hide-on-med-and-up white">
            <!-- Sidenav Contents -->
            <ul id="slide-out" class="sidenav">
                <li>
                    <div class="user-view">
                        <div class="background">
                            <img :src="bg_img">
                        </div>
                        <a href="#user"><img class="circle" :src="pro_img"></a>
                        <a href="#name"><span class="white-text name">Dr. Adebayo Akelere</span></a>
                        <a href="#email"><span class="white-text email">adebayoakelere@gmail.com</span></a>
                    </div>
                </li>
        
                <li>
                    <a href="/dashboard" class="dashLeftBarListDiv">
                        <i class="material-icons dashLeftBarIcons" id="dashIconLink">dashboard</i>
                        <p class="dashLeftBarTitle">Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="/websites" class="dashLeftBarListDiv">
                        <i class="material-icons dashLeftBarIcons">web</i>
                        <p class="dashLeftBarTitle">Websites</p>
                    </a>
                </li>
                <!-- <li><div class="divider"></div></li> -->
                <!-- <li><a class="subheader">Subheader</a></li> -->
                <li>
                    <a href="/client/template" class="dashLeftBarListDiv">
                        <i class="material-icons purple-text text-darken-4" id="dashActive">chrome_reader_mode</i>
                        <p class="dashLeftBarTitle">Templates</p>
                    </a>
                </li>
                <li>
                    <a href="/client/mail" class="dashLeftBarListDiv">
                        <i class="material-icons dashLeftBarIcons">mail_outline</i>
                        <p class="dashLeftBarTitle">Mails</p>
                    </a>
                </li>
                <li>
                    <a href="/client/settings" class="dashLeftBarListDiv">
                        <i class="material-icons dashLeftBarIcons">settings</i>
                        <p class="dashLeftBarTitle">Settings</p>
                    </a>
                </li>
                <li>
                    <a href="/client/support" class="dashLeftBarListDiv">
                        <i class="material-icons dashLeftBarIcons">question_answer</i>
                        <p class="dashLeftBarTitle">Help/Support</p>
                    </a>
                </li>
                <li>
                    <a href="#" class="dashLeftBarListDiv">
                        <i class="material-icons dashLeftBarIcons">autorenew</i>
                        <p class="dashLeftBarTitle">Logout</p>
                    </a>
                </li>
            </ul>
        
            <!-- Sidenav Trigger -->
            <a href="#" data-target="slide-out" class="sidenav-trigger">
                <i class="material-icons" id="dashSidenavIconBtn">menu</i>
            </a>
        </nav>
        
        
        <!-- Sidebar for large and medium devices -->
        <div class="row" id="dashRowDiv">
            <div class="col s12 m2 l2" id="dashLeftColBar">
                <div class="dashLeftBar hide-on-small-only">
                    <div class="proImgDiv">
                        <i class="material-icons" id="proImg">person</i>
                    </div>
        
                    <div class="dashLeftBarInnerDiv">
                        <a href="/dashboard" class="dashLeftBarListDiv">
                            <i class="material-icons dashLeftBarIcons">dashboard</i>
                            <p class="dashLeftBarTitle">Dashboard</p>
                        </a>
        
                        <a href="/websites" class="dashLeftBarListDiv">
                            <i class="material-icons dashLeftBarIcons">web</i>
                            <p class="dashLeftBarTitle">Websites</p>
                        </a>
        
                        <a href="#" class="dashLeftBarListDiv">
                            <i class="material-icons dashLeftBarIcons" id="dashActive">chrome_reader_mode</i>
                            <p class="dashLeftBarTitle">Templates</p>
                        </a>
        
                        <a href="/client/mail" class="dashLeftBarListDiv">
                            <i class="material-icons dashLeftBarIcons">mail_outline</i>
                            <p class="dashLeftBarTitle">Mails</p>
                        </a>
        
                        <a href="/client/settings" class="dashLeftBarListDiv">
                            <i class="material-icons dashLeftBarIcons">settings</i>
                            <p class="dashLeftBarTitle">Settings</p>
                        </a>
        
                        <a href="/client/support" class="dashLeftBarListDiv">
                            <i class="material-icons dashLeftBarIcons">question_answer</i>
                            <p class="dashLeftBarTitle">Help/Support</p>
                        </a>
        
                        <a href="#" class="dashLeftBarListDiv">
                            <i class="material-icons dashLeftBarIcons">autorenew</i>
                            <p class="dashLeftBarTitle">Logout</p>
                        </a>
                    </div>
        
        
                </div>
            </div>
        
            <!-- Center Bar Person Div -->
            <div class="col s12 m10 l10">
                <div class="userTempMainDiv">
                    <div class="row">
        
                        <div class="col s6 m4 l2">
                            <div id="userTempDiv">
                                <div class="tempImgDiv" id="tempImgDiv">
                                    <i class="material-icons" id="tempProIcon">person</i>
                                </div>
                                <p class="userTempTitle">Physician</p>
                            </div>
                        </div>
        
                        <div class="col s6 m4 l2">
                            <div id="userTempDiv">
                                <div class="tempImgDiv" id="tempImgDiv">
                                    <i class="material-icons" id="tempProIcon">person</i>
                                </div>
                                <p class="userTempTitle">Doctors</p>
                            </div>
                        </div>
        
                        <div class="col s6 m4 l2">
                            <div id="userTempDiv">
                                <div class="tempImgDiv" id="tempImgDiv">
                                    <i class="material-icons" id="tempProIcon">person</i>
                                </div>
                                <p class="userTempTitle">Tutors</p>
                            </div>
                        </div>
        
                        <div class="col s6 m4 l2">
                            <div id="userTempDiv">
                                <div class="tempImgDiv" id="tempImgDiv">
                                    <i class="material-icons" id="tempProIcon">person</i>
                                </div>
                                <p class="userTempTitle">Photographer</p>
                            </div>
                        </div>
        
                        <div class="col s6 m4 l2">
                            <div id="userTempDiv">
                                <div class="tempImgDiv" id="tempImgDiv">
                                    <i class="material-icons" id="tempProIcon">person</i>
                                </div>
                                <p class="userTempTitle">Trainner</p>
                            </div>
                        </div>
        
                        <div class="col s6 m4 l2">
                            <div id="userTempDiv">
                                <div class="tempImgDiv" id="tempImgDiv">
                                    <i class="material-icons" id="tempProIcon">person</i>
                                </div>
                                <p class="userTempTitle">Lawyers</p>
                            </div>
                        </div>
        
                    </div>
        
                </div>

                <!-- Client's Templates Section -->
                <div class="clientTempContainInnerDiv">
                    <div id="clientTempPageRowDiv">
            
                        <!-- First Row -->
                        <div class="col s12 m6 l4 clientTempPageImgSmDv">
                            <div class="tempPageImgDiv">
                                <img src="/media/img/tempPageImg.png" alt="tempPageImg.png" id="tempPageGridImg">
                            </div>
        
                            <p class="tempPageImgTitle">
                                Planet Earth
                            </p>
        
                            <p class="tempPageImgTxt">
                                The Planet Earth template is a captivating design with minimalist appeal.
                            </p>
        
                            <button type="button" class="btn" id="tempPageImgBtn">
                                USE TEMPLATE
                            </button>
                        </div>
        
                        <div class="col s12 m6 l4 clientTempPageImgSmDv">
                            <div class="tempPageImgDiv">
                                <img src="/media/img/tempPageImg.png" alt="tempPageImg.png">
                            </div>
        
                            <p class="tempPageImgTitle">
                                Planet Earth
                            </p>
        
                            <p class="tempPageImgTxt">
                                The Planet Earth template is a captivating design with minimalist appeal.
                            </p>
        
                            <button type="button" class="btn" id="tempPageImgBtn">
                                USE TEMPLATE
                            </button>
                        </div>
        
                        <div class="col s12 m6 l4">
                            <div class="tempPageImgDiv">
                                <img src="/media/img/tempPageImg.png" alt="tempPageImg.png">
                            </div>
        
                            <p class="tempPageImgTitle">
                                Planet Earth
                            </p>
        
                            <p class="tempPageImgTxt">
                                The Planet Earth template is a captivating design with minimalist appeal.
                            </p>
        
                            <button type="button" class="btn" id="tempPageImgBtn">
                                USE TEMPLATE
                            </button>
                        </div>
            
            
                        <!-- Second Row -->
                        <div class="col s12 m6 l4 clientTempPageImgSmDv">
                            <div class="tempPageImgDiv">
                                <img src="/media/img/tempPageImg.png" alt="tempPageImg.png" id="tempPageGridImg">
                            </div>
        
                            <p class="tempPageImgTitle">
                                Planet Earth
                            </p>
        
                            <p class="tempPageImgTxt">
                                The Planet Earth template is a captivating design with minimalist appeal.
                            </p>
        
                            <button type="button" class="btn" id="tempPageImgBtn">
                                USE TEMPLATE
                            </button>
                        </div>
        
                        <div class="col s12 m6 l4 clientTempPageImgSmDv">
                            <div class="tempPageImgDiv">
                                <img src="/media/img/tempPageImg.png" alt="tempPageImg.png">
                            </div>
        
                            <p class="tempPageImgTitle">
                                Planet Earth
                            </p>
        
                            <p class="tempPageImgTxt">
                                The Planet Earth template is a captivating design with minimalist appeal.
                            </p>
        
                            <button type="button" class="btn" id="tempPageImgBtn">
                                USE TEMPLATE
                            </button>
                        </div>
        
                        <div class="col s12 m6 l4">
                            <div class="tempPageImgDiv">
                                <img src="/media/img/tempPageImg.png" alt="tempPageImg.png">
                            </div>
        
                            <p class="tempPageImgTitle">
                                Planet Earth
                            </p>
        
                            <p class="tempPageImgTxt">
                                The Planet Earth template is a captivating design with minimalist appeal.
                            </p>
        
                            <button type="button" class="btn" id="tempPageImgBtn">
                                USE TEMPLATE
                            </button>
                        </div>
                        <!-- End of Row -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
// import FooterComponent from "./partials/FooterComponent.vue";
// import HeaderComponent from "./partials/HeaderComponent.vue";
export default {
    components: {
        // FooterComponent,
        // HeaderComponent
    },
    data() {
        return {
            bg_img: '/media/img/istockphoto-1390124896-170667a.jpg',
            pro_img: '/media/img/yuna.jpg',
        };
    },
    mounted() {},
    methods: {}
}
</script>