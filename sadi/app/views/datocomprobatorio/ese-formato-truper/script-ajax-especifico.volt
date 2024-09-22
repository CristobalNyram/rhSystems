
<!-- funcion para cargar los datos de datos comprobatorios -->
<script>
      function fnCargarDatosComprobatorios_especifico_adapatable_formato_truper(ese_id)
       {
         let url_enviar="<?php echo $this->url->get('datocomprobatorio/ajax_encontrar_o_crear/') ?>";

          $.ajax({
              type: "POST",
              url: url_enviar+ese_id,
                
              success: function(res)
              {
                    if (res.data.length==0) {
                       alertify.alert('DATOS','Error al procesar los datos...');

                    } 
                    else
                    {
                      let data=res.data;

                      $('#cop_ese_id-formato_truper').val(ese_id);
                      $('#cop_id-formato_truper').val(data.cop_id);
                      $('#cop_nacimientocantidad-formato_truper').val((data.cop_nacimientocantidad==null||data.cop_nacimientocantidad==''|| is_number(data.cop_nacimientocantidad)==null ) ? -1 : data.cop_nacimientocantidad);
                      $('#cop_nacimientocantidad-formato_truper').trigger('change');

                      $('#cop_nacimientofolio-formato_truper').val(data.cop_nacimientofolio);
                      $('#cop_nacimientocomentario-formato_truper').val(data.cop_nacimientocomentario);

                      let valor_cop_nacimientotipodoc =(data.cop_nacimientotipodoc==null || data.cop_nacimientotipodoc==-1) ?-1 :data.cop_nacimientotipodoc;
                      $('#cop_nacimientotipodoc-formato_truper').val(valor_cop_nacimientotipodoc);
                      $('#cop_nacimientotipodoc-formato_truper').trigger('change');

                      $('#cop_matrimoniocantidad-formato_truper').val((data.cop_matrimoniocantidad==null||data.cop_matrimoniocantidad==''|| is_number(data.cop_matrimoniocantidad)==null ) ? -1 : data.cop_matrimoniocantidad);
                      $('#cop_matrimoniocantidad-formato_truper').trigger('change');

                      $('#cop_matrimoniofolio-formato_truper').val(data.cop_matrimoniofolio);
                      $('#cop_matrimoniocomentario-formato_truper').val(data.cop_matrimoniocomentario);
                      let valor_cop_matrimoniotipodoc =(data.cop_matrimoniotipodoc==null || data.cop_matrimoniotipodoc==-1) ?-1 :data.cop_matrimoniotipodoc;
                      $('#cop_matrimoniotipodoc-formato_truper').val(valor_cop_matrimoniotipodoc);
                      $('#cop_matrimoniotipodoc-formato_truper').trigger('change');

                      $('#cop_conyugecomentario-formato_truper').val(data.cop_conyugecomentario);

                      $('#cop_conyugecantidad-formato_truper').val((data.cop_conyugecantidad==null||data.cop_conyugecantidad==''|| is_number(data.cop_conyugecantidad)==null ) ? -1 : data.cop_conyugecantidad);
                      $('#cop_conyugecantidad-formato_truper').trigger('change');

                      $('#cop_conyugefolio-formato_truper').val(data.cop_conyugefolio);
                      let valor_cop_conyugetipodoc =(data.cop_conyugetipodoc==null || data.cop_conyugetipodoc==-1) ?-1 :data.cop_conyugetipodoc;
                      $('#cop_conyugetipodoc-formato_truper').val(valor_cop_conyugetipodoc);
                      $('#cop_conyugetipodoc-formato_truper').trigger('change');


                      $('#cop_nacimientohijoscantidad-formato_truper').val((data.cop_nacimientohijoscantidad==null||data.cop_nacimientohijoscantidad==''|| is_number(data.cop_nacimientohijoscantidad)==null ) ? -1 : data.cop_nacimientohijoscantidad);
                      $('#cop_nacimientohijoscantidad-formato_truper').trigger('change');

                      $('#cop_nacimientohijosfolio-formato_truper').val(data.cop_nacimientohijosfolio);
                      $('#cop_nacimientohijoscomentario-formato_truper').val(data.cop_nacimientohijoscomentario);
                      let valor_cop_nacimientohijostipodoc =(data.cop_nacimientohijostipodoc==null || data.cop_nacimientohijostipodoc==-1) ?-1 :data.cop_nacimientohijostipodoc;
                      $('#cop_nacimientohijostipodoc-formato_truper').val(valor_cop_nacimientohijostipodoc);
                      $('#cop_nacimientohijostipodoc-formato_truper').trigger('change');


                      $('#cop_comprobantedomiciliofolio-formato_truper').val(data.cop_comprobantedomiciliofolio);
                      $('#cop_comprobantedomiciliocantidad-formato_truper').val((data.cop_comprobantedomiciliocantidad==null||data.cop_comprobantedomiciliocantidad==''|| is_number(data.cop_comprobantedomiciliocantidad)==null ) ? -1 : data.cop_comprobantedomiciliocantidad);
                      $('#cop_comprobantedomiciliocantidad-formato_truper').trigger('change');

                      $('#cop_comprobantedomiciliocomentario-formato_truper').val(data.cop_comprobantedomiciliocomentario);
                      let cop_comprobantedomiciliotipodoc_valor =(data.cop_comprobantedomiciliotipodoc==null || data.cop_comprobantedomiciliotipodoc==-1) ?-1 :data.cop_comprobantedomiciliotipodoc;
                      $('#cop_comprobantedomiciliotipodoc-formato_truper').val(cop_comprobantedomiciliotipodoc_valor);
                      $('#cop_comprobantedomiciliotipodoc-formato_truper').trigger('change');


                      $('#cop_credencialelectorcantidad-formato_truper').val((data.cop_credencialelectorcantidad==null||data.cop_credencialelectorcantidad==''|| is_number(data.cop_credencialelectorcantidad)==null ) ? -1 : data.cop_credencialelectorcantidad);
                      $('#cop_credencialelectorcantidad-formato_truper').trigger('change');

                      $('#cop_credencialelectorfolio-formato_truper').val(data.cop_credencialelectorfolio);
                      $('#cop_credencialelectorcomentario-formato_truper').val(data.cop_credencialelectorcomentario);
                      let cop_credencialelectortipodoc_valor =(data.cop_credencialelectortipodoc==null || data.cop_credencialelectortipodoc==-1) ?-1 :data.cop_credencialelectortipodoc;
                      $('#cop_credencialelectortipodoc-formato_truper').val(cop_credencialelectortipodoc_valor);
                      $('#cop_credencialelectortipodoc-formato_truper').trigger('change');


                        if(data.cop_curpfolio==null || data.cop_curpfolio==''){
                          $('#cop_curpfolio-formato_truper').val(res.estudio_data.ese_curp);
                        }else{
                          $('#cop_curpfolio-formato_truper').val(data.cop_curpfolio);

                        }

                        if(data.cop_imssfolio==null || data.cop_imssfolio==''){
                          $('#cop_imssfolio-formato_truper').val(res.estudio_data.ese_nss);


                        }else{
                          $('#cop_imssfolio-formato_truper').val(data.cop_imssfolio);

                        }
                      
                      $('#cop_curpcomentario-formato_truper').val(data.cop_curpcomentario);


                      $('#cop_curpcantidad-formato_truper').val((data.cop_curpcantidad==null||data.cop_curpcantidad==''|| is_number(data.cop_curpcantidad)==null ) ? -1 : data.cop_curpcantidad);
                      $('#cop_curpcantidad-formato_truper').trigger('change');


                      let cop_curptipodoc_valor =(data.cop_curptipodoc==null || data.cop_curptipodoc==-1) ?-1 :data.cop_curptipodoc;
                      $('#cop_curptipodoc-formato_truper').val(cop_curptipodoc_valor);
                      $('#cop_curptipodoc-formato_truper').trigger('change');

                      $('#cop_imsscantidad-formato_truper').val((data.cop_imsscantidad==null||data.cop_imsscantidad==''|| is_number(data.cop_imsscantidad)==null ) ? -1 : data.cop_imsscantidad);

                      $('#cop_imsscantidad-formato_truper').trigger('change');

                      $('#cop_imsscomentario-formato_truper').val(data.cop_imsscomentario);
                      let cop_imsstipodoc =(data.cop_imsstipodoc==null || data.cop_imsstipodoc==-1) ?-1 :data.cop_imsstipodoc;
                      $('#cop_imsstipodoc-formato_truper').val(cop_imsstipodoc);
                      $('#cop_imsstipodoc-formato_truper').trigger('change');


                      $('#cop_rfcfolio-formato_truper').val(data.cop_rfcfolio);
                      $('#cop_rfccantidad-formato_truper').val((data.cop_rfccantidad==null||data.cop_rfccantidad==''|| is_number(data.cop_rfccantidad)==null ) ? -1 : data.cop_rfccantidad);

                      $('#cop_rfccantidad-formato_truper').trigger('change');


                      $('#cop_rfccomentario-formato_truper').val(data.cop_rfccomentario);
                      let cop_rfctipodoc =(data.cop_rfctipodoc==null || data.cop_rfctipodoc==-1) ?-1 :data.cop_rfctipodoc;
                      $('#cop_rfctipodoc-formato_truper').val(cop_rfctipodoc);
                      $('#cop_rfctipodoc-formato_truper').trigger('change');

                      $('#cop_licenciacantidad-formato_truper').val((data.cop_licenciacantidad==null||data.cop_licenciacantidad==''|| is_number(data.cop_licenciacantidad)==null ) ? -1 : data.cop_licenciacantidad);

                      $('#cop_licenciacantidad-formato_truper').trigger('change');

                      $('#cop_licenciafolio-formato_truper').val(data.cop_licenciafolio);
                      $('#cop_licenciacomentario-formato_truper').val(data.cop_licenciacomentario);
                      let cop_licenciatipodoc =(data.cop_licenciatipodoc==null || data.cop_licenciatipodoc==-1) ?-1 :data.cop_licenciatipodoc;
                      $('#cop_licenciatipodoc-formato_truper').val(cop_licenciatipodoc);
                      $('#cop_licenciatipodoc-formato_truper').trigger('change');


                      
                      $('#cop_visafolio-formato_truper').val(data.cop_visafolio);
                      $('#cop_visacantidad-formato_truper').val((data.cop_visacantidad==null||data.cop_visacantidad==''|| is_number(data.cop_visacantidad)==null ) ? -1 : data.cop_visacantidad);


                      $('#cop_visacantidad-formato_truper').trigger('change');

                      $('#cop_visacomentario-formato_truper').val(data.cop_visacomentario);
                      let cop_visatipodoc =(data.cop_visatipodoc==null || data.cop_visatipodoc==-1) ?-1 :data.cop_visatipodoc;
                      $('#cop_visatipodoc-formato_truper').val(cop_visatipodoc);
                      $('#cop_visatipodoc-formato_truper').trigger('change');


                      
                      $('#cop_pasaportefolio-formato_truper').val(data.cop_pasaportefolio);
                      $('#cop_pasaportecantidad-formato_truper').val((data.cop_pasaportecantidad==null||data.cop_pasaportecantidad==''|| is_number(data.cop_pasaportecantidad)==null ) ? -1 : data.cop_pasaportecantidad);

                      $('#cop_pasaportecantidad-formato_truper').trigger('change');


                      $('#cop_pasaportecomentario-formato_truper').val(data.cop_pasaportecomentario);
                      let cop_pasaportetipodoc =(data.cop_pasaportetipodoc==null || data.cop_pasaportetipodoc==-1) ?-1 :data.cop_pasaportetipodoc;
                      $('#cop_pasaportetipodoc-formato_truper').val(cop_pasaportetipodoc);
                      $('#cop_pasaportetipodoc-formato_truper').trigger('change');



                      
                      $('#cop_ultimosestudiosfolio-formato_truper').val(data.cop_ultimosestudiosfolio);
                      $('#cop_ultimosestudioscantidad-formato_truper').val((data.cop_ultimosestudioscantidad==null||data.cop_ultimosestudioscantidad==''|| is_number(data.cop_ultimosestudioscantidad)==null ) ? -1 : data.cop_ultimosestudioscantidad);

                      $('#cop_ultimosestudioscantidad-formato_truper').trigger('change');

                      $('#cop_ultimosestudioscomentario-formato_truper').val(data.cop_ultimosestudioscomentario);
                      let cop_ultimosestudiostipodoc =(data.cop_ultimosestudiostipodoc==null || data.cop_ultimosestudiostipodoc==-1) ?-1 :data.cop_ultimosestudiostipodoc;
                      $('#cop_ultimosestudiostipodoc-formato_truper').val(cop_ultimosestudiostipodoc);
                      $('#cop_ultimosestudiostipodoc-formato_truper').trigger('change');
                    

                      $('#cop_cedulaprofesionalfolio-formato_truper').val(data.cop_cedulaprofesionalfolio);

                      $('#cop_cedulaprofesionalcantidad-formato_truper').val((data.cop_cedulaprofesionalcantidad==null||data.cop_cedulaprofesionalcantidad==''|| is_number(data.cop_cedulaprofesionalcantidad)==null ) ? -1 : data.cop_cedulaprofesionalcantidad);

                      $('#cop_cedulaprofesionalcantidad-formato_truper').trigger('change');

                      $('#cop_cedulaprofesionalcomentario-formato_truper').val(data.cop_cedulaprofesionalcomentario);
                      
                      let cop_cedulaprofesionaltipodoc =(data.cop_cedulaprofesionaltipodoc==null || data.cop_cedulaprofesionaltipodoc==-1) ?-1 :data.cop_cedulaprofesionaltipodoc;
                      $('#cop_cedulaprofesionaltipodoc-formato_truper').val(cop_cedulaprofesionaltipodoc);
                      $('#cop_cedulaprofesionaltipodoc-formato_truper').trigger('change');

                      $('#cop_recibosnominafolio-formato_truper').val(data.cop_recibosnominafolio);
                      $('#cop_recibosnominacantidad-formato_truper').val((data.cop_recibosnominacantidad==null||data.cop_recibosnominacantidad==''|| is_number(data.cop_recibosnominacantidad)==null ) ? -1 : data.cop_recibosnominacantidad);

                      $('#cop_recibosnominacantidad-formato_truper').trigger('change');

                      $('#cop_recibosnominacomentario-formato_truper').val(data.cop_recibosnominacomentario);
                      let cop_recibosnominatipodoc =(data.cop_recibosnominatipodoc==null || data.cop_recibosnominatipodoc==-1) ?-1 :data.cop_recibosnominatipodoc;
                      $('#cop_recibosnominatipodoc-formato_truper').val(cop_recibosnominatipodoc);
                      $('#cop_recibosnominatipodoc-formato_truper').trigger('change');
                    

                      $('#cop_segurosgastommfolio-formato_truper').val(data.cop_segurosgastommfolio);
                      $('#cop_segurosgastommcantidad-formato_truper').val((data.cop_segurosgastommcantidad==null||data.cop_segurosgastommcantidad==''|| is_number(data.cop_segurosgastommcantidad)==null ) ? -1 : data.cop_segurosgastommcantidad);
                      $('#cop_segurosgastommcantidad-formato_truper').trigger('change');

                      $('#cop_segurosgastommcomentario-formato_truper').val(data.cop_segurosgastommcomentario);
                      let cop_segurosgastommtipodoc =(data.cop_segurosgastommtipodoc==null || data.cop_segurosgastommtipodoc==-1) ?-1 :data.cop_segurosgastommtipodoc;
                      $('#cop_segurosgastommtipodoc-formato_truper').val(cop_segurosgastommtipodoc);
                      $('#cop_segurosgastommtipodoc-formato_truper').trigger('change');

                      $('#cop_aforefolio-formato_truper').val(data.cop_aforefolio);
                      $('#cop_aforecantidad-formato_truper').val((data.cop_aforecantidad==null||data.cop_aforecantidad==''|| is_number(data.cop_aforecantidad)==null ) ? -1 : data.cop_aforecantidad);

                      $('#cop_aforecantidad-formato_truper').trigger('change');

                      $('#cop_aforecomentario-formato_truper').val(data.cop_aforecomentario);
                      let cop_aforetipodoc =(data.cop_aforetipodoc==null || data.cop_aforetipodoc==-1) ?-1 :data.cop_aforetipodoc;
                      $('#cop_aforetipodoc-formato_truper').val(cop_aforetipodoc);
                      $('#cop_aforetipodoc-formato_truper').trigger('change');


                      $('#cop_recomendacionesfolio-formato_truper').val(data.cop_recomendacionesfolio);

                      $('#cop_recomendacionescantidad-formato_truper').val((data.cop_recomendacionescantidad==null||data.cop_recomendacionescantidad==''|| is_number(data.cop_recomendacionescantidad)==null ) ? -1 : data.cop_recomendacionescantidad);
                      $('#cop_recomendacionescantidad-formato_truper').trigger('change');

                      $('#cop_recomendacionescomentario-formato_truper').val(data.cop_recomendacionescomentario);
                      let cop_recomendacionestipodoc =(data.cop_recomendacionestipodoc==null || data.cop_recomendacionestipodoc==-1) ?-1 :data.cop_recomendacionestipodoc;
                      $('#cop_recomendacionestipodoc-formato_truper').val(cop_recomendacionestipodoc);
                      $('#cop_recomendacionestipodoc-formato_truper').trigger('change');


                      $('#cop_ingresosadicionalesfolio-formato_truper').val(data.cop_ingresosadicionalesfolio);
                      $('#cop_ingresosadicionalescantidad-formato_truper').val((data.cop_ingresosadicionalescantidad==null||data.cop_ingresosadicionalescantidad==''|| is_number(data.cop_ingresosadicionalescantidad)==null ) ? -1 : data.cop_ingresosadicionalescantidad);
                      $('#cop_ingresosadicionalescantidad-formato_truper').trigger('change');

                      $('#cop_ingresosadicionalescomentario-formato_truper').val(data.cop_ingresosadicionalescomentario);
                      let cop_ingresosadicionalestipodoc =(data.cop_ingresosadicionalestipodoc==null || data.cop_ingresosadicionalestipodoc==-1) ?-1 :data.cop_ingresosadicionalestipodoc;
                      $('#cop_ingresosadicionalestipodoc-formato_truper').val(cop_ingresosadicionalestipodoc);
                      $('#cop_ingresosadicionalestipodoc-formato_truper').trigger('change');

                      $('#cop_cartillafolio-formato_truper').val(data.cop_cartillafolio);
                      $('#cop_cartillacantidad-formato_truper').val((data.cop_cartillacantidad==null||data.cop_cartillacantidad==''|| is_number(data.cop_cartillacantidad)==null ) ? -1 : data.cop_cartillacantidad);
                      $('#cop_cartillacantidad-formato_truper').trigger('change');

                      $('#cop_cartillacomentario-formato_truper').val(data.cop_cartillacomentario);
                      let cop_cartillatipodoc =(data.cop_cartillatipodoc==null || data.cop_cartillatipodoc==-1) ?-1 :data.cop_cartillatipodoc;
                      $('#cop_cartillatipodoc-formato_truper').val(cop_cartillatipodoc);
                      $('#cop_cartillatipodoc-formato_truper').trigger('change');


               
           
                     
                    }


              },
              error: function(res)
              {
                  alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'); 
                
              }
          });
  }
</script>