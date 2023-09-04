<template>
    <div>
        <section class="about section scrollspy" id="aboutMe">
            <div class="container">
                <div class="flex sm-flex-col justify-between sm-justify-center align-center" v-if="preview === '1'">
                    <div class="profile">
                        <p class="introductory sm-text-center">
                            Hello, i’m Doctor Peter,
                            <span>A Gynecologist</span>
                        </p>
                        <p class="introduction">
                            As a respected member of the medical community, has contributed to numerous research studies and publications, sharing their knowledge and insights with colleagues. They are also actively involved in professional organisations, attending conferences and workshops to collaborate with peers and promote advancements in healthcare.
                        </p>
                        <div class="flex mt-2 sm-flex-col align-center gap15">
                            <a href="#!" class="downloadCv waves waves-effect flex justify-center align-center btnCustom mr-2">
                                <i class="fa fa-download"></i>
                                Curriculum Vitea
                            </a>
                            <a href="#!" class="callMe waves waves-effect flex justify-center align-center btnCustom">
                                Call Me
                            </a>
                        </div>
                    </div>
                    <div>
                        <div class="profileImage relative hide-on-small-only">
                            <img src="/media/img/templates/1/profileSample.png" class="responsive-img image" />
                            <p class="happyP">Happy Patients</p>
                            <p class="service24">24/7 Service</p>
                        </div>
                        <div class="flex justify-center align-center ">
                            <div class="socials flex justify-between align-center">
                                <a class="call" href="">
                                    <i class="fa-solid fa-phone"></i><span>16519</span>
                                </a>
                                <span>|</span>
                                <a :href="social.src" target="_blank" v-for="social in socials" :key="social">
                                    <i :class="'fa-brands fa-'+social.id"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex sm-flex-col justify-between sm-justify-center align-center" v-else-if="bio !== null">
                    <div class="profile">
                        <div class="flex align-center">
                            <p class="introductory sm-text-center">
                                Hello, I’m Doctor <span  v-if="!editing">{{ about.name }}</span> <input v-else type="text" class="custom-edit-field browser-default" v-model="about.name" />,
                                <span class="specialty">A {{ professionTitle !== ''  ? professionTitle  : 'Gynecologist' }}</span>
                            </p>
                            <div class="flex justify-between align-center" v-if="editing">
                                <div class="ml-3">
                                    <span v-if="editNames">
                                        <i class="fa-solid fa-gear primary fs-1 fa-spin"></i>
                                    </span>
                                    <span v-else>
                                        <a href="#!"><i class="fa-regular fa-circle-xmark primary fs-1" @click="edit(0)"></i></a>
                                        <a href="#!" class="pl-3" @click="confirmUpdateName"><i class="fa-solid fa-check primary fs-1"></i></a>
                                    </span>
                                </div>
                                
                            </div>
                            <div v-if="isLoggedIn" class="pl-3">
                                <a href="#!" @click="edit(0)"  v-show="!editing">
                                    <i class="fa-solid fa-pen primary fs-1"></i>
                                </a>
                            </div>
                        </div>
                        <div class="flex justify-between align-center">
                            <p class="introduction" v-if="!editingAbout">
                                <span v-if="about.about !== null">
                                    {{ about.about }}
                                </span>
                                <span v-else>
                                    As a respected member of the medical community,I have contributed to numerous research studies and publications, sharing their knowledge and insights with colleagues. They are also actively involved in professional organisations, attending conferences and workshops to collaborate with peers and promote advancements in healthcare.
                                </span>
                            </p>
                            <div class="flex justify-between align-center" v-else>
                                <textarea class="custom-textarea-field" v-model="about.about" maxlength="600"></textarea>
                                <div class="ml-3">
                                    <span v-if="editAbout">
                                        <i class="fa-solid fa-gear primary fs-1 fa-spin"></i>
                                    </span>
                                    <span v-else>
                                        <a href="#!"><i class="fa-regular fa-circle-xmark primary fs-1" @click="edit(1)"></i></a>
                                        <a href="#!" class="pl-3" @click="confirmUpdateAbout"><i class="fa-solid fa-check primary fs-1"></i></a>
                                    </span>
                                </div>
                                
                            </div>
                            <div v-if="isLoggedIn && !editingAbout" class="pl-3">
                                <a href="#!" @click="edit(1)"  v-show="!editingAbout">
                                    <i class="fa-solid fa-pen primary fs-1"></i>
                                </a>
                            </div>
                        </div>
                        <div class="flex mt-2 sm-flex-col align-center gap15">
                            <a href="#!" class="downloadCv waves waves-effect flex justify-center align-center btnCustom mr-2">
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

                    <div>
                        <div class="imageContainer relative hide-on-small-only">
                            <div class="profileImage">
                                <img src="" v-show="uploaded" id="uploadedImage" class="responsive-img image"/>
                                <img :src="'/media/tenants/' + tenant + '/img/' + about.photo" class="responsive-img image" v-show="!uploaded"/>
                                
                                <p class="happyP">Happy Patients</p>
                                <p class="service24">24/7 Service</p>
                            </div>
                            <div class="overlay" v-show="isLoggedIn">
                                <i class="fa-solid fa-gear white-text fa-2x fa-spin" v-if="loading"></i>
                                <label for="file-input" class="upload-label" v-else>
                                    <img src="/media/img/upload.svg" class="responsive-img" />
                                    <span class="inlBlock black-text">Drag &amp; Drop Image or</span>
                                    <span class="inBlock browse">Browse</span>
                                    <input type="file" id="file-input" accept="image/*" />
                                </label>
                            </div>
                        </div>
                        <div class="flex justify-center align-center ">
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
                                <!-- <span > -->
                                    <template v-if="!editingSocials">
                                        <a :href="social.src" target="_blank" v-for="social in socials" :key="social" >
                                            <i :class="'fa-brands fa-'+social.id"></i>
                                        </a>
                                    </template>
                                <!-- </span> -->
                                <div class="flex justify-between align-center" v-if="editingSocials">
                                    <div class="input-container" v-for="social in socials" :key="social">
                                        <i :class="'fa-brands fa-'+social.id"></i>
                                        <input type="text" autofocus placeholder="" class="custom-edit-field browser-default" v-model="social.handle" @input="updateHandle(social.id, social.handle)">
                                    </div>
                                    <div class="ml-3">
                                        <span v-if="editSocials">
                                            <i class="fa-solid fa-gear primary fs-1 fa-spin"></i>
                                        </span>
                                        <span v-else class="flex">
                                            <a href="#!"><i class="fa-regular fa-circle-xmark primary fs-1" @click="edit(2)"></i></a>
                                            <a href="#!" class="pl-3" @click="confirmUpdateSocials"><i class="fa-solid fa-check primary fs-1"></i></a>
                                        </span>
                                    </div>
                                </div>
                                <div v-if="isLoggedIn" >
                                    <a href="#!" @click="edit(2)"  v-show="!editingSocials" class="pl-3">
                                        <i class="fa-solid fa-pen primary fs-1"></i>
                                    </a>
                                </div>
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
            },
            aboutCount() {
                return this.about.about != null ?  this.about.about.length : "";
            },
        },
        data() {
            return {
                about: {
                    name: "",
                    photo: null,
                    about: "",
                },
                CVComponentShow: false,
                editing: false,
                editingAbout: false,
                editingSocials: false,
                editAbout: false,
                editNames: false,
                editSocials: false,
                errors: [],
                facebook: "",
                twitter: "",
                tiktok: "",
                instagram: "",
                loading: false,
                id: "",
                socials: [],
                uploaded: false,
                update: false,
                txt: "Sed porttitor lectus nibh. Proin eget tortor risus. Curabitur aliquet quam id dui posuere blandit. Vestibulum ante ipsum primis Pellentesque in ipsum id orci porta dapibus. Nulla porttitor accumsan tincidunt. Curabitur arcu erat",
            };
        },
        methods: {
            confirmUpdateName() {
                this.editNames = true;
                let formData = new FormData();
                formData.append("firstname", this.about.name.split(" ")[0]);
                formData.append("othername", this.about.name.split(" ")[2]);
                formData.append("lastname", this.about.name.split(" ")[1]);
                formData.append("_method", 'PUT');
                axios.post(`/api/bio/${this.bio.id}`, formData).then(res => {
                    if (res.data.status === 200) {
                        this.editNames = false;
                        this.editing = !this.editing;
                    }
                }).catch(err => {
                    console.log(err);
                })
            },
            confirmUpdateAbout() {
                if (this.aboutCount >= 600) {
                    M.toast({
                        html: 'Length should not exceed 600 characters',
                        classes: 'red',
                    })
                } else if (this.aboutCount <= 200) {
                    M.toast({
                        html: 'Character length should be minimum of 200 characters',
                        classes: 'red',
                    })
                } else {
                    let formData = new FormData();
                    this.editAbout = !this.editAbout;
                    
                    formData.append("about", this.about.about);
                    formData.append("_method", 'PUT');
                    axios
                    .post(`/api/bio/${this.bio.id}`, formData)
                    .then((res) => {
                        if (res.data.status == 200) {
                            M.toast({
                                html: res.data.message,
                                classes: "green darken-1",
                            });
                            this.editAbout = !this.editAbout;
                            this.editingAbout = !this.editingAbout;
                        }
                    })
                    .catch((err) => {
                        this.editAbout = !this.editAbout;
                        if (err.response.status == 400) {
                            err.response.data.forEach((el) => {
                                M.toast({
                                    html: 'An error has occured updating your profile',
                                    classes: "errorNotifier",
                                });
                            });
                        }
                    });
                }
            },
            edit(num) {
                if (num === 0) {
                    this.editing = !this.editing;
                } else if (num === 1) {
                    this.editingAbout =  !this.editingAbout;
                } else if (num === 2) {
                    this.editingSocials = !this.editingSocials;
                }
            },
            confirmUpdateSocials() {
                this.editSocials = !this.editSocials;
                let data = {
                    facebook: this.facebook, twitter: this.twitter, tiktok: this.tiktok, instagram: this.instagram,
                };
                this.update ? data._method = 'PUT' : null;
                axios.post(`/api/social/${this.id}`, data)
                    .then((res) => {
                        if (res.status == 200 || res.status == 201) {
                            this.editSocials = !this.editSocials;
                            this.editingSocials = !this.editingSocials;
                            this.socials.forEach((el, index) => {
                                if (index == 0) {
                                    el.src= `https://www.facebook.com/${res.data.social.facebook}`;
                                } else if (index == 1 ){
                                    el.src = `https://twitter.com/${res.data.social.twitter}?ref_src=twsrc%5Etfw`;
                                } else if (index == 2) {
                                    el.src = `https://www.instagram.com/reel/${res.data.social.instagram}/embed/captioned/?cr=1&v=14&wp=326&rd=http%3A%2F%2F127.0.0.1%3A8000&rp=%2Fpreview%2F1#%7B%22ci%22%3A0%2C%22os%22%3A3489.7999999998137%2C%22ls%22%3A3373.899999999441%2C%22le%22%3A3393.5%7D`;
                                } else if(index == 3) {
                                    el.src = `https://www.tiktok.com/@${res.data.social.tiktok}`;
                                }
                            });
                        }
                    })
                    .catch((err) => {
                        this.editSocials = !this.editSocials;
                        if (err.response.status == 400) {
                            err.response.data.forEach((el) => {
                                M.toast({
                                    html: el,
                                    classes: "errorNotifier",
                                });
                            });
                        }
                    });
            },
            updateHandle(id, item) {
                // const ids {facebook: 1, twitter: 2, instagram: 3, tiktok: 4}
                if (id == 'facebook-f') {
                    this.facebook = item;
                } else if (id == 'twitter') {
                    this.twitter = item;
                } else if (id == 'instagram') {
                    this.instagram = item;
                } else if (id == 'tiktok') {
                    this.tiktok = item;
                }
                console.log(item);
            }
        },
        mixins: [dragnDropImg],
        mounted() {
                
        },
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

            professionTitle: String, // Recently added
        },
        watch: {
            bio(newval, oldval) {
                if (newval) {
                    let othername = newval.othername == null ? '' : newval.othername;
                    this.about.name =
                        newval.firstname +
                        " " +
                        newval.lastname + " " + othername;
                    this.about.about = newval.about;
                    this.about.photo = newval.photo;
                }
            },
            CV(newval, oldval) {
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
                        handle: ''
                    };
                    let twitter = {
                        id: 'twitter',
                        src: `https://twitter.com/${this.twitter}?ref_src=twsrc%5Etfw`,
                        handle: ''
                    };
                    let instagram = {
                        id: 'instagram',
                        src: `https://www.instagram.com/reel/${this.instagram}/embed/captioned/?cr=1&v=14&wp=326&rd=http%3A%2F%2F127.0.0.1%3A8000&rp=%2Fpreview%2F1#%7B%22ci%22%3A0%2C%22os%22%3A3489.7999999998137%2C%22ls%22%3A3373.899999999441%2C%22le%22%3A3393.5%7D"`,
                        color: 'red',
                        handle: ''
                    };
                    let tiktok = {
                        id: 'tiktok',
                        src: `<blockquote class="tiktok-embed" cite="https://www.tiktok.com/@${this.tiktok}" data-unique-id="${this.tiktok}" data-embed-from="oembed" data-embed-type="creator" style="max-width: 780px; min-width: 288px; width: 32rem;" > <section> <a target="_blank" href="https://www.tiktok.com/@${this.tiktok}?refer=creator_embed">@${this.tiktok}</a> </section> </blockquote>`,
                        color: 'red',
                        handle: ''
                    };
                    if (newVal && this.preview === '0') {
                        newVal = JSON.parse(newVal);
                        this.update = true;
                        this.facebook = newVal.facebook;
                        this.twitter = newVal.twitter;
                        this.instagram = newVal.instagram;
                        this.tiktok = newVal.tiktok;
                        this.id = newVal.id;
                            facebook = {
                                id: 'facebook-f',
                                src: `https://www.facebook.com/${newVal.facebook}`,
                                handle: newVal.facebook
                            }
                            this.socials.push(facebook);
                            twitter = {
                                id: 'twitter',
                                src: `https://twitter.com/${newVal.twitter}?ref_src=twsrc%5Etfw`,
                                handle: newVal.twitter
                            }
                            this.socials.push(twitter);
                            instagram = {
                                id: 'instagram',
                                src: `https://www.instagram.com/reel/${newVal.instagram}/embed/captioned/?cr=1&v=14&wp=326&rd=http%3A%2F%2F127.0.0.1%3A8000&rp=%2Fpreview%2F1#%7B%22ci%22%3A0%2C%22os%22%3A3489.7999999998137%2C%22ls%22%3A3373.899999999441%2C%22le%22%3A3393.5%7D`,
                                color: 'red',
                                handle: newVal.instagram
                            }
                            this.socials.push(instagram);
                            tiktok = {
                                id: 'tiktok',
                                src: `https://www.tiktok.com/@${newVal.tiktok}?refer=creator_embed`,
                                color: 'red',
                                handle: newVal.tiktok
                            }
                            this.socials.push(tiktok);
                        
                    } else if (this.preview == '1') {
                        this.facebook = 'whiteCoatDomain';
                        this.twitter = 'WhiteCoatD_HQ';
                        this.instagram = 'CoUVYkmj6__';
                        this.tiktok = 'scout2015';
                        this.socials = [
                            {
                                id: 'facebook-f',
                                src: `https://www.facebook.com/${this.facebook}`,
                                handle: ''
                            },
                            {
                                id: 'twitter',
                                src: `https://twitter.com/${this.twitter}?ref_src=twsrc%5Etfw`,
                                handle: ''
                            },
                            {
                                id: 'instagram',
                                src: `https://www.instagram.com/reel/${this.instagram}/embed/captioned/?cr=1&v=14&wp=326&rd=http%3A%2F%2F127.0.0.1%3A8000&rp=%2Fpreview%2F1#%7B%22ci%22%3A0%2C%22os%22%3A3489.7999999998137%2C%22ls%22%3A3373.899999999441%2C%22le%22%3A3393.5%7D`,
                                color: 'red',
                                handle: ''
                            },
                            {
                                id: 'tiktok',
                                src: `https://www.tiktok.com/@${this.tiktok}`,
                                color: 'red',
                                handle: ''
                            }
                        ]
                    } else if (newVal === '') {
                        this.socials = [
                            {
                                id: 'facebook-f',
                                src: `https://www.facebook.com`,
                                handle: ''
                            },
                            {
                                id: 'twitter',
                                src: `https://www.twitter.com`,
                                handle: ''
                            },
                            {
                                id: 'instagram',
                                src: `https://www.instagram.com`,
                                color: 'red',
                                handle: ''
                            },
                            {
                                id: 'tiktok',
                                src: `https://www.tiktok.com`,
                                color: 'red',
                                handle: ''
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