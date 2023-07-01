<template>
    <div>
        <footer class="relative">
            <div class="container">
                <div class="d-flex justify-between align-center">
                    <img
                        src="/media/img/wcd-logo-noBckg.png"
                        class="responsive-img logoFooter"
                    />
                    <div class="d-flex justify-between align-center">
                        <div class="d-flex justify-between align-center">
                            <span class="links"
                                ><i class="fa-solid fa-phone"></i>
                            </span>
                            <span class="pl-2">+234817646</span>
                        </div>
                        <div class="d-flex justify-between align-center pl-2">
                            <span class="links"
                                ><i class="fa-solid fa-envelope"></i
                                >
                            </span>
                            <span class="pl-2">support@whitecoatdomain</span>
                        </div>
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
                <div class="d-flex justify-between mt-4">
                    <div class="cite">
                        “Enhance your public image with White Coat Domain”
                    </div>
                    <div class="explore">
                        <h5>Explore</h5>
                        <a href="/">Home</a>
                    </div>
                    <div class="explore">
                        <h5>Utility Pages</h5>
                        <ul>
                            <li>
                                <a href="/">Licenses</a>
                            </li>
                            <li>
                                <a href="/">Change log</a>
                            </li>
                        </ul>
                    </div>
                    <div class="contactus d-flex flex-col">
                        <h6>Contact Us</h6>
                        <p>We are always available to help</p>
                        <form>
                            <div class="custom-input">
                                <input
                                    type="email"
                                    placeholder="your email address"
                                    class="browser-default"
                                />
                            </div>
                            <button
                                class="waves waves-effect custom-btn"
                                type="submit"
                            >Send</button>
                        </form>
                    </div>
                </div>
            </div>
            <div
                class="
                    curve
                "
            ></div>
        </footer>
        <div class="copyright d-flex justify-center">
            Copyright © Whitecoatdomain | {{ new Date().getFullYear() }}
        </div>
    </div>
</template>
<style scoped>
    footer {
        padding: 9vh 0 14vh 0;
        background: #e5f2ef;
    }
    .logoFooter {
        height: 100px;
    }
    .copyright {
        color: #545454;
        font-size: 16px;
        font-family: 'Lato', sans-serif;
        font-weight: 400;
        line-height: 32px;
        word-wrap: break-word;
    }
    .cite {
        width: 369.58px;
        height: 158.31px;
        color: #333232;
        font-size: 36px;
        font-family: 'Montserrat', sans-serif;
        font-weight: 500;
        word-wrap: break-word;
    }
    .explore h5 {
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
    .custom-input {
        width: 325.7px;
        height: 60px;
        background: white;
        margin-bottom: 2rem;
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
        padding: 3vh 6vw;
        border-radius: 30px;
        border: 2px solid white;
        font-size: 1.25rem;
        font-weight: 500;
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
    }.curve {
        width: 833.23px;
                    height: 630.23px;
                    left: -37%;
                    top: -384.58px;
                    position: absolute;
                    border-radius: 9999px;
                    border: 1.5px #edfffa solid;
    }
</style>
<script>
    export default {};
</script>