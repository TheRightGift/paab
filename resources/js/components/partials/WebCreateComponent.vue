<template>
    <div>
        <div class="clientCreatePortModalDiv">
            <p class="clientCreatePortCancelDiv">
                <a @click="modalCancelBtn()" id="clientCreatePortCancelIconBtn" class="waves-effect waves-light btn-flat"><i class="material-icons left">arrow_back</i>Go Back</a>
            </p>
            <div class="row createWebRow" v-if="webCreateViewState === 0">
                <div class="col l6 createWebSectionTitle center-align">
                    <h5>Input your domain name</h5>
                    <p>
                        <small>If your names and title are Dr. Mark Cable and you want your domain name to be <b>www.drmarkcable.com</b>, please enter <b>drmarcable</b></small>
                    </p>
                </div>
                <div class="col l6 createWebsiteDomainName">
                    <img :src="'/media/img/domainName.png'"/>
                    <input
                        type="text"
                        placeholder="Domain name"
                        id="clientCreatePortInput"
                        v-model="web.name"
                    />
                    
                </div>
            </div>

            <div class="row createWebRow" v-if="webCreateViewState === 1">                
                <div class="col l6 createWebsiteDomainName">
                    <img :src="'/media/img/description.png'"/>
                    <input
                        type="text"
                        placeholder="Description"
                        id="clientCreatePortInput1"
                        v-model="web.description"
                    />
                    
                </div>
                <div class="col l6 createWebSectionTitle center-align">
                    <h5>Describe your domain (optional)</h5>
                    <p class="center-align">
                        <small>Providing a good description helps us setup SEO for your site.</small>
                    </p>
                </div>
            </div>
            <div class="row clientCreateWebsiteView gutterTopBottom"  v-if="webCreateViewState === 2">
                <TemplatePreviewComponent :selectedTemplate="web.template_id" @tempSel="processTemp($event)" :professionId="userProfessionId" :role="user.role"  :type="'create'"/>
            </div>

            <div class="row websiteCreateBtnRow gutterTop-10">
                <button class="btn-small primaryBorder" @click="prevWebsiteCreateView()" :disabled="disablePrev"><i class="material-icons left">navigate_before</i>Prev</button>
                <button
                    type="button"
                    class="btn-small create"
                    @click.prevent="createWebsite"
                    :disabled="disableCr8"
                >
                    <span v-if="!loading"><i class="material-icons right">send</i>CREATE</span>
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
                <button class="btn-small primaryBorder" @click="nextWebsiteCreateView()" :disabled="disableNxt"><i class="material-icons right">navigate_next</i>Next</button>
            </div>
        </div>
    </div>
</template>
<script>
import TemplatePreviewComponent from "../partials/TemplatePreviewComponent.vue";

export default {
    components: { 
        TemplatePreviewComponent
    },
    props: {
        loading: false,
        isHidden: false,
        userProfessionId: Number,
        user: Object,
    },
    data() {
        return {
            webCreateViewState: 0,
            web: {
                name: "",
                description: "",
                template_id: 0,
            },
        }
    },
    mounted() {
        // console.log(`This is: ${this.userProfessionId}`);
    },
    computed: {
        disableCr8() {
            if (this.web.name == '' || this.web.description == '' || this.web.template_id == 0) {
                return true;
            }
        },
        disablePrev(){
            if(this.webCreateViewState == 0){
                return true;
            }
        },
        disableNxt(){
            if(this.webCreateViewState == 2){
                return true;
            }
        }
    },
    methods: {
        createWebsite() {
            if(this.web.name === "" || this.web.description === "" || this.web.template_id === 0 ){
                M.toast({
                    html: "Please fill the website creation form properly",
                    classes: "errorNotifier",
                });
            } else {
                this.$emit('createWebsite', this.web)
            }
            
        },
        modalCancelBtn() {
            this.$emit('close', true);
        },
        processTemp(evt) {
            this.web.template_id = evt.id;
        },
        nextWebsiteCreateView(){
            if(this.webCreateViewState < 2){
                this.webCreateViewState++;
            }
        },
        prevWebsiteCreateView(){
            if(this.webCreateViewState > 0){
                this.webCreateViewState--;
            }
        }
    },
}
</script>