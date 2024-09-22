<script>
    function fnCargarDatosDelFormularioE_formato_truper(ese_id){

            $dgf_ese_id_formato_truper=ese_id;
            
            let form_seccionB=document.getElementById('form_estudio_seccionDatosFamiliares_formato_ese_truper');
            form_seccionB.reset();
            $('#dgf_ese_id-formato-truper').val(ese_id);
  
              // console.log(ese_id);
            let url_enviar="<?php echo $this->url->get('datogrupofamiliar/ajax_get_detalle/') ?>";
  
              $.ajax({
                      type: "POST",
                      url: url_enviar+ese_id,
                        
                      success: function(data)
                      {
                           if (data.length ==0) {
                         
                              fnCrearAutomaticoDatoGrupoFamiliar_formato_truper(ese_id);
                           }
                           else
                           {
                            fnCargarDatogrupofamiliardetallesVivenONoVivenFormatoTruper(data[0].dgf_id);
                            fnCargarDatogrupofamiliardetallesNegociooTrabajoEnFormatoTruper(data[0].dgf_id);
                            fnCargarDatogrupofamiliardetallesTrabajanCompaniaFormatoTruper(data[0].dgf_id);
                            $('#dgf_comentario-formato-truper').val(data[0].dgf_comentario);
                            $('#dgf_id-formato-truper').val(data[0].dgf_id);
            
                            
  
    
                       
                           }
  
  
  
                      },
                      error: function(data)
                      {
                          alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'); 
                        
                      }
             });
  
      }
  
      function fnCrearAutomaticoDatoGrupoFamiliar_formato_truper(ese_id)
      {
        let url_enviar="<?php echo $this->url->get('datogrupofamiliar/crear_automatico_dgf/') ?>";
  
              $.ajax({
                      type: "POST",
                      url: url_enviar+ese_id,
                        
                      success: function(res)
                      {
  
                            if(res[0]==2)
                            {
                                fnCargarDatosDelFormularioE_formato_truper(ese_id);
                            }
                            else
                            {
                              alertify.alert('ERROR','ERROR AL PROCESAR LOS DATOS'); 
  
                            }
  
  
                      },
                      error: function(res)
                      {
                          alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'); 
                        
                      }
              });
            
          
        }
  
    
  
  </script>