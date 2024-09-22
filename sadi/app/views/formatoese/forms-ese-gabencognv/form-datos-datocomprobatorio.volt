<form id="form_estudio_seccionDatosPersonales_formato_gabencognv" class="form-vertical   mb-3 mr-1 ml-2" method="post">
                      
                    
    <section class="m-3 "> 

          <div class="form-group row">
            <input type="hidden" value="" id="ese_formato_gabencognv_ese_id" name="ese[ese_id]">
            <div class="col-lg-4">
              <label class="col-form-label title-busq" for="ese_nombre">Nombre</label>
              <input type="text" class="form-control input-rounded data-not-lt-active" placeholder="Nombre..." id="ese_formato_gabencognv_ese_nombre_input" name="ese[ese_nombre]" maxlength="150"  oninput="handleInput(event)"  />
            </div>
            <div class="col-lg-4">
              <label class="col-form-label title-busq" for="ese_primerapellido">Primer apellido</label>
              <input type="text" class="form-control input-rounded data-not-lt-active" placeholder="Primer apellido..."  name="ese[ese_primerapellido]" id="ese_formato_gabencognv_ese_primerapellido_input" maxlength="150" oninput="handleInput(event)" />

            </div>
            <div class="col-lg-4">
              <label class="col-form-label title-busq" for="ese_segundoapellido">Segundo apellido</label>
              <input type="text" class="form-control input-rounded data-not-lt-active" placeholder="Segundo apellido..."  name="ese[ese_segundoapellido]" id="ese_formato_gabencognv_ese_segundoapellido_input" maxlength="150" oninput="handleInput(event)" />

            </div>
            
            <div class="col-lg-3">
              <label class="col-form-label title-busq" for="">Puesto</label>
              <input type="text" class="form-control input-rounded" placeholder="Puesto..." id="ese_formato_gabencognv[ese_puesto]" name="ese[ese_puesto]" maxlength="150"  oninput="handleInput(event)"  />
            </div>
            <div class="col-lg-5">
              <label class="col-form-label title-busq" for="ese_formato_gabencognv_ese_lugarnacimiento">Lugar de nacimiento</label>
              <input type="text"   oninput="handleInput(event)"  maxlength="150" class="form-control input-rounded" placeholder="Lugar de nacimiento..." id="ese_formato_gabencognv_ese_lugarnacimiento" name="ese[ese_lugarnacimiento]" />
            </div>
              
            <div class="col-lg-4">
              <label class="col-form-label title-busq" for="cop_nacimientofecha">Fecha de nacimiento</label>
              <input type="date" class="form-control input-rounded" placeholder="00-00-00"  name="ese[ese_fechanacimiento]" id="ese_formato_gabencognv[ese_fechanacimiento]" maxlength="" onchange="establecerFechaCalculada(event.target,'ese_formato_gabencognv[ese_edad]') "/>

            </div>
              <div class="col-lg-3" style="display:none ;">
            <label class="col-form-label title-busq" for="estudio_entrecalles">Entre calles</label>
            <input type="text"   oninput="handleInput(event)"  maxlength="150" class="form-control input-rounded" placeholder="Entre calles..." id="ese_formato_gabencognv[ese_entrecalles]" name="ese[ese_entrecalles]" />
          </div>
            <div class="col-lg-4">
              <label class="col-form-label title-busq" for="estudio_edad">Edad</label>
              <input type="number" class="form-control input-rounded"  placeholder="Edad..."    readonly name="ese[ese_edad]" id="ese_formato_gabencognv[ese_edad]" maxlength="20"/>
            </div>
            
            
            <div class="col-lg-4">
              <label class="col-form-label title-busq" for="estudio_genero">Género</label>
              <select name="ese[ese_sexo]" id="ese_formato_gabencognv[ese_sexo]" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..."  >
                <option value="-1">Seleccionar...</option>
                <option value="2">Masculino</option>
                <option value="1">Femenino</option>
             
              </select>
            </div>
       

            <div class="col-lg-4">
              <label class="col-form-label title-busq" for="estudio_estado_civil">Estado civil</label>
              <select name="ese[esc_id_eses]" id="ese_formato_gabencognv[esc_id_eses]" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
                
              </select>

            </div>

            

          </div>


          <div class="form-group row">

            <div class="col-lg-4">
              <label class="col-form-label title-busq" for="estudio_domicilio">Calle</label>
              <input type="text" class="form-control input-rounded" placeholder="Calle..." id="ese_formato_gabencognv[ese_calle]" name="ese[ese_calle]" maxlength="150"  oninput="handleInput(event)"  />
            </div>
            <div class="col-lg-2">
              <label class="col-form-label title-busq" for="estudio_domicilio">Número exterior</label>
              <input type="text" class="form-control input-rounded" placeholder="Número exterior..." id="ese_formato_gabencognv[ese_numext]" maxlength="45" name="ese[ese_numext]"  oninput="handleInput(event)"  />
            </div>
            <div class="col-lg-2">
              <label class="col-form-label title-busq" for="estudio_domicilio">Número interior</label>
              <input type="text" class="form-control input-rounded" placeholder="Número interior..." id="ese_formato_gabencognv[ese_numint]" maxlength="45" name="ese[ese_numint]"  oninput="handleInput(event)"  />
            </div>
          

              <div class="col-lg-4">
                <label class="col-form-label title-busq" for="estudio_domicilio_colonia">Colonia</label>
                <input type="text" class="form-control input-rounded" placeholder="Colonia..." id="ese_formato_gabencognv[ese_colonia]" maxlength="90" name="ese[ese_colonia]"  oninput="handleInput(event)"  />
              </div>
            
      

              <div class="col-lg-6">
                <label class="col-form-label title-busq" for="estudio_mucipio">Estado</label>
                <select name="ese[est_id]" id="est_id_nombre_formato_gabencognv" class="form-control select2-single " onchange="fnmunicipios_adaptable($('#mun_id_nombre_formato_gabencognv'),$('#est_id_nombre_formato_gabencognv').val(),-1)" data-toggle="select2" data-placeholder="Seleccionar ..." >
                
                </select>
  
              </div>
              <div class="col-lg-6">
                <label class="col-form-label title-busq" for="estudio_mucipio">Municipio</label>
                <select name="ese[mun_id]" id="mun_id_nombre_formato_gabencognv"  class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
                
                </select>

              </div>
            
         

          </div>
        
      
        <div class="form-group row">
          <div class="col-lg-3">
            <label class="col-form-label title-busq" for="estudio_codigo_postal">Código postal</label>
            <input type="text" class="form-control input-rounded" placeholder="Código..." id="ese_formato_gabencognv[ese_codpostal]" maxlength="10" name="ese[ese_codpostal]"  oninput="handleInput(event)"/>
            
          </div>
          <div class="col-lg-3">
            <label class="col-form-label title-busq" for="estudio_nivel_estudios">Nivel de estudios</label>
            <select name="ese[niv_id_eses]" id="ese_formato_gabencognv[niv_id_eses]" data-toggle="select2" class="form-control select2-multiple">

          </select>
          </div>

        

          <div class="col-lg-3">
            <label class="col-form-label title-busq" for="estudio_celular">Celular</label>
            <input type="text" oninput="handleInput(event)"  maxlength="20" class="form-control input-rounded" placeholder="Celular..."  id="ese_formato_gabencognv[ese_celular]" name="ese[ese_celular]"/>
          </div>

          <div class="col-lg-3">
            <label class="col-form-label title-busq" for="estudio_telefono">Teléfono</label>
            <input type="text"   oninput="handleInput(event)"  maxlength="20" class="form-control input-rounded" placeholder="Teléfono..." id="ese_formato_gabencognv[ese_telefono]" name="ese[ese_telefono]" />
          </div>

          <div class="col-lg-12" style="display:none ;">
            <label class="col-form-label title-busq" for="estudio_entrecalles">Entre calles</label>
            <input type="text"   oninput="handleInput(event)"  maxlength="150" class="form-control input-rounded" placeholder="Entre calles..." id="ese_formato_gabencognv[ese_entrecalles]" name="ese[ese_entrecalles]" />
          </div>

          <div class="col-lg-4">
            <label class="col-form-label title-busq" for="estudio_entrecalles">I.M.S.S</label>
            <input type="text"   oninput="handleInput(event)"  maxlength="30" class="form-control input-rounded" placeholder="Nº de seguridad social(11 dígitos)..." id="ese_formato_gabencognv_ese_nss" name="ese[ese_nss]" />
          </div>

          <div class="col-lg-4" >
            <label class="col-form-label title-busq" for="estudio_entrecalles">CURP</label>
            <input type="text"   oninput="handleInput(event)"  maxlength="45" class="form-control input-rounded" placeholder="Clave (CURP completa)..." id="ese_formato_gabencognv_ese_curp" name="ese[ese_curp]" />
          </div>

          <div class="col-lg-4">
            <label class="col-form-label title-busq" for="">¿Familiares en la empresa?</label>
            <select name="ese[ese_familiarempresa]" id="ese_formato_gabencognv_familiarempresa" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..."  >
              <option value="-1">Seleccionar...</option>
              <option value="1">Si</option>
              <option value="0">No</option>
           
            </select>
          </div>







 
        </div>
    
      <div class="row col-lg-12">
        <div class="col-sm-3 col-md-3 text-center mt-5">
        </div>                          
        <div class="col-sm-3 col-md-3 text-center mt-5">
          {% if cuarentayseis==1%}
            <div class="form-group">
              <button type="button" class="btn-green btn-rounded btn btn-limpiar" href="" data-toggle="modal" onclick="incidenciaformulario($('#ese_id_ese_actual_formato_gabencognv').text(),1)" data-target="#incidencias-modal" style="background-color: green;">Incidencia<i class="mdi mdi-shield-alert"></i></button>
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