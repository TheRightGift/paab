<template>
    <div class="contact section scrollspy" id="contact">
        <div class="bg">
            <div class="container">
                <div class="flex justify-between align-center px-5 sm-flex-col">
                    <div class="md-flex-1">
                        <h4 class="consultHead white-text sm-text-center">Free consultation with exceptional quality</h4>
                        <div class="flex align-center sm-justify-center">
                            <p class="oneCallAway white-text sm-text-center">Just one call away: <a :href="contact.phone != '' ? 'tel:'+contact.phone : 'tel:1 234 567 8910'" class="white-text"  v-if="!editing">+{{ contact.phone != '' ? contact.phone : '1 234 567 8910' }}</a> <input v-else type="text" class="custom-edit-field browser-default" v-model="contact.phone" placeholder="+25490338399"/></p>
                            <div v-if="isLoggedIn" class="pl-3">
                                <a href="#!" @click="edit(0)"  v-show="!editing">
                                    <i class="fa-solid fa-pen primary fs-1"></i>
                                </a>
                            </div>
                            <div class="flex justify-between align-center" v-if="editing">
                                <div class="ml-3">
                                    <span v-if="editContent">
                                        <i class="fa-solid fa-gear primary fs-1 fa-spin"></i>
                                    </span>
                                    <span v-else>
                                        <a href="#!"><i class="fa-regular fa-circle-xmark primary fs-1" @click="edit(0)"></i></a>
                                        <a href="#!" class="pl-3" @click="confirmUpdateOrCreate"><i class="fa-solid fa-check primary fs-1"></i></a>
                                    </span>
                                </div>
                                
                            </div>
                        </div>
                        
                    </div>
                    <div class="md-flex-1">
                        <div class="flex justify-end icons-call">
                            <a :href="contact.phone != '' ? 'tel:'+contact.phone : 'tel:1 234 567 890'"><i class="fa fa-phone" aria-hidden="true"></i></a>
                            <span>|</span>
                            <a :href="contact.phone != '' ? `https://wa.me/${contact.phone}?text=${encodeURIComponent(message)}` : 'https://wa.me/+1234567890'" target="_blank"><i class="fa-brands fa-whatsapp"></i></a>
                            <!-- <a class="consult waves waves-effect flex justify-center align-center">Get your consultation</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sm-p-0">
            <div class="contactBg">
                <div class="container">
                    <div class="flex justify-between align-center sm-align-unset sm-flex-col">
                        <div class="booking flex flex-col justify-center">
                            <p class="heading sm-text-center">Book an Appointment</p>
                            <div class="flex align-center">
                                <p class="sm-text-center contactContext" v-if="!editingContext">
                                    {{contact.context || 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio optio porro aspernatur et quaerat voluptas, voluptatum, cupiditate nemo culpa, facere placeat autem accusantium quasi consequatur qui debitis praesentium fuga odit' }}
                                </p>
                                <textarea class="custom-textarea-field" maxlength="300" v-model="contact.context" v-else></textarea>
                                <div v-if="isLoggedIn" class="pl-3">
                                    <a href="#!" @click="edit(1)"  v-show="!editingContext">
                                        <i class="fa-solid fa-pen primary fs-1"></i>
                                    </a>
                                </div>
                                <div class="flex justify-between align-center" v-if="editingContext">
                                    <div class="ml-3">
                                        <span v-if="editContent">
                                            <i class="fa-solid fa-gear primary fs-1 fa-spin"></i>
                                        </span>
                                        <span v-else class="flex">
                                            <a href="#!"><i class="fa-regular fa-circle-xmark primary fs-1" @click="edit(1)"></i></a>
                                            <a href="#!" class="pl-3" @click="confirmUpdateOrCreate"><i class="fa-solid fa-check primary fs-1"></i></a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="card">
                                <div class="card-content">
                                    <h5>Contact Me</h5>
                                    <form @submit.prevent="sendMail">
                                        <div class="custom-input">
                                            <i class="fa fa-user user-icon"></i>
                                            <input type="text" class="browser-default" placeholder="Full Name" required v-model="appointment.fullName"/>
                                        </div>
                                        <div class="custom-input">
                                            <i class="fa fa-envelope user-icon"></i>
                                            <input type="email" class="browser-default" placeholder="Email" required v-model="appointment.email"/>
                                        </div>
                                        <div class="custom-input message">
                                            <i class="fa fa-envelope user-icon"></i>
                                            <textarea class="browser-default" placeholder="Message:" required v-model="appointment.message"></textarea>
                                        </div>
                                        <div class="flex justify-center">
                                            <button type="submit" class="submitBtn waves waves-effect btn" :disabled="saving">
                                                <span v-if="!saving">Send Message</span>
    
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
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footerBg flex justify-center align-center">
            Copyright &copy; {{ extractDomain }}
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
                context: ""
            },
            appointment: {
                message: "",
                phone: "",
                email: "",
                firstname: "",
                lastname: "",
            },
            editing: false,
            editingContext: false,
            editContent: false,
            saving: false,
            update: 0,
            message: '',
        }
    },
    // My office hours are from 06:00am - 05:00pm, Mondays - Saturdays
    props: {preview: String, isLoggedIn: Boolean, contactMail: Object, physicianName: String},
    methods: {
        confirmUpdateOrCreate() {
            this.editContent = !this.editContent;
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
                        this.editContent = !this.editContent;
                        this.editing = false;
                        this.editingContext = false;
                    }
                })
                .catch((err) => {
                    this.editContent = !this.editContent;
                    if (err.response.status == 400) {
                        err.response.data.forEach((el) => {
                            M.toast({
                                html: 'An error has occured, please retry',
                                classes: "errorNotifier",
                            });
                        });
                    }
                });
        },
        edit (num) {
            if (num === 0) {
                this.editing = !this.editing;
            } else if (num === 1) {
                this.editingContext = !this.editingContext;
            }
        },
        sendMail(){
            if (this.preview == '0') {
                const sentence = this.appointment.fullName;
                const words = sentence.split(" ");
                this.appointment.firstname = words[0];
                this.appointment.lastname = words[1];
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
                this.contact.context = newVal.context;
                this.update = 1;
            }
        }
    },
    computed: {
        extractDomain () {
            var hostname = window.location.hostname;
            var parts = hostname.split('.');
            var subdomain = parts[0];
            var isSubdomain = parts.length > 2; // Check if there are more than two parts in the hostname
            if (isSubdomain) {
                return subdomain.com;
            }
            this.message = `${window.location.hostname}. Hello, I want to book for consultaion.`;
            return hostname;
        },
    },
}
</script>