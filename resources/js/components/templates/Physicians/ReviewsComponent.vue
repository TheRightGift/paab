<template>
    <div>
        <div class="tempOneRevDiv">
            <div class="tempOneRevInnerDiv">
                <a href="#!" class="black-text" @click="goBackToNormal">
                    <i
                        class="
                            medium
                            material-icons
                            modal-close
                            tempOneAddTestiIcon
                        "
                        >arrow_back</i
                    >
                </a>

                <p class="tempOneRevTitle">Reviews</p>
            </div>
            <div>
                <div class="row">
                    <!-- Testimonials First Row -->
                    <div class="col s12">
                        <p class="tempOneRevTime right">Now</p>
                    </div>

                    <div
                        class="col m6 l4 min-height-40"
                        v-for="(review) in reviews"
                        :key="review"
                    >
                        <img
                            :src="
                                review.imageURL != null
                                    ? 'tenancy/assets/' + review.imageURL
                                    : '/media/img/user.png'
                            "
                            :alt="
                                review.imageURL != null
                                    ? review.firstname + review.lastname
                                    : 'testiProImg.png'
                            "
                            class="responsive-img testiProImg"
                        />
                        <div class="testiMapDiv">
                            <p class="testiMapProName">{{ review.lastname }}
                                        {{ review.firstname }}</p>
                            <p class="testiMapTxt">
                                {{review.comment}}
                            </p>
                        </div>
                    </div>

                    <div
                        class="col s12 centre tempOneRevLoadMoreDiv"
                        v-if="!loading"
                    >
                        <a
                            v-if="total != reviews.length"
                            href="#!"
                            class="tempOneRevLoadMore"
                            @click.prevent="getReviews"
                            >Load more</a
                        >
                        <p v-if="total == reviews.length">
                            You are all caught up!!!
                        </p>
                    </div>
                    <div
                        v-else-if="loading"
                        class="col s12 centre tempOneRevLoadMoreDiv"
                    >
                        <div class="preloader-wrapper small active">
                            <div class="spinner-layer spinner-white-only">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                page: 1,
                reviews: [],
                loading: false,
                total: 0,
            };
        },
        mounted() {
            this.getReviews();
        },
        methods: {
            goBackToNormal() {
                this.$emit("goBack");
            },
            getReviews() {
                this.loading = true;
                axios.get(`/api/review/?page=${this.page++}`).then((res) => {
                    this.reviews = [...this.reviews, ...res.data.reviews.data];
                    this.total = res.data.reviews.total;
                    this.loading = false;
                });
            },
        },
    };
</script>