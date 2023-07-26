<template>
    <div>
        <section class="about section scrollspy" id="aboutMe">
            <div class="container">
                <div
                    class="flex gap20 justify-center flex-col align-center relative"
                    v-if="preview === '1'"
                >
                    <div
                        class="profile flex justify-center flex-col align-center"
                    >
                        <div class="profileImage hide-on-small-only">
                            <div class="p-10">
                                <img
                                    src="/media/img/templates/2/profileSample.png"
                                />
                            </div>
                        </div>
                        <p class="introductory">
                            Hello, i’m Doctor Peter,
                            <span>A Pediatrician</span>
                        </p>
                        <p class="introduction">
                            I provide specialized care for infants, children,
                            teenagers and young adults. Their main
                            responsibilities include evaluating, diagnosing and
                            treating various health issues. Pediatricians must
                            also take into account the different characteristics
                            of a growing body and look for any unusual aspects
                            of a child's physical development.
                        </p>
                        <div class="flex mt-2 sm-flex-col gap20 align-center">
                            <a
                                href="#!"
                                class="downloadCv waves waves-effect flex justify-center align-center btnCustom mr-2"
                            >
                                <i class="fa fa-download"></i>
                                Curriculum Vitea
                            </a>
                            <a
                                href="#!"
                                class="callMe waves waves-effect flex justify-center align-center btnCustom"
                            >
                                Call Me
                            </a>
                        </div>
                    </div>
                    <div class="positrix bottom25">
                        <div class="flex justify-center align-center">
                            <div
                                class="socials flex justify-between align-center"
                            >
                                <a class="call" href="tel:16519">
                                    <i class="fa-solid fa-phone"></i
                                    ><span>16519</span>
                                </a>
                                <span>|</span>
                                <a :href="social.src" target="_blank" v-for="social in socials" :key="social">
                                    <i :class="'fa-brands fa-'+social.id"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="flex gap20 justify-center flex-col align-center relative"
                    v-else-if="bio !== null"
                >
                    <div
                        class="profile flex justify-center flex-col align-center"
                    >
                        <div class="profileImage hide-on-small-only">
                            <!-- <div class="hexagon" id="hexagon">
                                <img
                                    :src="'/media/tenants/' + tenant + '/img/' + about.photo"
                                />
    </div> -->
                            <div class="p-10">
                                <img
                                    :src="'/media/tenants/' + tenant + '/img/' + about.photo"
                                />
                            </div>
                        </div>
                        <p class="introductory">
                            Hello, i’m Doctor {{ about.name }},
                            <span>A Pediatrician</span>
                        </p>
                        <p class="introduction">
                            <span v-if="about.about !== null">
                                {{ about.about }}
                            </span>
                            <span v-else>
                                I provide specialized care for infants,
                                children, teenagers and young adults. Their main
                                responsibilities include evaluating, diagnosing
                                and treating various health issues.
                                Pediatricians must also take into account the
                                different characteristics of a growing body and
                                look for any unusual aspects of a child's
                                physical development.
                            </span>
                        </p>
                        <div class="flex mt-2 sm-flex-col gap20 align-center">
                            <a
                                href="#!"
                                class="downloadCv waves waves-effect flex justify-center align-center btnCustom mr-2"
                            >
                                <i class="fa fa-download"></i>
                                Curriculum Vitea
                            </a>
                            <a
                                v-if="phone"
                                :href="'tel:' + contact.phone"
                                class="callMe waves waves-effect flex justify-center align-center btnCustom"
                            >
                                Call Me
                            </a>
                        </div>
                    </div>
                    <div class="positrix" :class="{'bottom25': phone }">
                        <div class="flex justify-center align-center">
                            <div
                                class="socials flex justify-between align-center" :class="{'m-15': contact == null}"
                            >
                                <span v-if="phone">
                                    <a class="call" :href="'tel:' + contact.phone">
                                        <i class="fa-solid fa-phone"></i
                                        ><span>{{ phone }}</span>
                                    </a>
                                    <span>|</span>
                                </span>
                                <a :href="social.src" target="_blank" v-for="social in socials" :key="social">
                                    <i :class="'fa-brands fa-'+social.id"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
<script>
    import CVComponent from "./CVComponent.vue";
    import { dragnDropImg } from "../../dragnDropImg";
    export default {
        components: {
            CVComponent,
        },
        computed: {
            phone() {
                if (this.contact && this.contact.phone) {
                    return this.contact.phone.slice(0, 5);
                }
                return false;
            }
        },
        data() {
            return {
                about: {
                    name: "",
                    photo: null,
                    about: "",
                },
                CVComponentShow: false,
                facebook: "whiteCoatDomain",
                twitter: "WhiteCoatD_HQ",
                tiktok: "scout2015",
                instagram: "CoUVYkmj6__",
                loading: false,
                id: "",
                socials: [],
                txt: "Sed porttitor lectus nibh. Proin eget tortor risus. Curabitur aliquet quam id dui posuere blandit. Vestibulum ante ipsum primis Pellentesque in ipsum id orci porta dapibus. Nulla porttitor accumsan tincidunt. Curabitur arcu erat",
            };
        },
        methods: {},
        mixins: [dragnDropImg],
        props: {
            bio: Object,
            user: String,
            services: Array,
            location: String,
            preview: String,
            title: String,
            tenant: String,
            templateID: String,
            isLoggedIn: Boolean,
            CV: Object,
            contact: Object,
            template_id: String,
            social: String,
        },
        watch: {
            bio(newval, oldval) {
                if (newval) {
                    this.about.name =
                        newval.firstname +
                        " " +
                        newval.lastname;
                    this.about.about = newval.about;
                    // this.about.about = this.about.about.replace(/Dr\. [A-Za-z]+|she\/he [A-Za-z]+/g, "I am");
                    this.about.photo = newval.photo;
                }
            },
            CV(newval, oldval) {
                console.log(newval);
                if (newval.summary !== null) {
                    // newval.license !== null &&
                    this.CVComponentShow = true;
                }
            },
       
            social: {
                handler(newVal, olVal) {
                    let facebook = {
                        id: 'facebook-f',
                        src: `https://www.facebook.com/${this.facebook}`,
                    };
                    let twitter = {
                        id: 'twitter',
                        src: `https://twitter.com/${this.twitter}?ref_src=twsrc%5Etfw`,
                    };
                    let instagram = {
                        id: 'instagram',
                        src: `https://www.instagram.com/reel/${this.instagram}/embed/captioned/?cr=1&v=14&wp=326&rd=http%3A%2F%2F127.0.0.1%3A8000&rp=%2Fpreview%2F1#%7B%22ci%22%3A0%2C%22os%22%3A3489.7999999998137%2C%22ls%22%3A3373.899999999441%2C%22le%22%3A3393.5%7D"`,
                        color: 'red'
                    };
                    let tiktok = {
                        id: 'tiktok',
                        src: `<blockquote class="tiktok-embed" cite="https://www.tiktok.com/@${this.tiktok}" data-unique-id="${this.tiktok}" data-embed-from="oembed" data-embed-type="creator" style="max-width: 780px; min-width: 288px; width: 32rem;" > <section> <a target="_blank" href="https://www.tiktok.com/@${this.tiktok}?refer=creator_embed">@${this.tiktok}</a> </section> </blockquote>`,
                        color: 'red'
                    };
                    if (newVal !== null && newVal !== '' && this.preview === '0') {
                        newVal = JSON.parse(newVal);
                        this.facebook = newVal.facebook;
                        this.twitter = newVal.twitter;
                        this.instagram = newVal.instagram;
                        this.tiktok = newVal.tiktok;
                        this.id = newVal.id;
                        if (newVal.facebook !== '' && newVal.facebook !== null) {
                            facebook = {
                                id: 'facebook-f',
                                src: `https://www.facebook.com/${newVal.facebook}`,
                            }
                            this.socials.push(facebook);
                        }
                        if (newVal.twitter !== '' && newVal.twitter !== null) {
                            twitter = {
                                id: 'twitter',
                                src: `https://twitter.com/${newVal.twitter}?ref_src=twsrc%5Etfw`,
                            }
                            this.socials.push(twitter);
                        }
                        if (newVal.instagram !== '' && newVal.instagram !== null) {
                            instagram = {
                                id: 'instagram',
                                src: `https://www.instagram.com/reel/${newVal.instagram}/embed/captioned/?cr=1&v=14&wp=326&rd=http%3A%2F%2F127.0.0.1%3A8000&rp=%2Fpreview%2F1#%7B%22ci%22%3A0%2C%22os%22%3A3489.7999999998137%2C%22ls%22%3A3373.899999999441%2C%22le%22%3A3393.5%7D`,
                                color: 'red'
                            }
                            this.socials.push(instagram);
                        }
                        if (newVal.tiktok !== '' && newVal.tiktok !== null) {
                            tiktok = {
                                id: 'tiktok',
                                src: `https://www.tiktok.com/@${newVal.tiktok}?refer=creator_embed`,
                                color: 'red'
                            }
                            this.socials.push(tiktok);
                        }
                    } else if (this.preview == '1') {
                        this.facebook = 'whiteCoatDomain';
                        this.twitter = 'WhiteCoatD_HQ';
                        this.instagram = 'CoUVYkmj6__';
                        this.tiktok = 'scout2015';
                        this.socials = [
                            {
                                id: 'facebook-f',
                                src: `https://www.facebook.com/${this.facebook}`,
                            },
                            {
                                id: 'twitter',
                                src: `https://twitter.com/${this.twitter}?ref_src=twsrc%5Etfw`,
                            },
                            {
                                id: 'instagram',
                                src: `https://www.instagram.com/reel/${this.instagram}/embed/captioned/?cr=1&v=14&wp=326&rd=http%3A%2F%2F127.0.0.1%3A8000&rp=%2Fpreview%2F1#%7B%22ci%22%3A0%2C%22os%22%3A3489.7999999998137%2C%22ls%22%3A3373.899999999441%2C%22le%22%3A3393.5%7D`,
                                color: 'red'
                            },
                            {
                                id: 'tiktok',
                                src: `https://www.tiktok.com/@${this.tiktok}`,
                                color: 'red'
                            }
                        ]
                    } else if (newVal === '') {
                        this.socials = [
                            {
                                id: 'facebook-f',
                                src: `https://www.facebook.com`,
                            },
                            {
                                id: 'twitter',
                                src: `https://www.twitter.com`,
                            },
                            {
                                id: 'instagram',
                                src: `https://www.instagram.com`,
                                color: 'red'
                            },
                            {
                                id: 'tiktok',
                                src: `https://www.tiktok.com`,
                                color: 'red'
                            }
                        ]
                    }
                },
                deep: true,
                immediate: true,
            }
        },
    };
</script>