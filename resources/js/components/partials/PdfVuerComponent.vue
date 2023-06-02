<template>
    <div v-if="pdfUrl != ''">
        <pdf :src="pdfUrl" :page="1">
            <template slot="loading"> loading content here... </template>
        </pdf>
    </div>
</template>
  
  <script>
    import pdf from "pdfvuer";

    export default {
        components: {
            pdf,
        },
        props: {
            pdfUrl: String,
        }
    };
</script>