<template>
    <div>
        <div @change="onChangeInput($event)">
            <div class="bioModalDiv" v-if="bioModal">
                <div class="editInnerGenModal">
                    <div class="genTitleDiv">
                        <div>
                            <i
                                class="material-icons"
                                id="genTitleCheck"
                                v-if="bio.firstname != '' || bio.lastname != ''"
                                >check</i
                            >
                            <i
                                class="material-icons genTitleClear"
                                v-else-if="
                                    bio.firstname == '' || bio.lastname == ''
                                "
                                >clear</i
                            >
                            <p
                                class="genTitle activeTab cursor"
                                @click="bioGoBackBtn1"
                            >
                                Full Name
                            </p>
                        </div>
                        <div>
                            <span v-if="bio.gender !== null">
                                <i
                                    class="material-icons"
                                    id="genTitleCheck1"
                                    v-if="bio.gender != ''"
                                >check</i
                                >
                            </span>
                            <i
                                class="material-icons genTitleClear"
                                v-else-if="bio.gender == ''"
                                >clear</i
                            >
                            <p class="genTitle cursor" @click="bioNextBtn">
                                Gender
                            </p>
                        </div>

                        <div>
                            <i
                                class="material-icons"
                                id="genTitleCheck2"
                                v-if="bio.photo != null"
                                >check</i
                            >
                            <i
                                class="material-icons genTitleClear"
                                v-else-if="bio.photo == null"
                                >clear</i
                            >
                            <p class="genTitle cursor" @click="bioNextBtn1">
                                Upload Photo
                            </p>
                        </div>

                        <div>
                            <i
                                class="material-icons"
                                id="genTitleCheck3"
                                v-if="bio.CV != null"
                                >check</i
                            >
                            <i
                                class="material-icons genTitleClear"
                                v-else-if="bio.CV == null"
                                >clear</i
                            >
                            <p class="genTitle cursor" @click="bioNextBtn2">
                                Upload Curriculum
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col s12 m12 l6">
                            <p class="genTitle1">Provide your full name</p>

                            <p class="genTxt">
                                Your names are auto inputted with the names you provided during registration. you can change it if you wish so.
                            </p>

                            <div class="input-field">
                                <input type="text" v-model="bio.lastname" placeholder="Last Name" class="bioInput" />
                            </div>

                            <div class="input-field">
                                <input type="text" v-model="bio.firstname" placeholder="First Name" class="bioInput" />
                            </div>
                            <div class="input-field">
                                <input type="text" v-model="bio.institution" placeholder="Institution" class="bioInput" required/>
                            </div>

                            <!-- <div>
                                <button type="button" class="btn" id="genModalBtn">
                                    save
                                </button>
                            </div> -->
                        </div>

                        <div class="col s12 m12 l6">
                            <img src="/media/img/editWebsiteSettings/fullname.png" alt="fullname.png" class="editWebIllustrativeImg">
                        </div>
                    </div>
                        <div class="right">
                            <a
                                href="#"
                                class="chevronIconLink"

                                title="skip to next"
                                @click="bioNextBtn()"
                            >
                                <i class="material-icons chevronIcon"
                                    >chevron_right</i
                                >
                            </a>
                        </div>
                    <div class="genBottomBtnDiv">
                        <div class="flexed">
                            <a href="#" class="btn right" id="genNextBtn" @click="bioGoBackBtn()">GENERAL</a>
                            <a href="#" class="btn right" id="genNextBtn" @click="servicesLink()">SERVICES</a>

                        </div>
                    </div>

                </div>
            </div>

            <!-- Bio Modal 1 -->
            <div class="bioModalDiv" v-if="bioModal1">
                <div class="editInnerGenModal">
                    <div class="genTitleDiv">
                        <div>
                            <i
                                class="material-icons"
                                id="genTitleCheck"
                                v-if="bio.firstname !== '' || bio.lastname !== ''"
                                >check</i
                            >
                            <i
                                class="material-icons genTitleClear"
                                v-else-if="
                                    bio.firstname === '' || bio.lastname === ''
                                "
                                >clear</i
                            >
                            <p class="genTitle cursor" @click="bioGoBackBtn1">
                                Full Name
                            </p>
                        </div>
                        <div>
                            <span v-if="bio.about !== null">
                                <i
                                    class="material-icons"
                                    id="genTitleCheck1"
                                    v-if="bio.gender != ''"
                                >check</i
                                >
                            </span>
                            <i
                                class="material-icons genTitleClear"
                                v-else-if="bio.gender === ''"
                                >clear</i
                            >
                            <p
                                class="genTitle cursor activeTab"
                                @click="bioNextBtn"
                            >
                                Gender
                            </p>
                        </div>

                        <div>
                            <i
                                class="material-icons"
                                id="genTitleCheck2"
                                v-if="bio.photo != null"
                                >check</i
                            >
                            <i
                                class="material-icons genTitleClear"
                                v-else-if="bio.photo == null"
                                >clear</i
                            >
                            <p class="genTitle cursor" @click="bioNextBtn1">
                                Upload Photo
                            </p>
                        </div>
                        <div>
                            <i
                                class="material-icons"
                                id="genTitleCheck3"
                                v-if="bio.CV != null"
                                >check</i
                            >
                            <i
                                class="material-icons genTitleClear"
                                v-else-if="bio.CV == null"
                                >clear</i
                            >
                            <p class="genTitle cursor" @click="bioNextBtn2">
                                Upload Curriculum
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col s12 m12 l6">
                            <p class="genTitle1">About You</p>

                            <select class="browser-default" v-model="bio.gender">
                                <option value="" disabled selected>Choose gender</option>
                                <option value="M">Male, He/Him</option>
                                <option value="F">Female, She/Her</option>
                                <option value="O">Others, They/Them</option>
                            </select>
                            
                            <!-- <div class="input-field">
                                <textarea v-model="bio.about" class="materialize-textarea bioDescribeInput" placeholder="Highly skilled Pediatrician with 9 year of experience ..." maxlength="614"></textarea>
                                <p class="right m-0 " :class="{redColor: aboutCount <= 599, successColor: aboutCount >= 614}">
                                    {{aboutCount}}/614
                                </p>
                            </div> -->
                        </div>

                        <div class="col s12 m12 l6">
                            <img src="/media/img/editWebsiteSettings/fullnameDescription.png" alt="fullnameDescription.png" class="editWebIllustrativeImg">
                        </div>
                    </div>
                        <div class="right">
                            <a
                                href="#"
                                class="chevronIconLink"
                                @click="bioGoBackBtn1()"
                            >
                                <i class="material-icons chevronIcon"
                                    >chevron_left</i
                                >
                            </a>
                            <a
                                href="#"
                                class="chevronIconLink"

                                title="skip to next"
                                @click="bioNextBtn1()"
                            >
                                <i class="material-icons chevronIcon"
                                    >chevron_right</i
                                >
                            </a>
                        </div>
                    <div class="genBottomBtnDiv">
                        <div class="flexed">
                            <a href="#" class="btn right" id="genNextBtn" @click="bioGoBackBtn()">GENERAL</a>
                            <a href="#" class="btn right" id="genNextBtn" @click="servicesLink()">SERVICES</a>
                            <!-- <i class="material-icons">chevron_right</i> -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bio Modal 2 -->
            <div class="bioModalDiv" v-if="bioModal2">
                <div class="editInnerGenModal">
                    <div class="genTitleDiv">
                        <div>
                            <i
                                class="material-icons"
                                id="genTitleCheck"
                                v-if="bio.firstname !== '' || bio.lastname !== ''"
                                >check</i
                            >
                            <i
                                class="material-icons genTitleClear"
                                v-else-if="
                                    bio.firstname === '' || bio.lastname === ''
                                "
                                >clear</i
                            >
                            <p class="genTitle cursor" @click="bioGoBackBtn1">
                                Full Name
                            </p>
                        </div>
                        <div>
                            <span v-if="bio.gender !== ''">
                                <i
                                    class="material-icons"
                                    id="genTitleCheck1"
                                    v-if="bio.gender !== ''"
                                >check</i
                                >
                            </span>
                            <i
                                class="material-icons genTitleClear"
                                v-else-if="bio.gender === ''"
                                >clear</i
                            >
                            <p class="genTitle cursor" @click="bioNextBtn">
                                Gender
                            </p>
                        </div>
                        <div>
                            <i
                                class="material-icons"
                                id="genTitleCheck2"
                                v-if="bio.photo !== null"
                                >check</i
                            >
                            <i
                                class="material-icons genTitleClear"
                                v-else-if="bio.photo === null"
                                >clear</i
                            >
                            <p
                                class="genTitle cursor activeTab"
                                @click="bioNextBtn1"
                            >
                                Upload Photo
                            </p>
                        </div>
                        <div>
                            <i
                                class="material-icons"
                                id="genTitleCheck3"
                                v-if="bio.CV !== null"
                                >check</i
                            >
                            <i
                                class="material-icons genTitleClear"
                                v-else-if="bio.CV === null"
                                >clear</i
                            >
                            <p class="genTitle cursor" @click="bioNextBtn2">
                                Upload Curriculum
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col l12">
                            <p class="genTitle1">Upload a clear picture of you</p>
                        </div>

                        <div class="col l6">
                            <p class="genTxt">
                                Image must be .jpg/.png. The size must not be more than 1MB. The dimension should be 451px (width) by 512px (height).
                            </p>

                            <div
                                class="file-field input-field"
                                id="genUploadFavIconDiv"
                                v-if="bio.photo == null && !showCropper"
                            >
                               
                                <div class="">
                                    <input
                                        class=" validate genInput1"
                                        type="button"
                                        value="Click to Choose Avatar"
                                        @click="showCropper = true"
                                    />
                                </div>
                            </div>
                            <div v-else class="" v-show="!showCropper">
                                <div class="col l9 center-align">
                                    <img
                                        class="bioPics"
                                        :src=" uploaded !== null ? uploaded :
                                            typeof bio.photo === 'string'
                                            ? '/media/tenants/'+tenant+'/img/'+ bio.photo
                                                : uploaded
                                        "
                                    />
                                </div>
                                <div class="col l3 faviconUploadBtnCol">
                                    <button type="button" class="btn-flat redBorderBtn matchngBtn" @click="(deleteImg, showCropper=true)"><i class="material-icons">swap_horiz</i></button>
                                </div>
                            </div>
                            <div v-show="showCropper">
                                <ImageCropper :height="512" :width="451" @uploadPhoto="photoUpload($event)"/>
                            </div>
                        </div>
                        <div class="col l6">
                            <img src="/media/img/editWebsiteSettings/fullname.png" alt="fullname.png" class="editWebIllustrativeImg2">
                        </div>
                    </div>


                    <div class="flexed">
                        <button  v-if="loading" class="btn">
                            <div class="preloader-wrapper small active">
                                <div
                                    class="spinner-layer spinner-white-only"
                                >
                                    <div class="circle-clipper left">
                                        <div class="circle"></div>
                                    </div>
                                    <div class="gap-patch">
                                        <div class="circle"></div>
                                    </div>
                                    <div class="circle-clipper right">
                                        <div class="circle"></div>
                                    </div>
                                </div>
                            </div>
                        </button>
                        <button type="button" class="btn" id="genModalBtn" @click.prevent="bioSave" v-else-if="saved == null">
                            Save
                        </button>
                        <button type="button" class="btn" id="genModalBtn" @click.prevent="bioUpdate" v-else disabled>
                            Update
                        </button>
                        <div>
                            <a
                                href="#!"
                                class="chevronIconLink"
                                @click="bioGoBackBtn2()"
                            >
                                <i class="material-icons chevronIcon"
                                    >chevron_left</i
                                >
                            </a>
                            <a
                                href="#!"
                                class="chevronIconLink"

                                title="skip to next"
                                @click="bioNextBtn2()"
                            >
                                <i class="material-icons chevronIcon"
                                    >chevron_right</i
                                >
                            </a>
                        </div>
                    </div>
                    <div class="genBottomBtnDiv">
                        <div class="flexed">
                            <a href="#" class="btn right" id="genNextBtn" @click="bioGoBackBtn()">GENERAL</a>
                            <a href="#!" class="btn right" id="genNextBtn" @click="servicesLink()">SERVICES</a>
                            <!-- <i class="material-icons">chevron_right</i> -->
                        </div>
                    </div>

                </div>
            </div>

            <!-- Bio Modal 3 -->
            <div class="bioModalDiv" v-if="bioModal3">
                <div class="editInnerGenModal">
                    <div class="genTitleDiv">
                        <div>
                            <i
                                class="material-icons"
                                id="genTitleCheck"
                                v-if="bio.firstname != '' || bio.lastname != ''"
                                >check</i
                            >
                            <i
                                class="material-icons genTitleClear"
                                v-else-if="
                                    bio.firstname == '' || bio.lastname == ''
                                "
                                >clear</i
                            >
                            <p class="genTitle cursor" @click="bioGoBackBtn1">
                                Full Name
                            </p>
                        </div>
                        <div>
                            <span v-if="bio.gender !== null">
                                <i
                                    class="material-icons"
                                    id="genTitleCheck1"
                                    v-if="bio.gender !== null"
                                >check</i
                                >
                            </span>
                            <i
                                class="material-icons genTitleClear"
                                v-else-if="bio.gender == ''"
                                >clear</i
                            >
                            <p class="genTitle cursor" @click="bioNextBtn">
                                Gender
                            </p>
                        </div>
                        <div>
                            <i
                                class="material-icons"
                                id="genTitleCheck2"
                                v-if="bio.photo != null"
                                >check</i
                            >
                            <i
                                class="material-icons genTitleClear"
                                v-else-if="bio.photo == null"
                                >clear</i
                            >
                            <p class="genTitle cursor" @click="bioNextBtn1">
                                Upload Photo
                            </p>
                        </div>
                        <div>
                            <i
                                class="material-icons"
                                id="genTitleCheck3"
                                v-if="bio.CV != null"
                                >check</i
                            >
                            <i
                                class="material-icons genTitleClear"
                                v-else-if="bio.CV == null"
                                >clear</i
                            >
                            <p
                                class="genTitle cursor activeTab"
                                @click="bioNextBtn2"
                            >
                                Upload Curriculum
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col s12 m12 l7">
                            <p class="genTitle1">Your curriculum Vitae</p>

                            <p class="genTxt">
                                Let your clients know more about you.
                            </p>

                            <div class="file-field input-field" id="genUploadFavIconDiv" v-if="bio.CV == null">
                                <a class="waves-effect waves-light btn-flat modal-trigger" href="#cvModal">Let us get to know you more</a>

                                <!-- <input type="file" @change="CVUpload"
                                    accept="application/msword, application/vnd.ms-powerpoint,application/pdf," />
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text" id="genInput1" placeholder="File must not be more than 2MB" />
                                    <i class="material-icons" id="genUploadFavIcon">file_upload</i>
                                </div> -->
                            </div>
                            <div v-else class="flex no-space-between">
                                <p>
                                    {{
                                    uploadedfile != null ? uploadedfile : bio.CV
                                    }}
                                </p>
                                <div class="faviconUploadBtnCol">
                                    <button type="button" class="btn-flat redBorderBtn matchngBtn"  @click="deleteCV"><i class="material-icons">swap_horiz</i></button>
                                </div>
                            </div>



                        </div>

                        <div class="col s12 m12 l5">
                            <img src="/media/img/editWebsiteSettings/fullnameCv.png" alt="fullnameCv.png" class="editWebIllustrativeImg" width="420" height="300">
                        </div>
                    </div>

                    <div class="flexed">
                        <button  v-if="loading" class="btn">
                            <div class="preloader-wrapper small active">
                                <div
                                    class="spinner-layer spinner-white-only"
                                >
                                    <div class="circle-clipper left">
                                        <div class="circle"></div>
                                    </div>
                                    <div class="gap-patch">
                                        <div class="circle"></div>
                                    </div>
                                    <div class="circle-clipper right">
                                        <div class="circle"></div>
                                    </div>
                                </div>
                            </div>
                        </button>
                        <button type="button" class="btn" id="genModalBtn" @click.prevent="bioSave" v-else-if="saved == null">
                            Save
                        </button>
                        <button type="button" class="btn" id="genModalBtn" @click.prevent="bioUpdate" v-else>
                            Update
                        </button>
                        <div>
                            <a
                                href="#!"
                                class="chevronIconLink"
                                @click="bioGoBackBtn3()"
                            >
                                <i class="material-icons chevronIcon"
                                    >chevron_left</i
                                >
                            </a>
                            <!-- <a
                                href="#!"
                                class="chevronIconLink"

                                title="skip to next"
                                @click="bioNextBtn2()"
                            >
                                <i class="material-icons chevronIcon"
                                    >chevron_right</i
                                >
                            </a> -->
                        </div>
                    </div>
                    <div class="genBottomBtnDiv">
                        <div class="flexed">
                            <a href="#" class="btn right" id="genNextBtn" @click="bioGoBackBtn()">GENERAL</a>
                            <a href="#!" class="btn right" id="genNextBtn" @click="servicesLink()">SERVICES</a>
                            <!-- <i class="material-icons">chevron_right</i> -->
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!-- Modal Structure -->
        <CVModalComponent />
    </div>
</template>
<style>
    .m-0 {
        margin: 0pc;
    }
    .w-custom {
        width: 483px;
    }
    .redColor {
        color: rgb(247, 146, 146);
    }
    .successColor {
        color: rgb(127, 247, 127);
    }
    .flexed {
        justify-content: space-between;
    }
</style>
<script>
import CVModalComponent from './CVModalComponent.vue';
import ImageCropper from "../../../../partials/ImageCropper.vue";
    export default {
    components: {ImageCropper, CVModalComponent },
        props: ["user", "bioModal", "bioModal1", "bioModal2", "bioModal3", "saved", 'loading', 'tenant'],
        data() {
            return {
                bio: {
                    photo: null,
                    gender: "",
                    firstname: this.user.firstname,
                    lastname: this.user.lastname,
                    institution: "",
                    CV: null,
                },
                uploaded: null,
                uploadedfile: null,
                bioeErrors: false,
                showCropper: false,
            };
        },
        
        methods: {
            deleteImg() {
                this.bio.oldPhoto = this.bio.photo;
                this.bio.photo = null;
            },
            deleteCV() {
                this.bio.oldCV = this.bio.CV;
                this.bio.CV = null;
            },
            photoUpload(e) {
                this.bio.photo = e;
                this.uploaded = e;
                this.showCropper = false;
            },
            CVUpload(e) {
                // if (!e.target.files.length) return;
                // this.bio.CV = e.target.files[0];
                // this.uploadedfile = e.target.files[0].name;
            },
            bioGoBackBtn() {
                this.$emit("bioGoBackBtn");
            },
            bioNextBtn() {
                this.$emit("bioNextBtn");
            },
            bioGoBackBtn1() {
                this.$emit("bioGoBackBtn1");
            },
            bioNextBtn1() {
                this.$emit("bioNextBtn1");
            },
            bioGoBackBtn2() {
                this.$emit("bioGoBackBtn2");
            },
            bioNextBtn2() {
                this.$emit("bioNextBtn2");
            },
            bioGoBackBtn3() {
                this.$emit("bioGoBackBtn3");
            },
            servicesLink() {
                if (this.bio.firstname == "" || this.bio.lastname == "" || this.bio.about == "" || this.bio.CV == null || this.bio.photo == null) {
                    this.bioeErrors = true;
                } else this.bioeErrors = false;
                this.$emit("servicesLink", this.bioeErrors);
            },
            bioSave() {
                this.$emit("bioSave", this.bio);
            },
            bioUpdate() {
                let data = {
                    _method: "PUT",
                };
                if (this.uploaded !== null && this.bio.oldCV) {
                    data = { ...data, ...this.bio };
                }
                if (this.uploaded) {
                    let toSend = {
                        firstname: this.bio.firstname,
                        lastname: this.bio.lastname,
                        gender: this.bio.gender,
                        photo: this.bio.photo,
                        id: this.bio.id,
                        about: "",
                    };
                    data = { ...data, ...toSend };
                }
                if (this.bio.oldCV) {
                    let toSend = {
                        firstname: this.bio.firstname,
                        lastname: this.bio.lastname,
                        gender: this.bio.gender,
                        CV: this.bio.CV,
                        id: this.bio.id,
                        about: "",
                    };
                    data = { ...data, ...toSend };
                } else {
                    let detail = {
                        firstname: this.bio.firstname,
                        lastname: this.bio.lastname,
                        gender: this.bio.gender,
                        id: this.bio.id,
                        about: "",
                    };
                    data = { ...data, ...detail };
                }
                this.$emit("bioUpdate", data);
            },
            onChangeInput(e) {
                console.log(e);
            },
        },
        watch: {
            saved(newVal, oldVal) {
                if (newVal != null) {
                    this.bio.photo = newVal.photo;
                    this.bio.gender = newVal.gender;
                    this.bio.id = newVal.id;
                    this.bio.firstname = newVal.firstname;
                    this.bio.lastname = newVal.lastname;
                    this.bio.CV = newVal.CV;
                }
            },
        },
    };
</script>
