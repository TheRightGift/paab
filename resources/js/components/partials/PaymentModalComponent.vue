<template>
    <div>
        <div id="paymentModal" class="modal">
            <div class="modal-content">
                <div v-if="!paymentSuccessful">
                    <div class="payment-title flexed">
                        <h1>Payment Information</h1>
                        <a href="#!" class="modal-close waves-effect waves-green btn right"><i class="fa-solid fa-xmark"></i></a>
                    </div>
                    <form id="payment-form">
                        <div class="form-container">
                            <div class="field-container">
                                <div class="mb-2">
                                    <label for="name" class="browser-default">Card Holder Name *</label>
                                    <input id="name" maxlength="20" type="text" class="browser-default" v-model="name">
                                </div>
                                <div class="mb-2">
                                    <label for="name" class="browser-default">Coupon<i>(If any)</i></label>
                                    <input id="coupon" maxlength="20" type="text" class="browser-default" v-model="coupon">
                                </div>
                                <div>
                                    <label>Card</label>
                                    <div id="card-element">
                                        
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="field-container">
                            </div> -->
                            
                        </div>
                        <div id="card-element-errors" role="alert"></div>
                        <div class="row">
                            <div class="col s12 l8 m8">
                                <button  id="add-card-button" class="waves waves-effect btn-large deep-purple lighten-2" @click.prevent="subscribe">
                                    <span v-if="!requesting"><i class="fas fa-lock"></i> Subscribe</span>
                                    <span class="fas fa-circle-notch fa-spin" v-else></span>
                                </button>
    
                            </div>
                        </div>
                    </form>
                </div>
                <div v-else class="flex-d">
                    <p class="check">
                        <i class="fa-solid fa-check"></i>
                    </p>
                    <h5 class="centered p-0">Scuccessful</h5>
                    <p class="centered text">Congratulations on the successful creation of your website! You have opted for a yearly plan that includes both hosting and domain registration at a cost of $144. Please note that your service will renew automatically one year from today. You should have received an email containing your login credentials, which will grant you access to the backend of your website. From there, you can add additional services and make any necessary updates. Thank you for choosing WhiteCoatDomain.</p>
                    <button class="modal-close waves-effect waves-green btn btn-rounded" @click="countDown">Close</button>
                </div>
            </div>
        </div>
    </div>

</template>
<script>

    export default {
        computed: {
            

        },  
        data() {
            return {
                coupon: "",
                email: "",
                cardNumber: "",
                code: "",
                expiry: "",
                stripe: '',
                elements: '',
                card: '',
                stripeAPIToken:  process.env.MIX_STRIPE_WEBHOOK_SECRET,
                intentToken: '',
                name: '',
                addPaymentStatus: 0,
                addPaymentStatusError: '',
                paymentMethods: [],
                requesting: false,
                plan: 'price_1Ma5RZIrcfsuhLLFylMzHuP4',
                paymentMethodSelected: {},
                paymentSuccessful: 0,
            }
        },
        props: {
            setModal: Boolean,
            user: Number,
            domainName: String,
            bio: Object,
        },
        methods: {
            addOneYear(date) {
                date.setFullYear(date.getFullYear() + 1);
                return date;
            },
            countDown() {
                this.$emit('countDown', true);
            },
            /*
                Configures Stripe by setting up the elements and
                creating the card element.
            */
            configureStripe(){
                const appearance = {
                    theme: 'stripe',
                    variables: {
                        colorPrimary: '#0570de',
                        colorBackground: '#ffffff',
                        colorText: '#30313d',
                        colorDanger: '#df1b41',
                        fontFamily: 'Ideal Sans, system-ui, sans-serif',
                        spacingUnit: '2px',
                        borderRadius: '4px',
                        // See all possible variables below
                    }
                };
                this.stripe = Stripe( this.stripeAPIToken );
                this.elements = this.stripe.elements();
                this.card = this.elements.create('card');

                this.card.mount('#card-element');
                this.card.on('change', function (event) {
                    this.displayError(event);
                });
                
            },
            /*
       Includes Stripe.js dynamically
   */
            includeStripe( URL, callback ){
                let documentTag = document, tag = 'script',
                    object = documentTag.createElement(tag),
                    scriptTag = documentTag.getElementsByTagName(tag)[0];
                object.src = '//' + URL;
                if (callback) { object.addEventListener('load', function (e) { callback(null, e); }, false); }
                scriptTag.parentNode.insertBefore(object, scriptTag);
            },
            /*
                Loads the payment intent key for the user to pay.
            */
            loadIntent(){
                axios.get(`/api/v1/user/setup-intent?GUID=${this.user}`)
                    .then( function( response ){
                        this.intentToken = response.data;
                    }.bind(this));
            },
            /*
    Loads all of the payment methods for the
    user.
*/
            loadPaymentMethods(){
                axios.get(`/api/v1/user/payment-methods?GUID=${this.user}`)
                    .then( function( response ){
                        this.paymentMethods = response.data;
                        this.paymentMethodSelected = response.data[0].id;
                    }.bind(this));
            },
            removePaymentMethod( paymentID ){
                axios.post('/api/v1/user/remove-payment', {
                    id: paymentID
                }).then( function( response ){
                    this.loadPaymentMethods();
                }.bind(this));
            },
            /*
    Saves the payment method for the user and
    re-loads the payment methods.
*/
            savePaymentMethod( method ){
                axios.post(`/api/v1/user/payments?GUID=${this.user}`, {
                    payment_method: method,
                }).then( function(){
                    this.loadPaymentMethods();
                    this.updateSubscription();
                }.bind(this));
            },
            /**
             * Subscribe::Saves the card and customer to DB as stripe customer
            **/
            updateSubscription(){
                const queryString = window.location.search;

                // Create an object with key-value pairs of each parameter
                const params = new URLSearchParams(queryString);

                // Get the value of a specific parameter, e.g. "param1"
                const claimable = params.get('claimable');

                let data = {
                    plan: this.plan, // Only premium plan
                    payment: this.paymentMethodSelected,
                    tenant_id: claimable,
                    email: localStorage.getItem('email'),
                    // domain: this.domainName,
                    // firstname: this.bio.firstname,
                    // lastname: this.bio.lastname,
                    // password: localStorage.getItem("passwordGen"),
                }
                if (this.coupon !== '') data.coupon = this.coupon;
                axios.put(`/api/v1/user/subscription?GUID=${this.user}`, data).then( function( response ){
                    this.requesting = !this.requesting;
                    this.paymentSuccessful = 1;
                    this.$emit('popupClose');
                    M.toast({
                        html: 'You have successfuly subscribed to domain premium plan!',
                        classes: 'successNotifier'
                    })
                    localStorage.removeItem("passwordGen");
                }.bind(this)).catch(err => {
                    console.log(err)
                    if (err.response.status === 500) {
                        M.toast({
                            html: err.response.data.message,
                            classes: 'errorNotifier'
                        });
                        this.loadIntent();
                    }
                    this.requesting = !this.requesting;
                });
            },
            subscribe() {
                this.addPaymentStatus = 1;
                this.requesting = !this.requesting;
                this.stripe.confirmCardSetup(
                    this.intentToken.client_secret, {
                        payment_method: {
                            card: this.card,
                            billing_details: {
                                name: this.name
                            }
                        }
                    }
                ).then(function(result) {
                    if (result.error) {
                        this.addPaymentStatus = 3;
                        this.addPaymentStatusError = result.error.message;
                        this.requesting = !this.requesting;
                    } else {
                        this.savePaymentMethod( result.setupIntent.payment_method );
                        this.addPaymentStatus = 2;
                        this.card.clear();
                        this.name = '';
                    }
                }.bind(this));
            },
            displayError(event){
                this.requesting = false;
                let displayError = document.getElementById('card-element-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            }
        },
        mounted() {
            this.includeStripe('js.stripe.com/v3/', function(){
                this.configureStripe();
            }.bind(this) );
            let card = document.getElementById('card-element');
            var vue = this;
            card.addEventListener('change', function (event) {
                vue.displayError(event);
            });
        },
        watch: {
            setModal(newval, oldval) {
                if (newval === true) {
                    this.loadIntent();
                    this.loadPaymentMethods();
                }
            }
        },

    }
</script>
<style scoped >
.mb-2 {
    margin-bottom: 2rem;
}
.p-0 {
    padding: 0 !important;
}
.btn-rounded {
    border-radius: 20px;
    background-color: #fff !important;
    color: var(--primary);
}
.text {
    font-size: 1.1rem;
    padding: 0;
}
.cheer {
    padding: 0 !important;
    font-size: 1.2rem;
}
.flex-d {
    display: flex;
    align-items: center;
    flex-direction: column;
    font-family: Poppins, 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
}
.check {
    text-align: center;
    font-size: 2rem;
    background-color: limegreen;
    width: 60px;
    height: 60px;
    line-height: 60px;
    border-radius: 50%;
    color: white;
}
.payment-title h1{
    font-size: 2.5rem;
}
.flexed {
    display: flex;
    justify-content: space-between !important;
    align-items: unset !important;
}
.form-container .field-container:first-of-type {
    grid-area: name;
}

.form-container .field-container:nth-of-type(2) {
    grid-area: coupon;
}

/* .form-container .field-container:nth-of-type(3) {
    grid-area: expiration;
}

.form-container .field-container:nth-of-type(4) {
    grid-area: security;
}
.form-container .field-container:nth-of-type(5) {
    grid-area: coupon;
} */

.field-container input {
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}

.field-container {
    position: relative;
}

.form-container {
    display: grid;
    grid-column-gap: 10px;
    grid-template-columns: auto auto;
    grid-template-rows: 90px 90px 90px;
    grid-template-areas: "name name""number number""expiration security";
    /* max-width: 400px; */
    padding: 20px;
    color: #707070;
}

label {
    padding-bottom: 5px;
    font-size: 13px;
}

input {
    margin-top: 3px;
    padding: 15px;
    font-size: 16px;
    width: 100%;
    border-radius: 3px;
    border: 1px solid #dcdcdc;
}

.ccicon {
    height: 38px;
    position: absolute;
    right: 6px;
    top: calc(50% - 17px);
    width: 60px;
}

/* CREDIT CARD IMAGE STYLING */
.preload * {
    -webkit-transition: none !important;
    -moz-transition: none !important;
    -ms-transition: none !important;
    -o-transition: none !important;
}

.container {
    width: 100%;
    max-width: 400px;
    max-height: 251px;
    height: 54vw;
    padding: 20px;
}

#ccsingle {
    position: absolute;
    right: 15px;
    top: 20px;
}

#ccsingle svg {
    width: 100px;
    max-height: 60px;
}

.creditcard svg#cardfront,
.creditcard svg#cardback {
    width: 100%;
    -webkit-box-shadow: 1px 5px 6px 0px black;
    box-shadow: 1px 5px 6px 0px black;
    border-radius: 22px;
}

body {
    margin: 0;
    padding: 0;
    background-color: #f9f9f9;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-line-pack: center;
    align-content: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    min-height: 100vh;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    font-family: 'Raleway';
}

.payment-title {
    width: 100%;
    text-align: center;
}
</style>
