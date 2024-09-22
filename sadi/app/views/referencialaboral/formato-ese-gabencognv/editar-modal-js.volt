{% set cuarentayunoEditar= acceso.verificar(41,rol_id) %}
{% set cuarentaycincoEditar= acceso.verificar(45,rol_id) %}
<script type="">

  function fnEditarReferenciaLaboral_formato_gabencognv(
      rel_id,permisoRH,permisoEscalaDesempeno
    )
  {
    let form_ocupado=document.getElementById('frm_editar_referencialaboral_formato_gabencognv');
    form_ocupado.reset();

    $('#rel_ese_id_editar_formato_gabencognv').text($('#ese_id_ese_actual_formato_gabencognv').text());
    $('#rel_ese_nombre_editar_formato_gabencognv').text($('#ese_nombrecompleto_actual_formato_gabencognv').text());
    $('#rel_id_editar_formato_gabencognv').val(rel_id);

    let url_enviar="<?php echo $this->url->get('referencialaboral/ajax_get_detalle/') ?>";

    $.ajax({
      type: "POST",
      url: url_enviar+rel_id,
      success: function(data)
      {
        $('#rel_candidatoempresa_editar_formato_gabencognv').val(data.rel_candidatoempresa);

        $('#rel_candidatodomicilio_editar_formato_gabencognv').val(data.rel_candidatodomicilio);
        $('#rel_candidatojefe_editar_formato_gabencognv').val(data.rel_candidatojefe);
        $('#rel_candidatotelefono_editar_formato_gabencognv').val(data.rel_candidatotelefono);
        $('#rel_candidatopuestoinicial_editar_formato_gabencognv').val(data.rel_candidatopuestoinicial);
        $('#rel_candidatopuestofinal_editar_formato_gabencognv').val(data.rel_candidatopuestofinal);
        $('#rel_candidatoingreso_editar_formato_gabencognv').val(data.rel_candidatoingreso);

        $('#rel_candidatosalida_editar_formato_gabencognv').val(data.rel_candidatosalida);
        $('#rel_candidatosueldoinicial_editar_formato_gabencognv').val(data.rel_candidatosueldoinicial);
        $('#rel_candidatosueldofinal_editar_formato_gabencognv').val(data.rel_candidatosueldofinal);
        $('#rel_candidatoseparacion_editar_formato_gabencognv').val(data.rel_candidatoseparacion);
        $('#rel_candidatoincapacidad_editar_formato_gabencognv').val(data.rel_candidatoincapacidad);
        $('#rel_candidatodemanda_editar_formato_gabencognv').val(data.rel_candidatodemanda);
        $('#rel_candidatorecomendable_editar_formato_gabencognv').val(data.rel_candidatorecomendable);
        if(permisoRH=='1')
        {
        $('#rel_rhempresa_editar_formato_gabencognv').val(data.rel_rhempresa);
        $('#rel_rhdomicilio_editar_formato_gabencognv').val(data.rel_rhdomicilio);
        $('#rel_rhjefe_editar_formato_gabencognv').val(data.rel_rhjefe);
        $('#rel_rhtelefono_editar_formato_gabencognv').val(data.rel_rhtelefono);
        $('#rel_rhpuestoinicial_editar_formato_gabencognv').val(data.rel_rhpuestoinicial);
        $('#rel_rhpuestofinal_editar_formato_gabencognv').val(data.rel_rhpuestofinal);
        $('#rel_rhingreso_editar_formato_gabencognv').val(data.rel_rhingreso);
        $('#rel_rhsalida_editar_formato_gabencognv').val(data.rel_rhsalida);
        $('#rel_rhsueldoinicial_editar_formato_gabencognv').val(data.rel_rhsueldoinicial);
        $('#rel_rhsueldofinal_editar_formato_gabencognv').val(data.rel_rhsueldofinal);
        $('#rel_rhseparacion_editar_formato_gabencognv').val(data.rel_rhseparacion);
        $('#rel_rhincapacidad_editar_formato_gabencognv').val(data.rel_rhincapacidad);
        $('#rel_rhdemanda_editar_formato_gabencognv').val(data.rel_rhdemanda);
        $('#rel_rhrecomendable_editar_formato_gabencognv').val(data.rel_rhrecomendable);
        }

        $('#rel_notas_editar_formato_gabencognv').val(data.rel_notas);
        if(permisoEscalaDesempeno=='1')
        {
        $('#rel_calidad_editar_formato_gabencognv').val((data.rel_calidad =='' || data.rel_calidad== -1 || data.rel_calidad== null ? -1 : data.rel_calidad));
        $('#rel_calidad_editar_formato_gabencognv').trigger('change');

        $('#rel_relaciones_editar_formato_gabencognv').val((data.rel_relaciones =='' || data.rel_relaciones== -1 || data.rel_relaciones== null ? -1 : data.rel_relaciones));
        $('#rel_relaciones_editar_formato_gabencognv').trigger('change');

        $('#rel_honradez_editar_formato_gabencognv').val((data.rel_honradez =='' || data.rel_honradez== -1 || data.rel_honradez== null ? -1 : data.rel_honradez));
        $('#rel_honradez_editar_formato_gabencognv').trigger('change');

        $('#rel_asistencia_editar_formato_gabencognv').val((data.rel_asistencia =='' || data.rel_asistencia== -1 || data.rel_asistencia== null ? -1 : data.rel_asistencia));
        $('#rel_asistencia_editar_formato_gabencognv').trigger('change');

        $('#rel_puntualidad_editar_formato_gabencognv').val((data.rel_puntualidad =='' || data.rel_puntualidad== -1 || data.rel_puntualidad== null ? -1 : data.rel_puntualidad));
        $('#rel_puntualidad_editar_formato_gabencognv').trigger('change');

        $('#rel_iniciativa_editar_formato_gabencognv').val((data.rel_iniciativa =='' || data.rel_iniciativa== -1 || data.rel_iniciativa== null ? -1 : data.rel_iniciativa));
        $('#rel_iniciativa_editar_formato_gabencognv').trigger('change');

        $('#rel_adicciones_editar_formato_gabencognv').val((data.rel_adicciones =='' || data.rel_adicciones== -1 || data.rel_adicciones== null ? -1 : data.rel_adicciones));
        $('#rel_adicciones_editar_formato_gabencognv').trigger('change');

        $('#rel_responsabilidad_editar_formato_gabencognv').val((data.rel_responsabilidad =='' || data.rel_responsabilidad== -1 || data.rel_responsabilidad== null ? -1 : data.rel_responsabilidad));
        $('#rel_responsabilidad_editar_formato_gabencognv').trigger('change');
        }
      },
      error: function(data)
      {
        alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'); 
      }
    });
  }

  $(function (){
    $('#frm_editar_referencialaboral_formato_gabencognv').submit(function(event) {
      let $form = $(this);
      a=$form.valid();
      if(a==false){
          return false;
      }
      $form.find("button").prop("disabled", true);
      let url_enviar="<?php echo $this->url->get('referencialaboral/actualizar/') ?>";
      $.ajax({
        type: "POST",
        url: url_enviar,
        data: $('#frm_editar_referencialaboral_formato_gabencognv').serialize(),
        success: function(res)
        {
          if(res[0]==2)
          {
          Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
            .then((value) => {
              $form.find("button").prop("disabled", false);
              let form_ocupado=document.getElementById('frm_editar_referencialaboral_formato_gabencognv');
              form_ocupado.reset();
              $('#editar-referencialaboral_formato_gabencognv-modal').modal('hide');
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
          alert('Error en el servidor...');
        }
      });
      return false;
    });
  });
 </script>
 
 

<div class="modal fade" id="editar-referencialaboral_formato_gabencognv-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-semi-grande  modal-dialog-scrollable">
    <div class="modal-content">
      <!-- <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
 -->        <div class="modal-header">
            <h5><div id="">
              <i class="mdi mdi-pencil-circle"></i>Editar una referencia laboral  del estudio No. <span id="rel_ese_id_editar_formato_gabencognv"></span> "<span id="rel_ese_nombre_editar_formato_gabencognv"></span>"
            </div></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- //contenido -->
            <form id="frm_editar_referencialaboral_formato_gabencognv" class="form-vertical mt-1" novalidate method="post">
              <div class="form-group row">
                <input type="hidden" id="rel_id_editar_formato_gabencognv" name="rel_id_editar" />
                <div class="{% if cuarentayunoEditar==1 %} col-lg-6{% else %} col-lg-12{% endif %} ">
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
                  <input name="rel_candidatoempresa_editar" id="rel_candidatoempresa_editar_formato_gabencognv" type="text" class="form-control input-rounded data-not-lt-active" required oninput="handleInput(event)"  placeholder="Nombre..." maxlength="65" />
                </div>
                {% if cuarentayunoAgregar==1 %}
                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Nombre de empresa -RH</label>
                  <input name="rel_rhempresa_editar" id="rel_rhempresa_editar_formato_gabencognv" type="text" required class="form-control input-rounded data-not-lt-active" oninput="handleInput(event)"   placeholder="Nombre de la empresa..."  maxlength="65"/>
                </div>
                {% endif %}

                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Domicilio</label>
                  <input name="rel_candidatodomicilio_editar" id="rel_candidatodomicilio_editar_formato_gabencognv" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Domicilio..."  maxlength="75"/>
                </div>

                {% if cuarentayunoAgregar==1 %}
                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Domiclio -RH</label>
                  <input name="rel_rhdomicilio_editar" id="rel_rhdomicilio_editar_formato_gabencognv" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Domicilio.."  maxlength="75"/>
                </div>
                {% endif %}

                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Nombre de Jefe directo inmediato</label>
                  <input name="rel_candidatojefe_editar" id="rel_candidatojefe_editar_formato_gabencognv" type="text" class="form-control input-rounded data-not-lt-active" oninput="handleInput(event)"   placeholder="Nombre de jefe inmediato..."  maxlength="45"/>
                </div>

                {% if cuarentayunoAgregar==1 %}
                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Nombre de jefe inmediato -RH</label>
                  <input name="rel_rhjefe_editar" id="rel_rhjefe_editar_formato_gabencognv" type="text" class="form-control input-rounded data-not-lt-active" oninput="handleInput(event)"   placeholder="Nombre de jefe inmediato..."  maxlength="45"/>
                </div>
                {% endif %}              

                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Teléfono</label>
                  <input name="rel_candidatotelefono_editar" id="rel_candidatotelefono_editar_formato_gabencognv" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Teléfono..."  maxlength="45"/>
                </div>

                {% if cuarentayunoAgregar==1 %}
                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Teléfono -RH</label>
                  <input name="rel_rhtelefono_editar" id="rel_rhtelefono_editar_formato_gabencognv" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Teléfono..."  maxlength="45"/>
                </div>
                {% endif %}

                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Puesto inicial</label>
                  <input name="rel_candidatopuestoinicial_editar" id="rel_candidatopuestoinicial_editar_formato_gabencognv" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Puesto inicial..."  maxlength="45"/>
                </div>

                {% if cuarentayunoAgregar==1 %}
                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Puesto inicial -RH</label>
                  <input name="rel_rhpuestoinicial_editar" id="rel_rhpuestoinicial_editar_formato_gabencognv" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Puesto inicial..."  maxlength="45"/>
                </div>
                {% endif %}

                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Puesto final</label>
                  <input name="rel_candidatopuestofinal_editar" id="rel_candidatopuestofinal_editar_formato_gabencognv" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Puesto final..."  maxlength="45"/>
                </div>
               
                {% if cuarentayunoAgregar==1 %}
                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Puesto final -RH</label>
                  <input name="rel_rhpuestofinal_editar" id="rel_rhpuestofinal_editar_formato_gabencognv" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Puesto final..."  maxlength="45"/>
                </div>
                {% endif %}

                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Fecha de ingreso</label>
                  <input name="rel_candidatoingreso_editar" id="rel_candidatoingreso_editar_formato_gabencognv" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Fecha de ingreso..."  maxlength="45"/>
                </div>

                {% if cuarentayunoAgregar==1 %}
                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Fecha de ingreso -RH</label>
                  <input name="rel_rhingreso_editar" id="rel_rhingreso_editar_formato_gabencognv" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Fecha de ingreso..."  maxlength="45"/>
                </div>
                {% endif %}

                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Fecha de salida</label>
                  <input name="rel_candidatosalida_editar" id="rel_candidatosalida_editar_formato_gabencognv" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Fecha de salida..."  maxlength="45"/>
                </div>

                {% if cuarentayunoAgregar==1 %}
                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Fecha de salida -RH</label>
                  <input name="rel_rhsalida_editar" id="rel_rhsalida_editar_formato_gabencognv" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Fecha de salida..."  maxlength="45"/>
                </div>
                {% endif %}

                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Sueldo inicial</label>
                  <input name="rel_candidatosueldoinicial_editar" id="rel_candidatosueldoinicial_editar_formato_gabencognv" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Puesto inicial..."  maxlength="45"/>
                </div>

                {% if cuarentayunoAgregar==1 %}
                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Sueldo inicial  -RH</label>
                  <input name="rel_rhsueldoinicial_editar" id="rel_rhsueldoinicial_editar_formato_gabencognv" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Sueldo inicial..."  maxlength="45"/>
                </div>
                {% endif %}

                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Sueldo final</label>
                  <input name="rel_candidatosueldofinal_editar" id="rel_candidatosueldofinal_editar_formato_gabencognv" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Puesto final..."  maxlength="45"/>
                </div>

                {% if cuarentayunoAgregar==1 %}
                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Sueldo final -RH</label>
                  <input name="rel_rhsueldofinal_editar" id="rel_rhsueldofinal_editar_formato_gabencognv" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Sueldo final..."  maxlength="45"/>
                </div>
                {% endif %}

                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Motivo de separación</label>
                  <input name="rel_candidatoseparacion_editar" id="rel_candidatoseparacion_editar_formato_gabencognv" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Motivo de separación..."  maxlength="75"/>
                </div>                
                
                {% if cuarentayunoAgregar==1 %}
                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Motivo de separación -RH</label>
                  <input name="rel_rhseparacion_editar" id="rel_rhseparacion_editar_formato_gabencognv" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Motivo de separación..."  maxlength="75"/>
                </div>
                {% endif %}

                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Incapacidad o accidentes</label>
                  <input name="rel_candidatoincapacidad_editar" id="rel_candidatoincapacidad_editar_formato_gabencognv" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Incapacidad o accidentes..."  maxlength="45"/>
                </div>

                {% if cuarentayunoAgregar==1 %}
                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Incapacidad o accidentes -RH</label>
                  <input name="rel_rhincapacidad_editar" id="rel_rhincapacidad_editar_formato_gabencognv" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Incapacidad o accidentes..."  maxlength="45"/>
                </div>
                {% endif %}

                <div class="col-lg-6">
                  <label class="col-form-label title-busq">¿Hubo alguna demanda o plática conciliatoria en la separación del empleado?
                  </label>
                  <input name="rel_candidatodemanda_editar" id="rel_candidatodemanda_editar_formato_gabencognv" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Demandas..."  maxlength="45"/>
                </div>

                {% if cuarentayunoAgregar==1 %}
                <div class="col-lg-6">
                  <label class="col-form-label title-busq">¿Hubo alguna demanda o plática conciliatoria en la separación del empleado? -RH
                  </label>
                  <input name="rel_rhdemanda_editar" id="rel_rhdemanda_editar_formato_gabencognv" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Demandas..."  maxlength="45"/>
                </div>
                {% endif %}

                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Recomendable</label>
                  <input name="rel_candidatorecomendable_editar" id="rel_candidatorecomendable_editar_formato_gabencognv" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Recomendable..."  maxlength="45"/>
                </div>
                {% if cuarentayunoAgregar==1 %}
                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Recomendable -RH</label>
                  <input name="rel_rhrecomendable_editar" id="rel_rhrecomendable_editar_formato_gabencognv" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Recomendable..."  maxlength="45"/>
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
                  <select  name="rel_calidad_editar" id="rel_calidad_editar_formato_gabencognv" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
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
                  <select  name="rel_responsabilidad_editar" id="rel_responsabilidad_editar_formato_gabencognv" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
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
                  <select  name="rel_relaciones_editar" id="rel_relaciones_editar_formato_gabencognv" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
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
                  <select  name="rel_honradez_editar" id="rel_honradez_editar_formato_gabencognv" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
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
                  <select  name="rel_asistencia_editar" id="rel_asistencia_editar_formato_gabencognv" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
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
                  <select  name="rel_puntualidad_editar" id="rel_puntualidad_editar_formato_gabencognv" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
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
                  <label class="col-form-label title-busq">Inciativa en el trabajo</label>
                  <select  name="rel_iniciativa_editar" id="rel_iniciativa_editar_formato_gabencognv" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
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
                  <select  name="rel_adicciones_editar" id="rel_adicciones_editar_formato_gabencognv" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
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
                  <textarea id="rel_notas_editar_formato_gabencognv" name="rel_notas_editar" oninput="handleInput(event)" class="form-control-textarea text_area_a" placeholder="Notas..." style="min-height:5rem" maxlength="600"></textarea>
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
                        <button type="submit" class="btn-dark btn-rounded btn btn-buscar">Editar  <i class="mdi mdi-content-save white"></i></button>
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
