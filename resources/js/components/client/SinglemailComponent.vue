<template>
    <div>
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
                    <a href="#" class="dashLeftBarListDiv">
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
        
                        <a href="#" class="dashLeftBarListDiv">
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
        
            <!-- Mail blue div -->
            <div class="col s12 m10 l10" id="singleMailRightDiv">
                <div class="clientSendmailContainDiv">
                    <div class="clientSendMailBackLinkDiv">
                        <a href="/client/dashboard" class="clientSendmailArrowBackLink">
                            <i class="material-icons" id="clientSendmailArrowBackIcon">arrow_back</i>
                            <span class="clientSendmailBackTxt">Back</span>
                        </a>
                    </div>
                    <div class="clientModalDiv">
                        <div class="row" id="clientSendmailRowDiv">
                            <div class="col l1">
                                <div class="cardImgDiv">
                                    <i class="material-icons" id="cardImg">person</i>
                                </div>
                            </div>
                
                            <div class="col l10">
                                <a href="#" class="clientSendemailTitle">info@paab.com</a>
                                <p class="clientSendemailTxt">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                                    industry's standard
                                    dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to
                                    make
                                    a type specimen
                                    book. It has survived not only five centuries, but also the leap into electronic typesetting,
                                    remaining
                                    essentially
                                    unchanged.
                                </p>
                                <p class="clientSendemailTxt1">
                                    There are many variations of passages of Lorem Ipsum available, but the majority have suffered
                                    alteration in some form,
                                    by injected humour, or randomised words which don't look even slightly believable. If you are going
                                    to
                                    use a passage of
                                    Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All
                                    the
                                    Lorem Ipsum
                                    generators on the Internet tend to repeat predefined chunks as necessary, making this the first true
                                    generator on the
                                    Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence
                                    structures, to
                                    generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from
                                    repetition,
                                    injected humour, or non-characteristic words etc.
                                </p>
                                <p class="clientSendemailTxt2">
                                    There are many variations of passages of Lorem Ipsum available, but the majority have suffered
                                    alteration in some form,
                                    by injected humour, or randomised words which don't look even slightly believable. If you are going
                                    to
                                    use a passage of
                                    Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All
                                    the
                                    Lorem Ipsum
                                    generators on the Internet tend to repeat predefined chunks as necessary, making this the first true
                                    generator on the
                                    Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence
                                    structures, to
                                    generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from
                                    repetition,
                                    injected humour, or non-characteristic words etc.
                
                                </p>
                            </div>
                
                            <div class="col l1">
                                <span class="clientSendmailTimeSent">
                                    now
                                </span>
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
    methods: {}
}
</script>