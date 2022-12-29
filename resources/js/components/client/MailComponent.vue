<template>
    <div>
        <mobile-nav-component />
        
        <div class="row" id="dashRowDiv">
            <side-nav-component @user="getUser"/>
        
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
                                    <i class="material-icons tempProIcon">person</i>
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
                                    <i class="material-icons tempProIcon">person</i>
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
                                    <i class="material-icons tempProIcon">person</i>
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
                                    <i class="material-icons tempProIcon">person</i>
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
import MobileNavComponent from "../partials/MobileNavComponent.vue";
import SideNavComponent from '../partials/SideNavComponent.vue';
export default {
    components: {
        MobileNavComponent,
        SideNavComponent,
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