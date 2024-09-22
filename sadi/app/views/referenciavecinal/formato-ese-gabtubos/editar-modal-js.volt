<script type="">
  function fnEditarReferenciaVecinal(rev_id){
    let form_ocupado=document.getElementById('frm_editar_referenciavecinal');
    $('#rev_ese_nombre_editar').text($('#ese_nombrecompleto_actual').text()); 

    form_ocupado.reset();
    $('#rev_hijos_editar').val('-1');
    $('#rev_hijos_editar').trigger('change');
    $('#rev_trabaja_editar').val('-1');
    $('#rev_trabaja_editar').trigger('change');
    $('#rev_esc_id_editar').val('-1');
    $('#rev_esc_id_editar').trigger('change');                                                    
    $('#rev_ese_id_editar').text($('#ese_id_ese_actual').text());

    let url_enviar="<?php echo $this->url->get('referenciavecinal/ajax_get_detalle/') ?>";
                                     
    $.ajax({
      type: "POST",
      url: url_enviar+rev_id,
      success: function(res)
      {                                                                            
        if(res[0]==2)
        {
          $('#rev_id_editar').val(rev_id);
          $('#rev_nombre_editar').val(res['data'].rev_nombre);
          $('#rev_tiempo_editar').val(res['data'].rev_tiempo);
          $('#rev_domicilio_editar').val(res['data'].rev_domicilio);
          $('#rev_telefono_editar').val(res['data'].rev_telefono);
          $('#rev_conceptocandidato_editar').val(res['data'].rev_conceptocandidato);
          $('#rev_conceptofamilia_editar').val(res['data'].rev_conceptofamilia);
          $('#rev_hijos_editar').val(res['data'].rev_hijos);
          $('#rev_hijos_editar').trigger('change');
          $('#rev_trabaja_editar').val(res['data'].rev_trabaja);
          $('#rev_trabaja_editar').trigger('change');

          $('#rev_notas_editar').val(res['data'].rev_notas);
          fnestadocivils_adaptable($('select[name="rev_esc_id_editar"]'),res['data'].esc_id);
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
      $('#frm_editar_referenciavecinal').submit(function(event) {
      let $form = $(this);
      a=$form.valid();
      if(a==false){
          return false;
      }
      $form.find("button").prop("disabled", true);
      let url_enviar="<?php echo $this->url->get('referenciavecinal/actualizar/') ?>";
      $.ajax({
        type: "POST",
        url: url_enviar,
        data: $('#frm_editar_referenciavecinal').serialize(),
        success: function(res)
        {
          if(res[0]==2)
          {
            Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
            .then((value) => {
              $form.find("button").prop("disabled", false);
                let form_ocupado=document.getElementById('frm_editar_referenciavecinal');
                form_ocupado.reset();
                $('#editar-referenciavecinal-modal').modal('hide');
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

<div class="modal fade" id="editar-referenciavecinal-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog detalle modal-dialog-scrollable">
    <div class="modal-content">
      <!-- <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
 -->        <div class="modal-header">
            <h5><div id="">
              <i class="mdi mdi-pencil-circle"></i>Editar una referencia vecinal del estudio No. <span id="rev_ese_id_editar"></span>  "<span id="rev_ese_nombre_editar"></span>"
            </div></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- //contenido -->
            <form id="frm_editar_referenciavecinal" class="form-vertical mt-1" novalidate method="post">
              <div class="form-group row">
                <input type="hidden" id="rev_id_editar" name="rev_id_editar" />

                <div class="col-lg-12">
                  <label class="col-form-label title-busq">Nombre</label>
                  <input name="rev_nombre_editar" id="rev_nombre_editar" type="text" class="form-control input-rounded data-not-lt-active" required oninput="handleInput(event)"  placeholder="Nombre completo..." maxlength="55" />

                </div>

                <div class="col-lg-4">
                  <label class="col-form-label title-busq">Tiempo de conocerlo</label>
                  <input name="rev_tiempo_editar" id="rev_tiempo_editar" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Tiempo de conocerlo..."  maxlength="10"/>

                </div>
                <div class="col-lg-4">
                  <label class="col-form-label title-busq">Domicilio</label>
                  <input name="rev_domicilio_editar" id="rev_domicilio_editar" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Domicilio..."  maxlength="80"/>

                </div>
                <div class="col-lg-4">
                  <label class="col-form-label title-busq">Teléfono</label>
                  <input name="rev_telefono_editar" id="rev_telefono_editar" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Teléfono (10 dígitos)..."  maxlength="45"/>

                </div>
                <div class="col-lg-12">
                  <label class="col-form-label title-busq">Concepto del candidato</label>
                  <input name="rev_conceptocandidato_editar" id="rev_conceptocandidato_editar" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Concepto..."  maxlength="100"/>

                </div>

                <div class="col-lg-12">
                  <label class="col-form-label title-busq">Concepto de la familia del candidato</label>
                  <input name="rev_conceptofamilia_editar" id="rev_conceptofamilia_editar" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Concepto..."  maxlength="100"/>

                </div>

                <div class="col-lg-4">
                  <label class="col-form-label title-busq">¿Tiene hijos?</label>
                  <select name="rev_hijos_editar" id="rev_hijos_editar" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..."  >
                    <option value="-1">Seleccionar...</option>
                    <option value="1">SI</option>
                    <option value="0">NO</option>
                 
                  </select>
                </div>

                <div class="col-lg-4">
                  <label class="col-form-label title-busq">¿Sabe donde trabaja?</label>
                  <select name="rev_trabaja_editar" id="rev_trabaja_editar" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..."  >
                    <option value="-1">Seleccionar...</option>
                    <option value="1">SI</option>
                    <option value="0">NO</option>
                 
                  </select>
                </div>
                <div class="col-lg-4">
                  <label class="col-form-label title-busq">Estado civil</label>
                  <select name="rev_esc_id_editar" id="rev_esc_id_editar" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..."  >
                    <option value="-1">Seleccionar...</option>
                    
                  </select>
                </div>
                <div class="col-lg-12">
                  <label class="col-form-label title-busq">Notas</label>
                  <textarea id="rev_notas_editar" name="rev_notas_editar" oninput="handleInput(event)" class="form-control-textarea text_area_a" style="min-height:5rem" maxlength="300"></textarea>

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
                        <button type="submit" class="btn-dark btn-rounded btn btn-buscar">Editar  <i class="mdi mdi-pencil-circle white"></i></button>
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
