<template>
    <div>
        <input
            ref="input"
            type="file"
            name="image"
            accept="image/*"
            @change="setImage"
        />

        <div class="content">
            <section class="cropper-area">
                <div class="img-cropper">
                    <vue-cropper
                        preview=".preview"
                        dragMode="move"
                        :aspectRatio="xAxis / yAxis"
                        ref="cropper"
                        :src="imgSrc"
                        :autoCrop="true"
                        :autoCropArea="1"
                        :guides="false"
                        :view-mode="2"
                        :zoomable="true"
                        :rotatable="true"
                        :scalable="true"
                        :cropBoxMovable= "true"
                        :cropBoxResizable= "false"
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
                    >
                        ></vue-cropper
                    >
                </div>
                <div class="actions center-align">
                    <button
                        @click.prevent="cropImage"
                        class="btn waves waves-green"
                        :disabled="imgNotSelected"
                        title="Crop image"
                    >
                        <i class="material-icons">crop</i>
                    </button>

                    <a
                        href="#"
                        role="button"
                        class="btn waves waves-green"
                        @click.prevent="showFileChooser"
                        title="Upload Image"
                    >
                        <i class="material-icons">cloud_upload</i>
                    </a>
                </div>
            </section>
        </div>
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
                imgSrc: this.img,
                // '/media/img/placeholder.jpg',
                cropImg: "",
                data: null,
                imgNotSelected: false,
            };
        },
        mounted() {
            this.imgNotSelected = true;
        },
        props: {
            height: Number,
            width: Number,
            xAxis: Number,
            yAxis: Number,
            img: String,
            minContainerHeight: Number,
            minContainerWidth: Number,
        },
        methods: {
            cropImage() {
                // get image data for post processing, e.g. upload or setting image src
                // TODO: convert to file and save
                this.$emit(
                    "uploadPhoto",
                    this.$refs.cropper.getCroppedCanvas().toDataURL()
                );
                this.cropImg = this.$refs.cropper.getCroppedCanvas().toDataURL();
            },

            getCropBoxData() {
                this.data = JSON.stringify(
                    this.$refs.cropper.getCropBoxData(),
                    null,
                    4
                );
            },
            
            getData() {
                this.data = JSON.stringify(this.$refs.cropper.getData(), null, 4);
            },

            reset() {
                this.$refs.cropper.reset();
            },

            setCropBoxData() {
                if (!this.data) return;

                this.$refs.cropper.setCropBoxData(JSON.parse(this.data));
            },
            setData() {
                if (!this.data) return;

                this.$refs.cropper.setData(JSON.parse(this.data));
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
                        this.imgSrc = event.target.result;
                        // rebuild cropperjs with the updated source
                        this.$refs.cropper.replace(event.target.result);
                    };

                    reader.readAsDataURL(file);
                    this.imgNotSelected = false;
                } else {
                    alert("Sorry, FileReader API not supported");
                }
            },
            showFileChooser() {
                this.$refs.input.click();
            },
        },
    };
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    body {
        font-family: Arial, Helvetica, sans-serif;
        width: 1024px;
        margin: 0 auto;
    }

    input[type="file"] {
        display: none;
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0 5px 0;
    }

    .header h2 {
        margin: 0;
    }

    .header a {
        text-decoration: none;
        color: black;
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
    }

    .actions a,
    .actions button {
        display: inline-block;
        /* padding: 5px 15px; */
        background: var(--sec);
        color: white;
        text-decoration: none;
        border-radius: 3px;
        margin-right: 1rem;
        margin-bottom: 1rem;
    }

    textarea {
        width: 100%;
        height: 100px;
    }

    .preview-area {
        width: 307px;
    }

    .preview-area p {
        font-size: 1.25rem;
        margin: 0;
        margin-bottom: 1rem;
    }

    .preview-area p:last-of-type {
        margin-top: 1rem;
    }

    .preview {
        width: 100%;
        height: calc(372px * (9 / 16));
        overflow: hidden;
    }

    .crop-placeholder {
        width: 100%;
        height: 200px;
        background: #ccc;
    }

    .cropped-image img {
        max-width: 100%;
    }
    .img-cropper {
        display: flex;
        justify-content: center;
        width: 400px;
        height: 300px;
        /* border: 1px solid gray; */
        margin: auto;
    }
</style>