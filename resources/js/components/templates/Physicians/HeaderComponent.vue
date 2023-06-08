<template>
    <div class="">
        <nav>
            <div class="nav-wrapper">
                <div class="headerContainer">
                    <a href="#templateAbout" class="brand-logo">{{
                        user == ""
                            ? "Dr " + physicianName
                            : this.userReplaced
                                  .replace("DO", "Dr.")
                                  .replace("MD", "Dr.")
                                  .replace("DD", "Dr.")
                    }}</a>
                    <a href="#" data-target="mobileNav" class="sidenav-trigger"
                        ><i class="material-icons">menu</i></a
                    >
                    <ul class="centerNav hide-on-med-and-down">
                        <li
                            v-if="
                                (services !== null &&
                                    services.length !== 0 &&
                                    preview === '0') ||
                                preview === '1'
                            "
                        >
                            <a href="#templateService">Interests</a>
                        </li>
                        <li
                            v-if="
                                (miniBlog !== null &&
                                    miniBlog.length !== 0 &&
                                    preview === '0') ||
                                preview === '1'
                            "
                        >
                            <a href="#miniBlog">Mini Blog</a>
                        </li>
                        <li
                            v-if="
                                (feeds !== null &&
                                    feeds !== '' &&
                                    preview === '0') ||
                                preview === '1'
                            "
                        >
                            <a href="#feeds">Feeds</a>
                        </li>
                        <li
                            v-if="
                                (reviews !== null &&
                                    reviewLen !== 0 &&
                                    preview === '0') ||
                                preview === '1'
                            "
                        >
                            <a href="#testimonials">Testimonials</a>
                        </li>
                    </ul>

                    <ul class="right hide-on-med-and-down">
                        <!-- <li><a href="#!">Contact</a></li> -->
                        <li>
                            <a
                                href="#contact"
                                class="waves-effect waves-light btn subscribeBtn"
                                >Contact</a
                            >
                        </li>
                        <li v-if="isLoggedIn">
                            <a
                                class="modal-trigger physiTempSettingsNavLink"
                                href="#showSettingsModal"
                            >
                                <i class="material-icons physiTempSettingsIcon"
                                    >settings</i
                                >
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <ul class="sidenav" id="mobileNav">
            <li>
                <a href="#templateAbout" class="brand-logo">{{
                    user == ""
                        ? "Dr Olivia Felix"
                        : this.userReplaced
                              .replace("DO", "Dr.")
                              .replace("MD", "Dr.")
                              .replace("DD", "Dr.")
                }}</a>
            </li>
            <li
                v-if="
                    (services !== null &&
                        services.length !== 0 &&
                        preview === '0') ||
                    preview === '1'
                "
            >
                <a href="#templateService">Interests</a>
            </li>
            <li
                v-if="
                    (miniBlog !== null &&
                        miniBlog.length !== 0 &&
                        preview === '0') ||
                    preview === '1'
                "
            >
                <a href="#miniBlog">Mini Blog</a>
            </li>
            <li
                v-if="
                    (feeds !== null && feeds !== '' && preview === '0') ||
                    preview === '1'
                "
            >
                <a href="#feeds">Feeds</a>
            </li>
            <li
                v-if="
                    (reviews !== null && reviewLen !== 0 && preview === '0') ||
                    preview === '1'
                "
            >
                <a href="#testimonials">Testimonials</a>
            </li>
            <li><a href="#contact">Contact</a></li>
            <li v-if="isLoggedIn">
                <a
                    class="modal-trigger physiTempSettingsNavLink"
                    href="#showSettingsModal"
                >
                    Settings
                </a>
            </li>
            <li>
                <a href="#!" class="waves-effect waves-light btn subscribeBtn"
                    >Subscribe</a
                >
            </li>
        </ul>
    </div>
    <!-- Modal Structure -->
    <div id="showSettingsModal" class="modal" v-if="preview == '0'">
        <div class="modal-content">
            <div v-if="modalView == 0" class="settingModalViewInitial">
                <div class="row">
                    <a
                        href="#!"
                        class="modal-close waves-effect waves-green btn-small circularBtn right grey darken-4"
                        ><i class="fa-solid fa-xmark"></i
                    ></a>
                    <div class="col l12 m12 s12">
                        <h3 class="mt-0">Settings</h3>
                        <p class="marginTop-1">
                            Update your website by selecting any of the links
                            below
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col l12 m12 s12">
                        <a
                            href="#"
                            v-if="!userSubscribed && !clickedSub"
                            @click="setModalPayment"
                            class="black-text right"
                        >
                            Subscribe
                    </a>
                    <a href="#" class="black-text right" v-else @click="showSettingOption(7, 'Payments')">Payments</a>
                        <!-- href="#paymentModal" -->
                    </div>
                    <div class="col l12 m12 s12">
                        <p v-if="!userSubscribed && !clickedSub" class="fs-9"><b>
                            Subscribe now to access/make changes to your site
                            now</b>
                        </p>
                    </div>
                </div>
                <div
                    class="row"
                    :class="{ disabledNotPaid: !userSubscribed }"
                    v-if="!clickedSub"
                >
                    <div class="col l4 m6 s6 marginBottom-2">
                        <div
                            class="generalSettings settingOptions hoverable"
                            @click="showSettingOption(1, 'General')"
                        >
                            <h6>General</h6>
                            <img
                                :src="'/media/img/templates/1/general.png'"
                                alt=""
                                class="responsive-img"
                            />
                        </div>
                    </div>
                    <div class="col l4 m6 s6 marginBottom-2">
                        <div
                            class="generalSettings settingOptions hoverable"
                            @click="showSettingOption(2, 'Mini Blog')"
                        >
                            <h6>Mini Blog</h6>
                            <img
                                :src="'/media/img/templates/1/miniBlog.png'"
                                alt=""
                                class="responsive-img"
                            />
                        </div>
                    </div>
                    <div class="col l4 m6 s6 marginBottom-2">
                        <div
                            class="generalSettings settingOptions hoverable"
                            @click="showSettingOption(3, 'Interests')"
                        >
                            <h6>Interests</h6>
                            <img
                                :src="'/media/img/templates/1/interests.png'"
                                alt=""
                                class="responsive-img"
                            />
                        </div>
                    </div>

                    <div class="col l4 m6 s6 marginBottom-2">
                        <div
                            class="generalSettings settingOptions hoverable"
                            @click="showSettingOption(4, 'Social Feeds')"
                        >
                            <h6>Feeds</h6>
                            <img
                                :src="'/media/img/templates/1/feeds.png'"
                                alt=""
                                class="responsive-img"
                            />
                        </div>
                    </div>
                    <div class="col l4 m6 s6 marginBottom-2">
                        <div
                            class="generalSettings settingOptions hoverable"
                            @click="showSettingOption(5, 'Public Features')"
                        >
                            <h6>Features</h6>
                            <img
                                :src="'/media/img/templates/1/publicFeatures.png'"
                                alt=""
                                class="responsive-img"
                            />
                        </div>
                    </div>
                    <div class="col l4 m6 s6 marginBottom-2">
                        <div
                            class="generalSettings settingOptions hoverable"
                            @click="showSettingOption(6, 'Qualifications')"
                        >
                            <h6>CV</h6>
                            <img
                                :src="'/media/img/templates/1/cv.png'"
                                alt=""
                                class="responsive-img"
                            />
                        </div>
                    </div>
                </div>
                <div class="row" v-else>
                    <go-live-component @revertToInit="revertToInit($event)" />
                </div>
            </div>

            <div v-show="modalView == 1">
                <Bio
                    :modalTitle="modalTitle"
                    :modalView="modalView"
                    @backToSettings="backToSettings"
                    :tenant="tenant"
                    :bio="bio"
                    :userID="userID"
                />
            </div>
            <div v-show="modalView == 2">
                <MiniBlogComponent
                    :modalTitle="modalTitle"
                    :modalView="modalView"
                    @backToSettings="backToSettings"
                    :tenant="tenant"
                />
            </div>
            <div v-show="modalView == 3">
                <ServicesRendered
                    :services="services"
                    :modalTitle="modalTitle"
                    @backToSettings="backToSettings"
                    :interests="interests"
                />
            </div>
            <div v-show="modalView == 4">
                <SocialMedia
                    :modalTitle="modalTitle"
                    :modalView="modalView"
                    @backToSettings="backToSettings"
                />
            </div>
            <div v-show="modalView == 5">
                <PublicFeature
                    :modalTitle="modalTitle"
                    :modalView="modalView"
                    @backToSettings="backToSettings"
                />
            </div>
            <div v-show="modalView == 6">
                <CVGenerator
                    :modalTitle="modalTitle"
                    :modalView="modalView"
                    @backToSettings="backToSettings"
                />
            </div>
            <div v-show="modalView == 7">
                <Payments
                    :modalTitle="modalTitle"
                    :modalView="modalView"
                    @backToSettings="backToSettings"
                    :paymentMethods="paymentMethods"
                    :defaultCard="defaultCard"
                    :email="email"
                    :user="parseInt(user_id)"
                />
            </div>
        </div>
    </div>
    <PaymentModalComponent
        :setModal="setModal"
        :user="parseInt(user_id)"
        @countDown="refreshForChanges($event)"
        @popupClose="refreshForChanges($event)"
        :domainName="extractDomain"
        :bio="bio"
        :tenantID="tenant"
        :email="email"
        :userSubscribed="userSubscribed"
        @paymentMethods="getCards($event)"
    />
    <!-- v-if="!userSubscribed" -->
</template>
<script>
    import ImageCropper from "../../partials/ImageCropper.vue";
    import Bio from "./Settings/tempSettings/Bio.vue";
    import MiniBlogComponent from "./Settings/tempSettings/MiniBlogComponent.vue";
    import PublicFeature from "./Settings/tempSettings/PublicFeature.vue";
    import ServicesRendered from "./Settings/tempSettings/ServicesRendered.vue";
    import SocialMedia from "./Settings/tempSettings/SocialMedia.vue";
    import CVGenerator from "./Settings/tempSettings/CVGenerator.vue";
    import Payments from "./Settings/tempSettings/PaymentsComponent.vue";
    import PaymentModalComponent from "../../partials/PaymentModalComponent.vue";
    import GoLiveComponent from "../../partials/GoLiveComponent.vue";
    export default {
        components: {
            CVGenerator,
            Payments,
            ImageCropper,
            MiniBlogComponent,
            Bio,
            SocialMedia,
            PublicFeature,
            ServicesRendered,
            PaymentModalComponent,
            GoLiveComponent,
        },
        data() {
            return {
                modalView: 0,
                modalTitle: "General",
                userReplaced: this.user,
                userID: parseInt(this.user_id),
                reviewLen: 0,
                setModal: false,
                clickedSub: false,
                paymentMethods: [],
                defaultCard: {},
                // user: 0,
            };
        },
        props: {
            user: String,
            isLoggedIn: Boolean,
            preview: String,
            achievement: Object,
            feeds: String,
            services: Array,
            tenant: String,
            bio: Object,
            reviews: Object,
            user_id: String,
            interests: Array,
            miniBlog: Array,
            userSubscribed: Boolean,
            email: String,
            physicianName: String,
        },
        mounted() {},
        methods: {
            getCards(evt) {
                this.paymentMethods = evt.cards;
                this.defaultCard = evt.default;
            },
            refreshForChanges(evt) {
                if (evt == true) {
                    location.reload();
                } else {
                    setTimeout(() => {
                        location.reload();
                    }, 10000);
                }
            },
            revertToInit() {
                this.clickedSub = false;
                this.setModal = true;
            },
            setModalPayment() {
                this.clickedSub = true;
            },
            showSettingOption(num, title) {
                if (this.userSubscribed) {
                    this.modalView = num;
                    this.modalTitle = title;
                    if (this.modalView === 4) {
                        var elems = document.querySelectorAll(".collapsible");
                        M.Collapsible.init(elems);
                    }
                    var textNeedCount = document.querySelectorAll(
                        "#input_text, #miniBlogDescription"
                    );
                } else {
                    document.getElementByID("paymentModalColor").focus();
                }
                M.CharacterCounter.init(textNeedCount);
            },
            showFileChooser() {
                // this.$refs.photo.click();
                this.showCropper = true;
            },
            photoUpload(e) {
                this.updatePhoto(e);
            },
            backToSettings() {
                this.modalView = 0;
            },

            saveAndBack(num) {
                if (num == 1) {
                    //save general data
                } else {
                }

                this.modalView = 0;
            },
        },
        computed: {
            extractDomain() {
                var hostname = window.location.hostname;
                var parts = hostname.split(".");
                var subdomain = parts[0];
                var isSubdomain = parts.length > 2; // Check if there are more than two parts in the hostname
                return subdomain + ".com";
            },
        },
        watch: {
            userReplaced(newVal) {
                console.log(newVal, "here");
                if (newVal != "") {
                    this.userReplaced = newVal;
                    this.userReplaced
                        .replace("DO", "Dr.")
                        .replace("MD", "Dr.")
                        .replace("DD", "Dr.");
                }
            },
            reviews(newVal) {
                this.reviewLen = newVal.data.length;
            },
        },
    };
</script>
<style scoped>
.mt-0 {
    margin-top: 0;
}
.fs-9 {
    font-size: .9rem;
}
.black-text {
    font-size: 1.2rem;
    font-weight: 600;
    text-decoration: underline;
}
    .circularBtn {
        border-radius: 100%;
        height: 30px;
        width: 30px;
        line-height: 20px;
        display: flex;
        text-align: center;
        justify-content: center;
        align-items: center;
    }
    #paymentModalColor {
        background-color: rgb(221, 125, 125) !important;
    }
    .disabledNotPaid {
        opacity: 0.4;
    }
    .disabledNotPaid {
    }
    @media only screen and (max-width: 992px) {
        .modal {
            width: 90%;
        }
    }
</style>