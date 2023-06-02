<template>
    <div>
        <!-- <div class="row">
            <div class="col s12">
                <div class="primaryColorDiv">
                    <div class="headerDiv">
                        <a href="/">
                            <img
                                src="/media/img/wcdMobileLogo.png"
                                alt="wcdMobileLogo.png"
                                class="hide-on-large-only wcdMobileLogo"
                            />
                            <img
                                src="/media/img/wcdMobileLogoLarge.png"
                                alt="wcdMobileLogoLarge.png"
                                class="hide-on-med-and-down"
                            />
                        </a>
                        <p class="headerTitle">
                            It is time for the world to hear your pulse
                        </p>
                    </div>
                    <div class="hide-on-large-only">
                        <img
                            src="/media/img/3dDoctors.png"
                            alt="3dDoctors.png"
                            class="primaryColorDocsImg"
                        />
                    </div>
                    <div class="hide-on-med-and-down">
                        <img
                            src="/media/img/3dDoctorsLarge.png"
                            alt="3dDoctorsLarge.png"
                            class="primaryColorDocsImgLarge"
                        />
                    </div>
                </div>
            </div>
            <div class="">
                <div class="contentDiv">
                    <div class="container">
                        Tab for Large device
                        <ul class="cvModalLinkHolder hide-on-med-and-down">
                            <li class="cvModalLinkList">
                                <a
                                    href="#"
                                    class="cvModalLink"
                                    @click="sumHeaderLink()"
                                >
                                    <span
                                        class="cvModalLinkNum"
                                        :class="view == 0 ? 'active' : ''"
                                        >1</span
                                    >
                                    Summary
                                </a>
                            </li>
                            <li class="cvModalLinkList">
                                <a
                                    href="#"
                                    class="cvModalLink"
                                    @click="eduHeaderLink()"
                                >
                                    <span
                                        class="cvModalLinkNum"
                                        :class="view == 1 ? 'active' : ''"
                                        >2</span
                                    >
                                    Education
                                </a>
                            </li>
                            <li class="cvModalLinkList">
                                <a
                                    href="#"
                                    class="cvModalLink"
                                    @click="trainHeaderLink()"
                                >
                                    <span
                                        class="cvModalLinkNum"
                                        :class="view == 2 ? 'active' : ''"
                                        >3</span
                                    >
                                    Training
                                </a>
                            </li>
                            <li class="cvModalLinkList">
                                <a
                                    href="#"
                                    class="cvModalLink"
                                    @click="expHeaderLink()"
                                >
                                    <span
                                        class="cvModalLinkNum"
                                        :class="view == 3 ? 'active' : ''"
                                        >4</span
                                    >
                                    Experience
                                </a>
                            </li>
                            <li class="cvModalLinkList">
                                <a
                                    href="#"
                                    class="cvModalLink"
                                    @click="refHeaderLink()"
                                >
                                    <span
                                        class="cvModalLinkNum"
                                        :class="view == 4 ? 'active' : ''"
                                        >5</span
                                    >
                                    Reference
                                </a>
                            </li>
                            <li class="cvModalLinkList">
                                <a
                                    href="#"
                                    class="cvModalLink"
                                    @click="licHeaderLink()"
                                >
                                    <span
                                        class="cvModalLinkNum"
                                        :class="view == 5 ? 'active' : ''"
                                        >6</span
                                    >
                                    Licence
                                </a>
                            </li>
                            <li class="cvModalLinkList">
                                <a href="#" class="cvModalLink modal-close">
                                    <i class="material-icons cvModalExitIcon"
                                        >exit_to_app</i
                                    >
                                    EXIT
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="container">
                        Summary
                        <div v-show="view == 0">
                            <h4 class="cvSetupTitle">
                                Let us know more about you
                            </h4>
                            <div class="row">
                                <div class="input-field col s12 l12">
                                    <input
                                        placeholder="Surgeon"
                                        type="text"
                                        class="validate cvSetupInput1 sumInput"
                                        v-model="
                                            cv.title
                                        "
                                    />
                                </div>
                            </div>
                            <textarea
                                placeholder="Typing..."
                                id=""
                                cols="30"
                                rows="10"
                                v-model="cv.summary"
                                class="cvSetupTextarea"
                                maxlength="614"
                            ></textarea>
                            <small class="maxChar right"
                                >{{cv.summary.length || 0}} count. Maximum characters should be 614 characters</small
                            >
                            
                            <div>
                                <button
                                    @click.prevent="saveCV"
                                    class="
                                        waves-effect waves-green
                                        btn
                                        cvSetupSaveBtn
                                    "
                                    v-if="!loading "
                                >
                                    <span v-if="!cvUpdate">Save</span>
                                    <span v-else>Update</span>
                                </button>

                                <button v-else class=" waves-effect waves-green
                                        btn
                                        cvSetupSaveBtn">
                                    <i class="fas fa-circle-notch fa-spin"></i>
                                </button>
                            </div>

                            <div class="cvNextStepBtnDiv">
                                <div class="right">
                                    <button
                                        @click="saveAndNext"
                                        v-if="view != 5"
                                        class="
                                            waves-effect waves-green
                                            btn
                                            cvSetupNextStepBtn
                                        "
                                    >
                                        Education
                                    </button>
                                </div>
                            </div>
                        </div>
                        Education
                        <div v-show="view == 1">
                            <div v-if="!showEduForm">
                                <h4 class="cvSetupTitle">
                                    Kindly answer the question below
                                </h4>
                                <div class="cvSetupRadioBtnDiv">
                                    <div class="cvSetupRadioBtnInnerDiv">
                                        <label class="cvSetupRadioBtnHolder">
                                            <input
                                                class="with-gap cvSetupRadioBtn"
                                                name="group1"
                                                type="radio"
                                                @click="showEdu(), (edu = 0)"
                                            />
                                            <span class="cvSetupRadioBtnSpan"
                                                >I attended med school and
                                                undergrad school</span
                                            >
                                        </label>
                                        <label class="cvSetupRadioBtnHolder">
                                            <input
                                                class="with-gap cvSetupRadioBtn"
                                                name="group1"
                                                type="radio"
                                                @click="showEdu(), undergradSchoolInput = 1, medSchoolOnly = true"
                                            />
                                            <span class="cvSetupRadioBtnSpan"
                                                >I only attended med
                                                school</span
                                            >
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div v-show="showEduForm">
                                <div v-if="edu === 0">
                                    UndergradSchool
                                    <div v-show="undergradSchoolInput == 0 && !medSchoolOnly">
                                        <div class="cvSetupEduIndicatorDiv">
                                            <p class="cvSetupEduIndicatorP">
                                                Undergrad School
                                            </p>
                                            <p class="cvSetupEduIndicatorP">
                                                Medical School
                                            </p>
                                            <p class="cvSetupEduIndicatorP">
                                                Other
                                            </p>
                                        </div>
                                        <h6 class="cvSetupTitle">
                                            Tell us about your time in Undergraduate
                                            School
                                        </h6>
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <input
                                                    placeholder="Institution"
                                                    type="text"
                                                    class="
                                                        validate
                                                        cvSetupInput1
                                                    "
                                                    v-model="
                                                        cvGradSchool.institution
                                                    "
                                                />
                                            </div>
                                            <div class="input-field col s12 l6">
                                                <input
                                                    placeholder=" Major"
                                                    type="text"
                                                    class="
                                                        validate
                                                        cvSetupInput
                                                    "
                                                    v-model="cvGradSchool.major"
                                                />
                                            </div>
                                            <div class="input-field col s12 l6">
                                                <input
                                                    placeholder="Minor (Optional)"
                                                    type="text"
                                                    class="
                                                        validate
                                                        cvSetupInput
                                                    "
                                                    v-model="cvGradSchool.minor"
                                                />
                                            </div>
                                            <div class="input-field col s12 l6">
                                                <date-picker
                                                    v-model:value="
                                                        cvGradSchool.yearStart
                                                    "
                                                    type="year"
                                                    placeholder="Year(End) ?"
                                                    class="
                                                        validate
                                                        cvSetupInput
                                                    "
                                                ></date-picker>
                                            </div>
                                            <div class="input-field col s12 l6">
                                                <select
                                                    class="
                                                        validate
                                                        formInput1
                                                        browser-default
                                                        cvSetupInput
                                                    "
                                                    v-model="
                                                        cvGradSchool.monthStart
                                                    "
                                                >
                                                    <option
                                                        :value="''"
                                                        disabled
                                                        selected
                                                    >
                                                        Month(Start)?
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
                                            <div class="input-field col s12 l6">
                                                <date-picker
                                                    v-model:value="
                                                        cvGradSchool.yearEnd
                                                    "
                                                    type="year"
                                                    placeholder="Year(End) ?"
                                                    class="
                                                        validate
                                                        cvSetupInput
                                                    "
                                                ></date-picker>
                                            </div>
                                            <div class="input-field col s12 l6">
                                                <select
                                                    class="
                                                        validate
                                                        formInput1
                                                        browser-default
                                                        cvSetupInput
                                                    "
                                                    v-model="
                                                        cvGradSchool.monthEnd
                                                    "
                                                >
                                                    <option
                                                        :value="''"
                                                        disabled
                                                        selected
                                                    >
                                                        Month(End)?
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
                                        </div>
                                    </div>
                                    Medical School
                                    <div
                                        class="row"
                                        v-show="undergradSchoolInput == 1"
                                    >
                                        <div class="cvSetupEduIndicatorDiv">
                                            <p class="cvSetupEduIndicatorP" v-show="!medSchoolOnly">
                                                <i
                                                    class="
                                                        material-icons
                                                        cvSetupEduIndicatorIcon
                                                    "
                                                    >check</i
                                                >
                                                Undergraduate School
                                            </p>
                                            <p class="cvSetupEduIndicatorP">
                                                Medical School
                                            </p>
                                            <p class="cvSetupEduIndicatorP">
                                                Other
                                            </p>
                                        </div>
                                        <h6 class="cvSetupTitle">
                                            Tell us about your time in medical/dental
                                            school
                                        </h6>
                                        <div class="row">
                                            <div class="row lt_mb">
                                                <div
                                                    class="
                                                        input-field
                                                        col
                                                        s12
                                                        l12
                                                    "
                                                >
                                                    <input
                                                        placeholder="Institution"
                                                        type="text"
                                                        class="
                                                            validate
                                                            cvSetupInput1
                                                        "
                                                        v-model="
                                                            cvMedSchool.institution
                                                        "
                                                    />
                                                </div>
                                                
                                            </div>
                                            <div class="row lt_mb">
                                                <div
                                                    class="
                                                        input-field
                                                        col
                                                        s12
                                                        l6
                                                    "
                                                >
                                                    <date-picker
                                                        v-model:value="
                                                            cvMedSchool.yearStart
                                                        "
                                                        type="year"
                                                        placeholder="Year(Start) ?"
                                                        class="
                                                            validate
                                                            cvSetupInput
                                                        "
                                                    ></date-picker>
                                                </div>
                                                <div
                                                    class="
                                                        input-field
                                                        col
                                                        s12
                                                        l6
                                                    "
                                                >
                                                    <select
                                                        class="
                                                            validate
                                                            formInput1
                                                            browser-default
                                                            cvSetupInput
                                                        "
                                                        v-model="
                                                            cvMedSchool.monthStart
                                                        "
                                                    >
                                                        <option
                                                            :value="''"
                                                            disabled
                                                            selected
                                                        >
                                                            Start(Month)?
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
                                            </div>
                                            <div class="row lt_mb">
                                                <div
                                                    class="
                                                        input-field
                                                        col
                                                        s12
                                                        l6
                                                    "
                                                >
                                                    <date-picker
                                                        v-model:value="
                                                            cvMedSchool.yearEnd
                                                        "
                                                        type="year"
                                                        placeholder="Year(End) ?"
                                                        class="
                                                            validate
                                                            cvSetupInput
                                                        "
                                                    ></date-picker>
                                                </div>
                                                <div
                                                    class="
                                                        input-field
                                                        col
                                                        s12
                                                        l6
                                                    "
                                                >
                                                    <select
                                                        class="
                                                            validate
                                                            formInput1
                                                            browser-default
                                                            cvSetupInput
                                                        "
                                                        v-model="
                                                            cvMedSchool.monthEnd
                                                        "
                                                    >
                                                        <option
                                                            :value="''"
                                                            disabled
                                                            selected
                                                        >
                                                            Month End?
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
                                            </div>
                                            <button
                                                @click.prevent="saveMedSchool"
                                                class="
                                                    waves-effect waves-green
                                                    btn
                                                    cvSetupSaveBtn
                                                    right
                                                "
                                                v-if="!loading"
                                            >
                                                <span v-if="!cvMedSchoolUpdate">Save</span>
                                                <span v-else>Update</span>
                                            </button>
                                            <button v-else class="btn waves-effect waves-green

                                                    cvSetupSaveBtn
                                                    right">
                                                <i class="fas fa-circle-notch fa-2x fa-spin"></i>                                            </button>
                                        </div>
                                    </div>
                                    Other School Attended
                                    <div
                                        class="row"
                                        v-show="undergradSchoolInput == 2"
                                    >
                                        <div class="cvSetupEduIndicatorDiv">
                                            <p class="cvSetupEduIndicatorP" v-show="!medSchoolOnly">
                                                <i
                                                    class="
                                                        material-icons
                                                        cvSetupEduIndicatorIcon
                                                    "
                                                    >check</i
                                                >
                                                Undergraduate School
                                            </p>
                                            <p class="cvSetupEduIndicatorP">
                                                <i
                                                    class="
                                                        material-icons
                                                        cvSetupEduIndicatorIcon
                                                    "
                                                    >check</i
                                                >
                                                Medical School
                                            </p>
                                            <p class="cvSetupEduIndicatorP">
                                                Other
                                            </p>
                                        </div>

                                        <h6 class="cvSetupTitle">
                                            Any other school attended?
                                            <small>optional</small>
                                        </h6>
                                        <div class="row">
                                            <div class="row lt_mb">
                                                <div
                                                    class="input-field col s12"
                                                >
                                                    <input
                                                        placeholder="Institution"
                                                        type="text"
                                                        class="
                                                            validate
                                                            cvSetupInput1
                                                        "
                                                        v-model="
                                                            cvAdditionalSchool.institution
                                                        "
                                                    />
                                                </div>
                                            </div>
                                            <div class="row lt_mb">
                                                <div
                                                    class="
                                                        input-field
                                                        col
                                                        s12
                                                        l6
                                                    "
                                                >
                                                    <input
                                                        placeholder="Title"
                                                        type="text"
                                                        class="
                                                            validate
                                                            cvSetupInput
                                                        "
                                                        v-model="
                                                            cvAdditionalSchool.title
                                                        "
                                                    />
                                                </div>
                                                <div
                                                    class="
                                                        input-field
                                                        col
                                                        s12
                                                        l6
                                                    "
                                                >
                                                    <input
                                                        placeholder="Degree"
                                                        type="text"
                                                        class="
                                                            validate
                                                            cvSetupInput
                                                        "
                                                        v-model="
                                                            cvAdditionalSchool.degree
                                                        "
                                                    />
                                                </div>
                                            </div>
                                            <div class="row lt_mb">
                                                <div
                                                    class="
                                                        input-field
                                                        col
                                                        s12
                                                        l6
                                                    "
                                                >
                                                    <date-picker
                                                        v-model:value="
                                                            cvAdditionalSchool.yearStart
                                                        "
                                                        type="year"
                                                        placeholder="Year(Start) ?"
                                                        class="
                                                            validate
                                                            cvSetupInput
                                                        "
                                                    ></date-picker>
                                                </div>
                                                <div
                                                    class="
                                                        input-field
                                                        col
                                                        s12
                                                        l6
                                                    "
                                                >
                                                    <select
                                                        class="
                                                            validate
                                                            formInput1
                                                            browser-default
                                                        "
                                                        v-model="
                                                            cvAdditionalSchool.monthStart
                                                        "
                                                    >
                                                        <option
                                                            :value="''"
                                                            disabled
                                                            selected
                                                        >
                                                            Month End?
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
                                            </div>
                                            <div class="row lt_mb">
                                                <div
                                                    class="
                                                        input-field
                                                        col
                                                        s12
                                                        l6
                                                    "
                                                >
                                                    <date-picker
                                                        v-model:value="
                                                            cvAdditionalSchool.yearEnd
                                                        "
                                                        type="year"
                                                        placeholder="Year(End) ?"
                                                        class="
                                                            validate
                                                            cvSetupInput
                                                        "
                                                    ></date-picker>
                                                </div>
                                                <div
                                                    class="
                                                        input-field
                                                        col
                                                        s12
                                                        l6
                                                    "
                                                >
                                                    <select
                                                        class="
                                                            validate
                                                            formInput1
                                                            browser-default
                                                        "
                                                        v-model="
                                                            cvAdditionalSchool.monthEnd
                                                        "
                                                    >
                                                        <option
                                                            :value="''"
                                                            disabled
                                                            selected
                                                        >
                                                            Month End?
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
                                            </div>
                                        </div>
                                        <button
                                            @click.prevent="saveOtherSchool"
                                            class="
                                                waves-effect waves-green
                                                btn
                                                cvSetupSaveBtn
                                                right
                                            "
                                            v-if="!loading"
                                        >
                                            <span v-if="!cvAdditionalSchoolUpdate">Save</span>
                                            <span v-else>Update</span>
                                        </button>

                                        <button v-else class="waves-effect waves-green
                                                btn
                                                cvSetupSaveBtn
                                                right">
                                            <div
                                                class="
                                                    preloader-wrapper
                                                    small
                                                    active
                                                "
                                            >
                                                <div
                                                    class="
                                                        spinner-layer
                                                        spinner-white-only
                                                    "
                                                >
                                                    <div
                                                        class="
                                                            circle-clipper
                                                            left
                                                        "
                                                    >
                                                        <div
                                                            class="circle"
                                                        ></div>
                                                    </div>
                                                    <div class="gap-patch">
                                                        <div
                                                            class="circle"
                                                        ></div>
                                                    </div>
                                                    <div
                                                        class="
                                                            circle-clipper
                                                            right
                                                        "
                                                    >
                                                        <div
                                                            class="circle"
                                                        ></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </button>
                                    </div>
                                    Chevron BTNs
                                    <div class="row">
                                        <div class="right">
                                            <a
                                                href="#!"
                                                class="chevronIconLink"
                                                @click="
                                                    prevEduBtn
                                                "
                                            >
                                                <i
                                                    class="
                                                        material-icons
                                                        chevronIcon
                                                    "
                                                    >chevron_left</i
                                                >
                                            </a>
                                            <a
                                                href="#!"
                                                class="chevronIconLink"
                                                @click="
                                                    nextEduBtn
                                                "
                                                title="skip to next"
                                            >
                                                <i
                                                    class="
                                                        material-icons
                                                        chevronIcon
                                                    "
                                                    >chevron_right</i
                                                >
                                            </a>
                                        </div>
                                    </div>

                                    <div class="cvNextStepBtnDiv1">
                                        <div class="right">
                                            <button
                                                @click="previous"
                                                class="
                                                    waves-effect waves-green
                                                    btn
                                                    cvSetupBackStepBtn
                                                "
                                            >
                                                Summary
                                            </button>
                                            <button
                                                @click="saveAndNext"
                                                v-if="view != 5"
                                                class="
                                                    waves-effect waves-green
                                                    btn
                                                    cvSetupNextStepBtn
                                                "
                                            >
                                                Trainings
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        Trainings
                        <div v-show="view == 2">
                            <div v-if="trainingSetup == 0">
                                <div class="cvSetupEduIndicatorDiv">
                                    <p class="cvSetupEduIndicatorP">
                                        Internship
                                    </p>
                                    <p class="cvSetupEduIndicatorP">
                                        Fellowship
                                    </p>
                                    <p class="cvSetupEduIndicatorP">
                                        Residency
                                    </p>
                                </div>
                                <div class="row lt_mb">
                                    <h6 class="col s12 l8 cvSetupTitle">
                                        Tell us about your internship
                                    </h6>
                                   
                                </div>

                                <div class="row">
                                    <div class="row lt_mb">
                                        <div class="input-field col s12 l6">
                                            <input
                                                placeholder="Institution"
                                                type="text"
                                                class="validate cvSetupInput"
                                                v-model="cvTrainingsIntern.institution"
                                            />
                                        </div>

                                        <div class="input-field col s12 l6">
                                            <input
                                                placeholder="Location"
                                                type="text"
                                                class="validate cvSetupInput"
                                                v-model="cvTrainingsIntern.location"
                                            />
                                        </div>
                                    </div>
                                    <div class="row lt_mb">
                                        <div class="input-field col s12 l6">
                                            <date-picker
                                                        v-model:value="
                                                            cvTrainingsIntern.yearStart
                                                        "
                                                        type="year"
                                                        placeholder="Year(Start) ?"
                                                        class="
                                                            validate
                                                            cvSetupInput
                                                        "
                                                    ></date-picker>
                                        </div>
                                        <div class="input-field col s12 l6">
                                            <select
                                                class="
                                                    validate
                                                    formInput1
                                                    browser-default
                                                "
                                                v-model="cvTrainingsIntern.monthStart"
                                            >
                                                <option
                                                    :value="''"
                                                    disabled
                                                    selected
                                                >
                                                Start (Month)?
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
                                    </div>
                                    <div class="row lt_mb">
                                        <div class="input-field col s12 l6">
                                            <date-picker
                                                        v-model:value="
                                                            cvTrainingsIntern.yearEnd
                                                        "
                                                        type="year"
                                                        placeholder="Year(End) ?"
                                                        class="
                                                            validate
                                                            cvSetupInput
                                                        "
                                                    ></date-picker>
                                        </div>
                                        <div class="input-field col s12 l6">
                                            <select
                                                class="
                                                    validate
                                                    formInput1
                                                    browser-default
                                                "
                                                v-model="cvTrainingsIntern.monthEnd"
                                            >
                                                <option
                                                    :value="''"
                                                    disabled
                                                    selected
                                                >
                                                End (Month)?
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
                                    </div>
                                </div>
                            </div>

                            <div v-if="trainingSetup == 1">
                                <div class="cvSetupEduIndicatorDiv">
                                    <p class="cvSetupEduIndicatorP">
                                        <i
                                            class="
                                                material-icons
                                                cvSetupEduIndicatorIcon
                                            "
                                            >check</i
                                        >
                                        Internship
                                    </p>
                                    <p class="cvSetupEduIndicatorP">
                                        Fellowship
                                    </p>
                                    <p class="cvSetupEduIndicatorP">
                                        Residency
                                    </p>
                                </div>
                                <div class="row lt_mb">
                                    <h6 class="col s12 l8 cvSetupTitle">
                                        Tell us about your fellowship
                                    </h6>

                                </div>

                                <div class="row">
                                    <div class="row lt_mb">
                                        <div class="input-field col s12 l6">
                                            <input
                                                placeholder="Institution"
                                                type="text"
                                                class="validate cvSetupInput"
                                                v-model="cvTrainingsFellowship.institution"
                                            />
                                        </div>

                                        <div class="input-field col s12 l6">
                                            <input
                                                placeholder="Location"
                                                type="text"
                                                class="validate cvSetupInput"
                                                v-model="cvTrainingsFellowship.location"
                                            />
                                        </div>
                                    </div>
                                    <div class="row lt_mb">
                                        <div class="input-field col s12 l6">
                                            <input
                                                placeholder="Speciality"
                                                type="text"
                                                class="validate cvSetupInput"
                                                v-model="cvTrainingsFellowship.specialty"
                                            />
                                        </div>
                                        <div class="input-field col s12 l6">
                                            <input
                                                type="text"
                                                class="validate cvSetupInput"
                                                placeholder="Sub-Speciality"
                                                v-model="cvTrainingsFellowship.sub_specialty"
                                            />
                                        </div>
                                    </div>
                                    <div class="row lt_mb">
                                        <div class="input-field col s12 l6">
                                            <date-picker
                                                        v-model:value="
                                                            cvTrainingsFellowship.yearStart
                                                        "
                                                        type="year"
                                                        placeholder="Year(Start) ?"
                                                        class="
                                                            validate
                                                            cvSetupInput
                                                        "
                                                    ></date-picker>
                                        </div>
                                        <div class="input-field col s12 l6">
                                            <select
                                                class="
                                                    validate
                                                    formInput1
                                                    browser-default
                                                "
                                                v-model="cvTrainingsFellowship.monthStart"
                                            >
                                                <option
                                                    :value="''"
                                                    disabled
                                                    selected
                                                >
                                                Start (Month)?
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
                                    </div>
                                    <div class="row lt_mb">
                                        <div class="input-field col s12 l6">
                                            <date-picker
                                                        v-model:value="
                                                            cvTrainingsFellowship.yearEnd
                                                        "
                                                        type="year"
                                                        placeholder="Year(End) ?"
                                                        class="
                                                            validate
                                                            cvSetupInput
                                                        "
                                                    ></date-picker>
                                        </div>
                                        <div class="input-field col s12 l6">

                                            <select
                                                class="
                                                    validate
                                                    formInput1
                                                    browser-default
                                                "
                                                v-model="cvTrainingsFellowship.monthEnd"
                                            >
                                                <option
                                                    :value="''"
                                                    disabled
                                                    selected
                                                >
                                                End (Month)?
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
                                    </div>
                                </div>
                            </div>

                            <div v-if="trainingSetup == 2">
                                <div class="cvSetupEduIndicatorDiv">
                                    <p class="cvSetupEduIndicatorP">
                                        <i
                                            class="
                                                material-icons
                                                cvSetupEduIndicatorIcon
                                            "
                                            >check</i
                                        >
                                        Internship
                                    </p>
                                    <p class="cvSetupEduIndicatorP">
                                        <i
                                            class="
                                                material-icons
                                                cvSetupEduIndicatorIcon
                                            "
                                            >check</i
                                        >
                                        Fellowship
                                    </p>
                                    <p class="cvSetupEduIndicatorP">
                                        Residency
                                    </p>
                                </div>
                                <div class="row lt_mb">
                                    <h6 class="col s12 l8 cvSetupTitle">
                                        Tell us about your Residency
                                    </h6>
                                </div>

                                <div class="row">
                                    <div class="row lt_mb">
                                        <div class="input-field col s12 l6">
                                            <input
                                                placeholder="Institution"
                                                type="text"
                                                class="validate cvSetupInput"
                                                v-model="cvTrainingsResidency.institution"
                                            />
                                        </div>

                                        <div class="input-field col s12 l6">
                                            <input
                                                placeholder="Location"
                                                type="text"
                                                class="validate cvSetupInput"
                                                v-model="cvTrainingsResidency.location"
                                            />
                                        </div>
                                    </div>
                                    <div class="row lt_mb">
                                        <div class="input-field col s12 l6">
                                            <input
                                                placeholder="Speciality"
                                                type="text"
                                                class="validate cvSetupInput"
                                                v-model="cvTrainingsResidency.specialty"
                                            />
                                        </div>
                                        <div class="input-field col s12 l6">
                                            <input
                                                type="text"
                                                class="validate cvSetupInput"
                                                placeholder="Sub-Speciality"
                                                v-model="cvTrainingsResidency.sub_specialty"
                                            />
                                        </div>
                                    </div>
                                    <div class="row lt_mb">
                                        <div class="input-field col s12 l6">
                                            <date-picker
                                                        v-model:value="
                                                            cvTrainingsResidency.yearStart
                                                        "
                                                        type="year"
                                                        placeholder="Year(Start) ?"
                                                        class="
                                                            validate
                                                            cvSetupInput
                                                        "
                                                    ></date-picker>
                                        </div>
                                        <div class="input-field col s12 l6">
                                            <select
                                                class="
                                                    validate
                                                    formInput1
                                                    browser-default
                                                "
                                                v-model="cvTrainingsResidency.monthStart"
                                            >
                                                <option
                                                    :value="''"
                                                    disabled
                                                    selected
                                                >
                                                Start (Month)?
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
                                    </div>
                                    <div class="row lt_mb">
                                        <div class="input-field col s12 l6">
                                            <date-picker
                                                        v-model:value="
                                                            cvTrainingsResidency.yearEnd
                                                        "
                                                        type="year"
                                                        placeholder="Year(End) ?"
                                                        class="
                                                            validate
                                                            cvSetupInput
                                                        "
                                                    ></date-picker>
                                        </div>
                                        <div class="input-field col s12 l6">
                                            <select
                                                class="
                                                    validate
                                                    formInput1
                                                    browser-default
                                                "
                                                v-model="cvTrainingsResidency.monthEnd"
                                            >
                                                <option
                                                    :value="''"
                                                    disabled
                                                    selected
                                                >
                                                    Month End?
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
                                    </div>
                                </div>
                            </div>

                            <div class="row" :class="{'flex-column': trainingSetup === 2}">
                                <div v-if="trainingSetup === 2" >
                                    <button
                                        @click.prevent="saveTraining"
                                        class="
                                            waves-effect waves-green
                                            btn
                                            cvSetupSaveBtn right
                                        "
                                        v-if="!loading"
                                    >
                                        <span v-if="!cvTrainingUpdate">Save</span>
                                        <span v-else>Update</span>
                                    </button>
                                    <button
                                        class="
                                            waves-effect waves-green
                                            btn
                                            cvSetupSaveBtn right
                                        "
                                        v-else
                                    >
                                        <i class="fas fa-circle-notch fa-2x fa-spin"></i>
                                    </button>
                                </div>
                                <div class="right mt-2">
                                    <a
                                        href="#!"
                                        class="chevronIconLink"
                                        @click="
                                            trainingSetup != 0
                                                ? trainingSetup--
                                                : null
                                        "
                                    >
                                        <i class="material-icons chevronIcon"
                                            >chevron_left</i
                                        >
                                    </a>
                                    <a
                                        href="#!"
                                        class="chevronIconLink"
                                        @click="
                                            trainingSetup != 2
                                                ? trainingSetup++
                                                : null
                                        "
                                        title="skip to next"
                                    >
                                        <i class="material-icons chevronIcon"
                                            >chevron_right</i
                                        >
                                    </a>
                                </div>
                            </div>
                            <div class="cvNextStepBtnDiv1">
                                <div class="right">
                                    <button
                                        @click="previous"
                                        class="
                                            waves-effect waves-green
                                            btn
                                            cvSetupBackStepBtn
                                        "
                                    >
                                        Education
                                    </button>
                                    <button
                                        @click="saveAndNext"
                                        v-if="view != 5"
                                        class="
                                            waves-effect waves-green
                                            btn
                                            cvSetupNextStepBtn
                                        "
                                    >
                                        Experience
                                    </button>
                                </div>
                            </div>
                        </div>
                        Experience
                        <div v-show="view == 3">
                            <div class="rule">
                                <div class="row lt_mb">
                                    <h6 class="col s12 l8 cvSetupTitle">
                                        Tell us about your Experience
                                    </h6>
                                </div>

                                    <div class="row">
                                        <div class="input-field col s12 l12">
                                            <input
                                                placeholder="Institution/Organization"
                                                type="text"
                                                class="validate cvSetupInput1"
                                                v-model="cvExperience.institution"
                                            />
                                        </div>
                                        <div class="input-field col s12 l4">
                                            <select
                                                class="
                                                    validate
                                                    formInput1
                                                    browser-default
                                                "
                                                v-model="countrySelected"
                                                @change="sortStates"
                                            >
                                                <option
                                                    :value="''"
                                                    disabled
                                                    selected
                                                >
                                                    Country
                                                </option>
                                                <option
                                                    v-for="country in countries"
                                                    :key="country.id"
                                                    :value="country.id"
                                                >
                                                    {{ country.name }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="input-field col s12 l4">
                                            <select
                                                class="validate formInput1 browser-default"
                                                v-model="stateSelected"
                                                @change="sortCities"
                                            >
                                                <option
                                                    :value="''"
                                                    disabled
                                                    selected
                                                >
                                                    State
                                                </option>
                                                <option
                                                    v-for="state in states"
                                                    :key="state.id"
                                                    :value="state.id"
                                                >
                                                    {{ state.name }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="input-field col s12 l4">
                                            <select
                                                class="
                                                    validate
                                                    formInput1
                                                    browser-default
                                                "
                                                v-model="cvExperience.city_id"
                                            >
                                                <option
                                                    value=""
                                                    disabled
                                                    selected
                                                >
                                                    City
                                                </option>
                                                <option
                                                    v-for="city in cities"
                                                    :key="city.id"
                                                    :value="city.id"
                                                >
                                                    {{ city.name }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="input-field col s12 l6">
                                            <date-picker
                                                        v-model:value="
                                                            cvExperience.yearStart
                                                        "
                                                        type="year"
                                                        placeholder="Year(Start) ?"
                                                        class="
                                                            validate
                                                            cvSetupInput
                                                        "
                                                    ></date-picker>
                                        </div>
                                        <div class="input-field col s12 l6">
                                            <select
                                                class="
                                                    validate
                                                    formInput1
                                                    browser-default
                                                "
                                                v-model="cvExperience.monthStart"
                                            >
                                                <option
                                                    :value="''"
                                                    disabled
                                                    selected
                                                >
                                                Start (Month)?
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
                                        <div class="input-field col s12 l6">
                                            <date-picker
                                                        v-model:value="
                                                            cvExperience.yearEnd
                                                        "
                                                        type="year"
                                                        placeholder="Year(End) ?"
                                                        class="
                                                            validate
                                                            cvSetupInput
                                                        "
                                                    ></date-picker>
                                        </div>
                                        <div class="input-field col s12 l6">
                                            <select
                                                class="
                                                    validate
                                                    formInput1
                                                    browser-default
                                                "
                                                v-model="cvExperience.monthEnd"
                                            >
                                                <option
                                                    :value="''"
                                                    disabled
                                                    selected
                                                >
                                                End (Month)?
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

                                        <div>
                                            <button
                                                @click.prevent="saveExperience"
                                                class="
                                                    waves-effect waves-green
                                                    btn
                                                    cvSetupSaveBtn right
                                                "
                                                v-if="!loading"
                                            >
                                                <span v-if="!cvExperienceUpdate">Save</span>
                                                <span v-else>Update</span>
                                            </button>
                                            <button
                                                class="
                                                    waves-effect waves-green
                                                    btn
                                                    cvSetupSaveBtn right
                                                "
                                                v-else
                                            >
                                                <i class="fas fa-circle-notch fa-2x fa-spin"></i>
                                            </button>
                                        </div>
                                    </div>

                                <div class="cvNextStepBtnDiv1">
                                    <div class="right">
                                        <button
                                            @click="previous"
                                            class="
                                                waves-effect waves-green
                                                btn
                                                cvSetupBackStepBtn
                                            "
                                        >
                                            Training
                                        </button>
                                        <button
                                            @click="saveAndNext"
                                            v-if="view != 5"
                                            class="
                                                waves-effect waves-green
                                                btn
                                                cvSetupNextStepBtn
                                            "
                                        >
                                            Reference
                                        </button>
                                    </div>
                                </div>

                            </div>
                            <div class="experiencesRow card"  v-for="expo in cvExperiences" :key="expo.id">
                                <div class="ruleoutxt card-content">
                                    <div class="flex">
                                        <i class="material-icons">home</i>
                                        <h6>{{expo.institution}}</h6>
                                    </div>
                                    <div class="flex" v-if=expo.state>
                                        <i class="material-icons">location_on</i>
                                        <p>{{expo.state.name}}/{{ expo.city.name }}</p>
                                    </div>
                                    <div class="flex">
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                        <p>{{expo.monthStart}}/{{ new Date(`${expo.yearStart}`).getFullYear() }} - {{expo.monthEnd || ''}} {{expo.yearEnd !== null ? '/' : ''}}{{ new Date(`${expo.yearEnd}`).getFullYear() || 'Present' }}</p>
                                    </div>
                                    <div class="row mt-2">
                                        <button class="btn waves waves-effect danger col s5 l2 m4" @click="deleteMe(expo)">Delete</button>
                                        <button class="btn waves waves-effect primary col s5 l2 offset-l2 m4 offset-m4 offset-s1" @click="populateCvExpo(expo)">Edit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        Reference
                        <div v-show="view == 4">
                            <div>
                                <div class="row lt_mb">
                                    <h6 class="col s12 l8 cvSetupTitle">
                                        Tell us about your Reference
                                    </h6>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12 l6">
                                        <input
                                            placeholder="Title"
                                            type="text"
                                            class="validate cvSetupInput"
                                            v-model="cvReference.title"
                                        />
                                    </div>
                                    <div class="input-field col s12 l6">
                                        <input
                                            placeholder="Name"
                                            type="text"
                                            class="validate cvSetupInput"
                                            v-model="cvReference.name"
                                        />
                                    </div>
                                    <div class="input-field col s12 l12">
                                        <input
                                            placeholder="Institution"
                                            type="text"
                                            class="validate cvSetupInput1"
                                            v-model="cvReference.institution"
                                        />
                                    </div>
                                    <div class="input-field col s12 l6">
                                        <input
                                            placeholder="Position"
                                            type="text"
                                            class="validate cvSetupInput"
                                            v-model="cvReference.position"
                                        />
                                    </div>
                                    <div class="input-field col s12 l6">
                                        <input
                                            type="text"
                                            class="validate cvSetupInput"
                                            placeholder="Location"
                                            v-model="cvReference.location"
                                        />
                                    </div>
                                    <div class="input-field col s12 l6">
                                        <input
                                            placeholder="Phone Number"
                                            type="text"
                                            class="validate cvSetupInput"
                                            v-model="cvReference.phone"
                                        />
                                    </div>
                                    <div class="input-field col s12 l6">
                                        <input
                                            type="email"
                                            class="validate cvSetupInput"
                                            placeholder="Email"
                                            v-model="cvReference.email"
                                        />
                                    </div>
                                </div>

                                <div class="row">
                                    <button
                                        @click.prevent="saveReference"
                                        class="
                                            waves-effect waves-green
                                            btn
                                            cvSetupSaveBtn right
                                        "
                                        v-if="!loading"
                                    >
                                        <span v-if="!cvReferenceUpdate">Save</span>
                                        <span v-else>Update</span>
                                    </button>
                                    <button
                                        class="
                                            waves-effect waves-green
                                            btn
                                            cvSetupSaveBtn right
                                        "
                                        v-else
                                    >
                                        <i class="fas fa-circle-notch fa-2x fa-spin"></i>
                                    </button>
                                </div>

                                <div class="cvNextStepBtnDiv1">
                                    <div class="right">
                                        <button
                                            @click="previous"
                                            class="
                                                waves-effect waves-green
                                                btn
                                                cvSetupBackStepBtn
                                            "
                                        >
                                            Experience
                                        </button>
                                        <button
                                            @click="saveAndNext"
                                            v-if="view != 5"
                                            class="
                                                waves-effect waves-green
                                                btn
                                                cvSetupNextStepBtn
                                            "
                                        >
                                            Licence
                                        </button>
                                    </div>
                                </div>

                                <div class="experiencesRow card" v-for="referrer in cvReferences" :key="referrer.id">
                                    <div class="ruleoutxt card-content" >
                                        <div class="flex">
                                            <i class="material-icons">account_circle</i>
                                            <h6>{{referrer.name || '-'}}</h6>
                                        </div>
                                        <div class="flex">
                                            <i class="material-icons">assignment_ind</i>
                                            <p>{{referrer.title || '-'}}</p>
                                        </div>
                                        <div class="flex">
                                            <i class="material-icons">home</i>
                                            <p>{{referrer.institution || '-'}}</p>
                                        </div>
                                        <div class="flex">
                                            <i class="material-icons">call</i>
                                            <p>{{referrer.phone || '-'}}</p>
                                        </div>
                                        <div class="flex">
                                            <i class="material-icons">location_on</i>
                                            <p>{{referrer.location || '-'}}</p>
                                        </div>
                                        <div class="flex">
                                            <i class="material-icons">account_box</i>
                                            <p>{{referrer.email || '-'}}</p>
                                        </div>
                                        <div class="row">
                                            <button class="btn waves waves-effect danger col s5 l2 m4" @click="deleteReferree(referrer)">Delete</button>
                                            <button class="btn waves waves-effect primary col s5 l2 offset-l2 m4 offset-m4 offset-s1" @click="populateReferree(referrer)">Edit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        License
                        <div v-show="view == 5">
                            <h6 class="cvSetupTitle">
                                Tell us about your License
                            </h6>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input
                                        placeholder="What year did you obtained your license"
                                        type="text"
                                        class="validate cvSetupInput1"
                                        v-model="license.year"
                                    />
                                </div>

                                <div class="input-field col s12">
                                    <input
                                        placeholder="How was this license obtained"
                                        type="text"
                                        class="validate cvSetupInput1"
                                        v-model="license.type"
                                    />
                                </div>

                                <div class="input-field col s12">
                                    <input
                                        placeholder="Location of issuance"
                                        type="text"
                                        class="validate cvSetupInput1"
                                        v-model="license.location"
                                    />
                                </div>
                            </div>

                            <div class="row">
                                <button
                                    @click.prevent="saveLicense"
                                    class="
                                        waves-effect waves-green
                                        btn
                                        cvSetupSaveBtn right
                                    "
                                    v-if="!loading"
                                >
                                    <span v-if="!licenseUpdate">Save</span>
                                    <span v-else>Update</span>
                                </button>
                                <button
                                    class="
                                        waves-effect waves-green
                                        btn
                                        cvSetupSaveBtn right
                                    "
                                    v-else
                                >
                                    <i class="fas fa-circle-notch fa-2x fa-spin"></i>
                                </button>
                            </div>

                            <div class="cvNextStepBtnDiv1">
                                <div class="right">
                                    <button
                                        @click="previous"
                                        class="
                                            waves-effect waves-green
                                            btn
                                            cvSetupBackStepBtn
                                        "
                                    >
                                        Reference
                                    </button>
                                    <a
                                        href="/"
                                        class="
                                            waves-effect waves-green
                                            btn
                                            cvSetupNextStepBtn
                                        "
                                    >
                                        Navigate to your Updated Website
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <FooterComponent />
                </div>
            </div>
        </div> -->
        <div class="container">
            <div class="card">
                <h3>Upload CV</h3>
                <div class="drop_box">
                    <div v-if="fileName == null">
                        <header>
                            <h4>Select File here</h4>
                        </header>
                        <p>Files Supported: PDF</p>
                        <input
                            type="file"
                            hidden
                            accept=".pdf"
                            id="fileID"
                            @change="handleFileChange"
                            style="display: none"
                        />
                        <button class="btn">Choose File</button>
                    </div>
                    <div v-else>
                        <form
                            action=""
                            method="post"
                            enctype="multipart/form-data"
                        >
                            <div class="form">
                                <h4 class="h4">{{ namedFile }}</h4>
                                <button class="btn" @click.prevent="uploadCV" :disabled="loading">
                                    <span v-if="!loading">Upload</span>
                                    <i class="fas fa-circle-notch fa-spin" v-else></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");
    @import url("https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap");

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
    }
    .fas {
        font-family: "Font Awesome 6 Free" !important;
    }

    .container {
        height: 70vh;
        width: 100%;
        align-items: center;
        display: flex;
        justify-content: center;
        background-color: #fcfcfc;
    }

    .card {
        border-radius: 10px;
        box-shadow: 0 5px 10px 0 rgba(0, 0, 0, 0.3);
        /* width: 600px; */
        width: 90%;
        height: 260px;
        background-color: #ffffff;
        padding: 10px 30px 40px;
    }

    .card h3 {
        font-size: 22px;
        font-weight: 600;
    }

    .drop_box {
        margin: 10px 0;
        padding: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        border: 3px dotted #a3a3a3;
        border-radius: 5px;
    }

    .drop_box h4 {
        font-size: 16px;
        font-weight: 400;
        color: #2e2e2e;
    }

    .drop_box p {
        margin-top: 10px;
        margin-bottom: 20px;
        font-size: 12px;
        color: #a3a3a3;
    }

    .btn {
        text-decoration: none;
        background-color: var(--primary);
        color: #ffffff;
        padding: 10px 20px;
        border: none;
        outline: none;
        transition: 0.3s;
        display: flex;
        align-items: center;
    }

    .btn:hover {
        text-decoration: none;
        background-color: #ffffff;
        color: #005af0;
        padding: 10px 20px;
        border: none;
        outline: 1px solid #010101;
    }
    .form input {
        margin: 10px 0;
        width: 100%;
        background-color: #e2e2e2;
        border: none;
        outline: none;
        padding: 12px 20px;
        border-radius: 4px;
    }

    .h4 {
        font-size: 1rem !important;
    }

    /* .custom-badge {
                width: 15px;
                height: 15px;
                background-color: rgb(175, 173, 173);
                border-radius: 15px;
            }
            .custom-badge.active {
                background-color: var(--primary);
            }
            .custom-badge.input-filled {
                background-color: rgb(98, 235, 98);
            }
            .text-center {
                display: flex;
                justify-content: center;
            } */
</style>
<script>
    import DatePicker from "vue-datepicker-next";
    import FooterComponent from "../../FooterComponent.vue";
    import "vue-datepicker-next/index.css";
    let cvXpo = "/api/cvexperience";
    let summy = "/api/cv";
    let training = "/api/cvtraining";
    let referal = "/api/cvreferral";
    let cvMed = "/api/cvmed_school";
    let cvOther = "/api/cv_otherschool";
    let underGrad = "/api/cv_gradschool";
    let license = "/api/license";
    let bio = "/api/bio";
    let countries = "https://whitecoatdomain.com/api/countries";

    export default {
        name: "CvModal",
        components: {
            FooterComponent,
            DatePicker,
        },
        mounted() {
            if (document.querySelector(".drop_box") != null) {
                const dropArea = document.querySelector(".drop_box"),
                    button = dropArea.querySelector("button"),
                    input = dropArea.querySelector("input");
    
                button.onclick = () => {
                    input.click();
                };
    
                input.addEventListener("change", function (e) {
                    this.namedFile = e.target.files[0].name;
                });
            }

            this.getData();
        },
        data() {
            return {
                namedFile: "",
                fileName: null,
                activities: [],
                activity: "",
                cities: [],
                countries: [],
                countrySelected: "",
                cvTraining: "",
                cv: {
                    summary: "",
                    skills: [],
                    title: "",
                },
                cvMedSchool: {
                    institution: "",
                    yearStart: "",
                    yearEnd: "",
                    monthStart: "",
                    monthEnd: "",
                    type: "",
                },
                cvGradSchool: {
                    institution: "",
                    yearStart: "",
                    yearEnd: "",
                    monthStart: "",
                    monthEnd: "",
                    major: "",
                    minor: "",
                },
                cvAdditionalSchool: {
                    institution: "",
                    yearStart: "",
                    yearEnd: "",
                    monthStart: "",
                    monthEnd: "",
                    title: "",
                    degree: "",
                },
                cvExperience: {
                    institution: "",
                    yearStart: "",
                    yearEnd: "",
                    monthStart: "",
                    monthEnd: "",
                    city_id: "",
                    activities: [{ activity: "" }],
                },
                cvExperiences: [],
                cvTrainingsResidency: {
                    institution: "",
                    yearStart: "",
                    yearEnd: "",
                    monthStart: "",
                    monthEnd: "",
                    title: "",
                    location: "",
                    specialty: "",
                    sub_specialty: "",
                    type: "residency",
                },

                cvTrainingsFellowship: {
                    institution: "",
                    yearStart: "",
                    yearEnd: "",
                    monthStart: "",
                    monthEnd: "",
                    title: "",
                    location: "",
                    specialty: "",
                    sub_specialty: "",
                    type: "fellowship",
                },

                cvTrainingsIntern: {
                    institution: "",
                    yearStart: "",
                    yearEnd: "",
                    monthStart: "",
                    monthEnd: "",
                    title: "",
                    location: "",
                    type: "internship",
                },

                cvReference: {
                    name: "",
                    location: "",
                    phone: "",
                    position: "",
                    title: "",
                    institution: "",
                    email: "",
                },
                cvReferences: [],
                cvExperienceUpdate: 0,
                cvExperienceActivityRemoved: [],
                cvExperienceRemoved: [],
                cvTrainingRemoved: [],
                cvTrainingUpdate: 0,
                cvReferencesRemoved: [],
                edu: 0,
                fetching: false,
                license: {
                    year: "",
                    issuance: "",
                    location: "",
                    type: "",
                },
                loading: false,
                states: [],
                stateSelected: "",
                showEduForm: false,
                view: 0,
                medSchoolInput: 0,
                medSchoolCount: 3,
                medSchoolOnly: false,
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
                undergradSchoolInput: 0,
                undergradSchoolCount: 4,
                showTrainingForm: false,
                showTrainingInputs: 0,
                showTrainingInputCount: 4,
                showExperienceForm: false,
                showExperienceInputs: 0,
                showExperienceInputCount: 4,
                showReferralForm: false,
                showRefferalInputs: 0,
                showRefferalInputCount: 4,
                trainingSetup: 0,
                trainings: [],
                cvMedSchoolUpdate: 0,
                cvGradSchoolUpdate: 0,
                cvAdditionalSchoolUpdate: 0,
                cvUpdate: 0,
                cvReferenceUpdate: 0,
                licenseUpdate: 0,
            };
        },
        methods: {
            uploadCV() {
                this.loading = true;
                const formData = new FormData();
                formData.append("cvfile", this.fileName);

                axios
                    .post("/api/upload-cv", formData)
                    .then((response) => {
                        if(response.status === 201) {
                            this.loading = false;
                            M.toast({html:'Upload Is Successfull!', classes: 'successNotifier'})
                            this.$emit('backToSettings');
                        }
                        console.log(response)
                        // Handle the response after successful upload
                    })
                    .catch((error) => {
                        console.log(error);
                        // Handle any errors that occur during the upload
                    });
            },
            handleFileChange(e) {
                const file = e.target.files[0];
                this.fileName = file;
                this.namedFile = file.name;
            },
            /********************************************************** For Incoming Requests ******************************************/
            getData() {
                this.fetching = true;
                const requestSummary = axios.get(summy);
                const requestCvXpo = axios.get(cvXpo);
                const requesTraining = axios.get(training);
                const requestReferral = axios.get(referal);
                const requestMedSchool = axios.get(cvMed);
                const requestOtherSchool = axios.get(cvOther);
                const requestUnderGrad = axios.get(underGrad);
                const requestLicense = axios.get(license);
                const requestBio = axios.get(bio);
                const requestCountry = axios.get(countries);
                axios
                    .all([
                        requestSummary,
                        requestCvXpo,
                        requesTraining,
                        requestReferral,
                        requestMedSchool,
                        requestOtherSchool,
                        requestUnderGrad,
                        requestLicense,
                        requestBio,
                        requestCountry,
                    ])
                    .then(
                        axios.spread((...responses) => {
                            const summaryRes = responses[0];
                            const cvExpRes = responses[1];
                            const trainingRes = responses[2];
                            const referralRes = responses[3];
                            const medSchoolRes = responses[4];
                            const otherSchoolRes = responses[5];
                            const underGradRes = responses[6];
                            const licenseRes = responses[7];
                            const bioRes = responses[8];
                            const countryRes = responses[9];

                            this.countries = countryRes.data.countries;
                            this.countries.sort(function (x, y) {
                                return x.name == "United States" ||
                                    x.name == "Canada"
                                    ? -1
                                    : y.name == "United States" ||
                                      y.name == "Canada"
                                    ? 1
                                    : 0;
                            });

                            if (summaryRes.data.cvSummary !== null) {
                                this.cv = summaryRes.data.cvSummary;
                                this.cvUpdate = 1;
                            }
                            this.cvExperiences = cvExpRes.data.experience;
                            this.cvExperiences.length !== 0
                                ? this.getStateNCity()
                                : 0; //     // let res = ;
                            //     console.log();
                            //     // this.cvExperiences[index].state = res.data.state;
                            //     // el.state =
                            // }) : 0;
                            this.trainings = trainingRes.data.trainings;
                            this.trainings.length !== 0
                                ? this.populateTraining()
                                : null;
                            this.cvReferences = referralRes.data.referral;
                            if (medSchoolRes.data.medSchool !== null) {
                                let e = medSchoolRes.data.medSchool;
                                this.cvMedSchool = e;
                                this.cvMedSchool.yearStart = new Date(
                                    `${e.yearStart}`
                                );
                                this.cvMedSchool.yearEnd = new Date(`${e.yearEnd}`);
                                this.cvMedSchoolUpdate = 1;
                            }
                            if (otherSchoolRes.data.additionalSchool !== null) {
                                let e = otherSchoolRes.data.additionalSchool;
                                this.cvAdditionalSchool = e;
                                this.cvAdditionalSchool.yearStart = new Date(
                                    `${e.yearStart}`
                                );
                                this.cvAdditionalSchool.yearEnd = new Date(
                                    `${e.yearEnd}`
                                );
                                this.cvAdditionalSchoolUpdate = 1;
                            }
                            if (underGradRes.data.underGradSchool !== null) {
                                let e = underGradRes.data.underGradSchool;
                                this.cvGradSchool = e;
                                this.cvGradSchool.yearStart = new Date(
                                    `${e.yearStart}`
                                );
                                this.cvGradSchool.yearEnd = new Date(
                                    `${e.yearEnd}`
                                );
                                this.cvGradSchoolUpdate = 1;
                            }
                            if (licenseRes.data.license !== null) {
                                this.license = licenseRes.data.license;
                                this.licenseUpdate = 1;
                            }

                            if (this.cv.summary === "") {
                                this.cv.summary = bioRes.data.bio.about;
                            }
                            this.fetching = false;
                        })
                    )
                    .catch((errors) => {
                        console.log(errors);
                    });
            },
            getStateNCity() {
                this.cvExperiences.forEach((el, index) => {
                    axios
                        .get(
                            `https://whitecoatdomain.com/api/getStateNCity/${el.city_id}`
                        )
                        .then((res) => {
                            this.cvExperiences[index] = {
                                ...this.cvExperiences[index],
                                state: res.data.state,
                                city: res.data.city,
                            };
                        })
                        .catch((err) => {
                            console.log(err);
                        });
                });
            },
            sortCities() {
                axios
                    .get(
                        `https://whitecoatdomain.com/api/cities/${this.stateSelected}`
                    )
                    .then((res) => {
                        if (res.data.status == 200) {
                            this.cities = res.data.cities;
                        } else {
                            M.toast({
                                html: "Error getting cities",
                                classes: "errorNotifier",
                            });
                        }
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            },
            sortStates() {
                axios
                    .get(
                        `https://whitecoatdomain.com/api/states/${this.countrySelected}`
                    )
                    .then((res) => {
                        if (res.data.status == 200) {
                            this.states = res.data.states;
                        } else {
                            M.toast({
                                html: "Error getting states",
                                classes: "errorNotifier",
                            });
                        }
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            },
            deleteMe(e) {
                axios
                    .delete(`/api/cvexperience/${e.id}`)
                    .then((res) => {
                        if (res.status === 204) {
                            M.toast({
                                html: "Deleted onSuccess!",
                                classess: "successNotifier",
                            });
                            this.cvExperiences.splice(
                                this.cvExperiences.findIndex(
                                    (expo) => expo.id === e.id
                                ),
                                1
                            );
                        }
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            },
            deleteReferree(e) {
                axios
                    .delete(`/api/cvreferral/${e.id}`)
                    .then((res) => {
                        if (res.status === 204) {
                            M.toast({
                                html: "Deleted onSuccess!",
                                classess: "successNotifier",
                            });
                            this.cvReferences.splice(
                                this.cvReferences.findIndex(
                                    (expo) => expo.id === e.id
                                ),
                                1
                            );
                        }
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            },
            populateReferree(e) {
                this.cvReference = e;
                this.cvReferenceUpdate = 1;
                window.scrollTo(100, 0);
            },
            populateCvExpo(e) {
                this.cvExperience = e;
                this.cvExperience.yearStart = new Date(`${e.yearStart}`);
                this.cvExperience.yearEnd = new Date(`${e.yearEnd}`);
                this.cvExperienceUpdate = 1;
                this.countrySelected = e.city.country_id;
                this.sortStates();
                this.stateSelected = e.city.state_id;
                this.sortCities();
            },
            populateTraining() {
                let internship = this.trainings.find(
                    (el) => el.type === "internship"
                );
                if (internship !== undefined) {
                    this.cvTrainingsIntern = internship;
                    this.cvTrainingsIntern.yearStart = new Date(
                        `${internship.yearStart}`
                    );
                    this.cvTrainingsIntern.yearEnd = new Date(
                        `${internship.yearEnd}`
                    );
                }

                let fellowship = this.trainings.find(
                    (el) => el.type === "fellowship"
                );
                if (fellowship !== undefined) {
                    this.cvTrainingsFellowship = fellowship;
                    this.cvTrainingsFellowship.yearStart = new Date(
                        `${fellowship.yearStart}`
                    );
                    this.cvTrainingsFellowship.yearEnd = new Date(
                        `${fellowship.yearEnd}`
                    );
                }

                let residency = this.trainings.find(
                    (el) => el.type === "residency"
                );
                if (residency !== undefined) {
                    this.cvTrainingsResidency = residency;
                    this.cvTrainingsResidency.yearStart = new Date(
                        `${residency.yearStart}`
                    );
                    this.cvTrainingsResidency.yearEnd = new Date(
                        `${residency.yearEnd}`
                    );
                }
                this.cvTrainingUpdate = 1;
            },

            saveLicense() {
                this.loading = !this.loading;
                let request;
                if (this.licenseUpdate == 1) {
                    request = axios.put(
                        `/api/license/${this.license.id}`,
                        this.license
                    );
                } else request = axios.post(`/api/license`, this.license);
                request
                    .then((res) => {
                        if (res.status === 201 || res.data.status === 200) {
                            this.loading = !this.loading;
                            M.toast({
                                html: res.data.message,
                                classes: "successNotifier",
                            });
                        }
                    })
                    .catch((err) => {
                        if (err.response.status == 400) {
                            this.loading = !this.loading;
                            err.response.data.errors.forEach((el) => {
                                M.toast({
                                    html: el,
                                    classes: "errorNotifier",
                                });
                            });
                        }
                    });
            },
            prevEduBtn() {
                if (this.undergradSchoolInput !== 0) {
                    if (!this.medSchoolOnly) {
                        this.undergradSchoolInput--;
                    } else if (this.medSchoolOnly) {
                        this.undergradSchoolInput = 1;
                    }
                }
            },
            nextEduBtn() {
                if (this.undergradSchoolInput === 0) {
                    this.saveUnderGradSchool();
                }
                if (this.undergradSchoolInput !== 2) {
                    this.undergradSchoolInput++;
                }
            },
            previous() {
                this.view != 0 ? this.view-- : null;
            },
            saveAndNext() {
                this.view != 5 ? this.view++ : null;
            },
            saveCV() {
                this.loading = !this.loading;
                let formData = new FormData();
                let request = `/api/cv`;
                if (this.cvUpdate == 1) {
                    formData.append("_method", "PUT");
                    request = `/api/cv/${this.cv.id}`;
                }
                formData.append("skills", JSON.stringify(this.cv.skills));
                formData.append("summary", this.cv.summary);
                formData.append("title", this.cv.title);
                axios
                    .post(request, formData)
                    .then((res) => {
                        if (res.status == 201 || res.data.status == 200) {
                            this.loading = !this.loading;
                            M.toast({
                                html: res.data.message,
                                classes: "successNotifier",
                            });
                        }
                    })
                    .catch((err) => {
                        if (err.response.status == 400) {
                            this.loading = !this.loading;
                            err.response.data.forEach((el) => {
                                M.toast({
                                    html: el,
                                    classes: "errorNotifier",
                                });
                            });
                        }
                    });
            },
            saveCont() {
                this.edu = 1;
            },
            saveEdu() {
                if (this.edu == 0) {
                    this.saveMedSchool();
                } else if (this.edu == 1) {
                    this.saveUnderGradSchool();
                } else if (this.edu == 2) {
                    this.saveOtherSchool();
                }
            },
            saveExperience() {
                this.loading = !this.loading;
                this.cvExperience.yearStart = new Date(
                    `${this.cvExperience.yearStart}`
                ).getFullYear();
                this.cvExperience.yearEnd = new Date(
                    `${this.cvExperience.yearEnd}`
                ).getFullYear();
                // this.cvExperiences.forEach((el) => JSON.stringify(el.activities));

                // let formData = new FormData();
                let request;
                if (this.cvExperienceUpdate == 1) {
                    // formData.append("_method", "PUT");
                    request = axios.put(
                        `/api/cvexperience/${this.cvExperience.id}`,
                        this.cvExperience
                    );
                } else request = axios.post(`/api/cvexperience`, this.cvExperience);
                // formData.append("data", this.cvExperience);
                request
                    .then((res) => {
                        if (res.status == 201 || res.data.status == 200) {
                            this.loading = !this.loading;
                            M.toast({
                                html: res.data.message,
                                classes: "successNotifier",
                            });

                            axios
                                .get(
                                    `https://whitecoatdomain.com/api/getStateNCity/${this.cvExperience.city_id}`
                                )
                                .then((res1) => {
                                    this.cvExperience = {
                                        ...this.cvExperience,
                                        state: res1.data.state,
                                        city: res1.data.city,
                                    };
                                    res.status === 201
                                        ? this.cvExperiences.unshift(
                                              this.cvExperience
                                          )
                                        : null;
                                    this.cvExperience = {
                                        institution: "",
                                        yearStart: "",
                                        yearEnd: "",
                                        monthStart: "",
                                        monthEnd: "",
                                        city_id: "",
                                        activities: [{ activity: "" }],
                                    };
                                    this.countrySelected = "";
                                    this.stateSelected = "";
                                })
                                .catch((err) => {
                                    console.log(err);
                                });
                        }
                    })
                    .catch((err) => {
                        console.log(err);
                        if (err.response.status == 400) {
                            this.loading = !this.loading;
                            err.response.data.forEach((el) => {
                                M.toast({
                                    html: el,
                                    classes: "errorNotifier",
                                });
                            });
                        }
                    });
            },
            saveMedSchool() {
                this.loading = !this.loading;
                this.cvMedSchool.yearStart = new Date(
                    `${this.cvMedSchool.yearStart}`
                ).getFullYear();
                this.cvMedSchool.yearEnd = new Date(
                    `${this.cvMedSchool.yearEnd}`
                ).getFullYear();
                let request = `/api/cvmed_school`;
                let data = {
                    _method: "PUT",
                };
                if (this.cvMedSchoolUpdate == 1) {
                    request = `/api/cvmed_school/${this.cvMedSchool.id}`;
                    this.cvMedSchool = { ...this.cvMedSchool, ...data };
                }
                axios
                    .post(request, this.cvMedSchool)
                    .then((res) => {
                        if (res.status == 201 || res.data.status == 200) {
                            this.loading = !this.loading;
                            M.toast({
                                html: res.data.message,
                                classes: "successNotifier",
                            });
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
            saveOtherSchool() {
                this.loading = !this.loading;
                let request = `/api/cv_otherschool`;
                this.cvAdditionalSchool.yearStart = new Date(
                    `${this.cvAdditionalSchool.yearStart}`
                ).getFullYear();
                this.cvAdditionalSchool.yearEnd = new Date(
                    `${this.cvAdditionalSchool.yearEnd}`
                ).getFullYear();
                let data = {
                    _method: "PUT",
                };
                if (this.cvAdditionalSchoolUpdate == 1) {
                    request = `/api/cv_otherschool/${this.cvAdditionalSchool.id}`;
                    this.cvAdditionalSchool = {
                        ...this.cvAdditionalSchool,
                        ...data,
                    };
                }
                axios
                    .post(request, this.cvAdditionalSchool)
                    .then((res) => {
                        if (res.status == 201 || res.data.status == 200) {
                            this.loading = !this.loading;
                            M.toast({
                                html: res.data.message,
                                classes: "successNotifier",
                            });
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
            saveReference() {
                this.loading = !this.loading;
                let request;
                if (this.cvReferenceUpdate == 1) {
                    request = axios.put(
                        `/api/cvreferral/${this.cvReference.id}`,
                        this.cvReference
                    );
                } else request = axios.post(`/api/cvreferral`, this.cvReference);
                request
                    .then((res) => {
                        if (res.status === 201 || res.data.status === 200) {
                            this.loading = !this.loading;
                            M.toast({
                                html: res.data.message,
                                classes: "successNotifier",
                            });
                            res.status === 201
                                ? this.cvReferences.push(this.cvReference)
                                : null;
                            this.cvReference = {
                                name: "",
                                location: "",
                                phone: "",
                                position: "",
                                title: "",
                                institution: "",
                                email: "",
                            };
                            res.data.status === 200
                                ? (this.cvReferenceUpdate = 0)
                                : null;
                        }
                    })
                    .catch((err) => {
                        if (err.response.status == 400) {
                            this.loading = !this.loading;
                            err.response.data.forEach((el) => {
                                M.toast({
                                    html: el,
                                    classes: "errorNotifier",
                                });
                            });
                        }
                    });
            },
            saveTraining() {
                this.loading = !this.loading;
                let cvTrainings = [];
                if (this.cvTrainingsFellowship.institution !== "") {
                    this.cvTrainingsFellowship.yearStart = new Date(
                        `${this.cvTrainingsFellowship.yearStart}`
                    ).getFullYear();
                    this.cvTrainingsFellowship.yearEnd = new Date(
                        `${this.cvTrainingsFellowship.yearEnd}`
                    ).getFullYear();
                    cvTrainings.push(this.cvTrainingsFellowship);
                }
                if (this.cvTrainingsIntern.institution !== "") {
                    this.cvTrainingsIntern.yearStart = new Date(
                        `${this.cvTrainingsIntern.yearStart}`
                    ).getFullYear();
                    this.cvTrainingsIntern.yearEnd = new Date(
                        `${this.cvTrainingsIntern.yearEnd}`
                    ).getFullYear();
                    cvTrainings.push(this.cvTrainingsIntern);
                }
                if (this.cvTrainingsResidency.institution !== "") {
                    this.cvTrainingsResidency.yearStart = new Date(
                        `${this.cvTrainingsResidency.yearStart}`
                    ).getFullYear();
                    this.cvTrainingsResidency.yearEnd = new Date(
                        `${this.cvTrainingsResidency.yearEnd}`
                    ).getFullYear();
                    cvTrainings.push(this.cvTrainingsResidency);
                }
                let formData = new FormData();
                let request = `/api/cvtraining`;
                if (this.cvTrainingUpdate == 1) {
                    formData.append("_method", "PUT");
                }
                formData.append("data", JSON.stringify(cvTrainings));
                axios
                    .post(request, formData)
                    .then((res) => {
                        if (res.status == 201 || res.data.status == 200) {
                            this.loading = !this.loading;
                            M.toast({
                                html: res.data.message,
                                classes: "successNotifier",
                            });
                        }
                    })
                    .catch((err) => {
                        if (err.response.status == 400) {
                            this.loading = !this.loading;
                            err.response.data.forEach((el) => {
                                M.toast({
                                    html: el,
                                    classes: "errorNotifier",
                                });
                            });
                        }
                    });
            },
            saveUnderGradSchool() {
                this.loading = !this.loading;
                if (
                    this.cvGradSchool.institution !== "" ||
                    this.cvGradSchool.monthEnd !== "" ||
                    this.cvGradSchool.yearEnd !== "" ||
                    this.cvGradSchool.yearStart !== "" ||
                    this.cvGradSchool.monthEnd !== ""
                )
                    this.cvGradSchool.yearStart = new Date(
                        `${this.cvGradSchool.yearStart}`
                    ).getFullYear();
                this.cvGradSchool.yearEnd = new Date(
                    `${this.cvGradSchool.yearEnd}`
                ).getFullYear();
                let request = `/api/cv_gradschool`;
                let data = {
                    _method: "PUT",
                };
                if (this.cvGradSchoolUpdate === 1) {
                    request = `/api/cv_gradschool/${this.cvGradSchool.id}`;
                    this.cvGradSchool = { ...this.cvGradSchool, ...data };
                }
                axios
                    .post(request, this.cvGradSchool)
                    .then((res) => {
                        if (res.status == 201 || res.data.status == 200) {
                            this.loading = !this.loading;
                            // M.toast({
                            //     html: res.data.message,
                            //     classes: "successNotifier",
                            // });
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
            showEdu() {
                this.showEduForm = !this.showEduForm;
            },
            saveMedSchoolTest() {
                this.edu = "";
            },
            procNo() {
                this.saveAndNext();
            },
            sumHeaderLink() {
                this.view = 0;
            },
            eduHeaderLink() {
                this.view = 1;
            },
            trainHeaderLink() {
                this.view = 2;
            },
            expHeaderLink() {
                this.view = 3;
            },
            refHeaderLink() {
                this.view = 4;
            },
            licHeaderLink() {
                this.view = 5;
            },
        },
    };
</script>
