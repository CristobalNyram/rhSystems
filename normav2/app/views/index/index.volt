<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <!-- FAVICON------------------------------------------------------------------------------FAVICON -->
  <link rel="icon" type="image/svg+xml" href="{{url('images/favicon.svg')}}" />
  <!-- FAVICON--------------------------------------------------------------------------------------------------------FAVICON -->


  {{ get_title() }}

  <!--CSS-------------------------------------------------------------------------------------CSS -->
  {{ stylesheet_link('css/alertify.min.css') }}
  
  {{stylesheet_link('assets/css/bootstrap.min.css')}}
  {{stylesheet_link('assets/css/icons.min.css')}}
  {{stylesheet_link('assets/css/app.min.css')}}
  {{stylesheet_link('assets/css/modificado.css')}}

  <!--CSS-------------------------------------------------------------------------------------------------------------------------------CSS -->



  <!-- Js------------------------------------------------------------------------------------------------------------------------------------JS -->
  {{ javascript_include('js/jquery.min.js') }}
  {{ javascript_include('js/nprogress.js') }}
  {{ javascript_include('js/alertify.min.js') }}
  <!-- JS-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------JS -->
</head>



<body>

    <!-- This library is for encrypt -->
    {{ javascript_include('js/sha256.js') }}
    <script>
      $(function () 
      {
        $("#formSession").submit(
          function(event)
          {   
            url_session="<?php echo $this->url->get('session/start') ?>";
            url_index="<?php echo $this->url->get('cuestionario/activarfolio') ?>";
            encriptada=SHA256($('#password').val());
            var $form = $(this);
            $form.find("button").prop("disabled",true);
            $.ajax({
              type: "POST",
              url: url_session,
              data:{
                correo: $('#correo').val(),
                password: encriptada,
                
              },
              success: function(res)
              {
                if(res[0]=='0')
                {
                              // grecaptcha.reset(iniciarses);
                              alertify.alert("Error",res[1]);
                            }
                            else
                            {
                              if(res[0]=='1')
                                window.location=url_index;
                              //$form.get(0).submit();
                            }
                            
                            $form.find("button").prop("disabled", false);
                          },
                          error: function(data)
                          {
                            $form.find("button").prop("disabled", false);   
                          }
                        });
            return false;
            });
      });
      
      
    </script>



    
<div class="row">
    <div class="col-md-12 col-lg-12 login-back colspan">
        <div class="row header_1">
            <div class="col-md-6 col-lg-6 logo-crm">
            <span class="logo-crm-login">
              {{ link_to('cuestionario/activarfolio', image("assets/images/config/"~logoactual,"height": "50",'class':'mt-2')) }}


             {# {{image('assets/images/small/logo_white.svg',"height": "39")}} #}
            </span>
        </div>	
        <div class="col-md-6 col-lg-6 logo-crm">
           <h1>Cuestionarios</h1>
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
                        <form  method='post' target='_self' id='formSession' class="p-2">
                            <div class="form-group">
                                <label for="emailaddress" class="">Usuario</label>
                                {{ text_field('correo', 'class': "form-control form-control-login","placeholder":"Correo electrónico",'required':'true') }}
                            </div>
                            <div class="form-group mb-4">
                                <label class="" for="password">Contraseña</label>
                                {{ password_field('password', 'class': "form-control form-control-login","placeholder":"Ingresa tu contraseña",'required':'true') }}
                            </div>

              
                            <div class="form-group text-center">
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
<!-- end page -->


{{ javascript_include('assets/js/vendor.min.js') }}
  {{ javascript_include('assets/js/app.min.js') }}
</body>



</html>