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

  {{ stylesheet_link('css/alertify.min.css') }}
  {{ stylesheet_link('css/custom.css') }}
  {{ stylesheet_link('css/maps/jquery-jvectormap-2.0.3.css') }}
  {{ stylesheet_link('css/icheck/flat/green.css') }}
  {{ stylesheet_link('css/floatexamples.css') }}
  <!-- {{ stylesheet_link('css/diseno.css') }} -->
  

  {{ javascript_include('js/jquery.min.js') }}
  {{ javascript_include('js/nprogress.js') }}
  {{ javascript_include('js/alertify.min.js') }}



</head>
<body id="login-bg" class="nav-md">
  {{ javascript_include('js/sha256.js') }}
 

  <div class="container body">
    <div class="main_container">
      <!-- page content -->
      <div class="right_col_login shadow" role="main">
        <div>
         <section class="login_content">
           <form method='post' target='_self' id='formSession'>
             <div class="x_panel shadow" style="width:80%;margin:auto">
               <div class="panel-body">
                 <div class="row"  style="margin:20px 0">
                   <div class="col-xs-6 col-xs-offset-3">
                    {% if valido==1 %}
                      <h3  style="color:green; font-family:verdana; font-size:200%; text-align:center;">El diploma es válido con la siguiente información</h3>
                      <br>

                      <h1>Nombre del instructor: {{ ins_nombre }}</h1>
                      
                      <h1>Curso impartido: {{ curso }}</h1>
                      {% if inicial==final %}
                        <h1>El día: {{ inicial }}</h1>
                      {% else %}
                        <h1>En el periodo: De {{ inicial }} a {{ final }}</h1>
                      {% endif %}
                      <h1>Expedido: {{ expedicion }}</h1>                      
                      <br>

                    {% endif %}

                    {% if valido==0 %}
                      <h4 style="color:red; font-family:verdana; font-size:200%;">No se ha encontrado registro sobre el diploma del instructor</h4>
                    {% endif %}


                    <!-- {{ image("images/recursos/sips_logo.svg", "class": "img-responsive") }} -->
                   </div>
                 </div>
                 <!-- {{ text_field('correo', 'class': "form-control","placeholder":"Correo electrónico",'required':'true') }} -->
                 <!-- <input type="text" class="form-control" placeholder="Correo Electrónico" required="" /> -->
                 <div> </div>
                 <div>
                  <!-- {{ password_field('password', 'class': "form-control","placeholder":"Contraseña",'required':'true') }} -->
                  <!-- <input type="password" class="form-control" placeholder="Contraseña" required="" /> -->
                  <!-- {{ submit_button('Iniciar Sesión', 'class': 'btn btn-btnempresa btn-block submit') }} -->
                  <!-- <a class="btn btn-btnempresa btn-block submit" href="index.html">Iniciar Sesión</a> -->
                </div>
                <!-- <div class='col-sm-12'> -->
                 
                 <!-- </div> -->
                 <!-- <div> -->

                   <!-- </div> -->
                   <div>
                     <div class="clearfix"></div>
                     <div class="separator">
                     </div>
                     <div class="clearfix"></div>
                     <br />
                     <div>
                     </div>
                   </div>
                 </div>
               </div>
             </form>
             <!-- form -->
           </section>
           <!-- content -->
         </div>
         <div class="clearfix"></div>
         <footer style="position:fixed;bottom:0;right:0">
          <div class="copyright-info">
            <p class="pull-right">© 2019 SIPS v.1 - 2019
            </p>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
      <!-- /page content -->

    </div>
  </div>

  
  {{ javascript_include('js/bootstrap.min.js') }}
</body>
</html>