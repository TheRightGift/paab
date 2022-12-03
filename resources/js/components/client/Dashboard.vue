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
                    <a href="/client/dashboard" class="dashLeftBarListDiv">
                        <i class="material-icons dashLeftBarIcons purple-text text-darken-4">dashboard</i>
                        <p class="dashLeftBarTitle">Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="/client/websites" class="dashLeftBarListDiv">
                        <i class="material-icons dashLeftBarIcons">web</i>
                        <p class="dashLeftBarTitle">Websites</p>
                    </a>
                </li>
                <!-- <li><div class="divider"></div></li> -->
                <!-- <li><a class="subheader">Subheader</a></li> -->
                <li>
                    <a href="/client/template" class="dashLeftBarListDiv">
                        <i class="material-icons">chrome_reader_mode</i>
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
                    <a href="/client/support" class="dashLeftBarListDiv">
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
                        <a href="/client/dashboard" class="dashLeftBarListDiv">
                            <i class="material-icons" id="dashActive">dashboard</i>
                            <p class="dashLeftBarTitle">Dashboard</p>
                        </a>
        
                        <a href="/client/websites" class="dashLeftBarListDiv">
                            <i class="material-icons dashLeftBarIcons">web</i>
                            <p class="dashLeftBarTitle">Websites</p>
                        </a>
        
                        <a href="/client/template" class="dashLeftBarListDiv">
                            <i class="material-icons dashLeftBarIcons">chrome_reader_mode</i>
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
        
            <div class="col s12 m10 l10">
                <div class="dashRightDiv">
                    <div id="dashRightImgDiv">
                        <div id="dashRightImgInnerDiv">
                            <div class="dashRightImgTxtDiv">
                                <p class="dashRightImgTitle">Skyrocket your portfolio</p>
                                <p class="dashRightImgTxt">
                                    Lorem Ipsum is simply dummy text of the printing and
                                    typesetting industry. Lorem Ipsum has been the industry's
                                </p>
                            </div>
        
                        </div>
                    </div>
        
                    <div class="row" id="dashWlcNoteRowDiv">
                        <div class="col s12 m8 l8">
                            <div class="dashWlcNoteDiv">
                                <div class="dashWlcNoteInnerDiv">
                                    <p class="dashWlcNoteTitle">
                                        Welcome! <span class="dashWlcNoteTitle1">Dr. Adebayo Akerele</span>
                                    </p>
                                    <p class="dashWlcNoteTxt">
                                        Lets start and automate your process so you can reclaim
                                        time and focus on your goals.
                                    </p>
                                </div>
                            </div>
                        </div>
        
                        <div class="col s12 m4 l4">
                            <div class="row">
        
                                <div class="dashTimeDiv">
                                    <div class="col s7 m6 l6">
                                        <div class="dashTimeInnerDiv">
                                            <p class="dashTimeDate">Nov 26th,2022</p>
                                            <p class="dashTime">
                                                10:30<span class="dashTimePeriod">am</span>
                                            </p>
                                        </div>
                                    </div>
        
                                    <div class="col s5 m6 l6">
                                        <div class="shapeDegDiv">
                                            <div class="shapeDeg"></div>
                                            <div class="shapeDeg1"></div>
                                            <div class="shapeDeg2"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <div class="row" id="myWebDiv">
                        <div class="col s12 m6 l6">
                            <div class="cardDiv">
                                <div class="cardHeader">
                                    <p class="cardTitle">MY WEBSITES</p>
                                </div>
                            </div>
                            <div class="cardContent">
                                <div class="cardContentProfile">
                                    <div class="row" id="myWebRmMgRow">
                                        <div class="col s10 m10 l10">
                                            <div class="cardImgMainDiv">
                                                <div class="cardImgDiv">
                                                    <i class="material-icons" id="cardImg">person</i>
                                                </div>
                                                <p class="cardProName">eskoba</p>
                                            </div>
        
                                        </div>
        
                                        <div class="col s2 m2 l2">
                                            <a href="#" id="cardViewLink">View</a>
                                        </div>
        
                                        <div class="col s12">
                                            <hr class="cardLine">
                                        </div>
                                    </div>
        
                                    <div class="row" id="myWebRmMgRow">
                                        <div class="col s10 m10 l10">
                                            <div class="cardImgMainDiv">
                                                <div class="cardImgDiv">
                                                    <i class="material-icons" id="cardImg">person</i>
                                                </div>
                                                <p class="cardProName">eskoba</p>
                                            </div>
        
                                        </div>
        
                                        <div class="col s2 m2 l2">
                                            <a href="#" id="cardViewLink">View</a>
                                        </div>
        
                                        <div class="col s12">
                                            <hr class="cardLine">
                                        </div>
        
                                        <div class="col s2 offset-s10">
                                            <i class="material-icons" id="dashAddIconBtn">add_circle</i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
        
                        <div class="col s12 m6 l6">
                            <div class="cardDiv">
                                <div class="cardHeader">
                                    <p class="cardTitle">MY MAIL</p>
                                </div>
                                <div class="cardContent">
                                    <div class="row" id="myMailDiv">
                                        <div class="col s10 m10 l10">
                                            <div class="cardImgMainDiv">
                                                <div class="cardImgDiv">
                                                    <i class="material-icons" id="cardImg">person</i>
                                                </div>
                                                <a href="#" class="cardProName">info@paab.com</a>
                                            </div>
                                        </div>
        
                                        <div class="col s2 m2 l2">
                                            <p class="dashTimeAgo">2m</p>
                                        </div>
        
                                        <div class="col s10 offset-s2">
                                            <p class="mailCardTxt">
                                                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                                Lorem Ipsum has been the industry's standard dummy text ever since
                                                the 1500s, when an unknown printer took a galley of type and
                                                scrambled it to make a type specimen book, Lorem Ipsum
                                                is simply dummy text of the printing and typesetting Lorem Ipsum has been the
                                                industry's standard dummy text ever since
                                                the 1500s,....
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
        mounted() { console.log('Mounted Dash client') },
        methods: {}
    }
</script>