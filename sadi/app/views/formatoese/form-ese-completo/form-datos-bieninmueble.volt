<form id="form_estudio_seccionBienesInmuebles" class="form-vertical mt-1">



  
    <!-- <div class="form-group row mt-3 mb-3 mr-3 ml-3 ">
      <p class="text-gray font-weight-bold">
        A continuación deberá especificar los datos relacionados con las personas que pertenecen al sistema familiar, así como los datos del cónyuge e hijos, únicamente en caso de que se encuentren laborando.
      </p>
   </div> -->

    <div class="row col-lg-12 d-flex ">
     
      <div class="ml-2">
        {{ link_to('#', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'50' , 'onclick':'fnCrearBienInmuebleDetalles();'),"data-toggle":"modal","data-target":"#agregar-bieninmuebledetalles-modal","title":"Agregar." ,'id':'' ) }}



      </div>
      <h6 class="text-success">Agregar bienes inmuebles</h6>

    </div>
    
    <div class="form-group row m-3" id="dato_bieninmuebledetalles_listado">
    </div>

    <div class="form-group row m-2">
      <div class="col-lg-2">
        <p class="col-form-label title-busq ml-2">Notas</p>
      </div>
      <div class="col-lg-10">
        <textarea id="bie_notasfamiliares"  name="bie_notasfamiliares" onkeyup="actualizaInfo(400,'bie_notasfamiliares', 'label_bie_notasfamiliares')"  oninput="handleInput(event)" class="form-control-textarea text_area_a" style="min-height:5rem" placeholder="Comentarios de los bienes inmuebles del candidato" maxlength="400"></textarea>
        <label class="col-form-label title-busq" id="label_bie_notasfamiliares"></label>

      </div>
      
  </div>   
  
    <div class="row col-lg-12 d-flex  ml-2 ">

      <div class="text-left">
        {{ link_to('#', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'50', 'onclick':'fnCrearAutomovilDetalles();'),"data-toggle":"modal","data-target":"#agregar-automovil-modal","title":"Agregar auto." ,'id':'' ) }}
        <span class="ml-1 h6  text-success">Agregar automóviles</span>
      </div>

    </div>
    <div class="form-group row m-3" id="dato_automovil_listado">
    </div>

    <section class="m-3">

                         





                        
                    <div class="form-group row">
                            <div class="col-lg-2">
                              <p class="col-form-label title-busq uppercase">Servicio de la zona</p>
  

                            </div>
                            <div class="col-lg-2">
                              <input type="hidden" name="bie_id" id="bie_id">
                                    <label class="col-form-label title-busq text-uppercase " for="bie_agua">Agua</label>
                                    <select  name="bie_agua" id="bie_agua" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                      <optgroup>
                                        <option value="-1">Seleccionar ...</option>
                                        <option value="1">Si</option>
                                        <option value="0">No</option>
                                      </optgroup>
                                    </select>
                            </div>
                            <div class="col-lg-2">
                              <label class="col-form-label title-busq text-uppercase " for="bie_drenaje">Drenaje</label>
                              <select  name="bie_drenaje" id="bie_drenaje" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                <optgroup>
                                  <option value="-1">Seleccionar ...</option>
                                  <option value="1">Si</option>
                                  <option value="0">No</option>
                                </optgroup>
                              </select>
                              </div>

                              <div class="col-lg-2">
                                <label class="col-form-label title-busq text-uppercase " for="bie_pavimento">Pavimento</label>
                                <select  name="bie_pavimento" id="bie_pavimento" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                  <optgroup>
                                    <option value="-1">Seleccionar ...</option>
                                    <option value="1">Si</option>
                                    <option value="0">No</option>
                                  </optgroup>
                                </select>
                              </div>


                              <div class="col-lg-2">
                                <label class="col-form-label title-busq text-uppercase ">Electricidad</label>
                                <select  name="bie_electricidad" id="bie_electricidad" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                  <optgroup>
                                    <option value="-1">Seleccionar ...</option>
                                    <option value="1">Si</option>
                                    <option value="0">No</option>
                                  </optgroup>
                                </select>
                              </div>
                              <div class="col-lg-2">
                                <label class="col-form-label title-busq text-uppercase ">Escuelas</label>
                                <select  name="bie_escuela" id="bie_escuela" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                  <optgroup>
                                    <option value="-1">Seleccionar ...</option>
                                    <option value="1">Si</option>
                                    <option value="0">No</option>
                                  </optgroup>
                                </select>
                              </div>



                    </div>

                    <div class="form-group row">
                   
                            <div class="col-lg-3">
                                    <label class="col-form-label title-busq text-uppercase ">Nivel</label>
                                    <select  name="bie_nivelzona" id="bie_nivelzona" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                      <optgroup>
                                        <option value="-1">Seleccionar ...</option>
                                        <option value="1">Alto</option>
                                        <option value="2">Medio alto</option>
                                        <option value="2">Medio </option>
                                        <option value="3">Medio bajo</option>
                                        <option value="4">Bajo</option>

                                      </optgroup>
                                    </select>
                            </div>

                            <div class="col-lg-3">
                                <label class="col-form-label title-busq text-uppercase ">Tipo</label>
                                <select  name="bie_tipo" id="bie_tipo" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                  <optgroup>
                                    <option value="-1">Seleccionar ...</option>
                                    <option value="1">Casa sola</option>
                                    <option value="2">Duplex</option>
                                    <option value="3">DEPTO</option>
                                    <option value="4">Condominio </option>
                                    <option value="5">Otro</option>

                                  </optgroup>
                                </select>
                            </div>

                            <div class="col-lg-3">
                              <label class="col-form-label title-busq text-uppercase ">Régimen</label>
                              <select  name="bie_regimen" id="bie_regimen" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                      <optgroup>
                                        <option value="-1">Seleccionar ...</option>
                                        <option value="1">Propia</option>
                                         <option value="2">Rentada</option>
                                        <option value="3">Hipotecaria</option>
                                        <option value="4">Prestada </option>
                                         <option value="5">Provisional</option>

                                      </optgroup>
                                </select>
                            </div>  
                            <div class="col-lg-3">
                              <label class="col-form-label title-busq text-uppercase ">Mobiliario</label>
                              <select  name="bie_mobilario" id="bie_mobilario" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                <optgroup>
                                  <option value="-1">Seleccionar ...</option>
                                  <option value="1">Excelente</option>
                                  <option value="2">Bueno </option>
                                  <option value="3">Regular</option>
                                  <option value="4">Malo</option>
                                  <option value="5">Deficiente</option>

                                </optgroup>
                              </select>
                      </div>



                            


                     </div>

                     

                     
                     
           




                     


               <div class="form-group row">
                <div class="col-lg-2">
                  <p class="col-form-label title-busq uppercase">Distribución</p>


                </div>
                <div class="col-lg-2">
                        <label for="estudio_bienesinmuebles_distribucion_recamaras" class="col-form-label title-busq text-uppercase ">Recámaras</label>
                        <input type="text" class="form-control input-rounded" oninput="handleInput(event)"  placeholder="Número..."  name="bie_recamaras" id="bie_recamaras" maxlength="2"/>

                    
                </div>
                <div class="col-lg-2">
                  <label  for="estudio_bienesinmuebles_distribucion_banos" class="col-form-label title-busq text-uppercase ">Baños</label>
                  <input type="text" class="form-control input-rounded" oninput="handleInput(event);"  placeholder="Número de baños..."  name="bie_banos" id="bie_banos" maxlength="2"/>


                  </div>

                  <div class="col-lg-2">
                    <label for="estudio_bienesinmuebles_distribucion_sala" class="col-form-label title-busq text-uppercase ">Sala</label>
                    <input type="text" class="form-control input-rounded" oninput="handleInput(event);"  placeholder="Número de salas..."  name="bie_sala" id="bie_sala" maxlength="2"/>

                   
                  </div>


                  <div class="col-lg-2">
                    <label for="estudio_bienesinmuebles_distribucion_comedor"  class="col-form-label title-busq text-uppercase ">Comedor</label>
                    <input type="text" class="form-control input-rounded"  oninput="handleInput(event);" placeholder="Número..."  name="bie_comedor" id="bie_comedor" maxlength="2"/>


                  </div>
                  <div class="col-lg-2">
                    <label for="estudio_bienesinmuebles_distribucion_garaje" class="col-form-label title-busq text-uppercase ">Garaje</label>
                    <input type="text" class="form-control input-rounded" oninput="handleInput(event);"  placeholder="Número..."  name="bie_garaje" id="bie_garaje" maxlength="2"/>

                    
                  </div>



               </div>

               <div class="form-group row">
                <div class="col-lg-2">
                  <p class="col-form-label title-busq uppercase">Tiempo de habitar el inmueble</p>


                </div>
                <div class="col-lg-2">
                        <label for="estudio_bienesinmuebles_tiempo_habilitar_inmueble_anios" class="col-form-label title-busq text-uppercase ">Años</label>
                        <input type="number" maxlength="2" class="form-control input-rounded"  oninput="soloNumeroPositivos(event);"  onblur="maxLenghtNumeros(event,2)"placeholder="Número..."  name="bie_habitaranos" id="bie_habitaranos"/>

                    
                </div>
                <div class="col-lg-2">
                  <label for="estudio_bienesinmuebles_tiempo_habilitar_inmueble_meses" class="col-form-label title-busq text-uppercase ">Meses</label>
                  <input type="number" maxlength="2" class="form-control input-rounded" oninput="soloNumeroPositivos(event);"  onblur="maxLenghtNumeros(event,2)" placeholder="Número..."  name="bie_habitarmeses" id="bie_habitarmeses"/>


                  </div>
               </div>
               <div class="form-group row mt-3  ">
                      <label for="bie_domicilioanterior" class="col-form-label title-busq text-uppercase ">Si el tiempo de habitar el domicilio es de 12 meses o menor, favor de anotar el domicilio anterior.</label>
              </div>

              <div class="form-group row">
                        <div class="col-lg-12">
                                <input type="text" class="form-control input-rounded" oninput="handleInput(event);"  placeholder="Domicilio anterior..." maxlength="150"  name="bie_domicilioanterior" id="bie_domicilioanterior"/>
                        </div>

                 

               </div>






                    <div class="form-group row">
                          <div class="col-lg-2">
                            <p class="col-form-label title-busq ml-2">Notas</p>
                          </div>
                          <div class="col-lg-10">
                            <textarea id="bie_notasvivienda"  name="bie_notasvivienda" oninput="handleInput(event)" onkeyup="actualizaInfo(500,'bie_notasvivienda', 'label_bie_notasvivienda')" class="form-control-textarea text_area_a" style="min-height:5rem" placeholder="Describe como es la vivienda..."></textarea>
                            <label class="col-form-label title-busq" id="label_bie_notasvivienda"></label>

                          </div>
                      
                    </div>    
                
                    {% if cuarenta==1%}

                    <div class="form-group row d-flex flex-row-reverse">
                      <div class="col-lg-4">
                            <label class="col-form-label title-busq text-uppercase ">Calificación</label>
                            <select  name="bie_calificacion" id="bie_calificacion" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
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
      <button type="button" class="btn-green btn-rounded btn btn-limpiar" href="" data-toggle="modal" onclick="incidenciaformulario($('#ese_id_ese_actual').text(),8)" data-target="#incidencias-modal" style="background-color: green;">Incidencia<i class="mdi mdi-shield-alert"></i></button>
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