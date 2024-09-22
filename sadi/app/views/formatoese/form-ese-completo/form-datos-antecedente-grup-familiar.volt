<form id="form_estudio_antecedentegrupofamiliar" class="form-vertical mt-1" method="post">
                                 
                               
                              
  
  
    <section class="m-3">

              <div class="form-group row mt-3 mb-3 ">
                      <p class="text-gray font-weight-bold">
                        A continuación deberá especificar los datos relacionados con las personas que pertenecen al sistema familiar, así como los datos del cónyuge e hijos, únicamente en caso de que se encuentren laborando.
                      </p>
              </div>
              <div class="row col-lg-12 d-flex ">
                    
              
                <div class="row ml-3 d-flex">
                  {{ link_to('#', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'50','onclick':'fnCrearDatoAntecedenteLaboralGrupoFamiliarDetalles()'),"data-toggle":"modal","data-target":"#agregar-familiar-antecedente-laboral-modal","title":"Agregar antecedentes laborales"  ) }}
                  <span class="ml-3 h6  text-success">Agregar antecedentes laborales</span>

                </div>
        
              </div>
              <div class="form-group row justify-content-center d-none">
                <h6>Folio de referencia de antecedentes de grupo familiar: <span id="agf_id_titulo_agf"> </span></h6>
              </div>

              <input type="hidden" id="agf_id" name="agf_id">

              <div class="form-group row m-3" id="datoantecedentesgrupofamiliardetalleslistado">
              </div>



 
                      <div class="form-group row mt-5">       
                            <div class="col-lg-3">
                              <p class="col-form-label title-busq uppercase">¿Sus padres cuentan con servicio médico?</p>
                            </div>

                            <div class="col-lg-2">
                              <select name="agf_padrescuentan" id="agf_padrescuentan" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ..." onchange="SelectMostrarOcultarDivDeAcuerdoASiONo_NoAplicaConClasesCSS(event.currentTarget.value,'agf_padrescuentan-preg-container','agf_padresservicio');">
                                <optgroup>
                                  <option value="-1">Seleccionar ...</option>
                                  <option value="1">SI</option>
                                  <option value="0">NO</option>
                                  <option value="2">NO APLICA</option>
                                </optgroup>
                              </select>                                          
                            </div>

                            <div class="col-lg-2 agf_padrescuentan-preg-container " style="display: none;">                                              
                                <label for="estudio_nombre_servicio_medico" oninput="handleInput(event)" class="col-form-label title-busq">   Nombre del servicio</label>
                            </div>

                            <div class="col-lg-5 agf_padrescuentan-preg-container " style="display: none;">      
                              <input type="text" class="form-control input-rounded" oninput="handleInput(event)" placeholder="Nombre del servicio..." name="agf_padresservicio" id="agf_padresservicio" maxlength="45"/>
                            </div>

                      </div>

                      <div class="form-group row">       
                            <div class="col-lg-3">
                              <p class="col-form-label title-busq uppercase">¿Su esposo (a) cuenta con servicio médico?</p>
                            </div>

                            <div class="col-lg-2">
                              <select name="agf_conyugecuentan" id="agf_conyugecuentan" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ..."  onchange="SelectMostrarOcultarDivDeAcuerdoASiONo_NoAplicaConClasesCSS(event.currentTarget.value,'agf_conyugecuentan-preg-container','agf_conyugeservicio');">
                                <optgroup>
                                  <option value="-1">Seleccionar ...</option>
                                  <option value="1">SI</option>
                                  <option value="0">NO</option>
                                  <option value="2">NO APLICA</option>
                                  <option value="3">DESCONOCE</option>
                                </optgroup>
                              </select>                                          
                            </div>
                            <div class="col-lg-2 agf_conyugecuentan-preg-container" style="display: none;">                                              
                              <label for="estudio_nombre_servicio_medico" oninput="handleInput(event)" class="col-form-label title-busq">   Nombre del servicio</label>
                          </div>

                          <div class="col-lg-5 agf_conyugecuentan-preg-container" style="display: none;">
                            <input type="text" class="form-control input-rounded" oninput="handleInput(event)" placeholder="Nombre del servicio..." name="agf_conyugeservicio" id="agf_conyugeservicio"  maxlength="45" />
                          </div>


                  </div>

                  <div class="form-group row">
                        <div class="col-lg-2">
                          <p class="col-form-label title-busq ml-2">Notas</p>
                        </div>
                        <div class="col-lg-10">
                          <textarea id="agf_notas" required name="agf_notas" oninput="handleInput(event)"  onkeyup="actualizaInfo(500,'agf_notas', 'label_agf_notas')"class="form-control-textarea text_area_a" style="min-height:5rem" maxlength="500"></textarea>
                          <label class="col-form-label title-busq" id="label_agf_notas"></label>

                        </div>
                    
                  </div>


                    



              





     {% if cuarenta==1%}

                <div class="form-group row d-flex flex-row-reverse" >
                  <div class="col-lg-4">
                        <label class="col-form-label title-busq">Calificación</label>
                        <select name="agf_calificacion" id="agf_calificacion" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
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
              <button type="button" class="btn-green btn-rounded btn btn-limpiar" href="" data-toggle="modal" onclick="incidenciaformulario($('#ese_id_ese_actual').text(),6)" data-target="#incidencias-modal" style="background-color: green;">Incidencia<i class="mdi mdi-shield-alert"></i></button>
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