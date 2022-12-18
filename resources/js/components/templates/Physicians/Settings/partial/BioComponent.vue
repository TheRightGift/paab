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
                        catchy. Not more than (614) characters.
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
                    >
                        <input
                            type="file"
                            @change="photoUpload"
                            accept="image/*"
                        />
                        <div class="file-path-wrapper">
                            <input
                                class="file-path validate"
                                type="text"
                                id="genInput1"
                            />
                            <i class="material-icons" id="genUploadFavIcon"
                                >file_upload</i
                            >
                        </div>
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
                        >
                        <!-- v-if="bio.CV == null" -->
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
                            />
                            <i class="material-icons" id="genUploadFavIcon"
                                >file_upload</i
                            >
                        </div>
                    </div>
                    <!-- <div v-else class="flex no-space-between">
                        <p>{{}}</p>
                        <img width="100" height="100" class="responsive-img" :src="typeof(general.favicon) == 'string' ? 'tenancy/assets/'+general.favicon : uploaded" >
                        <a class="waves-effect waves-light btn-small btn red" @click="deleteImg">Change</a>
                    </div> -->

                    <div>
                        <button
                            type="button"
                            class="btn"
                            id="genModalBtn"
                            @click.prevent="bioSave"
                            v-if="Object.entries(saved).length == 0"
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
        }
    },
    methods: {
        photoUpload(e) {
            if (!e.target.files.length) return;
            this.bio.photo = e.target.files[0];
        },
        CVUpload(e) {
            if (!e.target.files.length) return;
            this.bio.CV = e.target.files[0];
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
            this.$emit('bioSave', this.bio);
        }
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