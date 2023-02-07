<template>
    <div id="templateAbout">
        <div class="row">
            <div class="col s12 rm_mg_pd">
                <div class="section scrollspy physiContainerDiv" id="about">
                    <div v-if="bio === null && preview === '1'">
                        <div class="row about">
                            <div class="col s12 m6 l6 profileDesc">
                                <div class="containerDiv">
                                    <h3 class="physiTempName">
                                        Hi, I'm
                                        <br />
                                        Dr Chidinma Felix
                                        <span
                                            class="primaryColorBoxDesign"
                                        ></span>
                                    </h3>

                                    <p class="physiSummaryTxt">
                                        Dr. John Doe is an expert in Aestheistiologist with an M.D. from Pittsburgh School of Medicine and an undergraduate degree in Sociology from the University of Michigan- Ann Arbor.
                                        She started out as an intern at the UPMC Shadyside hospital, then proceeded to Brigham and Women’s Hospital for her residency.
                                        With more than 10 years of experience as an anaesthesiologist, she has dedicated years to patient care throughout every surgical experience.
                                    </p>
                                    <p class="center-align">
                                        <a href="#cvDetails" class="physiTempBtn waves-effect waves-light modal-trigger">
                                            View My curriculum vitae
                                        </a>
                                    </p>

                                </div>
                            </div>

                            <div class="col s12 m6 l6 profileImgContainer">
                                <!-- offset-l3 media/img/doc.png-->
                                <div class="profileImg" v-if="preview === '0'">
                                    <img
                                        src="'media/img/surgeonhero.png'"
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
                    </div>
                    <div v-else-if="bio !== null">
                        <div class="row about">
                            <div class="col s12 m6 l6 profileDesc">
                                <div class="containerDiv">
                                    <h3 class="physiTempName">
                                        <span>
                                            Hi, I’m
                                            <br />
                                            {{ title }} {{ bio.firstname }}
                                            {{ bio.lastname }}
                                            <span
                                                class="primaryColorBoxDesign"
                                            ></span>
                                        </span>
                                        <span class="hide-on-large-only physiTempNameEdit">
                                            <!-- About WriteUp Modal Trigger -->
                                            <a class="modal-trigger aboutWriteUpsEditBtn" href="#aboutWriteUpsEditModal" v-if="isLoggedIn">
                                                <i class="material-icons editIcon">edit</i>
                                            </a>
                                        </span>
                                    </h3>

                                    <p class="physiSummaryTxt">
                                        {{ bio.about }}
                                    </p>

<!--                                    <p class="center-align">-->
<!--                                        <a href="#cvDetails" class="physiTempBtn waves-effect waves-light modal-trigger">-->
<!--                                            View My curriculum vitae-->
<!--                                        </a>-->
<!--                                    </p>-->

<!--                                    <div class="hide-on-large-only">-->
<!--                                        &lt;!&ndash; About WriteUp Modal Trigger &ndash;&gt;-->
<!--                                        <a class="modal-trigger aboutWriteUpsEditBtn" href="#aboutWriteUpsEditModal" v-if="isLoggedIn">-->
<!--                                            <i class="material-icons editIcon">edit</i>-->
<!--                                        </a>-->
<!--                                    </div>-->
                                </div>
                            </div>

                            <div class="col s12 m6 l6 profileImgContainer">
                                <!-- offset-l3 media/img/doc.png-->
                                <div class="profileImg" v-if="preview === '0' && bio !== null">
                                    <img
                                        :src="typeof about.photo == 'string'
                                            ? '/media/tenants/'+tenant+'/img/'+ about.photo
                                                : uploaded == null ? '/media/tenants/'+tenant+'/img/'+ bio.photo : uploaded"
                                        alt="doc.png"
                                        class="responsive-img physiRightImg"
                                    />

                                    <div class="hide-on-large-only">
                                        <!-- About Edit Img Modal Trigger -->
                                        <a class="modal-trigger aboutImgEditBtn" href="#aboutImgEditModal" v-if="isLoggedIn">
                                            <i class="material-icons editIcon">edit</i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- About Edit Img Modal Structure -->
        <div id="aboutImgEditModal" class="modal">
            <div class="modal-content">
                <div class="aboutImgEditModalInnerDiv">
                    <a href="#!" class="modal-close editImgModalCloseBtn">
                        <i class="material-icons">keyboard_arrow_left</i>
                    </a>
                    <form enctype="multipart/form-data">
                        <div class="aboutImgModalDiv" v-if="isLoggedIn">
                            <img
                                alt="doc.png" class="responsive-img aboutImgModal"
                                :src="
                                    typeof about.photo == 'string'
                                    ? '/media/tenants/'+tenant+'/img/'+ about.photo
                                        : uploaded == null ? '/media/tenants/'+tenant+'/img/'+ bio.photo : uploaded
                                "
                            />
                        </div>
                        <div class="editImgChangeBtnDiv">
                            <input type="file" id="actual-btn" hidden @change="photoUpload" accept=".jpg, .png"/>

                            <!--our custom file upload button-->
                            <div class="centered">
                                <div v-if="errors.length > 0" >
                                    <p class="error" v-for="(error, index) in errors" :key="index">{{error}}</p>
                                </div>
                                <div>
                                    <label for="actual-btn" class="editImgChangeBtn" v-if="!loading">Change Image</label>
                                    <p v-else>Uploading image <i class="fas fa-spinner fa-spin"></i></p>
                                </div>
                            </div>
                        </div>
                        <p class="aboutImgSize">The Image should be 451px width and 512px height and .jpg oR .png</p>
                    </form>
                </div>
            </div>
        </div>

        <!-- About WriteUp Modal Structure -->
        <div id="aboutWriteUpsEditModal" class="modal">
            <div class="modal-content">
                <div class="aboutWriteUpsEditModalInnerDiv">
                    <a href="#!" class="modal-close editWriteUpsModalCloseBtn">
                        <i class="material-icons">keyboard_arrow_left</i>
                    </a>
                        <div class="row rm_mg">
                            <div class="input-field col s12">
                                <input type="text" v-model="about.name" class="validate aboutWriteUpsInput">
                            </div>
                            <div class="input-field col s12 rm_mg">
                                <textarea class="materialize-textarea aboutWriteUpsInput" v-model="about.about" maxlength="614"></textarea>
                                <p class="right m-0 " :class="{redColor: aboutCount <= 599, successColor: aboutCount >= 614}">
                                    {{aboutCount}}/614
                                </p>
                            </div>
                        </div>
                    <p class="aboutWriteUpsSize">Description should not be more than 600 characters</p>
                    <div class="editWriteUpsSaveBtnDiv">
                        <a href="#" class="editWriteUpsSaveBtn" @click.prevent="updateAbout" v-if="!loading">
                            Save
                        </a>
                        <a href="#" class="editWriteUpsSaveBtn" v-else>
                            <i class="fas fa-spinner fa-spin"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- For CV MODAL DETAILS -->
        <div id="cvDetails" class="modal">
            <div class="modal-content">
                <i class="material-icons right modal-close">close</i>
                <!-- <h4>{{}}</h4>
                <p>A bunch of text</p> -->
                <p class="text-center"><strong>Curriculum Vitae is still in development mode, please check back later. Thanks</strong></p>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    computed: {
        aboutCount() {
            return this.about.about != null ?  this.about.about.length : "";
        },
    },
    data() {
        return {
            about: {
                about: "",
                name: "",
                photo: null,
            },
            errors: [],
            loading: false,
            uploaded: null,
            txt: 'Sed porttitor lectus nibh. Proin eget tortor risus. Curabitur aliquet quam id dui posuere blandit. Vestibulum ante ipsum primis Pellentesque in ipsum id orci porta dapibus. Nulla porttitor accumsan tincidunt. Curabitur arcu erat'
        };
    },
    methods: {
        photoUpload(e) {
            this.errors = [];
            if (!e.target.files.length) return;
            this.about.photo = e.target.files[0];
            this.loading = !this.loading;
            let formData = new FormData();
            formData.append("photo", this.about.photo);
            formData.append("_method", 'PUT');
            axios
                .post(`/api/bio/${this.bio.id}`, formData)
                .then((res) => {
                    if (res.data.status == 200) {
                        M.toast({
                            html: res.data.message,
                            classes: "successNotifier",
                        });
                        this.loading = !this.loading;
                        this.uploaded = URL.createObjectURL(e.target.files[0]);
                    }
                })
                .catch((err) => {
                    this.loading = !this.loading;
                    if (err.response.status == 400) {
                        this.errors = err.response.data;
                    }
                });
        },
        updateAbout() {
            this.loading = !this.loading;
            let formData = new FormData();
            formData.append("firstname", this.about.name.split(" ")[0]);
            formData.append("othername", this.about.name.split(" ")[2]);
            formData.append("lastname", this.about.name.split(" ")[1]);
            formData.append("about", this.about.about);
            formData.append("_method", 'PUT');
            axios
                .post(`/api/bio/${this.bio.id}`, formData)
                .then((res) => {
                    if (res.data.status == 200) {
                        M.toast({
                            html: res.data.message,
                            classes: "successNotifier",
                        });
                        this.loading = !this.loading;
                    }
                })
                .catch((err) => {
                    this.loading = !this.loading;
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
    props: {
        bio: Object,
        user: String,
        services: Array,
        location: String,
        preview: String,
        title: String,
        tenant: String,
        isLoggedIn: Boolean,
    },
    watch: {
        bio(newval, oldval) {
            if (newval) {
                this.about.name = newval.firstname+' '+newval.lastname+' '+newval.othername;
                this.about.about = newval.about;
                this.about.photo = newval.photo;
            }
        }
    },
    };
</script>
<style lang="scss" scoped>
label {
    background-color: var(--primary);
    color: white;
    padding: 0.3rem;
    font-family: inherit;
    cursor: pointer;
}
@media only screen
and (min-width: 1370px)
and (max-width: 1605px)
{ /* STYLES GO HERE */
    .physiRightImg {
        height: 501.5px;
        width: 445.93px;
    }
}
.physiRightImg {
        position: unset;
}
.physiTempBtn:hover {
    text-decoration: none;
}
.containerDiv {
    position: relative;
}
</style>
