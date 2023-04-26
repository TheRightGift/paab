<template>
     <div>
        <div class="servicesModalDiv" v-if="servicesModal">
            <div class="editInnerGenModal">
                <div class="row">
                    <div class="col s12 m12 l6">
                        <div class="row">
                            <p class="genTitle1 col s10 m10 l6">Add your services</p>
                            <!-- <i
                                v-if="services.length < 3"
                                class="
                                    col s1 m1 l1
                                    offset-s1
                                    offset-m1
                                    offset-l1
                                    material-icons
                                    genTitle1
                                    cursor
                                "
                                title="Add More Services"
                                id="bioAddBtn"
                                @click="addMore()"
                                >add_circle</i
                            > -->
                        </div>
                        <form @submit.prevent="serviceSave">
                            <interest-input-component :interests="interests" :services="services" @myinterests="getMyInterests($event)" />

                            <div>
                                <button  v-if="loading" class="btn">
                                    <div class="preloader-wrapper small active">
                                        <div
                                            class="spinner-layer spinner-white-only"
                                        >
                                            <div class="circle-clipper left">
                                                <div class="circle"></div>
                                            </div>
                                            <div class="gap-patch">
                                                <div class="circle"></div>
                                            </div>
                                            <div class="circle-clipper right">
                                                <div class="circle"></div>
                                            </div>
                                        </div>
                                    </div>
                                </button>
                                <button
                                    type="submit"
                                    class="btn"
                                    id="genModalBtn"
                                    v-else-if="saved.length == 0"
                                >
                                    save
                                </button>
                                <button
                                    type="submit"
                                    class="btn"
                                    id="genModalBtn"
                                    v-else
                                    @click="update = 1"
                                >
                                    update
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="col s12 m12 l6">
                        <img
                            src="/media/img/editWebsiteSettings/servicesImg.png"
                            alt="servicesImg.png"
                            class="editWebIllustrativeImg"
                        />
                    </div>
                </div>


                <div class="genBottomBtnDiv">
                    <div class="flexed">
                        <a href="#" class="btn right" id="genNextBtn" @click="servicesGoBackBtn()">BIOGRAPH</a>
                        <a href="#!" class="btn right" id="genNextBtn" @click="achieveLink()">ACHIEVEMENT</a>
                        <!-- <i class="material-icons">chevron_right</i> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
    .flex {
        flex-direction: column;
    }
    #bioAddBtn {
        font-size: 34px;
    }
    .genTitle1 {
        font-size: 24px !important;
    }
</style>
<script>
import InterestInputComponent from "../../../../partials/InterestInputComponent.vue"

    export default {
        components: { InterestInputComponent },
        props: {
            servicesModal: Boolean,
            saved: Array,
            loading: Boolean,
            interests: Array
        },
        computed: {},
        data() {
            return {
                services: [],
                update: 0,
                removed: [],
                servicesError: false,
                selectedInterests: [],
            };
        },
        methods: {
            getMyInterests(evt) {
                this.selectedInterests = evt;
            },
            remove(index) {
                this.services.splice(index, 1);
            },
            servicesGoBackBtn() {
                this.$emit("servicesGoBackBtn");
            },
            achieveLink() {
                if (
                    this.services[0].title === "" ||
                    this.services[0].description === ""
                ) {
                    this.servicesError = true;
                } else this.servicesError = false;
                this.$emit("achieveLink", this.servicesError);
            },
            serviceCount(service) {
                return service.description.length;
            },
            serviceSave() {
                this.$emit("serviceSave", {
                    services: this.selectedInterests,
                    update: this.update,
                    id: this.id,
                    removed: this.removed,
                });
            },
        },
        watch: {
            saved(newVal, oldVal) {
                if (newVal.length > 0) {
                    this.services = newVal;
                    this.id = newVal[0].id;
                }
            },
        },
    };
</script>
