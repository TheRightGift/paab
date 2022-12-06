<template>
    <div>
        <!-- Logout Modal -->
        <div id="authAlertContainDiv3" v-if="!logoutModal">
            <div class="authAlertBox">
                <div class="authAlertBox1">
                    <div class="authAlertBox2">
                        <!-- Model cancel button -->
                        <div>
                            <i
                                class="material-icons"
                                id="errArlCancelIcon3"
                                @click="cancelLogoutBtn()"
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
                                        @click="confirmLogoutBtn()"
                                    >
                                        Yes
                                    </button>
                                    <button
                                        type="button"
                                        class="btn logoutNoBtn"
                                        id="errArlCancelBtn"
                                        @click="cancelLogoutBtn()"
                                    >
                                        No
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    methods: {
        cancelLogoutBtn() {
            this.logoutModal = true;
        },
        confirmLogoutBtn() {
            window.location.href = "/";
        },
        logoutBtn() {
            this.logoutModal = false;
        },

    },
}
</script>