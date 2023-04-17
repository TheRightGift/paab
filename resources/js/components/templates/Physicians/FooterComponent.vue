<template>
    <footer class="footer grey-text text-darken-3">
        Powered by <span class="domain">whitecoatdomain</span>
    </footer>
</template>
<script>
    export default {
        data() {
            return {
                location: location.host
            }
        }
    }
</script>
<style scoped>
    .domain {
        color: #77DEF4;
    }
    .footer {
        font-family: 'Montserrat', sans-serif;
        font-weight: 500;
        font-size: 0.75rem;
        line-height: 20px;
        text-align: center;
        letter-spacing: 0.1px;

        color: #000000;
        padding: 2rem 0;
    }
</style>
