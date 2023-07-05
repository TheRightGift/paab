<template>
    <div>
        <div class="content relative">
            <img class="doctorTypes" :src="'/media/img/'+src" />

            <div class="arrowBg d-flex justify-center align-center hoverable"><img src="/media/img/arrow-right.png" /></div>
            <div class="title">{{ title }}</div>
        </div>
    </div>
</template>
<style scoped>
    .doctorTypes {
        width: 256px;
        height: 319px;
        border-radius: 10px;
    }
    .arrowBg {
        width: 56px;
        height: 45px;
        left: 23px;
        top: 255px;
        position: absolute;
        background: var(--pri);
        border-radius: 5px;
        transition: width 0.3s ease;
        cursor: pointer;
    }
    .title {
        left: 5px;
        top: 334px;
        position: absolute;
        color: rgba(0, 0, 0, 0.726);
        font-size: 1.2rem;
        font-family: Montserrat;
        font-weight: 500;
        word-wrap: break-word;
    }
    .arrowBg:hover {
        width: 116px; 
        height: 45px;
        background: var(--sec);
        transition: width 0.5s ease;
    }
    .arrowBg:hover img {
        transform: scale(1.2);
        transition: width 0.3s ease;
        width: 51.79px;
    }
    .arrowBg img {
        width: 30px;
    }
    @media only screen and (min-width: 768px) and (max-width: 1023px) {
        .doctorTypes {
        width: 27vw !important;
        height: 273px !important;
    }
    .arrowBg {
        bottom: 10% !important;
        top: unset !important;
    }
    .title {
        top: unset;
    }
}
</style>
<script>
    export default {
        props: {
            src: String,
            title: String,
        }
    };
</script>