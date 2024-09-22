





<script type="text/javascript">
    
    $('#form_estudio_seccionReferenciasLaborales_formato_gabencognv').submit((event)=>{
            event.preventDefault();
            let id= $('#ese_id_ese_actual_formato_gabencognv').text();

            let formulario=$("#form_estudio_seccionReferenciasLaborales_formato_gabencognv");
            let $form = $(this);
            $form.find("button").prop("disabled", true);
            let url_enviar="<?php echo $this->url->get('seccionlaboral/ajax_set_update/') ?>";
    
                  $.ajax({
                          type: "POST",
                          url: url_enviar+id,
                          data: formulario.serialize(),
                          success: function(res)
                          {   
                        
                            if(res[0]==2)
                             {
                          
                                Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
                                          .then((value) => {
                                            fnCrearAutomaticoSeccionLaboral_formato_gabencognv(res['ese_id']);
                                               $('#link_seccion_datos_finales_gabencognv').trigger('click');
                                          });

                             }
                           else
                           {
                            Swal.fire({title:'Error',text:'No se puedieron cargar los datos.',type:"error"})
                                      .then((value) => {

                                          location.reload();  
                                      });
                           }
                       
                            
                          },
                          error: function(res)
                          { 
                          alert('error en el servidor...');
                          }
                });
            
          });
    
</script>