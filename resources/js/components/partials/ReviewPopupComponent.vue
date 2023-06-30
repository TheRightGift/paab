<template>
    <div>
        <div class="chat-box d-flex flex-col">
            <div class="chat-triangle"></div>
            <div class="">
                <p class="name">Kenneth John Cipher</p>
                <div>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <div class="review">
                    As a medical professional, it can prove to be a daunting task to
                    allocate sufficient time towards the development of a proficient
                    resume or portfolio. Nevertheless, the emergence of the Work the
                    Dream (WTD) platform has simplified this process, rendering it
                    considerably more manageable.
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
    .chat-box {
        position: relative;
        opacity: 0.7;
        width: 433.49px;
        height: 171px;
        background: rgba(231, 230, 230, 0.815);
        font-size: 0.813rem;
        font-family: Montserrat;
        border-radius: 15px;
        border: 0.5px solid #c5c5c53b ;
        padding: 10px 24px;
        margin-left: 30px;
    }
    .chat-triangle {
        position: absolute;
        top: 39%;
        left: -30px;
        width: 0;
        height: 0;
        border-top: 24px solid transparent;
        border-bottom: 24px solid transparent;
        border-right: 30px solid #f0f0f0;
    }
    .name {
        font-size: 0.875rem;
        margin: 1px;
    }
    i.fa-star {
        color: #dbba0d;
    }
    .review {
        width: 366px;
        height: 36px;
        color: #727272;
        font-weight: 400;
        word-wrap: break-word;
    }
</style>
<script>
    export default {};
</script>