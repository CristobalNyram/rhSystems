<form id="form_estudio_seccionDatosPersonales_formato_gabtubos" class="form-vertical   mb-3 mr-1 ml-2" method="post">
                      
                    
    <section class="m-3 "> 

          <div class="form-group row">
            <input type="hidden" value="" id="cop_ese_id_formato_gabtubos" name="cop_ese_id">
            <div class="col-lg-4">
              <label class="col-form-label title-busq" for="ese_nombre">Nombre</label>
              <input type="text" class="form-control input-rounded data-not-lt-active" placeholder="Nombre..." id="ese_formato_gabetubos_ese_nombre_input" name="ese[ese_nombre]" maxlength="150"  oninput="handleInput(event)"  />
            </div>
            <div class="col-lg-4">
              <label class="col-form-label title-busq" for="ese_primerapellido">Primer apellido</label>
              <input type="text" class="form-control input-rounded data-not-lt-active" placeholder="Primer apellido..."  name="ese[ese_primerapellido]" id="ese_formato_gabetubos_ese_primerapellido_input" maxlength="150" oninput="handleInput(event)"/>

            </div>
            <div class="col-lg-4">
              <label class="col-form-label title-busq" for="ese_segundoapellido">Segundo apellido</label>
              <input type="text" class="form-control input-rounded data-not-lt-active" placeholder="Segundo apellido..."  name="ese[ese_segundoapellido]" id="ese_formato_gabetubos_ese_segundoapellido_input" maxlength="150" oninput="handleInput(event)"/>

            </div>
            
            <div class="col-lg-4">
              <label class="col-form-label title-busq" for="">Puesto</label>
              <input type="text" class="form-control input-rounded " placeholder="Puesto..." id="ese_formato_gabtubos[ese_puesto]" name="ese[ese_puesto]" maxlength="150"  oninput="handleInput(event)"  />
            </div>
            <div class="col-lg-5">
              <label class="col-form-label title-busq" for="ese_formato_gabencognv_ese_lugarnacimiento">Lugar de nacimiento</label>
              <input type="text"   oninput="handleInput(event)"  maxlength="150" class="form-control input-rounded" placeholder="Lugar de nacimiento..." id="ese_formato_gabetubos_ese_lugarnacimiento" name="ese[ese_lugarnacimiento]" />
            </div>
            <div class="col-lg-3">
              <label class="col-form-label title-busq" for="cop_nacimientofecha">Fecha de nacimiento</label>
              <input type="date" class="form-control input-rounded" placeholder="00-00-00"  name="ese[ese_fechanacimiento]" id="ese_formato_gabtubos[ese_fechanacimiento]" maxlength="" onchange="establecerFechaCalculada(event.target,'ese_formato_gabtubos[ese_edad]') "/>

            </div>

            <div class="col-lg-4">
              <label class="col-form-label title-busq" for="estudio_edad">Edad</label>
              <input type="number" class="form-control input-rounded"  placeholder="Edad..."    readonly name="ese[ese_edad]" id="ese_formato_gabtubos[ese_edad]" maxlength="20"/>
            </div>
            
            
            <div class="col-lg-4">
              <label class="col-form-label title-busq" for="estudio_genero">Género</label>
              <select name="ese[ese_sexo]" id="ese_formato_gabtubos[ese_sexo]" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..."  >
                <option value="-1">Seleccionar...</option>
                <option value="2">Masculino</option>
                <option value="1">Femenino</option>
             
              </select>
            </div>
       

            <div class="col-lg-4">
              <label class="col-form-label title-busq" for="estudio_estado_civil">Estado civil</label>
              <select name="ese[esc_id_eses]" id="ese_formato_gabtubos[esc_id_eses]" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
                
              </select>

            </div>

            

          </div>


          <div class="form-group row">

            <div class="col-lg-4">
              <label class="col-form-label title-busq" for="estudio_domicilio">Calle</label>
              <input type="text" class="form-control input-rounded" placeholder="Calle..." id="ese_formato_gabtubos[ese_calle]" name="ese[ese_calle]" maxlength="150"  oninput="handleInput(event)"  />
            </div>
            <div class="col-lg-2">
              <label class="col-form-label title-busq" for="estudio_domicilio">Número exterior</label>
              <input type="text" class="form-control input-rounded" placeholder="Número exterior..." id="ese_formato_gabtubos[ese_numext]" maxlength="45" name="ese[ese_numext]"  oninput="handleInput(event)"  />
            </div>
            <div class="col-lg-2">
              <label class="col-form-label title-busq" for="estudio_domicilio">Número interior</label>
              <input type="text" class="form-control input-rounded" placeholder="Número interior..." id="ese_formato_gabtubos[ese_numint]" maxlength="45" name="ese[ese_numint]"  oninput="handleInput(event)"  />
            </div>
          

              <div class="col-lg-4">
                <label class="col-form-label title-busq" for="estudio_domicilio_colonia">Colonia</label>
                <input type="text" class="form-control input-rounded" placeholder="Colonia..." id="ese_formato_gabtubos[ese_colonia]" maxlength="90" name="ese[ese_colonia]"  oninput="handleInput(event)"  />
              </div>
            
  
              <div class="col-lg-6">
                <label class="col-form-label title-busq" for="estudio_mucipio">Estado</label>
                <select name="ese[est_id]" id="est_id_nombre_formato_gabtubos" class="form-control select2-single " onchange="fnmunicipios_adaptable($('#mun_id_nombre_formato_gabtubos'),$('#est_id_nombre_formato_gabtubos').val(),-1)" data-toggle="select2" data-placeholder="Seleccionar ..." >
                
                </select>
  
              </div>
              <div class="col-lg-6">
                <input type="hidden" name="ese[ese_nss]" disabled id="ese_nss_formato_gabtubos"  class="form-control input-rounded form-control-disabled" readonly placeholder="Municipio..." />

                <label class="col-form-label title-busq" for="estudio_mucipio">Municipio</label>
                <select name="ese[mun_id]" id="mun_id_nombre_formato_gabtubos"  class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
                
                </select>

              </div>
            
         

          </div>
        
      
        <div class="form-group row">
          <div class="col-lg-4">
            <label class="col-form-label title-busq" for="estudio_codigo_postal">Código postal</label>
            <input type="text" class="form-control input-rounded" placeholder="Código..." id="ese_formato_gabtubos[ese_codpostal]" maxlength="10" name="ese[ese_codpostal]"  oninput="handleInput(event)"/>
            
          </div>
          <div class="col-lg-4" style="display:none ;">
            <label class="col-form-label title-busq" for="estudio_nivel_estudios">Nivel de estudios</label>
            <select name="ese[niv_id_eses]" id="ese_formato_gabtubos[niv_id_eses]" data-toggle="select2" class="form-control select2-multiple">

          </select>
          </div>

        

          <div class="col-lg-4">
            <label class="col-form-label title-busq" for="estudio_celular">Celular</label>
            <input type="text" oninput="handleInput(event)"  maxlength="20" class="form-control input-rounded" placeholder="Celular..."  id="ese_formato_gabtubos[ese_celular]" name="ese[ese_celular]"/>
          </div>

          <div class="col-lg-4">
            <label class="col-form-label title-busq" for="estudio_telefono">Teléfono</label>
            <input type="text"   oninput="handleInput(event)"  maxlength="20" class="form-control input-rounded" placeholder="Teléfono..." id="ese_formato_gabtubos[ese_telefono]" name="ese[ese_telefono]" />
          </div>

          <div class="col-lg-12">
            <label class="col-form-label title-busq" for="estudio_entrecalles">Entre calles</label>
            <input type="text"   oninput="handleInput(event)"  maxlength="150" class="form-control input-rounded" placeholder="Entre calles..." id="ese_formato_gabtubos[ese_entrecalles]" name="ese[ese_entrecalles]" />
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
            <input type="text" class="form-control input-rounded" maxlength="30" placeholder="Fecha de registro..."  name="cop_nacimientofecha" id="cop_nacimientofecha_formato_gabtubos"  oninput="handleInput(event)"/>
          </div>
          <div class="col-lg-3">
            <input type="text" class="form-control input-rounded"  maxlength="155" placeholder="Lugar de registro..." name="cop_nacimientolugar" id="cop_nacimientolugar_formato_gabtubos"  oninput="handleInput(event)"/>
          </div>
          <div class="col-lg-3">
            <input type="text" class="form-control input-rounded" maxlength="25" placeholder="Nº Acta y Nº Libro..." name="cop_nacimientofolio" id="cop_nacimientofolio_formato_gabtubos"  oninput="handleInput(event)"/>
          </div>
    </div>


    <div class="form-group row">
          <div class="col-lg-3">
            <p class="col-form-label title-busq ">Acta de matrimonio</p>
          </div>
          <div class="col-lg-3">
            <input type="text" class="form-control input-rounded"  maxlength="30" placeholder="Fecha de registro..."  name="cop_matrimoniofecha" id="cop_matrimoniofecha_formato_gabtubos"  oninput="handleInput(event)"/>
          </div>
          <div class="col-lg-3">
            <input type="text" class="form-control input-rounded"  maxlength="150" placeholder="Lugar de registro..."  name="cop_matrimoniolugar" id="cop_matrimoniolugar_formato_gabtubos"  oninput="handleInput(event)"/>
          </div>
          <div class="col-lg-3">
            <input type="text" class="form-control input-rounded"  maxlength="25" placeholder="Nº Acta y Nº Libro..."  name="cop_matrimoniofolio" id="cop_matrimoniofolio_formato_gabtubos"  oninput="handleInput(event)"/>
          </div>
    </div>

    <div class="form-group row">
          <div class="col-lg-3">
            <p class="col-form-label title-busq ">Acta de nacimiento de cónyuge</p>
          </div>
          <div class="col-lg-3">
            <input type="text" class="form-control input-rounded"  maxlength="30" placeholder="Fecha de nacimiento..." id="cop_conyugefecha_formato_gabtubos" name="cop_conyugefecha"   oninput="handleInput(event)"/>
          </div>
          <div class="col-lg-3">
            <input type="text" class="form-control input-rounded"  maxlength="150" placeholder="Lugar de nacimiento..." name="cop_conyugelugar" id="cop_conyugelugar_formato_gabtubos"  oninput="handleInput(event)"/>
          </div>
          <div class="col-lg-3">
            <input type="text" class="form-control input-rounded"  maxlength="25" placeholder="Nº Acta y Nº Libro..." name="cop_conyugefolio" id="cop_conyugefolio_formato_gabtubos"  oninput="handleInput(event)"/>
          </div>
   </div>




<div class="form-group row">
    <div class="col-lg-3">
      <p class="col-form-label title-busq ">Acta de nacimiento de hijos</p>
    </div>
    <div class="col-lg-3">
      <input type="text" class="form-control input-rounded"  maxlength="30" placeholder="Fecha de nacimiento..." name="cop_nacimientohijosfecha" id="cop_nacimientohijosfecha_formato_gabtubos"  oninput="handleInput(event)" />
    </div>
    <div class="col-lg-3">
      <input type="text" class="form-control input-rounded"  maxlength="150" placeholder="Lugar nacimiento..." name="cop_nacimientohijoslugar" id="cop_nacimientohijoslugar_formato_gabtubos"  oninput="handleInput(event)" />
    </div>
    <div class="col-lg-3">
      <input type="text" class="form-control input-rounded"  maxlength="45" placeholder="Nº Acta y Nº Libro..." name="cop_nacimientohijosfolio" id="cop_nacimientohijosfolio_formato_gabtubos"  oninput="handleInput(event)" />
    </div>
</div>

<div class="form-group row">
  <div class="col-lg-3">
    <p class="col-form-label title-busq ">Comprobante de domicilio</p>
  </div>
  <div class="col-lg-3">
    <input type="text" class="form-control input-rounded"  maxlength="30" maxlength="30" placeholder="Fecha de facturación..."  oninput="handleInput(event)" name="cop_comprobantedomiciliofecha" id="cop_comprobantedomiciliofecha_formato_gabtubos" />
  </div>
  <div class="col-lg-3">
    <input type="text" class="form-control input-rounded"  maxlength="150" placeholder="Lugar de registro..."  oninput="handleInput(event)"  name="cop_comprobantedomiciliolugar" id="cop_comprobantedomiciliolugar_formato_gabtubos"/>
  </div>
  <div class="col-lg-3">
    <input type="text" class="form-control input-rounded"  maxlength="25" placeholder="Nº Oficial de documento..."  oninput="handleInput(event)" name="cop_comprobantedomiciliofolio" id="cop_comprobantedomiciliofolio_formato_gabtubos"/>
  </div>
</div>


<div class="form-group row">
<div class="col-lg-3">
  <p class="col-form-label title-busq ">Credencial de Elector</p>
</div>
<div class="col-lg-3">
  <input type="text"  oninput="handleInput(event)"  maxlength="30"  class="form-control input-rounded" placeholder="Año de registro..." name="cop_credencialelectorfecha" id="cop_credencialelectorfecha_formato_gabtubos" />
</div>
<div class="col-lg-3">
  <input type="text"  oninput="handleInput(event)"  maxlength="150" class="form-control input-rounded" placeholder="Lugar de registro..."  name="cop_credencialelectorlugar" id="cop_credencialelectorlugar_formato_gabtubos"/>
</div>
<div class="col-lg-3">
  <input type="text"  oninput="handleInput(event)"  maxlength="25" class="form-control input-rounded" placeholder="Clave de elector..."  name="cop_credencialelectorfolio" id="cop_credencialelectorfolio_formato_gabtubos"/>
</div>
</div>

<div class="form-group row">
<div class="col-lg-3">
  <p class="col-form-label title-busq ">C.U.R.P</p>
</div>
<div class="col-lg-3">
  <input type="text" class="form-control input-rounded"  maxlength="30" oninput="handleInput(event)" placeholder="Fecha de de inscripción..."  name="cop_curpfecha" id="cop_curpfecha_formato_gabtubos" />
</div>
<div class="col-lg-3">
  <input type="text" class="form-control input-rounded"  maxlength="150"  oninput="handleInput(event)" placeholder="Lugar de registro..." name="cop_curplugar" id="cop_curplugar_formato_gabtubos" />
</div>

<div class="col-lg-3">
  <input type="text" class="form-control input-rounded"  maxlength="25" oninput="handleInput(event)"  placeholder="Clave (CURP completa)..." name="cop_curpfolio" id="cop_curpfolio_formato_gabtubos" />
</div>

</div>


<div class="form-group row">
  <div class="col-lg-3">
    <p class="col-form-label title-busq ">Afiliación al I.M.S.S</p>
  </div>
  <div class="col-lg-3">
    <input type="text" class="form-control input-rounded" maxlength="30"  oninput="handleInput(event)"  placeholder="Fecha de solicitud o asignación..." id="cop_imssfecha_formato_gabtubos" name="cop_imssfecha"/>
  </div>
  <div class="col-lg-3">
    <input type="text" class="form-control input-rounded"  maxlength="150" oninput="handleInput(event)" placeholder="Lugar de registro..." id="cop_imsslugar_formato_gabtubos" name="cop_imsslugar"/>
  </div>
  <div class="col-lg-3">
    <input type="text" class="form-control input-rounded"   maxlength="25" oninput="handleInput(event)" placeholder="Nº de seguridad social(11 dígitos)..." id="cop_imssfolio_formato_gabtubos" name="cop_imssfolio"/>
  </div>
</div>

<div class="form-group row">
<div class="col-lg-3">
  <p class="col-form-label title-busq ">Comprobante de retención de impuestos</p>
</div>
<div class="col-lg-3">
  <input type="text" class="form-control input-rounded"  maxlength="30" oninput="handleInput(event)" placeholder="Fecha de expedición..." id="cop_retencionfecha_formato_gabtubos" name="cop_retencionfecha" />
</div>
<div class="col-lg-3">
  <input type="text" class="form-control input-rounded"  maxlength="150" oninput="handleInput(event)" placeholder="Lugar expedición..." id="cop_retencionlugar_formato_gabtubos" name="cop_retencionlugar" />
</div>
<div class="col-lg-3">
  <input type="text" class="form-control input-rounded"  maxlength="35"  oninput="handleInput(event)" placeholder="Nº de empleado o nombre de la empresa..." id="cop_retencionfolio_formato_gabtubos" name="cop_retencionfolio" />
</div>
</div>



<div class="form-group row">
<div class="col-lg-3">
  <p class="col-form-label title-busq ">Registro Federal Contribuyentes</p>
</div>
<div class="col-lg-3">
  <input type="text" class="form-control input-rounded"  maxlength="30"  oninput="handleInput(event)" placeholder="Fecha de inicio de operaciones..." id="cop_rfcfecha_formato_gabtubos" name="cop_rfcfecha"  />
</div>

<div class="col-lg-3">
  <input type="text" class="form-control input-rounded" maxlength="150"  oninput="handleInput(event)" placeholder="Lugar de emisión..." id="cop_rfclugar_formato_gabtubos" name="cop_rfclugar" />
</div>
<div class="col-lg-3">
  <input type="text" class="form-control input-rounded"  maxlength="25" oninput="handleInput(event)" placeholder="Registro Federal de Contribuyentes..." id="cop_rfcfolio_formato_gabtubos" name="cop_rfcfolio" />
</div>
</div>

<div class="form-group row">
<div class="col-lg-3">
  <p class="col-form-label title-busq ">Cartilla de servicio militar nacional</p>
</div>
<div class="col-lg-3">
  <input type="text" class="form-control input-rounded"  maxlength="30" oninput="handleInput(event)" placeholder="Fecha de trámite..." id="cop_cartillafecha_formato_gabtubos" name="cop_cartillafecha" />
</div>
<div class="col-lg-3">
  <input type="text" class="form-control input-rounded"   maxlength="150" oninput="handleInput(event)" placeholder="Lugar de trámite..."  id="cop_cartillalugar_formato_gabtubos" name="cop_cartillalugar"/>
</div>
<div class="col-lg-3">
  <input type="text" class="form-control input-rounded"  maxlength="25" oninput="handleInput(event)" placeholder="Nº Matrícula..."  id="cop_cartillafolio_formato_gabtubos" name="cop_cartillafolio"/>
</div>

</div>


<div class="form-group row">
<div class="col-lg-3">
  <p class="col-form-label title-busq ">Licencia para conducir</p>
</div>
<div class="col-lg-3">
  <input type="text" class="form-control input-rounded"  maxlength="30"  oninput="handleInput(event)" placeholder="Fecha de expedición y vigencia..." id="cop_licenciafecha_formato_gabtubos" name="cop_licenciafecha" />
</div>
<div class="col-lg-3">
  <input type="text" class="form-control input-rounded"  maxlength="150"  oninput="handleInput(event)" placeholder="Lugar de trámite..." id="cop_licencialugar_formato_gabtubos" name="cop_licencialugar"/>
</div>
<div class="col-lg-3">
  <input type="text" class="form-control input-rounded"  maxlength="45" oninput="handleInput(event)"  placeholder="Nº de conductor y tipo de licencia..." id="cop_licenciafolio_formato_gabtubos" name="cop_licenciafolio"/>
</div>
</div>


<div class="form-group row">
  <div class="col-lg-3">
    <p class="col-form-label title-busq ">Vigencia migratorio <span class="text-danger ">(para extranjeros)</span></p>
  </div>
  <div class="col-lg-3">
    <input type="text" class="form-control input-rounded"  maxlength="30" oninput="handleInput(event)" placeholder="Fecha de expedición y vencimiento..."  id="cop_migratoriafecha_formato_gabtubos" name="cop_migratoriafecha"/>
  </div>
  <div class="col-lg-3">
    <input type="text" class="form-control input-rounded"  maxlength="150" oninput="handleInput(event)" placeholder="Lugar de nacionalidad..." id="cop_migratorialugar_formato_gabtubos" name="cop_migratorialugar"/>
  </div>
  <div class="col-lg-3">
    <input type="text" class="form-control input-rounded"  maxlength="25" oninput="handleInput(event)" placeholder="Nº de cedula de identidad..." id="cop_migratoriafolio_formato_gabtubos" name="cop_migratoriafolio"/>
  </div>
</div>


<div class="form-group row d-flex flex-row-reverse ">
{% if cuarenta==1%}

     <div class="col-lg-4">
            <label class="col-form-label title-busq text-uppercase ">Calificación</label>
            <select  name="cop_calificacion" id="cop_calificacion_formato_gabtubos" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
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
              <button type="button" class="btn-green btn-rounded btn btn-limpiar" href="" data-toggle="modal" onclick="incidenciaformulario($('#ese_id_ese_actual_formato_gabtubos').text(),1)" data-target="#incidencias-modal" style="background-color: green;">Incidencia<i class="mdi mdi-shield-alert"></i></button>
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

  </section>

  </form>      