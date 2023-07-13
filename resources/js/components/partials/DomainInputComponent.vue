<template>
    <div>
        <div class="input-container mt-1">
            <input
                type="text"
                v-model="domain"
                class="validate browser-default"
                placeholder="Hit enter to search"
                @keyup="checkDomainAvailability($event)"
                data-no-label="true"
            />
            <span
                class="close-icon red-text lighten-3"
                @click="clearDomainInput"
                v-show="domain != '' && !domainCheckPassed"
                >&times;</span
            >
            <span
                class="close-icon green-text lighten-3"
                @click="clearDomainInput"
                v-show="domain != '' && domainCheckPassed"
                ><i class="fa fa-check"></i
            ></span>
        </div>
        <div class="col l12 s12 right-align">
            <i
                class="fas fa-spinner fa-spin fa-1x"
                v-if="checkingSuggestion"
            ></i>
            <small
                class="unAvailTitle"
                v-if="domainCheckPassed == false && this.domain != ''"
            >
                Unavailable
            </small>
            <small
                class="availTitle"
                v-if="domainCheckPassed == true && this.domain != ''"
            >
                Available
            </small>
        </div>
        <p class="supportText">
            Not satisfied with the suggested domain name above, type in your
            preferred domain name or
            <a href="#!" @click="generateMultiple">view our suggestions</a>.
        </p>
    </div>

    <div class="row" v-if="suggestionLoaded">
        <div class="col s12 domianMainDiv">
            <!--p class="noMarginTop"><a href="">Display Suggestions</a></p-->
            <div v-show="!loadingSuggestions">
                <template
                    v-for="(suggestion, index) in domainSuggestions"
                    :key="index"
                >
                    <div class="row">
                        <div class="col s1">
                            <p class="domainSelectP">
                                <label>
                                    <input
                                        class="with-gap"
                                        name="group1"
                                        type="radio"
                                        :value="suggestion.name"
                                        v-model="domain"
                                    />
                                    <span></span>
                                </label>
                            </p>
                        </div>
                        <div class="col s11">
                            <table>
                                <!-- Table Head Section if ever needed
                                                <thead><tr><th></th></tr></thead> -->
                                <tbody>
                                    <tr>
                                        <td class="domainTdName">
                                            {{ suggestion.name }}
                                        </td>
                                        <td class="domainTdState">Available</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </template>
            </div>
            <div class="flex center-align p-10">
                <div v-if="loadingSuggestions">
                    <i class="fas fa-spinner fa-spin fa-2x"></i>
                    <p>Loading Suggestions</p>
                </div>
                <p class="centered" v-if="domainSuggestions.length < 1">
                    No available suggestions
                </p>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        computed: {
            isDomainValid() {
                return this.domain.trim().length >= 2;
            },
        },
        data() {
            return {
                checkingSuggestion: false,
                domain: "",
                domainCheckPassed: null,
                domainSuggestions: [],
                suggestionLoaded: false,
                loadingSuggestions: false,
                timer: null,
            };
        },
        emits: ["newDomain"],
        methods: {
            checkDomainAvailability(event) {
                // Check if the Backspace key was pressed
                if (event.keyCode === 8 || event.key === "Backspace") {
                    // Handle Backspace key event
                    // For example, clear the domain input value or perform any other desired action
                    this.domainCheckPassed = null;
                    return;
                }

                clearTimeout(this.timer);
                this.timer = setTimeout(() => {
                    const inputValue = event.target.value.trim();
                    if (inputValue.length >= 2) {
                        this.checkingSuggestion = true;
                        let inputValue = this.domain.endsWith(".com")
                            ? this.domain
                            : this.domain + ".com";
                        axios
                            .post("/api/domain/check", { domain: inputValue })
                            .then((res) => {
                                if (res.data.status == 1) {
                                    this.domainCheckPassed = true;
                                    this.$emit("newDomain", inputValue);
                                } else if (res.data.status == 0) {
                                    this.domainCheckPassed = false;
                                }
                                this.checkingSuggestion = false;
                            })
                            .catch((err) => {
                                console.log(err);
                                this.checkingSuggestion = false;
                            });
                    } else {
                        this.domainCheckPassed = null;
                    }
                    // this.removeLabel(el);
                }, 1000);
            },
            clearDomainInput() {
                this.domain = "";
                this.domainCheckPassed = null;
            },
            generateMultiple() {
                if (this.titleId === "") {
                    M.toast({
                        html: "Please select your title",
                        classes: "errorNotifier",
                    });
                } else {
                    this.domainSuggestions = [];
                    let title = this.titles.find((el) => el.id == this.titleId);
                    this.suggestionLoaded = true;
                    this.domainSuggestions.push({
                        name: (
                            title.name.replace(/\./g, "") +
                            this.firstname +
                            this.lastname +
                            ".com"
                        ).toLowerCase(),
                    });
                    this.domainSuggestions.push({
                        name: (
                            title.name.replace(/\./g, "") +
                            this.lastname +
                            this.firstname +
                            ".com"
                        ).toLowerCase(),
                    });
                    this.domainSuggestions.push({
                        name: (
                            this.firstname +
                            this.lastname +
                            title.name.replace(/\./g, "") +
                            ".com"
                        ).toLowerCase(),
                    });
                    this.domainSuggestions.push({
                        name: (
                            this.lastname +
                            this.firstname +
                            title.name.replace(/\./g, "") +
                            ".com"
                        ).toLowerCase(),
                    });
                    this.domainSuggestions.push({
                        name: (
                            title.name.replace(/\./g, "") +
                            this.lastname +
                            ".com"
                        ).toLowerCase(),
                    });
                    // this.domainSuggestions.push({
                    //     name: (
                    //         title[0].name.replace(/\./g, "") +
                    //         this.bioData.firstname +
                    //         ".com"
                    //     ).toLowerCase(),
                    // });

                    let data = JSON.stringify(this.domainSuggestions);
                    this.loadingSuggestions = true;
                    axios
                        .post(`/api/domain/check/`, { domain: data })
                        .then((res) => {
                            if (res.data.status == 200) {
                                this.domainSuggestions = res.data.available;
                                this.loadingSuggestions = false;
                                this.suggestionLoaded = true;
                            }
                        })
                        .catch((err) => {
                            console.log(err);
                        });
                }
            },
        },
        props: {
            titles: Array,
            lastname: String,
            firstname: String,
            domainSelected: String,
            titleId: { required: true },
        },
        watch: {
            domainSelected: {
                handler(val) {
                    console.log(val);
                    if (val) {
                        this.domain = val;
                    }
                },
            },
        },
    };
</script>
<style scoped>
    .input-container {
        position: relative;
    }

    .input-container input {
        padding-right: 25px; /* Adjust the padding to make room for the close icon */
    }

    .close-icon {
        position: absolute;
        top: 0;
        right: 0;
        padding: 10px;
        cursor: pointer;
        font-size: 1.75rem;
    }
    .supportText {
        color: #000;
        font-family: "Montserrat", sans-serif;
        font-size: 0.875rem;
        font-style: normal;
        font-weight: 400;
        line-height: normal;
    }
    table {
        width: 95%;
    }

    table tr {
        border: 1px solid #d9d9d9;
    }

    table tr td {
        padding: 0.5rem 1rem;
    }

    .domainTdName {
        font-family: "Montserrat", sans-serif;
        font-weight: 500;
        font-size: 0.9rem;
        color: var(--black);
    }

    .domainTdState {
        font-family: "Montserrat", sans-serif;
        font-weight: 500;
        font-size: 0.9rem;
        color: #078523;
        text-align: right;
    }

    .domainSelectP {
        margin: 0.5vh 0 0 0;
    }

    .domianMainDiv {
        margin-bottom: 1vh;
    }

    .unAvailTitle,
    .availTitle {
        font-family: "Montserrat", sans-serif;
        font-size: 12px;
        font-style: normal;
        font-weight: 500;
        line-height: normal;
    }
    .unAvailTitle {
        color: #ad1010;
    }
    .availTitle {
        color: #9adf4c;
    }
    @media only screen and (max-width: 767px) {
        .supportText {
            font-size: 0.75rem;
            margin-bottom: 0;
        }
    }
</style>