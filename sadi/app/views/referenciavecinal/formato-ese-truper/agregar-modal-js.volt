<script type="">
 function fnCrearReferenciaVecinalFormatoTruper(){
    // $('#agd_agf_id').val($('#agf_id').val());
    let form_ocupado=document.getElementById('frm_crear_truper_referenciavecinal');
    form_ocupado.reset();

     $('#rev_ese_id_crear-formato_truper').text($('#ese_id_ese_actual_formato_ese_truper').text());
     $('#rev_ese_nombre_crear-formato_truper').text($('#ese_nombrecompleto_actual_formato_ese_truper').text()); 
     $('#rev_sep_id-formato_truper').val($('#sep_id-formato_truper').val()); 
     
     $('#rev_lorecomienda_crear-formato_truper').val('-1');
      $('#rev_lorecomienda_crear-formato_truper').trigger('change');


    //  console.log($('sep_id-formato_truper').val());
  }
  
  $(function (){
    $('#frm_crear_truper_referenciavecinal').submit(function(event) {
      let $form = $(this);
      a=$form.valid();
      if(a==false){
          return false;
      }
      $form.find("button").prop("disabled", true);
      let url_enviar="<?php echo $this->url->get('referenciavecinal/crear_formato_truper/') ?>";

      $.ajax({
        type: "POST",
        url: url_enviar,
        data: $('#frm_crear_truper_referenciavecinal').serialize(),
        success: function(res)
        {   
          if(res[0]==2)
          {
            Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
            .then((value) => {
              $form.find("button").prop("disabled", false);

              let form_ocupado=document.getElementById('frm_crear_truper_referenciavecinal');
              form_ocupado.reset();

              $('#agregar-referenciavecinal-truper-modal').modal('hide');
              fnCargarTablaDatoReferenciaVecinalFormatoTruper(res['sep_id']);

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

<div class="modal fade" id="agregar-referenciavecinal-truper-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog detalle modal-dialog-scrollable">
    <div class="modal-content">
        <!-- <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
          -->        <div class="modal-header">
            <h5><div id="">
              <i class="mdi mdi-plus"></i>Agregar una referencia vecinal  al estudio No. <span id="rev_ese_id_crear-formato_truper"></span> "<span id="rev_ese_nombre_crear-formato_truper"></span>"
            </div></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- //contenido -->
            <form id="frm_crear_truper_referenciavecinal" class="form-vertical mt-1" novalidate method="post">
              <div class="form-group row">
                <input type="hidden" id="rev_sep_id-formato_truper" name="sep_id" />

                <div class="col-lg-12">
                  <label class="col-form-label title-busq">Nombre completo</label>
                  <input name="rev_nombre" id="rev_nombre_crear-formato_truper" type="text" class="form-control input-rounded data-not-lt-active" required oninput="handleInput(event)"  placeholder="Nombre completo..." maxlength="55" />

                </div>

                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Edad</label>
                  <input name="rev_edad" id="rev_edad_crear-formato_truper" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Edad..."  maxlength="10"/>

                </div>
                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Teléfono</label>
                  <input name="rev_telefono" id="rev_telefono_crear-formato_truper" type="text"  class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Teléfono..."  maxlength="45"/>

                </div>
                <div class="col-lg-12">
                  <label class="col-form-label title-busq">Dirección                    </label>
                  <input name="rev_domicilio" id="rev_domicilio_crear-formato_truper" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Dirección..."  maxlength="45"/>

                </div>

   

                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Tiempo en conocerlo</label>
                  <input name="rev_tiempo" id="rev_tiempo_crear-formato_truper" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Tiempo en conocerlo..."  maxlength="10"/>

                </div>

                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Como lo conoció                    </label>
                  <input name="rev_comoloconocio" id="rev_comoloconocio_crear-formato_truper" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Como lo conoció..."  maxlength="255"/>

                </div>


                <div class="col-lg-6">
                  <label class="col-form-label title-busq"> Conoce su domicilio                    </label>
                  <input name="rev_conocesudomicilio" id="rev_conocesudomicilio_crear-formato_truper" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder=" Conoce su domicilio  ..."  maxlength="155"/>

                </div>


                <div class="col-lg-6">
                  <label class="col-form-label title-busq"> Conoce su estado civil                    </label>
                  <input name="rev_conocesuestadocivil" id="rev_conocesuestadocivil_crear-formato_truper" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Conoce su estado civil..."  maxlength="45"/>

                </div>


                 

               


      
                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Conoce su empleo                    </label>
                  <input name="rev_conocesuempleo" id="rev_conocesuempleo_crear-formato_truper" type="text"  class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Conoce su empleo..."  maxlength="45"/>


                </div>


                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Sabe sus pasatiempos                    </label>
                  <input name="rev_conocesupasatiempos" id="rev_conocesupasatiempos_crear-formato_truper" type="text"  class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Sabe sus pasatiempos..."  maxlength="45"/>


                </div>

                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Concepto de él o ella	
                  </label>
                  <input name="rev_conceptodeelella" id="rev_conceptodeelella_crear-formato_truper" type="text"  class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Concepto de él o ella	..."  maxlength="45"/>


                </div>

                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Lo recomienda</label>
                  <select name="rev_lorecomienda"  id="rev_lorecomienda_crear-formato_truper" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                    <optgroup class="text-uppercase">
                        <option value="-1">Seleccionar...</option>
                        <option value="1">RECOMENDABLE</option>
                        <option value="2">RECOMENDABLE C / RESERVAS			
                        </option>
                        <option value="3"> --  NO -- RECOMENDABLE			
                        </option>

                    </optgroup>
                  </select>

                </div>

                <div class="col-lg-12">
                  <label class="col-form-label title-busq">Comentarios                    </label>
                  <textarea name="rev_notas" id="rev_notas_crear-formato_truper" oninput="handleInput(event)" class="form-control-textarea text_area_a" style="min-height:5rem" maxlength="400" placeholder="Comentarios..."></textarea>

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
