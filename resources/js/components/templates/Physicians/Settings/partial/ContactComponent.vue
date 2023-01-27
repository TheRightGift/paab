<template>
    <div>
        <div class="bioModalDiv" v-if="contactModal">
            <div class="editInnerGenModal">
                <div>
                    <p class="genTitle1">Put in your contact details</p>

                    <p class="genTxt">
                        Lorem Ipsum is simply dummy text of the printing and
                        typesetting industry.
                    </p>

                    <form @submit.prevent="saveContact">
                        <div class="input-field">
                            <input
                                type="email"
                                placeholder="Email"
                                id="contactInput"
                                class="contactInput"
                                v-model="contact.email"
                            />
                        </div>

                        <div class="input-field">
                            <input
                                type="tel"
                                placeholder="Phone number"
                                id="contactInput1"
                                class="contactInput"
                                v-model="contact.phone"
                            />
                        </div>

                        <div class="input-field">
                            <input
                                type="address"
                                placeholder="Location"
                                id="contactInput2"
                                class="contactInput"
                                v-model="contact.address"
                            />
                        </div>

                        <div>
                            <button  v-if="loading" class="btn">
                                <div class="preloader-wrapper small active">
                                    <div
                                        class="spinner-layer spinner-white-only"
                                    >
                                        <div class="circle-clipper left">
                                            <div class="circle"></div>
                                        </div>
                                        <div class="gap-patch">
                                            <div class="circle"></div>
                                        </div>
                                        <div class="circle-clipper right">
                                            <div class="circle"></div>
                                        </div>
                                    </div>
                                </div>
                            </button>
                            <button type="submit" class="btn" id="genModalBtn" v-else-if="saved == null">
                                save
                            </button>
                            <button type="submit" class="btn" id="genModalBtn" v-else @click="contact.update = 1">
                                update
                            </button>
                        </div>
                    </form>

                    <div class="genBottomBtnDiv">
                        <a
                            href="#"
                            class="goBackBtn"
                            @click="contactGoBackBtn()"
                            >GO BACK</a
                        >
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            contactModal: Boolean,
            user: Object,
            saved: Object,
            loading: Boolean
        },
        data() {
            return {
                contact: {
                    email: this.user.email,
                    phone: "",
                    address: "",
                    update: 0,
                },
            };
        },
        methods: {
            contactGoBackBtn() {
                this.$emit("contactGoBackBtn");
            },
            saveContact() {
                this.$emit("saveContact", this.contact);
            },
        },
        watch: {
            saved(newVal, oldVal){
                if (newVal != null) {
                    this.contact.email = newVal.email;
                    this.contact.phone = newVal.phone;
                    this.contact.address = newVal.address;
                    this.contact.id = newVal.id;
                }
            }
        },
    };
</script>