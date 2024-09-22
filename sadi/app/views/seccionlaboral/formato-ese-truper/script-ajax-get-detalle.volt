<script>

    function fnCargarDatosDelFormularioI_formato_truper(ese_id=0){
            
            let form_seccion=document.getElementById('form_estudio_seccionReferenciasLaborales_formato_truper');
            form_seccion.reset();
      
            
            let url_enviar="<?php echo $this->url->get('seccionlaboral/ajax_get_detalle/') ?>";
  
              $.ajax({
                      type: "POST",
                      url: url_enviar+ese_id,
                        
                      success: function(data)
                      {

                    
                           if (data.length ==0) {
                             fnCrearAutomaticoSeccionLaboral_formato_truper(ese_id);
                           }
                           else
                           {
                            fnCargarTablaDatoReferenciaLaboralFormatoTruper(data.sel_id);

                            $('#sel_id-formato_truper').val(data.sel_id);

                            getDataTrayectoriaRegistrado(data.sel_id);
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
  
      function fnCrearAutomaticoSeccionLaboral_formato_truper(ese_id)
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
                              fnCargarDatosDelFormularioI_formato_truper(ese_id);
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


        function getDataTrayectoriaRegistrado(sel_id){
       
            
            let url_enviar="<?php echo $this->url->get('trayectorialaboralregistrado/ajax_encontrar_crear_detalle/') ?>";
  
              $.ajax({
                      type: "POST",
                      url: url_enviar+sel_id,
                        
                      success: function(res)
                      {

                        let data_trl=res.data_trl.data;
                    // console.log(data);

                    {% if sesentaytres==1  %} 

                        fnCargarTablaDatoTrayectorialaboralFormatoTruper(sel_id);
                    {% endif %}

                    {% if sesentaycuatro==1  %} 
                         fnCargarTablaDatoTrayectorialaboralregistradodetallesFormatoTruper(data_trl.tlr_id);
                        $('#tlr_empresasnoreconoce-formato_truper').val(data_trl.tlr_empresasnoreconoce);

                        $('#tlr_id-formato_truper').val(data_trl.tlr_id);


                        $('#tlr_reconocehabeestado-formato_truper').val((data_trl.tlr_reconocehabeestado==-1 ||data_trl.tlr_reconocehabeestado == null?-1:data_trl.tlr_reconocehabeestado));
                        $('#tlr_reconocehabeestado-formato_truper').trigger('change');

                        $('#tlr_datocandidatocontienetelcontacto-formato_truper').val((data_trl.tlr_datocandidatocontienetelcontacto==-1 ||data_trl.tlr_datocandidatocontienetelcontacto == null?-1:data_trl.tlr_datocandidatocontienetelcontacto));
                        $('#tlr_datocandidatocontienetelcontacto-formato_truper').trigger('change');

                        $('#tlr_datocandidatocontienenombrescontacto-formato_truper').val((data_trl.tlr_datocandidatocontienenombrescontacto==-1 ||data_trl.tlr_datocandidatocontienenombrescontacto == null?-1:data_trl.tlr_datocandidatocontienenombrescontacto));
                        $('#tlr_datocandidatocontienenombrescontacto-formato_truper').trigger('change');
                        
                        $('#tlr_coincidefechacandadidatoobtenida-formato_truper').val((data_trl.tlr_coincidefechacandadidatoobtenida==-1 ||data_trl.tlr_coincidefechacandadidatoobtenida == null?-1:data_trl.tlr_coincidefechacandadidatoobtenida));
                        $('#tlr_coincidefechacandadidatoobtenida-formato_truper').trigger('change');

                        $('#tlr_coincidedatoscandidadtoinvestigador-formato_truper').val((data_trl.tlr_coincidedatoscandidadtoinvestigador==-1 ||data_trl.tlr_coincidedatoscandidadtoinvestigador == null?-1:data_trl.tlr_coincidedatoscandidadtoinvestigador));
                        $('#tlr_coincidedatoscandidadtoinvestigador-formato_truper').trigger('change');
                        

                    {% endif %}
                       
                        
  
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

   
    
  
  </script>