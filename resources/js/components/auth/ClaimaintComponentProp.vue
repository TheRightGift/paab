<template>
    <div>
        <div class="row">
            <div id="popup">
                <span class="pl-1"
                    >Preview website:
                    <a
                        class="btn btn-small waves waves-effect"
                        @click="makePayment"
                        >Continue to payment</a
                    ></span
                >
                <iframe title="Your website preview" srcdoc="Loading..."  id="iframe" onload="this.removeAttribute('srcdoc')"></iframe>
            </div>
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
            <div class="col s12">
                <div id="page"></div>
                <div class="contentDiv">
                    <!-- <button @click="popup" >Click Me</button> -->
                    <ProgressComponent v-if="view >= 1" :steps="steps" :view="view" />
                    <div class="contentInnerDiv">
                        <!-- Get Started Section -->
                        <div v-show="view == 0">
                            <p class="contentTitle">
                                Lets help you setup your website
                            </p>

                            <div class="getStartedBtnDiv">
                                <a
                                    class="waves-effect waves-light btn getStartedBtn"
                                    @click="getStarted()"
                                    >GET STARTED</a
                                >
                            </div>
                        </div>

                        <!-- Confirm your name section -->
                        <div v-show="view == 1">
                            <p class="contentTitle">
                                Is it okay to address you as follows?
                            </p>

                            <form>
                                <div class="row formInnerDiv">
                                    <div class="input-field col s2">
                                        <select
                                            v-model="bio.title_id"
                                            required
                                            class="browser-default"
                                            id="userTitle"
                                            @change="switchText($event)"
                                        >
                                            <option
                                                :value="null"
                                                disabled
                                                selected
                                            >
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

                                    <div class="input-field col s3">
                                        <input
                                            type="text"
                                            v-model="bio.firstname"
                                            class="validate"
                                            placeholder="Firstname"
                                        />
                                    </div>
                                    <div class="input-field col s3">
                                        <input
                                            type="text"
                                            v-model="bio.lastname"
                                            class="validate"
                                            placeholder="Lastname"
                                        />
                                    </div>
                                    <div class="input-field col s3">
                                        <input
                                            type="text"
                                            v-model="bio.othername"
                                            class="validate"
                                            placeholder="Othernames"
                                        />
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Domain name check section -->
                        <div v-show="view == 2" class="container">
                            <p class="contentTitle">
                                Are you ok with this domain name?
                            </p>

                            <div>
                                <div class="row formInnerDiv">
                                    <div class="input-field col s10">
                                        <input
                                            type="text"
                                            v-model="domainSelected"
                                            class="validate"
                                            placeholder="Hit enter to search"
                                            @keyup="domainCheckPassed = null"
                                            @keyup.enter.prevent="
                                                checkDomainAvailability
                                            "
                                        />
                                        <p class="unAvailTxt">
                                            Not satisfied with the suggestions
                                            below, type in your preferred domain
                                            name
                                        </p>
                                    </div>
                                    <div class="col s2">
                                        <i
                                            class="fas fa-spinner fa-spin fa-1x"
                                            v-if="checkingSuggestion"
                                        ></i>
                                        <p
                                            class="unAvailTitle"
                                            v-if="domainCheckPassed == false"
                                        >
                                            Unavailable
                                        </p>
                                        <p
                                            class="availTitle"
                                            v-if="domainCheckPassed == true"
                                        >
                                            Available
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col s12 domianMainDiv">
                                    <p class="primaryTxt">Suggestions</p>
                                    <div v-show="!loadingSuggestions">
                                        <template
                                            v-for="(
                                                suggestion, index
                                            ) in domainSuggestions"
                                            :key="index"
                                        >
                                            <div class="col s1">
                                                <p class="domainSelectP">
                                                    <label>
                                                        <input
                                                            class="with-gap"
                                                            name="group1"
                                                            type="radio"
                                                            :value="
                                                                suggestion.name
                                                            "
                                                            v-model="
                                                                domainSelected
                                                            "
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
                                                            <td
                                                                class="domainTdName"
                                                            >
                                                                {{
                                                                    suggestion.name
                                                                }}
                                                            </td>
                                                            <td
                                                                class="domainTdState"
                                                            >
                                                                Available
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </template>
                                    </div>
                                    <div class="flex center-align p-10">
                                        <div v-if="loadingSuggestions">
                                            <i
                                                class="fas fa-spinner fa-spin fa-2x"
                                            ></i>
                                            <p>Loading Suggestions</p>
                                        </div>
                                        <p
                                            class="centered"
                                            v-if="domainSuggestions.length < 1"
                                        >
                                            No available suggestions
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Client Img check section -->
                        <div v-show="view == 3">
                            <p
                                class="contentTitle"
                                v-show="
                                    !showCropper &&
                                    (bioData.photo !== null ||
                                        uploaded !== null)
                                "
                            >
                                Are you ok with this picture?
                            </p>
                            <p
                                class="contentTitle"
                                v-show="
                                    !showCropper &&
                                    bioData.photo === null &&
                                    uploaded === null
                                "
                            >
                                Upload Your Avatar
                            </p>
                            <div v-show="showCropper" class="flexed">
                                <p class="contentTitle">
                                    Alright, Upload a clear picture then OR
                                </p>
                                <a
                                    class="btn-flat btn waves offsetS2"
                                    href="#"
                                    @click="showCropper = false"
                                    >Cancel</a
                                >
                            </div>

                            <div class="proImgContainer" v-show="!showCropper">
                                <img
                                    :src="
                                        typeof bio.photo === 'string'
                                            ? '/media/tenants/' +
                                              tenantId +
                                              '/img/' +
                                              bioData.photo
                                            : uploaded
                                    "
                                    :alt="bioData.firstname + ' avatar'"
                                    class="proImg"
                                    v-if="
                                        bioData.photo !== null ||
                                        uploaded !== null
                                    "
                                />
                                <img
                                    class="proImg"
                                    src="/media/img/doctor.png"
                                    v-else-if="bioData.photo === null"
                                />
                            </div>
                            <form enctype="multipart/form-data">
                                <div class="proImgBtnMainDiv">
                                    <div
                                        class="proImgBtnContainDiv"
                                        :class="{
                                            'justify-center':
                                                bioData.photo === null &&
                                                uploaded === null,
                                        }"
                                    >
                                        <a
                                            href="#"
                                            class="proImgYesBtn"
                                            @click="view = 4"
                                            v-show="
                                                !showCropper &&
                                                (bioData.photo !== null ||
                                                    uploaded !== null)
                                            "
                                            >Yes</a
                                        >
                                        <div class="" id="genUploadFavIconDiv">
                                            <div
                                                class=""
                                                v-if="!uploadPhotoProcessing"
                                            >
                                                <a
                                                    href="#"
                                                    role="button"
                                                    @click.prevent="
                                                        showFileChooser
                                                    "
                                                    v-show="!showCropper"
                                                    class="decorate"
                                                >
                                                    <span
                                                        v-if="
                                                            bioData.photo !==
                                                                null ||
                                                            uploaded !== null
                                                        "
                                                        >Change</span
                                                    >
                                                    <span v-else>Upload</span>
                                                </a>
                                                <div class="row">
                                                    <div class="col s12">
                                                        <image-cropper
                                                            v-show="showCropper"
                                                            :height="512"
                                                            :width="451"
                                                            @uploadPhoto="
                                                                photoUpload(
                                                                    $event
                                                                )
                                                            "
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                            <p v-else>
                                                Uploading Image<i
                                                    class="fas fa-circle-notch"
                                                ></i>
                                            </p>
                                        </div>
                                    </div>
                                    <div
                                        class="proImgInstructDiv"
                                        v-show="!showCropper"
                                    >
                                        <p class="proImgInstruct">
                                            The image should be greater than
                                            451px width and 512px height
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Acadamic Section -->
                        <div v-show="view == 4">
                            <!-- Academic Check -->
                            <div v-show="academicCheck == 0">
                                <p class="contentTitle">
                                    Which academic path suits you?
                                </p>

                                <div class="acaMainDiv">
                                    <p>
                                        <label @click="undergradMedSelected()">
                                            <input
                                                class="with-gap"
                                                name="acadamic"
                                                type="radio"
                                                value="1"
                                                v-model="acadRoute"
                                            />
                                            <span class="radioBtnSpan"
                                                >Undergraduate School and
                                                Medical School</span
                                            >
                                        </label>
                                    </p>
                                    <p>
                                        <label @click="medSelected()">
                                            <input
                                                class="with-gap"
                                                name="acadamic"
                                                type="radio"
                                                value="2"
                                                v-model="acadRoute"
                                            />
                                            <span class="radioBtnSpan"
                                                >Only Medical School</span
                                            >
                                        </label>
                                    </p>
                                </div>
                            </div>

                            <!-- Undergrad and Med school -->
                            <div v-show="academicCheck == 1">
                                <div>
                                    <p class="contentTitle">
                                        Tell us about your time in undergraduate
                                        school
                                    </p>

                                    <div v-if="attendedSchInfo == 0">
                                        <form class="mainForm">
                                            <div class="row formContainDiv">
                                                <div
                                                    class="input-field col s12"
                                                >
                                                    <input
                                                        placeholder="Name of institution?"
                                                        v-model="
                                                            underGrad.institution
                                                        "
                                                        type="text"
                                                        class="validate formInput"
                                                    />
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div v-if="attendedSchInfo == 1">
                                        <form class="mainForm">
                                            <div class="row formInnerDiv">
                                                <div class="input-field col s5">
                                                    <input
                                                        placeholder="What was your major?"
                                                        type="text"
                                                        v-model="
                                                            underGrad.major
                                                        "
                                                        class="validate formInput"
                                                    />
                                                </div>
                                                <div class="input-field col s6">
                                                    <input
                                                        placeholder="What was your minor(optional)?"
                                                        type="text"
                                                        v-model="
                                                            underGrad.minor
                                                        "
                                                        class="validate formInput"
                                                    />
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div v-if="attendedSchInfo == 2">
                                        <form class="mainForm">
                                            <div class="row formInnerDiv">
                                                <div class="col s6">
                                                    <p class="schQuesP">
                                                        When did you start?
                                                    </p>
                                                    <div
                                                        class="row spaceAround"
                                                    >
                                                        <div class="col s3">
                                                            <p
                                                                class="schQuesP1"
                                                            >
                                                                Start
                                                            </p>
                                                        </div>
                                                        <div
                                                            class="input-field col s4 formInput1ColDiv"
                                                        >
                                                            <select
                                                                class="validate formInput1 browser-default"
                                                                v-model="
                                                                    underGrad.monthStart
                                                                "
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
                                                                        month,
                                                                        index
                                                                    ) in months"
                                                                    :key="index"
                                                                    :value="
                                                                        index +
                                                                        1
                                                                    "
                                                                >
                                                                    {{ month }}
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div
                                                            class="input-field col s4 formInput1ColDiv"
                                                        >
                                                            <!-- <input
                                                                placeholder="Year"
                                                                type="text"
                                                                class="
                                                                    validate
                                                                    formInput1
                                                                "
                                                                v-model="underGrad.yearStart"
                                                            /> -->
                                                            <date-picker
                                                                v-model:value="
                                                                    underGrad.yearStart
                                                                "
                                                                type="year"
                                                                placeholder="Year"
                                                            ></date-picker>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col s6">
                                                    <p class="schQuesP">
                                                        When did you finish?
                                                    </p>
                                                    <div
                                                        class="row spaceAround"
                                                    >
                                                        <div class="col s2">
                                                            <p
                                                                class="schQuesP1"
                                                            >
                                                                Finish
                                                            </p>
                                                        </div>
                                                        <div
                                                            class="input-field col s4 formInput1ColDiv"
                                                        >
                                                            <select
                                                                class="validate formInput1 browser-default"
                                                                v-model="
                                                                    underGrad.monthEnd
                                                                "
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
                                                                        month,
                                                                        index
                                                                    ) in months"
                                                                    :key="index"
                                                                    :value="
                                                                        index +
                                                                        1
                                                                    "
                                                                >
                                                                    {{ month }}
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div
                                                            class="input-field col s4 formInput1ColDiv"
                                                        >
                                                            <!-- <input
                                                                placeholder="Year"
                                                                type="text"
                                                                class="
                                                                    validate
                                                                    formInput1
                                                                "
                                                                v-model="underGrad.yearEnd"
                                                            /> -->
                                                            <date-picker
                                                                v-model:value="
                                                                    underGrad.yearEnd
                                                                "
                                                                type="year"
                                                                placeholder="Year"
                                                            ></date-picker>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Med school -->
                            <div v-show="academicCheck == 2">
                                <!-- <div> -->
                                <p class="contentTitle">
                                    Tell us about your time in {{medText}} school
                                </p>

                                <div>
                                    <div v-if="attendedMedSch === 0">
                                        <form class="mainForm">
                                            <div class="row formContainDiv">
                                                <div
                                                    class="input-field col s12"
                                                >
                                                    <input
                                                        placeholder="Name of institution?"
                                                        type="text"
                                                        class="validate formInput"
                                                        v-model="
                                                            medSchool.institution
                                                        "
                                                    />
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                               
                                    <div v-if="attendedMedSch === 1">
                                        <form class="mainForm">
                                            <div class="row formInnerDiv">
                                                <div class="col s6">
                                                    <p class="schQuesP">
                                                        When did you start?
                                                    </p>
                                                    <div
                                                        class="row spaceAround"
                                                    >
                                                        <div class="col s3">
                                                            <p
                                                                class="schQuesP1"
                                                            >
                                                                Start
                                                            </p>
                                                        </div>
                                                        <div
                                                            class="input-field col s4 formInput1ColDiv"
                                                        >
                                                            <select
                                                                class="validate formInput1 browser-default"
                                                                v-model="
                                                                    medSchool.monthStart
                                                                "
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
                                                                        month,
                                                                        index
                                                                    ) in months"
                                                                    :key="index"
                                                                    :value="
                                                                        index +
                                                                        1
                                                                    "
                                                                >
                                                                    {{ month }}
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div
                                                            class="input-field col s4 formInput1ColDiv"
                                                        >
                                                            <date-picker
                                                                v-model:value="
                                                                    medSchool.yearStart
                                                                "
                                                                type="year"
                                                                placeholder="Year"
                                                            ></date-picker>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col s6">
                                                    <p class="schQuesP">
                                                        When did you finish?
                                                    </p>
                                                    <div
                                                        class="row spaceAround"
                                                    >
                                                        <div class="col s2">
                                                            <p
                                                                class="schQuesP1"
                                                            >
                                                                Finish
                                                            </p>
                                                        </div>
                                                        <div
                                                            class="input-field col s4 formInput1ColDiv"
                                                        >
                                                            <select
                                                                class="validate formInput1 browser-default"
                                                                v-model="
                                                                    medSchool.monthEnd
                                                                "
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
                                                                        month,
                                                                        index
                                                                    ) in months"
                                                                    :key="index"
                                                                    :value="
                                                                        index +
                                                                        1
                                                                    "
                                                                >
                                                                    {{ month }}
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div
                                                            class="input-field col s4 formInput1ColDiv"
                                                        >
                                                            <date-picker
                                                                v-model:value="
                                                                    medSchool.yearEnd
                                                                "
                                                                type="year"
                                                                placeholder="Year"
                                                            ></date-picker>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- </div> -->
                            </div>
                        </div>

                        <!-- Internship Section -->
                        <div v-show="view == 5">
                            <!-- Internship Check -->
                            <div v-show="internshipCheck == 0 && internUpdate === 0" class="container">
                                <p class="contentTitle">
                                    Have you completed your internship program?
                                </p>

                                <div class="radioBtnMainDiv">
                                    <p>
                                        <label @click="internSelected()">
                                            <input
                                                class="with-gap"
                                                name="intern"
                                                type="radio"
                                            />
                                            <span class="radioBtnSpan"
                                                >Yes</span
                                            >
                                        </label>
                                    </p>
                                    <p>
                                        <label @click="internNotSelected()">
                                            <input
                                                class="with-gap"
                                                name="intern"
                                                type="radio"
                                            />
                                            <span class="radioBtnSpan">No</span>
                                        </label>
                                    </p>
                                </div>
                            </div>

                            <div v-show="internshipCheck == 1">
                                <p class="contentTitle">
                                    Tell us about your internship program
                                </p>

                                <form class="mainForm">
                                    <div class="row formContainDiv">
                                        <div class="input-field col s12">
                                            <input
                                                placeholder="Name of institution?"
                                                type="text"
                                                class="validate formInput"
                                                v-model="internship.institution"
                                            />
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div v-show="internshipCheck == 2">
                                <p class="contentTitle">
                                    Tell us about your internship program
                                </p>

                                <form class="mainForm">
                                    <div class="row formInnerDiv">
                                        <div class="col s6">
                                            <p class="schQuesP">
                                                When did you start?
                                            </p>
                                            <div class="row spaceAround">
                                                <div class="col s3">
                                                    <p class="schQuesP1">
                                                        Start
                                                    </p>
                                                </div>
                                                <div
                                                    class="input-field col s4 formInput1ColDiv"
                                                >
                                                    <select
                                                        class="validate formInput1 browser-default"
                                                        v-model="
                                                            internship.monthStart
                                                        "
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
                                                <div
                                                    class="input-field col s4 formInput1ColDiv"
                                                >
                                                    <date-picker
                                                        v-model:value="
                                                            internship.yearStart
                                                        "
                                                        type="year"
                                                        placeholder="Year"
                                                    ></date-picker>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col s5">
                                            <p class="schQuesP">
                                                When did you finish?
                                            </p>
                                            <div class="row spaceAround">
                                                <div class="col s2">
                                                    <p class="schQuesP1">Finish</p>
                                                </div>
                                                <div
                                                    class="input-field col s4 formInput1ColDiv"
                                                >
                                                    <select
                                                        class="validate formInput1 browser-default"
                                                        v-model="
                                                            internship.monthEnd
                                                        "
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
                                                <div
                                                    class="input-field col s4 formInput1ColDiv"
                                                >
                                                    <date-picker
                                                        v-model:value="
                                                            internship.yearEnd
                                                        "
                                                        type="year"
                                                        placeholder="Year"
                                                    ></date-picker>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Fellowship Section -->
                        <div v-show="view == 6">
                            <!-- Fellowship Check -->
                            <div
                                v-show="
                                    fellowshipCheck === 0 &&
                                    fellowshipUpdate === 0
                                "
                                class="container"
                            >
                                <p class="contentTitle">
                                    Have you completed your fellowship program?
                                </p>

                                <div class="radioBtnMainDiv">
                                    <p>
                                        <label @click="fellowSelected()">
                                            <input
                                                class="with-gap"
                                                name="intern"
                                                type="radio"
                                            />
                                            <span class="radioBtnSpan"
                                                >Yes</span
                                            >
                                        </label>
                                    </p>
                                    <p>
                                        <label @click="fellowNotSelected()">
                                            <input
                                                class="with-gap"
                                                name="intern"
                                                type="radio"
                                            />
                                            <span class="radioBtnSpan">No</span>
                                        </label>
                                    </p>
                                </div>
                            </div>

                            <div v-show="fellowshipCheck == 1">
                                <p class="contentTitle">
                                    Tell us about your fellowship program
                                </p>

                                <form class="mainForm">
                                    <div class="row formContainDiv">
                                        <div class="input-field col s12">
                                            <input
                                                placeholder="Name of institution?"
                                                type="text"
                                                class="validate formInput"
                                                v-model="fellowship.institution"
                                            />
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div v-show="fellowshipCheck == 2">
                                <p class="contentTitle">
                                    Tell us about your fellowship program
                                </p>

                                <form class="mainForm">
                                    <div class="row formInnerDiv">
                                        <div class="col s6">
                                            <p class="schQuesP">
                                                When did you start?
                                            </p>
                                            <div class="row spaceAround">
                                                <div class="col s3">
                                                    <p class="schQuesP1">
                                                        Start
                                                    </p>
                                                </div>
                                                <div
                                                    class="input-field col s4 formInput1ColDiv"
                                                >
                                                    <select
                                                        class="validate formInput1 browser-default"
                                                        v-model="
                                                            fellowship.monthStart
                                                        "
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
                                                <div
                                                    class="input-field col s4 formInput1ColDiv"
                                                >
                                                    <date-picker
                                                        v-model:value="
                                                            fellowship.yearStart
                                                        "
                                                        type="year"
                                                        placeholder="Year"
                                                    ></date-picker>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col s6">
                                            <p class="schQuesP">
                                                When did you finish?
                                            </p>
                                            <div class="row spaceAround">
                                                <div class="col s2">
                                                    <p class="schQuesP1">Finish</p>
                                                </div>
                                                <div
                                                    class="input-field col s4 formInput1ColDiv"
                                                >
                                                    <select
                                                        class="validate formInput1 browser-default"
                                                        v-model="
                                                            fellowship.monthEnd
                                                        "
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
                                                <div
                                                    class="input-field col s4 formInput1ColDiv"
                                                >
                                                    <date-picker
                                                        v-model:value="
                                                            fellowship.yearEnd
                                                        "
                                                        type="year"
                                                        placeholder="Year"
                                                    ></date-picker>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Residency Section -->
                        <div v-show="view == 7">
                            <!-- Residency Check -->
                            <div
                                v-show="
                                    residencyCheck == 0 && residencyUpdate === 0
                                "
                                class="container"
                            >
                                <p class="contentTitle">
                                    Have you completed your residency program?
                                </p>

                                <div class="radioBtnMainDiv">
                                    <p>
                                        <label @click="residencySelected()">
                                            <input
                                                class="with-gap"
                                                name="intern"
                                                type="radio"
                                            />
                                            <span class="radioBtnSpan"
                                                >Yes</span
                                            >
                                        </label>
                                    </p>
                                    <p>
                                        <label @click="residencyNotSelected()">
                                            <input
                                                class="with-gap"
                                                name="intern"
                                                type="radio"
                                            />
                                            <span class="radioBtnSpan">No</span>
                                        </label>
                                    </p>
                                </div>
                            </div>

                            <div v-show="residencyCheck == 1">
                                <p class="contentTitle">
                                    Tell us about your residency program
                                </p>

                                <form class="mainForm">
                                    <div class="row formContainDiv">
                                        <div class="input-field col s12">
                                            <input
                                                placeholder="Name of institution?"
                                                type="text"
                                                class="validate formInput"
                                                v-model="residency.institution"
                                            />
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div v-show="residencyCheck == 2">
                                <p class="contentTitle">
                                    Tell us about your residency program
                                </p>

                                <form class="mainForm">
                                    <div class="row formInnerDiv">
                                        <div class="col s6">
                                            <p class="schQuesP">
                                                When did you start?
                                            </p>
                                            <div class="row spaceAround">
                                                <div class="col s3">
                                                    <p class="schQuesP1">
                                                        Start
                                                    </p>
                                                </div>
                                                <div
                                                    class="input-field col s4 formInput1ColDiv"
                                                >
                                                    <select
                                                        class="validate formInput1 browser-default"
                                                        v-model="
                                                            residency.monthStart
                                                        "
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
                                                <div
                                                    class="input-field col s4 formInput1ColDiv"
                                                >
                                                    <date-picker
                                                        v-model:value="
                                                            residency.yearStart
                                                        "
                                                        type="year"
                                                        placeholder="Year"
                                                    ></date-picker>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col s5">
                                            <p class="schQuesP">
                                                When did you finish?
                                            </p>
                                            <div class="row spaceAround">
                                                <div class="col s2">
                                                    <p class="schQuesP1">Finish</p>
                                                </div>
                                                <div
                                                    class="input-field col s4 formInput1ColDiv"
                                                >
                                                    <select
                                                        class="validate formInput1 browser-default"
                                                        v-model="
                                                            residency.monthEnd
                                                        "
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
                                                <div
                                                    class="input-field col s4 formInput1ColDiv"
                                                >
                                                    <date-picker
                                                        v-model:value="
                                                            residency.yearEnd
                                                        "
                                                        type="year"
                                                        placeholder="Year"
                                                    ></date-picker>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Experience Section -->
                        <div v-show="view == 8">
                            <!-- Experience Check -->
                            <div v-show="experienceCheck == 0">
                                <p class="contentTitle">
                                    Tell us about your experience
                                </p>
                                <form class="mainForm">
                                    <div class="row formContainDiv">
                                        <div class="input-field col s12">
                                            <input
                                                placeholder="Name of hospital/medical establishment?"
                                                type="text"
                                                class="validate formInput"
                                                v-model="
                                                    experiences.institution
                                                "
                                            />
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div v-show="experienceCheck == 1">
                                <p class="contentTitle">
                                    Tell us about your experience
                                </p>
                                <form class="">
                                    <div class="row">
                                        <div class="col s12">
                                            <p class="schQuesP text-center">
                                                Please select the
                                                country/state/city you work
                                                in?
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row spaceAround mb-0">
                                        <div class="col s4">
                                            <p class="schQuesP1 text-center">
                                                Country
                                            </p>
                                        </div>
                                        <div class="col s4">
                                            <p class="schQuesP1 text-center">
                                                State
                                            </p>
                                        </div>
                                        <div class="col s4">
                                            <p class="schQuesP1 text-center">
                                                City
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row spaceAround formInnerDiv">
                                        <div
                                            class="input-field col s3 formInput1ColDiv"
                                        >
                                            <select
                                                class="validate formInput1 browser-default"
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
                                        <div
                                            class="input-field col s3 formInput1ColDiv"
                                        >
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
                                        <div
                                            class="input-field col s3 formInput1ColDiv"
                                        >
                                            <select
                                                class="validate formInput1 browser-default"
                                                v-model="experiences.city_id"
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
                                    </div>
                                </form>
                            </div>

                            <div v-show="experienceCheck == 2">
                                <p class="contentTitle">
                                    Tell us about your experience
                                </p>
                                <form class="mainForm">
                                    <div class="row formInnerDiv">
                                        <div class="col s12">
                                            <p class="schQuesP">
                                                When did you start?
                                            </p>
                                            <div class="row spaceAround">
                                                <div class="col s6">
                                                    <p class="schQuesP1">
                                                        Start
                                                    </p>
                                                </div>
                                                <div
                                                    class="input-field col s4 formInput1ColDiv"
                                                >
                                                    <select
                                                        class="validate formInput1 browser-default"
                                                        v-model="
                                                            experiences.monthStart
                                                        "
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
                                                <div
                                                    class="input-field col s6 formInput1ColDiv"
                                                >
                                                    <date-picker
                                                        v-model:value="
                                                            experiences.yearStart
                                                        "
                                                        type="year"
                                                        placeholder="Year"
                                                    ></date-picker>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Add More Quarifications Section -->
                        <div v-show="view == 9">
                            <div v-show="addQualificaion == 0 && additionalSchoolUpdate == 0">
                                <p class="contentTitle">
                                    Do you have additional academic
                                    qualifications?
                                </p>
                                <div class="radioBtnMainDiv">
                                    <p>
                                        <label @click="addQualSelected()">
                                            <input
                                                class="with-gap"
                                                name="intern"
                                                type="radio"
                                            />
                                            <span class="radioBtnSpan"
                                                >Yes</span
                                            >
                                        </label>
                                    </p>
                                    <p>
                                        <label @click="addQualNotSelected()">
                                            <input
                                                class="with-gap"
                                                name="intern"
                                                type="radio"
                                            />
                                            <span class="radioBtnSpan">No</span>
                                        </label>
                                    </p>
                                </div>
                            </div>

                            <div v-show="addQualificaion == 1">
                                <p class="contentTitle">
                                    Tell us about your academic qualifications
                                </p>

                                <form class="mainForm">
                                    <div class="row formContainDiv">
                                        <div class="input-field col s12">
                                            <input
                                                placeholder="Name of institution?"
                                                type="text"
                                                class="validate formInput"
                                                v-model="
                                                    additionalSchool.institution
                                                "
                                            />
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div v-show="addQualificaion == 2">
                                <p class="contentTitle">
                                    Tell us about your academic qualifications
                                </p>

                                <form class="mainForm">
                                    <div class="row formContainDiv">
                                        <div class="input-field col s12">
                                            <input
                                                placeholder="What was your degree?"
                                                type="text"
                                                class="validate formInput"
                                                v-model="
                                                    additionalSchool.degree
                                                "
                                            />
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div v-show="addQualificaion == 3">
                                <p class="contentTitle">
                                    Tell us about your academic qualifications
                                </p>

                                <form class="mainForm">
                                    <div class="row formInnerDiv">
                                        <div class="col s6">
                                            <p class="schQuesP">
                                                When did you start?
                                            </p>
                                            <div class="row spaceAround">
                                                <div class="col s3">
                                                    <p class="schQuesP1">
                                                        Start
                                                    </p>
                                                </div>
                                                <div
                                                    class="input-field col s4 formInput1ColDiv"
                                                >
                                                    <select
                                                        class="validate formInput1 browser-default"
                                                        v-model="
                                                            additionalSchool.monthStart
                                                        "
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
                                                <div
                                                    class="input-field col s4 formInput1ColDiv"
                                                >
                                                    <date-picker
                                                        v-model:value="
                                                            additionalSchool.yearStart
                                                        "
                                                        type="year"
                                                        placeholder="Year"
                                                    ></date-picker>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col s6">
                                            <p class="schQuesP">
                                                When did you end?
                                            </p>
                                            <div class="row spaceAround">
                                                <div class="col s2">
                                                    <p class="schQuesP1">End</p>
                                                </div>
                                                <div
                                                    class="input-field col s4 formInput1ColDiv"
                                                >
                                                    <select
                                                        class="validate formInput1 browser-default"
                                                        v-model="
                                                            additionalSchool.monthEnd
                                                        "
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
                                                <div
                                                    class="input-field col s4 formInput1ColDiv"
                                                >
                                                    <date-picker
                                                        v-model:value="
                                                            additionalSchool.yearEnd
                                                        "
                                                        type="year"
                                                        placeholder="Year"
                                                    ></date-picker>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                       

                        <!-- Publish Section -->
                        <div v-show="view == 10" class="container">
                            <div class="contentTitle" v-if="!showGoLiveBtns" >
                                <span class="serviceSuccessTxt">Congrats!</span>
                                Your site has been setup successfully!
                                <span class="serviceSuccessTxt">Hooray!</span>
                                <p class="timer">
                                    Redirecting you to your site in
                                    {{ countdown }}s
                                </p>
                            </div>

                            <go-live-component :showGoLiveBtns="showGoLiveBtns" :bio="bio" @sendEmail="sendEmail($event)"/>
                        </div>

                        <!-- Prev/Next Button Section -->
                        <div class="mt-5">
                            <div v-if="view > 0 && view <= 3 || (view == 4 && academicCheck == 0)" class="skipDiv">
                                <button
                                    class="skipBtn"
                                    @click="prev()"
                                    :disabled="view <= 1"
                                    :class="view > 1 ? 'btnOn' : 'btnOff'"
                                >
                                    <i class="material-icons"
                                        >keyboard_arrow_left</i
                                    >
                                </button>

                                <button
                                    class="skipBtn"
                                    @click="next()"
                                    :disabled="view == view.length || (view == 4 && academicCheck == 0)"
                                    :class="view != 4 ? 'btnOn' : 'btnOff'"
                                >
                                    <i class="material-icons"
                                        >keyboard_arrow_right</i
                                    >
                                </button>

                                <!-- <i class="material-icons skipBtnIcon" @click="prev()">keyboard_arrow_left</i>
                                
                                <i class="material-icons skipBtnIcon" @click="next()">keyboard_arrow_right</i> -->
                            </div>
                            <div v-if="view == 4 && academicCheck == 1">
                                <div class="skipDiv">
                                    <button class="skipBtn" @click="prev(1)">
                                        <i class="material-icons"
                                            >keyboard_arrow_left</i
                                        >
                                    </button>

                                    <button
                                        class="skipBtn"
                                        @click="next(1)"
                                        :disabled="
                                            academicCheck ==
                                            academicCheck.length
                                        "
                                        :class="
                                            attendedSchInfo != 3
                                                ? 'btnOn'
                                                : 'btnOff'
                                        "
                                    >
                                        <i class="material-icons"
                                            >keyboard_arrow_right</i
                                        >
                                    </button>
                                </div>
                            </div>
                            <div v-if="view == 4 && academicCheck == 2 && attendedMedSch <= 3">
                                <div class="skipDiv">
                                    <!-- :disabled="academicCheck == 0"
                                        :class="
                                            attendedMedSch > 0 ? 'btnOn' : 'btnOff'
                                        " -->
                                    <button class="skipBtn" @click="prev(1)">
                                        <i class="material-icons"
                                            >keyboard_arrow_left</i
                                        >
                                    </button>

                                    <button
                                        class="skipBtn"
                                        @click="next(1)"
                                        :disabled="
                                            academicCheck ==
                                            academicCheck.length
                                        "
                                        :class="
                                            attendedMedSch != 3
                                                ? 'btnOn'
                                                : 'btnOff'
                                        "
                                    >
                                        <i class="material-icons"
                                            >keyboard_arrow_right</i
                                        >
                                    </button>
                                </div>
                            </div>
                            <div v-if="view == 5">
                                <div class="skipDiv">
                                    <button class="skipBtn" @click="prev(2)">
                                        <i class="material-icons"
                                            >keyboard_arrow_left</i
                                        >
                                    </button>

                                    <button
                                        class="skipBtn"
                                        @click="next(2)"
                                        :disabled="internshipCheck == 0"
                                        :class="
                                            internshipCheck < 1
                                                ? 'btnOff'
                                                : 'btnOn'
                                        "
                                    >
                                        <i class="material-icons"
                                            >keyboard_arrow_right</i
                                        >
                                    </button>
                                </div>
                            </div>
                            <div v-if="view == 6">
                                <div class="skipDiv">
                                    <button class="skipBtn" @click="prev(3)">
                                        <i class="material-icons"
                                            >keyboard_arrow_left</i
                                        >
                                    </button>

                                    <button
                                        class="skipBtn"
                                        @click="next(3)"
                                        :disabled="fellowshipCheck == 0"
                                        :class="
                                            fellowshipCheck < 1
                                                ? 'btnOff'
                                                : 'btnOn'
                                        "
                                    >
                                        <i class="material-icons"
                                            >keyboard_arrow_right</i
                                        >
                                    </button>
                                </div>
                            </div>
                            <div v-if="view == 7">
                                <div class="skipDiv">
                                    <button class="skipBtn" @click="prev(4)">
                                        <i class="material-icons"
                                            >keyboard_arrow_left</i
                                        >
                                    </button>

                                    <button
                                        class="skipBtn"
                                        @click="next(4)"
                                        :disabled="residencyCheck == 0"
                                        :class="
                                            residencyCheck < 1
                                                ? 'btnOff'
                                                : 'btnOn'
                                        "
                                    >
                                        <i class="material-icons"
                                            >keyboard_arrow_right</i
                                        >
                                    </button>
                                </div>
                            </div>
                            <div v-if="view == 8">
                                <div class="skipDiv">
                                    <button class="skipBtn" @click="prev(5)">
                                        <i class="material-icons"
                                            >keyboard_arrow_left</i
                                        >
                                    </button>

                                    <button
                                        class="skipBtn"
                                        @click="next(5)"
                                        :disabled="experienceCheck >= 3"
                                        :class="
                                            experienceCheck >= 3
                                                ? 'btnOff'
                                                : 'btnOn'
                                        "
                                    >
                                        <i class="material-icons"
                                            >keyboard_arrow_right</i
                                        >
                                    </button>
                                </div>
                            </div>
                            <div v-if="view == 9">
                                <div class="skipDiv">
                                    <button
                                        class="skipBtn btnOn"
                                        @click="prev(6)"
                                        
                                    >
                                        <i class="material-icons"
                                            >keyboard_arrow_left</i
                                        >
                                    </button>

                                    <button
                                        class="skipBtn"
                                        @click="next(6)"
                                        :class="
                                            addQualificaion > 5  || addQualificaion == 0
                                                ? 'btnOff'
                                                : 'btnOn'
                                        "
                                    >
                                        <i class="material-icons"
                                            >keyboard_arrow_right</i
                                        >
                                    </button>
                                </div>
                            </div>
                            
                            <div v-if="view == 10">
                                <div class="skipDiv">
                                    <button
                                        class="skipBtn"
                                        @click="prev(7)"
                                        :disabled="view < 10"
                                        :class="view < 10 ? 'btnOff' : 'btnOn'"
                                    >
                                        <i class="material-icons"
                                            >keyboard_arrow_left</i
                                        >
                                    </button>

                                    <button
                                        class="skipBtn"
                                        @click="next(7)"
                                        :disabled="view == 10"
                                        :class="view >= 10 ? 'btnOff' : 'btnOn'"
                                    >
                                        <i class="material-icons"
                                            >keyboard_arrow_right</i
                                        >
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- <InnerFooter /> -->
                    </div>
                </div>
                <div id="modal1" class="modal">
                    <div class="modal-content">
                        <i
                            class="fas fa-spinner fa-spin fa-2xl flex center-align"
                        ></i>
                        <p class="centered">Setting up your site</p>
                    </div>
                </div>
            </div>
        </div>
        <PaymentModalComponent
            :setModal="setModal"
            :user="user"
            @countDown="timerStart($event)"
            @popupClose="popupClose($event)"
            :domainName="domainSelected"
        />
    </div>
</template>
<script>
    let env = process.env.MIX_APP_ENV;
    let domain = 'whitecoatdomain.com';
    import InnerFooter from "../partials/InnerFooterComponent.vue";
    import DatePicker from "vue-datepicker-next";
    import "vue-datepicker-next/index.css";
    import PaymentModalComponent from "../partials/PaymentModalComponent.vue";
    import ImageCropper from "../partials/ImageCropper.vue";
    import ProgressComponent from "../partials/ProgressComponent.vue";
    import GoLiveComponent from '../partials/GoLiveComponent.vue';
    export default {
        components: {
            PaymentModalComponent,
            InnerFooter,
            DatePicker,
            ImageCropper,
            ProgressComponent,
            GoLiveComponent,
        },

        data() {
            return {
                medText: 'Medical',
                stateSelected: "",
                countrySelected: "",
                states: [],
                cities: [],
                cvMedSchoolUpdate: 0,
                underGradUpdate: 0,
                additionalSchoolUpdate: 0,
                internUpdate: 0,
                residencyUpdate: 0,
                fellowshipUpdate: 0,
                experienceUpdate: 0,
                serviceUpdate: 0,
                steps: [
                    { stepValue: "Name", filled: false, current: 0 },
                    { stepValue: "Domain", filled: false, current: 0 },
                    { stepValue: "Avatar", filled: false, current: 0 },
                    { stepValue: "Academic", filled: false, current: 0 },
                    { stepValue: "Internship", filled: false, current: 0 },
                    { stepValue: "Fellowship", filled: false, current: 0 },
                    { stepValue: "Residency", filled: false, current: 0 },
                    { stepValue: "Experience", filled: false, current: 0 },
                    { stepValue: "Education", filled: false, current: 0 },
                    { stepValue: "Payment", filled: false, current: 0 },
                ],
                setDomain: false,
                showCropper: false,
                view: 0,
                bio: {
                    firstname: "",
                    lastname: "",
                    othername: "",
                    title_id: "",
                    photo: null,
                },
                countdown: 10,
                domainCheckPassed: null,
                domainSuggestions: [],
                domainSelected: "",
                bioData: {},
                initialDomain: "",
                experiences: {
                    institution: "",
                    yearStart: "",
                    monthStart: "",
                    city_id: "",
                },
                internship: {
                    institution: "",
                    yearStart: "",
                    yearEnd: "",
                    monthStart: "",
                    monthEnd: "",
                    title: "",
                    location: "",
                    type: "internship",
                },
                loadingSuggestions: false,
                checkingSuggestion: false,
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
                    type: "",
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
                    type: "fellowship",
                },
                residency: {
                    institution: "",
                    yearStart: "",
                    yearEnd: "",
                    monthStart: "",
                    monthEnd: "",
                    type: "residency",
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
                experienceCheck: 0,
                addQualificaion: 0,
                servicesCheck: 0,
                setModal: false,
                user: 0,
                acadRoute: 0
            };
        },
        mounted() {
            this.getTenantNDomain();
            this.getData();
            document.addEventListener("DOMContentLoaded", function () {
                let elems = document.querySelector("#modal1");
                let options = {
                    dismissible: false,
                };
                let instances = M.Modal.init(elems, options);
            });

            document.getElementById("page").onclick = function () {
                if (document.getElementById("popup").style.display == "block") {
                    document.getElementById("popup").style.display = "none";
                    document.getElementById("page").style.display = "none";
                    document.getElementById("page").className = "";
                }
            };
        },
        methods: {
            switchText(val) {
                let valText;
                if (!val) {
                    val = document.querySelector('#userTitle');
                    valText = val.selectedOptions[0].innerText;
                } else valText= val.target.selectedOptions[0].innerText;
                if (valText === 'DD') {
                    this.medText = 'Dental';
                }
                else {
                    this.medText = 'Medical';
                }
            },
            getData() {
                axios
                    .get("/claim/data")
                    .then((res) => {
                        if (res.data.medschool !== null) {
                            let e = res.data.medschool;
                            this.medSelected();
                            this.medSchool = e;
                            this.medSchool.yearStart = new Date(`${e.yearStart}`);
                            this.medSchool.yearEnd = new Date(`${e.yearEnd}`);
                            this.cvMedSchoolUpdate = 1;
                            this.steps[3].filled = true;
                        }
                        if (res.data.undergrad !== null) {
                            let e = res.data.undergrad;
                            this.underGrad = e;
                            this.underGrad.yearStart = new Date(`${e.yearStart}`);
                            this.underGrad.yearEnd = new Date(`${e.yearEnd}`);
                            this.underGradUpdate = 1;
                            this.steps[3].filled = true;
                        }
                        if (res.data.otheredu !== null) {
                            let e = res.data.otheredu;
                            this.additionalSchool = e;
                            this.additionalSchool.yearStart = new Date(
                                `${e.yearStart}`
                            );
                            this.additionalSchool.yearEnd = new Date(
                                `${e.yearEnd}`
                            );
                            this.additionalSchoolUpdate = 1;
                            this.steps[8].filled = true;
                        }
                        let expo = res.data.experiences[0];
                        res.data.experiences.length !== 0
                            ? ((this.steps[7].filled = true),
                              (this.experiences = expo),
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
                            ? ((this.internship = internship),
                              (this.steps[4].filled = true),
                              (this.internUpdate = 1),
                              (this.internSelected()), (this.internship.yearStart = new Date(`${internship.yearStart}`)), (this.internship.yearEnd = new Date(`${internship.yearEnd}`)))
                            : null;
                        fellowship !== undefined
                            ? ((this.fellowship = fellowship),
                              (this.steps[5].filled = true),
                              (this.fellowshipUpdate = 1),
                              this.fellowSelected(), (this.fellowship.yearStart = new Date(`${fellowship.yearStart}`)), (this.fellowship.yearEnd = new Date(`${fellowship.yearEnd}`)))
                            : null;
                        residency !== undefined
                            ? ((this.residency = residency),
                              (this.steps[6].filled = true),
                              (this.residencyUpdate = 1),
                              this.residencySelected())
                            : null;
                            this.switchText();
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
            sortCities() {
                axios
                    .get(`/api/cities/${this.stateSelected}`)
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
                    .get(`/api/states/${this.countrySelected}`)
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
            makePayment() {
                let paymentModal = document.getElementById("paymentModal");
                let paymentModalInstance = M.Modal.getInstance(paymentModal);
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
            showFileChooser() {
                // this.$refs.photo.click();
                this.showCropper = true;
            },
            checkDomainAvailability() {
                if (this.domainSelected != "") {
                    this.checkingSuggestion = true;
                    let domainToCheck = this.domainSelected.endsWith(".com")
                        ? this.domainSelected
                        : this.domainSelected + ".com";
                    axios
                        .post("/api/domain/check", { domain: domainToCheck })
                        .then((res) => {
                            if (res.data.status == 1) {
                                this.domainCheckPassed = true;
                                this.setDomain ? this.updateDomain() : null;
                            } else if (res.data.status == 0) {
                                this.domainCheckPassed = false;
                                if (this.setDomain) {
                                    M.toast({
                                        html: "Domain Not Available!",
                                        classes: "errorNotifier",
                                    });
                                    this.view = 2;
                                }
                            }
                            this.checkingSuggestion = false;
                        })
                        .catch((err) => {
                            console.log(err);
                            this.checkingSuggestion = false;
                        });
                }
            },
            prev(num = null) {
                if(num === null){
                    if(this.view == 5){
                        this.attendedSchInfo = 0
                    }

                    this.view != 0 ? this.view-- : null;
                } else if(num === 1){//academics
                    if(this.academicCheck === 1){//underGrad
                        // this.attendedSchInfo != 0 ? this.attendedSchInfo-- : (this.view = 3);
                        this.attendedSchInfo != 0 ? this.attendedSchInfo-- : null;
                        if (this.attendedSchInfo == 0) {
                            this.academicCheck = 0;
                            // reset school route option
                            this.acadRoute = 0;
                        }
                    } else if(this.academicCheck === 2){//medSchool
                        // this.attendedMedSch != 0 ? this.attendedMedSch-- : (this.attendedSchInfo = 3);
                        this.attendedMedSch != 0 ? this.attendedMedSch-- : null;

                        if (this.attendedMedSch == 0) {
                            this.academicCheck = 0;
                            // reset school route option
                            this.acadRoute = 0;
                        }
                    }
                } else if(num === 2){//internship
                    // this.internshipCheck != 0 ? this.internshipCheck-- : ((this.view = 4), (this.attendedMedSch = 2));
                    
                    if(this.internshipCheck <= 1){
                        this.view = 4;
                        this.academicCheck = 0;
                        this.acadRoute = 0;
                        this.attendedMedSch = 0;
                        this.attendedSchInfo = 0
                    } else {
                        this.internshipCheck--;
                    }
                } else if(num === 3){//fellowship
                    // this.fellowshipCheck != 0 ? this.fellowshipCheck-- : (this.view = 5);
                    if(this.fellowshipCheck <= 1){
                        this.view = 5;
                        this.internshipCheck = 1;
                    } else {
                        this.fellowshipCheck--;
                    }
                } else if(num === 4){//residency
                    // this.residencyCheck != 0 ? this.residencyCheck-- : this.view--;
                    if(this.residencyCheck <= 1){
                        this.view = 6;
                        this.fellowshipCheck = 1;
                    } else {
                        this.residencyCheck--;
                    }
                }  else if(num === 5){//experience
                    // this.experienceCheck != 0 ? this.experienceCheck-- : this.view--;
                    if(this.experienceCheck <= 0){
                        this.view = 7;
                        this.residencyCheck = 1;
                    } else {
                        this.experienceCheck--;
                    }
                }  else if( num === 6){//additional Ed
                    // this.addQualificaion != 0 ? this.addQualificaion-- : this.view--;
                    if(this.addQualificaion <= 1){
                        this.view = 8;
                        this.experienceCheck = 1;
                    } else {
                        this.addQualificaion--;
                    }
                } else if(num === 7){//payment
                        this.view = 9;
                        this.addQualificaion = 1;
                }                
            },
            next(num = null) {
                if(num === null){
                    if (this.view === 2) {
                        this.setDomain = true;
                        if (
                            this.initialDomain !=
                            this.domainSelected.replace(".com", "")
                        ) {
                            this.checkDomainAvailability();
                        }
                    }
                    if (this.view == 3) {
                        this.view++;
                    }
                    if (this.view === 1) {
                        this.registerUpdateUser();
                        this.updateBio();
                        if (
                            (this.bio.title_id !== null || this.bio.title_id !== "") &&
                            this.bio.firstname !== "" &&
                            this.bio.lastname !== ""
                        ) {
                            this.generateMultiple();
                            this.view = 2;
                        } else {
                            this.view = 1;
                        }
                    } else if (this.view != 4) {
                        this.view++;
                    }
                } else if(num === 1){//academics
                    if(this.academicCheck === 1){//underGrad
                        this.attendedSchInfo != 3 ? (this.saveUndergradSchoolTime(), this.attendedSchInfo++) : null;

                        if (this.attendedSchInfo >= 3) {
                            this.academicCheck = 2;
                        }
                    } else if(this.academicCheck === 2){//medSchool
                        this.attendedMedSch != 2 ? (this.saveMedSchoolTime(), this.attendedMedSch++) : null;

                        if (this.attendedMedSch == 2) {
                            this.view = 5;
                        }
                    }
                } else if(num === 2){//internship
                    this.internshipCheck != 3 ? (this.saveInternshipTime(), this.internshipCheck++) : null;

                    if (this.internshipCheck >= 3) {
                        this.view = 6;
                    }
                } else if(num === 3){//fellowship
                    this.fellowshipCheck != 3 ? (this.saveFellowshipTime(), this.fellowshipCheck++) : null;

                    if (this.fellowshipCheck >= 3) {
                        this.view = 7;
                    }
                } else if(num === 4){//residency
                    this.residencyCheck != 3 ? (this.saveResidencyTime(), this.residencyCheck++) : null;

                    if (this.residencyCheck >= 3) {
                        this.view = 8;
                    }
                } else if(num === 5){//experience
                    this.experienceCheck != 3 ? (this.saveExperience(), this.experienceCheck++) : null;

                    if (this.experienceCheck >= 3) {
                        this.view = 9;
                        if (this.additionalSchoolUpdate === 1) {
                            this.addQualificaion = 1;
                        }
                    }
                } else if( num === 6){//additional Ed
                    this.addQualificaion !== 3 ? (this.saveAdditionalSchoolTime(), this.addQualificaion++) : this.view = 10;
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
                            this.domainSelected = `${res.data.domain}.com`;
                            this.initialDomain = res.data.domain;
                            this.tenantId = res.data.tenantID;
                            res.data.domain !== null
                                ? (this.steps[1].filled = true)
                                : null;
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
            generateMultiple() {
                let title = this.titles.filter((el) => el.id == this.bio.title_id);
                this.domainSuggestions.push({
                    name: (
                        title[0].name.replace(/\./g, "") +
                        this.bio.firstname +
                        this.bio.lastname +
                        ".com"
                    ).toLowerCase(),
                });
                this.domainSuggestions.push({
                    name: (
                        title[0].name.replace(/\./g, "") +
                        this.bio.lastname +
                        this.bio.firstname +
                        ".com"
                    ).toLowerCase(),
                });
                this.domainSuggestions.push({
                    name: (
                        this.bio.firstname +
                        this.bio.lastname +
                        title[0].name.replace(/\./g, "") +
                        ".com"
                    ).toLowerCase(),
                });
                this.domainSuggestions.push({
                    name: (
                        this.bio.lastname +
                        this.bio.firstname +
                        title[0].name.replace(/\./g, "") +
                        ".com"
                    ).toLowerCase(),
                });
                this.domainSuggestions.push({
                    name: (
                        title[0].name.replace(/\./g, "") +
                        this.bio.lastname +
                        ".com"
                    ).toLowerCase(),
                });
                this.domainSuggestions.push({
                    name: (
                        title[0].name.replace(/\./g, "") +
                        this.bioData.firstname +
                        ".com"
                    ).toLowerCase(),
                });

                let data = JSON.stringify(this.domainSuggestions);
                this.loadingSuggestions = true;
                axios
                    .post(`/api/domain/check/`, { domain: data })
                    .then((res) => {
                        if (res.data.status == 200) {
                            this.domainSuggestions = res.data.available;
                            this.loadingSuggestions = false;
                        }
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            },
            parseClaimaintData(dataToParse) {
                let data = JSON.parse(dataToParse);
                this.bioData = data.length === undefined ? data : data[0];
                this.bio.firstname = this.bioData.firstname;
                this.bio.lastname = this.bioData.lastname;
                this.bio.othername = this.bioData.othername;
                this.bio.title_id = this.bioData.title_id;
                this.bio.photo = this.bioData.photo;
                this.bio.id = this.bioData.id;
                if (this.bio.firstname !== "" || this.bio.lastname !== "") {
                    this.steps[0].filled = true;
                }
                if (this.bio.photo !== undefined && this.bio.photo !== null) {
                    this.steps[2].filled = true;
                }
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
            photoUpload(e) {
                this.updatePhoto(e);
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

                                    this.steps[0].filled = true;
                                }
                            })
                            .catch((err) => {
                                console.log(err);
                            });
                    }
                }
            },
            saveExperience() {
                if (
                    (this.experiences.institution != "" ||
                        this.experiences.yearStart != "" ||
                        this.experiences.monthStart != "" ||
                        this.experiences.city_id != "") &&
                    this.experienceUpdate === 0
                ) {
                    this.experiences.yearStart != ""
                        ? (this.experiences.yearStart =
                              this.experiences.yearStart.getFullYear())
                        : null;
                    axios
                        .post("/claim/saveexperience", this.experiences)
                        .then((res) => {
                            if (res.data.status == 201) {
                                M.toast({
                                    html: res.data.message,
                                    classes: "successNotifier",
                                });
                                this.experiences.id = res.data.id;
                                this.experienceCheck === 3
                                    ? ((this.steps[7].filled = true),
                                      (this.experienceUpdate = 1))
                                    : null;
                            }
                        })
                        .catch((err) => {
                            console.log(err);
                        });
                }
            },
            saveUndergradSchoolTime() {
                if (
                    (this.underGrad.institution != "" ||
                        this.underGrad.yearEnd != "" ||
                        this.underGrad.monthEnd != "" ||
                        this.underGrad.major != "" ||
                        this.underGrad.yearStart != "" ||
                        this.underGrad.monthStart != "" ||
                        this.underGrad.minor != "") &&
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
                                M.toast({
                                    html: res.data.message,
                                    classes: "successNotifier",
                                });
                                this.attendedSchInfo === 2
                                    ? (this.steps[3].filled = true)
                                    : null;
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
                                M.toast({
                                    html: res.data.message,
                                    classes: "successNotifier",
                                });
                                this.additionalSchool.id = res.data.id;
                                this.addQualificaion === 4
                                    ? (this.steps[8].filled = true)
                                    : null;
                            }
                        })
                        .catch((err) => {
                            console.log(err);
                        });
                }
            },
            saveMedSchoolTime() {
                if (
                    (this.medSchool.institution != "" ||
                        this.medSchool.yearEnd != "" ||
                        this.medSchool.monthEnd != "" ||
                        this.medSchool.type != "" ||
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
                                M.toast({
                                    html: res.data.message,
                                    classes: "successNotifier",
                                });
                                this.attendedMedSch === 2
                                    ? (this.steps[3].filled = true)
                                    : null;
                            }
                        })
                        .catch((err) => {
                            console.log(err);
                        });
                }
            },
            saveInternshipTime() {
                if (
                    (this.internship.institution != "" ||
                        this.internship.yearEnd != "" ||
                        this.internship.monthEnd != "" ||
                        this.internship.type != "" ||
                        this.internship.yearStart != "" ||
                        this.internship.monthStart != "" ||
                        this.internship.location != "") &&
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
                    axios
                        .post("/claim/saveinternship", this.internship)
                        .then((res) => {
                            if (res.data.status == 201) {
                                M.toast({
                                    html: res.data.message,
                                    classes: "successNotifier",
                                });
                                this.internshipCheck === 3
                                    ? (this.steps[4].filled = true)
                                    : null;
                            }
                        })
                        .catch((err) => {
                            console.log(err);
                        });
                }
            },
            saveServiceOffered() {
                if (this.service.title != "") {
                    axios
                        .post("/claim/save/service", this.service)
                        .then((res) => {
                            if (res.data.status == 201) {
                                M.toast({
                                    html: res.data.message,
                                    classes: "successNotifier",
                                });
                                this.steps[9].filled = true;
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
                        this.fellowship.type != "" ||
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
                    axios
                        .post("/claim/savefellowship", this.fellowship)
                        .then((res) => {
                            if (res.data.status == 201) {
                                M.toast({
                                    html: res.data.message,
                                    classes: "successNotifier",
                                });
                                this.fellowshipCheck === 3
                                    ? (this.steps[5].filled = true)
                                    : null;
                            }
                        })
                        .catch((err) => {
                            console.log(err);
                        });
                }
            },
            saveResidencyTime() {
                if (
                    (this.residency.institution !== "" ||
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
                    axios
                        .post("/claim/saveresidency", this.residency)
                        .then((res) => {
                            if (res.data.status == 201) {
                                M.toast({
                                    html: res.data.message,
                                    classes: "successNotifier",
                                });
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
            updateDomain() {
                axios
                    .put(`/claim/updateDomain/tenant`, {
                        domain: this.domainSelected,
                    })
                    .then((res) => {
                        if (res.data.status == 200) {
                            this.initialDomain = res.data.domain.domain;
                            M.toast({
                                html: res.data.message,
                                classes: "successNotifier",
                            });
                            this.setDomain = false;
                            this.steps[1].filled = true;
                        }
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            },
            updatePhoto(e) {
                this.uploadPhotoProcessing = true;
                let formData = new FormData();
                formData.append("photo", e);
                formData.append("_method", "PUT");
                formData.append("id", this.bioData.id);
                axios
                    .post("/claim/updateAvatar/bio", formData)
                    .then((res) => {
                        // console.log(res);
                        if (res.data.status == 200) {
                            M.toast({
                                html: res.data.message,
                                classes: "successNotifier",
                            });
                            localStorage.setItem(
                                "claimproc",
                                JSON.stringify([res.data.bio])
                            );
                            this.bio = res.data.bio;
                            this.uploadPhotoProcessing = false;
                            this.showCropper = false;
                            this.uploaded = e;
                            this.bio.photo = {};
                            this.steps[2].filled = true;
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
            undergradMedSelected() {
                this.academicCheck = 1;
                this.attendedSchInfo = 0;
            },
            medSelected() {
                this.academicCheck = 2;
            },
            
            internSelected() {
                this.internshipCheck = 1;
            },
            internNotSelected() {
                this.view = 6;
            },
            
            fellowSelected() {
                this.fellowshipCheck = 1;
            },
            fellowNotSelected() {
                this.view = 7;
            },
            residencySelected() {
                this.residencyCheck = 1;
            },
            residencyNotSelected() {
                this.view = 8;
            },
            
            expSelected() {
                this.experienceCheck = 0;
                this.experiences = {
                    institution: "",
                    yearStart: "",
                    yearEnd: "",
                    monthStart: "",
                    monthEnd: "",
                    position: "",
                    location: "",
                };
                this.experienceUpdate = 0;
            },
            expNotSelected() {
                this.view = 9;
            },
            
            addQualSelected() {
                this.addQualificaion = 1;
            },
            addQualNotSelected() {
                this.view = 10;
            },
            addMoreQualSelected() {
                this.addQualificaion = 1;
                this.additionalSchool = {
                    institution: "",
                    yearStart: "",
                    yearEnd: "",
                    monthStart: "",
                    monthEnd: "",
                    degree: "",
                };
            },
            
            
            prev9() {
                this.servicesCheck != 0 ? this.servicesCheck-- : null;

                if (this.servicesCheck < 3) {
                    this.view = 10;
                    this.servicesCheck = 0;
                }
            },
            prev10() {
                this.view = 3;
            },
            next10() {
                this.academicCheck = 1;
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
                    document.getElementById("iframe").src =
                        `https://${domainSelected}.${domain}`;
                    document.getElementById("iframe").srcdoc = '<!DOCTYPE html><div class="loader"></div>';
                    document.getElementById("iframe").addEventListener('load', () => iframe.removeAttribute('srcdoc'));
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
                    plan: val,
                    password: localStorage.getItem("passwordGen"),
                    domain: this.domainSelected.replace(".com", ""),
                };
                axios
                    .post("/claim/successdomainregistra", data)
                    .then((res) => {
                        if (res.status == 201) {
                            M.toast({
                                html: res.data.message,
                                classes: "successNotifier",
                            });
                            localStorage.removeItem("claimproc");
                            localStorage.removeItem("passwordGen");
                            this.user = res.data.user;
                            let elem = document.getElementById("modal1");
                            let instance = M.Modal.getInstance(elem);
                            instance.close();
                            this.popup();
                        }
                    })
                    .catch((err) => {
                        let elem = document.getElementById("modal1"); //.getElementsByClassName('modal-close').click()
                        let instance = M.Modal.getInstance(elem);
                        instance.close();
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
                    location.replace(
                        `https://${domainSelected}.${domain}`
                    );
                }
            },
        },
        props: {
            claimaint: String,
            titles: Array,
            claimant: String,
            countries: Array,
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
        },
    };
</script>
<style scoped>
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
    .pl-1 {
        padding: 0 1em;
    }

    .darken {
        background: rgba(0, 0, 0, 0.7);
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
    .center-align {
        justify-content: center !important;
    }
    .p-10 {
        padding: 2rem 0;
    }
    .proInputFileUpladIcon {
        float: right;
        padding-top: 20px;
    }
    .file-path-wrapper {
        display: flex;
        align-items: center;
    }
    .input-field {
        margin-top: 0;
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
    select {
        padding: 0;
    }
    .modal-content {
        padding-bottom: 0px;
    }
    #modal1 {
        transform: translateY(-50%) scaleX(1) !important;
        top: 50% !important;
    }

    @media only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (-webkit-min-device-pixel-ratio: 1) {
        #popup {
            padding: 0;
        }
    }
    @media only screen and (max-width: 992px) {
        .modal {
            width: 20%;
            /* margin-top: 50%; */
        }
    }
    @media screen and (max-width: 640px) {
        .modal {
            width: 40%;
            /* margin-top: 50%; */
        }
        #popup {
            width: 95%;
            padding: 1em 0 0 0;
        }
    }
    .mt-5 {
        margin-top: 5rem;
    }
    .justify-center {
        justify-content: center !important;
    }
    .holds-the-iframe {
        background: url('data:image/svg+xml;charset=utf-8,<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 100% 100%"><text fill="%23FF0000" x="50%" y="50%" font-family="\'Lucida Grande\', sans-serif" font-size="24" text-anchor="middle">PLACEHOLDER</text></svg>') 0px 0px no-repeat;
    }
</style>
