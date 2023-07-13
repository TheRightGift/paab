<template>
    <div class="contact section scrollspy" id="contact">
        <div class="bg">
            <div class="container">
                <div class="flex justify-between align-center px-5 sm-flex-col">
                    <div class="">
                        <h4 class="consultHead white-text">Free consultation with exceptional quality</h4>
                        <p class="oneCallAway white-text">Just one call away: <a href="" class="white-text" >+{{ contact.phone != '' ? contact.phone : '1 234 567 8910' }}</a></p>
                    </div>
                    <div class="">
                        <a class="consult waves waves-effect flex justify-center align-center">Get your consultation</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="contactBg">
            <div class="px-5 py-2">
                <div class="container">
                    <div class="flex justify-between align-center sm-flex-col sm-justify-center">
                        <div class="booking flex flex-col justify-center">
                            <p class="heading">Book an Appointment</p>
                            <p class="">Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio optio porro aspernatur et quaerat voluptas, voluptatum, cupiditate nemo culpa, facere placeat autem accusantium quasi consequatur qui debitis praesentium fuga odit?</p>
                        </div>
                        <form class="flex flex-col gap20" @submit.prevent="sendMail">
                            <div class="custom-input ">
                                <label>Full Name</label>
                                <input type="text" class="browser-default" placeholder="Full Name" required v-model="appointment.fullName"/>
                            </div>
                            <div class="flex justify-between">
                                <div class="custom-input">
                                    <label>Email</label>
                                    <input type="email" class="browser-default" placeholder="Email" required v-model="appointment.email"/>
                                </div>
                                <div class="ml-5">
                                    <label>Date</label>
                                    <div class="custom-input">
                                        <input type="date" class="browser-default date-input" placeholder="Select Date" required v-model="appointment.date"/>
                                    </div>
                                </div>
                            </div>
                            <div class="custom-input message">
                                <label>Message</label>
                                <textarea class="browser-default" placeholder="Write Message" required v-model="appointment.message"></textarea>
                            </div>
                            <!-- <div class="flex justify-center">
                                <button type="submit" class="submitBtn waves waves-effect btn">Send Message</button>
                            </div> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="bgFooter">

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