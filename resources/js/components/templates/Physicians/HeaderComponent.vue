<template>
    <!--Large device-->
    <!--div class="custom-navbar-fixed">
        <nav  v-bind:class="scrollPosition >= 5 ? 'altNav' : 'navbar'" class='hide-on-med-and-down'>
            <div class="nav-wrapper navbarWrap">
                <a href="/" class="brand-logo" id="physiPortPageLogo"
                >{{user == '' ? 'Dr John Doe' : user}}</a
                >
                <ul
                    id="nav-mobile"
                    class="section table-of-contents right hide-on-med-and-down"
                >
                    <li>
                        <a href="#about" class="physiTempNavLinks">About Me</a>
                    </li>
                    <li v-if="(services !== null && services.length !== 0 && preview === '0') || preview === '1'">
                        <a href="#services" class="physiTempNavLinks">Services</a>
                    </li>
                    <li v-if="(achievement !== null && preview === '0') || preview === '1'">
                        <a href="#experience" class="physiTempNavLinks"
                        >Experience</a>
                    </li>
                    <li v-if="(feeds !== null && feeds !== '' && preview === '0') || preview === '1'"><a href="#feeds" class="physiTempNavLinks">Feeds</a></li>
                    
                    <li>
                        <a href="#contact" class="physiTempContactBtn"
                        >Contact Me</a
                        >
                    </li>
                    <li v-if="isLoggedIn">
                        <a class='sidenav-trigger physiTempSettingsNavLink' href='#!' data-target="slide-out">
                            <i class="material-icons physiTempSettingsIcon">settings</i>
                        </a>
                    </li>
                </ul>
                <ul id="slide-out" class="sidenav">
                    <li>
                        <a href="/general" class="dropSetLink">General</a>
                    </li>
                    <li class="divider" tabindex="-1"></li>
                    <li>
                        <a href="/biography" class="dropSetLink">Bio</a>
                    </li>
                    <li class="divider" tabindex="-1"></li>
                    <li>
                        <a href="/milestones" class="dropSetLink">Milestones</a>
                    </li>
                    <li class="divider" tabindex="-1"></li>
                    <li>
                        <a href="/public_feature" class="dropSetLink">Public Features</a>
                    </li>
                    <li class="divider" tabindex="-1"></li>
                    <li>
                        <a href="/services_rendered" class="dropSetLink">Services</a>
                    </li>
                    <li class="divider" tabindex="-1"></li>
                    <li>
                        <a href="/socialmedia_presence" class="dropSetLink">Social Media</a>
                    </li>
                    <li class="divider" tabindex="-1"></li>
                    <li>
                        <a href="/cv_generator" class="dropSetLink">CV Generator</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div-->
    <div class="">
        <nav>
            <div class="nav-wrapper">
                <div class="container">
                    <a href="#!" class="brand-logo">{{user == '' ? 'Dr Olivia Felix' : user}}</a>
                    <a href="#" data-target="mobileNav" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                    <ul class="centerNav hide-on-med-and-down">
                        <li><a href="#!">Interests</a></li>
                        <li><a href="#miniBlog">Mini Blog</a></li>
                        <li><a href="#!">Feeds</a></li>
                        <li><a href="#!">Testimonials</a></li>                        
                    </ul>

                    <ul class="right hide-on-med-and-down">
                        <li><a href="#!">Contact</a></li>
                        <li><a href="#!" class="waves-effect waves-light btn subscribeBtn">Subscribe</a></li>
                        <li v-if="isLoggedIn">
                            <a class='modal-trigger physiTempSettingsNavLink' href='#showSettingsModal'>
                                <i class="material-icons physiTempSettingsIcon">settings</i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <ul class="sidenav" id="mobileNav">
            <li><a href="#!" class="brand-logo">{{user == '' ? 'Dr Olivia Felix' : user}}</a></li>
            <li><a href="#!">Interests</a></li>
            <li><a href="#miniBlog">Mini Blog</a></li>
            <li><a href="#!">Feeds</a></li>
            <li><a href="#!">Testimonials</a></li>  
            <li><a href="#!">Contact</a></li>
            <li><a href="#!" class="waves-effect waves-light btn subscribeBtn">Subscribe</a></li>
        </ul>
    </div>
    <!--Small devices-->
    <!--div class="navbar-fixw hide-on-large-only">
        <nav class="white navMain" id="sideNav">
            <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons black-text sideNavIcon"
                                                                           id="sideNavIcon">menu</i></a>

            <a href="#" class="" id="physiPortPageLogo">{{user == '' ? 'Dr John Doe' : user}}</a>

            <ul id="slide-out" class="sidenav">
                <li>
                    <a href="#" class="physiSidenavTempName">LIVELY PURPLE</a>
                </li>
                <li>
                    <div class="divider"></div>
                </li>
                <li class="sideNavLinkMgTp">
                    <a href="#about" class="physiTempNavLinks">About Me</a>
                </li>
                <li class="sideNavLinkMgTp">
                    <a href="#services" class="physiTempNavLinks">Services</a>
                </li>
                <li>
                    <a href="#experience" class="physiTempNavLinks">Experience</a>
                </li>
                <li><a href="#feeds" class="physiTempNavLinks">Feeds</a></li>
                <li>
                    <a href="#testimonials" class="physiTempNavLinks">Testimonials</a>
                </li>
                <li>
                    <a href="#contact" class="physiTempContactBtn">Contact Me</a>
                </li>
            </ul>
        </nav>

        <div class="navbar-fixed">
            <nav class="headerNoSideNav center-align">
                <a href="#" data-target="slide" class="sidenav-trigger sidenavTriggerLink" v-if="isLoggedIn">
                    <i class="material-icons sidenavTriggerIcon">settings</i>
                </a>
                <a href="/" class="sideNavBrandLogo">
                    {{user == '' ? 'Dr Chidinma Felix' : user}}
                </a>
                <ul class="extHeaderNoSideNav">
                    <li>
                        <a href="#about" class="mobileNavLink">About</a>
                    </li>
                    <li>
                        <a href="#services" class="mobileNavLink">Services</a>
                    </li>
                    <li v-if="(achievement !== null && preview === '0') || preview === '1'">
                            <a href="#experience">Experience</a>
                    </li>
                    <li v-if="(feeds !== null && feeds !== '' && preview === '0') || preview === '1'">
                        <a href="#feeds">Feeds</a>
                    </li>
                    <li>
                        <a href="#contact" class="mobileNavLink">Contact</a>
                    </li>
                </ul>
            </nav>
        </div>
        <ul id="slide" class="sidenav">
            <li>
                <a href="#!" class="sidenav-close sidenavCloseBtn">
                    <i class="material-icons sidenavCloseIcon white-text">cancel</i>
                </a>
            </li>

            <li><a href="/general" class="sidenavLink">General</a></li>
            <li><div class="divider"></div></li>
            <li><a href="/biography" class="sidenavLink">Bio</a></li>
            <li><div class="divider"></div></li>
            <li><a href="/milestones" class="sidenavLink">Milestones</a></li>
            <li><div class="divider"></div></li>
            <li><a href="/public_feature" class="sidenavLink">Public Features</a></li>
            <li><div class="divider"></div></li>
            <li><a href="#!" class="sidenavLink">Services</a></li>
            <li><div class="divider"></div></li>
            <li><a href="socialmedia_presence" class="sidenavLink">Social Media</a></li>
            <li><div class="divider"></div></li>
            <li><a href="/cv_generator" class="sidenavLink">CV Generator</a></li>
            <li><div class="divider"></div></li>
        </ul>

    </div-->

    <!-- Modal Structure -->
    <div id="showSettingsModal" class="modal">
        <div class="modal-content">
            <div v-if="modalView == 0" class="settingModalViewInitial">
                <div class="row">
                    <div class="col l12">
                        <h3>Settings</h3>
                        <p class="marginTop-1">Update your website by selecting any of the links below</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col l12">
                        <button class="btn closeSettingModal right modal-close">Close settings</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col l4">
                        <div class="generalSettings settingOptions hoverable"  @click="showSettingOption(1, 'General')">
                            <h6>General</h6>
                            <img :src="'/media/img/templates/1/general.png'" alt="" class=""/>
                        </div>
                    </div>
                    <div class="col l4">
                        <div class="generalSettings settingOptions hoverable" @click="showSettingOption(2, 'Mini Blog')">
                            <h6>Mini Blog</h6>
                            <img :src="'/media/img/templates/1/miniBlog.png'" alt="" class=""/>
                        </div>
                    </div>
                    <div class="col l4">
                        <div class="generalSettings settingOptions hoverable" @click="showSettingOption(3, 'Interests')">
                            <h6>Interests</h6>
                            <img :src="'/media/img/templates/1/interests.png'" alt="" class=""/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col l4">
                        <div class="generalSettings settingOptions hoverable" @click="showSettingOption(4, 'Feeds')">
                            <h6>Feeds</h6>
                            <img :src="'/media/img/templates/1/feeds.png'" alt="" class=""/>
                        </div>
                    </div>
                    <div class="col l4">
                        <div class="generalSettings settingOptions hoverable" @click="showSettingOption(5, 'Public Features')">
                            <h6>Features</h6>
                            <img :src="'/media/img/templates/1/publicFeatures.png'" alt="" class=""/>
                        </div>
                    </div>
                    <div class="col l4">
                        <div class="generalSettings settingOptions hoverable">
                            <h6>CV</h6>
                            <img :src="'/media/img/templates/1/cv.png'" alt="" class=""/>
                        </div>
                    </div>
                </div>
            </div>

            <div v-show="modalView == 1">
                <div class="row noMarginBottom">
                    <div class="col l6 optionSettingBackground" @click="modalView = 0">
                        <p>
                            <a class="btn-flat"><i class="material-icons left">chevron_left</i>Back</a>
                        </p>
                        <h5>
                            {{modalTitle}}
                        </h5>
                    </div>
                    <div class="col l6 optionSettingContainer">
                        <div class="row hPadding-1">
                            <h4 class="settingOptionSectionTitle col l12 noMarginBottom">Basic</h4>
                            <div class="formInnerDiv">
                                <div class="input-field selectInputField col l12 m12 s12 paddingLeftSM">
                                    <select
                                        required
                                        class="browser-default"
                                        id="userTitle"
                                        data-label="true"
                                    >
                                        <option
                                            :value="''"
                                            disabled
                                            selected
                                        >
                                            Pick Title
                                        </option>
                                        <!--option
                                            v-for="title in titles"
                                            :key="title.id"
                                            :value="title.id"
                                        >
                                            {{ title.name }}
                                        </option-->
                                    </select>
                                    <label>Title</label>
                                </div>

                                <div class="input-field col l12">
                                    <input
                                        type="text"
                                        class="validate formInput"
                                        required
                                        placeholder="Firstname"
                                    />
                                    <label>Firstname</label>
                                </div>
                                <div class="input-field col l12 m12 s12">
                                    <input
                                        type="text"
                                        class="validate"
                                        placeholder="Lastname"
                                    />
                                    <label>Lastname</label>
                                </div>
                                <div class="input-field col l12 m12 s12">
                                    <input
                                        type="text"
                                        class="validate"
                                        placeholder="Othernames"
                                        data-optional="true"
                                    />
                                    <label>Othername</label>
                                </div>
                            </div>
                        </div>
                        <div class="row hPadding-1">
                            <h4 class="settingOptionSectionTitle col l12 noMarginBottom">Website Title</h4>
                            <div class="input-field col l12">
                                <input placeholder="Dr. Olivia Felix" id="websiteTitle" type="text" class="validate formInput">
                                <label for="websiteTitle">Website title</label>
                            </div>
                        </div>

                        <!--TODO: Image cropper doesnt work-->
                        <div class="row hPadding-1">
                            <h4 class="settingOptionSectionTitle col l12 noMarginBottom">Site logo (favicon)</h4>
                            <div v-show="showCropper" class="cFlex flexRight">
                                <a class="right" href="#" @click="showCropper = false">
                                    <i class="material-icons priText">clear</i>
                                </a>
                            </div>

                            <div class="settingImgContainer" v-if="!showCropper">
                                <!--img
                                    :src="
                                        typeof bio.photo === 'string'
                                            ? '/media/tenants/' +
                                            tenantId +
                                            '/img/' +
                                            bioData.photo
                                            : uploaded
                                    "
                                    :alt="bioData.firstname + ' avatar'"
                                    class="settingImg"
                                    v-if="
                                        bioData.photo !== null ||
                                        uploaded !== null
                                    "
                                /-->
                                <img
                                    class="settingImg"
                                    src="/media/img/templates/1/favPlaceholder.png"
                                />
                            </div>
                            <form enctype="multipart/form-data">
                                <div class="settingImgBtnMainDiv">
                                    <div class="settingImgBtnContainDiv justify-center">
                                        <div class="" id="genUploadFavIconDiv">
                                            <div class="" v-if="!uploadPhotoProcessing">
                                                <div class="col l12 center-align marginTop-5">
                                                    <button
                                                        href="#"
                                                        role="button"
                                                        @click.prevent="
                                                            showFileChooser
                                                        "
                                                        v-if="!showCropper"
                                                        class="btn btn-flat"
                                                    >
                                                        <!--span
                                                            v-if="
                                                                bioData.photo !==
                                                                    null ||
                                                                uploaded !== null
                                                            "
                                                            >
                                                                <i class="material-icons white-text">edit</i>
                                                            </span-->
                                                            <i class="material-icons">file_upload</i>
                                                    </button>
                                                </div>
                                                <div class="row">
                                                    <div class="col s12">
                                                        <image-cropper
                                                            v-if="showCropper"
                                                            :height="50"
                                                            :width="50"
                                                            :img="'/media/img/templates/1/favPlaceholder.png'"
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
                                    <!--div
                                        class="proImgInstructDiv"
                                        v-show="!showCropper"
                                    >
                                        <p class="proImgInstruct">
                                            The image should be greater than
                                            451px width and 512px height
                                        </p>
                                    </div-->
                                </div>
                            </form>
                        </div>

                        <!--TODO: Image cropper doesnt work-->
                        <div class="row hPadding-1">
                            <h4 class="settingOptionSectionTitle col l12 noMarginBottom">Profile Picture</h4>
                            <div v-show="showCropper" class="cFlex flexRight">
                                <a class="right" href="#" @click="showCropper = false">
                                    <i class="material-icons priText">clear</i>
                                </a>
                            </div>

                            <div class="settingImgContainer" v-if="!showCropper">
                                <!--img
                                    :src="
                                        typeof bio.photo === 'string'
                                            ? '/media/tenants/' +
                                            tenantId +
                                            '/img/' +
                                            bioData.photo
                                            : uploaded
                                    "
                                    :alt="bioData.firstname + ' avatar'"
                                    class="settingImg"
                                    v-if="
                                        bioData.photo !== null ||
                                        uploaded !== null
                                    "
                                /-->
                                <img
                                    class="settingImg"
                                    src="/media/img/templates/1/physicianHero.png"
                                />
                            </div>
                            <form enctype="multipart/form-data">
                                <div class="settingImgBtnMainDiv">
                                    <div class="settingImgBtnContainDiv justify-center">
                                        <div class="" id="genUploadFavIconDiv">
                                            <div class="" v-if="!uploadPhotoProcessing">
                                                <div class="col l12 center-align marginTop-5">
                                                    <button
                                                        href="#"
                                                        role="button"
                                                        @click.prevent="
                                                            showFileChooser
                                                        "
                                                        v-if="!showCropper"
                                                        class="btn btn-flat"
                                                    >
                                                        <!--span
                                                            v-if="
                                                                bioData.photo !==
                                                                    null ||
                                                                uploaded !== null
                                                            "
                                                            >
                                                                <i class="material-icons white-text">edit</i>
                                                            </span-->
                                                            <i class="material-icons">file_upload</i>
                                                    </button>
                                                </div>
                                                <div class="row">
                                                    <div class="col s12">
                                                        <image-cropper
                                                            v-if="showCropper"
                                                            :height="50"
                                                            :width="50"
                                                            :img="'/media/img/templates/1/favPlaceholder.png'"
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
                                    <!--div
                                        class="proImgInstructDiv"
                                        v-show="!showCropper"
                                    >
                                        <p class="proImgInstruct">
                                            The image should be greater than
                                            451px width and 512px height
                                        </p>
                                    </div-->
                                </div>
                            </form>
                        </div>

                        <div class="row hPadding-1 center-align">
                            <button class="btn saveSettingBtn" @click="saveAndBack(1)">Save &amp; Back</button>
                        </div>
                    </div>
                </div>
            </div>
            <div v-show="modalView == 2">
                <div class="row noMarginBottom" id="miniBlog">
                    <div class="col l6 optionSettingBackground" @click="modalView = 0">
                        <p>
                            <a class="btn-flat"><i class="material-icons left">chevron_left</i>Back</a>
                        </p>
                        <h5>
                            {{modalTitle}}
                        </h5>
                    </div>
                    <div class="col l6 optionSettingContainer">
                        <div class="row hPadding-1">
                            <h4 class="settingOptionSectionTitle col l12 noMarginBottom">Blog</h4>
                            <div class="formInnerDiv">
                                <div class="input-field col l12">
                                    <input
                                        type="text"
                                        class="validate formInput"
                                        required
                                        placeholder="Title"
                                    />
                                    <label>Title</label>
                                </div>
                                <div class="input-field col l12 m12 s12">
                                    <textarea id="miniBlogDecription" placeholder="Content" class="materialize-textarea" data-length="300"></textarea>
                                    <label for="description">Content</label>
                                </div>
                            </div>
                        </div>
                        <!--TODO: Image cropper doesnt work-->
                        <div class="row hPadding-1">
                            <h4 class="settingOptionSectionTitle col l12 noMarginBottom">Image</h4>
                            <div v-show="showCropper" class="cFlex flexRight">
                                <a class="right" href="#" @click="showCropper = false">
                                    <i class="material-icons priText">clear</i>
                                </a>
                            </div>

                            <div class="settingImgContainer" v-if="!showCropper">
                                <img
                                    class="settingImg"
                                    src="/media/img/templates/1/placeholder.png"
                                />
                            </div>
                            <form enctype="multipart/form-data">
                                <div class="settingImgBtnMainDiv">
                                    <div class="settingImgBtnContainDiv justify-center">
                                        <div class="" id="genUploadFavIconDiv">
                                            <div class="" v-if="!uploadPhotoProcessing">
                                                <div class="col l12 center-align marginTop-5">
                                                    <!-- <span>Upload</span> -->
                                                    <button
                                                        href="#"
                                                        role="button"
                                                        @click.prevent="
                                                            showFileChooser
                                                        "
                                                        v-if="!showCropper"
                                                        class="btn btn-flat"
                                                    >
                                                        <!--span
                                                            v-if="
                                                                bioData.photo !==
                                                                    null ||
                                                                uploaded !== null
                                                            "
                                                            >
                                                                <i class="material-icons white-text">edit</i>
                                                            </span-->
                                                            <i class="material-icons">file_upload</i>
                                                    </button>
                                                </div>
                                                <div class="row">
                                                    <div class="col s12">
                                                        <image-cropper
                                                            v-if="showCropper"
                                                            :height="50"
                                                            :width="50"
                                                            :img="'/media/img/templates/1/favPlaceholder.png'"
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
                                    <!--div
                                        class="proImgInstructDiv"
                                        v-show="!showCropper"
                                    >
                                        <p class="proImgInstruct">
                                            The image should be greater than
                                            451px width and 512px height
                                        </p>
                                    </div-->
                                </div>
                            </form>
                        </div>
                        <div class="row hPadding-1 center-align">
                            <button class="btn saveSettingBtn" @click="saveAndBack(1)">Save &amp; Add New</button>
                            <button class="btn saveSettingBtn" @click="saveAndBack(1)">Save &amp; Back</button>
                        </div>
                    </div>
                </div>
            </div>
            <div v-show="modalView == 3">
                <div class="row noMarginBottom" id="interests">
                    <div class="col l6 optionSettingBackground" @click="modalView = 0">
                        <p>
                            <a class="btn-flat"><i class="material-icons left">chevron_left</i>Back</a>
                        </p>
                        <h5>
                            {{modalTitle}}
                        </h5>
                    </div>
                    <div class="col l6 optionSettingContainer">
                        <div class="row hPadding-1">
                            <h4 class="settingOptionSectionTitle col l12 noMarginBottom">Interests</h4>
                            <p class="subHeading">You can only select a max. of 3</p>
                            <div class="formInnerDiv">
                                <div class="row">
                                    <h6 class="settingOptionSectionTitle col l12 noMarginBottom">Medical</h6>
                                </div>
                                <p v-for="(interest, index) in interests" :key="interest">
                                    <label>
                                        <input type="checkbox" v-model="myinterests" :disabled="myinterests.length >= 3 && myinterests.indexOf(index) == -1"/>
                                        <span>{{interest}}</span>
                                    </label>
                                </p>
                            </div>
                            <h6 class="settingOptionSectionTitle col l12 noMarginBottom">Non-Medical</h6>

                            <div class="row hPadding-1 center-align">
                                <p class="underConstruct">Under Construction</p>
                                <button class="btn saveSettingBtn" @click="saveAndBack(1)">Save &amp; Exit</button>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div v-show="modalView == 4">
                <div class="row noMarginBottom" id="feeds">
                    <div class="col l6 optionSettingBackground" @click="modalView = 0">
                        <p>
                            <a class="btn-flat"><i class="material-icons left">chevron_left</i>Back</a>
                        </p>
                        <h5>
                            {{modalTitle}}
                        </h5>
                    </div>
                    <div class="col l6 optionSettingContainer">
                        <div id="facebook">
                            <div class="row hPadding-1">
                                <h4 class="settingOptionSectionTitle col l12 noMarginBottom">Facebook</h4>
                                <div class="formInnerDiv">
                                    <div class="input-field col l12">
                                        <input
                                            type="text"
                                            class="validate formInput"
                                            required
                                            placeholder="Facebook ID"
                                        />
                                        <label>Facebook ID</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row hPadding-2">
                                <ul class="collapsible">
                                    <li>
                                        <div class="collapsible-header">
                                            <i class="material-icons">smartphone</i>
                                            <span class="contentTitle1">How to get my facebook id via mobile</span>
                                        </div>
                                        <div class="collapsible-body">
                                            <video class="socialMediaHandVidTag" controls>
                                                <source src="/media/videos/get_facebook_pro_page_name.mp4" type="video/mp4">
                                            </video>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="collapsible-header">
                                            <i class="material-icons">laptop_windows</i>
                                            <span class="contentTitle1">How to get my facebook id via desktop</span>
                                        </div>
                                        <div class="collapsible-body">
                                            <video class="socialMediaHandVidTag" controls>
                                                <source src="/media/videos/get_facebook_pro_page_name.mp4" type="video/mp4">
                                            </video>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div id="twitter">
                            <div class="row hPadding-1">
                                <h4 class="settingOptionSectionTitle col l12 noMarginBottom">Twitter</h4>
                                <div class="formInnerDiv">
                                    <div class="input-field col l12">
                                        <input
                                            type="text"
                                            class="validate formInput"
                                            required
                                            placeholder="Twitter ID"
                                        />
                                        <label>Twitter ID</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row hPadding-2">
                                <ul class="collapsible">
                                    <li>
                                        <div class="collapsible-header">
                                            <i class="material-icons">smartphone</i>
                                            <span class="contentTitle1">How to get my Twitter id via mobile</span>
                                        </div>
                                        <div class="collapsible-body">
                                            <video class="socialMediaHandVidTag" controls>
                                                <source src="/media/videos/get_twitter_handle.mp4" type="video/mp4">
                                            </video>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="collapsible-header">
                                            <i class="material-icons">laptop_windows</i>
                                            <span class="contentTitle1">How to get my Twitter id via desktop</span>
                                        </div>
                                        <div class="collapsible-body">
                                            <video class="socialMediaHandVidTag" controls>
                                                <source src="/media/videos/get_twitter_handle.mp4" type="video/mp4">
                                            </video>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div id="instagram">
                            <div class="row hPadding-1">
                                <h4 class="settingOptionSectionTitle col l12 noMarginBottom">Instagram</h4>
                                <div class="formInnerDiv">
                                    <div class="input-field col l12">
                                        <input
                                            type="text"
                                            class="validate formInput"
                                            placeholder="Instagram ID"
                                        />
                                        <label>Instagram ID</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row hPadding-2">
                                <ul class="collapsible">
                                    <li>
                                        <div class="collapsible-header">
                                            <i class="material-icons">smartphone</i>
                                            <span class="contentTitle1">How to get my Instagram id via mobile</span>
                                        </div>
                                        <div class="collapsible-body">
                                            <video class="socialMediaHandVidTag" controls>
                                                <source src="/media/videos/get_instagram_handle.webm" type="video/webm">
                                            </video>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="collapsible-header">
                                            <i class="material-icons">laptop_windows</i>
                                            <span class="contentTitle1">How to get my Instagram id via desktop</span>
                                        </div>
                                        <div class="collapsible-body">
                                            <video class="socialMediaHandVidTag" controls>
                                                <source src="/media/videos/get_instagram_handle.webm" type="video/webm">
                                            </video>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div id="titktok">
                            <div class="row hPadding-1">
                                <h4 class="settingOptionSectionTitle col l12 noMarginBottom">Tiktok</h4>
                                <div class="formInnerDiv">
                                    <div class="input-field col l12">
                                        <input
                                            type="text"
                                            class="validate formInput"
                                            placeholder="Tiktok ID"
                                        />
                                        <label>Tiktok ID</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row hPadding-2">
                                <ul class="collapsible">
                                    <li>
                                        <div class="collapsible-header">
                                            <i class="material-icons">smartphone</i>
                                            <span class="contentTitle1">How to get my Tiktok id via mobile</span>
                                        </div>
                                        <div class="collapsible-body">
                                            <video class="socialMediaHandVidTag" controls>
                                                <source src="/media/videos/get_tiktok_handle.webm" type="video/webm">
                                            </video>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="collapsible-header">
                                            <i class="material-icons">laptop_windows</i>
                                            <span class="contentTitle1">How to get my Tiktok id via desktop</span>
                                        </div>
                                        <div class="collapsible-body">
                                            <video class="socialMediaHandVidTag" controls>
                                                <source src="/media/videos/get_tiktok_handle.webm" type="video/webm">
                                            </video>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="row hPadding-1 center-align">
                            <button class="btn saveSettingBtn" @click="saveAndBack(1)">Save &amp; Back</button>
                        </div>
                    </div>
                </div>
            </div>
            <div v-show="modalView == 5">
                <div class="row noMarginBottom" id="publicFeatures">
                    <div class="col l6 optionSettingBackground" @click="modalView = 0">
                        <p>
                            <a class="btn-flat"><i class="material-icons left">chevron_left</i>Back</a>
                        </p>
                        <h5>
                            {{modalTitle}}
                        </h5>
                    </div>
                    <div class="col l6 optionSettingContainer">
                        <div>
                            <div class="row hPadding-1">
                                <h4 class="settingOptionSectionTitle col l12 noMarginBottom">Your public profile</h4>
                                <div class="formInnerDiv">
                                    <div class="input-field col l12">
                                        <input
                                            type="text"
                                            class="validate formInput"
                                            required
                                            placeholder="CNN Health"
                                        />
                                        <label>Program Title</label>
                                    </div>
                                    <div class="input-field col l12">
                                        <input
                                            type="text"
                                            class="validate formInput"
                                            required
                                            placeholder="CNN, BBC"
                                        />
                                        <label>Program URL <span class="optionalColor">(Optional)</span></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row hPadding-1 center-align">
                            <button class="btn saveSettingBtn" @click="saveAndBack(1)">Save &amp; Add New</button>
                            <button class="btn saveSettingBtn" @click="saveAndBack(1)">Save &amp; Back</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import ImageCropper from "../../partials/ImageCropper.vue";
export default {    
    components: {ImageCropper},
    data() {
        return {
            modalView: 0,
            modalTitle: "General",
            showCropper: false,
            uploadPhotoProcessing: false,
            interests: [
                'Ophthalmologists',
                'Gynecologists',
                'Dermatologists',
                'Allergists',
                'Endocrinologists',
                'Gastroenterologists',
                'Neurologists',
                'Psychiatrists',
            ],
            myinterests: [],
        };
    },
    props: {
        user: String,
        isLoggedIn: Boolean,
        preview: String,
        achievement: Object,
        feeds: String,
        services: Array
    },
    mounted() {
    },
    methods: {
        showSettingOption(num, title){
            this.modalView = num;
            this.modalTitle = title;
            if (this.modalView === 4) {
                var elems = document.querySelectorAll('.collapsible');
                M.Collapsible.init(elems);
                console.log(elems)
            }
            var textNeedCount = document.querySelectorAll('#input_text, #miniBlogDescription');
            M.CharacterCounter.init(textNeedCount);
        },
        showFileChooser() {
            // this.$refs.photo.click();
            this.showCropper = true;
        },
        photoUpload(e) {
                this.updatePhoto(e);
        },
        updatePhoto(e) {
            this.uploadPhotoProcessing = true;
            let formData = new FormData();
            formData.append("photo", e);
            formData.append("_method", "PUT");
            formData.append("id", this.bioData.id);
            console.log(formData)
            // axios
            // .post("/claim/updateAvatar/bio", formData)
            // .then((res) => {
            //     // console.log(res);
            //     if (res.data.status == 200) {
            //         M.toast({
            //             html: res.data.message,
            //             classes: "successNotifier",
            //         });
            //         localStorage.setItem(
            //             "claimproc",
            //             JSON.stringify([res.data.bio])
            //         );
            //         this.bio = res.data.bio;
            //         this.uploadPhotoProcessing = false;
            //         this.showCropper = false;
            //         this.uploaded = e;
            //         this.bio.photo = {};
            //     }
            // })
            // .catch((err) => {
            //     if (err.response.status == 400) {
            //         err.response.data.forEach((el) => {
            //             M.toast({
            //                 html: el,
            //                 classes: "errorNotifier",
            //             });
            //         });
            //     }
            //     if (err.response.status == 413) {
            //         M.toast({
            //             html: err.response.statusText,
            //             classes: "errorNotifier",
            //         });
            //     }
            //     this.uploadPhotoProcessing = false;
            //     console.log(err);
            // });
        },
        saveAndBack(num){
            if(num == 1){//save general data

            } else {

            }

            this.modalView = 0;
        }
    },
    computed: {},
};
</script>
