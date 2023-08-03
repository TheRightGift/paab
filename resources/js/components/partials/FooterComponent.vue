<template>
    <div>
        <footer class="relative">
            <div class="container hide-on-med-and">
                <div class="d-flex justify-between align-center sm-flex-col">
                    <img
                        src="/media/img/wcd-logo-noBckg.png"
                        class="responsive-img logoFooter mb-2"
                    />
                    <div class="d-flex justify-between align-center sm-justify-center  md-absolute sm-flex-col">
                        <!-- <div class="hide-on-small-only">
                            <div class="d-flex justify-between sm-justify-center align-center">
                                <span class="links"
                                    ><i class="fa-solid fa-phone"></i>
                                </span>
                                <span class="pl-2">+234817646</span>
                            </div>
                        </div> -->
                        <div class="hide-on-small-only">
                            <div class="d-flex justify-between align-center sm-justify-center pl-2">
                                <span class="links"
                                    ><i class="fa-solid fa-envelope"></i
                                    >
                                </span>
                                <span class="pl-2">support@whitecoatdomain</span>
                            </div>
                        </div>
                        <div class="hide-on-med-only">
                            <a href="#" class="links"
                                ><i class="fa-brands fa-facebook"></i>
                            </a>
                            <a href="#" class="links"
                                ><i class="fa-brands fa-instagram"></i>
                            </a>
                            <a href="#" class="links"
                                ><i class="fa-brands fa-twitter"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-between md-mt-0 mt-4 sm-flex-col sm-align-center">
                    <div class="cite">
                        “Enhance your public image with White Coat Domain”
                    </div>
                    <div class="d-flex justify-between md-flex-col md-rel-13">
                        <div class="explore mb-4">
                            <h5>Explore</h5>
                            <ul>
                                <li>
                                    <a href="/">Home</a>
                                </li>
                                <li>
                                    <a href="/">Templates</a>
                                </li>
                            </ul>
                        </div>
                        <!-- <div class="explore ml-4 md-m0">
                            <h5>Utility Pages</h5>
                            <ul>
                                <li>
                                    <a href="/">Licenses</a>
                                </li>
                                <li>
                                    <a href="/">Change log</a>
                                </li>
                            </ul>
                        </div> -->
                    </div>
                    <div class="hide-on-med-and-up">
                        <div class="d-flex justify-between align-center sm-align-center sm-flex-col">
                            <!-- <div class="d-flex justify-between sm-justify-center align-center mb-2">
                                <span class="links"
                                    ><i class="fa-solid fa-phone"></i>
                                </span>
                                <span class="pl-2">+234817646</span>
                            </div> -->
                            <div class="d-flex justify-between align-center sm-justify-center pl-2">
                                <span class="links"
                                    ><i class="fa-solid fa-envelope"></i
                                    >
                                </span>
                                <span class="pl-2">support@whitecoatdomain</span>
                            </div>
                        </div>
                    </div>
                    <div class="hide-on-small-only md-rel-13 width30">
                        <div class="contactus d-flex flex-col">
                            <h5>Contact Us</h5>
                            <p>We are always available to help</p>
                            <form>
                                <div class="custom-input">
                                    <input
                                        type="email"
                                        placeholder="your email address"
                                        class="browser-default"
                                        required
                                    />
                                </div>
                                <button
                                    class="waves waves-effect custom-btn footerBtn"
                                    type="submit"
                                >Send</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div
                class="
                    curve hide-on-med-and-down
                "
            ></div> -->
        </footer>
        <div class="copyright d-flex justify-center">
            Copyright © Whitecoatdomain | {{ new Date().getFullYear() }}
        </div>
    </div>
</template>
<style scoped>
    .mb-2, .md-mb-2 {
        margin-bottom: 2rem;
    }
    .mb-4 {
        margin-bottom: 4rem;
    }
    .mt-4 {
        margin-top: 4rem;
    }
    footer {
        padding: 9vh 0 14vh 0;
        background: #e5f2ef;
    }
    .logoFooter {
        height: 100px;
    }
    .copyright {
        color: #545454;
        font-size: 1rem;
        font-family: 'Lato', sans-serif;
        font-weight: 400;
        line-height: 32px;
        word-wrap: break-word;
    }

    .cite[data-v-f8ae22de] {
        /* width: 369.58px; */
        height: 158.31px;
        color: #333232;
        font-size: 1.75rem;
        font-family: 'Montserrat', sans-serif;
        font-weight: 500;
        word-wrap: break-word;
    }
    
    .explore h5, .contactus h5 {
        color: #1c1c1c;
        font-size: 20px;
        font-family: 'Montserrat', sans-serif;
        font-weight: 600;
        line-height: 22.9px;
        word-wrap: break-word;
    }
    .explore a {
        color: #545454;
        font-size: 16px;
        font-family: 'Montserrat', sans-serif;
        font-weight: 400;
        line-height: 32px;
        word-wrap: break-word;
    }
    .custom-input input, .custom-textarea textarea {
        width: 100%;
        height: 60px;
        background: white;
        border-left: 0.5px #dcdcdc solid;
        border-top: 0.5px #dcdcdc solid;
        border-right: 0.5px #dcdcdc solid;
        border-bottom: 0.5px #dcdcdc solid;
        padding: 0 0 0 1vw;
        /* margin-bottom: 2vh; */
    }
    .width30 {
            width: 30%;
        }
    .custom-input input { 
        width:100%;
    }
    .custom-input input::placeholder {
        color: #b9b9b9;
        font-size: 16px;
        font-weight: 400;
        line-height: 25.6px;
        word-wrap: break-word;
    }
    .custom-btn {
        color: var(--white);
        background: var(--pri);
        padding: 1.5vh 4vw;
        border-radius: 30px;
        border: 2px solid white;
        font-size: 1.25rem;
        font-weight: 500;
        margin-top: 2vh;
    }
    .custom-btn:hover, .custom-btn:visited {
        color: var(--pri);
        background: var(--white);
    }
    span.links {
        width: 43.115px;
        height: 43.115px;
        line-height: 43.115px;
        background: var(--pri);
        border-radius: 100%;
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
        
    }
    span.links i{
        color: white;
        
    }
    .pl-2 {
        padding-left: 1.5rem;
    }
    span.pl-2 {
        color: #545454;
        font-size: 1rem;
        font-style: normal;
        font-weight: 400;
        line-height: 200%;
    }
    i.fa-brands {
        padding-left: 2vw;
        font-size: 1.5rem;
        color: var(--white);
    }
    .curve {
        width: 833.23px;
        height: 630.23px;
        left: -37%;
        top: -384.58px;
        position: absolute;
        border-radius: 9999px;
        border: 1.5px #edfffa solid;
    }
    
    @media only screen and (min-width: 768px) and (max-width: 1023px) {
        .container {
            width: 90%;
        }
        .md-flex-col {
            flex-direction: column;
        }
        .md-justify-center {
            justify-content: center;
        }
        .custom-btn {
            padding: 1vh 10vw;
        }
        
        .cite {
            width: 45vw !important;
            text-align: left !important;
        }
        
        .md-absolute {
            bottom: 15%;
        }
        .width30 {
            width: 30%;
        }
        .custom-input {
            width: 100%;
        }

        .md-rel-13 {
            position: relative;
            top: -3vh;
        }
        
    }
    @media only screen and (max-width: 767px) {
        .sm-align-center {
            align-items: center;
        }
        .sm-flex-col {
            flex-direction: column;
        }
        .cite {
            font-size: 1.5rem;
            width: 52vw;
            text-align: center;
        }
        i.fa-brands {
            color: var(--pri) !important;
            font-size: 1.8rem;
            padding-left: 10vw;
        }
        .explore:nth-of-type(2) {
            margin-left: 15vw;
        }
    }
</style>
<script>
    export default {};
</script>