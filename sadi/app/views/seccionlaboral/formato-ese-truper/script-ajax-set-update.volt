





<script type="text/javascript">
    
    $('#form_estudio_seccionReferenciasLaborales_formato_truper').submit((event)=>{
            event.preventDefault();
            // let id= $('#ese_id_ese_actual_formato_ese_truper').text()
            let id= $('#sel_id-formato_truper').val()

            let formulario=$("#form_estudio_seccionReferenciasLaborales_formato_truper");
            let $form = $(this);
            $form.find("button").prop("disabled", true);
            let url_enviar="<?php echo $this->url->get('seccionlaboral/ajax_set_update_formato_truper/') ?>";
    
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
                                              fnCargarDatosDelFormularioI_formato_truper(res['ese_id']);

                                               $('#link_seccion_datos_referencia_truper').trigger('click');
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