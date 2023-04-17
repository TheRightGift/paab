<template>
    <div class="section scrollspy contactContainDiv" id="contact">
        <div class="row" id="templateContact">
            <div class="col s12" id="testiContactFormTitleDiv">
                <!-- <p class="feedsMainTitle expMainTitle">Contact Me</p>
                <p class="contactHeaderTxt">SCHEDULE AN APPOINTMENT</p> -->
                <h2 class="sectionHeader">
                    Contact me
                    <span class="primaryColorBoxDesign5"></span>
                </h2>

                <div v-if="isLoggedIn" class="" >
                    <!-- Contact Modal Trigger -->
                    <a class="modal-trigger contactEditBtn" href="#contactEditModal">
                        <i class="material-icons editIcon">edit</i>
                    </a>

                    <!-- Contact Modal Structure -->
                    <div id="contactEditModal" class="modal">
                        <div class="modal-content">
                            <div class="aboutWriteUpsEditModalInnerDiv">
                                <a href="#!" class="modal-close editWriteUpsModalCloseBtn">
                                    <i class="material-icons">keyboard_arrow_left</i>
                                </a>
                                <form>
                                    <div class="row rm_mg">
                                        <div class="input-field col s12 rm_mg">
                                            <input type="text" v-model="contact.phone" placeholder="+17792973" class="validate aboutWriteUpsInput">
                                        </div>
                                    </div>
                                    <div class="row rm_mg">
                                        <div class="input-field col s12 rm_mg">
                                            <input type="text" v-model="contact.address" placeholder="Address" class="validate aboutWriteUpsInput">
                                        </div>
                                    </div>
                                    <div class="row rm_mg">
                                        <div class="input-field col s12 rm_mg">
                                            <input type="email" v-model="contact.email" placeholder="youremail@handler.com" class="validate aboutWriteUpsInput">
                                        </div>
                                    </div>

                                </form>
                                <p class="servicesInputInstruct">Email you input will be the mail your client will contact you</p>
                                <div class="editWriteUpsSaveBtnDiv">
                                    <a href="#" class="editWriteUpsSaveBtn" @click.prevent="saveUpdateContact" v-if="!loading">
                                        <span v-if="contactMail == null">Save</span>
                                        <span v-else>Update</span>
                                    </a>
                                    <a href="#" class="editWriteUpsSaveBtn" v-else>
                                        <i class="fas fa-circle-notch fa-spin"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="contactMainDiv row">
                <div class="col s12 m5 l5 greenBg pt-5">
                    <div class="row">
                        <div class="col s2">
                            <div class="contactIconDiv">
                                <i class="material-icons contactIcon">contact_mail</i>
                            </div>
                        </div>
                        <div class="col s10">
                            <p class="contactMeTitle">Chat with me</p>
                            <p class="contactMeTxt">drakerele@gmail.com</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s2">
                            <div class="contactIconDiv">
                                <i class="material-icons contactIcon">location_on</i>
                            </div>
                        </div>
                        <div class="col s10">
                            <p class="contactMeTitle">Visit me</p>
                            <p class="contactMeTxt">Lekki phase 1, Lagos Nigeria</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s2">
                            <div class="contactIconDiv">
                                <i class="material-icons contactIcon">perm_phone_msg</i>
                            </div>
                        </div>
                        <div class="col s10">
                            <p class="contactMeTitle">Call me</p>
                            <p class="contactMeTxt">08000000333</p>
                        </div>
                    </div>
                </div>
                <div class="col s12 m7 l7">
                    <div class="formContainDiv">
                        <p class="contactFormTitle greenBg">
                            Free Consultation for a first time client
                        </p>
                        <form @submit.prevent="sendMail">
                            <div class="row">
                                <div class="input-field col s12 m12 l12">
                                    <input
                                        placeholder="Last Name"
                                        id="testiLname"
                                        type="text"
                                        class="validate contactFormInput"
                                        v-model="appointment.lastname"
                                        required
                                    />
                                </div>

                                <div class="input-field col s12 m12 l12">
                                    <input
                                        placeholder="First Name"
                                        id="testiFname"
                                        type="text"
                                        class="validate contactFormInput"
                                        v-model="appointment.firstname"
                                        required
                                    />
                                </div>

                                <div class="input-field col s12 m12 l12">
                                    <input
                                        placeholder="Email"
                                        id="testiEmail"
                                        type="text"
                                        class="validate contactFormInput"
                                        v-model="appointment.email"
                                        required
                                    />
                                </div>

                                <div class="input-field col s12 m12 l12">
                                    <input
                                        placeholder="Phone Number"
                                        id="testiPhone"
                                        type="text"
                                        class="validate contactFormInput"
                                        v-model="appointment.phone"
                                        required
                                    />
                                </div>

                                <div class="input-field col s12">
                                    <textarea
                                        id="testiTextarea1"
                                        class="materialize-textarea contactFormInput"
                                        placeholder="State your reasons"
                                        v-model="appointment.message"
                                        required
                                    ></textarea>
                                </div>
                                <div class="right">
                                    <button type="submit" class="btn testiContactBtn float-right" :disabled="saving">
                                        <span v-if="!saving">SUBMIT</span>
                                        <!-- <i class="material-icons" id="testiContactBtnIcon">send</i> -->
    
                                        <div class="preloader-wrapper small active" v-else>
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
                                </div>
                            </div>
                        </form>
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
            contact: {
                email: "",
                phone: "",
                address: "",
            },
            loading: false,
            success: false,
            saving: false,
            appointment: {
                message: "",
                phone: "",
                email: "",
                firstname: "",
                lastname: "",
            },
            update: 0,
        }
    },
    props: {preview: String, isLoggedIn: Boolean, contactMail: Object},
    methods: {
        saveUpdateContact() {
            this.loading = !this.loading;
            let request = `/api/contact`;
            let data = {
                _method: "PUT",
            };
            if (this.update == 1) {
                request = `/api/contact/${this.contact.id}`;
                this.contact = { ...this.contact, ...data };
            }
            axios
                .post(request, this.contact)
                .then((res) => {
                    if (res.status == 201 || res.data.status == 200) {
                        this.loading = !this.loading;
                        M.toast({
                            html: res.data.message,
                            classes: "successNotifier",
                        });
                        // location.reload();
                        // this.contactNextBtn()
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
        sendMail(){
            if (this.preview == '0') {
                this.saving = true
                axios.post('/api/schedule', this.appointment)
                .then(res => {
                    if (res.status == 201) {
                        console.log(res)
                        setTimeout(() => {
                            this.$router.go()
                        }, 3000)
                        M.toast({
                            html: res.data.message,
                            classes: "successNotifier",
                        });
                        this.saving = false;
                        this.appointment.message = "";
                        this.appointment.phone = "";
                        this.appointment.email = "";
                        this.appointment.firstname = "";
                        this.appointment.lastname = "";
                    }
                })
                .catch(error => {
                    // console.log(error);
                    this.saving = false
                })
            }
        }
    },
    watch: {
        contactMail(newVal, oldVal){
            if (newVal != null) {
                this.contact.email = newVal.email;
                this.contact.phone = newVal.phone;
                this.contact.address = newVal.address;
                this.contact.id = newVal.id;
                this.update = 1;
            }
        }
    },
}
</script>
