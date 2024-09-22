<script>
    function fnCargarDatosDelFormularioI(ese_id=0){
            
            let form_seccionI=document.getElementById('form_estudio_seccionReferenciasPersonales');
            form_seccionI.reset();
            $('#sep_calificacion').val('-1');
            $('#sep_calificacion').trigger('change');
                           
            
            let url_enviar="<?php echo $this->url->get('seccionpersonal/ajax_get_detalle/') ?>";
  
              $.ajax({
                      type: "POST",
                      url: url_enviar+ese_id,
                        
                      success: function(data)
                      {

                    
                           if (data.length ==0) {
                             fnCrearAutomaticoSeccionPersonal(ese_id);
                           }
                           else
                           {
                               $('#sep_id').val(data.sep_id);
                              fnCargarTablaDatoReferenciaPersonal(data.sep_id);
                              fnRe_CargarTablaDatoReferenciaVecinal(data.sep_id);

    
                              $('#sep_calificacion').val((data.sep_calificacion==null ||data.sep_calificacion== '' ? -1 :data.sep_calificacion));
                              $('#sep_calificacion').trigger('change');

                              
                   
                           }
  
                           
  
                      },
                      error: function(data)
                      {
                          Swal.fire({title:'Error',text:'No se puedieron cargar los datos vuelve a intentar de nuevo.',type:"error"})
                                                                 .then((value) => {
                                                                     });
                        
                      }
             });
  
      }
  
      function fnCrearAutomaticoSeccionPersonal(ese_id)
      {
        let url_enviar="<?php echo $this->url->get('seccionpersonal/crear_automatico/') ?>";
  
   
              $.ajax({
                      type: "POST",
                      url: url_enviar+ese_id,
                        
                      success: function(res)
                      {
                       
                            if(res[0]==2)
                            {
                              fnCargarDatosDelFormularioI(ese_id);
                            }
                            else
                            {
                              alertify.alert(res['titulo'],res['mensaje']); 
  
                            }
  
                           
                      },
                      error: function(res)
                      {
                          alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'); 
                        
                      }
              });
            
          
        }
  
    
  
  </script>