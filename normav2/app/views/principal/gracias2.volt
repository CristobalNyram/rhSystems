<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" type="image/png" href="{{url('assets/favicon.svg')}}" />
  <title>GRACIAS!</title>

  <!-- Bootstrap core CSS -->
  {{ stylesheet_link('bootstrap/css/bootstrap.min.css') }}
  {{ stylesheet_link('css/nom.css') }}

  

</head>

<body>
  <div class="body">
    <div class="col-sm-8">
      <div   class="main_container container-mensaje " id="{{gcolor}}">
        <div role="main">
          <div class="right_col" role="main">
            {{ flash.output() }}
            <div class="card border-light margin_title">
              <div class="card-body">
                {{ image("assets/images/config/"~logoactual, "height": "50") }}
              </div>
                <span style="text-align: justify; font-size: 16px; margin-top: 25px; color: black;">
                  {{estatusAnuncioGracias2['con_texto']}}
                </span>
             

              	<center>Puedes cerrar esta ventana.</center> 
      		    </p>
            </div>
          </div>
        </div>
        <div class="col-sm-12">
          <div class="col-sm-2">
          
          </div>
          <div class="col-sm-8">
            <br>
            
          </div>
        </div>
        <br>
        <br>
        <br>

      </div>
    </div>
    <div class="col-sm-4 fondo fondoCustomJs">

    </div>
  </div>
  <!-- Bootstrap core JavaScript -->
{{ javascript_include('js/jquery.min.js') }}
{{ javascript_include('js/bootstrap.min.js') }}
{% include "/principal/complementos/script-js-ajuste-imagen-dinamica.volt" %}

</body>

</html>
