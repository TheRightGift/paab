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
                        <i class="material-icons dashLeftBarIcons">dashboard</i>
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
                        <i class="material-icons">chrome_reader_mode</i>
                        <p class="dashLeftBarTitle">Templates</p>
                    </a>
                </li>
                <li>
                    <a href="/client/mail" class="dashLeftBarListDiv">
                        <i class="material-icons dashLeftBarIcons purple-text text-darken-4">mail_outline</i>
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
                        <a href="/client/dashboard" class="dashLeftBarListDiv">
                            <i class="material-icons dashLeftBarIcons">dashboard</i>
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
                            <i class="material-icons dashLeftBarIcons" id="dashActive">mail_outline</i>
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
        
            <!-- Mail blue div -->
            <div class="col s12 m10 l10" id="mailRightDiv">
                <div class="mailBlueDiv">
                    <div class="webBlackDiv1">
        
                        <div class="row webBlackDiv1">
                            <div class="col s12">
                                <p class="mailTitle">Get Updates</p>
                            </div>
                            <div class="col s12">
                                <p class="webBlackTxt">
                                    Lets start and automate your process so you can
                                    reclaim time and focus on your goals.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
        
                <!-- Mail Black div -->
                <div class="mailBlackDiv" id="mailScrollDiv" @click="showSingleEmail()">
                    <div class="webBlackDiv1">
                        <div class="row" id="mailInnerDiv">
                            <div class="col s2 m2 l1">
                                <div class="webWhiteProDiv" id="">
                                    <i class="material-icons" id="tempProIcon">person</i>
                                </div>
                            </div>
                            <div class="col s8 m9 l10">
                                <a href="#" class="mailLink">info@paab.com</a>
                                <p class="mailP">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                                    when an unknown printer took a galley of type and scrambled it to make a type specimen
                                    book. It has survived not only five centuries, but also the leap into electronic typesetting, 
                                    remaining essentially
                                    unchanged.
                                </p>
                            </div>
                            <div class="col s2 m1 l1">
                                <span class="mailTime right">Now</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mail Black div -->
                <div class="mailBlackDiv" id="mailScrollDiv">
                    <div class="webBlackDiv1">
                        <div class="row" id="mailInnerDiv">
                            <div class="col s2 m2 l1">
                                <div class="webWhiteProDiv" id="">
                                    <i class="material-icons" id="tempProIcon">person</i>
                                </div>
                            </div>
                            <div class="col s8 m9 l10">
                                <a href="#" class="mailLink">info@paab.com</a>
                                <p class="mailP">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                                    when an unknown printer took a galley of type and scrambled it to make a type specimen
                                    book. It has survived not only five centuries, but also the leap into electronic typesetting,
                                    remaining essentially
                                    unchanged.
                                </p>
                            </div>
                            <div class="col s2 m1 l1">
                                <span class="mailTime right">Yesterday</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mail Black div -->
                <div class="mailBlackDiv" id="mailScrollDiv">
                    <div class="webBlackDiv1">
                        <div class="row" id="mailInnerDiv">
                            <div class="col s2 m2 l1">
                                <div class="webWhiteProDiv" id="">
                                    <i class="material-icons" id="tempProIcon">person</i>
                                </div>
                            </div>
                            <div class="col s8 m9 l10">
                                <a href="#" class="mailLink">info@paab.com</a>
                                <p class="mailP">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                                    when an unknown printer took a galley of type and scrambled it to make a type specimen
                                    book. It has survived not only five centuries, but also the leap into electronic typesetting,
                                    remaining essentially
                                    unchanged.
                                </p>
                            </div>
                            <div class="col s2 m1 l1">
                                <span class="mailTime right">2days ago</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mail Black div -->
                <div class="mailBlackDiv" id="mailScrollDiv">
                    <div class="webBlackDiv1">
                        <div class="row" id="mailInnerDiv">
                            <div class="col s2 m2 l1">
                                <div class="webWhiteProDiv" id="">
                                    <i class="material-icons" id="tempProIcon">person</i>
                                </div>
                            </div>
                            <div class="col s8 m9 l10">
                                <a href="#" class="mailLink">info@paab.com</a>
                                <p class="mailP">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                                    when an unknown printer took a galley of type and scrambled it to make a type specimen
                                    book. It has survived not only five centuries, but also the leap into electronic typesetting,
                                    remaining essentially
                                    unchanged.
                                </p>
                            </div>
                            <div class="col s2 m1 l1">
                                <span class="mailTime right">Nov 3rd</span>
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
    mounted() { },
    methods: {
        showSingleEmail() {
            window.location.href = "/client/singlemail";
        }
    }
}
</script>