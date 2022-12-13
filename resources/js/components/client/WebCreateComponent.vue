<template>
    <div>
        <div class="clientCreatePortModalDiv">
            <p class="clientCreatePortCancelDiv">
                <a @click="modalCancelBtn()" id="clientCreatePortCancelIconBtn" class="waves-effect waves-light btn-flat"><i class="material-icons left">arrow_back</i>Go Back</a>
                
            </p>

            <p class="clientCreatePortTitle">
                Giving your website a good title make it easier for customer to
                find your page.
            </p>

            <div class="row clientCreateWebsiteView" id="clientCreatePortInputRowDiv">
                <div class="col l6">
                    <input
                        type="text"
                        placeholder="Website title"
                        id="clientCreatePortInput"
                        v-model="web.name"
                    />
                </div>

                <div class="col l6">
                    <input
                        type="text"
                        placeholder="Description"
                        id="clientCreatePortInput1"
                        v-model="web.description"
                    />
                </div>
            </div>

            <div class="row clientCreateWebsiteView gutterTopBottom">
                <TemplatePreviewComponent :selectedTemplate="web.template_id" @tempSel="processTemp($event)" :professionId="userProfessionId" :type="'create'"/>
            </div>

            <button
                type="button"
                class="btn"
                id="clientCreatePortBtn"
                @click.prevent="createWebsite"
            >
                <span v-if="!loading">CREATE</span>
                <div class="preloader-wrapper small active" v-else>
                    <div class="spinner-layer spinner-white-only">
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
</template>
<script>
import TemplatePreviewComponent from "../partials/TemplatePreviewComponent.vue";
export default {
    components: { TemplatePreviewComponent },
    props: {
        loading: false,
        isHidden: false,
        userProfessionId: Number,
    },
    data() {
        return {
            // userProfessionId: 0,
            web: {
                name: "",
                description: "",
                template_id: 0
            },
        }
    },
    mounted() {
        // console.log(`This is: ${this.userProfessionId}`);
    },
    methods: {
        createWebsite() {
            this.$emit('createWebsite', this.web)
        },
        modalCancelBtn() {
            this.$emit('close', true);
        },
        processTemp(evt) {
            this.web.template_id = evt.id;
            console.log(evt.id)
        }
    },
}
</script>