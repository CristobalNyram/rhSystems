  <form id="form_estudio_seccionEstadoGeneralDeSalud" class="form-vertical mt-1">
                    

                    <section class="m-3">
                      <div class="form-group row">
                        <div class="col-lg-3">
                          <label for="ess_fechaexamenmedico" class="col-form-label title-busq">Fecha de su último examen médico realizado</label>
                          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="dd-mm-aaaa"  name="ess_fechaexamenmedico" id="ess_fechaexamenmedico"maxlength="45"/>
                        </div>
                        <div class="col-lg-3">
                          <label for="ess_estadosalud" class="col-form-label title-busq">Estado de salud actual</label>
                          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Estado de salud"  name="ess_estadosalud" id="ess_estadosalud" maxlength="45" />
                        </div>
                        <div class="col-lg-3">
                          <label  for="ess_enfermedadcronica" class="col-form-label title-busq">Enfermedades crónicas ó hereditarias que padezca</label>
                          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Nombre de la Enfermedad" name="ess_enfermedadcronica" id="ess_enfermedadcronica" maxlength="85"/>
                        </div>
                        <div class="col-lg-3">
                          <label for="ess_medicamento" class="col-form-label title-busq">Medicamentos que habitúa consumir</label>
                          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Nombre del medicamento..." id="ess_medicamento" name="ess_medicamento" maxlength="85" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-lg-2">
                          <label for="ess_intervencionquirurgica" class="col-form-label title-busq">
                            Intervenciones quirúrgicas
                          </label>
                        </div>
                        <div class="col-lg-10">
                          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Nombre de la cirugía y fecha de la cirugía..."  name="ess_intervencionquirurgica" id="ess_intervencionquirurgica" maxlength="255" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-lg-4">
                          <label for="ess_alergia" class="col-form-label title-busq">Alergia</label>
                          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Alergia..." id="ess_alergia" name="ess_alergia" maxlength="155" />
                        </div>
                        <div class="col-lg-4">
                          <label  for="ess_tiposangre" class="col-form-label title-busq">Tipo sanguíneo</label>
                          <input type="text" oninput="handleInput(event)"  class="form-control input-rounded" placeholder="Tipo y factor sanguíneo..." id="ess_tiposangre" name="ess_tiposangre" maxlength="45" />
                        </div>
                        <div class="col-lg-3">
                          <label for="ess_estatura" class="col-form-label title-busq">Estatura</label>
                          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Estatura en metros..."  name="ess_estatura" id="ess_estatura" maxlength="15" />
                        </div>
                        <div class="col-lg-3">
                          <label for="ess_peso" class="col-form-label title-busq">Peso</label>
                          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Peso en kilogramos..." name="ess_peso" id="ess_peso" maxlength="15" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-lg-3">
                          <label for="ess_avisar" class="col-form-label title-busq">En caso de accidente avisar a:</label>
                          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Nombre de la persona..."  id="ess_avisar" name="ess_avisar" maxlength="155" />
                        </div>
                        <div class="col-lg-3">
                          <label for="ess_telefono" class="col-form-label title-busq">Número de teléfono</label>
                          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="000 000 00 00" name="ess_telefono" id="ess_telefono" maxlength="25" />
                        </div>
                        <div class="col-lg-3">
                          <label  for="ess_direccion" class="col-form-label title-busq">Dirección</label>
                          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="N°, calle, colonia y entidad" id="ess_direccion" name="ess_direccion" maxlength="255" />
                        </div>
                        <div class="col-lg-3">
                          <label for="ess_parentesco" class="col-form-label title-busq">Parentesco</label>
                          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Parentesco..." name="ess_parentesco" id="ess_parentesco" maxlength="85" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-lg-2">
                          <p class="col-form-label title-busq ml-2">Notas</p>
                        </div>
                        <div class="col-lg-10">
                          <textarea id="ess_nota"  placeholder="Notas..." name="ess_nota" oninput="handleInput(event)" class="form-control-textarea text_area_a" style="min-height:5rem" maxlength="400" onkeyup="actualizaInfo(400,'ess_nota', 'label_ess_nota')"></textarea>
                          <label  id="label_ess_nota" for="ess_nota" class="col-form-label title-busq ml-2"></label>

                        </div>
                      </div>
                      {% if cuarenta==1%}
                        <div class="form-group row d-flex flex-row-reverse">
                          <div class="col-lg-4">
                            <label class="col-form-label title-busq">Calificación</label>
                            <select name="ess_calificacion" id="ess_calificacion" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
                              <optgroup>
                                <option value="-1">Seleccionar ...</option>
                                <option value="1">1.-INAPROPIADO</option>
                                <option value="2">2.-PROMEDIO</option>
                                <option value="3">3.-APROPIADO</option>
                              </optgroup>
                            </select>
                        </div>
                        </div>
                      {% endif %}
                    </section>
                    <div class="row col-lg-12">
                      <div class="col-sm-3 col-md-3 text-center mt-5">
                        </div>                          
                        <div class="col-sm-3 col-md-3 text-center mt-5">
                          {% if cuarentayseis==1%}
                            <div class="form-group">
                              <button type="button" class="btn-green btn-rounded btn btn-limpiar" href="" data-toggle="modal" onclick="incidenciaformulario($('#ese_id_ese_actual').text(),4)" data-target="#incidencias-modal" style="background-color: green;">Incidencia<i class="mdi mdi-shield-alert"></i></button>
                            </div>
                          {% endif %}
                        </div>
                      <div class="col-sm-3 col-md-3 text-center mt-5">
                          <div class="form-group">
                            <button type="button" class="btn-dark btn-rounded btn btn-limpiar" class="close" data-dismiss="modal" aria-label="Close">Cancelar</button>
                          </div>
                      </div>
                      <div class="col-sm-3 col-md-3  text-center mt-5 ">
                          <div class="form-group">
                            <button type="submit" class="btn-dark btn-rounded btn btn-buscar">Guardar <i class="mdi mdi-content-save white"></i> </button>
                          </div>
                      </div>
                    </div>
                  </form>