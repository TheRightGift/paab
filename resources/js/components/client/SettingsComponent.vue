<template>
    <div>
        <mobile-nav-component />
        
        
        <!-- Sidebar for large and medium devices -->
        <div class="row" id="dashRowDiv">
            <side-nav-component @user="getUser" />
        
            <!-- Mail blue div -->
            <div class="col s12 m10 l10" id="setRightDiv">

                <div class="setMainDiv">

                    <div class="settingBannerDiv">
                        <img src="/media/img/settingillustration.png" alt="settingillustration.png"
                            class="responsive-img settingsIllustImg right">
                    </div>

                    <div class="col s12 settingsFormDiv">
                        <form id="settingsForm">

                            <div class="row rm_mg" id="setProMainDiv">
                                <div>
                                    <div class="setProDiv">
                                        <i class="material-icons" id="setProImg">person</i>
                                    </div>
                                    
                                    <div class="setProEditIconDiv">
                                        <i class="material-icons" id="setProEditIcon">edit</i>
                                    </div>
                                </div>

                                <div class="setProTitleDiv">
                                    <p class="mySetTitle">Settings</p>
                                    <span class="mySetName">jubrilake@gmail.com</span>
                                </div>
                            </div>
                            

                            <div class="row rm_mg">
                                <div class="row rm_mg">
                                    <div class="input-field col s4 rm_mg sm_mg">
                                        <input placeholder="Title" type="text" class="validate" id="settingTitle">
                                    </div>

                                    <div class="input-field col s4 rm_mg sm_mg">
                                        <input placeholder="Last Name" id="settingLname" type="text" class="validate">
                                    </div>

                                    <div class="input-field col s4 rm_mg sm_mg">
                                        <input placeholder="First Name" id="settingFName" type="text" class="validate">
                                    </div>
                                </div>

                                <div class="row rm_mg">
                                    <div class="input-field col s12 rm_mg sm_mg">
                                        <input placeholder="Email" id="settingEmail" type="email" class="validate">
                                    </div>
                                </div>

                                <div class="row rm_mg">
                                    <div class="input-field col s12 rm_mg sm_mg">
                                        <input placeholder="Phone Number" id="settingPhone" type="text" class="validate">
                                    </div>
                                </div>

                                <div class="row rm_mg">
                                    <div class="input-field col s6 rm_mg sm_mg">
                                        <input placeholder="Country" id="settingCountry" type="text" class="validate">
                                    </div>

                                    <div class="input-field col s6 rm_mg sm_mg">
                                        <select class="browser-default" id="settingGender">
                                            <option value="" disabled selected>Gender</option>
                                            <option value="M">Male</option>
                                            <option value="F">Female</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row rm_mg">
                                    <div class="input-field col s6 rm_mg sm_mg">
                                        <input placeholder="State" id="settingState" type="text" class="validate">
                                    </div>

                                    <div class="input-field col s6 rm_mg sm_mg">
                                        <input placeholder="City" id="settingCity" type="text" class="validate">
                                    </div>
                                </div>

                                <div class="row rm_mg">
                                    <div class="input-field col s12 rm_mg sm_mg">
                                        <input placeholder="Password" id="settingPass" type="password" class="validate">
                                    </div>
                                </div>

                                <div class="row rm_mg">
                                    <div class="input-field col s12 rm_mg sm_mg">
                                        <input placeholder="Confirm Password" id="settingCpass" type="password" class="validate">
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
</template>

<script>
import MobileNavComponent from '../partials/MobileNavComponent.vue';
import SideNavComponent from '../partials/SideNavComponent.vue';
// import FooterComponent from "./partials/FooterComponent.vue";
// import HeaderComponent from "./partials/HeaderComponent.vue";
export default {
    components: {
        MobileNavComponent,
        SideNavComponent
        // FooterComponent,
        // HeaderComponent
    },
    data() {
        return {
            bg_img: '/media/img/istockphoto-1390124896-170667a.jpg',
            pro_img: '/media/img/yuna.jpg',
            user: {},
        };
    },
    mounted() { },
    methods: {
        getUser(e) {
            this.user = e;
        }
    }
}
</script>





