<template>
    <div>
        <!-- Sidenav for small devices -->
        <mobile-nav-component />

        <div class="row" id="dashRowDiv">
            <!-- Sidebar for large and medium devices -->
            <sidenav-component />

            <!-- Mail blue div -->
            <div class="col s12 m10 l10" id="mailRightDiv">
                <div class="mailBlueDiv">
                    <div class="webBlackDiv1">

                        <div class="row webBlackDiv1">
                            <div class="col s12">
                                <p class="mailTitle">Create Mail</p>
                            </div>
                            <div class="col s12">
                                <p class="webBlackTxt">
                                    Send messages across to clients.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="webBlackDiv1">
                    <div class="row">
                         <form class="col s12" @submit.prevent="sendMessage">
                            <div class="row">
                                <div class="input-field col s12">
                                    <input v-on:focus="changePlaceholder" v-on:focusout="initialPlaceholder" required placeholder="Recipients" id="to" type="text" class="validate" v-model="email.recipients">
                                    <small v-if="textShow">Add comma for batch emails</small>
                                </div>
                                <!-- <div class="chips input-field col s12">
                                    <input type="email" class="custom-class" v-model="email.recipients">
                                </div> -->
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input required placeholder="Subject" id="Subject" type="text" class="validate" v-model="email.subject">
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <textarea required placeholder="Message" id="textarea1" class="materialize-textarea" v-model="email.message"></textarea>
                                </div>
                            </div>

                            <button class="waves-effect waves-light btn capitalize">
                                <span v-if="!loading">Send</span>
                                <span v-if="loading" class="fas fa-circle-notch fa-spin "></span>
                            </button>
                         </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import SidenavComponent from "../partials/SideNavComponent.vue";
import MobileNavComponent from '../partials/MobileNavComponent.vue';
import axios from "axios";
export default {
    components: {
        SidenavComponent,
        MobileNavComponent,
    },
    data() {
        return {
            bg_img: '/media/img/istockphoto-1390124896-170667a.jpg',
            pro_img: '/media/img/yuna.jpg',
            email: {
                recipients: [],
                message: "",
                subject: "",
            },
            textShow: false,
            loading: false,
        };
    },
    mounted() { },
    methods: {
        changePlaceholder() {
            document.getElementById('to').setAttribute('placeholder', 'To');
            this.textShow = true;
        },
        initialPlaceholder() {
            document.getElementById('to').setAttribute('placeholder', 'Recipients');
            this.textShow = false;
        },
        showSingleMail() {
            window.location.href = "/supre/singlemail";
        },
        sendMessage() {
            this.loading = true;
            axios.post('/api/admin_send_mail', this.email).then(res => {
                if (res.data.status === 200) {
                    this.loading = false;
                    this.email = {recipients: [], message: "", subject: ""};
                    M.toast({html: res.data.message, classes: 'successNotifier'});
                }
            }).catch(err => {
                console.log(err);
                M.toast({html: err.response.data.message, classes: 'errorNotifier', outDuration: 400});
                this.loading = false;
            })
        }
    }
}
</script>