<template>
    <div>
        <div id="loadMoreReviews" class="modal">
            <div class="testimonialReviewDiv">
                <!-- <div class="testimonialReviewInnerDiv">
                    <i class="material-icons modal-close reviewsModalClose">arrow_back</i>
        
                    <p class="reviewsTitle">Reviews</p>
                </div> -->
                <div class="tempOneRevDiv">
                    <div class="tempOneRevInnerDiv">
                        <a class="black-text" @click="goBackToNormal">
                            <i
                                class="
                                    small
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
                            <!-- Testimonials First Row -->
                            <div class="col s12">
                                <p class="tempOneRevTime right">Now</p>
                            </div>
                            
                            <div class="col s12 m6 l4">
                                <img src="/media/img/testiProImg.png" alt="testiProImg.png" class="responsive-img testiProImg">
                                <div class="testiMapDiv">
                                    <p class="testiMapProName">Mr. Akin Olu</p>
                                    <p class="testiMapTxt">
                                        Contrary to popular belief, Lorem Ipsum is not simply random text.
                                        It has roots in a piece.
                                    </p>
                                </div>
                            </div>
                            
                            <div class="col s12 m6 l4">
                                <img src="/media/img/testiProImg.png" alt="testiProImg.png" class="responsive-img testiProImg">
                                <div class="testiMapDiv">
                                    <p class="testiMapProName">Mr. Akin Olu</p>
                                    <p class="testiMapTxt">
                                        Contrary to popular belief, Lorem Ipsum is not simply random text.
                                        It has roots in a piece.
                                    </p>
                                </div>
                            </div>
                            
                            <div class="col s12 m6 l4">
                                <img src="/media/img/testiProImg.png" alt="testiProImg.png" class="responsive-img testiProImg">
                                <div class="testiMapDiv">
                                    <p class="testiMapProName">Mr. Akin Olu</p>
                                    <p class="testiMapTxt">
                                        Contrary to popular belief, Lorem Ipsum is not simply random text.
                                        It has roots in a piece.
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Testimonials Second Row -->
                            <div class="col s12">
                                <p class="tempOneRevTime right">1 days ago</p>
                            </div>
                            
                            <div class="col s12 m6 l4">
                                <img src="/media/img/testiProImg.png" alt="testiProImg.png" class="responsive-img testiProImg">
                                <div class="testiMapDiv">
                                    <p class="testiMapProName">Mr. Akin Olu</p>
                                    <p class="testiMapTxt">
                                        Contrary to popular belief, Lorem Ipsum is not simply random text.
                                        It has roots in a piece.
                                    </p>
                                </div>
                            </div>
                            
                            <div class="col s12 m6 l4">
                                <img src="/media/img/testiProImg.png" alt="testiProImg.png" class="responsive-img testiProImg">
                                <div class="testiMapDiv">
                                    <p class="testiMapProName">Mr. Akin Olu</p>
                                    <p class="testiMapTxt">
                                        Contrary to popular belief, Lorem Ipsum is not simply random text.
                                        It has roots in a piece.
                                    </p>
                                </div>
                            </div>
                            
                            <div class="col s12 m6 l4">
                                <img src="/media/img/testiProImg.png" alt="testiProImg.png" class="responsive-img testiProImg">
                                <div class="testiMapDiv">
                                    <p class="testiMapProName">Mr. Akin Olu</p>
                                    <p class="testiMapTxt">
                                        Contrary to popular belief, Lorem Ipsum is not simply random text.
                                        It has roots in a piece.
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Testimonials Third Row -->
                            <div class="col s12">
                                <p class="tempOneRevTime right">3 days ago</p>
                            </div>
                            
                            <div class="col s12 m6 l4">
                                <img src="/media/img/testiProImg.png" alt="testiProImg.png" class="responsive-img testiProImg">
                                <div class="testiMapDiv">
                                    <p class="testiMapProName">Mr. Akin Olu</p>
                                    <p class="testiMapTxt">
                                        Contrary to popular belief, Lorem Ipsum is not simply random text.
                                        It has roots in a piece.
                                    </p>
                                </div>
                            </div>
                            
                            <div class="col s12 m6 l4">
                                <img src="/media/img/testiProImg.png" alt="testiProImg.png" class="responsive-img testiProImg">
                                <div class="testiMapDiv">
                                    <p class="testiMapProName">Mr. Akin Olu</p>
                                    <p class="testiMapTxt">
                                        Contrary to popular belief, Lorem Ipsum is not simply random text.
                                        It has roots in a piece.
                                    </p>
                                </div>
                            </div>
                            
                            <div class="col s12 m6 l4">
                                <img src="/media/img/testiProImg.png" alt="testiProImg.png" class="responsive-img testiProImg">
                                <div class="testiMapDiv">
                                    <p class="testiMapProName">Mr. Akin Olu</p>
                                    <p class="testiMapTxt">
                                        Contrary to popular belief, Lorem Ipsum is not simply random text.
                                        It has roots in a piece.
                                    </p>
                                </div>
                            </div>

                            <div
                                class="col m6 l4 min-height-40"
                                v-for="(review) in reviews"
                                :key="review"
                            >
                            <div class="reviewsProImgDiv">
                                <img
                                    :src="
                                        review.imageURL != null
                                            ? '/media/'+tenant+'/img/reviews/'+ review.imageURL
                                            : '/media/img/user.png'
                                    "
                                    :alt="
                                        review.imageURL != null
                                            ? review.firstname + review.lastname
                                            : 'testiProImg.png'
                                    "
                                    class="responsive-img testiProImg"
                                />
                            </div>
                                <div class="testimonialDiv">
                                    <p class="singleReviewName">{{ review.lastname }}
                                                {{ review.firstname }}</p>
                                    <p class="singleReviewComment">
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
        </div>
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
        props: {
            tenant: String,
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
<style scoped>
    .testiProImg {
        margin-bottom: -20px;
        position: static;
    }
    .reviewsProImgDiv {
        display: flex;
        justify-content: center;
    }
</style>