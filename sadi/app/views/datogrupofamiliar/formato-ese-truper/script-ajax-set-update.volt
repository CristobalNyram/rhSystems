<script type="text/javascript">
    
    $('#form_estudio_seccionDatosFamiliares_formato_ese_truper').submit((event)=>{
            event.preventDefault();
            let id= $('#ese_id_ese_actual_formato_ese_truper').text();

            let formulario=$("#form_estudio_seccionDatosFamiliares_formato_ese_truper");
            let $form = $(this);
            $form.find("button").prop("disabled", true);
            let url_enviar="<?php echo $this->url->get('datogrupofamiliar/actualizar_formato_truper/') ?>";
    
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
                                  
                                    $('#link_seccion_datos_comprobatorios_truper').trigger('click');
                                 });

                             }
                           else
                           {
                            Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
                                 .then((value) => {
                                  location.reload();  
                                 });

                         
                
                           }
                          
                            
                          },
                          error: function(res)
                          { 
                          
                          }
                });
            
          });
    
</script>