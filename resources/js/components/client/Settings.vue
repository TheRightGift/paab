<template>
    <div>
        <SideNavComponent @user="getUser"/>
        <HeaderComponent :user="user"/>
        <main>
            <section>
                <SettingsComponent :user="user"/>
            </section>
        </main>
    </div>
</template>
<script>
import HeaderComponent from '../partials/HeaderComponent.vue';
import SettingsComponent from '../partials/SettingsComponent.vue'
import SideNavComponent from '../partials/SideNavComponent.vue';
export default {
    components: { SettingsComponent, SideNavComponent, HeaderComponent },
    data() {
        return {
            user: {}
        }
    },
    methods: {
        getUser(e) {
            this.user = e;
        },
    }
}
</script>