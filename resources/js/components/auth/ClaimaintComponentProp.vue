<template>
    <div>
        <div class="row">
            <div id="popup">
                <div class="paymentOverlay cFlex">
                    <a class="btn btn-small waves waves-effect" @click="makePayment">Continue to payment</a>
                </div>
                <h5 class="center-align">Preview website </h5>
                <iframe title="Your website preview" srcdoc="Loading..."  id="iframe" onload="this.removeAttribute('srcdoc')"></iframe>
            </div>
            <div class="col s12 noPaddingLeft noPaddingRight">
                <div class="websiteClaimContainer">
                    <div class="col l6 s12 noPaddingLeft noPaddingRight">
                        <div id="page"></div>
                        <div class="contentDiv">
                            <div class="contentInnerDiv">
                                <!-- Get Started Section -->
                                <div v-show="view == 0" class="intro">
                                    <div class="center-align">
                                        <a href="/">
                                            <img
                                                v-if="tenantOnDemand == 1"
                                                src="/media/img/wcdlogodeepblue.webp"
                                                alt="WhiteCoatDomain Logo"
                                                class="responsive-img"
                                                width="287"
                                                height="173"
                                            />
                                            <img
                                                v-else
                                                src="/media/img/wcd-logo-noBckg.webp"
                                                alt="WhiteCoatDomain Logo"
                                                class=""
                                                width="287"
                                                height="173"
                                            />
                                        </a>
                                        <p class="contentTitle marginTop-5">
                                            Lets help you setup your website
                                        </p>

                                        <div class="getStartedBtnDiv">
                                            <a
                                                class="waves-effect waves-black btn getStartedBtn" :class="{'tenantOnDemand': tenantOnDemand == 1}"
                                                @click="getStarted()"
                                                >GET STARTED</a
                                            >
                                        </div>
                                    </div>
                                </div>

                            <!-- Confirm your name section -->
                            <div v-show="view == 1">
                                <section class="row" id="bio">
                                    <h4 class="sectionTitle">
                                        Basic information
                                    </h4>
                                    
                                    <div class="row formInnerDiv">
                                        <div class="input-field selectInputField noMarginLeft col l2 m2 s12 noPaddingLeft paddingLeftSM">
                                            <select
                                                v-model="bio.title_id"
                                                required
                                                class="browser-default"
                                                id="userTitle"
                                                data-label="true"
                                                @change="switchText($event)"
                                            >
                                                <option
                                                    :value="''"
                                                    disabled
                                                    selected
                                                >
                                                    Pick Title
                                                </option>
                                                <option
                                                    v-for="title in titles"
                                                    :key="title.id"
                                                    :value="title.id"
                                                >
                                                    {{ title.name }}
                                                </option>
                                            </select>
                                            <label>Title</label>
                                        </div>

                                        <div class="input-field col l3 m3 s12">
                                            <input
                                                type="text"
                                                v-model="bio.firstname"
                                                class="validate"
                                                required
                                                placeholder="Firstname"
                                                @keyup="removeLabel($event)"
                                            />
                                            <label>Firstname</label>
                                        </div>
                                        <div class="input-field col l3 m3 s12">
                                            <input
                                                type="text"
                                                v-model="bio.lastname"
                                                class="validate"
                                                placeholder="Lastname"
                                                @keyup="(removeLabel($event), checkTenantOnDemand())"
                                            />
                                            <label>Lastname</label>
                                        </div>
                                        <div class="input-field col l3 m3 s12">
                                            <input
                                                type="text"
                                                v-model="bio.othername"
                                                class="validate"
                                                placeholder="Othernames"
                                                data-optional="true"
                                            />
                                            <label>Othername</label>
                                        </div>
                                    </div>
                                </section>

                                <section class="row" id="domain">
                                    <h4 class="sectionTitle">
                                        Domain name
                                    </h4>
                                    <div>
                                        <div class="row">
                                            <div class="input-field col l12 s12 noPaddingLeft paddingLeftSM">
                                                <input
                                                    type="text"
                                                    v-model="domainSelected"
                                                    class="validate noMarginBottom"
                                                    placeholder="Hit enter to search"
                                                    @keyup="checkDomainAvailability($event)"
                                                    data-no-label="true"
                                                />
                                                <div class="col l12 s12 right-align">
                                                    <i
                                                        class="fas fa-spinner fa-spin fa-1x"
                                                        v-if="checkingSuggestion"
                                                    ></i>
                                                    <small
                                                        class="unAvailTitle"
                                                        v-if="domainCheckPassed == false"
                                                    >
                                                        Unavailable
                                                    </small>
                                                    <small
                                                        class="availTitle"
                                                        v-if="domainCheckPassed == true"
                                                    >
                                                        Available
                                                    </small>
                                                </div>
                                                <p class="unAvailTxt noMarginBottom">
                                                    Not satisfied with the suggested domain name above, type in your preferred domain
                                                    name or <a href="#!" @click="generateMultiple">view our suggestions</a>.
                                                </p>
                                            </div>
                                            
                                        </div>
                                    </div>

                                    <div class="row" v-if="suggestionLoaded">
                                        <div class="col s12 domianMainDiv">
                                            <!--p class="noMarginTop"><a href="">Display Suggestions</a></p-->
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
                                </section>

                                <section class="row" id="brandImage">
                                    <h4 class="sectionTitle">
                                        Main Website Image
                                    </h4>
                                    <div v-if="showCropper" class="cFlex flexRight">
                                        <a class="right" href="#" @click="showCropper = false">
                                            <i class="material-icons priText">clear</i>
                                        </a>
                                    </div>

                                    <div class="proImgContainer" v-show="!showCropper">
                                        <img
                                            class="proImg"
                                            src="/media/img/doctor.png"
                                            v-if="bioData.photo === null || bio.photo === undefined"
                                        />
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
                                            v-else-if="
                                                bioData.photo !== null || bio.photo !== undefined ||
                                                uploaded !== null
                                            "
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
                                                <div class="" id="genUploadFavIconDiv">
                                                    <div
                                                        class=""
                                                        v-if="!uploadPhotoProcessing"
                                                    >
                                                        <div class="col l12 center-align marginTop-5">
                                                            <a
                                                                href="#"
                                                                role="button"
                                                                @click.prevent="
                                                                    showFileChooser
                                                                "
                                                                v-if="!showCropper"
                                                                class="btn btn-flat"
                                                                :class="{'tenantOnDemand': tenantOnDemand == 1}"
                                                            >
                                                                <span
                                                                    v-if="
                                                                        bioData.photo !==
                                                                            null ||
                                                                        uploaded !== null
                                                                    "
                                                                    >
                                                                        <span>Change Image</span>
                                                                        <i class="material-icons white-text right">edit</i>
                                                                    </span
                                                                >
                                                                <span v-else>
                                                                    <i class="material-icons white-text">file_upload</i>
                                                                </span>
                                                            </a>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col s12">
                                                                <image-cropper v-if="tenantId && showCropper"
                                                                    :height="799"
                                                                    :width="650"
                                                                    :img="bio.photo == undefined ? '/media/img/doctor.png' : '/media/tenants/'+tenantId +'/img/'+bioData.photo"
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
                                        </div>
                                    </form>
                                </section>
                            

                                <section class="row" id="underGrad">
                                    <h4 class="sectionTitle">
                                        Undergraduate School <br/>
                                        <small>Only fill if you had an undergrad progam before medical school</small>
                                    </h4>

                                    <div class="row">
                                        <div class="col l12 s12 noPaddingLeft paddingLeftSM">
                                            <input
                                                placeholder="Name of institution"
                                                v-model="underGrad.institution"
                                                @keyup="removeLabel($event)"
                                                type="text"
                                                class="validate formInput"
                                            />
                                            <label>Name of institution</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col l6 m6 s12 noPaddingLeft paddingLeftSM">
                                            <input
                                                placeholder="What was your major?"
                                                type="text"
                                                v-model="
                                                    underGrad.major
                                                "
                                                @keyup="removeLabel($event)"
                                                class="validate formInput"
                                            />
                                            <label>Undergraduate Major</label>
                                        </div>
                                        <div class="input-field col l6 m6 s12">
                                            <input
                                                placeholder="What was your minor(optional)?"
                                                type="text"
                                                v-model="underGrad.minor"
                                                data-optional="true"
                                                class="validate formInput"
                                            />
                                            <label>Undergraduate Minor(optional)</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col l6 m6 s12 noPaddingLeft noPaddingRightMd paddingLeftSM">
                                            <p class="schQuesP">
                                                When did you start?
                                            </p>
                                            <div
                                                class="row spaceAround"
                                            >
                                                <div
                                                    class="input-field col s6 formInput1ColDiv noPaddingLeft"
                                                >
                                                    <select
                                                        class="validate formInput1 browser-default"
                                                        v-model="
                                                            underGrad.monthStart
                                                        "
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
                                                    class="input-field col s6 formInput1ColDiv"
                                                >
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

                                        <div class="col l6 m6 s12 noPaddingLeftMd paddingLeftSM">
                                            <p class="schQuesP">
                                                When did you finish?
                                            </p>
                                            <div
                                                class="row spaceAround"
                                            >
                                                <div
                                                    class="input-field col s6 formInput1ColDiv noPaddingLeft"
                                                >
                                                    <select
                                                        class="validate formInput1 browser-default"
                                                        v-model="
                                                            underGrad.monthEnd
                                                        "
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
                                                    class="input-field col s6 formInput1ColDiv noPaddingRight"
                                                >
                                                    <date-picker
                                                        v-model:value="
                                                            underGrad.yearEnd
                                                        "
                                                        @change="removeLabel($event, 1)"
                                                        type="year"
                                                        placeholder="Year"
                                                    ></date-picker>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                
                                <section class="row" id="medSchool">
                                    <h4 class="sectionTitle">
                                        {{medText}} School
                                    </h4>

                                    <div class="row">
                                        <div
                                            class="input-field col l12 s12 noPaddingLeft paddingLeftSM"
                                        >
                                            <input
                                                placeholder="Name of institution"
                                                type="text"
                                                class="validate formInput"
                                                v-model="
                                                    medSchool.institution
                                                "
                                                @keyup="removeLabel($event)"
                                            />
                                            <label>Name of institution</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col l6 s6 noPaddingLeft paddingLeftSM">
                                            <p class="schQuesP">
                                                When did you start?
                                            </p>
                                            <div
                                                class="row spaceAround"
                                            >
                                                <div
                                                    class="input-field col l6 s6 noPaddingLeft formInput1ColDiv"
                                                >
                                                    <select
                                                        class="validate formInput1 browser-default"
                                                        v-model="
                                                            medSchool.monthStart
                                                        "
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
                                                    class="input-field col l6 s6 formInput1ColDiv"
                                                >
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

                                        <div class="col s6 noPaddingLeft paddingLeftSM">
                                            <p class="schQuesP">
                                                When did you finish?
                                            </p>
                                            <div
                                                class="row spaceAround"
                                            >
                                                <div
                                                    class="input-field col l6 s6 noPaddingLeft formInput1ColDiv"
                                                >
                                                    <select
                                                        class="validate formInput1 browser-default"
                                                        v-model="
                                                            medSchool.monthEnd
                                                        "
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
                                                    class="input-field col l6 s6 formInput1ColDiv noPaddingRight"
                                                >
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
                                    <h4 class="sectionTitle">
                                        Internship program
                                    </h4>
                                    <div class="row">
                                        <div class="input-field col s12 noPaddingLeft paddingLeftSM">
                                            <input
                                                placeholder="Name of institution"
                                                type="text"
                                                class="validate formInput"
                                                v-model="internship.institution"
                                                @keyup="removeLabel($event)"
                                            />
                                            <label for="Name of institution">Name of institution</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col l6 s6 noPaddingLeft paddingLeftSM">
                                            <p class="schQuesP">
                                                When did you start?
                                            </p>
                                            <div class="row spaceAround">
                                                <div
                                                    class="input-field col l6 s6 noPaddingLeft formInput1ColDiv"
                                                >
                                                    <select
                                                        class="validate formInput1 browser-default"
                                                        v-model="
                                                            internship.monthStart
                                                        "
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
                                                <div
                                                    class="input-field col l6 s6 noPaddingLeft formInput1ColDiv"
                                                >
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

                                        <div class="col s6 noPaddingLeft paddingLeftSM">
                                            <p class="schQuesP">
                                                When did you finish?
                                            </p>
                                            <div class="row spaceAround">
                                                <div
                                                    class="input-field col l6 s6 noPaddingLeft formInput1ColDiv"
                                                >
                                                    <select
                                                        class="validate formInput1 browser-default"
                                                        v-model="
                                                            internship.monthEnd
                                                        "
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
                                                <div
                                                    class="input-field col l6 s6 noPaddingRight formInput1ColDiv"
                                                >
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

                                <!-- Residency Section -->
                                <section class="row" id="residency">
                                    <h4 class="sectionTitle">
                                        Residency program
                                    </h4>
                                    <div class="row">
                                        <div class="input-field col s12 noPaddingLeft paddingLeftSM">
                                            <input
                                                placeholder="Name of institution"
                                                type="text"
                                                class="validate formInput"
                                                v-model="residency.institution"
                                                @keyup="removeLabel($event)"
                                            />
                                            <label for="Name of institution">Name of institution</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col l6 s6 noPaddingLeft paddingLeftSM">
                                            <p class="schQuesP">
                                                When did you start?
                                            </p>
                                            <div class="row spaceAround">
                                                <div
                                                    class="input-field col l6 s6 noPaddingLeft formInput1ColDiv"
                                                >
                                                    <select
                                                        class="validate formInput1 browser-default"
                                                        v-model="
                                                            residency.monthStart
                                                        "
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
                                                <div
                                                    class="input-field col l6 s6 noPaddingLeft formInput1ColDiv"
                                                >
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

                                        <div class="col s6 noPaddingLeft paddingLeftSM">
                                            <p class="schQuesP">
                                                When did you finish?
                                            </p>
                                            <div class="row spaceAround">
                                                <div
                                                    class="input-field col l6 s6 noPaddingLeft formInput1ColDiv"
                                                >
                                                    <select
                                                        class="validate formInput1 browser-default"
                                                        v-model="
                                                            residency.monthEnd
                                                        "
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
                                                <div
                                                    class="input-field col l6 s6 noPaddingRight formInput1ColDiv"
                                                >
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


                                <!-- Fellowship Section -->
                                <section class="row" id="fellowship">
                                    <h4 class="sectionTitle">
                                        Fellowship program
                                    </h4>
                                    <div class="row">
                                        <div class="input-field col s12 noPaddingLeft paddingLeftSM">
                                            <input
                                                placeholder="Name of institution"
                                                type="text"
                                                class="validate formInput"
                                                v-model="fellowship.institution"
                                                @keyup="removeLabel($event)"
                                            />
                                            <label for="Name of institution">Name of institution</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col l6 s6 noPaddingLeft paddingLeftSM">
                                            <p class="schQuesP">
                                                When did you start?
                                            </p>
                                            <div class="row spaceAround">
                                                <div
                                                    class="input-field col l6 s6 noPaddingLeft formInput1ColDiv"
                                                >
                                                    <select
                                                        class="validate formInput1 browser-default"
                                                        v-model="
                                                            fellowship.monthStart
                                                        "
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
                                                <div
                                                    class="input-field col l6 s6 noPaddingLeft formInput1ColDiv"
                                                >
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

                                        <div class="col s6 noPaddingLeft paddingLeftSM">
                                            <p class="schQuesP">
                                                When did you finish?
                                            </p>
                                            <div class="row spaceAround">
                                                <div
                                                    class="input-field col l6 s6 noPaddingLeft formInput1ColDiv"
                                                >
                                                    <select
                                                        class="validate formInput1 browser-default"
                                                        v-model="
                                                            fellowship.monthEnd
                                                        "
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
                                                <div
                                                    class="input-field col l6 s6 noPaddingRight formInput1ColDiv"
                                                >
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
                                
                                <section class="row" id="additionalSchool" v-if="tenantOnDemand == 1">
                                    <h4 class="sectionTitle">
                                        Interests
                                    </h4>
                                    <p v-if="maxSelected != ''">{{  maxSelected  }}</p>
                                    <div class="grid">
                                        <div class="pills" :class="{selected: selectedIndex.includes(index)}"   v-for="(interest, index) in interests" :key="interest.id">
                                            <p @click="getSelectedInterests(interest, index)">{{  interest.title  }}</p>
                                            <i @click="removeFromSelected(interest, index)" v-show="selectedIndex.includes(index)" class="material-icons removeInterest">close</i>
                                        </div>
                                    </div>
                                </section>
                            </div>


                                <div class="marginTop-5 marginBottom-5" v-if="view == 1">
                                    <div class="skipDiv">
                                        <button
                                            class="saveAllBtn btn btn-small waves-effect waves-black"
                                            :class="{'tenantOnDemand': tenantOnDemand == 1}"
                                            @click="saveAll()"
                                        >
                                            Save &amp; Publish
                                        </button>
                                    </div>
                                </div>
                               
                                <!-- Publish Section -->
                                <div v-show="view == 2" class="container">
                                    <div class="contentTitle" v-if="!showGoLiveBtns" >
                                        <span class="serviceSuccessTxt">Congrats!</span>
                                        Your site has been setup successfully!
                                        <span class="serviceSuccessTxt">Hooray!</span>
                                        <p class="timer">
                                            Redirecting you to your site in
                                            {{ countdown }}s
                                        </p>
                                    </div>

                                    <go-live-component :tenantOnDemand="tenantOnDemand" :showGoLiveBtns="showGoLiveBtns" :bio="bio" @sendEmail="sendEmail($event)"/>
                                </div>

                                <!-- Prev/Next Button Section -->
                                
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

                    <div class="col l6 s12  noPaddingLeft noPaddingRight fullpage" v-if='view < 2'>
                        <div class="col l6 offset-l6 hide-on-med-and-down" v-if='view > 0'>
                            <a href="/" target="_blank">
                                <img v-if="tenantOnDemand == 1" src="/media/img/wcdlogodeepblue.webp" width="287" height="173" alt="whitecoatdomain logo" class="responsive-img"/>
                                <img v-else src="/media/img/wcd-logo-noBckg.webp" width="287" height="173" alt="whitecoatdomain logo" class="responsive-img"/>
                            </a>
                        </div>
                        <div class="col m6 s6 hide-on-large-only" v-if='view > 0'>
                            <a href="/" target="_blank">
                                <img v-if="tenantOnDemand == 1" src="/media/img/wcdlogodeepblue.png" alt="whitecoatdomain logo" class="responsive-img"/>
                                <img v-else src="/media/img/wcd-logo-noBckg.webp" width="287" height="173" alt="whitecoatdomain logo" class="responsive-img"/>
                            </a>
                        </div>
                        <div class="bottomOfPage white halfWidth hPadding-5 fullWidthMd">                            
                            <small>
                                <a href="/" :class="{'tenantOnDemand': tenantOnDemand == 1}">Home</a>
                                <span class="right">&copy; Copyright 2023. WhiteCoatDomain</span>
                            </small>
                        </div>
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
            :bio="bio"
            :tenantID="tenantId"
            :email="email"
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
                suggestionLoaded: false,
                medText: 'Medical',
                cvMedSchoolUpdate: 0,
                underGradUpdate: 0,
                additionalSchoolUpdate: 0,
                internUpdate: 0,
                residencyUpdate: 0,
                fellowshipUpdate: 0,
                setDomain: false,
                showCropper: false,
                view: 0,
                bio: {
                    firstname: "",
                    lastname: "",
                    othername: "Othername",
                    title_id: "",
                    photo: null,
                },
                countdown: 10,
                domainCheckPassed: null,
                domainSuggestions: [],
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
                maxSelected: ''
            };
        },
        mounted() {
            this.getTenantNDomain();
            this.getData();
            this.getInterests();
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
            serviceSaveOrUpdate() {
                this.loading = !this.loading;
                let request = `/claim/save/service`;
                let formData = new FormData()
                // if (this.updateActive === 1) {
                //     request = `/claim/service/1`;
                //     formData.append('_method', 'PUT');
                //     this.removed.length > 0 ? formData.append('removed', JSON.stringify(this.removed)) : null;
                // }
                formData.append('data', JSON.stringify(this.selectedInterests));
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
                                    if (this.selectedInterests.hasOwnProperty(key)) {
                                        console.log(`${key}: ${this.selectedInterests[key]}`);
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
                }
                else {
                    // Get a class to make those pills grey
                    this.maxSelected = 'You can select max. of 3'
                }
            },
            removeFromSelected(interest, index) {
                this.selectedInterests.splice(this.selectedInterests.indexOf(interest), 1);
                this.selectedIndex.splice(this.selectedIndex.indexOf(index), 1);
                console.log(this.selectedInterests, this.selectedIndex);
            },
            getInterests() {
                axios.get(`http://whitecoatdomain.com/api/interests`).then(res => {
                    this.interests = res.data.interests;
                }).catch(err => {
                    console.log(err);
                });
            },
            checkTenantOnDemand() {
                if (this.tenantOnDemand == 1 && this.bio.photo == undefined) {
                    let title = this.bio.title_id != '' ? this.titles.find(el => el.id == this.bio.title_id).name : '';
                    let firstname = this.bio.firstname != '' ? this.bio.firstname : '';
                    let lastname = this.bio.lastname != '' ? this.bio.lastname : '';
                    this.domainSelected = ('Dr'+firstname.substring(0, 1)+lastname+title+'.com').toLocaleLowerCase();
                }
            },
            saveAll (){
                this.underGrad.minor === ''|| this.underGrad.minor === null ? delete this.underGrad.minor : null;
                this.bio.othername === '' || this.bio.othername === null ? delete this.bio.othername : null;
                this.bioData.othername === '' || this.bioData.othername === null ? delete this.bioData.othername : null;
                
                if (this.validator(this.additionalSchool) && this.validator(this.fellowship) && this.validator(this.residency) && this.validator(this.internship) && this.validator(this.medSchool) && this.validator(this.underGrad) && this.validator(this.bio) && this.domainSelected !== ''){ // && this.validator(this.domainSelected))
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
                    } catch (error) {
                        M.toast({
                            html: error,
                            classes: 'errorNotifier'
                        })
                    } finally {
                        M.toast({
                            html: 'Success',
                            classes: 'successNotifier'
                        });
                        this.view = 2;
                    }
                }
                else {
                    this.validationException();
                }
            },
            switchText(val) {
                let valText;
                this.removeLabel(val)
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
                            ? ((this.internship.institution = internship.institution),(this.internship.monthStart = internship.monthStart), (this.internship.yearStart = internship.yearStart), (this.internship.monthEnd = internship.monthEnd), (this.internship.yearEnd = internship.yearEnd),
                              (this.internUpdate = 1),
                              (this.internship.yearStart = new Date(`${internship.yearStart}`)), (this.internship.yearEnd = new Date(`${internship.yearEnd}`)))
                            : null;
                        fellowship !== undefined
                            ? ((this.fellowship.institution = fellowship.institution),(this.fellowship.monthStart = fellowship.monthStart), (this.fellowship.yearStart = fellowship.yearStart), (this.fellowship.monthEnd = fellowship.monthEnd), (this.fellowship.yearEnd = fellowship.yearEnd),
                              (this.fellowshipUpdate = 1), (this.fellowship.yearStart = new Date(`${fellowship.yearStart}`)), (this.fellowship.yearEnd = new Date(`${fellowship.yearEnd}`)))
                            : null;
                        residency !== undefined
                            ? ((this.residency.institution = residency.institution),(this.residency.monthStart = residency.monthStart), (this.residency.yearStart = residency.yearStart), (this.residency.monthEnd = residency.monthEnd), (this.residency.yearEnd = residency.yearEnd),
                              (this.residencyUpdate = 1), (this.residency.yearStart = new Date(`${residency.yearStart}`)), (this.residency.yearEnd = new Date(`${residency.yearEnd}`)))
                            : null;
                            this.switchText();
                        res.data.services.length > 0 ? this.services = res.data.services : [];
                    })
                    .catch((error) => {
                        console.log(error);
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
            checkDomainAvailability(el) {
                this.domainCheckPassed = null;
                this.removeLabel(el);
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
                                this.view = 1;
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
            getStarted() {
                this.view = 1;
            },
            getTenantNDomain() {
                axios
                    .get("/claim/getTenantDomain")
                    .then((res) => {
                        if (res.data.status == 200) {
                            this.domainSelected = this.bio.firstname == '' && this.tenantOnDemand == 1 ? '' : `${res.data.domain}.com`;
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
                if (this.bio.title_id === null || this.bio.title_id == '') {
                    M.toast({
                        html: 'Please select a title',
                        classes: 'errorNotifier'
                    })
                }else  {
                    let title = this.titles.filter((el) => el.id == this.bio.title_id);
                    this.suggestionLoaded = true;
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
                                this.suggestionLoaded = true;
                            }
                        })
                        .catch((err) => {
                            console.log(err);
                        });
                }
            },
            parseClaimaintData(dataToParse) {
                let data = JSON.parse(dataToParse);
                this.bioData = data.length === undefined ? data : data[0];
                this.bio.firstname = this.bioData.firstname;
                this.bio.lastname = this.bioData.lastname;
                this.bio.othername = this.bioData.othername;
                this.bio.title_id = this.bioData.title_id === null ? "" : this.bioData.title_id;
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
                        axios.post("/claim/save/additonalqualification", this.additionalSchool)
                            .then((res) => {
                                if (res.data.status == 201) {
                                    this.additionalSchool.id = res.data.id;
                                    return true;
                                }
                            })
                            .catch((err) => {
                                console.log(err);
                            });
                    }
                    else {
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
                        this.internship.type = 'internship';
                    axios
                        .post("/claim/saveinternship", this.internship)
                        .then((res) => {
                            if (res.data.status == 201) {
                                this.internship.yearStart = new Date(`${this.internship.yearStart}`);
                                this.internship.yearEnd = new Date(`${this.internship.yearEnd}`);
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
                                this.fellowship.yearStart = new Date(`${this.fellowship.yearStart}`);
                                this.fellowship.yearEnd = new Date(`${this.fellowship.yearEnd}`);
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
                        this.residency.type = 'residency';
                    axios
                        .post("/claim/saveresidency", this.residency)
                        .then((res) => {
                            if (res.data.status == 201) {
                                this.residency.yearStart = new Date(`${this.residency.yearStart}`);
                                this.residency.yearEnd = new Date(`${this.residency.yearEnd}`);
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
            updateDomain() {
                if (this.initialDomain+'.com' !== this.domainSelected) {
                    axios
                        .put(`/claim/updateDomain/tenant`, {
                            domain: this.domainSelected,
                        })
                        .then((res) => {
                            if (res.data.status == 200) {
                                this.initialDomain = res.data.domain.domain;
                                this.setDomain = false;
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
                this.bio.id === undefined ? null : formData.append("id", this.bioData.id);
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
                            this.bio.id = res.data.bio.id;
                            this.uploadPhotoProcessing = false;
                            this.showCropper = false;
                            this.uploaded = e;
                            this.bio.photo = {};
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
                    this.loopInputsNCheckEmptyValues('additionalSchool');
                    this.getOffset('additionalSchool')
                }
                if (!this.validator(this.fellowship)) {
                    this.loopInputsNCheckEmptyValues('fellowship');
                    this.getOffset('fellowship');
                }
                if (!this.validator(this.residency)) {
                    this.loopInputsNCheckEmptyValues('residency');
                    this.getOffset('residency');
                }
                if (!this.validator(this.internship)) {
                    this.loopInputsNCheckEmptyValues('internship');
                    this.getOffset('internship');
                }
                if (!this.validator(this.medSchool)) {
                    this.loopInputsNCheckEmptyValues('medSchool');
                    this.getOffset('medSchool');
                }
                if (!this.validator(this.underGrad)) {
                    this.loopInputsNCheckEmptyValues('underGrad');
                    this.getOffset('underGrad');
                }
                if (!this.validator(this.bio)) {
                    this.loopInputsNCheckEmptyValues('bio');
                    this.getOffset('bio');
                }
                if (this.domainSelected === '') {
                    this.loopInputsNCheckEmptyValues('domain');
                    this.getOffset('domain');
                }
                
            },
            createLabel(input) {
                const newElement = document.createElement("label");
                newElement.style.color = 'indianred';
                newElement.style.fontSize = '0.75rem'
                newElement.textContent = "Required";
                input.style.margin = 0;
                input.style.borderBottomColor = 'indianred';
                input.insertAdjacentElement("afterend", newElement);
                input.classList.add('bb-danger', 'required', 'm-0');
            },
            removeLabel(el, num = 0) {
                const timestamp = Date.parse(el);
                if (el === null || !isNaN(timestamp)) {
                    let mxInput = document.querySelectorAll('.mx-input')[num];
                    if (mxInput.nextElementSibling !== null && mxInput.nextElementSibling.tagName === 'LABEL') {
                        mxInput.nextElementSibling.remove();
                    } 
                    if (mxInput.style.borderBottomColor !== "") {
                        mxInput.style.borderBottomColor = "";
                    }
                } else {
                    if (el.target.classList.contains('bb-danger', 'required')){
                        el.target.classList.remove('bb-danger', 'required');
                    }
                    if (el.target.nextSibling !== null) {
                        if (el.target.nextSibling.classList.contains('dangerTxt')) {
                            el.target.nextSibling.classList.remove('dangerTxt');
                        }
                        if (el.target.hasAttribute('data-no-label')) {
                            if (el.target.nextSibling.tagName === 'LABEL') {
                                el.target.nextSibling.remove();
                            }
                        }
                    }
                    if (el.target.style.hasOwnProperty('border-bottom-color')) {
                        el.target.style.removeProperty("border-bottom-color");
                    }
                    if (el.type === 'change') {
                        if (el.target.nextSibling !== null && !el.target.hasAttribute('data-label')) {
                            el.target.nextSibling.remove();
                        }
                        if (el.target.nextSibling !== null && el.target.hasAttribute('data-label')) {
                            el.target.nextSibling.classList.remove('dangerTxt');
                        }
                        if (el.target.style) {
                            el.target.style.removeProperty("border-bottom-color");
                        }
                    }
                }
            },
            loopInputsNCheckEmptyValues(id) {
                let mySection = document.querySelector(`#${id}`);
                    let inputSelect = mySection.querySelectorAll("input, select");
                    inputSelect.forEach(input => {
                        if (!input.value) {
                            if (input.nextSibling !== null) {
                                if (input.nextSibling.localName == 'label' && !input.hasAttribute('data-optional')) {
                                    input.nextSibling.classList.add('dangerTxt');
                                    input.classList.add('bb-danger', 'required');
                                }else if(input.nextSibling.localName != 'label') {
                                    this.createLabel(input);
                                }
                            }
                            else {
                                this.createLabel(input);
                            }
                        }
                        else if (this.bio.photo === undefined) {
                            document.getElementById('brandImage').getElementsByClassName('sectionTitle')[0].style.color = 'red';
                        }
                        else {
                            console.log(input.value);
                        }
                    });
            },
            getOffset(el) {
                let DOMEL = document.querySelector(`#${el}`);
                let container = document.querySelectorAll('.contentDiv');
                const rect = DOMEL.getBoundingClientRect();
                container[0].scrollTop += rect.top;
            }

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
        },
    };
</script>
<style scoped>

    .pills:visited, .pills:focus {
        background: red;
    }
    .removeInterest:hover {
        cursor: pointer;
        background-color: rgb(16, 15, 58);
    }
    .pills {
        background-color: var(--white);
        box-shadow: 2px 2px 4px #b7b7b7;
        border-radius: 4vh;
        padding: 1vh 0vw;
        text-align: center;
        margin: 0.8vh 0.75vw;
        color: var(--sec);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .pills > p {
        margin: 0;
    }
    .pills:hover, .selected {
        background: var(--sec);
        color: var(--white);

    }
    .grid {
        display: grid;
        grid-template-columns: auto auto auto;
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

        .paymentOverlay {
            height: 88vh;
        }
    }
    .saveAllBtn {
        background-color: var(--pri) !important;
    }
    .justify-center {
        justify-content: center !important;
    }
    .holds-the-iframe {
        background: url('data:image/svg+xml;charset=utf-8,<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 100% 100%"><text fill="%23FF0000" x="50%" y="50%" font-family="\'Lucida Grande\', sans-serif" font-size="24" text-anchor="middle">PLACEHOLDER</text></svg>') 0px 0px no-repeat;
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

    .input-field>label, label {
        font-size: .75rem !important;
    }
    input.mx-input {
        margin: 0px !important;
    }
</style>
