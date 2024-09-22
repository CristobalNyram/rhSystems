<div class="card card-crm busqueda-item" id="busqueda" name="busqueda">
                {{ form('', 'id': 'indexprincipal','name': 'indexprincipal','','class':'form-vertical col-md-12 row') }}
                <!-- <div class="container"> -->
                  <div class="col-lg-3">
                    <label class="col-form-label title-busq">Ejecutivos</label>
                    <select name="usu_id" id="usu_id" class="form-control select2-multiple" data-toggle="select2" data-placeholder="Seleccionar ...">
                        <option value="-1">Todos</option>
                        {% for eje in ejecutivoselect %}
                        <option value="{{eje.usu_id}}" {% if indexeje== eje.usu_id%} selected {% endif %}>{{eje.nombre}} </option>
                        {% endfor %}
                    </select>
                  </div>
              
          
                  <div class="col-lg-3">
                    <label class="col-form-label title-busq">Empresa <i class="mdi mdi-office-building"></i></label>
                    <select name="emp_id" id="emp_id" data-toggle="select2" class="form-control select2-multiple" onchange="fndatosempresa();">
                        <option value="-1">Todos</option>
                        {% for emp in empresaselect %}
                        <option value="{{emp.emp_id}}" {% if indexemp== emp.emp_id%} selected {% endif %}>{{emp.emp_nombre}} - ({{emp.emp_alias}})</option>
                        {% endfor %}
                    </select>
                  </div>
                  <div class="col-lg-3" >
                    <label class="col-form-label title-busq">Quien solicita</label>
                    <select name="cne_id" id="cne_id" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                      <option selected value="-1">Seleccione una empresa</option>
                    </select>
                  </div>

                  <div class="col-lg-3" >
                    <label class="col-form-label title-busq">Centro de costo</label>
                    <select name="cen_id" id="cen_id" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                      <option selected value="-1">Seleccione una empresa</option>
                    </select>
                  </div>
            
          
                  <div class="col-lg-6" >
                    <label class="col-form-label title-busq">Estado</label>
                    <select name="est_id" id="est_id" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." onchange="fnmunicipios();">
                    </select>
                  </div>
                  <div class="col-lg-6" >
                    <label class="col-form-label title-busq">Municipio <i class="mdi mdi-fireplace-off"></i></label>
                    <select name="mun_id" id="mun_id" class="form-control select2-single " data-toggle="select2" data-placeholder="Selecciona el estado...">
                      <option selected value="-1">Seleccione un estado</option>
                    </select>
                  </div>
                 

                  <div class="col-lg-4" >
                    <label class="col-form-label title-busq">ID Expediente</label>
                    <input id="filtro_exc_id" name="filtro_exc_id" type="number" class="form-control input-rounded" placeholder="ID Expediente" oninput="soloNumeroPositivos(event);" />
                  </div>
                  <div class="col-lg-4" >
                    <label class="col-form-label title-busq">ID Vacante</label>
                    <input id="filtro_vac_id" name="filtro_vac_id" type="number" class="form-control input-rounded" placeholder="ID Vacante" oninput="soloNumeroPositivos(event);" />
                  </div>
                
                  <div class="col-lg-4" >
                    <label class="col-form-label title-busq">Puesto candidato</label>
                    <input id="filtro_cav_nombre" name="cav_nombre" type="text" class="form-control input-rounded" maxlength="25" placeholder="Puesto candidato"  oninput="handleInput(event)"  />
                  </div>
                  <div class="col-lg-6 " id="fecha_alta_div" >
             
                        <label class="col-form-label  title-busq">Fecha alta <i class="mdi mdi-upload"></i></label>
                            <div>
                                <div class="input-group" id="">
                                  <label class="col-form-label  title-busq">Desde</label>
                                    <input type="date" id="vac_registro_fechainicial" name="vac_registro_fechainicial" class="form-control bar-left" placeholder="Desde" />
                                    <label class="col-form-label  title-busq">Hasta</label>
                                    <input type="date" id="vac_registro_fechafinal" name="vac_registro_fechafinal" class="form-control bar-right" placeholder="Hasta" />
                                </div>
                          
                            </div>
                  </div>

                  <div class="col-lg-5  d-none" id="fecha_cancelacion_div">
                  
                        <label class="col-form-label  title-busq">Fecha de cancelación <i class="mdi mdi-cancel"></i></label>
                            <div>
                                <div class="input-group" id="">
                                  <label class="col-form-label  title-busq">Desde</label>
                                    <input type="date" id="vac_fechafin_f_inicial" name="vac_fechafin_f_inicial" class="form-control bar-left" placeholder="Desde" />
                                    <label class="col-form-label  title-busq">Hasta</label>
                                    <input type="date" id="vac_fechafin_f_final" name="vac_fechafin_f_final" class="form-control bar-right" placeholder="Hasta" />
                                </div>
                    </div>

                
                  
                  </div>


                  <div class="col-lg-5  d-none" id="fecha_vacfin_div">
                      <label class="col-form-label  title-busq">Fecha fin <i class="mdi mdi-calendar"></i></label>
                      <div class="input-group" id="">
                        <label class="col-form-label  title-busq">Desde</label>
                        <input type="date" id="vac_fechavacfin_f_inicial" name="vac_fechavacfin_f_inicial" class="form-control bar-left" placeholder="Desde" />
                        <label class="col-form-label  title-busq">Hasta</label>
                        <input type="date" id="vac_fechavacfin_f_final" name="vac_fechavacfin_f_final" class="form-control bar-right" placeholder="Hasta" />
                      </div>
                  </div>

                  <div class="col-lg-5  d-none" id="vac_actualizacion_div">
                      <label class="col-form-label  title-busq">Fecha de actualización de vacante <i class="mdi mdi-calendar-multiple-check"></i></label>
                      <div class="input-group" id="">
                        <label class="col-form-label  title-busq">Desde</label>
                        <input type="date" id="vac_actualizacion_f_inicial" name="vac_actualizacion_f_inicial" class="form-control bar-left" placeholder="Desde" />
                        <label class="col-form-label  title-busq">Hasta</label>
                        <input type="date" id="vac_actualizacion_f_final" name="vac_actualizacion_f_final" class="form-control bar-right" placeholder="Hasta" />
                      </div>
                  </div>

                  <div class="col-lg-5  d-none" id="vac_fechareactivoproceso_div">
                      <label class="col-form-label  title-busq">Fecha de reactivación de proceso <i class="mdi mdi-calendar-remove"></i></label>
                      <div class="input-group" id="">
                        <label class="col-form-label title-busq">Desde</label>
                        <input type="date" id="vac_reactivoproceso_f_inicial" name="vac_reactivoproceso_f_inicial" class="form-control bar-left" placeholder="Desde" />
                        <label class="col-form-label  title-busq">Hasta</label>
                        <input type="date" id="vac_reactivoproceso_f_final" name="vac_reactivoproceso_f_final" class="form-control bar-right" placeholder="Hasta" />
                      </div>
                  </div>

                  <div class="col-lg-3 d-none" id="filtro_sexo_div">
                    <label class="col-form-label title-busq">Género <i class="mdi mdi-human-male-female"></i></label>
                    <select name="sex_id" id="sex_id" data-toggle="select2" class="form-control select2-multiple">
                        <option value="-1">Todos</option>
                        {% for sex in sexselect %}
                          <option value="{{sex.sex_id}}" {% if indexemp== sex.sex_id %} selected {% endif %}>{{sex.sex_nombre}}</option>
                        {% endfor %}
                    </select>
                  </div>

                  <div class="col-lg-3 d-none" id="filtro_tpg_div">
                    <label class="col-form-label title-busq">Tipo pago <i class="mdi mdi-coin"></i></label>
                    <select name="tpg_id" id="tpg_id" data-toggle="select2" class="form-control select2-multiple">
                        <option value="-1">Todos</option>
                        {% for tpg in tpgselect %}
                          <option value="{{tpg.tpg_id}}" {% if indexemp== tpg.tpg_id %} selected {% endif %}>{{tpg.tpg_nombre}}</option>
                        {% endfor %}
                    </select>
                  </div>

                  <div class="col-lg-3 d-none" id="filtro_estadocivil_div">
                    <label class="col-form-label title-busq">Estado civil <i class="mdi mdi-account-multiple-outline"></i></label>
                    <select name="esc_id" id="esc_id" data-toggle="select2" class="form-control select2-multiple">
                        <option value="-1">Todos</option>
                        {% for esc in escselect %}
                          <option value="{{esc.esc_id}}" {% if indexemp== esc.esc_id %} selected {% endif %}>{{esc.esc_nombre}}</option>
                        {% endfor %}
                    </select>
                  </div>

                  <div class="col-lg-3 d-none" id="filtro_gra_div">
                    <label class="col-form-label title-busq">Grado escolar <i class="mdi mdi-school"></i></label>
                    <select name="gra_id" id="gra_id" data-toggle="select2" class="form-control select2-multiple">
                        <option value="-1">Todos</option>
                        {% for gra in graselect %}
                          <option value="{{gra.gra_id}}" {% if indexemp== gra.gra_id %} selected {% endif %}>{{gra.gra_nombre}}</option>
                        {% endfor %}
                    </select>
                  </div>

                  <div class="col-lg-3 d-none" id="filtro_tie_div">
                    <label class="col-form-label title-busq">Tipo empleo <i class="mdi mdi-worker"></i></label>
                    <select name="tie_id" id="tie_id" data-toggle="select2" class="form-control select2-multiple">
                        <option value="-1">Todos</option>
                        {% for tie in tieselect %}
                          <option value="{{tie.tie_id}}" {% if indexemp== tie.tie_id %} selected {% endif %}>{{tie.tie_nombre}}</option>
                        {% endfor %}
                    </select>
                  </div>

                  <div class="col-lg-3 d-none" id="filtro_pre_div">
                    <label class="col-form-label title-busq">Prestación <i class="mdi mdi-call-made"></i></label>
                    <select name="pre_id" id="pre_id" data-toggle="select2" class="form-control select2-multiple">
                        <option value="-1">Todos</option>
                        {% for pre in preselect %}
                          <option value="{{pre.pre_id}}" {% if indexemp == pre.pre_id %} selected {% endif %}>{{pre.pre_nombre}}</option>
                        {% endfor %}
                    </select>
                  </div>

                  <div class="col-lg-3 d-none" id="filtro_tip_div">
                    <label class="col-form-label title-busq">Tipo de vacante <i class="mdi mdi-comment-question-outline"></i></label>
                    <select name="tip_id" id="tip_id" data-toggle="select2" class="form-control select2-multiple">
                        <option value="-1">Todos</option>
                        {% for tip in tipselect %}
                          <option value="{{tip.tip_id}}" {% if indexemp == tip.tip_id %} selected {% endif %}>{{tip.tip_nombre}}</option>
                        {% endfor %}
                    </select>
                  </div>

                  <div class="col-lg-5 d-none" id="filtro_usu_idreactivoproceso_div">
                    <label class="col-form-label title-busq">Usuarios que reactivaron proceso <i class="mdi mdi-repeat"></i></label>
                    <select name="usu_idreactivoproceso" id="usu_idreactivoproceso" data-toggle="select2" class="form-control select2-multiple">
                        <option value="-1">Todos</option>
                        {% for usu in ususelect %}
                          <option value="{{usu.usu_id}}" {% if indexemp == usu.usu_id %} selected {% endif %}>{{usu.nombre}}</option>
                        {% endfor %}
                    </select>
                  </div>
                   
                  <div class="col-lg-3 d-none" id="filtro_vac_estatus_div">
                    <label class="col-form-label title-busq">Estatus de vacante <i class="mdi mdi-animation"></i></label>
                    <select name="vac_estatus" id="vac_estatus" data-toggle="select2" class="form-control select2-multiple">
                        <option value="-1">Todos</option>
                       
                        {% for key, value in vacselect_estatus %}
                            <option value="{{ key }}">{{ value }} </option>
                        {% endfor %}
                    </select>
                  </div>

                  <div class="col-lg-3 d-none" id="filtro_can_valido_div">
                    <label class="col-form-label title-busq">Candidato con información valida <i class="mdi mdi-account-card-details"></i></label>
                    <select name="can_valido" id="can_valido" data-toggle="select2" class="form-control select2-multiple">
                        <option value="-1">Todos</option>
                        <option value="1">SÍ</option>
                        <option value="2">NO</option>
                    </select>
                  </div>

                  <div class="col-lg-4 d-none" id="filtro_can_correo_div">
                    <label class="col-form-label title-busq">Correo candidato <i class="mdi mdi-email"></i></label>
                    <input id="can_correo" name="can_correo" type="email" class="form-control input-rounded data-not-lt-active" maxlength="65" placeholder="CORREO ELECTRÓNICO CANDIDATO"  oninput="handleInput(event)"  />
                  </div>

                  <div class="col-lg-3 d-none" id="filtro_ent_seleccionado_div">
                    <label class="col-form-label title-busq">Seleccionado <i class="mdi mdi-account-box-outline"></i></label>
                    <select name="ent_seleccionado" id="ent_seleccionado" data-toggle="select2" class="form-control select2-multiple">
                        <option value="-1">Todos</option>
                        <option value="1">SÍ</option>
                        <option value="2">NO</option>
                    </select>
                  </div>

                  <div class="col-lg-5  d-none" id="filtro_ent_fecharegistro_div">
                      <label class="col-form-label  title-busq">Fecha registro Entrevista <i class="mdi mdi-calendar-range"></i></label>
                      <div class="input-group" id="">
                        <label class="col-form-label title-busq">Desde</label>
                        <input type="date" id="filtro_ent_fecharegistro_f_inicial" name="filtro_ent_fecharegistro_f_inicial" class="form-control bar-left" placeholder="Desde" />
                        <label class="col-form-label  title-busq">Hasta</label>
                        <input type="date" id="filtro_ent_fecharegistro_f_final" name="filtro_ent_fecharegistro_f_final" class="form-control bar-right" placeholder="Hasta" />
                      </div>
                  </div>

                  <div class="col-lg-5  d-none" id="filtro_fat_fecharegistro_div">
                      <label class="col-form-label  title-busq">Fecha registro Facturación <i class="mdi mdi-file-export"></i></label>
                      <div class="input-group" id="">
                        <label class="col-form-label title-busq">Desde</label>
                        <input type="date" id="filtro_fat_fecharegistro_f_inicial" name="filtro_fat_fecharegistro_f_inicial" class="form-control bar-left" placeholder="Desde" />
                        <label class="col-form-label  title-busq">Hasta</label>
                        <input type="date" id="filtro_fat_fecharegistro_f_final" name="filtro_fat_fecharegistro_f_final" class="form-control bar-right" placeholder="Hasta" />
                      </div>
                  </div>
                  
                  <div class="col-lg-5  d-none" id="filtro_cit_registro_div">
                      <label class="col-form-label  title-busq">Fecha registro Cita <i class="mdi mdi-calendar-today"></i></label>
                      <div class="input-group" id="">
                        <label class="col-form-label title-busq">Desde</label>
                        <input type="date" id="filtro_cit_registro_f_inicial" name="filtro_cit_registro_f_inicial" class="form-control bar-left" placeholder="Desde" />
                        <label class="col-form-label  title-busq">Hasta</label>
                        <input type="date" id="filtro_cit_registro_f_final" name="filtro_cit_registro_f_final" class="form-control bar-right" placeholder="Hasta" />
                      </div>
                  </div>

                  <div class="col-lg-5  d-none" id="filtro_cit_fecha_div">
                      <label class="col-form-label title-busq">Fecha Cita <i class="mdi mdi-calendar-text"></i></label>
                      <div class="input-group" id="">
                        <label class="col-form-label title-busq">Desde</label>
                        <input type="date" id="filtro_cit_fecha_f_inicial" name="filtro_cit_fecha_f_inicial" class="form-control bar-left" placeholder="Desde" />
                        <label class="col-form-label  title-busq">Hasta</label>
                        <input type="date" id="filtro_cit_fecha_f_final" name="filtro_cit_fecha_f_final" class="form-control bar-right" placeholder="Hasta" />
                      </div>
                  </div>

                  <div class="col-lg-5  d-none" id="filtro_cit_hora_div">
                      <label class="col-form-label title-busq">Hora Cita <i class="mdi mdi-calendar-clock"></i></label>
                      <div class="input-group" id="">
                        <label class="col-form-label title-busq">Desde</label>
                        <input type="time" id="filtro_cit_hora_f_inicial" name="filtro_cit_hora_f_inicial" class="form-control bar-left" placeholder="Desde" />
                        <label class="col-form-label  title-busq">Hasta</label>
                        <input type="time" id="filtro_cit_hora_f_final" name="filtro_cit_hora_f_final" class="form-control bar-right" placeholder="Hasta" />
                      </div>
                  </div>

                  <div class="col-lg-3 d-none" id="filtro_tic_id_div">
                    <label class="col-form-label title-busq">Tipo cita <i class="mdi mdi-account-search"></i></label>
                    <select name="tic_id" id="tic_id" data-toggle="select2" class="form-control select2-multiple">
                        <option value="-1">Todos</option>
                        {% for tic in ticselect %}
                          <option value="{{tic.tic_id}}" {% if indexemp == tic.tic_id %} selected {% endif %}>{{tic.tic_nombre}}</option>
                        {% endfor %}
                    </select>
                  </div>

                  <div class="col-lg-3 d-none" id="filtro_med_id_div">
                    <label class="col-form-label title-busq">Tipo de medio  de contacto <i class="mdi mdi-share-variant"></i></label>
                    <select name="med_id" id="med_id" data-toggle="select2" class="form-control select2-multiple">
                        <option value="-1">Todos</option>
                        {% for med in medselect %}
                          <option value="{{med.med_id}}" {% if indexemp == med.med_id %} selected {% endif %}>{{med.med_nombre}}</option>
                        {% endfor %}
                    </select>
                  </div>


                  {# seccion laboral inicio #}

                  <div class="col-lg-5  d-none" id="filtro_sel_registro_div">
                      <label class="col-form-label title-busq">Fecha registro Referencias <i class="mdi mdi-calendar-check"></i></label>
                      <div class="input-group" id="">
                        <label class="col-form-label title-busq">Desde</label>
                        <input type="date" id="filtro_sel_registro_f_inicial" name="filtro_sel_registro_f_inicial" class="form-control bar-left" placeholder="Desde" />
                        <label class="col-form-label title-busq">Hasta</label>
                        <input type="date" id="filtro_sel_registro_f_final" name="filtro_sel_registro_f_final" class="form-control bar-right" placeholder="Hasta" />
                      </div>
                  </div>

                  <div class="col-lg-5  d-none" id="filtro_sel_calificacion_div">
                      <label class="col-form-label title-busq"> Calificación sección laboral <i class="mdi mdi-dice-d10"></i></label>
                      <select name="sel_calificacion" id="sel_calificacion" data-toggle="select2" class="form-control select2-multiple">
                        <option value="-1">Todos</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>

                      </select>
                  </div>



                  <div class="col-lg-5  d-none" id="filtro_sel_necesitoauxiliar_div">
                      <label class="col-form-label title-busq">Necesita auxiliar <i class="mdi mdi-library"></i></label>
                      <select name="sel_necesitoauxiliar" id="filtro_sel_necesitoauxiliar" data-toggle="select2" class="form-control select2-multiple">
                        <option value="-1">Todos</option>
                        <option value="1">SÍ</option>
                        <option value="0">NO</option>
                      </select>
                  </div>
                  
                  <div class="col-lg-5  d-none" id="filtro_sel_empleosocultos_div">
                      <label class="col-form-label title-busq">Empleos ocultos <i class="mdi mdi-file-find"></i></label>
                      <select name="sel_empleosocultos" id="filtro_sel_empleosocultos" data-toggle="select2" class="form-control select2-multiple">
                        <option value="-1">Todos</option>
                        <option value="1">SÍ</option>
                        <option value="0">NO</option>
                      </select>
                  </div>

                  {# seccion laboral fin #}


                  {# psicometria inicio #}
                    <div class="col-lg-5  d-none" id="filtro_psi_calificacion_div">
                      <label class="col-form-label title-busq">Psicometría Calificación <i class="mdi mdi-library"></i></label>
                      <select name="psi_calificacion" id="psi_calificacion" data-toggle="select2" class="form-control select2-multiple">
                        <option value="-1">Todos</option>
                        <option value="N/A">N/A</option>
                          {% for i in 1..5 %}
                              <option value="{{ i }}">{{ i }}</option>
                          {% endfor %}
                      </select>
                    </div>

                    <div class="col-lg-5  d-none" id="filtro_psi_registro_div">
                      <label class="col-form-label title-busq">Registro de psicometría <i class="mdi mdi-calendar-text"></i></label>
                      <div class="input-group" id="">
                        <label class="col-form-label title-busq">Desde</label>
                        <input type="date" id="filtro_psi_fecharegistro_f_inicial" name="filtro_psi_fecharegistro_f_inicial" class="form-control bar-left" placeholder="Desde" />
                        <label class="col-form-label  title-busq">Hasta</label>
                        <input type="date" id="filtro_psi_fecharegistro_f_final" name="filtro_psi_fecharegistro_f_final" class="form-control bar-right" placeholder="Hasta" />
                      </div>
                  </div>
                  {# psicometria fin #}


                  
                {# garantia inicio #}
                    <div class="col-lg-5  d-none" id="filtro_usu_idgarantia_div">
                      <label class="col-form-label title-busq">Usuarios que mandaron a garantía<i class="mdi mdi-people"></i></label>
                      <select name="usu_idgarantia" id="usu_idgarantia" data-toggle="select2" class="form-control select2-multiple">
                        <option value="-1">Todos</option>
                         {% for usu in ususelect %}
                          <option value="{{usu.usu_id}}" {% if indexemp == usu.usu_id %} selected {% endif %}>{{usu.nombre}}</option>
                        {% endfor %}
                         
                      </select>
                    </div>

                    <div class="col-lg-5  d-none" id="filtro_exc_fechagarantia_div">
                      <label class="col-form-label title-busq">Registro de garantía <i class="mdi mdi-calendar-text"></i></label>
                      <div class="input-group" id="">
                        <label class="col-form-label title-busq">Desde</label>
                        <input type="date" id="filtro_exc_fechagarantia_f_inicial" name="filtro_exc_fechagarantia_f_inicial" class="form-control bar-left" placeholder="Desde" />
                        <label class="col-form-label  title-busq">Hasta</label>
                        <input type="date" id="filtro_exc_fechagarantia_f_final" name="filtro_exc_fechagarantia_f_final" class="form-control bar-right" placeholder="Hasta" />
                      </div>
                  </div>
                  {# garantia fin #}
                  

 
                  <div class="col-lg-8 mt-4">
                    
                  </div>
                  <div class="col-lg-3 col-9  text-right mt-4">
                    <div class="form-group">
                        <button type="submit" id="buscar" name="buscar" onclick="principal(); window.location.href = '#listadoprincipal'; return false;" class="btn-dark btn-rounded btn btn-buscar"><i class=" mdi mdi-magnify white"></i>  Buscar</button>
                    </div>
                  </div>
                  <div class="col-lg-1 col-3  text-right mt-4">
                      <div class="form-group">
                        {{ link_to('consulta/index_vac', '<i class="mdi mdi-eraser white" title="Limpiar búsqueda"></i>',"class": "btn-dark btn-rounded btn btn-limpiar") }}
                  </div>

              </form>

</div>