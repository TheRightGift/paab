<template>
    <section class="support">
        <div class="container">
            <div class="supportBody">
                <p class="supportHeader">WE’RE ALWAYS HAPPY TO HELP</p>
                <div class="row">
                    <div class="col l4 s12">
                        <div class="centerOnSmall">
                            <div class="md-mb-2">
                                <p class="header">Technical support</p>
                                <p class="supportMail">techsupport@wcd.com</p>
                            </div>
                            <div>
                                <p class="header">Social media</p>
                                <div class="socials">
                                    <img v-for="(image, index) in images" :key="index" class="responsive-img" :src="'./media/img/'+image">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col l8 s12">
                        <div class="row mb-0">
                            <form class="col s12" @submit.prevent="sendToSupport">
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input required placeholder="Jane" type="text" class="validate" v-model="support.fname">
                                        <label for="first_name">First Name</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input required placeholder="Doe" type="text" class="validate" v-model="support.lname">
                                        <label for="last_name">Last Name</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input required placeholder="janedoe@mail.com" type="email" class="validate" v-model="support.email">
                                        <label for="first_name">Email</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input required type="tel" class="validate" placeholder="xxx-xxx-xxx" v-model="support.phone">
                                        <label for="last_name">Phone</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="textarea1">Message</label>
                                    <div class="input-field col s12">
                                        <textarea id="textarea1" class="materialize-textarea" required v-model="support.message"></textarea>
                                    </div>
                                </div>
                                <div class="getStartedLayout mb-4">
                                    <button type="submit" class="button submitForSupport waves-effect waves-deep-orange" :disabled="loading">
                                        <span v-if="!loading">Get Started</span>
                                        <i v-else class="fas fa-circle-notch fa-spin"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
export default {
    data() {
        return {
            images: [
                'facebook.png',
                'twitter.png',
                'insta.png'
            ],
            loading: false,
            support: {
                lname: "",
                fname: "",
                email: "",
                message: "",
                phone: "",
            },
        }
    },
    methods: {
        sendToSupport() {
            this.loading = true;
            let data = {
                names: this.support.fname+' '+this.support.lname,
                message: this.support.message,
                email: this.support.email,
                phone: this.support.phone,
            };
            axios.post('/api/support', data).then(res => {
                if (res.status == 201) {
                    M.toast({html: res.data, classes: 'successNotifier'});
                    this.support.fname = '';
                    this.support.lname = '';
                    this.support.email = '';
                    this.support.phone = '';
                    this.support.message = '';
                    this.loading = false;
                }
            }).catch(err => {
                console.log(err);
                this.loading = false;
            })
        }
    },
}
</script>



<style scoped>
.mb-0 {
    margin-bottom:0;
}
.submitForSupport {
    background-color: var(--white);
    color: #2E4451;
}
.submitForSupport:hover {
    color: var(--white);
    background: #2e4451;
}
.supportHeader {
    font-family: 'Montserrat', sans-serif;
    font-weight: 700;
    font-size: 3.125rem;
    line-height: 3.809rem;
    /* width: 45.625rem; */
    width: 47vw;
    text-align: center;
    margin: 2.75rem;
}
.support {
    background: #2E4451;
    color: var(--white);
}
.support .col.l4.s12 {
    padding-left: 0;
}
.supportHeader {
    width: 31vw;
    margin-left: 0;
    margin-right: 0;
    text-align: left;
}
.socials > img:not(:last-of-type){
    margin-right: .75rem;
}
.header:first-of-type {
    margin-top: 0;
}
.header {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 1.25rem;
    margin-bottom: .2rem;
    font-weight: 600;
}
.supportMail {
    margin: 0;
}
label[for="textarea1"] {
    padding-left: .9rem;
}
.input-field > label, label {
    font-family: 'Montserrat', sans-serif;
    font-weight: 500;
    font-size: 1.25rem;
    color: var(--white);
    /* margin-bottom: 1.5rem; */
}
input::placeholder {
    color: #2E4451;
}
.input-field > input[type=text]:not(.browser-default), .input-field > input[type=email]:not(.browser-default), .input-field > input[type=tel]:not(.browser-default) {
    background: #F5F5F5;
    margin-top: 1rem;
    text-align: center;
}
textarea, .input-field > input[type=text]:not(.browser-default),.input-field > input[type=email]:not(.browser-default), .input-field > input[type=tel]:not(.browser-default) {
    padding: 0 0.11rem;
}
.input-field > input[type=text]:not(.browser-default):focus, .input-field > input[type=email]:not(.browser-default):focus, textarea:focus, .input-field > input[type=tel]:not(.browser-default):focus {
    border: 2px solid #119DAD;
}
@media screen and (max-width: 640px) { 
    textarea, .input-field > input[type=text]:not(.browser-default), .input-field > input[type=email]:not(.browser-default), .input-field > input[type=tel]:not(.browser-default) {
        padding: 0 0rem;
    }
    .supportHeader {
        width: 94vw;
    }
    .supportBody {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    .centerOnSmall {
        display: flex;
        margin-bottom: 1.75rem;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
    }
    .socials {
        display: flex;
        justify-content: center;
    }
    .md-mb-2 {
        margin-bottom: 0;
    }
}
</style>