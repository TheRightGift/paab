<template>
    <div>
        <p>{{author.firstname}} {{author.lastname}}</p>
        <PasswordChangeComponent :tenant="true"/>
    </div>
</template>
<script>
import PasswordChangeComponent from "../../../../partials/PasswordChangeComponent.vue";
export default {
    name: 'PasswordChangeForTenant',
    components: {PasswordChangeComponent},
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

