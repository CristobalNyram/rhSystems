<html lang="es">

<head>
    {% include "/cliente/layouts/head_login.volt" %}


</head>

<body>


  <div class="row">
      <div class="col-md-12 col-lg-12 login-cliente-back colspan">
        <div class="row header_1">
        <div class="col-md-6 col-lg-6 logo-crm">
          <span class="logo-crm-login">
            {{ image("assets/images/small/logo_white.svg", "height": "45") }}
          </span>
        </div>  
      <div class="col-md-6 col-lg-6 logo-crm">
                   <h1></h1>
                </div>  
    </div>
      <div class="col-md-4 col-sm-4 offset-md-4">
            <div class="account-pages pt-4">
                        <div class="card card-login">
                            <div class="card-body">
                                <div class="text-center mb-4 mt-3">                                       
                      <span class=" text-center">
                        <h1 class="h1-login"><b>¡Bienvenido!</b></h1>
                      <p>Para iniciar, ingresa tus datos.</p>
                      </span>
                                </div>
                                <form method='post' id='formSession_cliente' class="p-2">
                                    <div class="form-group">
                                        <der for="emailaddress" class="">Dirección de Email</der":"Correo eleclabel>
                                        {{ text_field('correo', 'class': "form-control form-control-login","placeholder":"Correo",'required':'true') }}
                                    </div>
                                    <div class="form-group">
                                        <label class="" for="password">Contraseña</label>
                                        {{ password_field('password', 'class': "form-control form-control-login","placeholder":"Contraseña",'required':'true') }}
                                    </div>
                                    <input type="hidden" id="ip_cliente">

                                    <!-- <div class="form-group mb-4 pb-3">
                                        <div class="custom-control custom-checkbox checkbox-primary">
                                            <a href="page-recoverpw.html" class="text-muted float-right">¿Olvidaste tu Contraseña?</a>
                                        </div>
                                    </div> -->
                                    <div class="mb-3 text-center">
                                      {{ submit_button('Entrar', 'class': 'btn btn-primary btn-login btn-block') }}
                                    </div>
                                </form>
                            </div>
                            <!-- end card-body -->
                        </div>
                        <!-- end card -->
                    </div>
        </div>
      </div>
  </div>


  

  
  {{ javascript_include('assets/js/vendor.min.js') }}
  {{ javascript_include('assets/js/app.min.js') }}
  {{ javascript_include('js/jquery.min.js') }}
  {{ javascript_include('js/alertify.min.js') }}
  {{ javascript_include('assets/libs/sweetalert2/sweetalert2.min.js') }}
  {% include "/cliente/login_js.volt" %}

</body>
</html>