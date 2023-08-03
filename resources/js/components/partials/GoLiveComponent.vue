<template>
    <div class="flex justify-center gap-30 sm-flex-col" >
        <div
            :style="packard.background"
               
            v-for="(packard, index) in packages"
            :key="index"
            class="contenta"
        >
            <div class="flex justify-between">
                <p class="packageName m-0">{{ packard.name }}</p>
                <span class="saveUp" :style="{color: packard.color}">Save 40%</span>
            </div>
            <ul>
                <li
                    v-for="feature in packard.features"
                    :key="feature"
                    class="feature flex align-center"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="10"
                        height="10"
                        viewBox="0 0 10 10"
                        fill="none"
                    >
                        <g clip-path="url(#clip0_1740_28551)">
                            <path
                                d="M3.80533 8.99998C3.50111 8.99998 3.21298 8.88397 3.02835 8.68396L0.529596 5.98599C0.452341 5.90267 0.395941 5.80772 0.363618 5.70658C0.331296 5.60544 0.323685 5.50008 0.341222 5.39653C0.358758 5.29298 0.401097 5.19327 0.465819 5.1031C0.530542 5.01293 0.616377 4.93407 0.718419 4.87103C0.820424 4.80772 0.936716 4.76149 1.06063 4.73497C1.18454 4.70846 1.31364 4.70219 1.44052 4.71653C1.5674 4.73086 1.68958 4.76552 1.80004 4.81851C1.9105 4.8715 2.00708 4.94178 2.08424 5.02533L3.7284 6.79921L7.86223 1.3747C7.99932 1.1956 8.21775 1.06824 8.4696 1.02057C8.72145 0.972893 8.98616 1.00879 9.20567 1.12039C9.66234 1.35241 9.80291 1.84389 9.51757 2.21764L4.63335 8.62395C4.54997 8.7338 4.43505 8.82536 4.29856 8.89069C4.16206 8.95602 4.00812 8.99315 3.85008 8.99884C3.8347 8.99998 3.82071 8.99998 3.80533 8.99998Z"
                                fill="white"
                            />
                        </g>
                        <defs>
                            <clipPath id="clip0_1740_28551">
                                <rect
                                    width="9.92"
                                    height="8.32"
                                    fill="white"
                                    transform="translate(0.0390625 0.839996)"
                                />
                            </clipPath>
                        </defs>
                    </svg>
                    {{ feature }}
                </li>
            </ul>
            <div class="flex align-baseline mb-1">
                <p class="amount m-0">&dollar;{{ packard.amount }}</p>
                <p class="term m-0">/Annual</p>
            </div>
            <div>
                <a href="#paymentModal" @click="revertToInit(packard.stripe_plan)" class="btn waves waves-effect packageButton flex align-center justify-center modal-trigger" :style="packard.btnBackground">Try 1 Year</a>
            </div>
        </div>
               
    </div>
    <div class="flexed grey-text text-lighten mb-2 justify-center">
        <i class="material-icons fs-16">info_outline</i>
        <p class="smallTextSupport">
            Your subscription auto renews until you cancel
        </p>
    </div>
</template>
<script>
    let url = process.env.MIX_APP_URL;
    export default {
        computed: {
            extractDomain() {
                let index = window.location.hostname.indexOf('.');
                let path = index.valueOf(1);
                return path;
            }
        },
        data() {
            return {
                packages: [
                    {
                        name: ".doctor",
                        features: [
                            "Pro website templates",
                            "Secured website",
                            "Custom domain name",
                            "Domain hosting",
                            "Branded Email",
                            "Social Media Stream",
                        ],
                        background: "background: #1f1366",
                        amount: 213.04,
                        btnBackground: 'background: #4A39AE;',
                        color: '#4A39AE',
                        stripe_plan: 'price_1NZuDQGol1wahrlSximl9naO',
                        // stripe_plan: 'price_1NZx3kGol1wahrlSntmwDVf1',
                    },
                    {
                        name: ".com",
                        features: [
                            "Pro website templates",
                            "Secured website",
                            "Custom domain name",
                            "Domain hosting",
                            "Branded Email",
                            "Social Media Stream",
                        ],
                        background: "background: #1b4475",
                        amount: 144,
                        btnBackground: 'background: #4786D1;',
                        color: '#4A39AE',
                        stripe_plan: 'price_1N9xKmGol1wahrlSl4XkMDTn',
                        // stripe_plan: 'price_1NDmVnGol1wahrlS4LGzwUT8',
                    },
                ],
            };
        },
        methods: {
            revertToInit(value) {
                this.$emit("revertToInit", value);
            },
            getPlans() {
                axios.get(`${url}/api/plans`).then(res => {
                    // Leave for future
                }).catch(err => {
                    console.log(err);
                });
            }
        },
        mounted() {
            // this.getPlans();
        }
    };
</script>
<style scoped>
    .flexed {
        display: flex;
        margin-top: 2vh;
    }
    .gap-30 {
        gap: 5vw;
    }
    .packageName {
        color: #fff;
        font-family: "Inter", sans-serif;
        font-size: 1.5rem;
        font-style: normal;
        font-weight: 700;
        line-height: normal;
    }
    .feature {
        color: #fff;
        font-family: "Inter", sans-serif;
        font-size: 1rem;
        font-style: normal;
        font-weight: 400;
        line-height: normal;
        padding: 1vh 0;
        gap: 1vw;
    }
    .amount {
        color: #FFF;
        font-family: 'Inter', sans-serif;
        font-size: 1.563rem;
        font-style: normal;
        font-weight: 700;
        line-height: normal;
    }
    .term {
        color: #FFF;
        font-family: 'Inter', sans-serif;
        font-size: 1.063rem;
        font-style: normal;
        font-weight: 400;
        line-height: normal;
        opacity: 0.6800000071525574;
    }
    .align-baseline {
        align-items: baseline;
    }
    .packageButton {
        width: 212px;
        height: 48px;
        border-radius: 8px;
        font-size: 1.25rem;
        font-weight: 700;
        font-family: 'Inter', sans-serif;
    }
    .fs-16 {
        font-size: 16px;
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
    .contenta {
        width: 260px;
        height: 417px;
        border-radius: 24px;
        padding: 24px;
    }
    .saveUp {
        background-color: #fff;
        padding: 0.5vh 1vw;
        font-size: 0.625rem;
        font-family: 'Inter', sans-serif;
    }
</style>