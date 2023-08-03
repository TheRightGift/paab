<template>
    <div>
        <nav class="white shadow-none">
            <div class="nav-wrapper flex justify-center fs-2">
                <span class="primary text-center">{{ bio.firstname }} {{ bio.lastname }}</span>
            </div>
        </nav>
        <div  class="flex justify-center align-center flex-col h-100">
            <go-live-component />
        </div>
        <PaymentModalComponent
            :setModal="setModal"
            :user="parseInt(user_id)"
            @countDown="refreshForChanges($event)"
            @popupClose="refreshForChanges($event)"
            :domainName="extractDomain"
            :bio="bio"
            :tenantID="tenant"
            :email="email"
            :userSubscribed="userSubscribed"
            @paymentMethods="getCards($event)"
            :plan="plan"
        />
    </div>
</template>
<script>
import GoLiveComponent from '../partials/GoLiveComponent.vue';
import PaymentModalComponent from '../partials/PaymentModalComponent.vue';
import HeaderComponent from './Physicians/gynaecologist/HeaderComponent.vue';
let bio = '/api/bio';

export default {
    data() {
        return  {
            bio: {},
            setModal: false,
            paymentMethods : "",
            defaultCard: '',
            plan: '',
        }
    },
    components: { HeaderComponent, GoLiveComponent, PaymentModalComponent },
    computed: {
        extractDomain() {
            var hostname = window.location.hostname;
            var parts = hostname.split(".");
            var subdomain = parts[0];
            var isSubdomain = parts.length > 2; // Check if there are more than two parts in the hostname
            return subdomain + ".com";
        },
    },
    props: {
        template: String,
        template_id: String,
        id: "",
        user: String,
        preview: String,
        title: String,
        tenant: String,
        social: String,
        can: String,
        email: String,
        user_id: String,
        userSubscribed: String,
    },
    method: {
        refreshForChanges(evt) {
            if (evt == true) {
                location.reload();
            } else {
                setTimeout(() => {
                    location.reload();
                }, 10000);
            }
        },
        setModalPayment() {
            this.clickedSub = true;
        },
        getCards(evt) {
            this.paymentMethods = evt.cards;
            this.defaultCard = evt.default;
        },
    },
    mounted() {
        axios.get(bio).then(res => {
            this.bio = res.data.bio;
        }).catch(err => {
            console.log(err);
        })
    }
}
</script>
<style>
/* .shadow-none {
    box-shadow: none;
} */
</style>