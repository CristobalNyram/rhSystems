{# datos por candidatos #}
{% set treintaynueve= acceso.verificar(39,rol_id) %}
{# datos por rh #}
{% set cuarenta= acceso.verificar(40,rol_id) %}
{# escala desempeño #}
{% set cuarentayuno= acceso.verificar(41,rol_id) %}



{# permisos para mostrar lista de registros inicio  #}
{% set ochentaysiete_rl_lis= acceso.verificar(87,rol_id) %}
{# permisos para mostrar lista de registros inicio  #}

<script type="">
    function fnCrearReferenciaLaboral(sel_id){
    // $('#agd_agf_id').val($('#agf_id').val());
      $('#frm_crear_referencialaboral-general')[0].reset(); // Reinicia el formulario
      $('#rel_exc_id_crear').text($('#rel_exc_id_crear').text());
      $('#rel_exc_nombre_crear').text($('#ese_nombrecompleto_actual').text()); 
      $('#rel_sel_id').val(sel_id);
      $('#rel_calidad_crear').val('-1').change();      
      $('#rel_relaciones_crear').val('-1').change();
      $('#rel_honradez_crear').val('-1').change();
      $('#rel_asistencia_crear').val('-1').change();
      $('#rel_puntualidad_crear').val('-1').change();
      $('#rel_iniciativa_crear').val('-1').change();
      $('#rel_adicciones_crear').val('-1').change();
      $('#rel_responsabilidad_crear').val('-1').change();
      $('#rel_exc_id_crear').text(sel_id);


    }
    
    $(function (){
      
      $('#frm_crear_referencialaboral-general').submit(function(event) {
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
          data: $form.serialize(),
          success: function(res)
          {
           // console.log(res);
             switch (res['estado']) {
                    case 2:
                    swalalert('Éxito',res['mensaje'], "success", 0);
                      {% if ochentaysiete_rl_lis==1 %}
                      fnCargarTablaDatoReferenciaLaboral(res['sel_id'])
                      {% endif %} 

                      $("#agregar-referencialaboral-modal").modal("hide");
                      $form.find("button").prop("disabled", false);
                      break;
                  
                    case -2:
                    swalalertHTML(res["titular"],`${res['mensaje']} <br> <span class=></span> `, "error",1);
                    console.error(res);							
                    break;
                    case -1:
                    swalalertHTML(res["titular"],`${res['mensaje']} <br> <span class=></span> `, "warning");
                    $form.find("button").prop("disabled", false);
                    console.warn(res);							
                    break;
                
                    default:
                    
                      break;
              }
          
          },
          error: function(res)
          { 
           alert('error en el servidor...'+res.responseText);
          }
        });
        return false;
      });
    });
</script>

<div class="modal fade" id="agregar-referencialaboral-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-semi-grande  modal-dialog-scrollable">
      <div class="modal-content">
        <!-- <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
   -->        <div class="modal-header">
              <h5><div id="">
                <i class="mdi mdi-plus"></i>Agregar una referencia laboral de la sección laboral No. <span id="rel_exc_id_crear"></span> 
              </div></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <!-- //contenido -->
              <form id="frm_crear_referencialaboral-general" class="form-vertical mt-1" novalidate method="post">
                <div class="form-group row">
                  <input type="hidden" id="rel_sel_id" name="rel_sel_id" />
                  <div class="{% if cuarenta==1 %} col-lg-6{% else %} col-lg-12{% endif %} ">
                    <h5 class="text-info ml-4 mt-4">
                      <i class="mdi mdi-worker "></i>Datos proporcionados por el candidato
                    </h5>
                  </div >
                  {% if cuarenta==1 %}

                  <div class="col-lg-6">
                    <h5 class="text-info ml-4 mt-4">
                      <i class="mdi mdi-worker "></i>Datos de RH
                    </h5>
                    <br>
                  </div >
                  {% endif %}

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Nombre de la empresa</label>
                    <input name="rel_candidatoempresa_crear" id="rel_candidatoempresa_crear" type="text" class="form-control input-rounded data-not-lt-active" required oninput="handleInput(event)"  placeholder="Nombre..." maxlength="65" />
                  </div>
                  {% if cuarenta==1 %}
                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Nombre de empresa -RH</label>
                    <input name="rel_rhempresa_crear" id="rel_rhempresa_crear" type="text" required class="form-control input-rounded data-not-lt-active" oninput="handleInput(event)"   placeholder="Nombre de la empresa..."  maxlength="65"/>
                  </div>
                  {% endif %}
                  
                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Domicilio</label>
                    <input name="rel_candidatodomicilio_crear" id="rel_candidatodomicilio_crear" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Domicilio..."  maxlength="75"/>
                  </div>
                  
                  {% if cuarenta==1 %}
                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Domiclio -RH</label>
                    <input name="rel_rhdomicilio_crear" id="rel_rhdomicilio_crear" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Domicilio.."  maxlength="75"/>
                  </div>
                  {% endif %}

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Nombre de Jefe directo inmediato</label>
                    <input name="rel_candidatojefe_crear" id="rel_candidatojefe_crear" type="text" class="form-control input-rounded data-not-lt-active" oninput="handleInput(event)"   placeholder="Nombre de jefe inmediato..."  maxlength="50"/>
                  </div>

                  {% if cuarenta==1 %}
                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Nombre de jefe inmediato -RH</label>
                    <input name="rel_rhjefe_crear" id="rel_rhjefe_crear" type="text" class="form-control input-rounded data-not-lt-active" oninput="handleInput(event)"   placeholder="Nombre de jefe inmediato..."  maxlength="50"/>
                  </div>
                  {% endif %}

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Teléfono</label>
                    <input name="rel_candidatotelefono_crear" id="rel_candidatotelefono_crear" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Teléfono..."  maxlength="45"/>
                  </div>

                  {% if cuarenta==1 %}
                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Teléfono -RH</label>
                    <input name="rel_rhtelefono_crear" id="rel_rhtelefono_crear" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Teléfono..."  maxlength="45"/>
                  </div>
                  {% endif %}

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Puesto inicial</label>
                    <input name="rel_candidatopuestoinicial_crear" id="rel_candidatopuestoinicial_crear" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Puesto inicial..."  maxlength="45"/>
                  </div>

                  {% if cuarenta==1 %}
                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Puesto inicial -RH</label>
                    <input name="rel_rhpuestoinicial_crear" id="rel_rhpuestoinicial_crear" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Puesto inicial..."  maxlength="45"/>
                  </div>
                  {% endif %}

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Puesto final</label>
                    <input name="rel_candidatopuestofinal_crear" id="rel_candidatopuestofinal_crear" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Puesto final..."  maxlength="45"/>
                  </div>
                 
                  {% if cuarenta==1 %}
                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Puesto final -RH</label>
                    <input name="rel_rhpuestofinal_crear" id="rel_rhpuestofinal_crear" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Puesto final..."  maxlength="45"/>
                  </div>
                  {% endif %}

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Fecha de ingreso</label>
                    <input name="rel_candidatoingreso_crear" id="rel_candidatoingreso_crear" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Fecha de ingreso..."  maxlength="45"/>
                  </div>

                  {% if cuarenta==1 %}
                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Fecha de ingreso -RH</label>
                    <input name="rel_rhingreso_crear" id="rel_rhingreso_crear" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Fecha de ingreso..."  maxlength="45"/>
                  </div>
                  {% endif %}

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Fecha de salida</label>
                    <input name="rel_candidatosalida_crear" id="rel_candidatosalida_crear" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Fecha de salida..."  maxlength="45"/>
                  </div>

                  {% if cuarenta==1 %}
                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Fecha de salida -RH</label>
                    <input name="rel_rhsalida_crear" id="rel_rhsalida_crear" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Fecha de salida..."  maxlength="45"/>
                  </div>
                  {% endif %}

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Sueldo inicial</label>
                    <input name="rel_candidatosueldoinicial_crear" id="rel_candidatosueldoinicial_crear" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Sueldo inicial..."  maxlength="45"/>
                  </div>

                  {% if cuarenta==1 %}
                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Sueldo inicial  -RH</label>
                    <input name="rel_rhsueldoinicial_crear" id="rel_rhsueldoinicial_crear" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Sueldo inicial..."  maxlength="45"/>
                  </div>
                  {% endif %}

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Sueldo final</label>
                    <input name="rel_candidatosueldofinal_crear" id="rel_candidatosueldofinal_crear" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Sueldo final..."  maxlength="45"/>
                  </div>

                  {% if cuarenta==1 %}
                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Sueldo final -RH</label>
                    <input name="rel_rhsueldofinal_crear" id="rel_rhsueldofinal_crear" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Sueldo final..."  maxlength="45"/>
                  </div>
                  {% endif %}

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Motivo de separación</label>
                    <input name="rel_candidatoseparacion_crear" id="rel_candidatoseparacion_crear" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Motivo de separación..."  maxlength="75"/>
                  </div>

                  {% if cuarenta==1 %}
                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Motivo de separación -RH</label>
                    <input name="rel_rhseparacion_crear" id="rel_rhseparacion_crear" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Motivo de separación..."  maxlength="75"/>
                  </div>
                  {% endif %}

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Incapacidad o accidentes</label>
                    <input name="rel_candidatoincapacidad_crear" id="rel_candidatoincapacidad_crear" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Incapacidad o accidentes..."  maxlength="45"/>
                  </div>
                  
                  {% if cuarenta==1 %}
                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Incapacidad o accidentes -RH</label>
                    <input name="rel_rhincapacidad_crear" id="rel_rhincapacidad_crear" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Incapacidad o accidentes..."  maxlength="45"/>
                  </div>
                  {% endif %}

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">¿Hubo alguna demanda o plática conciliatoria en la separación del empleado?
                    </label>
                    <input name="rel_candidatodemanda_crear" id="rel_candidatodemanda_crear" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Demandas..."  maxlength="45"/>
                  </div>

                  {% if cuarenta==1 %}
                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">¿Hubo alguna demanda o plática conciliatoria en la separación del empleado? -RH
                    </label>
                    <input name="rel_rhdemanda_crear" id="rel_rhdemanda_crear" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Demandas..."  maxlength="45"/>
                  </div>
                  {% endif %}

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Recomendable</label>
                    <input name="rel_candidatorecomendable_crear" id="rel_candidatorecomendable_crear" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Recomendable..."  maxlength="45"/>
                  </div>

                  {% if cuarenta==1 %}
                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Recomendable -RH</label>
                    <input name="rel_rhrecomendable_crear" id="rel_rhrecomendable_crear" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Recomendable..."  maxlength="45"/>

                  </div>
                  {% endif %}

                  {% if cuarentayuno==1 %}
                  <div class="col-lg-12">
                    <h5 class="text-success ml-4 mt-4">
                      <i class="mdi mdi-check "></i>Escala de desempeño
                    </h5>
                    <br>
                  </div>
                  <div class="col-lg-4">
                    <label class="col-form-label title-busq">Calidad en el trabajo</label>
                    <select  name="rel_calidad_crear" id="rel_calidad_crear" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
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
                    <select  name="rel_responsabilidad_crear" id="rel_responsabilidad_crear" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
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
                    <select  name="rel_relaciones_crear" id="rel_relaciones_crear" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
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
                    <select  name="rel_honradez_crear" id="rel_honradez_crear" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
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
                    <select  name="rel_asistencia_crear" id="rel_asistencia_crear" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
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
                    <select  name="rel_puntualidad_crear" id="rel_puntualidad_crear" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
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
                    <select  name="rel_iniciativa_crear" id="rel_iniciativa_crear" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
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
                    <select  name="rel_adicciones_crear" id="rel_adicciones_crear" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
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
                    <textarea id="rel_notas_crear" name="rel_notas_crear" oninput="handleInput(event)" class="form-control-textarea text_area_a" style="min-height:5rem" maxlength="600"></textarea>
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
  