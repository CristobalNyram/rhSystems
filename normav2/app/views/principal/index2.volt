<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" type="image/png" href="{{url('assets/favicon.svg')}}" />
  <title>Bienvenido</title>

  <!-- Bootstrap core CSS -->
  {{ stylesheet_link('bootstrap/css/bootstrap.min.css') }}
  {{ stylesheet_link('css/nom.css') }}
  {{ stylesheet_link('css/alertify.min.css') }}



   <!-- Js------------------------------------------------------------------------------------------------------------------------------------JS -->
   {{ javascript_include('js/jquery.min.js') }}
   {{ javascript_include('js/nprogress.js') }}
   {{ javascript_include('js/alertify.min.js') }}
   <!-- JS-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------JS -->
  
   {% include "/layouts/js-funciones-generales.volt" %}

  

</head>

<body>
  <div class="body">
    <div class="col-sm-8">
    <div class="main_container" id="{{gcolor}}">
      <div role="main">
        <div class="right_col" role="main">
          {{ flash.output() }}
          {% if requiere_carga_info_usuario ==2 %}
             {% include "/principal/complementos/script-modal-cargar-info-por-si-mismo.volt" %}

          {% else %}
             {% include "/principal/complementos/mensaje-bienvenidad-contestar.volt" %}
          {% endif %}
      
           
          


        </div>
        </div>
        <div class="col-sm-12">
          <div class="col-sm-2">
          
          </div>
          <div class="col-sm-8 " style="margin-top: 30px;">
            
            <br>

            

            {% set folio = app.request.getQuery('folio') %}
            {% set ruta = app.request.getQuery('cueinicio') %}
           
            {% if ruta is not empty %}
            {% set siguienteruta = app.request.getQuery('sigcue') %}
            {% else %}
            {% set siguienteruta = 'nac' %}
            {% endif %}

            {% if ruta is empty %}
            <script>
                let url = "{{ url('principal/index') }}";
                window.location.href = url;
            </script>
            {% endif %}

            {% if requiere_carga_info_usuario !=2 %}
                   {{ link_to("cuestionario"~ruta~"/formulario/?sigcue="~siguienteruta~"&folio="~folio, '<i class="">IR A CUESTIONARIO</i>', "class": "btn btn-cuestionario btn-lg btn-block", "style": "width: 100%;") }}            

            {% else %}
            
            {% endif %}
          

              
         
          </div>
        </div>
        <br>
        <br>
        <br>

      </div>
    </div>
    <div class="col-sm-4 fondo3 fondoCustomJs">

    </div>
  </div>






<!-- Bootstrap core JavaScript -->
{{ javascript_include('js/jquery.min.js') }}
{{ javascript_include('js/bootstrap.min.js') }}
{% include "/principal/complementos/script-js-ajuste-imagen-dinamica.volt" %}

</body>
</html>
