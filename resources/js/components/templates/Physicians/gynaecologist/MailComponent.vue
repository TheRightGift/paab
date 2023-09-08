<template>
    <div>
        <side-nav-for-mail-component />
        <header-for-mail-component :user="user" />
        <main>
            <section>
                <div v-show="views === 0">
                    <div class="d-flex h-80 justify-center align-center flex-col" v-if="myMails.length <= 0">
                        <div class="noContent">
                            <svg xmlns="http://www.w3.org/2000/svg" width="212" height="228" viewBox="0 0 212 228" fill="none">
                                <path d="M36.793 60.2598C36.793 32.6456 59.1787 10.2598 86.793 10.2598H133.209C160.823 10.2598 183.209 32.6455 183.209 60.2598V105.538H36.793V60.2598Z" fill="url(#paint0_linear_1917_6100)"/>
                                <path d="M161.946 10.2598H86.793C59.1787 10.2598 36.793 32.6455 36.793 60.2598V70.8177V88.1777V105.538" stroke="black" stroke-width="2"/>
                                <path d="M43.7891 40.942C43.7891 27.5639 54.6342 16.7188 68.0123 16.7188C81.3904 16.7188 92.2355 27.5638 92.2355 40.9419V98.001H43.7891V40.942Z" fill="#0C5E67"/>
                                <rect x="103.004" y="105.537" width="13.9956" height="122.193" fill="#109DAD"/>
                                <path d="M44.3287 98.002H92.7751L49.4425 123.84H0.996094L44.3287 98.002Z" fill="url(#paint1_linear_1917_6100)"/>
                                <rect x="12.2832" y="53.3242" width="62.442" height="40.372" rx="5" transform="rotate(-15 12.2832 53.3242)" fill="white"/>
                                <path d="M15 63.4629L21.4382 87.4906C22.1529 90.1579 24.8946 91.7408 27.5619 91.0261L83.0466 76.159" stroke="black" stroke-width="2"/>
                                <path d="M51.2821 68.7794C50.1785 70.2295 48.2344 70.7504 46.5536 70.0464L19.4335 58.6866C15.9158 57.2132 16.2598 52.1206 19.9436 51.1335L64.8706 39.0954C68.5544 38.1083 71.3986 42.3466 69.0889 45.3815L51.2821 68.7794Z" fill="#169AA9"/>
                                <path d="M72.3195 41.4805L54.0176 64.8962" stroke="black" stroke-width="2"/>
                                <path d="M158.984 2.18635C170.558 3.26293 184.392 15.536 186.976 22.6415C187.155 14.926 192.052 0.214325 203.663 11.0682C216.043 22.6415 186.976 7.03098 211.199 1.37891" stroke="black" stroke-width="2"/>
                                <path d="M87.9297 177.939C75.0107 170.941 65.4829 182.407 62.8991 189.513C62.7196 181.797 57.8231 167.085 46.212 177.939C33.8312 189.513 62.8991 173.902 38.6759 168.25" stroke="black" stroke-width="2"/>
                                <path d="M11.0228 52.8771C9.21245 50.9274 5.71702 45.6495 6.21836 40.1348M9.1428 54.1304C6.70575 53.2252 1.66454 50.8299 0.996094 48.4904M13.3206 49.7437C12.2065 48.2118 10.981 44.4797 14.9917 41.8059" stroke="black" stroke-width="2"/>
                                <path d="M195.859 56.0156L197.458 60.7305L201.78 62.4751L197.458 64.2198L195.859 68.9347L194.259 64.2198L189.938 62.4751L194.259 60.7305L195.859 56.0156Z" fill="url(#paint2_radial_1917_6100)"/>
                                <path d="M21.1221 91.2334L23.696 93.3415L26.8158 92.7909L24.9131 95.3239L25.6285 98.5731L23.0546 96.4649L19.9348 97.0156L21.8375 94.4825L21.1221 91.2334Z" fill="url(#paint3_radial_1917_6100)"/>
                                <path d="M76.627 48.748L77.7175 51.8913L80.6642 53.0544L77.7175 54.2175L76.627 57.3607L75.5366 54.2175L72.5898 53.0544L75.5366 51.8913L76.627 48.748Z" fill="url(#paint4_radial_1917_6100)"/>
                                <defs>
                                    <linearGradient id="paint0_linear_1917_6100" x1="110.001" y1="10.2598" x2="110.001" y2="105.538" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#C2EFF4"/>
                                    <stop offset="1" stop-color="#109DAD"/>
                                    </linearGradient>
                                    <linearGradient id="paint1_linear_1917_6100" x1="46.8856" y1="98.002" x2="46.8856" y2="123.84" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#43848B"/>
                                    <stop offset="1" stop-color="#023439"/>
                                    </linearGradient>
                                    <radialGradient id="paint2_radial_1917_6100" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(195.859 62.4751) rotate(90) scale(6.45952 5.92123)">
                                    <stop stop-color="#6AD0DC"/>
                                    <stop offset="1" stop-color="#109DAD"/>
                                    </radialGradient>
                                    <radialGradient id="paint3_radial_1917_6100" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(23.3753 94.9032) rotate(58.4514) scale(4.30635 4.0372)">
                                    <stop stop-color="#6AD0DC"/>
                                    <stop offset="1" stop-color="#109DAD"/>
                                    </radialGradient>
                                    <radialGradient id="paint4_radial_1917_6100" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(76.627 53.0544) rotate(90) scale(4.30635 4.0372)">
                                    <stop stop-color="#6AD0DC"/>
                                    <stop offset="1" stop-color="#109DAD"/>
                                    </radialGradient>
                                </defs>
                            </svg>
                        </div>
                        <h6 class="noMailsHeading">No Mails</h6>
                        <span class="supportWelcomeNote">Lets start and automate your process so you can reclaim time and focus on your goals.</span>
                        <div class="mt-5">
                            <button class="composeMail btn waves waves-effect">Compose Mail</button>
                        </div>
                    </div>
                    <div class="py-5" v-else>
                        <div class="myMessage hover" v-for="mail in myMails" :key="mail.id" :class="{unread: mail.read === 'N'}">
                            <div class="d-flex justify-between align-center" >
                                <div class="d-flex gap align-center">
                                    <p class="m-0">
                                        <label>
                                            <input type="checkbox" />
                                            <span></span>
                                        </label>
                                    </p>
                                    <p class="m-0">{{ mail.from }}</p>
                                </div>
                                <p class="timeAgo">12m</p>
                            </div>
                            <div>
                                <p class="message m-0">
                                    {{ mail.text.slice(0, 275) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-show="views === 1">
                    <div style="width: 711px; height: 397px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 30px; display: inline-flex">
                        <div style="width: 711px; height: 55px; position: relative">
                            <div style="width: 88px; left: 23px; top: 16px; position: absolute; color: #7C8DB5; font-size: 16px; font-family: Montserrat; font-weight: 400; line-height: 24px; word-wrap: break-word">Recipents</div>
                            <div style="width: 711px; height: 55px; left: 0px; top: 0px; position: absolute; border-radius: 15px; border: 0.50px #D9D9D9 solid"></div>
                        </div>
                        <div style="width: 711px; height: 55px; position: relative">
                            <div style="width: 88px; left: 23px; top: 15px; position: absolute; color: #7C8DB5; font-size: 16px; font-family: Montserrat; font-weight: 400; line-height: 24px; word-wrap: break-word">Subject</div>
                            <div style="width: 711px; height: 55px; left: 0px; top: 0px; position: absolute; border-radius: 15px; border: 0.50px #D9D9D9 solid"></div>
                        </div>
                        <div style="width: 711px; height: 227px; position: relative">
                            <div style="width: 88px; left: 23px; top: 14px; position: absolute; color: #7C8DB5; font-size: 16px; font-family: Montserrat; font-weight: 400; line-height: 24px; word-wrap: break-word">Message</div>
                            <div style="width: 711px; height: 227px; left: 0px; top: 0px; position: absolute; border-radius: 15px; border: 0.50px #D9D9D9 solid"></div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</template>
<style scoped>
    .mt-5 {
        margin-top: 5vh;
    }
    .py-5 {
        padding: 5vh 0;
    }
    .h-80 {
        height: 80vh;
    }
    .noContent{
        width: 246px;
        height: 246px;
        background: #F5F5F5;
        border-radius: 9999px;
    }
    .noMailsHeading {
        color: #000;
        text-align: center;
        font-size: 1.5rem;
        font-style: normal;
        font-weight: 500;
        line-height: 150%;
    }
    .supportWelcomeNote {
        width: 485px;
        text-align: center;
    }
    .composeMail {
        width: 236px;
        height: 54px;
        border-radius: 10px;
        outline: none;
        background: #109DAD;
        box-shadow: 0px 4px 19px 0px #109DAD;
        text-transform: capitalize;
    }
    [type="checkbox"]+span:not(.lever) {
        color: #000;
        font-size: 1rem;
        font-style: normal;
        font-weight: 500;
    }
    .unread .message, .unread p {
        font-weight: bolder;
        font-size: 1rem;
    }
    .timeAgo {
        color: #109DAD;
        font-size: 0.75rem;
        font-style: normal;
        font-weight: 500;
        line-height: normal;
    }
    .message {
        color: rgba(0, 0, 0, 0.80);
        font-size: 0.875rem;
        font-style: normal;
        font-weight: 400;
        line-height: 22px; /* 157.143% */
        padding-left: 35px;
    }
    .myMessage {
        padding: 5px 0;
        border-bottom: 1px solid rgba(16, 157, 173, 0.50);
    }
    .hover {
        cursor: pointer;
    }
</style>
<script>    
    import HeaderForMailComponent from '../../../partials/Mails/HeaderForMailComponent.vue';
    import SideNavForMailComponent from "../../../partials/Mails/SideNavForMailComponent.vue";
    export default {
        components: { SideNavForMailComponent, HeaderForMailComponent },
        created() {
            try {
                this.user = JSON.parse(this.bio);
                this.myMails = JSON.parse(this.mails);
            } catch (error) {
                console.error("Invalid JSON format:", error);
            }
        },
        data() {
            return {
                myMails: [],
                user: {},
                views: 0,
            };
        },
        props: {
            bio: String,
            mails: String
        },
    };
</script>