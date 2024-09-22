<script>
    function fnCargarDatosDelFormularioH(ese_id=0){
            
            let form_seccionG=document.getElementById('form_estudio_seccionBienesInmuebles');
            form_seccionG.reset();
            $('#bie_calificacion').val('-1');
            $('#bie_calificacion').trigger('change');
                           
            
            let url_enviar="<?php echo $this->url->get('bieninmueble/ajax_get_detalle/') ?>";
  
              $.ajax({
                      type: "POST",
                      url: url_enviar+ese_id,
                        
                      success: function(data)
                      {

                    
                           if (data.length ==0) {
                             fnCrearAutomaticoBienInmueble(ese_id);
                           }
                           else
                           {
                              $('#bie_id').val(data.bie_id);
                              fnCargarTablaDatoBienInmuebleDetalles(data.bie_id);
                              fnCargarTablaAutomovilDetalles(data.bie_id);
                              $('#bie_notasfamiliares').val(data.bie_notasfamiliares);
                              $('#bie_agua').val((data.bie_agua==null || data.bie_agua=='' ? -1 :data.bie_agua));
                              $('#bie_agua').trigger('change');

                              $('#bie_drenaje').val((data.bie_drenaje==null || data.bie_drenaje=='' ? -1 :data.bie_drenaje));
                              $('#bie_drenaje').trigger('change');

                              $('#bie_pavimento').val((data.bie_pavimento==null ||data.bie_pavimento== '' ? -1 :data.bie_pavimento));
                              $('#bie_pavimento').trigger('change');

                              $('#bie_electricidad').val((data.bie_electricidad==null ||data.bie_electricidad== '' ? -1 :data.bie_electricidad));
                              $('#bie_electricidad').trigger('change');

                              $('#bie_escuela').val((data.bie_escuela==null ||data.bie_escuela== '' ? -1 :data.bie_escuela));
                              $('#bie_escuela').trigger('change');


                              $('#bie_nivelzona').val((data.bie_nivelzona==null ||data.bie_nivelzona=='' ? -1 :data.bie_nivelzona));
                              $('#bie_nivelzona').trigger('change');

                              $('#bie_tipo').val((data.bie_tipo==null ||data.bie_tipo== '' ? -1 :data.bie_tipo));
                              $('#bie_tipo').trigger('change');

                              $('#bie_regimen').val((data.bie_regimen==null || data.bie_regimen=='' ? -1 :data.bie_regimen));
                              $('#bie_regimen').trigger('change');

                              $('#bie_mobilario').val((data.bie_mobilario==null ||data.bie_mobilario== '' ? -1 :data.bie_mobilario));
                              $('#bie_mobilario').trigger('change');

                            
                              $('#bie_recamaras').val(data.bie_recamaras);
                              $('#bie_banos').val(data.bie_banos);
                              $('#bie_sala').val(data.bie_sala);
                              $('#bie_comedor').val(data.bie_comedor);

                              $('#bie_garaje').val(data.bie_garaje);
                              $('#bie_habitaranos').val(data.bie_habitaranos);
                              $('#bie_habitarmeses').val(data.bie_habitarmeses);
                              $('#bie_habitardias').val(data.bie_habitardias);
                              $('#bie_domicilioanterior').val(data.bie_domicilioanterior);
                              $('#bie_notasvivienda').val(data.bie_notasvivienda);
    
                              $('#bie_calificacion').val((data.bie_calificacion==null ||data.bie_calificacion== '' ? -1 :data.bie_calificacion));
                              $('#bie_calificacion').trigger('change');

                              
                   
                           }
  
                           
  
                      },
                      error: function(data)
                      {
                          alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'); 
                        
                      }
             });
  
      }
  
      function fnCrearAutomaticoBienInmueble(ese_id)
      {
        let url_enviar="<?php echo $this->url->get('bieninmueble/crear_automatico/') ?>";
  
   
              $.ajax({
                      type: "POST",
                      url: url_enviar+ese_id,
                        
                      success: function(res)
                      {
                       
                            if(res[0]==2)
                            {
                                fnCargarDatosDelFormularioH(ese_id);
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