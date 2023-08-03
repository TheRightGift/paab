<template>
    <div>
        <header>
            <nav class="customNavBar">
                <div class="nav-wrapper">
                    <div class="row">
                        <div class="col s12 d-flex justify-between align-center">
                            <!-- <a
                                href="#"
                                data-target="sidenav-1"
                                class="left sidenav-trigger hide-on-medium-and-up"
                                ><i class="material-icons">menu</i></a
                            > -->
                            <div class="search-container">
                                <svg width="23" height="22" viewBox="0 0 23 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="search-icon">
                                    <path d="M11.3431 19.2497C16.1526 19.2497 20.0514 15.3508 20.0514 10.5413C20.0514 5.73186 16.1526 1.83301 11.3431 1.83301C6.53362 1.83301 2.63477 5.73186 2.63477 10.5413C2.63477 15.3508 6.53362 19.2497 11.3431 19.2497Z" stroke="#787486" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M20.9681 20.1663L19.1348 18.333" stroke="#787486" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <input type="search" class="browser-default custom-search" placeholder="Search for anything..."/>
                            </div>

                            <div class="notify relative">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.0206 2.91016C8.71058 2.91016 6.02058 5.60016 6.02058 8.91016V11.8002C6.02058 12.4102 5.76058 13.3402 5.45058 13.8602L4.30058 15.7702C3.59058 16.9502 4.08058 18.2602 5.38058 18.7002C9.69058 20.1402 14.3406 20.1402 18.6506 18.7002C19.8606 18.3002 20.3906 16.8702 19.7306 15.7702L18.5806 13.8602C18.2806 13.3402 18.0206 12.4102 18.0206 11.8002V8.91016C18.0206 5.61016 15.3206 2.91016 12.0206 2.91016Z" stroke="#787486" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"/>
                                    <path d="M13.8699 3.20043C13.5599 3.11043 13.2399 3.04043 12.9099 3.00043C11.9499 2.88043 11.0299 2.95043 10.1699 3.20043C10.4599 2.46043 11.1799 1.94043 12.0199 1.94043C12.8599 1.94043 13.5799 2.46043 13.8699 3.20043Z" stroke="#787486" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M15.0195 19.0596C15.0195 20.7096 13.6695 22.0596 12.0195 22.0596C11.1995 22.0596 10.4395 21.7196 9.89953 21.1796C9.35953 20.6396 9.01953 19.8796 9.01953 19.0596" stroke="#787486" stroke-width="1.5" stroke-miterlimit="10"/>
                                    />
                                </svg>
                                <svg class="newMessage"><circle cx="18" cy="4" r="3" fill="#D8727D"></circle></svg>
                            </div>

                            <div class="d-flex justify-between align-center gap-1">
                                <img src="/media/img/profileIMG.png" class="responsive-img profileIMG"/>
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
</style>
<script>
export default {
    props:{
        user: Object,
    }
}
</script>