<template>
    <div>
        <!-- Sidenav for small devices -->
        <nav class="hide-on-med-and-up white">
            <!-- Sidenav Contents -->
            <ul id="slide-out" class="sidenav">
                <li>
                    <!-- <div class="user-view">
                        <div class="background">
                            <img :src="bg_img" />
                        </div>
                        <a href="#user"
                            ><img class="circle" :src="pro_img"
                        /></a>
                        <a href="#name"
                            ><span class="white-text name"
                                >Dr. Adebayo Akelere</span
                            ></a
                        >
                        <a href="#email"
                            ><span class="white-text email"
                                >adebayoakelere@gmail.com</span
                            ></a
                        >
                    </div> -->
                </li>

                <li>
                    <a href="/dashboard" class="dashLeftBarListDiv">
                        <i class="
                                material-icons
                                dashLeftBarIcons
                                purple-text
                                text-darken-4
                            ">dashboard</i>
                        <p class="dashLeftBarTitle">Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="/admin/client" class="dashLeftBarListDiv">
                        <i class="material-icons dashLeftBarIcons">web</i>
                        <p class="dashLeftBarTitle">Client</p>
                    </a>
                </li>
                <!-- <li><div class="divider"></div></li> -->
                <!-- <li><a class="subheader">Subheader</a></li> -->
                <li>
                    <a href="/admin/template" class="dashLeftBarListDiv">
                        <i class="material-icons">chrome_reader_mode</i>
                        <p class="dashLeftBarTitle">Templates</p>
                    </a>
                </li>
                <li>
                    <a href="/admin/messages" class="dashLeftBarListDiv">
                        <i class="material-icons dashLeftBarIcons">mail_outline</i>
                        <p class="dashLeftBarTitle">Messages</p>
                    </a>
                </li>
                <li>
                    <a href="/client/settings" class="dashLeftBarListDiv">
                        <i class="material-icons dashLeftBarIcons">settings</i>
                        <p class="dashLeftBarTitle">Settings</p>
                    </a>
                </li>
                <li>
                    <a href="#logoutModal" class="dashLeftBarListDiv modal-trigger">
                        <i class="material-icons dashLeftBarIcons">exit_to_app</i>
                        <p class="dashLeftBarTitle">Logout</p>
                    </a>
                </li>
            </ul>

            <!-- Sidenav Trigger -->
            <a href="#" data-target="slide-out" class="sidenav-trigger">
                <i class="material-icons" id="dashSidenavIconBtn">menu</i>
            </a>
        </nav>
    </div>
</template>
<script>
export default {
    components: {  },
    name: 'MobileNav',

    methods: {
        logout() {
            axios
                .post("/auth/logout")
                .then((res) => {
                    if (res.data.status == 401) {
                        this.delete_cookie('_token', '/',)
                        location.replace('/');
                    }
                    console.log(res);
                })
                .catch((err) => {
                    console.log(err);
                });
        },
    }
}

</script>