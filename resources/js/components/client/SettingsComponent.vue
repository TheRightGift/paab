<template>
    <div>
        <mobile-nav-component />
        
        
        <!-- Sidebar for large and medium devices -->
        <div class="row" id="dashRowDiv">
            <side-nav-component @user="getUser"/>
        
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
import MobileNavComponent from '../partials/MobileNavComponent.vue';
import SideNavComponent from '../partials/SideNavComponent.vue';
export default {
    components: {
        MobileNavComponent,
        SideNavComponent
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