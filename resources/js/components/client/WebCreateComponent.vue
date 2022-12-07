<template>
    <div>
        <div class="clientCreatePortModalDiv">
            <p class="clientCreatePortCancelDiv">
                <i
                    class="material-icons"
                    id="clientCreatePortCancelIconBtn"
                    @click="modalCancelBtn()"
                    >cancel</i
                >
            </p>

            <p class="clientCreatePortTitle">
                Giving your website a good title make it easier for customer to
                find your page.
            </p>

            <div class="row" id="clientCreatePortInputRowDiv">
                <div class="col s12">
                    <input
                        type="text"
                        placeholder="Website title"
                        id="clientCreatePortInput"
                        v-model="web.name"
                    />
                </div>

                <div class="col s12">
                    <input
                        type="text"
                        placeholder="Description"
                        id="clientCreatePortInput1"
                        v-model="web.description"
                    />
                </div>
            </div>

            <div class="clientCreateInnerPortModalDiv">
                <div class="webProfessionDiv">
                    <div class="row">
                        <div
                            class="col s6 m4 l2"
                            v-for="profession in professions"
                            :key="profession.id"
                        >
                            <div id="userTempDiv" class="hoverable">
                                <div class="tempImgDiv" id="tempImgDiv">
                                    <i class="material-icons" id="tempProIcon"
                                        >person</i
                                    >
                                </div>
                                <p class="userTempTitle">
                                    {{ profession.name }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button
                type="button"
                class="btn"
                id="clientCreatePortBtn"
                @click.prevent="createWebsite"
            >
                <span v-if="!loading">GET STARTED</span>
                <div class="preloader-wrapper small active" v-else>
                    <div class="spinner-layer spinner-white-only">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="gap-patch">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
            </button>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        loading: false,
        isHidden: false,
        professions: Array,
    },
    data() {
        return {
            web: {
                name: "",
                description: "",
            },
        }
    },
    methods: {
        createWebsite() {
            this.$emit('createWebsite', this.web)
        },
        modalCancelBtn() {
            this.$emit('close', true);
        },
    },
}
</script>