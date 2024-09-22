
   <!-- Vendor js -->
  <!-- Vendor js -->
  {{ javascript_include('assets/libs/morris-js/morris.min.js') }}


  {{ javascript_include('assets/libs/moment/moment.min.js') }}
  {{ javascript_include('assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}
  {{ javascript_include('assets/libs/switchery/switchery.min.js') }}
  {{ javascript_include('assets/libs/select2/select2.min.js') }}
  {{ javascript_include('assets/libs/parsleyjs/parsley.min.js') }}
  {{ javascript_include('assets/libs/bootstrap-filestyle2/bootstrap-filestyle.min.js') }}
  {{ javascript_include('assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.js') }}
  {{ javascript_include('assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js') }}
  {{ javascript_include('assets/libs/clockpicker/bootstrap-clockpicker.min.js') }}
  {{ javascript_include('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}
  {{ javascript_include('assets/libs/bootstrap-daterangepicker/daterangepicker.js') }}

  <!-- Required datatable js -->
  {{ javascript_include('assets/libs/datatables/jquery.dataTables.min.js') }}
  {{ javascript_include('assets/libs/datatables/dataTables.bootstrap4.min.js') }}

  <!-- Buttons examples -->
  {{ javascript_include('assets/libs/datatables/dataTables.buttons.min.js') }}
  {{ javascript_include('assets/libs/datatables/buttons.bootstrap4.min.js') }}
  {{ javascript_include('assets/libs/datatables/dataTables.keyTable.min.js') }}
  {{ javascript_include('assets/libs/datatables/dataTables.select.min.js') }}
  
  {{ javascript_include('assets/libs/jszip/jszip.min.js') }}
  {{ javascript_include('assets/libs/pdfmake/pdfmake.min.js') }}
  {{ javascript_include('assets/libs/pdfmake/vfs_fonts.js') }}
  {{ javascript_include('assets/libs/datatables/buttons.html5.min.js') }}
  {{ javascript_include('assets/libs/datatables/buttons.print.min.js') }}
  {{ javascript_include('assets/libs/datatables/buttons.colVis.min.js') }}



  <!-- Responsive examples -->
 {{ javascript_include('assets/libs/datatables/dataTables.responsive.min.js') }}
 {{ javascript_include('assets/libs/datatables/responsive.bootstrap4.min.js') }}

 <!-- Datatables init -->
 {{ javascript_include('assets/js/pages/datatables.init.js') }}

 <!-- Summernote js -->
 {{ javascript_include('assets/libs/summernote/summernote-bs4.min.js') }}


   <!-- Intro -->
   {{ javascript_include('assets/js/introjs/intro.min.js') }}

 <!-- Init js-->
 {{ javascript_include('assets/js/pages/form-advanced.init.js') }}

 <!-- App js -->
 {{ javascript_include('assets/js/app.min.js') }}
 {{ javascript_include('assets/libs/sweetalert2/sweetalert2.min.js') }}
 {{ assets.outputJs() }}
 <script>
  
  $(window).on('load', function () {
    // $('#hide-me').css('display', 'none');
    $('#hide-me').fadeOut("slow");
    // setTimeout(function () {
      // $(".loader-page").css({visibility:"hidden",opacity:"0"});
    // }, 1000);
       
  });
  $( document ).ajaxStart(function() {
    $('#hide-me').css('display', 'block');
  });

  $(document).ajaxStop(function(){ 
    $('#hide-me').fadeOut("slow");
    // $('#hide-me').css('display', 'none');
  });
 </script>