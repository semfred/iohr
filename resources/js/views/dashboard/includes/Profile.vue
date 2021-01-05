<template>
  <b-card
    no-body
    class="profile-section"
  >
	    <template slot="header">
	    	<b-img slot="aside" class="rounded-circle" blank blank-color="#ccc" width="120" alt="placeholder"></b-img>
	    	<h2>{{ name }}</h2>
	    </template>


	<b-card-group>

	    <b-card>
			<b-card-title class="text-center">
				<small>Vacation</small>
			</b-card-title>
			<b-card-title class="text-center text-main-red">
				<h2>{{'testtest'}}</h2>
			</b-card-title>
			<b-card-sub-title class="mb-2 text-center">
				<small class="text-muted"><span class="text-main-red">{{'test'}}</span> HOUR(S) USED</small>
			</b-card-sub-title>
			<b-card-sub-title class="mb-2 text-center">
				<small class="text-muted"><span class="text-main-red">{{'test'}}</span> HOUR(S) SCHEDULED</small>
			</b-card-sub-title>
	    </b-card>

	    <b-card>
			<b-card-title tag="small" class="text-center">
				<small>Sick</small>
			</b-card-title>
			<b-card-title class="text-center text-main-red">
				<h2>{{'test'}}</h2>
			</b-card-title>
			<b-card-sub-title class="mb-2 text-center">
				<small class="text-muted"><span class="text-main-red">{{ 'test' }}</span> HOUR(S) USED</small>
			</b-card-sub-title>
			<b-card-sub-title class="mb-2 text-center">
				<small class="text-muted"><span class="text-main-red">{{'test'}}</span> HOUR(S) SCHEDULED</small>
			</b-card-sub-title>
	    </b-card>

	</b-card-group>	

    <b-card-body>
      <b-card-title>Card Title</b-card-title>
      <b-card-sub-title class="mb-2">Card Sub Title</b-card-sub-title>
      <b-card-text>
        Some quick example text to build on the card title and make up the bulk of the card's
        content.
      </b-card-text>
    </b-card-body>

    <b-list-group flush>
      <b-list-group-item>Cras justo odio</b-list-group-item>
      <b-list-group-item>Dapibus ac facilisis in</b-list-group-item>
      <b-list-group-item>Vestibulum at eros</b-list-group-item>
    </b-list-group>

    <b-card-body>
      <a href="#" class="card-link">Card link</a>
      <a href="#" class="card-link">Another link</a>
    </b-card-body>

    <b-card-footer>This is a footer</b-card-footer>

    <b-card-img src="https://placekitten.com/480/210" alt="Image" bottom></b-card-img>
  </b-card>
</template>

<script>
	import { mapGetters } from 'vuex'

	export default {
		
		created() {

			this.emp = JSON.parse(localStorage.getItem('employee'));
			console.log(this.emp);
			console.log(this.employee);

		},

		data() {
			return {
				emp: {},
			}
		},

		computed: {
			...mapGetters([
				'loggedEmployee',
			]),

			name() {
				return this.emp.employee.fname + ' ' + this.emp.employee.lname;
			}
		},

	}

</script>