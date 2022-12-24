<template>
    <div>
        <div class="editWebModalDiv">
            <p id="editWebWlcTxt">Promotionals</p>
            <div class="configWebBackBtnDiv" v-if="!createNew">
                <a href="#!" @click="close" class="configWebBackBtn">GO BACK</a>
                <a
                    href="#!"
                    @click="openCreateNew"
                    class="configWebBackBtn right"
                    >CREATE NEW</a
                >
            </div>
            <div class="configWebBackBtnDiv" v-if="createNew">
                <a href="#!" @click="cancel" class="configWebBackBtn">CANCEL</a>
            </div>
            <div class="achieveModalDiv" v-if="createNew">
                <div class="editInnerGenModal">
                    <div>
                        <p class="genTitle1">Add/Edit Promotion</p>

                        <p class="genTxt">
                            Are you running a promo, use this section to upload a banner that showcases your promo.
                        </p>
                        <small>Note: You ought to have updated your site before continuing</small>

                        <form @submit.prevent="saveNew">
                            <div
                                class="file-field input-field"
                                id="genUploadFavIconDiv"
                                v-if="promotion.banner == null"
                            >
                                <input
                                    type="file"
                                    accept="image/*"
                                    @change="addBannerchiever"
                                />
                                <div class="file-path-wrapper">
                                    <input
                                        class="file-path validate"
                                        placeholder="Banner must not be greater than 500KB(1249x743)"
                                        type="text"
                                        id="genInput1"
                                    />
                                    <i
                                        class="material-icons"
                                        id="genUploadFavIcon"
                                        >file_upload</i
                                    >
                                </div>
                            </div>

                            <div v-else class="flex no-space-between">
                                <img
                                    width="100"
                                    height="100"
                                    class="responsive-img"
                                    :src="
                                        typeof promotion.banner == 'string'
                                            ? 'tenancy/assets/' +
                                              promotion.banner
                                            : uploaded
                                    "
                                />
                                <a
                                    class="
                                        waves-effect waves-light
                                        btn-small btn
                                        red
                                    "
                                    @click="deleteImg"
                                    >Change</a
                                >
                            </div>

                            <div>
                                <p class="genTitle1">
                                    Provide info about promotion
                                </p>

                                <p class="genTxt">
                                    Lorem Ipsum is simply dummy text of the
                                    printing and typesetting industry.
                                </p>

                                <div class="input-field col ss9">
                                    <input
                                        type="text"
                                        v-model.lazy="promotion.expiry"
                                        placeholder="Enter the date this promotion will expire"
                                        id="bioInput"
                                        class="datepicker"
                                        required
                                    />
                                </div>
                                <div class="input-field col s3">
                                    <input
                                        type="text"
                                        v-model.lazy="promotion.time"
                                        placeholder="Enter the date this promotion will expire"
                                        id="bioInput"
                                        class="timepicker"
                                        required
                                    />
                                </div>

                                <div class="input-field">
                                    <input
                                        type="text"
                                        v-model="promotion.promo"
                                        placeholder="Whats the promotion about?"
                                        id="bioInput1"
                                    />
                                </div>
                            </div>

                            <div>
                                <button
                                    type="submit"
                                    class="btn"
                                    id="genModalBtn"
                                    v-if="!promotion.update"
                                >
                                    Save
                                </button>
                                <button
                                    type="submit"
                                    class="btn"
                                    id="genModalBtn"
                                    v-else
                                >
                                    Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div v-else>
                <div v-if="promotions.length > 0">
                    <div
                        class="row websitesViewRow"
                        v-for="promotion in promotions"
                        :key="promotion.id"
                    >
                        <div class="col l2">
                            <div class="websiteTitle">
                                <div class="webWhiteProDiv">
                                    <img
                                        :src="
                                            'tenancy/assets/' + promotion.banner
                                        "
                                        class="responsive-img"
                                    />
                                </div>
                            </div>
                            <p class="websiteTemplateName center-align">
                                {{ promotion.promo }}
                            </p>
                        </div>
                        <div class="col l10 websiteTemplateDesc">
                            <h5>Expiry</h5>
                            <div class="col l9">
                                <p class="webWhiteTxt">
                                    {{
                                        moment(promotion.expiry).format("llll")
                                    }}
                                </p>
                            </div>

                            <div class="col l3 right-align">
                                <a
                                    href="#!"
                                    @click="remove(promotion)"
                                    class="marginRight1"
                                    title="Delete promotion"
                                >
                                    <i class="material-icons" id="webWhiteIcon"
                                        >delete_forever</i
                                    >
                                </a>
                                <a
                                    href="#!"
                                    @click="update(promotion)"
                                    title="Edit your promotion"
                                >
                                    <i class="material-icons" id="webWhiteIcon"
                                        >edit</i
                                    >
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-else>
                    <p class="centered">
                        No promotion created yet!. All promotions appears here
                        when you create one
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import moment from "moment";
    let promotion = { banner: null, expiry: "", promo: "" };
    export default {
        data() {
            return {
                createNew: false,
                promotion: promotion,
                promotions: [],
                uploaded: null,
                proEdit: {},
            };
        },
        mounted() {
            this.getPromotions();
        },

        methods: {
            moment(arg) {
                return moment(arg);
            },
            close() {
                this.$emit("close");
            },
            cancel() {
                this.createNew = false;
            },
            deleteImg() {
                this.promotion.oldBanner = this.promotion.banner;
                this.promotion.banner = null;
            },
            addBannerchiever(e) {
                if (!e.target.files.length) return;
                this.promotion.banner = e.target.files[0];
                this.uploaded = URL.createObjectURL(e.target.files[0]);
            },
            getPromotions() {
                axios
                    .get("/api/promotion")
                    .then((res) => {
                        if (res.status == 200) {
                            this.promotions = res.data.promotions;
                        }
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            },
            openCreateNew() {
                this.promotion = promotion;
                this.createNew = true;
                $(document).ready(function () {
                    $(".datepicker").datepicker();
                    $(".timepicker").timepicker();
                });
            },
            saveNew() {
                let formData = new FormData();
                let request = `/api/promotion`;
                this.loading = true;
                typeof(this.promotion.banner) == 'string' ? null : formData.append("banner", this.promotion.banner);
                formData.append(
                    "expiry",
                    this.promotion.expiry + " " + this.promotion.time
                );
                formData.append("promo", this.promotion.promo);
                if (this.promotion.update == 1) {
                    formData.append("_method", "PUT");
                    request = `/api/promotion/${this.promotion.id}`;
                }
                axios
                    .post(request, formData)
                    .then((res) => {
                        if (res.status == 201 || res.data.status == 200) {
                            M.toast({
                                html: res.data.message,
                                classes: "successNotifier",
                            });
                            this.createNew = false;
                            let e = this.promotion.update ? this.promotions.findIndex(el => el.id == this.promotion.id) : null;
                            this.promotion.update ? this.promotions[e] = res.data.promotion : this.promotions.unshift(res.data.promotion);
                            this.loading = false;
                        }
                    })
                    .catch((err) => {
                        if (err.response.status == 400) {
                            err.response.data.forEach((el) => {
                                M.toast({
                                    html: el,
                                    classes: "errorNotifier",
                                });
                            });
                            this.loading = false;
                        }
                        this.loading = false;
                    });
            },
            update(promotion, index) {
                this.createNew = true;
                $(document).ready(function () {
                    $(".datepicker").datepicker();
                    $(".timepicker").timepicker();
                });
                this.promotion = promotion;
                this.promotion.update = 1;
                this.promotion.time = this.moment(promotion.expiry).format("LT");
                this.promotion.expiry = this.moment(promotion.expiry).format("ll");
            },
            remove(promo) {
                axios.delete(`/api/promotion/${promo.id}`).then(res => {
                    if (res.status == 204) {
                        const findId = (rol) => rol.id === promo.id;
                        this.promotions.splice(
                            this.promotions.findIndex(findId),
                            1
                        );
                    }
                    console.log(res);
                }).catch(err => {
                    console.log(err);
                })
            }
        },
    };
</script>