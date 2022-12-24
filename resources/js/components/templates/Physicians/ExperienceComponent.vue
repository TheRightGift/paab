<template>
    <div class="section scrollspy physiExpContainerDiv" id="experience" v-show="experience == null">
        <div class="row">
            <div class="col s12">
                <p class="expMainTitle">Experience</p>
                <p class="expMainTxt">MY ACHIEVEMENT</p>
            </div>

            <div class="col s12 m3 l2">
                <div class="expLeftBarDiv">
                    <div class="expLeftBarInnerDiv">
                        <div class="expLeftBarTxtDiv">
                            <p class="expLeftBarTxt">99 Yrs</p>
                            <p class="expLeftBarTxt1">Experience</p>
                        </div>
                    </div>

                    <div class="expLeftBarInnerDiv">
                        <div class="expLeftBarTxtDiv">
                            <p class="expLeftBarTxt">2,000</p>
                            <p class="expLeftBarTxt1">Ward rounds</p>
                        </div>
                    </div>

                    <div class="expLeftBarInnerDiv">
                        <div class="expLeftBarTxtDiv">
                            <p class="expLeftBarTxt">100</p>
                            <p class="expLeftBarTxt1">Volunteer services</p>
                        </div>
                    </div>

                    <div class="expLeftBarInnerDiv">
                        <div class="expLeftBarTxtDiv">
                            <p class="expLeftBarTxt">15</p>
                            <p class="expLeftBarTxt1">Certifications</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col s12 m9 l10">
                <img src="/media/img/physicianTemplate.png" 
                    alt="physicianTemplate.png" class="responsive-img" 
                    id="expRightDivImg"
                >
            </div>
        </div>
    </div>
    <div class="section scrollspy physiExpContainerDiv" id="experience" v-show="experience != null">
        <div class="row">
            <div class="col s12">
                <p class="expMainTitle">Experience</p>
                <p class="expMainTxt">MY ACHIEVEMENT</p>
            </div>

            <div class="col s12 m3 l2">
                <div class="expLeftBarDiv">
                    <div class="expLeftBarInnerDiv" v-for="(feat, index) in feats" :key="index">
                        <div class="expLeftBarTxtDiv">
                            <p class="expLeftBarTxt">{{feat}} {{index == 'experience' ? 'Yrs' : null}} </p>
                            <p class="expLeftBarTxt1">{{index}} {{ index == 'volunteer' ? 'services' : null }} {{ index == 'ward' ? 'rounds' : null}}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col s12 m9 l10" v-if="experience != null">
                <img :src="'tenancy/assets/'+experience.banner" 
                    alt="physicianTemplate.png" class="responsive-img" 
                    id="expRightDivImg"
                    v-if="promo == ''"
                >
                <img :src="'tenancy/assets/'+promo.banner" 
                    alt="physicianTemplate.png" class="responsive-img" 
                    id="expRightDivImg"
                    v-else-if="promo != ''"
                >
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                feats: {},
                promo: "",
            };
        },
        props: {
            experience: Object,
        },
        watch: {
            experience (newVal, oldVal) {
                if (newVal != null) this.feats = JSON.parse(newVal.feats);
            }
        },
        mounted() {
            this.getActivePromo();
        },
        methods: {
            getActivePromo() {
                axios.get('/api/activePromo').then(res => {
                    if (res.data != "") {
                        this.promo = res.data.promo;
                    }
                }).catch(err => {
                    console.log(err)
                })
            }
        },
        computed: {},
    };
</script>