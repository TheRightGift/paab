<template>
    <div>
        <div>
            <a href="#!" class="back" @click="goBack"><i class="fa-solid fa-arrow-left-long fa-1x"></i> Back</a>
        </div>
        <div>
            <p></p>
        </div>
        <div class="row" id="configWebInputDiv" v-if="user.role == 'Admin'">
            <label class="col s12 configWebInputLabel"
                >Edit client Mail</label
            >
            <div class="col s9">
                <input
                    type="email"
                    required
                    placeholder="Client Email"
                    class="clientCreatePortInput1"
                    v-model="email"
                />
            </div>

            <div class="col s1 offset-s1 clientCreatePortBtnDiv">
                <button
                    type="button"
                    class="btn clientCreatePortBtn"
                    @click.prevent="giveAccess"
                    :disabled="email == '' || email == claimantMail"
                    v-if="!granting"
                >
                    Update
                </button>
                <button
                    type="button"
                    class="btn clientCreatePortBtn"
                    v-if="granting"
                >
                    <i class="fa-solid fa-circle-notch fa-spin"></i>
                </button>
            </div>

        </div>
        <div >
            <h6 class="fw-500 center">Change template</h6>
            <p class="fs-1 mb-0 supportWelcomeNote center"><i class="fa-solid fa-circle-info"></i>&nbsp;You can change your initial template to any of your choice without extra charges.</p>
            <TemplatePreviewComponent
                :selectedTemplate="web.template_id || selectedTemplate"
                @tempSel="processTemp($event)"
                :professionId="userProfessionId"
                :type="'create'"
                :role="user.role"
                :clientProfessionID="professionID"
            />
            <div class="col s12 center l12 m12 d-flex justify-center">
                <button
                    type="button"
                    class="btn customBtn"
                    @click.prevent="updateDomainTemplate"
                    :disabled="selectedTemplate == web.template_id"
                    >
                    <span v-if="!loading">change</span>
                    <ButtonLoaderComponent v-else />
                </button>
            </div>
        </div>
        <div class="d-flex gap-1 align-center mt-5">
            <h5 class="">Do you want to delete website?</h5>
            <div>
                <button type="button" class="btn customBtn red waves waves-effect">
                    Delete Website
                </button>
                <p class="fs-1 m-0 supportWelcomeNote center"><i class="fa-solid fa-circle-info"></i>&nbsp;Feature not available.</p>
            </div>
        </div>
    </div>
</template>
<style scoped>
    .customBtn {
        width: 15vw !important;
        height: 5vh !important;
        border-radius: 10px;
    }
    .btn:hover{
        background-color: #7746FF;
    }
    .btn:visited {
        background-color: #9977f7;
    }
    .customBtn.red  {
        background: red !important;
    }
    @media only screen and (min-width: 768px) and (max-width: 1023px) {
        .customBtn {width: 20vw !important;}
    }
</style>
<script>
    import InnerFooterComponent from "../partials/InnerFooterComponent.vue";
    import TemplatePreviewComponent from "../partials/TemplatePreviewComponent.vue";
    import ButtonLoaderComponent from "./ButtonLoaderComponent.vue";
    export default {
        components: {
            InnerFooterComponent,
            TemplatePreviewComponent,
            ButtonLoaderComponent,
        },
        data() {
            return {
                email: this.claimantMail,
                web: {
                    name: "",
                    description: "",
                    template_id: this.selectedTemplate,
                },
                domainName: this.domain,
            };
        },
        props: {
            granting: Boolean,
            userProfessionId: Number,
            selectedTemplate: Number,
            domain: String,
            loading: Boolean,
            user: Object,
            professionID: Number,
            claimantMail: String,
        },
        methods: {
            goBack() {
                this.$emit("goBack");
            },
            processTemp(evt) {
                this.web.template_id = evt.id;
            },
            updateDomainTemplate() {
                this.$emit("updateDomainTemplate", {
                    domain: this.domainName,
                    template: this.web.template_id,
                });
            },
            giveAccess() {
               this.$emit('giveAccess', this.email);
            }
        },
    };
</script>