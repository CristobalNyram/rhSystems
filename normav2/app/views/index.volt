<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="{{url('assets/favicon.svg')}}" />
  
  {{ get_title() }}

  <!--*******************
   START STYLES IN CSS
  *********************** -->
    <!-- Third party css -->
  {{stylesheet_link('assets/libs/datatables/dataTables.bootstrap4.css')}}
  {{stylesheet_link('assets/libs/datatables/buttons.bootstrap4.css')}}
  {{stylesheet_link('assets/libs/datatables/responsive.bootstrap4.css')}}
  {{stylesheet_link('assets/libs/datatables/select.bootstrap4.css')}}
  

        <!-- app css -->
        {{stylesheet_link('assets/css/bootstrap.min.css')}}
        {{stylesheet_link('assets/css/icons.min.css')}}
        {{stylesheet_link('assets/css/app.min.css')}}
        {{stylesheet_link('assets/css/modificado.css')}}
        {{ stylesheet_link('assets/libs/select2/select2.min.css') }}
        

  <!--********************
  END STYLES IN CSS
  ************************ -->

  {{ stylesheet_link('css/alertify.min.css') }}
  
  {{ javascript_include('assets/js/vendor.min.js')}}
  {{ javascript_include('js/nprogress.js') }}
  {{ javascript_include('js/alertify.min.js') }}

  {{javascript_include('assets/js/cuestomalertify.js')}}
  
  <!--Select 2-->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" rel="stylesheet">
 <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>



</head>
<body data-layout="horizontal">
  {{ content() }} 
     <!-- <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script> -->
  <!-- gauge js -->
  

  
  <script>
    NProgress.done();
  </script>
 
 


  

  <!-- vendor js -->
  {{javascript_include('assets/libs/moment/moment.min.js')}}
  {{javascript_include('assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}
  {{javascript_include('assets/libs/switchery/switchery.min.js')}}
  {{javascript_include('assets/libs/select2/select2.min.js')}}
  {{javascript_include('assets/libs/parsleyjs/parsley.min.js')}}
  {{javascript_include('assets/libs/bootstrap-filestyle2/bootstrap-filestyle.min.js')}}
  {{javascript_include('assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.js')}}
  {{javascript_include('assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js')}}
  {{javascript_include('assets/libs/clockpicker/bootstrap-clockpicker.min.js')}}
  {{javascript_include('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js')}}
  {{javascript_include('assets/libs/bootstrap-daterangepicker/daterangepicker.js')}}


  <!-- Librerias para graficar  -->
  {{javascript_include('assets/libs/morris-js/morris.min.js')}}
  {{javascript_include('assets/libs/raphael/raphael.min.js')}}




  <!-- Required datatable js -->
  {{javascript_include('assets/libs/datatables/jquery.dataTables.min.js')}}
  {{javascript_include('assets/libs/datatables/dataTables.bootstrap4.min.js')}}
 
  <!-- Buttons examples -->
  {{javascript_include('assets/libs/datatables/dataTables.buttons.min.js')}}
  {{javascript_include('assets/libs/datatables/buttons.bootstrap4.min.js')}}
  {{javascript_include('assets/libs/datatables/dataTables.keyTable.min.js')}}
  {{javascript_include('assets/libs/datatables/dataTables.select.min.js')}}
  
  {{javascript_include('assets/libs/jszip/jszip.min.js')}}
  {{javascript_include('assets/libs/pdfmake/pdfmake.min.js')}}
  {{javascript_include('assets/libs/pdfmake/vfs_fonts.js')}}
  {{javascript_include('assets/libs/datatables/buttons.html5.min.js')}}
  {{javascript_include('assets/libs/datatables/buttons.print.min.js')}}
  {{javascript_include('assets/libs/datatables/buttons.colVis.min.js')}}

  <!-- Responsive examples -->
  {{javascript_include('assets/libs/datatables/dataTables.responsive.min.js')}}
  {{javascript_include('assets/libs/datatables/responsive.bootstrap4.min.js')}}
 
  <!-- Charts -->
  {{javascript_include('assets/libs/charts/chart.min.js')}}
  

  <!-- DataTables Init -->
  {{javascript_include('assets/js/pages/datatables.init.js')}}
  

  <!-- Summernote js -->
  {{javascript_include('assets/libs/summernote/summernote-bs4.min.js')}}

  <!-- init js -->
  {{javascript_include('assets/js/pages/form-advanced.init.js')}}

  <!-- app js -->

  {{javascript_include('assets/js/app.min.js')}}
  {{assets.outputJs()}}

</body>
</html>
