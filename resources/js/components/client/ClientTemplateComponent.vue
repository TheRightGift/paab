<template>
    <div>
        <mobile-nav-component />
        
        
        <!-- Sidebar for large and medium devices -->
        <div class="row" id="dashRowDiv">
            <side-nav-component @user="getUser"/>
        
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
        };
    },
    mounted() {},
    methods: {}
}
</script>