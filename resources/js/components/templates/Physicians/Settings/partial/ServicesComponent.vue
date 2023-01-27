<template>
     <div>
        <div class="servicesModalDiv" v-if="servicesModal">
            <div class="editInnerGenModal">
                <div class="row">
                    <div class="col s12 m12 l6">
                        <div class="row">
                            <p class="genTitle1 col s10 m10 l6">Add your services</p>
                            <i
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
                            >
                        </div>

                        <p class="genTxt">
                            CLick on the '+' icon above to view input field for adding extra services you render. You must enter at least one service.
                        </p>
                        <form
                            enctype="multipart/form-data"
                            @submit.prevent="serviceSave"
                        >
                            <div
                                v-for="(service, index) in services"
                                :key="index"
                            >
                                <div class="row">
                                    <div class="flex">
                                        <div>
                                            <div class="input-field">
                                                <input
                                                    type="text"
                                                    placeholder="JohnDoe"
                                                    id="genInput"
                                                    v-model="service.title"
                                                    maxlength="15"
                                                    required
                                                />
                                            </div>
                                            <div class="input-field">
                                                <!-- <input type="text" placeholder="First Name" id="bioInput1"> -->
                                                <textarea
                                                    id="bioDescribeInput"
                                                    required
                                                    maxlength="239"
                                                    v-model="
                                                        service.description
                                                    "
                                                    class="materialize-textarea"
                                                    placeholder="Description"
                                                ></textarea>
                                                <p
                                                    class="right m-0"
                                                    :class="{
                                                        redColor:
                                                            service.description
                                                                .length <= 239,
                                                        successColor:
                                                            service.description
                                                                .length >= 239,
                                                    }"
                                                >
                                                    {{
                                                        service.description
                                                            .length
                                                    }}/239
                                                </p>
                                            </div>
                                        </div>
                                        <div>
                                            <label>&nbsp;</label>
                                            <i
                                                @click="
                                                    remove(index),
                                                        pushToTrash(service)
                                                "
                                                v-show="index != 0"
                                                class="material-icons cursor"
                                                id="bioAddBtn"
                                            >
                                                cancel
                                            </i>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
                    <a href="#" class="goBackBtn" @click="servicesGoBackBtn()"
                        >GO BACK</a
                    >

                    <button
                        type="button"
                        class="btn right"
                        id="genNextBtn"
                        @click="achieveLink()"
                    >
                        NEXT STEP
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            servicesModal: Boolean,
            saved: Array,
            loading: Boolean,
        },
        computed: {},
        data() {
            return {
                services: [
                    {
                        title: "",
                        description: "",
                        icon: "fa-tooth",
                    },
                ],
                update: 0,
                removed: [],
                servicesError: false,
            };
        },
        methods: {
            addMore() {
                this.services.push({
                    title: "",
                    description: "",
                    icon: "fa-tooth",
                });
            },
            remove(index) {
                this.services.splice(index, 1);
            },
            pushToTrash(e) {
                this.removed.push(e);
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
                    services: this.services,
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