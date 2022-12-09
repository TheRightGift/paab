<template>
    <div>
        <!-- Edit Website General -->
        <div class="editWebModalDiv">
            <!-- Edit Website Modal Header -->
            <div class="editWebNav">
                <div class="editInnerWebNav">
                    <ul id="editWebUl">
                        <li class="editWebLi">
                            <a href="#" class="editWebLink" id="genBtn" @click="genBtn()">General</a>
                        </li>
                        <li class="editWebLi">
                            <a href="#" class="editWebLink" id="logoBtn" @click="logoBtn()">Logo</a>
                        </li>
                        <li class="editWebLi">
                            <a href="#" class="editWebLink" id="bioBtn" @click="bioBtn()">Bio</a>
                        </li>
                        <li class="editWebLi">
                            <a href="#" class="editWebLink" id="contactBtn" @click="contactBtn()">Contact</a>
                        </li>
                        <li class="editWebLi">
                            <a href="#" class="editWebLink" id="socialsBtn" @click="socialsBtn()">Socials</a>
                        </li>
                        <li class="editWebLi">
                            <a href="#" class="editWebLink" id="reviewBtn" @click="reviewBtn()">Reviews</a>
                        </li>
                        <li>
                            <a href="#" class="editWebModalExitBtn" id="modalExitBtn" @click="modalExitBtn()">Exit</a>
                        </li>
                    </ul>
                </div>
                
            </div>

            <!-- General Modal -->
            <div class="editWebModal" v-if="!genModal">
                <div class="editInnerWebModal">
                    <form>
                        <div class="row">
                            <div class="col s12">
                                <p class="editWebGenTitle">Title</p>
                                <input type="text" placeholder="Title" class="validate" id="editWebGenModelInput">
                            </div>
                        
                            <div class="col s12">
                                <p class="editWebGenTitle">Title</p>
                                <input type="text" placeholder="Title" class="validate" id="editWebGenModelInput">
                            </div>
                        
                            <div class="col s12">
                                <p class="editWebGenTitle">Title</p>
                                <input type="text" placeholder="Title" class="validate" id="editWebGenModelInput">
                            </div>
                        
                            <div class="col s12">
                                <p class="editWebGenTitle">Title</p>
                                <input type="text" placeholder="Title" class="validate" id="editWebGenModelInput">
                            </div>
                        
                            <div class="col s12">
                                <p class="editWebGenTitle">Title</p>
                                <input type="text" placeholder="Title" class="validate" id="editWebGenModelInput">
                            </div>
                        
                            <button type="button" class="col s12 btn" id="editWebGenBtn">save</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Logo Modal -->
            <div class="logoContainDiv" v-if="!logoModal">
                <div class="row logoRowDiv">
                    <div class="col s3">
                        <p class="logoImgTxt">Favicon (32x32)</p>
                        <div class="logImgDiv"></div>
                    </div>

                    <div class="col s4 offset-s5 logoUpDiv">
                        <i class="material-icons" id="logoModalUpIcon">cloud_upload</i>
                        <a href="#" class="logoModalUpLink">Upload</a>
                    </div>
                </div>

                <hr class="logoHr">

                <div class="row logoRowDiv">
                    <div class="col s3">
                        <p class="logoImgTxt">Favicon (32x32)</p>
                        <div class="logImgDiv"></div>
                    </div>
                
                    <div class="col s4 offset-s5 logoUpDiv">
                        <i class="material-icons" id="logoModalUpIcon">cloud_upload</i>
                        <a href="#" class="logoModalUpLink">Upload</a>
                    </div>
                </div>
                
                <hr class="logoHr">

                <div class="row logoRowDiv">
                    <div class="col s3">
                        <p class="logoImgTxt">Favicon (32x32)</p>
                        <div class="logImgDiv"></div>
                    </div>
                
                    <div class="col s4 offset-s5 logoUpDiv">
                        <i class="material-icons" id="logoModalUpIcon">cloud_upload</i>
                        <a href="#" class="logoModalUpLink">Upload</a>
                    </div>
                </div>
                <div class="flexed">
                    <button type="button" class="col s12 btn" id="logModalBtn">save</button>
                </div>
            </div>

            <!-- Bio Modal -->
            <div class="bioModalDiv" v-if="!bioModalDiv">
                <form id="bioForm">
                    <div class="row">
                        <div class="row">
                            <p class="bioTitle">About</p>
                            <div class="input-field col s9">
                                <input type="text" placeholder="About" id="bioAboutInput">
                            </div>
    
                            <div class="col s3" id="bioUpIconColDiv">
                                <i class="material-icons" id="bioIcon">cloud_upload</i>
                                <a href="#" class="bioUpTxt">Upload Image</a>
                            </div>
                        </div>
                        <div class="row">
                            <p class="bioTitle">Curriculum Vitae</p>
                            <div class="input-field col s12">
                                <input type="text" id="bioCvInput">
                            </div>
                            
                            <div class="" id="bioUpIconColDiv1">
                                <i class="material-icons" id="bioIcon">cloud_upload</i>
                                <a href="#" class="bioUpTxt">Upload Image</a>
                            </div>
                            
                            <p class="bioTitle">History</p>
                            <div class="input-field col s12">
                                <input type="text" placeholder="History" id="bioCvInput1">
                            </div>
                        </div>


                        <div class="row rm_mg">
                            <div class="row">
                                <p class="col s6 bioTitle">Services</p>
                                <i class="col s1 offset-s5 material-icons" id="bioAddBtn">add_circle</i>
                            </div>
                            
                            <div class="input-field col s2 rm_mg">
                                <input type="text" placeholder="Title" id="bioCvInput2">
                            </div>
                            
                            <div class="input-field col s7 rm_mg">
                                <input type="text" placeholder="Description" id="bioCvInput3">
                            </div>
                            
                            <div class="" id="bioUpIconColDiv2">
                                <i class="material-icons" id="bioIcon">cloud_upload</i>
                                <a href="#" class="bioUpTxt">Upload Image</a>
                            </div>
                        </div>

                        <div class="row rm_mg">
                            <div class="input-field col s2">
                                <input type="text" placeholder="Title" id="bioCvInput2">
                            </div>
                        
                            <div class="input-field col s7">
                                <input type="text" placeholder="Description" id="bioCvInput3">
                            </div>
                        
                            <div class="" id="bioUpIconColDiv2">
                                <i class="material-icons" id="bioIcon">cloud_upload</i>
                                <a href="#" class="bioUpTxt">Upload Image</a>
                            </div>
                        </div>

                        
                        <div class="row rm_mg">
                            <div class="row">
                                <p class="col s6 bioTitle">Archievement</p>
                                <i class="col s1 offset-s5 material-icons" id="bioAddBtn">add_circle</i>
                            </div>
                        
                            <div class="input-field col s2 rm_mg">
                                <input type="text" placeholder="Title" id="bioCvInput2">
                            </div>
                        
                            <div class="input-field col s7 rm_mg">
                                <input type="text" placeholder="Description" id="bioCvInput3">
                            </div>
                        
                            <select class="col s2 offset-s1 browser-default bioSelectOpt">
                                <option value="" disabled selected>percentage</option>
                                <option value="1">Option 1</option>
                                <option value="2">Option 2</option>
                                <option value="3">Option 3</option>
                            </select>
                        </div>
                        
                        <div class="row rm_mg">
                            <div class="input-field col s2">
                                <input type="text" placeholder="Title" id="bioCvInput2">
                            </div>
                        
                            <div class="input-field col s7">
                                <input type="text" placeholder="Description" id="bioCvInput3">
                            </div>
                        
                            <select class="col s2 offset-s1 browser-default bioSelectOpt1">
                                <option value="" disabled selected>percentage</option>
                                <option value="1">Option 1</option>
                                <option value="2">Option 2</option>
                                <option value="3">Option 3</option>
                            </select>

                            <button type="button" class="col s12 btn" id="bioModalBtn">save</button>
                        </div>
                        
                    </div>
                </form>
                
            </div>

            <!-- Contact Modal -->
            <div class="editWebModal" v-if="!contactModal">
                <div class="editInnerWebModal">
                    <form>
                        <div class="row">
                            <div class="col s12">
                                <p class="editWebGenTitle">Phone Number</p>
                                <input type="text" placeholder="Phone Number" class="validate" id="editWebGenModelInput">
                            </div>
            
                            <div class="col s12">
                                <p class="editWebGenTitle">Email</p>
                                <input type="text" placeholder="Email" class="validate" id="editWebGenModelInput">
                            </div>
            
                            <div class="col s12">
                                <p class="editWebGenTitle">Address</p>
                                <input type="text" placeholder="Address" class="validate" id="editWebGenModelInput">
                            </div>
            
            
                            <button type="button" class="col s12 btn" id="contactModalSubBtn">save</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Socials Modal -->
            <div class="editWebModal" v-if="!socialsModal">
                <div class="editInnerWebModal">
                    <form>
                        <div class="row">
                            <div class="col s12">
                                <p class="editWebGenTitle">Facebook</p>
                                <input type="text" placeholder="@bayoake" class="validate" id="editWebGenModelInput">
                            </div>
            
                            <div class="col s12">
                                <p class="editWebGenTitle">Instagram</p>
                                <input type="text" placeholder="@bayoake" class="validate" id="editWebGenModelInput">
                            </div>
            
                            <div class="col s12">
                                <p class="editWebGenTitle">Twitter</p>
                                <input type="text" placeholder="@bayoake" class="validate" id="editWebGenModelInput">
                            </div>
            
            
                            <button type="button" class="col s12 btn" id="socialsModalSubBtn">save</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Review Modal -->
            <div class="bioModalDiv" v-if="!reviewModalDiv">
                <form id="reviewForm">
                    <div class="row rm_mg">
                        <p class="col s12 reviewTitle">Client</p>
                    
                        <div class="input-field col s2 rm_mg">
                            <input type="text" placeholder="Title" id="bioCvInput2">
                        </div>
                    
                        <div class="input-field col s7 rm_mg">
                            <input type="text" placeholder="Description" id="bioCvInput3">
                        </div>
                    
                        <div class="" id="reviewUpIconColDiv2">
                            <i class="material-icons" id="bioIcon">cloud_upload</i>
                            <a href="#" class="bioUpTxt">Upload Image</a>
                        </div>
                    </div>

                    <div class="row rm_mg">
                        <p class="col s12 reviewTitle">Client</p>
                    
                        <div class="input-field col s2 rm_mg">
                            <input type="text" placeholder="Title" id="bioCvInput2">
                        </div>
                    
                        <div class="input-field col s7 rm_mg">
                            <input type="text" placeholder="Description" id="bioCvInput3">
                        </div>
                    
                        <div class="" id="reviewUpIconColDiv2">
                            <i class="material-icons" id="bioIcon">cloud_upload</i>
                            <a href="#" class="bioUpTxt">Upload Image</a>
                        </div>
                    </div>

                    <div class="row rm_mg">
                        <p class="col s12 reviewTitle">Client</p>
                    
                        <div class="input-field col s2 rm_mg">
                            <input type="text" placeholder="Title" id="bioCvInput2">
                        </div>
                    
                        <div class="input-field col s7 rm_mg">
                            <input type="text" placeholder="Description" id="bioCvInput3">
                        </div>
                    
                        <div class="" id="reviewUpIconColDiv2">
                            <i class="material-icons" id="bioIcon">cloud_upload</i>
                            <a href="#" class="bioUpTxt">Upload Image</a>
                        </div>

                        <button type="button" class="col s12 btn" id="reviewModalBtn">save</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            logoModal: true,
            genModal: false,
            bioModalDiv: true,
            contactModal: true, 
            socialsModal: true,
            reviewModalDiv: true,
        }
    },
    methods: {
        editWebModalBtn() {
            this.isHidden = false;

            $("#genBtn").css("color", "black");
        },

        modalExitBtn() {
            this.$emit('exitModal')
        }, 

        logoBtn() {
            this.logoModal = false;
            this.genModal = true;
            this.bioModalDiv = true;
            this.contactModal = true;
            this.socialsModal = true;
            this.reviewModalDiv = true;

            $("#logoBtn").css("color", "black");
            $("#genBtn").css("color", "white");
            $('#bioBtn').css('color', 'white');
            $("#socialsBtn").css("color", "white");
            $("#reviewBtn").css("color", "white");
        },

        genBtn() {
            this.logoModal = true;
            this.genModal = false
            this.bioModalDiv = true;
            this.contactModal = true;
            this.socialsModal = true;
            this.reviewModalDiv = true;

            $("#genBtn").css("color", "black");
            $("#logoBtn").css("color", "white");
            $('#bioBtn').css('color', 'white');
            $("#contactBtn").css("color", "white");
            $("#socialsBtn").css("color", "white");
            $("#reviewBtn").css("color", "white");
        },

        bioBtn() {
            this.logoModal = true;
            this.genModal = true;
            this.bioModalDiv = false;
            this.contactModal = true;
            this.socialsModal = true;
            this.reviewModalDiv = true;

            $('#bioBtn').css('color', 'black');
            $("#genBtn").css("color", "white");
            $("#logoBtn").css("color", "white");
            $("#contactBtn").css("color", "white");
            $("#socialsBtn").css("color", "white");
            $("#reviewBtn").css("color", "white");
        }, 

        contactBtn() {
            this.contactModal = false;
            this.logoModal = true;
            this.genModal = true;
            this.bioModalDiv = true;
            this.socialsModal = true;
            this.reviewModalDiv = true;


            $('#bioBtn').css('color', 'white');
            $("#genBtn").css("color", "white");
            $("#logoBtn").css("color", "white");
            $("#contactBtn").css("color", "black");
            $("#socialsBtn").css("color", "white");
            $("#reviewBtn").css("color", "white");
        }, 

        socialsBtn() {
            this.socialsModal = false;
            this.contactModal = true;
            this.logoModal = true;
            this.genModal = true;
            this.bioModalDiv = true; 
            this.reviewModalDiv = true;

            $('#bioBtn').css('color', 'white');
            $("#genBtn").css("color", "white");
            $("#logoBtn").css("color", "white");
            $("#contactBtn").css("color", "white");
            $("#socialsBtn").css("color", "black");
            $("#reviewBtn").css("color", "white");
        },

        reviewBtn() {
            this.reviewModalDiv = false; 
            this.socialsModal = true;
            this.contactModal = true;
            this.logoModal = true;
            this.genModal = true;
            this.bioModalDiv = true; 

            $('#bioBtn').css('color', 'white');
            $("#genBtn").css("color", "white");
            $("#logoBtn").css("color", "white");
            $("#contactBtn").css("color", "white");
            $("#socialsBtn").css("color", "white");
            $("#reviewBtn").css("color", "black");
        },
    },
}
</script>