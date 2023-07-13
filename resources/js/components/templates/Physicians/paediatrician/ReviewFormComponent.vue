<template>
    <div>
        <!-- Add Testimonial Modal Structure -->
        <div id="addReviewModal" class="modal">
            <div class="modal-content">
                <div>
                    <i class="material-icons modal-close tempOneAddTestiIcon"
                        >arrow_back</i
                    >
                </div>

                <form id="reviewForm" @submit.prevent="subReview">
                    <!-- <div id="addReviewProMainDiv flex"> -->
                    <!-- <div class="setProDiv">
                            <i class="material-icons" id="setProImg">person</i>
                        </div> -->

                    <!-- <div class="setProEditIconDiv">
                            <input
                                type="file"
                                @change="getImage"
                                accept="image/*"
                            />
                        </div> -->
                    <!-- </div> -->
                    <div class="addReviewProMainDiv">
                        <div class="addReviewProDiv">
                            <i
                                class="material-icons addReviewProImg"
                                v-if="
                                    review.imageUrl === null ||
                                    uploaded === null
                                "
                                >person</i
                            >
                            <img
                                :src="uploaded"
                                v-else
                                width="100"
                                height="100"
                                class="userAvatar circle responsive-img"
                            />
                            <input
                                @change="getImage"
                                accept="image/*"
                                class="custom-file-input edit icon"
                                :class="{'filled-custom-file-input': uploaded != null, 'plain-custom-file-input': uploaded == null}"
                                type="file"
                                id="setProEditIcon"
                            />
                        </div>
                    </div>

                    <div class="row rm_mg">
                        <div class="row rm_mg">
                            <div class="input-field col s12 l5 rm_mg sm_mg">
                                <input
                                    placeholder="Last Name"
                                    type="text"
                                    class="validate"
                                    id="tempOneAddTestiLname"
                                    v-model="review.lastname"
                                />
                            </div>

                            <div
                                class="input-field col s12 l5 offset-l1 rm_mg sm_mg"
                            >
                                <input
                                    placeholder="First Name"
                                    type="text"
                                    class="validate"
                                    id="tempOneAddTestiFname"
                                    v-model="review.firstname"
                                    title=""
                                />
                            </div>
                        </div>

                        <div class="row rm_mg">
                            <div class="input-field col s12 rm_mg sm_mg">
                                <textarea
                                    id="tempOneAddTestiReview"
                                    class=""
                                    placeholder="Write a review (Maximum of 200 characters)"
                                    v-model="review.comment"
                                    maxlength="200"
                                ></textarea>
                            </div>
                        </div>

                        <button
                            class="btn col s12 l2 offset-l9 rm_mg sm_mg"
                            type="submit"
                            id="tempOneTestiSubBtn"
                        >
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<style>
</style>
<script>
    export default {
        data() {
            return {
                review: {
                    lastname: "",
                    firstname: "",
                    comment: "",
                    imageUrl: null,
                },
                uploaded: null,
            };
        },
        props: { preview: String },
        methods: {
            getImage(e) {
                if (!e.target.files.length) return;
                this.review.imageUrl = e.target.files[0];
                this.uploaded = URL.createObjectURL(e.target.files[0]);
            },
            subReview() {
                if (this.preview == "0") {
                    let formData = new FormData();
                    this.review.imageUrl !== null
                        ? formData.append("imageURL", this.review.imageUrl)
                        : null;
                    formData.append("firstname", this.review.firstname);
                    formData.append("lastname", this.review.lastname);
                    formData.append("comment", this.review.comment);

                    axios
                        .post("/api/review", formData)
                        .then((res) => {
                            if (res.status == 201) {
                                M.toast({
                                    html: res.data.message,
                                    classes: "successNotifier",
                                });
                                this.review.imageUrl = null;
                                this.review.firstname = "";
                                this.review.lastname = "";
                                this.review.comment = "";
                                location.reload();
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
                            }
                        });
                }
            },
        },
    };
</script>
<style scoped>
    .filled-custom-file-input {
        margin-left: -36px !important;
    }
    .plain-custom-file-input {
        margin-left: -30px !important;
    }
    .custom-file-input {
        /* position: absolute;
        top: 31%;
        right: 300px; */
        margin-top: 30px !important;
        background: var(--primary);
        width: 2.5rem;
        height: 2.5rem;
        border-radius: 3.8rem;
    }
    input[type="file"] {
        color: transparent;
    }
    .userAvatar {
        width: 100px;
        height: 100px;
    }
</style>