<template>
    <div>
        <div class="row noMarginBottom" id="publicFeatures">
            <div class="col l6 s12 optionSettingBackground">
                <p @click="$emit('backToSettings')">
                    <a class="btn-flat"
                        ><i class="material-icons left">chevron_left</i>Back</a
                    >
                </p>
                <h5>
                    {{ modalTitle }}
                </h5>
            </div>
            <div class="col l6 s12 optionSettingContainer">
                <div>
                    <div class="row hPadding-1">
                        <h3
                            class="settingOptionSectionTitle col l12 noMarginBottom"
                        >
                            Billing
                        </h3>

                        <div class="row">
                            <div class="col s12 m12">
                                <div class="card custom-color">
                                    <div class="card-content white-text">
                                        <span class="card-title">
                                            Premium
                                            <p class="right">{{ renewalDate }} days remaining</p>
                                        </span>
                                        <small
                                            >Includes access to all settings to
                                            enhance your site</small
                                        >
                                        <div class="card inner-custom">
                                            <div class="card-content">
                                                <div class="flex">
                                                    <div class="card-img">
                                                        <img
                                                            :src="
                                                                '/media/img/' +
                                                                selectCardImg(
                                                                    defaultCard.brand
                                                                )
                                                            "
                                                            class="responsive-img cardo"
                                                            width="60"
                                                            alt="card-default image"
                                                        />
                                                    </div>
                                                    <div class="card-details">
                                                        <p class="capitalize">
                                                            {{
                                                                defaultCard.brand
                                                            }}
                                                            ending in
                                                            {{
                                                                defaultCard.last_four
                                                            }}
                                                        </p>
                                                        <p
                                                            class="grey-text darken-3"
                                                        >
                                                            Expiry
                                                            {{
                                                                defaultCard.exp_month
                                                            }}/{{
                                                                defaultCard.exp_year
                                                            }}
                                                        </p>
                                                        <p
                                                            class="grey-text darken-3 billing"
                                                        >
                                                            <i
                                                                class="material-icons pr-1"
                                                                >mail_outline</i
                                                            >{{ email }}
                                                        </p>
                                                    </div>
                                                    <p>
                                                        <a
                                                            href="#"
                                                            class="white-text"
                                                            >Edit</a
                                                        >
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" v-if="paymentMethods.length > 1">
                            <div class="col s12 m12">
                                <h5>Cards</h5>
                                <div class="card cardso">
                                    <div class="card-content">
                                        <form action="#">
                                            <p
                                                v-for="(
                                                    card, idx
                                                ) in paymentMethods"
                                                :key="card.id"
                                            >
                                                <label>
                                                    <input
                                                        name="group1"
                                                        type="radio"
                                                        :checked="idx == 0"
                                                    />
                                                    <span
                                                        class="black-text capitalize"
                                                        >{{ card.brand }} ****{{
                                                            card.last_four
                                                        }}</span
                                                    >
                                                </label>
                                                <a
                                                    href=""
                                                    class="right"
                                                    @click.prevent="
                                                        removePaymentMethod(
                                                            card
                                                        )
                                                    "
                                                    >Remove</a
                                                >
                                            </p>
                                            <a
                                                class="waves waves-effect grey-text darken-1"
                                                >Update</a
                                            >
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m12">
                                <h5>Billing History</h5>
                                <table class="responsive-table">
                                    <thead>
                                        <tr>
                                            <th>Invoice</th>
                                            <th>Date</th>
                                            <th>-</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr v-for="invoice in invoices" :key="invoice.id">
                                            <td>{{invoice.id.slice(0, 10)}}</td>
                                            <td>{{invoice.created}}</td>
                                            <td><a :href="URL+'/user/invoice/'+invoice.id+'/'+user" target="_blank">View</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
    .capitalize {
        text-transform: capitalize;
    }
    a.waves {
        font-size: 1.1rem;
        padding: 10px 15px;
    }
    .pr-1 {
        padding-right: 0.5vw;
    }
    .custom-color {
        background-color: #111727;
        border-radius: 10px;
    }
    .cardo {
        border-radius: 5px;
    }
    .inner-custom {
        background-color: #27303d;
        border-radius: 10px;
    }
    .card.custom-color .card-content {
        padding: 10px;
    }
    .card .card-content .card-title {
        font-size: 1.1rem;
        margin-bottom: 0;
    }
    .flex {
        display: flex;
    }
    .card-img {
        margin-right: 1vw;
    }
    .card-details {
        font-size: 0.85rem;
        font-family: Poppins, sans-serif;
    }
    .billing {
        display: flex;
        align-items: center;
    }
    .cardso {
        border-radius: 15px;
        background-color: ghostwhite;
    }
    .cardso .card-content {
        padding: 15px;
    }
</style>
<script>
    export default {
        data() {
            return {
                loading: false,
                update: 0,
                renewalDate: "",
                URL: process.env.MIX_APP_URL,
                invoices: [],
            };
        },
        methods: {
            downloadInvoice (invoice) {
                axios.get('/user/invoice/'+invoice+'/'+this.user).then(res => {
                    console.log(res);
                }).catch(err => {
                    console.log(err);
                })
            },
            selectCardImg(brand) {
                let cardImgs = {
                    visa: "visa.png",
                    mastercard: "mastercard.png",
                    american_express: "americanExpress.png",
                    jcb: "jcb.png",
                    diners_club: "dinersClub.png",
                    union_pay: "unionPay.png",
                };
                for (let key in cardImgs) {
                    if (key === brand) {
                        return cardImgs[key];
                    }
                }
                return "default.png";
            },
            removePaymentMethod(paymentID) {
                this.$emit("reloadPayment");
                axios
                    .post(`${this.URL}/api/v1/user/remove-payment`, {
                        id: paymentID,
                    })
                    .then(
                        function (response) {
                            this.loadPaymentMethods();
                        }.bind(this)
                    );
            },
            getExpiry() {
                axios
                    .get("/api/get_expiry")
                    .then((res) => {
                        this.renewalDate = res.data;
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            },
            getInvoices () {
                axios
                    .get("/api/get_invoices")
                    .then((res) => {
                        this.invoices = res.data;
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            }
        },
        mounted() {
            this.getExpiry();
            this.getInvoices();
        },
        props: {
            modalTitle: String,
            paymentMethods: Array,
            defaultCard: Object,
            email: String,
            user: Number,
        },
    };
</script>