<template>
    <section class="footer">
        <div class="container">
            <div class="footerBody">
                <div class="socials-footer">
                    <a href="#!" v-for="(image, index) in images" :key="index">
                        <img class="responsive-img" :src="'./media/img/'+image.src" :alt="image.alt">
                    </a>
                </div>
                <div class="termsPrivacyPolicy">
                    <a href="#!">Terms</a>
                    <a href="#!">Privacy Policy</a>
                    <p>&copy; 2023, Whitecoatdomain</p>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
    export default {
        data() {
            return {
                images: [
                    {
                        src: 'linkedinFooter.png',
                        alt: 'our linkedin handle'
                    },
                    {
                        src: 'facebookFooter.png',
                        alt: 'our facebook handle',
                    },
                    {
                        src: 'twitterFooter.png',
                        alt: 'our twitter handle'
                    },
                    {
                        src: 'instaFooter.png',
                        alt: 'our instagram handle'
                    }
                ]
            }
        },
    };
</script>
<style scoped>
.footer {
    background: #2E4451;
    color: var(--white);
}
.footer {
    border-top: thin solid rgba(217, 217, 217, 0.5);
    padding: 1.5vh;
}
.footerBody, .termsPrivacyPolicy {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.termsPrivacyPolicy > a, .socials-footer > a:not(:last-of-type), .termsPrivacyPolicy > p {
    margin: 0 1vw 0 0;
    text-decoration: none;
    color: var(--white);
}
.termsPrivacyPolicy > a:hover {
    color: #D7B9AE;
    text-decoration: underline #D7B9AE;
}

@media screen and (max-width: 640px) { 
    .footerBody, .termsPrivacyPolicy {
        flex-direction: column;
    }
    .termsPrivacyPolicy > a, .socials-footer, .termsPrivacyPolicy > p {
        margin-bottom: .75vh;
    }
    .socials-footer > a:not(:last-of-type) {
        margin-right: 4.5vw;
    }
}
</style>