<template>
    <div class="section scrollspy contactContainDiv" id="contact">
        <div class="row">
            <div class="col s12" id="testiContactFormTitleDiv">
                <p class="feedsMainTitle">Contact Me</p>
                <p class="feedsMainTxt">SCHEDULE AN APPOINTMENT</p>
            </div>

            <div class="input-field col s12 m6 l6">
                <input
                    placeholder="Last Name"
                    id="testiLname"
                    type="text"
                    class="validate"
                />
            </div>

            <div class="input-field col s12 m6 l6">
                <input
                    placeholder="First Name"
                    id="testiFname"
                    type="text"
                    class="validate"
                />
            </div>

            <div class="input-field col s12 m6 l6">
                <input
                    placeholder="Email"
                    id="testiEmail"
                    type="text"
                    class="validate"
                />
            </div>

            <div class="input-field col s12 m6 l6">
                <input
                    placeholder="Phone Number"
                    id="testiPhone"
                    type="text"
                    class="validate"
                />
            </div>

            <div class="input-field col s12">
                <textarea
                    id="testiTextarea1"
                    class="materialize-textarea"
                    placeholder="State your reasons"
                ></textarea>
            </div>

            <button type="button" class="col s12 btn" id="testiContactBtn">
                SEND
                <i class="material-icons" id="testiContactBtnIcon">send</i>
            </button>
        </div>
    </div>
</template>