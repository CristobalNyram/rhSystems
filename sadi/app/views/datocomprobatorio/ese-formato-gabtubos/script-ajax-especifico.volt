
<!-- funcion para cargar los datos de datos comprobatorios -->
<script>
      function fnCargarDatosComprobatorios_especifico_adapatable_formato_gabtubos(ese_id)
       {
         let url_enviar="<?php echo $this->url->get('datocomprobatorio/ajax_get_especifico/') ?>";

          $.ajax({
              type: "POST",
              url: url_enviar+ese_id,
                
              success: function(data)
              {
                    if (data.length==0) {
                      // alertify.alert('DATOS','El cuestionario aún no tiene datos comprobatorios');

                    } 
                    else
                    {
                      // alert();
                      //console.log(data);
                      
                      $('#cop_nacimientofecha_formato_gabtubos').val(data[0].cop_nacimientofecha);
                      $('#cop_nacimientolugar_formato_gabtubos').val(data[0].cop_nacimientolugar);
                      $('#cop_nacimientofolio_formato_gabtubos').val(data[0].cop_nacimientofolio);

                      $('#cop_matrimoniofecha_formato_gabtubos').val(data[0].cop_matrimoniofecha);
                      $('#cop_matrimoniolugar_formato_gabtubos').val(data[0].cop_matrimoniolugar);
                      $('#cop_matrimoniofolio_formato_gabtubos').val(data[0].cop_matrimoniofolio);
                      
                      $('#cop_conyugefecha_formato_gabtubos').val(data[0].cop_conyugefecha);
                      $('#cop_conyugelugar_formato_gabtubos').val(data[0].cop_conyugelugar);
                      $('#cop_conyugefolio_formato_gabtubos').val(data[0].cop_conyugefolio);

                     

                      $('#cop_nacimientohijosfecha_formato_gabtubos').val(data[0].cop_nacimientohijosfecha);
                      $('#cop_nacimientohijoslugar_formato_gabtubos').val(data[0].cop_nacimientohijoslugar);
                      $('#cop_nacimientohijosfolio_formato_gabtubos').val(data[0].cop_nacimientohijosfolio);

             
                      $('#cop_comprobantedomiciliofecha_formato_gabtubos').val(data[0].cop_comprobantedomiciliofecha);
                      $('#cop_comprobantedomiciliolugar_formato_gabtubos').val(data[0].cop_comprobantedomiciliolugar);
                      $('#cop_comprobantedomiciliofolio_formato_gabtubos').val(data[0].cop_comprobantedomiciliofolio);

                      $('#cop_credencialelectorfecha_formato_gabtubos').val(data[0].cop_credencialelectorfecha);
                      $('#cop_credencialelectorlugar_formato_gabtubos').val(data[0].cop_credencialelectorlugar);
                      $('#cop_credencialelectorfolio_formato_gabtubos').val(data[0].cop_credencialelectorfolio);

                      $('#cop_curpfecha_formato_gabtubos').val(data[0].cop_curpfecha);
                      $('#cop_curplugar_formato_gabtubos').val(data[0].cop_curplugar);

                      if(data[0].cop_curpfolio!=null ||  $data[0].cop_curpfolio!='')
                      {
                        // $('#cop_curpfolio').val(data.ese_curp);
                        $('#cop_curpfolio_formato_gabtubos').val(data[0].cop_curpfolio);

                      }


                      $('#cop_imssfecha_formato_gabtubos').val(data[0].cop_imssfecha);
                      $('#cop_imsslugar_formato_gabtubos').val(data[0].cop_imsslugar);

                      if(data[0].cop_imssfolio!='' || data[0].cop_imssfolio!=null)
                      {
                        $('#cop_imssfolio_formato_gabtubos').val(data[0].cop_imssfolio);

                      }

                      //
                      $('#cop_retencionfecha_formato_gabtubos').val(data[0].cop_retencionfecha);
                      $('#cop_retencionlugar_formato_gabtubos').val(data[0].cop_retencionlugar);
                      $('#cop_retencionfolio_formato_gabtubos').val(data[0].cop_retencionfolio);

                      $('#cop_rfcfecha_formato_gabtubos').val(data[0].cop_rfcfecha);
                      $('#cop_rfclugar_formato_gabtubos').val(data[0].cop_rfclugar);
                      $('#cop_rfcfolio_formato_gabtubos').val(data[0].cop_rfcfolio);

                      $('#cop_cartillafecha_formato_gabtubos').val(data[0].cop_cartillafecha);
                      $('#cop_cartillalugar_formato_gabtubos').val(data[0].cop_cartillalugar);
                      $('#cop_cartillafolio_formato_gabtubos').val(data[0].cop_cartillafolio);
                      

                      $('#cop_licenciafecha_formato_gabtubos').val(data[0].cop_licenciafecha);
                      $('#cop_licencialugar_formato_gabtubos').val(data[0].cop_licencialugar);
                      $('#cop_licenciafolio_formato_gabtubos').val(data[0].cop_licenciafolio);

                      $('#cop_migratoriafecha_formato_gabtubos').val(data[0].cop_migratoriafecha);
                      $('#cop_migratorialugar_formato_gabtubos').val(data[0].cop_migratorialugar);
                      $('#cop_migratoriafolio_formato_gabtubos').val(data[0].cop_migratoriafolio);

                      let valor_cop_calificacion =(data[0].cop_calificacion==null || data[0].cop_calificacion==-1) ?-1 :data[0].cop_calificacion;
                      // $("#cop_calificacion").select2("val", valor_cop_calificacion);
                      $('#cop_calificacion_formato_gabtubos').val(valor_cop_calificacion);
                     $('#cop_calificacion_formato_gabtubos').trigger('change');
         
                     
                    }


              },
              error: function(res)
              {
                  alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'); 
                
              }
          });
  }
</script>