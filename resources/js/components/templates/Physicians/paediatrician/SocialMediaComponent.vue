<template>
    <div class="section scrollspy background" id="feeds">
        <div class="container">
            <div class="row">
                <div class="col l8 m8 s12">
                    <span class="sectionSubHeading">SOCIAL FEEDS</span>
                    <h2 class="sectionHeading">My Social<br/> handles</h2>
                </div>
                <div class="col l4 m4 s12 cardNavContainer">
                    <!--button class="roundBtn marginRight-5" @click="prev"><i class="material-icons">chevron_left</i></button>
                    <button class="roundBtn" @click="next"><i class="material-icons">chevron_right</i></button-->
                    <a class="btn-floating btn-large waves-effect waves-light marginRight-5"  @click="prev"><i class="material-icons">chevron_left</i></a>
                    <a class="btn-floating btn-large waves-effect waves-light" @click="nextSocial"><i class="material-icons">chevron_right</i></a>

                </div>
            </div>
        </div>
        <div class="">
            <div class="container">
                <div class="row noMarginBottom" id="socailCardContainer">
                    <div class="col l12 customCarousel">
                        <div class="inner" ref="innerSocial" :style="innerStyles">
                            <div class="customCard w-50" v-for="card in socials" :key="card"> 
                                <div>
                                    <div class="cardHeader">
                                        <h3 :class="{'red-text': card.color}">{{card.id}}</h3>
                                    </div>
                                    <p v-html="card.src"></p>
                                    <!-- <div class="fb-page" :data-href="'https://www.facebook.com/'+facebook" data-tabs="timeline" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote :cite="'https://www.facebook.com/'+facebook" class="fb-xfbml-parse-ignore"><a :href="'https://www.facebook.com/'+facebook">{{ facebook }}</a></blockquote></div> -->
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
            facebook: "whiteCoatDomain",
            twitter: "WhiteCoatD_HQ",
            tiktok: "scout2015",
            instagram: "CoUVYkmj6__",
            loading: false,
            id: "",

            // 
            innerStyles: {},
            step: '',
            transitioning: false,
            socials: [],
        }
    },
    mounted() {
        this.setSocialStep()
        this.resetTranslate()
    },
    methods: {
        updateSocialHandles() {
            this.loading = !this.loading;
            axios
                .post(`/api/social/${this.id}`, {facebook: this.facebook, twitter: this.twitter, tiktok: this.tiktok, instagram: this.instagram, _method: "PUT"})
                .then((res) => {
                    if (res.data.status == 200) {
                        this.loading = !this.loading;
                        M.toast({
                            html: `${res.data.message} : This page will Refresh to reflect changes`,
                            classes: "successNotifier",
                        });
                        location.reload();
                    }
                })
                .catch((err) => {
                    this.loading = !this.loading;
                    if (err.response.status == 400) {
                        err.response.data.forEach((el) => {
                            M.toast({
                                html: el,
                                classes: "errorNotifier",
                            });
                        });
                    }
                });
        },
        setSocialStep () {
            const innerWidth = this.$refs.innerSocial.scrollWidth;
            const totalSocials = this.socials.length;
            this.step = `${innerWidth / totalSocials}px`;
        },
        nextSocial () {
            if (this.transitioning){
                    return;
            } else {
                this.transitioning = true
                this.moveLeft();
                this.afterTransition(() => {
                    const socialCard = this.socials.shift()
                    this.socials.push(socialCard)
                    this.resetTranslate()
                    this.transitioning = false
                })
            }                
        },
        prev () {
            if (this.transitioning) {
                return;
            } else {
                this.transitioning = true
                this.moveLeft()
                this.afterTransition(() => {
                    const socialCard = this.socials.shift()
                    this.socials.push(socialCard)
                    this.resetTranslate()
                    this.transitioning = false
                })
            }            
        },
        moveLeft () {
            // console.log(`translateX(-${this.step})`)
            this.innerStyles = {
                transform: `translateX(-${this.step})`
            }
        },
        moveRight () {
            // console.log(`translateX(${this.step})`)
            this.innerStyles = {
                transform: `translateX(${this.step})`
            }
        },
        afterTransition (callback) {
            const listener = () => {
                callback()
                this.$refs.innerSocial.removeEventListener('transitionend', listener)
            }
            this.$refs.innerSocial.addEventListener('transitionend', listener)
        },
        resetTranslate () {
            let step = 0;
            this.innerStyles = {
                transition: 'none',
                transform: `translateX(-${step})`
            }
        }
    },
    props: {
        isLoggedIn: Boolean,
        preview: String,
        social: String,
    },
    watch: {
        social: {
            handler(newVal, olVal) {
                let facebook = {
                    id: 'Facebook',
                    src: `<div class="fb-page" data-href="https://www.facebook.com/${this.facebook}" data-tabs="timeline" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/${this.facebook}" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/${this.facebook}">${this.facebook}</a></blockquote></div></div>`,
                };
                let twitter = {
                    id: 'Twitter',
                    src: `<a class="twitter-timeline" data-width="100%" data-height="500" data-theme="light" width="100%" href="https://twitter.com/${this.twitter}?ref_src=twsrc%5Etfw">Tweets by ${this.twitter}</a>`,
                };
                let instagram = {
                    id: 'Instagram',
                    src: `<iframe src="https://www.instagram.com/reel/${this.instagram}/embed/captioned/?cr=1&v=14&wp=326&rd=http%3A%2F%2F127.0.0.1%3A8000&rp=%2Fpreview%2F1#%7B%22ci%22%3A0%2C%22os%22%3A3489.7999999998137%2C%22ls%22%3A3373.899999999441%2C%22le%22%3A3393.5%7D" />`,
                    color: 'red'
                };
                let tiktok = {
                    id: 'Tiktok',
                    src: `<blockquote class="tiktok-embed" cite="https://www.tiktok.com/@${this.tiktok}" data-unique-id="${this.tiktok}" data-embed-from="oembed" data-embed-type="creator" style="max-width: 780px; min-width: 288px; width: 32rem;" > <section> <a target="_blank" href="https://www.tiktok.com/@${this.tiktok}?refer=creator_embed">@${this.tiktok}</a> </section> </blockquote>`,
                    color: 'red'
                };
                if (newVal !== null && newVal !== '' && this.preview === '0') {
                    newVal = JSON.parse(newVal);
                    this.facebook = newVal.facebook;
                    this.twitter = newVal.twitter;
                    this.instagram = newVal.instagram;
                    this.tiktok = newVal.tiktok;
                    this.id = newVal.id;
                    if (newVal.facebook !== '' && newVal.facebook !== null) {
                        facebook = {
                            id: 'Facebook',
                            src: `<div class="fb-page" data-href="https://www.facebook.com/${newVal.facebook}" data-tabs="timeline" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/${newVal.facebook}" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/${newVal.facebook}">${newVal.facebook}</a></blockquote></div></div>`,
                        }
                        this.socials.push(facebook);
                    }
                    if (newVal.twitter !== '' && newVal.twitter !== null) {
                        twitter = {
                            id: 'Twitter',
                            src: `<a class="twitter-timeline" data-width="100%" data-height="500" data-theme="light" width="100%" href="https://twitter.com/${newVal.twitter}?ref_src=twsrc%5Etfw">Tweets by ${newVal.twitter}</a>`,
                        }
                        this.socials.push(twitter);
                    }
                    if (newVal.instagram !== '' && newVal.instagram !== null) {
                        instagram = {
                            id: 'Instagram',
                            src: `<iframe src="https://www.instagram.com/reel/${newVal.instagram}/embed/captioned/?cr=1&v=14&wp=326&rd=http%3A%2F%2F127.0.0.1%3A8000&rp=%2Fpreview%2F1#%7B%22ci%22%3A0%2C%22os%22%3A3489.7999999998137%2C%22ls%22%3A3373.899999999441%2C%22le%22%3A3393.5%7D" />`,
                            color: 'red'
                        }
                        this.socials.push(instagram);
                    }
                    if (newVal.tiktok !== '' && newVal.tiktok !== null) {
                        tiktok = {
                            id: 'Tiktok',
                            src: `<blockquote class="tiktok-embed" cite="https://www.tiktok.com/@${newVal.tiktok}" data-unique-id="${newVal.tiktok}" data-embed-from="oembed" data-embed-type="creator" style="max-width: 780px; min-width: 288px; width: 32rem;" > <section> <a target="_blank" href="https://www.tiktok.com/@${newVal.tiktok}?refer=creator_embed">@${newVal.tiktok}</a> </section> </blockquote>`,
                            color: 'red'
                        }
                        this.socials.push(tiktok);
                    }
                } else if (this.preview == '1') {
                    this.facebook = 'whiteCoatDomain';
                    this.twitter = 'WhiteCoatD_HQ';
                    this.instagram = 'CoUVYkmj6__';
                    this.tiktok = 'scout2015';
                    this.socials = [
                        {
                            id: 'Facebook',
                            src: `<div class="fb-page" data-href="https://www.facebook.com/${this.facebook}" data-tabs="timeline" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/${this.facebook}" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/${this.facebook}">${this.facebook}</a></blockquote></div></div>`,
                        },
                        {
                            id: 'Twitter',
                            src: `<a class="twitter-timeline" data-width="100%" data-height="500" data-theme="light" width="100%" href="https://twitter.com/${this.twitter}?ref_src=twsrc%5Etfw">Tweets by ${this.twitter}</a>`,
                        },
                        {
                            id: 'Instagram',
                            src: `<iframe src="https://www.instagram.com/reel/${this.instagram}/embed/captioned/?cr=1&v=14&wp=326&rd=http%3A%2F%2F127.0.0.1%3A8000&rp=%2Fpreview%2F1#%7B%22ci%22%3A0%2C%22os%22%3A3489.7999999998137%2C%22ls%22%3A3373.899999999441%2C%22le%22%3A3393.5%7D" />`,
                            color: 'red'
                        },
                        {
                            id: 'Tiktok',
                            src: `<blockquote class="tiktok-embed" cite="https://www.tiktok.com/@${this.tiktok}" data-unique-id="${this.tiktok}" data-embed-from="oembed" data-embed-type="creator" style="max-width: 780px; min-width: 288px; width: 32rem;" > <section> <a target="_blank" href="https://www.tiktok.com/@${this.tiktok}?refer=creator_embed">@${this.tiktok}</a> </section> </blockquote>`,
                            color: 'red'
                        }
                    ]
                }
            },
            deep: true,
            immediate: true,
        }
    },
};
</script>
<style scoped>
.cardHeader {
    margin-bottom: 1rem;
}
.w-50 {
    width: 45%;
    aspect-ratio: unset;
}
.redtoseclast:nth-child(3) {
    color: red;
    }
iframe div._2lqh {
        display: none !important;
        width: 0 !important;
    }
    .feedsHeading {
        color: var(--white);
    }
</style>
<style>
/* Inferred */
.Embed {
    height: 501px;
    max-height: 501px;
    overflow: auto;
}
iframe, .tiktok-embed, .twitter-timeline.twitter-timeline-rendered {
    height: 500px;
    width: 33vw !important;
    border-radius: 1rem;
    border: none;
}
blockquote {
    padding-left: 0;
}
@media screen and (max-width: 992px) and (min-width: 640px) {
    .w-50 {
        width: 65% !important;
    }
    iframe, .tiktok-embed, .twitter-timeline.twitter-timeline-rendered {
        height: 500px;
        width: 53vw !important;
        border-radius: 1rem;
    }
    #socailCardContainer .customCard {
        padding: 1vh 2vw 0vh;
    }

    #socailCardContainer .customCard h3 {
        padding-left: 3vw;
        font-size: 2.7vh
    }
}


@media screen and (max-width: 640px) { 
    iframe, .tiktok-embed, .twitter-timeline.twitter-timeline-rendered {
        height: 500px;
        width: 90vw !important;
        border-radius: 1rem;
    }
    #socailCardContainer .customCard {
        padding: 1vh 2vw 0vh;
    }

    #socailCardContainer .customCard h3 {
        padding-left: 3vw;
        font-size: 2.7vh
    }
}
</style>