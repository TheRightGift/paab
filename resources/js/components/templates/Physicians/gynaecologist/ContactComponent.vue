<template>
    <div class="contact section scrollspy" id="contact">
        <div class="bg">
            <div class="container">
                <div class="flex justify-between align-center px-5 sm-flex-col">
                    <div class="md-flex-1">
                        <h4 class="consultHead white-text sm-text-center">Free consultation with exceptional quality</h4>
                        <p class="oneCallAway white-text sm-text-center">Just one call away: <a href="" class="white-text" >+{{ contact.phone != '' ? contact.phone : '1 234 567 8910' }}</a></p>
                    </div>
                    <div class="md-flex-1">
                        <div class="flex justify-end">
                            <a class="consult waves waves-effect flex justify-center align-center">Get your consultation</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="px-5 py-2 sm-p-0">
            <div class="contactBg">
                <div class="container">
                    <div class="flex justify-between align-center sm-align-unset sm-flex-col">
                        <div class="booking flex flex-col justify-center">
                            <p class="heading sm-text-center">Book an Appointment</p>
                            <p class="sm-text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio optio porro aspernatur et quaerat voluptas, voluptatum, cupiditate nemo culpa, facere placeat autem accusantium quasi consequatur qui debitis praesentium fuga odit?</p>
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
        <div class="footerBg"></div>
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
            appointment: {
                message: "",
                phone: "",
                email: "",
                firstname: "",
                lastname: "",
            },
            saving: false,
        }
    },
    props: {preview: String, isLoggedIn: Boolean, contactMail: Object, physicianName: String},
    methods: {
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
            return hostname;
        },
    },
}
</script>