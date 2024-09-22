<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" type="image/png" href="{{url('assets/favicon.svg')}}" />
  <title>NORMA 035</title>

  <!-- Bootstrap core CSS -->
  {{ stylesheet_link('bootstrap/css/bootstrap.min.css') }}
  {{ stylesheet_link('css/nom.css') }}

  

</head>

<body>
  <div class="body">
    <div class="col-sm-8">
      <div class="main_container container-mensaje" id="{{gcolor}}">
        <div role="main">
          <div class="right_col" role="main">
            {{ flash.output() }}
            <div class="card border-light margin_title">
              <div class="card-body">
                {{ image("assets/images/config/"~logoactual, "height": "50") }}

              </div>
                <!-- <br><br> -->
                <!-- <center><h3><strong>GRACIAS POR TU PARTICIPACIÓN</strong></h3></center> -->
                <span style="text-align: justify; font-size: 16px; margin-top: 25px;color: black;">
                  {{estatusAnuncioGracias1['con_texto']}}
                </span>

              </div>
          </div>
        </div>
        <div class="col-sm-12">
          <div class="col-sm-2">
          
          </div>
          <div class="col-sm-8">
            <br>
            
          

            <?php $folio = isset($_GET['folio']) ? $_GET['folio'] : null; ?>

            <?php if ($folio === null || empty($folio)): ?>
            <script>
                let url = "{{ url('principal/index') }}";
                window.location.href = url;
            </script>
            <?php endif; ?>
            {{ link_to("cuestionariouno/formulario/?folio="~folio, '<i class="fa fa-pencil">IR A CUESTIONARIO</i>', "class": "btn btn-cuestionario btn-lg btn-block","title":"IR A CUESTIONARIO") }}
          </div>
        </div>
        <br>
        <br>
        <br>

      </div>
    </div>
    <div class="col-sm-4 fondo2 fondoCustomJs">

    </div>
  </div>
<!-- Bootstrap core JavaScript -->
{{ javascript_include('js/jquery.min.js') }}
{{ javascript_include('js/bootstrap.min.js') }}
{% include "/principal/complementos/script-js-ajuste-imagen-dinamica.volt" %}

</body>

</html>
