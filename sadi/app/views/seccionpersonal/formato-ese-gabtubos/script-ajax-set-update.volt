
<script type="text/javascript">
    
//     alert('include');

      
    
    $('#form_estudio_seccionReferenciasPersonales_formato_gabtubos').submit((event)=>{
            event.preventDefault();
            let id= $('#ese_id_ese_actual_formato_gabtubos').text();

            let formulario=$("#form_estudio_seccionReferenciasPersonales_formato_gabtubos");
            let $form = $(this);
            $form.find("button").prop("disabled", true);
            let url_enviar="<?php echo $this->url->get('seccionpersonal/ajax_set_update/') ?>";
    
                  $.ajax({
                          type: "POST",
                          url: url_enviar+id,
                          method:'post',
                          data: formulario.serialize(),
                          success: function(res)
                          {   
                        
                            if(res[0]==2)
                             {
                 

                             Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
                                      .then((value) => {
                                        $('#link_seccion_ref_laborales_formato_gabtubos').trigger('click');

//                                            $('#contact-tab-md-10').trigger('click');
                                      });

                             }
                           else
                           {
                   

                              Swal.fire({title:res['titular'],text:res['mensaje'],type:"error"})
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