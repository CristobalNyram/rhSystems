<div class="modal fade" id="agregar-referencialaboral-alta-estudio-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-semi-grande  modal-dialog-scrollable">
      <div class="modal-content">
        <!-- <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
   -->        <div class="modal-header">
              <h5><div id="">
                <i class="mdi mdi-plus"></i>Agregar una referencia laboral al estudio 
              </div></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <!-- //contenido -->
              <form id="frm_ref_lab_alta_ese_comp" class="form-vertical mt-1"  method="post">
                <div class="form-group row">
           


                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Nombre de la empresa</label>
                    <input name="rel_candidatoempresa_crear" required id="rel_candidatoempresa_crear_formato_completo" type="text" class="form-control input-rounded data-not-lt-active"   oninput="handleInput(event)"  placeholder="Nombre..." maxlength="65" />
                  </div>

                  
                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Domicilio</label>
                    <input name="rel_candidatodomicilio_crear" id="rel_candidatodomicilio_crear_formato_completo" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Domicilio..."  maxlength="75"/>
                  </div>
                  


                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Nombre de Jefe directo inmediato</label>
                    <input name="rel_candidatojefe_crear" id="rel_candidatojefe_crear_formato_completo" type="text" class="form-control input-rounded data-not-lt-active" oninput="handleInput(event)"   placeholder="Nombre de jefe inmediato..."  maxlength="45"/>
                  </div>



                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Teléfono</label>
                    <input name="rel_candidatotelefono_crear" id="rel_candidatotelefono_crear_formato_completo" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Teléfono..."  maxlength="45"/>
                  </div>


                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Puesto inicial</label>
                    <input name="rel_candidatopuestoinicial_crear" id="rel_candidatopuestoinicial_crear_formato_completo" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Puesto inicial..."  maxlength="45"/>
                  </div>

              

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Puesto final</label>
                    <input name="rel_candidatopuestofinal_crear" id="rel_candidatopuestofinal_crear_formato_completo" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Puesto final..."  maxlength="45"/>
                  </div>
                 


                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Fecha de ingreso</label>
                    <input name="rel_candidatoingreso_crear" id="rel_candidatoingreso_crear_formato_completo" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Fecha de ingreso..."  maxlength="45"/>
                  </div>



                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Fecha de salida</label>
                    <input name="rel_candidatosalida_crear" id="rel_candidatosalida_crear_formato_completo" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Fecha de salida..."  maxlength="45"/>
                  </div>



                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Sueldo inicial</label>
                    <input name="rel_candidatosueldoinicial_crear" id="rel_candidatosueldoinicial_crear_formato_completo" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Sueldo inicial..."  maxlength="45"/>
                  </div>



                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Sueldo final</label>
                    <input name="rel_candidatosueldofinal_crear" id="rel_candidatosueldofinal_crear_formato_completo" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Sueldo final..."  maxlength="45"/>
                  </div>



                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Motivo de separación</label>
                    <input name="rel_candidatoseparacion_crear" id="rel_candidatoseparacion_crear_formato_completo" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Motivo de separación..."  maxlength="75"/>
                  </div>

               

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Incapacidad o accidentes</label>
                    <input name="rel_candidatoincapacidad_crear_formato_completo" id="rel_candidatoincapacidad_crear_formato_completo" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Incapacidad o accidentes..."  maxlength="45"/>
                  </div>
                  
              

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">¿Hubo alguna demanda o plática conciliatoria en la separación del empleado?
                    </label>
                    <input name="rel_candidatodemanda_crear_formato_completo" id="rel_candidatodemanda_crear_formato_completo" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Demandas..."  maxlength="45"/>
                  </div>

            

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Recomendable</label>
                    <input name="rel_candidatorecomendable_crear_formato_completo" id="rel_candidatorecomendable_crear_formato_completo" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Recomendable..."  maxlength="45"/>
                  </div>

              

                  <div class="col-lg-12">
                    <label class="col-form-label title-busq">Notas</label>
                    <textarea id="rel_notas_crear_formato_completo"  name="rel_notas_crear_formato_completo" oninput="handleInput(event)"  onkeyup="actualizaInfo(300,'rel_notas_crear_formato_completo', 'labelrel_notas_crear_formato_completo')"  class="form-control-textarea text_area_a" style="min-height:5rem"  placeholder="Notas..." maxlength="300"></textarea>
                    <label id="labelrel_notas_crear_formato_completo" class="col-form-label title-busq"></label>
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
                          <button type="submit" class="btn-dark btn-rounded btn btn-buscar">Guardar <i class="mdi mdi-content-save white"></i></button>
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