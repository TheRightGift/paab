<template>
    <div>
        <div @change="onChangeInput($event)">
            <div class="bioModalDiv" v-if="bioModal">
                <div class="editInnerGenModal">
                    <div class="genTitleDiv">
                        <p
                            class="genTitle activeTab cursor"
                            @click="bioGoBackBtn1"
                        >
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
                            Full Name
                        </p>

                        <p class="genTitle cursor" @click="bioNextBtn">
                            <i
                                class="material-icons"
                                id="genTitleCheck1"
                                v-if="bio.about.length > 600"
                                >check</i
                            >
                            <i
                                class="material-icons genTitleClear"
                                v-else-if="bio.about == ''"
                                >clear</i
                            >
                            Description
                        </p>

                        <p class="genTitle cursor" @click="bioNextBtn1">
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
                            Upload Photo
                        </p>

                        <p class="genTitle cursor" @click="bioNextBtn2">
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
                            Upload Curriculum
                        </p>
                    </div>

                    <div class="row">
                        <div class="col s6">
                            <p class="genTitle1">Provide your full name</p>
                        
                            <p class="genTxt">
                                Lorem Ipsum is simply dummy text of the printing and
                                typesetting industry.
                            </p>
                        
                            <div class="input-field">
                                <input type="text" v-model="bio.lastname" placeholder="Last Name" class="bioInput" />
                            </div>
                        
                            <div class="input-field">
                                <input type="text" v-model="bio.firstname" placeholder="First Name" class="bioInput" />
                            </div>
                        
                            <!-- <div>
                                <button type="button" class="btn" id="genModalBtn">
                                    save
                                </button>
                            </div> -->
                        </div>

                        <div class="col s6">
                            <img src="/media/img/editWebsiteSettings/fullname.png" alt="fullname.png" class="editWebIllustrativeImg">
                        </div>
                    </div>

                    <div class="genBottomBtnDiv">
                        <a href="#" class="goBackBtn" @click="bioGoBackBtn()">GO BACK</a>
                    
                        <button type="button" class="btn right" id="genNextBtn" @click="bioNextBtn()">
                            NEXT STEP
                        </button>
                    </div>
                    
                </div>
            </div>

            <!-- Bio Modal 1 -->
            <div class="bioModalDiv" v-if="bioModal1">
                <div class="editInnerGenModal">
                    <div class="genTitleDiv">
                        <p class="genTitle cursor" @click="bioGoBackBtn1">
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
                            Full Name
                        </p>

                        <p
                            class="genTitle cursor activeTab"
                            @click="bioNextBtn"
                        >
                            <i
                                class="material-icons"
                                id="genTitleCheck1"
                                v-if="bio.about.length > 600"
                                >check</i
                            >
                            <i
                                class="material-icons genTitleClear"
                                v-else-if="bio.about == ''"
                                >clear</i
                            >
                            Description
                        </p>

                        <p class="genTitle cursor" @click="bioNextBtn1">
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
                            Upload Photo
                        </p>

                        <p class="genTitle cursor" @click="bioNextBtn2">
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
                            Upload Curriculum
                        </p>
                    </div>

                    <div class="row">
                        <div class="col s6">
                            <p class="genTitle1">About You</p>
                        
                            <p class="genTxt">
                                Readers only looks at vital info about you, so make
                                it catchy. Not more than (614) and not less than
                                (600) characters.
                            </p>
                        
                            <div class="input-field">
                                <textarea v-model="bio.about" class="materialize-textarea bioDescribeInput" placeholder="Highly skilled Pediatrician with 9 year of experience ..." maxlength="614"></textarea>
                                <p class="right m-0 " :class="{redColor: aboutCount <= 599, successColor: aboutCount >= 614}">
                                    {{aboutCount}}/614
                                </p>
                            </div>
                        
                            <!-- <div>
                                <button type="button" class="btn" id="genModalBtn">
                                    save
                                </button>
                            </div> -->
                        </div>

                        <div class="col s6">
                            <img src="/media/img/editWebsiteSettings/fullnameDescription.png" alt="fullnameDescription.png" class="editWebIllustrativeImg">
                        </div>
                    </div>
                    
                    <div class="genBottomBtnDiv">
                        <a href="#" class="goBackBtn" @click="bioGoBackBtn1()">GO BACK</a>
                    
                        <button type="button" class="btn right" id="genNextBtn" @click="bioNextBtn1()">
                            NEXT STEP
                        </button>
                    </div>
                </div>
            </div>

            <!-- Bio Modal 2 -->
            <div class="bioModalDiv" v-if="bioModal2">
                <div class="editInnerGenModal">
                    <div class="genTitleDiv">
                        <p class="genTitle cursor" @click="bioGoBackBtn1">
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
                            Full Name
                        </p>

                        <p class="genTitle cursor" @click="bioNextBtn">
                            <i
                                class="material-icons"
                                id="genTitleCheck1"
                                v-if="bio.about.length > 600"
                                >check</i
                            >
                            <i
                                class="material-icons genTitleClear"
                                v-else-if="bio.about == ''"
                                >clear</i
                            >
                            Description
                        </p>

                        <p
                            class="genTitle cursor activeTab"
                            @click="bioNextBtn1"
                        >
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
                            Upload Photo
                        </p>

                        <p class="genTitle cursor" @click="bioNextBtn2">
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
                            Upload Curriculum
                        </p>
                    </div>

                    <!--div class="row">
                        <div class="col s7">
                            <p class="genTitle1">Upload a clear picture of you</p>
                        
                            <p class="genTxt">
                                Lorem Ipsum is simply dummy text of the printing and
                                typesetting industry.
                            </p>
                        
                            <div class="file-field input-field" id="genUploadFavIconDiv" v-if="bio.photo == null">
                                <input type="file" @change="photoUpload" accept=".jpg, .png" />
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text" id="genInput1"
                                        placeholder="Image must be .jpg/.png and not greater than 1MB(500x500)" />
                                    <i class="material-icons" id="genUploadFavIcon">file_upload</i>
                                </div>
                            </div>
                            <div v-else class="flex no-space-between">
                                <img width="100" height="100" class="responsive-img" :src="
                                    typeof bio.photo == 'string'
                                        ? 'tenancy/assets/' + bio.photo
                                        : uploaded
                                " />
                                <a class="
                                    waves-effect waves-light
                                    btn-small btn
                                    red
                                " @click="deleteImg">Change</a>
                            </div>
                        </div>

                        <div class="col s5">
                            <img src="/media/img/editWebsiteSettings/fullnameProImg.png" alt="fullnameProImg.png" class="editWebIllustrativeImg" width="420" height="300">
                        </div>
                    </div-->
                    <div class="row">
                        <div class="col l12">
                            <p class="genTitle1">Upload a clear picture of you</p>
                        </div>

                        <div class="col l6">
                            <p class="genTxt">
                                Image must be .jpg/.png and not greater than 1MB(500x500).
                            </p>

                            <div
                                class="file-field input-field"
                                id="genUploadFavIconDiv"
                                v-if="bio.photo == null"
                            >
                                <input
                                    type="file"
                                    @change="photoUpload"
                                    accept=".jpg, .png"
                                />
                                <div class="file-path-wrapper">
                                    <input
                                        class="file-path validate genInput1"
                                        type="text"
                                        placeholder="Pick a Picture"
                                    />
                                    <!--i class="material-icons" id="genUploadFavIcon"
                                        >file_upload</i
                                    -->
                                </div>
                            </div>
                            <div v-else class="flex no-space-between">
                                <img
                                    width="250"
                                    height="250"
                                    class="responsive-img"
                                    :src="
                                        typeof bio.photo == 'string'
                                            ? 'tenancy/assets/' + bio.photo
                                            : uploaded
                                    "
                                />
                                <div class="faviconUploadBtnCol">
                                    <button type="button" class="btn-flat redBorderBtn matchngBtn" @click="deleteImg"><i class="material-icons">swap_horiz</i></button>                                
                                </div>
                            </div>
                        </div>
                        <!-- <div v-else class="flex">
                            <img
                                width="100"
                                height="100"
                                class="responsive-img"
                                :src="
                                    typeof bio.photo == 'string'
                                        ? 'tenancy/assets/' + bio.photo
                                        : uploaded
                                "
                            />
                            <div class="faviconUploadBtnCol">
                                <button type="button" class="btn-flat redBorderBtn matchngBtn"  @click="deleteImg"><i class="material-icons">swap_horiz</i></button>                                
                            </div> -->

                        <div class="col l6">
                            <img src="/media/img/editWebsiteSettings/fullname.png" alt="fullname.png">
                        </div>
                    </div>
                        <!-- <div>
                                    <button type="button" class="btn" id="genModalBtn">
                                        Upload
                                    </button>
                                </div> -->

                    <div class="genBottomBtnDiv">
                        <a
                            href="#"
                            class="goBackBtn"
                            @click="bioGoBackBtn2()"
                            >GO BACK</a
                        >

                        <button
                            type="button"
                            class="btn right"
                            id="genNextBtn"
                            @click="bioNextBtn2()"
                        >
                            NEXT STEP
                        </button>
                    </div>
                    
                </div>
            </div>

            <!-- Bio Modal 3 -->
            <div class="bioModalDiv" v-if="bioModal3">
                <div class="editInnerGenModal">
                    <div class="genTitleDiv">
                        <p class="genTitle cursor" @click="bioGoBackBtn1">
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
                            Full Name
                        </p>

                        <p class="genTitle cursor" @click="bioNextBtn">
                            <i
                                class="material-icons"
                                id="genTitleCheck1"
                                v-if="bio.about.length > 600"
                                >check</i
                            >
                            <i
                                class="material-icons genTitleClear"
                                v-else-if="bio.about == ''"
                                >clear</i
                            >
                            Description
                        </p>

                        <p class="genTitle cursor" @click="bioNextBtn1">
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
                            Upload Photo
                        </p>

                        <p
                            class="genTitle cursor activeTab"
                            @click="bioNextBtn2"
                        >
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
                            Upload Curriculum
                        </p>
                    </div>

                    <div class="row">
                        <div class="col s7">
                            <p class="genTitle1">Your curriculum Vitae</p>
                        
                            <p class="genTxt">
                                Let your clients know more about you.
                            </p>
                        
                            <div class="file-field input-field" id="genUploadFavIconDiv" v-if="bio.CV == null">
                                <a class="waves-effect waves-light btn modal-trigger" href="#cvModal">Let us get to know you more</a>

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
                        
                            <div>
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
                            </div>
                        </div>

                        <div class="col s5">
                            <img src="/media/img/editWebsiteSettings/fullnameCv.png" alt="fullnameCv.png" class="editWebIllustrativeImg" width="420" height="300">
                        </div>
                    </div>
                    
                    <div class="genBottomBtnDiv">
                        <a href="#" class="goBackBtn" @click="bioGoBackBtn3()">GO BACK</a>
                    
                        <button type="button" class="btn right" id="genNextBtn" @click="servicesLink()">
                            NEXT STEP
                        </button>
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
</style>
<script>
import CVModalComponent from './CVModalComponent.vue';
    export default {
    components: { CVModalComponent },
        props: ["user", "bioModal", "bioModal1", "bioModal2", "bioModal3", "saved", 'loading'],
        data() {
            return {
                bio: {
                    photo: null,
                    about: "",
                    firstname: this.user.firstname,
                    lastname: this.user.lastname,
                    CV: null,
                },
                uploaded: null,
                uploadedfile: null,
                bioeErrors: false,
            };
        },
        computed: {
            aboutCount() {
                return this.bio.about.length;
            },
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
                if (!e.target.files.length) return;
                this.bio.photo = e.target.files[0];
                this.uploaded = URL.createObjectURL(e.target.files[0]);
            },
            CVUpload(e) {
                if (!e.target.files.length) return;
                this.bio.CV = e.target.files[0];
                this.uploadedfile = e.target.files[0].name;
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
                if (this.bio.oldPhoto && this.bio.oldCV) {
                    data = { ...data, ...this.bio };
                }
                if (this.bio.oldPhoto) {
                    let toSend = {
                        firstname: this.bio.firstname,
                        lastname: this.bio.lastname,
                        about: this.bio.about,
                        photo: this.bio.photo,
                        id: this.bio.id,
                    };
                    data = { ...data, ...toSend };
                }
                if (this.bio.oldCV) {
                    let toSend = {
                        firstname: this.bio.firstname,
                        lastname: this.bio.lastname,
                        about: this.bio.about,
                        CV: this.bio.CV,
                        id: this.bio.id,
                    };
                    data = { ...data, ...toSend };
                } else {
                    let detail = {
                        firstname: this.bio.firstname,
                        lastname: this.bio.lastname,
                        about: this.bio.about,
                        id: this.bio.id,
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
                    this.bio.about = newVal.about;
                    this.bio.id = newVal.id;
                    this.bio.firstname = newVal.firstname;
                    this.bio.lastname = newVal.lastname;
                    this.bio.CV = newVal.CV;
                }
            },
        },
    };
</script>