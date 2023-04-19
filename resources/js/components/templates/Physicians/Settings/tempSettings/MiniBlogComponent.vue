<template>
    <div>
        <div class="row noMarginBottom" id="miniBlogSettings">
            <div class="col l6 optionSettingBackground" @click="modalView = 0">
                <p>
                    <a class="btn-flat"
                        ><i class="material-icons left">chevron_left</i>Back</a
                    >
                </p>
                <h5>
                    {{ modalTitle }}
                </h5>
            </div>
            <div class="col l6 optionSettingContainer">
                <div class="row hPadding-1">
                    <h4
                        class="settingOptionSectionTitle col l12 noMarginBottom"
                    >
                        Blog
                    </h4>
                    <div class="formInnerDiv">
                        <div class="input-field col l12">
                            <input
                                type="text"
                                class="validate formInput"
                                required
                                placeholder="Title"
                            />
                            <label>Title</label>
                        </div>
                        <div class="input-field col l12 m12 s12">
                            <textarea
                                id="miniBlogDecription"
                                placeholder="Content"
                                class="materialize-textarea"
                                data-length="300"
                            ></textarea>
                            <label for="description">Content</label>
                        </div>
                    </div>
                </div>
                <!--TODO: Image cropper doesnt work-->
                <div class="row hPadding-1">
                    <h4
                        class="settingOptionSectionTitle col l12 noMarginBottom"
                    >
                        Image
                    </h4>
                    <div v-show="showCropper" class="cFlex flexRight">
                        <a class="right" href="#" @click="showCropper = false">
                            <i class="material-icons priText">clear</i>
                        </a>
                    </div>

                    <div class="settingImgContainer" v-if="!showCropper">
                        <img
                            class="settingImg"
                            src="/media/img/templates/1/placeholder.png"
                        />
                    </div>
                    <form enctype="multipart/form-data">
                        <div class="settingImgBtnMainDiv">
                            <div class="settingImgBtnContainDiv justify-center">
                                <div class="" id="genUploadFavIconDiv">
                                    <div class="" v-if="!uploadPhotoProcessing">
                                        <div
                                            class="col l12 center-align marginTop-5"
                                        >
                                            <!-- <span>Upload</span> -->
                                            <button
                                                href="#"
                                                role="button"
                                                @click.prevent="showFileChooser"
                                                v-if="!showCropper"
                                                class="btn btn-flat"
                                            >
                                                <!--span
                                                            v-if="
                                                                bioData.photo !==
                                                                    null ||
                                                                uploaded !== null
                                                            "
                                                            >
                                                                <i class="material-icons white-text">edit</i>
                                                            </span-->
                                                <i class="material-icons"
                                                    >file_upload</i
                                                >
                                            </button>
                                        </div>
                                        <div class="row">
                                            <div class="col s12">
                                                <image-cropper
                                                    v-if="showCropper"
                                                    :height="50"
                                                    :width="50"
                                                    :img="'/media/img/templates/1/favPlaceholder.png'"
                                                    @uploadPhoto="
                                                        photoUpload($event)
                                                    "
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <p v-else>
                                        Uploading Image<i
                                            class="fas fa-circle-notch"
                                        ></i>
                                    </p>
                                </div>
                            </div>
                            <!--div
                                        class="proImgInstructDiv"
                                        v-show="!showCropper"
                                    >
                                        <p class="proImgInstruct">
                                            The image should be greater than
                                            451px width and 512px height
                                        </p>
                                    </div-->
                        </div>
                    </form>
                </div>
                <div class="row hPadding-1 center-align">
                    <button class="btn saveSettingBtn" @click="saveAndBack(1)">
                        Save &amp; Add New
                    </button>
                    <button class="btn saveSettingBtn" @click="saveAndBack(1)">
                        Save &amp; Back
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            
        }
    },
    methods: {
        
    },
}
</script>