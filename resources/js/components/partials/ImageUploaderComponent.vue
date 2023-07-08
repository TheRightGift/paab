<template>
    <div>
        <div class="content" v-show="showCropper && tenantId">
            <section class="cropper-area">
                <div class="img-cropper">
                    <vue-cropper
                        ref="cropper"
                        :aspect-ratio="xAxis / yAxis"
                        :src="imgSrc"
                        preview=".preview"
                        dragMode="move"
                        :auto-crop="true"
                        :autoCropArea="1"
                        :guides="false"
                        :view-mode="2"
                        :zoomable="true"
                        :rotatable="true"
                        :scalable="true"
                        :cropBoxMovable="true"
                        :cropBoxResizable="false"
                        :data="{
                            width: width,
                            height: height,
                        }"
                        :minContainerWidth="minContainerWidth || 250"
                        :minCanvasWidth="200"
                        :minCanvasHeight="300"
                        :minContainerHeight="minContainerHeight || 180"
                        :background="false"
                        :img-style="{ width: '80%', height: '300px' }"
                    />
                </div>
                <div class="actions" v-show="!processing">
                    <a
                        href="#"
                        role="button"
                        @click.prevent="reset"
                        class="btn waves waves-green"
                    >
                        <i class="material-icons">close</i>
                    </a>
                    <a
                        href="#"
                        role="button"
                        @click.prevent="cropImage"
                        class="btn waves waves-green"
                    >
                        <i class="material-icons">crop</i>
                    </a>
                </div>
            </section>
        </div>
        <section class="row" id="brandImage" v-show="!showCropper">
            <div class="custom-file-input">
                <input
                    type="file"
                    @change="setImage"
                    ref="fileInput"
                    class="file-input"
                    accept="image/*"
                />
                <div class="button" @click="openFileInput">
                    <i class="fas fa-user" v-show="photo == null && uploaded == null"></i>
                    <img :src="uploaded ? uploaded : path + photo" v-show="uploaded != null || photo != null" class="responsive-img"/>
                </div>
            </div>
        </section>
    </div>
</template>
  
  <script>
    import VueCropper from "vue-cropperjs";
    import "cropperjs/dist/cropper.css";

    export default {
        components: {
            VueCropper,
        },
        data() {
            return {
                imgSrc: null,
                cropImg: "",
                data: null,
                showCropper: false,
                file: null,
                processing: false,
                userIcon: false,
            };
        },
        methods: {
            cropImage() {
                // get image data for post processing, e.g. upload or setting image src
                this.processing = true;
                this.cropImg = this.$refs.cropper.getCroppedCanvas().toDataURL();
                this.$emit("fileChosen", this.cropImg);
            },
            setImage(e) {
                const file = e.target.files[0];

                if (file.type.indexOf("image/") === -1) {
                    alert("Please select an image file");
                    return;
                }

                if (typeof FileReader === "function") {
                    const reader = new FileReader();

                    reader.onload = (event) => {
                        this.showCropper = true;
                        this.imgSrc = event.target.result;
                        // rebuild cropperjs with the updated source
                        this.$refs.cropper.replace(event.target.result);
                    };

                    reader.readAsDataURL(file);
                } else {
                    alert("Sorry, FileReader API not supported");
                }
            },
            reset() {
                this.$refs.cropper.reset();
                this.showCropper = false;
            },
            openFileInput() {
                this.$refs.fileInput.click(); // Trigger the file input when the custom button is clicked
            },
        },
        mounted () {
            this.userIcon = true;
        },
        props: {
            height: Number,
            width: Number,
            xAxis: Number,
            yAxis: Number,
            img: String,
            minContainerHeight: Number,
            minContainerWidth: Number,
            photo: String,
            tenantOnDemand: String,
            tenantId: String,
            uploaded: String,
            path: String,
        },
        watch: {
            uploaded(newVal, oldVal){
                console.log(newVal, 'I came')
                if(newVal !== null) {
                    this.showCropper = false;
                    this.userIcon = false;
                    this.processing = false;
                } else {
                    this.userIcon = true;
                }
            },
            photo(newVal, oldVal){
                console.log(newVal, 'I came2')
                if(newVal === null) {
                    this.userIcon = true;
                } else {
                    this.userIcon = false;
                }
            }
        }
    };
</script>
<style scoped>
    body {
        font-family: Arial, Helvetica, sans-serif;
        width: 100%;
        margin: 0 auto;
    }

    .custom-file-input {
        position: relative;
        display: inline-block;
    }

    #brandImage {
        margin-bottom: 2vh
    }
    .file-input {
        display: none; /* Hide the default file input button */
    }

    .button {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 254px;
        height: 309px;
        background: rgba(16, 157, 173, 0.15);
        border-radius: 5px;
        border: 1px solid rgba(16, 157, 173, 0.808);
        cursor: pointer;
    }
    .button i {
        color: var(--pri);
        font-size: 7rem;
    }
    .button img {
        border: inherit;
    }

    .content {
        display: flex;
        justify-content: space-between;
    }

    .cropper-area {
        width: 100%;
    }

    .actions {
        margin-top: 1rem;
        display: flex;
        justify-content: center;
    }

    .actions a {
        display: inline-block;
        color: white;
        text-decoration: none;
        border-radius: 3px;
        margin-right: 1rem;
        margin-bottom: 1rem;
    }
    @media only screen and (min-width: 1024px) {
        .button {
            height: 50vh;
        }
    }
</style>