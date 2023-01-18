<template>
    <div>
        <div id="cvModal" class="modal">
            <div class="modal-content">
                <h4>Let us know more about you</h4>
                <div v-if="view == 1">
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
                            <option value="Board">Board</option>
                            <option value="Government">Government</option>
                        </select>
                    </div>
                </div>
                <div v-if="view == 2">
                    <div>
                        <h6>Tell us about your time in Med School</h6>
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
                                    v-model="cvMedSchool.monthEnd"
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
                    <div>
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
                                <label>Browser Select</label>
                                <select
                                    class="browser-default"
                                    v-model="cvGradSchool.major"
                                >
                                    <option value="" disabled selected>
                                        Is this a major
                                    </option>
                                    <option value="Y">Yes</option>
                                    <option value="N">No</option>
                                </select>
                            </div>
                            <div class="col s6">
                                <label>Browser Select</label>
                                <select
                                    class="browser-default"
                                    v-model="cvGradSchool.minor"
                                >
                                    <option value="" disabled selected>
                                        Is this a minor
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
                                    v-model="cvGradSchool.yearStart"
                                />
                            </div>
                            <div class="input-field col s3">
                                <input
                                    type="text"
                                    class="validate"
                                    placeholder="Start(Month)"
                                    v-model="cvGradSchool.monthEnd"
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
                    <div>
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
                                    v-model="cvAdditionalSchool.monthEnd"
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
                </div>
                <div v-if="view == 3">
                    <div>
                        <h6>Tell us about your Experiences</h6>
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
                                <div class="input-field col s12">
                                    <input
                                        placeholder="Institution"
                                        type="text"
                                        class="validate"
                                        v-model="training.institution"
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
                                        v-model="training.monthEnd"
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
                        </div>

                        <small>Have more Trainings </small>
                        <button
                            @click="addMoreTrainings"
                            class="btn btn-small waves waves-effect"
                        >
                            Add More
                        </button>
                    </div>
                </div>
                <div v-if="view == 4">
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
                                        v-model="experience.monthEnd"
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
                            <div class="row">
                                <div class="input-field col s12">
                                    <input
                                        placeholder="Institution"
                                        type="text"
                                        class="validate"
                                        v-model="experience.activities"
                                    />
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
                    </div>
                </div>
                <div v-if="view == 5">
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
                            <div class="input-field col s6">
                                <input
                                    placeholder="Name"
                                    type="text"
                                    class="validate"
                                    v-model="reference.name"
                                />
                            </div>
                            <div class="input-field col s6">
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
                                    placeholder="Location"
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
                </div>
            </div>
            <div class="modal-footer">
                <button
                    @click="saveAndNext"
                    class="waves-effect waves-green btn"
                >
                    Save n Continue
                </button>
                <small>
                    <i class="material-icons">chevron_right</i>
                    {{
                    view == 1 ? "Education" : view == 2 ? "Experience" : view == 3 ? 'Trainings' : 'Reference'
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
                cv: {
                    summary: "",
                    skills: "",
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
                    },
                ],
                cvTrainings: [
                    {
                        institution: "",
                        yearStart: "",
                        yearEnd: "",
                        monthStart: "",
                        monthEnd: "",
                        position: "",
                        location: "",
                        specialty: "",
                        sub_specialty: "",
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

                cvExperienceRemoved: [],
                cvTrainingRemoved: [],
                cvReferencesRemoved: [],
                view: 1,
            };
        },
        methods: {
            addMore() {
                this.cvExperiences.push({
                    institution: "",
                    yearStart: "",
                    yearEnd: "",
                    monthStart: "",
                    monthEnd: "",
                    position: "",
                    location: "",
                    activities: [],
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
                    position: "",
                    location: "",
                });
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
            pushToTrash(e) {
                this.view == 3
                    ? this.cvTrainingRemoved.push(e)
                    : this.view == 5
                    ? this.cvReferencesRemoved.push(e)
                    : this.cvExperienceRemoved.push(e);
            },
            saveAndNext() {
                this.view++;
            },
        },
        watch: {
            cv(newVal, oldVal) {
                console.log(newVal, oldVal)
            }
        },
    };
</script>