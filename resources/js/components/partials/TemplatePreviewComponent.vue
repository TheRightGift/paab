<template>
    <div class="row">
        <div class="row clientCreatePortInputRowDiv" v-if="determineRole">
            <div class="userTempMainDiv">
                <div
                    v-for="(profession, index) in professions"
                    :key="profession.id"
                >
                    <div
                        :class="{ selectedUserTempDiv: index == selectedIndex }"
                        id="userTempDiv"
                        @click="getTemplates(profession.id, index)"
                    >
                        <div class="tempImgDiv" id="tempImgDiv">
                            <span id="tempProIcon">{{
                                profession.name.slice(0, 1)
                            }}</span>
                        </div>
                        <p class="userTempTitle">{{ profession.name }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="templates.length > 0" class="gutterTop-10">
            <div
                class="col s12 m6 l3"
                :class="
                    selectedTemplate == template.id ? 'clientSelectedTemp' : ''
                "
                v-for="template in templates"
                :key="template.id"
            >
                <div class="card hoverable">
                    <div class="card-image">
                        <img
                            :src="
                                '/media/img/templateThumbnail/' +
                                template.profession.name +
                                '/' +
                                template.imageUrl
                            "
                        />
                        <i
                            class="material-icons green-text selectedTemplate"
                            v-if="selectedTemplate == template.id"
                            >check_box</i
                        >
                    </div>
                    <div class="card-content">
                        <a :href="'/preview/' + template.id" target="_blank"
                            >Preview</a
                        >

                        <span v-if="selectedTemplate == template.id">
                            <a class="right green-text">Selected</a>
                        </span>
                        <span v-else>
                            <a @click="selectTemplate(template)" class="right"
                                >Select</a
                            >
                        </span>
                    </div>
                </div>
            </div>
            <!-- <div>
                <p class="configWebLoadTxt center">Loading...</p>
            </div> -->
        </div>
        <div v-else-if="loading" class="centered">
            <i class="fas fa-spinner fa-spin fa-2x"></i>
        </div>
        <div v-else>
            <p class="centered">No template found for profession</p>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                loading: false,
                templates: [],
                professions: [],
                selectedIndex: 0,
            };
        },
        computed: {
            determineRole() {
                if (this.role === "Admin") {
                    return true;
                } else {
                    return false;
                }
            },
        },
        props: {
            professionId: Number,
            selectedTemplate: Number,
            type: String,
            role: String,
            clientProfessionID: Number,
        },
        mounted() {
            this.clientProfessionID == undefined
                ? this.getTemplates(this.professionId)
                : this.getTemplates(this.clientProfessionID);
            this.role === "Admin" ? this.getProfessions() : null;
        },
        methods: {
            getProfessions() {
                axios
                    .get("/api/profession")
                    .then((res) => {
                        this.professions = res.data.professionals;
                        this.selectedIndex =
                            this.clientProfessionID != undefined
                                ? this.professions.findIndex(
                                      (el) => el.id == this.clientProfessionID
                                  )
                                : 0;
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            },
            getTemplates(professionId, index = 0) {
                this.selectedIndex = index;
                this.loading = true;
                let url = "";
                if (professionId == 0) {
                    url = `/api/template`;
                } else {
                    url = `/api/template/${professionId}`;
                }

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
            selectTemplate(temp) {
                this.$emit("tempSel", temp);
            },
        },
    };
</script>
<style scoped>
    .card .card-image {
        border-bottom: thin solid rgba(63, 63, 63, 0.4);
    }
    .card-image img {
        height: 162px !important;
        /* width: 245px; */
    }
    .card .card-content {
        padding: 12px 24px;
    }
    .height {
        min-height: 50vh;
        height: 60vh;
        overflow: auto;
    }
</style>