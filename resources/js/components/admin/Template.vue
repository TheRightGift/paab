<template>
    <div>
        <mobile-nav-component />

        <div class="row" id="dashRowDiv">
            <!-- Sidebar for large and medium devices -->
            <side-nav-component @user="getUser"/>
            <admins-template-view-component :role="user.role"/>
        </div>
    </div>
</template>

<script>
    import MobileNavComponent from "../partials/MobileNavComponent.vue";
    import AdminsTemplateViewComponent from "../partials/AdminsTemplateViewComponent.vue";
    import SideNavComponent from "../partials/SideNavComponent.vue";
    import Template from "../super/Template.vue";
    export default {
        components: {
            MobileNavComponent,
            SideNavComponent,
            Template,
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
<style scoped>
    .clientCreatePortInputRowDiv {
        padding: 3em;
    }
    #userTempDiv {
        cursor: pointer;
    }
    .image {
        width: 328px;
        height: 262px;
    }
    .style {
        margin: 0 5% 0 5%;
    }
    .btn {
        background-color: var(--primary);
    }
</style>