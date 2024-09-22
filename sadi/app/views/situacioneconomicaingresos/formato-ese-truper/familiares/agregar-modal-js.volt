<script type="">
   function fnCrearSituacionEconomicaIngresosFamiliar_FormatoTruper(){
    // $('#agd_agf_id').val($('#agf_id').val());

    let form_ocupado=document.getElementById('frm_crear_familiar_truper_situacioneconomicaingresos');
    form_ocupado.reset();
   
     $('#sef_ese_id_crear_familiar-formato_truper').text($('#ese_id_ese_actual_formato_ese_truper').text());
     $('#sei_sef_id_crear_familiar-formato_truper').val($('#sef_id-formato_truper').val());
     $('#sef_ese_nombre_crear_familiar-formato_truper').text($('#ese_nombrecompleto_actual_formato_ese_truper').text()); 
     
    }
    $(function (){
          $('#frm_crear_familiar_truper_situacioneconomicaingresos').submit(function(event){
                        let $forms = $(this);
                        a=$forms.valid();
                        if(a==false){
                            return false;
                        }
                        event.preventDefault();
                
                          
                        let formulario=$("#frm_crear_familiar_truper_situacioneconomicaingresos");
                        let $form = $(this);
                        $form.find("button").prop("disabled", true);
                        let url_enviar="<?php echo $this->url->get('situacioneconomicaingresos/crear_familiar_formato_truper/') ?>";
                        $.ajax({
                                      type: "POST",
                                      url: url_enviar,
                                      data: formulario.serialize(),
                                      success: function(res)
                                      {   
                                       
                                      // console.log(res);
                                     
                                        if(res[0]==2)
                                        {
                                        Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
                                                                                    .then((value) => {
                                                                                      $form.find("button").prop("disabled", false);
                                                                                        let form_ocupado=document.getElementById('frm_crear_familiar_truper_situacioneconomicaingresos');
                                                                                        form_ocupado.reset();
                                                                                        $('#agregar-familiar-truper-situacioneconomica-ingreso-modal').modal('hide');
                                                                                        fnCargarTablaDatoSituacioneEconomicaIngresosFamiliares_FormatoTruper(res['sef_id']);
                                                                                        // $('#sef_totalingresos-formato_truper').val(res['sef_totalingresos']);
                                                                                        getTotalSituacionFinacieraFamiliar('ingreso_familiar-formato_truper','sef_totalingresosfamiliares-formato_truper',$('#ese_id_ese_actual_formato_ese_truper').text())
                                                                                        
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
                                      
                                      }
                            });
                            return false;

                
        });



  });
</script>



<div class="modal fade" id="agregar-familiar-truper-situacioneconomica-ingreso-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog detalle modal-dialog-scrollable">
      <div class="modal-content">
        <!-- <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
   -->        <div class="modal-header">
              <h5><div id="">
                <i class="mdi mdi-plus"></i>Agregar referencia de ingreso  familiar al estudio No. <span id="sef_ese_id_crear_familiar-formato_truper"></span>  "<span id="sef_ese_nombre_crear_familiar-formato_truper"></span>"
              </div></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <!-- //contenido -->
              <form id="frm_crear_familiar_truper_situacioneconomicaingresos" class="form-vertical mt-1" novalidate method="post">
                <div class="form-group row">
                  <input type="hidden" id="sei_sef_id_crear_familiar-formato_truper" name="sef_id" />

       

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Parentesco</label>
                    <input name="sei_parentesco" id="sei_parentesco_crear_familiar-formato_truper" type="text" required class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Parentesco..."  maxlength="45"/>

                  </div>

                
                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Aportación</label>
                    <input   name="sei_aportacion" id="sei_aportacion_crear_familiar-formato_truper" type="number" required  class="form-control input-rounded"  oninput="limitDecimalPlaces(event,2)"  placeholder="Aportación ($)..." max="999999999" />

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
  