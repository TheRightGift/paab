<template>
    <div>
        <div class="service">
            <div class="icon-container">
                <img src="/media/img/cv.png" alt="like icon">
            </div>
            <p class="title">Curriculum Vitae</p>
            <p class="description">
                Our team of highly professionals uses the latest health quickly and easily.
            </p>
            <div class="d-flex align-center">
                <span class="readmore">Read More</span>
                <span class="holder d-flex justify-center align-center"><i class="fa fa-plus"></i> </span>
            </div>
        </div>
    </div>
</template>
<style scoped>
    .service {
        width: 286px;
        height: 305px;
        padding-left: 30px;
        padding-right: 30px;
        padding-top: 45px;
        padding-bottom: 45px;
        background: rgba(16, 157, 173, 0.1);
        flex-direction: column;
        justify-content: flex-start;
        align-items: flex-start;
        gap: 10px;
        display: inline-flex;
        font-family: Montserrat;
    }
    .service .title {
        color: #1c1c1c;
        font-size: 1.25rem;
        font-weight: 600;
        line-height: 22.9px;
        word-wrap: break-word;
    }
    .title, .description {
        margin: 1px;
    }
    .description {
        width: 225.27px;
        height: 72.58px;
        color: #545454;
        font-size: 1rem;
        font-family: Montserrat;
        font-weight: 400;
        line-height: 22.72px;
        word-wrap: break-word;
    }
    .readmore {
        color: #363636;
        font-size: 1rem;
        font-family: Inter;
        font-weight: 500;
        line-height: 25.6px;
        word-wrap: break-word;
    }
    .holder {
        width: 16.79px;
        height: 16.79px;
        background: var(--pri);
        border-radius: 9999px;
        color: var(--white);
        line-height: 16.79px;
        margin-left: 2vw;
    }
</style>
<script>
    export default {};
</script>