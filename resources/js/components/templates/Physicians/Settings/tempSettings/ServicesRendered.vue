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
                                    <input :checked="checked[index]" @change="handleChange(index)" :disabled="!isCheckable(index)" type="checkbox" v-model="myinterests[interest.title]"/>
                                    <span>{{interest.title}}</span>
                                </label>
                            </p>
                        </div>
                        <h6 class="settingOptionSectionTitle col l12 noMarginBottom">Non-Medical</h6>
    
                        <div class="row hPadding-1 center-align">
                            <p class="underConstruct">Under Construction</p>
                            <button class="btn saveSettingBtn" @click="serviceSaveOrUpdate">Save &amp; Back</button>
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
            interests: [
                {
                    title: 'Ophthalmologists',
                    id: 1,
                    description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Euismod urna faucibus nunc etiam nulla aliquam.',
                    icon: '/media/img/templates/1/otho.svg',
                },
                {
                    title: 'Gynecologists',
                    id: 2,
                    description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Euismod urna faucibus nunc etiam nulla aliquam.',
                    icon: '/media/img/templates/1/cadio.svg',
                },
                {
                    title: 'Dermatologists',
                    id: 3,
                    description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Euismod urna faucibus nunc etiam nulla aliquam.',
                    icon: '/media/img/templates/1/pedia.svg',
                },
                {
                    title: 'Allergists',
                    id: 4,
                    description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Euismod urna faucibus nunc etiam nulla aliquam.',
                    icon: '/media/img/templates/1/gastro.svg'
                },
                {
                    title: 'Pediatric',
                    id: 5,
                    description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Euismod urna faucibus nunc etiam nulla aliquam.',
                    icon: '/media/img/templates/1/pedia.svg'
                },
                {
                    title: 'Neurologists',
                    id: 6,
                    description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Euismod urna faucibus nunc etiam nulla aliquam.',
                    icon: '/media/img/templates/1/cadio.svg'
                },
                {
                    title: 'Psychiatrists',
                    id: 7,
                    description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Euismod urna faucibus nunc etiam nulla aliquam.',
                    icon: '/media/img/templates/1/otho.svg'
                },
                {
                    title: 'Cadiology',
                    id: 8,
                    description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Euismod urna faucibus nunc etiam nulla aliquam.',
                    icon: '/media/img/templates/1/cadio.svg'
                },
                {
                    title: 'Orthopaedics',
                    id: 9,
                    description: 'Orthopedists treat a wide variety of musculoskeletal conditions. These conditions may be present from birth, or they may result from an injury or age-related wear and tear.',
                    icon: '/media/img/templates/1/otho.svg'
                }
            ],
            loading: false,
            maxChecked: 3,
            myinterests: {},
            updateActive: 0,
        }
    },
    methods: {
        handleChange(index) {
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
                request = `/api/service/${this.service.id}`;
                formData.append('_method', 'PUT');
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
                        res.status === 201 ? this.services.unshift(res.data.service) : null;
                        this.loading = !this.loading;
                        this.service = {
                            title: "",
                            description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Euismod urna faucibus nunc etiam nulla aliquam.',
                            icon: "fa-tooth"
                        };
                        this.updateActive = 0;
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
        this.checked = new Array(this.interests.length).fill(false)
    },
    props: {
        services: Array,
        modalTitle: String,
    },
    watch: {
        services: {
            handler(newVal, oldVal) {
                // Do something when the prop changes
                if (newVal != null || newVal != undefined) {
                    this.myinterests = newVal;
                        this.interests.forEach((el, index) => {
                            // console.log(`E ${el.title}: ${el.title}`)
                            newVal.forEach(ele => {
                                if (el.title == ele.title) {
                                    this.checked[index] = true;
                                }
                            })
                        })
                }
                console.log(newVal);
            },
            deep: true
        }
    },
}
</script>