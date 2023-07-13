<template>
    <div class="section scrollspy" id="services">
        <div class="container">
            <div class="flex justify-center align-center flex-col">
                <h2 class="heading">Services</h2>
                <p class="sectionDescription">
                    They provide a wide range of services and care for women of all ages, from adolescence through menopause and beyond. Some of the key services offered by gynecologists include:
                </p>
                <div class="row">
                    <div class="row">
                        <div class="col s12 l4 m4" v-for="service in services" :key="service.id">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-img">
                                        <img :src="'/media/img/templates/1/'+service.url" class="responsive-img"/>
                                    </div>
                                    <div class="card-title">
                                        {{ service.service }}
                                    </div>
                                    <div class="card-body">
                                        {{ service.description }}
                                    </div>
                                </div>
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
                    url: 'familPlanSample.png',
                    description: 'Lorem ipsum dolor sit amet consecte tur adipiscing elit semper dalaracc lacus vel facilisis volutpat est velitolm.'
                },
                {
                    id: 2,
                    service: 'PapTests',
                    url: 'papTestSample.png',
                    description: 'Lorem ipsum dolor sit amet consecte tur adipiscing elit semper dalaracc lacus vel facilisis volutpat est velitolm.'
                },
                {
                    id: 3,
                    service: 'Gynecological Surgeries',
                    url: 'gynaSurgical.png',
                    description: 'Lorem ipsum dolor sit amet consecte tur adipiscing elit semper dalaracc lacus vel facilisis volutpat est velitolm.'
                },
                {
                    id: 4,
                    service: 'Menopause Management',
                    url: 'menopauseSample.png',
                    description: 'Lorem ipsum dolor sit amet consecte tur adipiscing elit semper dalaracc lacus vel facilisis volutpat est velitolm.'
                },
                {
                    id: 5,
                    service: 'Pregnancy Care',
                    url: 'pregnancySample.png',
                    description: 'Lorem ipsum dolor sit amet consecte tur adipiscing elit semper dalaracc lacus vel facilisis volutpat est velitolm.'
                },
                {
                    id: 6,
                    service: 'Menstrual Disorders',
                    url: 'menstrualSample.png',
                    description: 'Lorem ipsum dolor sit amet consecte tur adipiscing elit semper dalaracc lacus vel facilisis volutpat est velitolm.'
                }
            ]
        }
    }
}
</script>