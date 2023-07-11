<template>
    <div>
        <div class="row noMarginBottom" id="bioSettings">
            <div class="col l6 s12 optionSettingBackground">
                <p @click="$emit('backToSettings')">
                    <a class="btn-flat"><i class="material-icons left">chevron_left</i>Back</a>
                </p>
                <h5>
                    {{modalTitle}}
                </h5>
            </div>
            <div class="col l6 optionSettingContainer">
                <div class="row hPadding-1">
                    <h4 class="settingOptionSectionTitle col l12 noMarginBottom">Basic</h4>
                    <div class="formInnerDiv">
                        <div class="input-field selectInputField col l12 m12 s12 paddingLeftSM">
                            <select
                                required
                                class="browser-default"
                                id="userTitle"
                                data-label="true"
                                v-model="bio.title_id"
                            >
                                <option
                                    :value="''"
                                    disabled
                                    selected
                                >
                                    Pick Title
                                </option>
                                <option
                                    v-for="title in titles"
                                    :key="title.id"
                                    :value="title.id"
                                >
                                    {{ title.name }}
                                </option>
                            </select>
                            <label>Title</label>
                        </div>

                        <div class="input-field selectInputField col l12 m12 s12 paddingLeftSM">
                            <select
                                required
                                class="browser-default"
                                id="userGender"
                                data-label="true"
                                v-model="bio.gender"
                            >
                                <option
                                    :value="''"
                                    disabled
                                    selected
                                >
                                    Select Gender
                                </option>
                                <option
                                    v-for="gender in genders"
                                    :key="gender.value"
                                    :value="gender.value"
                                >
                                    {{ gender.name }}
                                </option>
                            </select>
                            <label>Gender</label>
                        </div>

                        <div class="input-field col l12">
                            <input
                                type="text"
                                class="validate formInput"
                                required
                                placeholder="Firstname"
                                id="firstname"
                                v-model="bio.firstname"
                                @keyup="validateFirstname"
                            />
                            <label>Firstname</label>
                        </div>
                        <div class="input-field col l12 m12 s12">
                            <input
                                type="text"
                                class="validate"
                                placeholder="Lastname"
                                id="lastname"
                                v-model="bio.lastname"
                                @keyup="validateLastname"
                            />
                            <label>Lastname</label>
                        </div>
                        <div class="input-field col l12 m12 s12">
                            <input
                                type="text"
                                class="validate"
                                placeholder="Othernames"
                                data-optional="true"
                                v-model="bio.othername"
                                id="othername"
                            />
                            <label>Othername</label>
                        </div>
                    </div>
                </div>
                <div class="row hPadding-1">
                    <h4 class="settingOptionSectionTitle col l12 noMarginBottom">Website Title</h4>
                    <div class="input-field col l12">
                        <input @keyup="validateGeneralTitle" v-model="general.title" placeholder="Dr. Olivia Felix" id="websiteTitle" type="text" class="validate formInput">
                        <label for="websiteTitle">Website title</label>
                    </div>
                </div>

                <!--TODO: Image cropper doesnt work-->
                <div class="row hPadding-1" id="forFavicon">
                    <h4 class="settingOptionSectionTitle col l12 noMarginBottom">Site logo (favicon)</h4>
                    <div v-show="showCropperForGeneral" class="cFlex flexRight">
                        <a class="right" href="#" @click="showCropperForGeneral = false">
                            <i class="material-icons priText">clear</i>
                        </a>
                    </div>

                    <div class="settingImgContainer" v-if="!showCropperForGeneral">
                        <!--img
                            :src="
                                typeof bio.photo === 'string'
                                    ? '/media/tenants/' +
                                    tenantId +
                                    '/img/' +
                                    bioData.photo
                                    : uploaded
                            "
                            :alt="bioData.firstname + ' avatar'"
                            class="settingImg"
                            v-if="
                                bioData.photo !== null ||
                                uploaded !== null
                            "
                        /-->
                        <img
                            class="settingImg"
                            src="/media/img/templates/1/favPlaceholder.png"
                            v-if="general.favicon == null"
                        />
                        <img v-if="faviconUploaded !== null" class="settingImg" :src="general.favicon"/>
                        <img v-else-if="faviconUploaded === null && general.favicon != null" class="settingImg" :src="'/media/tenants/'+tenant+'/img/'+general.favicon"/>
                    </div>
                    <form enctype="multipart/form-data">
                        <div class="settingImgBtnMainDiv">
                            <div class="settingImgBtnContainDiv justify-center">
                                <div class="" id="genUploadFavIconDiv">
                                    <div class="" v-if="!uploadGeneralProcessing">
                                        <div class="col l12 center-align marginTop-5">
                                            <button
                                                href="#"
                                                role="button"
                                                @click.prevent="
                                                    showFileChooserGeneral
                                                "
                                                v-if="!showCropperForGeneral"
                                                class="btn btn-flat"
                                            ><i class="material-icons">file_upload</i>
                                            </button>
                                        </div>
                                        <div class="row">
                                            <div class="col s12">
                                                <!-- <ImageCropperVue
                                                    v-if="showCropperForGeneral"
                                                    :height="50"
                                                    :width="50"
                                                    :minContainerHeight="250"
                                                    :minContainerWidth="250"
                                                    :img="'/media/img/templates/1/favPlaceholder.png'"
                                                    @uploadPhoto="
                                                        faviconUpload(
                                                            $event
                                                        )
                                                    "
                                                /> -->
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <p v-else class="center-align">
                                        Uploading Image<i
                                            class="fas fa-circle-notch fa-spin"
                                        ></i>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!--TODO: Image cropper doesnt work-->
                <div class="row hPadding-1" id="forPhoto">
                    <h4 class="settingOptionSectionTitle col l12 noMarginBottom">Profile Picture</h4>
                    <div v-show="showCropper" class="cFlex flexRight">
                        <a class="right" href="#" @click="showCropper = false">
                            <i class="material-icons priText">clear</i>
                        </a>
                    </div>

                    <div class="settingImgContainer" v-if="!showCropper">
                        <!--img
                            :src="
                                typeof bio.photo === 'string'
                                    ? '/media/tenants/' +
                                    tenantId +
                                    '/img/' +
                                    bioData.photo
                                    : uploaded
                            "
                            :alt="bioData.firstname + ' avatar'"
                            class="settingImg"
                            v-if="
                                bioData.photo !== null ||
                                uploaded !== null
                            "
                        /-->
                        <img
                            class="settingImg"
                            src="/media/img/templates/1/physicianHero.png"
                            v-if="bio.photo == null"
                        />
                        <img v-if="bioUploaded != null" class="settingImg" :src="bioUploaded"/>
                        <img v-else-if="bioUploaded === null && bio.photo != null" class="settingImg" :src="'/media/tenants/'+tenant+'/img/'+bio.photo"/>
                    </div>
                    <form enctype="multipart/form-data">
                        <div class="settingImgBtnMainDiv">
                            <div class="settingImgBtnContainDiv justify-center">
                                <div class="" id="genUploadFavIconDiv">
                                    <div class="" v-if="!uploadPhotoProcessing">
                                        <div class="col l12 center-align marginTop-5">
                                            <button
                                                href="#"
                                                role="button"
                                                @click.prevent="
                                                    showFileChooser
                                                "
                                                v-if="!showCropper"
                                                class="btn btn-flat"
                                            >
                                                <!--span
                                                    v-if="
                                                        bioData.photo !==
                                                            null ||
                                                        uploaded !== null
                                                    "
                                                    >
                                                        <i class="material-icons white-text">edit</i>
                                                    </span-->
                                                    <i class="material-icons">file_upload</i>
                                            </button>
                                        </div>
                                        <div class="row">
                                            <div class="col s12">
                                                <ImageCropperVue
                                                    v-if="showCropper"
                                                    :height="256" :width="225"
                                                    :minContainerHeight="250"
                                                    :minContainerWidth="250"
                                                    :img="'/media/img/templates/1/physicianHero.png'"
                                                    @uploadPhoto="
                                                        updatePhoto(
                                                            $event
                                                        )
                                                    "
                                                />
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <p v-else class="center-align">
                                        Uploading Image<i
                                            class="fas fa-circle-notch fa-spin"
                                        ></i>
                                    </p>
                                </div>
                            </div>
                            <!--div
                                class="proImgInstructDiv"
                                v-show="!showCropper"
                            >
                                <p class="proImgInstruct">
                                    The image should be greater than
                                    451px width and 512px height
                                </p>
                            </div-->
                        </div>
                    </form>
                </div>

                <div class="row hPadding-1 center-align">
                    <button class="btn saveSettingBtn" @click="saveAndBack">
                        <i class="fas fa-circle-notch fa-spin" v-if="loading"></i>
                        <span v-else>Save &amp; Back</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
// import ImageCropperVue from '../../../../../../partials/ImageCropper.vue';
export default {
    components: {
        // ImageCropperVue,
    },
    data() {
        return {
            // bios: {
            //     firstname: "",
            //     lastname: "",
            //     othername: "",
            //     title_id: "",
            //     photo: null
            // },
            bioUploaded: null,
            bioUpdate: 1,
            errors: [],
            genders: [
                {
                    name: 'Male - He/His',
                    value: 'M'
                },
                {
                    name: 'Female - She/Her',
                    value: 'F'
                },
                {
                    name: 'Others - They/Them',
                    value: 'O'
                },
            ],
            general: {
                favicon: null,
                title: "",
            },
            generalUpdate: 0,
            loading: false,
            titles: [],
            faviconUploaded: null,
            uploadFavLoading: false,
            uploadGeneralProcessing: false,
            uploadPhotoProcessing: false,
            showCropper: false,
            showCropperForGeneral: false
        }
    },
    methods: {
        faviconUpload(e) {
            this.errors = [];
            this.uploadGeneralProcessing = !this.uploadGeneralProcessing;
            this.general.favicon = e;
            let formData = new FormData();
            formData.append("favicon", this.general.favicon);
            let request = this.generalUpdate === 1 ? `/api/general/${this.general.id}` : '/api/general';
            this.generalUpdate === 1 ? formData.append('_method', 'PUT') : null;
            axios
                .post(request, formData)
                .then((res) => {
                    if (res.data.status === 200) {
                        M.toast({
                            html: res.data.message,
                            classes: "successNotifier",
                        });
                        this.uploadGeneralProcessing = !this.uploadGeneralProcessing;
                        this.generalUpdate = 1;
                        this.general.id = res.data.general.id;
                        this.showCropperForGeneral = false;
                        this.faviconUploaded = e;
                    }
                })
                .catch((err) => {
                    this.uploadGeneralProcessing = !this.uploadGeneralProcessing;
                    if (err.response.status == 400) {
                        this.loading = !this.loading;
                        this.errors = err.response.data;
                    }
                });
        },
        generalSaveUpdate(){
            this.loading = !this.loading;
            let formData = new FormData();
            formData.append("title", this.general.title);
            let request = this.generalUpdate === 1 ? `/api/general/${this.general.id}` : '/api/general';
            this.generalUpdate === 1 ? formData.append('_method', 'PUT') : null;
            axios
                .post(request, formData)
                .then((res) => {
                    if (res.data.status === 200) {
                        M.toast({
                            html: res.data.message,
                            classes: "successNotifier",
                        });
                        this.loading = false;
                        return true;
                    }
                })
                .catch((err) => {
                    this.loading = false;
                    if (err.response.status == 400) {
                        this.loading = !this.loading;
                        this.errors = err.response.data;
                    }
                });
        },
        getSavedFavNTitle() {
            axios.get('/api/general').then(res => {
                if (res.data.general !== null) {
                    this.general = res.data.general;
                    this.generalUpdate = 1;
                }
            }).catch(err => {
                console.log(err);
            })
        },
        getTitle() {
            axios.get("https://whitecoatdomain.com/api/title").then(res => {
                this.titles = res.data.titles;
            }).catch(err => {
                console.log(err);
            })
        },
        saveAndBack() {
            if (this.switchForInputs()) {
                try {
                    // For BIO
                    this.loading = true;
                    let bioFormData = new FormData();
                    bioFormData.append('firstname', this.bio.firstname);
                    bioFormData.append('lastname', this.bio.lastname);
                    bioFormData.append('gender', this.bio.gender);
                    bioFormData.append('title_id', this.bio.title_id);
                    let bioRequest = this.bioUpdate === 1 ? `/api/bio/${this.bio.id}` : '/api/bio';
                    this.bioUpdate === 1 ? bioFormData.append('_method', 'PUT') : null;
    
                    // For WebsiteTitle
                    let formData = new FormData();
                    formData.append("title", this.general.title);
                    let request = this.generalUpdate === 1 ? `/api/general/${this.general.id}` : '/api/general';
                    this.generalUpdate === 1 ? formData.append('_method', 'PUT') : null;
                    
                    axios.all([
                        axios.post(`http://127.0.0.1:8000/api/updateUser/${this.userID}`, bioFormData),
                        // axios.post(`https://whitecoatdomain.com/api/updateUser/${this.userID}`, bioFormData),
                        axios.post(bioRequest, bioFormData), 
                        axios.post(request, formData),
                    ]).then(axios.spread((bio, general, user) => {
                        if (bio.data.status === 200 || bio.data.status === 201) {
                            M.toast({
                                html: bio.data.message,
                                classes: "successNotifier",
                            });
                            this.$emit('backToSettings');
                        }
                        console.log('data1', bio, 'data2', general, user)
                    })).catch(error => {
                        this.loading = false;
                        console.log(error);
                        if (error.response.status == 400) {
                            this.loading = !this.loading;
                            this.errors = error.response.data;
                        }
                    });
                } catch (error) {
                    console.log(erorr);
                }
            }
        },
        showFileChooserGeneral() {
            this.showCropperForGeneral = true;
            this.uploadGeneralProcessing = false;
        },
        showFileChooser() {
            this.showCropper = true;
            this.uploadPhotoProcessing = false;
        },
        switchForInputs() {
            if (this.validatePhotoImage() && this.validateFavicon() && this.validateGeneralTitle() && this.validateTitle() && this.validateLastname() && this.validateFirstname()) {
                return true;
            }
            return false;
        },
        updatePhoto(e) {
                this.errors = [];
                this.uploadPhotoProcessing = true;
                let formData = new FormData();
                formData.append('photo', e);
                this.bioUpdate === true ? formData.append('_method', 'PUT') : null;
                let request = this.bioUpdate === true ? `/api/bio/${this.bio.id}` : '/api/bio';
                axios.post(request, formData).then(res => {
                    if (res.data.status === 200 || res.data.status === 201) {
                        M.toast({
                            html: res.data.message,
                            classes: "successNotifier",
                        });
                        this.photo = {};
                        this.bioUploaded = e;
                        this.uploadPhotoProcessing = false;
                        this.showCropper = false;
                    }
                }).catch(err => {
                    if (err.response.status === 400) {
                        this.errors = err.response.data;
                    }
                    this.uploadPhotoProcessing = false;
                    console.log(err);
                })

        },
        updateBio() {
            this.loading = true;
            let formData = new FormData();
            formData.append('firstname', this.bio.firstname);
            formData.append('lastname', this.bio.lastname);
            formData.append('gender', this.bio.gender);

            let request = this.bioUpdate === 1 ? `/api/bio/${this.bio.id}` : '/api/bio';
            this.bioUpdate === 1 ? formData.append('_method', 'PUT') : null;
            axios
            .post(request, formData)
            .then((res) => {
                if (res.data.status === 200 || res.data.status === 201) {
                    M.toast({
                        html: res.data.message,
                        classes: "successNotifier",
                    });
                    this.loading = false;
                    return true;
                }
            })
            .catch((err) => {
                this.loading = false;
                console.log(err);
            });
        },
        validatePhotoImage () {
            let tag = document.querySelectorAll('#bioSettings #forPhoto .settingOptionSectionTitle')[0];
            if (this.bio.photo == null) {
                tag.style.color = 'red'
                document.querySelector('#bioSettings .optionSettingContainer').scrollTop = 125;
                return false;
            } else {
                tag.style.color = 'unset'
                return true;
            }
        },
        validateFavicon () {
            let tag = document.querySelectorAll('#bioSettings #forFavicon .settingOptionSectionTitle')[0];
            if (this.general.favicon == null) {
                tag.style.color = 'red'
                document.querySelector('#bioSettings .optionSettingContainer').scrollTop = 110;
                return false;
            } else {
                tag.style.color = 'unset'
                return true;
            }
        },
        validateTitle () {
            let input = document.getElementById('userTitle');
            if (this.bio.title_id == '') {
                input.nextElementSibling.style.color = 'red';
                input.style.borderBottomColor = 'red'
                document.querySelector('#bioSettings .optionSettingContainer').scrollTop = 0;
                return false;
            }
            else {
                input.nextElementSibling.style.color = 'unset';
                input.style.borderBottomColor = 'unset'
                return true;
            }
        },
        validateGeneralTitle () {
            let input = document.getElementById('websiteTitle');
            if (this.general.title == '') {
                input.nextElementSibling.style.color = 'red';
                input.style.borderBottomColor = 'red'
                document.querySelector('#bioSettings .optionSettingContainer').scrollTop = 105;
                return false;
            }
            else {
                input.nextElementSibling.style.color = 'unset';
                input.style.borderBottomColor = 'unset'
                return true;
            }
        },
        validateFirstname () {
            let input = document.getElementById('firstname');
            if (this.bio.firstname == '') {
                input.nextElementSibling.style.color = 'red';
                input.style.borderBottomColor = 'red'
                document.querySelector('#bioSettings .optionSettingContainer').scrollTop = 0;
                return false;
            }
            else {
                input.nextElementSibling.style.color = 'unset';
                input.style.borderBottomColor = 'unset'
                return true;
            }
        },
        validateLastname () {
            let input = document.getElementById('lastname');
            if (this.bio.lastname == '') {
                input.nextElementSibling.style.color = 'red';
                input.style.borderBottomColor = 'red'
                document.querySelector('#bioSettings .optionSettingContainer').scrollTop = 50;
                return false;
            }
            else {
                input.nextElementSibling.style.color = 'unset';
                input.style.borderBottomColor = 'unset'
                return true;
            }
        },
    },
    mounted() {
        this.getTitle();
        this.getSavedFavNTitle();
    },
    props: {
        modalTitle: String,
        modalView: Number,
        tenant: String,
        bio: Object,
        userID: Number
    }
}
</script>