<template>
    <div
        class="row serviceBtnRowDiv"
        v-show="showGoLiveBtns"
    >
        <div class="col s12 m12 l12 customFlex">
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
        </div>
    </div>
</template>
<script>
import { send } from 'process';

export default {
    props: {
        showGoLiveBtns: Boolean,
        bio: Object,
    },
    methods: {
        sendEmail(){
            this.$emit('sendEmail', 'premium');
        }
    },
}
</script>
<style scoped>
    .customCard {
        position: relative;
        width: 345px;
        height: 187.26px;
        background: #46166B;
        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
        border-radius: 30px;
        padding: 20px;
        font-size: 14px;
        color: var(--white);
        font-weight: 600;
    }
    .nameOnCard {
        position: absolute;
        bottom: 20px;
        left: 20px;
        text-transform: uppercase;
    }

    .cardType {
        position: absolute;
        top: 20px;
        left: 20px;
        display: flex;
    }
    .amountOnCard {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 30px;
    }

    .numberOnCard {
        position: absolute;
        top: 20px;
        right: 20px;
    }
    .red {
        background-color: #D44141
    }
    .gold {
        background: rgba(212, 162, 65, 0.8);
        margin-left: -2px;
    }
    .ellipsis {
        width: 18px;
        height: 20.01px;
        border-radius: 50%;
    }
    .btn {
        background: var(--primary);
    }
    @media only screen and (max-width: 640px) {
        ul {
            width: 84% !important;
        }
        ul > li {
            text-align: justify !important;
            font-size: 0.9rem;
            list-style-type: disc !important;
        }
        ul li::marker {
            font-size: 2em;
            color: #46166B;
        }
    }
    ul {
        margin-bottom: 1rem;
        list-style-type: none;
    }
    
</style>