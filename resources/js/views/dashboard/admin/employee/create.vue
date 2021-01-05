<template>
    <div>
        <b-form @submit="onSubmit" @reset="onReset" disabled>
            <b-container fluid>
                <b-row>
                    <b-col md="3">
                        <label>Name <span class="text-danger">*</span></label>
                    </b-col>
                    <b-col md="9">
                        <b-row style="margin:0;">
                            <b-col style="padding-left:0;">
                                <b-form-input
                                    id="fname"
                                    v-model="form.fname"
                                    required
                                    placeholder="First Name">
                                </b-form-input>
                            </b-col>
                            <b-col>
                                <b-form-input
                                    id="mname"
                                    v-model="form.mname"
                                    placeholder="Middle Name">
                                </b-form-input>
                            </b-col>
                            <b-col style="padding-right:0;">
                                <b-form-input
                                    id="lname"
                                    v-model="form.lname"
                                    required
                                    placeholder="Last Name">
                                </b-form-input>
                            </b-col>
                        </b-row>
                    </b-col>
                </b-row>
                <b-row>
                    <b-col md="3">
                        <label for="email">Email <span class="text-danger">*</span></label>
                    </b-col>
                    <b-col md="9">
                        <b-form-input
                            id="email"
                            type="email"
                            v-model="form.email"
                            required
                            placeholder="someone@example.com">
                        </b-form-input>
                    </b-col>
                </b-row>
                <b-row>
                    <b-col md="3">
                        <label for="birthday">Birth date <span class="text-danger">*</span></label>
                    </b-col>
                    <b-col md="9">
                        <b-form-input
                            id="birthday"
                            type="date"
                            v-model="form.birthday"
                            required
                            >
                        </b-form-input>
                    </b-col>
                </b-row>
                <b-row>
                    <b-col md="3">
                        <label for="contact_no">Contact Number <span class="text-danger">*</span></label>
                    </b-col>
                    <b-col md="9">
                        <b-form-input
                            id="contact_no"
                            v-model="form.contact_no"
                            required
                            placeholder="+(000)000-000"
                            :state="contactNoState"
                            >
                        </b-form-input>
                    </b-col>
                </b-row>
                <b-row>
                    <b-col md="3">
                        <label for="">Gender </label>
                    </b-col>
                    <b-col md="9">
                        <b-form-radio-group v-model="form.gender" :options="genderOptions" :state="genderState" name="radio-validation">
                        </b-form-radio-group>
                    </b-col>
                </b-row>
                <b-row>
                    <b-col md="3">
                        <label for="civil_status">Civil Status</label>
                    </b-col>
                    <b-col md="9">
                        <b-form-select
                            id="civil_status"
                            v-model="form.civil_status"
                            :options="civilStatusOptions">
                        </b-form-select>
                    </b-col>
                </b-row>
                <b-row v-if="isSingleParent">
                    <b-col md="3">
                        <label for="noDependents">No. of Dependents</label>
                    </b-col>
                    <b-col md="9">
                        <b-form-input
                            id="noDependents"
                            v-model="form.noDependents"
                            type="number"
                            min="0"
                            step="1"
                            >
                        </b-form-input>
                    </b-col>
                </b-row>
                <b-row>
                    <b-col md="3">
                        <label for="tin_no">TIN No.</label>
                    </b-col>
                    <b-col md="9">
                        <b-form-input
                            id="tin_no"
                            v-model="form.tin_no"
                            placeholder="000-000-000-00000">
                        </b-form-input>
                    </b-col>
                </b-row>
                <b-row>
                    <b-col md="3">
                        <label for="sss_no">SSS No.</label>
                    </b-col>
                    <b-col md="9">
                        <b-form-input
                            id="sss_no"
                            v-model="form.sss_no"
                            placeholder="00-0000000-0">
                        </b-form-input>
                    </b-col>
                </b-row>
                <b-row>
                    <b-col md="3">
                        <label for="philhealth_no">Philhealth No.</label>
                    </b-col>
                    <b-col md="9">
                        <b-form-input
                            id="philhealth_no"
                            v-model="form.philhealth_no"
                            placeholder="00-000000000-0">
                        </b-form-input>
                    </b-col>
                </b-row>
                <b-row>
                    <b-col md="3">
                        <label for="pagibig_no">PAG-IBIG No.</label>
                    </b-col>
                    <b-col md="9">
                        <b-form-input
                            id="pagibig_no"
                            v-model="form.pagibig_no"
                            placeholder="0000-0000-0000">
                        </b-form-input>
                    </b-col>
                </b-row>
                <b-row>
                    <b-col>
                        <b-button
                            type="submit"
                            id="submit"
                            variant="success">
                            Submit
                        </b-button>
                        <b-button
                            type="reset"
                            id="reset"
                            variant="danger">
                            Reset
                        </b-button>
                    </b-col>
                </b-row>
            </b-container>
        </b-form>
    </div>
</template>

<script>
export default {

    data() {
        return {
            errors: {

            },
            form: {
                fname: '',
                mname: '',
                lname: '',
                email: '',
                contact_no: '',
                birthday: '',
                gender: '',
                civil_status: null,
                noDependents: '',
                tin_no: '',
                pagibig_no: '',
                sss_no: '',
                philhealth_no: '',
            },
            genderOptions: [
                { text: 'Male', value: 'male', selected: true },
                { text: 'Female', value: 'female' },
            ],
            civilStatusOptions: [
                { text: ' ', value: null, selected: true },
                { text: 'Single', value: 'single' },
                { text: 'Married', value: 'married' },
                { text: 'Single Parent', value: 'single_parent' },
            ],
        }
    },

    computed: {
      genderState() {
        return Boolean(this.form.gender)
      },

      contactNoState() {
          return (!this.form.contact_no.match(/[a-z]/i) && this.form.contact_no) ? true : false
      },

      tinNoFormat() {
          return (!this.form.contact_no.match(/[a-z]/i) && this.form.tin_no) ? true : false
      },

      pagibigNoFormat() {
          return (!this.form.contact_no.match(/[a-z]/i) && this.form.pagibig_no) ? true : false
      },

      sssNoFormat() {
          return (!this.form.contact_no.match(/[a-z]/i) && this.form.sss_no) ? true : false
      },

      philhealthNoFormat() {
          return (!this.form.contact_no.match(/[a-z]/i) && this.form.philhealth_no) ? true : false
      },

      isSingleParent() {
          return this.form.civil_status !== 'single' && this.form.civil_status !== null
      }
    },

    methods: {
        onSubmit(evt) {
            evt.preventDefault();
            axios.post('/api/employees', this.form)
                 .then(res => {
                     if(res.data.errors) {
                         console.log('error')
                     } else {
                         console.log(res.data);
                     }
                 })
                 .catch( err => {
                     console.log('test');
                     console.log(err);
                 })
        },

        onReset(evt) {
            evt.preventDefault();
            console.log(evt);
        }
    }

}
</script>
