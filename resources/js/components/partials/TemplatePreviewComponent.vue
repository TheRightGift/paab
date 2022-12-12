<template>
    <div class="row">
        <div v-if="templates.length > 0">
            <div class="col s12 l3 m6" v-for="template in templates" :key="template.id">
                <!--div id="userTempDiv" class="hoverable" :class="{highlighted: selectedTemplate == template.id}" @click="selectTemplate(template)"-->
                <div class="card hoverable">
                    <div class="card-image">
                        <img  :src="'/media/img/templateThumbnail/'+template.profession.name+'/'+template.imageUrl"/>
                    </div>
                    <div class="card-content">
                        <!--p class="userTempTitle">{{ template.title }}</p-->
                        <a :href="'/previewTemplates/'+template.id" target="_blank">Preview</a> 
                        <a @click="selectTemplate(template)" class="right" v-if="type == 'create'">Select</a>
                    </div>
                </div>
            </div>
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
            type: String
        },
        mounted() {
            this.getTemplates(this.professionId);
        },
        methods: {
            getTemplates(professionId) {
                let url = '';
                if(professionId == 0){//get all
                    // TODO: Get all template with pagination
                    url = `/api/template`;
                } else {
                    // TODO: Get template associated with the professionId
                    url = `/api/template/${this.professionId}`;
                }

                axios.get(url).then(res => {
                    if (res.status == 200) {
                        this.templates = res.data.templates;
                    }
                }).catch(err => {
                    console.log(err);
                });
            },
            selectTemplate(temp) {
                this.$emit('tempSel', temp)
            }
        },
        computed: {},
    };
</script>
<style scoped>
    .card .card-image {
        border-bottom: thin solid rgba(63, 63, 63, 0.4);
    }
    .card .card-content {
        padding: 12px 24px;
    }
</style>