<template>
    <div>
        <div class="content relative">
            <img class="doctorTypes" :src="'/media/img/' + src" />

            <div class="arrowBg d-flex justify-center align-center hoverable">
                Preview <i class="fa-solid fa-arrow-right"></i>
            </div>
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
        height: 45px;
        left: 23px;
        top: 255px;
        font-size: 1.25rem;
        position: absolute;
        background: var(--pri);
        color: var(--white);
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
        height: 45px;
        background: var(--sec);
        transition: width 0.5s ease;
    }
    i.fa-solid {
        color: var(--white);
        padding-left: 1vw;
    }
    @media only screen and (min-width: 768px) and (max-width: 1023px) {
        .doctorTypes {
            width: 27vw !important;
            height: 273px !important;
        }
        .arrowBg {
            bottom: 10% !important;
            width: 18vw;
            font-size: 1.1rem;
            top: unset !important;
        }
        .title {
            top: unset;
        }

    }
    @media only screen and (max-width: 767px) {
        .arrowBg {
            width: 35vw;
            z-index: 1;
        }
    }
    @media only screen and (min-width: 1024px) {
        .arrowBg {
            width: 10vw;
            font-size: 1.2rem;
        }
    }
</style>
<script>
    export default {
        props: {
            src: String,
            title: String,
        },
    };
</script>