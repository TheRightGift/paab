<template>
    <div class="col s12 m10 l10" id="mailRightDiv">
        <div class="section">
            <div class="row">
                <h1 class="center">Password Change</h1>
                <div class="col offset-l4 s12 l4 offset-m2 m8">
                    <p>Please change your password from here</p>
                </div>
            </div>
            <form @submit.prevent="changePassword" autocomplete="off">
                <div class="row">
                    <div class="input-field col offset-l4 s12 l4 offset-m2 m8">
                        <input
                            type="password"
                            class="validate input"
                            placeholder="Old Password"
                            v-model="pass.oldPass"
                        />
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col offset-l4 s12 l4 offset-m2 m8">
                        <small
                        >Password should not be less than eight
                            characters</small
                        >
                        <input
                            type="password"
                            class="validate input"
                            placeholder="Password"
                            v-model="pass.password"
                            autocomplete="new-password"
                        />
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col offset-l4 s12 l4 offset-m2 m8">
                        <input
                            type="password"
                            class="validate input"
                            placeholder="Confirm Password"
                            v-model="pass.confirmPass"
                            autocomplete="new-password"
                        />
                    </div>
                </div>
                <div class="centered">
                    <div class="row">
                        <div class="col offset-l4 s12 l4 offset-m2 m8">
                            <button
                                class="
                                            btn
                                            waves waves-effect
                                            getStartedBtn
                                            col
                                            s12
                                        "
                                v-if="!loading"
                                :disabled="enableSubmitBtn"
                            >
                                Update
                            </button>
                            <button
                                class="btn  col s12 disabled"
                                v-else-if="loading"
                                :disabled="loading"
                            >
                                <div
                                    class="
                                                preloader-wrapper
                                                small
                                                active
                                            "
                                >
                                    <div
                                        class="
                                                    spinner-layer
                                                    spinner-white-only
                                                "
                                    >
                                        <div
                                            class="circle-clipper left"
                                        >
                                            <div class="circle"></div>
                                        </div>
                                        <div class="gap-patch">
                                            <div class="circle"></div>
                                        </div>
                                        <div
                                            class="circle-clipper right"
                                        >
                                            <div class="circle"></div>
                                        </div>
                                    </div>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                loading: false,
                pass: {
                    oldPass: "",
                    password: "",
                    confirmPass: "",
                },
            };
        },
        computed: {
            enableSubmitBtn() {
                if (
                    this.pass.oldPass == "" ||
                    this.pass.password == "" ||
                    this.pass.confirmPass == ""
                ) {
                    return true;
                }
                if (this.pass.password.length < 8) {
                    return true;
                } else if (this.pass.password !== this.pass.confirmPass) {
                    return true;
                }
            },
        },
        props: {tenant: Boolean},
        methods: {
            changePassword() {
                this.loading = !this.loading;
                axios
                    .patch("/api/changePassword", this.pass)
                    .then((res) => {
                        if (res.data.error == 401) {
                            M.toast({
                                html: "Check Your current password",
                                classes: "errorNotifier",
                            });
                            this.loading = !this.loading;
                        } else if (res.data.user == true) {
                            M.toast({
                                html: res.data.message,
                                classes: "successNotifier",
                            });
                            this.loading = !this.loading;
                            localStorage.setItem('візіт', (localStorage.getItem('візіт') + 1));
                            this.tenant === true ? location.href = `http://${location.host}` : location.replace("/dashboard");
                        }
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            },
        },
    }
</script>
<style scoped>
.input {
    background: rgba(70, 22, 107, 0.3) !important;
    box-shadow: 0px 4px 4px rgb(0 0 0 / 25%) !important;
    border-radius: 100px !important;
    /* margin-top: 2vh; */
    /* padding: 0 2vw; */
    text-align: center;
    height: 7vh;
    font-family: "Montserrat", sans-serif;
    font-weight: 500;
    font-size: 15px !important;
}
.btn {
    background-color: var(--primary);
}
.btn:hover {
    background-color: #7958cc;
}
</style>
