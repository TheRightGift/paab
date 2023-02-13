<template>
    <div>
        <div class="row">
            <div class="col s12">
                <div class="primaryColorDiv">
                    <div class="headerDiv">
                        <a href="/">
                            <img src="/media/img/setupWeb/wcdMobileLogo.png" alt="wcdMobileLogo.png" class="hide-on-large-only wcdMobileLogo">
                            <img src="/media/img/setupWeb/wcdMobileLogoLarge.png" alt="wcdMobileLogoLarge.png" class="hide-on-med-and-down">
                        </a>
                        <p class="headerTitle">
                            It is time for the world
                            to hear your pulse
                        </p>
                    </div>
                    <div class="hide-on-large-only">
                        <img src="/media/img/setupWeb/3dDoctors.png" alt="3dDoctors.png" class="primaryColorDocsImg">
                    </div>
                    <div class="hide-on-med-and-down">
                        <img src="/media/img/setupWeb/3dDoctorsLarge.png" alt="3dDoctorsLarge.png" class="primaryColorDocsImgLarge">
                    </div>
                </div>
            </div>
            <div class="col s12">
                <div class="contentDiv">
                    <div class="contentInnerDiv">

                        <!-- Get Started Section -->
                        <div v-show="view == 0">
                            <p class="contentTitle">Lets help you setup your website</p>

                            <div class="getStartedBtnDiv">
                                <a href="#" class="waves-effect waves-light btn getStartedBtn" @click="getStarted()">GET STARTED</a>
                            </div>
                        </div>

                        <!-- Confirm your name section -->
                        <div v-show="view == 1">
                            <p class="contentTitle">Is it okay to address you as follows?</p>

                            <form class="mainForm">
                                <div class="row formInnerDiv">
                                    <div class="input-field col s2">
                                        <select>
                                            <option value="1">MD</option>
                                            <option value="2">Dr</option>
                                        </select>
                                    </div>

                                    <div class="input-field col s3">
                                        <input type="text" value="Doe" class="validate">
                                    </div>
                                    <div class="input-field col s3">
                                        <input type="text" value="John" class="validate">
                                    </div>
                                    <div class="input-field col s3">
                                        <input type="text" value="Chigozie" class="validate">
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Domain name check section -->
                        <div v-show="view == 2">
                            <p class="contentTitle">Are you ok with this domain name?</p>

                            <form class="mainForm">
                                <div class="row formInnerDiv">
                                    <div class="input-field col s8">
                                        <input type="text" value="johndoemed.com" class="validate">
                                        <p class="unAvailTxt">
                                            Not satisfied with the suggestions below, type in
                                            your preferred domain name
                                        </p>
                                    </div>
                                    <div class="col s4">
                                        <p class="unAvailTitle">Unavailable</p>
                                    </div>


                                </div>
                            </form>

                            <div class="row">
                                <div class="col s12 domianMainDiv">
                                    <p class="primaryTxt">Suggestions</p>

                                    <div class="col s1">
                                        <p class="domainSelectP">
                                            <label>
                                                <input class="with-gap" name="domainName" type="radio" />
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
                                                <td class="domainTdName">mddoejohn.com</td>
                                                <td class="domainTdState">Available</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="col s12 domianMainDiv">
                                    <div class="col s1">
                                        <p class="domainSelectP">
                                            <label>
                                                <input class="with-gap" name="domainName" type="radio" />
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
                                                <td class="domainTdName">johnmddoe.com</td>
                                                <td class="domainTdState">Available</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="col s12 domianMainDiv">
                                    <div class="col s1">
                                        <p class="domainSelectP">
                                            <label>
                                                <input class="with-gap" name="domainName" type="radio" />
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
                                                <td class="domainTdName">johndoe.com</td>
                                                <td class="domainTdState">Available</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="col s12 domianMainDiv">
                                    <div class="col s1">
                                        <p class="domainSelectP">
                                            <label>
                                                <input class="with-gap" name="domainName" type="radio" />
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
                                                <td class="domainTdName">mdjohn.com</td>
                                                <td class="domainTdState">Available</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Client Img check section -->
                        <div v-show="view == 3">
                            <p class="contentTitle">Are you ok with this picture?</p>

                            <div class="proImgDiv">
                                <img src="/media/img/setupWeb/profilePics.png" alt="profilePics.png" class="proImg">
                            </div>

                            <div class="proImgBtnMainDiv">
                                <div class="proImgBtnContainDiv">
                                    <a href="#" class="proImgYesBtn" @click="yesProImg()">Yes</a>
                                    <form>
                                        <a href="#" class="proImgSelectFile" @click="$refs.file.click()">
                                            No
                                            <i class="material-icons proInputFileUpladIcon">file_upload</i>
                                        </a>
                                        <input type="file" ref="file" class="displayNone" />
                                    </form>
                                </div>
                                <div class="proImgInstructDiv">
                                    <p class="proImgInstruct">The image should be 451px width and 512px height</p>
                                </div>
                            </div>
                        </div>

                        <!-- Acadamic Section -->
                        <div v-show="view == 4">
                            <p class="contentTitle">Which academic path suits you?</p>

                            <div class="acaMainDiv">
                                <p>
                                    <label @click="undergradMedSelected()">
                                        <input class="with-gap" name="acadamic" type="radio" />
                                        <span class="radioBtnSpan">Undergraduate School and Medical School</span>
                                    </label>
                                </p>
                                <p>
                                    <label @click="medSelected()">
                                        <input class="with-gap" name="acadamic" type="radio" />
                                        <span class="radioBtnSpan">Only Medical School</span>
                                    </label>
                                </p>
                            </div>
                        </div>

                        <!-- Undergrad and Med school Acadamic Section -->
                        <div v-show="view == 5">
                            <p class="contentTitle">Tell us about your time in undergraduate school</p>

                            <form class="mainForm">
                                <div class="row formContainDiv">
                                    <div class="input-field col s12">
                                        <input placeholder="What Institution did you attend" type="text" class="validate formInput">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div v-show="view == 6">
                            <p class="contentTitle">Tell us about your time in undergraduate school</p>

                            <form class="mainForm">
                                <div class="row formInnerDiv">
                                    <div class="input-field col s5">
                                        <input placeholder="What major" type="text" class="validate formInput">
                                    </div>
                                    <div class="input-field col s6">
                                        <input placeholder="What minor(optional)" type="text" class="validate formInput">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div v-show="view == 7">
                            <p class="contentTitle">Tell us about your time in undergraduate school</p>

                            <form class="mainForm">
                                <div class="row formInnerDiv">
                                    <div class="col s6">
                                        <p class="schQuesP">When did you start</p>
                                        <div class="row spaceAround">
                                            <div class="col s2">
                                                <p class="schQuesP1">Start</p>
                                            </div>
                                            <div class="input-field col s4 formInput1ColDiv">
                                                <input placeholder="Month" type="text" class="validate formInput1">
                                            </div>
                                            <div class="input-field col s4 formInput1ColDiv">
                                                <input placeholder="Year" type="text" class="validate formInput1">
                                            </div>
                                        </div>
                                    </div>

                                    <div class=" col s5">
                                        <p class="schQuesP">When did you end</p>
                                        <div class="row spaceAround">
                                            <div class="col s2">
                                                <p class="schQuesP1">End</p>
                                            </div>
                                            <div class="input-field col s4 formInput1ColDiv">
                                                <input placeholder="Month" type="text" class="validate formInput1">
                                            </div>
                                            <div class="input-field col s4 formInput1ColDiv">
                                                <input placeholder="Year" type="text" class="validate formInput1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Med school Acadamic Section -->
                        <div v-show="view == 8">
                            <p class="contentTitle">Tell us about your time in medical school</p>

                            <form class="mainForm">
                                <div class="row formContainDiv">
                                    <div class="input-field col s12">
                                        <input placeholder="What Institution did you attend" type="text" class="validate formInput">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div v-show="view == 9">
                            <p class="contentTitle">Tell us about your time in medical school</p>

                            <form class="mainForm">
                                <div class="row formContainDiv">
                                    <div class="input-field col s12">
                                        <input placeholder="What degree" type="text" class="validate formInput">
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div v-show="view == 10">
                            <p class="contentTitle">Tell us about your time in medical school</p>

                            <form class="mainForm">
                                <div class="row formInnerDiv">
                                    <div class="col s6">
                                        <p class="schQuesP">When did you start</p>
                                        <div class="row spaceAround">
                                            <div class="col s2">
                                                <p class="schQuesP1">Start</p>
                                            </div>
                                            <div class="input-field col s4 formInput1ColDiv">
                                                <input placeholder="Month" type="text" class="validate formInput1">
                                            </div>
                                            <div class="input-field col s4 formInput1ColDiv">
                                                <input placeholder="Year" type="text" class="validate formInput1">
                                            </div>
                                        </div>
                                    </div>

                                    <div class=" col s5">
                                        <p class="schQuesP">When did you end</p>
                                        <div class="row spaceAround">
                                            <div class="col s2">
                                                <p class="schQuesP1">End</p>
                                            </div>
                                            <div class="input-field col s4 formInput1ColDiv">
                                                <input placeholder="Month" type="text" class="validate formInput1">
                                            </div>
                                            <div class="input-field col s4 formInput1ColDiv">
                                                <input placeholder="Year" type="text" class="validate formInput1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Internship Section -->
                        <div v-show="view == 11">
                            <p class="contentTitle">Did you attend internship?</p>

                            <div class="radioBtnMainDiv">
                                <p>
                                    <label @click="internSelected()">
                                        <input class="with-gap" name="intern" type="radio" />
                                        <span class="radioBtnSpan">Yes</span>
                                    </label>
                                </p>
                                <p>
                                    <label @click="internNotSelected()">
                                        <input class="with-gap" name="intern" type="radio" />
                                        <span class="radioBtnSpan">No</span>
                                    </label>
                                </p>
                            </div>
                        </div>
                        <div v-show="view == 12">
                            <p class="contentTitle">Tell us about your internship program</p>

                            <form class="mainForm">
                                <div class="row formContainDiv">
                                    <div class="input-field col s12">
                                        <input placeholder="What Institution did you attend" type="text" class="validate formInput">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div v-show="view == 13">
                            <p class="contentTitle">Tell us about your internship program</p>

                            <form class="mainForm">
                                <div class="row formInnerDiv">
                                    <div class="col s6">
                                        <p class="schQuesP">When did you start</p>
                                        <div class="row spaceAround">
                                            <div class="col s2">
                                                <p class="schQuesP1">Start</p>
                                            </div>
                                            <div class="input-field col s4 formInput1ColDiv">
                                                <input placeholder="Month" type="text" class="validate formInput1">
                                            </div>
                                            <div class="input-field col s4 formInput1ColDiv">
                                                <input placeholder="Year" type="text" class="validate formInput1">
                                            </div>
                                        </div>
                                    </div>

                                    <div class=" col s5">
                                        <p class="schQuesP">When did you end</p>
                                        <div class="row spaceAround">
                                            <div class="col s2">
                                                <p class="schQuesP1">End</p>
                                            </div>
                                            <div class="input-field col s4 formInput1ColDiv">
                                                <input placeholder="Month" type="text" class="validate formInput1">
                                            </div>
                                            <div class="input-field col s4 formInput1ColDiv">
                                                <input placeholder="Year" type="text" class="validate formInput1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Fellowship Section -->
                        <div v-show="view == 14">
                            <p class="contentTitle">Did you attended fellowship?</p>

                            <div class="radioBtnMainDiv">
                                <p>
                                    <label @click="fellowSelected()">
                                        <input class="with-gap" name="intern" type="radio" />
                                        <span class="radioBtnSpan">Yes</span>
                                    </label>
                                </p>
                                <p>
                                    <label @click="fellowNotSelected()">
                                        <input class="with-gap" name="intern" type="radio" />
                                        <span class="radioBtnSpan">No</span>
                                    </label>
                                </p>
                            </div>

                        </div>
                        <div v-show="view == 15">
                            <p class="contentTitle">Tell us about your fellowship program</p>

                            <form class="mainForm">
                                <div class="row formContainDiv">
                                    <div class="input-field col s12">
                                        <input placeholder="What Institution did you attend" type="text" class="validate formInput">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div v-show="view == 16">
                            <p class="contentTitle">Tell us about your fellowship program</p>

                            <form class="mainForm">
                                <div class="row formInnerDiv">
                                    <div class="col s6">
                                        <p class="schQuesP">When did you start</p>
                                        <div class="row spaceAround">
                                            <div class="col s2">
                                                <p class="schQuesP1">Start</p>
                                            </div>
                                            <div class="input-field col s4 formInput1ColDiv">
                                                <input placeholder="Month" type="text" class="validate formInput1">
                                            </div>
                                            <div class="input-field col s4 formInput1ColDiv">
                                                <input placeholder="Year" type="text" class="validate formInput1">
                                            </div>
                                        </div>
                                    </div>

                                    <div class=" col s5">
                                        <p class="schQuesP">When did you end</p>
                                        <div class="row spaceAround">
                                            <div class="col s2">
                                                <p class="schQuesP1">End</p>
                                            </div>
                                            <div class="input-field col s4 formInput1ColDiv">
                                                <input placeholder="Month" type="text" class="validate formInput1">
                                            </div>
                                            <div class="input-field col s4 formInput1ColDiv">
                                                <input placeholder="Year" type="text" class="validate formInput1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Residency Section -->
                        <div v-show="view == 17">
                            <p class="contentTitle">Did you attended residency?</p>

                            <div class="radioBtnMainDiv">
                                <p>
                                    <label @click="residencySelected()">
                                        <input class="with-gap" name="intern" type="radio" />
                                        <span class="radioBtnSpan">Yes</span>
                                    </label>
                                </p>
                                <p>
                                    <label @click="residencyNotSelected()">
                                        <input class="with-gap" name="intern" type="radio" />
                                        <span class="radioBtnSpan">No</span>
                                    </label>
                                </p>
                            </div>
                        </div>
                        <div v-show="view == 18">
                            <p class="contentTitle">Tell us about your residency program</p>

                            <form class="mainForm">
                                <div class="row formContainDiv">
                                    <div class="input-field col s12">
                                        <input placeholder="What Institution did you attend" type="text" class="validate formInput">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div v-show="view == 19">
                            <p class="contentTitle">Tell us about your residency program</p>

                            <form class="mainForm">
                                <div class="row formInnerDiv">
                                    <div class="col s6">
                                        <p class="schQuesP">When did you start</p>
                                        <div class="row spaceAround">
                                            <div class="col s2">
                                                <p class="schQuesP1">Start</p>
                                            </div>
                                            <div class="input-field col s4 formInput1ColDiv">
                                                <input placeholder="Month" type="text" class="validate formInput1">
                                            </div>
                                            <div class="input-field col s4 formInput1ColDiv">
                                                <input placeholder="Year" type="text" class="validate formInput1">
                                            </div>
                                        </div>
                                    </div>

                                    <div class=" col s5">
                                        <p class="schQuesP">When did you end</p>
                                        <div class="row spaceAround">
                                            <div class="col s2">
                                                <p class="schQuesP1">End</p>
                                            </div>
                                            <div class="input-field col s4 formInput1ColDiv">
                                                <input placeholder="Month" type="text" class="validate formInput1">
                                            </div>
                                            <div class="input-field col s4 formInput1ColDiv">
                                                <input placeholder="Year" type="text" class="validate formInput1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Experience Section -->
                        <div v-show="view == 20">
                            <p class="contentTitle">Tell us about your experience</p>

                            <form class="mainForm">
                                <div class="row formContainDiv">
                                    <div class="input-field col s12">
                                        <input placeholder="what hospital/medical/institutions" type="text" class="validate formInput">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div v-show="view == 21">
                            <p class="contentTitle">Tell us about your experience</p>
                            <form class="mainForm">
                                <div class="row formContainDiv">
                                    <div class="input-field col s12">
                                        <input placeholder="What is the location" type="text" class="validate formInput">
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div v-show="view == 22">
                            <p class="contentTitle">Tell us about your experience</p>
                            <form class="mainForm">
                                <div class="row formContainDiv">
                                    <div class="input-field col s12">
                                        <input placeholder="What is your position" type="text" class="validate formInput">
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div v-show="view == 23">
                            <p class="contentTitle">Tell us about your experience</p>
                            <form class="mainForm">
                                <div class="row formInnerDiv">
                                    <div class="col s6">
                                        <p class="schQuesP">When did you start</p>
                                        <div class="row spaceAround">
                                            <div class="col s2">
                                                <p class="schQuesP1">Start</p>
                                            </div>
                                            <div class="input-field col s4 formInput1ColDiv">
                                                <input placeholder="Month" type="text" class="validate formInput1">
                                            </div>
                                            <div class="input-field col s4 formInput1ColDiv">
                                                <input placeholder="Year" type="text" class="validate formInput1">
                                            </div>
                                        </div>
                                    </div>

                                    <div class=" col s5">
                                        <p class="schQuesP">When did you end</p>
                                        <div class="row spaceAround">
                                            <div class="col s2">
                                                <p class="schQuesP1">End</p>
                                            </div>
                                            <div class="input-field col s4 formInput1ColDiv">
                                                <input placeholder="Month" type="text" class="validate formInput1">
                                            </div>
                                            <div class="input-field col s4 formInput1ColDiv">
                                                <input placeholder="Year" type="text" class="validate formInput1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div v-show="view == 24">
                            <p class="contentTitle">Do you want to add more experience</p>
                            <div class="radioBtnMainDiv">
                                <p>
                                    <label @click="expSelected()">
                                        <input class="with-gap" name="intern" type="radio" />
                                        <span class="radioBtnSpan">Yes</span>
                                    </label>
                                </p>
                                <p>
                                    <label @click="expNotSelected()">
                                        <input class="with-gap" name="intern" type="radio" />
                                        <span class="radioBtnSpan">No</span>
                                    </label>
                                </p>
                            </div>
                        </div>

                        <!-- Add More Quarifications Section -->
                        <div v-show="view == 25">
                            <p class="contentTitle">Do you have additional academic qualifications</p>

                            <div class="radioBtnMainDiv">
                                <p>
                                    <label @click="addQualSelected()">
                                        <input class="with-gap" name="intern" type="radio" />
                                        <span class="radioBtnSpan">Yes</span>
                                    </label>
                                </p>
                                <p>
                                    <label @click="addQualNotSelected()">
                                        <input class="with-gap" name="intern" type="radio" />
                                        <span class="radioBtnSpan">No</span>
                                    </label>
                                </p>
                            </div>
                        </div>
                        <div v-show="view == 26">
                            <p class="contentTitle">Tell us about your academic qualifications</p>

                            <form class="mainForm">
                                <div class="row formContainDiv">
                                    <div class="input-field col s12">
                                        <input placeholder="What institutions" type="text" class="validate formInput">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div v-show="view == 27">
                            <p class="contentTitle">Tell us about your academic qualifications</p>

                            <form class="mainForm">
                                <div class="row formContainDiv">
                                    <div class="input-field col s12">
                                        <input placeholder="What degree" type="text" class="validate formInput">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div v-show="view == 28">
                            <p class="contentTitle">Tell us about your residency program</p>

                            <form class="mainForm">
                                <div class="row formInnerDiv">
                                    <div class="col s6">
                                        <p class="schQuesP">When did you start</p>
                                        <div class="row spaceAround">
                                            <div class="col s2">
                                                <p class="schQuesP1">Start</p>
                                            </div>
                                            <div class="input-field col s4 formInput1ColDiv">
                                                <input placeholder="Month" type="text" class="validate formInput1">
                                            </div>
                                            <div class="input-field col s4 formInput1ColDiv">
                                                <input placeholder="Year" type="text" class="validate formInput1">
                                            </div>
                                        </div>
                                    </div>

                                    <div class=" col s5">
                                        <p class="schQuesP">When did you end</p>
                                        <div class="row spaceAround">
                                            <div class="col s2">
                                                <p class="schQuesP1">End</p>
                                            </div>
                                            <div class="input-field col s4 formInput1ColDiv">
                                                <input placeholder="Month" type="text" class="validate formInput1">
                                            </div>
                                            <div class="input-field col s4 formInput1ColDiv">
                                                <input placeholder="Year" type="text" class="validate formInput1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div v-show="view == 29">
                            <p class="contentTitle">Do you want to add more additional qualifications</p>

                            <div class="radioBtnMainDiv">
                                <p>
                                    <label @click="addMoreQualSelected()">
                                        <input class="with-gap" name="intern" type="radio" />
                                        <span class="radioBtnSpan">Yes</span>
                                    </label>
                                </p>
                                <p>
                                    <label @click="addMoreQualNotSelected()">
                                        <input class="with-gap" name="intern" type="radio" />
                                        <span class="radioBtnSpan">No</span>
                                    </label>
                                </p>
                            </div>
                        </div>

                        <!-- Service Section -->
                        <div v-show="view == 30">
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
                        <div v-show="view == 31">
                            <p class="contentTitle">Tell us about your services</p>

                            <form class="mainForm">
                                <div class="row formContainDiv">
                                    <div class="input-field col s12">
                                        <input placeholder="Title" type="text" class="validate formInput">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div v-show="view == 32">
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

                        <!-- Publish Section -->
                        <div v-show="view == 33">
                            <p class="contentTitle">
                                <span class="serviceSuccessTxt">Congrats!</span>
                                Curriculum Vitae completed
                            </p>

                            <div class="row serviceBtnRowDiv">
                                <div class="col s5 m4 offset-s1 offset-m2">
                                    <button class="waves-effect waves-light btn goLiveFreeBtn">
                                        Go live <br> Free
                                    </button>

                                    <ul>
                                        <li>Secured website</li>
                                        <li>Custom domain name</li>
                                        <li>Branded email</li>
                                    </ul>
                                </div>
                                <div class="col s5 m4 offset-s1 offset-m1">
                                    <button class="waves-effect waves-light btn goLiveProBtn">
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
                        <div v-if="view > 0" class="skipDiv">
                            <button class="skipBtn"
                                    @click="prev()"
                                    :disabled="view <= 1"
                                    :class="view > 1 ? 'btnOn' : 'btnOff'">
                                <i class="material-icons">keyboard_arrow_left</i>
                            </button>
                            <span class="skipTxt">skip</span>
                            <button class="skipBtn"
                                    @click="next()"
                                    :disabled="view == view.length"
                                    :class="view != 33 ? 'btnOn' : 'btnOff'">
                                <i class="material-icons">keyboard_arrow_right</i>
                            </button>
                        </div>

                    </div>

                    <!-- <InnerFooter /> -->
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import InnerFooter from "./partials/InnerFooterComponent.vue";
export default {
    components: {
        InnerFooter
    },
    data() {
        return {
            view: 0,
            medSchClicked: 0,
        };
    },
    mounted() { },
    methods: {
        prev() {
            this.view != 0 ? this.view-- : null;

            if (this.medSchClicked == 1 && this.view < 8) {
                this.view = 4;
            }
            if (this.medSchClicked == 1 && this.view == 4) {
                this.medSchClicked = 0;
            }
        },
        next() {
            this.view != 33 ? this.view++ : null;
        },
        getStarted() {
            this.view = 1;
        },
        undergradMedSelected() {
            this.view = 5;
            this.medSchClicked = 0;
        },
        medSelected() {
            this.view = 8;
            this.medSchClicked = 1;
        },
        internSelected() {
            this.view = 12;
        },
        internNotSelected() {
            this.view = 14;
        },
        fellowSelected() {
            this.view = 15;
        },
        fellowNotSelected() {
            this.view = 17;
        },
        residencySelected() {
            this.view = 18;
        },
        residencyNotSelected() {
            this.view = 20;
        },
        expSelected() {
            this.view = 21;
        },
        expNotSelected() {
            this.view = 25;
        },
        addQualSelected() {
            this.view = 26;
        },
        addQualNotSelected() {
            this.view = 30;
        },
        addMoreQualSelected() {
            this.view = 26;
        },
        addMoreQualNotSelected() {
            this.view = 30;
        },
        servicesSelected() {
            this.view = 31;
        },
        servicesNotSelected() {
            this.view = 33;
        },
        addMoreServicesSelected() {
            this.view = 31;
        },
        addMoreServicesNotSelected() {
            this.view = 33;
        },
        yesProImg() {
            this.view = 4;
        }
    },
};
</script>
<style>
.flex {
    display: flex;
}
.btnOn {
    border: 2px solid var(--primary);
    color: var(--primary);
}
.btnOff {
    border: 2px solid #D9D9D9;
    color: #D9D9D9;
}
.displayNone {
    display: none;
}
</style>
