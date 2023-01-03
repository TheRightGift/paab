<template>
    <ReviewsComponent v-if="showReviews" :reviews="reviews" @goBack="goBack"/>
    <div class="section scrollspy testiContainDiv" id="testimonials" v-else>
        <div class="row">
            <div class="col s12">
                <p class="feedsMainTitle">Testimonials</p>
                <p class="feedsMainTxt">WHAT MY CLIENT SAYS</p>
            </div>
            <div class="col s12">
                <div class="tempReviewOptDiv">
                    <div>
                        <a class="modal-trigger" href="#modal2">
                            CLIENT REVIEWS({{ reviewLen }})
                        </a>
                    </div>
                    <!-- Add Testimonial Modal Trigger -->
                    <div>
                        <a class="modal-trigger btn-flat" href="#modal1">
                            ADD A REVIEW
                            <i class="material-icons right">add</i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col s12">
                <div id="testiMapImg">
                    <div class="row">
                        <div v-if="reviewLen > 0">
                            <div
                                :class="{
                                    'col s9 m8 l3 offset-l1': index == 0,
                                    'col s9 l3 offset-s3 offset-m3 offset-l2':
                                        index == 1,
                                    'col s9 m8 l3 offset-l2': index == 2,
                                    'col s9 m9 l3 offset-s3 offset-m3 offset-l2':
                                        index == 3,
                                    'col s9 m9 l3 offset-s2 offset-m2 offset-l4':
                                        index == 4,
                                }"
                                v-for="(review, index) in reviewsFront"
                                :key="review.id"
                            >
                                <img
                                    :src="
                                        review.imageURL != null
                                            ? 'tenancy/assets/' +
                                              review.imageURL
                                            : '/media/img/user.png'
                                    "
                                    :alt="
                                        review.imageURL != null
                                            ? review.firstname + review.lastname
                                            : 'testiProImg.png'
                                    "
                                    class="responsive-img testiProImg"
                                    width="64"
                                    height="57"
                                />
                                <div class="testiMapDiv">
                                    <p class="testiMapProName">
                                        {{ review.lastname }}
                                        {{ review.firstname }}
                                    </p>
                                    <p class="testiMapTxt">
                                        {{ sliceComment(review.comment) }}
                                        {{ addDots(review.comment) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div v-else>
                            <p class="centre">
                                Client Has no Review at the moment. You can see
                                other customer success or reviews from here
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Testimonial Modal Structure -->
    <div id="modal2" class="modal tempOneModal2Div">
        <div class="modal-content">
            <div>
                <p class="tempOneModal2Txt">
                    is simply dummy text of the printing and typesetting
                    industry. Lorem Ipsum has been the industry's standard dummy
                    text ever since the 1500s, when
                </p>

                <div class="tempOneModal2BtnDiv">
                    <button
                        class="btn"
                        id="tempOneModal2Btn"
                        @click="goToReviews"
                    >
                        view more
                    </button>
                </div>
            </div>
        </div>
    </div>
    <ReviewFormComponent :preview="preview"/>
</template>
<script>
    import ReviewFormComponent from "./ReviewFormComponent.vue";
    import ReviewsComponent from "./ReviewsComponent.vue";
    export default {
        components: { ReviewFormComponent, ReviewsComponent },
        data() {
            return {
                showReviews: false,
            };
        },
        props: {
            reviews: Object,
            preview: String,
        },
        computed: {
            reviewLen() {
                return this.reviews.total;
            },
            reviewsFront() {
                return this.reviews.data ? this.reviews.data.slice(0, 5) : null;
            },
        },
        methods: {
            sliceComment(e) {
                return e.substring(0, 85);
            },
            addDots(e) {
                if (e.length > 85) {
                    return "...";
                }
            },
            goBack() {
                this.showReviews = !this.showReviews;
            },
            goToReviews() {
                this.showReviews = true;
                let elem = document.getElementById("modal2");
                var instance = M.Modal.getInstance(elem);
                instance.close();
            },
        },
        watch: {
            // reviews (newVal, oldVal) {
            //     if (newVal != null) ;
            // }
        },
    };
</script>