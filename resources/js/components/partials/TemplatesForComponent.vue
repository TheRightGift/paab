<template>
    <div>
        <div class="content relative">
            <img class="doctorTypes" src="/media/img/psychologist.png" />

            <div class="arrowBg d-flex justify-center align-center"><img src="/media/img/arrow-right.png" /></div>
            <div class="title">Therapist</div>
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
    }
    .title {
        left: 5px;
        top: 334px;
        position: absolute;
        color: var(--black);
        font-size: 1.25rem;
        font-family: Montserrat;
        font-weight: 500;
        word-wrap: break-word;
    }
    .arrowBg:hover {
        width: 116px; 
        height: 45px;
        background: var(--sec);
    }
    .arrowBg:hover img {
        transform: scale(1.2);
        transition: transform 0.3s ease;
        width: 51.79px;
    }
    .arrowBg img {
        width: 30px;
    }
</style>
<script>
    export default {};
</script>