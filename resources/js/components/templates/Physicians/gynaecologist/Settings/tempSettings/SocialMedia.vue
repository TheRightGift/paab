<template>
    <div>
        <div class="row noMarginBottom" id="feeds">
            <div class="col l6 s12 optionSettingBackground" >
                <p @click="$emit('backToSettings')">
                    <a class="btn-flat"><i class="material-icons left">chevron_left</i>Back</a>
                </p>
                <h5>
                    {{modalTitle}}
                </h5>
            </div>
            <div class="col l6 optionSettingContainer">
                <div id="facebook">
                    <div class="row hPadding-1">
                        <h4 class="settingOptionSectionTitle col l12 noMarginBottom">Facebook</h4>
                        <div class="formInnerDiv">
                            <div class="input-field col l12">
                                <input
                                    type="text"
                                    class="validate formInput"
                                    placeholder="Facebook ID"
                                    v-model="social.facebook"
                                />
                                <label>Facebook ID</label>
                            </div>
                        </div>
                    </div>
                    <div class="row hPadding-2">
                        <ul class="collapsible">
                            <li>
                                <div class="collapsible-header">
                                    <i class="material-icons">smartphone</i>
                                    <span class="contentTitle1">How to get my facebook id via mobile</span>
                                </div>
                                <div class="collapsible-body">
                                    <video class="socialMediaHandVidTag" controls>
                                        <source src="/media/videos/get_facebook_pro_page_name.mp4" type="video/mp4">
                                    </video>
                                </div>
                            </li>
                            <li>
                                <div class="collapsible-header">
                                    <i class="material-icons">laptop_windows</i>
                                    <span class="contentTitle1">How to get my facebook id via desktop</span>
                                </div>
                                <div class="collapsible-body">
                                    <video class="socialMediaHandVidTag" controls>
                                        <source src="/media/videos/get_facebook_pro_page_name.mp4" type="video/mp4">
                                    </video>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="twitter">
                    <div class="row hPadding-1">
                        <h4 class="settingOptionSectionTitle col l12 noMarginBottom">Twitter</h4>
                        <div class="formInnerDiv">
                            <div class="input-field col l12">
                                <input
                                    type="text"
                                    class="validate formInput"
                                    placeholder="Twitter ID"
                                    v-model="social.twitter"
                                />
                                <label>Twitter ID</label>
                            </div>
                        </div>
                    </div>
                    <div class="row hPadding-2">
                        <ul class="collapsible">
                            <li>
                                <div class="collapsible-header">
                                    <i class="material-icons">smartphone</i>
                                    <span class="contentTitle1">How to get my Twitter id via mobile</span>
                                </div>
                                <div class="collapsible-body">
                                    <video class="socialMediaHandVidTag" controls>
                                        <source src="/media/videos/get_twitter_handle.mp4" type="video/mp4">
                                    </video>
                                </div>
                            </li>
                            <li>
                                <div class="collapsible-header">
                                    <i class="material-icons">laptop_windows</i>
                                    <span class="contentTitle1">How to get my Twitter id via desktop</span>
                                </div>
                                <div class="collapsible-body">
                                    <video class="socialMediaHandVidTag" controls>
                                        <source src="/media/videos/get_twitter_handle.mp4" type="video/mp4">
                                    </video>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="instagram">
                    <div class="row hPadding-1">
                        <h4 class="settingOptionSectionTitle col l12 noMarginBottom">Instagram</h4>
                        <div class="formInnerDiv">
                            <div class="input-field col l12">
                                <input
                                    type="text"
                                    class="validate formInput"
                                    placeholder="Instagram ID"
                                    v-model="social.instagram"
                                />
                                <label>Instagram ID</label>
                            </div>
                        </div>
                    </div>
                    <div class="row hPadding-2">
                        <ul class="collapsible">
                            <li>
                                <div class="collapsible-header">
                                    <i class="material-icons">smartphone</i>
                                    <span class="contentTitle1">How to get my Instagram id via mobile</span>
                                </div>
                                <div class="collapsible-body">
                                    <video class="socialMediaHandVidTag" controls>
                                        <source src="/media/videos/get_instagram_handle.webm" type="video/webm">
                                    </video>
                                </div>
                            </li>
                            <li>
                                <div class="collapsible-header">
                                    <i class="material-icons">laptop_windows</i>
                                    <span class="contentTitle1">How to get my Instagram id via desktop</span>
                                </div>
                                <div class="collapsible-body">
                                    <video class="socialMediaHandVidTag" controls>
                                        <source src="/media/videos/get_instagram_handle.webm" type="video/webm">
                                    </video>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="titktok">
                    <div class="row hPadding-1">
                        <h4 class="settingOptionSectionTitle col l12 noMarginBottom">Tiktok</h4>
                        <div class="formInnerDiv">
                            <div class="input-field col l12">
                                <input
                                    type="text"
                                    class="validate formInput"
                                    placeholder="Tiktok ID"
                                    v-model="social.tiktok"
                                />
                                <label>Tiktok ID</label>
                            </div>
                        </div>
                    </div>
                    <div class="row hPadding-2">
                        <ul class="collapsible">
                            <li>
                                <div class="collapsible-header">
                                    <i class="material-icons">smartphone</i>
                                    <span class="contentTitle1">How to get my Tiktok id via mobile</span>
                                </div>
                                <div class="collapsible-body">
                                    <video class="socialMediaHandVidTag" controls>
                                        <source src="/media/videos/get_tiktok_handle.webm" type="video/webm">
                                    </video>
                                </div>
                            </li>
                            <li>
                                <div class="collapsible-header">
                                    <i class="material-icons">laptop_windows</i>
                                    <span class="contentTitle1">How to get my Tiktok id via desktop</span>
                                </div>
                                <div class="collapsible-body">
                                    <video class="socialMediaHandVidTag" controls>
                                        <source src="/media/videos/get_tiktok_handle.webm" type="video/webm">
                                    </video>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row hPadding-1 center-align">
                    <button class="btn saveSettingBtn" @click="saveSocials">
                        <i class="fas fa-circle-notch fa-spin" v-if="loading"></i>
                        <span v-else>Save &amp; Back</span>
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
            loading: false,
            social: {},
            update: 0,
        }
    },
    methods: {
        getSavedSocials(){
            this.loading = true;
            axios.get('/api/social').then(res => {
                if (res.data.social !== null) {
                    this.social = res.data.social;
                    this.update = 1;
                }
                this.loading = false;
            }).catch(reportError => {
                this.loading = false;
                console.log(reportError)
            })
        },
        saveSocials() {
            if (
                this.social.facebook !== '' ||
                this.social.tiktok !== '' ||
                this.social.instagram !== '' ||
                this.social.twitter !== ''
            ) {
                this.loading = true;
                let request = `/api/social`;
                let data = {
                    _method: "PUT",
                };
                if (this.update == 1) {
                    request = `/api/social/${this.social.id}`;
                    this.social = { ...this.social, ...data };
                }
                axios
                    .post(request, this.social)
                    .then((res) => {
                        if (res.status == 201 || res.data.status == 200) {
                            M.toast({
                                html: res.data.message,
                                classes: "successNotifier",
                            });
                            this.social.id = res.data.social.id;
                            this.update = 1;
                            this.loading = false;
                            this.$emit('backToSettings');
                        }
                    })
                    .catch((err) => {
                        this.loading = false;
                        console.log(err);
                    });
            }
        },
    },
    mounted() {
        this.getSavedSocials();
    },
    props: {
        modalTitle: String,
    }
}
</script>