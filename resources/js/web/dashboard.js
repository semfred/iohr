require('./../bootstrap');

import 'bootstrap';
import Swal from 'sweetalert2/dist/sweetalert2.js'
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction'; // for selectable

import '@fullcalendar/core/main.css';
import '@fullcalendar/daygrid/main.css';
import 'sweetalert2/src/sweetalert2.scss'

document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');

      var calendar = new Calendar(calendarEl, {
        plugins: [ dayGridPlugin ],
        events: {
            url :   '/web/holidays/calendar/get',
            method  :   'GET',
            success :   function(res) {
                console.log(res);
            },
            failure :   function() {
                alert('There was an error fetching holidays and events!');
            },
        },
        eventClick: function(res) {
            Swal.fire({
                title: res.event.title,
                text: '',
                type: 'info',
                showConfirmButton: false,
              })
        },
      });

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });

      calendar.render();
    });
