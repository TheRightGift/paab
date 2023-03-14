<template>
    <div id="home">
        <!-- Navbar & SideNav Section -->
        <HeaderComponent :type="'main'"></HeaderComponent>
        
        <!-- Small Device SHOCASE Section -->
        <div class="hide-on-med-and-up">
            <p class="circleDivTitle"><small>SHOWCASE YOUR PROFESSION WITH </small>White Coat Domain</p>
            <p class="circleDivtxtSmall">
                Our professional wish is that you STAND OUT in your medical practice and share more with the world what makes you an awesome physician. 
            </p>

            <div class="circleBtnDiv">
                <a href="/templates" class="btn circleDivBtn">
                    preview templates
                </a>
            </div>

            <div class="portraitImgDiv">
                <div class="innerPortraitImgDiv">
                    <div class="portraitImgContainDiv">
                        <img
                            :src="'./media/img/portrait2.png'"
                            alt="portrait2.png"
                            class="portraitImg"
                            id="portrait2"
                        />

                        <div class="portraitImgInnerDiv">
                            <img
                                :src="'./media/img/portrait3.png'"
                                alt="portrait3.png"
                                class="portraitImg"
                                id="portrait3"
                            />

                            <div class="portraitImgCircleDiv"></div>
                        </div>
                    </div>

                    <div class="portraitImgContainDiv1">
                        <div class="portraitImgRightDiv">
                            <div class="portraitImgRightInnerDiv">
                                <img
                                    :src="'./media/img/portrait.png'"
                                    alt="portrait.png"
                                    class="portraitImg"
                                    id="portrait"
                                />
                            </div>

                            <div class="portraitImgCircleRightDiv"></div>

                            <div class="portraitImgRightInnerDiv1">
                                <img
                                    :src="'./media/img/portrait1.png'"
                                    alt="portrait1.png"
                                    class="portraitImg"
                                    id="portrait1"
                                />
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

                <div>
                    <p class="portfolioTxt">
                        Select from our variety of ground breaking templates ,
                        designer fonts and eye catching colors that speaks to
                        your style and professional taste.
                    </p>

                    <P class="portfolioTxt">
                        Explore with our add ons- whether it is linking your
                        social media platforms , scheduling an appointment and
                        displaying client reviews.
                    </P>

                    <P class="portfolioTxt">
                        Let your words travel faster by linking all your social
                        media accounts to retain and grow your audience.
                    </P>
                </div>
            </div>
        </div>

        <!-- Large Device SHOCASE Section -->
        <div class="row hide-on-small-only" id="banner">
            <div class="bannerContainer">
                <div class="col l6 circleTxtDiv">
                    <div class="">
                        <p class="circleDivTitle">
                            <small>SHOWCASE YOUR PROFESSION WITH </small>White Coat Domain
                        </p>
                        <p class="circleDivtxt">
                            Our professional wish is that you STAND OUT in your medical practice and share more with the world what makes you an awesome physician. 
                        </p>

                        <a href="/templates" class="btn circleDivBtnLg">
                            preview templates
                        </a>
                    </div>
                </div>
                <div class="col l6 portraitImgDiv">
                    <div class="innerPortraitImgDiv">
                        <div class="portraitImgContainDiv">
                            <img
                                :src="'./media/img/portrait2.png'"
                                alt="portrait2.png"
                                class="portraitImg"
                                id="portrait2"
                            />

                            <div class="portraitImgInnerDiv">
                                <img
                                    :src="'./media/img/portrait3.png'"
                                    alt="portrait3.png"
                                    class="portraitImg"
                                    id="portrait3"
                                />

                                <div class="portraitImgCircleDiv"></div>
                            </div>
                        </div>

                        <div class="portraitImgContainDiv1">
                            <div class="portraitImgRightDiv">
                                <div class="portraitImgRightInnerDiv">
                                    <img
                                        :src="'./media/img/portrait.png'"
                                        alt="portrait.png"
                                        class="portraitImg"
                                        id="portrait"
                                    />
                                </div>

                                <div class="portraitImgCircleRightDiv"></div>

                                <div class="portraitImgRightInnerDiv1">
                                    <img
                                        :src="'./media/img/portrait1.png'"
                                        alt="portrait1.png"
                                        class="portraitImg"
                                        id="portrait1"
                                    />
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
                <p class="portfolioTitle">MAKE YOUR PORTFOLIO WORK FOR YOU</p>

                <!-- <div class="ellipseMedDiv"> -->
                <div class="ellipseLarge hide-on-med-and-down"></div>
                <div class="ellipseSmall hide-on-med-and-down"></div>
                <!-- </div> -->
            </div>

            <div>
                <p class="portfolioTxt">
                    Select from our variety of ground breaking templates , designer fonts and eye catching colors that speaks to your
                    style
                    and professional taste.
                </p>
                
                <P class="portfolioTxt">
                    Explore with our add ons- whether it is linking your social media platforms , scheduling an
                    appointment and displaying client reviews.
                </P>
                
                <P class="portfolioTxt">
                    Let your words travel faster by linking all your social media accounts to
                    retain and grow your audience.
                </P>
            </div>
        </div>

        <!-- features Section -->
        <div class="section scrollspy" id="features">
            <div class="moreThanLandDiv">
                <div class="moreThanLandInnerDiv">
                    <p class="moreThanLandTitle">
                        MORE THAN JUST A LANDING PAGE
                    </p>

                    <p class="moreThanLandTxt"> 
                        White Coat Domain is offering you the opportunity to show your targeted audience who you are and what you can offer. We want to be a
                        part of your success story by bringing your ideas to life with seamless efforts.
                        <br><br>
                        Discover thousands of customized , mobile responsive templates to convert visitors to potential clients.
                    </p>
                </div>
            </div>

            <!-- Live Chat Section -->
            <div class="liveChatMainDiv">
                <div class="row liveChatInnerDiv">
                    <div class="col l6 liveChatImgDiv">
                        <div class="liveChatImgInnerDiv">
                            <img
                                :src="'./media/img/chatimage.png'"
                                alt="chatimage.png"
                                id="chatImage"
                            />
                        </div>
                    </div>

                    <div class="col l6 liveChatWriteUpDiv">
                        <p class="liveChatTitle">LIVE CHAT</p>
                        <p class="liveChatTxt">
                            Creating that outstanding online portfolio may require a support system. For that reason we have our help desk on standby to guide you through as you make those important steps. 
                        </p>
                    </div>
                </div>
            </div>

            <!-- CV Section -->
            <div class="cvMainDiv">
                <div class="row cvInnerDiv">
                    <div class="col l3 offset-l3 cvImgDiv hide-on-large-only">
                        <div class="cvImgInnerDivSm">
                            <img
                                :src="'./media/img/cv.png'"
                                alt="cvFile.png"
                                id="cvImage"
                            />
                        </div>
                    </div>

                    <div class="col l6 cvWriteUpDiv">
                        <p class="cvTitle">CURRICULUM VITAE</p>
                        <p class="cvTxt">
                            Fill in your details and have access to your auto generated curriculum vitae (cv)
                        </p>
                    </div>

                    <div class="col l3 offset-l3 cvImgDiv hide-on-med-and-down">
                        <div class="cvImgInnerDiv">
                            <img
                                :src="'./media/img/cv.png'"
                                alt="cvFile.png"
                                id="cvImage"
                            />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Social Media section -->
            <div class="socialMediaMainDiv">
                <div class="row socialMediaInnerDiv">
                    <div class="col l6 socialMediaImgDiv">
                        <div class="socialMediaImgInnerDiv">
                            <img
                                :src="'./media/img/socialMedia.png'"
                                alt="csocialMediaPhone.png"
                                id="socialMediaImage"
                            />
                            <img
                                :src="'./media/img/facebookImg.png'"
                                alt="facebookImg.png"
                                id="facebookImg"
                            />
                            <img
                                :src="'./media/img/twiterImg.png'"
                                alt="twiterImg.png"
                                id="twiterImg"
                            />
                        </div>
                    </div>

                    <div class="col l6 socialMediaWriteUpDiv">
                        <p class="socialMediaTitle">SOCIAL MEDIA POST</p>
                        <p class="socialMediaTxt">
                            Let your patients  connect with you on social level and see you outside the white coat by linking all your social media platforms.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Client Review Section -->
            <div class="clientRevMainDiv">
                <div class="row clientRevInnerDiv">
                    <div
                        class="
                            col
                            l3
                            offset-l3
                            clientRevImgDiv
                            hide-on-large-only
                        "
                    >
                        <div class="clientRevImgInnerDiv">
                            <img
                                :src="'./media/img/clientRevImg.png'"
                                alt="clientRevImg.png"
                                id="clientRevImage"
                            />
                        </div>
                    </div>

                    <div class="col l6 clientRevWriteUpDiv">
                        <p class="clientRevTitle">CLIENT REVIEW</p>
                        <p class="clientRevTxt">
                            Whether it is a “Thank you note” or Constructive criticism on display to encourage word of mouth marketing for potential patients.  
                        </p>
                    </div>

                    <div
                        class="
                            col
                            l3
                            offset-l3
                            clientRevImgDiv
                            hide-on-med-and-down
                        "
                    >
                        <div class="clientRevImgInnerDiv">
                            <img
                                :src="'./media/img/clientRevImg.png'"
                                alt="clientRevImg.png"
                                id="clientRevImage"
                            />
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
                            We are giving you the freedom to select from our multiple customized 
                            templates designed to meet your personal and professional taste. 
                            Our templates are seamless with drag and drop settings.
                        </p>
                    </div>

                    <div class="col l12 tempRowImgDiv">
                        <img
                            :src="'./media/img/template.png'"
                            alt="tempImg.png"
                            class="responsive-img tempImg"
                        />
                    </div>
                </div>
            </div>
        </div>

        <!-- Customer Support Section -->
        <div class="section scrollspy cusSupportDiv" id="support">
            <div class="row cusSupportInnerDiv">
                <div
                    class="col s12 m12 l7 cusSupportImgDiv hide-on-med-and-down"
                >
                    <img
                        :src="'./media/img/CARE.png'"
                        alt="CARE.png"
                        id="careImg"
                    />
                </div>

                <div class="col s12 m12 l5 cusSupportFormDiv">
                    <p class="cusSupportTitle">WE’RE ALWAYS HAPPY TO HELP</p>

                    <form class="col s12">
                        <div class="row rm_mg">
                            <div class="input-field col s6 rm_mg">
                                <input
                                    placeholder="First name"
                                    id="fName"
                                    type="text"
                                    class="validate"
                                />
                            </div>
                            <div class="input-field col s6 rm_mg">
                                <input
                                    placeholder="Last name "
                                    id="lName"
                                    type="text"
                                    class="validate"
                                />
                            </div>
                        </div>

                        <div class="row rm_mg">
                            <div class="input-field col s12 rm_mg">
                                <input
                                    placeholder="Email address"
                                    id="email"
                                    type="email"
                                    class="validate"
                                />
                            </div>
                        </div>

                        <div class="row rm_mg">
                            <div class="input-field col s12 rm_mg">
                                <textarea
                                    placeholder="Share your thoughts..."
                                    id="textarea1"
                                    class="materialize-textarea"
                                ></textarea>
                            </div>
                        </div>

                        <button
                            type="button"
                            class="btn col s12 m12 l12 rm_mg"
                            id="btnForm"
                        >
                            Send
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <FooterComponent />
    </div>
</template>

<script>
    import FooterComponent from "./partials/FooterComponent.vue";
    import HeaderComponent from "./partials/HeaderComponent.vue";
    export default {
        components: {
            FooterComponent,
            HeaderComponent,
        },
        data() {
            return {};
        },
        mounted() {},
        methods: {},
    };
</script>
<style>
    
</style>