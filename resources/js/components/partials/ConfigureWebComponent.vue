<template>
    <div>
        <div class="col s12 m10 l10">
            <div class="webBlackDiv">
                <div class="webBlackDiv1">
                    <div class="row">
                        <div class="col s12">
                            <p class="configWebBlackTitle">
                                Configure your website
                            </p>
                        </div>
                        <div class="col s11">
                            <p class="webBlackTxt">
                                Lets start and automate your process so you can
                                reclaim time and focus on your goals.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="configWebBackBtnDiv">
                <a href="#!" @click="goBack" class="configWebBackBtn"
                    >GO BACK</a
                >
            </div>

            <div class="row" id="configWebInputDiv">
                <p class="configWebInputLabel">Edit your domain name</p>

                <form>
                    <div class="col s9">
                        <input
                            type="text"
                            placeholder="Domain name"
                            id="configWebInput"
                            v-model="domainName"
                        />
                    </div>

                    <button
                        type="button"
                        class="col s1 offset-s1 btn"
                        id="configWebBtn"
                        @click.prevent="updateDomainTemplate"
                        :disabled="domainName == domain"
                    >
                        save
                    </button>
                </form>
            </div>

            <!-- Client's Templates Section -->
            <div class="row" id="configWebInputDiv">
                <p class="configWebTitle">Change template</p>
                <TemplatePreviewComponent
                    :selectedTemplate="web.template_id || selectedTemplate"
                    @tempSel="processTemp($event)"
                    :professionId="userProfessionId"
                    :type="'create'"
                />
                <div>
                    <button
                        type="button"
                        class="col s1 offset-s1 btn right"
                        id="configWebBtn"
                        @click.prevent="updateDomainTemplate"
                        :disabled="selectedTemplate == web.template_id"
                    >
                        <span v-if="!loading">change</span>
                        <ButtonLoaderComponent v-else/>
                    </button>
                </div>
            </div>
            <div class="row configDelDiv" id="configWebInputDiv">
                <p class="configDeTxt">Do you want to delete website?</p>

                <div class="configDelBtnDiv">
                    <button type="button" class="btn" id="configDelBtn">
                        Delete Website
                    </button>
                    <!-- @click="
                                toggleDeleteModal
                            " -->
                </div>
            </div>

            <InnerFooterComponent />
        </div>
    </div>
</template>
<script>
    import InnerFooterComponent from "../partials/InnerFooterComponent.vue";
    import TemplatePreviewComponent from "../partials/TemplatePreviewComponent.vue";
import ButtonLoaderComponent from "./ButtonLoaderComponent.vue";
    export default {
        components: { InnerFooterComponent, TemplatePreviewComponent, ButtonLoaderComponent },
        data() {
            return {
                web: {
                    name: "",
                    description: "",
                    template_id: this.selectedTemplate,
                },
                domainName: this.domain,
            };
        },
        props: {
            userProfessionId: Number,
            selectedTemplate: Number,
            domain: String,
            loading: Boolean,
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
        },
    };
</script>