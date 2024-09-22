<form id="form_estudio_seccionReferenciasPersonales_formato_gabtubos" method="post" class="form-vertical mt-1">
  <div class="form-group row mt-3 mb-3 d-flex justify-content-center">
    <p class="text-danger h6 font-weight-bold uppercase">
      QUE NO SEAN PARIENTES, NI JEFES DE EMPLEOS ANTERIORES
    </p>
  </div>
  <section class="m-3">
    <div class="row col-lg-12 d-flex ml-2 ">
      <div class="text-left">
        {{ link_to('#', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'50' , 'onclick':'fnCrearReferenciaPersonal_formato_gabtubos();'),"data-toggle":"modal","data-target":"#agregar-referenciapersonal_formato_gabtubos-modal","title":"Agregar." ,'id':'' ) }}
        <span class="ml-3 h6  text-success">Agregar referencias personales</span>
      </div>
    </div>
    <input type="hidden" class="form-control input-rounded" oninput=""  placeholder="" maxlength=""  name="sep_id" id="sep_id_formato_gabtubos"/>
    <div class="form-group row m-3" id="dato_referenciapersonal_listado_formato_gabtubos">
    </div>
  </section>
  {% if cuarenta==1%}
    <div class="form-group row d-flex flex-row-reverse">
      <div class="col-lg-4">
        <label class="col-form-label title-busq text-uppercase ">Calificación</label>
        <select  name="sep_calificacion" id="sep_calificacion_formato_gabtubos" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
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
        <button type="button" class="btn-green btn-rounded btn btn-limpiar" href="" data-toggle="modal" onclick="incidenciaformulario($('#ese_id_ese_actual_formato_gabtubos').text(),9)" data-target="#incidencias-modal" style="background-color: green;">Incidencia<i class="mdi mdi-shield-alert"></i></button>
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
        <button type="submit" class="btn-dark btn-rounded btn btn-buscar" type="submit">Guardar <i class="mdi mdi-content-save white"></i> </button>
      </div>
    </div>
  </div>

</form> 

