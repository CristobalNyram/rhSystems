<form id="form_estudio_seccionDatosEscolares_formato_gabtubos" class=" form-vertical mt-1 ">
                  



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
          <input type="text" class="form-control input-rounded"  oninput="handleInput(event)" placeholder="Periodo" name="dae_primariaperiodo" id="dae_primariaperiodo_formato_gabtubos" maxlength="45" />
        </div>
        <div class="col-lg-2">
          <input type="text" class="form-control input-rounded data-not-lt-active"  oninput="handleInput(event)" placeholder="Nombre de la escuela" name="dae_primariaescuela" id="dae_primariaescuela_formato_gabtubos" maxlength="45"/>
        </div>
        <div class="col-lg-2">
          <select name="dae_primariacertificado"  id="dae_primariacertificado_formato_gabtubos" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
            <optgroup>
              <option value="-1">SELECCIONAR...</option>
              <option value="2">EN TRÁMITE</option>
              <option value="1">SI</option>
              <option value="0">NO</option>
            </optgroup>
          </select>
        </div>
        <div class="col-lg-2">
          <input oninput="handleInput(event)" type="text" class="form-control input-rounded" placeholder="Promedio obtenido..." name="dae_primariapromedio" id="dae_primariapromedio_formato_gabtubos" maxlength="10"/>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-lg-2">
          <label for="estudio_secundaria_fecha" class="col-form-label title-busq ml-2">Secundaria</label>
        </div>
        <div class="col-lg-2">
          <input type="text" class="form-control input-rounded" placeholder="Periodo" name="dae_secundariaperiodo" id="dae_secundariaperiodo_formato_gabtubos" maxlength="45" oninput="handleInput(event)"/>
        </div>
        <div class="col-lg-2">
          <input type="text"  oninput="handleInput(event)" class="form-control input-rounded data-not-lt-active" placeholder="Nombre de la escuela..." name="dae_secundariaescuela" id="dae_secundariaescuela_formato_gabtubos" maxlength="45"/>
        </div>
        <div class="col-lg-2">
          <select name="dae_secundariacertificado" id="dae_secundariacertificado_formato_gabtubos" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
            <optgroup>
                <option value="-1">SELECCIONAR...</option>
                <option value="2">EN TRÁMITE</option>
                <option value="1">SI</option>
                <option value="0">NO</option>
              </optgroup>
          </select>
        </div>
        <div class="col-lg-2">
          <input type="text"  oninput="handleInput(event)" class="form-control input-rounded" placeholder="Promedio obtenido..." name="dae_secundariapromedio" id="dae_secundariapromedio_formato_gabtubos" maxlength="10"/>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-lg-2">
          <label for="estudio_carrera_comercial_fecha" class="col-form-label title-busq ml-2">Carrera comercial</label>
        </div>
        <div class="col-lg-2">
          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Periodo" name="dae_comercialperiodo" id="dae_comercialperiodo_formato_gabtubos" maxlength="45" oninput="handleInput(event)"/>
        </div>
        <div class="col-lg-2">
          <input type="text" oninput="handleInput(event)" class="form-control input-rounded data-not-lt-active" placeholder="Nombre de la escuela..." name="dae_comercialescuela" id="dae_comercialescuela_formato_gabtubos" maxlength="45"/>
        </div>
        <div class="col-lg-2">
          <select name="dae_comercialcertificado" id="dae_comercialcertificado_formato_gabtubos" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
            <optgroup>
            <option value="-1">SELECCIONAR...</option>
            <option value="2">EN TRÁMITE</option>
            <option value="1">SI</option>
            <option value="0">NO</option>
          </optgroup>
          </select>
        </div>
        <div class="col-lg-2">
          <input type="text" class="form-control input-rounded" placeholder="Promedio obtenido..." name="dae_comercialpromedio" id="dae_comercialpromedio_formato_gabtubos" oninput="handleInput(event)" maxlength="10"/>
        </div>
      </div>              
      <div class="form-group row">
        <div class="col-lg-2">
          <label for="estudio_bachillerato_fecha" class="col-form-label title-busq ml-2">Bachillerato o Preparatoria</label>
        </div>
        <div class="col-lg-2">
          <input type="text" class="form-control input-rounded" placeholder="Periodo" name="dae_preparatoriaperiodo" id="dae_preparatoriaperiodo_formato_gabtubos" maxlength="45" oninput="handleInput(event)"/>
        </div>
        <div class="col-lg-2">
          <input type="text" oninput="handleInput(event)" class="form-control input-rounded data-not-lt-active" placeholder="Nombre de la escuela..." name="dae_preparatoriaescuela" id="dae_preparatoriaescuela_formato_gabtubos" maxlength="45"/>
        </div>
        <div class="col-lg-2">
          <select name="dae_preparatoriacertificado" id="dae_preparatoriacertificado_formato_gabtubos" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
            <optgroup>
              <option value="-1">SELECCIONAR...</option>
              <option value="2">EN TRÁMITE</option>
              <option value="1">SI</option>
              <option value="0">NO</option>
            </optgroup>
          </select>
        </div>
        <div class="col-lg-2">
          <input type="text" class="form-control input-rounded" placeholder="Promedio obtenido..." name="dae_preparatoriapromedio" id="dae_preparatoriapromedio_formato_gabtubos" oninput="handleInput(event)" maxlength="10"/>
        </div>
      </div>  
      <div class="form-group row">
        <div class="col-lg-2">
          <label for="estudio_licenciatura_fecha" class="col-form-label title-busq ml-2">Licenciatura</label>
        </div>
        <div class="col-lg-2">
          <input type="text" class="form-control input-rounded" placeholder="Periodo" name="dae_licenciaturaperiodo" id="dae_licenciaturaperiodo_formato_gabtubos" maxlength="45" oninput="handleInput(event)"/>
        </div>
        <div class="col-lg-2">
          <input type="text" oninput="handleInput(event)" class="form-control input-rounded data-not-lt-active" placeholder="Nombre de la escuela..." name="dae_licenciaturaescuela" id="dae_licenciaturaescuela_formato_gabtubos" maxlength="45"/>
        </div>
        <div class="col-lg-2">
          <select name="dae_licenciaturacertificado"  id="dae_licenciaturacertificado_formato_gabtubos" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
            <optgroup>
              <option value="-1">SELECCIONAR...</option>
              <option value="2">EN TRÁMITE</option>
              <option value="1">SI</option>
              <option value="0">NO</option>
            </optgroup>
          </select>
        </div>
        <div class="col-lg-2">
          <input type="text" class="form-control input-rounded" placeholder="Promedio obtenido..." name="dae_licenciaturapromedio" id="dae_licenciaturapromedio_formato_gabtubos" oninput="handleInput(event)" maxlength="10"/>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-lg-2">
          <label for="estudio_cedula_fecha" class="col-form-label title-busq ml-2">Cédula profesional</label>
        </div>
        <div class="col-lg-2">
          <input type="text" class="form-control input-rounded" placeholder="Fecha de la cédula" name="dae_cedulaperiodo" id="dae_cedulaperiodo_formato_gabtubos" maxlength="45" oninput="handleInput(event)"/>
        </div>
        <div class="col-lg-2">
          <input type="text" oninput="handleInput(event)" class="form-control input-rounded data-not-lt-active" placeholder="No. de la cédula..." name="dae_cedulaescuela" id="dae_cedulaescuela_formato_gabtubos" maxlength="45"/>
        </div>
        <div class="col-lg-2">
          <select name="dae_cedulacertificado" id="dae_cedulacertificado_formato_gabtubos" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
            <optgroup>
              <option value="-1">SELECCIONAR...</option>
              <option value="2">EN TRÁMITE</option>
              <option value="1">SI</option>
              <option value="0">NO</option>
            </optgroup>
          </select>
        </div>
        <div class="col-lg-2">
          <input type="text" class="form-control input-rounded" placeholder="Promedio obtenido..." name="dae_cedulapromedio" id="dae_cedulapromedio_formato_gabtubos" oninput="handleInput(event)" maxlength="10"/>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-lg-2">
          <label for="estudio_otroEstudios_fecha" class="col-form-label title-busq ml-2">Otros</label>
        </div>
        <div class="col-lg-2">
          <input type="text" class="form-control input-rounded" placeholder="Periodo" name="dae_otroperiodo" id="dae_otroperiodo_formato_gabtubos" maxlength="45" oninput="handleInput(event)"/>
        </div>
        <div class="col-lg-2">
          <input type="text" oninput="handleInput(event)" class="form-control input-rounded data-not-lt-active" placeholder="Nombre de la escuela..." name="dae_otroescuela" id="dae_otroescuela_formato_gabtubos" maxlength="45"/>
        </div>
        <div class="col-lg-2">
          <select name="dae_otrocertificado" id="dae_otrocertificado_formato_gabtubos" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
            <optgroup>
              <option value="-1">SELECCIONAR...</option>
              <option value="2">EN TRÁMITE</option>
              <option value="1">SI</option>
              <option value="0">NO</option>
            </optgroup>
          </select>
        </div>
        <div class="col-lg-2">
          <input type="text" class="form-control input-rounded" placeholder="Promedio obtenido..." name="dae_otropromedio" id="dae_otropromedio_formato_gabtubos" oninput="handleInput(event)" maxlength="10"/>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-lg-2">
          <label for="estudio_estudiosActuales_fecha" class="col-form-label title-busq ml-2">Estudios Actuales</label>
        </div>
        <div class="col-lg-2">
          <input type="text" class="form-control input-rounded" placeholder="Periodo" name="dae_actualperiodo" id="dae_actualperiodo_formato_gabtubos" maxlength="45" oninput="handleInput(event)"/>
        </div>
        <div class="col-lg-2">
          <input type="text" oninput="handleInput(event)" class="form-control input-rounded data-not-lt-active" placeholder="Nombre de la escuela..." name="dae_actualescuela" id="dae_actualescuela_formato_gabtubos" maxlength="45"/>
        </div>
        <div class="col-lg-2">
          <select name="dae_actualcertificado" id="dae_actualcertificado_formato_gabtubos" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
            <optgroup>
              <option value="-1">SELECCIONAR...</option>
              <option value="2">EN TRÁMITE</option>
              <option value="1">SI</option>
              <option value="0">NO</option>
            </optgroup>
          </select>
        </div>
        <div class="col-lg-2">
          <input type="text" class="form-control input-rounded" placeholder="Promedio obtenido..." name="dae_actualpromedio" id="dae_actualpromedio_formato_gabtubos" oninput="handleInput(event)" maxlength="10"/>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-lg-2">
          <label for="estudio_periodo_inactivo" class="col-form-label title-busq ml-2">Periodos inactivos</label>
        </div>
        <div class="col-lg-10">
          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Periodo inactivo..."  name="dae_periodoinactivo" id="dae_periodoinactivo_formato_gabtubos" maxlength="100"/>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-lg-2">
          <label for="estudio_periodo_inactivo_razones" class="col-form-label title-busq ml-2">Motivos</label>
        </div>
        <div class="col-lg-10">
          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Escriba la razón..." name="dae_motivo" id="dae_motivo_formato_gabtubos" maxlength="150"/>
        </div>
      </div>  
      <div class="form-group row">
        <div class="col-lg-2">
          <label for="comentario_nuevo" class="col-form-label title-busq ml-2">Notas</label>
        </div>
        <div class="col-lg-10">
          <textarea id="dae_notas_formato_gabtubos" name="dae_notas" oninput="handleInput(event)" class="form-control-textarea text_area_a" style="min-height:5rem" maxlength="400"></textarea>
        </div>
      </div>                 
      <div class="form-group row d-flex flex-row-reverse">
        {% if cuarenta==1%}
          <div class="col-lg-4">
            <label class="col-form-label title-busq">Calificación</label>
            <select name="dae_calificacion" id="dae_calificacion_formato_gabtubos" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
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
              <button type="button" class="btn-green btn-rounded btn btn-limpiar" href="" data-toggle="modal" onclick="incidenciaformulario($('#ese_id_ese_actual_formato_gabtubos').text(),2)" data-target="#incidencias-modal" style="background-color: green;">Incidencia<i class="mdi mdi-shield-alert"></i></button>
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