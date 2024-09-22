<script>
    function fnCargarDatosDelFormularioF(ese_id,agf_padrescuentan_select=0,agf_padresservicio_input=0,agf_conyugecuentan_select=0,agf_conyugeservicio_input=0,agf_notas_input=0,agf_calificacion_select=0,agf_id_input=0){
            
            let form_seccionF=document.getElementById('form_estudio_antecedentegrupofamiliar');
            form_seccionF.reset();
            // $('#dgf_ese_id').val(ese_id);
  
            
            let url_enviar="<?php echo $this->url->get('antecedentegrupofamiliar/ajax_get_detalle/') ?>";
  
              $.ajax({
                      type: "POST",
                      url: url_enviar+ese_id,
                        
                      success: function(data)
                      {

                    
                           if (data.length ==0) {
                             fnCrearAutomaticoAntecedenteGrupoFamiliar(ese_id);
                           }
                           else
                           {


                              fnCargarTablaDatoAntecedentesgrupofamiliardetalles(data.agf_id,data.ese_id);
                      
                             
                       

                       

                              $(`#${agf_id_input}`).val(data.agf_id);
                              $(`#${agf_padrescuentan_select}`).val((data.agf_conyugecuentan==null ?-1:data.agf_padrescuentan ));
                              $(`#${agf_padrescuentan_select}`).trigger('change');

                              $(`#${agf_conyugecuentan_select}`).val((data.agf_conyugecuentan==null ?-1:data.agf_conyugecuentan ));
                              $(`#${agf_conyugecuentan_select}`).trigger('change');

                              
                              $(`#${agf_calificacion_select}`).val((data.agf_calificacion==null ?-1:data.agf_calificacion ));
                              $(`#${agf_calificacion_select}`).trigger('change');
                              $('#agf_padresservicio').val(data.agf_padresservicio);
                              $('#agf_conyugeservicio').val(data.agf_conyugeservicio);

                              $('#agf_notas').val(data.agf_notas);

                              $('#agf_id').val(data.agf_id);    
                   
                           }
  
                           
  
                      },
                      error: function(data)
                      {
                          alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'); 
                        
                      }
             });
  
      }
  
      function fnCrearAutomaticoAntecedenteGrupoFamiliar(ese_id)
      {
        let url_enviar="<?php echo $this->url->get('antecedentegrupofamiliar/crear_automatico_agf/') ?>";
  
   
              $.ajax({
                      type: "POST",
                      url: url_enviar+ese_id,
                        
                      success: function(res)
                      {
                       
                            if(res[0]==2)
                            {
                                fnCargarDatosDelFormularioF(ese_id);
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