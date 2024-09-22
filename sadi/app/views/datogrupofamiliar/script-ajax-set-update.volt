<script type="text/javascript">
    
    $('#form_estudio_seccionGrupoFamiliar').submit((event)=>{
            event.preventDefault();
            let id= $('#ese_id_ese_actual').text();

            let formulario=$("#form_estudio_seccionGrupoFamiliar");
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
                                        $('#contact-tab-md-6').trigger('click');
                                        
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