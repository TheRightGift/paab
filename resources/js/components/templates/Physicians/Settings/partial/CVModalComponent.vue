<template>
    <div id="cvModal" class="modal">
        <!-- <ul class="cvModalLinkHolder hide-on-med-and-down">
            <li class="cvModalLinkList">
                <a href="#" class="cvModalLink" @click="sumHeaderLink()">
                    <span
                        class="cvModalLinkNum"
                        :class="view == 0 ? 'active' : ''"
                        >1</span
                    >
                    Summary
                </a>
            </li>
            <li class="cvModalLinkList">
                <a href="#" class="cvModalLink" @click="eduHeaderLink()">
                    <span
                        class="cvModalLinkNum"
                        :class="view == 1 ? 'active' : ''"
                        >2</span
                    >
                    Education
                </a>
            </li>
            <li class="cvModalLinkList">
                <a href="#" class="cvModalLink" @click="trainHeaderLink()">
                    <span
                        class="cvModalLinkNum"
                        :class="view == 2 ? 'active' : ''"
                        >3</span
                    >
                    Training
                </a>
            </li>
            <li class="cvModalLinkList">
                <a href="#" class="cvModalLink" @click="expHeaderLink()">
                    <span
                        class="cvModalLinkNum"
                        :class="view == 3 ? 'active' : ''"
                        >4</span
                    >
                    Experience
                </a>
            </li>
            <li class="cvModalLinkList">
                <a href="#" class="cvModalLink" @click="refHeaderLink()">
                    <span
                        class="cvModalLinkNum"
                        :class="view == 4 ? 'active' : ''"
                        >5</span
                    >
                    Reference
                </a>
            </li>
            <li class="cvModalLinkList">
                <a href="#" class="cvModalLink" @click="licHeaderLink()">
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
        <div class="modal-content">
            <div v-show="view == 0">
                <h4 class="cvSetupTitle">Let us know more about you</h4>
                <textarea
                    placeholder="Typing..."
                    id=""
                    cols="30"
                    rows="10"
                    v-model="cv.summary"
                    class="cvSetupTextarea"
                ></textarea>
                <small class="maxChar right"
                    >Maximum characters should be 600 words</small
                >


                <div>
                    <button
                        @click.prevent="saveCV"
                        class="waves-effect waves-green btn cvSetupSaveBtn"
                        v-if="!loading"
                    >
                        Save
                    </button>
                    <button v-if="loading" class="btn">
                        <div class="preloader-wrapper small active">
                            <div class="spinner-layer spinner-white-only">
                                <div class="circle-clipper left">
                                    <div class="circle"></div>
                                </div>
                                <div class="gap-patch">
                                    <div class="circle"></div>
                                </div>
                                <div class="circle-clipper right">
                                    <div class="circle"></div>
                                </div>
                            </div>
                        </div>
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
                                    >I attended med school and undergrad
                                    school</span
                                >
                            </label>
                            <label class="cvSetupRadioBtnHolder">
                                <input
                                    class="with-gap cvSetupRadioBtn"
                                    name="group1"
                                    type="radio"
                                    @click="edu = 2"
                                />
                                <span class="cvSetupRadioBtnSpan"
                                    >I only attended med school</span
                                >
                            </label>
                        </div>
                    </div>
                </div>

                <div v-show="showEduForm">
                    <div v-if="edu === 1">
                        <h6 class="cvSetupTitle">
                            Tell us about your time in Med School
                            <small
                                >Important so that patients can view your
                                site</small
                            >
                        </h6>
                        <div class="row" v-show="medSchoolInput == 0">
                            <div class="input-field col s12">
                                <input
                                    placeholder="Institution"
                                    type="text"
                                    class="validate"
                                    v-model="cvMedSchool.institution"
                                />
                            </div>
                        </div>
                        <div class="row" v-show="medSchoolInput == 1">
                            <div class="col s12">
                                <label>Browser Select</label>
                                <select
                                    class="browser-default"
                                    v-model="cvMedSchool.type"
                                >
                                    <option value="" disabled selected>
                                        Choose your degree
                                    </option>
                                    <option value="MD">MD</option>
                                    <option value="DO">DO</option>
                                </select>
                            </div>
                        </div>
                        <div class="row" v-show="medSchoolInput == 2">
                            <div class="input-field col s6">
                                <input
                                    placeholder="Start(Year)"
                                    type="text"
                                    class="validate"
                                    v-model="cvMedSchool.yearStart"
                                />
                            </div>
                            <div class="input-field col s6">
                                <input
                                    type="text"
                                    class="validate"
                                    placeholder="Start(Month)"
                                    v-model="cvMedSchool.monthStart"
                                />
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <input
                                        placeholder="End(Year)"
                                        type="text"
                                        class="validate"
                                        v-model="cvMedSchool.yearEnd"
                                    />
                                </div>
                                <div class="input-field col s6">
                                    <input
                                        type="text"
                                        class="validate"
                                        placeholder="End(Month)"
                                        v-model="cvMedSchool.monthEnd"
                                    />
                                </div>
                            </div>
                            <button
                                v-if="!loading"
                                class="btn waves waves-effect"
                                @click.prevent="saveMedSchoolTest"
                            >
                                Save
                            </button>
                            <button v-if="loading" class="btn">
                                <div class="preloader-wrapper small active">
                                    <div
                                        class="
                                            spinner-layer spinner-white-only
                                        "
                                    >
                                        <div class="circle-clipper left">
                                            <div class="circle"></div>
                                        </div>
                                        <div class="gap-patch">
                                            <div class="circle"></div>
                                        </div>
                                        <div class="circle-clipper right">
                                            <div class="circle"></div>
                                        </div>
                                    </div>
                                </div>
                            </button>
                        </div>
                    </div>
                    <div v-if="edu === 0">
                        <div v-show="undergradSchoolInput == 0">
                            <div class="cvSetupEduIndicatorDiv">
                                <p class="cvSetupEduIndicatorP">
                                    Undergrad School
                                </p>
                                <p class="cvSetupEduIndicatorP">
                                    Medical School
                                </p>
                                <p class="cvSetupEduIndicatorP">Other</p>
                            </div>
                            <h6 class="cvSetupTitle">
                                Tell us about your time in Undergrad School
                            </h6>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input
                                        placeholder="Institution"
                                        type="text"
                                        class="validate cvSetupInput1"
                                        v-model="cvGradSchool.institution"
                                    />
                                </div>
                                <div class="input-field col s12 l6">
                                    <input
                                        placeholder=" Major"
                                        type="text"
                                        class="validate cvSetupInput"
                                        v-model="cvGradSchool.major"
                                    />
                                </div>
                                <div class="input-field col s12 l6">
                                    <input
                                        placeholder="Minor (Optional)"
                                        type="text"
                                        class="validate cvSetupInput"
                                        v-model="cvGradSchool.minor"
                                    />
                                </div>
                                <div class="input-field col s12 l6">
                                    <input
                                        placeholder="Start (Year)"
                                        type="text"
                                        class="validate cvSetupInput"
                                        v-model="cvGradSchool.yearStart"
                                    />
                                </div>
                                <div class="input-field col s12 l6">
                                    <input
                                        type="text"
                                        class="validate cvSetupInput"
                                        placeholder="Start (Month)"
                                        v-model="cvGradSchool.monthStart"
                                    />
                                </div>
                                <div class="input-field col s12 l6">
                                    <input
                                        placeholder="End (Year)"
                                        type="text"
                                        class="validate cvSetupInput"
                                        v-model="cvGradSchool.yearEnd"
                                    />
                                </div>
                                <div class="input-field col s12 l6">
                                    <input
                                        type="text"
                                        class="validate cvSetupInput"
                                        placeholder="End (Month)"
                                        v-model="cvGradSchool.monthEnd"
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="row" v-show="undergradSchoolInput == 1">
                            <div class="cvSetupEduIndicatorDiv">
                                <p class="cvSetupEduIndicatorP">
                                    <i
                                        class="
                                            material-icons
                                            cvSetupEduIndicatorIcon
                                        "
                                        >check</i
                                    >
                                    Undergrad School
                                </p>
                                <p class="cvSetupEduIndicatorP">
                                    Medical School
                                </p>
                                <p class="cvSetupEduIndicatorP">Other</p>
                            </div>
                            <h6 class="cvSetupTitle">
                                Tell us about your time in medical school
                            </h6>
                            <div class="row">
                                <div class="row lt_mb">
                                    <div class="input-field col s12 l6">
                                        <input
                                            placeholder="Institution"
                                            type="text"
                                            class="validate cvSetupInput"
                                            v-model="
                                                cvGradSchool.institution
                                            "
                                        />
                                    </div>
                                    <div class="input-field col s12 l6">
                                        <select
                                            class="
                                                browser-default
                                                cvSetupInput
                                            "
                                            v-model="cvMedSchool.type"
                                        >
                                            <option
                                                value=""
                                                disabled
                                                selected
                                            >
                                                Choose your degree
                                            </option>
                                            <option value="MD">MD</option>
                                            <option value="DO">DO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row lt_mb">
                                    <div class="input-field col s12 l6">
                                        <input
                                            placeholder="Start (Year)"
                                            type="text"
                                            class="validate cvSetupInput"
                                            v-model="cvGradSchool.yearStart"
                                        />
                                    </div>
                                    <div class="input-field col s12 l6">
                                        <input
                                            type="text"
                                            class="validate cvSetupInput"
                                            placeholder="Start (Month)"
                                            v-model="
                                                cvGradSchool.monthStart
                                            "
                                        />
                                    </div>
                                </div>
                                <div class="row lt_mb">
                                    <div class="input-field col s12 l6">
                                        <input
                                            placeholder="End (Year)"
                                            type="text"
                                            class="validate cvSetupInput"
                                            v-model="cvGradSchool.yearEnd"
                                        />
                                    </div>
                                    <div class="input-field col s12 l6">
                                        <input
                                            type="text"
                                            class="validate cvSetupInput"
                                            placeholder="End (Month)"
                                            v-model="cvGradSchool.monthEnd"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" v-show="undergradSchoolInput == 2">
                            <div class="cvSetupEduIndicatorDiv">
                                <p class="cvSetupEduIndicatorP">
                                    <i
                                        class="
                                            material-icons
                                            cvSetupEduIndicatorIcon
                                        "
                                        >check</i
                                    >
                                    Undergrad School
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
                                <p class="cvSetupEduIndicatorP">Other</p>
                            </div>
                            <h6 class="cvSetupTitle">
                                Any other school attended?
                                <small>optional</small>
                            </h6>
                            <div class="row">
                                <div class="row lt_mb">
                                    <div class="input-field col s12">
                                        <input
                                            placeholder="Institution"
                                            type="text"
                                            class="validate cvSetupInput1"
                                            v-model="
                                                cvGradSchool.institution
                                            "
                                        />
                                    </div>
                                </div>
                                <div class="row lt_mb">
                                    <div class="input-field col s12 l6">
                                        <input
                                            placeholder="Title"
                                            type="text"
                                            class="validate cvSetupInput"
                                            v-model="
                                                cvGradSchool.institution
                                            "
                                        />
                                    </div>
                                    <div class="input-field col s12 l6">
                                        <select
                                            class="
                                                browser-default
                                                cvSetupInput
                                            "
                                            v-model="cvMedSchool.type"
                                        >
                                            <option
                                                value=""
                                                disabled
                                                selected
                                            >
                                                Choose your degree
                                            </option>
                                            <option value="MD">MD</option>
                                            <option value="DO">DO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row lt_mb">
                                    <div class="input-field col s12 l6">
                                        <input
                                            placeholder="Start (Year)"
                                            type="text"
                                            class="validate cvSetupInput"
                                            v-model="cvGradSchool.yearStart"
                                        />
                                    </div>
                                    <div class="input-field col s12 l6">
                                        <input
                                            type="text"
                                            class="validate cvSetupInput"
                                            placeholder="Start (Month)"
                                            v-model="
                                                cvGradSchool.monthStart
                                            "
                                        />
                                    </div>
                                </div>
                                <div class="row lt_mb">
                                    <div class="input-field col s12 l6">
                                        <input
                                            placeholder="End (Year)"
                                            type="text"
                                            class="validate cvSetupInput"
                                            v-model="cvGradSchool.yearEnd"
                                        />
                                    </div>
                                    <div class="input-field col s12 l6">
                                        <input
                                            type="text"
                                            class="validate cvSetupInput"
                                            placeholder="End (Month)"
                                            v-model="cvGradSchool.monthEnd"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="right">
                                <a
                                    href="#!"
                                    class="chevronIconLink"
                                    @click="
                                        undergradSchoolInput != 0
                                            ? undergradSchoolInput--
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
                                        undergradSchoolInput != 2
                                            ? undergradSchoolInput++
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
                        <div
                            class="cvNextStepBtnDiv1"
                            v-show="undergradSchoolInput == 2"
                        >
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
                                    Training
                                </button>
                            </div>
                        </div>
                    </div>
                    <div v-if="edu === 2">
                        <h6>
                            Any other school you attended, you want to add ?
                            <small>Optional</small>
                        </h6>
                        <div class="row">
                            <div class="input-field col s12">
                                <input
                                    placeholder="Institution"
                                    type="text"
                                    class="validate"
                                    v-model="cvAdditionalSchool.institution"
                                />
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s8">
                                <input
                                    placeholder="Title"
                                    id="first_name"
                                    type="text"
                                    class="validate"
                                    v-model="cvAdditionalSchool.title"
                                />
                            </div>
                            <div class="input-field col s4">
                                <input
                                    placeholder="Degree"
                                    type="text"
                                    class="validate"
                                    v-model="cvAdditionalSchool.degree"
                                />
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s3">
                                <input
                                    placeholder="Start(Year)"
                                    type="text"
                                    class="validate"
                                    v-model="cvAdditionalSchool.yearStart"
                                />
                            </div>
                            <div class="input-field col s3">
                                <input
                                    type="text"
                                    class="validate"
                                    placeholder="Start(Month)"
                                    v-model="cvAdditionalSchool.monthStart"
                                />
                            </div>
                            <div class="input-field col s3">
                                <input
                                    placeholder="End(Year)"
                                    type="text"
                                    class="validate"
                                    v-model="cvAdditionalSchool.yearEnd"
                                />
                            </div>
                            <div class="input-field col s3">
                                <input
                                    type="text"
                                    class="validate"
                                    placeholder="End(Month)"
                                    v-model="cvAdditionalSchool.monthEnd"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-show="view == 2">
                <div v-if="trainingSetup == 0">
                    <div class="cvSetupEduIndicatorDiv">
                        <p class="cvSetupEduIndicatorP">Internship</p>
                        <p class="cvSetupEduIndicatorP">Fellowship</p>
                        <p class="cvSetupEduIndicatorP">Residency</p>
                    </div>
                    <div class="row lt_mb">
                        <h6 class="col s12 l8 cvSetupTitle">
                            Tell us about your internship
                        </h6>
                        <p class="col s12 l4 cvMoreInternP">
                            Have more internship?
                            <i
                                @click="addMoreTrainingsIntern"
                                class="material-icons cvMoreInternIcon"
                                >add_circle</i
                            >
                        </p>
                    </div>

                    <div
                        v-for="(training, index) in cvTrainingsIntern"
                        :key="index"
                    >
                        <p>
                            Trainings(Internship) {{ index + 1 }}
                            <i
                                @click="
                                    removeTrainingIntern(index),
                                        pushToTrash(training)
                                "
                                v-show="index != 0"
                                class="material-icons cursor right"
                                id="bioAddBtn"
                            >
                                cancel
                            </i>
                        </p>
                        <div class="row">
                            <div class="row lt_mb">
                                <div class="input-field col s12 l6">
                                    <input
                                        placeholder="Institution"
                                        type="text"
                                        class="validate cvSetupInput"
                                        v-model="training.institution"
                                    />
                                </div>

                                <div class="input-field col s12 l6">
                                    <input
                                        placeholder="Location"
                                        type="text"
                                        class="validate cvSetupInput"
                                        v-model="training.location"
                                    />
                                </div>
                            </div>
                            <div class="row lt_mb">
                                <div class="input-field col s12 l6">
                                    <input
                                        placeholder="Speciality"
                                        type="text"
                                        class="validate cvSetupInput"
                                        v-model="training.specialty"
                                    />
                                </div>
                                <div class="input-field col s12 l6">
                                    <input
                                        type="text"
                                        class="validate cvSetupInput"
                                        placeholder="Sub-Speciality"
                                        v-model="training.sub_specialty"
                                    />
                                </div>
                            </div>
                            <div class="row lt_mb">
                                <div class="input-field col s12 l6">
                                    <input
                                        placeholder="Start (Year)"
                                        type="text"
                                        class="validate cvSetupInput"
                                        v-model="training.yearStart"
                                    />
                                </div>
                                <div class="input-field col s12 l6">
                                    <input
                                        type="text"
                                        class="validate cvSetupInput"
                                        placeholder="Start (Month)"
                                        v-model="training.monthStart"
                                    />
                                </div>
                            </div>
                            <div class="row lt_mb">
                                <div class="input-field col s12 l6">
                                    <input
                                        placeholder="End (Year)"
                                        type="text"
                                        class="validate cvSetupInput"
                                        v-model="training.yearEnd"
                                    />
                                </div>
                                <div class="input-field col s12 l6">
                                    <input
                                        type="text"
                                        class="validate cvSetupInput"
                                        placeholder="End (Month)"
                                        v-model="training.monthEnd"
                                    />
                                </div>
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
                        <p class="cvSetupEduIndicatorP">Fellowship</p>
                        <p class="cvSetupEduIndicatorP">Residency</p>
                    </div>
                    <div class="row lt_mb">
                        <h6 class="col s12 l8 cvSetupTitle">
                            Tell us about your fellowship
                        </h6>
                        <p class="col s12 l4 cvMoreInternP">
                            Have more fellowship?
                            <i
                                @click="addMoreTrainingsFellowship"
                                class="material-icons cvMoreInternIcon"
                                >add_circle</i
                            >
                        </p>
                    </div>

                    <div
                        v-for="(training, index) in cvTrainingsFellowship"
                        :key="index"
                    >
                        <p>
                            Trainings(Fellowship) {{ index + 1 }}
                            <i
                                @click="
                                    removeTrainingFellowship(index),
                                        pushToTrash(training)
                                "
                                v-show="index != 0"
                                class="material-icons cursor right"
                                id="bioAddBtn"
                            >
                                cancel
                            </i>
                        </p>

                        <div class="row">
                            <div class="row lt_mb">
                                <div class="input-field col s12 l6">
                                    <input
                                        placeholder="Institution"
                                        type="text"
                                        class="validate cvSetupInput"
                                        v-model="training.institution"
                                    />
                                </div>

                                <div class="input-field col s12 l6">
                                    <input
                                        placeholder="Location"
                                        type="text"
                                        class="validate cvSetupInput"
                                        v-model="training.location"
                                    />
                                </div>
                            </div>
                            <div class="row lt_mb">
                                <div class="input-field col s12 l6">
                                    <input
                                        placeholder="Speciality"
                                        type="text"
                                        class="validate cvSetupInput"
                                        v-model="training.specialty"
                                    />
                                </div>
                                <div class="input-field col s12 l6">
                                    <input
                                        type="text"
                                        class="validate cvSetupInput"
                                        placeholder="Sub-Speciality"
                                        v-model="training.sub_specialty"
                                    />
                                </div>
                            </div>
                            <div class="row lt_mb">
                                <div class="input-field col s12 l6">
                                    <input
                                        placeholder="Start (Year)"
                                        type="text"
                                        class="validate cvSetupInput"
                                        v-model="training.yearStart"
                                    />
                                </div>
                                <div class="input-field col s12 l6">
                                    <input
                                        type="text"
                                        class="validate cvSetupInput"
                                        placeholder="Start (Month)"
                                        v-model="training.monthStart"
                                    />
                                </div>
                            </div>
                            <div class="row lt_mb">
                                <div class="input-field col s12 l6">
                                    <input
                                        placeholder="End (Year)"
                                        type="text"
                                        class="validate cvSetupInput"
                                        v-model="training.yearEnd"
                                    />
                                </div>
                                <div class="input-field col s12 l6">
                                    <input
                                        type="text"
                                        class="validate cvSetupInput"
                                        placeholder="End (Month)"
                                        v-model="training.monthEnd"
                                    />
                                </div>
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
                        <p class="cvSetupEduIndicatorP">Residency</p>
                    </div>
                    <div class="row lt_mb">
                        <h6 class="col s12 l8 cvSetupTitle">
                            Tell us about your Residency
                        </h6>
                        <p class="col s12 l4 cvMoreInternP">
                            Have more residency?
                            <i
                                @click="addMoreTrainingsResidency"
                                class="material-icons cvMoreInternIcon"
                                >add_circle</i
                            >
                        </p>
                    </div>
                    <div
                        v-for="(training, index) in cvTrainingsResidency"
                        :key="index"
                    >
                        <p>
                            Trainings(Residency) {{ index + 1 }}
                            <i
                                @click="
                                    removeTrainingResidency(index),
                                        pushToTrash(training)
                                "
                                v-show="index != 0"
                                class="material-icons cursor right"
                                id="bioAddBtn"
                            >
                                cancel
                            </i>
                        </p>

                        <div class="row">
                            <div class="row lt_mb">
                                <div class="input-field col s12 l6">
                                    <input
                                        placeholder="Institution"
                                        type="text"
                                        class="validate cvSetupInput"
                                        v-model="training.institution"
                                    />
                                </div>

                                <div class="input-field col s12 l6">
                                    <input
                                        placeholder="Location"
                                        type="text"
                                        class="validate cvSetupInput"
                                        v-model="training.location"
                                    />
                                </div>
                            </div>
                            <div class="row lt_mb">
                                <div class="input-field col s12 l6">
                                    <input
                                        placeholder="Speciality"
                                        type="text"
                                        class="validate cvSetupInput"
                                        v-model="training.specialty"
                                    />
                                </div>
                                <div class="input-field col s12 l6">
                                    <input
                                        type="text"
                                        class="validate cvSetupInput"
                                        placeholder="Sub-Speciality"
                                        v-model="training.sub_specialty"
                                    />
                                </div>
                            </div>
                            <div class="row lt_mb">
                                <div class="input-field col s12 l6">
                                    <input
                                        placeholder="Start (Year)"
                                        type="text"
                                        class="validate cvSetupInput"
                                        v-model="training.yearStart"
                                    />
                                </div>
                                <div class="input-field col s12 l6">
                                    <input
                                        type="text"
                                        class="validate cvSetupInput"
                                        placeholder="Start (Month)"
                                        v-model="training.monthStart"
                                    />
                                </div>
                            </div>
                            <div class="row lt_mb">
                                <div class="input-field col s12 l6">
                                    <input
                                        placeholder="End (Year)"
                                        type="text"
                                        class="validate cvSetupInput"
                                        v-model="training.yearEnd"
                                    />
                                </div>
                                <div class="input-field col s12 l6">
                                    <input
                                        type="text"
                                        class="validate cvSetupInput"
                                        placeholder="End (Month)"
                                        v-model="training.monthEnd"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                    <button
                        @click.prevent="saveCV"
                        class="waves-effect waves-green btn cvSetupSaveBtn"
                        v-if="!loading"
                    >
                        Save
                    </button>
                </div>
                <div class="row">
                    <div class="right">
                        <a
                            href="#!"
                            class="chevronIconLink"
                            @click="
                                trainingSetup != 0 ? trainingSetup-- : null
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
                                trainingSetup != 2 ? trainingSetup++ : null
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
            <div v-show="view == 3">
                <div>
                    <div class="row lt_mb">
                        <h6 class="col s12 l8 cvSetupTitle">
                            Tell us about your Experience
                        </h6>
                        <p class="col s12 l4 cvMoreInternP">
                            Have more experience?
                            <i
                                class="material-icons cvMoreInternIcon"
                                @click="addMore"
                                >add_circle</i
                            >
                        </p>
                    </div>
                    <div
                        v-for="(experience, index) in cvExperiences"
                        :key="index"
                    >
                        <p>
                            Experience {{ index + 1 }}
                            <i
                                @click="
                                    remove(index), pushToTrash(experience)
                                "
                                v-show="index != 0"
                                class="material-icons cursor right"
                                id="bioAddBtn"
                            >
                                cancel
                            </i>
                        </p>
                        <div class="row">
                            <div class="input-field col s12">
                                <input
                                    placeholder="Institution/Organization"
                                    type="text"
                                    class="validate cvSetupInput1"
                                    vv-model="experience.institution"
                                />
                            </div>
                            <div class="input-field col s12 l6">
                                <input
                                    placeholder="Location"
                                    type="text"
                                    class="validate cvSetupInput"
                                    v-model="experience.position"
                                />
                            </div>
                            <div class="input-field col s12 l6">
                                <input
                                    placeholder="Position"
                                    type="text"
                                    class="validate cvSetupInput"
                                    v-model="cvGradSchool.minor"
                                />
                            </div>
                            <div class="input-field col s12 l6">
                                <input
                                    placeholder="Start (Year)"
                                    type="text"
                                    class="validate cvSetupInput"
                                    v-model="cvGradSchool.yearStart"
                                />
                            </div>
                            <div class="input-field col s12 l6">
                                <input
                                    type="text"
                                    class="validate cvSetupInput"
                                    placeholder="Start (Month)"
                                    v-model="cvGradSchool.monthStart"
                                />
                            </div>
                            <div class="input-field col s12 l6">
                                <input
                                    placeholder="End (Year)"
                                    type="text"
                                    class="validate cvSetupInput"
                                    v-model="cvGradSchool.yearEnd"
                                />
                            </div>
                            <div class="input-field col s12 l6">
                                <input
                                    type="text"
                                    class="validate cvSetupInput"
                                    placeholder="End (Month)"
                                    v-model="cvGradSchool.monthEnd"
                                />
                            </div>
                        </div>
                    </div>

                    <button
                        @click.prevent="saveCV"
                        class="waves-effect waves-green btn cvSetupSaveBtn"
                        v-if="!loading"
                    >
                        Save
                    </button>

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
            </div>
            <div v-show="view == 4">
                <div>
                    <div class="row lt_mb">
                        <h6 class="col s12 l8 cvSetupTitle">
                            Tell us about your Reference
                        </h6>
                        <p class="col s12 l4 cvMoreInternP">
                            Have more reference?
                            <i
                                class="material-icons cvMoreInternIcon"
                                @click="addMoreReferences"
                                >add_circle</i
                            >
                        </p>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 l6">
                            <input
                                placeholder="Title"
                                type="text"
                                class="validate cvSetupInput"
                                v-model="cvGradSchool.major"
                            />
                        </div>
                        <div class="input-field col s12 l6">
                            <input
                                placeholder="Name"
                                type="text"
                                class="validate cvSetupInput"
                                v-model="cvGradSchool.minor"
                            />
                        </div>
                        <div class="input-field col s12 l6">
                            <input
                                placeholder="Position"
                                type="text"
                                class="validate cvSetupInput"
                                v-model="cvGradSchool.yearStart"
                            />
                        </div>
                        <div class="input-field col s12 l6">
                            <input
                                type="text"
                                class="validate cvSetupInput"
                                placeholder="Institution"
                                v-model="cvGradSchool.monthStart"
                            />
                        </div>
                        <div class="input-field col s12 l6">
                            <input
                                placeholder="Phone Number"
                                type="text"
                                class="validate cvSetupInput"
                                v-model="cvGradSchool.yearEnd"
                            />
                        </div>
                        <div class="input-field col s12 l6">
                            <input
                                type="email"
                                class="validate cvSetupInput"
                                placeholder="Email"
                                v-model="cvGradSchool.monthEnd"
                            />
                        </div>
                    </div>

                    <button
                        @click.prevent="saveCV"
                        class="waves-effect waves-green btn cvSetupSaveBtn"
                        v-if="!loading"
                    >
                        Save
                    </button>

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
                </div>
            </div>
            <div v-show="view == 5">
                <h6 class="cvSetupTitle">Tell us about your License</h6>
                <div class="row">
                    <div class="input-field col s12">
                        <input
                            placeholder="What year did you obtained your license"
                            type="text"
                            class="validate cvSetupInput1"
                            v-model="cvGradSchool.institution"
                        />
                    </div>

                    <div class="input-field col s12">
                        <input
                            placeholder="How was this license obtained"
                            type="text"
                            class="validate cvSetupInput1"
                            v-model="cvGradSchool.institution"
                        />
                    </div>

                    <div class="input-field col s12">
                        <input
                            placeholder="Location of issuance"
                            type="text"
                            class="validate cvSetupInput1"
                            v-model="cvGradSchool.institution"
                        />
                    </div>
                </div>

                <button
                    @click.prevent="saveCV"
                    class="waves-effect waves-green btn cvSetupSaveBtn"
                    v-if="!loading"
                >
                    Save
                </button>

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
                    </div>
                </div>
            </div>
        </div> -->
        <div class="modal-content">
            <i class="material-icons right modal-close">close</i>
            <p class="text-center"><strong>Curriculum Vitae is still in development mode, please check back later. Thanks</strong></p>
        </div>
    </div>
    <!-- <div class="modal" id="cvModal">
        <h1 class="centre">Still in construct, please check back later!</h1>
    </div> -->
</template>
<style>
    .custom-badge {
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
    }
    /* .modal .modal-content {
        padding: 10px;
    } */
    /* .modal {
        width: 100%;
    } */
</style>
<script>
    export default {
        name: "CvModal",
        mounted() {
            // var data = $('#skills').material_chip('data')
            // setTimeout(() => {
            //     let elem = document
            //         .getElementById("skills")
            //         .getElementsByClassName("chips");
            //
            //     var instance = M.Chips.getInstance(elem);
            //     //     instance.onChipAdd: (event, chip) => {
            //     // console.log(event[0].M_Chips.chipsData);
            //     // console.log( instance)
            // }, 5000);
        },
        data() {
            return {
                activities: [],
                activity: "",
                cvTraining: "",
                cv: {
                    summary: "",
                    skills: [],
                    license: "",
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
                cvExperiences: [
                    {
                        institution: "",
                        yearStart: "",
                        yearEnd: "",
                        monthStart: "",
                        monthEnd: "",
                        position: "",
                        location: "",
                        activities: [{ activity: "" }],
                    },
                ],
                cvTrainingsResidency: [
                    {
                        institution: "",
                        yearStart: "",
                        yearEnd: "",
                        monthStart: "",
                        monthEnd: "",
                        title: "",
                        location: "",
                        specialty: "",
                        sub_specialty: "",
                        type: "",
                    },
                ],
                cvTrainingsFellowship: [
                    {
                        institution: "",
                        yearStart: "",
                        yearEnd: "",
                        monthStart: "",
                        monthEnd: "",
                        title: "",
                        location: "",
                        specialty: "",
                        sub_specialty: "",
                        type: "",
                    },
                ],
                cvTrainingsIntern: [
                    {
                        institution: "",
                        yearStart: "",
                        yearEnd: "",
                        monthStart: "",
                        monthEnd: "",
                        title: "",
                        location: "",
                        type: "internship",
                    },
                ],

                cvReferences: [
                    {
                        name: "",
                        location: "",
                        phone: "",
                        position: "",
                    },
                ],
                cvExperienceUpdate: 0,
                cvExperienceActivityRemoved: [],
                cvExperienceRemoved: [],
                cvTrainingRemoved: [],
                cvTrainingUpdate: 0,
                cvReferencesRemoved: [],
                edu: 0,
                license: {
                    year: "",
                    issuance: "",
                    location: "",
                    type: "",
                },
                loading: false,
                showEduForm: false,
                view: 0,
                medSchoolInput: 0,
                medSchoolCount: 3,
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
            };
        },
        methods: {
            addMoreActitvity(e) {
                this.cvExperiences[e].activities.push({ activity: "" });
            },
            addMore() {
                this.cvExperiences.push({
                    institution: "",
                    yearStart: "",
                    yearEnd: "",
                    monthStart: "",
                    monthEnd: "",
                    position: "",
                    location: "",
                    activities: [{ activity: "" }],
                });
            },
            addMoreReferences() {
                this.cvReferences.push({
                    name: "",
                    location: "",
                    phone: "",
                    position: "",
                });
            },
            addMoreTrainingsFellowship() {
                this.cvTrainingsFellowship.push({
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
                });
            },
            addMoreTrainingsResidency() {
                this.cvTrainingsResidency.push({
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
                });
            },
            addMoreTrainingsIntern() {
                this.cvTrainingsIntern.push({
                    institution: "",
                    yearStart: "",
                    yearEnd: "",
                    monthStart: "",
                    monthEnd: "",
                    title: "",
                    location: "",
                    type: "internship",
                });
            },
            removeActivity(e, index) {
                this.cvExperiences[e].activities.splice(index, 1);
            },
            removeTrainingFellowship(index) {
                this.cvTrainingsFellowship.splice(index, 1);
            },
            removeTrainingIntern(index) {
                this.cvTrainingsIntern.splice(index, 1);
            },
            removeTrainingResidency(index) {
                this.cvTrainingsResidency.splice(index, 1);
            },
            removeReference(index) {
                this.cvReferences.splice(index, 1);
            },
            remove(index) {
                this.cvExperiences.splice(index, 1);
            },
            previous() {
                this.view != 0 ? this.view-- : null;
            },
            pushToTrash(e) {
                this.view == 3
                    ? this.cvTrainingRemoved.push(e)
                    : this.view == 5
                    ? this.cvReferencesRemoved.push(e)
                    : this.cvExperienceRemoved.push(e);
            },
            activityToTrash(e) {
                this.cvExperienceActivityRemoved.push(e);
            },
            saveAndNext() {
                this.view != 5 ? this.view++ : null;
            },
            saveCV() {
                this.loading = !this.loading;
                let formData = new FormData();
                let request = `/api/cv`;
                if (this.cv.update == 1) {
                    formData.append("_method", "PUT");
                    request = `/api/cv/${this.cv.id}`;
                }
                formData.append("skills", JSON.stringify(this.cv.skills));
                formData.append("summary", this.cv.summary);
                formData.append("license", this.cv.license);
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
                this.cvExperiences.forEach((el) => JSON.stringify(el.activities));

                let formData = new FormData();
                let request = `/api/cvexperience`;
                if (this.cvExperienceUpdate == 1) {
                    formData.append("_method", "PUT");
                    request = `/api/cvexperience/${this.cvExperiences[0].id}`;
                }
                formData.append("data", JSON.stringify(this.cvExperiences));
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
            saveMedSchool() {
                this.loading = !this.loading;
                let request = `/api/cvmed_school`;
                let data = {
                    _method: "PUT",
                };
                if (this.cvMedSchool.update == 1) {
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
                let data = {
                    _method: "PUT",
                };
                if (this.cvAdditionalSchool.update == 1) {
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

                let formData = new FormData();
                let request = `/api/cvreferral`;
                if (this.cvReferenceUpdate == 1) {
                    formData.append("_method", "PUT");
                    request = `/api/cvreferral/${this.cvReferences[0].id}`;
                }
                formData.append("data", JSON.stringify(this.cvReferences));
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
            saveTraining() {
                this.loading = !this.loading;

                let formData = new FormData();
                let request = `/api/cvtraining`;
                if (this.cvTrainingUpdate == 1) {
                    formData.append("_method", "PUT");
                    request = `/api/cvtraining/${this.cvTrainings[0].id}`;
                }
                formData.append("data", JSON.stringify(this.cvTrainings));
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
                let request = `/api/cv_gradschool`;
                let data = {
                    _method: "PUT",
                };
                if (this.cvGradSchool.update == 1) {
                    request = `/api/cv_gradschool/${this.cvGradSchool.id}`;
                    this.cvGradSchool = { ...this.cvGradSchool, ...data };
                }
                axios
                    .post(request, this.cvGradSchool)
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
        watch: {
            cv(newVal, oldVal) {
                console.log(newVal, oldVal);
            },
        },
    };
</script>
