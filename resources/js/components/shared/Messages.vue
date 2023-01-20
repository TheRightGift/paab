<template>
    <div>
        <!-- Sidenav for small devices -->
        <AdminMobileNavComponent />

        <div class="row" id="dashRowDiv">
            <!-- Sidebar for large and medium devices -->
            <sidenav-component />

            <!-- Mail blue div -->
            <div class="col s12 m10 l10" id="mailRightDiv">
                <div class="row mailBlueDiv mailRow">
                    <div class="webBlackDiv1">

                        <div class="row webBlackDiv1">
                            <div class="col s12">
                                <p class="mailTitle">Mails</p>
                            </div>
                            <div class="col s12">
                                <p class="webBlackTxt">
                                    Lets start and automate your process so you can
                                    reclaim time and focus on your goals.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mailRow">
                    <p class="center-align">
                        No Mail
                    </p>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
import SidenavComponent from "../partials/SideNavComponent.vue";
import AdminMobileNavComponent from "../partials/AdminMobileNavComponent.vue";
export default {
    components: {
        SidenavComponent,
        AdminMobileNavComponent,
    },
    data() {
        return {
            bg_img: '/media/img/istockphoto-1390124896-170667a.jpg',
            pro_img: '/media/img/yuna.jpg',
        };
    },
    mounted() { },
    methods: {
        showSingleMesg() {
            window.location.href = "/admin/singlemsg";
        }
    }
}
</script>