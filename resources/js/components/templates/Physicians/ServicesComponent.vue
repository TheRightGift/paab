<template>
    <div class="row">
        <div class="col s12 rm_mg_pd">
            <div class="section scrollspy physiContainerDiv" id="services">
                <div v-if="bio == null">
                    <div class="row rm_mg_pd">
                        <div class="col s12 m6 l6">
                            <div class="containerDiv">
                                <h3 class="physiTempName">
                                    Hi, I’m
                                    <br />
                                    Dr Chidinma Felix
                                    <span class="primaryColorBoxDesign"></span>
                                </h3>

                                <p class="physiSummaryTxt">
                                    Sed porttitor lectus nibh. Proin eget tortor
                                    risus. Curabitur aliquet quam id dui posuere
                                    blandit. Vestibulum ante ipsum primis in
                                    faucibus orci luctus et ultrices posuere
                                    cubilia Curae; Donec velit neque, auctor sit
                                    amet aliquam vel, ullamcorper sit amet
                                    ligula. Cras ultricies ligula sed magna
                                    dictum porta. Quisque velit nisi, pretium ut
                                    lacinia in, elementum id enim. Mauris
                                    blandit aliquet elit, eget tincidunt nibh
                                    pulvinar a. Pellentesque in ipsum id orci
                                    porta dapibus. Nulla porttitor accumsan
                                    tincidunt. Curabitur arcu erat, accumsan id
                                    imperdiet et, porttitor at sem. Praesent
                                    sapien massa, convallis a
                                </p>

                                <a href="#" class="physiTempBtn">
                                    Download My curriculum vitae
                                </a>
                            </div>
                        </div>

                        <div class="col s12 m6 l6 rm_mg_pd">
                            <!-- offset-l3 media/img/doc.png-->
                            <div class="profileImg" v-if="preview == '0'">
                                <img
                                    :src="
                                        location + 'media/img/surgeonhero.png'
                                    "
                                    alt="doc.png"
                                    class="responsive-img physiRightImg"
                                />
                            </div>
                            <div class="profileImg" v-else>
                                <img
                                    src="/media/img/surgeonhero.png"
                                    alt="doc.png"
                                    class="responsive-img physiRightImg"
                                />
                            </div>
                        </div>
                    </div>

                    <div class="row whatIdoTxtRowDiv">
                        <div class="col s12">
                            <p class="servicesMainTitle">Services</p>
                            <p class="servicesWhatIdo">WHAT I DO</p>
                            <h3 class="title">
                                WHAT I DO
                                <span class="primaryColorBoxDesign1"></span>
                            </h3>
                        </div>

                        <div class="col m4 l4 s12">
                            <h5 class="servcesHeading forSurgeon">
                                <span class="whatIdoServiceTitleNum">01.</span>
                                Service
                            </h5>
                            <div class="servicesIconsDiv">
                                <i
                                    class="
                                        fa-solid fa-briefcase-medical
                                        servicesIcons1
                                    "
                                ></i>
                            </div>

                            <p class="servcesHeading forDoc">Service One</p>

                            <p class="servicesTxt">
                                Contrary to popular belief, Lorem Ipsum is not
                                simply random text. It has roots in a piece of
                                classical Latin literature from 45 BC, making it
                                over 2000 years old. Richard McClintock, a Latin
                                professor at Hampden-Sydney College in Virginia
                            </p>
                        </div>

                        <div class="col m4 l4 s12">
                            <h5 class="servcesHeading forSurgeon">
                                <span class="whatIdoServiceTitleNum">02.</span>
                                Service
                            </h5>
                            <div class="servicesIconsDiv">
                                <i class="fa-solid fa-tooth servicesIcons"></i>
                            </div>

                            <p class="servcesHeading forDoc">Service Two</p>

                            <p class="servicesTxt">
                                Contrary to popular belief, Lorem Ipsum is not
                                simply random text. It has roots in a piece of
                                classical Latin literature from 45 BC, making it
                                over 2000 years old. Richard McClintock, a Latin
                                professor at Hampden-Sydney College in Virginia
                            </p>
                        </div>

                        <div class="col m4 l4 s12">
                            <h5 class="servcesHeading forSurgeon">
                                <span class="whatIdoServiceTitleNum">03.</span>
                                Service
                            </h5>
                            <div class="servicesIconsDiv">
                                <i
                                    class="
                                        fa-sharp fa-solid fa-heart-pulse
                                        servicesIcons2
                                    "
                                ></i>
                            </div>

                            <p class="servcesHeading forDoc">Service Three</p>

                            <p class="servicesTxt">
                                Contrary to popular belief, Lorem Ipsum is not
                                simply random text. It has roots in a piece of
                                classical Latin literature from 45 BC, making it
                                over 2000 years old. Richard McClintock, a Latin
                                professor at Hampden-Sydney College in Virginia
                            </p>
                        </div>
                    </div>
                </div>
                <div v-else>
                    <div class="row rm_mg_pd">
                        <div class="col s12 m6 l6">
                            <div class="containerDiv">
                                <h3 class="physiTempName">
                                    Hi, I’m
                                    <br />
                                    {{ title }} {{ bio.firstname }}
                                    {{ bio.lastname }}
                                    <span class="primaryColorBoxDesign"></span>
                                </h3>

                                <p class="physiSummaryTxt">
                                    {{ bio.about }}
                                </p>

                                <a class="physiTempBtn" :href="location + 'tenancy/assets/' + bio.CV">
                                    Download My curriculum vitae
                                </a>
                            </div>
                        </div>

                        <div class="col s12 m6 l6 rm_mg_pd">
                            <!-- offset-l3 media/img/doc.png-->
                            <div class="profileImg" v-if="preview == '0'">
                                <img
                                    :src="
                                        location + 'tenancy/assets/' + bio.photo
                                    "
                                    alt="doc.png"
                                    class="responsive-img"
                                    id="physiRightImg"
                                />

                            </div>
                        </div>
                    </div>

                    <div class="row whatIdoTxtRowDiv">
                        <div class="col s12">
                            <p class="servicesMainTitle">Services</p>
                            <p class="servicesWhatIdo">WHAT I DO</p>
                            <h3 class="title">
                                WHAT I DO
                                <span class="primaryColorBoxDesign1"></span>
                            </h3>
                        </div>
                        <div
                            :class="{ flexed: services.length <= 2 }"
                            class="row"
                        >
                            <div
                                class="col m4 l4 m-0"
                                v-for="(service, index) in services"
                                :key="service.id"
                            >
                                <h5 class="servcesHeading forSurgeon">
                                    <span class="whatIdoServiceTitleNum">0{{index}}.</span>
                                    {{ service.title }}
                                </h5>
                                <div class="servicesIconsDiv">
                                    <i
                                        class="
                                            fa-solid fa-briefcase-medical
                                            servicesIcons1
                                        "
                                        :class="service.icon"
                                    ></i>
                                </div>
                                <p class="servcesHeading forDoc">{{ service.title }}</p>
                                <p class="servicesTxt">
                                    {{ service.description }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            user: String,
            bio: Object,
            services: Array,
            location: String,
            preview: String,
            title: String,
        },
    };
</script>
<style>
    #physiRightImg {
        width: 428px;
        height: 497px;
    }
</style>
<style scoped>
    @media only screen and (min-width: 1200px) {
        .flexed {
            display: flex;
            justify-content: center;
        }
        .ml-0,
        .row .col.m4 {
            margin-left: 0 !important;
        }
    }
    @media only screen and (min-width: 993px) {
        .flexed {
            display: flex;
            justify-content: center;
        }
        .ml-0,
        .row .col.m4 {
            margin-left: 0 !important;
        }
    }
</style>