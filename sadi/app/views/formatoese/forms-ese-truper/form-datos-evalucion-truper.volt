<form id="form_estudio_seccionEvaluacionFinal_formato_ese_truper" class=" form-vertical mt-1 ">


    
    <section class="m-2">
    
            <div class="form-group row ">
                <div class="col-lg-8">
                    <label for="evt_entornosocioecoacorde" class="col-form-label title-busq">
                        ¿El entorno socioeconómico del candidato es acorde a su puesto y sueldo?							
                    </label>
                </div>
    
                <div class="col-12 col-lg-4">
                    <select name="evt_entornosocioecoacorde" id="evt_entornosocioecoacorde-formato_truper" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
                        <optgroup>
                        <option value="-1">Seleccionar ...</option>
                        <option value="1">SÍ</option>
                        <option value="0">NO</option>
                        </optgroup>
                    </select>
                </div>
    
                <div class="col-12 col-lg-8">
                    <label for="evt_vivendaacordeentornofam" class="col-form-label title-busq">
                        ¿La vivienda corresponde al entorno familiar que el candidato refiere?							
                    </label>
                </div>
    
                <div class="col-12 col-lg-4">
                    <select name="evt_vivendaacordeentornofam" id="evt_vivendaacordeentornofam-formato_truper" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
                        <optgroup>
                        <option value="-1">Seleccionar ...</option>
                        <option value="1">SÍ</option>
                        <option value="0">NO</option>
                        </optgroup>
                    </select>
                </div>
    
                <div class="col-12 col-lg-8">
                    <label for="evt_infovisitacoincide" class="col-form-label title-busq">
                         ¿La información que el candidato proporcionó coincide con lo observado en la visita?							
                    </label>
                </div>
    
                <div class="col-12 col-lg-4">
                    <select name="evt_infovisitacoincide" id="evt_infovisitacoincide-formato_truper" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
                        <optgroup>
                        <option value="-1">Seleccionar ...</option>
                        <option value="1">SÍ</option>
                        <option value="0">NO</option>
                        </optgroup>
                    </select>
                </div>
    
    
                <div class="col-12 col-lg-8">
                    <label for="evt_candibuenactituinform" class="col-form-label title-busq">
                         ¿El candidato mostró buena actitud para proporcionar la información?							
                    </label>
                </div>
    
                <div class="col-12 col-lg-4">
                    <select name="evt_candibuenactituinform" id="evt_candibuenactituinform-formato_truper" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
                        <optgroup>
                        <option value="-1">Seleccionar ...</option>
                        <option value="1">SÍ</option>
                        <option value="0">NO</option>
                        </optgroup>
                    </select>
                </div>
    
                <div class="col-12 col-lg-8">
                    <label for="evt_infodentrocasacandi" class="col-form-label title-busq">
                        ¿La obtención de información se realizó dentro del domicilio del candidato?							
                    </label>
                </div>
    
                <div class="col-12 col-lg-4">
                    <select name="evt_infodentrocasacandi" id="evt_infodentrocasacandi-formato_truper" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
                        <optgroup>
                        <option value="-1">Seleccionar ...</option>
                        <option value="1">SÍ</option>
                        <option value="0">NO</option>
                        </optgroup>
                    </select>
                </div>
    
    
                <div class="col-12 col-lg-8">
                    <label for="evt_canditodainfo" class="col-form-label title-busq">
                        ¿El candidato proporcionó toda la información solicitada?							
                    </label>
                </div>
    
                <div class="col-12 col-lg-4">
                    <select name="evt_canditodainfo" id="evt_canditodainfo-formato_truper" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
                        <optgroup>
                        <option value="-1">Seleccionar ...</option>
                        <option value="1">SÍ</option>
                        <option value="0">NO</option>
                        </optgroup>
                    </select>
                </div>
    
    
    
                <div class="col-12 col-lg-8 mt-1 mb-1">
                    <label for="evt_problemaagendaentrevista" class="col-form-label title-busq">
                         ¿Se tuvo algún problema durante el proceso de agenda de la investigación?							
                    </label>
                </div>
    
                <div class="col-12 col-lg-4 mt-1 mb-1">
                    <select name="evt_problemaagendaentrevista" id="evt_problemaagendaentrevista-formato_truper" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ..."  onchange="SelectMostrarOcultarDivDeAcuerdoASiONoConClasesCSS(event.currentTarget.value,'evt_problemaagendaentrevistacual-container','evt_problemaagendaentrevistacual-formato_truper');">
                        <optgroup>
                        <option value="-1">Seleccionar ...</option>
                        <option value="1">SÍ</option>
                        <option value="0">NO</option>
                        </optgroup>
                    </select>
                </div>

                <div class="col-12 col-lg-2 mt-1 mb-1 evt_problemaagendaentrevistacual-container">
                    <label for="estudio_pertence_club_deportivo" class="col-form-label title-busq">
                        ¿Cuál?
                    </label>
                </div>
    
                <div class="col-12 col-lg-10 mt-1 mb-1 evt_problemaagendaentrevistacual-container">
                    <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="¿Cuál?.." name="evt_problemaagendaentrevistacual" id="evt_problemaagendaentrevistacual-formato_truper" maxlength="85"/>
                </div>
    
    
                <div class="col-12 col-lg-8">
                    <label for="evt_problemavisita" class="col-form-label title-busq">
                         ¿Se tuvo algún problema durante el proceso de visita al candidato?							
                    </label>
                </div>
    
                <div class="col-12 col-lg-4">
                    <select name="evt_problemavisita" id="evt_problemavisita-formato_truper" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ..."  onchange="SelectMostrarOcultarDivDeAcuerdoASiONoConClasesCSS(event.currentTarget.value,'evt_problemavisitacual-container','evt_problemavisitacual-formato_truper');">
                        <optgroup>
                        <option value="-1">Seleccionar ...</option>
                        <option value="1">SI</option>
                        <option value="0">NO</option>
                        </optgroup>
                    </select>
                </div>
                <div class="col-12 col-lg-2 mt-1 mb-1 evt_problemavisitacual-container">
                    <label for="evt_problemavisitacual" class="col-form-label title-busq">
                        ¿Cuál?
                    </label>
                </div>
                <div class="col-12 col-lg-10 mt-1 mb-1 evt_problemavisitacual-container">
                    <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="¿Cuál?.." name="evt_problemavisitacual" id="evt_problemavisitacual-formato_truper" maxlength="85"/>
                </div>
    
                <div class="col-12 col-lg-8 mt-1 mb-1">
                    <label for="evt_problemaanlisisinfo" class="col-form-label title-busq">
                         ¿Se tuvo algún problema durante el proceso de análisis de la información?							
                    </label>
                </div>

                
    
                <div class="col-lg-4 mt-1 mb-1">
                    <select name="evt_problemaanlisisinfo" id="evt_problemaanlisisinfo-formato_truper" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ..."  onchange="SelectMostrarOcultarDivDeAcuerdoASiONoConClasesCSS(event.currentTarget.value,'evt_problemaanlisisinfocual-container','evt_problemaanlisisinfocual-formato_truper');">
                        <optgroup>
                        <option value="-1">Seleccionar ...</option>
                        <option value="1">SÍ</option>
                        <option value="0">NO</option>
                        </optgroup>
                    </select>
                </div>
    
                <div class="col-12 col-lg-2 mt-1 mb-1 evt_problemaanlisisinfocual-container">
                    <label for="evt_problemaanlisisinfocual" class="col-form-label title-busq">
                        ¿Cuál?
                    </label>
                </div>

               <div class="col-12 col-lg-10 mt-1 mb-1 evt_problemaanlisisinfocual-container">
                    <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="¿Cuál?.." name="evt_problemaanlisisinfocual" id="evt_problemaanlisisinfocual-formato_truper" maxlength="85"/>
                </div>
    
    
    
    
    
    
    
    
    
    
            </div >
        
    
    </section>
    
    <section class="m-2">

        <div class="form-group row mr-2 ml-2">
            <div class="col-lg-2">
              <label for="" class="col-form-label title-busq ml-2">RESUMEN GENERAL									
            </label>
    
            </div>
            <div class="col-lg-10">
    
              <textarea id="evt_resumen-formato_truper" name="evt_resumen" oninput="handleInput(event)" class="form-control-textarea text_area_a" placeholder="RESUMEN GENERAL..." style="min-height:10rem" maxlength="1000" onkeyup="actualizaInfo(1000,'evt_resumen-formato_truper', 'label-evt_resumen-formato_truper')"></textarea>
              <label  id="label-evt_resumen-formato_truper" for="evt_resumen-formato_truper" class="col-form-label title-busq ml-2"></label>
    
            </div>
        </div>  
    
    </section>

    <div class="row col-lg-12">
        <div class="col-sm-3 col-md-3 text-center mt-5">
          </div>                          
          <div class="col-sm-3 col-md-3 text-center mt-5">
      
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