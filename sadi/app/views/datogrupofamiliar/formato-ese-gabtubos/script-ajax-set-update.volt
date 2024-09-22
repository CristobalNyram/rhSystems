<script type="text/javascript">
    
    $('#form_estudio_seccionGrupoFamiliar_formato_gabtubos').submit((event)=>{
            event.preventDefault();
            let id= $('#ese_id_ese_actual_formato_gabtubos').text();

            let formulario=$("#form_estudio_seccionGrupoFamiliar_formato_gabtubos");
            let $form = $(this);
            $form.find("button").prop("disabled", true);
            let url_enviar="<?php echo $this->url->get('datogrupofamiliar/ajax_set_update/') ?>";
    
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
                                  
                                  $('#link_seccion_ref_personales_formato_gabtubos').trigger('click');
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