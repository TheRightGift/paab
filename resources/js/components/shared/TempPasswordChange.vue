<template>
    <div>
        <!-- Sidenav for small devices -->
        <mobile-nav-component />

        <div class="row" id="dashRowDiv">
            <!-- Sidebar for large and medium devices -->
            <side-nav-component />

            <!-- Mail blue div -->
            <PasswordChangeComponent />
        </div>
    </div>
</template>
<script>
    import MobileNavComponent from "../partials/MobileNavComponent.vue";
    import SideNavComponent from "../partials/SideNavComponent.vue";
    import PasswordChangeComponent from "../partials/PasswordChangeComponent.vue";
    export default {
        components: { SideNavComponent, MobileNavComponent, PasswordChangeComponent },

    };
</script>

