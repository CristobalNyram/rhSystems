<div class="modal fade" id="agregar-referenciapersonal-alta-estudio-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog detalle modal-dialog-scrollable">
      <div class="modal-content">
       <div class="modal-header">

              <h5><div id="">
                <i class="mdi mdi-plus"></i>Agregar una referencia personal 
              </div></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="frm_crear_referencia_personal_alta_estudio_alta_estudio_formato_completo"  novalidate class="form-vertical mt-1"  method="post">
                <div class="form-group row">

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Nombre</label>
                    <input name="rep_nombre_crear" id="rep_nombre_crear" type="text" class="form-control input-rounded data-not-lt-active" required oninput="handleInput(event)"  placeholder="Nombre completo..." maxlength="55" />

                  </div>

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Tiempo</label>
                    <input name="rep_tiempo_crear" id="rep_tiempo_crear" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Tiempo de conocer al candidato..."  maxlength="10"/>

                  </div>

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Número de calle</label>
                    <input name="rep_callenumero_crear" id="rep_callenumero_crear" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Número de calle..."  maxlength="45"/>

                  </div>

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Colonia</label>
                    <input name="rep_colonia_crear" id="rep_colonia_crear" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Nombre de la colonia..."  maxlength="45"/>

                  </div>

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Código postal</label>
                    <input name="rep_codpostal_crear" id="rep_codpostal_crear" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Código postal..."  maxlength="10"/>

                  </div>
                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Teléfono</label>
                    <input name="rep_telefono_crear" id="rep_telefono_crear" type="text" required class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Teléfono (10 dígitos)..."  maxlength="45"/>

                  </div>


                  <div class="col-lg-12">
                    <label class="col-form-label title-busq">Notas</label>
                    <textarea id="rep_notas_crear" name="rep_notas_crear" onkeyup="actualizaInfo(300,'rep_notas_crear', 'labelrep_notas_crear')"   oninput="handleInput(event)" class="form-control-textarea text_area_a" style="min-height:5rem" maxlength="300" placeholder="Notas.."></textarea>
                    <label id="labelrep_notas_crear" class="col-form-label title-busq"></label>
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
  
      </div>
    </div>
  </div>