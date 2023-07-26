<template>
    <div class="row w-70">
        <div class="row">
            <div class="col l12 s12">
                <h4 class="center-align grey-text darken-2">Make your website live for only $12/month.</h4>
            </div>
        </div>
        <div class="row featureContainer">
            <div>
                <div
                    class="col l6 offset-l6 s12 feature featurePremium center-align greyText"
                >
                    Premium
                </div>
            </div>
            <div>
                <div class="col l8 s8 m6 feature featureBackground">
                    <b>Pro website templates</b>
                </div>
                <div class="col l4 s4 m6 feature featurePremium center-align">
                    <i class="material-icons">check</i>
                </div>
            </div>
            <div>
                <div class="col l8 s8 m6 feature featureBackground">
                    <b>Secured website</b>
                </div>
                <div class="col l4 s4 m6 feature featurePremium center-align">
                    <i class="material-icons">check</i>
                </div>
            </div>
            <div>
                <div class="col l8 s8 m6 feature featureBackground">
                    <b>Custom domain name</b>
                </div>
                <div class="col l4 s4 m6 feature featurePremium center-align">
                    <i class="material-icons">check</i>
                </div>
            </div>
            <div>
                <div class="col l8 s8 m6 feature featureBackground">
                    <b>Domain hosting</b>
                </div>
                <div class="col l4 s4 m6 feature featurePremium center-align">
                    <i class="material-icons">check</i>
                </div>
            </div>
            <div>
                <div class="col l8 s8 m6 feature featureBackground">
                    <b>Branded email</b>
                </div>
                <div class="col l4 s4 m6 feature featurePremium center-align">
                    <i class="material-icons">check</i>
                </div>
            </div>
            <div>
                <div class="col l8 s8 m6 feature featureBackground">
                    <b>Social media stream</b>
                </div>
                <div class="col l4 s4 m6 feature featurePremium center-align">
                    <i class="material-icons">check</i>
                </div>
            </div>
            <div>
                <div class="col l8 s8 m6 feature">
                    <b>Price (Annual)</b>
                </div>
                <div
                    class="col l4 s4 m6 feature featurePremium center-align borderBottom greyText"
                >
                    <b>$144.00 </b>
                </div>
            </div>
        </div>

        <div class="flexed">
            <button
                class="goLiveBtn waves-effect waves-light btn modal-trigger modal-close"
                :class="{ tenantOnDemand: tenantOnDemand == 1 }"
                href="#paymentModal"
                @click="revertToInit()"
            >
                Go live
            </button>
        </div>
        <div class="flexed grey-text text-lighten mb-2">
            <i class="material-icons fs-16">info_outline</i>
            <p class="smallTextSupport">
                Your subscription auto renews until you cancel
            </p>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            showGoLiveBtns: Boolean,
            bio: Object,
            tenantOnDemand: Number,
        },
        methods: {
            revertToInit() {
                this.$emit("revertToInit");
            },
        },
    };
</script>
<style scoped>
.flexed {
    display: flex;
    margin-top: 2vh;
}
    .goLiveBtn {
        width: 100%;
        background-color: var(--primary);
    }
    h4 {
        font-size: 1.2rem;
        color: #c9c7c7;
    }
    .fs-16 {
        font-size: 16px;
    }
    .featureContainer {
        margin: 1vh 0;
    }
    .featureBackground {
        background-color: #c8cbce;
    }
    .w-70{
        width: 70%;
    }
    @media screen and (max-width: 640px) {
        .featureBackground {
            padding-left: 5vw !important;
        }
        .featureContainer {
            margin: 1vh 0;
            width: 95%;
            margin: auto;
        }
        .feature {
            padding: 2.3vh 1.5vw;
        }
        .w-70 {
            width: 100%;
        }
    }
    .featurePremium {
        background-color: #2e4450;
    }
    .featurePremium:first-child {
        border-top-left-radius: 2rem;
        border-top-right-radius: 2rem;
        padding-top: 4vh;
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
        padding: 2.3vh 4.6vw;
    }
    .feature i {
        font-size: 1rem;
        color: #adf802;
    }
    .btn {
        background-color: var(--primary) !important;
    }
    .smallTextSupport {
        font-family: "Poppins", sans-serif;
        font-size: 0.8rem;
        text-align: center;
        margin: 0;
    }
    .mb-2 {
        margin-bottom: 2rem;
    }
</style>