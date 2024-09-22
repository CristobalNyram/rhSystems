{% include "/consulta/complementos/permisos.volt" %}
{% include "/transporte/archivo-js.volt" %}
{% include "/transporte/archivo-modales-js.volt" %}
{% include "/archivo/modal-js.volt" %}
{% include "/consulta/script-index-js.volt" %}



<div class="row">
  <div class="col-6" id="">
          <h4 class="header-title header-title-crm" style="color:#16345E ;">Consulta <i class="mdi mdi-shield-search" style="color:#16345E ;"></i> </h4>
  </div>
  <div class="col-6">
    <div class="text-right">
      <!-- <a href="#"><img src="dist/assets/images/small/boton.svg" class="boton-plus" height="60"></a> -->
    </div>
  </div>
</div>
<div class="mt-3">




    <div class="container-d-flex-and-block" >
              <div name="busqueda-filtros" id="busqueda-filtros"  class="card card-crm container-options-menu col-12 col-lg-3 col-sm-3 mr-2">
                <label class="title-busq d-flex justify-content-center mt-2 uppercase">Filtros</label>
                  <div  id="container-menu-options" class="container-menu-options" aria-labelledby="dropdownMenu2">
                    <button class="dropdown-item active" type="button" id="filtro_fecha_alta">Fecha alta</button>
                   

                    <button class="dropdown-item " type="button" id="filtro_entrega_cliente">Fecha de entrega cliente</button>
                    <button class="dropdown-item " type="button" id="filtro_entrega_investigador">Fecha de entrega investigador</button>
                    <button class="dropdown-item " type="button" id="filtro_entrega_analista">Fecha de entrega analista</button>
                    <button class="dropdown-item " type="button" id="filtro_transporte_asig">Transporte asignado</button>
                    <button class="dropdown-item" type="button" id="filtro_asig_analista">Fecha de asignación analista</button>
                    <button class="dropdown-item" type="button" id="filtro_asig_inv">Fecha de asignación investigador</button>
                    <button class="dropdown-item" type="button" id="filtro_fol_verificacion">Folio de verificación o núm. control</button>
                    <button class="dropdown-item" type="button" id="filtro_fecha_cancelación">Fecha cancelación</button>
                    <button class="dropdown-item" type="button" id="filtro_tipo_estudio">Tipo  de estudio</button>
                    {% if ochentaynueve ==1 %}
                    <button class="dropdown-item" type="button" id="filtro_ese_calificacion">ESE Calificación</button>
                    {% endif %}
                    {% if noventaycuatro ==1 %}
                    <button class="dropdown-item" type="button" id="filtro_ese_empresarecluta">Empresa recluta</button>
                    {% endif %}


                </div>
              </div>

              <div class="card card-crm" id="busqueda" name="busqueda">
                {% if acceso.verificar(18,rol_id)==1 %}
                {{ form('', 'id': 'indexprincipal','name': 'indexprincipal','','class':'form-vertical col-md-12 row') }}
                <!-- <div class="container"> -->
                  <div class="col-lg-3">
                    <label class="col-form-label title-busq">Analista</label>
                    <select name="ana_id" id="ana_id" class="form-control select2-multiple" data-toggle="select2" data-placeholder="Seleccionar ...">
                        <option value="-1">Todos</option>
                        {% for ana in analistaselect %}
                        <option value="{{ana.usu_id}}" {% if indexana== ana.usu_id%} selected {% endif %}>{{ana.nombre}} </option>
                        {% endfor %}
                    </select>
                  </div>
              
          
                  <div class="col-lg-3">
                    <label class="col-form-label title-busq">Investigador</label>
                    <select name="inv_id" id="inv_id" data-toggle="select2" class="form-control select2-multiple">
                        <option value="-1">TODOS</option>
                        <option value="172">AUTOESTUDIO</option>

                        {% for inv in investigadorselect %}
                        <option value="{{inv.usu_id}}" {% if indexinv== inv.usu_id%} selected {% endif %}>{{inv.nombre}} </option>
                        {% endfor %}
                    </select>
                  </div>
                  <div class="col-lg-3">
                    <label class="col-form-label title-busq">Estatus <i class="mdi mdi-checkbox-multiple-marked-circle"></i></label>
                    <select name="ese_estatus" id="ese_estatus" data-toggle="select2" class="form-control select2-multiple">
                        <option value="-1">Todos</option>
                        <option value="7" >Aprobados</option>
                        <option value="-2">Cancelados</option>
                        <option value="1">Inicial</option>
                        <option value="2">En campo</option>
                        <option value="3">En campo (reasginados)</option>
                        <option value="4">En revisión </option>
                        <option value="5">En revisión A</option>
                        <option value="7">Validados</option>
                        <option value="8">No aprobados</option>
          
          
          
                    </select>
                  </div>
                  <div class="col-lg-3">
                    <label class="col-form-label title-busq">Empresa <i class="mdi mdi-office-building"></i></label>
                    <select name="emp_id" id="emp_id" data-toggle="select2" class="form-control select2-multiple" onchange="fndatosempresa();">
                        <option value="-1">Todos</option>
                        {% for emp in empresaselect %}
                        <option value="{{emp.emp_id}}" {% if indexemp== emp.emp_id%} selected {% endif %}>{{emp.emp_nombre}}</option>
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
            
          
                  <div class="col-lg-3" >
                    <label class="col-form-label title-busq">Estado</label>
                    <select name="est_id" id="est_id" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." onchange="fnmunicipios();">

                    </select>
                  </div>
                  <div class="col-lg-3" >
                    <label class="col-form-label title-busq">Municipio <i class="mdi mdi-fireplace-off"></i></label>
                    <select name="mun_id" id="mun_id" class="form-control select2-single " data-toggle="select2" data-placeholder="Selecciona el estado...">
                      <option selected value="-1">Seleccione un estado</option>
                    </select>
                  </div>
                  <div class="col-lg-4" >
                    <label class="col-form-label title-busq">Nombre candidato</label>
                    <input id="ese_nombre" name="ese_nombre" type="text" class="form-control input-rounded data-not-lt-active" maxlength="25" placeholder="NOMBRE CANDIDATO"  oninput="handleInput(event)"  />
                  </div>
                  <div class="col-lg-4" >
                    <label class="col-form-label title-busq">Primer apellido candidato</label>
                    <input id="ese_primerapellido" name="ese_primerapellido" type="text" class="form-control input-rounded data-not-lt-active" maxlength="19" placeholder="PRIMER APELLIDO CANDIDATO"  oninput="handleInput(event)"  />
                  </div>
                  <div class="col-lg-4" >
                    <label class="col-form-label title-busq">Segundo apellido candidato</label>
                    <input id="ese_segundoapellido" name="ese_segundoapellido" type="text" class="form-control input-rounded data-not-lt-active" maxlength="25" placeholder="SEGUNDO APELLIDO CANDIDATO"  oninput="handleInput(event)"  />
                  </div>

                  <div class="col-lg-4" >
                    <label class="col-form-label title-busq">ID ESE</label>
                    <input id="ese_id" name="ese_id" type="number" class="form-control input-rounded" placeholder="ESE ID" oninput="soloNumeroPositivos(event);" />
                  </div>
                  <div class="col-lg-4" >
                    <label class="col-form-label title-busq">CURP CANDIDATO</label>
                    <input id="ese_curp" name="ese_curp" type="text" class="form-control input-rounded data-not-lt-active" maxlength="19" placeholder="CURP CANDIDATO"  oninput="handleInput(event)"  />
                  </div>
                  <div class="col-lg-4" >
                    <label class="col-form-label title-busq">PUESTO CANDIDATO</label>
                    <input id="ese_puesto" name="ese_puesto" type="text" class="form-control input-rounded" maxlength="25" placeholder="PUESTO CANDIDATO"  oninput="handleInput(event)"  />
                  </div>
                  <div class="col-lg-6 " id="fecha_alta_div" >
             
                        <label class="col-form-label  title-busq">Fecha alta <i class="mdi mdi-upload"></i></label>
                            <div>
                                <div class="input-group" id="">
                                  <label class="col-form-label  title-busq">Desde</label>
                                    <input type="date" id="ese_registro_fechainicial" name="ese_registro_fechainicial" class="form-control bar-left" placeholder="Desde" />
                                    <label class="col-form-label  title-busq">Hasta</label>
                                    <input type="date" id="ese_registro_fechafinal" name="ese_registro_fechafinal" class="form-control bar-right" placeholder="Hasta" />
                                </div>
                          
                            </div>
                  </div>
                  
            
        
                  <div class="col-lg-6 d-none" id="fecha_entrega_cliente_div" >
                   
                        <label class="col-form-label  title-busq">Fecha entrega cliente <i class="mdi mdi-account-multiple-minus-outline"></i></label>
                            <div>
                                <div class="input-group" id="">
                                  <label class="col-form-label  title-busq">Desde</label>
                                    <input type="date" id="ese_fechaentregacliente_f_inicial" name="ese_fechaentregacliente_f_inicial" class="form-control bar-left" placeholder="Desde" />
                                    <label class="col-form-label  title-busq">Hasta</label>
                                    <input type="date" id="ese_fechaentregacliente_f_final" name="ese_fechaentregacliente_f_final" class="form-control bar-right" placeholder="Hasta" />
                                </div>
                           
                    </div>
                  </div>

                  <div class="col-lg-6 d-none" id="fecha_asig_ana_div" >
                   
                        <label class="col-form-label  title-busq">Fecha analista<i class="mdi mdi-account-multiple-minus-outline"></i></label>
                            <div>
                                <div class="input-group" id="">
                                  <label class="col-form-label  title-busq">Desde</label>
                                    <input type="date" id="ese_fechaasiganalista_f_inical" name="ese_fechaasiganalista_f_inical" class="form-control bar-left" placeholder="Desde" />
                                    <label class="col-form-label  title-busq">Hasta</label>
                                    <input type="date" id="ese_fechaasiganalista_f_final" name="ese_fechaasiganalista_f_final" class="form-control bar-right" placeholder="Hasta" />
                                </div>
                          
                    </div>
                  </div>
                  <div class="col-lg-6 d-none" id="fecha_entrega_inv_div" >
         
                        <label class="col-form-label  title-busq">Fecha entrega investigador</label>
                            <div>
                                <div class="input-group" id="">
                                  <label class="col-form-label  title-busq">Desde</label>
                                    <input type="date" id="ese_fechaentregainvestigador_f_inicial" name="ese_fechaentregainvestigador_f_inicial" class="form-control bar-left" placeholder="Desde" />
                                    <label class="col-form-label  title-busq">Hasta</label>
                                    <input type="date" id="ese_fechaentregainvestigador_f_final" name="ese_fechaentregainvestigador_f_final" class="form-control bar-right" placeholder="Hasta" />
                                </div>
              
                    </div>
                  </div>
                  <div class="col-lg-6 d-none" id="fecha_entrega_ana_div" >
                   
                        <label class="col-form-label  title-busq">Fecha entrega analista</label>
                            <div>
                                <div class="input-group" id="">
                                  <label class="col-form-label  title-busq">Desde</label>
                                    <input type="date" id="ese_fechaentregaanalista_f_inicial" name="ese_fechaentregaanalista_f_inicial" class="form-control bar-left" placeholder="Desde" />
                                    <label class="col-form-label  title-busq">Hasta</label>
                                    <input type="date" id="ese_fechaentregaanalista_f_final" name="ese_fechaentregaanalista_f_final" class="form-control bar-right" placeholder="Hasta" />
                                </div>
                           
                    </div>
                  </div>

                  <div class="col-lg-6 d-none" id="fecha_asig_inv_div" >
                  
                        <label class="col-form-label  title-busq">Fecha de asignación investigador</label>
                            <div>
                                <div class="input-group" id="">
                                  <label class="col-form-label  title-busq">Desde</label>
                                    <input type="date" id="ese_fechaasiginvestigador_f_inical" name="ese_fechaasiginvestigador_f_inical" class="form-control bar-left" placeholder="Desde" />
                                    <label class="col-form-label  title-busq">Hasta</label>
                                    <input type="date" id="ese_fechaasiginvestigador_f_final" name="ese_fechaasiginvestigador_f_final" class="form-control bar-right" placeholder="Hasta" />
                                </div>
                        
                    </div>
                  </div>

                  <div class="col-lg-5  d-none" id="trasnporte_asig_div">
                    <label class="col-form-label title-busq">Transporte asignado <i class="mdi mdi-car"></i></label>
                    <select name="ese_transporte" id="ese_transporte" data-toggle="select2" class="form-control select2-multiple">
                        <option value="-1">Todos</option>
                        <option value="2">SI</option>
                        <option value="1">NO</option>
          
                    </select>
                  </div>
                  <div class="col-lg-5  d-none" id="fol_verificacion_div">
                    <label class="col-form-label title-busq">Folio de verificación o núm. control</label>
                    <input id="ese_folioverificacion" name="ese_folioverificacion" type="text" class="form-control input-rounded" placeholder="Folio de verificación o núm. control" oninput="handleInput(event)" />
                  </div>

                  <div class="col-lg-5  d-none" id="fecha_cancelacion_div">
                  
                        <label class="col-form-label  title-busq">Fecha de cancelación <i class="mdi mdi-cancel"></i></label>
                            <div>
                                <div class="input-group" id="">
                                  <label class="col-form-label  title-busq">Desde</label>
                                    <input type="date" id="ese_fechacancelacion_f_inicial" name="ese_fechacancelacion_f_inicial" class="form-control bar-left" placeholder="Desde" />
                                    <label class="col-form-label  title-busq">Hasta</label>
                                    <input type="date" id="ese_fechacancelacion_f_final" name="ese_fechacancelacion_f_final" class="form-control bar-right" placeholder="Hasta" />
                                </div>
                          
                    </div>

                
                  
                  </div>
                  <div class="col-lg-5 d-none" id="tipo_estudio_div">
                    <label class="col-form-label title-busq">Tipo de estudio <i class="mdi mdi-checkbox-intermediate"></i></label>
                    <select name="tip_id" id="tip_id" data-toggle="select2" class="form-control select2-multiple">
                        <option value="-1">Todos</option>
                        {% for tipoEstudio in tipoEstudios %}
                        <option value="{{tipoEstudio.tip_id}}" >{{tipoEstudio.tip_nombre}}</option>
                        {% endfor %}
          
                    </select>
                  </div>
                  <div class="col-lg-6 d-none" id="ese_empresarecluta_div" >
                   
                    <label class="col-form-label  title-busq">Empresa recluta  <i class="mdi mdi-star"></i></label>
                        <div>
                            <div class="input-group" id="">
                              <select name="ese_empresarecluta" id="ese_empresarecluta" data-toggle="select2" class="form-control select2-multiple" >
                                <option value="-1">Seleccionar </option>
                                <option value="2">SI</option>
                           


                                </select>
                            </div>
                       
                    
                         </div>
                  </div>
                  <div class="col-lg-6 d-none" id="ese_calificacion_div" >
                   
                    <label class="col-form-label  title-busq">Calificación  ESE  <i class="mdi mdi-star"></i></label>
                        <div>
                            <div class="input-group" id="">
                              <select name="ese_calificacion" id="ese_calificacion" data-toggle="select2" class="form-control select2-multiple" >
                                <option value="-1">Seleccionar </option>
                                <option value="2">SI</option>
                           


                                </select>
                            </div>
                       
                    
                         </div>
                  </div>

 
                  <div class="col-lg-8 mt-4">
                    
                  </div>
                  <div class="col-lg-3 col-9  text-right mt-4">
                    <div class="form-group">
                        <button type="submit" id="buscar" name="buscar" onclick="principal(); window.location.href = '#listadoprincipal'; return false;" class="btn-dark btn-rounded btn btn-buscar"><i class=" mdi mdi-magnify white"></i>  Buscar</button>
                    </div>
                  </div>
                  <div class="col-lg-1 col-3  text-right mt-4">
                      <div class="form-group">
                        {{ link_to('consulta/index', '<i class="mdi mdi-eraser white" title="Limpiar búsqueda"></i>',"class": "btn-dark btn-rounded btn btn-limpiar") }}
                        <!-- <button class="btn-dark btn-rounded btn btn-limpiar"><i class="mdi mdi-eraser white"></i></button> -->
                      </div>
          </div>
          
        <!-- </div> -->
        <!-- <div id="listado">
        </div> -->
        </form>
        {% endif %}
      </div>
    </div>


    <div id="listadoprincipal" >
        <!-- <h5>Realice una búsqueda</h5> -->
    </div>
    
        <!-- end content -->

    <!-- END content-page -->

</div>
        <!-- END wrapper -->
        {% include "/estudio/regresar_estatus-modal-js.volt" %}



    
{% include "/comentarioese/modales-js.volt" %}
{% include "/consulta/resumen-visualizar-modal-js.volt" %}
{% include "/consulta/acciones/consultar-calf-ese-modal-js.volt" %}-