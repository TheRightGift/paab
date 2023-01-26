<template>
    <div class="section scrollspy feedsContainDiv" id="feeds">
        <div class="row">
            <div class="col s12">
                <h3 class="center-align feeds">
                    MY FEEDS
                    <span class="primaryColorBoxDesign3"></span>
                </h3>
            </div>
        </div>
        <div class="row" id="feeds">
            <div class="col s12 l4">
                <div class="col s12">
                    <p class="facebookFeedsIcon center-align">
                        <i
                            class="fa-brands fa-facebook-square text"
                            id="feedsFacebookIcon"
                        ></i>
                        <span class="feedsTwitterTxt text">Facebook Feeds</span>
                    </p>
                </div>

                <iframe
                    id="fb"
                    :src="
                        'https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2F' +
                        facebook +
                        '&tabs=timeline&width=405&height=500&small_header=true&adapt_container_width=true&hide_cover=true&show_facepile=true&appId=387648135838115'
                    "
                    width="100%"
                    height="500"
                    style="border: none; overflow: hidden"
                    scrolling="no"
                    frameborder="0"
                    allowfullscreen="true"
                    allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"
                ></iframe>
            </div>
            <div class="col s12 l4">
                <div class="col s12">
                    <p class="facebookFeedsIcon center-align">
                        <i
                            class="fa-brands fa-twitter-square text"
                            id="feedsFacebookIcon"
                        ></i>
                        <span class="feedsTwitterTxt text">Twitter Feeds</span>
                    </p>
                </div>
                <a
                    class="twitter-timeline"
                    data-width="100%"
                    data-height="500"
                    data-theme="light"
                    :href="
                        'https://twitter.com/' +
                        twitter +
                        '?ref_src=twsrc%5Etfw'
                    "
                    >Tweets by TwitterDev</a
                >
            </div>

            <div class="col s12 l4">
                <div class="col s12">
                    <p class="facebookFeedsIcon center-align">
                        <i
                            class="fa-brands fa-linkedin text"
                            id="feedsFacebookIcon"
                        ></i>
                        <span class="feedsTwitterTxt text">Linkedin Feeds</span>
                    </p>
                </div>
                <div class="col s12">
                    <iframe
                        :src="
                            'https://www.linkedin.com/embed/feed/update/urn:li:share:' +
                            linkedin
                        "
                        height="500"
                        width="100%"
                        frameborder="0"
                        allowfullscreen=""
                        title="Embedded post"
                    ></iframe>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                facebook: "whiteCoatDomain",
                twitter: "WhiteCoatD_HQ",
                linkedin: "7024316559623958529",
            };
        },
        props: {
            socials: Object,
        },
        watch: {
            socials(newVal, oldVal) {
                if (newVal != null) {
                    this.facebook = newVal.facebook;
                    this.linkedin = newVal.linkedin;
                    this.twitter = newVal.twitter;
                }
                // if (newVal != null) console.log(newVal)
            },
        },
    };
</script>
<style scoped>
    iframe div._2lqh {
        display: none !important;
        width: 0 !important;
    }
</style>