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
                        <a href="#name"><span class="white-text name">Dr. {{user.firstname}} {{user.lastname}}</span></a>
                        <a href="#email"><span class="white-text email">{{user.email}}</span></a>
                    </div>
                </li>

                <li>
                    <a href="/client/dashboard" class="dashLeftBarListDiv">
                        <i class="material-icons dashLeftBarIcons">dashboard</i>
                        <p class="dashLeftBarTitle">Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="#" class="dashLeftBarListDiv">
                        <i class="material-icons dashLeftBarIcons purple-text text-darken-4">web</i>
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
                            <i class="material-icons dashLeftBarIcons" id="dashActive">web</i>
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

            <!-- Web black div -->
            <div class="col s12 m10 l10" id="webRightDiv">
                <div class="webBlackDiv">
                    <div class="webBlackDiv1">
                        
                        <div class="row webBlackDiv1">
                            <div class="col s12">
                                <p class="webBlackTitle">Create Portfolio</p>
                            </div>
                            <div class="col s11">
                                <p class="webBlackTxt">
                                    Lets start and automate your process so you can
                                    reclaim time and focus on your goals.
                                </p>
                            </div>
                            <div class="col s1">
                                <i class="material-icons right" id="webAddCircleIcon">add_circle</i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- web empty div -->
                <div class="webWhiteDiv" >
                    <div class="webWhiteDiv1" >
                        <div v-if="(websites.length > 0)">
                            <div class="row" id="webWhiteDiv2" v-for="website in websites" :key="website.id">
                                <div class="col s3 m2 l2" id="webWhiteProMgLftDiv">
                                    <div id="">
                                        <div class="webWhiteProDiv" id="">
                                            <i class="material-icons" id="tempProIcon">person</i>
                                        </div>
                                        <p class="webWhiteProName">escoba</p>
                                    </div>
                                </div>
    
                                <div class="col s5 s5 l6 offset-s1">
                                    <p class="webWhiteTitle">Description</p>
                                    <p class="webWhiteTxt">
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                                        Lorem Ipsum has been the industry's standard dummy text
                                    </p>
                                </div>
    
                                <div class="col s1 m2 l3 offset-s1 offset-m1">
                                    <a href="#">
                                        <i class="material-icons right" id="webWhiteIcon">open_in_new</i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div v-else>
                            <p class="centered">No website created yet!. All websites appears here when you create one</p>
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
            user: {},
            websites: [],

        };
    },
    mounted() { 
        this.getUser();
        this.getWebsites();
    },
    methods: {
        getUser() {
            axios.get("/api/user").then(res => {
                this.user = res.data;
            }).catch(err => {
                console.log(err);
            });
        },
        getWebsites() {
            axios.get("/api/tenancies").then(res => {
                if (res.data.status == 200) {
                    this.websites = res.data;
                }
            }).catch(err => {
                console.log(err);
            });
        },
    }
}
</script>
<style>
.centered {
    color: black;
}
</style>