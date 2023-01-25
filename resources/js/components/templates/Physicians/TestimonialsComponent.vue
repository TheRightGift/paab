<template>
    <ReviewsComponent :reviews="reviews" @goBack="goBack" :tenant="tenant"/>
    <!-- Load More Modal Structure -->
    <div class="section scrollspy testiContainDiv" id="testimonials" >
        
        <div class="row">
            <div class="col s12">
                <h3 class="feedsMainTitle forSurgeon">
                    TESTIMONIALS
                    <span class="primaryColorBoxDesign4"></span>
                </h3>
                <p class="feedsMainTitle center-align expMainTitle">Testimonials</p>
                <p class="feedsMainTxt">WHAT MY CLIENT SAYS</p>
            </div>
            <div class="testimonialsContainer">
                <div class="col s12 tempReviewOptDiv">
                    <div>
                        <a class="modal-trigger" href="#loadMoreReviews" > 
                            <!-- @click="goToReviews" -->
                            CLIENT REVIEWS({{ reviewLen }})
                        </a>
                    </div>
                    <!-- Add Testimonial Modal Trigger -->
                    <div>
                        <a class="modal-trigger btn-flat" href="#addReviewModal">
                            ADD A REVIEW
                            <i class="material-icons right">add</i>
                        </a>
                    </div>
                </div>
                <div class="row" v-if="preview == '1'">
                    <div class="greenBg">
                        <div class="col s12 m5 l5">
                            <div class="testimonialsProImgdiv">
                                <div class="row ">
                                    <div class="col s2">
                                        <img src="/media/img/testiProImg.png" alt="testiProImg.png" class="testiProImg">
                                    </div>
                                    <div class="col s10">
                                        <div class="testimonialsProDiv">
                                            <p class="testimonialsProName">Akerele A.</p>
                                            <p class="testimonialsProTitle">Software Engineer</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
    
                            <div class="testimonialsProImgdiv1">
                                <div class="row ">
                                    <div class="col s2">
                                        <img src="/media/img/testiProImg.png" alt="testiProImg.png" class="testiProImg">
                                    </div>
                                    <div class="col s10">
                                        <div class="testimonialsProDiv">
                                            <p class="testimonialsProName">Akerele A.</p>
                                            <p class="testimonialsProTitle">Software Engineer</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            <div class="testimonialsProImgdiv1">
                                <div class="row ">
                                    <div class="col s2">
                                        <img src="/media/img/testiProImg.png" alt="testiProImg.png" class="testiProImg">
                                    </div>
                                    <div class="col s10">
                                        <div class="testimonialsProDiv">
                                            <p class="testimonialsProName">Akerele A.</p>
                                            <p class="testimonialsProTitle">Software Engineer</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <div class="col s12 m7 l7">
                            <p class="testimonialsWriteupTitle">It was a great experience</p>
                            <div class="testimonialsWriteupReviewDiv">
                                <i class="material-icons reviewIcon">star</i>
                                <i class="material-icons reviewIcon">star</i>
                                <i class="material-icons reviewIcon">star</i>
                                <i class="material-icons reviewIcon">star</i>
                                
                                <!-- Add Review Modal Trigger -->
                                <a href="#addReviewModal" class="modal-trigger">
                                    <i class="material-icons addreview right" title="Add Review">add_circle</i>
                                </a>
                            </div>
                            <p class="tesimonialsWriteupTxt">
                                It is a long established fact that a reader will be distracted by 
                                the readable content of a page when looking at its layout. 
                                The point of using Lorem Ipsum is that it has a more-or-less 
                                normal distribution of letters, as opposed to using 
                                'Content here, content here', making it look like readable English. 
                                desktop publishing packages and web page editors now use Lorem Ipsum 
                                as their default model text, and a search for 'lorem ipsum' will uncover
                            </p>
                            <p class="tesimonialsWriteupTxt">
                                It is a long established fact that a reader will be distracted by 
                                the readable content of a page when looking at its layout. 
                                The point of using Lorem Ipsum is
                            </p>
                            <!-- Load More Modal Trigger -->
                            <a class="loadMoreReviews modal-trigger" href="#loadMoreReviews" >Load More</a>
                            <!-- @click="goToReviews" -->
                        </div>
                    </div>
                </div>
                <div class="row" v-else>
                    <div class="greenBg">
                        <div class="col s12 m5 l5">
                            <div v-if="reviewLen > 0">
                                <div class="" :class="{testimonialsProImgdiv: index == 0, testimonialsProImgdiv1: index > 0}" v-for="(review, index) in reviewsFront"
                                    :key="review.id">
                                    <div class="row " @click="showUserComment(review)">
                                        <div class="col s2">
                                            <img
                                                :src="
                                                    review.imageURL != null
                                                        ? '/media/'+tenant+'/img/reviews/'+
                                                        review.imageURL
                                                        : '/media/img/testiProImg.png'
                                                "
                                                :alt="
                                                    review.imageURL != null
                                                        ? review.firstname + review.lastname
                                                        : 'testiProImg.png'
                                                "
                                                class="testiProImg"
                                            />
                                        </div>
                                        <div class="col s10">
                                            <div class="testimonialsProDiv">
                                                <p class="testimonialsProName">
                                                    {{ review.lastname }}
                                                    {{ review.firstname }}
                                                </p>
                                                <p class="testimonialsProTitle"></p>
                                            </div>
                                        </div>
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
                    
                        <div class="col s12 m7 l7">
                            <p class="testimonialsWriteupTitle">It was a great experience</p>
                            <div class="testimonialsWriteupReviewDiv">
                                <i class="material-icons reviewIcon">star</i>
                                <i class="material-icons reviewIcon">star</i>
                                <i class="material-icons reviewIcon">star</i>
                                <i class="material-icons reviewIcon">star</i>
                                
                                <!-- Add Review Modal Trigger -->
                                <a href="#addReviewModal" class="modal-trigger">
                                    <i class="material-icons addreview right" title="Add Review">add_circle</i>
                                </a>
                            </div>
                            <p class="tesimonialsWriteupTxt" v-if="userReview != undefined">
                                {{userReview.comment}}
                            </p>
                            <!-- Load More Modal Trigger -->
                            <a class="loadMoreReviews modal-trigger" href="#loadMoreReviews">Load More</a>
                            <!-- @click="goToReviews" -->
                        </div>
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
                            <div class="flex flex-centered">
                                <img
                                    :src="
                                        review.imageURL != null
                                            ? '/media/'+tenant+'/img/reviews/'+
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
                            </div>
                                <div class="testimonialDiv">
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
    
    <ReviewFormComponent :preview="preview" :tenant="tenant"/>
</template>
<script>
    import ReviewFormComponent from "./ReviewFormComponent.vue";
    import ReviewsComponent from "./ReviewsComponent.vue";
    export default {
        components: { ReviewFormComponent, ReviewsComponent },
        data() {
            return {
                showReviews: false,
                userReview: {},
            };
        },
        props: {
            reviews: Object,
            preview: String,
            tenant: String,
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
            showUserComment(review) {
                this.userReview = review;
            },
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
        mounted() {
            setTimeout(() => {
                this.reviewsFront != null ? this.userReview = this.reviewsFront[0] : null;
            
            }, 2000);
        },
        watch: {
            // reviews (newVal, oldVal) {
            //     if (newVal != null) ;
            // }
        },
    };
</script>
<style scoped>
    a:hover {
        cursor: pointer;
    }
    .flex-centered {
        justify-content: center !important;
    }
    .testimonialDiv {
        margin-top: -10px;
    }
</style>