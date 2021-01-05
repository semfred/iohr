<template>
<div>
    <b-row>
        <b-col md="2" offset-md="10">
            <b-button variant="success" :to="{ 'name' : 'admin.employees.create' }" block>Add Employee</b-button>
        </b-col>
    </b-row>
    <b-alert
      :show="dismissCountDown"
      dismissible
      :variant="alertVariant"
      @dismissed="dismissCountDown=0"
      fade
    >
        {{ alertContent }}
    </b-alert>
	<b-card-group columns>
		<b-card  v-for="(employee, index) in employees" :index="index" :key="employee.id" v-on:remove="employees.splice(index, 1)">
			<b-card-title>
				{{ employee.fname }} {{ employee.lname }}
			</b-card-title>
			<b-card-text>
				{{ employee.email }}
			</b-card-text>
			<footer>
				<b-row>
                    <b-col class="text-center">
						<b-button block variant="outline-primary" @click="deleteEmployee(employee.id, index)">
							Edit
						</b-button>
					</b-col>
                    <b-col class="text-center">
						<b-button block variant="outline-danger" @click="deleteEmployee(employee.id, index)">
							Remove
						</b-button>
					</b-col>
                </b-row>
			</footer>
		</b-card>
	</b-card-group>
</div>
</template>

<script>
	export default {

		data() {
			return {

				employees: [
						    {
						        "id": 1,
						        "fname": null,
						        "mname": null,
						        "lname": null,
						        "gender": null,
						        "position_id": null,
						        "civil_status": null,
						        "birthday": null,
						        "email": "dev@heliocentrix.co.uk",
						        "contact_no": null,
						        "tin_no": null,
						        "pagibig_no": null,
						        "sss_no": null,
                                "philhealth_no": null,
                                "noDependents": null,
						        "deleted_at": null,
						        "created_at": "2019-03-22 13:46:05",
						        "updated_at": "2019-03-22 13:46:05",
						        "user": {
						            "id": 1,
						            "name": "heliocentrix",
						            "email": "dev@heliocentrix.co.uk",
						            "employee_id": 1,
						            "verified": "2019-03-22 13:46:05",
						            "superuser": 1,
						            "type": "admin",
						            "created_at": "2019-03-22 13:46:05",
						            "updated_at": "2019-03-22 13:46:05",
						            "deleted_at": null
						        },
						        "leave_requests": [],
						        "employment": {
						            "id": 1,
						            "employee_id": 1,
						            "position_id": null,
						            "working_hrs": null,
						            "immediate_mngr": null,
						            "approving_mngr": null,
						            "onboard_date": null,
						            "employed": 1,
						            "offboard_date": null,
						            "created_at": "2019-03-22 13:46:05",
						            "updated_at": "2019-03-22 13:46:05",
						            "deleted_at": null,
						            "salary": [],
						            "position": null,
						            "immediate_manager": null,
						            "approving_manager": null
						        },
						        "entitlement": {
						            "id": 1,
						            "employee_id": 1,
						            "vacation": 5,
						            "sick": 5,
						            "year": "2019",
						            "deleted_at": null
						        }
						    }
                        ],
                        dismissSecs: 3,
                        dismissCountDown: 0,
                        alertVariant: "danger",
                        alertContent: "Something went wrong",

			}
		},
        beforeRouteEnter (to, from, next) {
			next(vm => {
				vm.getEmployees();
			});
        },

		created() {

		},

		mounted() {

		},

		computed: {

		},

        methods: {

            getEmployees() {
                axios
                    .get('/api/employees')
                    .then( req => {
                        this.employees = req.data
						console.log(this.employees);
                    })
                    .catch( error => {
                        console.log('error');
                    });
            },

            deleteEmployee(id, i = 0) {
                console.log(id);
                this.$bvModal.msgBoxConfirm('Please confirm that you want to delete this employee.', {
                    title: '',
                    size: 'md',
                    buttonSize: 'md',
                    okVariant: 'danger',
                    okTitle: 'Remove',
                    cancelTitle: 'Cancel',
                    footerClass: 'p-2',
                    hideHeaderClose: false,
                    centered: true
                })
                .then(value => {
                    axios
                        .delete('/api/employees/' + id)
                        .then( req => {
                            if(req.data) {
                                this.alertContent = req.data.message

                                if(req.data.status) {
                                    this.alertVariant = 'success'
                                    this.$emit('remove');
                                } else {
                                    this.alertVariant = 'danger'
                                }

                                this.dismissCountDown = this.dismissSecs
                            }

                        })
                        .catch( error => {
                            // An error occured
                        });
                })
                .catch(err => {
                    // An error occurred
                })

            },


        }

	}
</script>
