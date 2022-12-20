<template>
    <div>
        <div class="bioModalDiv" v-if="bioModal">
            <div class="editInnerGenModal">
                <div class="genTitleDiv">
                    <i
                        class="material-icons"
                        id="genTitleCheck"
                        v-if="bio.firstname != ''"
                        >check</i
                    >
                    <p class="genTitle">Full Name</p>

                    <i
                        class="material-icons"
                        id="genTitleCheck1"
                        v-if="bio.about != ''"
                        >check</i
                    >
                    <p class="genTitle">Description</p>

                    <i
                        class="material-icons"
                        id="genTitleCheck2"
                        v-if="bio.photo != null"
                        >check</i
                    >
                    <p class="genTitle">Upload Photo</p>

                    <i
                        class="material-icons"
                        id="genTitleCheck3"
                        v-if="bio.CV != null"
                        >check</i
                    >
                    <p class="genTitle">Upload Curriculum</p>
                </div>

                <div>
                    <p class="genTitle1">Provide your full name</p>

                    <p class="genTxt">
                        Lorem Ipsum is simply dummy text of the printing and
                        typesetting industry.
                    </p>

                    <div class="input-field">
                        <input
                            type="text"
                            v-model="bio.lastname"
                            placeholder="Last Name"
                            id="bioInput"
                        />
                    </div>

                    <div class="input-field">
                        <input
                            type="text"
                            v-model="bio.firstname"
                            placeholder="First Name"
                            id="bioInput1"
                        />
                    </div>

                    <!-- <div>
                            <button type="button" class="btn" id="genModalBtn">
                                save
                            </button>
                        </div> -->

                    <div class="genBottomBtnDiv">
                        <a href="#" class="goBackBtn" @click="bioGoBackBtn()"
                            >GO BACK</a
                        >

                        <button
                            type="button"
                            class="btn right"
                            id="genNextBtn"
                            @click="bioNextBtn()"
                        >
                            NEXT STEP
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bio Modal 1 -->
        <div class="bioModalDiv" v-if="bioModal1">
            <div class="editInnerGenModal">
                <div class="genTitleDiv">
                    <i
                        class="material-icons"
                        id="genTitleCheck"
                        v-if="bio.firstname != ''"
                        >check</i
                    >
                    <p class="genTitle">Full Name</p>

                    <i
                        class="material-icons"
                        id="genTitleCheck1"
                        v-if="bio.about != ''"
                        >check</i
                    >
                    <p class="genTitle">Description</p>

                    <i
                        class="material-icons"
                        id="genTitleCheck2"
                        v-if="bio.photo != null"
                        >check</i
                    >
                    <p class="genTitle">Upload Photo</p>

                    <i
                        class="material-icons"
                        id="genTitleCheck3"
                        v-if="bio.CV != null"
                        >check</i
                    >
                    <p class="genTitle">Upload Curriculum</p>
                </div>

                <div>
                    <p class="genTitle1">About You</p>

                    <p class="genTxt">
                        Readers only looks at vital info about you, so make it
                        catchy. Not more than (614) and not less than (600) characters.
                    </p>

                    <div class="input-field">
                        <textarea
                            v-model="bio.about"
                            id="bioDescribeInput"
                            class="materialize-textarea"
                            placeholder="Me"
                            maxlength="614"
                        ></textarea>
                    </div>

                    <!-- <div>
                            <button type="button" class="btn" id="genModalBtn">
                                save
                            </button>
                        </div> -->

                    <div class="genBottomBtnDiv">
                        <a href="#" class="goBackBtn" @click="bioGoBackBtn1()"
                            >GO BACK</a
                        >

                        <button
                            type="button"
                            class="btn right"
                            id="genNextBtn"
                            @click="bioNextBtn1()"
                        >
                            NEXT STEP
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bio Modal 2 -->
        <div class="bioModalDiv" v-if="bioModal2">
            <div class="editInnerGenModal">
                <div class="genTitleDiv">
                    <i
                        class="material-icons"
                        id="genTitleCheck"
                        v-if="bio.firstname != ''"
                        >check</i
                    >
                    <p class="genTitle">Full Name</p>

                    <i
                        class="material-icons"
                        id="genTitleCheck1"
                        v-if="bio.about != ''"
                        >check</i
                    >
                    <p class="genTitle">Description</p>

                    <i
                        class="material-icons"
                        id="genTitleCheck2"
                        v-if="bio.photo != null"
                        >check</i
                    >
                    <p class="genTitle">Upload Photo</p>

                    <i
                        class="material-icons"
                        id="genTitleCheck3"
                        v-if="bio.CV != null"
                        >check</i
                    >
                    <p class="genTitle">Upload Curriculum</p>
                </div>

                <div>
                    <p class="genTitle1">Upload a clear picture of you</p>

                    <p class="genTxt">
                        Lorem Ipsum is simply dummy text of the printing and
                        typesetting industry.
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
                                class="file-path validate"
                                type="text"
                                id="genInput1"
                                placeholder="Image must be .jpg/.png and not greater than 1MB(500x500)"
                            />
                            <i class="material-icons" id="genUploadFavIcon"
                                >file_upload</i
                            >
                        </div>
                    </div>
                    <div v-else class="flex no-space-between">
                        <img width="100" height="100" class="responsive-img" :src="typeof(bio.photo) == 'string' ? 'tenancy/assets/'+bio.photo : uploaded" >
                        <a class="waves-effect waves-light btn-small btn red" @click="deleteImg">Change</a>
                    </div>
                    <!-- <div>
                                <button type="button" class="btn" id="genModalBtn">
                                    Upload
                                </button>
                            </div> -->

                    <div class="genBottomBtnDiv">
                        <a href="#" class="goBackBtn" @click="bioGoBackBtn2()"
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
        </div>

        <!-- Bio Modal 3 -->
        <div class="bioModalDiv" v-if="bioModal3">
            <div class="editInnerGenModal">
                <div class="genTitleDiv">
                    <i
                        class="material-icons"
                        id="genTitleCheck"
                        v-if="bio.firstname != ''"
                        >check</i
                    >
                    <p class="genTitle">Full Name</p>

                    <i
                        class="material-icons"
                        id="genTitleCheck1"
                        v-if="bio.about != ''"
                        >check</i
                    >
                    <p class="genTitle">Description</p>

                    <i
                        class="material-icons"
                        id="genTitleCheck2"
                        v-if="bio.photo != null"
                        >check</i
                    >
                    <p class="genTitle">Upload Photo</p>

                    <i
                        class="material-icons"
                        id="genTitleCheck3"
                        v-if="bio.CV != null"
                        >check</i
                    >
                    <p class="genTitle">Upload Curriculum</p>
                </div>

                <div>
                    <p class="genTitle1">Upload your curriculum Vitae</p>

                    <p class="genTxt">
                        Lorem Ipsum is simply dummy text of the printing and
                        typesetting industry.
                    </p>


                    <div
                        class="file-field input-field"
                        id="genUploadFavIconDiv"
                        v-if="bio.CV == null"
                        >
                        <input
                            type="file"
                            @change="CVUpload"
                            accept="application/msword, application/vnd.ms-powerpoint,application/pdf,"
                        />
                        <div class="file-path-wrapper">
                            <input
                                class="file-path validate"
                                type="text"
                                id="genInput1"
                                placeholder="File must not be more than 2MB"
                            />
                            <i class="material-icons" id="genUploadFavIcon"
                                >file_upload</i
                            >
                        </div>
                    </div>
                    <div v-else class="flex no-space-between">
                        <p>{{ uploadedfile != null ? uploadedfile : bio.CV  }}</p>
                        <a class="waves-effect waves-light btn-small btn red" @click="deleteCV">Change</a>
                    </div>
                    

                    <div>
                        <button
                            type="button"
                            class="btn"
                            id="genModalBtn"
                            @click.prevent="bioSave"
                            v-if="saved == null"
                        >
                            Save
                        </button>
                        <button
                            type="button"
                            class="btn"
                            id="genModalBtn"
                            @click.prevent="bioUpdate"
                            v-else
                        >
                            Update
                        </button>
                        
                    </div>

                    <div class="genBottomBtnDiv">
                        <a href="#" class="goBackBtn" @click="bioGoBackBtn3()"
                            >GO BACK</a
                        >

                        <button
                            type="button"
                            class="btn right"
                            id="genNextBtn"
                            @click="servicesLink()"
                        >
                            NEXT STEP
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['user', 'bioModal', 'bioModal1', 'bioModal2', 'bioModal3', 'saved'],
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
        }
    },
    methods: {
        deleteImg() {
            this.bio.oldPhoto = this.bio.photo;
            this.bio.photo = null;
        },
        deleteCV() {
            this.bio.oldCV= this.bio.CV;
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
        bioGoBackBtn(){
            this.$emit('bioGoBackBtn');
        },
        bioNextBtn(){
            this.$emit('bioNextBtn');
        },
        bioGoBackBtn1() {
            this.$emit('bioGoBackBtn1');
        },
        bioNextBtn1(){
            this.$emit('bioNextBtn1');
        },
        bioGoBackBtn2(){
            this.$emit('bioGoBackBtn2')
        },
        bioNextBtn2(){
            this.$emit('bioNextBtn2');
        },
        bioGoBackBtn3(){
            this.$emit('bioGoBackBtn3');
        },
        servicesLink(){
            this.$emit('servicesLink');
        },
        bioSave() {
            console.log('heree')
            this.$emit('bioSave', this.bio);
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
                }
                data = { ...data, ...toSend };
            }
            if (this.bio.oldCV) {
                let toSend = {
                    firstname: this.bio.firstname,
                    lastname: this.bio.lastname,
                    about: this.bio.about,
                    CV: this.bio.CV,
                    id: this.bio.id,
                }
                data = { ...data, ...toSend };
            }
             else {
                let detail = {
                    firstname: this.bio.firstname,
                    lastname: this.bio.lastname,
                    about: this.bio.about,
                    id: this.bio.id,
                }
                data = { ...data, ...detail };
            }
            this.$emit("bioUpdate", data);
        },
    },
    watch: {
        saved(newVal, oldVal){
            if (newVal != null) {
                this.bio.photo = newVal.photo;
                this.bio.about = newVal.about;
                this.bio.id = newVal.id;
                this.bio.firstname = newVal.firstname;
                this.bio.lastname = newVal.lastname;
                this.bio.CV = newVal.CV;
            }
        }
    },
}
</script>