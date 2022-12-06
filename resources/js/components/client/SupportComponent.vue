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
                        <i class="material-icons dashLeftBarIcons purple-text text-darken-4">question_answer</i>
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
                            <i class="material-icons dashLeftBarIcons">mail_outline</i>
                            <p class="dashLeftBarTitle">Mails</p>
                        </a>
        
                        <a href="/client/settings" class="dashLeftBarListDiv">
                            <i class="material-icons dashLeftBarIcons">settings</i>
                            <p class="dashLeftBarTitle">Settings</p>
                        </a>
        
                        <a href="/client/support" class="dashLeftBarListDiv">
                            <i class="material-icons dashLeftBarIcons" id="dashActive">question_answer</i>
                            <p class="dashLeftBarTitle">Help/Support</p>
                        </a>
        
                        <a href="#" class="dashLeftBarListDiv">
                            <i class="material-icons dashLeftBarIcons">autorenew</i>
                            <p class="dashLeftBarTitle">Logout</p>
                        </a>
                    </div>
                </div>
            </div>
        
            <!-- Right Side Div -->
            <div class="col s12 m10 l10" id="supportRightDiv">
                <div class="supportBlueDiv">
                    <div class="webBlackDiv1">
                        <div class="row webBlackDiv1">
                            <div class="col s12">
                                <p class="supportTitle">FAQs</p>
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

                <div class="row supportDiv">
                    <div class="col s12 m6 l6 supportColDiv">
                        <p class="supportTitle1">Is it a free platform</p>
                        <p class="supportTxt1">
                            There are many variations of passages of Lorem Ipsum available, 
                            but the majority have suffered alteration in some form, by injected humour, 
                            or randomised words which don't look even slightly believable. 
                            If you are going
                        </p>
                    </div>

                    <div class="col s12 m6 l6">
                        <p class="supportTitle1">Is it a free platform</p>
                        <p class="supportTxt1">
                            There are many variations of passages of Lorem Ipsum available,
                            but the majority have suffered alteration in some form, by injected humour,
                            or randomised words which don't look even slightly believable.
                            If you are going
                        </p>
                    </div>

                    <div class="col s12 m6 l6">
                        <p class="supportTitle1">Is it a free platform</p>
                        <p class="supportTxt1">
                            There are many variations of passages of Lorem Ipsum available,
                            but the majority have suffered alteration in some form, by injected humour,
                            or randomised words which don't look even slightly believable.
                            If you are going
                        </p>
                    </div>

                    <div class="col s12 m6 l6">
                        <p class="supportTitle1">Is it a free platform</p>
                        <p class="supportTxt1">
                            There are many variations of passages of Lorem Ipsum available,
                            but the majority have suffered alteration in some form, by injected humour,
                            or randomised words which don't look even slightly believable.
                            If you are going
                        </p>
                    </div>

                    <div class="col s12 m6 l6">
                        <p class="supportTitle1">Is it a free platform</p>
                        <p class="supportTxt1">
                            There are many variations of passages of Lorem Ipsum available,
                            but the majority have suffered alteration in some form, by injected humour,
                            or randomised words which don't look even slightly believable.
                            If you are going
                        </p>
                    </div>

                    <div class="col s12 m6 l6">
                        <p class="supportTitle1">Is it a free platform</p>
                        <p class="supportTxt1">
                            There are many variations of passages of Lorem Ipsum available,
                            but the majority have suffered alteration in some form, by injected humour,
                            or randomised words which don't look even slightly believable.
                            If you are going
                        </p>
                    </div>
                </div>

                <div class="supportGetInTouchDiv">
                    <div class="row supportGetInTouchRowDiv">
                        <div class="col l1">
                            <div class="cardImgDiv">
                                <i class="material-icons" id="cardImg">person</i>
                            </div>
                        </div>

                        <div class="col l9">
                            <p class="supportGetInTouchTitle">Still have any questions?</p>
                            <p class="supportGetInTouchTxt">
                                Can’t find the answers you are looking for? 
                                please chat with our friendly team
                            </p>
                        </div>

                        <div class="col l2" id="supportGetInTouchBtnColDiv">
                            <button class="btn" type="button" id="supportGetInTouchBtn" @click="supportModal()">
                                GET INTOUCH
                            </button>
                        </div>
                    </div>
                </div>
        
                <!-- Customer Support Modal -->
                <div class="clientModalSupportDiv" v-if="!isHidden">
                    <i class="material-icons" id="clientCusSupportCancelBtn" @click="hideSupportModal()">cancel</i>
                    <div class="row clientModalSupportInnerDiv">
                        <div class="col s12 m12 l5 cusSupportImgDiv">
                            <img src="/media/img/CARE.png" alt="CARE.png" id="careImg">
                        </div>
                
                        <div class="col s12 m12 l7 cusSupportFormDiv">
                            <p class="cusSupportTitle">WE’RE ALWAYS HAPPY TO HELP</p>
                
                            <form class="col s12">
                                <div class="row rm_mg">
                                    <div class="input-field col s6 rm_mg">
                                        <input placeholder="First name" id="fName" type="text" class="validate">
                                        <!-- <label for="first_name">First Name</label> -->
                                    </div>
                                    <div class="input-field col s6 rm_mg">
                                        <input placeholder="Last name " id="lName" type="text" class="validate">
                                        <!-- <label for="last_name">Last Name</label> -->
                                    </div>
                                </div>
                
                                <div class="row rm_mg">
                                    <div class="input-field col s12 rm_mg">
                                        <input placeholder="Email address" id="email" type="email" class="validate">
                                        <!-- <label for="email">Email</label> -->
                                    </div>
                                </div>
                
                                <div class="row rm_mg">
                                    <div class="input-field col s12 rm_mg">
                                        <textarea placeholder="Share your thoughts..." id="textarea1"
                                            class="materialize-textarea"></textarea>
                                    </div>
                                </div>
                
                                <button type="button" class="btn col s12 m12 l12 rm_mg" id="modalSupportBtnForm">
                                    Send
                                </button>
                            </form>
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

            isHidden: true

        };
    },
    mounted() { },
    methods: {
        supportModal() {
            this.isHidden = false
        },
        hideSupportModal() {
            this.isHidden = true
        }
    }
}
</script>