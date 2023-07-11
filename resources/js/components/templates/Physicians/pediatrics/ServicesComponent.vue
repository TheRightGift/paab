<template>
    <div class="section scrollspy" id="services">
        <div class="container">
                <div class="flex justify-center align-center">
                    <div class="serviceContainer">
                        <img src="/media/img/templates/2/serviBG.png"  class="rotate180"/>
                        <div class="serviceImgs">
                            <div class="img1">
                                <img src="/media/img/templates/2/servImg1.png" />
                            </div>
                            <div class="img2">
                                <img src="/media/img/templates/2/servImg2.png" />
                            </div>
                            <div class="img3">
                                <img src="/media/img/templates/2/servImg4.png" />
                            </div>
                            <div class="img4">
                                <img src="/media/img/templates/2/servImg3.png" />
                            </div>
                            <div class="img5">
                                <img src="/media/img/templates/2/servImg6.png" />
                            </div>
                            <div class="img6">
                                <img src="/media/img/templates/2/servImg5.png" />
                            </div>
                            <div class="img7">
                                <img src="/media/img/templates/2/servImg7.png" />
                            </div>
                        </div>
                    </div>
                    <div>
                        <h2 class="heading">Services</h2>
                        <p class="sectionDescription">
                            As a pediatrician here are a few services i offer
                        </p>
                        <div class="services">
                            <div class="flex flex-col align-center">
                                <div class="flex justify-between align-center" v-for="service in services" :key="service.id">
                                    <div class="servDescImgContainer flex justify-center align-center">
                                        <img :src="'/media/img/templates/2/'+service.url" class="responsive-img"/>
                                    </div>
                                    <p class="servDescription">{{ service.description }}</p>
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
                    service: 'Family planning',
                    url: 'group.png',
                    description: 'Reporting any unusual development regarding a child’s health to their parents or legal guardians.'
                },
                {
                    id: 2,
                    service: 'PapTests',
                    url: 'placehol.png',
                    description: 'Prescribing appropriate medication while taking into consideration the child’s health issue, health condition and overall development.'
                },
                {
                    id: 3,
                    service: 'Menopause Management',
                    url: 'users.png',
                    description: 'Helping children and teenagers get over the emotional distress associated with visiting the doctor\'s office.'
                },
            ]
        }
    }
}
</script>