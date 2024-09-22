<form id="form_estudio_seccionAntecedenteSocial" class="form-vertical mt-1">
                 


    <section class="m-3">
      <div class="form-group row">
        <div class="col-lg-3">
          <label for="ans_tiempolibre" class="col-form-label title-busq">
            Actividades en su tiempo libre
          </label>
        </div>
        <div class="col-lg-9">
          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Nombre de las actividades que realiza..."  name="ans_tiempolibre" id="ans_tiempolibre" maxlength="255" />
        </div>
      </div>
      <div class="form-group row">
        <div class="col-lg-3">
          <label for="estudio_pertence_club_deportivo" class="col-form-label title-busq">¿Pertenece a algún club deportivo?</label>
        </div>
        <div class="col-lg-2">
          <select name="ans_clubdeportivo" id="ans_clubdeportivo" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ..." onchange="SelectMostrarOcultarDivDeAcuerdoASiONoConClasesCSS(event.currentTarget.value,'ans_pertenceclubdepotivo-container','ans_deporte');">
            <optgroup>
              <option value="-1">Seleccionar ...</option>
              <option value="1">SI</option>
              <option value="0">NO</option>
            </optgroup>
          </select>
        </div>
        <div class="col-lg-3  ans_pertenceclubdepotivo-container" style="display:none;"  >
          <label for="ans_deporte" class="col-form-label title-busq">
            ¿Qué deporte practica?
          </label>
        </div>
        <div class="col-lg-4 ans_pertenceclubdepotivo-container" style="display:none;" >
          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Nombre del deporte" name="ans_deporte" id="ans_deporte" maxlength="155" />
        </div>
      </div>
      <div class="form-group row" >
        <div class="col-lg-3">
          <label for="estudio_pertence_club_deportivo" class="col-form-label title-busq">¿Pertenece a algún puesto sindical?</label>
        </div>
        <div class="col-lg-2">
          <select name="ans_puestosindical" id="ans_puestosindical" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ..." onchange="SelectMostrarOcultarDivDeAcuerdoASiONoConClasesCSS(event.currentTarget.value,'ans_puestosindical-preg-container','ans_puestonombre');">
            <optgroup>
              <option value="-1">Seleccionar ...</option>
              <option value="1">SI</option>
              <option value="0">NO</option>
            </optgroup>
          </select>
        </div>
        <div class="col-lg-1 ans_puestosindical-preg-container" style="display: none;">
          <label for="ans_puestonombre" class="col-form-label title-busq">
            ¿A cuál?
          </label>
        </div>
        <div class="col-lg-2 ans_puestosindical-preg-container" style="display: none;">
          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Nombre del sindicato" name="ans_puestonombre" id="ans_puestonombre" maxlength="155" />
        </div>
        <div class="col-lg-1 ans_puestosindical-preg-container" style="display: none;">
          <label for="ans_puestocargo" class="col-form-label title-busq">
            ¿Qué cargo?
          </label>
        </div>
        <div class="col-lg-3 ans_puestosindical-preg-container" style="display: none;">
          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Nombre del puesto" name="ans_puestocargo" id="ans_puestocargo" maxlength="155" />
        </div>
      </div>
      <div class="form-group row">
        <div class="col-lg-3">
          <label for="ans_politico" class="col-form-label title-busq">¿Pertenece a algún partido político?</label>
        </div>
        <div class="col-lg-2">
          <select name="ans_politico" id="ans_politico" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ..." onchange="SelectMostrarOcultarDivDeAcuerdoASiONoConClasesCSS(event.currentTarget.value,'ans_politico-preg-container','ans_politiconombre');">
            <optgroup>
              <option value="-1">Seleccionar ...</option>
              <option value="1">SI</option>
              <option value="0">NO</option>
            </optgroup>
          </select>
        </div>
        <div class="col-lg-1 ans_politico-preg-container" style="display: none;">
          <label for="ans_politiconombre" class="col-form-label title-busq">
            ¿A cuál?
          </label>
        </div>
        <div class="col-lg-2 ans_politico-preg-container" style="display: none;">
          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Nombre del partido" name="ans_politiconombre" id="ans_politiconombre" maxlength="155" />
        </div>
        <div class="col-lg-1 ans_politico-preg-container" style="display: none;">
          <label for="ans_politicocargo" class="col-form-label title-busq">
            ¿Qué cargo?
          </label>
        </div>
        <div class="col-lg-3 ans_politico-preg-container" style="display: none;">
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
        <div class="col-lg-9">
          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Planes a corto plazo..." name="ans_cortoplazo"  id="ans_cortoplazo" maxlength="255" />
        </div>
      </div>
      <div class="form-group row">
        <div class="col-lg-3">
          <label for="ans_medianoplazo" class="col-form-label title-busq">
            ¿Cuáles son sus planes a mediano plazo?
          </label>
        </div>
        <div class="col-lg-9">
          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Planes a mediano plazo..." name="ans_medianoplazo" id="ans_medianoplazo" maxlength="255" />
        </div>
      </div>
      <div class="form-group row">
        <div class="col-lg-3">
          <label for="ans_largoplazo" class="col-form-label title-busq">
            ¿Cuáles son sus planes a largo plazo?
          </label>
        </div>
        <div class="col-lg-9">
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
          <select name="ans_bebida" id="ans_bebida" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ..." onchange="SelectMostrarOcultarDivDeAcuerdoASiONoConClasesCSS(event.currentTarget.value,'ans_bebida-preg-container','ans_bebidafrecuencia');">
            <optgroup>
              <option value="-1">Seleccionar ...</option>
              <option value="1">SI</option>
              <option value="0">NO</option>
            </optgroup>
          </select>
        </div>
        <div class="col-lg-1  ans_bebida-preg-container" style="display: none;">
          <label for="ans_bebidafrecuencia" class="col-form-label title-busq">
            ¿Con qué frecuencia?
          </label>
        </div>
        <div class="col-lg-6  ans_bebida-preg-container" style="display: none;">
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
          <select name="ans_fumar" id="ans_fumar" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ..." onchange="SelectMostrarOcultarDivDeAcuerdoASiONoConClasesCSS(event.currentTarget.value,'ans_fumar-preg-container','ans_fumarfrecuencia');">
            <optgroup>
              <option value="-1">Seleccionar ...</option>
              <option value="1">SI</option>
              <option value="0">NO</option>
            </optgroup>
          </select>
        </div>
        <div class="col-lg-1 ans_fumar-preg-container" style="display: none;">
          <label for="ans_fumarfrecuencia" class="col-form-label title-busq">
            ¿Con qué frecuencia?
          </label>
        </div>
        <div class="col-lg-6 ans_fumar-preg-container" style="display: none;">
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
          <textarea id="ans_nota"  placeholder="Notas..." name="ans_nota" oninput="handleInput(event)"  onkeyup="actualizaInfo(400,'ans_nota', 'label_ans_nota')"class="form-control-textarea text_area_a" style="min-height:5rem" maxlength="400"></textarea>
          <label  id="label_ans_nota" for="ans_nota" class="col-form-label title-busq ml-2"></label>

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