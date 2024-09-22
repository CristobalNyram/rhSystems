<script>
        function fnNuevoCatVacantesModal(emp_id=0){
          let form_ocupado=document.getElementById('form_asignar_catvacante');
          form_ocupado.reset();
          $('#emp_id-asignar-catvacante').val(emp_id);
          fnocupacionesAdaptable($('#ocu_id-asignar-catvacante'),0);
        }

        $(function() {
        $("#form_asignar_catvacante").submit(function(event) {
          event.preventDefault();
          if($('#ocu_id-asignar-catvacante').val()=='-1')
            {
                            alertify.alert("Error","Debe seleccionar una ocupación.")
                            return false;
            }
          let $form = $(this);
          let urled = "<?php echo $this->url->get('catvacante/nuevo_emp/') ?>";
          
          if (!$form.valid()) {
            return false;
          }

          $form.find("button").prop("disabled", true);

          $.ajax({
            type: "POST",
            url: urled,
            data: $form.serialize(),
            success: function(res) {
              if (res[0] <= 0) {
                alertify.alert("Error", res[1]);
              } else {
                alertify.alert("Éxito", res[1], function() {
                  fnCargarTablaCatVacantes(res['emp_id'],0);
                  $('#asignar-catvacante-modal').modal('hide');
                });
              }

              $form.find("button").prop("disabled", false);
            },
            error: function(res) {
              $form.find("button").prop("disabled", false);
            }
          });
        });
      });
</script>


<div class="modal fade" id="asignar-catvacante-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="" id="asignar-catvacante-titulo">Crear catalogo de vacante</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form_asignar_catvacante" class="form-vertical mt-1">
            <div class="form-group row">
              <input type="hidden" name="emp_id" id="emp_id-asignar-catvacante">
              <div class="col-lg-6">
                <label class="col-form-label title-busq">Nombre de vacante</label>
                <input id="cav_nombre-asignar-catvacante" name="cav_nombre" type="text" class="form-control input-rounded data-not-lt-active" minlength="2" placeholder="Nombre" maxlength="55" required oninput="handleInput(event)"/>
              </div>
  
              <div class="col-lg-6">
                <label class="col-form-label title-busq">Ocupación</label>
                <select name="ocu_id" id="ocu_id-asignar-catvacante"  required class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..."  >
                  <optgroup>
                    <option value="-2">Reinciar...</option>
                  </optgroup>
                </select>
              </div>
         
          
              <div class="row col-lg-12">
                <div class="col-sm-6 col-md-6 text-center mt-5">
                </div>
                <div class="col-sm-3 col-md-3 text-center mt-5">
                    <div class="form-group">
                      <a class="btn-dark btn-rounded btn btn-limpiar" data-dismiss="modal"><i class=" mdi mdi-close white"></i>  Cancelar</a>
                    </div>
                </div>
                <div class="col-sm-3 col-md-3  text-center mt-5 ">
                    <div class="form-group">
                      <button class="btn-dark btn-rounded btn btn-buscar">Guardar <i class="mdi mdi-chevron-right white"></i> </button>
                    </div>
                </div>
              </div>
            </div>
          </form>      
        </div>
      </div>
    </div>
  </div>
  