<template>
    <div class="section scrollspy" id="miniBlog">
        <div class="container"><!--v-if this is preview-->
            <div class="row">
                <div class="col l12">
                    <span class="sectionSubHeading">MINI BLOG</span>
                    <h2 class="sectionHeading">Shared <br/>updates &amp; thoughts.</h2>
                </div>
            </div>
            <div  class="row">
                <div class="row">
                    <div class="col s12 m6 l4" v-for="blog in blogs" :key="blog">
                        <div class="card">
                            <div class="card-image">
                                <img :src="blog.img">
                                <span class="card-title">{{blog.title}}</span>
                            </div>
                            <div class="card-content">
                                {{truncate(blog.content)}}
                            </div>
                            <div class="card-action">
                                <a href="#">Read more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div><!--else if being used for website--></div>
        
        <div id="blogModal" class="modal">
            <div class="modal-content">
                <div class="row">

                </div>
                <div class="row">

                </div>
                <div class="row">

                </div>
            </div>
        </div>
    </div>
</template>
<script>
import ImageCropper from '../../partials/ImageCropper.vue';
    export default {
        components: {ImageCropper},
        data() {
            return {
                loading: false,
                blogs: [
                    {
                        title: "Five Reasons You Need a Website: Credibility",
                        img: `/media/img/templates/1/blogImage.jpg`,
                        content: `<p>One of the main reasons you should have a website for your business is to increase your organization's credibility. Chances are there are several providers offering a similar service to yours. One way you can stand out is by having a website that looks good and clearly communicates quality information to your consumers.</p><p>Without a website, people may question your legitimacy as a business. Having a website is an opportunity to make a great first impression and give people comfort that you're a real business.</p>`
                    },
                    {
                        title: "Five Reasons You Need a Website: Brand",
                        img: `/media/img/templates/1/blogImage.jpg`,
                        content: `<p>Showcasing your brand to your prospective customers is one of the most important things that you can do. By clearly establishing who you are, what you represent and what you stand for, you increase the chances of your customers buying from you.</p><p>This is also something that can set you apart from your competitors. Without a website, it can be incredibly challenging to do this because people can't easily find quality and reliable information on your business.</p>`
                    },
                    {
                        title: "Five Reasons You Need a Website: Leads",
                        img: `/media/img/templates/1/blogImage.jpg`,
                        content: `<p>Perhaps one of the most intriguing reasons to have a website for your business is because it can increase your chances of getting leads.</p><p>Once people find you online, become interested in your product or service and want to know more, they'll know how to contact you thanks to the information on your website, which gives you the opportunity to increase your sales. Even though websites have a cost, when used correctly, they have a positive ROI.</p>`
                    },
                    {
                        title: "Five Reasons You Need a Website: Organic Traffic",
                        img: `/media/img/templates/1/blogImage.jpg`,
                        content: `<p>Once you're online and have an SEO-optimized website, you have a chance of showing up in Google search results. This means that when people are searching for a product or service, there is a chance your website will show up in the results. This gives you the opportunity to drastically increase your customer base.</p>`
                    },
                    {
                        title: "Five Reasons You Need a Website: Customer Service",
                        img: `/media/img/templates/1/blogImage.jpg`,
                        content: `<p>Many businesses get calls from prospects or existing customers asking simple questions about location and hours of operation. If you miss a call, the customer is left unhappy. Calls can also distract your staff from focusing on the most important parts of your business. A website can reduce these calls and increase internal productivity. At the same time, it helps customers find useful information without needing to call, which ultimately provides an all-around better user experience.</p>`
                    }
                ]
            };
        },
        props: {
            tenant: String,
            isLoggedIn: Boolean,
        },
        watch: {
            
        },
        mounted() {
            // this.getActivePromo();
        },
        methods: {
            truncate(words){
                let nuWord = words.replace( /(<([^>]+)>)/ig, ' ');
                if(nuWord.length > 57){
                    return nuWord.slice(0, 80)+'...';
                }
            }
        },
        computed: {},
    };
</script>
<style scoped>
</style>
