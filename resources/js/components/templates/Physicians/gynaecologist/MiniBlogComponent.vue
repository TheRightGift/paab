<template>
    <div class="section scrollspy" id="miniBlog">
        <div class="container">
            <div class="flex justify-center align-center flex-col pb-3">
                <h2 class="heading">Mini Blog</h2>
                <p class="sectionDescription">
                    They provide a wide range of services and care for women of all
                </p>
                <div class="" v-for="blog in miniBlog" :key="blog">
                    <div class="flex justify-between align-center sm-flex-col">
                        <div class="blogImage">
                            <img :src="'/media/tenants/'+tenant+'/img/miniblog/'+blog.imageUrl" v-if="preview == '0'"/>
                            <img src="/media/img/templates/1/blogSample.png" v-if="preview == '1'">
                        </div>
                        <div class="blogTitleBody">
                            <h3 class="blogTitle sm-text-center">{{blog.title}}</h3>
                            <div class="flex justify-between align-center">
                                <div class="flex align-center">
                                    <img :src="'/media/tenants/'+tenant+'/img/'+bio.photo" class="responsive-img circle blogUploader" v-if="preview == '0'"/>
                                    <img src="/media/img/templates/1/profileSample.png" class="responsive-img circle blogUploader" v-else/>
                                    <p class="titleUploader">
                                        DR. <span v-if="preview == '0'"> {{ bio.firstname }} {{ bio.lastname }}</span>
                                        <span v-else> Jane Chang</span>
                                    </p>
                                </div>
                                <div class="flex align-center">
                                    <p class="dash"></p>
                                </div>
                                <div class="">
                                    <p class="uploadDate">
                                        <span v-if="preview == '1'">June 28, 2023</span>
                                        <span v-else>{{ moment(blog.created_at).format("MMMM D, YYYY") }}</span>
                                    </p>
                                </div>
                                <p class="shareHandle hide-on-small-only">
                                    <a href=""><i class="fa-solid fa-share-nodes"></i></a> <span v-if="preview == '1'"> 1K shares</span><span v-else>0 shares</span>
                                </p>
                            </div>
                            <p class="shareHandle hide-on-med-and-up sm-text-center">
                                <a href=""><i class="fa-solid fa-share-nodes"></i></a><span v-if="preview == '1'"> 1K shares</span><span v-else>0 shares</span>
                            </p>
                            <p class="blogBody sm-text-center">
                                {{blog.body}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import moment from "moment";

    export default {
        components: {},
        data() {
            return {
                loading: false,
                
            };
        },
        props: {
            tenant: String,
            isLoggedIn: Boolean,
            miniBlog: Array,
            preview: String,
            bio: Object
        },
        mounted() {
            // this.getActivePromo();
        },
        methods: {
            moment(arg) {
                return moment(arg);
            },
            truncate(words){
                let nuWord = words.replace( /(<([^>]+)>)/ig, ' ');
                if(nuWord.length > 57){
                    return nuWord.slice(0, 80)+'...';
                }
            }
        },
        computed: {},
    };
</script>