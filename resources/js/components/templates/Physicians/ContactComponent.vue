<template>
    <div class="section scrollspy contactContainDiv" id="contact">
        <div class="row">
            <div class="col s12" id="testiContactFormTitleDiv">
                <p class="feedsMainTitle">Contact Me</p>
                <p class="feedsMainTxt">SCHEDULE AN APPOINTMENT</p>
            </div>
            <form @submit.prevent="sendMail">
                <div class="input-field col s12 m6 l6">
                    <input
                        placeholder="Last Name"
                        id="testiLname"
                        type="text"
                        class="validate"
                        v-model="appointment.lastname"
                        required
                    />
                </div>
    
                <div class="input-field col s12 m6 l6">
                    <input
                        placeholder="First Name"
                        id="testiFname"
                        type="text"
                        class="validate"
                        v-model="appointment.firstname"
                        required
                    />
                </div>
    
                <div class="input-field col s12 m6 l6">
                    <input
                        placeholder="Email"
                        id="testiEmail"
                        type="text"
                        class="validate"
                        v-model="appointment.email"
                        required
                    />
                </div>
    
                <div class="input-field col s12 m6 l6">
                    <input
                        placeholder="Phone Number"
                        id="testiPhone"
                        type="text"
                        class="validate"
                        v-model="appointment.phone"
                        required
                    />
                </div>
    
                <div class="input-field col s12">
                    <textarea
                        id="testiTextarea1"
                        class="materialize-textarea"
                        placeholder="State your reasons"
                        v-model="appointment.message"
                        required
                    ></textarea>
                </div>
    
                <button type="submit" class="col s12 btn" id="testiContactBtn" :disabled="saving">
                    <span v-if="!saving">SEND</span>
                    <i v-if="!saving" class="material-icons" id="testiContactBtnIcon">send</i>
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
            </form>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            success: false,
            saving: false,
            appointment: {
                message: "",
                phone: "",
                email: "",
                firstname: "",
                lastname: "",
            }
        }
    },
    props: {preview: toString},
    methods: {
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
}
</script>