<form id="form_estudio_seccionSituacionEconomica" class="form-vertical mt-1" method="post">
                              

                             
                                  

    <input type="hidden" id="sie_id" name="sie_id">

    <div class="form-group row text-uppercase d-flex  d-flex justify-content-center">
      <div class="">
        <h5><span class="text-success">Ingresos </span> mensuales </h5>
      </div>
    </div>
    <div class="row col-lg-12 d-flex  ml-2 ">

      <div class="text-left">
        {{ link_to('#', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'50', 'onclick':'fnCrearSituacionEconomicaIngresos();'),"data-toggle":"modal","data-target":"#agregar-situacioneconomica-ingreso-modal","title":"Agregar ingreso." ,'id':'' ) }}
        <span class="ml-1 h6  text-success">Agregar referencias de ingresos</span>
       </div>

    </div>
    <div class="form-group row m-3" id="dato_situacioneconomicaingresos_listado">
    </div>

    <div class="form-group row ml-4">
      <div class="col-lg-3">
        <label class="col-form-label title-busq" for="estudio_estado_civil">¿Recibe manutención?</label>
        <select name="sie_manuingreso" id="sie_manuingreso" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ..." required onchange="mostrarOcultarDivMontoIngresoManuntencion(event.currentTarget.value,'sie_totalingresos');" >
          <optgroup>
            <option value="-1">Seleccionar ...</option>
            <option value="1">SI</option>
            <option value="0">NO</option>
          
          </optgroup>
        </select>

      </div>
      <div class="col-lg-4 " style="display: none;" id="div_container_sie_manuingresomonto">
        <label class="col-form-label title-busq" for="estudio_estado_civil">Monto  de ingreso manuntención</label>
        <input type="number" class="input-number form-control input-rounded " placeholder="$00.00"  name="sie_manuingresomonto" id="sie_manuingresomonto"    onchange="sumarMontoManuntencionAIngresos(event.currentTarget.value,$('#sie_id').val(),'sie_totalingresos','sie_manuingresomonto')" oninput="limitDecimalPlaces(event,2)"  maxlength="45"  step="0.01" />
      </div>
      
    </div>

    <div class="form-group row d-flex justify-content-end">
      <div class="col-lg-6">
        <label class="col-form-label title-busq" for="estudio_estado_civil">Total de ingresos</label>
        <input type="number" class="form-control input-rounded-disabled" placeholder="$00.00" readonly name="sie_totalingresos" id="sie_totalingresos" maxlength="" />


      </div>
    </div>

    <div class="form-group row text-uppercase d-flex  d-flex justify-content-center">
      <div class="">
        <h5> <span class="text-danger">Egresos </span>mensuales </h5>
      </div>
    </div>
    <div class="form-group row ml-1">
     

      <div class="col-lg-3">
        <label class="col-form-label title-busq" for="cop_nacimientofecha">Alimentación</label>
        <input type="number" class="monto-monto form-control input-rounded" placeholder="$00.00"  oninput="limitDecimalPlaces(event,2)" name="sie_alimentacion" id="sie_alimentacion" maxlength="13"   step="0.01"/>

      </div>
      <div class="col-lg-3">
        <label class="col-form-label title-busq" for="estudio_edad">Renta</label>
        <input type="number" class="monto-monto form-control input-rounded" placeholder="$00.00"  oninput="limitDecimalPlaces(event,2)"  name="sie_renta" id="sie_renta" nmaxlength="13" step="0.01" />
      </div>
      
      
      <div class="col-lg-3">
        <label class="col-form-label title-busq" for="estudio_genero">Telefono, luz, agua</label>
        <input type="number" class="monto-monto form-control input-rounded" placeholder="$00.00"  oninput="limitDecimalPlaces(event,2)"  name="sie_telluzagua" id="sie_telluzagua" maxlength="13"   step="0.01"/>

      </div>
 

      <div class="col-lg-3">
        <label class="col-form-label title-busq" for="estudio_estado_civil">Transporte</label>
        <input type="number" class="monto-monto form-control input-rounded" placeholder="$00.00"   oninput="limitDecimalPlaces(event,2)" name="sie_transporte" id="sie_transporte" maxlength="13" step="0.01" />


      </div>

      <div class="col-lg-3">
        <label class="col-form-label title-busq" for="estudio_estado_civil">Ropa/calzado</label>
        <input type="number" class="monto-monto form-control input-rounded" placeholder="$00.00" oninput="limitDecimalPlaces(event,2)"  name="sie_ropacalzado" id="sie_ropacalzado" maxlength="13" step="0.01" />


      </div>
      
      <div class="col-lg-3">
        <label class="col-form-label title-busq" for="estudio_estado_civil">Escolares</label>
        <input type="number" class="monto-monto form-control input-rounded" placeholder="$00.00"  oninput="limitDecimalPlaces(event,2)"  name="sie_escolares" id="sie_escolares" maxlength="13"   step="0.01"/>


      </div>
      <div class="col-lg-3">
        <label class="col-form-label title-busq" for="estudio_estado_civil">Servicio doméstico</label>
        <input type="number" class="monto-monto form-control input-rounded" placeholder="$00.00"   oninput="limitDecimalPlaces(event,2)" name="sie_serviciodomestico" id="sie_serviciodomestico" maxlength="13"   step="0.01"/>


      </div>

      <div class="col-lg-3">
        <label class="col-form-label title-busq" for="estudio_estado_civil">Créditos</label>
        <input type="number" class="monto-monto form-control input-rounded-disabled" placeholder="$00.00" readonly   oninput="limitDecimalPlaces(event,2)" name="sie_creditos" id="sie_creditos" maxlength="13"  step="0.01"/>


      </div>
      <div class="col-lg-3">
        <label class="col-form-label title-busq" for="estudio_estado_civil">Diversiones</label>
        <input type="number" class="monto-monto form-control input-rounded" placeholder="$00.00"  oninput="limitDecimalPlaces(event,2)"  name="sie_diversiones" id="sie_diversiones" maxlength="13"  step="0.01"/>


      </div>
      <div class="col-lg-3">
        <label class="col-form-label title-busq" for="estudio_estado_civil">Otros</label>
        <input type="number" class="monto-monto form-control input-rounded" placeholder="$00.00"  oninput="limitDecimalPlaces(event,2)" name="sie_otros" id="sie_otros" maxlength="13" step="0.01" />

        
      </div>
      <div class="col-lg-3">

          <label class="col-form-label title-busq" for="estudio_estado_civil">¿Da manutención?</label>
          <select name="sie_manuegreso" id="sie_manuegreso" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ..." onchange="SelectMostrarOcultarDivDeAcuerdoASiONo(event.currentTarget.value,'div_container_sie_manuegresomonto','sie_manuegresomonto');">
              <optgroup>
                  <option value="-1">Seleccionar ...</option>
                  <option value="1">SI</option>
                  <option value="0">NO</option>
                
                </optgroup>
          </select>
      </div>

      <div class="col-lg-3" style="display: none;" id="div_container_sie_manuegresomonto">
        <label class="col-form-label title-busq" for="estudio_estado_civil">Monto de manuntención</label>
        <input type="text" class="monto-monto form-control input-rounded input-number" placeholder="$00.00"  onchange="limitDecimalPlaces(event,2)" name="sie_manuegresomonto" id="sie_manuegresomonto" maxlength="13"  step="0.01" />
        
        
      </div>

      <div class="col-lg-12">
        <label class="col-form-label title-busq" for="estudio_estado_civil">Total de egresos</label>
        <input type="number" class="form-control input-rounded-disabled" placeholder="$00.00" readonly  name="sie_totalegresos" id="sie_totalegresos" maxlength="" />
      </div>

      

    </div>





    <section class="m-3 contorno-del-sistema">


      <div class="pt-5">

      </div>

      <div class="from-group row">
        <div class="col-lg-2">
          <label for="estudio_situacionEconomica_comoSolventaEgregesosMayorAIngresos" class="col-form-label title-busq"> ¿Cuándo los egresos son mayores que los ingresos como los solventa?:</label>
        </div>
      
        <div class="col-lg-10">
          <input oninput="handleInput(event)" type="text" class="form-control input-rounded" placeholder="Explicación..." id="sie_solventa" name="sie_solventa" maxlength="100" />
        </div>
        <div class="col-lg-2">

            <label for="estudio_situacionEconomica_situacionEnBuro" class="col-form-label title-busq"> Su situación económica ante Buró de créditos es:</label>
        
        </div>
      
        <div class="col-lg-5">
          <input oninput="handleInput(event)" type="text" class="form-control input-rounded" placeholder="Situación económica es..." id="sie_buro" name="sie_buro" maxlength="45"/>
        </div>

        
  
      </div>

      <div class="from-group row">
        <div class="col-lg-2">

            <label for="estudio_situacionEconomica_situacionEnBuro" class="col-form-label title-busq ">En caso negativo, ¿con qué institución?:</label>
        
        </div>
      
        <div class="col-lg-5">
          <input type="text" class="form-control input-rounded data-not-lt-active" placeholder="Nombre de la institución..." id="sie_institucion" name="sie_institucion" oninput="handleInput(event)"  maxlength="45"/>
        </div>


      </div>
</section>

<!-- CREDITOS VIGENTES  INCIO-->
    
    <div class="form-group row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">                  

              <p class=" text-white text-center font-weight-bold h6 text-uppercase" >
                Créditos vigentes <i class="mdi mdi-square-inc-cash white"></i>
              </p>

    
  </div>
    <div class="row col-lg-12 d-flex  ml-2 ">

      <div class="text-left">
        {{ link_to('#', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'50' , 'onclick':'fnCrearSituacionEconomicaCreditos();'),"data-toggle":"modal","data-target":"#agregar-situacioneconomica-credito-modal","title":"Agregar créditos vigentes." ,'id':'' ) }}
        <span class="ml-1 h5  text-success">Agregar un crédito vigente</span>
       </div>

    </div>

    <div class="form-group row m-3" id="dato_situacioneconomicacredito_listado">
    </div>
    
    <section class="m-3 contorno-del-sistema" >
               


              

                      {% if cuarenta==1%}

                        <div class="form-group row d-flex flex-row-reverse">
                                <div class="col-lg-4">
                                      <label class="col-form-label title-busq">Calificación</label>
                                      <select name="sie_calificacion" id="sie_calificacion" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
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

 <!-- CREDITOS VIGENTES  FIN-->

    
<div class="row col-lg-12">
<div class="col-sm-3 col-md-3 text-center mt-5">
</div>                          
<div class="col-sm-3 col-md-3 text-center mt-5">
  {% if cuarentayseis==1%}
    <div class="form-group">
      <button type="button" class="btn-green btn-rounded btn btn-limpiar" href="" data-toggle="modal" onclick="incidenciaformulario($('#ese_id_ese_actual').text(),7)" data-target="#incidencias-modal" style="background-color: green;">Incidencia<i class="mdi mdi-shield-alert"></i></button>
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
















