<template>
    <div>
        <div class="row noMarginBottom" id="interests">
            <div class="col l6 optionSettingBackground">
                <p @click="$emit('backToSettings')">
                    <a class="btn-flat"><i class="material-icons left">chevron_left</i>Back</a>
                </p>
                <h5>
                    {{modalTitle}}
                </h5>
            </div>
            <div class="col l6 optionSettingContainer">
                <div class="row hPadding-1">
                    <h4 class="settingOptionSectionTitle col l12 noMarginBottom">Interests</h4>
                    <p class="subHeading hPadding-1" v-if="isCheckedLimitExceeded">You can only select {{ maxChecked }} options.</p>
                    <div class="hPadding-1">
                        <div class="formInnerDiv">
                            <div class="row">
                                <h6 class="settingOptionSectionTitle col l12 noMarginBottom">Medical</h6>
                            </div>
                            <p v-for="(interest, index) in interests" :key="interest">
                                <label>
                                    <input :checked="checked[index]" @change="handleChange(interest, index)" :disabled="!isCheckable(index)" type="checkbox" v-model="myinterests[interest.title]"/>
                                    <span>{{interest.title}}</span>
                                </label>
                            </p>
                        </div>
                        <h6 class="settingOptionSectionTitle col l12 noMarginBottom">Non-Medical</h6>
    
                        <div class="row hPadding-1 center-align">
                            <p class="underConstruct">Under Construction</p>
                            <button class="btn saveSettingBtn" @click="serviceSaveOrUpdate">
                                <i class="fas fa-circle-notch fa-spin" v-if="loading"></i>
                                <span v-else>Save &amp; Back</span>
                                
                            </button>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</template>
<script>
export default {
    computed: {
        myinterests: {
            get() {
                return this.interests.filter((option, index) => this.checked[index]);
            },
            set(value) {
                const newChecked = new Array(this.interests.length).fill(false);
                value.forEach((option) => {
                    const index = this.interests.indexOf(option);
                    if (index !== -1) {
                        newChecked[index] = true;
                    }
                });
                this.checked = newChecked;
            },
        },
        isCheckedLimitExceeded() {
            const checkedCount = this.checked.filter((isChecked) => isChecked).length;
            return checkedCount >= this.maxChecked;
        },
    },
    data() {
        return {
            checked: [],
            loading: false,
            maxChecked: 3,
            removed: [],
            updateActive: 0,
        }
    },
    methods: {
        handleChange(interest, index) {
            let e = this.services.find(el => el.interest_id == interest.id);
            console.log(interest, e);
            e != undefined ? this.removed.push(e) : null;
            if (this.isCheckable(index)) {
                this.checked[index] = !this.checked[index];
            } else {
                this.checked[index] = false;
            }
        },
        isCheckable(index) {
            const checkedCount = this.checked.filter((isChecked) => isChecked).length;
            const uncheckedCount = this.checked.length - checkedCount;
            return this.checked[index] || checkedCount < this.maxChecked || uncheckedCount === 0;
        },
        serviceSaveOrUpdate() {
            this.loading = !this.loading;
            let request = `/api/service`;
            let formData = new FormData()
            if (this.updateActive === 1) {
                request = `/api/service/1`;
                formData.append('_method', 'PUT');
                this.removed.length > 0 ? formData.append('removed', JSON.stringify(this.removed)) : null;
            }
            formData.append('data', JSON.stringify(this.myinterests));
            axios
                .post(request, formData)
                .then((res) => {
                    if (res.status == 201 || res.data.status == 200) {
                        M.toast({
                            html: res.data.message,
                            classes: "successNotifier",
                        });
                        if (res.status == 201) {
                            for (const key in this.myinterests) {
                                if (this.myinterests.hasOwnProperty(key)) {
                                    console.log(`${key}: ${this.myinterests[key]}`);
                                    // this.services.unshift(this.myinterests[key])
                                }
                            }
                        }

                        this.loading = !this.loading;
                        this.service = {
                            title: "",
                            description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Euismod urna faucibus nunc etiam nulla aliquam.',
                            icon: "fa-tooth"
                        };
                        this.updateActive = 1;
                        this.$emit('backToSettings');
                    }
                })
                .catch((err) => {
                    this.loading = !this.loading;
                    if (err.response.status == 400) {
                        err.response.data.forEach((el) => {
                            M.toast({
                                html: el,
                                classes: "errorNotifier",
                            });
                        });
                    }
                });
        },
    },
    mounted() {
        
    },
    props: {
        services: Array,
        modalTitle: String,
        interests: Array,
    },
    watch: {
        services: {
            handler(newVal, oldVal) {
                // Do something when the prop changes
                if (newVal != null || newVal != undefined) {
                        this.interests.forEach((el, index) => {
                            // console.log(`E ${el.title}: ${el.title}`)
                            newVal.forEach(ele => {
                                if (el.id == ele.interest_id) {
                                    this.checked[index] = true;
                                }
                            })
                            if (newVal.length !== 0) {
                                this.updateActive = 1;
                            } 
                        })
                }
            },
            deep: true
        },
        interests(newVal, oldVal) {
            if (newVal !== null) {
                if (newVal.length > 0) {
                    this.checked = new Array(this.interests.length).fill(false)
                }
            }
        },
    },
}
</script>