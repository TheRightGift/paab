<template>
    <div>
        <mobile-nav-component />

        <!-- Sidebar for large and medium devices -->
        <div class="row" id="dashRowDiv">
            <side-nav-component @user="getUser" />

            <!-- Center Bar Person Div -->
            <div class="col s12 m10 l10">
                <!-- Client's Templates Section -->
                <div class="clientTempContainInnerDiv">
                    <div id="clientTempPageRowDiv">
                        <!-- First Row -->
                        <div v-if="templates.length > 0" class="height">
                            <div
                                class="col s12 m6 l4 clientTempPageImgSmDv"
                                v-for="template in templates"
                                :key="template.id"
                            >
                                <div class="">
                                    <img
                                        src="/media/img/aboutmyself.png"
                                        alt="tempPageImg.png"
                                        id=""
                                    />
                                </div>
    
                                <p class="tempPageImgTitle">Planet Earth</p>
    
                                <p class="tempPageImgTxt">
                                    The Planet Earth template is a captivating
                                    design with minimalist appeal.
                                </p>
    
                                <a
                                    :href="'/preview/' + template.id"
                                    target="_blank"
                                    class="tempPageImgLink"
                                    >View</a
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import MobileNavComponent from "../partials/MobileNavComponent.vue";
    import SideNavComponent from "../partials/SideNavComponent.vue";
    export default {
        components: {
            MobileNavComponent,
            SideNavComponent,
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