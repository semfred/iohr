require('./../bootstrap');

import 'bootstrap';
import Swal from 'sweetalert2/dist/sweetalert2.js'

import 'sweetalert2/src/sweetalert2.scss'

document.addEventListener('DOMContentLoaded', function() {


const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });



  $('.daterangepicker').daterangepicker();

  $('.btn-delete').each(function(){
      $(this).on('click', function(){
          Swal.fire({
              title: 'Are you sure?',
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if(result.value) {
                  $('#'+$(this).data('id')).submit();
              }
            })
      });
  });

  $('.cancel-leave').each(function(){
    $(this).on('click', function(){
        Swal.fire({
            title: 'Are you sure?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, cancel leave!'
          }).then((result) => {
            if(result.value) {
                $('#'+$(this).data('id')).submit();
            }
          })
    });
});

  $('#timePicker').daterangepicker({
      timePicker: true,
      timePickerIncrement: 1,
      locale: {
          format: 'HH:mm'
      }
  }).on('show.daterangepicker', function (ev, picker) {
      picker.container.find(".calendar-table").hide();
  });

  // ADD FILENAME TO FILE INPUT WHEN CHANGED
  $("input[type=file]").change(function () {

      var fieldVal = $(this).val();
      // Change the node's value by removing the fake path (Chrome)
      fieldVal = fieldVal.replace("C:\\fakepath\\", "");
      if (fieldVal != undefined || fieldVal != "") {
        $(this).next(".custom-file-label").html(fieldVal);
      }

    });

    $('.btn-leave-details').on('click', function(e){
      e.preventDefault();
      Swal.fire({

      })
    });

    $('.btn-submit').on('click', function(e){
      e.preventDefault();
      Swal.fire({
          title: 'Are you sure?',
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ok'
        }).then((result) => {
          if(result.value) {
              this.form.submit();
          }
        })
    })

    function getStatus(status) {

      var stat;

      switch(status) {
          case 'Approved':
              stat = 'success';
              break;
          case 'Pending':
              stat = 'question';
              break;
          case 'Canceled':
              stat = 'warning';
              break;
          case 'Declined':
              stat = 'error';
              break;
      }

      return stat;
    }


    $('.list-item-leave-request').on('click', function(e){
      e.preventDefault();
      if($(this).data('statusnote') !== '') {
          var status_note = $(this).data('statusnote')
      } else {
          var status_note = 'No note added'
      }

      var html = '';

      if($(this).data('statusnote') !== '') {
          html += '<em>Note by Approving Manager:<br>' + $(this).data('statusnote') + '</em>';
      }
      html += '<h3 style="margin: 20px 0">' + $(this).data('fromdate') + ' - ' + $(this).data('todate') + '</h3>';
      html += '<p>' + $(this).data('note') + '</p>';

      Swal.fire({
          title: $(this).data('status') + ' ' + $(this).data('type'),
          html: html,
          type: getStatus($(this).data('status')),
          showConfirmButton: false,
      })
    });

    $('.leave-stat').on('click', function(e) {
        e.preventDefault();
        if($(this).data('statusnote')) {
            var status_note = $(this).data('statusnote')
        } else {
            var status_note = 'No note added'
        }

        var html = '';
        if($(this).data('statusnote') !== '') {
            html = '<em>Note by Approving Manager:<br>' + $(this).data('statusnote') + '</em>';
        }
        Swal.fire({
            title: 'Reviewed by: ' + $(this).data('name'),
            html: html,
            type: getStatus($(this).data('status')),
            showConfirmButton: false,
        })
    });

});
