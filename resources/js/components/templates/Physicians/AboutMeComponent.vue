<template>
    <div id="templateAbout">
        <div class="row">
            <div class="col s12 rm_mg_pd">
                <div class="section scrollspy physiContainerDiv" id="about">
                    <div v-if="preview === '1'">
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
                                            {{ bio.firstname }}
                                            {{ bio.lastname }}({{ title }})
                                            <span
                                                class="primaryColorBoxDesign"
                                            ></span>
                                        </span>
                                        <span class="physiTempNameEdit">
                                            <!-- About WriteUp Modal Trigger -->
                                            <a class="modal-trigger iconBox" href="#aboutWriteUpsEditModal" title="Edit Name and Description" v-if="isLoggedIn">
                                                <i class="material-icons editIcon">edit</i>
                                            </a>
                                        </span>
                                    </h3>

                                    <p class="physiSummaryTxt">
                                        <span v-if="bio.about !== null">{{ bio.about }}</span>
                                        <span v-else>
                                            Dr. {{ user.firstname ?? 'John' }} {{user.lastname ?? 'Doe'}} is an expert in Aestheistiologist with an M.D. from Pittsburgh School of Medicine and an undergraduate degree in Sociology from the University of Michigan- Ann Arbor.
                                            She started out as an intern at the UPMC Shadyside hospital, then proceeded to Brigham and Women’s Hospital for her residency.
                                            With more than 10 years of experience as an anaesthesiologist, she has dedicated years to patient care throughout every surgical experience.
                                        </span>
                                    </p>

                                   <p class="center-align" v-if="CVComponentShow">
                                       <a href="#cvDetails" class="physiTempBtn waves-effect waves-light modal-trigger">
                                           View My curriculum vitae
                                       </a>
                                   </p>

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
                                <div class="profileImg" v-if="bio !== null">
                                    <img
                                        :src="typeof about.photo == 'string'
                                            ? '/media/tenants/'+tenant+'/img/'+ about.photo
                                                : uploaded == null ? '/media/tenants/'+tenant+'/img/'+ bio.photo : uploaded"
                                        alt="doc.png"
                                        class="responsive-img physiRightImg"
                                    />

                                    <div class="">
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
                        <div class="aboutImgModalDiv" v-if="bio !== null ">
                            <img v-if="!showCropper"
                                alt="doc.png" class="responsive-img aboutImgModal"
                                :src="
                                    typeof about.photo == 'string'
                                    ? '/media/tenants/'+tenant+'/img/'+ about.photo
                                        : uploaded == null ? '/media/tenants/'+tenant+'/img/'+ bio.photo : uploaded
                                "
                            />
                            <div v-show="showCropper">
                                <image-cropper :height="512" :width="451" @uploadPhoto="photoUpload($event)" :xAxis="451" :yAxis="512"/>
                            </div>
                        </div>
                        <div class="editImgChangeBtnDiv">
                            <!-- <input type="file" id="actual-btn" hidden @change="photoUpload" accept=".jpg, .png"/> -->

                            <!--our custom file upload button-->
                            <div class="centered">
                                <div v-if="errors.length > 0" >
                                    <p class="error" v-for="(error, index) in errors" :key="index">{{error}}</p>
                                </div>
                                <div>
                                    <label for="actual-btn" class="editImgChangeBtn" v-if="!loading" v-show="!showCropper" @click="showCropper=true">Change Image</label>
                                    <p v-else>Uploading image <i class="fas fa-spinner fa-spin"></i></p>
                                </div>
                                
                            </div>
                        </div>
                        <p class="aboutImgSize" v-show="!showCropper">The Image should be 451px width and 512px height and .jpg oR .png</p>
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
        
        <CVComponent :CV="CV" :contact="contact" :preview="preview" :user="user"/>
    </div>
</template>
<script>
import ImageCropper from '../../partials/ImageCropper.vue';
import CVComponent from './CVComponent.vue';
export default {
    computed: {
        aboutCount() {
            return this.about.about != null ?  this.about.about.length : "";
        },
    },
    components: {
        ImageCropper,
        CVComponent
    },
    data() {
        CVComponent
        return {
            about: {
                about: "",
                name: "",
                photo: null,
            },
            CVComponentShow: false,
            errors: [],
            loading: false,
            uploaded: null,
            showCropper: false,
            txt: 'Sed porttitor lectus nibh. Proin eget tortor risus. Curabitur aliquet quam id dui posuere blandit. Vestibulum ante ipsum primis Pellentesque in ipsum id orci porta dapibus. Nulla porttitor accumsan tincidunt. Curabitur arcu erat'
        };
    },
    methods: {
        photoUpload(e) {
            this.errors = [];
            // if (!e.target.files.length) return;
            // this.about.photo = e.target.files[0];
            this.loading = !this.loading;
            let formData = new FormData();
            formData.append("photo", e);
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
                        this.about.photo = null;
                        this.uploaded = e;
                        this.showCropper = false;
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
            if (this.aboutCount === 614 || this.aboutCount > 600) {
                let formData = new FormData();
                this.loading = !this.loading;
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
            else {
                M.toast({
                    html: 'The about you should be greater than 600 in lenght',
                    classess: 'errorNotifier',
                })
            }
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
        CV: Object,
        contact: Object,
    },
    watch: {
        bio(newval, oldval) {
            if (newval) {
                this.about.name = newval.firstname+' '+newval.lastname+' '+newval.othername;
                this.about.about = newval.about;
                this.about.photo = newval.photo;
            }
        },
        CV(newval, oldval) {
            if (newval.medschool !== null ) { // newval.license !== null && 
                this.CVComponentShow = true;
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
