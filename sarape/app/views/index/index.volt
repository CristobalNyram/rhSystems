<html lang="es">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="{{url('assets/images/favicon.svg')}}" />
  
  {{ get_title() }}

  {{ stylesheet_link('assets/css/bootstrap.min.css') }}
  {{ stylesheet_link('assets/css/icons.min.css') }}
  {{ stylesheet_link('assets/css/app.min.css') }}
  {{ stylesheet_link('assets/css/modificado.css') }}
  {{ stylesheet_link('css/alertify.min.css') }}

  {{ javascript_include('js/jquery.min.js') }}
  {{ javascript_include('js/alertify.min.js') }}
  <script src='https://www.google.com/recaptcha/api.js?render=6LfnkqwpAAAAACFbi4c2jedNMqM_wWdNm_0oPI_W'></script>
  <script>
    let repeticion =  window.setInterval("verificaptcha()", 110000);

    function verificaptcha(){
      grecaptcha.ready(function() {
      grecaptcha.execute('6LfnkqwpAAAAACFbi4c2jedNMqM_wWdNm_0oPI_W', {action: 'ejemplo'})
        .then(function(token) {
        var recaptchaResponse = document.getElementById('recaptchaResponse');
        recaptchaResponse.value = token;
        });
      });
    }

    grecaptcha.ready(function() {
      grecaptcha.execute('6LfnkqwpAAAAACFbi4c2jedNMqM_wWdNm_0oPI_W', {action: 'ejemplo'})
      .then(function(token) {
      var recaptchaResponse = document.getElementById('recaptchaResponse');
      recaptchaResponse.value = token;
      });
    });
</script>
</head>
<body>
  {{ javascript_include('js/sha256.js') }}
  <script>
    $(function () 
    {
      function obtenerIP() {
        fetch('https://api.ipify.org/?format=json')
            .then(response => response.json())
            .then(data => {
               // console.log(data.ip);
                // Aquí puedes hacer lo que desees con la dirección IP
                $('#ip_cliente').val(data.ip);
            })
            .catch(error => {
                console.log(error);
            });
    }
    obtenerIP();

      $("#formSession").submit(
        function(event)
        {   
          url_session="<?php echo $this->url->get('session/start') ?>";
          url_index="<?php echo $this->url->get('') ?>";
          encriptada=SHA256($('#password').val());
          var $form = $(this);
          $form.find("button").prop("disabled",true);
          $.ajax({
            type: "POST",
            url: url_session,
            data:{
              correo: $('#correo').val(),
              password: encriptada,
              ip_cliente:$('#ip_cliente').val(),
              recaptcha_response:$('#recaptchaResponse').val()
            },
            success: function(res)
            {
              if(res[0]=='0')
              {
                alertify.alert("Error",res[1]);
                console.log(res[1]);
              }
              else
              {
                if(res[0]=='1')
                  console.log(res[1]);
                  window.location=url_index+res[2];
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
            {{ image("assets/images/small/logo_white.svg", "height": "45") }}
          </span>
        </div>  
      <div class="col-md-6 col-lg-6 logo-crm">
          <h1>Sistema de Administración de Reclutamiento y Administración de Personal</h1>
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
              <form method='post' id='formSession' class="p-2">
                <div class="form-group">
                  <label for="emailaddress" class="">Dirección de Email</label>
                  {{ text_field('correo', 'class': "form-control form-control-login","placeholder":"Correo electrónico",'required':'true') }}
                </div>
                <div class="form-group">
                  <label class="" for="password">Contraseña</label>
                  {{ password_field('password', 'class': "form-control form-control-login","placeholder":"Contraseña",'required':'true') }}
                </div>
                <input type="hidden" id="ip_cliente">
                <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
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
</body>
</html>