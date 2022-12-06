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
                        <i class="material-icons dashLeftBarIcons purple-text text-darken-4">settings</i>
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
                            <i class="material-icons dashLeftBarIcons">mail_outline</i>
                            <p class="dashLeftBarTitle">Mails</p>
                        </a>
        
                        <a href="/client/settings" class="dashLeftBarListDiv">
                            <i class="material-icons dashLeftBarIcons" id="dashActive">settings</i>
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
            <div class="col s12 m10 l10" id="setRightDiv">

                <div class="setMainDiv">
                    <div>
                        <p class="mySetTitle">My settings</p>
                    </div>

                    <div class="">
                        <div class="settingsFormDiv">
                            <form id="settingsForm">

                                <div id="setProMainDiv">
                                    <div class="setProDiv">
                                        <i class="material-icons" id="setProImg">person</i>
                                    </div>

                                    <div class="setProEditIconDiv">
                                        <i class="material-icons" id="setProEditIcon">edit</i>
                                    </div>
                                </div>
                                

                                <div class="row rm_mg">
                                    <div class="row rm_mg">
                                        <div class="input-field col s4 rm_mg sm_mg">
                                            <input placeholder="Title" type="text" class="validate" id="signupTitle">
                                        </div>

                                        <div class="input-field col s4 rm_mg sm_mg">
                                            <input placeholder="Last Name" id="signupLname" type="text" class="validate">
                                        </div>

                                        <div class="input-field col s4 rm_mg sm_mg">
                                            <input placeholder="First Name" id="signupFName" type="text" class="validate">
                                        </div>
                                    </div>

                                    <div class="row rm_mg">
                                        <div class="input-field col s12 rm_mg sm_mg">
                                            <input placeholder="Email" id="signupEmail" type="email" class="validate">
                                        </div>
                                    </div>

                                    <div class="row rm_mg">
                                        <div class="input-field col s12 rm_mg sm_mg">
                                            <input placeholder="Phone Number" id="signupPhone" type="Number" class="validate">
                                        </div>
                                    </div>

                                    <div class="row rm_mg">
                                        <div class="input-field col s6 rm_mg sm_mg">
                                            <input placeholder="Country" id="signupCountry" type="text" class="validate">
                                        </div>

                                        <div class="input-field col s6 rm_mg sm_mg">
                                            <select class="browser-default" id="signupGender">
                                                <option value="" disabled selected>Gender</option>
                                                <option value="M">Male</option>
                                                <option value="F">Female</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row rm_mg">
                                        <div class="input-field col s6 rm_mg sm_mg">
                                            <input placeholder="State" id="signupState" type="text" class="validate">
                                        </div>

                                        <div class="input-field col s6 rm_mg sm_mg">
                                            <input placeholder="City" id="signupCity" type="text" class="validate">
                                        </div>
                                    </div>

                                    <div class="row rm_mg">
                                        <div class="input-field col s12 rm_mg sm_mg">
                                            <input placeholder="Password" id="signupPass" type="password" class="validate">
                                        </div>
                                    </div>

                                    <div class="row rm_mg">
                                        <div class="input-field col s12 rm_mg sm_mg">
                                            <input placeholder="Confirm Password" id="signCpass" type="password" class="validate">
                                        </div>
                                    </div>

                                    <button class="btn col s12 rm_mg sm_mg" type="button" id="setFormBtn">
                                        SAVE
                                    </button>
                                </div>
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
        };
    },
    mounted() { },
    methods: {}
}
</script>