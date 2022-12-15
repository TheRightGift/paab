<template>
    <edit-website-modal-component :user="userDets"/>
</template>
<script>
import EditWebsiteModalComponent from './EditWebsiteModalComponent.vue'
export default {
    components: { EditWebsiteModalComponent },
    props: {
        user: String,
    },
    data() {
        return {
            userDets: JSON.parse(this.user)
        }
    },
    setup() {
        
    },
}
</script>