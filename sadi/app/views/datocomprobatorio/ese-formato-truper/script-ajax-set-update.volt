<!-- funcion para guardar los datos -->

<script type="text/javascript">
    $(document).ready(()=>{
      
          $('#form_estudio_seccionDatosComprobatorios_formato_ese_truper').submit((event)=>{
            event.preventDefault();
            let formulario=$("#form_estudio_seccionDatosComprobatorios_formato_ese_truper");
            let $form = $(this);
       
            let url_enviar="<?php echo $this->url->get('datocomprobatorio/ajax_set_update_formato_truper/') ?>";
    
                  $.ajax({
                          type: "POST",
                          url: url_enviar,
                          data: formulario.serialize(),
                          success: function(res)
                          {   
                            if(res[0]==2)
                             {
                              Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
                                          .then((value) => {

                                            fnCargarDatosComprobatorios_especifico_adapatable_formato_truper(res['ese_id']);

                                            $('#link_seccion_datos_financieros_truper').trigger('click');
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
                          
                          }
                });
            
          });
        
    
    });
    </script>