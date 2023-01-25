<template>
    <footer class="copyWrite">
        &copy; White Coat Domain. {{getYear()}}. We support your brand!
    </footer>
</template>
<script>
    export default {
        data() {
            return {};
        },
        methods: {
            getYear() {
                return new Date().getFullYear()
            }
        },
        props: {},
        mounted() {},
        watch: {},
    };
</script>