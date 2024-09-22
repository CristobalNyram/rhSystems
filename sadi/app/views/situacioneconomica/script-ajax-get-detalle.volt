<script>
        function mostrarOcultarDivMontoIngresoManuntencion(event_current_value,input_trabajado){
          if(event_current_value=='0'||event_current_value=='-1'){
            $('#div_container_sie_manuingresomonto').hide('slow');
            $(`#sie_manuingresomonto`).val(0);

            sumarMontoManuntencionAIngresos(0,$('#sie_id').val(),'sie_totalingresos','sie_manuingresomonto')
            
          }
          if(event_current_value=='1'){
            $('#div_container_sie_manuingresomonto').show('slow');
          }

        }

        function sumarMontoManuntencionAIngresos(event,sie_id,input_mostrar_total,id_current_input){
          let url_enviar="<?php echo $this->url->get('situacioneconomicaingresos/ajax_get_total_ingreso_ese/') ?>";
          let valor_input=event;
   
            $.ajax({
                    type: "POST",
                    url: url_enviar+sie_id,
                    data: {monto_manuntencion: valor_input}, // the data we want to send
                    success: function(res)
                    {
                      if(res[0]=='2'){
                        $(`#${input_mostrar_total}`).val(res['suma_ingresos_manuntencion']);

                      }
                      if(res[0]=='-1'){
                        Swal.fire({title:res['titular'],text:res['mensaje'],type:"warning"})
                                                                                    .then((value) => {
                                                                                      $(`#${id_current_input}`).val(0);
                                                                                      $(`#${input_mostrar_total}`).val(res['total_ingresos']);
                                                                                      // console.log(res);

                                                                                    });
                      }
                      // console.log(res);
                        
                    },
                    error: function(res)
                    {
                      alert('Error en el servidor...');
                      
                    }
            });

        }
  
    function fnCargarDatosDelFormularioG(ese_id=0,sie_id_input,sie_totalingresos_input=0,sie_alimentacion_input=0,sie_renta_input=0
        ,sie_telluzagua_input=0,sie_transporte_input=0,sie_ropacalzado_input=0,sie_escolares_input=0,sie_serviciodomestico_input=0,
        sie_creditos_input,sie_diversiones_input=0,sie_otros_input=0,sie_totalegresos_input,sie_solventa_input=0,
        sie_buro_input=0,sie_institucion_input,sie_calificacion_input
        ){
            
            let form_seccionG=document.getElementById('form_estudio_seccionSituacionEconomica');
            form_seccionG.reset();
  
            
               let url_enviar="<?php echo $this->url->get('situacioneconomica/ajax_get_detalle/') ?>";
  
              $.ajax({
                      type: "POST",
                      url: url_enviar+ese_id,
                        
                      success: function(data)
                      {



                        // console.log(data);

                           if (data.length ==0) {
                             fnCrearAutomaticoSituacionEconomica(ese_id);
                           }
                           else
                           {
                            $(`#${sie_id_input}`).val(data.sie_id);
                            $('#sie_id').val(data.sie_id);
                            fnCargarTablaDatoSituacioneEconomicaIngresos(data.sie_id);
                            fnCargarTablaDatoSituacionEconomicaCreditos(data.sie_id);
                            
                            if(data.sie_totalingresos!='')
                            {
                              $('#sie_totalingresos').val(data.sie_totalingresos);
                            }

                            if(data.sie_alimentacion!='')
                            {
                              $('#sie_alimentacion').val(data.sie_alimentacion);
                            }
                            if(data.sie_renta!='')
                            {
                              $('#sie_renta').val(data.sie_renta);

                            }
 
                            if(data.sie_telluzagua!='')
                            {
                              $('#sie_telluzagua').val(data.sie_telluzagua);

                            }

                            if(data.sie_transporte!='')
                            {
                              $('#sie_transporte').val(data.sie_transporte);

                            }
                            if(data.sie_ropacalzado!='')
                            {
                              $('#sie_ropacalzado').val(data.sie_ropacalzado);

                            }
                            if(data.sie_escolares!='')
                            {
                              $('#sie_escolares').val(data.sie_escolares);

                            }
                            if(data.sie_serviciodomestico!='')
                            {
                              $('#sie_serviciodomestico').val(data.sie_serviciodomestico);

                            }
                           
                            if(data.sie_creditos!='')
                            {
                              $('#sie_creditos').val(data.sie_creditos);

                            }
                            if(data.sie_diversiones!='')
                            {
                              $('#sie_diversiones').val(data.sie_diversiones);

                            }
                            if(data.sie_otros!='')
                            {
                              $('#sie_otros').val(data.sie_otros);

                            }
                            if(data.sie_totalegresos!='')
                            {
                              $('#sie_totalegresos').val(data.sie_totalegresos);

                            }

                            if(data.sie_solventa!='')
                            {
                              $('#sie_solventa').val(data.sie_solventa);

                            }
                            if(data.sie_buro!='')
                            {
                              $('#sie_buro').val(data.sie_buro);

                            }
                            if(data.sie_institucion!='')
                            {
                              $('#sie_institucion').val(data.sie_institucion);

                            }

                            //manuntencion
                  
                            $('#sie_manuingreso').val((data.sie_manuingreso==null || data.sie_manuingreso==''?-1:data.sie_manuingreso));
                            $('#sie_manuingreso').trigger('change');

                            //da manuntencion
                            $('#sie_manuegreso').val((data.sie_manuegreso==null || data.sie_manuegreso==''?-1:data.sie_manuegreso));
                            $('#sie_manuegreso').trigger('change');
                            if(data.sie_manuegresomonto!='')
                            {
                              $('#sie_manuegresomonto').val(data.sie_manuegresomonto);

                            }


                            $('#sie_manuingresomonto').val(data.sie_manuingresomonto);
                            // console.log(data.sie_manuingresomonto);
                           
                              $('#sie_calificacion').val((data.sie_calificacion==null || data.sie_calificacion==''?-1:data.sie_calificacion));
                              $('#sie_calificacion').trigger('change');

                            
                           
    
                   
                           }
  
                           
  
                      },
                      error: function(data)
                      {
                          alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'); 
                        
                      }
             });
  
      }
  
      function fnCrearAutomaticoSituacionEconomica(ese_id)
      {
        let url_enviar="<?php echo $this->url->get('situacioneconomica/crear_automatico/') ?>";
  
   
              $.ajax({
                      type: "POST",
                      url: url_enviar+ese_id,
                        
                      success: function(res)
                      {
                       
                            if(res[0]==2)
                            {
                                fnCargarDatosDelFormularioG(ese_id);
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