<template>
    <div>
        <mobile-nav-component />

        <!-- Sidebar for large and medium devices -->
        <div class="row" id="dashRowDiv">
            <side-nav-component @user="getUser" />

            <!-- Center Bar Person Div -->
            <div class="col s12 m10 l10">
                <div class="mailBlueDiv">
                    <div class="webBlackDiv1">
        
                        <div class="row webBlackDiv1">
                            <div class="col s12">
                                <p class="mailTitle">All Templates</p>
                            </div>
                            <div class="col s12">
                                <p class="webBlackTxt">
                                    Glance through all the templates prepare to meet your professional needs.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Client's Templates Section -->
                <TemplatePreviewComponent :professionId="0" :selectedTemplate="0"  :type="'preview'"/>

            </div>
        </div>
    </div>
</template>

<script>
    import MobileNavComponent from "../partials/MobileNavComponent.vue";
    import SideNavComponent from "../partials/SideNavComponent.vue";
    import TemplatePreviewComponent from "../partials/TemplatePreviewComponent.vue";

    export default {
        components: {
            MobileNavComponent,
            SideNavComponent,
            TemplatePreviewComponent
        },
        data() {
            return {
                bg_img: "/media/img/istockphoto-1390124896-170667a.jpg",
                pro_img: "/media/img/yuna.jpg",
                templates: [],
            };
        },
        mounted() {},
        methods: {},
    };
</script>