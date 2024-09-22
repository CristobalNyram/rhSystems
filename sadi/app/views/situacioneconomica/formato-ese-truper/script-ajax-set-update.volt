<script type="text/javascript">
    
    $('#form_estudio_seccionSituacionEconomica_truper').submit((event)=>{
            event.preventDefault();
            let id= $('#ese_id_ese_actual_formato_ese_truper').text();



          

            // console.log($('#sie_manuegresomonto').val());

            let formulario=$("#form_estudio_seccionSituacionEconomica_truper");
            let $form = $(this);
            $form.find("button").prop("disabled", true);
            let url_enviar="<?php echo $this->url->get('situacioneconomica/ajax_set_update_formato_truper/') ?>";
    
                  $.ajax({
                          type: "POST",
                          url: url_enviar+id,
                          data: formulario.serialize(),
                          success: function(res)
                          {   
                        
                           //  console.log(res);
                            if(res[0]==2)
                             {
                                Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
                                      .then((value) => {
                                       cargarDatosSeccion_G_ESES_formato_truper(res['ese_id']);

                                          $('#link_seccion_datos_bienes_inmuebles_truper').trigger('click');
                                      });

                             }
                           else
                           {
                              alertify.alert(res['titular'],res['mensaje'], function(){
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