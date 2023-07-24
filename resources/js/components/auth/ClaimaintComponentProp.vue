<template>
    <div>
        <div id="page"></div>
        <div class="flex">
            <div
                class="item flex flex-col align-center justify-center hide-on-med-and-down"
            >
                <img
                    class="logo"
                    src="/media/img/wcdlogoLG-noBG.png"
                    alt="Whitecoatdomain Logo"
                />
            </div>
            <div
                class="item flex flex-col align-center justify-center sm-flex-start"
            >
                <img
                    src="/media/img/wcd-logo-noBckg-removebg-previewWHITE.png"
                    class="responsive logo show-on-medium hide-on-small hide-on-large-only hide-on-small-only"
                />
                <div v-if="view == 0 || inputEmail == ''" class="flex flex-col background gap20 md-justify-center">
                    <div class="flex flex-end hide-on-med-and-up">
                        <img
                            src="/media/img/wcdlogoLG-noBG.png"
                            class="responsive logo"
                        />
                    </div>
                    <div class="flex justify-center align-center">
                        <div v-show="!otpMode" class="flex flex-col justify-center">
                            <h6>Enter your email to proceed</h6>
                            <form @submit.prevent="checkEmail">
                                <div class="">
                                    <!-- <label>Enter your email address</label> -->
                                    <input type="email" v-model="inputEmail" class="browser-default mt-1" placeholder="Email address" required/>
                                </div>
                                <div class="flex justify-center mt-1">
                                    <button type="submit" class="btn waves waves-effect col s12 custom-button" :disabled="verificationLoading"> <i class="fa fa-spinner fa-spin" v-show="verificationLoading"></i>Submit</button>
                                </div>
                            </form>
                        </div>
                        <div v-show="otpMode" class="row">
                            <otp-component @res="changeView($event)" type="register" :otp="otp" />
                        </div>
                    </div>

                </div>
                <div class="formContainer"  v-else>
                    <div>
                        <div class="flex flex-end hide-on-med-and-up">
                            <img
                                src="/media/img/wcdlogoLG-noBG.png"
                                class="responsive logo"
                            />
                        </div>
                        <section class="row" id="bio">
                            <h4 class="sectionTitle col s12">
                                Basic information
                            </h4>

                            <div class="row">
                                <div class="col l3 m3 s6 sm-mt-1">
                                    <label>Pick Title</label>
                                    <select
                                        v-model="bio.title_id"
                                        required
                                        class="browser-default custom-select mt-1"
                                        id="userTitle"
                                        data-label="true"
                                        @change="switchText($event)"
                                    >
                                        <option :value="''" disabled selected>
                                            Title
                                        </option>
                                        <option
                                            v-for="title in titles"
                                            :key="title.id"
                                            :value="title.id"
                                        >
                                            {{ title.name }}
                                        </option>
                                    </select>
                                </div>

                                <div class="col l3 m3 s6 sm-mt-1">
                                    <label>Firstname</label>
                                    <input
                                        type="text"
                                        v-model="bio.firstname"
                                        class="validate browser-default mt-1"
                                        required
                                        placeholder="Firstname"
                                        @keyup="removeLabel($event)"
                                    />
                                </div>
                                <div class="col l3 m3 s6 sm-mt-1">
                                    <label>Lastname</label>
                                    <input
                                        type="text"
                                        v-model="bio.lastname"
                                        class="validate browser-default mt-1"
                                        placeholder="Lastname"
                                        @keyup="
                                            removeLabel($event),
                                                checkTenantOnDemand()
                                        "
                                    />
                                </div>
                                <div class="col l3 m3 s6 sm-mt-1">
                                    <label>Othername</label>
                                    <input
                                        type="text"
                                        v-model="bio.othername"
                                        class="validate browser-default mt-1"
                                        placeholder="Othernames"
                                        data-optional="true"
                                    />
                                </div>
                            </div>
                        </section>
                        <section class="row" id="domain">
                            <div class="col l12 s12">
                                <label>Type domain name</label>
                                <domain-input-component
                                    @newDomain="newDomain($event)"
                                    :titles="titles"
                                    :domainSelected="domainSelected"
                                    :firstname="bio.firstname"
                                    :lastname="bio.lastname"
                                    :titleId="bio.title_id"
                                />
                            </div>
                        </section>
                        <section id="profile-picture">
                            <div class="row">
                                <label class="col s12 mt-1"
                                    >Portfolio Image</label
                                >
                            </div>
                            <div
                                class="flex justify-center flex-col align-center sm-mt-4"
                            >
                                <image-uploader-component
                                    :tenantId="tenantId"
                                    :uploaded="uploaded"
                                    :photo="bio.photo"
                                    :path="'/media/tenants/' +tenantId +'/img/'"
                                    :height="799"
                                    :width="650"
                                    :xAxis="650"
                                    :yAxis="799"
                                    @fileChosen="imageChosen($event)"
                                />
                                <div class="" v-show="uploadPhotoProcessing">
                                    <i
                                        class="fa-solid fa-circle-notch fa-spin"
                                    ></i>
                                </div>
                            </div>
                        </section>
                        <section class="row" id="underGrad">
                            <h4 class="sectionTitle col s12">
                                Undergraduate School <br />
                                <small
                                    >Only fill if you had an undergrad progam
                                    before medical school</small
                                >
                            </h4>
                            <div class="row">
                                <div class="col s12">
                                    <label>Name of institution</label>
                                    <input
                                        placeholder="Name of institution"
                                        v-model="underGrad.institution"
                                        @keyup="removeLabel($event)"
                                        type="text"
                                        class="validate browser-default mt-1"
                                    />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col l6 m6 s6">
                                    <label>Undergraduate Major</label>
                                    <input
                                        placeholder="What was your major?"
                                        type="text"
                                        v-model="underGrad.major"
                                        @keyup="removeLabel($event)"
                                        class="validate browser-default mt-1"
                                    />
                                </div>
                                <div class="col l6 m6 s6">
                                    <label>Undergraduate Minor</label>
                                    <input
                                        placeholder="What was your minor(optional)?"
                                        type="text"
                                        v-model="underGrad.minor"
                                        data-optional="true"
                                        class="validate browser-default mt-1"
                                    />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col l6 m6 s6">
                                    <label> When did you start? </label>
                                    <div class="row">
                                        <div class="col s6">
                                            <select
                                                class="validate browser-default mt-1"
                                                v-model="underGrad.monthStart"
                                                @change="removeLabel($event)"
                                            >
                                                <option
                                                    :value="''"
                                                    disabled
                                                    selected
                                                >
                                                    Month
                                                </option>
                                                <option
                                                    v-for="(
                                                        month, index
                                                    ) in months"
                                                    :key="index"
                                                    :value="index + 1"
                                                >
                                                    {{ month }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col s6 mt-1">
                                            <date-picker
                                                v-model:value="
                                                    underGrad.yearStart
                                                "
                                                @change="removeLabel($event, 0)"
                                                type="year"
                                                placeholder="Year"
                                            ></date-picker>
                                        </div>
                                    </div>
                                </div>

                                <div class="col l6 m6 s6">
                                    <label> When did you finish? </label>
                                    <div class="row">
                                        <div class="col s6">
                                            <select
                                                class="validate browser-default mt-1"
                                                v-model="underGrad.monthEnd"
                                                @change="removeLabel($event)"
                                            >
                                                <option
                                                    :value="''"
                                                    disabled
                                                    selected
                                                    class="base"
                                                >
                                                    Month
                                                </option>
                                                <option
                                                    v-for="(
                                                        month, index
                                                    ) in months"
                                                    :key="index"
                                                    :value="index + 1"
                                                >
                                                    {{ month }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col s6 mt-1">
                                            <date-picker
                                                v-model:value="
                                                    underGrad.yearEnd
                                                "
                                                @change="removeLabel($event, 1)"
                                                type="year"
                                                class="browser-default"
                                                placeholder="Year"
                                            ></date-picker>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="row" id="medSchool">
                            <h4 class="sectionTitle col s12">
                                {{ medText }} School
                            </h4>

                            <div class="row">
                                <div class="col l12 s12">
                                    <label>Name of institution</label>
                                    <input
                                        placeholder="Name of institution"
                                        type="text"
                                        class="validate browser-default mt-1"
                                        v-model="medSchool.institution"
                                        @keyup="removeLabel($event)"
                                    />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col l6 s6">
                                    <label> When did you start? </label>
                                    <div class="row">
                                        <div class="col l6 s6">
                                            <select
                                                class="validate browser-default mt-1"
                                                v-model="medSchool.monthStart"
                                                @change="removeLabel($event)"
                                            >
                                                <option
                                                    :value="''"
                                                    disabled
                                                    selected
                                                >
                                                    Month
                                                </option>
                                                <option
                                                    v-for="(
                                                        month, index
                                                    ) in months"
                                                    :key="index"
                                                    :value="index + 1"
                                                >
                                                    {{ month }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col l6 s6 mt-1">
                                            <date-picker
                                                v-model:value="
                                                    medSchool.yearStart
                                                "
                                                @change="removeLabel($event, 2)"
                                                type="year"
                                                placeholder="Year"
                                            ></date-picker>
                                        </div>
                                    </div>
                                </div>

                                <div class="col s6">
                                    <label> When did you finish? </label>
                                    <div class="row">
                                        <div class="col l6 s6">
                                            <select
                                                class="validate browser-default mt-1"
                                                v-model="medSchool.monthEnd"
                                                @change="removeLabel($event)"
                                            >
                                                <option
                                                    :value="''"
                                                    disabled
                                                    selected
                                                >
                                                    Month
                                                </option>
                                                <option
                                                    v-for="(
                                                        month, index
                                                    ) in months"
                                                    :key="index"
                                                    :value="index + 1"
                                                >
                                                    {{ month }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col l6 s6 mt-1">
                                            <date-picker
                                                v-model:value="
                                                    medSchool.yearEnd
                                                "
                                                @change="removeLabel($event, 3)"
                                                type="year"
                                                placeholder="Year"
                                            ></date-picker>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="row" id="internship">
                            <h4 class="sectionTitle col s12">
                                Internship program
                            </h4>
                            <div class="row">
                                <div class="col s12">
                                    <label for="Name of institution"
                                        >Name of institution</label
                                    >
                                    <input
                                        placeholder="Name of institution"
                                        type="text"
                                        class="validate browser-default mt-1"
                                        v-model="internship.institution"
                                        @keyup="removeLabel($event)"
                                    />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col l6 s6">
                                    <label> When did you start? </label>
                                    <div class="row">
                                        <div class="col l6 s6">
                                            <select
                                                class="validate browser-default mt-1"
                                                v-model="internship.monthStart"
                                                @change="removeLabel($event)"
                                            >
                                                <option
                                                    :value="''"
                                                    disabled
                                                    selected
                                                >
                                                    Month
                                                </option>
                                                <option
                                                    v-for="(
                                                        month, index
                                                    ) in months"
                                                    :key="index"
                                                    :value="index + 1"
                                                >
                                                    {{ month }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col l6 s6 mt-1">
                                            <date-picker
                                                v-model:value="
                                                    internship.yearStart
                                                "
                                                @change="removeLabel($event, 4)"
                                                type="year"
                                                placeholder="Year"
                                            ></date-picker>
                                        </div>
                                    </div>
                                </div>

                                <div class="col s6">
                                    <label> When did you finish? </label>
                                    <div class="row">
                                        <div class="col l6 s6">
                                            <select
                                                class="validate browser-default mt-1"
                                                v-model="internship.monthEnd"
                                                @change="removeLabel($event)"
                                            >
                                                <option
                                                    :value="''"
                                                    disabled
                                                    selected
                                                >
                                                    Month
                                                </option>
                                                <option
                                                    v-for="(
                                                        month, index
                                                    ) in months"
                                                    :key="index"
                                                    :value="index + 1"
                                                >
                                                    {{ month }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col l6 s6 mt-1">
                                            <date-picker
                                                v-model:value="
                                                    internship.yearEnd
                                                "
                                                @change="removeLabel($event, 5)"
                                                type="year"
                                                placeholder="Year"
                                            ></date-picker>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="row" id="residency">
                            <h4 class="sectionTitle col s12">
                                Residency program
                            </h4>
                            <div class="row">
                                <div class="col s12">
                                    <label for="Name of institution"
                                        >Name of institution</label
                                    >
                                    <input
                                        placeholder="Name of institution"
                                        type="text"
                                        class="validate browser-default mt-1"
                                        v-model="residency.institution"
                                        @keyup="removeLabel($event)"
                                    />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col l6 s6">
                                    <label> When did you start? </label>
                                    <div class="row">
                                        <div class="col l6 s6">
                                            <select
                                                class="validate browser-default mt-1"
                                                v-model="residency.monthStart"
                                                @change="removeLabel($event)"
                                            >
                                                <option
                                                    :value="''"
                                                    disabled
                                                    selected
                                                >
                                                    Month
                                                </option>
                                                <option
                                                    v-for="(
                                                        month, index
                                                    ) in months"
                                                    :key="index"
                                                    :value="index + 1"
                                                >
                                                    {{ month }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col l6 s6 mt-1">
                                            <date-picker
                                                v-model:value="
                                                    residency.yearStart
                                                "
                                                @change="removeLabel($event, 6)"
                                                type="year"
                                                placeholder="Year"
                                            ></date-picker>
                                        </div>
                                    </div>
                                </div>

                                <div class="col s6">
                                    <label> When did you finish? </label>
                                    <div class="row">
                                        <div class="col l6 s6">
                                            <select
                                                class="validate browser-default mt-1"
                                                v-model="residency.monthEnd"
                                                @change="removeLabel($event)"
                                            >
                                                <option
                                                    :value="''"
                                                    disabled
                                                    selected
                                                >
                                                    Month
                                                </option>
                                                <option
                                                    v-for="(
                                                        month, index
                                                    ) in months"
                                                    :key="index"
                                                    :value="index + 1"
                                                >
                                                    {{ month }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col l6 s6 mt-1">
                                            <date-picker
                                                v-model:value="
                                                    residency.yearEnd
                                                "
                                                @change="removeLabel($event, 7)"
                                                type="year"
                                                placeholder="Year"
                                            ></date-picker>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="row" id="fellowship">
                            <h4 class="sectionTitle col s12">
                                Fellowship program
                            </h4>
                            <div class="row">
                                <div class="col s12">
                                    <label for="Name of institution"
                                        >Name of institution</label
                                    >
                                    <input
                                        placeholder="Name of institution"
                                        type="text"
                                        class="validate browser-default mt-1"
                                        v-model="fellowship.institution"
                                        @keyup="removeLabel($event)"
                                    />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col l6 s6">
                                    <label> When did you start? </label>
                                    <div class="row">
                                        <div class="col l6 s6">
                                            <select
                                                class="validate mt-1 browser-default"
                                                v-model="fellowship.monthStart"
                                                @change="removeLabel($event)"
                                            >
                                                <option
                                                    :value="''"
                                                    disabled
                                                    selected
                                                >
                                                    Month
                                                </option>
                                                <option
                                                    v-for="(
                                                        month, index
                                                    ) in months"
                                                    :key="index"
                                                    :value="index + 1"
                                                >
                                                    {{ month }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col l6 s6 mt-1">
                                            <date-picker
                                                v-model:value="
                                                    fellowship.yearStart
                                                "
                                                @change="removeLabel($event, 8)"
                                                type="year"
                                                placeholder="Year"
                                            ></date-picker>
                                        </div>
                                    </div>
                                </div>

                                <div class="col s6">
                                    <label> When did you finish? </label>
                                    <div class="row">
                                        <div class="col l6 s6">
                                            <select
                                                class="validate mt-1 browser-default"
                                                v-model="fellowship.monthEnd"
                                                @change="removeLabel($event)"
                                            >
                                                <option
                                                    :value="''"
                                                    disabled
                                                    selected
                                                >
                                                    Month
                                                </option>
                                                <option
                                                    v-for="(
                                                        month, index
                                                    ) in months"
                                                    :key="index"
                                                    :value="index + 1"
                                                >
                                                    {{ month }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col l6 s6 mt-1">
                                            <date-picker
                                                v-model:value="
                                                    fellowship.yearEnd
                                                "
                                                @change="removeLabel($event, 9)"
                                                type="year"
                                                placeholder="Year"
                                            ></date-picker>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section
                            class="row"
                            id="additionalSchool"
                            v-if="tenantOnDemand == 1"
                        >
                            <h4 class="sectionTitle">Interests</h4>
                            <p v-if="maxSelected != ''">
                                {{ maxSelected }}
                            </p>
                            <div class="grid">
                                <div
                                    class="pills"
                                    :class="{
                                        selected: selectedIndex.includes(index),
                                    }"
                                    v-for="(interest, index) in interests"
                                    :key="interest.id"
                                >
                                    <p
                                        @click="
                                            getSelectedInterests(
                                                interest,
                                                index
                                            )
                                        "
                                    >
                                        {{ interest.title }}
                                    </p>
                                    <i
                                        @click="
                                            removeFromSelected(interest, index)
                                        "
                                        v-show="selectedIndex.includes(index)"
                                        class="material-icons removeInterest"
                                        >close</i
                                    >
                                </div>
                            </div>
                        </section>

                        <section class="row" id="specialty">
                            <div class="col s12 sm-mt-1">
                                <label>Select specialty</label>
                                <select
                                    v-model="specialty"
                                    required
                                    class="browser-default custom-select mt-1 black-text"
                                    data-label="true"
                                    @change="switchText($event)"
                                >
                                    <option :value="''" disabled selected>
                                        Sub Specialty
                                    </option>
                                    <option
                                        v-for="specialty in specialties"
                                        :key="specialty.id"
                                        :value="specialty"
                                    >
                                        {{ specialty.title }}
                                    </option>
                                </select>
                            </div>
                        </section>
                        <div
                            class="flex justify-center align-center flex-col mt-4"
                        >
                            <button
                                type="button"
                                class="customNextBtn waves waves-effect btn"
                                @click="saveAll"
                            >
                                Save &amp; Publish
                            </button>
                            <p class="pubSupportText">
                                After publishing your website, you can still do
                                more editing and customization
                            </p>
                        </div>
                    </div>
                </div>
                <div class="absolute bottom-0">
                    <p class="m-0 copyright">
                        Copyright &copy; {{ new Date().getFullYear() }},
                        Whitecoatdomain.
                    </p>
                </div>
            </div>
        </div>
        <div id="successWebCr8Modal" class="modal">
            <div class="modal-dialog modal-confirm">
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                        <div class="icon-box">
                            <i class="material-icons">&#xE876;</i>
                        </div>
                    </div>
                    <div class="modal-body text-center">
                        <h4>Great!</h4>
                        <p>Your account has been created successfully, you will receive an email shortly with instructions to setup your personal website.</p>
                        <button class="btn btn-success" :disabled="clicked" data-dismiss="modal" @click="startExploring">
                            <span>Start Exploring</span>
                            <i class="material-icons">&#xE5C8;</i>
                        </button>
                        <p class="timer" v-if="clicked">
                            Redirecting you to your site in
                            {{ countdown }}s
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    let env = process.env.MIX_APP_ENV;
    let domain = "whitecoatdomain.com";
    import InnerFooter from "../partials/InnerFooterComponent.vue";
    import DatePicker from "vue-datepicker-next";
    import "vue-datepicker-next/index.css";
    import PaymentModalComponent from "../partials/PaymentModalComponent.vue";
    import ProgressComponent from "../partials/ProgressComponent.vue";
    import GoLiveComponent from "../partials/GoLiveComponent.vue";
    import OtpComponent from "../partials/OtpComponent.vue";
    import DomainInputComponent from "../partials/DomainInputComponent.vue";
    import ImageUploaderComponent from "../partials/ImageUploaderComponent.vue";
    export default {
        components: {
            PaymentModalComponent,
            InnerFooter,
            DatePicker,
            ProgressComponent,
            GoLiveComponent,
            OtpComponent,
            DomainInputComponent,
            ImageUploaderComponent,
        },

        data() {
            return {
                otpMode: false,
                clicked: false,
                failedPic: false,
                medText: "Medical",
                cvMedSchoolUpdate: 0,
                underGradUpdate: 0,
                additionalSchoolUpdate: 0,
                internUpdate: 0,
                residencyUpdate: 0,
                fellowshipUpdate: 0,
                view: 0,
                step: 0,
                bio: {
                    firstname: "",
                    lastname: "",
                    othername: "Othername",
                    title_id: "",
                    photo: null,
                },
                countdown: 10,
                domainSelected: "",
                bioData: {},
                initialDomain: "",
                internship: {
                    institution: "",
                    yearStart: "",
                    yearEnd: "",
                    monthStart: "",
                    monthEnd: "",
                },
                updateUserData: 0,
                uploaded: null,
                uploadPhotoProcessing: false,
                underGrad: {
                    institution: "",
                    yearStart: "",
                    yearEnd: "",
                    monthStart: "",
                    monthEnd: "",
                    major: "",
                    minor: "",
                },
                medSchool: {
                    institution: "",
                    yearStart: "",
                    yearEnd: "",
                    monthStart: "",
                    monthEnd: "",
                },
                additionalSchool: {
                    institution: "",
                    yearStart: "",
                    yearEnd: "",
                    monthStart: "",
                    monthEnd: "",
                    degree: "",
                },
                fellowship: {
                    institution: "",
                    yearStart: "",
                    yearEnd: "",
                    monthStart: "",
                    monthEnd: "",
                },
                residency: {
                    institution: "",
                    yearStart: "",
                    yearEnd: "",
                    monthStart: "",
                    monthEnd: "",
                },
                months: [
                    "JAN",
                    "FEB",
                    "MAR",
                    "APR",
                    "MAY",
                    "JUN",
                    "JUL",
                    "AUG",
                    "SEP",
                    "OCT",
                    "NOV",
                    "DEC",
                ],
                tenantId: null,
                showGoLiveBtns: true,
                academicCheck: 0,
                attendedSchInfo: 0,
                attendedMedSch: 0,
                internshipCheck: 0,
                fellowshipCheck: 0,
                residencyCheck: 0,
                addQualificaion: 0,
                setModal: false,
                user: 0,
                acadRoute: 0,
                interests: [],
                selectedInterests: [],
                services: [],
                selectedIndex: [],
                maxSelected: "",

                inputEmail: this.email,
                verificationLoading: false,
                otp: "",
                specialty: "",
                specialties: [],
            };
        },
        mounted() {
            this.getTenantNDomain();
            this.getData();
            this.getInterests();
            this.getSpecialties();
            if (this.email != '') {
                this.view = 1;
            }
            // document.addEventListener("DOMContentLoaded", function () {
            //     let elems = document.querySelector("#modal1");
            //     let options = {
            //         dismissible: false,
            //     };
            //     let instances = M.Modal.init(elems, options);
            // });
        },
        methods: {
            checkEmail() {
                if (this.inputEmail === "") {
                    M.toast({
                        html: "Please input your email.",
                        classes: "errorNotifier",
                    });
                } else {
                    this.verificationLoading = true;
                    let data = {
                        email: this.inputEmail,
                    };
                    axios
                        .post("/auth/verifyEmailForRegistration", data)
                        .then((res) => {
                            if (res.status === 200) {
                                if (res.data.status == 200) {
                                    this.otp = res.data.otp;
                                    this.otpMode = true;
                                } else if (res.data.status == 404) {
                                    M.toast({
                                        html: res.data.error,
                                        classes: "errorNotifier",
                                    });
                                }
                                this.verificationLoading = false;
                            }
                        })
                        .catch((err) => {
                            console.log(err.response);
                        });
                }
            },
            changeView(e) {
                console.log(e);
                if (e == 200) {
                    // Save the user with email
                    // Login user temporary to be able to access route
                    const urlParams = new URLSearchParams(window.location.search);
                    const code = urlParams.get("code");
                    const tenantId = urlParams.get("claimable");
                    axios
                        .get(`/guest-login/${code}`)
                        .then((res) => {
                            console.log(res);
                        })
                        .catch((err) => {
                            console.log(err);
                        });
                    axios
                        .put(`/admin_order/${tenantId}`, { email: this.inputEmail })
                        .then((res) => {
                            if (res.status == 200) {
                                M.toast({
                                    html: 'Email verified !',
                                    classes: 'successNotifier'
                                });
                                this.view = 1;
                            }
                        })
                        .catch((err) => {
                            console.log(err);
                        });
                }
            },
            imageChosen(e) {
                this.bio.photo = e;
                document
                    .getElementById("profile-picture")
                    .querySelector(".button")
                    .classList.remove("empty-input");
                this.updatePhoto(e);
            },
            serviceSaveOrUpdate() {
                this.loading = !this.loading;
                let request = `/claim/save/service`;
                let formData = new FormData();
                formData.append("data", JSON.stringify(this.selectedInterests));
                axios
                    .post(request, formData)
                    .then((res) => {
                        if (res.status == 201 || res.data.status == 200) {
                            M.toast({
                                html: res.data.message,
                                classes: "successNotifier",
                            });
                            if (res.status == 201) {
                                for (const key in this.selectedInterests) {
                                    if (
                                        this.selectedInterests.hasOwnProperty(key)
                                    ) {
                                        console.log(
                                            `${key}: ${this.selectedInterests[key]}`
                                        );
                                        // this.services.unshift(this.selectedInterests[key])
                                    }
                                }
                            }
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
            getSelectedInterests(evt, index) {
                if (this.selectedInterests.length < 3) {
                    if (!this.selectedInterests.includes(evt)) {
                        this.selectedIndex.push(index);
                        this.selectedInterests.push(evt);
                    }
                } else {
                    // Get a class to make those pills grey
                    this.maxSelected = "You can select max. of 3";
                }
            },
            removeFromSelected(interest, index) {
                this.selectedInterests.splice(
                    this.selectedInterests.indexOf(interest),
                    1
                );
                this.selectedIndex.splice(this.selectedIndex.indexOf(index), 1);
                console.log(this.selectedInterests, this.selectedIndex);
            },
            getInterests() {
                axios
                    .get(`https://whitecoatdomain.com/api/interests`)
                    .then((res) => {
                        this.interests = res.data.interests;
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            },
            getSpecialties() {
                axios.get('/api/specialties').then(res => {
                    this.specialties = res.data.specialties;
                }).catch(err => {
                    console.log(err);
                })
            },
            checkTenantOnDemand() {
                if (this.tenantOnDemand == 1 && this.bio.photo == undefined) {
                    let title =
                        this.bio.title_id != ""
                            ? this.titles.find((el) => el.id == this.bio.title_id)
                                  .name
                            : "";
                    let firstname =
                        this.bio.firstname != "" ? this.bio.firstname : "";
                    let lastname = this.bio.lastname != "" ? this.bio.lastname : "";
                    this.domainSelected = (
                        "Dr" +
                        firstname.substring(0, 1) +
                        lastname +
                        title +
                        ".com"
                    ).toLocaleLowerCase();
                }
            },
            saveAll() {
                this.underGrad.minor === "" || this.underGrad.minor === null
                    ? delete this.underGrad.minor
                    : null;
                this.bio.othername === "" || this.bio.othername === null
                    ? delete this.bio.othername
                    : null;
                this.bioData.othername === "" || this.bioData.othername === null
                    ? delete this.bioData.othername
                    : null;
                this.failedPic = this.bioData.photo == null ? true : false;
                if (
                    this.validator(this.additionalSchool) &&
                    this.validator(this.fellowship) &&
                    this.validator(this.residency) &&
                    this.validator(this.internship) &&
                    this.validator(this.medSchool) &&
                    this.validator(this.underGrad) &&
                    this.validator(this.bio) &&
                    this.domainSelected !== "" &&
                    this.specialty !== ""
                ) {
                    // && this.validator(this.domainSelected))
                    try {
                        this.registerUpdateUser();
                        this.saveUndergradSchoolTime();
                        this.saveMedSchoolTime();
                        this.saveInternshipTime();
                        this.saveFellowshipTime();
                        this.saveResidencyTime();
                        this.saveAdditionalSchoolTime();
                        this.updateBio();
                        this.updateDomain();
                        this.serviceSaveOrUpdate();
                        this.saveUpdateTemplate();
                    } catch (error) {
                        M.toast({
                            html: error,
                            classes: "errorNotifier",
                        });
                    } finally {
                        M.toast({
                            html: "Success",
                            classes: "successNotifier",
                        });
                        this.sendEmail();
                        let successWebCr8Modal =
                            document.getElementById("successWebCr8Modal");
                        let modal = M.Modal.init(successWebCr8Modal);
                        modal.open();
                        // this.popup();
                    }
                } else {
                    this.validationException();
                }
            },
            startExploring() {
                // this.view = 2;
                this.clicked = true;
                this.timerStart();
            },
            switchText(val) {
                let valText;
                this.removeLabel(val);
                if (!val) {
                    val = document.querySelector("#userTitle");
                    valText = val.selectedOptions[0].innerText;
                } else valText = val.target.selectedOptions[0].innerText;
                if (valText === "DD") {
                    this.medText = "Dental";
                } else {
                    this.medText = "Medical";
                }
            },
            getData() {
                axios
                    .get("/claim/data")
                    .then((res) => {
                        if (res.data.medschool !== null) {
                            let e = res.data.medschool;
                            this.medSchool = e;
                            this.medSchool.yearStart = new Date(`${e.yearStart}`);
                            this.medSchool.yearEnd = new Date(`${e.yearEnd}`);
                            this.cvMedSchoolUpdate = 1;
                        }
                        if (res.data.undergrad !== null) {
                            let e = res.data.undergrad;
                            this.underGrad = e;
                            this.underGrad.yearStart = new Date(`${e.yearStart}`);
                            this.underGrad.yearEnd = new Date(`${e.yearEnd}`);
                            this.underGradUpdate = 1;
                        }
                        if (res.data.otheredu !== null) {
                            let e = res.data.otheredu;
                            this.additionalSchool = e;
                            delete this.additionalSchool.title;
                            this.additionalSchool.yearStart = new Date(
                                `${e.yearStart}`
                            );
                            this.additionalSchool.yearEnd = new Date(
                                `${e.yearEnd}`
                            );
                            this.additionalSchoolUpdate = 1;
                        }
                        let expo = res.data.experiences[0];
                        res.data.experiences.length !== 0
                            ? ((this.experiences = expo),
                              (this.experiences.yearStart = new Date(
                                  `${expo.yearStart}`
                              )),
                              (this.experiences.yearEnd = new Date(
                                  `${expo.yearEnd}`
                              )),
                              (this.experienceUpdate = 1))
                            : null;
                        // Trainings
                        let internship = res.data.trainings.find(
                            (el) => el.type === "internship"
                        );
                        let fellowship = res.data.trainings.find(
                            (el) => el.type === "fellowship"
                        );
                        let residency = res.data.trainings.find(
                            (el) => el.type === "residency"
                        );
                        internship !== undefined
                            ? ((this.internship.institution =
                                  internship.institution),
                              (this.internship.monthStart = internship.monthStart),
                              (this.internship.yearStart = internship.yearStart),
                              (this.internship.monthEnd = internship.monthEnd),
                              (this.internship.yearEnd = internship.yearEnd),
                              (this.internUpdate = 1),
                              (this.internship.yearStart = new Date(
                                  `${internship.yearStart}`
                              )),
                              (this.internship.yearEnd = new Date(
                                  `${internship.yearEnd}`
                              )))
                            : null;
                        fellowship !== undefined
                            ? ((this.fellowship.institution =
                                  fellowship.institution),
                              (this.fellowship.monthStart = fellowship.monthStart),
                              (this.fellowship.yearStart = fellowship.yearStart),
                              (this.fellowship.monthEnd = fellowship.monthEnd),
                              (this.fellowship.yearEnd = fellowship.yearEnd),
                              (this.fellowshipUpdate = 1),
                              (this.fellowship.yearStart = new Date(
                                  `${fellowship.yearStart}`
                              )),
                              (this.fellowship.yearEnd = new Date(
                                  `${fellowship.yearEnd}`
                              )))
                            : null;
                        residency !== undefined
                            ? ((this.residency.institution = residency.institution),
                              (this.residency.monthStart = residency.monthStart),
                              (this.residency.yearStart = residency.yearStart),
                              (this.residency.monthEnd = residency.monthEnd),
                              (this.residency.yearEnd = residency.yearEnd),
                              (this.residencyUpdate = 1),
                              (this.residency.yearStart = new Date(
                                  `${residency.yearStart}`
                              )),
                              (this.residency.yearEnd = new Date(
                                  `${residency.yearEnd}`
                              )))
                            : null;
                        this.switchText();
                        res.data.services.length > 0
                            ? (this.services = res.data.services)
                            : [];
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
            makePayment() {
                let paymentModal = document.getElementById("paymentModal");
                let paymentModalInstance = M.Modal.init(paymentModal);
                this.setModal = true;
                paymentModalInstance.open();
            },
            popupClose() {
                if (document.getElementById("popup").style.display == "block") {
                    document.getElementById("popup").style.display = "none";
                    document.getElementById("page").style.display = "none";
                    document.getElementById("page").className = "";
                }
            },
            getStarted() {
                this.view = 1;
            },
            getTenantNDomain() {
                axios
                    .get("/claim/getTenantDomain")
                    .then((res) => {
                        if (res.data.status == 200) {
                            this.domainSelected =
                                this.bio.firstname == "" && this.tenantOnDemand == 1
                                    ? ""
                                    : `${res.data.domain}.com`;
                            this.initialDomain = res.data.domain;
                            this.tenantId = res.data.tenantID;
                        }
                    })
                    .catch((err) => console.log(err));
            },
            generateSuggestions() {
                let wordList = [
                    this.bio.firstname,
                    this.bio.lastname,
                    this.bio.othername,
                    title[0].name,
                ];
                let shuffledList = wordList.slice();
                shuffledList = shuffledList.sort(() => Math.random() - 0.5);
                const sentenceLength =
                    Math.floor(Math.random() * shuffledList.length) + 1;
                const sentence = shuffledList.slice(0, sentenceLength).join("");
                return sentence;
            },
            parseClaimaintData(dataToParse) {
                let data = JSON.parse(dataToParse);
                this.bioData = data.length === undefined ? data : data[0];
                this.bio.firstname = this.bioData.firstname;
                this.bio.lastname = this.bioData.lastname;
                this.bio.othername = this.bioData.othername;
                this.bio.title_id =
                    this.bioData.title_id === null ? "" : this.bioData.title_id;
                this.bio.photo = this.bioData.photo;
                this.bio.id = this.bioData.id;
            },
            passwordGenerator() {
                var chars =
                    "0123456789abcdefghijklmnopqrstuvwxyz!@#$%^&*()ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                var passwordLength = 12;
                var password = "";
                for (var i = 0; i <= passwordLength; i++) {
                    var randomNumber = Math.floor(Math.random() * chars.length);
                    password += chars.substring(randomNumber, randomNumber + 1);
                }
                return password;
            },
            saveUpdateTemplate() {
                axios
                    .put(`/claim/updateDomain/tenant`, {
                        // Change to template id based on selection
                        template: this.specialty.templates[0].id,
                    })
                    .then((res) => {
                        if (res.data.status == 200) {
                            this.initialDomain = res.data.domain.domain;
                            return true;
                        }
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            },
            // If user clicks on next for the view 1 register user or update details
            registerUpdateUser() {
                if (
                    this.bio.firstname === "" ||
                    this.bio.lastname === "" ||
                    this.bio.title_id === (null || "")
                ) {
                    document.querySelector("#userTitle").required = true;
                    M.toast({
                        html: "Please fufill all input",
                        classes: "errorNotifier",
                    });
                } else {
                    if (
                        this.bio.lastname != this.bioData.lastname ||
                        this.bio.firstname != this.bioData.firstname ||
                        this.bio.othername != this.bioData.othername ||
                        this.bio.title_id != this.bioData.title_id
                    ) {
                        if (this.updateUserData == 0) {
                            let data = {
                                password: this.passwordGenerator(),
                            };
                            localStorage.setItem("passwordGen", data.password);
                            this.bio = { ...this.bio, ...data };
                        }
                        axios
                            .post("/claim/saveuser", this.bio)
                            .then((res) => {
                                if (
                                    res.data.status == 200 ||
                                    res.data.status == 201
                                ) {
                                    M.toast({
                                        html: res.data.msg,
                                        classes: "successNotifier",
                                    });
                                    localStorage.setItem(
                                        "passwordGen",
                                        this.bio.password
                                    );
                                }
                            })
                            .catch((err) => {
                                console.log(err);
                            });
                    }
                }
            },

            saveUndergradSchoolTime() {
                if (
                    (this.underGrad.institution != "" ||
                        this.underGrad.yearEnd != "" ||
                        this.underGrad.monthEnd != "" ||
                        this.underGrad.major != "" ||
                        this.underGrad.yearStart != "" ||
                        this.underGrad.monthStart != "") &&
                    this.underGradUpdate === 0
                ) {
                    this.underGrad.yearStart != ""
                        ? (this.underGrad.yearStart =
                              this.underGrad.yearStart.getFullYear())
                        : null;
                    this.underGrad.yearEnd != ""
                        ? (this.underGrad.yearEnd =
                              this.underGrad.yearEnd.getFullYear())
                        : null;
                    axios
                        .post("/claim/saveUndergrad", this.underGrad)
                        .then((res) => {
                            if (res.data.status == 201) {
                                return true;
                            }
                        })
                        .catch((err) => {
                            console.log(err);
                        });
                }
            },
            saveAdditionalSchoolTime() {
                if (
                    (this.additionalSchool.institution != "" ||
                        this.additionalSchool.yearEnd != "" ||
                        this.additionalSchool.monthEnd != "" ||
                        this.additionalSchool.degree != "" ||
                        this.additionalSchool.yearStart != "" ||
                        this.additionalSchool.monthStart != "") &&
                    this.additionalSchoolUpdate === 0
                ) {
                    if (this.validator(this.additionalSchool)) {
                        this.additionalSchool.yearStart != ""
                            ? (this.additionalSchool.yearStart =
                                  this.additionalSchool.yearStart.getFullYear())
                            : null;
                        this.additionalSchool.yearEnd != ""
                            ? (this.additionalSchool.yearEnd =
                                  this.additionalSchool.yearEnd.getFullYear())
                            : null;
                        axios
                            .post(
                                "/claim/save/additonalqualification",
                                this.additionalSchool
                            )
                            .then((res) => {
                                if (res.data.status == 201) {
                                    this.additionalSchool.id = res.data.id;
                                    return true;
                                }
                            })
                            .catch((err) => {
                                console.log(err);
                            });
                    } else {
                        this.additionalSchoolException = true;
                        this.validationException();
                    }
                }
            },
            saveMedSchoolTime() {
                if (
                    (this.medSchool.institution != "" ||
                        this.medSchool.yearEnd != "" ||
                        this.medSchool.monthEnd != "" ||
                        this.medSchool.yearStart != "" ||
                        this.medSchool.monthStart != "") &&
                    this.cvMedSchoolUpdate === 0
                ) {
                    this.medSchool.yearStart != ""
                        ? (this.medSchool.yearStart =
                              this.medSchool.yearStart.getFullYear())
                        : null;
                    this.medSchool.yearEnd != ""
                        ? (this.medSchool.yearEnd =
                              this.medSchool.yearEnd.getFullYear())
                        : null;
                    axios
                        .post("/claim/savemedicalschooltime", this.medSchool)
                        .then((res) => {
                            if (res.data.status == 201) {
                                return true;
                            }
                        })
                        .catch((err) => {
                            console.log(err);
                        });
                }
            },
            saveInternshipTime() {
                if (
                    (this.residency.institution != "" ||
                        this.internship.yearStart != "" ||
                        this.internship.monthStart != "") &&
                    this.internUpdate === 0
                ) {
                    this.internship.yearStart != ""
                        ? (this.internship.yearStart =
                              this.internship.yearStart.getFullYear())
                        : null;
                    this.internship.yearEnd != ""
                        ? (this.internship.yearEnd =
                              this.internship.yearEnd.getFullYear())
                        : null;
                    this.internship.type = "internship";
                    axios
                        .post("/claim/saveinternship", this.internship)
                        .then((res) => {
                            if (res.data.status == 201) {
                                this.internship.yearStart = new Date(
                                    `${this.internship.yearStart}`
                                );
                                this.internship.yearEnd = new Date(
                                    `${this.internship.yearEnd}`
                                );
                                return true;
                            }
                        })
                        .catch((err) => {
                            console.log(err);
                        });
                }
            },
            saveFellowshipTime() {
                if (
                    (this.fellowship.institution != "" ||
                        this.fellowship.yearEnd != "" ||
                        this.fellowship.monthEnd != "" ||
                        this.fellowship.yearStart != "" ||
                        this.fellowship.monthStart != "") &&
                    this.fellowshipUpdate === 0
                ) {
                    this.fellowship.yearStart != ""
                        ? (this.fellowship.yearStart =
                              this.fellowship.yearStart.getFullYear())
                        : null;
                    this.fellowship.yearEnd != ""
                        ? (this.fellowship.yearEnd =
                              this.fellowship.yearEnd.getFullYear())
                        : null;
                    this.fellowship.type = "fellowship";
                    axios
                        .post("/claim/savefellowship", this.fellowship)
                        .then((res) => {
                            if (res.data.status == 201) {
                                this.fellowship.yearStart = new Date(
                                    `${this.fellowship.yearStart}`
                                );
                                this.fellowship.yearEnd = new Date(
                                    `${this.fellowship.yearEnd}`
                                );
                                return true;
                            }
                        })
                        .catch((err) => {
                            console.log(err);
                        });
                }
            },
            saveResidencyTime() {
                if (
                    (this.residency.institution != "" ||
                        this.residency.yearStart != "" ||
                        this.residency.monthStart != "") &&
                    this.residencyUpdate === 0
                ) {
                    this.residency.yearStart != ""
                        ? (this.residency.yearStart =
                              this.residency.yearStart.getFullYear())
                        : null;
                    this.residency.yearEnd != ""
                        ? (this.residency.yearEnd =
                              this.residency.yearEnd.getFullYear())
                        : null;
                    this.residency.type = "residency";
                    axios
                        .post("/claim/saveresidency", this.residency)
                        .then((res) => {
                            if (res.data.status == 201) {
                                this.residency.yearStart = new Date(
                                    `${this.residency.yearStart}`
                                );
                                this.residency.yearEnd = new Date(
                                    `${this.residency.yearEnd}`
                                );
                                return true;
                            }
                        })
                        .catch((err) => {
                            console.log(err);
                        });
                }
            },
            // If the user decides to alter the first view, update the tenant part
            updateBio(e) {
                if (
                    this.bio.firstname === "" ||
                    this.bio.lastname === "" ||
                    this.bio.title_id === (null || "")
                ) {
                    document.querySelector("#userTitle").required = true;
                } else {
                    if (
                        this.bio.lastname != this.bioData.lastname ||
                        this.bio.firstname != this.bioData.firstname ||
                        this.bio.othername != this.bioData.othername ||
                        this.bio.title_id != this.bioData.title_id
                    ) {
                        axios
                            .put("/claim/updatebio", this.bio)
                            .then((res) => {
                                if (res.data.status == 200) {
                                    localStorage.setItem(
                                        "claimproc",
                                        JSON.stringify([res.data.user])
                                    );
                                    this.bioData = res.data.user;
                                }
                            })
                            .catch((err) => {
                                console.log(err);
                            });
                    }
                }
            },
            newDomain(domain) {
                this.domainSelected = domain;
            },
            updateDomain() {
                if (this.initialDomain + ".com" !== this.domainSelected) {
                    axios
                        .put(`/claim/updateDomain/tenant`, {
                            domain: this.domainSelected,
                        })
                        .then((res) => {
                            if (res.data.status == 200) {
                                this.initialDomain = res.data.domain.domain;
                                return true;
                            }
                        })
                        .catch((err) => {
                            console.log(err);
                        });
                }
            },
            updatePhoto(e) {
                this.uploadPhotoProcessing = true;
                let formData = new FormData();
                formData.append("photo", e);
                formData.append("_method", "PUT");
                this.bio.id === undefined
                    ? null
                    : formData.append("id", this.bioData.id);
                axios
                    .post("/claim/updateAvatar/bio", formData)
                    .then((res) => {
                        if (res.data.status == 200) {
                            M.toast({
                                html: res.data.message,
                                classes: "successNotifier",
                            });
                            localStorage.setItem(
                                "claimproc",
                                JSON.stringify([res.data.bio])
                            );
                            this.bio.id = res.data.bio.id;
                            this.bio.image_changed = 1;
                            this.uploadPhotoProcessing = false;
                            this.showCropper = false;
                            this.uploaded = e;
                        }
                    })
                    .catch((err) => {
                        if (err.response.status == 400) {
                            err.response.data.forEach((el) => {
                                M.toast({
                                    html: el,
                                    classes: "errorNotifier",
                                });
                            });
                        }
                        if (err.response.status == 413) {
                            M.toast({
                                html: err.response.statusText,
                                classes: "errorNotifier",
                            });
                        }
                        this.uploadPhotoProcessing = false;
                        console.log(err);
                    });
            },
            timerStart(e) {
                this.showGoLiveBtns = false;
                this.countdownTimer();
            },
            popup(val) {
                let domainSelected = this.domainSelected.replace(".com", "");
                document.getElementById("popup").showpopup = function () {
                    document.getElementById("popup").style.display = "block";
                    // domainSelected = 'mdemmapowerful'
                    document.getElementById(
                        "iframe"
                    ).src = `https://${domainSelected}.${domain}`;
                    document.getElementById("iframe").srcdoc =
                        '<!DOCTYPE html><div class="loader"></div>';
                    document
                        .getElementById("iframe")
                        .addEventListener("load", () =>
                            iframe.removeAttribute("srcdoc")
                        );
                    document.getElementById("page").className = "darken";
                    document.getElementById("page").style.display = "block";
                };
                document.getElementById("popup").showpopup();
            },
            sendEmail(val) {
                /**
                 * What this does is to get the saved dummy password for the user and whatever plan he chose and send details
                 * to the user, getting the email from the session on the server and sending to him
                 */

                let data = {
                    plan: "F",
                    password: localStorage.getItem("passwordGen"),
                    domain: this.domainSelected.replace(".com", ""),
                    tenantOnDemand: this.tenantOnDemand,
                };
                axios
                    .post("/claim/successdomainregistra", data)
                    .then((res) => {
                        if (res.status == 201) {
                            M.toast({
                                html: res.data.message,
                                classes: "successNotifier",
                            });

                            this.user = res.data.user;
                            localStorage.removeItem("claimproc");
                            localStorage.removeItem("passwordGen");
                            localStorage.removeItem("email");
                        }
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            },
            countdownTimer() {
                if (this.countdown > 0) {
                    setTimeout(() => {
                        this.countdown -= 1;
                        this.countdownTimer();
                    }, 1000);
                } else {
                    let domainSelected = this.domainSelected.replace(".com", "");
                    location.replace(`https://${domainSelected}.${domain}`);
                }
            },
            validator(obj) {
                // Passes an object of data
                // Checks that each item in the object is filled
                // Else each object should be empty
                // If empty for any of the object, get the label and red it out
                // Refuse update or edit for other fields
                let nonEmptyKey = null;
                for (var key in obj) {
                    if (!obj.hasOwnProperty(key)) {
                        continue;
                    }
                    if (obj[key]) {
                        nonEmptyKey = key;
                        break;
                    }
                }
                if (nonEmptyKey === null) {
                    return true;
                }
                for (var key in obj) {
                    if (!obj.hasOwnProperty(key) || key === nonEmptyKey) {
                        continue;
                    }
                    if (!obj[key]) {
                        return false;
                    }
                }
                return true;
            },
            validationException() {
                if (!this.validator(this.additionalSchool)) {
                    this.loopInputsNCheckEmptyValues("additionalSchool");
                    this.getOffset("additionalSchool");
                }
                if (!this.validator(this.fellowship)) {
                    this.loopInputsNCheckEmptyValues("fellowship");
                    this.getOffset("fellowship");
                }
                if (!this.validator(this.residency)) {
                    this.loopInputsNCheckEmptyValues("residency");
                    this.getOffset("residency");
                }
                if (!this.validator(this.internship)) {
                    this.loopInputsNCheckEmptyValues("internship");
                    this.getOffset("internship");
                }
                if (!this.validator(this.medSchool)) {
                    this.loopInputsNCheckEmptyValues("medSchool");
                    this.getOffset("medSchool");
                }
                if (!this.validator(this.underGrad)) {
                    this.loopInputsNCheckEmptyValues("underGrad");
                    this.getOffset("underGrad");
                }
                if (!this.validator(this.bio)) {
                    this.loopInputsNCheckEmptyValues("bio");
                    this.getOffset("bio");
                }
                if (this.domainSelected === "") {
                    this.loopInputsNCheckEmptyValues("domain");
                    this.getOffset("domain");
                }
                if (this.specialty === "") {
                    this.loopInputsNCheckEmptyValues("specialty");
                    this.getOffset("specialty");
                }
            },
            removeLabel(el) {
                el.target.classList.remove("empty-input");
            },
            loopInputsNCheckEmptyValues(id) {
                let mySection = document.querySelector(`#${id}`);
                let inputSelect = mySection.querySelectorAll("input, select");
                inputSelect.forEach((input) => {
                    if (!input.value && !input.hasAttribute("data-optional")) {
                        input.required = true;
                        input.classList.add("empty-input");
                    } else if (this.bio.photo === null) {
                        document
                            .getElementById("profile-picture")
                            .querySelector(".button")
                            .classList.add("empty-input");
                    } else {
                        document
                            .getElementById("profile-picture")
                            .querySelector(".button")
                            .classList.remove("empty-input");
                        input.classList.remove("empty-input");
                    }
                });
            },
            getOffset(el) {
                let DOMEL = document.querySelector(`#${el}`);
                DOMEL.scrollIntoView({ behavior: "smooth" });
            },
        },
        props: {
            claimaint: String,
            titles: Array,
            claimant: String,
            countries: Array,
            tenantOnDemand: Number,
            email: String,
        },
        watch: {
            claimant: {
                immediate: true,
                handler(val, oldval) {
                    // console.log(val, oldval, 'o');
                    if (oldval == undefined && val != "")
                        this.parseClaimaintData(this.claimant);
                },
            },
            claimaint: {
                immediate: true,
                handler(val, oldval) {
                    // console.log(val, oldval, 'l');
                    if (oldval == undefined && val != null)
                        this.parseClaimaintData(this.claimaint);
                },
            },
            email: {
                handler(val, oldVal) {
                    this.inputEmail = val;
                }
            }
        },
    };
</script>
<style scoped>
    .background {
        height: 80vh;
        background: lightblue;
        width: 80vw;
        padding: 0 5vw;
        border-radius: 10px;
    }
    .custom-button {
        height: 40px;
        width: 160px;
        font-weight: 600;
        outline: none;
        border: none;
        margin-top: 3vh;
        box-shadow: 0px 4px 19px #109DAD;
        border-radius: 10px;
    }
    .paymentOverlay {
        position: absolute;
        height: 100vh;
        width: 90%;
        margin: 0 4%;
        justify-content: center;
        align-items: center;
        background-color: rgba(0, 0, 0, 0.75);
    }
    .btn {
        background-color: var(--pri) !important;
    }
    /* Start popup */
    #popup {
        display: none;
        border: 1px black solid;
        width: 95%;
        height: 97%;
        top: 20px;
        left: 50%;
        background-color: white;
        z-index: 10;
        padding: 2em;
        position: fixed;
        transform: translate(-50%);
    }

    #page {
        display: none;
        width: 100%;
        height: 100%;
        top: 0px;
        left: 0px;
        z-index: 9;
        padding: 2em;
        position: absolute;
    }
    iframe {
        width: 100% !important;
    }
    #iframe {
        border: 0;
        height: 100%;
        width: 100%;
    }

    html,
    body,
    #page {
        height: 100%;
    }
    /* End Popup */
    .flex {
        display: flex;
    }
    .mb-0 {
        margin-bottom: 0;
    }

    #cs {
        width: 3rem;
        border-bottom: 0;
        text-decoration: underline;
        color: rgb(160, 88, 88);
    }
    #cs::placeholder {
        color: rgb(231, 111, 111);
    }
    .modal-content {
        padding-bottom: 0px;
    }
    #modal1 {
        transform: translateY(-50%) scaleX(1) !important;
        top: 50% !important;
    }

    .modal-confirm,
    #successWebCr8Modal {
        color: #434e65;
        width: 525px;
    }
    .modal-confirm .modal-content {
        padding: 20px;
        font-size: 16px;
        border-radius: 5px;
        border: none;
        text-align: center;
    }
    .modal-confirm .modal-header {
        background: #47c9a2;
        border-bottom: none;
        position: relative;
        text-align: center;
        margin: -20px -20px 0;
        border-radius: 5px 5px 0 0;
        padding: 35px;
    }
    .modal-confirm h4 {
        text-align: center;
        font-size: 36px;
        margin: 10px 0;
    }
    .modal-confirm .form-control,
    .modal-confirm .btn {
        min-height: 40px;
        border-radius: 3px;
    }
    .modal-confirm .close {
        position: absolute;
        top: 15px;
        right: 15px;
        color: #fff;
        text-shadow: none;
        opacity: 0.5;
    }
    .modal-confirm .close:hover {
        opacity: 0.8;
    }
    .modal-confirm .icon-box {
        color: #fff;
        width: 95px;
        height: 95px;
        display: inline-block;
        border-radius: 50%;
        z-index: 9;
        border: 5px solid #fff;
        padding: 15px;
        text-align: center;
    }
    .modal-confirm .icon-box i {
        font-size: 64px;
        margin: -4px 0 0 -4px;
    }

    .modal-confirm .btn,
    .modal-confirm .btn:active {
        color: #fff;
        border-radius: 4px;
        background: #d7b9ae !important;
        text-decoration: none;
        transition: all 0.4s;
        line-height: normal;
        border-radius: 30px;
        margin-top: 10px;
        padding: 6px 20px;
        border: none;
    }
    .modal-confirm .btn:hover,
    .modal-confirm .btn:focus {
        background: #eda645 !important;
        outline: none;
    }
    .modal-confirm .btn span {
        margin: 1px 3px 0;
        float: left;
    }
    .modal-confirm .btn i {
        margin-left: 1px;
        font-size: 20px;
        float: right;
    }
    .trigger-btn {
        display: inline-block;
        margin: 100px auto;
    }

    @media only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (-webkit-min-device-pixel-ratio: 1) {
        #popup {
            padding: 0;
        }
        .paymentOverlay {
            height: 90vh;
            margin: 2.5% 2.5% auto;
        }
    }
    @media only screen and (max-width: 992px) {
        .modal {
            width: 20%;
            /* margin-top: 50%; */
        }
        .paymentOverlay {
            height: 90vh;
            margin: 2% 4%;
        }
    }
    @media screen and (max-width: 640px) {
        .contentDiv {
            height: 55vh;
        }
        .modal {
            width: 40%;
            /* margin-top: 50%; */
        }
        #popup {
            width: 95%;
            padding: 1em 0 0 0;
        }
        .modal-confirm,
        #successWebCr8Modal {
            color: #434e65;
            width: 350px;
        }
        .paymentOverlay {
            height: 88vh;
        }
    }
    .saveAllBtn {
        background-color: var(--pri) !important;
    }
    .justify-center {
        justify-content: center;
    }
    .holds-the-iframe {
        background: url('data:image/svg+xml;charset=utf-8,<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 100% 100%"><text fill="%23FF0000" x="50%" y="50%" font-family="\'Lucida Grande\', sans-serif" font-size="24" text-anchor="middle">PLACEHOLDER</text></svg>')
            0px 0px no-repeat;
    }

    .bb-danger {
        border-bottom-color: rgb(238, 118, 118) !important;
    }
    .dangerTxt {
        color: rgb(238, 118, 128);
    }
    .required::-webkit-input-placeholder {
        color: rgb(238, 118, 128);
    }

    input.mx-input {
        margin: 0px !important;
    }
    .timer {
        font-weight: 600;
        font-family: Poppins, sans-serif;
    }
</style>
