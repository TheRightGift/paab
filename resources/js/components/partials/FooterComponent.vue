<template>
    <footer class="footer">
        <div class="footerContainDiv">
                <div class="row footerInnerDiv">
                    <div class="col l4 footerGridDivs">
                        <p class="contactTitle">Contact</p>
                        <a href="#" class="contactTxt">info@paab.com</a>
                    </div>

                    <div class="col l4 footerGridDivs">
                        <p class="locTitle">Location</p>
                        <p class="locTxt">
                            8 providence street,lekki,
                            <br>
                            Lagos,
                            <br>
                            Nigeria
                        </p>
                    </div>

                    <div class="col l4">
                        <p class="socialTitle">Socials</p>
                        
                        <div class="socialMedIconsDiv">
                            <a href="#">
                                <i class="fa-brands fa-square-instagram socialMedIcons"></i>
                            </a>
                            <a href="#">
                                <i class="fa-brands fa-facebook socialMedIcons"></i>
                            </a>
                            <a href="#">
                                <i class="fa-brands fa-twitter socialMedIcons"></i>
                            </a>
                        </div>
                    </div>
                </div>
        </div>
        <InnerFooterComponent/>
    </footer>
</template>
<script>
    import InnerFooterComponent from './InnerFooterComponent.vue';
    export default {
        components: {
            InnerFooterComponent
        },
        data() {
            return {};
        },
        methods: {},
        props: {},
        mounted() {},
        watch: {},
    };
</script>