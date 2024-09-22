{% if cuarenta==1%}

<form id="form_estudio_seccionDatosFinalesFormatoTruper" class=" form-vertical mt-1 ">
                    

    <section class="m-3 contorno-del-sistema">
      <input type="hidden" id="cal_id-ese_truper" name="cal_id" >

      <div class="form-group row d-flex flex-row-reverse d-block ">
        <div class="col-lg-4">
          
          <label class="col-form-label title-busq">Calificación propuesta</label>
          <select name="daf_calificacion" id="daf_calificacion-formato_truper" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
            <optgroup>
              <!-- <option value="-1">SELECCIONAR ...</option>
              <option value="1">1. NO - RECOMENDABLE</option>
              <option value="2">2.-RECOMENDABLE CON RESERVAS</option>
              <option value="3">3.-RECOMENDABLE </option>
              <option value="4">4.-SIN CALIFICACIÓN </option> -->
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

{% endif %}
