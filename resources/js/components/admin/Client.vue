<template>
    <div>
        <!-- Sidenav for small devices -->
        <AdminMobileNavComponent />

        <div class="row" id="dashRowDiv">
            <!-- Sidebar for large and medium devices -->
            <AdminSideNavComponent />

            <!-- Web black div -->
            <div class="col s12 m10 l10" id="webRightDiv">

                <!-- Create Website Name Section -->
                <div class="createPortDiv" v-if="!hiddenCreateWebName">
                    <div class="webBlackDiv">
                        <div class="webBlackDiv1">
                            <div class="row webBlackDiv1">
                                <div class="col s11">
                                    <p class="webBlackTitle">Setup your Website Name</p>
                                </div>
                                <div class="col s1">
                                    <i class="material-icons right" id="webAddCircleIcon">help</i>
                                </div>
                                <div class="col s12">
                                    <p class="webBlackTxt">
                                        Lets start and automate your process so you can
                                        reclaim time and focus on your goals.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <div class="webWhiteDiv">
                        <div class="webWhiteDiv1">
                            <div class="row">
                                <div class="row clientCreatePortInputRowDiv">
                                    <form>
                                        <div class="col s12">
                                            <input type="text" placeholder="Domain" class="clientCreatePortInput1">
                                        </div>
                
                                        <div class="clientCreatePortBtnDiv">
                                            <button type="button" class="btn clientCreatePortBtn" @click="hiddenCreateWebNameBtn()">Next</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Create Website Description Section -->
                <div class="createPortDiv" v-if="!hiddenCreateWebDescription">
                    <div class="webBlackDiv">
                        <div class="webBlackDiv1">
                            <div class="row webBlackDiv1">
                                <div class="col s11">
                                    <p class="webBlackTitle">Setup your Website description</p>
                                </div>
                                <div class="col s1">
                                    <i class="material-icons right" id="webAddCircleIcon">help</i>
                                </div>
                                <div class="col s12">
                                    <p class="webBlackTxt">
                                        Lets start and automate your process so you can
                                        reclaim time and focus on your goals.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="webWhiteDiv">
                        <div class="webWhiteDiv1">
                            <div class="row">
                                <div class="row clientCreatePortInputRowDiv">
                                    <form>
                                        <div class="col s12">
                                            <input type="text" placeholder="Description" class="clientCreatePortInput1">
                                        </div>

                                        <div class="clientCreatePortBtnDiv">
                                            <button type="button" class="btn clientCreatePortBtn" @click="hiddenCreateWebDescriptionBtn()">Next</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Choose a template Section -->
                <div class="createPortDiv" v-if="!chooseTempDiv">
                    <div class="webBlackDiv">
                        <div class="webBlackDiv1">
                            <div class="row webBlackDiv1">
                                <div class="col s11">
                                    <p class="webBlackTitle">Choose a template</p>
                                </div>
                                <div class="col s1">
                                    <i class="material-icons right" id="webAddCircleIcon">help</i>
                                </div>
                                <div class="col s12">
                                    <p class="webBlackTxt">
                                        Lets start and automate your process so you can
                                        reclaim time and focus on your goals.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <div class="webWhiteDiv">
                        <div class="webWhiteDiv1">
                            <div class="row">
                                <div class="row clientCreatePortInputRowDiv">
                                    <!-- <form> -->
                                    <div class="userTempMainDiv">
                                        <div class="row">
                
                                            <div class="col s6 m4 l2">
                                                <div id="userTempDiv">
                                                    <div class="tempImgDiv" id="tempImgDiv">
                                                        <i class="material-icons" id="tempProIcon">person</i>
                                                    </div>
                                                    <p class="userTempTitle">PhysicianX</p>
                                                </div>
                                            </div>
                
                                            <div class="col s6 m4 l2">
                                                <div id="userTempDiv">
                                                    <div class="tempImgDiv" id="tempImgDiv">
                                                        <i class="material-icons" id="tempProIcon">person</i>
                                                    </div>
                                                    <p class="userTempTitle">MedicPlus</p>
                                                </div>
                                            </div>
                
                                            <div class="col s6 m4 l2">
                                                <div id="userTempDiv">
                                                    <div class="tempImgDiv" id="tempImgDiv">
                                                        <i class="material-icons" id="tempProIcon">person</i>
                                                    </div>
                                                    <p class="userTempTitle">DocTab</p>
                                                </div>
                                            </div>
                
                                            <div class="col s6 m4 l2">
                                                <div id="userTempDiv">
                                                    <div class="tempImgDiv" id="tempImgDiv">
                                                        <i class="material-icons" id="tempProIcon">person</i>
                                                    </div>
                                                    <p class="userTempTitle">PhisiLux</p>
                                                </div>
                                            </div>
                
                                            <div class="col s6 m4 l2">
                                                <div id="userTempDiv">
                                                    <div class="tempImgDiv" id="tempImgDiv">
                                                        <i class="material-icons" id="tempProIcon">person</i>
                                                    </div>
                                                    <p class="userTempTitle">Trainner</p>
                                                </div>
                                            </div>
                
                                            <div class="col s6 m4 l2">
                                                <div id="userTempDiv">
                                                    <div class="tempImgDiv" id="tempImgDiv">
                                                        <i class="material-icons" id="tempProIcon">person</i>
                                                    </div>
                                                    <p class="userTempTitle">Lawyers</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                
                                    <div class="clientCreatePortBtnDiv">
                                        <button type="button" class="btn clientCreatePortBtn" @click="chooseTempBtn()">Get Started</button>
                                    </div>
                                    <!-- </form> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Create portfolio Div -->
                <div class="createPortDiv" v-if="!createPortDiv">
                    <div class="webBlackDiv">
                        <div class="webBlackDiv1">
                
                            <div class="row webBlackDiv1">
                                <div class="col s12">
                                    <p class="webBlackTitle">Create Portfolio</p>
                                </div>
                                <div class="col s11">
                                    <p class="webBlackTxt">
                                        Lets start and automate your process so you can
                                        reclaim time and focus on your goals.
                                    </p>
                                </div>
                                <div class="col s1">
                                    <i class="material-icons right" id="webAddCircleIcon" @click="webAddCircleIcon()">add_circle</i>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <!-- web empty div -->
                    <div class="webWhiteDiv">
                        <div class="webWhiteDiv1">
                            <div class="row" id="webWhiteDiv2">
                                <div class="col s3 m2 l2" id="webWhiteProMgLftDiv">
                                    <div id="">
                                        <div class="webWhiteProDiv" id="">
                                            <i class="material-icons" id="tempProIcon">person</i>
                                        </div>
                                        <p class="webWhiteProName">escoba</p>
                                    </div>
                                </div>
                
                                <div class="col s5 s5 l6 offset-s1">
                                    <p class="webWhiteTitle">Description</p>
                                    <p class="webWhiteTxt">
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                        Lorem Ipsum has been the industry's standard dummy text
                                    </p>
                                </div>
                
                                <div class="col l3 right-align">
                                    <a href="#!" class="marginRight1" title="Visit my website">
                                        <i class="material-icons" id="webWhiteIcon">visibility</i>
                                    </a>
                
                                    <a href="#!" class="marginRight1" title="Configure my webiste details">
                                        <i class="material-icons" id="webWhiteIcon" @click="createPortSettings()">settings</i>
                                    </a>
                                    <a href="#!" title="Edit your website">
                                        <i class="material-icons" id="webWhiteIcon">edit</i>
                                    </a>
                                </div>
                
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Configure Website Section -->
                <div class="createPortDiv" v-if="!configureWebDiv">
                    <div class="webBlackDiv">
                        <div class="webBlackDiv1">
                            <div class="row webBlackDiv1">
                                <div class="col s12">
                                    <p class="webBlackTitle">Configure your website</p>
                                </div>
                                <div class="col s12">
                                    <p class="webBlackTxt">
                                        Lets start and automate your process so you can
                                        reclaim time and focus on your goals.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="#" class="configWebGoBackBtn">GO BACK</a>
                
                    <div class="webWhiteDiv">
                        <div class="webWhiteDiv1">
                            <div class="row configureWebDiv">
                                <form>
                                    <div>
                                        <label class="col s12 configWebInputLabel">Edit your domain name</label>
                                        <div class="col s10">
                                            <input type="text" placeholder="Domain Name" class="clientCreatePortInput1">
                                        </div>
                                        
                                        <div class="col s1 offset-s1 clientCreatePortBtnDiv">
                                            <button type="button" class="btn clientCreatePortBtn">CHECK AVAILABILITY</button>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="col s12 configWebInputLabel">Assign website</label>
                                        <div class="col s10">
                                            <input type="text" placeholder="Username or Email" class="clientCreatePortInput1">
                                        </div>
                                        
                                        <div class="col s1 offset-s1 clientCreatePortBtnDiv">
                                            <button type="button" class="btn clientCreatePortBtn">GIVE ACCESS</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <div class="clientConfigTempDiv">
                        <p class="col s12 configWebTxt">Change Template</p>
                        <!-- First Row -->
                        <div class="col s12 m6 l4 clientTempPageImgSmDv">
                    
                            <div class="tempPageImgDiv clientSelectedTemp">
                                <img src="/media/img/aboutmyself.png" alt="tempPageImg.png" class="responsive-img tempPageGridImg">
                            </div>
                    
                            <p class="tempPageImgTitle">
                                Planet Earth
                            </p>
                    
                            <p class="tempPageImgTxt">
                                The Planet Earth template is a captivating design with minimalist appeal.
                            </p>
                    
                            <a href="#" class="tempPageImgLink">Preview</a>
                            <a href="#" class="tempPageImgLink1 right">Selected</a>
                        </div>  
                    
                        <div class="col s12 m6 l4 clientTempPageImgSmDv">
                            <div class="tempPageImgDiv">
                                <img src="/media/img/aboutmyself.png" alt="tempPageImg.png" class="tempPageGridImg">
                            </div>
                    
                            <p class="tempPageImgTitle">
                                Planet Earth
                            </p>
                    
                            <p class="tempPageImgTxt">
                                The Planet Earth template is a captivating design with minimalist appeal.
                            </p>
                    
                            <a href="#" class="tempPageImgLink">Preview</a>
                            <a href="#" class="tempPageImgLink1 right">Select</a>
                        </div>
                    
                        <div class="col s12 m6 l4 clientTempPageImgSmDv">
                            <div class="tempPageImgDiv">
                                <img src="/media/img/aboutmyself.png" alt="tempPageImg.png" class="tempPageGridImg">
                            </div>
                    
                            <p class="tempPageImgTitle">
                                Planet Earth
                            </p>
                    
                            <p class="tempPageImgTxt">
                                The Planet Earth template is a captivating design with minimalist appeal.
                            </p>
                    
                            <a href="#" class="tempPageImgLink">Preview</a>
                            <a href="#" class="tempPageImgLink1 right">Select</a>
                        </div>
                    
                    
                        <!-- Second Row -->
                        <div class="col s12 m6 l4 clientTempPageImgSmDv">
                            <div class="tempPageImgDiv">
                                <img src="/media/img/aboutmyself.png" alt="tempPageImg.png" class="tempPageGridImg">
                            </div>
                    
                            <p class="tempPageImgTitle">
                                Planet Earth
                            </p>
                    
                            <p class="tempPageImgTxt">
                                The Planet Earth template is a captivating design with minimalist appeal.
                            </p>
                    
                            <a href="#" class="tempPageImgLink">Preview</a>
                            <a href="#" class="tempPageImgLink1 right">Select</a>
                        </div>
                    
                        <div class="col s12 m6 l4 clientTempPageImgSmDv">
                            <div class="tempPageImgDiv">
                                <img src="/media/img/aboutmyself.png" alt="tempPageImg.png" class="tempPageGridImg">
                            </div>
                    
                            <p class="tempPageImgTitle">
                                Planet Earth
                            </p>
                    
                            <p class="tempPageImgTxt">
                                The Planet Earth template is a captivating design with minimalist appeal.
                            </p>
                    
                            <a href="#" class="tempPageImgLink">Preview</a>
                            <a href="#" class="tempPageImgLink1 right">Select</a>
                        </div>
                    
                        <div class="col s12 m6 l4 clientTempPageImgSmDv">
                            <div class="tempPageImgDiv">
                                <img src="/media/img/aboutmyself.png" alt="tempPageImg.png" class="tempPageGridImg">
                            </div>
                    
                            <p class="tempPageImgTitle">
                                Planet Earth
                            </p>
                    
                            <p class="tempPageImgTxt">
                                The Planet Earth template is a captivating design with minimalist appeal.
                            </p>
                    
                            <a href="#" class="tempPageImgLink">Preview</a>
                            <a href="#" class="tempPageImgLink1 right">Select</a>
                        </div>
                        <!-- End of Row -->
                    </div>

                    <div class="col s12">
                        <p class="adminClientConfigPreload">Loading...</p>
                    </div>

                    <div class="col s12 adminClientConfigDelBtnDiv">
                        <p class="adminClientConfigDelTxt">Do you want to delete website?</p>

                        <button type="button" class="btn adminClientConfigDelBtn">Delete Website</button>
                    </div>
                </div>

                <!-- Admin Clients Section -->
                <div class="createPortDiv" v-if="!addClientDiv">
                    <div class="webBlackDiv">
                        <div class="webBlackDiv1">
                            <div class="row webBlackDiv1">
                                <div class="col s12">
                                    <p class="webBlackTitle">Add Clients</p>
                                </div>
                                <div class="col s11">
                                    <p class="webBlackTxt">
                                        Lets start and automate your process so you can
                                        reclaim time and focus on your goals.
                                    </p>
                                </div>
                                <div class="col s1">
                                    <i class="material-icons right" id="webAddCircleIcon" @click="addClientBtn()">add_circle</i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="adminClientSearchInputMainDiv">
                        <div>
                            <form>
                                <div class="input-field">
                                    <input placeholder="&#128269; Search" id="adminClientSearchInput" type="text" class="validate">
                                </div>
                            </form>
                        </div>

                        <div class="adminClientSearchInputControlDiv">
                            <div>
                                <span class="adminClientSearchInputTxts">Filter</span>
                                <i class="material-icons adminClientSearchInputIcons">filter_list</i>
                            </div>

                            <div class="adminClientSearchInputIconsDiv">
                                <span class="adminClientSearchInputTxts">Sort</span>
                                <i class="material-icons adminClientSearchInputIcons">sort</i>
                            </div>
                        </div>
                    </div>
                    
                
                    <table class="responsive-table adminAddClientTable">
                        <!-- <thead>
                            <tr>
                                <th>Name</th>
                                <th>Item Name</th>
                                <th>Item Price</th>
                            </tr>
                        </thead> -->
                    
                        <tbody>
                            <tr class="adminAddClientTr">
                                <td><div class="adminAddClientImgDiv"></div></td>
                                <td class="addminAddClientTxts">Dr</td>
                                <td class="addminAddClientTxts">Akerele</td>
                                <td class="addminAddClientTxts">Adebayo</td>
                                <td class="addminAddClientTxts">adebayo@gmail.com</td>
                                <td class="addminAddClientTxts">drade.paab.com</td>
                                <td class="right">
                                    <button type="button" class="btn adminAddClientViewBtn">view</button>
                                    <button type="button" class="btn adminAddClientDelBtn">delete</button>
                                </td>
                            </tr>
                            <tr class="adminAddClientTr">
                                <td>
                                    <div class="adminAddClientImgDiv"></div>
                                </td>
                                <td class="addminAddClientTxts">Dr</td>
                                <td class="addminAddClientTxts">Akerele</td>
                                <td class="addminAddClientTxts">Adebayo</td>
                                <td class="addminAddClientTxts">adebayo@gmail.com</td>
                                <td class="addminAddClientTxts">drade.paab.com</td>
                                <td class="right">
                                    <button type="button" class="btn adminAddClientViewBtn">view</button>
                                    <button type="button" class="btn adminAddClientDelBtn">delete</button>
                                </td>
                            </tr>
                            <tr class="adminAddClientTr">
                                <td>
                                    <div class="adminAddClientImgDiv"></div>
                                </td>
                                <td class="addminAddClientTxts">Dr</td>
                                <td class="addminAddClientTxts">Akerele</td>
                                <td class="addminAddClientTxts">Adebayo</td>
                                <td class="addminAddClientTxts">adebayo@gmail.com</td>
                                <td class="addminAddClientTxts">drade.paab.com</td>
                                <td class="right">
                                    <button type="button" class="btn adminAddClientViewBtn">view</button>
                                    <button type="button" class="btn adminAddClientDelBtn">delete</button>
                                </td>
                            </tr>
                            <tr class="adminAddClientTr">
                                <td>
                                    <div class="adminAddClientImgDiv"></div>
                                </td>
                                <td class="addminAddClientTxts">Dr</td>
                                <td class="addminAddClientTxts">Akerele</td>
                                <td class="addminAddClientTxts">Adebayo</td>
                                <td class="addminAddClientTxts">adebayo@gmail.com</td>
                                <td class="addminAddClientTxts">drade.paab.com</td>
                                <td class="right">
                                    <button type="button" class="btn adminAddClientViewBtn">view</button>
                                    <button type="button" class="btn adminAddClientDelBtn">delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="adminClientPaginationControlDiv">
                        <div class="adminClientPaginationInnerControlDiv right">
                            <span class="adminClientPaginationNum">1-5 of 20</span>

                            <div class="adminClientPaginationIconDiv">
                                <i class="material-icons adminClientPaginationLeftIcon">navigate_before</i>
                                <i class="material-icons adminClientPaginationRightIcon">navigate_next</i>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
import AdminSideNavComponent from "../partials/AdminSideNavComponent.vue";
import AdminMobileNavComponent from "../partials/AdminMobileNavComponent.vue";
// import FooterComponent from "./partials/FooterComponent.vue";
// import HeaderComponent from "./partials/HeaderComponent.vue";
export default {
    components: {
        AdminSideNavComponent,
        AdminMobileNavComponent,
        // FooterComponent,
        // HeaderComponent,
    },
    data() {
        return {
            bg_img: '/media/img/istockphoto-1390124896-170667a.jpg',
            pro_img: '/media/img/yuna.jpg',

            addClientDiv: false,
            hiddenCreateWebName: true,
            hiddenCreateWebDescription: true,
            chooseTempDiv: true,
            createPortDiv: true,
            configureWebDiv: true,
        };
    },
    mounted() { },
    methods: {
        addClientBtn() {
            this.addClientDiv = true;
            this.hiddenCreateWebName = false;
        },
        hiddenCreateWebNameBtn() {
            this.hiddenCreateWebName = true;
            this.hiddenCreateWebDescription = false;
        },
        hiddenCreateWebDescriptionBtn() {
            this.hiddenCreateWebDescription = true;
            this.chooseTempDiv = false;
        },
        chooseTempBtn() {
            this.chooseTempDiv = true;
            this.createPortDiv = false;
        },
        createPortSettings() {
            this.createPortDiv = true;
            this.configureWebDiv = false;
        }
    }
}
</script>