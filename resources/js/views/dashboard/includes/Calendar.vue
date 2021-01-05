<template>
	<FullCalendar @eventClick="eventClick" @select="selectDates" @dateClick="handleDateClick" defaultView="dayGridMonth" :selectable="selectable" :plugins="calendarPlugins" :events="initEvents" />
</template>

<script>

	import FullCalendar from '@fullcalendar/vue'
	import dayGridPlugin from '@fullcalendar/daygrid'
	import interactionPlugin from '@fullcalendar/interaction'
	import moment from 'moment';

	export default {

		props: {
			initEvents: Array,
			selectable: Boolean,
		},

		components: {
			FullCalendar
		},

		mounted() {
			
		},

		data() {
			return {
				calendarPlugins: [ dayGridPlugin, interactionPlugin ]
			}
		},

		computed: {
			
		},

		methods: {
		  handleDateClick(arg) {
		    console.log(arg.date)
		  },

		  eventClick(info) {
		  	console.log(info);
		  },

		  selectDates( info ) {
		  	console.log(moment());
		  }

		},

	}

</script>