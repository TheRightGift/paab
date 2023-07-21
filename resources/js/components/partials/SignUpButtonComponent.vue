<template>
    <div>
        <button
            class="btn waves waves-effect d-flex align-center justify-center"
            :class="{transparent: bg != null || bg != '' }"
            @click="route(goto)"
        >
            Sign up
        </button>
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
        word-wrap: break-word;
        text-transform: capitalize;
        /* padding: 4vh 5.3vw; */
        color: var(--white);
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .transparent {
        background-color: transparent;
        color: var(--pri);
        border: 2px solid var(--pri);
    }
    .btn:hover,
    .btn:visited {
        color: var(--white);
        background-color: var(--sec) !important;
        border: 2px solid var(--white);
    }
    @media only screen and (max-width:767px) {
        .btn {
            padding: 2.6vh 8vw !important;
            /* width: 38vw;
            height: 7vh; */
        }
    }
    @media only screen and (min-width: 1024px) {
        .btn {
            /* padding: 4vh 4vw; */
            width: 15vw;
            height: 6vh;
        }
    }
</style>
<script>
    export default {
        methods: {
            route(url) {
                location.href = url;
            },
        },
        props: {
            bg: String,
            goto: String,
        }
    };
</script>