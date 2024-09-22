<script>
    function fnCargarDatosDelFormularioJ(ese_id=0){
            
            let form_seccionI=document.getElementById('form_estudio_seccionReferenciasLaborales');
            form_seccionI.reset();
            $('#sel_calificacion').val('-1');
            $('#sel_calificacion').trigger('change');
                           
            
            let url_enviar="<?php echo $this->url->get('seccionlaboral/ajax_get_detalle/') ?>";
  
              $.ajax({
                      type: "POST",
                      url: url_enviar+ese_id,
                        
                      success: function(data)
                      {

                    
                           if (data.length ==0) {
                             fnCrearAutomaticoSeccionLaboral(ese_id);
                           }
                           else
                           {
                            // alert();
                               $('#sel_id').val(data.sel_id);
                               fnRe_CargarTablaDatoReferenciaLaboral(data.sel_id);
                               fnRe_CargarTablaDatoReferenciaLaboral(data.sel_id);
                         
                                   fnCargarTablaDatoPeriodoInactivo(data.sel_id);

                                   {% if ochenta==1%}
                                   CargarTablaDatoEmpleosOcultos(data.sel_id);
                                   {% endif %}

                                    //alert();
                                   $('#sel_notas').val(data.sel_notas);

                                  $('#sel_empleosocultos').val((data.sel_empleosocultos==null ||data.sel_empleosocultos== '' ? -1 :data.sel_empleosocultos));
                                  $('#sel_empleosocultos').trigger('change');

                              $('#sel_calificacion').val((data.sel_calificacion==null ||data.sel_calificacion== '' ? -1 :data.sel_calificacion));
                              $('#sel_calificacion').trigger('change');

                              
                   
                           }
  
                           
  
                      },
                      error: function(data)
                      {
                          Swal.fire({title:'ERROR',text:'No se pudieron cargar los datos vuelve a intentar de nuevo.',type:"error"})
                                      .then((value) => {

                                          location.reload();  
                                      });
                        
                      }
             });
  
      }
  
      function fnCrearAutomaticoSeccionLaboral(ese_id)
      {
        let url_enviar="<?php echo $this->url->get('seccionlaboral/crear_automatico/') ?>";
  
   
              $.ajax({
                      type: "POST",
                      url: url_enviar+ese_id,
                        
                      success: function(res)
                      {
                       
                            if(res[0]==2)
                            {
                              fnCargarDatosDelFormularioJ(ese_id);
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