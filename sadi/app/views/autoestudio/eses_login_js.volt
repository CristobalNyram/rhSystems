{{ javascript_include('js/sha256.js') }}

<script>
    $(function () 
    {
      function obtenerIP() {
        fetch('https://api.ipify.org/?format=json')
              .then(response => response.json())
              .then(data => {
                  // Aquí puedes hacer lo que desees con la dirección IP
                  $('#ip_cliente').val(data.ip);
              })
              .catch(error => {
              });
      }
      obtenerIP();
      // Llamando a la función para obtener la IP
      $("#formSession_autoeses").submit(
        function(event)
        {   

          event.preventDefault();
          url_session="<?php echo $this->url->get('session/start_aes') ?>";
          url_index="<?php echo $this->url->get('') ?>";
          encriptada=SHA256($('#password').val());
          var $form = $(this);
          // $form.find("button").prop("disabled",true);
          $.ajax({
            type: "POST",
            url: url_session,
            data:{
              correo: $('#correo').val(),
              password: encriptada,
              ip_cliente:$('#ip_cliente').val()

              
            },
                        success: function(res)
                        {
                    
                         // console.log(res);
                                         if(res['estado']=='2')
                                          {
              


                                            alertify.alert(res['titular'],res['mensaje'],function(){

                                            });
                                            window.location=res['url_redireccionar'];

                                            /*  Swal.fire({title:res['titular'],text:res['mensaje'],type:"success",showConfirmButton: false,})
                                                            .then((value) => {

                                                            });*/

                                                            // console.log(url_index+res['url_redireccionar']);

                                          }
                                          else
                                          {

                                            alertify.alert(res['titular'],res['mensaje']);

                                            
                                          }
                         
                          
                          
                        },
                        error: function(error)
                        {

                          console.log(error.responseText);
                          // $form.find("button").prop("disabled", false);   
                        }
                      });
          return false;
        });
    });
    
    
  </script>