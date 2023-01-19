<template>
    <div>
        <div id="cvModal" class="modal">
            <div class="modal-content">
                <h4>Let us know more about you</h4>
                <div v-show="view == 1">
                    <textarea
                        placeholder="Summary"
                        id=""
                        cols="30"
                        rows="10"
                        v-model="cv.summary"
                    ></textarea>
                    <div id="skills">
                        <div
                            class="chips chips-placeholder"
                            limit="6"
                            secondaryPlaceholder="+Tag"
                            placeholder="Enter a tag"
                        >
                            <input class="custom-class" v-model="cv.skills" />
                        </div>
                    </div>
                    <div class="input-field col s12">
                        <select v-model="cv.license">
                            <option value="" disabled selected>
                                Choose how you got your license
                            </option>
                            <option value="board">Board</option>
                            <option value="government">Government</option>
                        </select>
                    </div>
                    <div>   
                        <button
                            @click.prevent="saveCV"
                            class="waves-effect waves-green btn"
                            v-if="!loading"
                        >
                            Save
                        </button>
                        <button  v-if="loading" class="btn">
                            <div class="preloader-wrapper small active">
                                <div
                                    class="spinner-layer spinner-white-only"
                                >
                                    <div class="circle-clipper left">
                                        <div class="circle"></div>
                                    </div>
                                    <div class="gap-patch">
                                        <div class="circle"></div>
                                    </div>
                                    <div class="circle-clipper right">
                                        <div class="circle"></div>
                                    </div>
                                </div>
                            </div>
                        </button>
                    </div>
                </div>
                <div v-show="view == 2">
                    <div v-if="edu == 0">
                        <h6>Tell us about your time in Med School <small>Important so that patients can view your site</small></h6>
                        <div class="row">
                            <div class="input-field col s8">
                                <input
                                    placeholder="Institution"
                                    type="text"
                                    class="validate"
                                    v-model="cvMedSchool.institution"
                                />
                            </div>
                            <div class="col s4">
                                <label>Browser Select</label>
                                <select
                                    class="browser-default"
                                    v-model="cvMedSchool.type"
                                >
                                    <option value="" disabled selected>
                                        Choose your degree
                                    </option>
                                    <option value="MD">MD</option>
                                    <option value="DO">DO</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s3">
                                <input
                                    placeholder="Start(Year)"
                                    type="text"
                                    class="validate"
                                    v-model="cvMedSchool.yearStart"
                                />
                            </div>
                            <div class="input-field col s3">
                                <input
                                    type="text"
                                    class="validate"
                                    placeholder="Start(Month)"
                                    v-model="cvMedSchool.monthStart"
                                />
                            </div>
                            <div class="input-field col s3">
                                <input
                                    placeholder="End(Year)"
                                    type="text"
                                    class="validate"
                                    v-model="cvMedSchool.yearEnd"
                                />
                            </div>
                            <div class="input-field col s3">
                                <input
                                    type="text"
                                    class="validate"
                                    placeholder="End(Month)"
                                    v-model="cvMedSchool.monthEnd"
                                />
                            </div>
                        </div>
                    </div>
                    <div v-if="edu == 1">
                        <h6>Tell us about your time in Undergrad School</h6>
                        <div class="row">
                            <div class="input-field col s12">
                                <input
                                    placeholder="Institution"
                                    type="text"
                                    class="validate"
                                    v-model="cvGradSchool.institution"
                                />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s6">
                                <input
                                    placeholder=" Major"
                                    type="text"
                                    class="validate"
                                    v-model="cvGradSchool.major"
                                />
                            </div>
                            <div class="col s6">
                                <input
                                    placeholder=" Minor"
                                    type="text"
                                    class="validate"
                                    v-model="cvGradSchool.minor"
                                />
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s3">
                                <input
                                    placeholder="Start(Year)"
                                    type="text"
                                    class="validate"
                                    v-model="cvGradSchool.yearStart"
                                />
                            </div>
                            <div class="input-field col s3">
                                <input
                                    type="text"
                                    class="validate"
                                    placeholder="Start(Month)"
                                    v-model="cvGradSchool.monthStart"
                                />
                            </div>
                            <div class="input-field col s3">
                                <input
                                    placeholder="End(Year)"
                                    type="text"
                                    class="validate"
                                    v-model="cvGradSchool.yearEnd"
                                />
                            </div>
                            <div class="input-field col s3">
                                <input
                                    type="text"
                                    class="validate"
                                    placeholder="End(Month)"
                                    v-model="cvGradSchool.monthEnd"
                                />
                            </div>
                        </div>
                    </div>
                    <div v-if="edu == 2">
                        <h6>
                            Any other school you attended, you want to add ?
                            <small>Optional</small>
                        </h6>
                        <div class="row">
                            <div class="input-field col s12">
                                <input
                                    placeholder="Institution"
                                    type="text"
                                    class="validate"
                                    v-model="cvAdditionalSchool.institution"
                                />
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s8">
                                <input
                                    placeholder="Title"
                                    id="first_name"
                                    type="text"
                                    class="validate"
                                    v-model="cvAdditionalSchool.title"
                                />
                            </div>
                            <div class="input-field col s4">
                                <input
                                    placeholder="Degree"
                                    type="text"
                                    class="validate"
                                    v-model="cvAdditionalSchool.degree"
                                />
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s3">
                                <input
                                    placeholder="Start(Year)"
                                    type="text"
                                    class="validate"
                                    v-model="cvAdditionalSchool.yearStart"
                                />
                            </div>
                            <div class="input-field col s3">
                                <input
                                    type="text"
                                    class="validate"
                                    placeholder="Start(Month)"
                                    v-model="cvAdditionalSchool.monthStart"
                                />
                            </div>
                            <div class="input-field col s3">
                                <input
                                    placeholder="End(Year)"
                                    type="text"
                                    class="validate"
                                    v-model="cvAdditionalSchool.yearEnd"
                                />
                            </div>
                            <div class="input-field col s3">
                                <input
                                    type="text"
                                    class="validate"
                                    placeholder="End(Month)"
                                    v-model="cvAdditionalSchool.monthEnd"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <button v-if="!loading" class="btn waves waves-effect" @click.prevent="saveEdu">Save</button>
                        <button  v-if="loading" class="btn">
                            <div class="preloader-wrapper small active">
                                <div
                                    class="spinner-layer spinner-white-only"
                                >
                                    <div class="circle-clipper left">
                                        <div class="circle"></div>
                                    </div>
                                    <div class="gap-patch">
                                        <div class="circle"></div>
                                    </div>
                                    <div class="circle-clipper right">
                                        <div class="circle"></div>
                                    </div>
                                </div>
                            </div>
                        </button>
                        <a href="#!" class="btn-flat right" @click="edu != 2 ? edu ++ : null" title="skip to next">
                            <i class="material-icons">chevron_right</i>
                        </a>
                        <a href="#!" class="btn-flat right" @click="edu != 0 ? edu -- : null">
                            <i class="material-icons">chevron_left</i>
                        </a>
                    </div>
                </div>
                <div v-show="view == 3">
                    <div>
                        <h6>Tell us about your Trainings</h6>
                        <div
                            v-for="(training, index) in cvTrainings"
                            :key="index"
                        >
                            <p>
                                Trainings {{ index + 1 }}
                                <i
                                    @click="
                                        removeTraining(index),
                                            pushToTrash(training)
                                    "
                                    v-show="index != 0"
                                    class="material-icons cursor right"
                                    id="bioAddBtn"
                                >
                                    cancel
                                </i>
                            </p>

                            <div class="row">
                                <div class="input-field col s8">
                                    <input
                                        placeholder="Institution"
                                        type="text"
                                        class="validate"
                                        v-model="training.institution"
                                    />
                                </div>
                                <div class="input-field col s4">
                                    <input
                                        placeholder="Location"
                                        type="text"
                                        class="validate"
                                        v-model="training.location"
                                    />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s6">
                                    <label>Browser Select</label>
                                    <select
                                        class="browser-default"
                                        v-model="training.specialty"
                                    >
                                        <option value="" disabled selected>
                                            Is this a specialty
                                        </option>
                                        <option value="Y">Yes</option>
                                        <option value="N">No</option>
                                    </select>
                                </div>
                                <div class="col s6">
                                    <label>Browser Select</label>
                                    <select
                                        class="browser-default"
                                        v-model="training.sub_specialty"
                                    >
                                        <option value="" disabled selected>
                                            Is this a subspecialty
                                        </option>
                                        <option value="Y">Yes</option>
                                        <option value="N">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s3">
                                    <input
                                        placeholder="Start(Year)"
                                        type="text"
                                        class="validate"
                                        v-model="training.yearStart"
                                    />
                                </div>
                                <div class="input-field col s3">
                                    <input
                                        type="text"
                                        class="validate"
                                        placeholder="Start(Month)"
                                        v-model="training.monthStart"
                                    />
                                </div>
                                <div class="input-field col s3">
                                    <input
                                        placeholder="End(Year)"
                                        type="text"
                                        class="validate"
                                        v-model="training.yearEnd"
                                    />
                                </div>
                                <div class="input-field col s3">
                                    <input
                                        type="text"
                                        class="validate"
                                        placeholder="End(Month)"
                                        v-model="training.monthEnd"
                                    />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s6">
                                    <label>Browser Select</label>
                                    <select
                                        class="browser-default"
                                        v-model="training.type"
                                        required
                                    >
                                        <option value="" disabled selected>
                                            Training type
                                        </option>
                                        <option value="Internship">Internship</option>
                                        <option value="Fellowship">Fellowship</option>
                                        <option value="Residency">Residency</option>
                                    </select>
                                </div>
                                <div class="col s6">
                                    <input
                                        type="text"
                                        class="validate"
                                        placeholder="Position during your training"
                                        v-model="training.title"
                                    />
                                </div>
                                
                            </div>
                        </div>

                        <small>Have more Trainings </small>
                        <button
                            @click="addMoreTrainings"
                            class="btn btn-small waves waves-effect"
                        >
                            Add More
                        </button>
                        <div>   
                            <button
                                @click.prevent="saveTraining"
                                class="waves-effect waves-green btn"
                                v-if="!loading"
                            >
                                Save
                            </button>
                            <button  v-if="loading" class="btn">
                            <div class="preloader-wrapper small active">
                                <div
                                    class="spinner-layer spinner-white-only"
                                >
                                    <div class="circle-clipper left">
                                        <div class="circle"></div>
                                    </div>
                                    <div class="gap-patch">
                                        <div class="circle"></div>
                                    </div>
                                    <div class="circle-clipper right">
                                        <div class="circle"></div>
                                    </div>
                                </div>
                            </div>
                        </button>
                        </div>
                    </div>
                </div>
                <div v-show="view == 4">
                    <div>
                        <h6>Tell us about your Experiences</h6>
                        <div
                            v-for="(experience, index) in cvExperiences"
                            :key="index"
                        >
                            <p>
                                Experience {{ index + 1 }}
                                <i
                                    @click="
                                        remove(index), pushToTrash(experience)
                                    "
                                    v-show="index != 0"
                                    class="material-icons cursor right"
                                    id="bioAddBtn"
                                >
                                    cancel
                                </i>
                            </p>

                            <div class="row">
                                <div class="input-field col s12">
                                    <input
                                        placeholder="Institution"
                                        type="text"
                                        class="validate"
                                        v-model="experience.institution"
                                    />
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s8">
                                    <input
                                        placeholder="Position you held"
                                        type="text"
                                        class="validate"
                                        v-model="experience.position"
                                    />
                                </div>
                                <div class="input-field col s4">
                                    <input
                                        placeholder="Location"
                                        type="text"
                                        class="validate"
                                        v-model="experience.location"
                                    />
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s3">
                                    <input
                                        placeholder="Start(Year)"
                                        type="text"
                                        class="validate"
                                        v-model="experience.yearStart"
                                    />
                                </div>
                                <div class="input-field col s3">
                                    <input
                                        type="text"
                                        class="validate"
                                        placeholder="Start(Month)"
                                        v-model="experience.monthStart"
                                    />
                                </div>
                                <div class="input-field col s3">
                                    <input
                                        placeholder="End(Year)"
                                        type="text"
                                        class="validate"
                                        v-model="experience.yearEnd"
                                    />
                                </div>
                                <div class="input-field col s3">
                                    <input
                                        type="text"
                                        class="validate"
                                        placeholder="End(Month)"
                                        v-model="experience.monthEnd"
                                    />
                                </div>
                            </div>
                            <div class="row" v-for="(input, indexact) in experience.activities" :key="indexact">
                                <div class="input-field col s10">
                                    <input
                                        placeholder="Responsibilities"
                                        type="text"
                                        class="validate"
                                        v-model="input.activity"
                                    />
                                </div>
                                <div class="col s2">
                                    <i
                                        @click="
                                            addMoreActitvity(index)
                                        "
                                        class="material-icons cursor right"
                                        id="bioAddBtn"
                                    >
                                        add
                                    </i>

                                    <i
                                        @click="
                                            removeActivity(index, indexact), activityToTrash(input)
                                        "
                                        v-show="indexact != 0"
                                        class="material-icons cursor right"
                                        id="bioAddBtn"
                                    >
                                        cancel
                                    </i>

                                </div>
                            </div>
                        </div>

                        <small>Have more experinces </small>
                        <button
                            @click="addMore"
                            class="btn btn-small waves waves-effect"
                        >
                            Add More
                        </button>
                        <div>   
                            <button
                                @click.prevent="saveExperience"
                                class="waves-effect waves-green btn"
                                v-if="!loading"
                            >
                                Save
                            </button>
                            <button  v-if="loading" class="btn">
                            <div class="preloader-wrapper small active">
                                <div
                                    class="spinner-layer spinner-white-only"
                                >
                                    <div class="circle-clipper left">
                                        <div class="circle"></div>
                                    </div>
                                    <div class="gap-patch">
                                        <div class="circle"></div>
                                    </div>
                                    <div class="circle-clipper right">
                                        <div class="circle"></div>
                                    </div>
                                </div>
                            </div>
                        </button>
                        </div>
                    </div>
                </div>
                <div v-show="view == 5">
                    <div
                        v-for="(reference, index) in cvReferences"
                        :key="index"
                    >
                        <p>
                            Reference {{ index + 1 }}
                            <i
                                @click="
                                    removeReference(index),
                                        pushToTrash(training)
                                "
                                v-show="index != 0"
                                class="material-icons cursor right"
                                id="bioAddBtn"
                            >
                                cancel
                            </i>
                        </p>
                        <div class="row">
                            <div class="input-field col s2">
                                <input
                                    placeholder="Dr."
                                    type="text"
                                    class="validate"
                                    v-model="reference.title"
                                />
                            </div>
                            <div class="input-field col s5">
                                <input
                                    placeholder="Name"
                                    type="text"
                                    class="validate"
                                    v-model="reference.name"
                                />
                            </div>
                            <div class="input-field col s5">
                                <input
                                    placeholder="Position"
                                    type="text"
                                    class="validate"
                                    v-model="reference.position"
                                />
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input
                                    placeholder="Harvard University, England"
                                    type="text"
                                    class="validate"
                                    v-model="reference.location"
                                />
                            </div>
                            <div class="input-field col s6">
                                <input
                                    placeholder="Phone"
                                    type="text"
                                    class="validate"
                                    v-model="reference.phone"
                                />
                            </div>
                        </div>
                    </div>
                    <small>Have more Referreal </small>
                    <button
                        @click="addMoreReferences"
                        class="btn btn-small waves waves-effect"
                    >
                        Add More
                    </button>
                    <div>   
                        <button
                            @click.prevent="saveReference"
                            class="waves-effect waves-green btn"
                            v-if="!loading"
                        >
                            Save
                        </button>
                        <button  v-if="loading" class="btn">
                            <div class="preloader-wrapper small active">
                                <div
                                    class="spinner-layer spinner-white-only"
                                >
                                    <div class="circle-clipper left">
                                        <div class="circle"></div>
                                    </div>
                                    <div class="gap-patch">
                                        <div class="circle"></div>
                                    </div>
                                    <div class="circle-clipper right">
                                        <div class="circle"></div>
                                    </div>
                                </div>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- <small>
                    {{
                    view == 0 ? null : view == 1 ? "Education" : view == 3 ? "Experience" : view == 4 ? 'Trainings' : view == 0 ? null : 'Reference'
                }}</small> -->
                <button
                    @click="previous"
                    class="waves-effect waves-green btn"
                >
                    Prev
                </button>
                <button
                    @click="saveAndNext"
                    v-if="view != 5"
                    class="waves-effect waves-green btn"
                >
                    Next
                </button>
                <small>
                    {{
                    view == 1 ? "Education" : view == 2 ? "Trainings" : view == 3 ? 'Experience' : 'Reference'
                }}</small>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name: "CvModal",
        mounted() {
            // var data = $('#skills').material_chip('data')
            setTimeout(() => {
                let elem = document.getElementById("skills").getElementsByClassName('chips');
                
                var instance = M.Chips.getInstance(elem);
            //     instance.onChipAdd: (event, chip) => {
            // console.log(event[0].M_Chips.chipsData);
                // console.log( instance)
            }, 5000);
        },
        data() {
            return {
                activities: [],
                activity: "",
                cv: {
                    summary: "",
                    skills: [],
                    license: "",
                },
                cvMedSchool: {
                    institution: "",
                    yearStart: "",
                    yearEnd: "",
                    monthStart: "",
                    monthEnd: "",
                    type: "",
                },
                cvGradSchool: {
                    institution: "",
                    yearStart: "",
                    yearEnd: "",
                    monthStart: "",
                    monthEnd: "",
                    major: "",
                    minor: "",
                },
                cvAdditionalSchool: {
                    institution: "",
                    yearStart: "",
                    yearEnd: "",
                    monthStart: "",
                    monthEnd: "",
                    title: "",
                    degree: "",
                },
                cvExperiences: [
                    {
                        institution: "",
                        yearStart: "",
                        yearEnd: "",
                        monthStart: "",
                        monthEnd: "",
                        position: "",
                        location: "",
                        activities: [
                            {activity: ""}
                        ]
                    },
                ],
                cvTrainings: [
                    {
                        institution: "",
                        yearStart: "",
                        yearEnd: "",
                        monthStart: "",
                        monthEnd: "",
                        title: "",
                        location: "",
                        specialty: "",
                        sub_specialty: "",
                        type: "",
                    },
                ],

                cvReferences: [
                    {
                        name: "",
                        location: "",
                        phone: "",
                        position: "",
                    },
                ],
                cvExperienceUpdate: 0,
                cvExperienceActivityRemoved: [],
                cvExperienceRemoved: [],
                cvTrainingRemoved: [],
                cvTrainingUpdate: 0,
                cvReferencesRemoved: [],
                edu: 0,
                loading: false,
                view: 1,
            };
        },
        methods: {
            addMoreActitvity(e) {
                this.cvExperiences[e].activities.push({activity: ""})
            },
            addMore() {
                this.cvExperiences.push({
                    institution: "",
                    yearStart: "",
                    yearEnd: "",
                    monthStart: "",
                    monthEnd: "",
                    position: "",
                    location: "",
                    activities: [
                        {activity: ""}
                    ]
                });
            },
            addMoreReferences() {
                this.cvReferences.push({
                    name: "",
                    location: "",
                    phone: "",
                    position: "",
                });
            },
            addMoreTrainings() {
                this.cvTrainings.push({
                    institution: "",
                    yearStart: "",
                    yearEnd: "",
                    monthStart: "",
                    monthEnd: "",
                    title: "",
                    location: "",
                    type: "",
                });
            },
            removeActivity(e, index) {
                this.cvExperiences[e].activities.splice(index, 1);
            },
            removeTraining(index) {
                this.cvTrainings.splice(index, 1);
            },
            removeReference(index) {
                this.cvReferences.splice(index, 1);
            },
            remove(index) {
                this.cvExperiences.splice(index, 1);
            },
            previous(){
                this.view != 1 ? this.view-- : null;
            },
            pushToTrash(e) {
                this.view == 3
                    ? this.cvTrainingRemoved.push(e)
                    : this.view == 5
                    ? this.cvReferencesRemoved.push(e)
                    : this.cvExperienceRemoved.push(e);
            },
            activityToTrash(e) {
                this.cvExperienceActivityRemoved.push(e)
            },
            saveAndNext() {
                this.view != 5 ? this.view++ : null;
            },
            saveCV() {
                this.loading = !this.loading;
                let formData = new FormData();
                let request = `/api/cv`;
                if (this.cv.update == 1) {
                    formData.append("_method", "PUT");
                    request = `/api/cv/${this.cv.id}`;
                }
                formData.append("skills", JSON.stringify(this.cv.skills));
                formData.append("summary", this.cv.summary);
                formData.append("license", this.cv.license);
                axios
                    .post(request, formData)
                    .then((res) => {
                        if (res.status == 201 || res.data.status == 200) {
                            this.loading = !this.loading;
                            M.toast({
                                html: res.data.message,
                                classes: "successNotifier",
                            });
                        }
                    })
                    .catch((err) => {
                        if (err.response.status == 400) {
                            this.loading = !this.loading;
                            err.response.data.forEach((el) => {
                                M.toast({
                                    html: el,
                                    classes: "errorNotifier",
                                });
                            });
                        }
                    });
            },
            saveEdu () {
                if (this.edu == 0){
                    this.saveMedSchool();
                }
                else if (this.edu == 1){
                    this.saveUnderGradSchool();
                }
                else if (this.edu == 2){
                    this.saveOtherSchool();
                }
            },
            saveExperience() {
                this.loading = !this.loading;
                this.cvExperiences.forEach(el => JSON.stringify(el.activities));

                let formData = new FormData();
                let request = `/api/cvexperience`;
                if (this.cvExperienceUpdate == 1) {
                    formData.append("_method", "PUT");
                    request = `/api/cvexperience/${this.cvExperiences[0].id}`;
                }
                formData.append("data", JSON.stringify(this.cvExperiences));
                axios
                    .post(request, formData)
                    .then((res) => {
                        if (res.status == 201 || res.data.status == 200) {
                            this.loading = !this.loading;
                            M.toast({
                                html: res.data.message,
                                classes: "successNotifier",
                            });
                        }
                    })
                    .catch((err) => {
                        if (err.response.status == 400) {
                            this.loading = !this.loading;
                            err.response.data.forEach((el) => {
                                M.toast({
                                    html: el,
                                    classes: "errorNotifier",
                                });
                            });
                        }
                    });
            },
            saveMedSchool() {
                this.loading = !this.loading;
                let request = `/api/cvmed_school`;
                let data = {
                    _method: "PUT",
                };
                if (this.cvMedSchool.update == 1) {
                    request = `/api/cvmed_school/${this.cvMedSchool.id}`;
                    this.cvMedSchool = { ...this.cvMedSchool, ...data };
                }
                axios
                    .post(request, this.cvMedSchool)
                    .then((res) => {
                        if (res.status == 201 || res.data.status == 200) {
                            this.loading = !this.loading;
                            M.toast({
                                html: res.data.message,
                                classes: "successNotifier",
                            });
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
            saveOtherSchool() {
                this.loading = !this.loading;
                let request = `/api/cv_otherschool`;
                let data = {
                    _method: "PUT",
                };
                if (this.cvAdditionalSchool.update == 1) {
                    request = `/api/cv_otherschool/${this.cvAdditionalSchool.id}`;
                    this.cvAdditionalSchool = { ...this.cvAdditionalSchool, ...data };
                }
                axios
                    .post(request, this.cvAdditionalSchool)
                    .then((res) => {
                        if (res.status == 201 || res.data.status == 200) {
                            this.loading = !this.loading;
                            M.toast({
                                html: res.data.message,
                                classes: "successNotifier",
                            });
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
            saveReference() {
                this.loading = !this.loading;

                let formData = new FormData();
                let request = `/api/cvreferral`;
                if (this.cvReferenceUpdate == 1) {
                    formData.append("_method", "PUT");
                    request = `/api/cvreferral/${this.cvReferences[0].id}`;
                }
                formData.append("data", JSON.stringify(this.cvReferences));
                axios
                    .post(request, formData)
                    .then((res) => {
                        if (res.status == 201 || res.data.status == 200) {
                            this.loading = !this.loading;
                            M.toast({
                                html: res.data.message,
                                classes: "successNotifier",
                            });
                        }
                    })
                    .catch((err) => {
                        if (err.response.status == 400) {
                            this.loading = !this.loading;
                            err.response.data.forEach((el) => {
                                M.toast({
                                    html: el,
                                    classes: "errorNotifier",
                                });
                            });
                        }
                    });
            },
            saveTraining() {
                this.loading = !this.loading;

                let formData = new FormData();
                let request = `/api/cvtraining`;
                if (this.cvTrainingUpdate == 1) {
                    formData.append("_method", "PUT");
                    request = `/api/cvtraining/${this.cvTrainings[0].id}`;
                }
                formData.append("data", JSON.stringify(this.cvTrainings));
                axios
                    .post(request, formData)
                    .then((res) => {
                        if (res.status == 201 || res.data.status == 200) {
                            this.loading = !this.loading;
                            M.toast({
                                html: res.data.message,
                                classes: "successNotifier",
                            });
                        }
                    })
                    .catch((err) => {
                        if (err.response.status == 400) {
                            this.loading = !this.loading;
                            err.response.data.forEach((el) => {
                                M.toast({
                                    html: el,
                                    classes: "errorNotifier",
                                });
                            });
                        }
                    });
            },
            saveUnderGradSchool() {
                this.loading = !this.loading;
                let request = `/api/cv_gradschool`;
                let data = {
                    _method: "PUT",
                };
                if (this.cvGradSchool.update == 1) {
                    request = `/api/cv_gradschool/${this.cvGradSchool.id}`;
                    this.cvGradSchool = { ...this.cvGradSchool, ...data };
                }
                axios
                    .post(request, this.cvGradSchool)
                    .then((res) => {
                        if (res.status == 201 || res.data.status == 200) {
                            this.loading = !this.loading;
                            M.toast({
                                html: res.data.message,
                                classes: "successNotifier",
                            });
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
        },
        watch: {
            cv(newVal, oldVal) {
                console.log(newVal, oldVal)
            }
        },
    };
</script>