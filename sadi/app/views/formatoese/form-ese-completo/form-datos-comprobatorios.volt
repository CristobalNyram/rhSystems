<form id="form_estudio_seccionDatosPersonales" class="form-vertical   mb-3 mr-1 ml-2" method="post">
                      
                    
    <section class="m-3 "> 

          <div class="form-group row">
            <input type="hidden" value="" id="cop_ese_id" name="cop_ese_id">
           
            <div class="col-lg-4">
              <label class="col-form-label title-busq" for="ese_nombre">Nombre</label>
              <input type="text" class="form-control input-rounded data-not-lt-active" placeholder="Nombre..." id="ese_nombrecompleto_ese_nombre" name="ese[ese_nombre]" maxlength="150"  oninput="handleInput(event)"   />
            </div>
            <div class="col-lg-4">
              <label class="col-form-label title-busq" for="ese_primerapellido">Primer apellido</label>
              <input type="text" class="form-control input-rounded data-not-lt-active" placeholder="Primer apellido..."  name="ese[ese_primerapellido]" id="ese_nombrecompleto_ese_primerapellido" maxlength="150" oninput="handleInput(event)" />

            </div>
            <div class="col-lg-4">
              <label class="col-form-label title-busq" for="ese_segundoapellido">Segundo apellido</label>
              <input type="text" class="form-control input-rounded data-not-lt-active" placeholder="Segundo apellido..."  name="ese[ese_segundoapellido]" id="ese_nombrecompleto_ese_segundoapellido" maxlength="150"  oninput="handleInput(event)"/>

            </div>

            <div class="col-lg-4">
              <label class="col-form-label title-busq" for="">Puesto</label>
              <input type="text" class="form-control input-rounded" placeholder="Puesto..." id="ese[ese_puesto]" name="ese[ese_puesto]" maxlength="150"  oninput="handleInput(event)"  />
            </div>
            <div class="col-lg-4">
              <label class="col-form-label title-busq" for="ese_lugarnacimiento">Lugar de nacimiento</label>
              <input type="text" class="form-control input-rounded" placeholder="Lugar de nacimiento"  name="ese[ese_lugarnacimiento]" id="ese[ese_lugarnacimiento]" maxlength="150" oninput="handleInput(event)"/>

            </div>
            <div class="col-lg-4">
              <label class="col-form-label title-busq" for="cop_nacimientofecha">Fecha de nacimiento</label>
              <input type="date" class="form-control input-rounded" placeholder="00-00-00"  name="ese[ese_fechanacimiento]" id="ese[ese_fechanacimiento]" maxlength="" oninput="establecerFechaCalculada(event.target,'ese[ese_edad]') "/>

            </div>
            <div class="col-lg-4">
              <label class="col-form-label title-busq" for="estudio_edad">Edad</label>
              <input type="number" class="form-control input-rounded"  placeholder="Edad..."    readonly name="ese[ese_edad]" id="ese[ese_edad]" maxlength="20"/>
            </div>
            
            
            <div class="col-lg-4">
              <label class="col-form-label title-busq" for="estudio_genero">Género</label>
              <select name="ese[ese_sexo]" id="ese[ese_sexo]" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..."  >
                <option value="-1">Seleccionar...</option>
                <option value="2">Masculino</option>
                <option value="1">Femenino</option>
             
              </select>
            </div>
       

            <div class="col-lg-4">
              <label class="col-form-label title-busq" for="estudio_estado_civil">Estado civil</label>
              <select name="ese[esc_id_eses]" id="ese[esc_id_eses]" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
                
              </select>

            </div>

            

          </div>


          <div class="form-group row">

            <div class="col-lg-4">
              <label class="col-form-label title-busq" for="estudio_domicilio">Calle</label>
              <input type="text" class="form-control input-rounded" placeholder="Calle..." id="ese[ese_calle]" name="ese[ese_calle]" maxlength="150"  oninput="handleInput(event)"  />
            </div>
            <div class="col-lg-2">
              <label class="col-form-label title-busq" for="estudio_domicilio">Número exterior</label>
              <input type="text" class="form-control input-rounded" placeholder="Número exterior..." id="ese[ese_numext]" maxlength="45" name="ese[ese_numext]"  oninput="handleInput(event)"  />
            </div>
            <div class="col-lg-2">
              <label class="col-form-label title-busq" for="estudio_domicilio">Número interior</label>
              <input type="text" class="form-control input-rounded" placeholder="Número interior..." id="ese[ese_numint]" maxlength="45" name="ese[ese_numint]"  oninput="handleInput(event)"  />
            </div>
          

              <div class="col-lg-4">
                <label class="col-form-label title-busq" for="estudio_domicilio_colonia">Colonia</label>
                <input type="text" class="form-control input-rounded" placeholder="Colonia..." id="ese[ese_colonia]" maxlength="90" name="ese[ese_colonia]"  oninput="handleInput(event)"  />
              </div>
            
              <div class="col-lg-6">
                <label class="col-form-label title-busq" for="estudio_mucipio">Estado</label>
                <select name="ese[est_id]" id="est_id_nombre_ver_completo" class="form-control select2-single " onchange="fnmunicipios_adaptable($('#mun_id_nombre_ver_completo'),$('#est_id_nombre_ver_completo').val(),-1)" data-toggle="select2" data-placeholder="Seleccionar ..." >
                
                </select>
  
              </div>
              <div class="col-lg-6">
                <label class="col-form-label title-busq" for="estudio_mucipio">Municipio</label>
                <select name="ese[mun_id]" id="mun_id_nombre_ver_completo"  class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
                
                </select>

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

          <div class="col-lg-12">
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