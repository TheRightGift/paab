<template>
    <div>
        <!-- Logout Modal -->
        <!--div id="authAlertContainDiv3">
            <div class="authAlertBox">
                <div class="authAlertBox1">
                    <div class="authAlertBox2">
                    
                        <div>
                            <i
                                class="material-icons"
                                id="errArlCancelIcon3"
                                @click="open"
                                >cancel</i
                            >
                        </div>

                        <div class="modalImgDiv">
                            <img
                                src="/media/img/alertQUESTIONg.png"
                                alt="alertQUESTIONg.png"
                                id="errAltImg"
                            />
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <p class="logoutTxt">
                                    You are about to logout from your space
                                </p>
                            </div>

                            <div class="col s12">
                                <div id="authLogoutBtnDiv">
                                    <button
                                        type="button"
                                        class="btn logoutYesBtn"
                                        @click="logout"
                                    >
                                        Yes
                                    </button>
                                    <button
                                        type="button"
                                        class="btn logoutNoBtn"
                                        id="errArlCancelBtn"
                                        @click="open"
                                    >
                                        No
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div-->

        <div id="logoutModal" class="modal">
            <div class="modal-content">
                <div class="row logoutModalImageRow">
                    <img
                        src="/media/img/alertQUESTIONg.png"
                        alt="alertQUESTIONg.png"
                        id="errAltImg"
                    />
                </div>
                <div class="row">
                    <p>You are about to logout from your space</p>
                </div>

                <div class="row">
                    <button @click="logout" class="modal-close black waves-effect waves-green btn-flat">Yes</button>
                    <button @click="open" class="modal-close white waves-effect waves-green btn-flat">No</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        
        mounted() {
            M.AutoInit();
            $('.modal').openModal();
        },
        methods: {
            delete_cookie(name, path, domain) {
                if (this.get_cookie(name)) {
                    document.cookie =
                        name +
                        "=" +
                        (path ? ";path=" + path : "") +
                        // (domain ? ";domain=" + domain : "") +
                        ";expires=Thu, 01 Jan 1970 00:00:01 GMT";
                }
            },
            get_cookie(name) {
                return document.cookie.split(";").some((c) => {
                    return c.trim().startsWith(name + "=");
                });
            },
            logout() {
                axios
                    .post("/auth/logout")
                    .then((res) => {
                        if (res.data.status == 401) {
                            this.delete_cookie('_token', '/', )
                            location.replace('/');
                        }
                        console.log(res);
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            },
           open() {
            this.$emit('switchMe');
           }
        },
    };
</script>