<template>
	<div>
		<b-row>
			<b-col>
				<h1 class="text-white"><i class="fas fa-home"></i> HOME</h1>
			</b-col>
		</b-row>
		<!-- IMPORTANT NOTICE -->
		<!-- <div class="row">
			<div class="col-md-12">
				<notice></notice>
			</div>
		</div> -->
		<!-- END IMPORTANT NOTICE -->

		<b-row>

			<b-col md="2">
					<profile></profile>
			</b-col>
			<b-col md="10">
				<b-card>
					<calendar :selectable="true" :initEvents="events"></calendar>
				</b-card>
			</b-col>

		</b-row>


	</div>
</template>

<script>

	import Calendar from './includes/Calendar'
	import Notice from './includes/Notice'
	import Profile from './includes/Profile'

	export default {

		beforeCreate() {
			
		},

		beforeRouteEnter (to, from, next) {
			next(vm => {
				vm.getHolidays();
			});
		},

		created() {
			
		},

		mounted() {

		},

		data() {
			return {
				events: [],
			}
		},

		computed: {

		},

		components: {
			Calendar, Notice, Profile
		},

		methods: {

			getHolidays () {
				let arr = [];
				axios
					.get('/api/holidays')
					.then(response => {
						console.log(response.data);
						response.data.forEach(function(val) {
					  		arr.push({

					  			title	: val.name + " (" + val.type + ")",
					  			start 	: val.observance,
					  			backgroundColor	: val.country == 'ph' ? 'blue' : 'red',
					  			borderColor	: val.country == 'ph' ? 'blue' : 'red',
					  			textColor: 'white',
					  			allDay	: true,
					  			
					  		});
						});
						this.events = arr;
					})
					.catch((error) => {
						console.log(error);
					})
			}

		}

	}

</script>