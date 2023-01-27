<template>
    <div id="templateAbout">
        <div class="row">
            <div class="col s12 rm_mg_pd">
                <div class="section scrollspy physiContainerDiv" id="about">
                    <div v-if="bio == null">
                        <div class="row rm_mg_pd">
                            <div class="col s12 m6 l6">
                                <div class="containerDiv">
                                    <h3 class="physiTempName">
                                        Hi, I'm
                                        <br />
                                        Dr Chidinma Felix
                                        <span
                                            class="primaryColorBoxDesign"
                                        ></span>
                                    </h3>

                                    <p class="physiSummaryTxt">
                                        Sed porttitor lectus nibh. Proin eget
                                        tortor risus. Curabitur aliquet quam id
                                        dui posuere blandit. Vestibulum ante
                                        ipsum primis in faucibus orci luctus et
                                        ultrices posuere cubilia Curae; Donec
                                        velit neque, auctor sit amet aliquam
                                        vel, ullamcorper sit amet ligula. Cras
                                        ultricies ligula sed magna dictum porta.
                                        Quisque velit nisi, pretium ut lacinia
                                        in, elementum id enim. Mauris blandit
                                        aliquet elit, eget tincidunt nibh
                                        pulvinar a. Pellentesque in ipsum id
                                        orci porta dapibus. Nulla porttitor
                                        accumsan tincidunt. Curabitur arcu erat,
                                        accumsan id imperdiet et, porttitor at
                                        sem. Praesent sapien massa, convallis a
                                    </p>

                                    <a href="#cvDetails" class="physiTempBtn waves-effect waves-light modal-trigger">
                                        View My curriculum vitae
                                    </a>
                                </div>
                            </div>

                            <div class="col s12 m6 l6 rm_mg_pd profileImgContainer">
                                <!-- offset-l3 media/img/doc.png-->
                                <div class="profileImg" v-if="preview == '0'">
                                    <img
                                        :src="'media/img/surgeonhero.png'"
                                        alt="doc.png"
                                        class="responsive-img physiRightImg"
                                    />
                                </div>
                                <div class="profileImg" v-else>
                                    <img
                                        src="/media/img/surgeonhero.png"
                                        alt="doc.png"
                                        class="responsive-img physiRightImg"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-else>
                        <div class="row rm_mg_pd">
                            <div class="col s12 m6 l6">
                                <div class="containerDiv">
                                    <h3 class="physiTempName">
                                        Hi, I’m
                                        <br />
                                        {{ title }} {{ bio.firstname }}
                                        {{ bio.lastname }}
                                        <span
                                            class="primaryColorBoxDesign"
                                        ></span>
                                    </h3>

                                    <p class="physiSummaryTxt">
                                        {{ bio.about }}
                                    </p>

                                    <a href="#cvDetails" class="physiTempBtn btn-flat waves-effect waves-light modal-trigger">
                                        View My curriculum vitae
                                    </a>
                                </div>
                            </div>

                            <div class="col s12 m6 l6 rm_mg_pd profileImgContainer">
                                <!-- offset-l3 media/img/doc.png-->
                                <div class="profileImg" v-if="preview == '0'">
                                    <img
                                        :src="'/media/tenants/'+tenant+'/img/'+ bio.photo"
                                        alt="doc.png"
                                        class="responsive-img physiRightImg"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="cvDetails" class="modal">
            <div class="modal-content">
                <i class="material-icons right modal-close">close</i>
                <!-- <h4>{{}}</h4>
                <p>A bunch of text</p> -->
                <p class="text-center"><strong>Curriculum Vitae is still in development mode, please check back later. Thanks</strong></p>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            bio: Object,
            user: String,
            services: Array,
            location: String,
            preview: String,
            title: String,
            tenant: String,
        },
    };
</script>
<style lang="scss" scoped>
@media only screen   
and (min-width: 1370px)  
and (max-width: 1605px)  
{ /* STYLES GO HERE */
    .physiRightImg {
        height: 501.5px;
        width: 445.93px;
    }
} 
.physiRightImg {
        position: unset;
}
.physiTempBtn:hover {
    text-decoration: none;
}
</style>