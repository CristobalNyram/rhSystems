
<!-- funcion para cargar los datos de datos comprobatorios -->
<script>
      function fnCargarDatosComprobatorios_especifico_adapatable(ese_id,cop_nacimientofecha_input,cop_nacimientolugar_input,cop_nacimientofolio_input,
   cop_matrimoniofecha_input,cop_matrimoniolugar_input,cop_matrimoniofolio_input,
   cop_conyugefecha_input,cop_conyugelugar_input,cop_conyugefolio_input,
   cop_nacimientohijosfecha_input,cop_nacimientohijoslugar_input,cop_nacimientohijosfolio_input,
   cop_comprobantedomiciliofecha_input,cop_comprobantedomiciliolugar_input,cop_comprobantedomiciliofolio_input,
   cop_credencialelectorfecha_input,cop_credencialelectorlugar_input,cop_credencialelectorfolio_input,
   cop_curpfecha_input,cop_curplugar_input,cop_curpfolio_input,
   cop_imssfecha_input,cop_imsslugar_input,cop_imssfolio_input,
   cop_retencionfecha_input,cop_retencionlugar_input,cop_retencionfolio_input,
   cop_rfcfecha_input,cop_rfclugar_input,cop_rfcfolio_input,
   cop_cartillafecha_input,cop_cartillalugar_input,cop_cartillafolio_input,
   cop_licenciafecha_input,cop_licencialugar_input,cop_licenciafolio_input,
   cop_migratoriafecha_input,cop_migratorialugar_input,cop_migratoriafolio_input,cop_calificacion_input
   )
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
                      cop_nacimientofecha_input.val(data[0].cop_nacimientofecha);
                      cop_nacimientolugar_input.val(data[0].cop_nacimientolugar);
                      cop_nacimientofolio_input.val(data[0].cop_nacimientofolio);

                      cop_matrimoniofecha_input.val(data[0].cop_matrimoniofecha);
                      cop_matrimoniolugar_input.val(data[0].cop_matrimoniolugar);
                      cop_matrimoniofolio_input.val(data[0].cop_matrimoniofolio);
                      
                      cop_conyugefecha_input.val(data[0].cop_conyugefecha);
                      cop_conyugelugar_input.val(data[0].cop_conyugelugar);
                      cop_conyugefolio_input.val(data[0].cop_conyugefolio);

                     

                      cop_nacimientohijosfecha_input.val(data[0].cop_nacimientohijosfecha);
                      cop_nacimientohijoslugar_input.val(data[0].cop_nacimientohijoslugar);
                      cop_nacimientohijosfolio_input.val(data[0].cop_nacimientohijosfolio);

             
                      cop_comprobantedomiciliofecha_input.val(data[0].cop_comprobantedomiciliofecha);
                      cop_comprobantedomiciliolugar_input.val(data[0].cop_comprobantedomiciliolugar);
                      cop_comprobantedomiciliofolio_input.val(data[0].cop_comprobantedomiciliofolio);

                      cop_credencialelectorfecha_input.val(data[0].cop_credencialelectorfecha);
                      cop_credencialelectorlugar_input.val(data[0].cop_credencialelectorlugar);
                      cop_credencialelectorfolio_input.val(data[0].cop_credencialelectorfolio);

                      cop_curpfecha_input.val(data[0].cop_curpfecha);
                      cop_curplugar_input.val(data[0].cop_curplugar);

                      if(data[0].cop_curpfolio!=null ||  $data[0].cop_curpfolio!='')
                      {
                        // $('#cop_curpfolio').val(data.ese_curp);
                        cop_curpfolio_input.val(data[0].cop_curpfolio);
                      }

                      cop_imssfecha_input.val(data[0].cop_imssfecha);
                      cop_imsslugar_input.val(data[0].cop_imsslugar);

                      if(data[0].cop_imssfolio!='' || data[0].cop_imssfolio!=null)
                      {
                        cop_imssfolio_input.val(data[0].cop_imssfolio);

                      }

                      //
                      cop_retencionfecha_input.val(data[0].cop_retencionfecha);
                      cop_retencionlugar_input.val(data[0].cop_retencionlugar);
                      cop_retencionfolio_input.val(data[0].cop_retencionfolio);

                      cop_rfcfecha_input.val(data[0].cop_rfcfecha);
                      cop_rfclugar_input.val(data[0].cop_rfclugar);
                      cop_rfcfolio_input.val(data[0].cop_rfcfolio);

                      cop_cartillafecha_input.val(data[0].cop_cartillafecha);
                      cop_cartillalugar_input.val(data[0].cop_cartillalugar);
                      cop_cartillafolio_input.val(data[0].cop_cartillafolio);
                      

                      cop_licenciafecha_input.val(data[0].cop_licenciafecha);
                      cop_licencialugar_input.val(data[0].cop_licencialugar);
                      cop_licenciafolio_input.val(data[0].cop_licenciafolio);

                      cop_migratoriafecha_input.val(data[0].cop_migratoriafecha);
                      cop_migratorialugar_input.val(data[0].cop_migratorialugar);
                      cop_migratoriafolio_input.val(data[0].cop_migratoriafolio);

                      let valor_cop_calificacion =(data[0].cop_calificacion==null || data[0].cop_calificacion==-1) ?-1 :data[0].cop_calificacion;
                      // $("#cop_calificacion").select2("val", valor_cop_calificacion);
                      $('#cop_calificacion').val(valor_cop_calificacion);
                     $('#cop_calificacion').trigger('change');
         
                     
                    }


              },
              error: function(res)
              {
                  alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'); 
                
              }
          });
  }
</script>