<template>
    <div class="row">
        <div v-if="templates.length > 0" class="height">
            <div
                class="col s12 m6 l4 clientTempPageImgSmDv"
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
                        <a
                            :href="'/previewTemplates/' + template.id"
                            target="_blank"
                            >Preview</a
                        >

                        <span v-if="selectedTemplate == template.id">
                            <a class="right tempPageImgLink">Selected</a>
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
        <div v-else>
            <p class="centered">No template found for your profession</p>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                templates: [],
            };
        },
        props: {
            professionId: Number,
            selectedTemplate: Number,
            type: String,
        },
        mounted() {
            this.getTemplates(this.professionId);
        },
        methods: {
            getTemplates(professionId) {
                let url = "";
                if (professionId == 0) {
                    //get all
                    // TODO: Get all template with pagination
                    url = `/api/template`;
                } else {
                    // TODO: Get template associated with the professionId
                    url = `/api/template/${this.professionId}`;
                }

                axios
                    .get(url)
                    .then((res) => {
                        if (res.status == 200) {
                            this.templates = res.data.templates;
                        }
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            },
            selectTemplate(temp) {
                console.log(temp.id);
                this.$emit("tempSel", temp);
            },
        },
        computed: {},
    };
</script>
<style scoped>
    .card .card-image {
        border-bottom: thin solid rgba(63, 63, 63, 0.4);
    }
    .card-image img {
        height: 162px;
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