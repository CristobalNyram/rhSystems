





<script type="text/javascript">
    
    $('#form_estudio_seccionReferenciasLaborales_formato_gabtubos').submit((event)=>{
            event.preventDefault();
            let id= $('#ese_id_ese_actual_formato_gabtubos').text();

            let formulario=$("#form_estudio_seccionReferenciasLaborales_formato_gabtubos");
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
                                            fnCrearAutomaticoSeccionLaboral_formato_gabtubos(res['ese_id']);

                                               $('#link_seccion_datos_finales_formato_gabtubos').trigger('click');
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