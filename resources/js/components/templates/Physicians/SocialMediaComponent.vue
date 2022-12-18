<template>
    <div class="section scrollspy feedsContainDiv" id="feeds">
        <div class="row">

            <div class="col s12 l6">
                <div class="col s12">
                    <p class="facebookFeedsIcon">
                        <i class="fa-brands fa-facebook-square" id="feedsFacebookIcon"></i>
                        <span class="feedsTwitterTxt">Facebook Feeds</span>
                    </p>
                </div>
                <iframe :src="'https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2F'+facebook+'&tabs=timeline%2C%20events&width=600&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId'" width="600" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>            
            </div>
            <div class="col s12 l6">
                <div class="col s12">
                    <p class="facebookFeedsIcon">
                        <i class="fa-brands fa-twitter-square" id="feedsFacebookIcon"></i>
                        <span class="feedsTwitterTxt">Twitter Feeds</span>
                    </p>
                </div>
                <a class="twitter-timeline" data-width="600" data-height="500" data-theme="light" :href="'https://twitter.com/'+twitter+'?ref_src=twsrc%5Etfw'">Tweets by TwitterDev</a>
            </div>
            
        </div>
        <div class="row">
            <div class="col s12">
                <p class="facebookFeedsIcon">
                    <i class="fa-brands fa-linkedin" id="feedsFacebookIcon"></i>
                    <span class="feedsTwitterTxt">Linkedin Feeds</span>
                </p>
            </div>
            <div class="col s12 l6">
                <iframe src="https://www.linkedin.com/embed/feed/update/urn:li:share:7009384519854166016" height="500" width="500" frameborder="0" allowfullscreen="" title="Embedded post"></iframe>                </div>
        </div>
        <!-- <div class="col s12 l4">
            <div class="feedsCard">
                <div class="row" id="feedsCardRowDiv">
                    <div class="col s2">
                        <div class="feedsProDiv">
                            <span class="feedsProImg">A</span>
                        </div>
                    </div>
        
                    <div class="col s9">
                        <p class="feedsCardHeader">Header</p>
                        <p class="feedsCardSubhead">Subhead</p>
                    </div>
        
                    <div class="col s1">
                        <i class="fa-solid fa-house-blank"></i>
                        <i class="fa-solid fa-house" id="feedsCardIcon"></i>
        
                    </div>
                </div>
        
                <div class="">
                    <img src="/media/img/feedsCardImg.png" alt="feedsCardImg.png" class="responsive-img" id="feedsCardImg">
                </div>
        
                <div>
                    <p class="feedsCardTitle">Title</p>
                    <p class="feedsCardTxt">Subhead</p>
                    <p class="feedsCardTxt1">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        sed do eiusmod tempor
                    </p>
                </div>
        
                <button class="btn" id="feedsCardBtn">View</button>
            </div>
        </div> -->
        <!-- <div class="col s12 l4">
            <div class="feedsCard">
                <div class="row" id="feedsCardRowDiv">
                    <div class="col s2">
                        <div class="feedsProDiv">
                            <span class="feedsProImg">A</span>
                        </div>
                    </div>
        
                    <div class="col s9">
                        <p class="feedsCardHeader">Header</p>
                        <p class="feedsCardSubhead">Subhead</p>
                    </div>
        
                    <div class="col s1">
                        <i class="fa-solid fa-house-blank"></i>
                        <i class="fa-solid fa-house" id="feedsCardIcon"></i>
        
                    </div>
                </div>
        
                <div class="">
                    <img src="/media/img/feedsCardImg.png" alt="feedsCardImg.png" class="responsive-img" id="feedsCardImg">
                </div>
        
                <div>
                    <p class="feedsCardTitle">Title</p>
                    <p class="feedsCardTxt">Subhead</p>
                    <p class="feedsCardTxt1">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        sed do eiusmod tempor
                    </p>
                </div>
        
                <button class="btn" id="feedsCardBtn">View</button>
            </div>
        </div> -->
        
        <!-- <div class="col s12 l4">
            <div class="feedsCard">
                <div class="row" id="feedsCardRowDiv">
                    <div class="col s2">
                        <div class="feedsProDiv">
                            <span class="feedsProImg">A</span>
                        </div>
                    </div>
        
                    <div class="col s9">
                        <p class="feedsCardHeader">Header</p>
                        <p class="feedsCardSubhead">Subhead</p>
                    </div>
        
                    <div class="col s1">
                        <i class="fa-solid fa-house-blank"></i>
                        <i class="fa-solid fa-house" id="feedsCardIcon"></i>
        
                    </div>
                </div>
        
                <div class="">
                    <img src="/media/img/feedsCardImg.png" alt="feedsCardImg.png" class="responsive-img" id="feedsCardImg">
                </div>
        
                <div>
                    <p class="feedsCardTitle">Title</p>
                    <p class="feedsCardTxt">Subhead</p>
                    <p class="feedsCardTxt1">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        sed do eiusmod tempor
                    </p>
                </div>
        
                <button class="btn" id="feedsCardBtn">View</button>
            </div>
        </div> -->
    </div>
</template>
<script>
export default {
    data() {
        return {
            facebook: "BinanceAfricaChannel",
            twitter: "TwitterDev"
        }
    },
    props: {
        socials: Object,
    },
    watch: {
        socials(newVal, oldVal) {
            if (newVal != null) console.log(newVal)
        }
    }
}
</script>