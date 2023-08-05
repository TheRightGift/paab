<template>
    <div>
        <header>
            <nav class="customNavBar">
                <div class="nav-wrapper">
                    <div class="row">
                        <div class="col s12 d-flex justify-between align-center">
                            <div class="search-container">
                                <svg width="23" height="22" viewBox="0 0 23 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="search-icon">
                                    <path d="M11.3431 19.2497C16.1526 19.2497 20.0514 15.3508 20.0514 10.5413C20.0514 5.73186 16.1526 1.83301 11.3431 1.83301C6.53362 1.83301 2.63477 5.73186 2.63477 10.5413C2.63477 15.3508 6.53362 19.2497 11.3431 19.2497Z" stroke="#787486" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M20.9681 20.1663L19.1348 18.333" stroke="#787486" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <input type="search" class="browser-default custom-search" placeholder="Search for anything..."/>
                            </div>

                            <button class="composeMail btn waves waves-effect" @click="openCompose">Compose Mail</button>

                            <div class="d-flex justify-between align-center gap-1">
                                <img src="/media/img/doc-icon.svg" class="responsive-img profileIMG"/>
                                <span class="profileName">{{ user.firstname }} {{ user.lastname }}</span>
                                <a href="#!" class="icon"  ><i class="fa-solid fa-caret-down"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
    </div>
</template>
<style scoped>
    .icon {
        color: #5041BC;
    }

    .composeMail {
        width: 189px; 
        height: 45px; 
        background: #109DAD; 
        box-shadow: 0px 4px 19px #109DAD; 
        border-radius: 10px;
        text-transform: capitalize;
    }
</style>
<script>
export default {
    methods: {
        openCompose() {
            this.$emit('openComposeBox', true);
        }
    },
    props:{
        user: Object,
    }
}
</script>