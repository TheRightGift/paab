<template>
    <div class="section scrollspy" id="services">
        <div class="containerGrid">
            <div class="item">
                <div
                    class="serviceContainer"
                >
                    <div
                        class="
                            bgBlue
                        "
                    ></div>
                    <div
                        class="
                            bgPink
                        "
                    ></div>
                    <div
                        class="
                            bgRed
                        "
                    ></div>
                    <div
                        class="
                            bgCyan
                        "
                    ></div>
                    <div
                        class="
                            bgGreen
                        "
                    ></div>
                    <img
                        class="img1"
                        src="/media/img/templates/2/servImg2.png"
                    />
                    <img
                        class="img2"
                        src="/media/img/templates/2/servImg1.png"
                    />
                    <img
                        class="img3"
                        src="/media/img/templates/2/servImg4.png"
                    />
                    <img
                        class="img4"
                        src="/media/img/templates/2/servImg7.png"
                    />
                    <img
                        class="img5"
                        src="/media/img/templates/2/servImg3.png"
                    />
                    <img
                        class="img6"
                        src="/media/img/templates/2/servImg5.png"
                    />
                    <img
                        class="img7"
                        src="/media/img/templates/2/servImg6.png"
                    />
                </div>
            </div>
            <div class="item">
                <!-- Content for the second column -->
                <div class="sm-text-center p-mix">
                    <h2 class="heading">Services</h2>
                    <p class="sectionDescription">
                        As a pediatrician here are a few services i offer
                    </p>
                    <div class="services">
                        <div class="flex flex-col align-center">
                            <div
                                class="flex gap10 lg-gap30 justify-between align-center sm-flex-col"
                                v-for="service in services"
                                :key="service.id"
                            >
                                <div
                                    class="servDescImgContainer flex justify-center align-center sm-flex-col"
                                >
                                    <img
                                        :src="
                                            '/media/img/templates/2/' +
                                            service.url
                                        "
                                        class="responsive-img"
                                    />
                                </div>
                                <p class="servDescription">
                                    {{ service.description }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                services: [
                    {
                        id: 1,
                        service: "Family planning",
                        url: "group.png",
                        description:
                            "Reporting any unusual development regarding a child’s health to their parents or legal guardians.",
                    },
                    {
                        id: 2,
                        service: "PapTests",
                        url: "placehol.png",
                        description:
                            "Prescribing appropriate medication while taking into consideration the child’s health issue, health condition and overall development.",
                    },
                    {
                        id: 3,
                        service: "Menopause Management",
                        url: "users.png",
                        description:
                            "Helping children and teenagers get over the emotional distress associated with visiting the doctor's office.",
                    },
                ],
            };
        },
    };
</script>