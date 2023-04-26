<template>
    <div>
        <p v-for="(interest, index) in interests" :key="interest">
            <label>
                <input :id="interest.id" :checked="checked[index]" @change="handleChange(interest, index)" :disabled="!isCheckable(index)" type="checkbox" v-model="myinterests[interest.title]"/>
                <span>{{interest.title}}</span>
            </label>
        </p>
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
            maxChecked: 3,
            removed: [],
        }
    },
    methods: {
        handleChange(interest, index) {
            let e = this.services.find(el => el.interest_id == interest.id);
            e != undefined ? this.removed.push(e) : null;
            if (this.isCheckable(index)) {
                this.checked[index] = !this.checked[index];
            } else {
                this.checked[index] = false;
            }
            this.$emit('myinterests', this.myinterests);
        },
        isCheckable(index) {
            const checkedCount = this.checked.filter((isChecked) => isChecked).length;
            const uncheckedCount = this.checked.length - checkedCount;
            return this.checked[index] || checkedCount < this.maxChecked || uncheckedCount === 0;
        },
    },
    mounted() {
        if (this.interests.length > 0) {
            this.checked = new Array(this.interests.length).fill(false)
        }
        if (this.services.length > 0) {
            this.interests.forEach((el, index) => {
                // console.log(`E ${el.title}: ${el.title}`)
                this.services.forEach(ele => {
                    if (el.id == ele.interest_id) {
                        this.checked[index] = true;
                    }
                })
            })
        }
    },
    props: {
        interests: Array,
        services: Array,
    },
}
</script>