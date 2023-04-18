<template>
    <ReviewsComponent :reviews="reviews" @goBack="goBack" :tenant="tenant"/>
    <!-- Load More Modal Structure -->
    <div class="section scrollspy testiContainDiv" id="testimonials" >
        <div class="">
            <div class="container">
                <div class="row">
                    <div class="col s12 mb-6">
                            <span class="sectionSubHeading">TESTIMONIALS</span>
                            <h2 class="sectionHeading">What my clients <br/>say about me</h2>
                    </div>
                    <div class="testimonialsContainer">
                        <div class="row" v-if="preview == '1'">
                            <div class="row">
                                <div class="col s12 m5 l5 testifiers">
                                    <div class="clients">
                                        <div @click="showReview(i, index)" class="testimonialsProImgdiv" :class="{ selected: selectedIndex === index }" v-for="(i, index) in revPreviews" :key="index">
                                            <div class="d-flex align-center justify-between">
                                                <div class="">
                                                    <img :src="'/media/img/'+i.image" :alt="i.name" class="testiProImg">
                                                </div>
                                                <div class="titleName right-align">
                                                    <div class="testimonialsProDiv">
                                                        <p class="testimonialsProName">{{i.name}}</p>
                                                        <p class="testimonialsProTitle">{{i.title}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="col s12 m7 l7 testament">
                                    <p class="testimonialsWriteupTitle">It was a great experience</p>
                                    <div class="testimonialsWriteupReviewDiv">
                                        <i class="material-icons reviewIcon">star</i>
                                        <i class="material-icons reviewIcon">star</i>
                                        <i class="material-icons reviewIcon">star</i>
                                        <i class="material-icons reviewIcon">star</i>
                                        
                                        <!-- Add Review Modal Trigger -->
                                        <!-- <a href="#addReviewModal" class="modal-trigger">
                                            <i class="material-icons addreview right" title="Add Review">add_circle</i>
                                        </a> -->
                                    </div>
                                    <p class="tesimonialsWriteupTxt">
                                        {{ reviewOn }}
                                    </p>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row" v-else>
                            <div class="row" v-if="reviewLen > 0">
                                <div class="col s12 m5 l5">
                                    <div class="clients">
                                        <div @click="showReview(i, index)" class="testimonialsProImgdiv" :class="{ selected: selectedIndex === index }" v-for="(i, index) in revPreviews" :key="index">
                                            <div class="d-flex align-center justify-between">
                                                <div class="">
                                                    <img :src="'/media/img/'+i.image" :alt="i.name" class="testiProImg">
                                                </div>
                                                <div class="titleName">
                                                    <div class="testimonialsProDiv">
                                                        <p class="testimonialsProName">{{i.name}}</p>
                                                        <p class="testimonialsProTitle">{{i.title}}</p>
                                                    </div>
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
                                        <!-- <a href="#addReviewModal" class="modal-trigger">
                                            <i class="material-icons addreview right" title="Add Review">add_circle</i>
                                        </a> -->
                                    </div>
                                    <p class="tesimonialsWriteupTxt">
                                        {{ reviewOn }}
                                    </p>
                                    
                                </div>
                            </div>
                            <div v-else class="centre col s12 m12 l12">
                                <p >
                                    Client Has no Review at the moment. You can view
                                    other customer success or reviews from here
                                </p>
                            </div>
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
                revPreviews: [
                    {
                        id: 1,
                        name: 'John Doe',
                        title: 'Software Engineer',
                        image: 'user.png',
                        review: `Desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover`
                    },
                    {
                        id: 2,
                        name: 'John Doe',
                        title: 'Software Engineer',
                        image: 'user.png',
                        review: `It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.`
                    },
                    {
                        id: 3,
                        name: 'John Doe',
                        title: 'Software Engineer',
                        image: 'user.png',
                        review: `It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters. Desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover`
                    },
                    {
                        id: 4,
                        name: 'John Doe',
                        title: 'Software Engineer',
                        image: 'user.png',
                        review: `It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover`
                    },
                    {
                        id: 5,
                        name: 'John Doe',
                        title: 'Software Engineer',
                        image: 'user.png',
                        review: `It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover`
                    }
                ],
                reviewOn: {},
                selectedIndex: null,
            };
        },
        props: {
            reviews: Object,
            preview: String,
            tenant: String,
        },
        computed: {
            reviewLen() {
                return this.reviews.total || 0;
            },
            reviewsFront() {
                return this.reviews.data ? this.reviews.data.slice(0, 5) : null;
            },
        },
        methods: {
            
            showReview(i, index) {
                this.reviewOn = i.review;
                this.selectedIndex = index !== undefined ? index : 0;
            },
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
            this.showReview(this.revPreviews[0]);
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
.mb-6 {
    margin-bottom: 5rem;
}
.d-flex {
    display: flex;
}
.align-center {
    align-items: center;
}
.justify-between {
    justify-content: space-between;
}
a:hover {
    cursor: pointer;
}
.flex-centered {
    justify-content: center !important;
}
.testimonialDiv {
    margin-top: -10px;
}
.clients {
    height: 40vh;
    overflow-y: auto;
    padding: 1rem 1rem 0rem 1rem;
    border-radius: 1rem;
}
.titleName {
    width: 22vw;
}
.selected {
    background-color: #546f75;
    color: #FFFF;
}
/* Hide scrollbar for Chrome, Safari and Opera */
.clients::-webkit-scrollbar {
    display: none;
}

/* Hide scrollbar for IE, Edge and Firefox */
.clients {
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;  /* Firefox */
}
@media screen and (max-width: 640px) {  
    .titleName {
        width: 50vw;
    }
}
</style>