<template>
    <div>
        <div class="editGenModal" v-show="genModal">
            <div class="editInnerGenModal">
                <div class="genTitleDiv">
                    <p class="genTitle cursor" @click="genGoBackBtn()">
                        <i
                            class="material-icons"
                            id="genTitleCheck"
                            v-if="general.title !== ''"
                            >check</i
                        >
                        <i
                            class="material-icons genTitleClear"
                            v-if="
                                (general.title == '' &&
                                    general.favicon !== null) ||
                                general.title == ''
                            "
                            >clear</i
                        >
                        Title
                    </p>

                    <p class="genTitle cursor activeTab" @click="genNextBtn">
                        <i
                            class="material-icons"
                            id="genTitleCheck"
                            v-if="general.favicon !== null"
                            >check</i
                        >
                        <i
                            class="material-icons genTitleClear"
                            v-if="
                                (general.title != '' &&
                                    general.favicon == null) ||
                                general.favicon == null
                            "
                            >clear</i
                        >
                        Favicon
                    </p>
                </div>

                <div>
                    <p class="genTitle1">Put in your title details</p>

                    <p class="genTxt">
                        Lorem Ipsum is simply dummy text of the printing and
                        typesetting industry.
                    </p>

                    <div class="input-field">
                        <input
                            type="text"
                            placeholder="JohnDoe"
                            id="genInput"
                            v-model="general.title"
                        />
                    </div>

                    <div class="genBottomBtnDiv">
                        <button
                            type="button"
                            class="btn right"
                            id="genNextBtn"
                            @click="genNextBtn()"
                        >
                            NEXT STEP
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- General Modal 1-->
        <div class="editGenModal" v-show="genModal1">
            <div class="editInnerGenModal">
                <div class="genTitleDiv">
                    <p class="genTitle cursor" @click="genGoBackBtn()">
                        <i
                            class="material-icons"
                            id="genTitleCheck"
                            v-if="general.title !== ''"
                            >check</i
                        >
                        <i
                            class="material-icons genTitleClear"
                            v-if="
                                (general.title == '' &&
                                    general.favicon !== null) ||
                                general.title == ''
                            "
                            >clear</i
                        >
                        Title
                    </p>

                    <p class="genTitle cursor activeTab" @click="genNextBtn">
                        <i
                            class="material-icons"
                            id="genTitleCheck"
                            v-if="general.favicon !== null"
                            >check</i
                        >
                        <i
                            class="material-icons genTitleClear"
                            v-if="
                                (general.title != '' &&
                                    general.favicon == null) ||
                                general.favicon == null
                            "
                            >clear</i
                        >
                        Favicon
                    </p>
                </div>

                <div>
                    <p class="genTitle1">Upload a favicon</p>

                    <p class="genTxt">
                        Lorem Ipsum is simply dummy text of the printing and
                        typesetting industry.
                    </p>

                    <div
                        class="file-field input-field"
                        id="genUploadFavIconDiv"
                        v-if="general.favicon == null"
                    >
                        <input type="file" @change="favUpload" accept=".png" />
                        <div class="file-path-wrapper">
                            <input
                                class="file-path validate"
                                type="text"
                                id="genInput1"
                                placeholder="File type must be in .png and not exceed 100kb"
                            />
                            <i class="material-icons" id="genUploadFavIcon"
                                >file_upload</i
                            >
                        </div>
                    </div>
                    <div v-else class="flex no-space-between mb-2">
                        <img
                            width="100"
                            height="100"
                            class="responsive-img"
                            :src="
                                typeof general.favicon == 'string'
                                    ? 'tenancy/assets/' + general.favicon
                                    : uploaded
                            "
                        />
                        <a
                            class="waves-effect waves-light btn-small btn red"
                            @click="deleteImg"
                            >Change</a
                        >
                    </div>

                    <div>
                        <button
                            type="button"
                            class="btn"
                            id="genModalBtn"
                            @click.prevent="generalSave"
                            v-if="saved == null"
                            :disabled="
                                general.favicon == null || general.title == ''
                            "
                        >
                            Save
                        </button>
                        <button
                            type="button"
                            class="btn"
                            id="genModalBtn"
                            @click.prevent="generalUpdate"
                            v-else
                            :disabled="
                                general.favicon == null || general.title == ''
                            "
                        >
                            Update
                        </button>
                    </div>

                    <div class="genBottomBtnDiv">
                        <a href="#" class="goBackBtn" @click="genGoBackBtn()"
                            >GO BACK</a
                        >

                        <button
                            type="button"
                            class="btn right"
                            id="genNextBtn"
                            @click="genNextBtn1()"
                        >
                            NEXT STEP
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                general: {
                    favicon: null,
                    title: "",
                },
                uploaded: null,
                tabs: [
                    {
                        title: "Title",
                        checked: false,
                        active: true,
                    },
                    {
                        title: "Favicon",
                        checked: false,
                        active: false,
                    },
                ],
                generalErrors: false,
            };
        },
        props: ["genModal", "genModal1", "saved"],
        methods: {
            deleteImg() {
                this.general.oldFav = this.general.favicon;
                this.general.favicon = null;
            },
            favUpload(e) {
                if (!e.target.files.length) return;
                this.general.favicon = e.target.files[0];
                this.uploaded = URL.createObjectURL(e.target.files[0]);
            },
            genGoBackBtn() {
                this.$emit("genGoBackBtn");
            },
            genNextBtn() {
                this.$emit("genNextBtn");
            },
            genNextBtn1() {
                if (this.general.title == "" || this.general.favicon == null) {
                    this.generalErrors = true;
                } else this.generalErrors = false;
                this.$emit("genNextBtn1", this.generalErrors);
            },
            generalSave() {
                this.$emit("generalSave", this.general);
            },
            generalUpdate() {
                let data = {
                    _method: "PUT",
                };
                if (this.general.oldFav) {
                    data = { ...data, ...this.general };
                } else {
                    let detail = {
                        title: this.general.title,
                        id: this.general.id,
                    };
                    data = { ...data, ...detail };
                }
                this.$emit("generalUpdate", data);
            },
        },
        watch: {
            saved(newVal, oldVal) {
                if (newVal != null) {
                    this.general.title = newVal.title;
                    this.general.favicon = newVal.favicon;
                    this.general.id = newVal.id;
                }
            },
        },
        computed: {
            eval() {
                return (
                    this.general.title === this.saved.title || !this.general.oldFav
                );
            },
        },
    };
</script>
<style>
    .flex {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    /* The slider itself */
    input[type="range"].achieveInnerProgressBar {
        -webkit-appearance: none; /* Override default CSS styles */
        appearance: none;
        background: #d3d3d3; /* Grey background */
        height: 12px;
        outline: none; /* Remove outline */
        opacity: 0.7; /* Set transparency (for mouse-over effects on hover) */
        -webkit-transition: 0.2s; /* 0.2 seconds transition on hover */
        transition: opacity 0.2s;
    }

    /* Mouse-over effects */
    .achieveInnerProgressBar:hover {
        opacity: 1; /* Fully shown on mouse-over */
    }
    input[type="range"]::-webkit-slider-thumb {
        background-color: #7746ff;
    }
    input[type="range"]::-moz-range-thumb {
        background-color: #7746ff;
    }
    input[type="range"]::-ms-thumb {
        background-color: #7746ff;
    }

    /***** These are to edit the thumb and the text inside the thumb *****/
    input[type="range"] + .thumb {
        background-color: #dedede;
    }
    input[type="range"] + .thumb.active .value,
    .years {
        color: #7746ff;
    }
    .years {
        font-weight: 600;
    }
    .no-space-between {
        justify-content: unset !important;
    }
    .mb-2 {
        margin-bottom: 2.5rem;
    }
    .genTitle:hover {
        box-shadow: 1px 2px #7746ff;
    }
</style>