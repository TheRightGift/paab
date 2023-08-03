<template>
    <div>
        <div class="body d-flex flex-col">
            <section class="relative">
                <div class="container">
                    <div class="customNav d-flex justify-between align-center">
                        <div class="logoContainer">
                            <img
                                class="logo"
                                src="/media/img/wcd-logo-noBckg.png"
                                alt="Whitecoatdomain Logo"
                            />
                        </div>
                        <div class="signUpBtnContainer">
                            <sign-up-button-component :goto="'/auth/login'" />
                        </div>
                    </div>
                    <div class="d-flex pt-5 flex-col lg-absolute">
                        <div class="d-flex sm-justify-center">
                            <div class="d-flex align-center">
                                <img src="/media/img/verify.png" />
                                <p class="verifyTitle">
                                    Best Portfolio Platform - World Record
                                </p>
                            </div>
                        </div>
                        <div class="heading relative">
                            <div>
                                <span class="headingText">
                                    Enhance your public image with
                                </span>
                                <span class="headingText">
                                    White Coat Domain
                                </span>
                            </div>
                            <img src="/media/img/decor.png" class="decor" />
                        </div>
                    </div>
                    <div class="relative md-right-style">
                        <div class="relative top-112">
                            <div class="image1Container">
                                <img
                                    src="/media/img/physicianBnW.png"
                                    class="responsive-img image1"
                                />
                            </div>
                            <div class="joiner">
                                <img
                                    src="/media/img/physicianBnWD.png"
                                    class="responsive-img image2"
                                />
                            </div>
                        </div>
                        <div class="spiralGrey">
                            <img src="/media/img/spiralGrey.png" class="responsive-img" />
                        </div>
                        <div class="spiralRed">
                            <img src="/media/img/spiralRed.png" class="responsive-img" />
                        </div>
                        <div class="maskPri">
                            <img src="/media/img/maskPri.png" class="responsive-img" />
                        </div>
                        <div class="maskSec">
                            <img src="/media/img/maskSec.png" class="responsive-img" />
                        </div>
                        <div class="reviewBoxPrev d-flex flex-col algn-center">
                            <div class="reviewBoxPrevHolder">
                                <div class="d-flex justify-between align-center mb-1">
                                    <p class="reviewStarAvg m-0">4.9</p>
                                    <div
                                        class="stars d-flex justify-between align-center"
                                    >
                                        <i
                                            class="fa-solid fa-star star"
                                        ></i>
                                        <i
                                            class="fa-solid fa-star star"
                                        ></i>
                                        <i
                                            class="fa-solid fa-star star"
                                        ></i>
                                        <i
                                            class="fa-solid fa-star star"
                                        ></i>
                                        <i
                                            class="fa-solid fa-star star"
                                        ></i>
                                    </div>
                                </div>
                                <div class="reviewBoxPrevUserImg">
                                    <div
                                        class="d-flex justify-between"
                                    >
                                        <div
                                            class="reviewBoxPrevImgHolder"
                                        >
                                            <img
                                                src="/media/img/comp1.png"
                                                class="responsive-img"
                                            />
                                        </div>
                                        <div
                                            class="reviewBoxPrevImgHolder"
                                        >
                                            <img
                                                src="/media/img/comp2.png"
                                                class="responsive-img"
                                            />
                                        </div>
                                        <div
                                            class="reviewBoxPrevImgHolder"
                                        >
                                            <img
                                                src="/media/img/comp3.png"
                                                class="responsive-img"
                                            />
                                        </div>
                                        <div
                                            class="reviewBoxPrevImgHolder"
                                        >
                                            <img
                                                src="/media/img/comp4.png"
                                                class="responsive-img"
                                            />
                                        </div>
                                        <div
                                            class="reviewBoxPrevImgHolder"
                                        >
                                            <p
                                                class="center countReview"
                                            >
                                                5K
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="relative top-30">
                        <div class="description">
                            As a physician, it is crucial to maintain and
                            manage your public profile. We strongly
                            recommend actively managing your online identity
                            by securing a personal domain name and
                            maintaining a website separate from social
                            media.
                        </div>
                        <div class="d-flex justify-between pt-5">
                            <get-started-button-component :goto="'/auth/login'" />
                            <sign-up-button-component :goto="'/auth/login'" :bg="'transparent'" class="hide-on-med-and-up"/>
                        </div>
                    </div>
                </div>
                <div class="pizzariedLeft"></div>
                <div class="pizzariedRight"></div>
            </section>
            <section class="mb-2 relative">
                <div class="sectionTwoContent d-flex flex-col container">
                    <div class="d-flex align-center flex-col">
                        <p class="heading">
                            <span class="headingText1"
                                >Use White Coat Domain to simplify </span
                            ><span class="headingText2"
                                >building and maintaining layouts</span
                            >
                        </p>
                        <p class="desc hide-on-small-only">
                            <span
                                >You can decide how you are working as a team
                                first and then let the software work around you.
                                The pace of delivery from idea to reality has
                                exploded.</span
                            >
                        </p>
                        <div class="stepContainer relative mt-4">
                            <div class="steps d-flex justify-between">
                                <div class="" style="width: 320px">
                                    <h5 class="mb-2">
                                        Build your own website in a few steps
                                    </h5>
                                    <p class="mb-2">
                                        Start yours today. Less than 30mins,
                                        your site will be live
                                    </p>
                                    <a class="btn waves waves-effect customBtnStarted"
                                        >Get Started</a
                                    >
                                </div>
                                <div class="contents">
                                    <p class="d-flex align-center">
                                        <i class="material-icons pr-1"
                                            >expand_more</i
                                        >
                                        1. Plan your website
                                    </p>
                                    <p class="d-flex align-center">
                                        <i class="material-icons pr-1"
                                            >expand_more</i
                                        >
                                        2. Plan your template
                                    </p>
                                    <p class="d-flex align-center">
                                        <i class="material-icons pr-1"
                                            >expand_more</i
                                        >
                                        3. Customize your website
                                    </p>
                                    <p class="d-flex align-center">
                                        <i class="material-icons pr-1"
                                            >expand_more</i
                                        >
                                        4. Launch your website
                                    </p>
                                </div>
                            </div>
                            <div>
                                <p class="center">
                                    A website Builder with perks
                                </p>
                            </div>
                            <div class="absolute tag hide-on-med-and-down">@whitecoatdomain.com</div>
                            <div class="absolute spiralCRed hide-on-small-only">
                                <img src="/media/img/spiralCRed.svg" />
                            </div>
                            <div class="absolute spiralingGrey hide-on-small-only">
                                <img src="/media/img/spiralingGrey.svg" />
                            </div>
                        </div>
                        <p class="desc show-on-small second">
                            <span
                                >You can decide how you are working as a team
                                first and then let the software work around you.
                                The pace of delivery from idea to reality has
                                exploded.</span
                            >
                        </p>
                    </div>
                </div>
                <div class="pizzariedUpLeft"></div>
                <div class="pizzariedDownRight"></div>
            </section>
            <section class="bgSec relative">
                <h4 class="mt-0 mb-2 hide-on-large-only">
                    Make your portfolio work for you
                </h4>
                <div class="d-flex justify-between sm-block md-flex-col">
                    <div class="templateImgHolder">
                        <img
                            src="/media/img/screenshotTemp.png"
                            alt=""
                            class="responsive-img"
                        />
                    </div>
                    <div class="sectionCont">
                        <!-- style="width: 540px"  -->
                        <h4 class="mt-0 mb-2 show-on-large hide-on-med-and-down">
                            Make your portfolio work for you
                        </h4>
                        <div class="d-flex justify-between">
                            <div class="blueBox yellow lighten-1">
                                <img src="/media/img/amazeTemp.png" />
                            </div>
                            <div class="-mr-6">
                                <h6 class="m-0">Amazing Templates</h6>
                                <p
                                    class="mt-1"
                                >
                                    Choose from our wide range of groundbreaking
                                    templates, designer fonts, and eye-catching
                                    colors that reflect your style and
                                    professional taste.
                                </p>
                            </div>
                        </div>
                        <div class="d-flex justify-between self-center">
                            <div class="blueBox">
                                <img src="/media/img/bestFeat.png" />
                            </div>
                            <div class="-mr-6">
                                <h6 class="m-0">Best Features</h6>
                                <p
                                    class="mt-1"
                                    
                                >
                                Explore our add-ons, whether you want to link your social media platforms, schedule an appointment, or display client reviews.
                                </p>
                            </div>
                        </div>
                        <div class="d-flex justify-between">
                            <div class="blueBox red">
                                <img src="/media/img/taxi.png" />
                            </div>
                            <div class="-mr-6">
                                <h6 class="m-0">Link social media accounts</h6>
                                <p
                                    class="mt-1"
                                    
                                >
                                Boost the reach of your words by linking all of your social media accounts to expand and retain your audience.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="pizzariedLeft"></div>
                    <div class="pizzariedRight"></div>
                </div>
            </section>
            <section class="relative sectionFour">
                <div class="container">
                    <div class="d-flex justify-between sm-block">
                        <div class="w-502">
                            <h4>Design & Build your own landing pages</h4>
                            <p class="text mb-2">
                                Follow this 6 simple steps to create a website today
                            </p>
                            <get-started-button-component :goto="'/auth/login'" class="hide-on-small-only"/>
                        </div>
                        <div class="stepsToStart">
                            <div class="d-flex">
                                <i class="material-icons hide-on-small-only">chevron_right</i>
                                <span>​Sign up for a free website builder.</span>
                            </div>
                            <div class="hide-on-med-and-up sec">
                                <i class="fa-solid fa-arrow-down"></i>
                            </div>
                            <div class="d-flex">
                                <i class="material-icons hide-on-small-only">chevron_right</i>
                                <span>Log into your dashboard.</span>
                            </div>
                            <div class="hide-on-med-and-up sec">
                                <i class="fa-solid fa-arrow-down"></i>
                            </div>
                            <div class="d-flex">
                                <i class="material-icons hide-on-small-only">chevron_right</i>
                                <span>Provide your favorite domain name.</span>
                            </div>
                            <div class="hide-on-med-and-up sec">
                                <i class="fa-solid fa-arrow-down"></i>
                            </div>
                            <div class="d-flex">
                                <i class="material-icons hide-on-small-only">chevron_right</i>
                                <span>Pick a template that suits you</span>
                            </div>
                            <div class="hide-on-med-and-up sec">
                                <i class="fa-solid fa-arrow-down"></i>
                            </div>
                            <div class="d-flex">
                                <i class="material-icons hide-on-small-only">chevron_right</i>
                                <span>Make payment & publish your website.</span>
                            </div>
                            <div class="hide-on-med-and-up sec">
                                <i class="fa-solid fa-arrow-down"></i>
                            </div>
                            <div class="d-flex">
                                <i class="material-icons hide-on-small-only">chevron_right</i>
                                <span>Your website is live in few minutes.</span>
                            </div>
                            <get-started-button-component :goto="'/auth/login'" class="hide-on-med-and-up"/>
                        </div>
                    </div>
                </div>
                <div class="pizzariedUpLeft"></div>
                <div class="pizzariedDownRight"></div>
            </section>
            <section class="relative services">
                <div class="container">
                    <div class="d-flex align-center flex-col">
                        <h6 class="center">Services</h6>
                        <h4>More than just a landing page</h4>
                        <p class="center servTitle mb-4">
                            White Coat Domain is providing you with an
                            opportunity to showcase who you are and what you can
                            offer to your target audience.
                        </p>
                        <div class="row sm-flexed sm-flex-col sm-align-center">
                            <div class="col s12 m6 mb-1" :class="{'l6 d-flex': index === 2 || index === 3, 'l3': index <= 1 || index > 3}" v-for="(service, index) in services" :key="service.title">
                                <services-offered-component :src="service.src" :title="service.title" :description="service.description"/>
                                <img
                                    src="/media/img/serv1Img.png"
                                    v-if="index === 2"
                                    class="responsive-img w-290 hide-on-med-and-down"
                                />
                                <img
                                    src="/media/img/serv2Img.png"
                                    v-if="index === 3"
                                    class="responsive-img w-290 hide-on-med-and-down"
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pizzariedLeft"></div>
                <div class="pizzariedRight"></div>
            </section>
            <section class="relative templateFit">
                <div class="container">
                    <div class="d-flex flex-start md-justify-center">
                        <div class="">
                            <h6>
                                <span class="pri">Templates</span> fit just for
                                you
                            </h6>
                            <p class="desc">
                                White Coat Domain is providing you with an
                                opportunity to showcase who you are and what you
                                can offer to your target audience.
                            </p>
                            <div class="absolute spiralGrey hide-on-small-only">
                                <img src="/media/img/spiralGrey.png" />
                            </div>
                            <div class="absolute spiralRed hide-on-small-only">
                                <img src="/media/img/spiralRed.png" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="d-flex justify-between sm-justify-center">
                        <div class="d-flex flex-col flex-end justify-between">
                            <div class="tempFitRow1 absolute  hide-on-med-and-down">
                                <templates-for-component
                                    :src="'dentist.png'"
                                    :title="'Dentists'"
                                    class="mb-4"
                                />
                                <templates-for-component
                                    :src="'pediatrics.png'"
                                    :title="'Pediatricians'"
                                    class="mb-4"
                                />
                                
                            </div>
                        </div>
                        <div class=" hide-on-med-and-down">
                            <div class="d-flex flex-col" >
                                <div class="tempFitRow2 sm-align-center absolute">
                                    <templates-for-component
                                        :src="'therapist.png'"
                                        :title="'Therapist'"
                                        class="mb-4"
                                    />
                                    <templates-for-component
                                        :src="'psychologists.png'"
                                        :title="'Psychologists'"
                                        class="mb-4 sm-mb-6"
                                    />
                                    <templates-for-component
                                        :src="'opticians.png'"
                                        :title="'Opticians'"
                                        class="mb-4"
                                    />
                                    
                                </div>
                            </div>
                        </div>
                        <div class="hide-on-med-and-down">
                            <div class="d-flex flex-col">
                                <div class="absolute tempFitRow3">
                                    <templates-for-component
                                        :src="'surgeons.png'"
                                        :title="'Surgeons'"
                                        class="mb-4"
                                    />
                                    <templates-for-component
                                        :src="'serv2Img.png'"
                                        :title="'Vetinary'"
                                        class="mb-4"
                                    />
                                    <templates-for-component
                                        :src="'gyna.png'"
                                        :title="'Gynaecologists'"
                                        class="mb-4 sm-mb-6"
                                    />
                                    <templates-for-component
                                        :src="'allergists.png'"
                                        :title="'Opticians'"
                                        class="mb-4"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="row show-on-medium">
                            <div class="col m4">
                                <templates-for-component
                                    :src="'surgeons.png'"
                                    :title="'Surgeons'"
                                    class="mb-4"
                                />
                            </div>
                            <div class="col m4">
                                <templates-for-component
                                    :src="'serv2Img.png'"
                                    :title="'Vetinary'"
                                    class="mb-4"
                                />
                            </div>
                            <div class="col m4">
                                <templates-for-component
                                    :src="'gyna.png'"
                                    :title="'Gynaecology'"
                                    class="mb-4 sm-mb-6"
                                />
                            </div>
                            <div class="col m4">
                                <templates-for-component
                                    :src="'therapist.png'"
                                    :title="'Therapist'"
                                    class="mb-4"
                                />
                            </div>
                            <div class="col m4">
                                <templates-for-component
                                    :src="'psychologists.png'"
                                    :title="'Psychologist'"
                                    class="mb-4"
                                />
                            </div>
                            <div class="col m4">
                                <templates-for-component
                                    :src="'opticians.png'"
                                    :title="'Opticians'"
                                    class="mb-4"
                                />
                            </div>
                            <div class="col m4">
                                <templates-for-component
                                    :src="'dentist.png'"
                                    :title="'Dentists'"
                                    class="mb-4"
                                />
                            </div>
                            <div class="col m4">
                                <templates-for-component
                                    :src="'pediatrics.png'"
                                    :title="'Pediatrics'"
                                    class="mb-4"
                                />
                            </div>
                            <div class="col m4">
                                <templates-for-component
                                    :src="'allergists.png'"
                                    :title="'Allergists/Immunology'"
                                    class="mb-4"
                                />
                            </div>
                            
                            
                        </div>
                        <div class="hide-on-med-and-up">
                            <div class="row sm-align-center d-flex flex-col">
                                <div class="col m4">
                                    <templates-for-component
                                        :src="'surgeons.png'"
                                        :title="'Surgeons'"
                                        class="mb-4"
                                    />
                                </div>
                                <div class="col s12">
                                    <templates-for-component
                                        :src="'pediatrics.png'"
                                        :title="'Pediatrics'"
                                        class="mb-4"
                                    />
                                </div>
                                <div class="col s12">
                                    <templates-for-component
                                        :src="'opticians.png'"
                                        :title="'Opticians'"
                                        class="mb-4"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pizzariedUpLeft hide-on-med-and-up"></div>
                <div class="pizzariedDownRight hide-on-med-and-up"></div>
            </section>
            <!-- <section class="relative reviews">
                <div class="container">
                    <div class="d-flex align-center flex-col pt-5">
                        <h6 class="center">Review</h6>
                        <h5 class="center mb-4">
                            OVER <span>29,345,698</span> CLIENTS AROUND THE
                            WORLD
                        </h5>
                        <div class="mapBg relative">
                            <template v-for="(img, index) in reviews" :key="img">
                                <div
                                    class="image absolute"
                                    @mouseover="showMessage(index)"
                                    @mouseout="hideMessage"
                                >
                                    <img
                                        :src="'/media/img/'+img.img"
                                        class="responsive-img circle"
                                    />
                                    <div
                                        class="chatbox"
                                        v-show="hoveredIndex === index"
                                        :class="{
                                            left: shouldOpenOnLeft(index),
                                        }"
                                    >
                                        <review-popup-component />
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
                <div class="pizzariedUpLeft"></div>
                <div class="pizzariedDownRight"></div>
            </section> -->
            <section class="faqs relative">
                <div class="container">
                    <h5 class="faqsHeading">FAQS</h5>
                    <h6 class="faqsTitle">Most frequent questions from our clients worldwide</h6>
                    <div class="lg-flex">
                        <ul class="collapsible">
                            <li class="active">
                            <div class="collapsible-header">
                                <div class="d-flex align-center m-0"><div class="w-24"><span class="circle"></span></div>What is Whitecoatdomain?</div>
                                
                                <i class="material-icons">chevron_right</i>
                            </div>
                            <div class="collapsible-body">
                                <span>Whitecoatdomain is a physician owned platform for physicians to creat online presence and manage their brand.</span>
                            </div>
                            </li>
                            <li>
                            <div class="collapsible-header">
                                <div class="d-flex align-center m-0"><div class="w-24"><span class="circle"></span></div>How is payment made on the website?</div>
                                <i class="material-icons">chevron_right</i>
                            </div>
                            <div class="collapsible-body">
                                <span>We partner <a href="https://stripe.com/" target="_blank">stripe</a> for all our payment services.</span>
                            </div>
                            </li>
                            <li>
                            <div class="collapsible-header">
                                <div class="d-flex align-center m-0"><div class="w-24"><span class="circle"></span></div>Does whitecoatdomain work worldwide?</div>
                                <i class="material-icons">chevron_right</i>
                            </div>
                            <div class="collapsible-body">
                                <span>Yes.</span>
                            </div>
                            </li>
                            <li>
                            <div class="collapsible-header">
                                <div class="d-flex align-center m-0"><div class="w-24"><span class="circle"></span></div>Is there any setup fee or annual maintainance fee that I need to pay regularly?</div>
                                <i class="material-icons">chevron_right</i>
                            </div>
                            <div class="collapsible-body">
                                <span>Yes, domain purchases has to be renewed yearly, but you can also pay up for 3 years and above.</span>
                            </div>
                            </li>
                            <!-- <li>
                            <div class="collapsible-header">
                                <div class="d-flex align-center m-0"><div class="w-24"><span class="circle"></span></div>Other</div>
                                <i class="material-icons">chevron_right</i>
                            </div>
                            <div class="collapsible-body">
                                <span>Whitecoatdomain is a versatile platform that caters to professionals across various domains, not just limited to the medical field. While the name may suggest a focus on healthcare professionals, the platform aims to bring together individuals from different industries who wear white coats as a symbol of their expertise and professionalism.</span>
                            </div>
                            </li> -->
                        </ul>
                    </div>
                </div>
            </section>
            <section class="getStarted relative">
                <div class="d-flex flex-col justify-center align-center container">
                    <h5 class="mb-2">Create a free account to get started</h5>
                    <get-started-button-component :goto="'/auth/login'" class="mb-2" />
                    <!-- <p>Join our 29,345,698 clients around the world</p> -->
                </div>
            </section>
             <section class="support relative">
                <div class="hide-on-small-only">
                    <div class="d-flex justify-center align-center">
                        <div class="secondary d-flex justify-between md-flex-col">
                            <div class="h-794 md-446">
                                <img
                                    src="/media/img/support.png"
                                    class="responsive-img hide-on-med-only"
                                />
                                <img
                                    src="/media/img/supportFull.png"
                                    class="responsive-img hide-on-large-only"
                                />
                            </div>
                            <div class="h-794">
                                <div class="card">
                                    <div class="card-content">
                                        <p>Contact us</p>
                                        <div class="mb-2 card-title">
                                            We are always happy to help
                                        </div>
                                        <form @submit.prevent="sendToSupport">
                                            <div class="d-flex flex-col gap-10">
                                                <div class="custom-input">
                                                    <input
                                                        type="text"
                                                        required
                                                        class="browser-default"
                                                        v-model="support.names"
                                                        placeholder="Name"
                                                    />
                                                </div>
                                                <div class="custom-input">
                                                    <input
                                                        type="text"
                                                        required
                                                        class="browser-default"
                                                        v-model="support.email"
                                                        placeholder="Email"
                                                    />
                                                </div>
                                                <div class="custom-input">
                                                    <input
                                                        type="text"
                                                        required
                                                        class="browser-default"
                                                        v-model="support.phone"
                                                        placeholder="Phone"
                                                    />
                                                </div>
                                                <div class="custom-input">
                                                    <input
                                                        type="text"
                                                        required
                                                        class="browser-default"
                                                        v-model="support.subject"
                                                        placeholder="Subject"
                                                    />
                                                </div>
                                                <div class="custom-textarea">
                                                    <textarea
                                                        class="textarea browser-default"
                                                        v-model="support.message"
                                                        placeholder="Message"
                                                    ></textarea>
                                                </div>
                                                <get-started-button-component type="submit" v-if="!loading"/>
                                                <button class="btnLoader" v-else><i class="fa-solid fa-circle-notch fa-spin white-text fa-2x"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hide-on-med-and-up">
                    <div class="d-flex flex-col justify-between align-center">
                        <img class="responsive-img mb-2" src="/media/img/supportFull.png" />
                        <div>
                            <h5 class="sm-contact">Contact Us</h5>
                            <p class="title">We are always available to help</p>
                        </div>
                        <form class="d-flex flex-col justify-between align-center" @submit.prevent="sendEmailForCallBack">
                            <div class="custom-input mb-2">
                                <input
                                    type="email"
                                    placeholder="your email address"
                                    class="browser-default"
                                    v-model="support.email"
                                    required
                                />
                            </div>
                            <button
                                class="waves waves-effect custom-btn"
                                type="submit"
                            ><span v-if="!loading">Send</span><i v-else class="fa-solid fa-circle-notch fa-spin"></i></button>
                        </form>
                    </div>
                </div>
            </section>
            <footer-component class="top relative" />
        </div>
    </div>
</template>
<style scoped>
    .custom-btn {
        color: var(--white);
        background: var(--pri);
        width: 210px;
        height: 50px;
        border-radius: 30px;
        border: 2px solid white;
        font-size: 1.25rem;
        font-weight: 500;
    }
    .custom-btn:hover, .custom-btn:visited {
        color: var(--pri);
        background: var(--white);
    }
    .btnLoader {
        background-color: var(--pri);
        box-shadow: 0px 30px 50px rgba(16, 157, 173, 0.15);
        border-radius: 192px;
        border: 2px solid rgb(255, 255, 255);
        width: 12vw;
        height: 6vh;
    }
</style>
<script>
    import SupportComponent from "./partials/SupportPageComponent.vue";
    import FooterComponent from "./partials/FooterComponent.vue";
    import GetStartedButtonComponent from "./partials/GetStartedButtonComponent.vue";
    import SignUpButtonComponent from "./partials/SignUpButtonComponent.vue";
    import ReviewPopupComponent from "./partials/ReviewPopupComponent.vue";
    import ServicesOfferedComponent from "./partials/ServicesOfferedComponent.vue";
    import TemplatesForComponent from "./partials/TemplatesForComponent.vue";
    export default {
        components: {
            SupportComponent,
            FooterComponent,
            GetStartedButtonComponent,
            SignUpButtonComponent,
            ReviewPopupComponent,
            ServicesOfferedComponent,
            TemplatesForComponent,
        },
        data() {
            return {
                hoveredIndex: null,
                templates: [
                    {
                        imgUrl: "templateOne.png",
                    },
                    {
                        imgUrl: "templateTwo.png",
                    },
                    {
                        imgUrl: "templateThree.png",
                    },
                    {
                        imgUrl: "templateTwo.png",
                    },
                    {
                        imgUrl: "templateOne.png",
                    },
                ],
                loading: false,
                support: {
                    names: "",
                    email: "",
                    message: "",
                    phone: "",
                    subject: "",
                },
                services: [
                    {
                        title: 'Live Chat',
                        description: 'Some of our templates come with Live chat. This allows your patients to consult with you in real-time. Using live chat, patients can interact with you quickly.',
                        src: 'chats.png',
                    },
                    {
                        title: 'Curriculum Vitae',
                        description: 'All templates come with a "CV Download" button. This allows your potential patients acquaint themselves with your wealth of training and experience. ',
                        src: 'cv.png',
                    },
                    {
                        title: 'Social Media Post',
                        description: 'Each template provides link to your social media handles or stream your social media. This will help your grow your social media followership.',
                        src: 'socialPost.png',
                    },
                    {
                        title: 'Technical Support',
                        description: 'We understand physicians are too busy to figure things out so we provide extensive tech support. This is in line with our easy-of-use principle.',
                        src: 'livesupport.png',
                    },
                    {
                        title: 'Auto generated',
                        description: 'Some parts of your website template come with an AI powered auto generation to allow for you to come back to it sometime in future; if need be. ',
                        src: 'autogen.png',
                    },
                    {
                        title: 'Client Review',
                        description: 'Patient review provides you with feedback you need to keep your relationship working well. It also helps potential patient make up their minds.',
                        src: 'star.png',
                    }
                ],
                reviews: [
                    {
                        img: 'comp1.png',
                    },
                    {
                        img: 'comp2.png',
                    },
                    {
                        img: 'comp3.png',
                    },
                    {
                        img: 'comp2.png',
                    },
                    {
                        img: 'comp4.png',
                    },
                    {
                        img: 'comp5.png',
                    },
                    {
                        img: 'comp6.png',
                    },
                    {
                        img: 'comp9.png',
                    },
                    {
                        img: 'comp8.png',
                    },
                    {
                        img: 'comp9.png',
                    },
                    {
                        img: 'comp11.png',
                    },

                ]
            };
        },
        mounted() {
        },
        methods: {
            showMessage(index) {
                this.hoveredIndex = index;
                document.querySelectorAll('.image').forEach(el => {
                    el.style.zIndex = '0';
                })
            },
            hideMessage() {
                this.hoveredIndex = null;
                document.querySelectorAll('.image').forEach(el => {
                    el.style.zIndex = '1';
                })
            },
            shouldOpenOnLeft(index) {
                const imageElement = document.querySelector(
                    `.image-wrapper:nth-child(${index + 1}) img`
                );
                if (!imageElement) return false;

                const imageRect = imageElement.getBoundingClientRect();
                // console.log(imageRect.left, imageRect.width, window.innerWidth);
                return imageRect.left + imageRect.width + 200 > window.innerWidth; // Adjust 200 according to your chatbox width
            },
            sendToSupport() {
                this.loading = true;
                let data = {
                    names: this.support.names,
                    message: this.support.message,
                    email: this.support.email,
                    phone: this.support.phone,
                    subject: this.support.subject
                };
                axios.post('/api/support', data).then(res => {
                    if (res.status == 201) {
                        M.toast({html: res.data, classes: 'successNotifier'});
                        this.support.subject = '';
                        this.support.names = '';
                        this.support.email = '';
                        this.support.phone = '';
                        this.support.message = '';
                        this.loading = false;
                    }
                }).catch(err => {
                    console.log(err);
                    this.loading = false;
                })
            },
            sendEmailForCallBack () {
                this.loading = true;
                let data = {
                    email: this.support.email,
                };
                axios.post('/api/supportForCallback', data).then(res => {
                    if (res.status == 201) {
                        M.toast({html: res.data, classes: 'successNotifier'});
                        this.support.email = '';
                        this.loading = false;
                    }
                }).catch(err => {
                    console.log(err);
                    this.loading = false;
                })
            }
        },
    };
</script>