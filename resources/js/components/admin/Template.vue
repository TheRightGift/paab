<template>
    <div>
        <!-- Sidenav for small devices -->
        <AdminMobileNavComponent />

        <div class="row" id="dashRowDiv">
            <!-- Sidebar for large and medium devices -->
            <side-nav-component />

            <!-- Center Bar Person Div -->
            <div class="col s12 m10 l10">
                <div class="webWhiteDiv1" v-if="view == 0">
                    <a class="waves-effect waves-teal btn" @click="setView(1)"
                        >Create Now
                    </a>

                    <div class="row clientCreatePortInputRowDiv">
                        <div class="userTempMainDiv">
                            <div
                                v-for="(profession, index) in professions"
                                :key="profession.id"
                            >
                                <div
                                    :class="{
                                        selectedUserTempDiv:
                                            index == selectedIndex,
                                    }"
                                    id="userTempDiv"
                                    @click="getTemplates(profession.id, index)"
                                >
                                    <div class="tempImgDiv" id="tempImgDiv">
                                        <span id="tempProIcon">{{
                                            profession.name.slice(0, 1)
                                        }}</span>
                                    </div>
                                    <p class="userTempTitle">
                                        {{ profession.name }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Client's Templates Section -->
                    <div class="adminTempContainInnerDiv">
                        <div id="clientTempPageRowDiv">
                            <!-- First Row -->
                            <div v-if="templates.length > 0" class="height">
                                <div
                                    class="col s12 m6 l4 clientTempPageImgSmDv"
                                    v-for="template in templates"
                                    :key="template.id"
                                >
                                    <div class="">
                                        <img
                                            :src="
                                                '/media/img/templateThumbnail/' +
                                                template.profession.name +
                                                '/' +
                                                template.imageUrl
                                            "
                                            :alt="template.name"
                                            id=""
                                            class="image"
                                        />
                                    </div>

                                    <p class="tempPageImgTitle">
                                        {{ template.title }}
                                    </p>

                                    <p class="tempPageImgTxt">
                                        Lorem ipsum dolor sit amet consectetur
                                        adipisicing elit. Odio, quisquam!.
                                    </p>

                                    <a :href="'/preview/'+template.id" target="_blank" class="tempPageImgLink"
                                        >View</a
                                    >
                                    <a href="#!" class="tempPageImgLink right" @click="editMe(template)"
                                        >Edit</a
                                    >
                                </div>
                            </div>
                            <div v-else-if="loading" class="centered">
                                <i class="fas fa-spinner fa-spin fa-2x"></i>
                            </div>
                            <div v-else>
                                <p class="centered">
                                    No template found for profession
                                    <a
                                        class="waves-effect waves-teal btn-flat"
                                        @click="setView(1)"
                                        >Create Now
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row webWhiteDiv1" v-else-if="view == 1">
                    <form
                        id="bioForm"
                        @submit.prevent="update == 0 ? createTemplate() : edit()"
                        enctype="multipart/form-data"
                    >
                        <a
                            class="waves-effect waves-teal btn-flat"
                            @click="setView(0)"
                        >
                            <i class="material-icons left">arrow_back</i>Back
                        </a>
                        <div class="row">
                            <p class="bioTitle">Add Template</p>
                            <div class="row">
                                <div
                                    class="
                                        input-field
                                        col
                                        l6
                                        m6
                                        s12
                                        noPaddingLeft
                                    "
                                >
                                    <input
                                        placeholder="Title"
                                        id="signupPass"
                                        type="text"
                                        class="validate"
                                        v-model="template.title"
                                        required
                                    />
                                </div>

                                <div
                                    class="
                                        input-field
                                        col
                                        l6
                                        s12
                                        noPaddingRight
                                    "
                                >
                                    <select
                                        class="browser-default"
                                        id="signupGender"
                                        v-model="template.profession_id"
                                        required
                                    >
                                        <option value="" disabled selected>
                                            Profession
                                        </option>
                                        <option
                                            v-for="profession in professions"
                                            :key="profession.id"
                                            :value="profession.id"
                                        >
                                            {{ profession.name }}
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="center col l6">
                                    <div class="card-content centered">
                                        <div class="file-field input-field">
                                            <div class="btn btn_file">
                                                <span>File</span>
                                                <input
                                                    type="file"
                                                    @change="previewImage"
                                                    accept="image/*"
                                                />
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input
                                                    placeholder="Upload preview Image"
                                                    class="file-path validate"
                                                    type="text"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="center col l6">
                                    <div class="card-content centered">
                                        <div class="file-field input-field">
                                            <div class="btn btn_file">
                                                <span>File</span>
                                                <input
                                                    type="file"
                                                    @change="uploadStylesheet"
                                                    accept=".css"
                                                />
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input
                                                    class="file-path validate"
                                                    type="text"
                                                    placeholder="Upload the stylesheet file"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flexed">
                                <button
                                    type="submit"
                                    class="col s12 btn"
                                    id="logModalBtn"
                                >
                                    <span v-if="!loading && update == 0">save</span>
                                    <span v-if="!loading && update == 1">Update</span>
                                    <div
                                        class="preloader-wrapper small active"
                                        v-else-if="loading"
                                    >
                                        <div
                                            class="
                                                spinner-layer spinner-white-only
                                            "
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
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import AdminMobileNavComponent from "../partials/AdminMobileNavComponent.vue";
    import SideNavComponent from "../partials/SideNavComponent.vue";
    export default {
        components: {
            AdminMobileNavComponent,
            SideNavComponent,
        },
        data() {
            return {
                bg_img: "/media/img/istockphoto-1390124896-170667a.jpg",
                pro_img: "/media/img/yuna.jpg",
                professions: [],
                professionId: 0,
                selectedIndex: 0,
                loading: false,
                templates: [],
                template: {
                    title: "",
                    profession_id: 0,
                    imageUrl: null,
                    styleFile: null,
                },
                update: 0,
                view: 0,
            };
        },
        mounted() {
            this.getProfessions();
        },
        methods: {
            createTemplate() {
                this.loading = !this.loading;
                let formData = new FormData();
                formData.append("imageUrl", this.template.imageUrl);
                formData.append("title", this.template.title);
                formData.append("profession_id", this.template.profession_id);
                formData.append("styleFile", this.template.styleFile);

                axios
                    .post("/api/template", formData)
                    .then((res) => {
                        console.log(res)
                        if (res.status == 201) {
                            this.loading = !this.loading;
                            M.toast({
                                html: res.data.message,
                                classes: "successNotifier",
                            });location.reload()
                        } else {
                            M.toast({
                                html: "File too large",
                                classes: "errorNotifier",
                            });
                        }
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            },
            edit() {
                this.loading = !this.loading;
                let formData = new FormData();
                this.template.imageUrl == null ? null : formData.append("imageUrl", this.template.imageUrl);
                formData.append("title", this.template.title);
                formData.append("profession_id", this.template.profession_id);
                this.template.styleFile == null ? null : formData.append("styleFile", this.template.styleFile);
                formData.append('_method', 'PUT');
                axios
                    .post(`/api/template/${this.template.id}`, formData)
                    .then((res) => {
                        console.log(res)
                        if (res.status == 200) {
                            this.loading = !this.loading;
                            M.toast({
                                html: res.data.message,
                                classes: "successNotifier",
                            });location.reload()
                        } else {
                            M.toast({
                                html: "File too large",
                                classes: "errorNotifier",
                            });
                        }
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            },
            editMe(template) {
                this.template.title = template.title;
                this.template.profession_id = template.profession_id;
                this.template.id = template.id;
                this.setView(1); 
                this.update = 1;
            },
            getProfessions() {
                axios
                    .get("/api/profession")
                    .then((res) => {
                        this.professions = res.data.professionals;
                        this.professionId = this.professions.length > 0 ? this.professions[0].id : 0;
                        this.getTemplates(this.professionId);
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            },
            getTemplates(professionId, index = 0) {
                this.selectedIndex = index;
                this.loading = true;
                let url = `/api/template/${professionId}`;

                axios
                    .get(url)
                    .then((res) => {
                        if (res.status == 200) {
                            this.templates = res.data.templates;
                            this.loading = false;
                        }
                    })
                    .catch((err) => {
                        console.log(err);
                        this.loading = false;
                    });
            },
            setView(view) {
                this.view = view;
            },
            previewImage(event) {
                if (event.target.files.length !== 0) {
                    this.template.imageUrl = event.target.files[0];
                    this.template.imagePreview = URL.createObjectURL(
                        this.template.imageUrl
                    );
                }
            },
            uploadStylesheet(event) {
                if (event.target.files.length !== 0) {
                    this.template.styleFile = event.target.files[0];
                }
            },
        },
    };
</script>
<style scoped>
    .clientCreatePortInputRowDiv {
        padding: 3em;
    }
    #userTempDiv {
        cursor: pointer;
    }
    .image {
        width: 328px;
        height: 262px;
    }
</style>