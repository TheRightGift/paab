<template>
    <footer class="footer grey-text text-darken-3">
        &copy; {{  new Date().getFullYear() }}, {{ location }}
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
