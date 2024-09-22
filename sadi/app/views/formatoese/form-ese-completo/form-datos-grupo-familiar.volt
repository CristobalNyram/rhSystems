<form id="form_estudio_seccionGrupoFamiliar" class="form-vertical mt-1">
                      
                   

    <div class="form-group row justify-content-center d-none">
      <h6>Folio de referencia familiar: <span id="gfd_id_titulo_gfd"> </span></h6>
    </div>

    <div class="row ml-3 d-flex" id="">
      {{ link_to('#', image("assets/images/small/boton.svg", 'class':'boton-plus','onclick':'fnCrearDatoGrupoFamiliarDetalles()', 'height':'50'),"data-toggle":"modal","data-target":"#agregar-familiar-candidato-modal","title":"Agregar familiar del candidato." ,'id':'' ) }}
      <span class="ml-3 h6  text-success">Agregar referencias familiares</span>

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