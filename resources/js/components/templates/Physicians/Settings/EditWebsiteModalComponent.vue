<template>
    <div>
        <!-- Edit Website Modal Div -->
        <div class="container">
            <p id="editWebWlcTxt">Setup your website</p>

            <!-- Modal Header -->
            <div class="editWebNav">
                <div class="editInnerWebNav">
                    <ul id="editWebUl">
                        <li class="editWebLi">
                            <a href="#" class="editWebLink" @click="genLink()">
                                <span class="editBtnLinkNum" :class="[isActive ? 'black' : '']" id="genLink">1</span>
                                General
                            </a>
                        </li>
                        <li class="editWebLi">
                            <a href="#" class="editWebLink" @click="bioLink()">
                                <span class="editBtnLinkNum" id="bioLink">2</span>
                                Bio
                            </a>
                        </li>
                        <li class="editWebLi">
                            <a href="#" class="editWebLink" @click="servicesLink()">
                                <span class="editBtnLinkNum" id="servicesLink">3</span>
                                Services
                            </a>
                        </li>
                        <li class="editWebLi">
                            <a href="#" class="editWebLink" @click="achieveLink()">
                                <span class="editBtnLinkNum" id="achieveLink">4</span>
                                Achievement
                            </a>
                        </li>
                        <li class="editWebLi">
                            <a href="#" class="editWebLink" @click="socialLink()">
                                <span class="editBtnLinkNum" id="socialLink">5</span>
                                Socials
                            </a>
                        </li>
                        <li class="editWebLi">
                            <a href="#" class="editWebLink" @click="contactLink()">
                                <span class="editBtnLinkNum" id="contactLink">6</span>
                                Contacts
                            </a>
                        </li>
                       
                    </ul>
                </div>
            </div>

            <!-- Modal Body -->
            <!-- General Modal -->
            <div class="editGenModal" v-if="!genModal">
                <div class="editInnerGenModal">
                    <div class="genTitleDiv">
                        <i class="material-icons" id="genTitleCheck" v-if="general.title !== '' ">check</i>
                        <p class="genTitle">Title</p>
                        <i class="material-icons" id="genTitleCheck" v-if="general.favicon != null">check</i>
                        <p class="genTitle">Favicon</p>
                    </div>

                    <div>
                        <p class="genTitle1">Put in your title details</p>
                    
                        <p class="genTxt">
                            Lorem Ipsum is simply dummy text of the
                            printing and typesetting industry.
                        </p>
                    
                        <div class="input-field">
                            <input type="text" placeholder="JohnDoe" id="genInput" v-model="general.title">
                        </div>

                        <!-- <div>
                            <button type="button" class="btn" id="genModalBtn">
                                save
                            </button>
                        </div> -->

                        <div class="genBottomBtnDiv">
                            <a href="/client/websites" class="goBackBtn">GO BACK</a>

                            <button type="button" class="btn right" id="genNextBtn" @click="genNextBtn()">
                                NEXT STEP
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- General Modal 1-->
            <div class="editGenModal" v-if="!genModal1">
                <div class="editInnerGenModal">
                    <div class="genTitleDiv">
                        <i class="material-icons" id="genTitleCheck" v-if="general.title !== '' ">check</i>
                        <p class="genTitle">Title</p>
                        
                        <i class="material-icons" id="genTitleCheck" v-if="general.favicon != null">check</i>
                        <p class="genTitle">Favicon</p>
                    </div>
            
                    <div>
                        <p class="genTitle1">Upload a favicon</p>
            
                        <p class="genTxt">
                            Lorem Ipsum is simply dummy text of the
                            printing and typesetting industry.
                        </p>
            
                        <div class="file-field input-field" id="genUploadFavIconDiv">
                            <input type="file" @change="favUpload" accept="image/*">
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" id="genInput1">
                                <i class="material-icons" id="genUploadFavIcon">file_upload</i>
                            </div>
                        </div>
        
                        <div>
                            <button type="button" class="btn" id="genModalBtn" @click.prevent="generalSave">
                                Save
                            </button>
                        </div>
            
                        <div class="genBottomBtnDiv">
                            <a href="#" class="goBackBtn" @click="genGoBackBtn()">GO BACK</a>
            
                            <!-- <button type="button" class="btn right" id="genNextBtn" @click="genNextBtn1()">
                                NEXT STEP
                            </button> -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bio Modal -->
            <div class="bioModalDiv" v-if="!bioModal">
                <div class="editInnerGenModal">
                    <div class="genTitleDiv">
                        <i class="material-icons" id="genTitleCheck" v-if="bio.firstname != ''">check</i>
                        <p class="genTitle">Full Name</p>
            
                        <i class="material-icons" id="genTitleCheck1" v-if="bio.about != ''">check</i>
                        <p class="genTitle">Description</p>

                        <i class="material-icons" id="genTitleCheck2" v-if="bio.photo != null">check</i>
                        <p class="genTitle">Upload Photo</p>

                        <i class="material-icons" id="genTitleCheck3" v-if="bio.CV != null">check</i>
                        <p class="genTitle">Upload Curriculum</p>
                    </div>
                
                    <div>
                        <p class="genTitle1">Provide your full name</p>
                
                        <p class="genTxt">
                            Lorem Ipsum is simply dummy text of the
                            printing and typesetting industry.
                        </p>
                
                        
                        <div class="input-field">
                            <input type="text" v-model="bio.lastname" placeholder="Last Name" id="bioInput">
                        </div>

                        <div class="input-field">
                            <input type="text" v-model="bio.firstname" placeholder="First Name" id="bioInput1">
                        </div>
            
                        <!-- <div>
                            <button type="button" class="btn" id="genModalBtn">
                                save
                            </button>
                        </div> -->
                
                        <div class="genBottomBtnDiv">
                            <a href="#" class="goBackBtn" @click="bioGoBackBtn()">GO BACK</a>
                
                            <button type="button" class="btn right" id="genNextBtn" @click="bioNextBtn()">
                                NEXT STEP
                            </button>
                        </div>
                    </div>
                </div>
            
            </div>

            <!-- Bio Modal 1 -->
            <div class="bioModalDiv" v-if="!bioModal1">
                <div class="editInnerGenModal">
                    <div class="genTitleDiv">
                        <i class="material-icons" id="genTitleCheck" v-if="bio.firstname != ''">check</i>
                        <p class="genTitle">Full Name</p>
            
                        <i class="material-icons" id="genTitleCheck1" v-if="bio.about != ''">check</i>
                        <p class="genTitle">Description</p>

                        <i class="material-icons" id="genTitleCheck2" v-if="bio.photo != null">check</i>
                        <p class="genTitle">Upload Photo</p>

                        <i class="material-icons" id="genTitleCheck3" v-if="bio.CV != null">check</i>
                        <p class="genTitle">Upload Curriculum</p>
                    </div>
            
                    <div>
                        <p class="genTitle1">About You</p>
            
                        <p class="genTxt">
                            Readers only looks at vital info about you, so make it catchy. Not more than (614) characters.
                        </p>
                            
                        <div class="input-field">
                            <textarea v-model="bio.about" id="bioDescribeInput" class="materialize-textarea" placeholder="Me" maxlength="614"></textarea>
                        </div>
        
                        <!-- <div>
                            <button type="button" class="btn" id="genModalBtn">
                                save
                            </button>
                        </div> -->
            
                        <div class="genBottomBtnDiv">
                            <a href="#" class="goBackBtn" @click="bioGoBackBtn1()">GO BACK</a>
            
                            <button type="button" class="btn right" id="genNextBtn" @click="bioNextBtn1()">
                                NEXT STEP
                            </button>
                        </div>
                    </div>
                </div>
            
            </div>

            <!-- Bio Modal 2 -->
            <div class="bioModalDiv" v-if="!bioModal2">
                <div class="editInnerGenModal">
                    <div class="genTitleDiv">
                        <i class="material-icons" id="genTitleCheck" v-if="bio.firstname != ''">check</i>
                        <p class="genTitle">Full Name</p>
            
                        <i class="material-icons" id="genTitleCheck1" v-if="bio.about != ''">check</i>
                        <p class="genTitle">Description</p>

                        <i class="material-icons" id="genTitleCheck2" v-if="bio.photo != null">check</i>
                        <p class="genTitle">Upload Photo</p>

                        <i class="material-icons" id="genTitleCheck3" v-if="bio.CV != null">check</i>
                        <p class="genTitle">Upload Curriculum</p>
                    </div>
            
                    <div>
                        <p class="genTitle1">Upload a clear picture of you</p>
            
                        <p class="genTxt">
                            Lorem Ipsum is simply dummy text of the
                            printing and typesetting industry.
                        </p>
        
                            <div class="file-field input-field" id="genUploadFavIconDiv">
                                <input type="file" @change="photoUpload" accept="image/*">
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text" id="genInput1">
                                    <i class="material-icons" id="genUploadFavIcon">file_upload</i>
                                </div>
                            </div>
                        
                            <!-- <div>
                                <button type="button" class="btn" id="genModalBtn">
                                    Upload
                                </button>
                            </div> -->
            
                        <div class="genBottomBtnDiv">
                            <a href="#" class="goBackBtn" @click="bioGoBackBtn2()">GO BACK</a>
            
                            <button type="button" class="btn right" id="genNextBtn" @click="bioNextBtn2()">
                                NEXT STEP
                            </button>
                        </div>
                    </div>
                </div>
            
            </div>

            <!-- Bio Modal 3 -->
            <div class="bioModalDiv" v-if="!bioModal3">
                <div class="editInnerGenModal">
                    <div class="genTitleDiv">
                        <i class="material-icons" id="genTitleCheck" v-if="bio.firstname != ''">check</i>
                        <p class="genTitle">Full Name</p>
            
                        <i class="material-icons" id="genTitleCheck1" v-if="bio.about != ''">check</i>
                        <p class="genTitle">Description</p>

                        <i class="material-icons" id="genTitleCheck2" v-if="bio.photo != null">check</i>
                        <p class="genTitle">Upload Photo</p>

                        <i class="material-icons" id="genTitleCheck3" v-if="bio.CV != null">check</i>
                        <p class="genTitle">Upload Curriculum</p>
                    </div>
            
                    <div>
                        <p class="genTitle1">Upload your curriculum Vitae</p>
            
                        <p class="genTxt">
                            Lorem Ipsum is simply dummy text of the
                            printing and typesetting industry.
                        </p>
            
                        <div class="file-field input-field" id="genUploadFavIconDiv">
                            <input type="file" @change="CVUpload"  accept="application/msword, application/vnd.ms-powerpoint,application/pdf," >
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" id="genInput1">
                                <i class="material-icons" id="genUploadFavIcon">file_upload</i>
                            </div>
                        </div>
        
                        <div>
                            <button type="button" class="btn" id="genModalBtn" @click.prevent="bioSave">
                                Save
                            </button>
                        </div>
            
                        <div class="genBottomBtnDiv">
                            <a href="#" class="goBackBtn" @click="bioGoBackBtn3()">GO BACK</a>
            
                            <button type="button" disabled class="btn right" id="genNextBtn" @click="bioNextBtn3()">
                                NEXT STEP
                            </button>
                        </div>
                    </div>
                </div>
            
            </div>

            <!-- Services Modal -->
            <div class="servicesModalDiv" v-if="!servicesModal">
                <div class="editInnerGenModal">
                
                    <div>
                        <div class="row">
                            <p class="genTitle1 col s6 ">Add your services</p>
                            <i
                                v-if="services.length < 3"
                                class="col s1 offset-s1 material-icons genTitle1 cursor" title="Add More Services"
                                id="bioAddBtn"
                                @click="addMore()"
                                >add_circle</i
                            >
                        </div>
                        
                        <p class="genTxt">
                            Lorem Ipsum is simply dummy text of the
                            printing and typesetting industry.
                        </p>
                        <form 
                            enctype="multipart/form-data"
                            @submit.prevent="serviceSave">
                            <div v-for="(service, index) in services" :key="index">
                                <div class="row">
                                    <div class="flex">
                                        <div>
                                            <div class="input-field">
                                                <input type="text" placeholder="JohnDoe" id="genInput" v-model="service.title" maxlength="15" required>
                                            </div>
                                            <div class="input-field">
                                                <!-- <input type="text" placeholder="First Name" id="bioInput1"> -->
                                                <textarea id="bioDescribeInput" required maxlength="239" v-model="service.description" class="materialize-textarea" placeholder="Description"></textarea>
                                            </div>
                                        </div>
                                        <div>
                                            <label>&nbsp;</label>
                                            <i
                                                @click="remove(index)"
                                                v-show="index != 0"
                                                class="material-icons cursor"
                                                id="bioAddBtn"
                                            >
                                                cancel
                                            </i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                
                            <div>
                                <button type="submit" class="btn" id="genModalBtn">
                                    save
                                </button>
                            </div>
                        </form>
                
                        <div class="genBottomBtnDiv">
                            <a href="#" class="goBackBtn" @click="servicesGoBackBtn()">GO BACK</a>
                
                            <button type="button" class="btn right" id="genNextBtn" @click="servicesNextBtn()">
                                NEXT STEP
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Achievement Modal -->
            <div class="achieveModalDiv" v-if="!achieveModal">
                <div class="editInnerGenModal">
                    <div>
                        <p class="genTitle1">Add your achievement</p>
                
                        <p class="genTxt">
                            Lorem Ipsum is simply dummy text of the
                            printing and typesetting industry.
                        </p>
                
                        <form>
                            <div class="file-field input-field" id="genUploadFavIconDiv">
                                <input type="file">
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" placeholder="Upload banner" type="text" id="genInput1">
                                    <i class="material-icons" id="genUploadFavIcon">file_upload</i>
                                </div>
                            </div>

                            <div>
                                <p class="achieveTitle">Experience</p>

                                <div class="achieveProgressBar">
                                    <div class="achieveInnerProgressBar"></div>
                                </div>
                            </div>

                            <div>
                                <p class="achieveTitle">Ward Rounds</p>
                            
                                <div class="achieveProgressBar">
                                    <div class="achieveInnerProgressBar"></div>
                                </div>
                            </div>

                            <div>
                                <p class="achieveTitle">Volunteer/Outreach</p>
                            
                                <div class="achieveProgressBar">
                                    <div class="achieveInnerProgressBar"></div>
                                </div>
                            </div>

                            <div>
                                <p class="achieveTitle">Certificates</p>
                            
                                <div class="achieveProgressBar">
                                    <div class="achieveInnerProgressBar"></div>
                                </div>
                            </div>
                                            
                            <div>
                                <button type="button" class="btn" id="genModalBtn">
                                    Upload
                                </button>
                            </div>
                        </form>
                
                        <div class="genBottomBtnDiv">
                            <a href="#" class="goBackBtn" @click="achieveGoBackBtn()">GO BACK</a>
                
                            <button type="button" class="btn right" id="genNextBtn" @click="achieveNextBtn()">
                                NEXT STEP
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Socials Modal -->
            <div class="socialModalDiv" v-if="!socialsModal">
                <div class="editInnerGenModal">
                    <div>
                        <p class="genTitle1">Link your social media platform</p>
                
                        <p class="genTxt">
                            Lorem Ipsum is simply dummy text of the
                            printing and typesetting industry.
                        </p>
                
                        <form @submit.prevent="saveSocial">
                            <div class="input-field">
                                <input type="url" id="socialInput" v-model="social.instagram">
                                <i class="fa-brands fa-square-instagram editSocialMedIcons"></i>
                            </div>
                
                            <div class="input-field">
                                <input type="url" id="socialInput1" v-model="social.twitter">
                                <i class="fa-brands fa-twitter editSocialMedIcons"></i>
                            </div>

                            <div class="input-field">
                                <input type="url" id="socialInput2" v-model="social.facebook">
                                <i class="fa-brands fa-facebook editSocialMedIcons"></i>
                            </div>
                
                            <div>
                                <button type="submit" class="btn" id="genModalBtn">
                                    save
                                </button>
                            </div>
                        </form>
                
                        <div class="genBottomBtnDiv">
                            <a href="#" class="goBackBtn" @click="socialGoBackBtn()">GO BACK</a>
                
                            <button type="button" class="btn right" id="genNextBtn" @click="socialNextBtn()">
                                NEXT STEP
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Modal -->
            <div class="bioModalDiv" v-if="!contactModal">
                <div class="editInnerGenModal">
                    <div>
                        <p class="genTitle1">Put in your contact details</p>
                
                        <p class="genTxt">
                            Lorem Ipsum is simply dummy text of the
                            printing and typesetting industry.
                        </p>
                
                        <form @submit.prevent="saveContact">
                            <div class="input-field">
                                <input type="email" placeholder="Email" id="contactInput" v-model="contact.email">
                            </div>
                
                            <div class="input-field">
                                <input type="tel" placeholder="Phone number" id="contactInput1" v-model="contact.phone">
                            </div>
                
                            <div class="input-field">
                                <input type="address" placeholder="Location" id="contactInput2" v-model="contact.address">
                            </div>
                
                            <div>
                                <button type="submit" class="btn" id="genModalBtn">
                                    save
                                </button>
                            </div>
                        </form>
                
                        <div class="genBottomBtnDiv">
                            <a href="#" class="goBackBtn" @click="contactGoBackBtn()">GO BACK</a>
                
                            <button type="button" class="btn right" id="genNextBtn" @click="contactNextBtn()">
                                NEXT STEP
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            bioModal: true,
            genModal: false,
            servicesModal: true,
            achieveModal: true, 
            socialsModal: true,
            contactModal: true,

            isActive: true, 

            genModal1: true,
            bioModal1: true,
            bioModal2: true,
            bioModal3: true,

            general: {
                favicon: null,
                title: "",
            },
            bio: {
                photo: null,
                about: "",
                firstname: this.user.firstname,
                lastname: this.user.lastname,
                CV: null,
            },
            titles: [],
            services: [
                {
                    title: "",
                    description: "",
                    icon: 'fa-tooth',
                },
            ],
            social: {
                facebook: "https://",
                twitter: "https://",
                instagram: "https://",
            },
            contact: {
                email: this.user.email,
                phone: "",
                address: "",
            }
        }
    },
    props: ['user'],
    mounted() {
    },
    methods: {
        generalSave() {
            let formData = new FormData();
                formData.append("favicon", this.general.favicon);
                formData.append("title", this.general.title);
                axios
                    .post(`/api/general`, formData)
                    .then((res) => {
                        if (res.data.status == 200) {
                            M.toast({
                                html: res.data.message,
                                classes: "successNotifier",
                            });
                            this.genNextBtn1();
                        }
                    })
                    .catch((err) => {
                        if (err.response.status == 400) {
                            err.response.data.forEach((el) => {
                                M.toast({
                                    html: el,
                                    classes: "errorNotifier",
                                });
                            });
                        }
                    });
        },
        bioSave() {
            if (this.bio.about.length > 614 || this.bio.about.length < 614) {
                M.toast({
                    html: "Your about must be 614 in character",
                    classes: "errorNotifier",
                });
            } else if (this.bio.about.length == 614) {
                let formData = new FormData();
                formData.append("CV", this.bio.CV);
                formData.append("photo", this.bio.photo);
                formData.append("about", this.bio.about);
                formData.append("firstname", this.bio.firstname);
                formData.append("lastname", this.bio.lastname);

                axios
                    .post(`/api/bio`, formData)
                    .then((res) => {
                        console.log(res);
                        if (res.status == 201) {
                            M.toast({
                                html: res.data.message,
                                classes: "successNotifier",
                            });
                            this.bioNextBtn3();
                        }
                    })
                    .catch((err) => {
                        if (err.response.status == 400) {
                            err.response.data.forEach((el) => {
                                M.toast({
                                    html: el,
                                    classes: "errorNotifier",
                                });
                            });
                        }
                    });
            }
        },
        addMore() {
            this.services.push({
                title: "",
                description: "",
                icon: 'fa-tooth',
            });
        },
        remove(index) {
            this.services.splice(index, 1);
        },
        serviceSave() {
            let formData = new FormData();
            formData.append('data', JSON.stringify(this.services));
            axios
                .post(`/api/service`, formData)
                .then((res) => {
                    console.log(res);
                    if (res.status == 201) {
                        M.toast({
                            html: res.data.message,
                            classes: "successNotifier",
                        });
                        this.servicesNextBtn();
                    }
                })
                .catch((err) => {
                    if (err.response.status == 400) {
                        err.response.data.forEach((el) => {
                            M.toast({
                                html: el,
                                classes: "errorNotifier",
                            });
                        });
                    }
                });
        },
        saveSocial() {
            axios
                .post(`/api/social`, this.social)
                .then((res) => {
                    if (res.status == 201) {
                        M.toast({
                            html: res.data.message,
                            classes: "successNotifier",
                        });
                        this.socialNextBtn();
                    }
                })
                .catch((err) => {
                    if (err.response.status == 400) {
                        err.response.data.forEach((el) => {
                            M.toast({
                                html: el,
                                classes: "errorNotifier",
                            });
                        });
                    }
                });
        },
        saveContact() {
            axios
                .post(`/api/contact`, this.contact)
                .then((res) => {
                    if (res.status == 201) {
                        M.toast({
                            html: res.data.message,
                            classes: "successNotifier",
                        });
                        // this.contactNextBtn()
                    }
                })
                .catch((err) => {
                    if (err.response.status == 400) {
                        err.response.data.forEach((el) => {
                            M.toast({
                                html: el,
                                classes: "errorNotifier",
                            });
                        });
                    }
                });
        },
        favUpload(e) {
            if (!e.target.files.length) return;
            this.general.favicon = e.target.files[0];
        },
        photoUpload(e) {
            if (!e.target.files.length) return;
            this.bio.photo = e.target.files[0];
        },
        CVUpload(e) {
            if (!e.target.files.length) return;
            this.bio.CV = e.target.files[0];
        },
        servicesLink() {
            this.bioModal = true;
            this.genModal = true;
            this.servicesModal = false;
            this.achieveModal = true;
            this.socialsModal = true;
            this.contactModal = true;

            this.isActive = false;

            $("#servicesLink").css("background-color", "black");
            $("#genLink").css("background-color", "white");
            $('#bioLink').css('background-color', 'white');
            $("#socialLink").css("background-color", "white");
            $("#contactLink").css("background-color", "white");
        },

        genLink() {
            this.bioModal = true;
            this.genModal = false
            this.servicesModal = true;
            this.achieveModal = true;
            this.socialsModal = true;
            this.contactModal = true;

            this.isActive = true;

            $("#genLink").css("background-color", "black");
            $("#servicesLink").css("background-color", "white");
            $('#bioLink').css('background-color', 'white');
            $("#achieveLink").css("background-color", "white");
            $("#socialLink").css("background-color", "white");
            $("#contactLink").css("background-color", "white");
        },

        bioLink() {
            this.bioModal = false;
            this.genModal = true;
            this.servicesModal = true;
            this.achieveModal = true;
            this.socialsModal = true;
            this.contactModal = true;

            this.isActive = false;

            $('#bioLink').css('background-color', 'black');
            $("#genLink").css("background-color", "white");
            $("#servicesLink").css("background-color", "white");
            $("#achieveLink").css("background-color", "white");
            $("#socialLink").css("background-color", "white");
            $("#contactLink").css("background-color", "white");
        }, 

        achieveLink() {
            this.achieveModal = false;
            this.bioModal = true;
            this.genModal = true;
            this.servicesModal = true;
            this.socialsModal = true;
            this.contactModal = true;

            this.isActive = false;


            $('#bioLink').css('background-color', 'white');
            $("#genLink").css("background-color", "white");
            $("#servicesLink").css("background-color", "white");
            $("#achieveLink").css("background-color", "black");
            $("#socialLink").css("background-color", "white");
            $("#contactLink").css("background-color", "white");
        }, 

        socialLink() {
            this.socialsModal = false;
            this.achieveModal = true;
            this.bioModal = true;
            this.genModal = true;
            this.servicesModal = true; 
            this.contactModal = true;

            this.isActive = false;

            $('#bioLink').css('background-color', 'white');
            $("#genLink").css("background-color", "white");
            $("#servicesLink").css("background-color", "white");
            $("#achieveLink").css("background-color", "white");
            $("#socialLink").css("background-color", "black");
            $("#contactLink").css("background-color", "white");
        },

        contactLink() {
            this.contactModal = false; 
            this.socialsModal = true;
            this.achieveModal = true;
            this.bioModal = true;
            this.genModal = true;
            this.servicesModal = true; 

            this.isActive = false;

            $('#bioLink').css('background-color', 'white');
            $("#genLink").css("background-color", "white");
            $("#servicesLink").css("background-color", "white");
            $("#achieveLink").css("background-color", "white");
            $("#socialLink").css("background-color", "white");
            $("#contactLink").css("background-color", "black");
        },

        genNextBtn() {
            this.genModal = true;
            this.genModal1 = false;
            $('#bioLink').css('background-color', 'white');
        },

        genGoBackBtn() {
            this.genModal = false;
            this.genModal1 = true;
            $('#bioLink').css('background-color', 'white');
        },

        genNextBtn1() {
            this.genModal1 = true;
            this.bioModal = false;
            this.isActive = false; 
            $('#bioLink').css('background-color', 'black');
        },

        bioGoBackBtn() {
            this.bioModal = true;
            this.genModal1 = false;
            $("#genLink").css("background-color", "black");
            $('#bioLink').css('background-color', 'white');

        }, 

        bioGoBackBtn() {
            this.bioModal = true;
            this.genModal1 = false;
        }, 

        bioNextBtn() {
            this.bioModal = true;
            this.bioModal1 = false;
        },

        bioGoBackBtn1() {
            this.bioModal1 = true;
            this.bioModal = false;
        }, 

        bioGoBackBtn2() {
            this.bioModal1 = false;
            this.bioModal2 = true;
        },

        bioNextBtn1() {
            this.bioModal1 = true;
            this.bioModal2 = false;
        }, 

        bioGoBackBtn3() {
            this.bioModal2 = false;
            this.bioModal3 = true;
        }, 

        bioNextBtn2() {
            this.bioModal3 = false;
            this.bioModal2 = true;
        }, 

        bioNextBtn3() {
            this.bioModal3 = true;
            this.servicesModal = false;
        },

        servicesGoBackBtn() {
            this.servicesModal = true;
            this.bioModal3 = false;
        },

        achieveGoBackBtn() {
            this.servicesModal = false;
            this.achieveModal = true;
        },

        servicesNextBtn() {
            this.servicesModal = true;
            this.achieveModal = false;
        },

        achieveNextBtn() {
            this.achieveModal = true;
            this.socialsModal = false;
        },

        socialGoBackBtn() {
            this.achieveModal = false;
            this.socialsModal = true;
        },

        socialNextBtn() {
            this.socialsModal = true;
            this.contactModal = false;
        }, 

        contactGoBackBtn() {
            this.contactModal = true;
            this.socialsModal = false;
        }
    },
}
</script>
<style scoped>
    .flex {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
</style>