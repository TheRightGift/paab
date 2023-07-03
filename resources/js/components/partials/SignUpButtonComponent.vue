<template>
    <div>
        <button
            class="btn waves waves-effect d-flex align-center"
            @click="route('auth/login')"
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
        padding: 3vh 4.5vw;
        color: var(--white);
    }
    .btn:hover,
    .btn:visited {
        color: var(--white);
        background-color: var(--sec);
        border: 2px solid var(--white);
    }
</style>
<script>
    export default {
        methods: {
            route(url) {
                location.href = url;
            },
        },
    };
</script>