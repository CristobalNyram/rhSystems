<script type="text/javascript">
    
    $('#form_estudio_antecedentegrupofamiliar').submit((event)=>{
            event.preventDefault();
            let id= $('#ese_id_ese_actual').text();

            let formulario=$("#form_estudio_antecedentegrupofamiliar");
            let $form = $(this);
            $form.find("button").prop("disabled", true);
            let url_enviar="<?php echo $this->url->get('antecedentegrupofamiliar/ajax_set_update/') ?>";
    
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
                                       $('#contact-tab-md-7').trigger('click');
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