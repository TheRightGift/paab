<template>
    <div>
        <button class="btn waves waves-effect d-flex align-center" @click="route(goto)">get started</button>
    </div>
</template>
<style scoped>
    .btn {
        background-color: var(--pri);
        box-shadow: 0px 30px 50px rgba(16, 157, 173, 0.15);
        border-radius: 192px;
        border: 2px solid rgb(255, 255, 255);
        font-weight: 700;
        font-family: Montserrat;
        font-size: 1.125rem;
        letter-spacing: 0.36px;
        text-transform: capitalize;
        color: var(--white);
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .btn:hover, .btn:visited {
        color: var(--pri);
        background-color: var(--white);
        border: 2px solid var(--pri);
    }
    @media only screen and (max-width:767px) {
        .btn {
            padding: 14px, 36px, 14px, 36px !important;
            width: 38vw;
            height: 7vh;
        }
    }
    @media only screen and (min-width: 1024px) {
        .btn {
            /* padding: 4vh 4vw; */
            width: 15vw;
            height: 8vh;
        }
    }
</style>
<script>
    export default {
        methods: {
            route(url) {
                if (url !== undefined) {
                    location.href = url;
                }
            }
        },
        props: {
            goto: String
        }
    };
</script>