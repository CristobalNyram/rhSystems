


<form id="form_estudio_seccionReferenciasLaborales_formato_truper" class="form-vertical mt-1">
                  
                   
    <!-- <div class="form-group row mt-3 mb-3 d-flex justify-content-center">
          <p class="text-danger font-weight-bold uppercase">
            Que no sean de parientes, ni de empleos anteriores
          </p>
    </div> -->
    <input type="hidden" name="sel_id" id="sel_id-formato_truper">
    <input type="hidden" name="tlr_id" id="tlr_id-formato_truper">

    <div class="row col-lg-12 d-flex ml-3 ">
      <div class="">
        {{ link_to('#', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'50' , 'onclick':'fnCrearReferenciaLaboralFormatoTruper()'),"data-toggle":"modal","data-target":"#agregar-referencialaboral-truper-modal","title":"Agregar."  ) }}
      </div>
      <span class="ml-3 h6  text-success">Agregar referencias laborales</span>

    </div>


    <div class="form-group row m-3" id="dato_referencialaboral_truper_listado">
    </div>


    {% if sesentaytres==1  %} 
  

    <section>
      <div class="form-group row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">                  
        <div class="container ">
  
          <p class=" text-white text-center font-weight-bold h6 text-uppercase sin-margen" >
             I | TRAYECTORIA LABORAL DEL CANDIDATO																													
             <i class="fas fa-address-card white mdi-18px"></i>
          </p>

        </div>
      </div>
    
      <div class="section-trayectoria-laboral">
        <div class="row col-lg-12 d-flex ml-3 ">
          <div class="">
            {{ link_to('#', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'50' , 'onclick':'fnCrearTrayectorialaboralFormatoTruper()'),"data-toggle":"modal","data-target":"#agregar-trayectorialaboral-formato-truper-modal","title":"Agregar."  ) }}
          </div>
          <span class="ml-3 h6  text-success">Agregar trayectorias laborales</span>
    
        </div>


      </div>
    
      <div class="m-3">
        <div class="form-group row m-3" id="dato_trayectorialaboral_truper_listado">
        </div>
      </div>

    </section>
    {% endif %}

    {% if sesentaycuatro==1  %} 

    <section>
      <div class="form-group row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">                  
        <div class="container ">
  
          <p class=" text-white text-center font-weight-bold h6 text-uppercase sin-margen" >
             I | TRAYECTORIA LABORAL (Empresas registradas en IMSS e Infonavit)																																				
             <i class="fas fa-address-card white mdi-18px"></i>
          </p>

        </div>




      </div>


      
     
 
     



      <div class="row col-lg-12 d-flex ml-3 ">
        <div class="">
          {{ link_to('#', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'50' , 'onclick':'fnCrearTrayectorialaboralRegistradoDetallesFormatoTruper()'),"data-toggle":"modal","data-target":"#agregar-trayectorialaboralregistradodetalles-formato-truper-modal","title":"Agregar."  ) }}
        </div>
        <span class="ml-3 h6  text-success">Agregar trayectorias laborales (IMSS  e INFONAVIT)</span>
  
      </div>
  
  
      <div class="form-group row m-3" id="dato_trayectorialaboralregistradodetalles_truper_listado">
      </div>

   
        <div class="section-trayectoria-laboral m-3">
          
              <div class="form-group row ">
                <div class="col-lg-4">
                  <label for="estudio_pertence_club_deportivo" class="col-form-label title-busq">¿El candidato reconoce haber laborado en el listado de empresas que aparecen en infonavit?								          </label>
                </div>
                <div class="col-lg-8">
                  <select name="tlr_reconocehabeestado" id="tlr_reconocehabeestado-formato_truper" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ..." onchange="SelectMostrarOcultarDivDeAcuerdoASiONoConClasesCSS_versionNo(event.currentTarget.value,'tlr_empresasnoreconoce-container','tlr_empresasnoreconoce-formato_truper');">
                    <optgroup class="text-uppercase">
                      <option value="-1">Seleccionar ...</option>
                      <option value="1">SÍ</option>
                      <option value="0">NO</option>
                    </optgroup>
                  </select>
                </div>

                  <div class="col-lg-4 tlr_empresasnoreconoce-container">
                    <label for="" class="col-form-label title-busq">Menciona las empresas que no reconoce el candidato:				
                    </label>
                  </div>
                  <div class="col-lg-8 tlr_empresasnoreconoce-container">
                    <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Especifique" name="tlr_empresasnoreconoce" id="tlr_empresasnoreconoce-formato_truper" maxlength="85"/>

                  </div>





              </div >


              <div class="form-group row ">
                <div class="col-lg-4">
                  <label for="estudio_pertence_club_deportivo" class="col-form-label title-busq">
                    ¿Los datos proporcionados por el candidato contenían teléfonos de contacto?								
                  </label>
                </div>
                <div class="col-lg-2">
                  <select name="tlr_datocandidatocontienetelcontacto" id="tlr_datocandidatocontienetelcontacto-formato_truper" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
                    <optgroup class="text-uppercase">
                      <option value="-1">Seleccionar ...</option>
                      <option value="1">SÍ</option>
                      <option value="0">NO</option>
                    </optgroup>
                  </select>
                </div>


                <div class="col-lg-4">
                  <label for="estudio_pertence_club_deportivo" class="col-form-label title-busq">
                    ¿Los datos proporcionados por el candidato contenían nombres de contacto?								
                  </label>
                </div>
                <div class="col-lg-2">
                  <select name="tlr_datocandidatocontienenombrescontacto" id="tlr_datocandidatocontienenombrescontacto-formato_truper" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
                    <optgroup class="text-uppercase">
                      <option value="-1">Seleccionar ...</option>
                      <option value="1">SÍ</option>
                      <option value="0">NO</option>
                    </optgroup>
                  </select>
                </div>




              </div >


              <div class="form-group row ">
                <div class="col-lg-4">
                  <label for="estudio_pertence_club_deportivo" class="col-form-label title-busq">
                    ¿Las fechas proporcionadas por el candidato coinciden con las obtenidas?								
                  </label>
                </div>
                <div class="col-lg-2">
                  <select name="tlr_coincidefechacandadidatoobtenida" id="tlr_coincidefechacandadidatoobtenida-formato_truper" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
                    <optgroup class="text-uppercase">
                      <option value="-1">Seleccionar ...</option>
                      <option value="1">SÍ</option>
                      <option value="0">NO</option>
                    </optgroup>
                  </select>
                </div>


                <div class="col-lg-4">
                  <label for="estudio_pertence_club_deportivo" class="col-form-label title-busq">
                    ¿Los datos proporcionados por el candidato coinciden con lo investigado?								
                  </label>
                </div>
                <div class="col-lg-2">
                  <select name="tlr_coincidedatoscandidadtoinvestigador" id="tlr_coincidedatoscandidadtoinvestigador-formato_truper" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
                    <optgroup class="text-uppercase">
                      <option value="-1">Seleccionar ...</option>
                      <option value="1">SÍ</option>
                      <option value="0">NO</option>
                    </optgroup>
                  </select>
                </div>




              </div >


              


    
     
    
    </section>

    


 







    <div class="row col-lg-12">
      <div class="col-sm-3 col-md-3 text-center mt-5">
      </div>                          
      <div class="col-sm-3 col-md-3 text-center mt-5">
        {% if cuarentayseis==1%}
          <div class="form-group">
            <button type="button" class="btn-green btn-rounded btn btn-limpiar" href="" data-toggle="modal" onclick="incidenciaformulario($('#ese_id_ese_actual_formato_ese_truper').text(),20)" data-target="#incidencias-modal" style="background-color: green;">Incidencia<i class="mdi mdi-shield-alert"></i></button>
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

    {% endif %}

  </form> 