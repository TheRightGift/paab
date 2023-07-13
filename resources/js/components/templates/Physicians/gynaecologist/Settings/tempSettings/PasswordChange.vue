<template>
    <div>
        <p>{{author.firstname}} {{author.lastname}}</p>
        <PasswordChangeComponent :tenant="true"/>
        <FooterComponent />
    </div>
</template>
<script>
import PasswordChangeComponent from "../../../../partials/PasswordChangeComponent.vue";
import FooterComponent from "../../FooterComponent.vue";
export default {
    name: 'PasswordChangeForTenant',
    components: {FooterComponent, PasswordChangeComponent},
    data() {
        return {
            author: {},
        }
    },
    props: {user: String},
    watch: {
        user(newval, oldval) {
            console.log(newval, oldval)
            if (newval) this.author = JSON.parse(newval);
        }
    }
}
</script>

