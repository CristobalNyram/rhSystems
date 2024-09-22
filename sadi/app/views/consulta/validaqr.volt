<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="{{url('images/favicon.png')}}" />

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/09915e7de3.js" crossorigin="anonymous"></script>

  <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>-->
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;200;300;800;900&display=swap" rel="stylesheet">

  {{ get_title() }}
  {{ stylesheet_link('assets/consulta/css/bootstrap.min.css') }}
  
  {{ stylesheet_link('assets/consulta/css/all.css') }}

  {{ stylesheet_link('assets/consulta/css/magnific-popup.css') }}
  {{ stylesheet_link('assets/consulta/css/owl.carousel.min.css') }}
  {{ stylesheet_link('assets/consulta/css/style.css') }}
  {{ stylesheet_link('assets/consulta/css/flickity-docs.css') }}
  
  {{ javascript_include('assets/consulta/js/jquery-3.3.1.min.js') }}
  
 
</head>
<body data-spy="scroll" data-target=".navbar">
  <div class="ts-page-wrapper" id="page-top">

    <section id="subscribe" class="ts-block_2 ts-separate-bg-element ts-background-repeat p-15 bg_validacion_2" data-bg-image-opacity=".05" data-bg-color="#ecf2fe">
      <div class="container">
        <div class="row">
          <div class="col-sm-6 col-md-6 text-center offset-md-3">
            <div class="card_2">
              <div class="card_validacion_2">

                <div id='resultado' class="">
                  {{ image("assets/images/small/logo_blue.svg", "height": "45") }}
                  <div class='valido' style="padding-top: 5%;">
                    {% if valido==1 %}
                      <h2 id="consulta'+id+" class="mensaje">El estudio es válido con la siguiente información</h2>
                      <br>
                      <h2><small>SE CERTIFICA QUE EL ESTUDIO REALIZADO A: {{ ese_nombre }}. <br>SE ENTREGÓ EL DÍA: {{ expedicion }}.<br> CON EL ID: {{ folio }}.</small></h2>
                      <h2>Para mayor información al correo electrónico: calidad@sips.mx
Teléfono 222 296 65 85 Calle Piaxtla #6 2do Piso, Col. La Paz, C.P. 72160, Puebla, Pue</h2>
                      
                      
                    {% endif %}
                    {% if valido==0 %}
                      <h2 id="consulta'+id+" class="mensaje_negativo">No se ha encontrado registro sobre el estudio</h2>
                    {% endif %}  
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  {{ javascript_include('assets/consulta/js/custom.hero.js') }}
  {{ javascript_include('assets/consulta/js/popper.min.js') }}
  {{ javascript_include('assets/consulta/js/bootstrap.min.js') }}
  {{ javascript_include('assets/consulta/js/imagesloaded.pkgd.min.js') }}
  {{ javascript_include('assets/consulta/js/isInViewport.jquery.js') }}
  {{ javascript_include('assets/consulta/js/jquery.magnific-popup.min.js') }}
  {{ javascript_include('assets/consulta/js/owl.carousel.min.js') }}

  {{ javascript_include('assets/consulta/js/scrolla.jquery.min.js') }}
  {{ javascript_include('assets/consulta/js/custom.js') }}
  {{ javascript_include('assets/consulta/js/flickity-docs.min.js') }}
</body>

</html>


