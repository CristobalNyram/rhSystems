<form id="form_estudio_seccionDatosEscolares_formato_ese_truper" class=" form-vertical mt-1 ">
                  


    <input type="hidden" name="ese_id" id="dae_ese_id_truper">

    <section class="m-3 contorno-del-sistema">
      <div class="form-group row ">
        <div class="col-lg-2 ml-2">
          
          <p class="col-form-label title-busq text-uppercase">NIVEL ESCOLAR </p>
        </div>
        <div class="col-lg-2">
          <p class="col-form-label title-busq text-uppercase">PERIODO (MES Y AÑO)</p>
        </div>
        <div class="col-lg-2">
          <p class="col-form-label title-busq text-uppercase">PROMEDIO</p>

        </div>
        <div class="col-lg-2">
              <p class="col-form-label title-busq text-uppercase">INSTITUCIÓN</p>
        </div>
        <div class="col-lg-2">
          <p class="col-form-label title-busq text-uppercase">ENTIDAD</p>

        </div>
        <div class="col-lg-1">
          <p class="col-form-label title-busq text-uppercase">DOCUMENTO RECIBIDO</p>

        </div>

      </div>
      <div class="form-group row pt-2 border-top">
        <div class="col-lg-2">
          <label for="dae_primariaperiodo" class="col-form-label title-busq ml-2">Primaria</label>
        </div>
        <div class="col-lg-2">
          <input type="text" class="form-control input-rounded"  oninput="handleInput(event)" placeholder="Periodo" name="dae_primariaperiodo" id="dae_primariaperiodo_formato_ese_truper" maxlength="45" data-lt-active="true"/>
        </div>
        <div class="col-lg-2">
          <input oninput="handleInput(event)" type="text" class="form-control input-rounded" placeholder="Promedio obtenido..." name="dae_primariapromedio" id="dae_primariapromedio_formato_ese_truper" maxlength="10" data-lt-active="true"/>

        </div>
        <div class="col-lg-2">
          <input type="text" class="form-control input-rounded data-not-lt-active"  oninput="handleInput(event)" placeholder="Nombre de la escuela" name="dae_primariaescuela" id="dae_primariaescuela_formato_ese_truper" maxlength="45" data-lt-active="true"/>

       
        </div>
       
        <div class="col-lg-2">
          <input type="text" class="form-control input-rounded data-not-lt-active"   oninput="handleInput(event)" placeholder="Entidad" name="dae_primariaentidad" id="dae_primariaentidad_formato_ese_truper" maxlength="45" data-lt-active="true"/>

        </div>

        <div class="col-lg-2">
          <select name="dae_primariadocrecibido"  id="dae_primariadocrecibido_formato_ese_truper" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
            <optgroup>
            
            </optgroup>
          </select>
        </div>

      </div>
      <div class="form-group row pt-2 border-top">
        <div class="col-lg-2">
          <label for="estudio_secundaria_fecha" class="col-form-label title-busq ml-2">Secundaria</label>
        </div>
        <div class="col-lg-2">
          <input type="text" class="form-control input-rounded" placeholder="Periodo" name="dae_secundariaperiodo" id="dae_secundariaperiodo_formato_ese_truper" maxlength="45" oninput="handleInput(event)" data-lt-active="true"/>
        </div>
        <div class="col-lg-2">
          <input type="text"  oninput="handleInput(event)" class="form-control input-rounded" placeholder="Promedio obtenido..." name="dae_secundariapromedio" id="dae_secundariapromedio_formato_ese_truper" maxlength="10" data-lt-active="true"/>

        </div>
        <div class="col-lg-2">
          <input type="text"  oninput="handleInput(event)" class="form-control input-rounded data-not-lt-active" placeholder="Nombre de la escuela..." name="dae_secundariaescuela" id="dae_secundariaescuela_formato_ese_truper" maxlength="45" data-lt-active="true"/>

        </div>
        <div class="col-lg-2">
          <input type="text" class="form-control input-rounded data-not-lt-active"  oninput="handleInput(event)" placeholder="Entidad" name="dae_secundariaentidad" id="dae_secundariaentidad_formato_ese_truper" maxlength="45" data-lt-active="true"/>

        </div>

        <div class="col-lg-2">
          
          <select name="dae_secundariadocrecibido" id="dae_secundariadocrecibido_formato_ese_truper" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
            <optgroup>
             
              </optgroup>
          </select>
        </div>

      </div>

      
      <div class="form-group row pt-2 border-top">
        <div class="col-lg-2">
          <label for="estudio_carrera_carreratecnica_fecha" class="col-form-label title-busq ml-2">Carrera técnica</label>
        </div>
        <div class="col-lg-2">
          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Periodo" name="dae_carreratecnicaperiodo" id="dae_carreratecnicaperiodo_formato_ese_truper" maxlength="45" oninput="handleInput(event)" data-lt-active="true"/>
        </div>
        <div class="col-lg-2">
          <input type="text" class="form-control input-rounded" placeholder="Promedio obtenido..." name="dae_carreratecnicapromedio" id="dae_carreratecnicapromedio_formato_ese_truper" oninput="handleInput(event)" maxlength="10" data-lt-active="true"/>

        </div>
        <div class="col-lg-2">

          <input type="text" oninput="handleInput(event)" class="form-control input-rounded data-not-lt-active" placeholder="Nombre de la escuela..." name="dae_carreratecnicaescuela" id="dae_carreratecnicaescuela_formato_ese_truper" maxlength="45" data-lt-active="true"/>


        </div>
        <div class="col-lg-2">
          <input type="text" class="form-control input-rounded data-not-lt-active"   oninput="handleInput(event)" placeholder="Entidad" name="dae_carreratecnicaentidad" id="dae_carreratecnicaentidad_formato_ese_truper" maxlength="45" data-lt-active="true"/>

        </div>

        <div class="col-lg-2">

          <select name="dae_carreratecnicadocrecibido" id="dae_carreratecnicadocrecibido_formato_ese_truper" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
            <optgroup>
       
           
          </optgroup>
          </select>
        </div>

        <div class="col-lg-2">
       

        </div>
        <div class="col-lg-4">
          <label for="estudio_bienesinmuebles_distribucion_recamaras" class="col-form-label title-busq text-uppercase ">En</label>
          <input type="text" class="form-control input-rounded"  oninput="handleInput(event)" placeholder="En..."  name="dae_carreratecnicaen" id="dae_carreratecnicaen_formato_ese_truper" maxlength="155" data-lt-active="true"/>

        </div>

      </div>              
      <div class="form-group row pt-2 border-top">
        <div class="col-lg-2">
          <label for="estudio_bachillerato_fecha" class="col-form-label title-busq ml-2">Media superior</label>
        </div>
        <div class="col-lg-2">
          <input type="text" class="form-control input-rounded" placeholder="Periodo" name="dae_preparatoriaperiodo" id="dae_preparatoriaperiodo_formato_ese_truper" maxlength="45" oninput="handleInput(event)" data-lt-active="true"/>
        </div>
        <div class="col-lg-2">
          <input type="text" class="form-control input-rounded" placeholder="Promedio obtenido..." name="dae_preparatoriapromedio" id="dae_preparatoriapromedio_formato_ese_truper" oninput="handleInput(event)" maxlength="10" data-lt-active="true"/>

        </div>
        <div class="col-lg-2">
          <input type="text" oninput="handleInput(event)" class="form-control input-rounded data-not-lt-active" placeholder="Nombre de la escuela..." name="dae_preparatoriaescuela" id="dae_preparatoriaescuela_formato_ese_truper" maxlength="45" data-lt-active="true"/>

     
        </div>
        <div class="col-lg-2">
          <input type="text" class="form-control input-rounded"  oninput="handleInput(event)" placeholder="Entidad" name="dae_preparatoriaentidad" id="dae_preparatoriaentidad_formato_ese_truper" maxlength="45" data-lt-active="true"/>

        </div>

        <div class="col-lg-2">
          <select name="dae_preparatoriadocrecibido" id="dae_preparatoriadocrecibido_formato_ese_truper" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
            <optgroup>
           
            </optgroup>
          </select>
        </div>

        <div class="col-lg-2">
       

        </div>
        <div class="col-lg-4">
          <label for="estudio_bienesinmuebles_distribucion_recamaras" class="col-form-label title-busq text-uppercase ">En</label>
          <input type="text" class="form-control input-rounded data-not-lt-active"  oninput="handleInput(event)" placeholder="En..."  name="dae_preparatoriaen" id="dae_preparatoriaen_formato_ese_truper" maxlength="155" data-lt-active="true"/>

        </div>

      </div>  
      <div class="form-group row pt-2 border-top">
        <div class="col-lg-2">
          <label for="estudio_licenciatura_fecha" class="col-form-label title-busq ml-2">Licenciatura o  ingeniería</label>
        </div>
        <div class="col-lg-2">
          <input type="text" class="form-control input-rounded" placeholder="Periodo" name="dae_licenciaturaperiodo" id="dae_licenciaturaperiodo_formato_ese_truper" maxlength="45" oninput="handleInput(event)" data-lt-active="true"/>
        </div>
        <div class="col-lg-2">
          <input type="text" class="form-control input-rounded" placeholder="Promedio obtenido..." name="dae_licenciaturapromedio" id="dae_licenciaturapromedio_formato_ese_truper" oninput="handleInput(event)" maxlength="10" data-lt-active="true"/>

        </div>
        <div class="col-lg-2">
          <input type="text" oninput="handleInput(event)" class="form-control input-rounded data-not-lt-active" placeholder="Nombre de la escuela..." name="dae_licenciaturaescuela" id="dae_licenciaturaescuela_formato_ese_truper" maxlength="45" data-lt-active="true"/>

        </div>
        <div class="col-lg-2">
          <input type="text" class="form-control input-rounded data-not-lt-active"  oninput="handleInput(event)" placeholder="Entidad" name="dae_licenciaturaentidad" id="dae_licenciaturaentidad_formato_ese_truper" maxlength="45" data-lt-active="true"/>

        </div>
        <div class="col-lg-2">
          
          <select name="dae_licenciaturadocrecibido"  id="dae_licenciaturadocrecibido_formato_ese_truper" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
            <optgroup>
            
            </optgroup>
          </select>
        </div>

        <div class="col-lg-2">
       

        </div>
        <div class="col-lg-2">
          <label for="estudio_bienesinmuebles_distribucion_recamaras" class="col-form-label title-busq text-uppercase ">En</label>
          <input type="text" class="form-control input-rounded"  oninput="handleInput(event)"  placeholder="En..."  name="dae_licenciaturaen" id="dae_licenciaturaen_formato_ese_truper" maxlength="155" data-lt-active="true"/>

        </div>

      </div>

      <div class="form-group row pt-2 border-top">
        <div class="col-lg-2">
          <label for="estudio_otroEstudios_fecha" class="col-form-label title-busq ml-2">Otros</label>
        </div>
        <div class="col-lg-2">
          <input type="text" class="form-control input-rounded" placeholder="Periodo" name="dae_otroperiodo" id="dae_otroperiodo_formato_ese_truper" maxlength="45" oninput="handleInput(event)" data-lt-active="true"/>
        </div>
        <div class="col-lg-2">
          <input type="text" class="form-control input-rounded" placeholder="Promedio obtenido..." name="dae_otropromedio" id="dae_otropromedio_formato_ese_truper" oninput="handleInput(event)" maxlength="10" data-lt-active="true"/>
        </div>
        <div class="col-lg-2">

          <input type="text" oninput="handleInput(event)" class="form-control input-rounded data-not-lt-active" placeholder="Nombre de la escuela..." name="dae_otroescuela" id="dae_otroescuela_formato_ese_truper" maxlength="45" data-lt-active="true"/>

          
        </div>
        <div class="col-lg-2">
          <input type="text" class="form-control input-rounded data-not-lt-active"  oninput="handleInput(event)" placeholder="Entidad" name="dae_otroentidad" id="dae_otroentidad_formato_ese_truper" maxlength="45" data-lt-active="true"/>

        </div>
        
        <div class="col-lg-2">
          <select id="dae_otrodocrecibido_formato_ese_truper" name="dae_otrodocrecibido" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
            <optgroup>
  
            </optgroup>
          </select>
        </div>

        <div class="col-lg-2">
       

        </div>
        <div class="col-lg-4">
          <label for="estudio_bienesinmuebles_distribucion_recamaras" class="col-form-label title-busq text-uppercase ">En</label>
          <input type="text" class="form-control input-rounded data-not-lt-active"  oninput="handleInput(event)"  placeholder="En..."  name="dae_otroen" id="dae_otroen_formato_ese_truper" maxlength="155" data-lt-active="true"/>

        </div>

      </div>
     
     
   
             
     
    </section>
    <div class="row col-lg-12">
      <div class="col-sm-3 col-md-3 text-center mt-5">
        </div>                          
        <div class="col-sm-3 col-md-3 text-center mt-5">
          {% if cuarentayseis==1%}
         
            <div class="form-group">
              <button type="button" class="btn-green btn-rounded btn btn-limpiar" href="" data-toggle="modal" onclick="incidenciaformulario($('#ese_id_ese_actual_formato_ese_truper').text(),14)" data-target="#incidencias-modal" style="background-color: green;">Incidencia<i class="mdi mdi-shield-alert"></i></button>
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