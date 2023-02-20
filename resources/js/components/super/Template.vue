<template>
    <div>
        <!-- Sidenav for small devices -->
        <mobile-nav-component />

        <div class="row" id="dashRowDiv">
            <!-- Sidebar for large and medium devices -->
            <side-nav-component @user="getUser"/>
            <admins-template-view-component :role="user.role"/>
            
        </div>
    </div>
</template>

<script>
import AdminsTemplateViewComponent from '../partials/AdminsTemplateViewComponent.vue';
    import MobileNavComponent from "../partials/MobileNavComponent.vue";
    import SideNavComponent from "../partials/SideNavComponent.vue";
    export default {
        components: {
            MobileNavComponent,
            SideNavComponent,
                AdminsTemplateViewComponent,
        },
        data() {
            return {
                user: {},
            }
        },
        methods: {
            getUser(e) {
                this.user = e;
            },
        },
        
    };
</script>
