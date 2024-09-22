<script type="">
 function fnCrearReferenciaVecinal(){
    // $('#agd_agf_id').val($('#agf_id').val());
    let form_ocupado=document.getElementById('frm_crear_referenciavecinal');
    form_ocupado.reset();

    $('#rev_hijos_crear').val('-1');
    $('#rev_hijos_crear').trigger('change');
    $('#rev_trabaja_crear').val('-1');
    $('#rev_trabaja_crear').trigger('change');
    $('#rev_esc_id_crear').val('-1');
    $('#rev_esc_id_crear').trigger('change');

    $('#rev_ese_id_crear').text($('#ese_id_ese_actual').text());
    $('#rev_sep_id').val($('#sep_id').val());
    $('#rev_ese_nombre_crear').text($('#ese_nombrecompleto_actual').text()); 

    fnestadocivils_adaptable($('select[name="rev_esc_id_crear"]'));
  }
  
  $(function (){
    $('#frm_crear_referenciavecinal').submit(function(event) {
      let $form = $(this);
      a=$form.valid();
      if(a==false){
          return false;
      }
      $form.find("button").prop("disabled", true);
      let url_enviar="<?php echo $this->url->get('referenciavecinal/crear/') ?>";

      $.ajax({
        type: "POST",
        url: url_enviar,
        data: $('#frm_crear_referenciavecinal').serialize(),
        success: function(res)
        {   
          if(res[0]==2)
          {
            Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
            .then((value) => {
              $form.find("button").prop("disabled", false);

              let form_ocupado=document.getElementById('frm_crear_referenciavecinal');
              form_ocupado.reset();

              $('#agregar-referenciavecinal-modal').modal('hide');
              fnRe_CargarTablaDatoReferenciaVecinal(res['sep_id']);

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

<div class="modal fade" id="agregar-referenciavecinal-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog detalle modal-dialog-scrollable">
    <div class="modal-content">
        <!-- <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
          -->        <div class="modal-header">
            <h5><div id="">
              <i class="mdi mdi-plus"></i>Agregar una referencia vecinal  al estudio No. <span id="rev_ese_id_crear"></span> "<span id="rev_ese_nombre_crear"></span>"
            </div></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- //contenido -->
            <form id="frm_crear_referenciavecinal" class="form-vertical mt-1" novalidate method="post">
              <div class="form-group row">
                <input type="hidden" id="rev_sep_id" name="rev_sep_id" />

                <div class="col-lg-12">
                  <label class="col-form-label title-busq">Nombre</label>
                  <input name="rev_nombre_crear" id="rev_nombre_crear" type="text" class="form-control input-rounded data-not-lt-active" required oninput="handleInput(event)"  placeholder="Nombre completo..." maxlength="55" />

                </div>

                <div class="col-lg-4">
                  <label class="col-form-label title-busq">Tiempo de conocerlo</label>
                  <input name="rev_tiempo_crear" id="rev_tiempo_crear" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Tiempo de conocerlo..."  maxlength="10"/>

                </div>
                <div class="col-lg-4">
                  <label class="col-form-label title-busq">Domicilio</label>
                  <input name="rev_domicilio_crear" id="rev_domicilio_crear" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Domicilio..."  maxlength="80"/>

                </div>
                <div class="col-lg-4">
                  <label class="col-form-label title-busq">Teléfono</label>
                  <input name="rev_telefono_crear" id="rev_telefono_crear" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Teléfono (10 dígitos)..."  maxlength="45"/>

                </div>
                <div class="col-lg-12">
                  <label class="col-form-label title-busq">Concepto del candidato</label>
                  <input name="rev_conceptocandidato_crear" id="rev_conceptocandidato_crear" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Concepto..."  maxlength="100"/>

                </div>

                <div class="col-lg-12">
                  <label class="col-form-label title-busq">Concepto de la familia del candidato</label>
                  <input name="rev_conceptofamilia_crear" id="rev_conceptofamilia_crear" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Concepto..."  maxlength="100"/>

                </div>

                <div class="col-lg-4">
                  <label class="col-form-label title-busq">¿Tiene hijos?</label>
                  <select name="rev_hijos_crear" id="rev_hijos_crear" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..."  >
                    <option value="-1">Seleccionar...</option>
                    <option value="1">SI</option>
                    <option value="0">NO</option>

                  </select>
                </div>

                <div class="col-lg-4">
                  <label class="col-form-label title-busq">¿Sabe donde trabaja?</label>
                  <select name="rev_trabaja_crear" id="rev_trabaja_crear" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..."  >
                    <option value="-1">Seleccionar...</option>
                    <option value="1">SI</option>
                    <option value="0">NO</option>

                  </select>
                </div>
                <div class="col-lg-4">
                  <label class="col-form-label title-busq">Estado civil</label>
                  <select name="rev_esc_id_crear" id="rev_esc_id_crear" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..."  >
                    <option value="-1">Seleccionar...</option>

                  </select>
                </div>
                <div class="col-lg-12">
                  <label class="col-form-label title-busq">Notas</label>
                  <textarea id="rev_notas_crear" name="rev_notas_crear" oninput="handleInput(event)" class="form-control-textarea text_area_a" style="min-height:5rem" maxlength="300"></textarea>
                </div>                

                <div class="row col-lg-12">
                  <div class="col-sm-6 col-md-6 text-center mt-5">
                  </div>
                  <div class="col-sm-3 col-md-3 text-center mt-5">
                    <div class="form-group">
                      <button class="btn-dark btn-rounded btn btn-limpiar" class="close" data-dismiss="modal" aria-label="Close">Cancelar</button>
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
