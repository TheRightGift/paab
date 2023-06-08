<template>
    <div>
        <div id="cvDetails" class="modal modal-fixed-footer">
            <div class="modal-content">
                <div v-show="preview === '1'">
                    <section class="intro">
                        <div>
                            <h4 class="header">Akerele Adebayo</h4>
                            <p class="subHeader">Surgeon</p>
                        </div>
                        <div>
                            <p class="flexedNoSpace">
                                <i class="material-icons pr-3">phone_locked</i>
                                <span class="fw-500">0906636373873</span>
                            </p>
                            <p class="flexedNoSpace">
                                <i class="material-icons pr-3">contact_mail</i>
                                <span class="fw-500">drake@gmail.co</span>
                            </p>
                            <p class="flexedNoSpace">
                                <i class="material-icons pr-3">location_on</i>
                                <span class="fw-500"
                                    >No. 5 Ocean view lekki, Lagos</span
                                >
                            </p>
                        </div>
                    </section>

                    <section class="summaryEtEducation">
                        <div class="row">
                            <div class="col s12 l5 m5">
                                <h5>Summary</h5>
                                <p class="summaryTxt">
                                    Lorem ipsum dolor sit amet, consectetur
                                    adipiscing elit. Integer in porttitor magna.
                                    Ut ornare lacinia leo non elementum. Morbi
                                    malesuada lacus quis urna posuere, ac
                                    viverra est varius. Pellentesque in turpis
                                    facilisis, dictum urna id, cursus nibh.
                                    Pellentesque eleifend eros in ex tempus, in
                                    sollicitudin purus tempor. Mauris est urna,
                                    blandit ut suscipit sed, venenatis ut nibh.
                                    In sed diam facilisis, sagittis tellus non,
                                    dapibus lectus. In hac habitasse platea
                                    dictumst. Orci varius natoque penatibus et
                                    magnis dis parturient montes, nascetur
                                    ridiculus mus. Mauris cursus massa eu
                                    viverra imperdiet. Donec vitae lorem ut
                                    ipsum consequat ultricies vitae sed nulla.
                                    Donec sed ligula vitae mauris volutpat
                                    vulputate sit amet vitae enim. Mauris id
                                    elit lectus. Morbi eget nunc egestas,
                                    consectetur sapien sit amet, euismod ipsum.
                                    Cras nec accumsan velit, eget lacinia nunc.
                                    Donec imperdiet felis volutpat leo aliquet
                                    porta. Proin efficitur ac arcu quis congue.
                                    Donec lobortis lobortis magna eget feugiat.
                                    Phasellus sodales consequat nibh ac
                                    vestibulum. Nullam a magna ac quam lacinia
                                    eleifend. Phasellus et luctus est. Donec
                                    diam sem, lacinia eget metus non, sodales
                                    hendrerit quam. Cras at enim volutpat,
                                    ultrices sapien ut, consectetur mi. Cras
                                    pulvinar, urna vitae lacinia euismod, leo
                                    metus mollis massa, a auctor erat nisi.
                                </p>
                            </div>
                            <div class="col s12 l5 m5 offset-l1 offset-m1">
                                <h5>Education</h5>
                                <div class="mb-2">
                                    <p class="title">Undergraduate</p>
                                    <p class="m-03">Doctor of medicine</p>
                                    <p class="flexedNoSpace">
                                        <i class="material-icons primaryColor"
                                            >date_range</i
                                        ><span class="date-range">
                                            20th June 2023 - 28th December
                                            2023</span
                                        >
                                    </p>
                                </div>
                                <div class="mb-2">
                                    <p class="title">Medical</p>
                                    <p class="m-03">Doctor of medicine</p>
                                    <p class="flexedNoSpace">
                                        <i class="material-icons primaryColor"
                                            >date_range</i
                                        ><span class="date-range">
                                            20th June 2023 - 28th December
                                            2023</span
                                        >
                                    </p>
                                </div>
                                <div>
                                    <p class="title">Other School</p>
                                    <p class="m-03">Doctor of medicine</p>
                                    <p class="flexedNoSpace">
                                        <i class="material-icons primaryColor"
                                            >date_range</i
                                        ><span class="date-range">
                                            20th June 2023 - 28th December
                                            2023</span
                                        >
                                    </p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section>
                        <div class="row">
                            <div class="col s12 l5 m5">
                                <h5>Training</h5>
                                <div class="mb-2">
                                    <p class="title">Internship</p>
                                    <p class="m-03">Doctor of medicine</p>
                                    <p class="flexedNoSpace">
                                        <i class="material-icons primaryColor"
                                            >location_on</i
                                        >Ocean View lekki, Lagos, Nigeria
                                    </p>
                                    <p class="flexedNoSpace">
                                        <i class="material-icons primaryColor"
                                            >date_range</i
                                        ><span class="date-range">
                                            20th June 2023 - 28th December
                                            2023</span
                                        >
                                    </p>
                                </div>
                                <div class="mb-2">
                                    <p class="title">Fellowship</p>
                                    <p class="m-03">Doctor of medicine</p>
                                    <p class="flexedNoSpace">
                                        <i class="material-icons primaryColor"
                                            >location_on</i
                                        >Ocean View lekki, Lagos, Nigeria
                                    </p>
                                    <p class="flexedNoSpace">
                                        <i class="material-icons primaryColor"
                                            >date_range</i
                                        ><span class="date-range">
                                            20th June 2023 - 28th December
                                            2023</span
                                        >
                                    </p>
                                </div>
                                <div>
                                    <p class="title">Residency</p>
                                    <p class="m-03">Doctor of medicine</p>
                                    <p class="flexedNoSpace">
                                        <i class="material-icons primaryColor"
                                            >location_on</i
                                        >Ocean View lekki, Lagos, Nigeria
                                    </p>
                                    <p class="flexedNoSpace">
                                        <i class="material-icons primaryColor"
                                            >date_range</i
                                        ><span class="date-range">
                                            20th June 2023 - 28th December
                                            2023</span
                                        >
                                    </p>
                                </div>
                            </div>
                            <div class="col s12 l5 m5 offset-l1 offset-m1">
                                <h5>Experience</h5>
                                <div class="mb-2">
                                    <p class="title">X-ray Medic</p>
                                    <p class="m-03">Assistan Surgeon</p>
                                    <p class="flexedNoSpace">
                                        <i class="material-icons primaryColor"
                                            >location_on</i
                                        >Ocean View lekki, Lagos, Nigeria
                                    </p>
                                    <p class="flexedNoSpace">
                                        <i class="material-icons primaryColor"
                                            >date_range</i
                                        ><span class="date-range">
                                            20th June 2023 - 28th December
                                            2023</span
                                        >
                                    </p>
                                </div>
                                <div class="mb-2">
                                    <p class="title">Clean medic</p>
                                    <p class="m-03">Surgeon</p>
                                    <p class="flexedNoSpace">
                                        <i class="material-icons primaryColor"
                                            >location_on</i
                                        >Ocean View lekki, Lagos, Nigeria
                                    </p>
                                    <p class="flexedNoSpace">
                                        <i class="material-icons primaryColor"
                                            >date_range</i
                                        ><span class="date-range">
                                            20th June 2023 - 28th December
                                            2023</span
                                        >
                                    </p>
                                </div>
                                <div>
                                    <p class="title">Medic care</p>
                                    <p class="m-03">Senior surgeon</p>
                                    <p class="flexedNoSpace">
                                        <i class="material-icons primaryColor"
                                            >location_on</i
                                        >Ocean View lekki, Lagos, Nigeria
                                    </p>
                                    <p class="flexedNoSpace">
                                        <i class="material-icons primaryColor"
                                            >date_range</i
                                        ><span class="date-range">
                                            20th June 2023 - 28th December
                                            2023</span
                                        >
                                    </p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section>
                        <div class="row">
                            <div class="col s12 l5 m5">
                                <h5>Reference</h5>
                                <div class="mb-2">
                                    <p class="title">Reference 1</p>
                                    <p class="m-03">Dr</p>
                                    <p class="m-03">Chigozie Peters</p>
                                    <p class="m-03">Senior Surgeon</p>
                                    <p class="m-03">Medic care institute</p>
                                    <div class="flexit">
                                        <p class="flexedNoSpace">
                                            <i
                                                class="material-icons primaryColor"
                                                >phone_locked</i
                                            >Ocean View lekki, Lagos, Nigeria
                                        </p>
                                        <p class="flexedNoSpace">
                                            <i
                                                class="material-icons primaryColor"
                                                >contact_mail</i
                                            ><span class="date-range">
                                                drakerele</span
                                            >
                                        </p>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <p class="title">Reference 2</p>
                                    <p class="m-03">Dr</p>
                                    <p class="m-03">Chigozie Peters</p>
                                    <p class="m-03">Senior Surgeon</p>
                                    <p class="m-03">Medic care institute</p>
                                    <p class="flexedNoSpace">
                                        <i class="material-icons primaryColor"
                                            >location_on</i
                                        >Ocean View lekki, Lagos, Nigeria
                                    </p>
                                    <p class="flexedNoSpace">
                                        <i class="material-icons primaryColor"
                                            >date_range</i
                                        ><span class="date-range">
                                            20th June 2023 - 28th December
                                            2023</span
                                        >
                                    </p>
                                </div>
                            </div>
                            <div class="col s12 l5 m5 offset-l1 offset-m1">
                                <h5>License</h5>
                                <div class="mb-2">
                                    <p class="flexedNoSpace">
                                        <i class="material-icons primaryColor"
                                            >date_range</i
                                        ><span class="date-range">
                                            20th June 2023</span
                                        >
                                    </p>
                                    <p>I got the license from the board</p>
                                    <p class="flexedNoSpace">
                                        <i class="material-icons primaryColor"
                                            >location_on</i
                                        >Ocean View lekki, Lagos, Nigeria
                                    </p>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div v-show="preview === '0'">
                    <pdf-vuer-component :pdfUrl="pdfUrl"/>
                    <!-- <section class="intro">
                        <div>
                            <h4 class="header">{{ stripTitle }}</h4>
                            <p class="subHeader" v-if="summary !== null">{{ summary.title }}</p>
                        </div>
                        <div>
                            <p class="flexedNoSpace">
                                <i class="material-icons pr-3">phone_locked</i> <span class="fw-500" v-if="contact !== null && contact.phone">{{contact.phone}}</span><span class="fw-500" v-else>-</span>
                            </p>
                            <p class="flexedNoSpace">
                                <i class="material-icons pr-3">contact_mail</i> <span class="fw-500" v-if="contact !== null && contact.email">{{contact.email}}</span><span class="fw-500" v-else>-</span>
                            </p>
                            <p class="flexedNoSpace ">
                                <i class="material-icons pr-3">location_on</i> 
                                <span class="fw-500" v-if="contact !== null && contact.address">{{contact.address}}</span><span class="fw-500" v-else>-</span>
                            </p>
                        </div>
                    </section>
                    
                    <section class="summaryEtEducation">
                        <div class="row">
                            <div class="col s12 l5 m5">
                                <h5>Summary</h5>
                                <p class="summaryTxt" v-if="summary !== null">
                                    {{summary.summary}}
                                </p>
                                <p v-else>-</p>
                            </div>
                            <div class="col s12 l5 m5 offset-l1 offset-m1">
                                <h5>Education</h5>
                                <div class="mb-2" v-if="undergradschool !== null">
                                    <p class="title">Undergraduate</p>
                                    <p class="m-03">{{ undergradschool.major }}</p>
                                    <p class="flexedNoSpace" v-if="undergradschool !== null"><i class="material-icons primaryColor">date_range</i><span class="date-range"> {{ undergradschool.monthStart }}/{{undergradschool.yearStart}} - {{ undergradschool.monthEnd }}/{{undergradschool.yearEnd}}</span></p>
                                </div>
                                <div class="mb-2">
                                    <p class="title">Medical</p>
                                    <div v-if="medschool !== null">
                                        <p class="flexedNoSpace"><i class="material-icons primaryColor">date_range</i><span class="date-range"> {{ medschool.monthStart }}/{{medschool.yearStart}} - {{ medschool.monthEnd }}/{{medschool.yearEnd}}</span></p>
                                    </div>
                                    <div v-else>
                                        <p>-</p>
                                    </div>
                                </div>
                                <div v-if="otherschool !== null">
                                    <p class="title">Other School</p>
                                    <p class="m-03">{{ otherschool.title }}</p>
                                    <p class="flexedNoSpace"><i class="material-icons primaryColor">date_range</i><span class="date-range"> {{ otherschool.monthStart }}/{{otherschool.yearStart}} - {{ otherschool.monthEnd }}/{{otherschool.yearEnd}}</span></p>
                                </div>
                            </div>
                        </div>
                    </section>
                
                    <section>
                        <div class="row">
                            <div class="col s12 l5 m5">
                                <h5>Training</h5>
                                <div :class="{'mb-2': index === 0 | index === 1}" v-for="(training, index) in trainings" :key="training.id">
                                    <p class="title">{{training.type}}</p>
                                    <p class="m-03">{{ training.specialty ?? training.title ?? training.sub_specialty }}</p>
                                    <p class="flexedNoSpace"><i class="material-icons primaryColor">location_on</i>{{ training.location }}</p>
                                    <p class="flexedNoSpace"><i class="material-icons primaryColor">date_range</i><span class="date-range"> {{ training.monthStart }}/{{training.yearStart}} - {{ training.monthEnd }}/{{training.yearEnd}}</span></p>
                                </div>
                                <div v-if="trainings.length === 0">
                                    <p>-</p>
                                </div>
                            </div>
                            <div class="col s12 l5 m5 offset-l1 offset-m1">
                                <h5>Experience</h5>
                                <div :class="{'mb-2':  index === 0 | index === 1}" v-for="(experience, index) in experiences" :key="experience.id">
                                    <p class="title">{{ experience.institution }}</p>
                                    <p class="flexedNoSpace" v-if="experience.state"><i class="material-icons primaryColor">location_on</i>{{ experience.state.name }} / {{ experience.city.name }}</p>
                                    <p class="flexedNoSpace"><i class="material-icons primaryColor">date_range</i><span class="date-range"> {{ experience.monthStart }}/{{experience.yearStart}} - {{experience.yearEnd === null ? 'Present' : experience.monthEnd +'/'+ experience.yearEnd}}</span></p>
                                </div>
                                <div v-if="experiences.length === 0">
                                    <p>-</p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section>
                        <div class="row">
                            <div class="col s12 l5 m5">
                                <h5>Reference</h5>
                                <div :class="{'mb-2': index === 0 | index === 1}" v-for="(referral, index) in referrals" :key="referral.id">
                                    <p class="title">Reference {{ index + 1 }}</p>
                                    <p class="m-03">{{ referral.title }}</p>
                                    <p class="m-03">{{ referral.name }}</p>
                                    <p class="m-03">{{ referral.position }}</p>
                                    <p class="m-03">{{ referral.institution }}</p>
                                    <div class="flexit">
                                        <p class="flexedNoSpace"><i class="material-icons primaryColor">phone_locked</i>{{ referral.phone ?? '-' }}</p>
                                        <p class="flexedNoSpace"><i class="material-icons primaryColor">contact_mail</i><span class="date-range"> {{ referral.email }}</span></p>
                                    </div>
                                </div>
                                <div v-if="referrals.length === 0">
                                    <p>-</p>
                                </div>
                            </div>
                            <div class="col s12 l5 m5 offset-l1 offset-m1">
                                <h5>License</h5>
                                <div class="mb-2" v-if="license !== null">
                                    <p class="flexedNoSpace"><i class="material-icons primaryColor">date_range</i><span class="date-range"> {{ license.year }}</span> </p>
                                    <p>I got the license from the {{ license.type }}</p>
                                    <p class="flexedNoSpace"><i class="material-icons primaryColor">location_on</i>{{ license.location }}</p>
                                </div>
                                <div v-else><p>-</p></div>
                            </div>
                        </div>
                    </section> -->
                </div>
            </div>
            <div class="modal-footer">
                <button class="mb-2 btn waves waves-effect darken-4 text-white circle modal-close">Close</button>
                <button class="mb-2 btn waves waves-effect text-white ter mr-2" @click="download">Download</button>
            </div>
        </div>
    </div>
</template>
<script>
import PdfVuerComponent from '../../partials/PdfVuerComponent.vue';
    export default {
    components: { PdfVuerComponent },
        data() {
            return {
                experiences: [],
                summary: "",
                medschool: {},
                otherschool: {},
                undergradschool: {},
                referrals: [],
                trainings: [],
                license: {},
                pdfUrl: "" // Replace with the actual URL or path of your PDF file
            };
        },
        props: {
            CV: Object,
            contact: Object,
            preview: String,
            user: String,
        },
        computed: {
            stripTitle() {
                return this.user.substring(this.user.indexOf(".") + 1);
            },
        },
        methods: {
            download(){
                let url = `${this.pdfUrl}`;
                window.open(url, '_blank');
                // // console.log(filename)
                // let pdfUrl = this.pdfUrl;
                // filename = hostname.split('.').slice(-2).join('.')+'.pdf';
                // console.log(pdfUrl, hostname)
                // var link = document.createElement('a');
                // link.href = url;
                // link.download = filename;
                // link.target = '_blank';
                // link.style.display = 'none';
                // document.body.appendChild(link);
                // link.click();
                // document.body.removeChild(link);
            }
        },
        watch: {
            CV(newval) {
                this.experiences = newval.experience;
                if (this.experiences.length !== 0) {
                    this.experiences.forEach((el, index) => {
                        axios
                            .get(
                                `https://whitecoatdomain.com/api/getStateNCity/${el.city_id}`
                            )
                            .then((res1) => {
                                this.experiences[index] = {
                                    ...this.experiences[index],
                                    state: res1.data.state,
                                    city: res1.data.city,
                                };
                            })
                            .catch((err) => {
                                console.log(err);
                            });
                    });
                }
                this.summary = newval.summary;
                this.pdfUrl = this.summary != null ? newval.summary.cvfile : '';
                this.medschool = newval.medschool;
                this.otherschool = newval.otherschool;
                this.undergradschool = newval.undergradschool;
                this.referrals = newval.referee;
                this.trainings = newval.trainings;
                this.license = newval.license;
            },
        },
    };
</script>
<style scoped>
.ter {
    background-color: var(--ter);
}
button {
    border-radius: 20px;
    padding: 0 2vw;
}
    .pr-3 {
        padding-right: 1rem;
    }
    .mb-2 {
        margin-bottom: 2rem;
    }
    .mr-2 {
        margin-right: 2vw;
    }
    .m-03 {
        margin: 0.3rem 0;
    }
    .intro {
        margin-bottom: 2.5rem;
    }
    .flexit {
        display: flex;
        justify-content: space-between;
    }
    .material-icons.pr-3 {
        font-size: 20px;
    }
    .modal {
        width: 67%;
    }
    .modal-content {
        font-family: "Montserrat", sans-serif;
    }
    .header {
        font-family: "Montserrat", sans-serif;
        font-style: normal;
        font-weight: 600;
        color: var(--primary);
        margin-bottom: 0;
        text-transform: uppercase;
    }
    .subHeader {
        font-style: normal;
        font-weight: 600;
        margin-top: 0;
    }
    .flexedNoSpace {
        display: flex;
        justify-content: flex-start;
        align-items: center;
        margin: 0.3rem 0;
    }
    .fw-500 {
        font-weight: 500;
        font-size: 0.9rem;
    }
    h5 {
        color: var(--primary);
        border-bottom: 3px solid var(--primary);
        text-transform: uppercase;
        font-family: "Montserrat", sans-serif;
        font-weight: 600;
    }
    div.col {
        padding: 0;
    }
    .summaryTxt {
        font-family: "Poppins";
        font-size: 0.9rem;
        line-height: 1;
        font-weight: 500;
    }
    .row {
        font-size: 0.9rem;
        font-weight: 600;
    }
    .title {
        color: var(--primary);
        font-size: 1.2rem;
        display: block;
        margin-bottom: 0;
        text-transform: capitalize;
    }
    .primaryColor {
        color: var(--primary);
    }
    .material-icons.primaryColor {
        font-size: 15px;
    }
    @media only screen and (min-width: 993px) {
        .row .col.l5 {
            width: 45.6666666667% !important;
            margin-left: auto;
            left: auto;
            right: auto;
        }
        .row .col.offset-l1 {
            margin-left: 8.3333333333% !important;
        }
    }
    @media only screen and (min-width: 601px) {
        .row .col.offset-m1 {
            margin-left: 8.3333333333%;
        }
    }
</style>