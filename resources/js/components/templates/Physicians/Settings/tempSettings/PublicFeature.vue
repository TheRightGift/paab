<template>
    <div>
        <div class="row noMarginBottom" id="publicFeatures">
            <div class="col l6 optionSettingBackground" >
                <p @click="$emit('backToSettings')">
                    <a class="btn-flat"><i class="material-icons left">chevron_left</i>Back</a>
                </p>
                <h5>
                    {{modalTitle}}
                </h5>
            </div>
            <div class="col l6 optionSettingContainer">
                <div>
                    <div class="row hPadding-1">
                        <h4 class="settingOptionSectionTitle col l12 noMarginBottom">Your public profile</h4>
                        <form>
                            <div class="formInnerDiv">
                                <div class="input-field col l12">
                                    <input
                                        type="text"
                                        class="validate formInput"
                                        required
                                        placeholder="CNN, BBC"
                                        v-model="program.broadcaster"
                                    />
                                    <label>Name of the media house?</label>
                                </div>
                                <div class="input-field col l12">
                                    <input
                                        type="text"
                                        class="validate formInput"
                                        required
                                        placeholder="CNN Health"
                                        v-model="program.title"
                                    />
                                    <label>Program Title</label>
                                </div>
                                <div class="input-field col l12">
                                    <input
                                        type="text"
                                        class="validate formInput"
                                        placeholder="https://news.com/whatevertheurlis"
                                        v-model="program.url"
                                    />
                                    <label>Program URL <span class="optionalColor">(Optional)</span></label>
                                </div>
                            </div>
                            <div class="center-align">
                                <!-- <button class="btn saveSettingBtn" @click="addEventFeatured(0)" type="submit">
                                    <i class="fas fa-circle-notch fa-spin" v-if="loading"></i>
                                    <span v-else>Save &amp; Add New</span>
                                </button> -->
                                <button v-if="update = 0" class="btn saveSettingBtn" @click.prevent="addEventFeatured(1)" type="submit">
                                    <i class="fas fa-circle-notch fa-spin" v-if="loading"></i>
                                    <span v-else>Save &amp; Back</span>
                                    <!-- <span v-else-if="update = 1 || !loading">Update &amp; Back</span> -->
                                </button>
                                <button v-else class="btn saveSettingBtn" @click.prevent="updateEventFeatured(1)" type="submit">
                                    <i class="fas fa-circle-notch fa-spin" v-if="loading"></i>
                                    <!-- <span v-else-if="update = 0 || !loading">Save &amp; Back</span> -->
                                    <span v-else>Update &amp; Back</span>
                                </button>
                            </div>
                        </form>
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
            loading: false,
            program: {
                title: "",
                broadcaster: "",
                url: "",
            },
            update: 0,
        }
    },
    methods: {
        addEventFeatured(expr) {
            if (
                this.program.title !== '' ||
                this.program.broadcaster !== '' ||
                this.program.url !== ''
            ) {
                this.loading = !this.loading;
                axios
                    .post("/api/public_feature", this.program)
                    .then((res) => {
                        if (res.data.message === 'Success') {
                            M.toast({
                                html: res.data.message,
                                classes: "successNotifier",
                            });
                            this.program.id = res.data.id;
                            this.loading = !this.loading;
                            // this.program.title = '';
                            // this.program.broadcaster = '';
                            // this.program.url = '';
                            expr === 1 ? this.$emit('backToSettings') : null;
                        }
                    })
                    .catch((err) => {
                        this.loading = !this.loading;
                        console.log(err);
                    });
            }
        },
        getSavedPublicFeatures(){
            this.loading = !this.loading;
            axios.get('/api/public_feature').then(res => {
                if (res.data.message === 'Success') {
                    if (res.data.public_feature !== null) {
                        this.program = res.data.public_feature;
                        this.update = 1;
                    }
                    this.loading = !this.loading;
                }
            }).catch(reportError => {
                this.loading = !this.loading;
                console.log(reportError)
            })
        },
        updateEventFeatured(expr) {
            if (
                this.program.title !== '' ||
                this.program.broadcaster !== '' ||
                this.program.url !== ''
            ) {
                this.loading = !this.loading;
                axios
                    .put(`/api/public_feature/${this.program.id}`, this.program)
                    .then((res) => {
                        if (res.data.message === 'Success') {
                            M.toast({
                                html: res.data.message,
                                classes: "successNotifier",
                            });
                            this.loading = !this.loading;
                            expr === 1 ? this.$emit('backToSettings') : null;
                        }
                    })
                    .catch((err) => {
                        this.loading = !this.loading;
                        console.log(err);
                    });
            }
        },
    },
    mounted() {
        this.getSavedPublicFeatures();
    },
    props: {
        modalTitle: String,
    }
}
</script>