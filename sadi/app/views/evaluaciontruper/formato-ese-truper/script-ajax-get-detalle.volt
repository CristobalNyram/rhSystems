<script> 
function fnCargarDatosDelFormularioEvalucionFinal_formato_truper(ese_id){

            let form_seccionI=document.getElementById('form_estudio_seccionEvaluacionFinal_formato_ese_truper');
            form_seccionI.reset();

            
            let url_enviar="<?php echo $this->url->get('evaluaciontruper/ajax_get_create_detalle/') ?>";
  
              $.ajax({
                      type: "POST",
                      url: url_enviar+ese_id,
                        
                      success: function(res)
                      {

                          if(res['estado']=='2'){

                            let data =res.data_evt.data;
                            // console.log(data_evt);

                            $('#evt_problemaagendaentrevistacual-formato_truper').val(data.evt_problemaagendaentrevistacual);
                            $('#evt_problemavisitacual-formato_truper').val(data.evt_problemavisitacual);
                            $('#evt_problemaanlisisinfocual-formato_truper').val(data.evt_problemaanlisisinfocual);
                            $('#evt_resumen-formato_truper').val(data.evt_resumen);

                            $('#evt_entornosocioecoacorde-formato_truper').val((data.evt_entornosocioecoacorde==-1 ||data.evt_entornosocioecoacorde == null?-1:data.evt_entornosocioecoacorde));
                            $('#evt_entornosocioecoacorde-formato_truper').trigger('change');
                            

                            $('#evt_vivendaacordeentornofam-formato_truper').val((data.evt_vivendaacordeentornofam==-1 ||data.evt_vivendaacordeentornofam == null?-1:data.evt_vivendaacordeentornofam));
                            $('#evt_vivendaacordeentornofam-formato_truper').trigger('change');


                            $('#evt_infovisitacoincide-formato_truper').val((data.evt_infovisitacoincide==-1 ||data.evt_infovisitacoincide == null?-1:data.evt_infovisitacoincide));
                            $('#evt_infovisitacoincide-formato_truper').trigger('change');

                            $('#evt_candibuenactituinform-formato_truper').val((data.evt_candibuenactituinform==-1 ||data.evt_candibuenactituinform == null?-1:data.evt_candibuenactituinform));
                            $('#evt_candibuenactituinform-formato_truper').trigger('change');


                            $('#evt_infodentrocasacandi-formato_truper').val((data.evt_infodentrocasacandi==-1 ||data.evt_infodentrocasacandi == null?-1:data.evt_infodentrocasacandi));
                            $('#evt_infodentrocasacandi-formato_truper').trigger('change');

                            $('#evt_canditodainfo-formato_truper').val((data.evt_canditodainfo==-1 ||data.evt_canditodainfo == null?-1:data.evt_canditodainfo));
                            $('#evt_canditodainfo-formato_truper').trigger('change');

                            $('#evt_problemaagendaentrevista-formato_truper').val((data.evt_problemaagendaentrevista==-1 ||data.evt_problemaagendaentrevista == null?-1:data.evt_problemaagendaentrevista));
                            $('#evt_problemaagendaentrevista-formato_truper').trigger('change');

                            $('#evt_problemavisita-formato_truper').val((data.evt_problemavisita==-1 ||data.evt_problemavisita == null?-1:data.evt_problemavisita));
                            $('#evt_problemavisita-formato_truper').trigger('change');
                            
                            $('#evt_problemaanlisisinfo-formato_truper').val((data.evt_problemaanlisisinfo==-1 ||data.evt_problemaanlisisinfo == null?-1:data.evt_problemaanlisisinfo));
                            $('#evt_problemaanlisisinfo-formato_truper').trigger('change');

                        
                            

                          }   
                          if(res['estado']=='-2'){

                          }
  
                           
  
                      },
                      error: function(data)
                      {
                          Swal.fire({title:'Error',text:'No se puedieron cargar los datos vuelve a intentar de nuevo.',type:"error"})
                                                                 .then((value) => {
                                                                     });
                        
                      }
             });
  
}
</script>