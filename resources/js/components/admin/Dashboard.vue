<template>
    <div>
        <!-- Sidenav for small devices -->
        <AdminMobileNavComponent />
        
        <div class="row" id="dashRowDiv">
            <!-- Sidebar for large and medium devices -->
            <AdminSideNavComponent />

            <div class="col s12 m10 l10">
                <div class="dashRightDiv">
                    <div id="adminDashRightImgDiv">
                        <div id="dashRightImgInnerDiv">
                            <div class="dashRightImgTxtDiv">
                                <p class="dashRightImgTitle white-text">
                                    Manage your client’s portfolio
                                </p>
                                <p class="dashRightImgTxt">
                                    Lorem Ipsum is simply dummy text of the
                                    printing and typesetting industry. 
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="dashWlcNoteRowDiv">
                        <div class="col s12 m8 l8">
                            <div class="dashWlcNoteDiv">
                                <div class="dashWlcNoteInnerDiv">
                                    <p class="dashWlcNoteTitle">
                                        Welcome!
                                        <span class="dashWlcNoteTitle1"
                                            >Dr. {{ user.firstname }}
                                            {{ user.lastname }}</span
                                        >
                                    </p>
                                    <p class="dashWlcNoteTxt">
                                        Lets start and automate your process so
                                        you can reclaim time and focus on your
                                        goals.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col s12 m4 l4">
                            <div class="row">
                                <div class="dashTimeDiv">
                                    <div class="col s7 m6 l6">
                                        <div class="dashTimeInnerDiv">
                                            <p class="dashTimeDate">
                                                {{ currentMonth }}
                                                {{ currentDay }},
                                                {{ currentYear }}
                                            </p>
                                            <p class="dashTime">
                                                {{ currentTime
                                                }}<span
                                                    class="dashTimePeriod"
                                                    >{{ currentMidNoon }}</span
                                                >
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col s5 m6 l6">
                                        <div class="shapeDegDiv">
                                            <div class="shapeDeg"></div>
                                            <div class="shapeDeg1"></div>
                                            <div class="shapeDeg2"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="row" id="myWebDiv">
                        <div class="col s12 m6 l6">
                            <div class="cardDiv">
                                <div class="cardHeader">
                                    <p class="cardTitle">MY WEBSITES</p>
                                </div>
                            </div>
                            <div class="cardContent">
                                <div class="cardContentProfile">
                                    <div  v-if="(websites.length > 0)">
                                        <div class="row" id="myWebRmMgRow"  v-for="website in websites" :key="website.id">
                                            <div class="col s10 m10 l10">
                                                <div class="cardImgMainDiv">
                                                    <div class="cardImgDiv">
                                                        <i
                                                            class="material-icons"
                                                            id="cardImg"
                                                            >person</i
                                                        >
                                                    </div>
                                                    <p class="cardProName">
                                                        {{website.name}}
                                                    </p>
                                                </div>
                                            </div>
    
                                            <div class="col s2 m2 l2">
                                                <a href="#" id="cardViewLink"
                                                    >View</a
                                                >
                                            </div>
    
                                            <div class="col s12">
                                                <hr class="cardLine" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" v-else>
                                        <p class="white-text center-align noVertMargin">No Website created yet</p>
                                    </div>
                                    <div class="row" id="myWebRmMgRow">
                                        <div class="col s12 center-align">
                                            <a @click="navigateToWebsitePage" class="waves-effect primary waves-light btn-small"><i class="material-icons right">add</i>Create website</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col s12 m6 l6">
                            <div class="cardDiv">
                                <div class="cardHeader">
                                    <p class="cardTitle">MY MAIL</p>
                                </div>
                                <div class="cardContent">
                                    <div class="row" id="myMailDiv">
                                        <div class="col s10 m10 l10">
                                            <div class="cardImgMainDiv">
                                                <div class="cardImgDiv">
                                                    <i
                                                        class="material-icons"
                                                        id="cardImg"
                                                        >person</i
                                                    >
                                                </div>
                                                <a href="#" class="cardProName"
                                                    >info@paab.com</a
                                                >
                                            </div>
                                        </div>

                                        <div class="col s2 m2 l2">
                                            <p class="dashTimeAgo">2m</p>
                                        </div>

                                        <div class="col s10 offset-s2">
                                            <p class="mailCardTxt">
                                                Lorem Ipsum is simply dummy text
                                                of the printing and typesetting
                                                industry. Lorem Ipsum has been
                                                the industry's standard dummy
                                                text ever since the 1500s, when
                                                an unknown printer took a galley
                                                of type and scrambled it to make
                                                a type specimen book, Lorem
                                                Ipsum is simply dummy text of
                                                the printing and typesetting
                                                Lorem Ipsum has been the
                                                industry's standard dummy text
                                                ever since the 1500s,....
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- Template Stuff -->
                    <div class="col s12 webWhiteDiv">
                        <div class="webWhiteDiv1" v-if="view == 0">
                            <a
                                class="waves-effect waves-teal btn"
                                @click="setView(1)"
                                >Create Now
                            </a>
                            <div class="row">
                                <div class="col l2 webWhiteTitle">Title</div>
                                <div class="col l2 webWhiteTitle websiteTitle">
                                    Profession
                                </div>
                                <div class="col l6 webWhiteTitle">
                                    Thumbnail
                                </div>
                                <div class="col l2 webWhiteTitle right-align">
                                    Actions
                                </div>
                            </div>
                            <div v-if="templates.length > 0">
                                <div
                                    class="row websitesViewRow"
                                    v-for="template in templates"
                                    :key="template.id"
                                >
                                    <div class="col l2">
                                        <p class="webWhiteProName">
                                            {{ template.title }}
                                        </p>
                                    </div>
                                    <div class="col l2">
                                        <div class="websiteTitle">
                                            <p class="webWhiteTxt">
                                                {{ template.profession_id }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col l6">
                                        <img
                                            class="materialboxed"
                                            width="100"
                                            :src="template.imageUrl"
                                        />
                                    </div>

                                    <div class="col l2 right-align">
                                        <a
                                            href="#!"
                                            class="marginRight1"
                                            title="Delete"
                                        >
                                            <i
                                                class="material-icons"
                                                @click="deleteTemplate(template)"
                                                id="webWhiteIcon"
                                                >delete</i
                                            >
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div v-else>
                                <p class="centered">
                                    No template created yet!. All template
                                    appears here when you create one
                                </p>
                                <div class="centered">
                                    <a
                                        class="waves-effect waves-teal btn-flat"
                                        @click="setView(1)"
                                        >Create Now
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- Form For Creation -->
                        <div class="row webWhiteDiv1" v-else-if="view == 1">
                            
                            <form
                            id="bioForm"
                            @submit.prevent="createTemplate"
                            enctype="multipart/form-data"
                            >
                            <a class="waves-effect waves-teal btn-flat" @click="setView(0)">
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
                                                <option
                                                    value=""
                                                    disabled
                                                    selected
                                                >
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
                                        <div class="center col l8">
                                            <div class="card-content centered">
                                                <div
                                                    class="
                                                        file-field
                                                        input-field
                                                    "
                                                >
                                                    <div class="btn btn_file">
                                                        <span>File</span>
                                                        <input
                                                            type="file"
                                                            @change="
                                                                previewImage
                                                            "
                                                            accept="image/*"
                                                            required
                                                        />
                                                    </div>
                                                    <div
                                                        class="
                                                            file-path-wrapper
                                                        "
                                                    >
                                                        <input
                                                            class="
                                                                file-path
                                                                validate
                                                            "
                                                            type="text"
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
                                            <span v-if="!loading">save</span>
                                            <div
                                                class="
                                                    preloader-wrapper
                                                    small
                                                    active
                                                "
                                                v-else
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
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- <InnerFooterComponent /> -->
            </div>
        </div>
    </div>
</template>

<script>
    import InnerFooterComponent from "../partials/InnerFooterComponent.vue";
    import AdminSideNavComponent from "../partials/AdminSideNavComponent.vue";
    import AdminMobileNavComponent from "../partials/AdminMobileNavComponent.vue";
    export default {
        components: {
            InnerFooterComponent,
            AdminSideNavComponent,
            AdminMobileNavComponent,
        },
        data() {
            return {
                bg_img: "/media/img/istockphoto-1390124896-170667a.jpg",
                pro_img: "/media/img/yuna.jpg",
                currentMonth: "",
                currentDay: "",
                currentDate: "",
                currentYear: "",
                currentTime: "",
                currentMidNoon: "",
                loading: false,
                months: [
                    "January",
                    "February",
                    "March",
                    "April",
                    "May",
                    "June",
                    "July",
                    "August",
                    "September",
                    "October",
                    "November",
                    "December",
                ],
                professions: [],
                template: {
                    profession_id: "",
                    title: "",
                    imageUrl: "",
                },
                templates: [],
                user: {},
                view: 0,
            };
        },
        mounted() {
            this.getUser();
            this.getDate();
            this.getProfessions();
            this.getTemplates();
            setInterval(this.getCurrentTimeInterval, 1000);
        },
        methods: {
            createTemplate() {
                this.loading = !this.loading;
                let formData = new FormData();
                formData.append("imageUrl", this.template.imageUrl);
                formData.append("title", this.template.title);
                formData.append("profession_id", this.template.profession_id);
                axios
                    .post("/api/template", formData)
                    .then((res) => {
                        if (res.status == 201) {
                            this.loading = !this.loading;
                            M.toast({
                                html: res.data.message,
                                classes: "successNotifier",
                            });
                            this.templates.unshift(res.data.template);
                            this.template.title = "";
                            (this.template.imageUrl = ""),
                                (this.template.profession_id = "");
                            this.setView(0);
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
            deleteTemplate(template) {
                this.loading = !this.loading;
                axios
                    .delete(`/api/template/${template.id}`)
                    .then((res) => {
                        if (res.status == 204) {
                            const findId = (rol) => rol.id === template.id;
                            this.templates.splice(
                                this.templates.findIndex(findId),
                                1
                            );
                            this.loading = !this.loading;
                        }
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            },
            getDate() {
                const d = new Date();
                this.currentMonth = this.months[d.getMonth()].substring(0, 3);
                this.currentDay = d.getDate() + this.dayFormatter(d.getDate());
                this.currentDate = d.getDate();
                this.currentYear = d.getFullYear();
                this.currentMidNoon = d.getHours() >= 12 ? "pm" : "am";
                this.getCurrentTimeInterval();
            },
            dayFormatter(d) {
                {
                    if (d > 3 && d < 21) return "th";
                    switch (d % 10) {
                        case 1:
                            return "st";
                        case 2:
                            return "nd";
                        case 3:
                            return "rd";
                        default:
                            return "th";
                    }
                }
            },
            formatAMPM(d) {
                var hours = d.getHours();
                var minutes = d.getMinutes();
                var ampm = hours >= 12 ? "pm" : "am";
                hours = hours % 12;
                hours = hours ? hours : 12; // the hour '0' should be '12'
                minutes = minutes < 10 ? "0" + minutes : minutes;
                var strTime = hours + ":" + minutes + " " + ampm;
                return strTime;
            },
            getCurrentTimeInterval() {
                const date = new Date();
                this.currentTime = `${date.getHours()}:${String(
                    date.getMinutes()
                ).padStart(2, "0")}`;
            },
            getProfessions() {
                axios
                    .get("/api/profession")
                    .then((res) => {
                        if (res.status == 200) {
                            this.professions = res.data.professionals;
                        }
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            },
            getUser() {
                axios
                    .get("/api/user")
                    .then((res) => {
                        this.user = res.data;
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            },
            getTemplates() {
                axios
                    .get("/api/template")
                    .then((res) => {
                        if (res.status == 200) {
                            this.templates = res.data.templates;
                        }
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            },
            navigateToWebsitePage() {
                window.location.replace("/admin/websites");
            },
            previewImage(event) {
                if (event.target.files.length !== 0) {
                    this.template.imageUrl = event.target.files[0];
                    this.template.imagePreview = URL.createObjectURL(
                        this.template.imageUrl
                    );
                }
            },
            setView(num) {
                this.view = num;
            },
        },
        props: ["_token"],
    };
</script>
<style>
    .centered {
        color: #000;
        text-align: center;
        padding-top: 20px;
    }
    .btn_file {
        background-color: #7746ff;
    }
    .btn_file:hover {
        background-color: #aa8ff5;
    }
    .center {
        margin: auto;
        width: 60%;
        border: 1px solid #b59ff0;
        padding: 30px;
        border-radius: 5px;
        background-color: #c1b8d8;
    }
</style>