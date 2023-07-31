<template>
    <div>
        <header>
            <nav class="custom-nav flex align-center">
                <div class="container">
                    <a
                        href="#"
                        data-target="mobile-demo"
                        class="sidenav-trigger hide-on-med-and-up"
                        ><svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="55"
                            height="55"
                            viewBox="0 0 55 55"
                            fill="none"
                        >
                            <path
                                d="M8.59375 13.75H46.4062M8.59375 27.5H46.4062M8.59375 41.25H46.4062"
                                stroke="black"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            /></svg
                    ></a>

                    <div
                        class="flex justify-between align-center sm-justify-end"
                    >
                        <div class="flex justify-between align-center">
                            <h5 class="headerTitle hide-on-small-only" v-if="!editing">
                                {{ user == "" ? physicianName : userReplaced }}
                            </h5> 
                            <div class="flex justify-between align-center" v-else>
                                <input type="text" class="custom-edit-field browser-default" v-model="userReplaced" />
                                <div class="ml-3">
                                    <span v-if="editHeaderTitle">
                                        <i class="fa-solid fa-gear primary fs-1 fa-spin"></i>
                                    </span>
                                    <span v-else>
                                        <a href="#!"><i class="fa-regular fa-circle-xmark primary fs-1" @click="edit(0)"></i></a>
                                        <a href="#!" class="pl-3" @click="confirmHeaderEdit"><i class="fa-solid fa-check primary fs-1"></i></a>
                                    </span>
                                </div>
                                
                            </div>
                            <div v-if="isLoggedIn" class="pl-3 hide-on-small-only">
                                <a href="#!" @click="edit(0)"  v-show="!editing">
                                    <i class="fa-solid fa-pen primary fs-1"></i>
                                </a>
                            </div>
                        </div>
                        <ul class="hide-on-small-only">
                            <li>
                                <a href="#aboutMe">About Me</a>
                            </li>
                            <li>
                                <a href="#services">Services</a>
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
                            <li v-if="can === '1'">
                                <a target="_self" :href="'https://whitecoatdomain.com/auth/claim?claimable=' +tenant +'&code=' +code" class="primary">Edit Website</a>
                            </li>
                            <li
                                v-if="isLoggedIn"
                                class="show-on-medium-and-up hide-on-small-only"
                            >
                                <a
                                    class="modal-trigger physiTempSettingsNavLink"
                                    href="#showSettingsModal"
                                >
                                    Edit Website
                                </a>
                            </li>
                        </ul>
                        <ul class="flex">
                            <li>
                                <a class="custom-btn" href="#contact"
                                    >Contact</a
                                >
                            </li>

                           
                        </ul>
                    </div>
                </div>
            </nav>
            <ul class="sidenav" id="mobile-demo">
                <li>
                    <a href="#aboutMe">About Me</a>
                </li>
                <li>
                    <a href="#services">Services</a>
                </li>
                <li>
                    <a
                        href="#miniBlog"
                        v-if="
                            (miniBlog !== null &&
                                miniBlog.length !== 0 &&
                                preview === '0') ||
                            preview === '1'
                        "
                        >Mini Blog</a
                    >
                </li>
                <li v-if="can === '1'">
                    <a target="_self" :href="'https://whitecoatdomain.com/auth/claim?claimable=' +tenant +'&code=' +code" class="primary">Edit Website</a>
                </li>
                <li v-if="isLoggedIn">
                    <a
                        class="modal-trigger physiTempSettingsNavLink"
                        href="#showSettingsModal"
                    >
                        Edit Website
                    </a>
                </li>
                <li>
                    <a href="#contact">Contact</a>
                </li>
                
            </ul>
        </header>
    </div>
    <div id="showSettingsModal" class="modal">
        <div class="modal-content" v-if="isLoggedIn">
            <div v-if="modalView == 0" class="settingModalViewInitial">
                <div class="row">
                    <div class="flex mb-2" :class="{'justify-end': !clickedSub, 'justify-between': clickedSub}">
                        <a href="#!" v-if="userSubscribed || clickedSub" @click="clickedSub = false" class="flex align-center  gap-3 black-text fw-500 fs-125 dec-none">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                                <path d="M25 13.75H9.7875L16.775 6.7625L15 5L5 15L15 25L16.7625 23.2375L9.7875 16.25H25V13.75Z" fill="#404040"/>
                            </svg> <span>Back</span>
                        </a>
                        <a href="#!" class="modal-close waves-effect waves-green ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                                <path d="M23.9325 22.9406C24.0015 23.005 24.057 23.0826 24.0954 23.1689C24.1338 23.2551 24.1545 23.3482 24.1561 23.4426C24.1578 23.5371 24.1404 23.6308 24.1051 23.7184C24.0697 23.8059 24.0171 23.8855 23.9503 23.9522C23.8835 24.019 23.804 24.0716 23.7165 24.107C23.6289 24.1424 23.5351 24.1597 23.4407 24.1581C23.3463 24.1564 23.2532 24.1357 23.167 24.0973C23.0807 24.0589 23.0031 24.0035 22.9387 23.9344L14.9981 15.9949L7.05746 23.9344C6.92417 24.0586 6.74788 24.1262 6.56572 24.123C6.38356 24.1198 6.20977 24.046 6.08094 23.9172C5.95212 23.7883 5.87832 23.6145 5.87511 23.4324C5.8719 23.2502 5.93951 23.0739 6.06371 22.9406L14.0032 15L6.06371 7.05938C5.93951 6.92609 5.8719 6.7498 5.87511 6.56764C5.87832 6.38549 5.95212 6.21169 6.08094 6.08286C6.20977 5.95404 6.38356 5.88025 6.56572 5.87703C6.74788 5.87382 6.92417 5.94143 7.05746 6.06563L14.9981 14.0051L22.9387 6.06563C23.072 5.94143 23.2483 5.87382 23.4305 5.87703C23.6126 5.88025 23.7864 5.95404 23.9152 6.08286C24.0441 6.21169 24.1178 6.38549 24.1211 6.56764C24.1243 6.7498 24.0567 6.92609 23.9325 7.05938L15.993 15L23.9325 22.9406Z" fill="black"/>
                            </svg>
                        </a>
                    </div>
                    <div class="col l12 m12 s12">
                        <h3 class="mt-0 fw-500 fs-175">{{ !userSubscribed && !clickedSub ? 'Settings' : 'Subscribe' }}</h3>
                        <p class="marginTop-1 supportTxt">
                            {{ !userSubscribed && !clickedSub ? 'Update your website by selecting any of the links below' : 'Update your website by selecting any of the Packages below'  }}
                        </p>
                    </div>
                </div>
                <div
                    class="row"
                    :class="{ disabledNotPaid: !userSubscribed }"
                    v-if="!clickedSub"
                >
                    <div class="col l4 m6 s6 marginBottom-2 h-120 mb-2">
                        <div
                            class="generalSettings settingOptions hoverable flex flex-col align-center"
                            @click="showSettingOption(1, 'General')"
                        >
                            <h6>General</h6>
                            <img
                                :src="'/media/img/general.svg'"
                                alt=""
                                class="responsive-img"
                            />
                        </div>
                    </div>
                    <div class="col l4 m6 s6 marginBottom-2 h-120 mb-2">
                        <div
                            class="generalSettings settingOptions hoverable flex flex-col align-center"
                            @click="showSettingOption(2, 'Mini Blog')"
                        >
                            <h6>Mini Blog</h6>
                            <img
                                :src="'/media/img/minBlog.svg'"
                                alt=""
                                class="responsive-img"
                            />
                        </div>
                    </div>
                    <div class="col l4 m6 s6 marginBottom-2 h-120 mb-2">
                        <div
                            class="generalSettings settingOptions hoverable flex flex-col align-center"
                            @click="showSettingOption(3, 'Interests')"
                        >
                            <h6>Interests</h6>
                            <img
                                :src="'/media/img/interest.svg'"
                                alt=""
                                class="responsive-img"
                            />
                        </div>
                    </div>

                    <div class="col l4 m6 s6 marginBottom-2 h-120 mb-2">
                        <div
                            class="generalSettings settingOptions hoverable flex flex-col align-center"
                            @click="showSettingOption(4, 'Social Feeds')"
                        >
                            <h6>Feeds</h6>
                            <img
                                :src="'/media/img/feeds.svg'"
                                alt=""
                                class="responsive-img"
                            />
                        </div>
                    </div>
                    <div class="col l4 m6 s6 marginBottom-2 h-120 mb-2">
                        <div
                            class="generalSettings settingOptions hoverable flex flex-col align-center"
                            @click="showSettingOption(5, 'Public Features')"
                        >
                            <h6>Features</h6>
                            <img
                                :src="'/media/img/features.svg'"
                                alt=""
                                class="responsive-img"
                            />
                        </div>
                    </div>
                    <div class="col l4 m6 s6 marginBottom-2 h-120 mb-2">
                        <div
                            class="generalSettings settingOptions hoverable flex flex-col align-center"
                            @click="showSettingOption(6, 'Qualifications')"
                        >
                            <h6>CV</h6>
                            <img
                                :src="'/media/img/cv.svg'"
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
            <div class="flex justify-center flex-col align-center">
                <div>
                    <a
                        href="#"
                        v-if="!userSubscribed && !clickedSub"
                        @click="setModalPayment"
                        class="black-text btn btn-custom-pay dec-none flex align-center justify-center"
                    >
                        Subscribe
                    </a>
                    <a
                        href="#"
                        class="black-text"
                        v-else
                        @click="showSettingOption(7, 'Payments')"
                        >Payments</a
                    >
                </div>
                
                <p v-if="!userSubscribed && !clickedSub" class="fs-9 supportTxt">
                    <b>
                        Subscribe now to access/make changes to your
                        site</b
                    >
                </p>
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
</template>
<script>
    import Bio from "./Settings/tempSettings/Bio.vue";
    import MiniBlogComponent from "./Settings/tempSettings/MiniBlogComponent.vue";
    import PublicFeature from "./Settings/tempSettings/PublicFeature.vue";
    import ServicesRendered from "./Settings/tempSettings/ServicesRendered.vue";
    import SocialMedia from "./Settings/tempSettings/SocialMedia.vue";
    import CVGenerator from "./Settings/tempSettings/CVGenerator.vue";
    import Payments from "./Settings/tempSettings/PaymentsComponent.vue";
    import PaymentModalComponent from "../../../partials/PaymentModalComponent.vue";
    import GoLiveComponent from "../../../partials/GoLiveComponent.vue";
    export default {
        components: {
            CVGenerator,
            Payments,
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
                editing: false,
                editHeaderTitle: false,
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
            general: Object,
            can: String,
            code: String,
        },
        mounted() {},
        methods: {
            confirmHeaderEdit() {
                this.editHeaderTitle = true;
                axios.post('/api/saveOrUpdateHeaderTitle', {headerTitle:this.userReplaced}).then(res => {
                    if (res.data.status === 'OK') {
                        this.editHeaderTitle = false;
                        this.editing = !this.editing;
                    }
                    console.log(res);
                }).catch(err => {
                    console.log(err);
                })
            },
            edit(num) {
                if (num === 0) {
                    this.editing = !this.editing;
                }
            },
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
                }
            },
            general(newVal) {
                if (newVal) {
                    if (newVal.headerTitle !== null) {
                        this.userReplaced = newVal.headerTitle;
                    }
                }
            },
            reviews(newVal) {
                this.reviewLen = newVal.data.length;
            },
            isLoggedIn(newVal, oldVal) {
                if (newVal === true) {
                    console.log(newVal)
                    var elem = document.querySelectorAll(".modal");
                    var instances = M.Modal.init(elem);
                }
            },
        },
    };
</script>
<style scoped>
    .h-120 {
        height: 120px;
    }
    .mt-0 {
        margin-top: 0;
    }
    .fs-9 {
        font-size: 0.9rem;
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

    @media only screen and (max-width: 992px) {
        .modal {
            width: 90%;
        }
    }
</style>