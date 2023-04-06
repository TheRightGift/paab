<template>
    <div>
        <div class="row">
            <div class="col s12">
                <div class="primaryColorDiv">
                    <div class="headerDiv">
                        <a href="/">
                            <img src="/media/img/wcdMobileLogo.png" alt="wcdMobileLogo.png" class="hide-on-large-only wcdMobileLogo">
                            <img src="/media/img/wcdMobileLogoLarge.png" alt="wcdMobileLogoLarge.png" class="hide-on-med-and-down">
                        </a>
                        <p class="headerTitle">
                            It is time for the world
                            to hear your pulse
                        </p>
                    </div>
                    <div class="hide-on-large-only">
                        <img src="/media/img/3dDoctors.png" alt="3dDoctors.png" class="primaryColorDocsImg">
                    </div>
                    <div class="hide-on-med-and-down">
                        <img src="/media/img/3dDoctorsLarge.png" alt="3dDoctorsLarge.png" class="primaryColorDocsImgLarge">
                    </div>
                </div>
            </div>

            <div class="col s12">
                <div class="contentDiv">

                    <div class="rule container">
                                <div class="row lt_mb">
                                    <h6 class="col s12 l8 cvSetupTitle">
                                        Services You Renders(Max of 3)
                                    </h6>
                                </div>
                                
                                    <div class="row" v-if="services.length !== 3 || updateActive">
                                        <form @submit.prevent="serviceSaveOrUpdate">
                                            <div class="input-field col s12 l12">
                                                <input
                                                    placeholder="Title of service"
                                                    type="text"
                                                    class="validate cvSetupInput1 padding"
                                                    v-model="service.title"
                                                    required
                                                />
                                            </div>
                                            <div class="input-field col s12 l12">
                                                <textarea
                                                    required
                                                    maxlength="239"
                                                    v-model="
                                                        service.description
                                                    "
                                                    class="materialize-textarea cvSetupInput1 padding p-textarea"
                                                    placeholder="Description"
                                                ></textarea>
                                                <div>
                                                    <p
                                                        class="right m-0"
                                                        :class="{
                                                            'red-text text-darken-1':
                                                                service.description != null ? service.description
                                                                    .length <= 239 : null,
                                                            'light-green-text text-darken-1':
                                                                    service.description != null ? service.description
                                                                    .length >= 200 : null,
                                                        }"
                                                    >
                                                        {{
                                                            service.description != null ? service.description
                                                                .length : null
                                                        }}/239
                                                    </p>
                                                </div>
                                            </div>
                                            <div>
                                                <button class="
                                                        waves-effect waves-green ml-2
                                                        btn
                                                        cvSetupSaveBtn right white deep-purple-text text-lighten-2
                                                    " @click="goBackToSite">Navigate Back To My Site</button>
                                                <button
                                                    type="submit"
                                                    class="
                                                        waves-effect waves-green
                                                        btn
                                                        cvSetupSaveBtn right
                                                    "
                                                    v-if="!loading"
                                                >
                                                    <span v-if="!updateActive">Save</span>
                                                    <span v-else>Update</span>
                                                </button>
                                                <button
                                                type="button"
                                                role="button"
                                                    class="
                                                        waves-effect waves-green
                                                        btn
                                                        cvSetupSaveBtn right
                                                    "
                                                    v-else
                                                >
                                                    <i class="fas fa-circle-notch fa-2x fa-spin"></i>
                                                </button>
                                                
                                            </div>
                                        </form>
                                    </div>
                            </div>
                            <div class="container">
                                <div class="experiencesRow card"  v-for="service in services" :key="service.id">
                                    <div class="ruleoutxt card-content">
                                        <div class="flex">
                                            <h6>{{service.title}}</h6>
                                        </div>
                                        <div class="flex">
                                            <p>{{service.description}}</p>
                                        </div>
                                        <div class="row mt-2">
                                            <button class="btn waves waves-effect danger col s5 l2 m4" :disabled="deleting || loading" @click="destroy(service)">
                                                <span v-if="!deleting">Delete</span>
                                                <span v-else class="fas fa-circle-notch fa-spin"></span>
                                            </button>
                                            <button :disabled="deleting || loading" class="btn waves waves-effect primary col s5 l2 offset-l2 m4 offset-m4 offset-s1" @click="populateService(service)">Edit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <footer class="footer grey-text text-darken-3">
                                &copy; {{  new Date().getFullYear() }}, {{ location }}.
                            </footer>
                </div>
            </div>
        </div>
        
    </div>
</template>
<script>
    export default {
        data() {
            return {
                deleting: false,
                loading: false,
                location: location.host,
                service: {
                    description: "",
                    title: "",
                    icon: 'fa-tooth'
                },
                services: [],
                updateActive: 0,
            }
        },
        methods: {
            destroy(item) {
                this.deleting = !this.deleting;
                axios.delete(`/api/service/${item.id}`).then(res => {
                    if (res.status === 204) {
                        M.toast({
                            html: 'Deleted onSuccess!',
                            classes: 'successNotifier'
                        });
                        this.services.splice(
                            this.services.findIndex(
                                (serv) => serv.id === item.id
                            ),
                            1
                        );
                        this.deleting = !this.deleting;
                    }
                }).catch(err => {
                    console.log(err);
                    this.deleting = !this.deleting;
                })
            },
            getServices() {
                axios.get('/api/service').then(res => {
                    this.services = res.data.services;
                }).catch(err => {
                    console.log(err);
                })
            },
            goBackToSite() {
                location.replace(`${location.origin}`);
            },
            populateService(item) {
                this.service = item;
                this.updateActive = 1;
            },
            serviceSaveOrUpdate() {
                this.loading = !this.loading;
                let request = `/api/service`;
                let formData = new FormData()
                if (this.updateActive === 1) {
                    request = `/api/service/${this.service.id}`;
                    formData.append('_method', 'PUT');
                }
                formData.append('data', JSON.stringify([this.service]));
                axios
                    .post(request, formData)
                    .then((res) => {
                        if (res.status == 201 || res.data.status == 200) {
                            M.toast({
                                html: res.data.message,
                                classes: "successNotifier",
                            });
                            res.status === 201 ? this.services.unshift(res.data.service) : null;
                            this.loading = !this.loading;
                            this.service = {
                                title: "",
                                description: "",
                                icon: "fa-tooth"
                            };
                            this.updateActive = 0;
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
        mounted() {
            this.getServices();
        }
    }
</script>
<style>
    .padding {
        padding: 0 1% 0 1% !important;
        width: 98% !important;
    }
    .p-textarea {
        padding: 0.8rem 1% 0.8rem 1% !important;
        width: 100% !important;
    }
    .ml-2 {
        margin-left: 2rem;
    }
    .flex > p {
        line-height: 1;
    }
    .mt-2 {
        margin-top: 1rem !important;
        margin-left: 1rem !important;
    }
    .contentDiv {
        /* height: unset !important;*/
    }
    button.btn:disabled {
        background-color: #f5f5f5 !important;
        border: none;
    }
    @media screen and (max-width: 640px) {
        input.validate.cvSetupInput1, textarea.materialize-textarea {
            margin-left: unset !important;
            text-align: justify !important;
            padding-left: 1% !important;
        }
    }
</style>