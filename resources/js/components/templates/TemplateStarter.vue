<template>
    <div>
        <!-- Navbar -->
        <nav class="navbar hide-on-med-and-down">
            <div class="nav-wrapper navbarWrap">
                <a href="#" class="brand-logo" id="physiPortPageLogo">Dr. {{user.firstname}} {{user.lastname}}</a>
                <ul id="nav-mobile" class="section table-of-contents right hide-on-med-and-down">
                    <li>
                        <a href="#services" id="physiTempNavLinks">Services</a>
                    </li>
                    <li><a href="#experience" id="physiTempNavLinks">Experience</a></li>
                    <li><a href="#testimonials" id="physiTempNavLinks">Testimonials</a></li>
                    <li><a href="#feeds" id="physiTempNavLinks">Feeds</a></li>
                    <li><a href="#contact" id="physiTempContactBtn">Contact Me</a></li>
                </ul>
            </div>
        </nav>
        
        <!-- SideNav Section -->
        <!-- <div class="navbar-fixed"> -->
            <nav class="hide-on-large-only white" id="sideNav">
                <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons black-text sideNavIcon"
                        id="sideNavIcon">menu</i></a>
            
                <a href="#" class="" id="physiPortPageLogo">Dr. Akerele Adebayo</a>
            
                <ul id="slide-out" class="sidenav">
                    <!-- <li> -->
                    <div class="user-view">
                        <div class="background" id="sideNavImgDiv">
                            <img src="/media/img/istockphoto-1390124896-170667a.jpg" id="sidNavImg">
                        </div>
                    </div>
                    <!-- </li> -->
            
                    <li class="sideNavLinkMgTp"><a href="#services" id="physiTempNavLinks">Services</a></li>
                    <li><a href="#experience" id="physiTempNavLinks">Experience</a></li>
                    <li><a href="#testimonials" id="physiTempNavLinks">Testimonials</a></li>
                    <li><a href="#" id="physiTempNavLinks">Feeds</a></li>
                    <li>
                        <div class="divider"></div>
                    </li>
                    <li><a href="#contact" id="physiTempContactBtn">Contact Me</a></li>
                </ul>
            </nav>
        <!-- </div> -->
        

        <!-- Services Section -->
        <div class="section scrollspy physiContainerDiv" id="services">
            <div class="row">
                <div class="col s12 m6 l5">
                    <p class="physiTempNameTitle">My name is</p>
                    <p class="physiTempName">Dr. {{user.firstname}} {{user.lastname}}</p>
                    <p class="physiTempTxt">
                        It is a long established fact that a reader will be distracted by the readable content of a page when
                        looking at its
                        layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as
                        opposed to using
                        'Content here, content here', making it look like readable English. Many desktop publishing packages and web
                        page
                        editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many
                        web sites
                        still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on
                        purpose
                        (injected humour and the like).
                    </p>
                    <button class="btn" id="physiTempBtn">
                        Download My curriculum vitae
                    </button>
                </div>

                <div class="col s12 m4 l6 offset-l3">
                    <div class="physiRightImgDiv">
                        <img src="/media/img/doc.png" alt="doc.png" class="responsive-img" id="physiRightImg">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col s12">
                    <p class="servicesMainTitle">Services</p>
                    <p class="servicesWhatIdo">WHAT I DO</p>
                </div>

                <div class="col m4 l4">
                    <div class="servicesIconsDiv">
                        <i class="fa-solid fa-briefcase-medical servicesIcons1"></i>
                    </div>

                    <p class="servicesTitle">Service One</p>

                    <p class="servicesTxt">
                        Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature
                        from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia
                    </p>
                </div>

                <div class="col m4 l4">
                    <div class="servicesIconsDiv">
                        <i class="fa-solid fa-tooth servicesIcons"></i>
                    </div>
                
                    <p class="servicesTitle">Service Two</p>
                
                    <p class="servicesTxt">
                        Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin
                        literature
                        from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in
                        Virginia
                    </p>
                </div>

                <div class="col m4 l4">
                    <div class="servicesIconsDiv">
                        <i class="fa-sharp fa-solid fa-heart-pulse servicesIcons2"></i>
                    </div>
                
                    <p class="servicesTitle">Service Three</p>
                
                    <p class="servicesTxt">
                        Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin
                        literature
                        from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in
                        Virginia
                    </p>
                </div>
            </div>
        </div>

        <!-- Experience Section -->
        <div class="section scrollspy physiExpContainerDiv" id="experience">
            <div class="row">
                <div class="col s12">
                    <p class="expMainTitle">Experience</p>
                    <p class="expMainTxt">MY ACHIEVEMENT</p>
                </div>

                <div class="col s12 m3 l2">
                    <div class="expLeftBarDiv">
                        <div class="expLeftBarInnerDiv">
                            <div class="expLeftBarTxtDiv">
                                <p class="expLeftBarTxt">99.9%</p>
                                <p class="expLeftBarTxt1">Positive feedbacks</p>
                            </div>
                        </div>

                        <div class="expLeftBarInnerDiv">
                            <div class="expLeftBarTxtDiv">
                                <p class="expLeftBarTxt">2,000+</p>
                                <p class="expLeftBarTxt1">Patients Recovered</p>
                            </div>
                        </div>

                        <div class="expLeftBarInnerDiv">
                            <div class="expLeftBarTxtDiv">
                                <p class="expLeftBarTxt">10yrs+</p>
                                <p class="expLeftBarTxt1">Experience</p>
                            </div>
                        </div>

                        <div class="expLeftBarInnerDiv">
                            <div class="expLeftBarTxtDiv">
                                <p class="expLeftBarTxt">15</p>
                                <p class="expLeftBarTxt1">Certifications</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col s12 m9 l10">
                    <img src="/media/img/physicianTemplate.png" 
                        alt="physicianTemplate.png" class="responsive-img" 
                        id="expRightDivImg"
                    >
                </div>
            </div>
        </div>


        <!-- Feeds Section -->
        <div class="section scrollspy feedsContainDiv" id="feeds">
            <div class="row">
                <div class="col s12">
                    <p class="feedsMainTitle">Feeds</p>
                    <p class="feedsMainTxt">UPDATES ON MY SOCIALS</p>
                </div>

                <div class="col s12">
                    <p>
                        <i class="fa-brands fa-twitter" id="feedsTwitterIcon"></i>
                        <span class="feedsTwitterTxt">Twitter Feeds</span>
                    </p>
                </div>

                <div class="col s12 l4">
                    <div class="feedsCard">
                        <div class="row" id="feedsCardRowDiv">
                            <div class="col s2">
                                <div class="feedsProDiv">
                                    <span class="feedsProImg">A</span>
                                </div>
                            </div>

                            <div class="col s9">
                                <p class="feedsCardHeader">Header</p>
                                <p class="feedsCardSubhead">Subhead</p>
                            </div>

                            <div class="col s1">
                                <!-- <i class="fa-solid fa-house-blank"></i> -->
                                <i class="fa-solid fa-house" id="feedsCardIcon"></i>
                                
                            </div>
                        </div>

                        <div class="">
                            <img src="/media/img/feedsCardImg.png" 
                                alt="feedsCardImg.png" class="responsive-img"
                                id="feedsCardImg"
                            >
                        </div>

                        <div>
                            <p class="feedsCardTitle">Title</p>
                            <p class="feedsCardTxt">Subhead</p>
                            <p class="feedsCardTxt1">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                                sed do eiusmod tempor
                            </p>
                        </div>

                        <button class="btn" id="feedsCardBtn">View</button>
                    </div>
                </div>

                <div class="col s12 l4">
                    <div class="feedsCard">
                        <div class="row" id="feedsCardRowDiv">
                            <div class="col s2">
                                <div class="feedsProDiv">
                                    <span class="feedsProImg">A</span>
                                </div>
                            </div>
                
                            <div class="col s9">
                                <p class="feedsCardHeader">Header</p>
                                <p class="feedsCardSubhead">Subhead</p>
                            </div>
                
                            <div class="col s1">
                                <!-- <i class="fa-solid fa-house-blank"></i> -->
                                <i class="fa-solid fa-house" id="feedsCardIcon"></i>
                
                            </div>
                        </div>
                
                        <div class="">
                            <img src="/media/img/feedsCardImg.png" alt="feedsCardImg.png" class="responsive-img" id="feedsCardImg">
                        </div>
                
                        <div>
                            <p class="feedsCardTitle">Title</p>
                            <p class="feedsCardTxt">Subhead</p>
                            <p class="feedsCardTxt1">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                sed do eiusmod tempor
                            </p>
                        </div>
                
                        <button class="btn" id="feedsCardBtn">View</button>
                    </div>
                </div>

                <div class="col s12 l4">
                    <div class="feedsCard">
                        <div class="row" id="feedsCardRowDiv">
                            <div class="col s2">
                                <div class="feedsProDiv">
                                    <span class="feedsProImg">A</span>
                                </div>
                            </div>
                
                            <div class="col s9">
                                <p class="feedsCardHeader">Header</p>
                                <p class="feedsCardSubhead">Subhead</p>
                            </div>
                
                            <div class="col s1">
                                <!-- <i class="fa-solid fa-house-blank"></i> -->
                                <i class="fa-solid fa-house" id="feedsCardIcon"></i>
                
                            </div>
                        </div>
                
                        <div class="">
                            <img src="/media/img/feedsCardImg.png" alt="feedsCardImg.png" class="responsive-img" id="feedsCardImg">
                        </div>
                
                        <div>
                            <p class="feedsCardTitle">Title</p>
                            <p class="feedsCardTxt">Subhead</p>
                            <p class="feedsCardTxt1">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                sed do eiusmod tempor
                            </p>
                        </div>
                
                        <button class="btn" id="feedsCardBtn">View</button>
                    </div>
                </div>

                <div class="col s12">
                    <p class="facebookFeedsIcon">
                        <i class="fa-brands fa-facebook-square" id="feedsFacebookIcon"></i>
                        <span class="feedsTwitterTxt">Facebook Feeds</span>
                    </p>
                </div>

                <div class="col s12 l4">
                    <div class="feedsCard">
                        <div class="row" id="feedsCardRowDiv">
                            <div class="col s2">
                                <div class="feedsProDiv">
                                    <span class="feedsProImg">A</span>
                                </div>
                            </div>
                
                            <div class="col s9">
                                <p class="feedsCardHeader">Header</p>
                                <p class="feedsCardSubhead">Subhead</p>
                            </div>
                
                            <div class="col s1">
                                <!-- <i class="fa-solid fa-house-blank"></i> -->
                                <i class="fa-solid fa-house" id="feedsCardIcon"></i>
                
                            </div>
                        </div>
                
                        <div class="">
                            <img src="/media/img/feedsCardImg.png" alt="feedsCardImg.png" class="responsive-img" id="feedsCardImg">
                        </div>
                
                        <div>
                            <p class="feedsCardTitle">Title</p>
                            <p class="feedsCardTxt">Subhead</p>
                            <p class="feedsCardTxt1">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                sed do eiusmod tempor
                            </p>
                        </div>
                
                        <button class="btn" id="feedsCardBtn">View</button>
                    </div>
                </div>
                
                <div class="col s12 l4">
                    <div class="feedsCard">
                        <div class="row" id="feedsCardRowDiv">
                            <div class="col s2">
                                <div class="feedsProDiv">
                                    <span class="feedsProImg">A</span>
                                </div>
                            </div>
                
                            <div class="col s9">
                                <p class="feedsCardHeader">Header</p>
                                <p class="feedsCardSubhead">Subhead</p>
                            </div>
                
                            <div class="col s1">
                                <!-- <i class="fa-solid fa-house-blank"></i> -->
                                <i class="fa-solid fa-house" id="feedsCardIcon"></i>
                
                            </div>
                        </div>
                
                        <div class="">
                            <img src="/media/img/feedsCardImg.png" alt="feedsCardImg.png" class="responsive-img" id="feedsCardImg">
                        </div>
                
                        <div>
                            <p class="feedsCardTitle">Title</p>
                            <p class="feedsCardTxt">Subhead</p>
                            <p class="feedsCardTxt1">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                sed do eiusmod tempor
                            </p>
                        </div>
                
                        <button class="btn" id="feedsCardBtn">View</button>
                    </div>
                </div>
                
                <div class="col s12 l4">
                    <div class="feedsCard">
                        <div class="row" id="feedsCardRowDiv">
                            <div class="col s2">
                                <div class="feedsProDiv">
                                    <span class="feedsProImg">A</span>
                                </div>
                            </div>
                
                            <div class="col s9">
                                <p class="feedsCardHeader">Header</p>
                                <p class="feedsCardSubhead">Subhead</p>
                            </div>
                
                            <div class="col s1">
                                <!-- <i class="fa-solid fa-house-blank"></i> -->
                                <i class="fa-solid fa-house" id="feedsCardIcon"></i>
                
                            </div>
                        </div>
                
                        <div class="">
                            <img src="/media/img/feedsCardImg.png" alt="feedsCardImg.png" class="responsive-img" id="feedsCardImg">
                        </div>
                
                        <div>
                            <p class="feedsCardTitle">Title</p>
                            <p class="feedsCardTxt">Subhead</p>
                            <p class="feedsCardTxt1">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                sed do eiusmod tempor
                            </p>
                        </div>
                
                        <button class="btn" id="feedsCardBtn">View</button>
                    </div>
                </div>

            </div>
        </div>

        <!-- Testimonials Section -->
        <div class="section scrollspy testiContainDiv" id="testimonials">
            <div class="row">
                <div class="col s12">
                    <p class="feedsMainTitle">Testimonials</p>
                    <p class="feedsMainTxt">WHAT MY CLIENT SAYS</p>
                </div>

                <div class="col s12">
                    <div id="testiMapImg">
                        <div class="row">
                            <!-- Testimonials First Row -->
                            <div class="col s9 m8 l3 offset-l1">
                                <img src="/media/img/testiProImg.png" alt="testiProImg.png" class="responsive-img" id="testiProImg">
                                <div class="testiMapDiv">
                                    <p class="testiMapProName">Mr. Akin Olu</p>
                                    <p class="testiMapTxt">
                                        Contrary to popular belief, Lorem Ipsum is not simply random text. 
                                        It has roots in a piece.
                                    </p>
                                </div>
                            </div>

                            <div class="col s9 l3 offset-s3 offset-m3 offset-l2" id="testiSecondImgRowOneDiv">
                                <img src="/media/img/testiProImg.png" alt="testiProImg.png" class="responsive-img" id="testiProImg">
                                <div class="testiMapDiv">
                                    <p class="testiMapProName">Mr. Akin Olu</p>
                                    <p class="testiMapTxt">
                                        Contrary to popular belief, Lorem Ipsum is not simply random text.
                                        It has roots in a piece.
                                    </p>
                                </div>
                            </div>

                            <!-- Testimonials Second Row -->
                            <div class="col s9 m8 l3 offset-l2">
                                <img src="/media/img/testiProImg.png" alt="testiProImg.png" class="responsive-img" id="testiProImg">
                                <div class="testiMapDiv">
                                    <p class="testiMapProName">Mr. Akin Olu</p>
                                    <p class="testiMapTxt">
                                        Contrary to popular belief, Lorem Ipsum is not simply random text.
                                        It has roots in a piece.
                                    </p>
                                </div>
                            </div>
                            
                            <div class="col s9 m9 l3 offset-s3 offset-m3 offset-l2" id="testiSecondImgRowTwoDiv">
                                <img src="/media/img/testiProImg.png" alt="testiProImg.png" class="responsive-img" id="testiProImg">
                                <div class="testiMapDiv">
                                    <p class="testiMapProName">Mr. Akin Olu</p>
                                    <p class="testiMapTxt">
                                        Contrary to popular belief, Lorem Ipsum is not simply random text.
                                        It has roots in a piece.
                                    </p>
                                </div>
                            </div>

                            <!-- Testimonials Third Row -->
                            <div class="col s9 m9 l3 offset-s2 offset-m2 offset-l4" id="testiSecondImgRowThreeDiv">
                                <img src="/media/img/testiProImg.png" alt="testiProImg.png" class="responsive-img" id="testiProImg">
                                <div class="testiMapDiv">
                                    <p class="testiMapProName">Mr. Akin Olu</p>
                                    <p class="testiMapTxt">
                                        Contrary to popular belief, Lorem Ipsum is not simply random text.
                                        It has roots in a piece.
                                    </p>
                                </div>
                            </div>

                        </div>
                        
                    </div>
                </div>  
                
            </div>
        </div>


        <!-- Contact Me Section -->
        <div class="section scrollspy contactContainDiv" id="contact">
            <div class="row">
                <div class="col s12" id="testiContactFormTitleDiv">
                    <p class="feedsMainTitle">Contact Me</p>
                    <p class="feedsMainTxt">SCHEDULE AN APPOINTMENT</p>
                </div>

                <div class="input-field col s12 m6 l6">
                    <input placeholder="Last Name" id="testiLname" type="text" class="validate">
                </div>

                <div class="input-field col s12 m6 l6">
                    <input placeholder="First Name" id="testiFname" type="text" class="validate">
                </div>

                <div class="input-field col s12 m6 l6">
                    <input placeholder="Email" id="testiEmail" type="text" class="validate">
                </div>
                
                <div class="input-field col s12 m6 l6">
                    <input placeholder="Phone Number" id="testiPhone" type="text" class="validate">
                </div>

                <div class="input-field col s12">
                    <textarea id="testiTextarea1" class="materialize-textarea" placeholder="State your reasons"></textarea>
                </div>

                <button type="button" class="col s12 btn" id="testiContactBtn">
                    SEND
                    <i class="material-icons" id="testiContactBtnIcon">send</i>
                </button>
            </div>
        </div>

        <div id="tempPubExtDiv">
            <div>
                <a href="#" id="tempPublishBtn">Publish</a>
            </div>
            <br>
            <div>
                <a href="#!" id="tempExitBtn" @click="viewTemplate">Exit Website</a>
            </div>
        </div>

    </div>
</template>
<script>
export default {
    data() {
        return {
            
        }
    },
    props: {
        user: Object
    },
    methods: {
        viewTemplate () {
            this.$emit('viewTemplate');
        }
    },
}
</script>