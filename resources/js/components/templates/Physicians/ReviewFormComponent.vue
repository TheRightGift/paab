<template>
    <div>
        <!-- Add Testimonial Modal Structure -->
        <div id="modal1" class="modal">
            <div class="modal-content">
                <div>
                    <i
                        class="
                            medium
                            material-icons
                            modal-close
                            tempOneAddTestiIcon
                        "
                        >arrow_back</i
                    >
                </div>

                <form id="reviewForm" @submit.prevent="subReview">
                    <div id="reviwProMainDiv">
                        <div class="setProDiv">
                            <i class="material-icons" id="setProImg">person</i>
                        </div>

                        <div class="setProEditIconDiv">
                            <input
                                type="file"
                                @change="getImage"
                                accept="image/*"
                            />
                        </div>
                    </div>

                    <div class="row rm_mg">
                        <div class="row rm_mg">
                            <div class="input-field col s5 rm_mg sm_mg">
                                <input
                                    placeholder="Last Name"
                                    type="text"
                                    class="validate"
                                    id="tempOneAddTestiLname"
                                    v-model="review.lastname"
                                />
                            </div>

                            <div
                                class="input-field col s5 offset-s1 rm_mg sm_mg"
                            >
                                <input
                                    placeholder="First Name"
                                    type="text"
                                    class="validate"
                                    id="tempOneAddTestiFname"
                                    v-model="review.firstname"
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
                            class="btn col s2 offset-s9 rm_mg sm_mg"
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
            };
        },
        props: {preview: String},
        methods: {
            getImage(e) {
                if (!e.target.files.length) return;
                this.review.imageUrl = e.target.files[0];
            },
            subReview() {
                if (this.preview == '0') {

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