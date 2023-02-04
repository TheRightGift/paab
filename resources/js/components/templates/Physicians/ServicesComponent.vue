<template>
    <div id="templateService" class="row">
        <div class="col s12 rm_mg_pd">
            <div class="section scrollspy physiContainerDiv" id="services">
                <div v-if="services == null || services.length === 0">
                    <div class="row whatIdoTxtRowDiv">
                        <div class="col s12">
                            <p class="servicesMainTitle">Services</p>
                            <p class="servicesWhatIdo">WHAT I DO</p>
                            <h3 class="title">
                                WHAT I DO
                                <span class="primaryColorBoxDesign1"></span>
                            </h3>


                        </div>
                        <div class="servicesRw">
                            <div class="col s12 m4 l4">
                                <h5 class="servcesHeading forSurgeon">
                                    <span class="whatIdoServiceTitleNum">01.</span>
                                    Service
                                </h5>
                                <div class="servicesIconsDiv">
                                    <i
                                        class="
                                            fa-solid fa-briefcase-medical
                                            servicesIcons1
                                        "
                                    ></i>
                                </div>

                                <p class="servcesHeading forDoc">Service One</p>

                                <p class="servicesTxt">
                                    Contrary to popular belief, Lorem Ipsum is not
                                    simply random text. It has roots in a piece of
                                    classical Latin literature from 45 BC, making it
                                    over 2000 years old. Richard McClintock, a Latin
                                    professor at Hampden-Sydney College in Virginia
                                </p>
                            </div>

                            <div class="col s12 m4 l4">
                                <h5 class="servcesHeading forSurgeon">
                                    <span class="whatIdoServiceTitleNum">02.</span>
                                    Service
                                </h5>
                                <div class="servicesIconsDiv">
                                    <i class="fa-solid fa-briefcase-medical servicesIcons1"></i>
                                </div>

                                <p class="servcesHeading forDoc">Service Two</p>

                                <p class="servicesTxt">
                                    Contrary to popular belief, Lorem Ipsum is not
                                    simply random text. It has roots in a piece of
                                    classical Latin literature from 45 BC, making it
                                    over 2000 years old. Richard McClintock, a Latin
                                    professor at Hampden-Sydney College in Virginia
                                </p>
                            </div>

                            <div class="col s12 m4 l4">
                                <h5 class="servcesHeading forSurgeon">
                                    <span class="whatIdoServiceTitleNum">03.</span>
                                    Service
                                </h5>
                                <div class="servicesIconsDiv">
                                    <i
                                        class="
                                            fa-sharp fa-solid fa-briefcase-medical
                                            servicesIcons2
                                        "
                                    ></i>
                                </div>

                                <p class="servcesHeading forDoc">Service Three</p>

                                <p class="servicesTxt">
                                    Contrary to popular belief, Lorem Ipsum is not
                                    simply random text. It has roots in a piece of
                                    classical Latin literature from 45 BC, making it
                                    over 2000 years old. Richard McClintock, a Latin
                                    professor at Hampden-Sydney College in Virginia
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-else-if="services != null || services.length !== 0">
                    <div class="row whatIdoTxtRowDiv">
                        <div class="col s12">
                            <p class="servicesMainTitle">Services</p>
                            <p class="servicesWhatIdo">WHAT I DO</p>
                            <h3 class="title">
                                WHAT I DO
                                <span class="primaryColorBoxDesign1"></span>
                            </h3>
                            <div class="hide-on-large-only">
                                <!-- Services Modal Trigger -->
                                <a class="modal-trigger servicesEditBtn" href="#servicesEditModal" v-if="isLoggedIn">
                                    <i class="material-icons editIcon">edit</i>
                                </a>
                            </div>

                        </div>
                        <div :class="{ flexed: services.length <= 2 }" class="servicesRw">
                            <div
                                class="col s12 m4 l4"
                                v-for="(service, index) in services"
                                :key="service.id"
                            >
                                <h5 class="servcesHeading forSurgeon">
                                    <span class="whatIdoServiceTitleNum">0{{index}}.</span>
                                    {{ service.title }}
                                </h5>
                                <div class="servicesIconsDiv">
                                    <i
                                        class="
                                            fa-solid fa-briefcase-medical
                                            servicesIcons1
                                        "
                                        :class="service.icon"
                                    ></i>
                                </div>
                                <p class="servcesHeading forDoc">{{ service.title }}</p>
                                <p class="servicesTxt">
                                    {{ service.description }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Services Modal Structure -->
            <div id="servicesEditModal" class="modal">
                <div class="modal-content">
                    <div class="aboutWriteUpsEditModalInnerDiv">
                        <a href="#!" class="modal-close editWriteUpsModalCloseBtn">
                            <i class="material-icons">keyboard_arrow_left</i>
                        </a>
                        <span v-if="services !== null">
                            <a href="#!" class="servicesAddMoreBtn" @click="addMore()" v-if="services.length < 3">ADD MORE</a>
                        </span>
                        <div
                            v-for="(service, index) in servicesRend"
                            :key="index"
                        >
                            <div class="row rm_mg">
                                    <div class="input-field col s12">
                                        <input type="text" class="validate aboutWriteUpsInput" v-model="service.title" maxlength="15">
                                    </div>
                                    <div class="input-field col s12 rm_mg">
                                        <textarea class="materialize-textarea servicesTextarea" placeholder="description" maxlength="239" v-model="service.description"></textarea>
                                        <p
                                            class="right m-0"
                                            :class="{
                                                redColor:
                                                    service.description != null ? service.description
                                                        .length <= 239 : null,
                                                successColor:
                                                     service.description != null ? service.description
                                                        .length >= 239 : null,
                                            }"
                                        >
                                            {{
                                                service.description != null ? service.description
                                                    .length : 0
                                            }}/239
                                        </p>
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
                            <p class="aboutWriteUpsSize">Description should not be more than 239 characters</p>
                        </div>
                        <div class="editWriteUpsSaveBtnDiv">
                            <a href="#" class="editWriteUpsSaveBtn" @click.prevent="serviceSave" v-if="!loading">
                                <span v-if="services !== null">
                                    <span v-if="services.length === 0">Save</span>
                                </span>
                                <span @click="update = 1" v-else>Update</span>
                            </a>
                            <a href="#!" class="editWriteupsSaveBtn" v-else>
                                <i class="fas fa-spinner fa-spin"></i>
                            </a>
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
                servicesRend: [
                    {
                        title: "",
                        description: "",
                        icon: "fa-tooth",
                    },
                ],
                service: "",
                update: 0,
                removed: [],
                loading: false,
            }
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
            serviceCount(service) {
                return service.description.length;
            },
            serviceSave() {
                this.loading = !this.loading;
                let request = `/api/service`;
                let formData = new FormData();
                if (this.update == 1) {
                    request = `/api/service/${this.service}`;
                    this.removed.length > 0
                        ? formData.append("removed", JSON.stringify(this.removed))
                        : null;
                }
                formData.append("data", JSON.stringify(this.services));
                this.update == 1 ? formData.append("_method", "PUT") : null;
                axios
                    .post(request, formData)
                    .then((res) => {
                        if (res.status == 201 || res.data.status == 200) {
                            M.toast({
                                html: res.data.message,
                                classes: "successNotifier",
                            });
                            this.serviceErrors = false;
                            this.loading = !this.loading;
                            this.update == 0 ? this.achieveLink() : null;
                        }
                    })
                    .catch((err) => {
                        this.loading = !this.loading;
                        if (err.response.status == 400) {
                            err.response.data.forEach((el) => {
                                M.toast({
                                    html: el,
                                    classes: "errorNotifier",
                                });
                            });
                        }
                    });
            },
        },
        props: {
            services: Array,
            isLoggedIn: Boolean,
        },
        watch: {
            services(newVal, oldVal) {
                if (newVal !== null) {
                    if (newVal.length > 0) {
                        this.servicesRend = newVal;
                        this.service = newVal[0].id;
                    }
                }
            },
        },
    };
</script>
<style scoped>
    @media only screen and (min-width: 1200px) {
        .flexed {
            display: flex;
            justify-content: center;
        }
        .ml-0,
        .row .col.m4 {
            margin-left: 0 !important;
        }
    }
    @media only screen and (min-width: 993px) {
        .flexed {
            display: flex;
            justify-content: center;
        }
        .ml-0,
        .row .col.m4 {
            margin-left: 0 !important;
        }
    }
</style>
