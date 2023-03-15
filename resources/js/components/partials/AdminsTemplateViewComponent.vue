<template>
    <div>
        <!-- Center Bar Person Div -->
        <div class="col s12 m10 l10">
                <div class="webWhiteDiv1" v-if="view == 0">
                    <div class="templateRow tempSetBlackDiv">
                        <div class="tempSetBlackInnerDiv">
                            <div class="row tempSetBlackInnerDiv">
                                <div class="col s12">
                                    <p class="tempSetTitle">Create Template</p>
                                </div>
                                <div class="col s11">
                                    <p class="tempSetTxt">
                                        Lets start and automate your process so
                                        you can reclaim time and focus on your
                                        goals.
                                    </p>
                                </div>
                                <div class="col s1">
                                    <i
                                        class="material-icons tempSetIcon right"
                                        @click="setView(1)"
                                        >add_circle</i
                                    >
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Profession Carousel lists -->
                    <!--div class="carousel carousel-slider center white">
                        <div class="carousel-item" href="#one!">
                            <div class="row tempSetCarouselInnerDiv">
                                

                                <div class="col s6 m4 l2">
                                    <div class="tempSetProMainDiv">
                                        <div class="tempSetProDiv">
                                            <span class="tempSetProSymbols"
                                                >S</span
                                            >
                                        </div>
                                        <p class="tempSetProTitle">Surgeon</p>
                                    </div>
                                </div>

                                <div class="col s6 m4 l2">
                                    <div class="tempSetProMainDiv">
                                        <div class="tempSetProDiv1">
                                            <span class="tempSetProSymbols"
                                                >D</span
                                            >
                                        </div>
                                        <p class="tempSetProTitle">Dentist</p>
                                    </div>
                                </div>

                                <div class="col s6 m4 l2">
                                    <div class="tempSetProMainDiv">
                                        <div class="tempSetProDiv2">
                                            <span class="tempSetProSymbols"
                                                >G</span
                                            >
                                        </div>
                                        <p class="tempSetProTitle">
                                            gynecologist
                                        </p>
                                    </div>
                                </div>

                                <div class="col s6 m4 l2">
                                    <div class="tempSetProMainDiv">
                                        <div class="tempSetProDiv3">
                                            <span class="tempSetProSymbols"
                                                >N</span
                                            >
                                        </div>
                                        <p class="tempSetProTitle">
                                            Neurologist
                                        </p>
                                    </div>
                                </div>

                                <div class="col s6 m4 l2">
                                    <div class="tempSetProMainDiv">
                                        <div class="tempSetProDiv4">
                                            <span class="tempSetProSymbols"
                                                >R</span
                                            >
                                        </div>
                                        <p class="tempSetProTitle">
                                            Radiologist
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item white" href="#two!">
                            <p><b>Second Panel</b></p>
                            <p class="">This is your second panel</p>
                        </div>
                    </div-->

                    <div class="templateRow tempSetSearchInputMainDiv">
                        <div>
                            <form>
                                <div class="input-field">
                                    <input
                                        placeholder="&#128269; Search by title"
                                        id="adminClientSearchInput"
                                        type="text"
                                        class="validate"
                                        v-model="search"
                                    />
                                </div>
                            </form>
                        </div>

                        <div class="tempSetSearchInputControlDiv">
                            <div>
                                <span class="tempSetSearchInputTxts"
                                    >Filter</span
                                >
                                <i
                                    class="
                                        material-icons
                                        tempSetSearchInputIcons
                                    "
                                    >filter_list</i
                                >
                            </div>

                            <div class="tempSetSearchInputIconsDiv">
                                <span class="tempSetSearchInputTxts">Sort</span>
                                <i
                                    class="
                                        material-icons
                                        tempSetSearchInputIcons
                                    "
                                    >sort</i
                                >
                            </div>
                        </div>
                    </div>

                    <!-- Client's Templates Section -->
                    <div class="row templateRow adminTempContainInnerDiv">
                        <div class="clientTempPageRowDiv">
                            <!-- First Row -->
                            <div v-if="templates.length > 0" class="height">
                                <div
                                    class="col s12 m6 l3"
                                    v-for="template in filteredTemplates()"
                                    :key="template.id"
                                >
                                    <div class="card hoverable">
                                        <div
                                            class="card-image"
                                            @click="preview(template)"
                                        >
                                            <img
                                                :src="
                                                    '/media/img/templateThumbnail/' +
                                                    template.profession.name +
                                                    '/' +
                                                    template.imageUrl
                                                "
                                                class="image"
                                            />
                                        
                                            <i
                                                class="
                                                    material-icons
                                                    green-text
                                                    selectedTemplate
                                                "
                                                v-if="
                                                    selectedTemplate ==
                                                    template.id
                                                "
                                                >check_box</i
                                            >
                                        </div>
                                        <div class="card-content">
                                            <div>
                                                {{template.title}}
                                                <span class="right" v-if="template.approved == 'T'">
                                                    <a @click="editMe(template)" href="#!">
                                                        <i class="material-icons">edit</i>
                                                    </a>
                                                    <span v-if="
                                                            template.toDelete !=
                                                            null || role === 'Admin'
                                                        ">
                                                        <a
                                                            @click="
                                                                assignID2Del(template)
                                                            "
                                                            
                                                            href="#tempDelModal"
                                                            class="
                                                                tempSetDelBtn
                                                                modal-trigger
                                                            "
                                                        >
                                                            <i class="material-icons">delete</i>
                                                        </a>
                                                        </span>
                                                </span>
                                                <span v-else>
                                                    <i
                                                        class="
                                                            fas
                                                            fa-spinner fa-spin
                                                        "
                                                        v-if="loading"
                                                    ></i>
                                                    <a
                                                        @click="approve(template)"
                                                        href="#!"
                                                        v-else-if="!loading || role === 'SuperAdmin' "
                                                        >Approve</a
                                                    >
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div v-else-if="loading" class="centered">
                                <i class="fas fa-spinner fa-spin fa-2x"></i>
                            </div>
                            <div v-else>
                                <p class="centered">
                                    No template found
                                    <a
                                        class="waves-effect waves-teal btn-flat"
                                        @click="setView(1)"
                                        >Create Now
                                    </a>
                                </p>
                            </div>
                            <div class="centered" v-if="
                                search && !filteredTemplates().length
                            ">
                                <p class="error">No results found!</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row webWhiteDiv1" v-else-if="view == 1">
                    
                    <!-- Add Title black rectangular div -->
                    <div v-for="(form, index) in currentForm" :key="index">
                        <div class="templateRow tempSetBlackDiv">
                            <div class="tempSetBlackInnerDiv">
                                <div class="row tempSetBlackInnerDiv">
                                    <div class="col s12">
                                        <p class="tempSetTitle">
                                            {{ form.head }}
                                        </p>
                                    </div>
                                    <div class="col s11">
                                        <p class="tempSetTxt">
                                            {{ form.subheading }}
                                        </p>
                                    </div>
                                    <div class="col s1">
                                        <!-- Add Title Help Modal Trigger -->
                                        <a
                                            class="modal-trigger"
                                            :href="'#' + form.modalID"
                                        >
                                            <i
                                                class="
                                                    material-icons
                                                    tempSetIcon1
                                                    right
                                                "
                                                >help</i
                                            >
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row templateRow goBackRow">
                            <p class="addTitleBack">
                                <a href="#!" @click="back" class="black-text"><i class="material-icons left">arrow_back</i> Back</a>
                            </p>
                        </div>

                        <div class="row templateRow addTitleInputDiv">
                            <form
                                class="row"
                                @submit.prevent="
                                    update == 0 ? createTemplate() : edit()
                                "
                                enctype="multipart/form-data"
                            >
                                <div class="row">
                                    <input
                                        type="text"
                                        placeholder="Title"
                                        id="addTitleInput"
                                        v-model="template.title"
                                        required
                                        v-if="currentIndex == 0"
                                    />

                                    <div v-if="currentIndex == 1">
                                        <div class="file-field input-field">
                                            <div
                                                class="
                                                    btn
                                                    uploadTempThumpnailInputBtn
                                                "
                                            >
                                                <span>Pick Template preview image</span>
                                                <input
                                                    type="file"
                                                    @change="previewImage"
                                                    accept="image/*"
                                                />
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input
                                                    class="file-path validate"
                                                    type="text"
                                                    id="uploadThumbnailInput"
                                                />
                                            </div>
                                        </div>
                                    </div>

                                    <div v-if="currentIndex == 2">
                                        <div class="file-field input-field">
                                            <div
                                                class="
                                                    btn
                                                    uploadTempThumpnailInputBtn
                                                "
                                            >
                                                <span>Pick template stylesheet</span>
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
                                                    id="uploadTempStyle"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row pl-3">
                                    <button
                                        :disabled="currentIndex == 0"
                                        type="button"
                                        class="col s2 offset-s2 btn m3"
                                        id="uploadThumbnailBtn"
                                        @click="prev()"
                                    >
                                        Prev
                                    </button>
                                    <button
                                        :disabled="currentIndex == 2"
                                        type="button"
                                        class="col s2 offset-s1 btn m3 offset-m1 offset-l1"
                                        id="uploadThumbnailBtn"
                                        @click="next()"
                                    >
                                        Next
                                    </button>
                                    <button
                                        type="submit"
                                        class="col s2 btn offset-s1 m3 offset-m1 offset-l1"
                                        id="uploadThumbnailBtn"
                                        :disabled="!filled"
                                    >
                                        <span v-if="!loading && update == 0"
                                            >save</span
                                        >
                                        <span v-if="!loading && update == 1"
                                            >Update</span
                                        >
                                        <div
                                            class="
                                                preloader-wrapper
                                                small
                                                active
                                            "
                                            v-else-if="loading"
                                        >
                                            <div
                                                class="
                                                    spinner-layer
                                                    spinner-white-only
                                                "
                                            >
                                                <div
                                                    class="
                                                        circle-clipper
                                                        left
                                                    "
                                                >
                                                    <div
                                                        class="circle"
                                                    ></div>
                                                </div>
                                                <div class="gap-patch">
                                                    <div
                                                        class="circle"
                                                    ></div>
                                                </div>
                                                <div
                                                    class="
                                                        circle-clipper
                                                        right
                                                    "
                                                >
                                                    <div
                                                        class="circle"
                                                    ></div>
                                                </div>
                                            </div>
                                        </div>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Template Delete Modal Structure -->
            <div id="tempDelModal" class="modal">
                <div class="row logoutModalImageRow">
                    <img
                        src="/media/img/warning.png"
                        alt="Illustrating a warning that you will be logged out"
                        id="errAltImg"
                        class="logoutModalImage"
                    />
                </div>
                <div class="row center-align">
                    <p><b>You sure you want to delete this template?</b></p>
                </div>

                <div class="row center-align">
                    <button
                        @click="deleteTemplate"
                        class="primary waves-effect waves-green btn-flat"
                    >
                        Yes
                    </button>
                    <span class="gutter1"></span>
                    <button
                        class="
                            modal-close
                            primaryBorder
                            waves-effect waves-green
                            btn-flat
                        "
                    >
                        No
                    </button>
                </div>
            </div>
            <!-- ------------------------------------------------------------------------------------- -->
            <!-- Template's Inputs help Modals -->
            <!-- ------------------------------------------------------------------------------------- -->

            <!-- Add Title Help Modal Structure -->
            <div id="addTitleModal" class="modal">
                <div class="modal-content">
                    <p>
                        <a
                            href="#!"
                            class="
                                modal-close
                                waves-effect waves-green
                                btn-flat
                                helpModalCloseBtn
                            "
                            >Go Back</a
                        >
                    </p>
                    <h5 class="helpModalTitle">What is Domain Name?</h5>
                    <p class="helpModalTxts">
                        Nothing sets your personal brand apart faster than a
                        unique address on the web. Your domain name is your
                        website's equivalent of a physical address.
                    </p>

                    <p class="helpModalTxts">
                        It consists of a website name and a domain name
                        extension. A memorable domain will strengthen your
                        branding and help your audience find your website easily
                    </p>
                </div>
            </div>

            <!-- Upload Template Thumbnail Help Modal Structure -->
            <div id="uploadTempThumbModal" class="modal">
                <div class="modal-content">
                    <p>
                        <a
                            href="#!"
                            class="
                                modal-close
                                waves-effect waves-green
                                btn-flat
                                helpModalCloseBtn
                            "
                            >Go Back</a
                        >
                    </p>
                    <h5 class="helpModalTitle">What is Domain Name?</h5>
                    <p class="helpModalTxts">
                        Nothing sets your personal brand apart faster than a
                        unique address on the web. Your domain name is your
                        website's equivalent of a physical address.
                    </p>

                    <p class="helpModalTxts">
                        It consists of a website name and a domain name
                        extension. A memorable domain will strengthen your
                        branding and help your audience find your website easily
                    </p>
                </div>
            </div>

            <!-- Upload Template Thumbnail Help Modal Structure -->
            <div id="uploadTempStyleModal" class="modal">
                <div class="modal-content">
                    <p>
                        <a
                            href="#!"
                            class="
                                modal-close
                                waves-effect waves-green
                                btn-flat
                                helpModalCloseBtn
                            "
                            >Go Back</a
                        >
                    </p>
                    <h5 class="helpModalTitle">What is Domain Name?</h5>
                    <p class="helpModalTxts">
                        Nothing sets your personal brand apart faster than a
                        unique address on the web. Your domain name is your
                        website's equivalent of a physical address.
                    </p>

                    <p class="helpModalTxts">
                        It consists of a website name and a domain name
                        extension. A memorable domain will strengthen your
                        branding and help your audience find your website easily
                    </p>
                </div>
            </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            bg_img: "/media/img/istockphoto-1390124896-170667a.jpg",
            currentForm: [],
            currentIndex: 0,
            forms: [
                {
                    head: "Add Title",
                    subheading:
                        "Lets start and automate your process so you can reclaim time and focus on your goals.",
                    modalID: "addTitleModal",
                    input: "",
                    shown: true,
                },
                {
                    head: "Upload Template Thumbnail",
                    subheading:
                        "Explore from the creative world with our numerous customized website templates which will definitely set you apart to crush those career goals",
                    modalID: "addTitleModal",
                    input: ``,
                    shown: false,
                },
                {
                    head: "Upload Template stylesheet",
                    subheading:
                        "Lets start and automate your process so you can reclaim time and focus on your goals.",
                    modalID: "uploadTempStyleModal",
                    input: "",
                    shown: false,
                },
            ],
            loading: false,
            pro_img: "/media/img/yuna.jpg",
            professions: [],
            professionId: 0,
            search: "",
            selectedIndex: 0,
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
        this.currentForm.push(this.forms[0]);
    },
    computed: {
        filled() {
            if (this.update == 1) {
                return true;
            } else {
                if (
                    this.template.imageUrl != null &&
                    this.template.styleFile != null &&
                    this.template.title != ""
                ) {
                    return true;
                }
            }
        },
    },
    methods: {
        approve(template) {
            this.loading = true;
            axios
                .patch(`/api/approveTemplate/${template.id}`, { approved: "T" })
                .then((res) => {
                    if (res.data.status == 200) {
                        M.toast({
                            html: res.data.message,
                            classes: "successNotifier",
                        });
                        this.loading = !this.loading;
                        location.reload();
                    }
                })
                .catch((err) => {
                    this.loading = !this.loading;
                    console.log(err);
                });
        },
        assignID2Del(template) {
            this.template.id = template.id;
        },
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
                    // console.log(res);
                    if (res.status == 201) {
                        this.loading = !this.loading;
                        M.toast({
                            html: res.data.message,
                            classes: "successNotifier",
                        });
                        location.reload();
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
        deleteTemplate() {
            let url = this.role === 'SuperAdmin' ? `/api/template/${this.template.id}` : `/api/deleteTemplate/${this.template.id}`
            let axiosFunction = this.role === 'SuperAdmin' ? axios.delete : axios.put;
            axiosFunction(url)
                .then((res) => {
                    if (res.status == 204) {
                        M.toast({
                            html: 'Template moved to archive',
                            classes: "successNotifier",
                        });
                    }
                    if (res.data.status === 200) {
                        M.toast({
                            html: res.data.message,
                            classes: "successNotifier",
                        });
                    }
                    // this.template.id = "";
                    let elem = document.getElementById("tempDelModal"); //.getElementsByClassName('modal-close').click()
                    var instance = M.Modal.getInstance(elem);
                    instance.close();
                    this.templates.splice(
                        this.templates.findIndex(
                            (templ) => templ.id === this.template.id
                        ),
                        1
                    );
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        edit() {
            this.loading = !this.loading;
            let formData = new FormData();
            this.template.imageUrl == null
                ? null
                : formData.append("imageUrl", this.template.imageUrl);
            formData.append("title", this.template.title);
            formData.append("profession_id", this.template.profession_id);
            this.template.styleFile == null
                ? null
                : formData.append("styleFile", this.template.styleFile);
            formData.append("_method", "PUT");
            axios
                .post(`/api/template/${this.template.id}`, formData)
                .then((res) => {
                    if (res.status == 200) {
                        this.loading = !this.loading;
                        M.toast({
                            html: res.data.message,
                            classes: "successNotifier",
                        });
                        location.reload();
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
        back() {
            this.template.title = "";
            this.template.profession_id = 0;
            this.template.id = "";
            this.setView(0);
            this.update = 0;
        },
        filteredTemplates() {
            return this.templates.filter((item) =>
                item.title
                    .toUpperCase()
                    .includes(this.search.toUpperCase())
            );
        },
        getProfessions() {
            axios
                .get("/api/profession")
                .then((res) => {
                    this.professions = res.data.professionals;
                    this.professionId =
                        this.professions.length > 0
                            ? this.professions[0].id
                            : 0;
                            setTimeout(() => {
                                this.getTemplates(this.professionId);
                            }, 100);
                    this.template.profession_id = res.data.professionals[0].id;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        getTemplates() {
            this.loading = true;
            let url = this.role === 'SuperAdmin' ? `/api/templates` : `/api/template`;

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
        next() {
            this.currentForm = [];
            let index = this.currentIndex + 1;
            this.currentIndex = index;
            this.currentForm.push(this.forms[index]);
        },
        prev() {
            this.currentForm = [];
            let index = this.currentIndex - 1;
            this.currentIndex = index;
            this.currentForm.push(this.forms[index]);
        },
        preview(template) {
            window.open(`/preview/${template.id}`, "_blank");
        },
        previewImage(event) {
            if (event.target.files.length !== 0) {
                this.template.imageUrl = event.target.files[0];
                this.template.imagePreview = URL.createObjectURL(
                    this.template.imageUrl
                );
            }
        },
        setView(view) {
            this.view = view;
        },
        uploadStylesheet(event) {
            if (event.target.files.length !== 0) {
                this.template.styleFile = event.target.files[0];
            }
        },
    },
    props: {role: String},
}
</script>
<style>
    .clientCreatePortInputRowDiv {
        padding: 3em;
    }

    #userTempDiv {
        cursor: pointer;
    }

    .image {
        width: 240px;
        height: 159px;
    }
    
</style>