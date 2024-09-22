{% set cuarentayunoEditar= acceso.verificar(41,rol_id) %}
{% set cuarentaycincoEditar= acceso.verificar(45,rol_id) %}
<script type="">

  function fnEditarReferenciaLaboralFormatoTruper(
      rel_id,permisoRH,permisoEscalaDesempeno
    )
  {
    let form_ocupado=document.getElementById('frm_editar_referencialaboral-formato_truper');
    form_ocupado.reset();

    $('#rel_ese_id_editar-formato_truper').text($('#ese_id_ese_actual_formato_ese_truper').text());
    $('#rel_ese_nombre_editar-formato_truper').text($('#ese_nombrecompleto_actual_formato_ese_truper').text());
    $('#rel_id_editar-formato_truper').val(rel_id);

    let url_enviar="<?php echo $this->url->get('referencialaboral/ajax_get_detalle/') ?>";

    $.ajax({
      type: "POST",
      url: url_enviar+rel_id,
      success: function(data)
      {
        $('#rel_candidatoempresa_editar-formato_truper').val(data.rel_candidatoempresa);
        $('#rel_candidatoempresagiro_editar-formato_truper').val(data.rel_candidatoempresagiro);

        $('#rel_candidatodomicilio_editar-formato_truper').val(data.rel_candidatodomicilio);
        $('#rel_candidatojefe_editar-formato_truper').val(data.rel_candidatojefe);
        $('#rel_candidatotelefono_editar-formato_truper').val(data.rel_candidatotelefono);
        $('#rel_candidatopuestoinicial_editar-formato_truper').val(data.rel_candidatopuestoinicial);
        $('#rel_candidatopuestofinal_editar-formato_truper').val(data.rel_candidatopuestofinal);
        $('#rel_candidatoingreso_editar-formato_truper').val(data.rel_candidatoingreso);

        $('#rel_candidatoareafinal_editar-formato_truper').val(data.rel_candidatoareafinal);
        $('#rel_candidatoareaincial_editar-formato_truper').val(data.rel_candidatoareaincial);

        
        $('#rel_candidatosalida_editar-formato_truper').val(data.rel_candidatosalida);
        $('#rel_candidatosueldoinicial_editar-formato_truper').val(data.rel_candidatosueldoinicial);
        $('#rel_candidatosueldofinal_editar-formato_truper').val(data.rel_candidatosueldofinal);
        $('#rel_candidatoseparacion_editar-formato_truper').val(data.rel_candidatoseparacion);
    

        $('#rel_notas_editar-formato_truper').val(data.rel_notas);

        if(permisoEscalaDesempeno=='1')
        {
        $('#rel_calidarel_editar-formato_truper').val((data.rel_calidad =='' || data.rel_calidad== -1 || data.rel_calidad== null ? -1 : data.rel_calidad));
        $('#rel_calidarel_editar-formato_truper').trigger('change');

     

        $('#rel_honradez_editar-formato_truper').val((data.rel_honradez =='' || data.rel_honradez== -1 || data.rel_honradez== null ? -1 : data.rel_honradez));
        $('#rel_honradez_editar-formato_truper').trigger('change');

     

        $('#rel_puntualidad_editar-formato_truper').val((data.rel_puntualidad =='' || data.rel_puntualidad== -1 || data.rel_puntualidad== null ? -1 : data.rel_puntualidad));
        $('#rel_puntualidad_editar-formato_truper').trigger('change');

        $('#rel_iniciativa_editar-formato_truper').val((data.rel_iniciativa =='' || data.rel_iniciativa== -1 || data.rel_iniciativa== null ? -1 : data.rel_iniciativa));
        $('#rel_iniciativa_editar-formato_truper').trigger('change');

   

        $('#rel_responsabilidad_editar-formato_truper').val((data.rel_responsabilidad =='' || data.rel_responsabilidad== -1 || data.rel_responsabilidad== null ? -1 : data.rel_responsabilidad));
        $('#rel_responsabilidad_editar-formato_truper').trigger('change');

        $('#rel_relacionescompanieros_editar-formato_truper').val((data.rel_relacionescompanieros =='' || data.rel_relacionescompanieros== -1 || data.rel_relacionescompanieros== null ? -1 : data.rel_relacionescompanieros));
        $('#rel_relacionescompanieros_editar-formato_truper').trigger('change');


        $('#rel_relacionessuperiores_editar-formato_truper').val((data.rel_relacionessuperiores =='' || data.rel_relacionessuperiores== -1 || data.rel_relacionessuperiores== null ? -1 : data.rel_relacionessuperiores));
        $('#rel_relacionessuperiores_editar-formato_truper').trigger('change');


        $('#rel_apegonormas_editar-formato_truper').val((data.rel_apegonormas =='' || data.rel_apegonormas== -1 || data.rel_apegonormas== null ? -1 : data.rel_apegonormas));
        $('#rel_apegonormas_editar-formato_truper').trigger('change');



        $('#rel_adaptacion_editar-formato_truper').val((data.rel_adaptacion =='' || data.rel_adaptacion== -1 || data.rel_adaptacion== null ? -1 : data.rel_adaptacion));
        $('#rel_adaptacion_editar-formato_truper').trigger('change');


        $('#rel_decisiones_editar-formato_truper').val((data.rel_decisiones =='' || data.rel_decisiones== -1 || data.rel_decisiones== null ? -1 : data.rel_decisiones));
        $('#rel_decisiones_editar-formato_truper').trigger('change');


        $('#rel_trabajoenquipo_editar-formato_truper').val((data.rel_trabajoenquipo =='' || data.rel_trabajoenquipo== -1 || data.rel_trabajoenquipo== null ? -1 : data.rel_trabajoenquipo));
        $('#rel_trabajoenquipo_editar-formato_truper').trigger('change');

        $('#rel_desempenio_editar-formato_truper').val((data.rel_desempenio =='' || data.rel_desempenio== -1 || data.rel_desempenio== null ? -1 : data.rel_desempenio));
        $('#rel_desempenio_editar-formato_truper').trigger('change');

        $('#rel_candidatorecomendable_editar-formato_truper').val((data.rel_candidatorecomendable =='' || data.rel_candidatorecomendable== -1 || data.rel_candidatorecomendable== null ? -1 : data.rel_candidatorecomendable));
        $('#rel_candidatorecomendable_editar-formato_truper').trigger('change');

        $('#rel_candidatodemanda_editar-formato_truper').val((data.rel_candidatodemanda =='' || data.rel_candidatodemanda== -1 || data.rel_candidatodemanda== null ? -1 : data.rel_candidatodemanda));
        $('#rel_candidatodemanda_editar-formato_truper').trigger('change');
        
        
      

        
        }
      },
      error: function(data)
      {
        alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'); 
      }
    });
  }

  $(function (){
    $('#frm_editar_referencialaboral-formato_truper').submit(function(event) {
      let $form = $(this);
      a=$form.valid();
      if(a==false){
          return false;
      }
      $form.find("button").prop("disabled", true);
      let url_enviar="<?php echo $this->url->get('referencialaboral/actualizar_formato_truper/') ?>";
      $.ajax({
        type: "POST",
        url: url_enviar,
        data: $('#frm_editar_referencialaboral-formato_truper').serialize(),
        success: function(res)
        {
          if(res[0]==2)
          {
          Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
            .then((value) => {
              $form.find("button").prop("disabled", false);
              let form_ocupado=document.getElementById('frm_editar_referencialaboral-formato_truper');
              form_ocupado.reset();
              $('#editar-referencialaboral-truper-modal').modal('hide');
              fnCargarTablaDatoReferenciaLaboralFormatoTruper(res['sel_id']);
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
 
 

 <div class="modal fade" id="editar-referencialaboral-truper-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-semi-grande  modal-dialog-scrollable">
    <div class="modal-content">
      <!-- <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
 -->        <div class="modal-header">
            <h5><div id="">
              <i class="mdi mdi-pencil"></i>Editar una referencia laboral al estudio No. <span id="rel_ese_id_editar-formato_truper"></span> "<span id="rel_ese_nombre_editar-formato_truper"></span>"
            </div></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- //contenido -->
            <form id="frm_editar_referencialaboral-formato_truper" class="form-vertical mt-1" novalidate method="post">
              <div class="form-group row">
                <input type="hidden" id="rel_id_editar-formato_truper" name="rel_id_editar" />
                <div class=" col-lg-12 ">
                  <h5 class="text-info ml-4 mt-4">
                    <i class="mdi mdi-worker "></i>Datos proporcionados por el candidato
                  </h5>
                </div >

                <div class="col-lg-6">
                  <h5 class="text-info ml-4 mt-4">
                  </h5>
                  <br>
                </div >

                <div class="col-lg-12">
                  <label class="col-form-label title-busq">Nombre de la empresa</label>
                  <input name="rel_candidatoempresa" id="rel_candidatoempresa_editar-formato_truper" type="text" class="form-control input-rounded data-not-lt-active" required oninput="handleInput(event)"  placeholder="Nombre..." maxlength="65" />
                </div>
              
                <div class="col-lg-12">
                  <label class="col-form-label title-busq">Giro de la empresa</label>
                  <input name="rel_candidatoempresagiro" id="rel_candidatoempresagiro_editar-formato_truper" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Giro..."  maxlength="75"/>
                </div>
                
                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Domicilio</label>
                  <input name="rel_candidatodomicilio" id="rel_candidatodomicilio_editar-formato_truper" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Domicilio..."  maxlength="75"/>
                </div>
                
            

               
           

                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Teléfono</label>
                  <input name="rel_candidatotelefono" id="rel_candidatotelefono_editar-formato_truper" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Teléfono..."  maxlength="45"/>
                </div>

            
                <div class="col-lg-12">
                  <label class="col-form-label title-busq">Nombre de Jefe directo inmediato</label>
                  <input name="rel_candidatojefe" id="rel_candidatojefe_editar-formato_truper" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Nombre de jefe inmediato..."  maxlength="45"/>
                </div>

                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Puesto </label>
                  <input name="rel_candidatopuestoinicial" id="rel_candidatopuestoinicial_editar-formato_truper" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Puesto inicial..."  maxlength="45"/>
                </div>
                <div class="col-lg-6 d-none">
                  <label class="col-form-label title-busq">Puesto final</label>
                  <input name="rel_candidatopuestofinal" id="rel_candidatopuestofinal_editar-formato_truper" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Puesto final..."  maxlength="45"/>
                </div>
        

           
                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Área                   </label>
                  <input name="rel_candidatoareaincial" id="rel_candidatoareaincial_editar-formato_truper" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Área inicial..."  maxlength="45"/>
                </div>
                <div class="col-lg-6 d-none">
                  <label class="col-form-label title-busq">Área  final                 </label>
                  <input name="rel_candidatoareafinal" id="rel_candidatoareafinal_editar-formato_truper" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Área final..."  maxlength="45"/>
                </div>
               
            

                <div class="col-lg-6">
                  <!-- <label class="col-form-label title-busq">Fecha de ingreso</label> -->
                  <label class="col-form-label title-busq">Periodo</label>

                  <input name="rel_candidatoingreso" id="rel_candidatoingreso_editar-formato_truper" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Periodo..."  maxlength="45"/>
                </div>

             
                <div class="col-lg-6 d-none">
                  <label class="col-form-label title-busq">Fecha de salida</label>
                  <input name="rel_candidatosalida" id="rel_candidatosalida_editar-formato_truper" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Fecha de salida..."  maxlength="45"/>
                </div>

         

                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Sueldo </label>
                  <input name="rel_candidatosueldoinicial" id="rel_candidatosueldoinicial_editar-formato_truper" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Sueldo inicial..."  maxlength="45"/>
                </div>

                <div class="col-lg-6 d-none">
                  <label class="col-form-label title-busq">Sueldo final</label>
                  <input name="rel_candidatosueldofinal" id="rel_candidatosueldofinal_editar-formato_truper" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Sueldo final..."  maxlength="45"/>
                </div>

             

         
            

                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Motivo de separación</label>
                  <input name="rel_candidatoseparacion" id="rel_candidatoseparacion_editar-formato_truper" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Motivo de separación..."  maxlength="75"/>
                </div>

          

                
         

                <div class="col-lg-6">
                  <label class="col-form-label title-busq">¿Hubo alguna demanda o plática conciliatoria en la separación del empleado?
                  </label>
                
                  <select  name="rel_candidatodemanda" id="rel_candidatodemanda_editar-formato_truper" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                    <optgroup>
                      <option value="-1">Seleccionar ...</option>
                      <option value="1">1.-SÍ</option>
                      <option value="0">2.-NO</option>
                    </optgroup>
                  </select>   
                </div>

            

                <div class="col-lg-12">
                  <label class="col-form-label title-busq">Recomendable</label>
                
                  <select  name="rel_candidatorecomendable" id="rel_candidatorecomendable_editar-formato_truper" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                    <optgroup>
                      <option value="-1">Seleccionar ...</option>
                      <option value="5">RECOMENDABLE</option>
                      <option value="1">RECOMENDABLE C / RESERVAS				                        </option>
                      <option value="2"> --  NO -- RECOMENDABLE				                        </option>
                      <option value="3"> NO DIERON INFORMACIÓN POR POLÍTICAS				                        </option>
                      <option value="4"> SOLO DATOS DEL SISTEMA				                        </option>

                    </optgroup>
                  </select>   
                </div>

                <div class="col-lg-12">
                  <label class="col-form-label title-busq">Comentarios</label>    
                  <label class="col-form-label title-busq" id="rel_notas_label_editar-formato_truper"></label>

                  <textarea name="rel_notas" id="rel_notas_editar-formato_truper" oninput="handleInput(event)" class="form-control-textarea text_area_a" style="min-height:5rem" maxlength="600"  onkeyup="actualizaInfo(600,'rel_notas_editar-formato_truper', 'rel_notas_label_editar-formato_truper')"></textarea>
                </div>



                {% if cuarentaycincoAgregar==1 %}
                <div class="col-lg-12">
                  <h5 class="text-success ml-4 mt-4">
                    <i class="mdi mdi-check "></i>Escala de desempeño
                  </h5>
                  <br>
                </div>

                <div class="col-lg-4">
                  <label class="col-form-label title-busq">Desempeño                    </label>
                  <select  name="rel_desempenio" id="rel_desempenio_editar-formato_truper" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                    <optgroup>
                      <option value="-1">Seleccionar ...</option>
                      <option value="1">1.-BUENO</option>
                      <option value="2">2.-REGULAR</option>
                      <option value="3">3.-MALO</option>

                    </optgroup>
                  </select>   
                </div>

                <div class="col-lg-4">
                  <label class="col-form-label title-busq">T. en equipo                    </label>
                  <select  name="rel_trabajoenquipo" id="rel_trabajoenquipo_editar-formato_truper" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                    <optgroup>
                      <option value="-1">Seleccionar ...</option>
                      <option value="1">1.-SI</option>
                      <option value="0">2.-NO</option>
                    </optgroup>
                  </select>   
               </div>

              <div class="col-lg-4">
                  <label class="col-form-label title-busq"> T. de decisiones                    </label>
                  <select  name="rel_decisiones" id="rel_decisiones_editar-formato_truper" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                    <optgroup>
                      <option value="-1">Seleccionar ...</option>
                      <option value="1">1.-SI</option>
                      <option value="0">2.-NO</option>
                    </optgroup>
                  </select>   
               </div>
                

               <div class="col-lg-4">
                <label class="col-form-label title-busq">Honradez  en el trabajo</label>
                <select  name="rel_honradez" id="rel_honradez_editar-formato_truper" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                  <optgroup>
                    <option value="-1">Seleccionar ...</option>
                    <option value="1">1.-BUENO</option>
                    <option value="2">2.-REGULAR</option>
                    <option value="3">3.-MALO</option>
                  </optgroup>
                </select>   
              </div>

              <div class="col-lg-4">
                <label class="col-form-label title-busq">Adaptación                  </label>
                <select  name="rel_adaptacion" id="rel_adaptacion_editar-formato_truper" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                  <optgroup>
                    <option value="-1">Seleccionar ...</option>
                    <option value="1">1.-SI</option>
                    <option value="0">2.-NO</option>
                  </optgroup>
                </select>   
              </div>

                <div class="col-lg-4">
                  <label class="col-form-label title-busq">Calidad en el trabajo</label>
                  <select  name="rel_calidad" id="rel_calidarel_editar-formato_truper" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                    <optgroup>
                      <option value="-1">Seleccionar ...</option>
                      <option value="1">1.-BUENO</option>
                      <option value="2">2.-REGULAR</option>
                      <option value="3">3.-MALO</option>
                    </optgroup>
                  </select>      
                </div>

                <div class="col-lg-4">
                  <label class="col-form-label title-busq">Iniciativa en el trabajo</label>
                  <select  name="rel_iniciativa" id="rel_iniciativa_editar-formato_truper" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                    <optgroup>
                      <option value="-1">Seleccionar ...</option>
                      <option value="1">1.-SI</option>
                      <option value="0">2.-NO</option>
                    </optgroup>
                  </select>   
                </div>
                <div class="col-lg-4">
                  <label class="col-form-label title-busq">Puntualidad  en el trabajo</label>
                  <select  name="rel_puntualidad" id="rel_puntualidad_editar-formato_truper" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                    <optgroup>
                      <option value="-1">Seleccionar ...</option>
                      <option value="1">1.-SI</option>
                      <option value="0">2.-NO</option>
                    </optgroup>
                  </select>   
                </div>
                <div class="col-lg-4">
                  <label class="col-form-label title-busq">Responsabilidad en el trabajo</label>
                  <select  name="rel_responsabilidad" id="rel_responsabilidad_editar-formato_truper" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                    <optgroup>
                      <option value="-1">Seleccionar ...</option>
                      <option value="1">1.-SI</option>
                      <option value="0">2.-NO</option>
                    </optgroup>
                  </select>   
                </div>
                <div class="col-lg-4">
                  <label class="col-form-label title-busq">Apego a normas</label>
                  <select  name="rel_apegonormas" id="rel_apegonormas_editar-formato_truper" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                    <optgroup>
                      <option value="-1">Seleccionar ...</option>
                      <option value="1">1.-SI</option>
                    <option value="0">2.-NO</option>
                    </optgroup>
                  </select>   
                </div>

                <div class="col-lg-4">
                  <label class="col-form-label title-busq">Relaciones con superiores</label>
                  <select  name="rel_relacionessuperiores" id="rel_relacionessuperiores_editar-formato_truper" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                    <optgroup>
                      <option value="-1">Seleccionar ...</option>
                      <option value="1">1.-EXCELENTE (ABIERTO)</option>
                      <option value="2">2.-BUENO (ABIERTO)</option>
                      <option value="3">3.-LO NECESARIO</option>
                      <option value="4">4.-PASA DESAPERCIBIDO	</option>
                      <option value="5">5.-MALO	</option>

                    </optgroup>
                  </select>   
                </div>

                <div class="col-lg-4">
                  <label class="col-form-label title-busq">Relaciones con compañeros</label>
                  <select  name="rel_relacionescompanieros" id="rel_relacionescompanieros_editar-formato_truper" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                    <optgroup>
                      <option value="-1">Seleccionar ...</option>
                      <option value="1">1.-EXCELENTE (ABIERTO)</option>
                      <option value="2">2.-BUENO (ABIERTO)</option>
                      <option value="3">3.-LO NECESARIO</option>
                      <option value="4">4.-PASA DESAPERCIBIDO	</option>
                      <option value="5">5.-MALO	</option>
                    </optgroup>
                  </select>   
                </div>

             

             
              

           


                {% endif %}


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
