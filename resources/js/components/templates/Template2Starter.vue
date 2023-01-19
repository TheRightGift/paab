<template>
    <div>
        <!-- Navbar -->
        <div class="navbar-fixed">
            <nav>
                <div class="nav-wrapper navContainer">
                    <a href="#!" class="brand-logo">Dr. Akerele Adebayo</a>
                    <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons sidenavListIcon">menu</i></a>
                    <ul class="right hide-on-med-and-down section table-of-contents">
                        <li><a href="#services" class="navbarLink">Services</a></li>
                        <li><a href="#experience" class="navbarLink">Experience</a></li>
                        <li><a href="#testimonials" class="navbarLink">Testimonials</a></li>
                        <li><a href="#feedsSection" class="navbarLink">Feeds</a></li>
                        <li><a href="#contact" class="contactNavLink">Contact Me</a></li>
                    </ul>
                </div>
            </nav>
        </div>
        
        <!-- Mobile Navbar Page Links -->
        <ul class="sidenav" id="mobile-demo">
            <li><a href="#services" class="navbarLink">Services</a></li>
            <li><a href="#experience" class="navbarLink">Experience</a></li>
            <li><a href="#testimonials" class="navbarLink">Testimonials</a></li>
            <li><a href="#feeds" class="navbarLink">Feeds</a></li>
            <li><a href="#contact" class="navbarLink">Contact Me</a></li>
        </ul>

        <!-- Load More Modal Structure -->
        <div id="loadMoreReviews" class="modal">
            <div class="testimonialReviewDiv">
                <div class="testimonialReviewInnerDiv">
                    <i class="material-icons modal-close reviewsModalClose">arrow_back</i>
        
                    <p class="reviewsTitle">Reviews</p>
                </div>
                <div>
                    <div class="row">
                        <!-- Testimonials First Row -->
                        <div class="col s12">
                            <p class="reviewsTime right">Now</p>
                        </div>
        
                        <div class="col s12 m4 l4">
                            <div class="reviewsProImgDiv">
                                <img src="/media/img/testiProImg.png" alt="testiProImg.png" class="responsive-img reviewsProImg">
                            </div>
                            <div class="reviewWriteupBoxDiv">
                                <p class="reviewProName">Mr. Akin Olu</p>
                                <p class="reviewTxt">
                                    Contrary to popular belief, Lorem Ipsum is not simply random text.
                                    It has roots in a piece.
                                </p>
                            </div>
                        </div>
        
                        <div class="col s12 m4 l4">
                            <div class="reviewsProImgDiv">
                                <img src="/media/img/testiProImg.png" alt="testiProImg.png" class="responsive-img reviewsProImg">
                            </div>
                            <div class="reviewWriteupBoxDiv">
                                <p class="reviewProName">Mr. Akin Olu</p>
                                <p class="reviewTxt">
                                    Contrary to popular belief, Lorem Ipsum is not simply random text.
                                    It has roots in a piece.
                                </p>
                            </div>
                        </div>
        
                        <div class="col s12 m4 l4">
                            <div class="reviewsProImgDiv">
                                <img src="/media/img/testiProImg.png" alt="testiProImg.png" class="responsive-img reviewsProImg">
                            </div>
                            <div class="reviewWriteupBoxDiv">
                                <p class="reviewProName">Mr. Akin Olu</p>
                                <p class="reviewTxt">
                                    Contrary to popular belief, Lorem Ipsum is not simply random text.
                                    It has roots in a piece.
                                </p>
                            </div>
                        </div>
        
                        <!-- Testimonials Second Row -->
                        <div class="col s12">
                            <p class="reviewsTime right">1 day ago</p>
                        </div>
        
                        <div class="col s12 m4 l4">
                            <div class="reviewsProImgDiv">
                                <img src="/media/img/testiProImg.png" alt="testiProImg.png" class="responsive-img reviewsProImg">
                            </div>
                            <div class="reviewWriteupBoxDiv">
                                <p class="reviewProName">Mr. Akin Olu</p>
                                <p class="reviewTxt">
                                    Contrary to popular belief, Lorem Ipsum is not simply random text.
                                    It has roots in a piece.
                                </p>
                            </div>
                        </div>
        
                        <div class="col s12 m4 l4">
                            <div class="reviewsProImgDiv">
                                <img src="/media/img/testiProImg.png" alt="testiProImg.png" class="responsive-img reviewsProImg">
                            </div>
                            <div class="reviewWriteupBoxDiv">
                                <p class="reviewProName">Mr. Akin Olu</p>
                                <p class="reviewTxt">
                                    Contrary to popular belief, Lorem Ipsum is not simply random text.
                                    It has roots in a piece.
                                </p>
                            </div>
                        </div>
        
                        <div class="col s12 m4 l4">
                            <div class="reviewsProImgDiv">
                                <img src="/media/img/testiProImg.png" alt="testiProImg.png" class="responsive-img reviewsProImg">
                            </div>
                            <div class="reviewWriteupBoxDiv">
                                <p class="reviewProName">Mr. Akin Olu</p>
                                <p class="reviewTxt">
                                    Contrary to popular belief, Lorem Ipsum is not simply random text.
                                    It has roots in a piece.
                                </p>
                            </div>
                        </div>
        
                        <!-- Testimonials Third Row -->
                        <div class="col s12">
                            <p class="reviewsTime right">3 days ago</p>
                        </div>
        
                        <div class="col s12 m4 l4">
                            <div class="reviewsProImgDiv">
                                <img src="/media/img/testiProImg.png" alt="testiProImg.png" class="responsive-img reviewsProImg">
                            </div>
                            <div class="reviewWriteupBoxDiv">
                                <p class="reviewProName">Mr. Akin Olu</p>
                                <p class="reviewTxt">
                                    Contrary to popular belief, Lorem Ipsum is not simply random text.
                                    It has roots in a piece.
                                </p>
                            </div>
                        </div>
        
                        <div class="col s12 m4 l4">
                            <div class="reviewsProImgDiv">
                                <img src="/media/img/testiProImg.png" alt="testiProImg.png" class="responsive-img reviewsProImg">
                            </div>
                            <div class="reviewWriteupBoxDiv">
                                <p class="reviewProName">Mr. Akin Olu</p>
                                <p class="reviewTxt">
                                    Contrary to popular belief, Lorem Ipsum is not simply random text.
                                    It has roots in a piece.
                                </p>
                            </div>
                        </div>
        
                        <div class="col s12 m4 l4">
                            <div class="reviewsProImgDiv">
                                <img src="/media/img/testiProImg.png" alt="testiProImg.png" class="responsive-img reviewsProImg">
                            </div>
                            <div class="reviewWriteupBoxDiv">
                                <p class="reviewProName">Mr. Akin Olu</p>
                                <p class="reviewTxt">
                                    Contrary to popular belief, Lorem Ipsum is not simply random text.
                                    It has roots in a piece.
                                </p>
                            </div>
                        </div>
        
                        <!-- Testimonials Forth Row -->
                        <div class="col s12">
                            <p class="reviewsTime right">1 week ago</p>
                        </div>
        
                        <div class="col s12 m4 l4">
                            <div class="reviewsProImgDiv">
                                <img src="/media/img/testiProImg.png" alt="testiProImg.png" class="responsive-img reviewsProImg">
                            </div>
                            <div class="reviewWriteupBoxDiv">
                                <p class="reviewProName">Mr. Akin Olu</p>
                                <p class="reviewTxt">
                                    Contrary to popular belief, Lorem Ipsum is not simply random text.
                                    It has roots in a piece.
                                </p>
                            </div>
                        </div>
        
                        <div class="col s12 m4 l4">
                            <div class="reviewsProImgDiv">
                                <img src="/media/img/testiProImg.png" alt="testiProImg.png" class="responsive-img reviewsProImg">
                            </div>
                            <div class="reviewWriteupBoxDiv">
                                <p class="reviewProName">Mr. Akin Olu</p>
                                <p class="reviewTxt">
                                    Contrary to popular belief, Lorem Ipsum is not simply random text.
                                    It has roots in a piece.
                                </p>
                            </div>
                        </div>
        
                        <div class="col s12 m4 l4">
                            <div class="reviewsProImgDiv">
                                <img src="/media/img/testiProImg.png" alt="testiProImg.png" class="responsive-img reviewsProImg">
                            </div>
                            <div class="reviewWriteupBoxDiv">
                                <p class="reviewProName">Mr. Akin Olu</p>
                                <p class="reviewTxt">
                                    Contrary to popular belief, Lorem Ipsum is not simply random text.
                                    It has roots in a piece.
                                </p>
                            </div>
                        </div>
        
                        <!-- Testimonials Fift Row -->
                        <div class="col s12">
                            <p class="reviewsTime right">1 month ago</p>
                        </div>
        
                        <div class="col s12 m4 l4">
                            <div class="reviewsProImgDiv">
                                <img src="/media/img/testiProImg.png" alt="testiProImg.png" class="responsive-img reviewsProImg">
                            </div>
                            <div class="reviewWriteupBoxDiv">
                                <p class="reviewProName">Mr. Akin Olu</p>
                                <p class="reviewTxt">
                                    Contrary to popular belief, Lorem Ipsum is not simply random text.
                                    It has roots in a piece.
                                </p>
                            </div>
                        </div>
        
                        <div class="col s12 m4 l4">
                            <div class="reviewsProImgDiv">
                                <img src="/media/img/testiProImg.png" alt="testiProImg.png" class="responsive-img reviewsProImg">
                            </div>
                            <div class="reviewWriteupBoxDiv">
                                <p class="reviewProName">Mr. Akin Olu</p>
                                <p class="reviewTxt">
                                    Contrary to popular belief, Lorem Ipsum is not simply random text.
                                    It has roots in a piece.
                                </p>
                            </div>
                        </div>
        
                        <div class="col s12 m4 l4">
                            <div class="reviewsProImgDiv">
                                <img src="/media/img/testiProImg.png" alt="testiProImg.png" class="responsive-img reviewsProImg">
                            </div>
                            <div class="reviewWriteupBoxDiv">
                                <p class="reviewProName">Mr. Akin Olu</p>
                                <p class="reviewTxt">
                                    Contrary to popular belief, Lorem Ipsum is not simply random text.
                                    It has roots in a piece.
                                </p>
                            </div>
                        </div>
        
                        <div class="col s12">
                            <a href="#" class="reviewLoadMoreLink">Load more</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Structure -->
        <div id="addReviewModal" class="modal">
            <div class="modal-content">
                <div>
                    <i class="material-icons modal-close reviewsModalClose">arrow_back</i>
                </div>
            
                <div class="addReviewFormContainDiv">
                    <form>
                        <div class="addReviewProMainDiv">
                            <div class="addReviewProDiv">
                                <i class="material-icons addReviewProImg">person</i>
                            </div>
                    
                            <div class="reviewProEditIconDiv">
                                <i class="material-icons setProEditIcon">edit</i>
                            </div>
                        </div>
                    
                        <div class="row rm_mg">
                            <div class="row rm_mg">
                                <div class="input-field col s12 m5 rm_mg sm_mg">
                                    <input placeholder="Last Name" type="text" class="validate addReviewInput">
                                </div>
                    
                                <div class="input-field col s12 m5 l5 offset-m1 offset-l1 rm_mg sm_mg">
                                    <input placeholder="First Name" type="text" class="validate addReviewInput">
                                </div>
                            </div>
                    
                            <div class="row rm_mg">
                                <div class="input-field col s12 rm_mg sm_mg">
                                    <textarea class="addReviewTextarea" placeholder="Write a review"></textarea>
                                </div>
                            </div>
                    
                            <button type="button" class="btn col s2 offset-s9 rm_mg sm_mg addReviewBtn">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

<!-- ssss -->
        <div class="row">
            <div class="col s12 rm_mg_pd">
                <!-- Services -->
                <div id="services" class="section scrollspy">
                    <div class="row rm_mg_pd">
                        <div class="col s12 m6 l6">
                            <div class="surgeonHeroWriteUPsDiv">
                                <h3 class="surgeonHeroClientName">
                                    Hi, I’m
                                    <br>
                                    Dr Chidinma Felix
                                    <span class="primaryColorBoxDesign"></span>
                                </h3>
                                
                                <p class="surgeonHeroClientTxts">
                                    It is a long established fact that a reader will be distracted by the readable content of a page when looking at its
                                    layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using
                                    'Content here, content here', making it look like readable English. Many desktop publishing packages and web page
                                    editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover
                                </p>
                                
                                <a href="#" class="surgeonHeroCvDownloadBtn">
                                    Download My curriculum vitae
                                </a>
                            </div>
                        </div>

                        <div class="col s12 m6 l6 surgeonHeroImgDiv">
                            <img src="/media/img/surgeonhero.png" alt="surgeonhero.png" class="surgeonImg right">
                        </div>
                    </div>

                    <!-- What I Do -->
                    <div class="row whatIdoTxtRowDiv">
                        <div class="col s12">
                            <h3 class="title">
                                WHAT I DO
                                <span class="primaryColorBoxDesign1"></span>
                            </h3>
                        </div>
                        <div class="col s12 m4 l4">
                            <h5 class="whatIdoServiceTitle">
                                <span class="whatIdoServiceTitleNum">01.</span>
                                Service
                            </h5>
                            <p class="whatIdoServiceTxt">
                                Contrary to popular belief, Lorem Ipsum is not simply random text. 
                                It has roots in a piece of classical Latin literature
                                from 45 BC, making it over 2000 years old. Richard McClintock, 
                                a Latin professor at Hampden-Sydney College in Virginia
                            </p>
                        </div>
                        <div class="col s12 m4 l4">
                            <h5 class="whatIdoServiceTitle">
                                <span class="whatIdoServiceTitleNum">02.</span>
                                Service
                            </h5>
                            <p class="whatIdoServiceTxt">
                                Contrary to popular belief, Lorem Ipsum is not simply random text.
                                It has roots in a piece of classical Latin literature
                                from 45 BC, making it over 2000 years old. Richard McClintock,
                                a Latin professor at Hampden-Sydney College in Virginia
                            </p>
                        </div>
                        <div class="col s12 m4 l4">
                            <h5 class="whatIdoServiceTitle">
                                <span class="whatIdoServiceTitleNum">03.</span>
                                Service
                            </h5>
                            <p class="whatIdoServiceTxt">
                                Contrary to popular belief, Lorem Ipsum is not simply random text.
                                It has roots in a piece of classical Latin literature
                                from 45 BC, making it over 2000 years old. Richard McClintock,
                                a Latin professor at Hampden-Sydney College in Virginia
                            </p>
                        </div>
                    </div>
                </div>
        
                <!-- Experience Section -->
                <div id="experience" class="section scrollspy">
                    <h3 class="title">
                        MY EXPERIENCE
                        <span class="primaryColorBoxDesign2"></span>
                    </h3>

                    <div class="experienceImgContainDiv">
                        <div class="surgeonBannerImgDiv">
                            <img src="/media/img/surgeonbanner.png" alt="surgeonbanner.png" class="surgeonBannerImg">
                        </div>

                        <div class="experienceAchieveDiv">
                            <div class="experienceAchieveInnerDiv">
                                <p class="experienceAchieveTitle">10yrs+</p>
                                <p class="experienceAchieveTxt">Experience</p>
                            </div>
                            <div class="experienceAchieveInnerDiv">
                                <p class="experienceAchieveTitle">2,000+</p>
                                <p class="experienceAchieveTxt">Ward Rounds</p>
                            </div>
                            <div class="experienceAchieveInnerDiv">
                                <p class="experienceAchieveTitle">10yrs+</p>
                                <p class="experienceAchieveTxt">Volunteer/Outreach</p>
                            </div>
                            <div>
                                <p class="experienceAchieveTitle">15</p>
                                <p class="experienceAchieveTxt">Certifications</p>
                            </div>
                        </div>
                    </div>  
                </div>
        
                <!-- Feed Section -->
                <div id="feedsSection" class="section scrollspy">
                    <h3 class="title">
                        MY FEEDS
                        <span class="primaryColorBoxDesign3"></span>
                    </h3>

                    <div class="feedsCardContainDiv">
                        <div class="row">
                            <!-- First Row -->
                            <div class="col s12 m6 l4">
                                <div class="feedsCard">
                                    <div class="row feedsCardRowDiv">
                                        <div class="col s2">
                                            <div class="feedsProDiv">
                                                <span class="feedsProSymbol">A</span>
                                            </div>
                                        </div>
                        
                                        <div class="col s9">
                                            <p class="feedsCardHeader">Header</p>
                                            <p class="feedsCardSubhead">Subhead</p>
                                        </div>
                        
                                        <div class="col s1">
                                            <i class="fa-solid fa-house feedsCardIcon"></i>
                        
                                        </div>
                                    </div>
                        
                                    <div class="">
                                        <img src="/media/img/feedsCardImg.png" alt="feedsCardImg.png" class="responsive-img feedsCardImg">
                                    </div>
                        
                                    <div>
                                        <p class="feedsCardTitle">Title</p>
                                        <p class="feedsCardTxt">Subhead</p>
                                        <div class="feedsCardTxt1Div">
                                            <p class="feedsCardTxt1">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                                sed do eiusmod tempor
                                            </p>
                                        </div>
                                    </div>
                        
                                    <a href="#" class="feedsCardBtn btn">View</a>
                                </div>
                            </div>
                            <div class="col s12 m6 l4">
                                <div class="feedsCard">
                                    <div class="row feedsCardRowDiv">
                                        <div class="col s2">
                                            <div class="feedsProDiv">
                                                <span class="feedsProSymbol">A</span>
                                            </div>
                                        </div>
                            
                                        <div class="col s9">
                                            <p class="feedsCardHeader">Header</p>
                                            <p class="feedsCardSubhead">Subhead</p>
                                        </div>
                            
                                        <div class="col s1">
                                            <i class="fa-solid fa-house feedsCardIcon"></i>
                            
                                        </div>
                                    </div>
                            
                                    <div class="">
                                        <img src="/media/img/feedsCardImg.png" alt="feedsCardImg.png" class="responsive-img feedsCardImg">
                                    </div>
                            
                                    <div>
                                        <p class="feedsCardTitle">Title</p>
                                        <p class="feedsCardTxt">Subhead</p>
                                        <div class="feedsCardTxt1Div">
                                            <p class="feedsCardTxt1">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                                sed do eiusmod tempor
                                            </p>
                                        </div>
                                    </div>
                            
                                    <a href="#" class="feedsCardBtn btn">View</a>
                                </div>
                            </div>
                            <div class="col s12 m6 l4">
                                <div class="feedsCard">
                                    <div class="row feedsCardRowDiv">
                                        <div class="col s2">
                                            <div class="feedsProDiv">
                                                <span class="feedsProSymbol">A</span>
                                            </div>
                                        </div>
                            
                                        <div class="col s9">
                                            <p class="feedsCardHeader">Header</p>
                                            <p class="feedsCardSubhead">Subhead</p>
                                        </div>
                            
                                        <div class="col s1">
                                            <i class="fa-solid fa-house feedsCardIcon"></i>
                            
                                        </div>
                                    </div>
                            
                                    <div class="">
                                        <img src="/media/img/feedsCardImg.png" alt="feedsCardImg.png" class="responsive-img feedsCardImg">
                                    </div>
                            
                                    <div>
                                        <p class="feedsCardTitle">Title</p>
                                        <p class="feedsCardTxt">Subhead</p>
                                        <div class="feedsCardTxt1Div">
                                            <p class="feedsCardTxt1">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                                sed do eiusmod tempor
                                            </p>
                                        </div>
                                    </div>
                            
                                    <a href="#" class="feedsCardBtn btn">View</a>
                                </div>
                            </div>

                            <!-- Second Row -->
                            <div class="col s12 m6 l4">
                                <div class="feedsCard">
                                    <div class="row feedsCardRowDiv">
                                        <div class="col s2">
                                            <div class="feedsProDiv">
                                                <span class="feedsProSymbol">A</span>
                                            </div>
                                        </div>
                            
                                        <div class="col s9">
                                            <p class="feedsCardHeader">Header</p>
                                            <p class="feedsCardSubhead">Subhead</p>
                                        </div>
                            
                                        <div class="col s1">
                                            <i class="fa-solid fa-house feedsCardIcon"></i>
                            
                                        </div>
                                    </div>
                            
                                    <div class="">
                                        <img src="/media/img/feedsCardImg.png" alt="feedsCardImg.png" class="responsive-img feedsCardImg">
                                    </div>
                            
                                    <div>
                                        <p class="feedsCardTitle">Title</p>
                                        <p class="feedsCardTxt">Subhead</p>
                                        <div class="feedsCardTxt1Div">
                                            <p class="feedsCardTxt1">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                                sed do eiusmod tempor
                                            </p>
                                        </div>
                                    </div>
                            
                                    <a href="#" class="feedsCardBtn btn">View</a>
                                </div>
                            </div>
                            <div class="col s12 m6 l4">
                                <div class="feedsCard">
                                    <div class="row feedsCardRowDiv">
                                        <div class="col s2">
                                            <div class="feedsProDiv">
                                                <span class="feedsProSymbol">A</span>
                                            </div>
                                        </div>
                            
                                        <div class="col s9">
                                            <p class="feedsCardHeader">Header</p>
                                            <p class="feedsCardSubhead">Subhead</p>
                                        </div>
                            
                                        <div class="col s1">
                                            <i class="fa-solid fa-house feedsCardIcon"></i>
                            
                                        </div>
                                    </div>
                            
                                    <div class="">
                                        <img src="/media/img/feedsCardImg.png" alt="feedsCardImg.png" class="responsive-img feedsCardImg">
                                    </div>
                            
                                    <div>
                                        <p class="feedsCardTitle">Title</p>
                                        <p class="feedsCardTxt">Subhead</p>
                                        <div class="feedsCardTxt1Div">
                                            <p class="feedsCardTxt1">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                                sed do eiusmod tempor
                                            </p>
                                        </div>
                                    </div>
                            
                                    <a href="#" class="feedsCardBtn btn">View</a>
                                </div>
                            </div>
                            <div class="col s12 m6 l4">
                                <div class="feedsCard">
                                    <div class="row feedsCardRowDiv">
                                        <div class="col s2">
                                            <div class="feedsProDiv">
                                                <span class="feedsProSymbol">A</span>
                                            </div>
                                        </div>
                            
                                        <div class="col s9">
                                            <p class="feedsCardHeader">Header</p>
                                            <p class="feedsCardSubhead">Subhead</p>
                                        </div>
                            
                                        <div class="col s1">
                                            <i class="fa-solid fa-house feedsCardIcon"></i>
                            
                                        </div>
                                    </div>
                            
                                    <div class="">
                                        <img src="/media/img/feedsCardImg.png" alt="feedsCardImg.png" class="responsive-img feedsCardImg">
                                    </div>
                            
                                    <div>
                                        <p class="feedsCardTitle">Title</p>
                                        <p class="feedsCardTxt">Subhead</p>
                                        <div class="feedsCardTxt1Div">
                                            <p class="feedsCardTxt1">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                                sed do eiusmod tempor
                                            </p>
                                        </div>
                                    </div>
                            
                                    <a href="#" class="feedsCardBtn btn">View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>

                <!-- Testimonials -->
                <div id="testimonials" class="section scrollspy">
                    <h3 class="title">
                        TESTIMONIALS
                        <span class="primaryColorBoxDesign4"></span>
                    </h3>

                    <div class="testimonialsMainDiv">
                        <div class="row">
                            <div class="col s12 m5 l5">
                                <div class="testimonialsProImgdiv">
                                    <div class="row ">
                                        <div class="col s2">
                                            <img src="/media/img/testiProImg.png" alt="testiProImg.png" class="testiProImg">
                                        </div>
                                        <div class="col s10">
                                            <div class="testimonialsProDiv">
                                                <p class="testimonialsProName">Akerele A.</p>
                                                <p class="testimonialsProTitle">Software Engineer</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="testimonialsProImgdiv1">
                                    <div class="row ">
                                        <div class="col s2">
                                            <img src="/media/img/testiProImg.png" alt="testiProImg.png" class="testiProImg">
                                        </div>
                                        <div class="col s10">
                                            <div class="testimonialsProDiv">
                                                <p class="testimonialsProName">Akerele A.</p>
                                                <p class="testimonialsProTitle">Software Engineer</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="testimonialsProImgdiv1">
                                    <div class="row ">
                                        <div class="col s2">
                                            <img src="/media/img/testiProImg.png" alt="testiProImg.png" class="testiProImg">
                                        </div>
                                        <div class="col s10">
                                            <div class="testimonialsProDiv">
                                                <p class="testimonialsProName">Akerele A.</p>
                                                <p class="testimonialsProTitle">Software Engineer</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="col s12 m7 l7">
                                <p class="testimonialsWriteupTitle">It was a great experience</p>
                                <div class="testimonialsWriteupReviewDiv">
                                    <i class="material-icons reviewIcon">star</i>
                                    <i class="material-icons reviewIcon">star</i>
                                    <i class="material-icons reviewIcon">star</i>
                                    <i class="material-icons reviewIcon">star</i>
                                    
                                    <!-- Add Review Modal Trigger -->
                                    <a href="#addReviewModal" class="modal-trigger">
                                        <i class="material-icons addreview right" title="Add Review">add_circle</i>
                                    </a>
                                </div>
                                <p class="tesimonialsWriteupTxt">
                                    It is a long established fact that a reader will be distracted by 
                                    the readable content of a page when looking at its layout. 
                                    The point of using Lorem Ipsum is that it has a more-or-less 
                                    normal distribution of letters, as opposed to using 
                                    'Content here, content here', making it look like readable English. 
                                    desktop publishing packages and web page editors now use Lorem Ipsum 
                                    as their default model text, and a search for 'lorem ipsum' will uncover
                                </p>
                                <p class="tesimonialsWriteupTxt">
                                    It is a long established fact that a reader will be distracted by 
                                    the readable content of a page when looking at its layout. 
                                    The point of using Lorem Ipsum is
                                </p>
                                <!-- Load More Modal Trigger -->
                                <a href="#loadMoreReviews" class="modal-trigger loadMoreReviews">Load More</a>
                            </div>
                        </div>
                    </div>
                    
                </div>

                <!-- Contact Section -->
                <div id="contact" class="section scrollspy">
                    <h3 class="title">
                        CONTACT ME
                        <span class="primaryColorBoxDesign5"></span>
                    </h3>

                    <div class="contactMainDiv">
                        <div class="row ">
                            <div class="col s12 m5 l5">
                                <div class="row">
                                    <div class="col s2">
                                        <div class="contactIconDiv">
                                            <i class="material-icons contactIcon">contact_mail</i>
                                        </div>
                                    </div>
                                    <div class="col s10">
                                        <p class="contactMeTitle">Chat with me</p>
                                        <p class="contactMeTxt">drakerele@gmail.com</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s2">
                                        <div class="contactIconDiv">
                                            <i class="material-icons contactIcon">location_on</i>
                                        </div>
                                    </div>
                                    <div class="col s10">
                                        <p class="contactMeTitle">Visit me</p>
                                        <p class="contactMeTxt">Lekki phase 1, Lagos Nigeria</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s2">
                                        <div class="contactIconDiv">
                                            <i class="material-icons contactIcon">perm_phone_msg</i>
                                        </div>
                                    </div>
                                    <div class="col s10">
                                        <p class="contactMeTitle">Call me</p>
                                        <p class="contactMeTxt">08000000333</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m7 l7">
                                <div class="formContainDiv">
                                    <p class="contactFormTitle">
                                        Free Consultation for a first time client
                                    </p>
                                    <form> 
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <input type="text" placeholder="First name" class="validate contactFormInput">
                                            </div>

                                            <div class="input-field col s12">
                                                <input type="text" placeholder="Last name" class="validate contactFormInput">
                                            </div>

                                            <div class="input-field col s12">
                                                <input type="email" placeholder="Email" class="validate contactFormInput">
                                            </div>

                                            <div class="input-field col s12">
                                                <input type="text" placeholder="Phone digit" class="validate contactFormInput">
                                            </div>

                                            <div class="input-field col s12">
                                                <input type="text" placeholder="State your reason" class="validate contactFormInput">
                                            </div>

                                            <button type="button" class="contactFormBtn btn right">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <InnerFooterComponent />
    </div>
</template>
<script>
import InnerFooterComponent from '../partials/InnerFooterComponent.vue';
export default {
    components: {
        InnerFooterComponent,
    },
    data() {
        return { };
    },
    mounted() {},
    methods: {},
};
</script>