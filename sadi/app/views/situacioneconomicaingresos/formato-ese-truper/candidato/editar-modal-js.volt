<script type="">
    function fnEditarSituacionEconomicaIngresosCandidatoFormatoTruper(sei_id){
     // $('#agd_agf_id').val($('#agf_id').val());
      let form_ocupado=document.getElementById('frm_editar_candidato_truper_situacioneconomicaingresos');
      form_ocupado.reset();

      let url_enviar="<?php echo $this->url->get('situacioneconomicaingresos/ajax_get_detalle/') ?>";
                                       
                                       $.ajax({
                                          type: "POST",
                                          url: url_enviar+sei_id,
                                           success: function(res)
                                             {   
                                                                                                                       
                                               if(res[0]==2)
                                                {

                                                  $('#sei_ese_id_candidato_editar-truper').text($('#ese_id_ese_actual_formato_ese_truper').text());
                                                  $('#sei_sie_id_editar-formato_truper').val($('#sie_id-formato_truper').val());
                                                  $('#sei_ese_nombre_candidato_editar-truper').text($('#ese_nombrecompleto_actual_formato_ese_truper').text()); 


     
                                                    

                                                    $('#sei_id_candidato_editar-truper').val(res['data'].sei_id);
                                                    $('#sei_concepto_candidato_editar-truper').val(res['data'].sei_concepto);
                                                    $('#sei_aportacion_candidato_editar-truper').val(res['data'].sei_aportacion);
                                                                  
                                                 
                                                 }
                                               else
                                               {
                                                                                            Swal.fire({title:res['titular'],text:res['mensaje'],type:"error"})
                                                                                                                      .then((value) => {
                                                                                                                        location.reload();  
                                                                                                                          });
                                               }
                                                                                                                                   
                                             },
                                            error: function(res)
                                             { 
                                                                      alert('error en el servidor...');
                                                                                          
                                             }
                                       });

  
    }

     
    $(function (){
          $('#frm_editar_candidato_truper_situacioneconomicaingresos').submit(function(event){
                        let $forms = $(this);
                        a=$forms.valid();
                        if(a==false){
                            return false;
                        }
                        event.preventDefault();
                
                     
                     
                          
                        let formulario=$("#frm_editar_candidato_truper_situacioneconomicaingresos");
                        let $form = $(this);
                        $form.find("button").prop("disabled", true);
                        let url_enviar="<?php echo $this->url->get('situacioneconomicaingresos/actualizar_candidato_formato_truper/') ?>";
                        $.ajax({
                                      type: "POST",
                                      url: url_enviar,
                                      data: formulario.serialize(),
                                      success: function(res)
                                      {   
                                       
                                      
                                        if(res[0]==2)
                                        {
  

                                        Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
                                                                                    .then((value) => {
                                                                                      $form.find("button").prop("disabled", false);
                                                                                        let form_ocupado=document.getElementById('frm_editar_candidato_truper_situacioneconomicaingresos');
                                                                                        form_ocupado.reset();
                                                                                        $('#editar-situacioneconomica-candidato-ingreso-truper-modal').modal('hide');
                                                                                        fnCargarTablaDatoSituacioneEconomicaIngresosCandidato_FormatoTruper(res['sie_id']);
                                                                                        // $('#sie_totalingresos-formato_truper').val(res['sie_totalingresos']);
                                                                                        getTotalSituacionFinacieraCandidato('ingreso_candidato-formato_truper','sie_totalingresos-formato_truper',$('#ese_id_ese_actual_formato_ese_truper').text())

                                                                                      });
                                        }
                                      else
                                      {
                                        Swal.fire({title:res['titular'],text:res['mensaje'],type:"error"})
                                                                 .then((value) => {
                                                                    location.reload();  
                                                                     });
                                      }
                                      
                                      
                                      },
                                      error: function(res)
                                      { 
                                      alert('ERROR EN EL SERVIDOR');
                                      }
                            });
                            return false;

                
        });



  });
 </script>
 
 
 
<div class="modal fade" id="editar-situacioneconomica-candidato-ingreso-truper-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog detalle modal-dialog-scrollable">
    <div class="modal-content">
      <!-- <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
 -->        <div class="modal-header">
            <h5><div id="">
              <i class="mdi mdi-pencil"></i>Editar referencia de ingreso al estudio No. <span id="sei_ese_id_candidato_editar-truper"></span>  "<span id="sei_ese_nombre_candidato_editar-truper"></span>"
            </div></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- //contenido -->
            <form id="frm_editar_candidato_truper_situacioneconomicaingresos" class="form-vertical mt-1" novalidate method="post">
              <div class="form-group row">
                <input type="hidden" id="sei_id_candidato_editar-truper" name="sei_id" />


                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Concepto</label>
                  <input name="sei_concepto" id="sei_concepto_candidato_editar-truper" type="text" required class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Concepto..."  maxlength="45"/>

                </div>

                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Aportación</label>
                  <input   name="sei_aportacion" id="sei_aportacion_candidato_editar-truper" type="number" required  class="form-control input-rounded"  oninput="limitDecimalPlaces(event,2)"  placeholder="Aportación ($)..." max="999999999"  />

                </div>



              

                <div class="row col-lg-12">
                  <div class="col-sm-6 col-md-6 text-center mt-5">
                  </div>
                  <div class="col-sm-3 col-md-3 text-center mt-5">
                      <div class="form-group">
                        <button type="button" class="btn-dark btn-rounded btn btn-limpiar" class="close" data-dismiss="modal" aria-label="Close">Cancelar</button>
                      </div>
                  </div>
                  <div class="col-sm-3 col-md-3  text-center mt-5 ">
                      <div class="form-group">
                        <button type="submit" class="btn-dark btn-rounded btn btn-buscar">Guardar  <i class="mdi mdi-content-save white"></i></button>
                      </div>
                  </div>
                </div>
                

                
              </div>
            </form>
          </div>
        <!-- </div>
      </div> -->
    </div>
  </div>
</div>
