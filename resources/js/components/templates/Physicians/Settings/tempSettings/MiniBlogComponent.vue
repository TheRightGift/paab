<template>
    <div>
        <div class="row noMarginBottom" id="miniBlogSettings">
            <div class="col l6 s12 optionSettingBackground">
                <p @click="$emit('backToSettings')">
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
                                id="title"
                                v-model="miniBlog.title"
                                @keyup="validateTitle"
                            />
                            <label>Title</label>
                        </div>
                        <div class="input-field col l12 m12 s12">
                            <textarea
                                id="miniBlogDescription"
                                placeholder="Content"
                                class="materialize-textarea"
                                v-model="miniBlog.body"
                                data-length="300"
                                maxlength="300"
                                @keyup="validateBody"
                            ></textarea>
                            <label for="description">Content</label>
                        </div>
                    </div>
                </div>
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

                    <div class="settingImgContainer" v-show="!showCropper">
                        <img
                            class="settingImg"
                            src="/media/img/templates/1/placeholder.png"
                            v-if="miniBlog.imageUrl == null"
                        />
                        <img v-if="uploaded !== null" class="settingImg" :src="miniBlog.imageUrl"/>
                        <img v-else-if="uploaded === null && miniBlog.imageUrl != null" class="settingImg" :src="'/media/tenants/'+tenant+'/img/miniblog/'+miniBlog.imageUrl"/>
                    </div>
                    <form enctype="multipart/form-data">
                        <div class="settingImgBtnMainDiv">
                            <div class="settingImgBtnContainDiv justify-center">
                                <div class="" id="genUploadFavIconDiv">
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
                                        ><i class="material-icons"
                                                >file_upload</i
                                            >
                                        </button>
                                    </div>
                                    <div class="" v-if="!uploadPhotoProcessing">
                                        <div class="row">
                                            <div class="col s12">
                                                <image-cropper
                                                    v-if="showCropper"
                                                    :height="50"
                                                    :width="50"
                                                    :minContainerWidth="250"
                                                    :minContainerHeight="250"
                                                    :img="'/media/img/templates/1/placeholder.png'"
                                                    @uploadPhoto="
                                                        photoUpload($event)
                                                    "
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row hPadding-1 center-align">
                    <div v-if="!update">
                        <button :disabled="loading" class="btn saveSettingBtn" @click="saveBlog(1)">
                            <i class="fas fa-circle-notch fa-spin" v-if="loading"></i>
                            <span v-else>Save &amp; Add New</span>
                        </button>
                        <button class="btn saveSettingBtn" @click="saveBlog(0)">
                            <i class="fas fa-circle-notch fa-spin" v-if="loading"></i>
                            <span v-else>Save &amp; Back</span>
                        </button>
                    </div>
                    <div v-else>
                        <button class="btn saveSettingBtn" @click="updateBlog()">
                            <i class="fas fa-circle-notch fa-spin" v-if="loading"></i>
                            <span v-else>Update</span>
                        </button>
                    </div>
                </div>


                <div class="row hPadding-1">
                    <h4 class="settingOptionSectionTitle" v-show="blogs.length > 0">My Posts</h4>
                    <div class="card sticky-action" v-for="(blog, index) in blogs" :key="blog.id" v-show="blogs.length > 0">
                        <div class="d-flex">
                            <div class="card-image waves-effect waves-block waves-light">
                                <img class="activator responsive-img" :src="'/media/tenants/'+tenant+'/img/miniblog/'+blog.imageUrl">
                            </div>
                            <div>
                                <div class="card-content">
                                    <span class="card-title activator grey-text text-darken-4">{{ blog.title }}<i class="material-icons right">more_vert</i></span>
                                </div>
                                <div class="card-action">
                                    <a href="#" title="Delete" @click="deleteMe(blog)"><i class="material-icons red-text">delete</i></a>
                                    <a href="#" @click="editMe(blog, index)"><i class="material-icons primaryColor">edit</i></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4">{{ blog.title }}<i class="material-icons right">close</i></span>
                            <p>{{ blog.body }}</p>
                        </div>
                    </div>
                    <!-- <div v-show="blogs.length == 0">
                        You have not added any blog yet
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import ImageCropper from '../../../../partials/ImageCropper.vue';
export default {
    components: {
        ImageCropper
    },
    data() {
        return {
            blogs: [],
            loading: false,
            miniBlog: {
                title: "",
                body: "",
                imageUrl: null,
            },
            showCropper: false,
            uploadPhotoProcessing: false,
            update: false,
            uploaded: null,
        }
    },
    methods: {
        deleteMe(blog) {
            axios.delete('/api/miniblog/'+blog.id).then(res => {
                if (res.status == 204) {
                    this.blogs.splice(
                        this.blogs.findIndex(
                            (rol) => rol.id === blog.id
                        ),
                        1
                    );
                    M.toast({
                        html: "Data Archived",
                        classes: 'successNotifier', 
                        duration: 3000,
                        position: "top-right",
                    });
                }
            }).catch(err => {
                console.log(err);
            })
        }, 
        editMe(blog, index) {
            this.miniBlog = blog;
            this.miniBlog.index = index;
            this.update = true;
            document.querySelector('#miniBlogSettings .settingImgContainer').style.width = '80%';
            document.querySelector('#miniBlogSettings .optionSettingContainer').scrollTop = 80;
        },
        getBlog() {
            axios.get("/api/miniblog").then(res => {
                this.blogs = res.data.miniBlog;
            }).catch(err => {
                console.log(err);
            })
        },
        saveBlog(expr) {
            this.switchForInputs();
            if (this.switchForInputs()) {
                this.loading = true;
                let formData = new FormData();
                formData.append("imageUrl", this.miniBlog.imageUrl);
                formData.append("title", this.miniBlog.title);
                formData.append("body", this.miniBlog.body);
                axios.post('/api/miniblog', formData).then(res => {
                    if (res.data.status == 1) {
                        M.toast({
                            html: res.data.message,
                            classes: 'successNotifier'
                        });
                        this.loading = false;
                        this.blogs.unshift(res.data.blog);
                        this.miniBlog.title = '';
                        this.miniBlog.imageUrl = null;
                        this.miniBlog.body = ''
                        document.querySelector('#miniBlogSettings .settingImgContainer').style.width = '40%'
                        expr == 0 ? this.$emit('backToSettings') : null;
                        this.uploaded = null;
                    }
                    else if (res.data.errors) {
                        M.toast({
                            html: res.data.errors,
                            classes: 'errorNotifier',
                            timer: 5000
                        });
                    }
                }).catch(err => {
                    console.log(err);
                    this.loading = false;
                })
            }
        },
        switchForInputs() {
            if (this.validateBody(), this.validateTitle(), this.validateImage()) {
                return true;
            }
            return false;
        },
        validateBody () {
            let input = document.getElementById('miniBlogDescription');
            if (this.miniBlog.body == '' || this.miniBlog.body.length > 300) {
                input.nextElementSibling.style.color = 'red';
                input.style.borderBottomColor = 'red'
                document.querySelector('#miniBlogSettings .optionSettingContainer').scrollTop = 80;
            } else {
                input.nextElementSibling.style.color = 'unset';
                input.style.borderBottomColor = 'unset'
                return true;
            }
        },
        updateBlog() {
            this.switchForInputs();
            if (this.switchForInputs()) {
                this.loading = true;
                let formData = new FormData();
                this.uploaded != null ? formData.append('newImage', true) : null;
                formData.append("imageUrl", this.miniBlog.imageUrl);
                formData.append("title", this.miniBlog.title);
                formData.append("body", this.miniBlog.body);
                formData.append("_method", 'PUT');
                axios.post(`/api/miniblog/${this.miniBlog.id}`, formData).then(res => {
                    if (res.data.status == 1) {
                        M.toast({
                            html: res.data.message,
                            classes: 'successNotifier'
                        });
                        this.loading = false;
                        this.blogs[this.miniBlog.index] = res.data.blogpost;
                        this.miniBlog.title = '';
                        this.miniBlog.imageUrl = null;
                        this.miniBlog.body = ''
                        document.querySelector('#miniBlogSettings .settingImgContainer').style.width = '40%';
                        this.uploaded = null;
                        this.update = false;
                    }
                    else if (res.data.errors) {
                        M.toast({
                            html: res.data.errors,
                            classes: 'errorNotifier',
                            timer: 5000
                        });
                    }
                }).catch(err => {
                    console.log(err);
                    this.loading = false;
                })
            }
        },
        validateImage () {
            let tag = document.querySelectorAll('#miniBlogSettings .settingOptionSectionTitle')[1];
            if (this.miniBlog.imageUrl == null) {
                tag.style.color = 'red'
                document.querySelector('#miniBlogSettings .optionSettingContainer').scrollTop = 92;
            } else {
                tag.style.color = 'unset'
                return true;
            }
        },
        validateTitle () {
            let input = document.getElementById('title');
            if (this.miniBlog.title == '') {
                input.nextElementSibling.style.color = 'red';
                input.style.borderBottomColor = 'red'
                document.querySelector('#miniBlogSettings .optionSettingContainer').scrollTop = 0;
            }
            else {
                input.nextElementSibling.style.color = 'unset';
                input.style.borderBottomColor = 'unset'
                return true;
            }
        },
        showFileChooser() {
            this.showCropper = true;
            this.uploadPhotoProcessing = false;
        },
        photoUpload(e) {
            this.uploadPhotoProcessing = true;
            this.showCropper = false;
            e != '' ? document.querySelector('#miniBlogSettings .settingImgContainer').style.width = '80%' : null;
            this.miniBlog.imageUrl = e;
            this.validateImage();
            this.uploaded = e;
        },
    },
    mounted() {
        this.getBlog();
    },
    props: {
        modalTitle: String,
        modalView: Number,
        tenant: String,
    }
}
</script>