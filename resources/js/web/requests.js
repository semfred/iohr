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
    $("input[type=file]").change(function () {

        var fieldVal = $(this).val();
        // Change the node's value by removing the fake path (Chrome)
        fieldVal = fieldVal.replace("C:\\fakepath\\", "");
        if (fieldVal != undefined || fieldVal != "") {
          $(this).next(".custom-file-label").html(fieldVal);
        }

      });

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });

    Date.prototype.addDays = function(days) {
        var dat = new Date(this.valueOf())
        dat.setDate(dat.getDate() + days);
        return dat;
    }

    function getDates(startDate, stopDate) {
       var dateArray = new Array();
       var currentDate = startDate;
       while (currentDate <= stopDate) {
         dateArray.push(currentDate)
         currentDate = currentDate.addDays(1);
       }
       return dateArray;
     }

     function formatDate(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;

        return [year, month, day].join('-');
    }

      var leaveCalendarEl = document.getElementById('leaveCalendar');

      var startInputEl = $('#startDate');
      var returnInputEl = $('#toDate');

      var leaveCalendar = new Calendar(leaveCalendarEl, {
        plugins: [ interactionPlugin, dayGridPlugin ],
        selectable: true,
        selectHelper: true,
        selectMinDistance: 2,
        select: function(start, end, allday) {
            // var dateArray = getDates(new Date(start.startStr), new Date(start.endStr));
            startInputEl.val('');
            returnInputEl.val('');
            console.log(start);

            var dates = [];
            var startdate = new Date(start.startStr);
            var enddate = new Date(start.endStr);

            dates.push(startdate);
            dates.push(enddate.setDate(enddate.getDate() - 1));

            console.log(dates);

            startInputEl.val(formatDate(new Date(Math.min.apply(null,dates))));
            returnInputEl.val(formatDate(new Date(Math.max.apply(null,dates))));

        },
        fullDay: false,
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
      console.log(leaveCalendar);

      leaveCalendar.render();
    });
