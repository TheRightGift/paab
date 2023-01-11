<template>
    <div class="copyWrite">
        &copy; White Coat Domain. {{getYear()}}. We support your brand!
    </div>
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