<script>


 
function fnCargarDatosDelFormularioGFormatoTruper(ese_id){
            
            
               let url_enviar="<?php echo $this->url->get('situacioneconomica/ajax_get_detalle_formato_truper/') ?>";
  
              $.ajax({
                      type: "POST",
                      url: url_enviar+ese_id,
                        
                      success: function(res)
                      {

                        fnCargarTablaDatoSituacioneEconomicaIngresosFamiliares_FormatoTruper(res.data_sef.sef_id);
                        fnCargarTablaDatoSituacioneEconomicaIngresosCandidato_FormatoTruper(res.data_sie.sie_id);
                        

                        
                        $('#sef_id-formato_truper').val(res.data_sef.sef_id);
                        $('#sie_id-formato_truper').val(res.data_sie.sie_id);


                        $('#sie_totalingresos-formato_truper').val(res.data_sie.data.sie_totalingresos);

                        
                        $('#sie_totalingresos-formato_truper').val(res.data_sie.data.sie_totalingresos);
                        $('#sie_alimentacion-formato_truper').val(res.data_sie.data.sie_alimentacion);
                        $('#sie_ropacalzado-formato_truper').val(res.data_sie.data.sie_ropacalzado);
                        $('#sie_serviciodomestico-formato_truper').val(res.data_sie.data.sie_serviciodomestico);
                        $('#sie_escolares-formato_truper').val(res.data_sie.data.sie_escolares);
                        $('#sie_creditos-formato_truper').val(res.data_sie.data.sie_creditos);
                        $('#sie_seguros-formato_truper').val(res.data_sie.data.sie_seguros);

                        $('#sie_hipoteca-formato_truper').val(res.data_sie.data.sie_hipoteca);
                        $('#sie_diversiones-formato_truper').val(res.data_sie.data.sie_diversiones);
                        $('#sie_mascotas-formato_truper').val(res.data_sie.data.sie_mascotas);
                        $('#sie_ahorros-formato_truper').val(res.data_sie.data.sie_ahorros);
                        $('#sie_renta-formato_truper').val(res.data_sie.data.sie_renta);
                        $('#sie_otros-formato_truper').val(res.data_sie.data.sie_otros);
                        $('#sie_totalegresos-formato_truper').val(res.data_sie.data.sie_totalegresos);

                        
                        $('#sef_totalingresosfamiliares-formato_truper').val(res.data_sef.data.sef_totalingresos);
                        $('#sef_alimentacion-formato_truper').val(res.data_sef.data.sef_alimentacion);
                        $('#sef_ropacalzado-formato_truper').val(res.data_sef.data.sef_ropacalzado);
                        $('#sef_serviciodomestico-formato_truper').val(res.data_sef.data.sef_serviciodomestico);
                        $('#sef_escolares-formato_truper').val(res.data_sef.data.sef_escolares);
                        $('#sef_creditos-formato_truper').val(res.data_sef.data.sef_creditos);
                        $('#sef_seguros-formato_truper').val(res.data_sef.data.sef_seguros);
                        $('#sef_hipotecas-formato_truper').val(res.data_sef.data.sef_hipotecas);
                        $('#sef_diversiones-formato_truper').val(res.data_sef.data.sef_diversiones);

                        $('#sef_mascotas-formato_truper').val(res.data_sef.data.sef_mascotas);
                        $('#sef_ahorro-formato_truper').val(res.data_sef.data.sef_ahorro);
                        $('#sef_renta-formato_truper').val(res.data_sef.data.sef_renta);
                        $('#sef_otros-formato_truper').val(res.data_sef.data.sef_otros);
                        $('#sef_totalegresos-formato_truper').val(res.data_sef.data.sef_totalegresos);

                        $('#sie_solventa-formato_truper').val(res.data_sie.data.sie_solventa);

                           

                        $('#sie_otrosconcepto-formato_truper').val(res.data_sie.data.sie_otrosconcepto);
                        $('#sie_sueldoingreso-formato_truper').val(res.data_sie.data.sie_sueldoingreso);

                        $('#sef_otrosconcepto-formato_truper').val(res.data_sef.data.sef_otrosconcepto);

                        $('#sef_conyugeingreso-formato_truper').val(res.data_sef.data.sef_conyugeingreso);
                        $('#sef_hijosmenoresingreso-formato_truper').val(res.data_sef.data.sef_hijosmenoresingreso);
                        $('#sef_hijosadultosingreso-formato_truper').val(res.data_sef.data.sef_hijosadultosingreso);
                        $('#sef_padresingreso-formato_truper').val(res.data_sef.data.sef_padresingreso);
                        $('#sef_hermanosingreso-formato_truper').val(res.data_sef.data.sef_hermanosingreso);


  
                      },
                      error: function(res)
                      {
                          alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'); 
                        
                      }
             });
  
      }
  
    
  
  </script>