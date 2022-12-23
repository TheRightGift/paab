<template>
    <div>
        <div class="editWebModalDiv">
            <p id="editWebWlcTxt">Promotionals</p>
            <button @click="close">Back</button>
        </div>
    </div>
</template>
<script>
    export default {
        methods: {
            close() {
                this.$emit("close");
            },
        },
    };
</script>