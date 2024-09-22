<form id="form_estudio_seccionBienesInmuebles_truper" class="form-vertical mt-1">


      <!-- antecedente social -->

    <input type="hidden" name="bie_id" id="ans_bie_id-formato_truper" >
    <input type="hidden" name="ans_id" id="ans_id-formato_truper" >

      <section class="m-3 p-2">

        <div class="form-group row">
          <div class="col-lg-2">
            <label for="ans_tiempolibre-formato_truper" class="col-form-label title-busq">
              Actividades en su tiempo libre
            </label>
          </div>
          <div class="col-lg-10">
            <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Nombre de las actividades que realiza..."  name="ans_tiempolibre" id="ans_tiempolibre-formato_truper" maxlength="255" />
          </div>
        </div>


        <div class="form-group row ">
          <div class="col-lg-2">
            <label for="estudio_pertence_club_deportivo" class="col-form-label title-busq">¿Pertenece algún Club Social?             </label>
          </div>
          <div class="col-lg-2">
            <select name="ans_clubsocial" id="ans_clubsocial-formato_truper" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ..." onchange="SelectMostrarOcultarDivDeAcuerdoASiONoConClasesCSS(event.currentTarget.value,'ans_clubsocialnombre-container','ans_clubsocialnombre-formato_truper');">
              <optgroup class="text-uppercase">
                <option value="-1">Seleccionar ...</option>
                <option value="1">SÍ</option>
                <option value="0">NO</option>
              </optgroup>
            </select>
          </div>

      
              <div class="col-lg-1 ans_clubsocialnombre-container" style="display:none;">
                <label for="ans_clubsocial-formato_truper" class="col-form-label title-busq">
                  ¿A Cuál?
                </label>
              </div>

              <div class="col-lg-7 ans_clubsocialnombre-container" style="display:none;">
                <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Nombre del club social..." name="ans_clubsocialnombre" id="ans_clubsocialnombre-formato_truper" maxlength="155" />
              </div>
     
        </div>
        <div class="form-group row">
          <div class="col-lg-2">
            <label for="ans_deportepractica-formato_truper" class="col-form-label title-busq">¿Práctica algún deporte? 
            </label>
          </div>
          <div class="col-lg-2">
            <select name="ans_deportepractica" id="ans_deportepractica-formato_truper" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ..."  onchange="SelectMostrarOcultarDivDeAcuerdoASiONoConClasesCSS(event.currentTarget.value,'ans_deporte-container','ans_deporte-formato_truper');"">
              <optgroup class="text-uppercase">
                <option value="-1">Seleccionar ...</option>
                <option value="1">SÍ</option>
                <option value="0">NO</option>
              </optgroup>
            </select>
          </div>
          <div class="col-lg-1 ans_deporte-container" style="display:none;">
            <label for="ans_deporte-formato_truper" class="col-form-label title-busq">
              ¿Cuál?
            </label>
          </div>
          <div class="col-lg-7 ans_deporte-container" style="display:none;">
            <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Nombre del deporte..." name="ans_deporte" id="ans_deporte-formato_truper" maxlength="155" />
          </div>
     
        </div>

        <div class="form-group row ans_deporte-container" style="display:none;">
          <div class="col-lg-2">
            <label for="ans_deportefrecuencia-formato_truper" class="col-form-label title-busq">Frecuencia que practica el deporte
            </label>
          </div>
          <div class="col-lg-10" >
            <select name="ans_deportefrecuencia" id="ans_deportefrecuencia-formato_truper" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
              <optgroup class="text-uppercase">
                <option value="-1">Seleccionar ...</option>
                <option value="1">RARA VEZ					
                </option>
                <option value="2">EVENTUAL					
                </option>
                <option value="3">SEMANAL					
                </option>
                <option value="4">DIARIO					
                </option>
               
              

              </optgroup>
            </select>
          </div>

        </div>
        
        <div class="form-group row">
          <div class="col-lg-2">
            <label for="ans_religion-formato_truper" class="col-form-label title-busq">Religión que profesa
            </label>
          </div>
          <div class="col-lg-10">
            <select name="ans_religion" id="ans_religion-formato_truper" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
              <optgroup class="text-uppercase">
                <option value="-1">Seleccionar ...</option>
                <option value="1">NINGUNA					
                </option>
                <option value="2">CATÓLICA					
                </option>
                <option value="3">EVANGELISTA					
                </option>
                <option value="4">CRISTIANA					
                </option>
                <option value="5">MORMÓN					
                </option>
                <option value="6">TESTIGO DE JEHOVÁ					
                </option>
                <option value="7">JUDAÍSMO									
                </option>
                <option value="8">ISLAMISTA								
                </option>

              </optgroup>
            </select>
          </div>
   
     
        </div>
      </section>

      <!-- antecedente social -->


  
    <div class="form-group row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">                  
      <div class="container ">

              <p class=" text-white text-center font-weight-bold h6 text-uppercase sin-margen" >
                H | Propiedades																
                  <i class="mdi mdi-home white"></i>
              </p>

      </div>
    </div>

    <div class="row col-lg-12 d-flex ">
     
      <div class="ml-2">
        {{ link_to('#', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'50' , 'onclick':'fnCrearBienInmuebleDetallesFormatoTruper();'),"data-toggle":"modal","data-target":"#agregar-bieninmuebledetalles-formato_truper-modal","title":"Agregar." ,'id':'' ) }}



      </div>
      <h6 class="text-success">Agregar bienes inmuebles</h6>

    </div>
    
    <div class="form-group row m-3" id="dato_bieninmuebledetalles_truper_listado">
    </div>


    <div class="form-group row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">                  
      <div class="container ">

              <p class=" text-white text-center font-weight-bold h6 text-uppercase sin-margen" >
                H | automóvil																
                  <i class="mdi mdi-car white"></i>
              </p>

      </div>
    </div>

    <div class="row col-lg-12 d-flex  ml-2 border-top">
     
      <div class="text-left">
        {{ link_to('#', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'50', 'onclick':'fnCrearAutomovilDetallesFormatoTruper();'),"data-toggle":"modal","data-target":"#agregar-automovil-formato-truper-modal","title":"Agregar auto." ,'id':'' ) }}
        <span class="ml-1 h6  text-success">Agregar automóviles</span>
      </div>

    </div>
    <div class="form-group row m-3" id="dato_automovil_truper_listado">
    </div>

    
    

<div class="row col-lg-12">
<div class="col-sm-3 col-md-3 text-center mt-5">
</div>                          
<div class="col-sm-3 col-md-3 text-center mt-5">
  {% if cuarentayseis==1%}
    <div class="form-group">
      <button type="button" class="btn-green btn-rounded btn btn-limpiar" href="" data-toggle="modal" onclick="incidenciaformulario($('#ese_id_ese_actual_formato_ese_truper').text(),19)" data-target="#incidencias-modal" style="background-color: green;">Incidencia<i class="mdi mdi-shield-alert"></i></button>
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