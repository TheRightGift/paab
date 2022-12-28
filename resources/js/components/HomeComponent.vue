<template>
    <div id="home">
        <!-- Navbar & SideNav Section -->
        <HeaderComponent :type="'main'"></HeaderComponent>


        <!--div class="row circleGenDiv">
            <div class="col s12 m4 l7">
                <div class="circlDiv">
                    <div class="circlDiv1">
                        <div class="circlDiv2">
                            <div class="circleTxtDiv">
                                <p class="circleDivTitle">SHOWCASE YOUR PROFESSION WITH PaaB</p>
                                <p class="circleDivtxt">
                                    It is a long established fact that a reader will be 
                                    distracted by the readable content of a page.
                                </p>

                                <a href="/templates" class="btn circleDivBtn">
                                    preview templates
                                </a>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>

            <div class="col s12 m8 l5">
                <div class="portraitImgDiv">
                    <div class="portraitImgContainDiv">
                        <img :src="'./media/img/portrait2.png'" alt="portrait2.png" class="portraitImg" id="portrait2">

                        <div class="portraitImgInnerDiv">
                            <img :src="'./media/img/portrait3.png'" alt="portrait3.png" class="portraitImg" id="portrait3">

                            <div class="portraitImgCircleDiv"></div>
                        </div>
                    </div>

                    <div class="portraitImgContainDiv1">
                        <div class="portraitImgRightDiv">
                            <div class="portraitImgRightInnerDiv">
                                <img :src="'./media/img/portrait.png'" alt="portrait.png" class="portraitImg" id="portrait">
                            </div>

                            <div class="portraitImgCircleRightDiv"></div>

                            <div class="portraitImgRightInnerDiv1">
                                <img :src="'./media/img/portrait1.png'" alt="portrait1.png" class="portraitImg" id="portrait1">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div-->

        <!-- Small Device SHOCASE Section -->
        <div class="hide-on-med-and-up">
            <p class="circleDivTitle">SHOWCASE YOUR PROFESSION WITH PaaB</p>
            <p class="circleDivtxt">
                It is a long established fact that a reader will be
                distracted by the readable content of a page.
            </p>
        
            <div class="circleBtnDiv">
                <a href="/templates" class="btn circleDivBtn">
                    preview templates
                </a>
            </div>
            
            <div class="portraitImgDiv">
                <div class="innerPortraitImgDiv">
                    <div class="portraitImgContainDiv">
                        <img :src="'./media/img/portrait2.png'" alt="portrait2.png" class="portraitImg" id="portrait2">
            
                        <div class="portraitImgInnerDiv">
                            <img :src="'./media/img/portrait3.png'" alt="portrait3.png" class="portraitImg" id="portrait3">
            
                            <div class="portraitImgCircleDiv"></div>
                        </div>
                    </div>
            
                    <div class="portraitImgContainDiv1">
                        <div class="portraitImgRightDiv">
                            <div class="portraitImgRightInnerDiv">
                                <img :src="'./media/img/portrait.png'" alt="portrait.png" class="portraitImg" id="portrait">
                            </div>
            
                            <div class="portraitImgCircleRightDiv"></div>
            
                            <div class="portraitImgRightInnerDiv1">
                                <img :src="'./media/img/portrait1.png'" alt="portrait1.png" class="portraitImg" id="portrait1">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="section scrollspy portfolioDiv" id="product">

                <div class="ellipseDiv">
                    <div class="ellipseLargeSm hide-on-med-and-up"></div>
                    <div class="ellipseSmallSm hide-on-med-and-up"></div>
                </div>

                <div class="portfolioInnerDiv">
                    <p class="portfolioTitle">
                        MAKE YOUR PORTFOLIO WORK FOR YOU
                    </p>
                    
                </div>
            
                <p class="portfolioTxt">
                    It is a long established fact that a reader will be distracted by the readable
                    content of a page when looking at its layout. The point of using Lorem Ipsum is
                    that it has a more-or-less normal distribution of letters, as opposed to using
                    'Content here, content here', making it look like readable English. Many desktop
                    publishing packages and web page editors now use 
                </p>
            </div>
            
        </div>





        <!-- Large Device SHOCASE Section -->
        <div class="row hide-on-small-only" id="banner">
            <div class="bannerContainer">
                <div class="col l6 circleTxtDiv">
                    <div class="">
                        <p class="circleDivTitle">SHOWCASE YOUR PROFESSION WITH PaaB</p>
                        <p class="circleDivtxt">
                            It is a long established fact that a reader will be 
                            distracted by the readable content of a page.
                        </p>
                        
                        <a href="/templates" class="btn circleDivBtn">
                            preview templates
                        </a>
                    </div>
                    
                </div>
                <div class="col l6 portraitImgDiv">
                    <div class="innerPortraitImgDiv">
                        <div class="portraitImgContainDiv">
                            <img :src="'./media/img/portrait2.png'" alt="portrait2.png" class="portraitImg" id="portrait2">

                            <div class="portraitImgInnerDiv">
                                <img :src="'./media/img/portrait3.png'" alt="portrait3.png" class="portraitImg" id="portrait3">

                                <div class="portraitImgCircleDiv"></div>
                            </div>
                        </div>

                        <div class="portraitImgContainDiv1">
                            <div class="portraitImgRightDiv">
                                <div class="portraitImgRightInnerDiv">
                                    <img :src="'./media/img/portrait.png'" alt="portrait.png" class="portraitImg" id="portrait">
                                </div>

                                <div class="portraitImgCircleRightDiv"></div>

                                <div class="portraitImgRightInnerDiv1">
                                    <img :src="'./media/img/portrait1.png'" alt="portrait1.png" class="portraitImg" id="portrait1">
                                </div>
                            </div>
                        </div>
                    </div>
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

        <div class="section scrollspy portfolioDiv hide-on-small-only" id="product">

            <div class="portfolioInnerDiv">
                <p class="portfolioTitle">
                    MAKE YOUR PORTFOLIO WORK FOR YOU
                </p>

                <!-- <div class="ellipseMedDiv"> -->
                    <div class="ellipseLarge hide-on-med-and-down"></div>
                    <div class="ellipseSmall hide-on-med-and-down"></div>
                <!-- </div> -->
                
            </div>
            
            <p class="portfolioTxt">
                It is a long established fact that a reader will be distracted by the readable 
                content of a page when looking at its layout. The point of using Lorem Ipsum is 
                that it has a more-or-less normal distribution of letters, as opposed to using 
                'Content here, content here', making it look like readable English. Many desktop 
                publishing packages and web page editors now use Lorem Ipsum as their 
                default model text, and a search for 'lorem ipsum' will uncover many web 
                sites still in their infancy. Various versions have evolved over the years, 
                sometimes by accident, sometimes on purpose (injected humour and the like).
            </p>
        </div>

        <!-- features Section -->
        <div class="section scrollspy" id="features">
            <div class=" moreThanLandDiv">
                <div class="moreThanLandInnerDiv">
                    <p class="moreThanLandTitle">MORE THAN JUST A LANDING PAGE</p>

                    <p class="moreThanLandTxt"> 
                        It is a long established fact that a reader will be distracted by the readable 
                        content of a page when looking at its layout. The point of using Lorem Ipsum is 
                        that it has a more-or-less normal distribution of letters, as opposed to using 
                        'Content here, content here.
                    </p>
                </div>
            </div>

            <!-- Live Chat Section -->
            <div class="liveChatMainDiv">
                <div class="row liveChatInnerDiv">
                    <div class="col l6 liveChatImgDiv">
                        <div class="liveChatImgInnerDiv">
                            <img :src="'./media/img/chatimage.png'" alt="chatimage.png" id="chatImage">
                        </div>
                    </div>

                    <div class="col l6 liveChatWriteUpDiv">
                        <p class="liveChatTitle">
                            LIVE CHAT
                        </p>
                        <p class="liveChatTxt">
                            It is a long established fact that a reader will be distracted by the 
                            readable content of a page when looking at its layout. The point of using 
                            Lorem Ipsum is that it has a more-or-less normal distribution of letters, 
                            as opposed to using 'Content here, content here.
                        </p>
                    </div>
                </div>
            </div>

            <!-- CV Section -->
            <div class="cvMainDiv">
                <div class="row cvInnerDiv">

                    <div class="col l3 offset-l3 cvImgDiv hide-on-large-only">
                        <div class="cvImgInnerDivSm">
                            <img :src="'./media/img/cv.png'" alt="cvFile.png" id="cvImage">
                        </div>
                    </div>

                    <div class="col l6 cvWriteUpDiv">
                        <p class="cvTitle">
                            CURRICULUM VITAE
                        </p>
                        <p class="cvTxt">
                            It is a long established fact that a reader will be distracted by the 
                            readable content of a page when looking at its layout. The point of using 
                            Lorem Ipsum is that it has a more-or-less normal distribution of letters, 
                            as opposed to using 'Content here, content here.
                        </p>
                    </div>

                    <div class="col l3 offset-l3 cvImgDiv hide-on-med-and-down">
                        <div class="cvImgInnerDiv">
                            <img :src="'./media/img/cv.png'" alt="cvFile.png" id="cvImage">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Social Media section -->
            <div class="socialMediaMainDiv">
                <div class="row socialMediaInnerDiv">
                    <div class="col l6 socialMediaImgDiv">
                        <div class="socialMediaImgInnerDiv">
                            <img :src="'./media/img/socialMedia.png'" alt="csocialMediaPhone.png" id="socialMediaImage">
                            <img :src="'./media/img/facebookImg.png'" alt="facebookImg.png" id="facebookImg">
                            <img :src="'./media/img/twiterImg.png'" alt="twiterImg.png" id="twiterImg">
                        </div>
                    </div>

                    <div class="col l6 socialMediaWriteUpDiv">
                        <p class="socialMediaTitle">
                            SOCIAL MEDIA POST
                        </p>
                        <p class="socialMediaTxt">
                            It is a long established fact that a reader will be distracted by the 
                            readable content of a page when looking at its layout. The point of using 
                            Lorem Ipsum is that it has a more-or-less normal distribution of letters, 
                            as opposed to using 'Content here, content here.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Client Review Section -->
            <div class="clientRevMainDiv">
                <div class="row clientRevInnerDiv">

                    <div class="col l3 offset-l3 clientRevImgDiv hide-on-large-only">
                        <div class="clientRevImgInnerDiv">
                            <img :src="'./media/img/clientRevImg.png'" alt="clientRevImg.png" id="clientRevImage">
                        </div>
                    </div>

                    <div class="col l6 clientRevWriteUpDiv">
                        <p class="clientRevTitle">
                            CLIENT REVIEW
                        </p>
                        <p class="clientRevTxt">
                            It is a long established fact that a reader will be distracted by the 
                            readable content of a page when looking at its layout. The point of using 
                            Lorem Ipsum is that it has a more-or-less normal distribution of letters, 
                            as opposed to using 'Content here, content here.
                        </p>
                    </div>

                    <div class="col l3 offset-l3 clientRevImgDiv hide-on-med-and-down">
                        <div class="clientRevImgInnerDiv">
                            <img :src="'./media/img/clientRevImg.png'" alt="clientRevImg.png" id="clientRevImage">
                        </div>
                    </div>

                </div>
            </div>

            <!-- Templates Section -->
            <div class="templatesRow">
                <div class="templatesRowInnerDiv row">
                    <div class="col l12 center-align">
                        <p class="templatesRowTitle">
                            TEMPLATES FIT JUST FOR YOU
                        </p>
                        <p class="templatesRowTxt">
                            It is a long established fact that a reader will be distracted by the 
                            readable content of a page when looking at its layout. The point of using 
                            Lorem Ipsum is that it has a more-or-less normal distribution of letters, 
                            as opposed to using 'Content here, content here.
                        </p>
                    </div>

                    <div class="col l12 tempRowImgDiv">
                        <img :src="'./media/img/template.png'" alt="tempImg.png" class="responsive-img tempImg">
                    </div>
                </div>
            </div>
        </div>
        

        <!-- Customer Support Section -->
        <div class="section scrollspy cusSupportDiv" id="support">
            <div class="row cusSupportInnerDiv">
                <div class="col s12 m12 l7 cusSupportImgDiv hide-on-med-and-down">
                    <img :src="'./media/img/CARE.png'" alt="CARE.png" id="careImg">
                </div>
        
                <div class="col s12 m12 l5 cusSupportFormDiv">
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
    export default {
        components: {
            FooterComponent,
            HeaderComponent
        },
        data() {
            return {};
        },
        mounted() {},
        methods: {}
    }
</script>
