<template>
    <div class="section scrollspy" id="miniBlog">
        <div class="container"><!--v-if this is preview-->
            <div class="row">
                <div class="col l12">
                    <span class="sectionSubHeading">MINI BLOG</span>
                    <h2 class="sectionHeading">Shared <br/>updates &amp; thoughts.</h2>
                </div>
            </div>
            <div  class="row">
                <div class="row">
                    <div class="col s12 m6 l4" v-for="blog in miniBlog" :key="blog">
                        <div class="card">
                            <div class="card-image">
                                <img :src="blog.img" v-if="preview == '1'">
                                <img :src="'/media/tenants/'+tenant+'/img/miniblog/'+blog.imageUrl" v-if="preview == '0'">
                                <span class="card-title">{{blog.title}}</span>
                            </div>
                            <div class="card-content">
                                {{truncate(blog.body)}}
                            </div>
                            <div class="card-action">
                                <a href="#">Read more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div><!--else if being used for website--></div>
        
        <div id="blogModal" class="modal">
            <div class="modal-content">
                <div class="row">

                </div>
                <div class="row">

                </div>
                <div class="row">

                </div>
            </div>
        </div>
    </div>
</template>
<script>
import ImageCropper from '../../partials/ImageCropper.vue';
    export default {
        components: {ImageCropper},
        data() {
            return {
                loading: false,
                
            };
        },
        props: {
            tenant: String,
            isLoggedIn: Boolean,
            miniBlog: Array,
            preview: String
        },
        mounted() {
            // this.getActivePromo();
        },
        methods: {
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
<style scoped>
</style>
