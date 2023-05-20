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
                        <!-- <div class="card">
                            <div class="card-image">
                                <img :src="blog.imageUrl" v-if="preview == '1'">
                                <img :src="'/media/tenants/'+tenant+'/img/miniblog/'+blog.imageUrl" v-if="preview == '0'">
                                <span class="card-title">{{blog.title}}</span>
                            </div>
                            <div class="card-content">
                                {{truncate(blog.body)}}
                            </div>
                            <div class="card-action activator">
                                <a href="#">Read more</a>
                            </div>
                        </div> -->

                        <div class="card">
                            <div class="card-image waves-effect waves-block waves-light">
                                <img :src="blog.imageUrl" v-if="preview == '1'" class="activator">
                                <img :src="'/media/tenants/'+tenant+'/img/miniblog/'+blog.imageUrl" v-if="preview == '0'" class="activator">
                            </div>
                            <div class="card-content">
                                <span class="card-title activator grey-text text-darken-4">{{blog.title}}<i class="material-icons right">more_vert</i></span>
                                <!-- <p><a href="#">This is a link</a></p> -->
                            </div>
                            <div class="card-reveal">
                                <span class="card-title grey-text text-darken-4">{{blog.title}}<i class="material-icons right">close</i></span>
                                <p>{{blog.body}}</p>
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
.card-title {
    text-shadow: #000 1px 0 5px;
}
</style>
