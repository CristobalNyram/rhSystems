{% set cuarentayunoAgregar= acceso.verificar(41,rol_id) %}
{% set cuarentaycincoAgregar= acceso.verificar(45,rol_id) %}
<script type="">
    function fnCrearReferenciaLaboral_formato_gabencognv(){
    //alert();

    // $('#agd_agf_id').val($('#agf_id').val());
      let form_ocupado=document.getElementById('frm_crear_referencialaboral_formato_gabencognv');
      form_ocupado.reset();
      $('#rel_ese_id_crear_formato_gabencognv').text($('#ese_id_ese_actual_formato_gabencognv').text());
      $('#rel_ese_nombre_crear_formato_gabencognv').text($('#ese_nombrecompleto_actual_formato_gabencognv').text()); 
      $('#rel_sel_id_formato_gabencognv').val($('#sel_id_formato_gabencognv').val());
      
      $('#rel_calidad_crear_formato_gabencognv').val('-1');
      $('#rel_calidad_crear_formato_gabencognv').trigger('change');
      
      $('#rel_relaciones_crear_formato_gabencognv').val('-1');
      $('#rel_relaciones_crear_formato_gabencognv').trigger('change');

      $('#rel_honradez_crear_formato_gabencognv').val('-1');
      $('#rel_honradez_crear_formato_gabencognv').trigger('change');

      $('#rel_asistencia_crear_formato_gabencognv').val('-1');
      $('#rel_asistencia_crear_formato_gabencognv').trigger('change');

      $('#rel_puntualidad_crear_formato_gabencognv').val('-1');
      $('#rel_puntualidad_crear').trigger('change');

      $('#rel_iniciativa_crear_formato_gabencognv').val('-1');
      $('#rel_iniciativa_crear_formato_gabencognv').trigger('change');

      $('#rel_adicciones_crear_formato_gabencognv').val('-1');
      $('#rel_adicciones_crear_formato_gabencognv').trigger('change');

      $('#rel_responsabilidad_crear_formato_gabencognv').val('-1');
      $('#rel_responsabilidad_crear_formato_gabencognv').trigger('change');
    }
    
    $(function (){
      
      $('#frm_crear_referencialaboral_formato_gabencognv').submit(function(event) {
       
        let $form = $(this);
        a=$form.valid();
        if(a==false){
            return false;
        }
        $form.find("button").prop("disabled", true);
        let url_enviar="<?php echo $this->url->get('referencialaboral/crear/') ?>";

        $.ajax({
          type: "POST",
          url: url_enviar,
          data: $('#frm_crear_referencialaboral_formato_gabencognv').serialize(),
          success: function(res)
          {
            if(res[0]==2)
            {
              Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
                .then((value) => {
                  $form.find("button").prop("disabled", false);
                  let form_ocupado=document.getElementById('frm_crear_referencialaboral_formato_gabencognv');
                  form_ocupado.reset();
                  $('#agregar-referencialaboral_formato_gabencognv-modal').modal('hide');
                  fnCargarTablaDatoReferenciaLaboral_formato_gabencognv(res['sel_id']);
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
            alert('error en el servidor...');
          }
        });
        return false;
      });
    });
</script>

<div class="modal fade" id="agregar-referencialaboral_formato_gabencognv-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-semi-grande  modal-dialog-scrollable">
      <div class="modal-content">
        <!-- <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
   -->        <div class="modal-header">
              <h5><div id="">
                <i class="mdi mdi-plus"></i>Agregar una referencia laboral al estudio No. <span id="rel_ese_id_crear_formato_gabencognv"></span> "<span id="rel_ese_nombre_crear_formato_gabencognv"></span>"
              </div></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <!-- //contenido -->
              <form id="frm_crear_referencialaboral_formato_gabencognv" class="form-vertical mt-1" novalidate method="post">
                <div class="form-group row">
                  <input type="hidden" id="rel_sel_id_formato_gabencognv" name="rel_sel_id" />
                  <div class="{% if cuarentayunoAgregar==1 %} col-lg-6{% else %} col-lg-12{% endif %} ">
                    <h5 class="text-info ml-4 mt-4">
                      <i class="mdi mdi-worker "></i>Datos proporcionados por el candidato
                    </h5>
                  </div >
                  {% if cuarentayunoAgregar==1 %}

                  <div class="col-lg-6">
                    <h5 class="text-info ml-4 mt-4">
                      <i class="mdi mdi-worker "></i>Datos de RH
                    </h5>
                    <br>
                  </div >
                  {% endif %}

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Nombre de la empresa</label>
                    <input name="rel_candidatoempresa_crear" id="rel_candidatoempresa_crear_formato_gabencognv" type="text" class="form-control input-rounded data-not-lt-active" required oninput="handleInput(event)"  placeholder="Nombre..." maxlength="65" />
                  </div>
                  {% if cuarentayunoAgregar==1 %}
                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Nombre de empresa -RH</label>
                    <input name="rel_rhempresa_crear" id="rel_rhempresa_crear_formato_gabencognv" type="text" required class="form-control input-rounded data-not-lt-active" oninput="handleInput(event)"   placeholder="Nombre de la empresa..."  maxlength="65"/>
                  </div>
                  {% endif %}
                  
                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Domicilio</label>
                    <input name="rel_candidatodomicilio_crear" id="rel_candidatodomicilio_crear_formato_gabencognv" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Domicilio..."  maxlength="75"/>
                  </div>
                  
                  {% if cuarentayunoAgregar==1 %}
                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Domiclio -RH</label>
                    <input name="rel_rhdomicilio_crear" id="rel_rhdomicilio_crear_formato_gabencognv" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Domicilio.."  maxlength="75"/>
                  </div>
                  {% endif %}

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Nombre de Jefe directo inmediato</label>
                    <input name="rel_candidatojefe_crear" id="rel_candidatojefe_crear_formato_gabencognv" type="text" class="form-control input-rounded data-not-lt-active" oninput="handleInput(event)"   placeholder="Nombre de jefe inmediato..."  maxlength="45"/>
                  </div>

                  {% if cuarentayunoAgregar==1 %}
                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Nombre de jefe inmediato -RH</label>
                    <input name="rel_rhjefe_crear" id="rel_rhjefe_crear_formato_gabencognv" type="text" class="form-control input-rounded data-not-lt-active" oninput="handleInput(event)"   placeholder="Nombre de jefe inmediato..."  maxlength="45"/>
                  </div>
                  {% endif %}

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Teléfono</label>
                    <input name="rel_candidatotelefono_crear" id="rel_candidatotelefono_crear_formato_gabencognv" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Teléfono..."  maxlength="45"/>
                  </div>

                  {% if cuarentayunoAgregar==1 %}
                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Teléfono -RH</label>
                    <input name="rel_rhtelefono_crear" id="rel_rhtelefono_crear_formato_gabencognv" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Teléfono..."  maxlength="45"/>
                  </div>
                  {% endif %}

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Puesto inicial</label>
                    <input name="rel_candidatopuestoinicial_crear" id="rel_candidatopuestoinicial_crear_formato_gabencognv" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Puesto inicial..."  maxlength="45"/>
                  </div>

                  {% if cuarentayunoAgregar==1 %}
                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Puesto inicial -RH</label>
                    <input name="rel_rhpuestoinicial_crear" id="rel_rhpuestoinicial_crear" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Puesto inicial..."  maxlength="45"/>
                  </div>
                  {% endif %}

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Puesto final</label>
                    <input name="rel_candidatopuestofinal_crear" id="rel_candidatopuestofinal_crear_formato_gabencognv" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Puesto final..."  maxlength="45"/>
                  </div>
                 
                  {% if cuarentayunoAgregar==1 %}
                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Puesto final -RH</label>
                    <input name="rel_rhpuestofinal_crear" id="rel_rhpuestofinal_crear_formato_gabencognv" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Puesto final..."  maxlength="45"/>
                  </div>
                  {% endif %}

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Fecha de ingreso</label>
                    <input name="rel_candidatoingreso_crear" id="rel_candidatoingreso_crear_formato_gabencognv" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Fecha de ingreso..."  maxlength="45"/>
                  </div>

                  {% if cuarentayunoAgregar==1 %}
                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Fecha de ingreso -RH</label>
                    <input name="rel_rhingreso_crear" id="rel_rhingreso_crear_formato_gabencognv" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Fecha de ingreso..."  maxlength="45"/>
                  </div>
                  {% endif %}

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Fecha de salida</label>
                    <input name="rel_candidatosalida_crear" id="rel_candidatosalida_crear_formato_gabencognv" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Fecha de salida..."  maxlength="45"/>
                  </div>

                  {% if cuarentayunoAgregar==1 %}
                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Fecha de salida -RH</label>
                    <input name="rel_rhsalida_crear" id="rel_rhsalida_crear_formato_gabencognv" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Fecha de salida..."  maxlength="45"/>
                  </div>
                  {% endif %}

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Sueldo inicial</label>
                    <input name="rel_candidatosueldoinicial_crear" id="rel_candidatosueldoinicial_crear_formato_gabencognv" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Sueldo inicial..."  maxlength="45"/>
                  </div>

                  {% if cuarentayunoAgregar==1 %}
                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Sueldo inicial  -RH</label>
                    <input name="rel_rhsueldoinicial_crear" id="rel_rhsueldoinicial_crear_formato_gabencognv" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Sueldo inicial..."  maxlength="45"/>
                  </div>
                  {% endif %}

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Sueldo final</label>
                    <input name="rel_candidatosueldofinal_crear" id="rel_candidatosueldofinal_crear_formato_gabencognv" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Sueldo final..."  maxlength="45"/>
                  </div>

                  {% if cuarentayunoAgregar==1 %}
                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Sueldo final -RH</label>
                    <input name="rel_rhsueldofinal_crear" id="rel_rhsueldofinal_crear_formato_gabencognv" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Sueldo final..."  maxlength="45"/>
                  </div>
                  {% endif %}

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Motivo de separación</label>
                    <input name="rel_candidatoseparacion_crear" id="rel_candidatoseparacion_crear_formato_gabencognv" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Motivo de separación..."  maxlength="75"/>
                  </div>

                  {% if cuarentayunoAgregar==1 %}
                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Motivo de separación -RH</label>
                    <input name="rel_rhseparacion_crear" id="rel_rhseparacion_crear_formato_gabencognv" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Motivo de separación..."  maxlength="75"/>
                  </div>
                  {% endif %}

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Incapacidad o accidentes</label>
                    <input name="rel_candidatoincapacidad_crear" id="rel_candidatoincapacidad_crear" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Incapacidad o accidentes..."  maxlength="45"/>
                  </div>
                  
                  {% if cuarentayunoAgregar==1 %}
                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Incapacidad o accidentes -RH</label>
                    <input name="rel_rhincapacidad_crear" id="rel_rhincapacidad_crear_formato_gabencognv" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Incapacidad o accidentes..."  maxlength="45"/>
                  </div>
                  {% endif %}

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">¿Hubo alguna demanda o plática conciliatoria en la separación del empleado?
                    </label>
                    <input name="rel_candidatodemanda_crear" id="rel_candidatodemanda_crear_formato_gabencognv" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Demandas..."  maxlength="45"/>
                  </div>

                  {% if cuarentayunoAgregar==1 %}
                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">¿Hubo alguna demanda o plática conciliatoria en la separación del empleado? -RH
                    </label>
                    <input name="rel_rhdemanda_crear" id="rel_rhdemanda_crear_formato_gabencognv" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Demandas..."  maxlength="45"/>
                  </div>
                  {% endif %}

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Recomendable</label>
                    <input name="rel_candidatorecomendable_crear" id="rel_candidatorecomendable_crear_formato_gabencognv" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Recomendable..."  maxlength="45"/>
                  </div>

                  {% if cuarentayunoAgregar==1 %}
                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Recomendable -RH</label>
                    <input name="rel_rhrecomendable_crear" id="rel_rhrecomendable_crear_formato_gabencognv" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Recomendable..."  maxlength="45"/>

                  </div>
                  {% endif %}

                  {% if cuarentaycincoAgregar==1 %}
                  <div class="col-lg-12">
                    <h5 class="text-success ml-4 mt-4">
                      <i class="mdi mdi-check "></i>Escala de desempeño
                    </h5>
                    <br>
                  </div>
                  <div class="col-lg-4">
                    <label class="col-form-label title-busq">Calidad en el trabajo</label>
                    <select  name="rel_calidad_crear" id="rel_calidad_crear_formato_gabencognv" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                      <optgroup>
                        <option value="-1">Seleccionar ...</option>
                        <option value="1">1.-EXCELENTE</option>
                        <option value="2">2.-APROPIADO</option>
                        <option value="3">3.-REGULAR</option>
                        <option value="4">4.-DEFICIENTE</option>
                      </optgroup>
                    </select>      
                  </div>

                  <div class="col-lg-4">
                    <label class="col-form-label title-busq">Responsabilidad en el trabajo</label>
                    <select  name="rel_responsabilidad_crear" id="rel_responsabilidad_crear_formato_gabencognv" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                      <optgroup>
                        <option value="-1">Seleccionar ...</option>
                        <option value="1">1.-EXCELENTE</option>
                        <option value="2">2.-APROPIADO</option>
                        <option value="3">3.-REGULAR</option>
                        <option value="4">4.-DEFICIENTE</option>
                      </optgroup>
                    </select>   
                  </div>

                  <div class="col-lg-4">
                    <label class="col-form-label title-busq">Relaciones en el trabajo</label>
                    <select  name="rel_relaciones_crear" id="rel_relaciones_crear_formato_gabencognv" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                      <optgroup>
                        <option value="-1">Seleccionar ...</option>
                        <option value="1">1.-EXCELENTE</option>
                        <option value="2">2.-APROPIADO</option>
                        <option value="3">3.-REGULAR</option>
                        <option value="4">4.-DEFICIENTE</option>
                      </optgroup>
                    </select>   
                  </div>

                  <div class="col-lg-4">
                    <label class="col-form-label title-busq">Honradez  en el trabajo</label>
                    <select  name="rel_honradez_crear" id="rel_honradez_crear_formato_gabencognv" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                      <optgroup>
                        <option value="-1">Seleccionar ...</option>
                        <option value="1">1.-EXCELENTE</option>
                        <option value="2">2.-APROPIADO</option>
                        <option value="3">3.-REGULAR</option>
                        <option value="4">4.-DEFICIENTE</option>
                      </optgroup>
                    </select>   
                  </div>

                  <div class="col-lg-4">
                    <label class="col-form-label title-busq">Asistencia  en el trabajo</label>
                    <select  name="rel_asistencia_crear" id="rel_asistencia_crear_formato_gabencognv" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                      <optgroup>
                        <option value="-1">Seleccionar ...</option>
                        <option value="1">1.-EXCELENTE</option>
                        <option value="2">2.-APROPIADO</option>
                        <option value="3">3.-REGULAR</option>
                        <option value="4">4.-DEFICIENTE</option>
                      </optgroup>
                    </select>   
                  </div>

                  <div class="col-lg-4">
                    <label class="col-form-label title-busq">Puntualidad  en el trabajo</label>
                    <select  name="rel_puntualidad_crear" id="rel_puntualidad_crear_formato_gabencognv" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                      <optgroup>
                        <option value="-1">Seleccionar ...</option>
                        <option value="1">1.-EXCELENTE</option>
                        <option value="2">2.-APROPIADO</option>
                        <option value="3">3.-REGULAR</option>
                        <option value="4">4.-DEFICIENTE</option>
                      </optgroup>
                    </select>   
                  </div>

                  <div class="col-lg-4">
                    <label class="col-form-label title-busq">Iniciativa en el trabajo</label>
                    <select  name="rel_iniciativa_crear" id="rel_iniciativa_crear_formato_gabencognv" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                      <optgroup>
                        <option value="-1">Seleccionar ...</option>
                        <option value="1">1.-EXCELENTE</option>
                        <option value="2">2.-APROPIADO</option>
                        <option value="3">3.-REGULAR</option>
                        <option value="4">4.-DEFICIENTE</option>
                      </optgroup>
                    </select>   
                  </div>

                  <div class="col-lg-4">
                    <label class="col-form-label title-busq">Adicciones</label>
                    <select  name="rel_adicciones_crear" id="rel_adicciones_crear_formato_gabencognv" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                      <optgroup>
                        <option value="-1">Seleccionar ...</option>
                        <option value="1">1.-SI</option>
                        <option value="0">2.-NO</option>
                      </optgroup>
                    </select>   
                  </div>
                  {% endif %}

                  <div class="col-lg-12">
                    <label class="col-form-label title-busq">Notas</label>
                    <textarea id="rel_notas_crear_formato_gabencognv" name="rel_notas_crear" oninput="handleInput(event)" class="form-control-textarea text_area_a" style="min-height:5rem"  placeholder="Notas..." maxlength="600"></textarea>
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
  