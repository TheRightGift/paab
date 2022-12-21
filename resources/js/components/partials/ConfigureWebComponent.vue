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
                <a href="/client/websites" class="configWebBackBtn">GO BACK</a>
            </div>

            <div class="row" id="configWebInputDiv">
                <p class="configWebInputLabel">Edit your domain name</p>

                <form>
                    <div class="col s9">
                        <input
                            type="text"
                            placeholder="Domain name"
                            id="configWebInput"
                        />
                    </div>

                    <button
                        type="button"
                        class="col s1 offset-s1 btn"
                        id="configWebBtn"
                    >
                        save
                    </button>
                </form>
            </div>

            <!-- Client's Templates Section -->
            <div class="row" id="configWebInputDiv">
                <div id="configWebTempPageRowDiv">
                    <p class="configWebTitle">Change template</p>
                    <TemplatePreviewComponent :selectedTemplate="web.template_id" @tempSel="processTemp($event)" :professionId="userProfessionId" :type="'create'"/>
                    <p class="configWebLoadTxt center">Loading...</p>

                    <div class="configDelDiv">
                        <p class="configDeTxt">
                            Do you want to delete website?
                        </p>

                        <div class="configDelBtnDiv">
                            <button type="button" class="btn" id="configDelBtn">
                                Delete Website
                            </button>
                        </div>
                    </div>
                </div>

                <InnerFooterComponent />
            </div>
        </div>
    </div>
</template>
<script>
import InnerFooterComponent from '../partials/InnerFooterComponent.vue';
import TemplatePreviewComponent from '../partials/TemplatePreviewComponent.vue';
export default {
    components: {InnerFooterComponent, TemplatePreviewComponent},
    data() {
        return {
            web: {
                name: "",
                description: "",
                template_id: 0,
            },
        }
    },
    props: {
        userProfessionId: Number,
    },
    methods: {
        processTemp(evt) {
            this.web.template_id = evt.id;
        },
    },
}
</script>