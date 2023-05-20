<template>
    <div
        class="row"
        v-show="showGoLiveBtns"
    >
        <!--div class="col s12 m12 l12 customFlex">
            <div class="customCard">
                <div class="nameOnCard">{{ bio.firstname ?? 'john' }} {{ bio.lastname ?? 'doe' }}</div>
                <div class="numberOnCard">.... 65432</div>
                <div class="amountOnCard">$ 144.00</div>
                <div class="cardType">
                    <div class="red ellipsis"></div>
                    <div class="gold ellipsis"></div>
                </div>
            </div>

            <ul>
                <li>Secured website</li>
                <li>Custom domain name</li>
                <li>Branded email</li>
                <li>Social media stream</li>
            </ul>
            

            <button
                class="waves-effect waves-light btn modal-trigger col s12"
                href="#modal1"
                @click="sendEmail('premium')"
            >
                Go live
            </button>
        </div-->
        <div class="row">
            <div class="col l12 s12">
                <h4>Pay less for premium services.</h4>
            </div>
        </div>
        <div class="row featureContainer">
            <div>
                
                <div class="col l6 offset-l6 s12 feature featurePremium center-align greyText">
                    Premium
                </div>
            </div>
            <div>
                <div class="col l6 s8 feature featureBackground">
                    <b>Pro website templates</b>
                </div>
                <div class="col l6 s4 feature featurePremium center-align">
                    <i class="material-icons">check</i>
                </div>
            </div>
            <div>
                <div class="col l6 s8 feature featureBackground">
                    <b>Secured website</b>
                </div>
                <div class="col l6 s4 feature featurePremium center-align">
                    <i class="material-icons">check</i>
                </div>
            </div>
            <div>
                <div class="col l6 s8 feature featureBackground">
                    <b>Custom domain name</b>
                </div>
                <div class="col l6 s4 feature featurePremium center-align">
                    <i class="material-icons">check</i>
                </div>
            </div>
            <div>
                <div class="col l6 s8 feature featureBackground">
                    <b>Domain hosting</b>
                </div>
                <div class="col l6 s4 feature featurePremium center-align">
                    <i class="material-icons">check</i>
                </div>
            </div>
            <div>   
                <div class="col l6 s8 feature featureBackground">
                    <b>Branded email</b>
                </div>
                <div class="col l6 s4 feature featurePremium center-align">
                    <i class="material-icons">check</i>
                </div>
            </div>
            <div>
                <div class="col l6 s8 feature featureBackground">
                    <b>Social media stream</b>
                </div>
                <div class="col l6 s4 feature featurePremium center-align">
                    <i class="material-icons">check</i>
                </div>
            </div>
            <div>
                <div class="col l6 s8 feature">
                    <b>Price (Annual)</b>
                </div>
                <div class="col l6 s4 feature featurePremium center-align borderBottom greyText">
                    <b>$144.00 </b>
                </div>
            </div>
        </div>

        <button
            class="goLiveBtn waves-effect waves-light btn modal-trigger col s12" :class="{'tenantOnDemand': tenantOnDemand == 1}"
            href="#modal1"
            @click="sendEmail('premium')"
        >
            Go live
        </button>
    </div>
</template>
<script>
import { send } from 'process';

export default {
    props: {
        showGoLiveBtns: Boolean,
        bio: Object,
        tenantOnDemand: Number
    },
    methods: {
        sendEmail(){
            this.$emit('sendEmail', 'premium');
        }
    },
}
</script>
<style scoped>
    .featureContainer {
        margin: 6vh 0;
    }
    .featureBackground {
        background-color: #c8cbce;
    }
    @media screen and (max-width: 640px) {
        .featureBackground {
            padding-left: 5vw !important;
        }
    }
    .featurePremium {
        background-color: var(--ter);
    }
    .featurePremium:first-child {
        border-top-left-radius: 2rem;
        border-top-right-radius: 2rem;
        padding-top: 4vh
    }
    .greyText {
        color: #b6b6b9;
    }
    .borderBottom {
        border-bottom-left-radius: 2rem;
        border-bottom-right-radius: 2rem;
        padding-bottom: 4vh !important;
    }
    .feature {
        padding: 2.3vh 1.5vw;
    }
    .feature i {
        font-size: 1rem;
        color: #adf802;
    }
    .btn {
        background-color: var(--pri) !important;
    }
</style>