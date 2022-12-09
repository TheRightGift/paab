<template>
    <div>
        <div class="clientCreateInnerPortModalDiv">
            <div class="webProfessionDiv">
                <div class="row">
                    <div v-if="templates.length > 0">
                        <div
                            class="col s6 m6 l6"
                            v-for="template in templates"
                            :key="template.id"
                        >
                            <div id="userTempDiv" class="hoverable" :class="{highlighted: selectedTemplate == template.id}" @click="selectTemplate(template)">
                                <img class="materialboxed rounded" data-caption="A picture of a way with a group of trees in a park" width="100" :src="template.imageUrl">
    
                                <p class="userTempTitle">
                                    {{ template.title }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div v-else>
                        <p class="centered">No template found for your profession</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'TemplateSelector',
    data() {
        return {
            templates: [],
        }
    },
    props: {
        profession_id: Number,
        selectedTemplate: Number,
    },  
    methods: {
        getTemplates() {
                axios.get(`/api/template/${this.profession_id}`).then(res => {
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
    mounted() {
        this.getTemplates();
    },
}
</script>
<style>
    .highlighted {
        background-color: rgb(175, 104, 241);
}
</style>