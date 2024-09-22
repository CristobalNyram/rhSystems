<script>
    function fnCargarDatosDelFormularioE_formato_gabtubos(ese_id=0){
            
            let form_seccionI=document.getElementById('form_estudio_seccionReferenciasLaborales_formato_gabtubos');
            form_seccionI.reset();
            $('#sel_calificacion_formato_gabtubos').val('-1');
            $('#sel_calificacion_formato_gabtubos').trigger('change');
                           
            
            let url_enviar="<?php echo $this->url->get('seccionlaboral/ajax_get_detalle/') ?>";
  
              $.ajax({
                      type: "POST",
                      url: url_enviar+ese_id,
                        
                      success: function(data)
                      {

                    
                           if (data.length ==0) {
                             fnCrearAutomaticoSeccionLaboral_formato_gabtubos(ese_id);
                           }
                           else
                           {
                               $('#sel_id_formato_gabtubos').val(data.sel_id);
                               fnCargarTablaDatoReferenciaLaboral_formato_gabtubos(data.sel_id);
                               fnCargarTablaDatoReferenciaLaboral_formato_gabtubos(data.sel_id);
                               fnCargarTablaDatoPeriodoInactivo_formato_gabtubos(data.sel_id);
                               
                               {% if ochenta==1%}
                                  fnCargarTablaDatoEmpleosOcultos_formato_gabtubos(data.sel_id);
                               {% endif %}

                               $('#sel_notas').val(data.sel_notas);

                               $('#sel_notas_formato_gabtubos').val(data.sel_notas);
                               $('#sel_empleosocultos_formato_gabtubos').val((data.sel_empleosocultos==null ||data.sel_empleosocultos== '' ? -1 :data.sel_empleosocultos));
                              $('#sel_empleosocultos_formato_gabtubos').trigger('change');
    
                              $('#sel_calificacion_formato_gabtubos').val((data.sel_calificacion==null ||data.sel_calificacion== '' ? -1 :data.sel_calificacion));
                              $('#sel_calificacion_formato_gabtubos').trigger('change');

                              
                   
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
  
      function fnCrearAutomaticoSeccionLaboral_formato_gabtubos(ese_id)
      {
        let url_enviar="<?php echo $this->url->get('seccionlaboral/crear_automatico/') ?>";
  
   
              $.ajax({
                      type: "POST",
                      url: url_enviar+ese_id,
                        
                      success: function(res)
                      {
                      //  console.log(ese_id);
                        
                       
                            if(res[0]==2)
                            {
                              fnCargarDatosDelFormularioE_formato_gabtubos(ese_id);
                            }
                            else
                            {
                              //alert();
                              // alertify.alert(res['titulo'],res['mensaje']); 
  
                            }

                           
                      },
                      error: function(res)
                      {
                          alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'); 
                        
                      }
              });
            
          
        }
  
    
  
  </script>