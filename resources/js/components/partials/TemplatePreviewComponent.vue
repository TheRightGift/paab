<template>
    <div class="row">
        <div v-if="templates.length > 0" class="">
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
                                template.specialty.title +
                                '/' +
                                template.imageUrl
                            "
                        />
                        <i
                            class="material-icons green-text selectedTemplate absolute top-0"
                            v-if="selectedTemplate == template.id"
                            >check_box</i
                        >
                    </div>
                    <div class="card-content">
                        <a :href="'/template/preview/' + template.id" target="_blank"
                            >Preview</a
                        >
                        <span v-show="type !== 'preview'">
                            <span v-if="selectedTemplate == template.id">
                                <a class="right green-text">Selected</a>
                            </span>
                            <span v-else >
                                <a @click="selectTemplate(template)" class="right"
                                    >Select</a
                                >
                            </span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div v-else-if="loading" class="centered">
            <i class="fas fa-circle-notch fa-spin fa-2x"></i>
        </div>
        <div v-else>
            <p class="centered">No templates</p>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                loading: false,
                templates: [],
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
            selectedTemplate: Number,
            type: String,
            role: String,
            clientProfessionID: Number,
        },
        mounted() {
            this.getTemplates(1);
        },
        methods: {
            getTemplates(professionId, index = 0) {
                this.selectedIndex = index;
                this.loading = true;
                
                let url = `/api/template`;
                // if (professionId == 0 || this.type == 'preview') {
                    // url = `/api/template`;
                // } else {
                    // url = `/api/template/${professionId}`;
                // }

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