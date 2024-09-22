{% set cuarentaycuatro = acceso.verificar(44,rol_id) %}
{% set cuarentayseis = acceso.verificar(46,rol_id) %}
{% set cuarenta = acceso.verificar(40,rol_id) %}

<!----------------------------------------------------------------------------------- VER TODO EL ESE INICIO-->


<!-- Estudio completo incio-------------------------------------------------------------------------------incio -->
<div class="modal fade" id="ese-formato-gabinte-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-grande modal-dialog-scrollable" >
      <div class="modal-content">
        <div class="modal-header " style="padding-bottom:0px ; padding-top:5px ; ">
          
          <h5 class="text-center" id="" >Estudio No. <span id="ese_id_ese_actual"></span> </h5>
          <div class="ml-5 pl-2">
                <ul class="nav nav-tab" id="myTabMD" role="tablist">
                  <li class="nav-item waves-effect waves-light ">
                    <a class="nav-link active nav-link-moda class-for-header" id="home-tab-md-1" data-toggle="tab" href="#SeccionDatosPersonales-md" role="tab" aria-controls="home-md" aria-selected="false" onclick="cargarDatosSeccion_A_ESES($('#ese_id_ese_actual').text())">Datos personales</a>
                  </li>
                  <li class="nav-item waves-effect waves-light ">
                    <a class="nav-link class-for-header" id="profile-tab-md-2" data-toggle="tab" href="#SeccionDatosEscolares-md" role="tab" aria-controls="profile-md" aria-selected="false" onclick="cargarDatosSeccion_B_ESES($('#ese_id_ese_actual').text())">Datos escolares</a>
                  </li>
                  <li class="nav-item waves-effect waves-light">
                    <a class="nav-link class-for-header" id="contact-tab-md-3" data-toggle="tab" href="#SeccionAntecedentesSociales-md" role="tab" aria-controls="contact-md" aria-selected="false" onclick="cargarDatosSeccion_C_ESES($('#ese_id_ese_actual').text())">Antecedentes sociales</a>
                  </li>
                  
                  <li class="nav-item waves-effect waves-light">
                    <a class="nav-link class-for-header" id="contact-tab-md-4" data-toggle="tab" href="#SeccionEstadoGeneralSal-md" role="tab" aria-controls="contact-md" aria-selected="false" onclick="cargarDatosSeccion_D($('#ese_id_ese_actual').text())">Estado general de salud</a>
                  </li>
                  <li class="nav-item waves-effect waves-light">
                    <a class="nav-link class-for-header" id="contact-tab-md-5" data-toggle="tab" href="#SeccionDatosgrupoFamiliar-md" role="tab" aria-controls="contact-md" aria-selected="false" onclick="cargarDatosSeccion_E_ESES($('#ese_id_ese_actual').text())">Datos de grupo familiar</a>
                  </li>
  
                  <li class="nav-item waves-effect waves-light">
                    <a class="nav-link class-for-header" id="contact-tab-md-6" data-toggle="tab" href="#SecciondAntecedentesLaborales-md" role="tab" aria-controls="contact-md" aria-selected="false" onclick="cargarDatosSeccion_F_ESES($('#ese_id_ese_actual').text())">Antecedentes laborales de grupo familiar</a>
                  </li>
                  <li class="nav-item waves-effect waves-light ">
                    <a class="nav-link class-for-header" id="contact-tab-md-7" data-toggle="tab" href="#SeccionSituacionEconomica-md" role="tab" aria-controls="contact-md" aria-selected="false" onclick="cargarDatosSeccion_G_ESES($('#ese_id_ese_actual').text())"  >Situación económica</a>
                  </li>
                  <li class="nav-item waves-effect waves-light ">
                    <a class="nav-link class-for-header" id="contact-tab-md-8" data-toggle="tab" href="#SeccionBienesInmuebles-md" role="tab" aria-controls="contact-md" aria-selected="false" onclick="cargarDatosSeccion_H_ESES($('#ese_id_ese_actual').text())">Bienes inmuebles</a>
                  </li>
                  <li class="nav-item waves-effect waves-light">
                    <a class="nav-link class-for-header" id="contact-tab-md-9" data-toggle="tab" href="#SeccionReferenciasPersonales-md" role="tab" aria-controls="contact-md" aria-selected="false" onclick="cargarDatosSeccion_I_ESES($('#ese_id_ese_actual').text())" >Referencias personales</a>
                  </li>
                  <li class="nav-item waves-effect waves-light">
                    <a class="nav-link class-for-header" id="contact-tab-md-10" data-toggle="tab" href="#SeccionReferenciasLaborales-md" role="tab" aria-controls="contact-md" aria-selected="false" onclick="cargarDatosSeccion_J_ESES($('#ese_id_ese_actual').text())" >Referencias laborales</a>
                  </li>
                  {% if cuarentaycuatro==1 %}
                    <li class="nav-item waves-effect waves-light">
                      <a class="nav-link class-for-header" id="contact-tab-md-8" data-toggle="tab" href="#SeccionDatosFinales-md" role="tab" aria-controls="contact-md" aria-selected="false" onclick="cargarDatosSeccion_Finales_ESES($('#ese_id_ese_actual').text())">Datos finales</a>
                    </li>
                  {% endif %}
                </ul>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
  
        </div>
        
        <div class="modal-body" style="padding-top:5px;">
  
            <section class="mr-3 ml-3 ">
        
              <center>
                <h5 style="margin-top: 0; margin-bottom:0"><span id="ese_nombrecompleto_actual"></span></h5>
              </center>
              <div class="tab-content card " style="padding-top: 0;" id="myTabContentMD">
  
            <!-- FOMULARIO DE DATOS PERSONALES INCIO------------------------------------------------------------------------------------INCIO -->
                
                <div class="tab-pane fade show active borde-inferior-del-sistema content-for-js " id="SeccionDatosPersonales-md" role="tabpanel" aria-labelledby="home-tab-md">
                   <div class="form-group  row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">

                                
                    <div class="container ">
                      
                      <center>
                        <p class=" text-white text-center font-weight-bold h6 sin-margen">
                          A | DATOS PERSONALES   <i class="mdi mdi-face-recognition white "></i>
                        </p>
                      </center>
                          
  
                    </div>
  
                    
                
                   </div>
                  
                  <form id="form_estudio_seccionDatosPersonales" class="form-vertical   mb-3 mr-1 ml-2" method="post">
                      
                    
                    <section class="m-3 "> 
  
                          <div class="form-group row">
                            <input type="hidden" value="" id="cop_ese_id" name="cop_ese_id">
                           
                            <div class="col-lg-3">
                              <label class="col-form-label title-busq" for="">Puesto</label>
                              <input type="text" class="form-control input-rounded" placeholder="Puesto..." id="ese[ese_puesto]" name="ese[ese_puesto]" maxlength="150"  oninput="handleInput(event)"  />
                            </div>
                            <div class="col-lg-2">
                              <label class="col-form-label title-busq" for="cop_nacimientofecha">Fecha de nacimiento</label>
                              <input type="date" class="form-control input-rounded" placeholder="00-00-00"  name="ese[ese_fechanacimiento]" id="ese[ese_fechanacimiento]" maxlength="" oninput="establecerFechaCalculada(event.target,'ese[ese_edad]') "/>
  
                            </div>
                            <div class="col-lg-2">
                              <label class="col-form-label title-busq" for="estudio_edad">Edad</label>
                              <input type="number" class="form-control input-rounded"  placeholder="Edad..."    readonly name="ese[ese_edad]" id="ese[ese_edad]" maxlength="20"/>
                            </div>
                            
                            
                            <div class="col-lg-2">
                              <label class="col-form-label title-busq" for="estudio_genero">Género</label>
                              <select name="ese[ese_sexo]" id="ese[ese_sexo]" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..."  >
                                <option value="-1">Seleccionar...</option>
                                <option value="2">Masculino</option>
                                <option value="1">Femenino</option>
                             
                              </select>
                            </div>
                       
  
                            <div class="col-lg-3">
                              <label class="col-form-label title-busq" for="estudio_estado_civil">Estado civil</label>
                              <select name="ese[esc_id_eses]" id="ese[esc_id_eses]" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
                                
                              </select>
  
                            </div>
  
                            
  
                          </div>
  
  
                          <div class="form-group row">
  
                            <div class="col-lg-3">
                              <label class="col-form-label title-busq" for="estudio_domicilio">Calle</label>
                              <input type="text" class="form-control input-rounded" placeholder="Calle..." id="ese[ese_calle]" name="ese[ese_calle]" maxlength="150"  oninput="handleInput(event)"  />
                            </div>
                            <div class="col-lg-3">
                              <label class="col-form-label title-busq" for="estudio_domicilio">Número exterior</label>
                              <input type="text" class="form-control input-rounded" placeholder="Número exterior..." id="ese[ese_numext]" maxlength="45" name="ese[ese_numext]"  oninput="handleInput(event)"  />
                            </div>
                            <div class="col-lg-3">
                              <label class="col-form-label title-busq" for="estudio_domicilio">Número interior</label>
                              <input type="text" class="form-control input-rounded" placeholder="Número interior..." id="ese[ese_numint]" maxlength="45" name="ese[ese_numint]"  oninput="handleInput(event)"  />
                            </div>
                          

                              <div class="col-lg-3">
                                <label class="col-form-label title-busq" for="estudio_domicilio_colonia">Colonia</label>
                                <input type="text" class="form-control input-rounded" placeholder="Colonia..." id="ese[ese_colonia]" maxlength="90" name="ese[ese_colonia]"  oninput="handleInput(event)"  />
                              </div>
                            
                              <div class="col-lg-5">
                                <label class="col-form-label title-busq" for="estudio_mucipio">Estado</label>
                                <input name="ese[est_id_eses]" disabled id="est_id_nombre"  class="form-control input-rounded form-control-disabled" readonly placeholder="Estado..." />
                              </div>
                              <div class="col-lg-5">
                                <label class="col-form-label title-busq" for="estudio_mucipio">Municipio</label>
                                <input name="ese[mun_id_eses]" disabled id="mun_id_nombre"  class="form-control input-rounded form-control-disabled" readonly placeholder="Municipio..." />


                              </div>
                            
                         
  
                          </div>
                        
                      
                        <div class="form-group row">
                          <div class="col-lg-3">
                            <label class="col-form-label title-busq" for="estudio_codigo_postal">Código postal</label>
                            <input type="text" class="form-control input-rounded" placeholder="Código..." id="ese[ese_codpostal]" maxlength="10" name="ese[ese_codpostal]"  oninput="handleInput(event)"/>
                            
                          </div>
                          <div class="col-lg-3">
                            <label class="col-form-label title-busq" for="estudio_nivel_estudios">Nivel de estudios</label>
                            <select name="ese[niv_id_eses]" id="ese[niv_id_eses]" data-toggle="select2" class="form-control select2-multiple">
              
                          </select>
                          </div>
  
                        
  
                          <div class="col-lg-3">
                            <label class="col-form-label title-busq" for="estudio_celular">Celular</label>
                            <input type="text" oninput="handleInput(event)"  maxlength="20" class="form-control input-rounded" placeholder="Celular..."  id="ese[ese_celular]" name="ese[ese_celular]"/>
                          </div>
  
                          <div class="col-lg-3">
                            <label class="col-form-label title-busq" for="estudio_telefono">Teléfono</label>
                            <input type="text"   oninput="handleInput(event)"  maxlength="20" class="form-control input-rounded" placeholder="Teléfono..." id="ese[ese_telefono]" name="ese[ese_telefono]" />
                          </div>

                          <div class="col-lg-5">
                            <label class="col-form-label title-busq" for="estudio_entrecalles">Entre calles</label>
                            <input type="text"   oninput="handleInput(event)"  maxlength="150" class="form-control input-rounded" placeholder="Entre calles..." id="ese[ese_entrecalles]" name="ese[ese_entrecalles]" />
                          </div>
  
  
                        </div>
              
                    
                    
  
  
                    <div class="form-group row mt-5 pt-5">
                      <div class="col-lg-3">
                        <p class="col-form-label title-busq text-uppercase">CONCEPTO</p>
                      </div>
                      <div class="col-lg-3">
                        <p class="col-form-label title-busq text-uppercase">Documentos comprobatorios <br> Fecha de expedición</p>
                      </div>
               
                      <div class="col-lg-3">
                        <p class="col-form-label title-busq text-uppercase">Lugar </p>
                      </div>
                      <div class="col-lg-3">
                        <p class="col-form-label title-busq text-uppercase">Folio </p>
                      </div>
                    </div>
  
                    <div class="form-group row">
                          <div class="col-lg-3">
                            <p class="col-form-label title-busq ">Acta de nacimiento</p>
                          </div>
                          <div class="col-lg-3">
                            <input type="text" class="form-control input-rounded" maxlength="30" placeholder="Fecha de registro..."  name="cop_nacimientofecha" id="cop_nacimientofecha"  oninput="handleInput(event)"/>
                          </div>
                          <div class="col-lg-3">
                            <input type="text" class="form-control input-rounded"  maxlength="155" placeholder="Lugar de registro..." name="cop_nacimientolugar" id="cop_nacimientolugar"  oninput="handleInput(event)"/>
                          </div>
                          <div class="col-lg-3">
                            <input type="text" class="form-control input-rounded" maxlength="25" placeholder="Nº Acta y Nº Libro..." name="cop_nacimientofolio" id="cop_nacimientofolio"  oninput="handleInput(event)"/>
                          </div>
                    </div>
  
  
                    <div class="form-group row">
                          <div class="col-lg-3">
                            <p class="col-form-label title-busq ">Acta de matrimonio</p>
                          </div>
                          <div class="col-lg-3">
                            <input type="text" class="form-control input-rounded"  maxlength="30" placeholder="Fecha de registro..."  name="cop_matrimoniofecha" id="cop_matrimoniofecha"  oninput="handleInput(event)"/>
                          </div>
                          <div class="col-lg-3">
                            <input type="text" class="form-control input-rounded"  maxlength="150" placeholder="Lugar de registro..."  name="cop_matrimoniolugar" id="cop_matrimoniolugar"  oninput="handleInput(event)"/>
                          </div>
                          <div class="col-lg-3">
                            <input type="text" class="form-control input-rounded"  maxlength="25" placeholder="Nº Acta y Nº Libro..."  name="cop_matrimoniofolio" id="cop_matrimoniofolio"  oninput="handleInput(event)"/>
                          </div>
                    </div>
          
                    <div class="form-group row">
                          <div class="col-lg-3">
                            <p class="col-form-label title-busq ">Acta de nacimiento de cónyuge</p>
                          </div>
                          <div class="col-lg-3">
                            <input type="text" class="form-control input-rounded"  maxlength="30" placeholder="Fecha de nacimiento..." id="cop_conyugefecha" name="cop_conyugefecha"   oninput="handleInput(event)"/>
                          </div>
                          <div class="col-lg-3">
                            <input type="text" class="form-control input-rounded"  maxlength="150" placeholder="Lugar de nacimiento..." name="cop_conyugelugar" id="cop_conyugelugar"  oninput="handleInput(event)"/>
                          </div>
                          <div class="col-lg-3">
                            <input type="text" class="form-control input-rounded"  maxlength="25" placeholder="Nº Acta y Nº Libro..." name="cop_conyugefolio" id="cop_conyugefolio"  oninput="handleInput(event)"/>
                          </div>
                   </div>
  
  
              
  
            <div class="form-group row">
                    <div class="col-lg-3">
                      <p class="col-form-label title-busq ">Acta de nacimiento de hijos</p>
                    </div>
                    <div class="col-lg-3">
                      <input type="text" class="form-control input-rounded"  maxlength="30" placeholder="Fecha de nacimiento..." name="cop_nacimientohijosfecha" id="cop_nacimientohijosfecha"  oninput="handleInput(event)" />
                    </div>
                    <div class="col-lg-3">
                      <input type="text" class="form-control input-rounded"  maxlength="150" placeholder="Lugar nacimiento..." name="cop_nacimientohijoslugar" id="cop_nacimientohijoslugar"  oninput="handleInput(event)" />
                    </div>
                    <div class="col-lg-3">
                      <input type="text" class="form-control input-rounded"  maxlength="45" placeholder="Nº Acta y Nº Libro..." name="cop_nacimientohijosfolio" id="cop_nacimientohijosfolio"  oninput="handleInput(event)" />
                    </div>
             </div>
  
             <div class="form-group row">
                  <div class="col-lg-3">
                    <p class="col-form-label title-busq ">Comprobante de domicilio</p>
                  </div>
                  <div class="col-lg-3">
                    <input type="text" class="form-control input-rounded"  maxlength="30" maxlength="30" placeholder="Fecha de facturación..."  oninput="handleInput(event)" name="cop_comprobantedomiciliofecha" id="cop_comprobantedomiciliofecha" />
                  </div>
                  <div class="col-lg-3">
                    <input type="text" class="form-control input-rounded"  maxlength="150" placeholder="Lugar de registro..."  oninput="handleInput(event)"  name="cop_comprobantedomiciliolugar" id="cop_comprobantedomiciliolugar"/>
                  </div>
                  <div class="col-lg-3">
                    <input type="text" class="form-control input-rounded"  maxlength="25" placeholder="Nº Oficial de documento..."  oninput="handleInput(event)" name="cop_comprobantedomiciliofolio" id="cop_comprobantedomiciliofolio"/>
                  </div>
            </div>
  
  
            <div class="form-group row">
                <div class="col-lg-3">
                  <p class="col-form-label title-busq ">Credencial de Elector</p>
                </div>
                <div class="col-lg-3">
                  <input type="text"  oninput="handleInput(event)"  maxlength="30"  class="form-control input-rounded" placeholder="Año de registro..." name="cop_credencialelectorfecha" id="cop_credencialelectorfecha" />
                </div>
                <div class="col-lg-3">
                  <input type="text"  oninput="handleInput(event)"  maxlength="150" class="form-control input-rounded" placeholder="Lugar de registro..."  name="cop_credencialelectorlugar" id="cop_credencialelectorlugar"/>
                </div>
                <div class="col-lg-3">
                  <input type="text"  oninput="handleInput(event)"  maxlength="25" class="form-control input-rounded" placeholder="Clave de elector..."  name="cop_credencialelectorfolio" id="cop_credencialelectorfolio"/>
                </div>
           </div>
  
          <div class="form-group row">
                <div class="col-lg-3">
                  <p class="col-form-label title-busq ">C.U.R.P</p>
                </div>
                <div class="col-lg-3">
                  <input type="text" class="form-control input-rounded"  maxlength="30" oninput="handleInput(event)" placeholder="Fecha de de inscripción..."  name="cop_curpfecha" id="cop_curpfecha" />
                </div>
                <div class="col-lg-3">
                  <input type="text" class="form-control input-rounded"  maxlength="150"  oninput="handleInput(event)" placeholder="Lugar de registro..." name="cop_curplugar" id="cop_curplugar" />
                </div>
                
                <div class="col-lg-3">
                  <input type="text" class="form-control input-rounded"  maxlength="25" oninput="handleInput(event)"  placeholder="Clave (CURP completa)..." name="cop_curpfolio" id="cop_curpfolio" />
                </div>
          
          </div>
  
  
            <div class="form-group row">
                  <div class="col-lg-3">
                    <p class="col-form-label title-busq ">Afiliación al I.M.S.S</p>
                  </div>
                  <div class="col-lg-3">
                    <input type="text" class="form-control input-rounded" maxlength="30"  oninput="handleInput(event)"  placeholder="Fecha de solicitud o asignación..." id="cop_imssfecha" name="cop_imssfecha"/>
                  </div>
                  <div class="col-lg-3">
                    <input type="text" class="form-control input-rounded"  maxlength="150" oninput="handleInput(event)" placeholder="Lugar de registro..." id="cop_imsslugar" name="cop_imsslugar"/>
                  </div>
                  <div class="col-lg-3">
                    <input type="text" class="form-control input-rounded"   maxlength="25" oninput="handleInput(event)" placeholder="Nº de seguridad social(11 dígitos)..." id="cop_imssfolio" name="cop_imssfolio"/>
                  </div>
            </div>
  
          <div class="form-group row">
                <div class="col-lg-3">
                  <p class="col-form-label title-busq ">Comprobante de retención de impuestos</p>
                </div>
                <div class="col-lg-3">
                  <input type="text" class="form-control input-rounded"  maxlength="30" oninput="handleInput(event)" placeholder="Fecha de expedición..." id="cop_retencionfecha" name="cop_retencionfecha" />
                </div>
                <div class="col-lg-3">
                  <input type="text" class="form-control input-rounded"  maxlength="150" oninput="handleInput(event)" placeholder="Lugar expedición..." id="cop_retencionlugar" name="cop_retencionlugar" />
                </div>
                <div class="col-lg-3">
                  <input type="text" class="form-control input-rounded"  maxlength="35"  oninput="handleInput(event)" placeholder="Nº de empleado o nombre de la empresa..." id="cop_retencionfolio" name="cop_retencionfolio" />
                </div>
          </div>
  
  
  
          <div class="form-group row">
                <div class="col-lg-3">
                  <p class="col-form-label title-busq ">Registro Federal Contribuyentes</p>
                </div>
                <div class="col-lg-3">
                  <input type="text" class="form-control input-rounded"  maxlength="30"  oninput="handleInput(event)" placeholder="Fecha de inicio de operaciones..." id="cop_rfcfecha" name="cop_rfcfecha"  />
                </div>
    
                <div class="col-lg-3">
                  <input type="text" class="form-control input-rounded" maxlength="150"  oninput="handleInput(event)" placeholder="Lugar de emisión..." id="cop_rfclugar" name="cop_rfclugar" />
                </div>
                <div class="col-lg-3">
                  <input type="text" class="form-control input-rounded"  maxlength="25" oninput="handleInput(event)" placeholder="Registro Federal de Contribuyentes..." id="cop_rfcfolio" name="cop_rfcfolio" />
                </div>
          </div>
  
            <div class="form-group row">
                <div class="col-lg-3">
                  <p class="col-form-label title-busq ">Cartilla de servicio militar nacional</p>
                </div>
                <div class="col-lg-3">
                  <input type="text" class="form-control input-rounded"  maxlength="30" oninput="handleInput(event)" placeholder="Fecha de trámite..." id="cop_cartillafecha" name="cop_cartillafecha" />
                </div>
                <div class="col-lg-3">
                  <input type="text" class="form-control input-rounded"   maxlength="150" oninput="handleInput(event)" placeholder="Lugar de trámite..."  id="cop_cartillalugar" name="cop_cartillalugar"/>
                </div>
                <div class="col-lg-3">
                  <input type="text" class="form-control input-rounded"  maxlength="25" oninput="handleInput(event)" placeholder="Nº Matrícula..."  id="cop_cartillafolio" name="cop_cartillafolio"/>
                </div>
  
            </div>
  
  
            <div class="form-group row">
                <div class="col-lg-3">
                  <p class="col-form-label title-busq ">Licencia para conducir</p>
                </div>
                <div class="col-lg-3">
                  <input type="text" class="form-control input-rounded"  maxlength="30"  oninput="handleInput(event)" placeholder="Fecha de expedición y vigencia..." id="cop_licenciafecha" name="cop_licenciafecha" />
                </div>
                <div class="col-lg-3">
                  <input type="text" class="form-control input-rounded"  maxlength="150"  oninput="handleInput(event)" placeholder="Lugar de trámite..." id="cop_licencialugar" name="cop_licencialugar"/>
                </div>
                <div class="col-lg-3">
                  <input type="text" class="form-control input-rounded"  maxlength="45" oninput="handleInput(event)"  placeholder="Nº de conductor y tipo de licencia..." id="cop_licenciafolio" name="cop_licenciafolio"/>
                </div>
           </div>
  
  
            <div class="form-group row">
                  <div class="col-lg-3">
                    <p class="col-form-label title-busq ">Vigencia migratorio <span class="text-danger ">(para extranjeros)</span></p>
                  </div>
                  <div class="col-lg-3">
                    <input type="text" class="form-control input-rounded"  maxlength="30" oninput="handleInput(event)" placeholder="Fecha de expedición y vencimiento..."  id="cop_migratoriafecha" name="cop_migratoriafecha"/>
                  </div>
                  <div class="col-lg-3">
                    <input type="text" class="form-control input-rounded"  maxlength="150" oninput="handleInput(event)" placeholder="Lugar de nacionalidad..." id="cop_migratorialugar" name="cop_migratorialugar"/>
                  </div>
                  <div class="col-lg-3">
                    <input type="text" class="form-control input-rounded"  maxlength="25" oninput="handleInput(event)" placeholder="Nº de cedula de identidad..." id="cop_migratoriafolio" name="cop_migratoriafolio"/>
                  </div>
            </div>
  
          
            <div class="form-group row d-flex flex-row-reverse ">
              {% if cuarenta==1%}
              
                     <div class="col-lg-4">
                            <label class="col-form-label title-busq text-uppercase ">Calificación</label>
                            <select  name="cop_calificacion" id="cop_calificacion" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                              <optgroup>
                                <option value="-1">SELECCIONAR ...</option>
                                <option value="1">1.-INAPROPIADO</option>
                                <option value="2">2.-PROMEDIO</option>
                                <option value="3">3.-APROPIADO</option>
                              </optgroup>
                            </select>
                      </div>
                {% endif %}     
              </div>
             
  
                    
                      <div class="row col-lg-12">
                        <div class="col-sm-3 col-md-3 text-center mt-5">
                        </div>                          
                        <div class="col-sm-3 col-md-3 text-center mt-5">
                          {% if cuarentayseis==1%}
                            <div class="form-group">
                              <button type="button" class="btn-green btn-rounded btn btn-limpiar" href="" data-toggle="modal" onclick="incidenciaformulario($('#ese_id_ese_actual').text(),1)" data-target="#incidencias-modal" style="background-color: green;">Incidencia<i class="mdi mdi-shield-alert"></i></button>
                            </div>
                          {% endif %}
                        </div>
                        <div class="col-sm-3 col-md-3 text-center mt-5">
                            <div class="form-group">
                              <button class="btn-dark btn-rounded btn btn-limpiar" class="close" data-dismiss="modal" aria-label="Close">Cancelar</button>
                            </div>
                        </div>
                        <div class="col-sm-3 col-md-3  text-center mt-5 ">
                            <div class="form-group">
                             
                              <button type="submit" class="btn-dark btn-rounded btn btn-buscar">Guardar <i class="mdi mdi-content-save white"></i> </button>
                              
                            </div>
                        </div>
                      </div>
  
                  </section>
  
                  </form>      
  
  
                </div>
                <!-- FORMULARIO DE DATOS ESCOLARES INCIO----------------------------------------------------------------------------------------------------------------------------------------INCIO -->
                <div class="tab-pane fade borde-inferior-del-sistema content-for-js" id="SeccionDatosEscolares-md" role="tabpanel" aria-labelledby="profile-tab-md">
                  <form id="form_estudio_seccionDatosEscolares" class=" form-vertical mt-1 ">
                  

                    <div class="form-group row d-flex justify-content-center  bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">
                    
                                
                          <div class="container row d-flex justify-content-center">
                            
                                <p class=" text-white text-center font-weight-bold h6 sin-margen" >
                                  B | DATOS ESCOLARES  <i class="mdi mdi-school white"></i>
                                </p>
        
                          </div>
    
                      
                  
                     </div>


                    <section class="m-3 contorno-del-sistema">
                      <div class="form-group row ">
                        <div class="col-lg-2 ml-2">
                          <p class="col-form-label title-busq text-uppercase">NIVEL ESCOLAR </p>
                        </div>
                        <div class="col-lg-2">
                          <p class="col-form-label title-busq text-uppercase">PERIODO (MES Y AÑO)</p>
                        </div>
                        <div class="col-lg-2">
                          <p class="col-form-label title-busq text-uppercase">ESCUELA</p>
                        </div>
                        <div class="col-lg-2">
                          <p class="col-form-label title-busq text-uppercase">CERTIFICADO</p>
                        </div>
                        <div class="col-lg-2">
                          <p class="col-form-label title-busq text-uppercase">PROMEDIO</p>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-lg-2">
                          <label for="dae_primariaperiodo" class="col-form-label title-busq ml-2">Primaria</label>
                        </div>
                        <div class="col-lg-2">
                          <input type="text" class="form-control input-rounded"  oninput="handleInput(event)" placeholder="Periodo" name="dae_primariaperiodo" id="dae_primariaperiodo" maxlength="45" />
                        </div>
                        <div class="col-lg-2">
                          <input type="text" class="form-control input-rounded"  oninput="handleInput(event)" placeholder="Nombre de la escuela" name="dae_primariaescuela" id="dae_primariaescuela" maxlength="45"/>
                        </div>
                        <div class="col-lg-2">
                          <select name="dae_primariacertificado"  id="dae_primariacertificado" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                            <optgroup>
                              <option value="-1">SELECCIONAR...</option>
                              <option value="2">EN TRÁMITE</option>
                              <option value="1">SI</option>
                              <option value="0">NO</option>
                            </optgroup>
                          </select>
                        </div>
                        <div class="col-lg-2">
                          <input oninput="handleInput(event)" type="text" class="form-control input-rounded" placeholder="Promedio obtenido..." name="dae_primariapromedio" id="dae_primariapromedio" maxlength="10"/>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-lg-2">
                          <label for="estudio_secundaria_fecha" class="col-form-label title-busq ml-2">Secundaria</label>
                        </div>
                        <div class="col-lg-2">
                          <input type="text" class="form-control input-rounded" placeholder="Periodo" name="dae_secundariaperiodo" id="dae_secundariaperiodo" maxlength="45" oninput="handleInput(event)"/>
                        </div>
                        <div class="col-lg-2">
                          <input type="text"  oninput="handleInput(event)" class="form-control input-rounded" placeholder="Nombre de la escuela..." name="dae_secundariaescuela" id="dae_secundariaescuela" maxlength="45"/>
                        </div>
                        <div class="col-lg-2">
                          <select name="dae_secundariacertificado" id="dae_secundariacertificado" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
                            <optgroup>
                                <option value="-1">SELECCIONAR...</option>
                                <option value="2">EN TRÁMITE</option>
                                <option value="1">SI</option>
                                <option value="0">NO</option>
                              </optgroup>
                          </select>
                        </div>
                        <div class="col-lg-2">
                          <input type="text"  oninput="handleInput(event)" class="form-control input-rounded" placeholder="Promedio obtenido..." name="dae_secundariapromedio" id="dae_secundariapromedio" maxlength="10"/>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-lg-2">
                          <label for="estudio_carrera_comercial_fecha" class="col-form-label title-busq ml-2">Carrera comercial</label>
                        </div>
                        <div class="col-lg-2">
                          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Periodo" name="dae_comercialperiodo" id="dae_comercialperiodo" maxlength="45" oninput="handleInput(event)"/>
                        </div>
                        <div class="col-lg-2">
                          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Nombre de la escuela..." name="dae_comercialescuela" id="dae_comercialescuela" maxlength="45"/>
                        </div>
                        <div class="col-lg-2">
                          <select name="dae_comercialcertificado" id="dae_comercialcertificado" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
                            <optgroup>
                            <option value="-1">SELECCIONAR...</option>
                            <option value="2">EN TRÁMITE</option>
                            <option value="1">SI</option>
                            <option value="0">NO</option>
                          </optgroup>
                          </select>
                        </div>
                        <div class="col-lg-2">
                          <input type="text" class="form-control input-rounded" placeholder="Promedio obtenido..." name="dae_comercialpromedio" id="dae_comercialpromedio" oninput="handleInput(event)" maxlength="10"/>
                        </div>
                      </div>              
                      <div class="form-group row">
                        <div class="col-lg-2">
                          <label for="estudio_bachillerato_fecha" class="col-form-label title-busq ml-2">Bachillerato o Preparatoria</label>
                        </div>
                        <div class="col-lg-2">
                          <input type="text" class="form-control input-rounded" placeholder="Periodo" name="dae_preparatoriaperiodo" id="dae_preparatoriaperiodo" maxlength="45" oninput="handleInput(event)"/>
                        </div>
                        <div class="col-lg-2">
                          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Nombre de la escuela..." name="dae_preparatoriaescuela" id="dae_preparatoriaescuela" maxlength="45"/>
                        </div>
                        <div class="col-lg-2">
                          <select name="dae_preparatoriacertificado" id="dae_preparatoriacertificado" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
                            <optgroup>
                              <option value="-1">SELECCIONAR...</option>
                              <option value="2">EN TRÁMITE</option>
                              <option value="1">SI</option>
                              <option value="0">NO</option>
                            </optgroup>
                          </select>
                        </div>
                        <div class="col-lg-2">
                          <input type="text" class="form-control input-rounded" placeholder="Promedio obtenido..." name="dae_preparatoriapromedio" id="dae_preparatoriapromedio" oninput="handleInput(event)" maxlength="10"/>
                        </div>
                      </div>  
                      <div class="form-group row">
                        <div class="col-lg-2">
                          <label for="estudio_licenciatura_fecha" class="col-form-label title-busq ml-2">Licenciatura</label>
                        </div>
                        <div class="col-lg-2">
                          <input type="text" class="form-control input-rounded" placeholder="Periodo" name="dae_licenciaturaperiodo" id="dae_licenciaturaperiodo" maxlength="45" oninput="handleInput(event)"/>
                        </div>
                        <div class="col-lg-2">
                          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Nombre de la escuela..." name="dae_licenciaturaescuela" id="dae_licenciaturaescuela" maxlength="45"/>
                        </div>
                        <div class="col-lg-2">
                          <select name="dae_licenciaturacertificado"  id="dae_licenciaturacertificado" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
                            <optgroup>
                              <option value="-1">SELECCIONAR...</option>
                              <option value="2">EN TRÁMITE</option>
                              <option value="1">SI</option>
                              <option value="0">NO</option>
                            </optgroup>
                          </select>
                        </div>
                        <div class="col-lg-2">
                          <input type="text" class="form-control input-rounded" placeholder="Promedio obtenido..." name="dae_licenciaturapromedio" id="dae_licenciaturapromedio" oninput="handleInput(event)" maxlength="10"/>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-lg-2">
                          <label for="estudio_cedula_fecha" class="col-form-label title-busq ml-2">Cédula profesional</label>
                        </div>
                        <div class="col-lg-2">
                          <input type="text" class="form-control input-rounded" placeholder="Fecha de la cédula" name="dae_cedulaperiodo" id="dae_cedulaperiodo" maxlength="45" oninput="handleInput(event)"/>
                        </div>
                        <div class="col-lg-2">
                          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="No. de la cédula..." name="dae_cedulaescuela" id="dae_cedulaescuela" maxlength="45"/>
                        </div>
                        <div class="col-lg-2">
                          <select name="dae_cedulacertificado" id="dae_cedulacertificado" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
                            <optgroup>
                              <option value="-1">SELECCIONAR...</option>
                              <option value="2">EN TRÁMITE</option>
                              <option value="1">SI</option>
                              <option value="0">NO</option>
                            </optgroup>
                          </select>
                        </div>
                        <div class="col-lg-2">
                          <input type="text" class="form-control input-rounded" placeholder="Promedio obtenido..." name="dae_cedulapromedio" id="dae_cedulapromedio" oninput="handleInput(event)" maxlength="10"/>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-lg-2">
                          <label for="estudio_otroEstudios_fecha" class="col-form-label title-busq ml-2">Otros</label>
                        </div>
                        <div class="col-lg-2">
                          <input type="text" class="form-control input-rounded" placeholder="Periodo" name="dae_otroperiodo" id="dae_otroperiodo" maxlength="45" oninput="handleInput(event)"/>
                        </div>
                        <div class="col-lg-2">
                          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Nombre de la escuela..." name="dae_otroescuela" id="dae_otroescuela" maxlength="45"/>
                        </div>
                        <div class="col-lg-2">
                          <select name="dae_otrocertificado" id="dae_otrocertificado" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
                            <optgroup>
                              <option value="-1">SELECCIONAR...</option>
                              <option value="2">EN TRÁMITE</option>
                              <option value="1">SI</option>
                              <option value="0">NO</option>
                            </optgroup>
                          </select>
                        </div>
                        <div class="col-lg-2">
                          <input type="text" class="form-control input-rounded" placeholder="Promedio obtenido..." name="dae_otropromedio" id="dae_otropromedio" oninput="handleInput(event)" maxlength="10"/>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-lg-2">
                          <label for="estudio_estudiosActuales_fecha" class="col-form-label title-busq ml-2">Estudios Actuales</label>
                        </div>
                        <div class="col-lg-2">
                          <input type="text" class="form-control input-rounded" placeholder="Periodo" name="dae_actualperiodo" id="dae_actualperiodo" maxlength="45" oninput="handleInput(event)"/>
                        </div>
                        <div class="col-lg-2">
                          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Nombre de la escuela..." name="dae_actualescuela" id="dae_actualescuela" maxlength="45"/>
                        </div>
                        <div class="col-lg-2">
                          <select name="dae_actualcertificado" id="dae_actualcertificado" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
                            <optgroup>
                              <option value="-1">SELECCIONAR...</option>
                              <option value="2">EN TRÁMITE</option>
                              <option value="1">SI</option>
                              <option value="0">NO</option>
                            </optgroup>
                          </select>
                        </div>
                        <div class="col-lg-2">
                          <input type="text" class="form-control input-rounded" placeholder="Promedio obtenido..." name="dae_actualpromedio" id="dae_actualpromedio" oninput="handleInput(event)" maxlength="10"/>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-lg-2">
                          <label for="estudio_periodo_inactivo" class="col-form-label title-busq ml-2">Periodos inactivos</label>
                        </div>
                        <div class="col-lg-10">
                          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Periodo inactivo..."  name="dae_periodoinactivo" id="dae_periodoinactivo" maxlength="100"/>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-lg-2">
                          <label for="estudio_periodo_inactivo_razones" class="col-form-label title-busq ml-2">Motivos</label>
                        </div>
                        <div class="col-lg-10">
                          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Escriba la razón..." name="dae_motivo" id="dae_motivo" maxlength="150"/>
                        </div>
                      </div>  
                      <div class="form-group row">
                        <div class="col-lg-2">
                          <label for="comentario_nuevo" class="col-form-label title-busq ml-2">Notas</label>
                        </div>
                        <div class="col-lg-10">
                          <textarea id="dae_notas" name="dae_notas" oninput="handleInput(event)" class="form-control-textarea text_area_a" style="min-height:5rem" maxlength="400"></textarea>
                        </div>
                      </div>                 
                      <div class="form-group row d-flex flex-row-reverse">
                        {% if cuarenta==1%}
                          <div class="col-lg-4">
                            <label class="col-form-label title-busq">Calificación</label>
                            <select name="dae_calificacion" id="dae_calificacion" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
                              <optgroup>
                                <option value="-1">SELECCIONAR ...</option>
                                <option value="1">1.-INAPROPIADO</option>
                                <option value="2">2.-PROMEDIO</option>
                                <option value="3">3.-APROPIADO</option>
                              </optgroup>
                            </select>
                          </div>
                        {% endif %}
                      </div>
                    </section>
                    <div class="row col-lg-12">
                      <div class="col-sm-3 col-md-3 text-center mt-5">
                        </div>                          
                        <div class="col-sm-3 col-md-3 text-center mt-5">
                          {% if cuarentayseis==1%}
                         
                            <div class="form-group">
                              <button type="button" class="btn-green btn-rounded btn btn-limpiar" href="" data-toggle="modal" onclick="incidenciaformulario($('#ese_id_ese_actual').text(),2)" data-target="#incidencias-modal" style="background-color: green;">Incidencia<i class="mdi mdi-shield-alert"></i></button>
                            </div>
                          {% endif %}
                        </div>
                      <div class="col-sm-3 col-md-3 text-center mt-5">
                        <div class="form-group">
                          <button class="btn-dark btn-rounded btn btn-limpiar" class="close" data-dismiss="modal" aria-label="Close">Cancelar</button>
                        </div>
                      </div>
                      <div class="col-sm-3 col-md-3  text-center mt-5 ">
                        <div class="form-group">
                          <button class="btn-dark btn-rounded btn btn-buscar">Guardar <i class="mdi mdi-content-save white"></i> </button>
                        </div>
                      </div>
                    </div>
                  </form>      
  
                <!-- FOMULARIO DE DATOS ESCOLARES FIN--------------------------------------------------------------------------------------------FIN -->
  
  
                </div>
                
              <!-- FORMULARIO DE ANTETECEDEMTES SOCIALES INCIO----------------------------------------------------------------------------------------------------INCIO -->
  
                <div class="tab-pane fade borde-inferior-del-sistema content-for-js" id="SeccionAntecedentesSociales-md" role="tabpanel" aria-labelledby="contact-tab-md">
                  <form id="form_estudio_seccionAntecedenteSocial" class="form-vertical mt-1">
                 

                  <div class="form-group row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">                  
                           <div class="container row d-flex justify-content-center">
                        
                            <p class=" text-white text-center font-weight-bold h6 sin-margen" >
                              C | ANTECEDENTES SOCIALES   <i class="mdi mdi-human-handsdown white "></i> <i class="mdi mdi-human-handsdown black "></i>
                            </p>
    
                          </div>
                  </div>
                    <section class="m-3">
                      <div class="form-group row">
                        <div class="col-lg-3">
                          <label for="ans_tiempolibre" class="col-form-label title-busq">
                            Actividades en su tiempo libre
                          </label>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Nombre de las actividades que realiza..."  name="ans_tiempolibre" id="ans_tiempolibre" maxlength="255" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-lg-3">
                          <label for="estudio_pertence_club_deportivo" class="col-form-label title-busq">¿Pertenece a algún club deportivo?</label>
                        </div>
                        <div class="col-lg-2">
                          <select name="ans_clubdeportivo" id="ans_clubdeportivo" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
                            <optgroup>
                              <option value="-1">Seleccionar ...</option>
                              <option value="1">SI</option>
                              <option value="0">NO</option>
                            </optgroup>
                          </select>
                        </div>
                        <div class="col-lg-3">
                          <label for="ans_deporte" class="col-form-label title-busq">
                            ¿Qué deporte practica?
                          </label>
                        </div>
                        <div class="col-lg-2">
                          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Nombre del deporte" name="ans_deporte" id="ans_deporte" maxlength="155" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-lg-3">
                          <label for="estudio_pertence_club_deportivo" class="col-form-label title-busq">¿Pertenece a algún puesto sindical?</label>
                        </div>
                        <div class="col-lg-2">
                          <select name="ans_puestosindical" id="ans_puestosindical" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
                            <optgroup>
                              <option value="-1">Seleccionar ...</option>
                              <option value="1">SI</option>
                              <option value="0">NO</option>
                            </optgroup>
                          </select>
                        </div>
                        <div class="col-lg-1">
                          <label for="ans_puestonombre" class="col-form-label title-busq">
                            ¿A cuál?
                          </label>
                        </div>
                        <div class="col-lg-2">
                          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Nombre del sindicato" name="ans_puestonombre" id="ans_puestonombre" maxlength="155" />
                        </div>
                        <div class="col-lg-1">
                          <label for="ans_puestocargo" class="col-form-label title-busq">
                            ¿Qué cargo?
                          </label>
                        </div>
                        <div class="col-lg-2">
                          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Nombre del puesto" name="ans_puestocargo" id="ans_puestocargo" maxlength="155" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-lg-3">
                          <label for="ans_politico" class="col-form-label title-busq">¿Pertenece a algún partido político?</label>
                        </div>
                        <div class="col-lg-2">
                          <select name="ans_politico" id="ans_politico" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
                            <optgroup>
                              <option value="-1">Seleccionar ...</option>
                              <option value="1">SI</option>
                              <option value="0">NO</option>
                            </optgroup>
                          </select>
                        </div>
                        <div class="col-lg-1">
                          <label for="ans_politiconombre" class="col-form-label title-busq">
                            ¿A cuál?
                          </label>
                        </div>
                        <div class="col-lg-2">
                          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Nombre del partido" name="ans_politiconombre" id="ans_politiconombre" maxlength="155" />
                        </div>
                        <div class="col-lg-1">
                          <label for="ans_politicocargo" class="col-form-label title-busq">
                            ¿Qué cargo?
                          </label>
                        </div>
                        <div class="col-lg-2">
                          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Nombre del puesto" name="ans_politicocargo" id="ans_politicocargo" maxlength="155" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-lg-3">
                          <label for="ans_religion" class="col-form-label title-busq">
                            ¿Qué religión a profesa?
                          </label>
                        </div>
                        <div class="col-lg-2">
                          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Nombre de la religión..."  name="ans_religion" id="ans_religion" maxlength="85" />
                        </div>
                        <div class="col-lg-3">
                          <label for="ans_religionfrecuencia" class="col-form-label title-busq">
                            ¿Con qué frecuencia?
                          </label>
                        </div>
                        <div class="col-lg-2">
                          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Frecuencia con la que visita esos lugares..." name="ans_religionfrecuencia" id="ans_religionfrecuencia" maxlength="85" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-lg-3">
                          <label for="ans_cortoplazo" class="col-form-label title-busq">
                            ¿Cuáles son sus planes a corto plazo?
                          </label>
                        </div>
                        <div class="col-lg-8">
                          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Planes a corto plazo..." name="ans_cortoplazo"  id="ans_cortoplazo" maxlength="255" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-lg-3">
                          <label for="ans_medianoplazo" class="col-form-label title-busq">
                            ¿Cuáles son sus planes a mediano plazo?
                          </label>
                        </div>
                        <div class="col-lg-8">
                          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Planes a mediano plazo..." name="ans_medianoplazo" id="ans_medianoplazo" maxlength="255" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-lg-3">
                          <label for="ans_largoplazo" class="col-form-label title-busq">
                            ¿Cuáles son sus planes a largo plazo?
                          </label>
                        </div>
                        <div class="col-lg-8">
                          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Planes a largo plazo..." name="ans_largoplazo" id="ans_largoplazo" maxlength="255" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-lg-3">
                          <label for="ans_bebida" class="col-form-label title-busq">
                            ¿Ingiere bebidas alcohólicas?
                          </label>
                        </div>
                        <div class="col-lg-2">
                          <select name="ans_bebida" id="ans_bebida" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
                            <optgroup>
                              <option value="-1">Seleccionar ...</option>
                              <option value="1">SI</option>
                              <option value="0">NO</option>
                            </optgroup>
                          </select>
                        </div>
                        <div class="col-lg-1">
                          <label for="ans_bebidafrecuencia" class="col-form-label title-busq">
                            ¿Con qué frecuencia?
                          </label>
                        </div>
                        <div class="col-lg-3">
                          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Frecuencia con la que realiza esa actividad..." id="ans_bebidafrecuencia" name="ans_bebidafrecuencia" maxlength="255"/>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-lg-3">
                          <label for="ans_fumar" class="col-form-label title-busq">
                            ¿Acostumbra fumar?
                          </label>
                        </div>
                        <div class="col-lg-2">
                          <select name="ans_fumar" id="ans_fumar" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
                            <optgroup>
                              <option value="-1">Seleccionar ...</option>
                              <option value="1">SI</option>
                              <option value="0">NO</option>
                            </optgroup>
                          </select>
                        </div>
                        <div class="col-lg-1">
                          <label for="ans_fumarfrecuencia" class="col-form-label title-busq">
                            ¿Con qué frecuencia?
                          </label>
                        </div>
                        <div class="col-lg-3">
                          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Frecuencia con la que realiza esa actividad..." id="ans_fumarfrecuencia" name="ans_fumarfrecuencia" maxlength="255" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-lg-2">
                          <label for="ans_nota" class="col-form-label title-busq">
                           Notas
                          </label>
                        </div>
                        <div class="col-lg-10">
                          <textarea id="ans_nota"  placeholder="Notas..." name="ans_nota" oninput="handleInput(event)" class="form-control-textarea text_area_a" style="min-height:5rem" maxlength="300"></textarea>
                        </div>
                      </div>
                      {% if cuarenta==1%}
                        <div class="form-group row d-flex flex-row-reverse">
                          <div class="col-lg-4">
                            <label class="col-form-label title-busq">Calificación</label>
                            <select name="ans_calificacion" id="ans_calificacion" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
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
                              <button type="button" class="btn-green btn-rounded btn btn-limpiar" href="" data-toggle="modal" onclick="incidenciaformulario($('#ese_id_ese_actual').text(),3)" data-target="#incidencias-modal" style="background-color: green;">Incidencia<i class="mdi mdi-shield-alert"></i></button>
                            </div>
                          {% endif %}
                        </div>
                      <div class="col-sm-3 col-md-3 text-center mt-5">
                          <div class="form-group">
                            <button class="btn-dark btn-rounded btn btn-limpiar" class="close" data-dismiss="modal" aria-label="Close">Cancelar</button>
                          </div>
                      </div>
                      <div class="col-sm-3 col-md-3  text-center mt-5 ">
                          <div class="form-group">
                            <button class="btn-dark btn-rounded btn btn-buscar">Guardar <i class="mdi mdi-content-save white"></i> </button>
                          </div>
                      </div>
                    </div>
                  </form>
                </div>
              <!-- FORMULARIO DE ENTECEDENTES SOCIALES FIN------------------------------------------------------------------------------------FIN -->
  
  
                <!-- FORMULARIO DE ESTADO GENERAL DE SALUD INCIO------------------------------------------------------------------------------------INCIO -->
                
                <div class="tab-pane fade borde-inferior-del-sistema content-for-js" id="SeccionEstadoGeneralSal-md" role="tabpanel" aria-labelledby="contact-tab-md">
                  <form id="form_estudio_seccionEstadoGeneralDeSalud" class="form-vertical mt-1">
                    

                    <div class="form-group row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">                  
                                <div class="container row d-flex justify-content-center">
                          
                                        <p class=" text-white text-center font-weight-bold h6 sin-margen" >
                                        D | ESTADO GENERAL DE SALUD  <i class="mdi mdi-hospital-building white"></i>
                                        </p>

                                </div>
                    </div>
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
                          <textarea id="ess_nota"  placeholder="Notas..." name="ess_nota" oninput="handleInput(event)" class="form-control-textarea text_area_a" style="min-height:5rem" maxlength="300"></textarea>
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
                            <button class="btn-dark btn-rounded btn btn-limpiar" class="close" data-dismiss="modal" aria-label="Close">Cancelar</button>
                          </div>
                      </div>
                      <div class="col-sm-3 col-md-3  text-center mt-5 ">
                          <div class="form-group">
                            <button class="btn-dark btn-rounded btn btn-buscar">Guardar <i class="mdi mdi-content-save white"></i> </button>
                          </div>
                      </div>
                    </div>
                  </form>
                </div>
  
  
              <!-- FORMULARIO DE ESTADO GENERAL DE SALUD FIN------------------------------------------------------------------------------------FIN--->
  
  
     <!-- FOMULARIO DE GRUPO FAMILIAR INCIO------------------------------------------------------------------------------------INCIO -->
  
     <div class="tab-pane fade borde-inferior-del-sistema content-for-js" id="SeccionDatosgrupoFamiliar-md" role="tabpanel" aria-labelledby="contact-tab-md">
      <form id="form_estudio_seccionGrupoFamiliar" class="form-vertical mt-1">
                      
                    <div class="form-group row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">                  
                        <div class="container row d-flex justify-content-center">
                  
                                <p class=" text-white text-center font-weight-bold h6 sin-margen" >
                                  E | DATOS DE GRUPO FAMILIAR   <i class="mdi mdi-worker white"></i>
                                </p>

                        </div>
                     </div>

                    <div class="form-group row justify-content-center d-none">
                      <h6>Folio de referencia familiar: <span id="gfd_id_titulo_gfd"> </span></h6>
                    </div>

                    <div class="row ml-3 d-flex" id="">
                      {{ link_to('#', image("assets/images/small/boton.svg", 'class':'boton-plus','onclick':'fnCrearDatoGrupoFamiliarDetalles()', 'height':'50'),"data-toggle":"modal","data-target":"#agregar-familiar-candidato-modal","title":"Agregar familiar del candidato." ,'id':'' ) }}
                      <span class="ml-3 h6  text-success">Agregar una referencia familiar</span>

                    </div>


                    <div class="form-group row m-3" id="datogrupofamiliardetalleslistado">
                    </div>

                <section class="m-3" >
                            
                          
  
                              <div class="form-group row" id="primer_familiar_candidato  d-none">
                                      
                              </div>
  
                              <div class="form-group row">
                                          <div class="col-lg-4">
                                            <label  for="dgf_matrimoniopadres" class="col-form-label title-busq">¿Cuántos matrimonios han contraído cada uno de sus padres?</label>
                                          </div>
                                          <div class="col-lg-8">
                                            <input oninput="handleInput(event)" type="text" class="form-control input-rounded" placeholder="Número de matrimonios..." name="dgf_matrimoniopadres" id="dgf_matrimoniopadres" maxlength="100" />
                                          </div>
                              </div>
  
  
  
                            {% if cuarenta==1%}
                                  <div class="form-group row d-flex flex-row-reverse  ">
                                    <div class="col-lg-4">
                                          <label class="col-form-label title-busq">Calificación</label>
                                          <select name="dgf_calificacion" id="dgf_calificacion" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
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
                      <button type="button" class="btn-green btn-rounded btn btn-limpiar" href="" data-toggle="modal" onclick="incidenciaformulario($('#ese_id_ese_actual').text(),5)" data-target="#incidencias-modal" style="background-color: green;">Incidencia<i class="mdi mdi-shield-alert"></i></button>
                    </div>
                  {% endif %}
                </div>
                <div class="col-sm-3 col-md-3 text-center mt-5">
                    <div class="form-group">
                      <button class="btn-dark btn-rounded btn btn-limpiar" class="close" data-dismiss="modal" aria-label="Close">Cancelar</button>
                    </div>
                </div>
                <div class="col-sm-3 col-md-3  text-center mt-5 ">
                    <div class="form-group">
                      <button class="btn-dark btn-rounded btn btn-buscar">Guardar <i class="mdi mdi-content-save white"></i> </button>
                    </div>
                </div>
              </div>
  
          </form>
    </div>
  <!-- FOMULARIO DE GRUPO FAMILIAR FIN------------------------------------------------------------------------------------FIN -->
  
  
  
                <!-- FOMULARIO DE ANTECEDENTES LABORALES INCIO------------------------------------------------------------------------------------INCIO -->
  
                <div class="tab-pane fade borde-inferior-del-sistema content-for-js" id="SecciondAntecedentesLaborales-md" role="tabpanel" aria-labelledby="contact-tab-md">
                  <form id="form_estudio_antecedentegrupofamiliar" class="form-vertical mt-1" method="post">
                                 
                                <div class="form-group row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">                  
                                  <div class="container row d-flex justify-content-center">
                            
                                          <p class=" text-white text-center font-weight-bold h6 sin-margen" >
                                            F | ANTECEDENTES LABORALES DE GRUPO FAMILIAR   <i class="mdi mdi-worker white"></i>
                                          </p>
          
                                  </div>
                               </div>
          
                              
  
  
                        <section class="m-3">
  
                                  <div class="form-group row mt-3 mb-3 ">
                                          <p class="text-gray font-weight-bold">
                                            A continuación deberá especificar los datos relacionados con las personas que pertenecen al sistema familiar, así como los datos del cónyuge e hijos, únicamente en caso de que se encuentren laborando.
                                          </p>
                                  </div>
                                  <div class="row col-lg-12 d-flex ">
                                        
                                  
                                    <div class="row ml-3 d-flex">
                                      {{ link_to('#', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'50','onclick':'fnCrearDatoAntecedenteLaboralGrupoFamiliarDetalles()'),"data-toggle":"modal","data-target":"#agregar-familiar-antecedente-laboral-modal","title":"Agregar antecedentes laborales"  ) }}
                                      <span class="ml-3 h6  text-success">Agregar un antecedente laboral</span>

                                    </div>
                            
                                  </div>
                                  <div class="form-group row justify-content-center d-none">
                                    <h6>Folio de referencia de antecedentes de grupo familiar: <span id="agf_id_titulo_agf"> </span></h6>
                                  </div>
  
                                  <input type="hidden" id="agf_id" name="agf_id">
  
                                  <div class="form-group row m-3" id="datoantecedentesgrupofamiliardetalleslistado">
                                  </div>

  
  
                     
                                          <div class="form-group row mt-5">       
                                                <div class="col-lg-3">
                                                  <p class="col-form-label title-busq uppercase">¿Sus padres cuentan con servicio médico?</p>
                                                </div>
        
                                                <div class="col-lg-2">
                                                  <select name="agf_padrescuentan" id="agf_padrescuentan" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
                                                    <optgroup>
                                                      <option value="-1">Seleccionar ...</option>
                                                      <option value="1">SI</option>
                                                      <option value="0">NO</option>
                                                      <option value="2">NO APLICA</option>
                                                    </optgroup>
                                                  </select>                                          
                                                </div>
  
                                                <div class="col-lg-2">                                              
                                                    <label for="estudio_nombre_servicio_medico" oninput="handleInput(event)" class="col-form-label title-busq">   Nombre del servicio</label>
                                                </div>
        
                                                <div class="col-lg-5">
                                                  <input type="text" class="form-control input-rounded" oninput="handleInput(event)" placeholder="Nombre del servicio..." name="agf_padresservicio" id="agf_padresservicio" maxlength="45"/>
                                                </div>
  
                                          </div>
  
                                          <div class="form-group row">       
                                                <div class="col-lg-3">
                                                  <p class="col-form-label title-busq uppercase">¿Su esposo (a) cuenta con servicio médico?</p>
                                                </div>
        
                                                <div class="col-lg-2">
                                                  <select name="agf_conyugecuentan" id="agf_conyugecuentan" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
                                                    <optgroup>
                                                      <option value="-1">Seleccionar ...</option>
                                                      <option value="1">SI</option>
                                                      <option value="0">NO</option>
                                                      <option value="2">NO APLICA</option>
                                                    </optgroup>
                                                  </select>                                          
                                                </div>
                                                <div class="col-lg-2">                                              
                                                  <label for="estudio_nombre_servicio_medico" oninput="handleInput(event)" class="col-form-label title-busq">   Nombre del servicio</label>
                                              </div>
      
                                              <div class="col-lg-5">
                                                <input type="text" class="form-control input-rounded" oninput="handleInput(event)" placeholder="Nombre del servicio..." name="agf_conyugeservicio" id="agf_conyugeservicio"  maxlength="45" />
                                              </div>
  
  
                                      </div>
  
                                      <div class="form-group row">
                                            <div class="col-lg-2">
                                              <p class="col-form-label title-busq ml-2">Notas</p>
                                            </div>
                                            <div class="col-lg-10">
                                              <textarea id="agf_notas" required name="agf_notas" oninput="handleInput(event)" class="form-control-textarea text_area_a" style="min-height:5rem" maxlength="500"></textarea>
                                            </div>
                                        
                                      </div>
  
                
                                        
  
            
  
                                  
                  
  
  
  
                
                         {% if cuarenta==1%}
  
                                    <div class="form-group row d-flex flex-row-reverse" >
                                      <div class="col-lg-4">
                                            <label class="col-form-label title-busq">Calificación</label>
                                            <select name="agf_calificacion" id="agf_calificacion" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
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
                                  <button type="button" class="btn-green btn-rounded btn btn-limpiar" href="" data-toggle="modal" onclick="incidenciaformulario($('#ese_id_ese_actual').text(),6)" data-target="#incidencias-modal" style="background-color: green;">Incidencia<i class="mdi mdi-shield-alert"></i></button>
                                </div>
                              {% endif %}
                            </div>
                            <div class="col-sm-3 col-md-3 text-center mt-5">
                                <div class="form-group">
                                  <button class="btn-dark btn-rounded btn btn-limpiar" class="close" data-dismiss="modal" aria-label="Close">Cancelar</button>
                                </div>
                            </div>
                            <div class="col-sm-3 col-md-3  text-center mt-5 ">
                                <div class="form-group">
                                  <button class="btn-dark btn-rounded btn btn-buscar">Guardar <i class="mdi mdi-content-save white"></i> </button>
                                </div>
                            </div>
                          </div>
  
                      </form>
                </div>
              <!-- FOMULARIO DE ANTECEDENTES LABORALES FIN------------------------------------------------------------------------------------FIN -->
  
  
                 <!-- FOMULARIO DE SITUACION ECONOMICA INCIO------------------------------------------------------------------------------------INCIO -->
                <div class="tab-pane fade borde-inferior-del-sistema content-for-js" id="SeccionSituacionEconomica-md" role="tabpanel" aria-labelledby="contact-tab-md">
                  <form id="form_estudio_seccionSituacionEconomica" class="form-vertical mt-1" method="post">
                              

                                <div class="form-group row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">                  
                                    <div class="container row d-flex justify-content-center">
                              
                                            <p class=" text-white text-center font-weight-bold h6 text-uppercase sin-margen" >
                                              G | SITUACIóN ECONóMICA  <i class="mdi mdi-cash-usd white"></i>
                                            </p>
            
                                    </div>
                                </div>
                                  

                                  <input type="hidden" id="sie_id" name="sie_id">
  
                                  <div class="form-group row text-uppercase d-flex  d-flex justify-content-center">
                                    <div class="">
                                      <h5><span class="text-success">Ingresos </span> mensuales </h5>
                                    </div>
                                  </div>
                                  <div class="row col-lg-12 d-flex  ml-2 ">
                           
                                    <div class="text-left">
                                      {{ link_to('#', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'50', 'onclick':'fnCrearSituacionEconomicaIngresos();'),"data-toggle":"modal","data-target":"#agregar-situacioneconomica-ingreso-modal","title":"Agregar ingreso." ,'id':'' ) }}
                                      <span class="ml-1 h6  text-success">Agregar una referencia de ingreso</span>
                                     </div>
                            
                                  </div>
                                  <div class="form-group row m-3" id="dato_situacioneconomicaingresos_listado">
                                  </div>
                                  <div class="form-group row d-flex justify-content-end">
                                    <div class="col-lg-6">
                                      <label class="col-form-label title-busq" for="estudio_estado_civil">Total de ingresos</label>
                                      <input type="number" class="form-control input-rounded-disabled" placeholder="$00.00" readonly name="sie_totalingresos" id="sie_totalingresos" maxlength="" />

          
                                    </div>
                                  </div>

                                  <div class="form-group row text-uppercase d-flex  d-flex justify-content-center">
                                    <div class="">
                                      <h5> <span class="text-danger">Egresos </span>mensuales </h5>
                                    </div>
                                  </div>
                                  <div class="form-group row ml-1">
                                   
          
                                    <div class="col-lg-3">
                                      <label class="col-form-label title-busq" for="cop_nacimientofecha">Alimentación</label>
                                      <input type="number" class="monto-monto form-control input-rounded" placeholder="$00.00"  oninput="limitDecimalPlaces(event,2)" name="sie_alimentacion" id="sie_alimentacion" maxlength="" />
          
                                    </div>
                                    <div class="col-lg-3">
                                      <label class="col-form-label title-busq" for="estudio_edad">Renta</label>
                                      <input type="number" class="monto-monto form-control input-rounded" placeholder="$00.00"  oninput="limitDecimalPlaces(event,2)"  name="sie_renta" id="sie_renta" maxlength="" />
                                    </div>
                                    
                                    
                                    <div class="col-lg-3">
                                      <label class="col-form-label title-busq" for="estudio_genero">Telefono, luz, agua</label>
                                      <input type="number" class="monto-monto form-control input-rounded" placeholder="$00.00"  oninput="limitDecimalPlaces(event,2)"  name="sie_telluzagua" id="sie_telluzagua" maxlength="" />

                                    </div>
                               
          
                                    <div class="col-lg-3">
                                      <label class="col-form-label title-busq" for="estudio_estado_civil">Transporte</label>
                                      <input type="number" class="monto-monto form-control input-rounded" placeholder="$00.00"   oninput="limitDecimalPlaces(event,2)" name="sie_transporte" id="sie_transporte" maxlength="" />

          
                                    </div>

                                    <div class="col-lg-3">
                                      <label class="col-form-label title-busq" for="estudio_estado_civil">Ropa/calzado</label>
                                      <input type="number" class="monto-monto form-control input-rounded" placeholder="$00.00" oninput="limitDecimalPlaces(event,2)"  name="sie_ropacalzado" id="sie_ropacalzado" maxlength="" />

          
                                    </div>
                                    
                                    <div class="col-lg-3">
                                      <label class="col-form-label title-busq" for="estudio_estado_civil">Escolares</label>
                                      <input type="number" class="monto-monto form-control input-rounded" placeholder="$00.00"  oninput="limitDecimalPlaces(event,2)"  name="sie_escolares" id="sie_escolares" maxlength="" />

          
                                    </div>
                                    <div class="col-lg-3">
                                      <label class="col-form-label title-busq" for="estudio_estado_civil">Servicio doméstico</label>
                                      <input type="number" class="monto-monto form-control input-rounded" placeholder="$00.00"   oninput="limitDecimalPlaces(event,2)" name="sie_serviciodomestico" id="sie_serviciodomestico" maxlength="" />

          
                                    </div>

                                    <div class="col-lg-3">
                                      <label class="col-form-label title-busq" for="estudio_estado_civil">Créditos</label>
                                      <input type="number" class="monto-monto form-control input-rounded-disabled" placeholder="$00.00" readonly   oninput="limitDecimalPlaces(event,2)" name="sie_creditos" id="sie_creditos" maxlength="" />

          
                                    </div>
                                    <div class="col-lg-3">
                                      <label class="col-form-label title-busq" for="estudio_estado_civil">Diversiones</label>
                                      <input type="number" class="monto-monto form-control input-rounded" placeholder="$00.00"  oninput="limitDecimalPlaces(event,2)"  name="sie_diversiones" id="sie_diversiones" maxlength="" />

          
                                    </div>
                                    <div class="col-lg-3">
                                      <label class="col-form-label title-busq" for="estudio_estado_civil">Otros</label>
                                      <input type="number" class="monto-monto form-control input-rounded" placeholder="$00.00"  oninput="limitDecimalPlaces(event,2)" name="sie_otros" id="sie_otros" maxlength="" />

                                      
                                    </div>

                                    <div class="col-lg-6">
                                      <label class="col-form-label title-busq" for="estudio_estado_civil">Total de egresos</label>
                                      <input type="number" class="form-control input-rounded-disabled" placeholder="$00.00" readonly  name="sie_totalegresos" id="sie_totalegresos" maxlength="" />
                                    </div>
          
                                    
          
                                  </div>

                          
  
  
  
                                  <section class="m-3 contorno-del-sistema">
           
  
                                    <div class="pt-5">
  
                                    </div>
  
                                    <div class="from-group row">
                                      <div class="col-lg-2">
                                        <label for="estudio_situacionEconomica_comoSolventaEgregesosMayorAIngresos" class="col-form-label title-busq"> ¿Cuándo los egresos son mayores que los ingresos como los solventa?:</label>
                                      </div>
                                    
                                      <div class="col-lg-10">
                                        <input oninput="handleInput(event)" type="text" class="form-control input-rounded" placeholder="Explicación..." id="sie_solventa" name="sie_solventa" maxlength="100" />
                                      </div>
                                      <div class="col-lg-2">
  
                                          <label for="estudio_situacionEconomica_situacionEnBuro" class="col-form-label title-busq"> Su situación económica ante Buró de créditos es:</label>
                                      
                                      </div>
                                    
                                      <div class="col-lg-5">
                                        <input oninput="handleInput(event)" type="text" class="form-control input-rounded" placeholder="Situación económica es..." id="sie_buro" name="sie_buro" maxlength="45"/>
                                      </div>
  
                                      
                                
                                    </div>

                                    <div class="from-group row">
                                      <div class="col-lg-2">
  
                                          <label for="estudio_situacionEconomica_situacionEnBuro" class="col-form-label title-busq ">En caso negativo, ¿con qué institución?:</label>
                                      
                                      </div>
                                    
                                      <div class="col-lg-5">
                                        <input type="text" class="form-control input-rounded" placeholder="Nombre de la institución..." id="sie_institucion" name="sie_institucion" oninput="handleInput(event)"  maxlength="45"/>
                                      </div>
  
                              
                                    </div>
                              </section>
                              
                              <!-- CREDITOS VIGENTES  INCIO-->
                                  
                                  <div class="form-group row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">                  
                              
                                            <p class=" text-white text-center font-weight-bold h6 text-uppercase" >
                                              Créditos vigentes <i class="mdi mdi-square-inc-cash white"></i>
                                            </p>
            
                                  
                                </div>
                                  <div class="row col-lg-12 d-flex  ml-2 ">
                           
                                    <div class="text-left">
                                      {{ link_to('#', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'50' , 'onclick':'fnCrearSituacionEconomicaCreditos();'),"data-toggle":"modal","data-target":"#agregar-situacioneconomica-credito-modal","title":"Agregar créditos vigentes." ,'id':'' ) }}
                                      <span class="ml-1 h5  text-success">Agregar un crédito vigente</span>
                                     </div>
                            
                                  </div>

                                  <div class="form-group row m-3" id="dato_situacioneconomicacredito_listado">
                                  </div>
                                  
                                  <section class="m-3 contorno-del-sistema" >
                                             
                            
                            
                                            
  
                                                    {% if cuarenta==1%}
  
                                                      <div class="form-group row d-flex flex-row-reverse">
                                                              <div class="col-lg-4">
                                                                    <label class="col-form-label title-busq">Calificación</label>
                                                                    <select name="sie_calificacion" id="sie_calificacion" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
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
  
                               <!-- CREDITOS VIGENTES  FIN-->
                             
                                  
                             <div class="row col-lg-12">
                              <div class="col-sm-3 col-md-3 text-center mt-5">
                              </div>                          
                              <div class="col-sm-3 col-md-3 text-center mt-5">
                                {% if cuarentayseis==1%}
                                  <div class="form-group">
                                    <button type="button" class="btn-green btn-rounded btn btn-limpiar" href="" data-toggle="modal" onclick="incidenciaformulario($('#ese_id_ese_actual').text(),7)" data-target="#incidencias-modal" style="background-color: green;">Incidencia<i class="mdi mdi-shield-alert"></i></button>
                                  </div>
                                {% endif %}
                              </div>
                              <div class="col-sm-3 col-md-3 text-center mt-5">
                                  <div class="form-group">
                                    <button class="btn-dark btn-rounded btn btn-limpiar" class="close" data-dismiss="modal" aria-label="Close">Cancelar</button>
                                  </div>
                              </div>
                              <div class="col-sm-3 col-md-3  text-center mt-5 ">
                                  <div class="form-group">
                                    <button class="btn-dark btn-rounded btn btn-buscar" type="submit">Guardar <i class="mdi mdi-content-save white"></i> </button>
                                  </div>
                              </div>
                            </div>
                             
                  </form> 
                </div>
                <!-- FOMULARIO DE SITUACION ECONOMICA FIN------------------------------------------------------------------------------------FIN -->
  
  
  
                <!-- FOMULARIO DE BIENES INMUEBLES INCIO------------------------------------------------------------------------------------INICIO-------- -->
  
                <div class="tab-pane fade borde-inferior-del-sistema" id="SeccionBienesInmuebles-md" role="tabpanel" aria-labelledby="contact-tab-md">
                  <form id="form_estudio_seccionBienesInmuebles" class="form-vertical mt-1">


                    <div class="form-group  row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">                  
                          <div class="container ">
                    
                                  <p class=" text-white text-center font-weight-bold h6 sin-margen" >
                                    H |  BIENES INMUEBLES <i class="mdi mdi-office-building white"></i>
                                  </p>

                          </div>
                    </div>
  
  
                                    <!-- <div class="form-group row mt-3 mb-3 mr-3 ml-3 ">
                                      <p class="text-gray font-weight-bold">
                                        A continuación deberá especificar los datos relacionados con las personas que pertenecen al sistema familiar, así como los datos del cónyuge e hijos, únicamente en caso de que se encuentren laborando.
                                      </p>
                                   </div> -->
  
                                    <div class="row col-lg-12 d-flex ">
                                     
                                      <div class="ml-2">
                                        {{ link_to('#', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'50' , 'onclick':'fnCrearBienInmuebleDetalles();'),"data-toggle":"modal","data-target":"#agregar-bieninmuebledetalles-modal","title":"Agregar." ,'id':'' ) }}



                                      </div>
                                      <h6 class="text-success">Agregar bien inmueble</h6>
                              
                                    </div>
                                    
                                    <div class="form-group row m-3" id="dato_bieninmuebledetalles_listado">
                                    </div>

                                    <div class="form-group row m-2">
                                      <div class="col-lg-2">
                                        <p class="col-form-label title-busq ml-2">Notas</p>
                                      </div>
                                      <div class="col-lg-10">
                                        <textarea id="bie_notasfamiliares"  name="bie_notasfamiliares" oninput="handleInput(event)" class="form-control-textarea text_area_a" style="min-height:5rem" placeholder="Comentarios de los bienes inmuebles del candidato"></textarea>
                                      </div>
                                      
                                  </div>    
  
                                    <section class="m-3">
  
                                                         
                              
              
                              

  
                                                        
                                                    <div class="form-group row">
                                                            <div class="col-lg-2">
                                                              <p class="col-form-label title-busq uppercase">Servicio de la zona</p>
                                  
  
                                                            </div>
                                                            <div class="col-lg-2">
                                                              <input type="hidden" name="bie_id" id="bie_id">
                                                                    <label class="col-form-label title-busq text-uppercase " for="bie_agua">Agua</label>
                                                                    <select  name="bie_agua" id="bie_agua" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                                                      <optgroup>
                                                                        <option value="-1">Seleccionar ...</option>
                                                                        <option value="1">Si</option>
                                                                        <option value="0">No</option>
                                                                      </optgroup>
                                                                    </select>
                                                            </div>
                                                            <div class="col-lg-2">
                                                              <label class="col-form-label title-busq text-uppercase " for="bie_drenaje">Drenaje</label>
                                                              <select  name="bie_drenaje" id="bie_drenaje" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                                                <optgroup>
                                                                  <option value="-1">Seleccionar ...</option>
                                                                  <option value="1">Si</option>
                                                                  <option value="0">No</option>
                                                                </optgroup>
                                                              </select>
                                                              </div>
  
                                                              <div class="col-lg-2">
                                                                <label class="col-form-label title-busq text-uppercase " for="bie_pavimento">Pavimento</label>
                                                                <select  name="bie_pavimento" id="bie_pavimento" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                                                  <optgroup>
                                                                    <option value="-1">Seleccionar ...</option>
                                                                    <option value="1">Si</option>
                                                                    <option value="0">No</option>
                                                                  </optgroup>
                                                                </select>
                                                              </div>
  
  
                                                              <div class="col-lg-2">
                                                                <label class="col-form-label title-busq text-uppercase ">Electricidad</label>
                                                                <select  name="bie_electricidad" id="bie_electricidad" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                                                  <optgroup>
                                                                    <option value="-1">Seleccionar ...</option>
                                                                    <option value="1">Si</option>
                                                                    <option value="0">No</option>
                                                                  </optgroup>
                                                                </select>
                                                              </div>
                                                              <div class="col-lg-2">
                                                                <label class="col-form-label title-busq text-uppercase ">Escuelas</label>
                                                                <select  name="bie_escuela" id="bie_escuela" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                                                  <optgroup>
                                                                    <option value="-1">Seleccionar ...</option>
                                                                    <option value="1">Si</option>
                                                                    <option value="0">No</option>
                                                                  </optgroup>
                                                                </select>
                                                              </div>
    
  
  
                                                    </div>
                              
                                                    <div class="form-group row">
                                                   
                                                            <div class="col-lg-3">
                                                                    <label class="col-form-label title-busq text-uppercase ">Nivel</label>
                                                                    <select  name="bie_nivelzona" id="bie_nivelzona" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                                                      <optgroup>
                                                                        <option value="-1">Seleccionar ...</option>
                                                                        <option value="1">Alto</option>
                                                                        <option value="2">Medio alto</option>
                                                                        <option value="2">Medio </option>
                                                                        <option value="3">Medio bajo</option>
                                                                        <option value="4">Bajo</option>
  
                                                                      </optgroup>
                                                                    </select>
                                                            </div>

                                                            <div class="col-lg-3">
                                                                <label class="col-form-label title-busq text-uppercase ">Tipo</label>
                                                                <select  name="bie_tipo" id="bie_tipo" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                                                  <optgroup>
                                                                    <option value="-1">Seleccionar ...</option>
                                                                    <option value="1">Casa sola</option>
                                                                    <option value="2">Duplex</option>
                                                                    <option value="3">DEPTO</option>
                                                                    <option value="4">Condominio </option>
                                                                    <option value="5">Otro</option>
    
                                                                  </optgroup>
                                                                </select>
                                                            </div>

                                                            <div class="col-lg-3">
                                                              <label class="col-form-label title-busq text-uppercase ">Régimen</label>
                                                              <select  name="bie_regimen" id="bie_regimen" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                                                      <optgroup>
                                                                        <option value="-1">Seleccionar ...</option>
                                                                        <option value="1">Propia</option>
                                                                         <option value="2">Rentada</option>
                                                                        <option value="3">Hipotecaria</option>
                                                                        <option value="4">Prestada </option>
                                                                         <option value="5">Provisional</option>

                                                                      </optgroup>
                                                                </select>
                                                            </div>  
                                                            <div class="col-lg-3">
                                                              <label class="col-form-label title-busq text-uppercase ">Mobiliario</label>
                                                              <select  name="bie_mobilario" id="bie_mobilario" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                                                <optgroup>
                                                                  <option value="-1">Seleccionar ...</option>
                                                                  <option value="1">Excelente</option>
                                                                  <option value="2">Bueno </option>
                                                                  <option value="3">Regular</option>
                                                                  <option value="4">Malo</option>
                                                                  <option value="5">Deficiente</option>

                                                                </optgroup>
                                                              </select>
                                                      </div>



                                                            
  
  
                                                     </div>
  
                                                     
  
                                                     
                                                     
                                           
  
  
             
  
                                                     

  
                                               <div class="form-group row">
                                                <div class="col-lg-2">
                                                  <p class="col-form-label title-busq uppercase">Distribución</p>
                      
  
                                                </div>
                                                <div class="col-lg-2">
                                                        <label for="estudio_bienesinmuebles_distribucion_recamaras" class="col-form-label title-busq text-uppercase ">Recámaras</label>
                                                        <input type="text" class="form-control input-rounded" oninput="handleInput(event)"  placeholder="Número..."  name="bie_recamaras" id="bie_recamaras" maxlength="2"/>
  
                                                    
                                                </div>
                                                <div class="col-lg-2">
                                                  <label  for="estudio_bienesinmuebles_distribucion_banos" class="col-form-label title-busq text-uppercase ">Baños</label>
                                                  <input type="text" class="form-control input-rounded" oninput="handleInput(event);"  placeholder="Número de baños..."  name="bie_banos" id="bie_banos" maxlength="2"/>
  
  
                                                  </div>
  
                                                  <div class="col-lg-2">
                                                    <label for="estudio_bienesinmuebles_distribucion_sala" class="col-form-label title-busq text-uppercase ">Sala</label>
                                                    <input type="text" class="form-control input-rounded" oninput="handleInput(event);"  placeholder="Número de salas..."  name="bie_sala" id="bie_sala" maxlength="2"/>
  
                                                   
                                                  </div>
  
  
                                                  <div class="col-lg-2">
                                                    <label for="estudio_bienesinmuebles_distribucion_comedor"  class="col-form-label title-busq text-uppercase ">Comedor</label>
                                                    <input type="text" class="form-control input-rounded"  oninput="handleInput(event);" placeholder="Número..."  name="bie_comedor" id="bie_comedor" maxlength="2"/>
  
            
                                                  </div>
                                                  <div class="col-lg-2">
                                                    <label for="estudio_bienesinmuebles_distribucion_garaje" class="col-form-label title-busq text-uppercase ">Garaje</label>
                                                    <input type="text" class="form-control input-rounded" oninput="handleInput(event);"  placeholder="Número..."  name="bie_garaje" id="bie_garaje" maxlength="2"/>
  
                                                    
                                                  </div>
  
  
  
                                               </div>
  
                                               <div class="form-group row">
                                                <div class="col-lg-2">
                                                  <p class="col-form-label title-busq uppercase">Tiempo de habitar el inmueble</p>
                      
  
                                                </div>
                                                <div class="col-lg-2">
                                                        <label for="estudio_bienesinmuebles_tiempo_habilitar_inmueble_anios" class="col-form-label title-busq text-uppercase ">Años</label>
                                                        <input type="number" maxlength="2" class="form-control input-rounded"  oninput="soloNumeroPositivos(event);"  onblur="maxLenghtNumeros(event,2)"placeholder="Número..."  name="bie_habitaranos" id="bie_habitaranos"/>
  
                                                    
                                                </div>
                                                <div class="col-lg-2">
                                                  <label for="estudio_bienesinmuebles_tiempo_habilitar_inmueble_meses" class="col-form-label title-busq text-uppercase ">Meses</label>
                                                  <input type="number" maxlength="2" class="form-control input-rounded" oninput="soloNumeroPositivos(event);"  onblur="maxLenghtNumeros(event,2)" placeholder="Número..."  name="bie_habitarmeses" id="bie_habitarmeses"/>
  
  
                                                  </div>
                                               </div>
                                               <div class="form-group row mt-3  ">
                                                      <label for="bie_domicilioanterior" class="col-form-label title-busq text-uppercase ">Si el tiempo de habitar el domicilio es de 12 meses o menor, favor de anotar el domicilio anterior.</label>
                                              </div>
  
                                              <div class="form-group row">
                                                        <div class="col-lg-12">
                                                                <input type="text" class="form-control input-rounded" oninput="handleInput(event);"  placeholder="Domicilio anterior..." maxlength="150"  name="bie_domicilioanterior" id="bie_domicilioanterior"/>
                                                        </div>
  
                                                 
  
                                               </div>
  
  
                        
                              
  
  
                                                    <div class="form-group row">
                                                          <div class="col-lg-2">
                                                            <p class="col-form-label title-busq ml-2">Notas</p>
                                                          </div>
                                                          <div class="col-lg-10">
                                                            <textarea id="bie_notasvivienda"  name="bie_notasvivienda" oninput="handleInput(event)" class="form-control-textarea text_area_a" style="min-height:5rem" placeholder="Describe como es la vivienda..."></textarea>
                                                          </div>
                                                      
                                                    </div>    
                                                
                                                    {% if cuarenta==1%}
                   
                                                    <div class="form-group row d-flex flex-row-reverse">
                                                      <div class="col-lg-4">
                                                            <label class="col-form-label title-busq text-uppercase ">Calificación</label>
                                                            <select  name="bie_calificacion" id="bie_calificacion" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
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
                                      <button type="button" class="btn-green btn-rounded btn btn-limpiar" href="" data-toggle="modal" onclick="incidenciaformulario($('#ese_id_ese_actual').text(),8)" data-target="#incidencias-modal" style="background-color: green;">Incidencia<i class="mdi mdi-shield-alert"></i></button>
                                    </div>
                                  {% endif %}
                                </div>
                                <div class="col-sm-3 col-md-3 text-center mt-5">
                                    <div class="form-group">
                                      <button class="btn-dark btn-rounded btn btn-limpiar" class="close" data-dismiss="modal" aria-label="Close">Cancelar</button>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-md-3  text-center mt-5 ">
                                    <div class="form-group">
                                      <button class="btn-dark btn-rounded btn btn-buscar">Guardar <i class="mdi mdi-content-save white"></i> </button>
                                    </div>
                                </div>
                              </div>
  
                          </form> 
                </div>
  
                <!-- FOMULARIO DE BIENES INMUEBLES FIN------------------------------------------------------------------------------------FIN -->
  
                
  
  
  
                
                <!-- FOMULARIO DE REFERENCIAS PERSONALES INCICIO------------------------------------------------------------------------------------INCIO-->
                <div class="tab-pane fade borde-inferior-del-sistema" id="SeccionReferenciasPersonales-md" role="tabpanel" aria-labelledby="contact-tab-md">
                  <form id="form_estudio_seccionReferenciasPersonales" class="form-vertical mt-1">
                                 

                                  <div class="form-group row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">                  
                                        <div class="container ">
                                  
                                                <p class=" text-white text-center font-weight-bold h6 text-uppercase sin-margen" >
                                                  I | Referencias personales <i class="mdi mdi-nature-people white"></i>
                                                </p>
              
                                        </div>
                                  </div>
                
                                                             <div class="form-group row mt-3 mb-3 d-flex justify-content-center">
                                                                    <p class="text-danger h6 font-weight-bold uppercase">
                                                                      QUE NO SEAN PARIENTES, NI JEFES DE EMPLEOS ANTERIORES
                                                                    </p>
                                                              </div>
   
                                                              
                  <section class="m-3">
  
                    <div class="row col-lg-12 d-flex ml-2 ">
                  
                                       
                          <div class="text-left">
                            {{ link_to('#', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'50' , 'onclick':'fnCrearReferenciaPersonal();'),"data-toggle":"modal","data-target":"#agregar-referenciapersonal-modal","title":"Agregar." ,'id':'' ) }}

                          </div>
                  
                  
                    </div>
                    <input type="hidden" class="form-control input-rounded" oninput=""  placeholder="" maxlength=""  name="sep_id" id="sep_id"/>


                    <div class="form-group row m-3" id="dato_referenciapersonal_listado">
                    </div>
                  
  
  
                                                                
                                      
                                                        
  
  
                    </section>
  
  
  

                    
                    <div class="form-group  row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">                  
                      <div class="container ">
                
                              <p class=" text-white text-center font-weight-bold h6 sin-margen" >
                                I | Referencias vecinales <i class="mdi mdi-home-city-outline white"></i>
                              </p>

                      </div>
                 </div>
  
                    <div class="row col-lg-12 d-flex ml-4 ">
                  
                                       
                            <div class="text-left">
                              {{ link_to('#', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'50' , 'onclick':'fnCrearReferenciaVecinal();'),"data-toggle":"modal","data-target":"#agregar-referenciavecinal-modal","title":"Agregar." ,'id':'' ) }}

                            </div>
              
              
                     </div>
  
                     <div class="form-group row m-3" id="dato_referenciavecinal_listado">
                    </div>
  
               
  
  
              
  
           
  
      
                      
  
        
  
       
  
       
                        
                      
  
  
                    {% if cuarenta==1%}
                   
                    <div class="form-group row d-flex flex-row-reverse">
                      <div class="col-lg-4">
                            <label class="col-form-label title-busq text-uppercase ">Calificación</label>
                            <select  name="sep_calificacion" id="sep_calificacion" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
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
 
  
 
  

  
  
  
                        <div class="row col-lg-12">
                          <div class="col-sm-3 col-md-3 text-center mt-5">
                          </div>                          
                          <div class="col-sm-3 col-md-3 text-center mt-5">
                            {% if cuarentayseis==1%}
                              <div class="form-group">
                                <button type="button" class="btn-green btn-rounded btn btn-limpiar" href="" data-toggle="modal" onclick="incidenciaformulario($('#ese_id_ese_actual').text(),9)" data-target="#incidencias-modal" style="background-color: green;">Incidencia<i class="mdi mdi-shield-alert"></i></button>
                              </div>
                            {% endif %}
                          </div>
                          <div class="col-sm-3 col-md-3 text-center mt-5">
                              <div class="form-group">
                                <button class="btn-dark btn-rounded btn btn-limpiar" class="close" data-dismiss="modal" aria-label="Close">Cancelar</button>
                              </div>
                          </div>
                          <div class="col-sm-3 col-md-3  text-center mt-5 ">
                              <div class="form-group">
                                <button class="btn-dark btn-rounded btn btn-buscar">Guardar <i class="mdi mdi-content-save white"></i> </button>
                              </div>
                          </div>
                        </div>
  
                      </form> 
                </div>
                
                <!-- FOMULARIO DE CREDITOS VIGENTES FIN------------------------------------------------------------------------------------FIN -->
  
                <div class="tab-pane fade borde-inferior-del-sistema" id="SeccionReferenciasLaborales-md" role="tabpanel" aria-labelledby="contact-tab-md">
                  <form id="form_estudio_seccionReferenciasLaborales" class="form-vertical mt-1">
                  
                    <div class="form-group row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">                  
                      <div class="container ">
                
                              <p class=" text-white text-center font-weight-bold h6 text-uppercase sin-margen" >
                                J | Referencias laborales <i class="mdi mdi-nature-people white"></i>
                              </p>

                      </div>
                    </div>
                    <!-- <div class="form-group row mt-3 mb-3 d-flex justify-content-center">
                          <p class="text-danger font-weight-bold uppercase">
                            Que no sean de parientes, ni de empleos anteriores
                          </p>
                    </div> -->
                    <input type="hidden" id="sel_id" name="sel_id">

                    <div class="row col-lg-12 d-flex ml-3 ">
                      <div class="">
                        {{ link_to('#', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'50' , 'onclick':'fnCrearReferenciaLaboral()'),"data-toggle":"modal","data-target":"#agregar-referencialaboral-modal","title":"Agregar."  ) }}
                      </div>
                    </div>


                    <div class="form-group row m-3" id="dato_referencialaboral_listado">
                    </div>
                 

                    <div class="form-group row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">                  
                      <div class="container ">
                
                        <center>
                          <p class=" text-white text-center font-weight-bold h6 text-uppercase"  >
                            J | Periodos de inactividad <i class="mdi mdi-bed-double white"></i>
                          </p>
                        </center>
                            

                      </div>
                    </div>
                    <div class="row col-lg-12 d-flex ml-3 ">
                      <div class="text-left">
                        {{ link_to('#', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'50', 'onclick':'fnCrearPeriodoInactivo()'),"data-toggle":"modal","data-target":"#agregar-periodoinactivo-modal","title":"Agregar periodo de inactividad" ,'id':'agregar_periodo_inactividad' ) }}
                      </div>
                    </div>

                    <div class="form-group row m-3" id="dato_periodoinactivo_listado">
                    </div>
                 
       
                    <section class="mt-3">
                      <div class="form-group row">
                        <div class="col-lg-2">
                          <p class="col-form-label title-busq ml-2">Observaciones finales</p>
                        </div>
                        <div class="col-lg-10">
                          <textarea id="sel_notas" required name="sel_notas" oninput="handleInput(event)" class="form-control-textarea text_area_a" style="min-height:5rem" placeholder="Observaciones..."></textarea>
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-lg-2">
                          <p class="col-form-label title-busq ml-2">Empleos ocultos</p>
                        </div>
                        <div class="col-lg-4">
                          <select  name="sel_empleosocultos" id="sel_empleosocultos" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                            <optgroup>
                              <option value="-1">Seleccionar ...</option>
                              <option value="1">1.-SI</option>
                              <option value="0">2.-NO</option>
                            </optgroup>
                          </select>
                        </div>
                      </div>

                      {% if cuarenta==1%}
                        <div class="form-group row d-flex flex-row-reverse">
                          <div class="col-lg-4">
                            <label class="col-form-label title-busq text-uppercase ">Calificación</label>
                            <select  name="sel_calificacion" id="sel_calificacion" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
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
                            <button type="button" class="btn-green btn-rounded btn btn-limpiar" href="" data-toggle="modal" onclick="incidenciaformulario($('#ese_id_ese_actual').text(),10)" data-target="#incidencias-modal" style="background-color: green;">Incidencia<i class="mdi mdi-shield-alert"></i></button>
                          </div>
                        {% endif %}
                      </div>
                      <div class="col-sm-3 col-md-3 text-center mt-5">
                          <div class="form-group">
                            <button class="btn-dark btn-rounded btn btn-limpiar" class="close" data-dismiss="modal" aria-label="Close">Cancelar</button>
                          </div>
                      </div>
                      <div class="col-sm-3 col-md-3  text-center mt-5 ">
                          <div class="form-group">
                            <button class="btn-dark btn-rounded btn btn-buscar">Guardar <i class="mdi mdi-content-save white"></i> </button>
                          </div>
                      </div>
                    </div>
                  </form> 
                </div>

                <!-- INICIO FORMULARIO DATOS FINALES --->
                <div class="tab-pane fade borde-inferior-del-sistema content-for-js" id="SeccionDatosFinales-md" role="tabpanel" aria-labelledby="profile-tab-md">
                  <form id="form_estudio_seccionDatosFinales" class=" form-vertical mt-1 ">
                    
                    <div class="form-group row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">                  
                      <div class="container ">
                
                              <p class=" text-white text-center font-weight-bold h6 sin-margen" >
                                DATOS FINALES  <i class="mdi mdi-school white"></i>
                              </p>

                      </div>
                    </div>
                    <section class="m-3 contorno-del-sistema">
                      <div class="form-group row">
                        <div class="col-lg-2">
                          <label for="daf_notafinal" class="col-form-label title-busq ml-2">Observaciones finales</label>
                        </div>
                        <div class="col-lg-10">
                          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Observaciones finales..."  name="daf_notafinal" id="daf_notafinal" maxlength="150"/>
                        </div>
                      </div>
                      <div class="form-group row d-flex flex-row-reverse d-block ">
                        <div class="col-lg-4">
                          <label class="col-form-label title-busq">Calificación propuesta</label>
                          <select name="daf_calificacion" id="daf_calificacion" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
                            <optgroup>
                              <option value="-1">SELECCIONAR ...</option>
                              <option value="1">1.-APTO</option>
                              <option value="2">2.-NO APTO</option>
                              <option value="3">3.-APTO CON RESERVAS</option>
                            </optgroup>
                          </select>
                        </div>
                      </div>
                    </section>
                    <div class="row col-lg-12">
                      <div class="col-sm-6 col-md-6 text-center mt-5">
                      </div>
                      <div class="col-sm-3 col-md-3 text-center mt-5">
                        <div class="form-group">
                          <button class="btn-dark btn-rounded btn btn-limpiar" class="close" data-dismiss="modal" aria-label="Close">Cancelar</button>
                        </div>
                      </div>
                      <div class="col-sm-3 col-md-3  text-center mt-5 ">
                        <div class="form-group">
                          <button class="btn-dark btn-rounded btn btn-buscar">Guardar <i class="mdi mdi-content-save white"></i> </button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>

                <!-- FIN FORMULARIO DATOS FINALES --->

              </div>
    
            </section>
            
  
  
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <script>

    function limpiarActive(array_header,backgroundHeaderActive,timeAnimation,index_set)
    {
      let index_select= parseInt(index_set);
      for (let index = 0; index < array_header.length; index++) {
          if(index==index_select)
          {
            array_header[index].style.background=backgroundHeaderActive;
                    array_header[index].style.color='white';
                    array_header[index].style.fontWeight ='bold';
                    array_header[index].style.padding ='8px';
                    array_header[index].style.transitionDuration=timeAnimation;
          }
          else{

            array_header[index].style.background='';
                                    array_header[index].style.color='gray';
                                    array_header[index].style.fontWeight ='normal';
                                    array_header[index].style.padding ='8px';
          }
  
              
        }  
    }

    function pintarYDespintarHeader(array_header,backgroundHeaderActive,timeAnimation)
    {
        for (let index = 0; index < array_header.length; index++) {
            array_header[index].addEventListener('click',()=>{
                    array_header[index].style.background=backgroundHeaderActive;
                    array_header[index].style.color='white';
                    array_header[index].style.fontWeight ='bold';
                    array_header[index].style.padding ='8px';
                    array_header[index].style.transitionDuration=timeAnimation;
                            for (let index2 = 0; index2 < array_header.length; index2++) {
                                  if(index!=index2)
                                  {
                                    array_header[index2].style.background='';
                                    array_header[index2].style.color='gray';
                                    array_header[index2].style.fontWeight ='normal';
                                    array_header[index2].style.padding ='8px';
  
                        
                                  }
                            
                            }
  
              });
        }  
    }
   
    
  $( document ).ready(function() {
    let contents =document.getElementsByClassName('content-for-js');
    let headers =document.getElementsByClassName('class-for-header');
    headers[0].style.background='#16345e';
                  headers[0].style.color='white';
                  headers[0].style.fontWeight ='bold';
                  headers[0].style.padding ='15px';
  
    pintarYDespintarHeader(headers,'#16345e','.9s');      
  
  
       
  
  
  });
  
  
  </script>

  <!-- Js de situacion economica inicio -->
  <script>
 

   let monto_monto =document.querySelectorAll('.monto-monto');
   for (let index = 0; index < monto_monto.length; index++) {
        
    monto_monto[index].addEventListener('keyup',()=>{
          let sum = 0;
              for (let index2 = 0; index2 <monto_monto.length; index2++) {
                    if(monto_monto[index2].value!='')
                    {
                      if(monto_monto[index2].value>=0)
                      {
                        sum +=parseFloat(monto_monto[index2].value);
  
                      }
                      else
                      {
                        monto_monto[index2].value=0;
                      }
                    }
              } 
            document.getElementById('sie_totalegresos').value=sum; 
              
          
        }); 
  
  }
  
      
  </script>
  <!-- Js de situacion economica fin->
  
  
  <!-- bienes inmuebles -->

  <!-- bienes inmuebles fin-->
  

  
  
  <!-- Estuudio completo fin-----------------------------------------------------fin -->
  
  
  <!-- VER TODO EL ESE FIN -->

<!-- selelets dinamicos incio -->

{% include "/nivelestudio/script-ajax-todos.volt" %}
{% include "/estadocivil/script-ajax-todos.volt" %}
{% include "/estado/script-ajax-todos.volt" %}
{% include "/municipio/script-ajax-todos.volt" %}
{% include "/estado/script-ajax-get-uno.volt" %}
{% include "/municipio/script-ajax-get-uno.volt" %}
<!-- selelets dinamicos final -->


<!-- script para cargar y guardar datos del estudio de la seccion A-->

{% include "/datocomprobatorio/script-ajax-especifico.volt" %}
{% include "/datocomprobatorio/script-ajax-get-especifico.volt" %}
{% include "/datocomprobatorio/script-ajax-set-update.volt" %}

<!-- script para cargar y guardar datos del estudio de la seccion A-->

<!-- script para cargar y guardar datos del estudio de la seccion B-->

{% include "/datoescolar/detalles.volt" %}

<!-- script para cargar y guardar datos del estudio de la seccion B-->

<!-- script para cargar y guardar datos del estudio de la seccion C-->

{% include "/antecedentesocial/detalles.volt" %}

<!-- script para cargar y guardar datos del estudio de la seccion C-->

<!-- script para cargar y guardar datos del estudio de la seccion D-->

{% include "/estadosalud/detalles.volt" %}

<!-- script para cargar y guardar datos del estudio de la seccion D-->


<!-- script para cargar y guardar datos de la seccion E  -->
{% include "/datogrupofamiliar/script-ajax-get-detalle.volt" %}
{% include "/datogrupofamiliar/script-ajax-set-update.volt" %}
{% include "/datogrupofamiliar/tabla-modal.volt" %}

<!-- script para cargar y guardar datos de la seccion E  -->


<!-- script para cargar y guardar los datos de la sección F incio -->
{% include "/antecedentegrupofamiliar/script-ajax-get-detalle.volt" %}
{% include "/antecedentegrupofamiliar/script-ajax-set-update.volt" %}
{% include "/antecedentegrupofamiliar/tabla-modal.volt" %}
<!-- script para cargar y guardar los datos de la sección F fin -->


<!-- script para cargar y guardar los datos de la sección G incio -->
{% include "/situacioneconomica/script-ajax-get-detalle.volt" %}
{% include "/situacioneconomica/script-ajax-set-update.volt" %}

<!-- ingresos -->
  {% include "/situacioneconomicaingresos/tabla-modal.volt" %}
<!-- inpuests -->
{% include "/situacioneconomicacredito/tabla-modal.volt" %}

<!-- script para cargar y guardar los datos de la sección G fin -->




<!-- script para cargar y guardar los datos de la sección H incio -->
{% include "/bieninmueble/script-ajax-get-detalle.volt" %}
{% include "/bieninmueble/script-ajax-set-update.volt" %}

{% include "/bieninmuebledetalles/tabla-modal.volt" %}

<!-- script para cargar y guardar los datos de la sección H fin -->

<!-- script para cargar y guardar los datos de la sección H incio -->
{% include "/seccionpersonal/script-ajax-get-detalle.volt" %}

{% include "/seccionpersonal/script-ajax-set-update.volt" %}

{% include "/referenciavecinal/tabla-modal.volt" %}
{% include "/referenciapersonal/tabla-modal.volt" %}



<!-- script para cargar y guardar los datos de la sección H fin -->

<!-- script para cargar y guardar datos del estudio de la seccion J incio-->
{% include "/seccionlaboral/script-ajax-get-detalle.volt" %}

{% include "/seccionlaboral/script-ajax-set-update.volt" %}

{% include "/referencialaboral/tabla-modal.volt" %}
{% include "/periodoinactivo/tabla-modal.volt" %}


<!-- script para cargar y guardar datos del estudio de la seccion J fin-->



<!-- script para cargar y guardar datos del estudio de la seccion datos finales-->

{% include "/datofinal/detalles.volt" %}

<!-- script para cargar y guardar datos del estudio de la seccion datos finales-->



<script type="text/javascript">



      //esta funcion nos sirve para cargar datos  basicos para todos los formularios
       function cargarDatosSeccion_A_ESES(ese_id)
        {
          //limpiamos todos los fomularios
          let form_seccionA=document.getElementById('form_estudio_seccionDatosPersonales');
          form_seccionA.reset();
          fnestudioespecifico(ese_id);
        } 
        function cargarDatosSeccion_B_ESES(ese_id)
        {
          let headers =document.getElementsByClassName('class-for-header');
          limpiarActive(headers,'#16345e','.9s',1);

          let form_seccionB=document.getElementById('form_estudio_seccionDatosEscolares');
          form_seccionB.reset();
          $('#dae_primariacertificado').val('-1');
          $('#dae_primariacertificado').trigger('change');

          $('#dae_secundariacertificado').val('-1');
          $('#dae_secundariacertificado').trigger('change');

          $('#dae_comercialcertificado').val('-1');
          $('#dae_comercialcertificado').trigger('change');

          $('#dae_preparatoriacertificado').val('-1');
          $('#dae_preparatoriacertificado').trigger('change');

          $('#dae_licenciaturacertificado').val('-1');
          $('#dae_licenciaturacertificado').trigger('change');

          $('#dae_cedulacertificado').val('-1');
          $('#dae_cedulacertificado').trigger('change');

          $('#dae_otrocertificado').val('-1');
          $('#dae_otrocertificado').trigger('change');

          $('#dae_actualcertificado').val('-1');
          $('#dae_actualcertificado').trigger('change');

          fnDatosEscolaresDetalle(ese_id);
        }

        function cargarDatosSeccion_C_ESES(ese_id)
        {
          
          let headers =document.getElementsByClassName('class-for-header');
          limpiarActive(headers,'#16345e','.9s',2);

          let form_seccionC=document.getElementById('form_estudio_seccionAntecedenteSocial');
          form_seccionC.reset();
          $('#ans_clubdeportivo').val('-1');
          $('#ans_clubdeportivo').trigger('change');

          $('#ans_puestosindical').val('-1');
          $('#ans_puestosindical').trigger('change');

          $('#ans_politico').val('-1');
          $('#ans_politico').trigger('change');

          $('#ans_bebida').val('-1');
          $('#ans_bebida').trigger('change');

          $('#ans_fumar').val('-1');
          $('#ans_fumar').trigger('change');

          $('#ans_calificacion').val('-1');
          $('#ans_calificacion').trigger('change');

          // $('#dae_actualcertificado').val('-1');
          // $('#dae_actualcertificado').trigger('change');

          fnAntecedenteSocialDetalle(ese_id);
        }

    
        function cargarDatosSeccion_D(ese_id)
        {
          let headers =document.getElementsByClassName('class-for-header');
          limpiarActive(headers,'#16345e','.9s',3);
          let form_seccionD=document.getElementById('form_estudio_seccionEstadoGeneralDeSalud');
          form_seccionD.reset();

          $('#ess_calificacion').val('-1');
          $('#ess_calificacion').trigger('change');

          fnEstadoSaludDetalle(ese_id);
        }


        function cargarDatosSeccion_E_ESES(ese_id)
        {
          let headers =document.getElementsByClassName('class-for-header');
          limpiarActive(headers,'#16345e','.9s',4);

          fnCargarDatosDelFormularioE(ese_id,$('#dgf_matrimoniopadres'),'dgf_calificacion','aqui_boton_detalles_grupo_familiar');
          $('#dgf_calificacion').val('-1');
          $('#dgf_calificacion').trigger('change');
          $('#aqui_boton_detalles_grupo_familiar').empty();
        }

        function cargarDatosSeccion_F_ESES(ese_id)
        {

          let headers =document.getElementsByClassName('class-for-header');
          limpiarActive(headers,'#16345e','.9s',5);

           fnCargarDatosDelFormularioF(ese_id,'agf_padrescuentan','agf_padresservicio','agf_conyugecuentan','agf_conyugeservicio','agf_notas','agf_calificacion','agf_id' );
         
           $('#agf_padrescuentan').val('-1');
           $('#agf_padrescuentan').trigger('change');

           $('#agf_conyugecuentan').val('-1');
           $('#agf_conyugecuentan').trigger('change');


           $('#agf_calificacion').val('-1');
           $('#agf_calificacion').trigger('change');
         
        }
        function cargarDatosSeccion_G_ESES(ese_id)
        {
          let headers =document.getElementsByClassName('class-for-header');
          limpiarActive(headers,'#16345e','.9s',6);

          fnCargarDatosDelFormularioG(ese_id,'sie_id');
          
          $('#sie_calificacion').val('-1');
          $('#sie_calificacion').trigger('change');

        }


        function cargarDatosSeccion_H_ESES(ese_id)
        {
          let headers =document.getElementsByClassName('class-for-header');
          limpiarActive(headers,'#16345e','.9s',7);
          fnCargarDatosDelFormularioH(ese_id);
          $('#bie_calificacion').val('-1');
          $('#bie_calificacion').trigger('change');
        }
        
        function cargarDatosSeccion_I_ESES(ese_id)
        {
          let headers =document.getElementsByClassName('class-for-header');
          limpiarActive(headers,'#16345e','.9s',8);
           fnCargarDatosDelFormularioI(ese_id);
          $('#sep_calificacion').val('-1');
          $('#sep_calificacion').trigger('change');
        }
        
        function cargarDatosSeccion_J_ESES(ese_id)
        {
          let headers =document.getElementsByClassName('class-for-header');
          limpiarActive(headers,'#16345e','.9s',9);

           fnCargarDatosDelFormularioJ(ese_id);
          
        }
        

        function cargar_primer_seccion_ESE(ese_id)
        {
          $('#ese_id_ese_actual').text(ese_id);
          $('#home-tab-md-1').trigger('click');

          // cargarDatosSeccion_A_ESES(ese_id);
          let headers =document.getElementsByClassName('class-for-header');
          headers[0].style.background='#16345e';
          headers[0].style.color='white';
          headers[0].style.fontWeight ='bold';
          headers[0].style.padding ='15px';
          limpiarActive(headers,'#16345e','.9s',0);
          

        }


        function cargarDatosSeccion_Finales_ESES(ese_id)
        {
          let form_seccionfinales=document.getElementById('form_estudio_seccionDatosFinales');
          form_seccionfinales.reset();

          fnDatosFinalesDetalle(ese_id);
        }
   
       

 

</script>
<!-- script para cargar datos del estudio  -->



  <!-- SCRIPTS PARA GUARDAR DATOS DE VER ESTUDIOS -->

  
  <!-- SCRIPTS PARA GUARDAR DATOS DE VER ESTUDIOS -->

  <!-- INICIO SCRIPTS PARA INCIDENCIAS DE ESTUDIOS -->
  {% include "/incidencia/incidencia.volt" %}
  
  <!-- FIN SCRIPTS PARA INCIDENCIAS DE ESTUDIOS --> 