<!-- funcion para guardar los datos -->

<script type="text/javascript">
    
      
          $('#form_estudio_seccionEvaluacionFinal_formato_ese_truper').submit((event)=>{
            event.preventDefault();
            let formulario=$("#form_estudio_seccionEvaluacionFinal_formato_ese_truper");
            let $form = $(this);
            let url_enviar="<?php echo $this->url->get('evaluaciontruper/actualizar_formato_truper/') ?>";
            let ese_id=  $('#ese_id_ese_actual_formato_ese_truper').text();


    
               $.ajax({
                          type: "POST",
                          url: url_enviar+ese_id,
                          data: formulario.serialize(),
                          success: function(res)
                          {   

                        

                            if(res[0]=='2'){
                              Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
                                          .then((value) => {
                                            cargarDatosSeccion_FINAL_ESES_formato_truper(res['ese_id']);
                                         
                                           					$('#link_seccion_datos_finales_truper').trigger('click');
 

                                          });
                        
                             }
                            else{
                              Swal.fire({title:res['titular'],text:res['mensaje'],type:"error"})
                                                                  .then((value) => {
                                                                      location.reload();  
                                                                      });
                            }
                           
                         
                          },
                          error: function(res)
                          { 
                            alert('Error en el servidor');
                          }
                });
            
          });
        
    
    
    </script>