<template>
    <div>
        <div class="container">
            <header>
                <div class="d-flex justify-between align-center">
                    <img
                        class="logo"
                        src="/media/img/wcd-logo-noBckg.png"
                        alt="Whitecoatdomain Logo"
                    />
                    <ul>
                        <li><a href="/" class="link">Home</a></li>
                    </ul>
                    <sign-up-button-component class="hide-on-small-only" />
                </div>
            </header>
            <main>
                <section>
                    <div
                        class="primaryBg content d-flex sm-flex-col align-center"
                    >
                        <img
                            src="/media/img/tempFitDocs.png"
                            class="fitImg responsive-img"
                        />
                        <div class="fitContainer">
                            <h6 class="fitHeading6">
                                Templates fit just for you
                            </h6>
                            <p class="fitDescription">
                                White Coat Domain is providing you with an
                                opportunity to showcase who you are and what you
                                can offer to your target audience.
                            </p>
                        </div>
                    </div>
                </section>
                <section id="specialties">
                    <h6 class="">Templates</h6>
                    <div class="scroll allPhysicistSelector d-flex">
                        <div class="d-flex flex-col align-center">
                            <div class="specialty">
                                <img
                                    src="/media/img/allTemp.png"
                                    alt="All Templates"
                                    class="responsive-img"
                                />
                            </div>
                            <p
                                class="specialtyName"
                                :class="{ active: selectedIndex == null }"
                                @click="getTemplates()"
                            >
                                All
                            </p>
                        </div>
                        <div
                            class="d-flex flex-col align-center mx-2"
                            v-for="(specialty, index) in specialties"
                            :key="specialty"
                        >
                            <div class="specialty">
                                <img
                                    :src="
                                        specialty.image
                                    "
                                    alt="All Templates"
                                    class="responsive-img"
                                />
                            </div>
                            <p
                                class="specialtyName"
                                :class="{ active: selectedIndex == index }"
                                @click="
                                    getTemplatesForSpecialty(
                                        index,
                                        specialty.templates,
                                        specialty.title
                                    )
                                "
                            >
                                {{ specialty.title }}
                            </p>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="templates row">
                        <div
                            v-for="template in templates"
                            :key="template"
                            class="col s12 m4 l3"
                        >
                            <div
                                class="template"
                                :style="getImageStyle(template, template.imageUrl)"
                            >
                                <!-- <img :src="template.imageUrl" class="responsive-img border"/> -->
                            </div>
                            <div class="templateFooter">
                                <a
                                    class="templateTitle"
                                    :href="'/template/preview/' + template.id"
                                    >{{ template.title }}</a
                                >

                                <p
                                    class="noMarginTop grey-text d-flex justify-between"
                                >
                                    <small>{{ title || template.title }}</small>
                                    <span class="tier">Free</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </section>
            </main>
        </div>
        <div class="spinner-overlay" v-show="fetching">
            <div class="spinner"></div>
        </div>
        <FooterComponent />
    </div>
</template>

<script>
    import FooterComponent from "./partials/FooterComponent.vue";
    import SignUpButtonComponent from "./partials/SignUpButtonComponent.vue";
    import TemplatePreviewComponent from "./partials/TemplatePreviewComponent.vue";
    export default {
        components: {
            FooterComponent,
            TemplatePreviewComponent,
            SignUpButtonComponent,
        },
        data() {
            return {
                fetching: false,
                specialties: [],
                selectedIndex: 0,
                templates: [],
                title: "",
            };
        },
        mounted() {
            this.getInterests();
            this.getTemplates();
        },
        methods: {
            getImageStyle(template, imageUrl) {
                return {
                    "background-image": `url(/media/img/templateThumbnail/${template.title}/${imageUrl})`,
                };
            },
            getTemplatesForSpecialty(index, templates, title) {
                this.selectedIndex = index;
                this.templates = templates;
                this.title = title;
            },
            getTemplates() {
                this.fetching = true;
                this.selectedIndex = null;
                axios
                    .get("/api/template")
                    .then((res) => {
                        if (res.status == 200) {
                            this.templates = res.data.templates;
                            this.fetching = false;
                        }
                    })
                    .catch((err) => {
                        console.log(err);
                        this.fetching = false;
                    });
            },
            getInterests() {
                this.fetching = true;
                axios
                    .get("/api/specialties")
                    .then((res) => {
                        console.log(res);
                        this.specialties = res.data.specialties;
                        // let allTemplate =
                        // this.specialties.unshift()
                        this.specialties.forEach((el, index) => {
                            if (index == 0) {
                                el.image = "/media/img/gyna.png";
                            } else if (index == 1) {
                                el.image = "/media/img/pediatrics.png";
                            }
                        });
                        this.fetching = false;
                    })
                    .catch((err) => {
                        console.log(err);
                        this.fetching = false;
                    });
            },
        },
    };
</script>
