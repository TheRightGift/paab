<template>
    <div class="section scrollspy physiContainerDiv" id="services">
        <div v-if="bio == null">
            <div class="row">
                <div class="col s12 m6 l5">
                    <p class="physiTempNameTitle">My name is</p>
                    <p class="physiTempName">Your name here</p>
                    <p class="physiTempTxt">
                        It is a long established fact that a reader will be distracted by the readable content of a page when
                        looking at its
                        layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as
                        opposed to using
                        'Content here, content here', making it look like readable English. Many desktop publishing packages and web
                        page
                        editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many
                        web sites
                        still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on
                        purpose
                        (injected humour and the like).
                    </p>
                    <button class="btn" id="physiTempBtn">
                        Download My curriculum vitae
                    </button>
                </div>
                
                <div class="col s12 m4 l6 offset-l3">
                    <div class="physiRightImgDiv">
                        <img src="/media/img/doc.png" alt="doc.png" class="responsive-img" id="physiRightImg">
                    </div>
                </div>
            </div>
    
            <div class="row">
                <div class="col s12">
                    <p class="servicesMainTitle">Services</p>
                    <p class="servicesWhatIdo">WHAT I DO</p>
                </div>
    
                <div class="col m4 l4">
                    <div class="servicesIconsDiv">
                        <i class="fa-solid fa-briefcase-medical servicesIcons1"></i>
                    </div>
    
                    <p class="servicesTitle">Service One</p>
    
                    <p class="servicesTxt">
                        Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature
                        from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia
                    </p>
                </div>
    
                <div class="col m4 l4">
                    <div class="servicesIconsDiv">
                        <i class="fa-solid fa-tooth servicesIcons"></i>
                    </div>
                
                    <p class="servicesTitle">Service Two</p>
                
                    <p class="servicesTxt">
                        Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin
                        literature
                        from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in
                        Virginia
                    </p>
                </div>
    
                <div class="col m4 l4">
                    <div class="servicesIconsDiv">
                        <i class="fa-sharp fa-solid fa-heart-pulse servicesIcons2"></i>
                    </div>
                
                    <p class="servicesTitle">Service Three</p>
                
                    <p class="servicesTxt">
                        Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin
                        literature
                        from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in
                        Virginia
                    </p>
                </div>
            </div>
        </div>
        <div v-else>
            <div class="row">
                <div class="col s12 m6 l5">
                    <p class="physiTempNameTitle">My name is</p>
                    <p class="physiTempName">Dr. {{bio.firstname}} {{bio.lastname}}</p>
                    <p class="physiTempTxt">
                        {{bio.about}}
                    </p>
                    <a class="btn" id="physiTempBtn" :href="'/tenancy/assets/'+bio.CV" target="_blank">
                        Download My curriculum vitae
                    </a>
                </div>
                
                <div class="col s12 m4 l6 offset-l3">
                    <div class="physiRightImgDiv">
                        <img :src="'/tenancy/assets/'+bio.photo" alt="doc.png" class="responsive-img" id="physiRightImg">
                    </div>
                </div>
            </div>
    
            <div class="row">
                <div class="col s12">
                    <p class="servicesMainTitle">Services</p>
                    <p class="servicesWhatIdo">WHAT I DO</p>
                </div>
    
                <div class="col m4 l4" v-for="service in services" :key="service.id">
                    <div class="servicesIconsDiv">
                        <i class="fa-solid servicesIcons1" :class="service.icon"></i>
                    </div>
    
                    <p class="servicesTitle">{{service.title}}</p>
    
                    <p class="servicesTxt">
                        {{service.description}}
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        user: String,
        bio: Object,
        services: Array,
    }
}
</script>
<style>
    #physiRightImg {
        width: 428px;
        height: 497px;
    }
</style>