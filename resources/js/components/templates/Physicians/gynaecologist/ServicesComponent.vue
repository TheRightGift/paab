<template>
    <div class="section scrollspy" id="services">
        <div class="container">
            <div class="flex justify-center align-center flex-col">
                <h2 class="heading">Services</h2>
                <p class="sectionDescription">
                    <!-- They provide a wide range of services and care for women of all ages, from adolescence through menopause and beyond. Some of the key services offered by gynecologists include: -->
                    I provide the following service
                </p>
                <div class="row">
                    <div class="row">
                        <div class="col s12 l4 m4" v-for="(service, index) in myServices" :key="service.id">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-img center relative servimageContainer" :id="index">
                                        <img :src="'/media/img/templates/1/'+service.icon" class="responsive-img" v-if="service.image_or_icon === null || service.image_or_icon === undefined"/>
                                        <img :src="'/media/tenants/' + tenant + '/img/' + service.image_or_icon" class="responsive-img" v-else/>
                                        <div class="overlay" v-show="isLoggedIn" @click="setIndex(index)">
                                            <i class="fa-solid fa-gear white-text fa-2x fa-spin" v-if="loading"></i>
                                            <label for="file-input" class="upload-label d-flex flex-col" v-else @change="handleFileUpload($event)">
                                                <img src="/media/img/upload.svg" class="responsive-img" />
                                                <p class="inBlock browse">Browse</p>
                                                <small class="red-text">Max file size: 500kb, .png,.jpg only</small>
                                                <input type="file" id="file-input" accept="image/*" @change="handleFileUpload($event)" />
                                            </label>
                                        </div>
                                    </div>
                                    <div class="card-title">
                                        <div class="flex justify-between">
                                            <span v-if="!editingService || editingIndex != index">{{ service.title }}</span>
                                            <div v-if="isLoggedIn" >
                                                <a href="#!" @click="edit(index)"  v-show="!editingService" class="pl-3">
                                                    <i class="fa-solid fa-pen primary fs-1"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <input maxlength="25" v-if="editingService && editingIndex == index" type="text" placeholder="" class="custom-edit-field browser-default w-100" v-model="service.title" @input="updateTitle(service.id, service.title)">
                                    </div>
                                    <div class="card-body">
                                        <span v-if="!editingService || editingIndex != index">{{ service.description }}</span>
                                        <textarea v-if="editingService && editingIndex == index" maxlength="114" class="custom-textarea-field w-100 h-10" v-model="service.description" @input="updateDescription(service.id, service.description)"></textarea>
                                        <div class="flex justify-between align-center" v-if="editingService && editingIndex == index">
                                            <div class="ml-3">
                                                <span v-if="editService">
                                                    <i class="fa-solid fa-gear primary fs-1 fa-spin"></i>
                                                </span>
                                                <span v-else class="flex">
                                                    <a href="#!"><i class="fa-regular fa-circle-xmark primary fs-1" @click="edit(index)"></i></a>
                                                    <a href="#!" class="pl-3" @click="confirmUpdateService(index, service.id)"><i class="fa-solid fa-check primary fs-1"></i></a>
                                                </span>
                                            </div>
                                        </div>
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
            editingIndex: null,
            editService: false,
            editingService: false,
            loading: false,
            servicesRend: {
                title: "",
                description: "",
                icon: "fa-tooth",
            },
            myServices: [
                {
                    title: 'Family planning',
                    icon: 'familPlanSample.png',
                    description: 'Lorem ipsum dolor sit amet consecte tur adipiscing elit semper dalaracc lacus vel facilisis volutpat est velitolm.'
                },
                {
                    title: 'PapTests',
                    icon: 'papTestSample.png',
                    description: 'Lorem ipsum dolor sit amet consecte tur adipiscing elit semper dalaracc lacus vel facilisis volutpat est velitolm.'
                },
                {
                    title: 'Gynecological Surgeries',
                    icon: 'gynaSurgical.png',
                    description: 'Lorem ipsum dolor sit amet consecte tur adipiscing elit semper dalaracc lacus vel facilisis volutpat est velitolm.'
                },
                {
                    title: 'Menopause Management',
                    icon: 'menopauseSample.png',
                    description: 'Lorem ipsum dolor sit amet consecte tur adipiscing elit semper dalaracc lacus vel facilisis volutpat est velitolm.'
                },
                {
                    title: 'Pregnancy Care',
                    icon: 'pregnancySample.png',
                    description: 'Lorem ipsum dolor sit amet consecte tur adipiscing elit semper dalaracc lacus vel facilisis volutpat est velitolm.'
                },
                {
                    title: 'Menstrual Disorders',
                    icon: 'menstrualSample.png',
                    description: 'Lorem ipsum dolor sit amet consecte tur adipiscing elit semper dalaracc lacus vel facilisis volutpat est velitolm.'
                }
            ]
        }
    },
    methods: {
        confirmUpdateService(index, id) {
            this.editService = !this.editService;
            let request = `/api/service`;
            let formData = new FormData();
            formData.append('title', this.servicesRend.title);
            formData.append('description', this.servicesRend.description);
            formData.append('icon', this.servicesRend.icon);
            formData.append('index', index);
            id == undefined ? null : formData.append('_method', 'PUT');
            id !== undefined ? request = `/api/service/${id}` : request;

            axios
                .post(request, formData)
                .then((res) => {
                    if (res.status == 201 || res.data.status == 200) {
                        this.editService = !this.editService;
                        this.editingIndex = null;
                        this.editingService = false;
                    }
                })
                .catch((err) => {
                    this.editService = !this.editService;
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
        edit(index) {
            this.editingService = !this.editingService;
            this.editingIndex = index;
            let toEdit = this.myServices[index];
            this.servicesRend.title = toEdit.title;
            this.servicesRend.description = toEdit.description;
            this.servicesRend.id = toEdit.id;
            this.servicesRend.icon = toEdit.icon;
            this.servicesRend.index = index;
            document.querySelectorAll('.card').forEach(el => {
                this.editingService ? el.classList.add('h-441') : el.classList.remove('h-441');
            })
        },
        updateTitle(id, item) {
            this.servicesRend.title = item;
        },
        updateDescription(id, item) {
            this.servicesRend.description = item;
        },
        handleFileUpload(file) {
            this.errors = [];
            this.loading = !this.loading;
            let formData = new FormData();
            formData.append("image_or_icon", file);
            formData.append("index", this.editingIndex);
            formData.append('title', this.servicesRend.title);
            formData.append('description', this.servicesRend.description);
            formData.append("_method", 'PUT');
            axios
                .post(`/api/saveimage`, formData)
                .then((res) => {
                    if (res.data.status == 200) {
                        this.loading = false;
                        M.toast({
                            html: 'Upload success',
                            classes: 'green white-text'
                        })
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    }
                })
                .catch((err) => {
                    this.loading = false;
                    if (err) {
                        this.errors = err.response;
                        M.toast({
                            html: 'Max file size is 500kb and should not be svg',
                            classes: 'red'
                        });
                    }
                });
        },
        setIndex(idx) {
            this.editingIndex = idx;
            let toEdit = this.myServices[idx];
            this.servicesRend.title = toEdit.title;
            this.servicesRend.description = toEdit.description;
            this.servicesRend.id = toEdit.id;
            this.servicesRend.icon = toEdit.icon;
        }
    },
    renderTriggered() {
        const servimageContainer = document.querySelector(".servimageContainer");
        if (servimageContainer !== null) {
            const fileInput = document.getElementById("file-input");
                fileInput.addEventListener("change", (e) => {
                this.handleFileUpload(e.target.files[0]);
            });
        }
    },
    mounted() {
        const servimageContainer = document.querySelector(".servimageContainer");
        if (servimageContainer !== null) {
            const fileInput = document.getElementById("file-input");
                fileInput.addEventListener("change", (e) => {
                this.handleFileUpload(e.target.files[0]);
            });
        }
    },
    props: {
            services: Array,
            isLoggedIn: Boolean,
            preview: String,
            tenant: String
        },
    watch: {
        services(newVal, oldVal) {
            if (newVal) {
                newVal.forEach((index, i) => {
                     const updatedItem = newVal[i];
                     if (index.index >= 0 && index.index < this.myServices.length) {
                         this.myServices[index.index] = updatedItem;
                     }
                 });
            }
        },
    },
}
</script>
<style scoped>
    .custom-textarea-field, .custom-edit-field {
        font-size: inherit;
        margin-bottom: 0;
    }
    .red-text {
        font-size: .5rem;
    }
</style>