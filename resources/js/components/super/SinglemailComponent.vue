<template>
    <div>
        <!-- Sidenav for small devices -->
        <mobile-nav-component />

        <div class="row" id="dashRowDiv">
            <!-- Sidebar for large and medium devices -->
            <side-nav-component @user="getUser" />

            <!-- Mail blue div -->
            <div class="col s12 m10 l10" id="singleMailRightDiv">
                <div class="clientSendmailContainDiv">
                    <div class="clientSendMailBackLinkDiv">
                        <a href="/supre/mail" class="clientSendmailArrowBackLink">
                            <i class="material-icons" id="clientSendmailArrowBackIcon">arrow_back</i>
                            <span class="clientSendmailBackTxt">Back</span>
                        </a>
                    </div>
                    <div class="clientModalDiv">
                        <div class="row" id="clientSendmailRowDiv">
                            <div class="col l1">
                                <div class="cardImgDiv">
                                    <i class="material-icons" id="cardImg">person</i>
                                </div>
                            </div>

                            <div class="col l10">
                                <a href="#" class="clientSendemailTitle">info@paab.com</a>
                                <p class="clientSendemailTxt">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum has been the
                                    industry's standard
                                    dummy text ever since the 1500s, when an unknown printer took a galley of type and
                                    scrambled it to
                                    make
                                    a type specimen
                                    book. It has survived not only five centuries, but also the leap into electronic
                                    typesetting,
                                    remaining
                                    essentially
                                    unchanged.
                                </p>
                                <p class="clientSendemailTxt1">
                                    There are many variations of passages of Lorem Ipsum available, but the majority
                                    have suffered
                                    alteration in some form,
                                    by injected humour, or randomised words which don't look even slightly believable.
                                    If you are going
                                    to
                                    use a passage of
                                    Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the
                                    middle of text. All
                                    the
                                    Lorem Ipsum
                                    generators on the Internet tend to repeat predefined chunks as necessary, making
                                    this the first true
                                    generator on the
                                    Internet. It uses a dictionary of over 200 Latin words, combined with a handful of
                                    model sentence
                                    structures, to
                                    generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore
                                    always free from
                                    repetition,
                                    injected humour, or non-characteristic words etc.
                                </p>
                                <p class="clientSendemailTxt2">
                                    There are many variations of passages of Lorem Ipsum available, but the majority
                                    have suffered
                                    alteration in some form,
                                    by injected humour, or randomised words which don't look even slightly believable.
                                    If you are going
                                    to
                                    use a passage of
                                    Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the
                                    middle of text. All
                                    the
                                    Lorem Ipsum
                                    generators on the Internet tend to repeat predefined chunks as necessary, making
                                    this the first true
                                    generator on the
                                    Internet. It uses a dictionary of over 200 Latin words, combined with a handful of
                                    model sentence
                                    structures, to
                                    generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore
                                    always free from
                                    repetition,
                                    injected humour, or non-characteristic words etc.

                                </p>
                            </div>

                            <div class="col l1">
                                <span class="clientSendmailTimeSent">
                                    now
                                </span>
                            </div>
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
        SideNavComponent,
    },
    data() {
        return {
            bg_img: '/media/img/istockphoto-1390124896-170667a.jpg',
            pro_img: '/media/img/yuna.jpg',
        };
    },
    mounted() { },
    methods: {}
}
</script>