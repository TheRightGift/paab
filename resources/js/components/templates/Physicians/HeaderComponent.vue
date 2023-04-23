<template>
    <div class="">
        <nav>
            <div class="nav-wrapper">
                <div class="headerContainer">
                    <a href="#!" class="brand-logo">{{user == '' ? 'Dr Olivia Felix' : this.userReplaced.replace('DO', 'Dr.').replace('MD', 'Dr.').replace('DD', 'Dr.')}}</a>
                    <a href="#" data-target="mobileNav" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                    <ul class="centerNav hide-on-med-and-down">
                        <li><a href="#!">Interests</a></li>
                        <li><a href="#miniBlog">Mini Blog</a></li>
                        <li><a href="#!">Feeds</a></li>
                        <li><a href="#!">Testimonials</a></li>                        
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
            <li><a href="#!" class="brand-logo">{{user == '' ? 'Dr Olivia Felix' : this.userReplaced.replace('DO', 'Dr.').replace('MD', 'Dr.').replace('DD', 'Dr.')}}</a></li>
            <li><a href="#!">Interests</a></li>
            <li><a href="#miniBlog">Mini Blog</a></li>
            <li><a href="#!">Feeds</a></li>
            <li><a href="#!">Testimonials</a></li>  
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
                    </div>
                </div>
                <div class="row">
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
                        <div class="generalSettings settingOptions hoverable">
                            <h6>CV</h6>
                            <img :src="'/media/img/templates/1/cv.png'" alt="" class="responsive-img"/>
                        </div>
                    </div>
                </div>
            </div>

            <div v-show="modalView == 1">
                <Bio :modalTitle="modalTitle" :modalView="modalView" @backToSettings="backToSettings" :tenant="tenant" :bio="bio" :userID=userID />
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
        </div>
    </div>
</template>
<script>
import ImageCropper from "../../partials/ImageCropper.vue";
import Bio from './Settings/tempSettings/Bio.vue';
import MiniBlogComponent from './Settings/tempSettings/MiniBlogComponent.vue';
import PublicFeature from './Settings/tempSettings/PublicFeature.vue';
import ServicesRendered from './Settings/tempSettings/ServicesRendered.vue';
import SocialMedia from './Settings/tempSettings/SocialMedia.vue';
export default {    
    components: {ImageCropper, MiniBlogComponent, Bio, SocialMedia, PublicFeature, ServicesRendered},
    data() {
        return {
            modalView: 0,
            modalTitle: "General",
            userReplaced: this.user,
            userID: parseInt(this.user_id),
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
        user_id: String,
        interests: Array,
    },
    mounted() {
    },
    methods: {
        showSettingOption(num, title){
            this.modalView = num;
            this.modalTitle = title;
            if (this.modalView === 4) {
                var elems = document.querySelectorAll('.collapsible');
                M.Collapsible.init(elems);
                console.log(elems)
            }
            var textNeedCount = document.querySelectorAll('#input_text, #miniBlogDescription');
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
        updatePhoto(e) {
            this.uploadPhotoProcessing = true;
            let formData = new FormData();
            formData.append("photo", e);
            formData.append("_method", "PUT");
            formData.append("id", this.bioData.id);
            console.log(formData)
            // axios
            // .post("/claim/updateAvatar/bio", formData)
            // .then((res) => {
            //     // console.log(res);
            //     if (res.data.status == 200) {
            //         M.toast({
            //             html: res.data.message,
            //             classes: "successNotifier",
            //         });
            //         localStorage.setItem(
            //             "claimproc",
            //             JSON.stringify([res.data.bio])
            //         );
            //         this.bio = res.data.bio;
            //         this.uploadPhotoProcessing = false;
            //         this.showCropper = false;
            //         this.uploaded = e;
            //         this.bio.photo = {};
            //     }
            // })
            // .catch((err) => {
            //     if (err.response.status == 400) {
            //         err.response.data.forEach((el) => {
            //             M.toast({
            //                 html: el,
            //                 classes: "errorNotifier",
            //             });
            //         });
            //     }
            //     if (err.response.status == 413) {
            //         M.toast({
            //             html: err.response.statusText,
            //             classes: "errorNotifier",
            //         });
            //     }
            //     this.uploadPhotoProcessing = false;
            //     console.log(err);
            // });
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
        }
    },
};
</script>
<style scoped>
    
</style>