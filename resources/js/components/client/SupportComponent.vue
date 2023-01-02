<template>
    <div>
        <mobile-nav-component />


        <!-- Sidebar for large and medium devices -->
        <div class="row" id="dashRowDiv">
            <side-nav-component @user="getUser"/>
        
            <!-- Right Side Div -->
            <div class="col s12 m10 l10" id="supportRightDiv">
                <div class="supportBlueDiv">
                    <div class="webBlackDiv1">
                        <div class="row webBlackDiv1">
                            <div class="col s12">
                                <p class="supportTitle">FAQs</p>
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

                <div class="row supportDiv">
                    <div class="col s12 m6 l6 supportColDiv">
                        <p class="supportTitle1">Is it a free platform</p>
                        <p class="supportTxt1">
                            There are many variations of passages of Lorem Ipsum available,
                            but the majority have suffered alteration in some form, by injected humour,
                            or randomised words which don't look even slightly believable.
                            If you are going
                        </p>
                    </div>

                    <div class="col s12 m6 l6">
                        <p class="supportTitle1">Is it a free platform</p>
                        <p class="supportTxt1">
                            There are many variations of passages of Lorem Ipsum available,
                            but the majority have suffered alteration in some form, by injected humour,
                            or randomised words which don't look even slightly believable.
                            If you are going
                        </p>
                    </div>

                    <div class="col s12 m6 l6">
                        <p class="supportTitle1">Is it a free platform</p>
                        <p class="supportTxt1">
                            There are many variations of passages of Lorem Ipsum available,
                            but the majority have suffered alteration in some form, by injected humour,
                            or randomised words which don't look even slightly believable.
                            If you are going
                        </p>
                    </div>

                    <div class="col s12 m6 l6">
                        <p class="supportTitle1">Is it a free platform</p>
                        <p class="supportTxt1">
                            There are many variations of passages of Lorem Ipsum available,
                            but the majority have suffered alteration in some form, by injected humour,
                            or randomised words which don't look even slightly believable.
                            If you are going
                        </p>
                    </div>

                    <div class="col s12 m6 l6">
                        <p class="supportTitle1">Is it a free platform</p>
                        <p class="supportTxt1">
                            There are many variations of passages of Lorem Ipsum available,
                            but the majority have suffered alteration in some form, by injected humour,
                            or randomised words which don't look even slightly believable.
                            If you are going
                        </p>
                    </div>

                    <div class="col s12 m6 l6">
                        <p class="supportTitle1">Is it a free platform</p>
                        <p class="supportTxt1">
                            There are many variations of passages of Lorem Ipsum available,
                            but the majority have suffered alteration in some form, by injected humour,
                            or randomised words which don't look even slightly believable.
                            If you are going
                        </p>
                    </div>
                </div>

                <div class="supportGetInTouchDiv">
                    <div class="row supportGetInTouchRowDiv">
                        <div class="col l1">
                            <div class="cardImgDiv">
                                <i class="material-icons" id="cardImg">person</i>
                            </div>
                        </div>

                        <div class="col l9">
                            <p class="supportGetInTouchTitle">Still have any questions?</p>
                            <p class="supportGetInTouchTxt">
                                Can’t find the answers you are looking for?
                                please chat with our friendly team
                            </p>
                        </div>

                        <div class="col l2" id="supportGetInTouchBtnColDiv">
                            <button class="btn" type="button" id="supportGetInTouchBtn" @click="supportModal()">
                                GET INTOUCH
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Customer Support Modal -->
                <div class="clientModalSupportDiv" v-if="!isHidden">
                    <i class="material-icons" id="clientCusSupportCancelBtn" @click="hideSupportModal()">cancel</i>
                    <div class="row clientModalSupportInnerDiv">
                        <div class="col s12 m12 l5 cusSupportImgDiv hide-on-med-and-down">
                            <img src="/media/img/CARE.png" alt="CARE.png" id="sCareImg">
                        </div>

                        <div class="col s12 m12 l6 offset-l1 cusSupportFormDiv">
                            <p class="cusSupportTitle">WE’RE ALWAYS HAPPY TO HELP</p>

                            <form class="col s12">
                                <div class="row rm_mg">
                                    <div class="input-field col s6 rm_mg">
                                        <input placeholder="First name" id="sFName" type="text" class="validate">
                                        <!-- <label for="first_name">First Name</label> -->
                                    </div>
                                    <div class="input-field col s6 rm_mg">
                                        <input placeholder="Last name " id="sLName" type="text" class="validate">
                                        <!-- <label for="last_name">Last Name</label> -->
                                    </div>
                                </div>

                                <div class="row rm_mg">
                                    <div class="input-field col s12 rm_mg">
                                        <input placeholder="Email address" id="sEmail" type="email" class="validate">
                                        <!-- <label for="email">Email</label> -->
                                    </div>
                                </div>

                                <div class="row rm_mg">
                                    <div class="input-field col s12 rm_mg">
                                        <textarea placeholder="Share your thoughts..." id="sTextarea1"
                                            class="materialize-textarea"></textarea>
                                    </div>
                                </div>

                                <button type="button" class="btn col s12 m12 l12 rm_mg" id="modalSupportBtnForm">
                                    Send
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
import MobileNavComponent from '../partials/MobileNavComponent.vue';
import SideNavComponent from '../partials/SideNavComponent.vue';
export default {
    components: {
        MobileNavComponent,
        SideNavComponent
    },
    data() {
        return {
            bg_img: '/media/img/istockphoto-1390124896-170667a.jpg',
            pro_img: '/media/img/yuna.jpg',

            isHidden: true

        };
    },
    mounted() { },
    methods: {
        supportModal() {
            this.isHidden = false
        },
        hideSupportModal() {
            this.isHidden = true
        }
    }
}
</script>