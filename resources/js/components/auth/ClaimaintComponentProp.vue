<template>
    <div>
        <div class="row">
            <div class="col s12">
                <div class="primaryColorDiv">
                    <div class="headerDiv">
                        <a href="/">
                            <img
                                src="/media/img/wcdMobileLogo.png"
                                alt="wcdMobileLogo.png"
                            />
                        </a>
                        <p class="headerTitle">
                            It is time for the world to hear your pulse
                        </p>
                    </div>
                    <div>
                        <img
                            src="/media/img/3dDoctors.png"
                            alt="3dDoctors.png"
                            class="primaryColorDocsImg"
                        />
                    </div>
                </div>
            </div>
            <div class="col s12">
                <div class="contentDiv">
                    <!-- Get Started Section -->
                    <div v-show="view == 0">
                        <p class="contentTitle">
                            Lets help you setup your website
                        </p>

                        <div class="getStartedBtnDiv">
                            <a
                                class="
                                    waves-effect waves-light
                                    btn
                                    getStartedBtn
                                "
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
                                    >
                                        <option :value="null" disabled selected>
                                            MD
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
                                    />
                                </div>
                                <div class="input-field col s3">
                                    <input
                                        type="text"
                                        v-model="bio.lastname"
                                        class="validate"
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
                    <div v-show="view == 2">
                        <p class="contentTitle">
                            Are you ok with this domain name?
                        </p>

                        <div>
                            <div class="row formInnerDiv">
                                <div class="input-field col s8">
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
                                <div class="col s4">
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
                                                        :value="suggestion.name"
                                                        v-model="domainSelected"
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
                                                            class="
                                                                domainTdState
                                                            "
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
                        <p class="contentTitle">
                            Are you ok with this picture?
                        </p>

                        <div class="proImgDiv">
                            <img
                                :src="
                                    typeof bio.photo == 'string'
                                        ? '/media/tenants/' +
                                          tenantId +
                                          '/img/' +
                                          bioData.photo
                                        : uploaded
                                "
                                :alt="bioData.firstname + ' avatar'"
                                class="proImg"
                            />
                            <i class="fas fa-spinner fa-spin fa-2x" v-if="uploadPhotoProcessing"></i>
                        </div>
                        <form enctype="multipart/form-data">

                            <div class="proImgBtnMainDiv">
                                <div class="proImgBtnContainDiv">
                                    <a href="#" class="proImgYesBtn">Yes</a>
                                    <div
                                        class="file-field input-field"
                                        id="genUploadFavIconDiv"
                                    >
                                        <input
                                            type="file"
                                            @change="photoUpload"
                                            accept=".jpg, .png"
                                        />
                                        <div class="file-path-wrapper">
                                            <input
                                                class="file-path validate genInput1"
                                                type="text"
                                                placeholder="No"
                                                id="custom-input"
                                                value="No"
                                            />
                                            <i
                                                class="
                                                    material-icons
                                                    proInputFileUpladIcon
                                                "
                                                >file_upload</i
                                            >
                                        </div>
                                    </div>
                                </div>
                                <div class="proImgInstructDiv">
                                    <p class="proImgInstruct">
                                        The image should be 451px width and 512px
                                        height
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
                                        />
                                        <span class="radioBtnSpan"
                                            >Undergraduate School and Medical
                                            School</span
                                        >
                                    </label>
                                </p>
                                <p>
                                    <label @click="medSelected()">
                                        <input
                                            class="with-gap"
                                            name="acadamic"
                                            type="radio"
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
                                            <div class="input-field col s12">
                                                <input
                                                    placeholder="What Institution did you attend"
                                                    v-model="underGrad.institution"
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
                                                    placeholder="What major"
                                                    type="text"
                                                    v-model="underGrad.major"
                                                    class="validate formInput"
                                                />
                                            </div>
                                            <div class="input-field col s6">
                                                <input
                                                    placeholder="What minor(optional)"
                                                    type="text"
                                                    v-model="underGrad.minor"
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
                                                    When did you start
                                                </p>
                                                <div class="row spaceAround">
                                                    <div class="col s3">
                                                        <p class="schQuesP1">
                                                            Start
                                                        </p>
                                                    </div>
                                                    <div
                                                        class="
                                                            input-field
                                                            col
                                                            s4
                                                            formInput1ColDiv
                                                        "
                                                    >
                                                        <select class="validate formInput1 browser-default" v-model="underGrad.monthStart">
                                                            <option :value="''" disabled selected>Month</option>
                                                            <option v-for="(month, index) in months" :key="index" :value="index+1">{{ month }}</option>
                                                        </select>
                                                        
                                                    </div>
                                                    <div
                                                        class="
                                                            input-field
                                                            col
                                                            s4
                                                            formInput1ColDiv
                                                        "
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
                                                        <date-picker v-model:value="underGrad.yearStart" type="year" placeholder="Year"></date-picker>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col s6">
                                                <p class="schQuesP">
                                                    When did you end
                                                </p>
                                                <div class="row spaceAround">
                                                    <div class="col s2">
                                                        <p class="schQuesP1">
                                                            End
                                                        </p>
                                                    </div>
                                                    <div
                                                        class="
                                                            input-field
                                                            col
                                                            s4
                                                            formInput1ColDiv
                                                        "
                                                    >
                                                        <select class="validate formInput1 browser-default" v-model="underGrad.monthEnd">
                                                            <option :value="''" disabled selected>Month</option>
                                                            <option v-for="(month, index) in months" :key="index" :value="index+1">{{ month }}</option>
                                                        </select>
                                                        
                                                    </div>
                                                    <div
                                                        class="
                                                            input-field
                                                            col
                                                            s4
                                                            formInput1ColDiv
                                                        "
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
                                                        <date-picker v-model:value="underGrad.yearEnd" type="year" placeholder="Year" format="2023"></date-picker>
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
                                Tell us about your time in medical school
                            </p>

                            <div>
                                <div v-if="attendedMedSch == 0">
                                    <form class="mainForm">
                                        <div class="row formContainDiv">
                                            <div class="input-field col s12">
                                                <input
                                                    placeholder="What Institution did you attend"
                                                    type="text"
                                                    class="validate formInput"
                                                    v-model="medSchool.institution"
                                                />
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div v-if="attendedMedSch == 1">
                                    <form class="mainForm">
                                        <div class="row formContainDiv">
                                            <div class="input-field col s12">
                                                <input
                                                    placeholder="What degree"
                                                    type="text"
                                                    class="validate formInput"
                                                    v-model="medSchool.type"
                                                />
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div v-if="attendedMedSch == 2">
                                    <form class="mainForm">
                                        <div class="row formInnerDiv">
                                            <div class="col s6">
                                                <p class="schQuesP">
                                                    When did you start
                                                </p>
                                                <div class="row spaceAround">
                                                    <div class="col s3">
                                                        <p class="schQuesP1">
                                                            Start
                                                        </p>
                                                    </div>
                                                    <div
                                                        class="
                                                            input-field
                                                            col
                                                            s4
                                                            formInput1ColDiv
                                                        "
                                                    >
                                                        <select class="validate formInput1 browser-default" v-model="medSchool.monthStart">
                                                            <option :value="''" disabled selected>Month</option>
                                                            <option v-for="(month, index) in months" :key="index" :value="index+1">{{ month }}</option>
                                                        </select>
                                                       
                                                    </div>
                                                    <div
                                                        class="
                                                            input-field
                                                            col
                                                            s4
                                                            formInput1ColDiv
                                                        "
                                                    >
                                                        <date-picker v-model:value="medSchool.yearStart" type="year" placeholder="Year"></date-picker>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col s6">
                                                <p class="schQuesP">
                                                    When did you end
                                                </p>
                                                <div class="row spaceAround">
                                                    <div class="col s2">
                                                        <p class="schQuesP1">
                                                            End
                                                        </p>
                                                    </div>
                                                    <div
                                                        class="
                                                            input-field
                                                            col
                                                            s4
                                                            formInput1ColDiv
                                                        "
                                                    >
                                                        <select class="validate formInput1 browser-default" v-model="medSchool.monthEnd">
                                                            <option :value="''" disabled selected>Month</option>
                                                            <option v-for="(month, index) in months" :key="index" :value="index+1">{{ month }}</option>
                                                        </select>
                                                        
                                                    </div>
                                                    <div
                                                        class="
                                                            input-field
                                                            col
                                                            s4
                                                            formInput1ColDiv
                                                        "
                                                    >
                                                        <date-picker v-model:value="medSchool.yearEnd" type="year" placeholder="Year"></date-picker>
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
                        <div v-show="internshipCheck == 0">
                            <p class="contentTitle">
                                Did you attend internship?
                            </p>

                            <div class="radioBtnMainDiv">
                                <p>
                                    <label @click="internSelected()">
                                        <input
                                            class="with-gap"
                                            name="intern"
                                            type="radio"
                                        />
                                        <span class="radioBtnSpan">Yes</span>
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
                                            placeholder="What Institution did you attend"
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
                                            When did you start
                                        </p>
                                        <div class="row spaceAround">
                                            <div class="col s3">
                                                <p class="schQuesP1">Start</p>
                                            </div>
                                            <div
                                                class="
                                                    input-field
                                                    col
                                                    s4
                                                    formInput1ColDiv
                                                "
                                            >
                                                <select class="validate formInput1 browser-default" v-model="internship.monthStart">
                                                    <option :value="''" disabled selected>Month</option>
                                                    <option v-for="(month, index) in months" :key="index" :value="index+1">{{ month }}</option>
                                                </select>
                                            </div>
                                            <div
                                                class="
                                                    input-field
                                                    col
                                                    s4
                                                    formInput1ColDiv
                                                "
                                            >
                                            <date-picker v-model:value="internship.yearStart" type="year" placeholder="Year"></date-picker>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col s5">
                                        <p class="schQuesP">When did you end</p>
                                        <div class="row spaceAround">
                                            <div class="col s2">
                                                <p class="schQuesP1">End</p>
                                            </div>
                                            <div
                                                class="
                                                    input-field
                                                    col
                                                    s4
                                                    formInput1ColDiv
                                                "
                                            >
                                                <select class="validate formInput1 browser-default" v-model="internship.monthEnd">
                                                    <option :value="''" disabled selected>Month</option>
                                                    <option v-for="(month, index) in months" :key="index" :value="index+1">{{ month }}</option>
                                                </select>
                                            </div>
                                            <div
                                                class="
                                                    input-field
                                                    col
                                                    s4
                                                    formInput1ColDiv
                                                "
                                            >
                                                <date-picker v-model:value="internship.yearEnd" type="year" placeholder="Year"></date-picker>
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
                        <div v-show="fellowshipCheck == 0">
                            <p class="contentTitle">
                                Did you attended fellowship?
                            </p>

                            <div class="radioBtnMainDiv">
                                <p>
                                    <label @click="fellowSelected()">
                                        <input
                                            class="with-gap"
                                            name="intern"
                                            type="radio"
                                        />
                                        <span class="radioBtnSpan">Yes</span>
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
                                            placeholder="What Institution did you attend"
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
                                            When did you start
                                        </p>
                                        <div class="row spaceAround">
                                            <div class="col s3">
                                                <p class="schQuesP1">Start</p>
                                            </div>
                                            <div
                                                class="
                                                    input-field
                                                    col
                                                    s4
                                                    formInput1ColDiv
                                                "
                                            >
                                                <select class="validate formInput1 browser-default" v-model="fellowship.monthStart">
                                                    <option :value="''" disabled selected>Month</option>
                                                    <option v-for="(month, index) in months" :key="index" :value="index+1">{{ month }}</option>
                                                </select>
                                            </div>
                                            <div
                                                class="
                                                    input-field
                                                    col
                                                    s4
                                                    formInput1ColDiv
                                                "
                                            >
                                            <date-picker v-model:value="fellowship.yearStart" type="year" placeholder="Year"></date-picker>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col s6">
                                        <p class="schQuesP">When did you end</p>
                                        <div class="row spaceAround">
                                            <div class="col s2">
                                                <p class="schQuesP1">End</p>
                                            </div>
                                            <div
                                                class="
                                                    input-field
                                                    col
                                                    s4
                                                    formInput1ColDiv
                                                "
                                            >
                                                <select class="validate formInput1 browser-default" v-model="fellowship.monthEnd">
                                                    <option :value="''" disabled selected>Month</option>
                                                    <option v-for="(month, index) in months" :key="index" :value="index+1">{{ month }}</option>
                                                </select>
                                            </div>
                                            <div
                                                class="
                                                    input-field
                                                    col
                                                    s4
                                                    formInput1ColDiv
                                                "
                                            >
                                                <date-picker v-model:value="fellowship.yearEnd" type="year" placeholder="Year"></date-picker>
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
                        <div v-show="residencyCheck == 0">
                            <p class="contentTitle">
                                Did you attended residency?
                            </p>

                            <div class="radioBtnMainDiv">
                                <p>
                                    <label @click="residencySelected()">
                                        <input
                                            class="with-gap"
                                            name="intern"
                                            type="radio"
                                        />
                                        <span class="radioBtnSpan">Yes</span>
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
                                            placeholder="What Institution did you attend"
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
                                            When did you start
                                        </p>
                                        <div class="row spaceAround">
                                            <div class="col s3">
                                                <p class="schQuesP1">Start</p>
                                            </div>
                                            <div
                                                class="
                                                    input-field
                                                    col
                                                    s4
                                                    formInput1ColDiv
                                                "
                                            >
                                                <select class="validate formInput1 browser-default" v-model="residency.monthStart">
                                                    <option :value="''" disabled selected>Month</option>
                                                    <option v-for="(month, index) in months" :key="index" :value="index+1">{{ month }}</option>
                                                </select>
                                            </div>
                                            <div
                                                class="
                                                    input-field
                                                    col
                                                    s4
                                                    formInput1ColDiv
                                                "
                                            >
                                            <date-picker v-model:value="residency.yearStart" type="year" placeholder="Year"></date-picker>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col s5">
                                        <p class="schQuesP">When did you end</p>
                                        <div class="row spaceAround">
                                            <div class="col s2">
                                                <p class="schQuesP1">End</p>
                                            </div>
                                            <div
                                                class="
                                                    input-field
                                                    col
                                                    s4
                                                    formInput1ColDiv
                                                "
                                            >
                                                <select class="validate formInput1 browser-default" v-model="residency.monthEnd">
                                                    <option :value="''" disabled selected>Month</option>
                                                    <option v-for="(month, index) in months" :key="index" :value="index+1">{{ month }}</option>
                                                </select>
                                            </div>
                                            <div
                                                class="
                                                    input-field
                                                    col
                                                    s4
                                                    formInput1ColDiv
                                                "
                                            >
                                                <date-picker v-model:value="residency.yearEnd" type="year" placeholder="Year"></date-picker>
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
                                            placeholder="What hospital/medical/institutions"
                                            type="text"
                                            class="validate formInput"
                                            v-model="experiences.institution"
                                        />
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div v-show="experienceCheck == 1">
                            <p class="contentTitle">
                                Tell us about your experience
                            </p>
                            <form class="mainForm">
                                <div class="row formContainDiv">
                                    <div class="input-field col s12">
                                        <input
                                            placeholder="What is the location"
                                            type="text"
                                            class="validate formInput"
                                            v-model="experiences.location"
                                        />
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div v-show="experienceCheck == 2">
                            <p class="contentTitle">
                                Tell us about your experience
                            </p>
                            <form class="mainForm">
                                <div class="row formContainDiv">
                                    <div class="input-field col s12">
                                        <input
                                            placeholder="What is your position"
                                            type="text"
                                            class="validate formInput"
                                            v-model="experiences.position"
                                        />
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div v-show="experienceCheck == 3">
                            <p class="contentTitle">
                                Tell us about your experience
                            </p>
                            <form class="mainForm">
                                <div class="row formInnerDiv">
                                    <div class="col s6">
                                        <p class="schQuesP">
                                            When did you start
                                        </p>
                                        <div class="row spaceAround">
                                            <div class="col s3">
                                                <p class="schQuesP1">Start</p>
                                            </div>
                                            <div
                                                class="
                                                    input-field
                                                    col
                                                    s4
                                                    formInput1ColDiv
                                                "
                                            >
                                                <select class="validate formInput1 browser-default" v-model="experiences.monthStart">
                                                    <option :value="''" disabled selected>Month</option>
                                                    <option v-for="(month, index) in months" :key="index" :value="index+1">{{ month }}</option>
                                                </select>
                                            </div>
                                            <div
                                                class="
                                                    input-field
                                                    col
                                                    s4
                                                    formInput1ColDiv
                                                "
                                            >
                                            <date-picker v-model:value="experiences.yearStart" type="year" placeholder="Year"></date-picker>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col s5">
                                        <p class="schQuesP">When did you end</p>
                                        <div class="row spaceAround">
                                            <div class="col s2">
                                                <p class="schQuesP1">End</p>
                                            </div>
                                            <div
                                                class="
                                                    input-field
                                                    col
                                                    s4
                                                    formInput1ColDiv
                                                "
                                            >
                                                <select class="validate formInput1 browser-default" v-model="experiences.monthEnd">
                                                    <option :value="''" disabled selected>Month</option>
                                                    <option v-for="(month, index) in months" :key="index" :value="index+1">{{ month }}</option>
                                                </select>
                                            </div>
                                            <div
                                                class="
                                                    input-field
                                                    col
                                                    s4
                                                    formInput1ColDiv
                                                "
                                            >
                                                <date-picker v-model:value="experiences.yearEnd" type="year" placeholder="Year"></date-picker>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div v-show="experienceCheck == 4">
                            <p class="contentTitle">
                                Do you want to add more experience
                            </p>
                            <div class="radioBtnMainDiv">
                                <p>
                                    <label @click="expSelected()">
                                        <input
                                            class="with-gap"
                                            name="intern"
                                            type="radio"
                                        />
                                        <span class="radioBtnSpan">Yes</span>
                                    </label>
                                </p>
                                <p>
                                    <label @click="expNotSelected()">
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
                    </div>

                    <!-- Add More Quarifications Section -->
                    <div v-show="view == 9">
                        <div v-show="addQualificaion == 0">
                            <p class="contentTitle">
                                Do you have additional academic qualifications
                            </p>
                            <div class="radioBtnMainDiv">
                                <p>
                                    <label @click="addQualSelected()">
                                        <input
                                            class="with-gap"
                                            name="intern"
                                            type="radio"
                                        />
                                        <span class="radioBtnSpan">Yes</span>
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
                                            placeholder="What institution"
                                            type="text"
                                            class="validate formInput"
                                            v-model="additionalSchool.institution"
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
                                            placeholder="What degree"
                                            type="text"
                                            class="validate formInput"
                                            v-model="additionalSchool.degree"
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
                                            When did you start
                                        </p>
                                        <div class="row spaceAround">
                                            <div class="col s3">
                                                <p class="schQuesP1">Start</p>
                                            </div>
                                            <div
                                                class="
                                                    input-field
                                                    col
                                                    s4
                                                    formInput1ColDiv
                                                "
                                            >
                                                <select class="validate formInput1 browser-default" v-model="additionalSchool.monthStart">
                                                    <option :value="''" disabled selected>Month</option>
                                                    <option v-for="(month, index) in months" :key="index" :value="index+1">{{ month }}</option>
                                                </select>
                                            </div>
                                            <div
                                                class="
                                                    input-field
                                                    col
                                                    s4
                                                    formInput1ColDiv
                                                "
                                            >
                                            <date-picker v-model:value="additionalSchool.yearStart" type="year" placeholder="Year"></date-picker>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col s6">
                                        <p class="schQuesP">When did you end</p>
                                        <div class="row spaceAround">
                                            <div class="col s2">
                                                <p class="schQuesP1">End</p>
                                            </div>
                                            <div
                                                class="
                                                    input-field
                                                    col
                                                    s4
                                                    formInput1ColDiv
                                                "
                                            >
                                                <select class="validate formInput1 browser-default" v-model="additionalSchool.monthEnd">
                                                    <option :value="''" disabled selected>Month</option>
                                                    <option v-for="(month, index) in months" :key="index" :value="index+1">{{ month }}</option>
                                                </select>
                                            </div>
                                            <div
                                                class="
                                                    input-field
                                                    col
                                                    s4
                                                    formInput1ColDiv
                                                "
                                            >
                                                <date-picker v-model:value="additionalSchool.yearEnd" type="year" placeholder="Year"></date-picker>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div v-show="addQualificaion == 4">
                            <p class="contentTitle">
                                Do you want to add more additional
                                qualifications
                            </p>

                            <div class="radioBtnMainDiv">
                                <p>
                                    <label @click="addMoreQualSelected()">
                                        <input
                                            class="with-gap"
                                            name="intern"
                                            type="radio"
                                        />
                                        <span class="radioBtnSpan">Yes</span>
                                    </label>
                                </p>
                                <p>
                                    <label @click="addMoreQualNotSelected()">
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
                    </div>

                    <!-- Service Section -->
                    <div v-show="view == 10">
                        <div v-show="servicesCheck == 0">
                            <p class="contentTitle">Do you render any services?</p>
                            
                            <div class="radioBtnMainDiv">
                                <p>
                                    <label @click="servicesSelected()">
                                        <input class="with-gap" name="intern" type="radio" />
                                        <span class="radioBtnSpan">Yes</span>
                                    </label>
                                </p>
                                <p>
                                    <label @click="servicesNotSelected()">
                                        <input class="with-gap" name="intern" type="radio" />
                                        <span class="radioBtnSpan">No</span>
                                    </label>
                                </p>
                            </div>
                        </div>

                        <div v-show="servicesCheck == 1">
                            <p class="contentTitle">Tell us about your services</p>

                            <form class="mainForm">
                                <div class="row formContainDiv">
                                    <div class="input-field col s12">
                                        <input placeholder="Title" type="text" class="validate formInput" v-model="service.title">
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div v-show="servicesCheck == 2">
                            <p class="contentTitle">Do you want to add more services?</p>
                        
                            <div class="radioBtnMainDiv">
                                <p>
                                    <label @click="addMoreServicesSelected()">
                                        <input class="with-gap" name="intern" type="radio" />
                                        <span class="radioBtnSpan">Yes</span>
                                    </label>
                                </p>
                                <p>
                                    <label @click="addMoreServicesNotSelected()">
                                        <input class="with-gap" name="intern" type="radio" />
                                        <span class="radioBtnSpan">No</span>
                                    </label>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Publish Section -->
                    <div v-show="view == 11">
                        <p class="contentTitle">
                            <span class="serviceSuccessTxt">Congrats!</span>
                            Curriculum Vitae completed
                        </p>

                        <div class="row serviceBtnRowDiv">
                            <div class="col s5 m4 offset-s1 offset-m2">
                                <button class="waves-effect waves-light btn goLiveFreeBtn modal-trigger" href="#modal1" @click="sendEmail('freemium')">
                                    Go live <br> Free
                                </button>

                                <ul>
                                    <li>Secured website</li>
                                    <li>Custom domain name</li>
                                    <li>Branded email</li>
                                </ul>
                            </div>
                            <div class="col s5 m4 offset-s1 offset-m1">
                                <button class="waves-effect waves-light btn goLiveProBtn modal-trigger" href="#modal1" @click="sendEmail('premium')">
                                    Go live <br> Pro
                                </button>

                                <ul>
                                    <li>Secured website</li>
                                    <li>Custom domain name</li>
                                    <li>Branded email</li>
                                    <li>Social media stream</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Prev/Next Button Section -->
                    <div>
                        <div v-if="view > 0 && view <= 3" class="skipDiv">
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
                            <span class="skipTxt">skip</span>
                            <button
                                class="skipBtn"
                                @click="next()"
                                :disabled="view == view.length"
                                :class="view != 4 ? 'btnOn' : 'btnOff'"
                            >
                                <i class="material-icons"
                                    >keyboard_arrow_right</i
                                >
                            </button>

                            <!-- <i class="material-icons skipBtnIcon" @click="prev()">keyboard_arrow_left</i>
                            <span class="skipTxt">skip</span>
                            <i class="material-icons skipBtnIcon" @click="next()">keyboard_arrow_right</i> -->
                        </div>
                        <div v-if="view == 4 && academicCheck == 1">
                            <div class="skipDiv">
                                <!-- :disabled="academicCheck == 0"  :class="
                                        attendedSchInfo > 0 ? 'btnOn' : 'btnOff'
                                    "-->
                                <button
                                    class="skipBtn"
                                    @click="prev1()"
                                   
                                >
                                    <i class="material-icons"
                                        >keyboard_arrow_left</i
                                    >
                                </button>
                                <span class="skipTxt">skip</span>
                                <button
                                    class="skipBtn"
                                    @click="next1()"
                                    :disabled="
                                        academicCheck == academicCheck.length
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
                        <div
                            v-if="
                                view == 4 &&
                                academicCheck == 2 &&
                                attendedMedSch <= 3
                            "
                        >
                            <div class="skipDiv">
                                <!-- :disabled="academicCheck == 0"
                                    :class="
                                        attendedMedSch > 0 ? 'btnOn' : 'btnOff'
                                    " -->
                                <button
                                    class="skipBtn"
                                    @click="prev2()"
                                    
                                >
                                    <i class="material-icons"
                                        >keyboard_arrow_left</i
                                    >
                                </button>
                                <span class="skipTxt">skip</span>
                                <button
                                    class="skipBtn"
                                    @click="next2()"
                                    :disabled="
                                        academicCheck == academicCheck.length
                                    "
                                    :class="
                                        attendedMedSch != 3 ? 'btnOn' : 'btnOff'
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
                                <!-- :disabled="internshipCheck == 0"
                                    :class="
                                        internshipCheck > 0 ? 'btnOn' : 'btnOff'
                                    " -->
                                <button
                                    class="skipBtn"
                                    @click="prev3()"
                                    
                                >
                                    <i class="material-icons"
                                        >keyboard_arrow_left</i
                                    >
                                </button>
                                <span class="skipTxt">skip</span>
                                <button
                                    class="skipBtn"
                                    @click="next3()"
                                    :disabled="internshipCheck == 0"
                                    :class="
                                        internshipCheck < 1 ? 'btnOff' : 'btnOn'
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
                                <!-- :disabled="fellowshipCheck == 0"
                                    :class="
                                        fellowshipCheck > 0 ? 'btnOn' : 'btnOff'
                                    " -->
                                <button
                                    class="skipBtn"
                                    @click="prev4()"
                                    
                                >
                                    <i class="material-icons"
                                        >keyboard_arrow_left</i
                                    >
                                </button>
                                <span class="skipTxt">skip</span>
                                <button
                                    class="skipBtn"
                                    @click="next4()"
                                    :disabled="fellowshipCheck == 0"
                                    :class="
                                        fellowshipCheck < 1 ? 'btnOff' : 'btnOn'
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
                                <!-- :disabled="residencyCheck == 0"
                                    :class="
                                        residencyCheck > 0 ? 'btnOn' : 'btnOff'
                                    " -->
                                <button
                                    class="skipBtn"
                                    @click="prev5()"
                                    
                                >
                                    <i class="material-icons"
                                        >keyboard_arrow_left</i
                                    >
                                </button>
                                <span class="skipTxt">skip</span>
                                <button
                                    class="skipBtn"
                                    @click="next5()"
                                    :disabled="residencyCheck == 0"
                                    :class="
                                        residencyCheck < 1 ? 'btnOff' : 'btnOn'
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
                                <!-- :disabled="experienceCheck == 0"
                                    :class="
                                        experienceCheck > 0 ? 'btnOn' : 'btnOff'
                                    " -->
                                <button
                                    class="skipBtn"
                                    @click="prev6()"
                                    
                                >
                                    <i class="material-icons"
                                        >keyboard_arrow_left</i
                                    >
                                </button>
                                <span class="skipTxt">skip</span>
                                <button
                                    class="skipBtn"
                                    @click="next6()"
                                    :disabled="experienceCheck > 4"
                                    :class="
                                        experienceCheck > 4 ? 'btnOff' : 'btnOn'
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
                                    class="skipBtn"
                                    @click="prev7()"
                                    :disabled="addQualificaion == 0"
                                    :class="
                                        addQualificaion > 0 ? 'btnOn' : 'btnOff'
                                    "
                                >
                                    <i class="material-icons"
                                        >keyboard_arrow_left</i
                                    >
                                </button>
                                <span class="skipTxt">skip</span>
                                <button
                                    class="skipBtn"
                                    @click="next7()"
                                    :disabled="addQualificaion > 5"
                                    :class="
                                        addQualificaion > 5 ? 'btnOff' : 'btnOn'
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
                                <button class="skipBtn" 
                                    @click="prev8()" 
                                    :disabled="servicesCheck >= 3"
                                    :class="servicesCheck >= 3 ? 'btnOff' : 'btnOn'"
                                >
                                    <i class="material-icons">keyboard_arrow_left</i>
                                </button>
                                    <span class="skipTxt">skip</span>
                                <button class="skipBtn" 
                                    @click="next8()" 
                                    :disabled="servicesCheck == 0"
                                    :class="servicesCheck < 1 ? 'btnOff' : 'btnOn'"
                                >
                                    <i class="material-icons">keyboard_arrow_right</i>
                                </button>
                            </div>
                        </div>
                        <div v-if="view == 11">
                            <div class="skipDiv">
                                <button class="skipBtn" 
                                    @click="prev9()" 
                                    :disabled="view < 10"
                                    :class="view < 10 ? 'btnOff' : 'btnOn'"
                                >
                                    <i class="material-icons">keyboard_arrow_left</i>
                                </button>
                                    <span class="skipTxt">skip</span>
                                <button class="skipBtn" 
                                    @click="next9()" 
                                    :disabled="view == 11"
                                    :class="view >= 11 ? 'btnOff' : 'btnOn'"
                                >
                                    <i class="material-icons">keyboard_arrow_right</i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- <InnerFooter /> -->
                </div>
            </div>
            <div id="modal1" class="modal">
                <div class="modal-content">
                    <i class="fas fa-spinner fa-spin fa-2xl flex center-align"></i>
                    <p class="centered">Setting up your site</p>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import InnerFooter from "../partials/InnerFooterComponent.vue";
    import DatePicker from 'vue-datepicker-next';
    import 'vue-datepicker-next/index.css';
    export default {
        components: {
            InnerFooter,
            DatePicker
        },

        data() {
            return {
                view: 0,
                bio: {
                    firstname: "",
                    lastname: "",
                    othername: "",
                    title_id: "",
                    photo: null
                },
                domainCheckPassed: null,
                domainSuggestions: [],
                domainSelected: "",
                bioData: {},
                initialDomain: "",
                experiences: {
                    institution: "",
                    yearStart: "",
                    yearEnd: "",
                    monthStart: "",
                    monthEnd: "",
                    position: "",
                    location: "",
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
                service: {
                    title: "",
                },
                months: [
                    'JAN',
                    'FEB',
                    'MAR',
                    'APR',
                    'MAY',
                    'JUN',
                    'JUL',
                    'AUG',
                    'SEP',
                    'OCT',
                    'NOV',
                    'DEC'
                ],
                tenantId: null,

                academicCheck: 0,
                attendedSchInfo: 0,
                attendedMedSch: 0,

                internshipCheck: 0,
                fellowshipCheck: 0,
                residencyCheck: 0,
                experienceCheck: 0,
                addQualificaion: 0,
                servicesCheck: 0,

            };
        },
        mounted() {
            this.getTenantNDomain();
            document.addEventListener('DOMContentLoaded', function() {
                var elems = document.querySelector('#modal1');
                let options = {
                    dismissible: false,
                }
                var instances = M.Modal.init(elems, options);
            });
        },
        methods: {
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
                            } else if (res.data.status == 0) {
                                this.domainCheckPassed = false;
                            }
                            this.checkingSuggestion = false;
                        })
                        .catch((err) => {
                            console.log(err);
                            this.checkingSuggestion = false;
                        });
                }
            },
            next() {
                if (this.view === 1) {
                    this.registerUpdateUser();
                    this.updateBio();
                    this.generateMultiple();
                }
                if (this.view === 2) {
                    this.updateDomain();
                }
                if (this.view == 3) {
                    this.updatePhoto();
                    this.view++;
                }
                this.view != 4 ? this.view++ : this.academicCheck = 0;
            },
            getStarted() {
                this.view = 1;
            },
            getTenantNDomain() {
                axios
                    .get("/claim/getTenantDomain")
                    .then((res) => {
                        console.log(res);
                        if (res.data.status == 200) {
                            this.domainSelected = res.data.domain;
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
            generateMultiple() {
                let title = this.titles.filter(
                    (el) => el.id == this.bioData.title_id
                );
                this.domainSuggestions.push({
                    name: (
                        title[0].name +
                        this.bio.firstname +
                        this.bio.lastname +
                        ".com"
                    ).toLowerCase(),
                });
                this.domainSuggestions.push({
                    name: (
                        title[0].name +
                        this.bio.lastname +
                        this.bio.firstname +
                        ".com"
                    ).toLowerCase(),
                });
                this.domainSuggestions.push({
                    name: (
                        this.bio.firstname +
                        this.bio.lastname +
                        title[0].name +
                        ".com"
                    ).toLowerCase(),
                });
                this.domainSuggestions.push({
                    name: (
                        this.bio.lastname +
                        this.bio.firstname +
                        title[0].name +
                        ".com"
                    ).toLowerCase(),
                });
                this.domainSuggestions.push({
                    name: (
                        title[0].name +
                        this.bio.lastname +
                        ".com"
                    ).toLowerCase(),
                });
                this.domainSuggestions.push({
                    name: (
                        title[0].name +
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
                this.bioData = data[0];
                this.bio.firstname = data[0].firstname;
                this.bio.lastname = data[0].lastname;
                this.bio.othername = data[0].othername;
                this.bio.title_id = data[0].title_id;
                this.bio.photo = data[0].photo;
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
                if (!e.target.files.length) return;
                this.bio.photo = e.target.files[0];
                this.uploaded = URL.createObjectURL(e.target.files[0]);
            },
            prev() {
                this.view != 0 ? this.view-- : null;
            },
            // If user clicks on next for the view 1 register user or update details
            registerUpdateUser() {
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
                            if (res.data.status == 200 || res.data.status == 201) {
                                M.toast({
                                    html: res.data.msg,
                                    classes: "successNotifier",
                                });
                                localStorage.setItem('passwordGen', this.bio.password);
                            }
                        })
                        .catch((err) => {
                            console.log(err);
                        });
                }
            },
            saveExperience() {
                if (
                    this.experiences.institution != '' ||
                    this.experiences.yearEnd != '' ||
                    this.experiences.monthEnd != '' ||
                    this.experiences.yearStart != '' ||
                    this.experiences.monthStart != '' ||
                    this.experiences.position != '' ||
                    this.experiences.location != ''
                ) {
                    this.experiences.yearStart != '' || this.experiences.yearEnd != '' ? (this.experiences.yearStart = this.experiences.yearStart.getFullYear() , this.experiences.yearEnd = this.experiences.yearEnd.getFullYear()) : null
                    axios
                        .post("/claim/saveexperience", this.experiences)
                        .then((res) => {
                            if (res.data.status == 201) {
                                M.toast({
                                    html: res.data.message,
                                    classes: "successNotifier",
                                });
                                this.experiences.id = res.data.id;
                            }
                        })
                        .catch((err) => {
                            console.log(err);
                        });
                }
            },
            saveUndergradSchoolTime() {
                if (
                    this.underGrad.institution != '' ||
                    this.underGrad.yearEnd != '' ||
                    this.underGrad.monthEnd != '' ||
                    this.underGrad.major != '' ||
                    this.underGrad.yearStart != '' ||
                    this.underGrad.monthStart != '' ||
                    this.underGrad.minor != '' 
                ) {
                    this.underGrad.yearStart != '' || this.underGrad.yearEnd != '' ? (this.underGrad.yearStart = this.underGrad.yearStart.getFullYear() , this.underGrad.yearEnd = this.underGrad.yearEnd.getFullYear()) : null
                    axios
                        .post("/claim/saveUndergrad", this.underGrad)
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
            saveAdditionalSchoolTime() {
                if (
                    this.additionalSchool.institution != '' ||
                    this.additionalSchool.yearEnd != '' ||
                    this.additionalSchool.monthEnd != '' ||
                    this.additionalSchool.degree != '' ||
                    this.additionalSchool.yearStart != '' ||
                    this.additionalSchool.monthStart != '' 
                ) {
                    this.additionalSchool.yearStart != '' || this.additionalSchool.yearEnd != '' ? (this.additionalSchool.yearStart = this.additionalSchool.yearStart.getFullYear() , this.additionalSchool.yearEnd = this.additionalSchool.yearEnd.getFullYear()) : null
                    axios
                        .post("/claim/save/additonalqualification", this.additionalSchool)
                        .then((res) => {
                            if (res.data.status == 201) {
                                M.toast({
                                    html: res.data.message,
                                    classes: "successNotifier",
                                });
                                this.additionalSchool.id = res.data.id;
                            }
                        })
                        .catch((err) => {
                            console.log(err);
                        });
                }
            },
            saveMedSchoolTime() {
                if (
                    this.medSchool.institution != '' ||
                    this.medSchool.yearEnd != '' ||
                    this.medSchool.monthEnd != '' ||
                    this.medSchool.type != '' ||
                    this.medSchool.yearStart != '' ||
                    this.medSchool.monthStart != '' 
                ) {
                    this.medSchool.yearStart != '' || this.medSchool.yearEnd != '' ? (this.medSchool.yearStart = this.medSchool.yearStart.getFullYear() , this.medSchool.yearEnd = this.medSchool.yearEnd.getFullYear()) : null
                    axios
                        .post("/claim/savemedicalschooltime", this.medSchool)
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
            saveInternshipTime() {
                if (
                    this.internship.institution != '' ||
                    this.internship.yearEnd != '' ||
                    this.internship.monthEnd != '' ||
                    this.internship.type != '' ||
                    this.internship.yearStart != '' ||
                    this.internship.monthStart != '' ||
                    this.internship.location != '' 
                ) {
                    this.internship.yearStart != '' || this.internship.yearEnd != '' ? (this.internship.yearStart = this.internship.yearStart.getFullYear() , this.internship.yearEnd = this.internship.yearEnd.getFullYear()) : null
                    axios
                        .post("/claim/saveinternship", this.internship)
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
            saveServiceOffered() {
                console.log('hey');
                if (
                    this.service.title != ''
                ) {
                    axios
                        .post("/claim/save/service", this.service)
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
            saveFellowshipTime() {
                if (
                    this.fellowship.institution != '' ||
                    this.fellowship.yearEnd != '' ||
                    this.fellowship.monthEnd != '' ||
                    this.fellowship.type != '' ||
                    this.fellowship.yearStart != '' ||
                    this.fellowship.monthStart != ''
                ) {
                    this.fellowship.yearStart != '' || this.fellowship.yearEnd != '' ? (this.fellowship.yearStart = this.fellowship.yearStart.getFullYear() , this.fellowship.yearEnd = this.fellowship.yearEnd.getFullYear()) : null
                    axios
                        .post("/claim/savefellowship", this.fellowship)
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
            saveResidencyTime() {
                if (
                    this.residency.institution != '' ||
                    this.residency.yearEnd != '' ||
                    this.residency.monthEnd != '' ||
                    this.residency.type != '' ||
                    this.residency.yearStart != '' ||
                    this.residency.monthStart != '' 
                ) {
                    this.residency.yearStart != '' || this.residency.yearEnd != '' ? (this.residency.yearStart = this.residency.yearStart.getFullYear() , this.residency.yearEnd = this.residency.yearEnd.getFullYear()) : null
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
            updateBio() {
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
                                M.toast({
                                    html: res.data.msg,
                                    classes: "successNotifier",
                                });
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
            },
            updateDomain() {
                if (this.initialDomain != this.domainSelected) {
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
                            }
                        })
                        .catch((err) => {
                            console.log(err);
                        });
                }
            },
            updatePhoto() {
                if (typeof(this.bio.photo) == 'string') {
                    return 'blinke';
                }
                else {
                    this.uploadPhotoProcessing = true;
                    let formData = new FormData();
                    formData.append('photo', this.bio.photo);
                    formData.append('_method', 'PUT')
                    axios.post('/claim/updateAvatar/bio', formData).then(res => {
                        console.log(res);
                        if (res.data.status == 200) {
                            M.toast({
                                html: res.data.message,
                                classes: "successNotifier",
                            });
                            localStorage.setItem(
                                "claimproc",
                                JSON.stringify([res.data.bio])
                            );
                            this.uploadPhotoProcessing = false;
                        }
                    }).catch(err => {
                        if (err.response.status == 400) {
                            err.response.data.forEach((el) => {
                                M.toast({
                                    html: el,
                                    classes: "errorNotifier",
                                });
                            });
                        }
                        this.uploadPhotoProcessing = false;
                        console.log(err);
                    })
                }
            },

            undergradMedSelected() {
                this.academicCheck = 1;
                this.attendedSchInfo = 0;
            },
            medSelected() {
                this.academicCheck = 2;
            },
            prev1() {
                this.attendedSchInfo != 0 ? this.attendedSchInfo-- : this.view = 3;

            },
            next1() {
                this.attendedSchInfo != 3 ? (this.saveUndergradSchoolTime(), this.attendedSchInfo++) : null;
                    
                if (this.attendedSchInfo >= 3) {
                    this.academicCheck = 2;
                }
            },
            prev2() {
                this.attendedMedSch != 0 ? this.attendedMedSch-- : this.attendedSchInfo = 3;
                if (this.attendedMedSch == 0) {
                    this.academicCheck = 0;
                }
            },
            next2() {
                this.attendedMedSch != 3 ? (this.saveMedSchoolTime(), this.attendedMedSch++) : null;

                if (this.attendedMedSch == 3) {
                    this.view = 5;
                }
            },
            internSelected() {
                this.internshipCheck = 1;
            },
            internNotSelected() {
                this.view = 6;
            },
            prev3() {
                this.internshipCheck != 0 ? this.internshipCheck-- : (this.view = 4, this.attendedMedSch = 2);
            },
            next3() {
                this.internshipCheck != 3 ? (this.saveInternshipTime(), this.internshipCheck++) : null;

                if (this.internshipCheck >= 3) {
                    this.view = 6;
                }
            },
            prev4() {
                this.fellowshipCheck != 0 ? this.fellowshipCheck-- : this.view = 5;
            },
            next4() {
                this.fellowshipCheck != 3 ? (this.saveFellowshipTime(), this.fellowshipCheck++) : null;

                if (this.fellowshipCheck >= 3) {
                    this.view = 7;
                }
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
            prev5() {
                this.residencyCheck != 0 ? this.residencyCheck-- : this.view--;
            },
            next5() {
                this.residencyCheck != 3 ? (this.saveResidencyTime(), this.residencyCheck++) : null;

                if (this.residencyCheck >= 3) {
                    this.view = 8;
                }
            },
            prev6() {
                this.experienceCheck != 0 ? this.experienceCheck-- : this.view--;
            },
            next6() {
                this.experienceCheck != 5 ? (this.saveExperience(), this.experienceCheck++) : null;

                if (this.experienceCheck >= 5) {
                    this.view = 9;
                }
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
            },
            expNotSelected() {
                this.view = 9;
            },
            prev7() {
                this.addQualificaion != 0 ? this.addQualificaion-- : this.view--;
            },
            next7() {
                this.addQualificaion != 5 ? (this.saveAdditionalSchoolTime(), this.addQualificaion++) : null;

                if (this.addQualificaion >= 5) {
                    this.view = 10;
                }
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
            addMoreQualNotSelected() {
                this.view = 10;
            },
            prev8() {
                this.servicesCheck != 0 ? this.servicesCheck-- : null;

                // if (this.servicesCheck < 2) {
                //     this.view = 9;
                //     this.addQualificaion = 4;
                // }
            },
            next8() {
                if (this.servicesCheck == 1 ) this.saveServiceOffered()
                this.servicesCheck != 3 ? this.servicesCheck++ : null;
                if (this.servicesCheck >= 3) {
                    this.view = 11;
                }
            },
            addMoreServicesSelected() {
                this.servicesCheck = 1;
                this.service = {
                    title: "",
                };
            }, 
            addMoreServicesNotSelected() {
                this.view = 11;
            },
            servicesSelected() {
                this.servicesCheck = 1;
            },
            servicesNotSelected() {
                this.view = 11;
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
            sendEmail(val) {
                /**
                 * What this does is to get the saved dummy password for the user and whatever plan he chose and send details
                 * to the user, getting the email from the session on the server and sending to him
                 */
                 
                let data = {plan: val, password: localStorage.getItem('passwordGen'), domain: this.domainSelected};
                axios.post('/claim/successdomainregistra', data).then(res => {
                    if (res.status == 201) {
                        M.toast({
                            html: res.data.message,
                            classes: 'successNotifier'
                        });
                        localStorage.removeItem('claimproc');
                        localStorage.removeItem('passwordGen');
                        location.replace(`http://${this.domainSelected}.whitecoatdomain.com`);
                    }
                }).catch(err => {
                    let elem = document.getElementById("modal1"); //.getElementsByClassName('modal-close').click()
                    var instance = M.Modal.getInstance(elem);
                    instance.close();
                    console.log(err);
                })
            }
        },
        props: { claimaint: String, titles: Array, claimant: String },
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
            titles: {
                // immediate: true,
                handler(val, oldval) {
                    // if (val) console.log(this.generateMultiple(), oldval);
                },
            },
        },
    };
</script>
<style scoped>
    .flex {
        display: flex;
    }
    .btnOn {
        border: 2px solid var(--primary);
        color: var(--primary);
    }
    .btnOff {
        border: 2px solid #d9d9d9;
        color: #d9d9d9;
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
    .file-path-wrapper  {
        display: flex;
        align-items: center;
    }
    .input-field {
        margin-top: 0;
        margin-bottom: 0;
    }
    #custom-input {
        width: 3rem;
        border-bottom: 0;
        text-decoration: underline;
        color: rgb(160, 88, 88);
    }
    #custom-input::placeholder {
        color: rgb(231, 111, 111);
    }
    select {
        padding: 0;
    }
    .modal-content {
        padding-bottom: 0px;
    }
    #modal1 {   transform: translateY(-50%) scaleX(1) !important; top: 50% !important;}

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
            }
</style>