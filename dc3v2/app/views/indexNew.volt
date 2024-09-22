<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="{{url('images/faviconsips.png')}}" />
  
  {{ get_title() }}
  {{ stylesheet_link('bootstrap/css/bootstrap.min.css') }}
  {{ stylesheet_link('fonts/font-awesome/css/font-awesome.min.css') }}
  {{ stylesheet_link('css/animate.min.css') }}

  {{ stylesheet_link("css/switchery/switchery.min.css") }}
  
  {{ stylesheet_link('css/alertify.min.css') }}
  {{ stylesheet_link('css/custom.css') }}
  
  {{ stylesheet_link('css/icheck/flat/green.css') }}
  {{ stylesheet_link('css/icheck/flat/blue.css') }}
  {{ stylesheet_link('css/floatexamples.css') }}
  {{ stylesheet_link('css/diseno.css') }}
  

  {{ javascript_include('js/jquery.min.js') }}
  {{ javascript_include('js/nprogress.js') }}
  {{ javascript_include('js/alertify.min.js') }}

  {{ stylesheet_link('plugins/datatables/dataTables.bootstrap.css') }}
  {# {{ stylesheet_link('plugins/datatables/extensions/FixedColumns/css/dataTables.fixedColumns.min.css') }} #}
 {{ stylesheet_link("https://cdn.datatables.net/fixedcolumns/3.3.3/css/fixedColumns.dataTables.min.css") }}
 <style type="text/css">
  th, td { white-space: nowrap;}
    div.dataTables_wrapper {
        width: 100%;
        margin: 0 auto;

    }
 </style>

  
  <!--Select 2-->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" rel="stylesheet">

</head>
<body class="nav-md">
  {{ content() }} 
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
  {{ javascript_include('js/bootstrap.min.js') }}
  <!-- gauge js -->
  

  <!-- bootstrap progress js -->
  {{ javascript_include('js/progressbar/bootstrap-progressbar.min.js') }}
  {{ javascript_include('js/nicescroll/jquery.nicescroll.min.js') }}
  <!-- icheck -->
  {{ javascript_include('js/icheck/icheck.min.js') }}
  

  {{ javascript_include('js/custom.js') }}


  
  <!-- dashbord linegraph -->
  <!-- /dashbord linegraph -->
  <!-- datepicker -->
  
  <script>
    NProgress.done();
  </script>
  {{ javascript_include('plugins/datatables/jquery.dataTables.min.js') }}
  {{ javascript_include('plugins/datatables/dataTables.bootstrap.min.js') }}
  {#  {{ javascript_include('plugins/datatables/extensions/FixedColumns/js/dataTables.fixedColumns.min.js') }} #}
  
  <script src="https://cdn.datatables.net/fixedcolumns/3.3.3/js/dataTables.fixedColumns.min.js"></script>
  <!-- <script src="https://nightly.datatables.net/fixedcolumns/js/dataTables.fixedColumns.js?_=041536f23acd079fda48eb314fad4838"></script> -->

  

  {{ assets.outputJs() }}
</body>
</html>
