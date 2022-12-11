<template>
    <div>
        <!-- Navbar & SideNav Section -->
        <HeaderComponent :type="'template'"></HeaderComponent>      
        
        <!-- Templates Section -->
        <div class="section scrollspy tempContainDiv" id="template">
            <div class="tempContainInnerDiv">
                <div class="row">
                    <div class="col s12 m6 l6">
                        <div class="tempPageLeftDiv">
                            <p class="tempPageTitle">
                                READY TO IMPORT <br> WEBSITE <br> TEMPLATES
                            </p>
        
                            <p class="tempPageTxt">
                                Discover thousands of easy to customize website templates
                                made by professional designers that are responsive and
                                conversion optimized.
                            </p>
        
                            <a href="/auth/getstarted" class="btn tempPageBtn">
                                Get started
                            </a>
                        </div>
        
                    </div>
        
                    <div class="col s12 m6 l6">
                        <div class="tempImgDiv1">
                            <img src="/media/img/template.png" alt="tempImg.png" class="responsive-img tempPageImg">
                        </div>
                    </div>
                </div>
        
                <!-- Page Arrow Up -->
                <button class="fixedArrowUpIconBtn hide-on-med-and-down" id="fixedArrowUpIconBtn" onclick="topFunction()">
                    <div class="fixedArrowUpIconInnerDiv">
                        <div class="fixedArrowUpCircleDiv"></div>
                        <i class="fa-solid fa-arrow-up" id="fixedArrowUpIcon"></i>
                    </div>
                </button>
        
                <!--TEMPLATE HERE-->
                <TemplatePreviewComponent :professionId="0" :selectedTemplate="0"  :type="'preview'"/>
            </div>
        </div>
        
        
        <!-- Customer Support Section -->
        <div class="section scrollspy cusSupportDiv" id="support">
            <div class="row cusSupportInnerDiv">
                <div class="col s12 m12 l7 cusSupportImgDiv">
                    <img src="/media/img/CARE.png" alt="CARE.png" id="careImg">
                </div>
        
                <div class="col s12 m12 l5 cusSupportFormDiv">
                    <p class="cusSupportTitle">WE’RE ALWAYS HAPPY TO HELP</p>
        
                    <form class="col s12">
                        <div class="row rm_mg">
                            <div class="input-field col s6">
                                <input placeholder="First name" id="fName" type="text" class="validate">
                                <!-- <label for="first_name">First Name</label> -->
                            </div>
                            <div class="input-field col s6">
                                <input placeholder="Last name " id="lName" type="text" class="validate">
                                <!-- <label for="last_name">Last Name</label> -->
                            </div>
                        </div>
        
                        <div class="row rm_mg">
                            <div class="input-field col s12">
                                <input placeholder="Email address" id="email" type="email" class="validate">
                                <!-- <label for="email">Email</label> -->
                            </div>
                        </div>
        
                        <div class="row rm_mg">
                            <div class="input-field col s12">
                                <textarea placeholder="Share your thoughts..." id="textarea1"
                                    class="materialize-textarea"></textarea>
                                <!-- <label for="textarea1">Textarea</label> -->
                            </div>
                        </div>
        
                        <button type="button" class="btn col s12 m12 l12 rm_mg" id="btnForm">
                            Send
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Footer -->
        <FooterComponent/>
    </div>
</template>

<script>
    import FooterComponent from "./partials/FooterComponent.vue";
    import HeaderComponent from "./partials/HeaderComponent.vue";
    import TemplatePreviewComponent from "./partials/TemplatePreviewComponent.vue";
    export default {
        components: {
            FooterComponent,
            HeaderComponent,
            TemplatePreviewComponent
        },
        data() {
            return {};
        },
        mounted() {},
        methods: {}
    }
</script>
