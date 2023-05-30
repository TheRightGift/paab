<template>
    <div class="">
        <nav>
            <div class="nav-wrapper">
                <div class="headerContainer">
                    <a href="#templateAbout" class="brand-logo">{{user == '' ? 'Dr '+physicianName : this.userReplaced.replace('DO', 'Dr.').replace('MD', 'Dr.').replace('DD', 'Dr.')}}</a>
                    <a href="#" data-target="mobileNav" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                    <ul class="centerNav hide-on-med-and-down">
                        <li v-if="(services !== null && services.length !== 0 && preview === '0') || preview === '1'"><a href="#templateService">Interests</a></li>
                        <li v-if="(miniBlog !== null && miniBlog.length !== 0 && preview === '0') || preview === '1'"><a href="#miniBlog">Mini Blog</a></li>
                        <li v-if="(feeds !== null && feeds !== '' && preview === '0') || preview === '1'"><a href="#feeds">Feeds</a></li>
                        <li v-if="(reviews !== null && reviewLen !== 0 && preview === '0') || preview === '1'"><a href="#testimonials">Testimonials</a></li>                        
                    </ul>

                    <ul class="right hide-on-med-and-down">
                        <li><a href="#!">Contact</a></li>
                        <li><a href="#!" class="waves-effect waves-light btn subscribeBtn">Subscribe</a></li>
                        <li v-if="isLoggedIn">
                            <a class='modal-trigger physiTempSettingsNavLink' href='#showSettingsModal'>
                                <i class="material-icons physiTempSettingsIcon">settings</i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <ul class="sidenav" id="mobileNav">
            <li><a href="#templateAbout" class="brand-logo">{{user == '' ? 'Dr Olivia Felix' : this.userReplaced.replace('DO', 'Dr.').replace('MD', 'Dr.').replace('DD', 'Dr.')}}</a></li>
            <li v-if="(services !== null && services.length !== 0 && preview === '0') || preview === '1'"><a href="#templateService">Interests</a></li>
            <li v-if="(miniBlog !== null && miniBlog.length !== 0 && preview === '0') || preview === '1'"><a href="#miniBlog">Mini Blog</a></li>
            <li v-if="(feeds !== null && feeds !== '' && preview === '0') || preview === '1'"><a href="#feeds">Feeds</a></li>
            <li v-if="(reviews !== null && reviewLen !== 0 && preview === '0') || preview === '1'"><a href="#testimonials" >Testimonials</a></li>  
            <li><a href="#!">Contact</a></li>
            <li v-if="isLoggedIn">
                <a class='modal-trigger physiTempSettingsNavLink' href='#showSettingsModal'>
                    Settings
                </a>
            </li>
            <li><a href="#!" class="waves-effect waves-light btn subscribeBtn">Subscribe</a></li>
        </ul>
    </div>
    <!-- Modal Structure -->
    <div id="showSettingsModal" class="modal" v-if="preview == '0'">
        <div class="modal-content">
            <div v-if="modalView == 0" class="settingModalViewInitial">
                <div class="row">
                    <div class="col l12 m12 s12">
                        <h3>Settings</h3>
                        <p class="marginTop-1">Update your website by selecting any of the links below</p>
                    </div>
                </div>
                <div class="row hide-on-med-and-down">
                    <div class="col l12 m12 s12">
                        <button class="btn closeSettingModal right modal-close">Close settings</button>
                        <button v-if="!userSubscribed" @click="setModalPayment" href="#paymentModal" id="paymentModalColor" class="modal-trigger btn closeSettingModal right modal-close">Subscribe</button>
                    </div>
                    <div class="col l12 m12 s12">
                        <p v-if="!userSubscribed">Subscribe now to access/make changes to your site now</p>
                    </div>
                </div>
                <div class="row" :class="{disabledNotPaid: !userSubscribed}">
                    <div class="col l4 m6 s6 marginBottom-2">
                        <div class="generalSettings settingOptions hoverable"  @click="showSettingOption(1, 'General')">
                            <h6>General</h6>
                            <img :src="'/media/img/templates/1/general.png'" alt="" class="responsive-img"/>
                        </div>
                    </div>
                    <div class="col l4 m6 s6 marginBottom-2">
                        <div class="generalSettings settingOptions hoverable" @click="showSettingOption(2, 'Mini Blog')">
                            <h6>Mini Blog</h6>
                            <img :src="'/media/img/templates/1/miniBlog.png'" alt="" class="responsive-img"/>
                        </div>
                    </div>
                    <div class="col l4 m6 s6 marginBottom-2">
                        <div class="generalSettings settingOptions hoverable" @click="showSettingOption(3, 'Interests')">
                            <h6>Interests</h6>
                            <img :src="'/media/img/templates/1/interests.png'" alt="" class="responsive-img"/>
                        </div>
                    </div>
                    
                    <div class="col l4 m6 s6 marginBottom-2">
                        <div class="generalSettings settingOptions hoverable" @click="showSettingOption(4, 'Social Feeds')">
                            <h6>Feeds</h6>
                            <img :src="'/media/img/templates/1/feeds.png'" alt="" class="responsive-img"/>
                        </div>
                    </div>
                    <div class="col l4 m6 s6 marginBottom-2">
                        <div class="generalSettings settingOptions hoverable" @click="showSettingOption(5, 'Public Features')">
                            <h6>Features</h6>
                            <img :src="'/media/img/templates/1/publicFeatures.png'" alt="" class="responsive-img"/>
                        </div>
                    </div>
                    <div class="col l4 m6 s6 marginBottom-2">
                        <div class="generalSettings settingOptions hoverable" @click="showSettingOption(6, 'Qualifications')">
                            <h6>Qualifications</h6>
                            <img :src="'/media/img/templates/1/cv.png'" alt="" class="responsive-img"/>
                        </div>
                    </div>
                </div>
            </div>

            <div v-show="modalView == 1">
                <Bio :modalTitle="modalTitle" :modalView="modalView" @backToSettings="backToSettings" :tenant="tenant" :bio="bio" :userID="userID" />
            </div>
            <div v-show="modalView == 2">
                <MiniBlogComponent :modalTitle="modalTitle" :modalView="modalView" @backToSettings="backToSettings" :tenant="tenant" />
            </div>
            <div v-show="modalView == 3">
                <ServicesRendered :services="services" :modalTitle="modalTitle" @backToSettings="backToSettings" :interests="interests" />
            </div>
            <div v-show="modalView == 4">
                <SocialMedia :modalTitle="modalTitle" :modalView="modalView" @backToSettings="backToSettings" />
            </div>
            <div v-show="modalView == 5">
                <PublicFeature :modalTitle="modalTitle" :modalView="modalView" @backToSettings="backToSettings"/>
            </div>
            <div v-show="modalView == 6">
                <!--CVGenerator/-->
            </div>
        </div>
    </div>
    <payment-modal-component 
        :setModal="setModal"
        :tenantID="tenant"
        :email="email"
        :user="parseInt(user_id)"
        @countDown="refreshForChanges($event)"
    />
</template>
<script>
import ImageCropper from "../../partials/ImageCropper.vue";
import Bio from './Settings/tempSettings/Bio.vue';
import MiniBlogComponent from './Settings/tempSettings/MiniBlogComponent.vue';
import PublicFeature from './Settings/tempSettings/PublicFeature.vue';
import ServicesRendered from './Settings/tempSettings/ServicesRendered.vue';
import SocialMedia from './Settings/tempSettings/SocialMedia.vue';
// import CVGenerator from './Settings/tempSettings/CVGenerator.vue';
import PaymentModalComponent from '../../partials/PaymentModalComponent.vue';
export default {    
    components: {ImageCropper, MiniBlogComponent, Bio, SocialMedia, PublicFeature, ServicesRendered, PaymentModalComponent},
    data() {
        return {
            modalView: 0,
            modalTitle: "General",
            userReplaced: this.user,
            userID: parseInt(this.user_id),
            reviewLen: 0,
            setModal: false,
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
        physicianName: String
    },
    mounted() {
    },
    methods: {
        refreshForChanges(evt) {
            location.reload();
        },
        setModalPayment() {
            this.setModal = true;
        },
        showSettingOption(num, title){
            if (this.userSubscribed) {
                this.modalView = num;
                this.modalTitle = title;
                if (this.modalView === 4) {
                    var elems = document.querySelectorAll('.collapsible');
                    M.Collapsible.init(elems);
                }
                var textNeedCount = document.querySelectorAll('#input_text, #miniBlogDescription');
            } else {
                document.getElementByID('paymentModalColor').focus();
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
        
        saveAndBack(num){
            if(num == 1){//save general data

            } else {

            }

            this.modalView = 0;
        }
    },
    computed: {},
    watch: {
        userReplaced (newVal) {
            console.log(newVal, 'here')
            if (newVal != '') {
                this.userReplaced = newVal;
                this.userReplaced.replace('DO', 'Dr.').replace('MD', 'Dr.').replace('DD', 'Dr.')
            }
        },
        reviews(newVal) {
            this.reviewLen = newVal.data.length;
        }
    },
};
</script>
<style scoped>
    #paymentModalColor {
        background-color: rgb(221, 125, 125) !important;
    }
    .disabledNotPaid {
        opacity: 0.4
    }
    .disabledNotPaid {

    }
    @media only screen and (max-width: 992px) {
        .modal {
            width: 90%;
        }
    }
</style>