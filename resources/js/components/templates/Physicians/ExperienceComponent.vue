<template>
    <div class="section scrollspy physiExpContainerDiv" id="experience">
        <div class="row">
            <div class="col s12">
                <p class="expMainTitle">Experience</p>
                <p class="expMainTxt">MY ACHIEVEMENT</p>
            </div>

            <div class="col s12 m3 l2">
                <div class="expLeftBarDiv">
                    <div class="expLeftBarInnerDiv" v-for="(feat, index) in feats" :key="index">
                        <div class="expLeftBarTxtDiv">
                            <p class="expLeftBarTxt">{{feat}}</p>
                            <p class="expLeftBarTxt1">{{index}}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col s12 m9 l10">
                <img :src="'tenancy/assets/'+experience.banner" 
                    alt="physicianTemplate.png" class="responsive-img" 
                    id="expRightDivImg"
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
            };
        },
        props: {
            experience: Object,
        },
        watch: {
            experience (newVal, oldVal) {
                this.feats = JSON.parse(newVal.feats);
            }
        },
        mounted() {},
        methods: {
            
        },
        computed: {},
    };
</script>